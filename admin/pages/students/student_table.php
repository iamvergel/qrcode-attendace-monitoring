<?php

include('../../config/dbconn.php');


    $table = 'tbluser';
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

    $where = "role='student'";
    require('../../config/sspconn.php');

    require('../../ssp.class.php');
    
    echo json_encode(
        SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns)
    );
