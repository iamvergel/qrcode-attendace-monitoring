<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_POST['grade'])) {
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $query = "SELECT DISTINCT strand FROM grade_section WHERE grade = '$grade' AND status = 'active'";
    $result = mysqli_query($conn, $query);

    $strands = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $strands[] = $row['strand'];
    }

    echo json_encode($strands);
}