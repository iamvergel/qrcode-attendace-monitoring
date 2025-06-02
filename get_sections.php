<?php
include('admin/config/dbconn.php');
include('superglobal.php');

if (isset($_POST['grade']) && isset($_POST['strand'])) {
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $strand = mysqli_real_escape_string($conn, $_POST['strand']);
    $query = "SELECT DISTINCT section FROM grade_section WHERE grade = '$grade' AND strand = '$strand' AND status = 'active'";
    $result = mysqli_query($conn, $query);

    $sections = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row['section'];
    }

    echo json_encode($sections);
}