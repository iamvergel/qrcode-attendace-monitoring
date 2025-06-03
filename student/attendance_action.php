<?php
include('authentication.php');
include('../admin/config/dbconn.php');
include('superglobal.php');

date_default_timezone_set("Asia/Manila");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function sendGuardianEmail($fname, $lrn, $lname, $email, $gemail, $status, $time, $grade, $strand, $section, $system_name, $mail_host, $mail_username, $mail_password)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $mail_host;
    $mail->SMTPAuth = true;
    $mail->Username = $mail_username;
    $mail->Password = $mail_password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($mail_username, $system_name);
    $mail->addAddress($gemail);
    $mail->isHTML(true);

    $date_formatted = date('Y-m-d', strtotime($time));
    $time_formatted = date('h:i A', strtotime($time));

    $mail->Subject = 'Attendance Update for ' . $fname . ' ' . $lname;

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
            <h2 style='color: #2c3e50;'>Attendance Update for $fname $lname</h2>  
            <p style='font-size: 16px;'>Your child, <strong>$fname $lname</strong>, has marked their attendance for today.</p>
            <p style='font-size: 16px;'>Here are the details:</p>
            <ul>
                <li><strong>LRN:</strong> $lrn</li>
                <li><strong>Grade:</strong> $grade</li>
                <li><strong>Strand:</strong> $strand</li>
                <li><strong>Section:</strong> $section</li>
                <li><strong>Status:</strong> $status</li>
                <li><strong>Date:</strong> $date_formatted</li>
                <li><strong>Time:</strong> $time_formatted</li>
            </ul>
            <p style='font-size: 16px;'>This is a confirmation that your child has successfully marked their attendance. If you have any questions, feel free to reach out to us.</p>
        </div>
    ";

    $mail->Body = $email_template;
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $time = date('Y-m-d H:i:s');

    $query = "SELECT * FROM tbluser WHERE id='$user_id'";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $lrn = $user['lrn'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $grade = $user['grade'];
        $strand = $user['strand'];
        $section = $user['section'];
        $email = $user['email'];
        $gemail = $user['gemail'];

        $check = "SELECT * FROM attendance WHERE user_id='$user_id' AND DATE(timestamp) = CURDATE() AND status='$status'";
        $check_res = mysqli_query($conn, $check);

        if (mysqli_num_rows($check_res) > 0) {
            $_SESSION['message'] = "You have already " . ($status == 'Time In' ? 'timed in' : 'timed out') . " for today.";
        } else {
            $last_check = "SELECT * FROM attendance WHERE user_id='$user_id' ORDER BY timestamp DESC LIMIT 1";
            $last_check_res = mysqli_query($conn, $last_check);
            $last_check_row = mysqli_fetch_assoc($last_check_res);

            if ($last_check_row && $last_check_row['status'] == $status) {
                $_SESSION['message'] = "You have already " . ($status == 'Time In' ? 'timed in' : 'timed out') . " for today.";
            } else {
                $insert = "INSERT INTO attendance (user_id, lrn, fname, lname, grade, strand, section, personal_email, guardian_email, status, timestamp)
                           VALUES ('$user_id', '$lrn', '$fname', '$lname', '$grade', '$strand', '$section', '$email', '$gemail', '$status', '$time')";

                if (mysqli_query($conn, $insert)) {
                    sendGuardianEmail($fname, $lrn, $lname, $email, $gemail, $status, $time, $grade, $strand, $section, $system_name, $mail_host, $mail_username, $mail_password);

                    $_SESSION['message'] = "Attendance " . ($status == 'Time In' ? 'Time In' : 'Time Out') . " successfully recorded.";
                } else {
                    $_SESSION['message'] = "Failed to record attendance.";
                }
            }
        }
    } else {
        $_SESSION['message'] = "Failed to record attendance. The QR code you scanned does not match the student who is currently logged in.";
    }

    header('Location: index.php');
}

