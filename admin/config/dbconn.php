<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "attendance";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
  header("Location: ../errors/db.php");
  die();
}
