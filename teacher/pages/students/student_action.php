<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['insertstudent'])) {
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $address = $_POST['address'];
    $dob = $_POST['birthday'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = '';
    $password = 'pass123';
    $confirmPassword = 'pass123';
    $verify_status = '';
    $regdate = date('Y-m-d H:i:s');

    if ($password == $confirmPassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $checkemail = "SELECT email FROM tbladmin WHERE email='$email' 
            UNION ALL SELECT email FROM tblstaff WHERE email='$email'
            UNION ALL SELECT email FROM tbluser WHERE email='$email'
            UNION ALL SELECT email FROM tbldoctor WHERE email='$email' ";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['error'] = "Email Already Exist";
            header('Location:index.php');
        } else {
            $sql = "INSERT INTO tbluser (fname,lname,address,dob,gender,phone,email,password,role,verify_status,created_at)
                VALUES ('$fname','$lname','$address','$dob','$gender','$phone','$email','$hash','student','1','$regdate')";
            $student_query_run = mysqli_query($conn, $sql);
            if ($student_query_run) {
                $_SESSION['success'] = "Adding student Successfully";
                header('Location:index.php');
            } else {
                $_SESSION['error'] = "Adding student Failed";
                header('Location:index.php');
            }
        }
    } else {
        $_SESSION['error'] = "Password does not match";
        header('Location:index.php');
    }
}

if (isset($_POST['userid'])) {
    $id = $_POST['userid'];
    //echo $return = $s_id;

    $sql = "SELECT * FROM tbluser WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
?>
            <div class="text-center">
                <img src="../../../upload/students/<?= $row['image'] ?>" class="img-thumbnail" width="120" alt="Doctor Image">
            </div>
            <h3 class="profile-username text-center"><?php echo $row['fname'] . ' ' . $row['lname']; ?></h3>
            <p class="text-muted text-center">student</p>
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
                <li class="list-group-item">
                    <b>Birthday</b>
                    <p class="float-right text-muted"><?php echo $row['dob']; ?></p>
                </li>
                <li class="list-group-item">
                    <b>Gender</b>
                    <p class="float-right text-muted"><?php echo $row['gender']; ?></p>
                </li>
            </ul>
<?php
        }
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}


if (isset($_POST['checking_editbtn'])) {
    $id = $_POST['user_id'];
    $result_array = [];

    $sql = "SELECT * FROM tbluser WHERE id='$id' ";
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

if (isset($_POST['updatedata'])) {
    $id = $_POST['edit_id'];
    $grade  = $_POST['grade'];
    $strand  = $_POST['strand'];
    $section  = $_POST['section'];

    $sql = "UPDATE tbluser set grade='$grade', strand='$strand', section='$section'  WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "student Updated Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "student Updated Unsuccessfully";
        header('Location:index.php');
    }
}

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];
    $del_image = $_POST['del_image'];

    $check_img_query = " SELECT * FROM tbluser WHERE id='$id' LIMIT 1";
    $img_res = mysqli_query($conn, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $sql = "DELETE FROM tbluser WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('../../../upload/students/' . $image)) {
                unlink("../../../upload/students/" . $image);
            }
        }
        $_SESSION['success'] = "student Deleted Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "index Deleted Unsuccessfully";
    }
}
