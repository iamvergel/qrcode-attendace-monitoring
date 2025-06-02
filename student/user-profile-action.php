<?php
    include('authentication.php');
    include('../admin/config/dbconn.php');

    if(isset($_POST['update_user']))
    {
        $id = $_POST['userid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['birthday'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $gfname = $_POST['gfname'];
        $glname = $_POST['glname'];
        $gemail = $_POST['gemail'];
        $gphone = $_POST['gphone'];

        $sql = "UPDATE tbluser SET fname='$fname',lname='$lname',dob='$dob',address='$address',phone='$contact',gfname='$gfname',glname='$glname',gemail='$gemail',gphone='$gphone' WHERE id='$id'";
        $query_run = mysqli_query($conn,$sql);

        if($query_run)
        {
            $_SESSION['success'] = "Profile Updated Successfully";
            header('Location: user-profile.php');
        }
        else
        {
            $_SESSION['error'] = "Profile Update Failed";
            header('Location: user-profile.php');
        }
    }

    if(isset($_POST['change_password']))
    {
        $id = $_POST['userid'];
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];
        $confirm_pass = $_POST['confirm_pass'];

        if(!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass))
        {
            $sql = "SELECT password FROM tbluser WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    if(password_verify($current_pass,$row['password']))
                    {
                        if($new_pass == $confirm_pass)
                        {
                            $hash = password_hash($new_pass,PASSWORD_DEFAULT);
                            $update_password = "UPDATE tbluser SET password='$hash' WHERE id='$id' LIMIT 1";
                            $update_password_run = mysqli_query($conn,$update_password);

                            if($update_password_run)
                            {
                                $_SESSION['success'] = "Password has been changed";
                                header("Location:user-profile.php");
                            }
                        }
                        else
                        {
                            $_SESSION['error'] = "Password and Confirm Password does not match";
                            header("Location:user-profile.php");
                        }

                    }           
                    else
                    {
                        $_SESSION['error'] = "Your current password does not match. Please try again.";
                        header("Location:user-profile.php");
                    }
                }
            }
              
        }
        else
        {
            $_SESSION['error'] = "Please Complete All Fields";
            header("Location:user-profile.php");
        }
    }


?>