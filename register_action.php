<?php
session_start();
include('admin/config/dbconn.php');
include('superglobal.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

function sendmail_verify($fname, $email, $verify_token, $system_name, $mail_link, $mail_host, $mail_username, $mail_password)
{
    // $mail->SMTPDebug = 2;	
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $mail_host;
    $mail->SMTPAuth = true;
    $mail->Username = $mail_username;
    $mail->Password = $mail_password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($mail_username, $fname);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Email verification from ' . $system_name;

    $email_template = "	
        <div style='
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            color: #333;
        '>
            <h2 style='color: #2c3e50;'>You have registered with $system_name</h2> 	
            <p style='font-size: 16px;'>Please click the link below to verify your email address and complete the registration process.</p>	
            <p style='font-size: 16px;'>You will be automatically redirected to the sign-in page after verification.</p>	
            <p style='font-size: 16px;'>Please click below to activate your account:</p>	
            <a href='$mail_link/verify_email.php?token=$verify_token' style='
                display: inline-block;
                padding: 12px 20px;
                margin-top: 10px;
                background-color: #3498db;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            '>Click Here</a>
        </div>
    ";
    $mail->Body = $email_template;
    try {
        $mail->send();
        echo "Message has been sent";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['register_btn'])) {
    $lrn = $_POST['lrn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $dob = $_POST['birthday'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $grade = $_POST['grade'];
    $strand = $_POST['strand'];
    $section = $_POST['section'];
    $gfname = $_POST['gfname'];
    $glname = $_POST['glname'];
    $gemail = $_POST['gemail'];
    $gphone = $_POST['gphone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $regdate = date('Y-m-d H:i:s');
    $verify_token = md5(rand());

    if ($password == $confirmPassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $checkemail = "SELECT * FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['error'] = "Email Already Exist";
            header('Location:register.php');
        } else {
            $sql = "INSERT INTO tbluser 
            (lrn, fname, lname, grade, strand, section, address, dob, gender, phone, email, password, role, verify_token, created_at, gfname, glname, gemail, gphone)
            VALUES 
            ('$lrn', '$fname', '$lname', '$grade', '$strand', '$section', '$address', '$dob', '$gender', '$phone', '$email', '$hash', 'student', '$verify_token', '$regdate', '$gfname', '$glname', '$gemail', '$gphone')";

            $patient_query_run = mysqli_query($conn, $sql);
            if ($patient_query_run) {
                sendmail_verify("$fname", "$email", "$verify_token", $system_name, $mail_link, $mail_host, $mail_username, $mail_password);
                $_SESSION['info'] = "We've sent an email to <b>$email</b> please check your email and click the link to verify.";
                header('Location:index.php');
            } else {
                $_SESSION['warning'] = "Registration Failed";
                header('Location:register.php');
            }
        }
    } else {
        $_SESSION['error'] = "Password does not match";
        header('Location:register.php');
    }
}
