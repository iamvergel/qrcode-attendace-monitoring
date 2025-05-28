<?php
include('../../authentication.php');
include('../../config/dbconn.php');

header('Content-Type: application/json');

if (isset($_GET['grade'])) {
    $grade = mysqli_real_escape_string($conn, $_GET['grade']);

    $query = "SELECT DISTINCT section FROM tbluser WHERE grade = '$grade' ORDER BY section ASC";
    $result = mysqli_query($conn, $query);

    $sections = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row['section'];
    }

    echo json_encode($sections);
} else {
    echo json_encode([]);
}