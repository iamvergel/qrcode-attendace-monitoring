<?php

include('admin/config/dbconn.php');
global $system_name, $system_logo, $address, $email, $mobile, $map, $brand, $facebook;
$sql = "SELECT * FROM system_details LIMIT 1";
$query_run = mysqli_query($conn, $sql);

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        $system_name = $row['name'];
        $email = $row['email'];
    }
}

global $mail_username, $mail_host, $mail_password, $mail_link, $mail_host, $mail_username, $mail_password;
$mail_link = 'https://www.mercifulsaviourhc.com/';

$sql = "SELECT * FROM mail_settings LIMIT 1";
$query_run = mysqli_query($conn, $sql);

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        $mail_host = $row['host'];
        $mail_username = $row['username'];
        $mail_password = $row['password'];
    }
}
