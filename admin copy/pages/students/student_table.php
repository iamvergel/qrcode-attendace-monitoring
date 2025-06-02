<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_SESSION['auth'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $sql_user_count = "SELECT grade, strand, section FROM tbluser WHERE id = '$user_id'";
    $query_run_user_count = mysqli_query($conn, $sql_user_count);
    $row_user_count = mysqli_fetch_assoc($query_run_user_count);
    $grade = $row_user_count['grade'];
    $strand = $row_user_count['strand'];
    $section = $row_user_count['section'];

    $table = 'tbluser WHERE role = "student" AND grade = "' . $grade . '" AND strand = "' . $strand . '" AND section = "' . $section . '"';
    $primaryKey = 'id';
    
    $columns = array(
        array( 'db' => 'fname',  'dt' => 'fname' ),
        array( 'db' => 'lname',  'dt' => 'lname' ),
        array( 'db' => 'lrn',  'dt' => 'lrn' ),
        array( 'db' => 'grade',  'dt' => 'grade' ),
        array( 'db' => 'section', 'dt' => 'section' ),
        array( 'db' => 'dob',  'dt' => 'dob' ),
        array( 'db' => 'gender',  'dt' => 'gender' ),
        array( 'db' => 'phone',   'dt' => 'phone' ),
        array( 'db' => 'email',  'dt' => 'email' ),
        array( 'db' => 'id',   'dt' => 'id' ),
    );

    require('../../config/sspconn.php');

    require('../../ssp.class.php');
    
    echo json_encode(
        SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns)
    );

}

