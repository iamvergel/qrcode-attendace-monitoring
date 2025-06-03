<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['lrn']) && isset($_POST['action'])) {
    $lrn = mysqli_real_escape_string($conn, $_POST['lrn']);
    $status = mysqli_real_escape_string($conn, $_POST['action']);

    // Optional: validate the status
    $valid_statuses = ['present', 'late', 'absent'];
    if (!in_array($status, $valid_statuses)) {
        $_SESSION['error'] = "Invalid attendance status";
        header("Location: index.php");
        exit();
    }

    // Update the student's attendance_status
    $sql = "UPDATE tbluser SET attendance_status = '$status' WHERE lrn = '$lrn'";
    $update_run = mysqli_query($conn, $sql);

    if ($update_run) {
        $_SESSION['success'] = "Attendance status updated to: " . ucfirst($status);
    } else {
        $_SESSION['error'] = "Failed to update attendance status";
    }

    header("Location: index.php");
    exit();
} else {
    $error_message = mysqli_error($conn);
    $_SESSION['error'] = "Invalid request: " . $error_message;
    echo $error_message;
    header("Location: index.php");
    exit();
}

