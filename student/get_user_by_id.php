<?php
include('authentication.php');
include('../admin/config/dbconn.php');

date_default_timezone_set("Asia/Manila");

// Check if the user is logged in
if (isset($_SESSION['auth'])) {
    $logged_in_user_id = $_SESSION['auth_user']['user_id']; // Get the logged-in user's ID

    // Handle the QR ID and check if it matches the logged-in user's ID
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']); // Get the ID from the QR code scan

        // If the scanned ID does not match the logged-in user's ID, show an error
        if ($id != $logged_in_user_id) {
            echo json_encode(['success' => false, 'message' => 'Scanned QR code ID does not match the logged-in user.']);
            exit();
        }

        // If the IDs match, proceed to fetch the user details from the database
        $query = "SELECT * FROM tbluser WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        // Check if the user exists and return their data
        if ($row = mysqli_fetch_assoc($result)) {
            echo json_encode(['success' => true, 'user' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Scanned QR code does not correspond to any registered user.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No QR code scanned.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
}