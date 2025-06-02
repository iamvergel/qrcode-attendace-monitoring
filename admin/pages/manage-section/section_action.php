<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['change_status'])) {
    $id = $_POST['user_id'];
    $status = $_POST['next_status'];
    $new_status = '';

    if ($status == "inactive") {
        $new_status = 'inactive';
    }
    if ($status == "active") {
        $new_status = 'active';
    }

    $sql = "UPDATE grade_section set status='$new_status' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Admin Status Change Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "Admin Status Change Unsuccessfully";
        header('Location:index.php');
    }
}

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];
    $del_image = $_POST['del_image'];

    $check_img_query = " SELECT * FROM tbladmin WHERE id='$id' LIMIT 1";
    $img_res = mysqli_query($conn, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $sql = "DELETE FROM tbladmin WHERE id='$id' LIMIT 1";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('../../../upload/admin/' . $image)) {
                unlink("../../../upload/admin/" . $image);
            }
        }
        $_SESSION['success'] = "Admin Deleted Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "Admin Deleted Unsuccessfully";
        header('Location:index.php');
    }
}

if (isset($_POST['update_grade_section'])) {
    $id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $strand = mysqli_real_escape_string($conn, $_POST['strand']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $updated_at = date('Y-m-d H:i:s');

    // Check for duplicate (excluding current record)
    $check = "SELECT * FROM grade_section WHERE grade = '$grade' AND strand = '$strand' AND section = '$section' AND id != '$id'";
    $check_run = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_run) > 0) {
        $_SESSION['error'] = "Grade and Section already exists.";
        header("Location: index.php");
        exit();
    }

    $query = "UPDATE grade_section 
              SET grade = '$grade', strand = '$strand', section = '$section', status = '$status', updated_at = '$updated_at' 
              WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Grade & Section updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update record: " . mysqli_error($conn);
    }

    header("Location: index.php");
    exit();
}

if (isset($_POST['checking_editAdminbtn'])) {
    $s_id = $_POST['user_id'];
    $result_array = [];

    $sql = "SELECT * FROM grade_section WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['checking_viewAdmintbtn'])) {
    $s_id = $_POST['user_id'];

    $sql = "SELECT * FROM tbladmin WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
?>
            <div class="text-center">
                <img src="../../../upload/admin/<?= $row['image'] ?>" class="img-thumbnail img-fluid img-circle" width="120" alt="Admin Image">
            </div>
            <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>
            <p class="text-muted text-center"><?php echo $row['specialty']; ?></p>
            <ul class="list-group list-group-unbordered mb-2">
                <li class="list-group-item">
                    <b>Email</b>
                    <p class="float-right text-muted"><?php echo $row['email']; ?></p>
                </li>
                <li class="list-group-item">
                    <b>Phone</b>
                    <p class="float-right text-muted"><?php echo $row['phone']; ?></p>
                </li>
                <li class="list-group-item">
                    <b>Address</b>
                    <p class="float-right text-muted"><?php echo $row['address']; ?></p>
                </li>
            </ul>
<?php
        }
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['insert_grade_section'])) {
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $strand = mysqli_real_escape_string($conn, $_POST['strand']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');

    // Optional: check for duplicate
    $check = "SELECT * FROM grade_section WHERE grade = '$grade' AND section = '$section' AND strand = '$strand'";
    $check_run = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_run) > 0) {
        $_SESSION['error'] = "Grade and Section already exists.";
        header("Location: index.php"); // change to your redirect page
        exit();
    }

    $query = "INSERT INTO grade_section (grade, strand, section, status, created_at) 
              VALUES ('$grade', '$strand', '$section', '$status', '$created_at')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Grade & Section added successfully.";
    } else {
        $_SESSION['error'] = "Failed to add record: " . mysqli_error($conn);
    }

    header("Location: index.php"); // change as needed
    exit();
}
?>