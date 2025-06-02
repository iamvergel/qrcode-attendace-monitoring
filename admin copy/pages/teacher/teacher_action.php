<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['change_status'])) {
    $id = $_POST['user_id'];
    $status = $_POST['next_status'];
    $new_status = '';

    if ($status == "Inactive") {
        $new_status = 0;
    }
    if ($status == "Active") {
        $new_status = 1;
    }

    $sql = "UPDATE tbluser set verify_status='$new_status' WHERE id='$id' ";
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

if (isset($_POST['updateadmin'])) {
    $id = $_POST['edit_id'];
    $lrn = $_POST['lrn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $admin_email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $grade = $_POST['grade'];
    $strand = $_POST['strand'];
    $section = $_POST['section'];

    // Check for email uniqueness across multiple tables
    $checkemail = "SELECT email FROM tbluser WHERE email='$admin_email' AND id != '$id' AND role='teacher'";
    $checkemail_run = mysqli_query($conn, $checkemail);

    if (!$checkemail_run) {
        $_SESSION['error'] = "Failed to check email uniqueness: " . mysqli_error($conn);
        header('Location:index.php');
        exit();
    }

    if (mysqli_num_rows($checkemail_run) > 0) {
        $_SESSION['error'] = "Email Already Exists";
        header('Location:index.php');
        exit();
    }

    // Update admin data
    $sql = "UPDATE tbluser SET 
            lrn='$lrn',
            fname='$fname',
            lname='$lname',
            address='$address',
            phone='$phone',
            email='$admin_email',
            dob='$birthday',
            gender='$gender',
            grade='$grade',
            strand='$strand',
            section='$section' 
            WHERE id='$id' AND role='teacher'";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Admin Updated Successfully";
    } else {
        $_SESSION['error'] = "Admin Update Failed: " . mysqli_error($conn);
    }

    header('Location:index.php');
    exit();
}

if (isset($_POST['checking_editAdminbtn'])) {
    $s_id = $_POST['user_id'];
    $result_array = [];

    $sql = "SELECT * FROM tbluser WHERE role='teacher' AND id='$s_id' ";
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

    $sql = "SELECT * FROM tbluser WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
            <div class="col-md-4">
                <h3 class="profile-username text-center"><?php echo $row['fname'] . ' ' . $row['lname']; ?></h3>
                <p class="text-muted text-center"><?php echo $row['role']; ?></p>
                <ul class="list-group list-group-unbordered mb-2">
                    <li class="list-group-item">
                        <b>Email</b>
                        <p class="float-right text-muted"><?php echo $row['email']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Grade</b>
                        <p class="float-right text-muted"><?php echo $row['grade']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Strand</b>
                        <p class="float-right text-muted"><?php echo $row['strand']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Section</b>
                        <p class="float-right text-muted"><?php echo $row['section']; ?></p>
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
            </div>
            <div class="col-md-8">
                <h1><?php echo $row['grade'] . ' - ' . $row['strand'] . ' ' . $row['section']; ?></h1>
                <table>
                    <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                        <thead class="bg-light">
                            <tr>
                                <th class="export">Name</th>
                                <th class="export">LRN</th>
                                <th class="export">Grade</th>
                                <th class="export">Strand</th>
                                <th class="export">Section</th>
                                <th class="export">Gender</th>
                                <th class="export">Email</th>
                            </tr>
                        </thead>
                        <tbody><?php
                        $i = 1;
                        $user = $_SESSION['auth_user']['user_id'];
                        $sql = "SELECT * FROM tbluser WHERE role='student' AND grade = '" . $row['grade'] . "' AND strand = '" . $row['strand'] . "' ORDER BY id DESC";
                        $query_run = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($query_run)) { ?>
                                <tr>
                                    <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                    <td><?php echo $row['lrn']; ?></td>
                                    <td><?php echo $row['grade'] ?></td>
                                    <td><?php echo $row['strand']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </table>
            </div>
            <?php
        }
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['insertadmin'])) {
    $doc_fname = $_POST['fname'];
    $doc_address = $_POST['address'];
    $doc_phone = $_POST['phone'];
    $admin_email = $_POST['email'];
    $role = '';
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $regdate = date('Y-m-d H:i:s');

    $image = $_FILES['doc_image']['name'];

    if ($password == $confirmPassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $checkemail = "SELECT email FROM tbladmin WHERE email='$admin_email' 
            UNION ALL SELECT email FROM tblstaff WHERE email='$admin_email'
            UNION ALL SELECT email FROM tblpatient WHERE email='$admin_email'
            UNION ALL SELECT email FROM tbldoctor WHERE email='$admin_email' ";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['error'] = "Email Already Exist";
            header('Location:index.php');
        } else {
            if ($image != NULL) {
                $allowed_file_format = array('jpg', 'png', 'jpeg');

                $image_extension = pathinfo($image, PATHINFO_EXTENSION);


                if (!in_array($image_extension, $allowed_file_format)) {
                    $_SESSION['error'] = "Upload valid file. jpg, png";
                    header('Location:index.php');
                } else if (($_FILES['doc_image']['size'] > 5000000)) {
                    $_SESSION['error'] = "File size exceeds 5MB";
                    header('Location:index.php');
                } else {
                    $filename = time() . '.' . $image_extension;
                    move_uploaded_file($_FILES['doc_image']['tmp_name'], '../../../upload/admin/' . $filename);
                }
            } else {
                $character = $_POST["fname"][0];
                $path = time() . ".png";
                $imagecreate = imagecreate(200, 200);
                $red = rand(0, 255);
                $green = rand(0, 255);
                $blue = rand(0, 255);
                imagecolorallocate($imagecreate, 230, 230, 230);
                $textcolor = imagecolorallocate($imagecreate, $red, $green, $blue);
                imagettftext($imagecreate, 100, 0, 55, 150, $textcolor, '../../font/arial.ttf', $character);
                imagepng($imagecreate, '../../../upload/admin/' . $path);
                imagedestroy($imagecreate);
                $filename = $path;
            }

            if ($_SESSION['error'] == '') {
                $sql = "INSERT INTO tbladmin (name,address,phone,email,image,password,role,created_at)
                    VALUES ('$doc_fname','$doc_address','$doc_phone','$admin_email','$filename','$hash','admin','$regdate')";
                $doctor_query_run = mysqli_query($conn, $sql);
                if ($doctor_query_run) {

                    $_SESSION['success'] = "Adding Admin Successfully";
                    header('Location:index.php');
                } else {
                    //$_SESSION['error'] = "Adding Admin Failed";
                    $_SESSION['error'] = mysqli_error($conn);
                    header('Location:index.php');
                }
            }
        }
    } else {
        $_SESSION['error'] = "Password does not match";
        header('Location:index.php');
    }
}
?>