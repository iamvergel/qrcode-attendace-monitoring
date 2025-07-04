<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['dental_record'])) {
    $student = $_POST['student'];
    $dentist = $_POST['dentist'];
    $visit = $_POST['visit'];


    $sql = "INSERT INTO dental_history (student_id,dentist,visit) values ('$student','$dentist','$visit')";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = 'Dental Record Added Successfully';
        header('Location:student-details.php?id=' . $student);
    } else {
        $_SESSION['error'] = 'Dental Record Added Unsuccessfull';
        header('Location:student-details.php?id=' . $student);
    }
}

if (isset($_POST['dental_editbtn'])) {
    $id = $_POST['user_id'];
    $result_array = [];

    $sql = "SELECT * FROM dental_history WHERE id='$id'";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['update_dental'])) {
    $id = $_POST['edit_id'];
    $userid = $_POST['userid'];
    $dentist = $_POST['dentist'];
    $visit = $_POST['visit'];

    $sql = "UPDATE dental_history set dentist='$dentist',visit='$visit' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Dental Record Updated Successfully";
        header('Location:student-details.php?id=' . $userid);
    } else {
        $_SESSION['error'] = "Dental Record Updated Unsuccessfull";
        header('Location:student-details.php?id=' . $userid);
    }
}

if (isset($_POST['delete_dental'])) {
    $student = $_POST['student'];
    $id = $_POST['user_id'];

    $sql = "DELETE FROM dental_history WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Dental Record Deleted Successfully";
        header('Location:student-details.php?id=' . $student);
    } else {
        $_SESSION['error'] = "Dental Record Deleted Unsuccessfull";
        header('Location:student-details.php?id=' . $student);
    }
}

if (isset($_POST['medical_record'])) {
    $student = $_POST['student'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];
    $allergy = $_POST['allergy'];
    $med = $_POST['med'];
    $medical = implode(',', $med);
    $date_submitted = date('Y-m-d H:i:s');

    $sql = "INSERT INTO medical_record (student_id,q1,q2,q3,q4,q5,allergy,med,created_at) values ('$student','$q1','$q2','$q3','$q4','$q5','$allergy','$medical','$date_submitted')";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = 'Medical Record Added Successfully';
        header('Location:student-details.php?id=' . $student);
    } else {
        $_SESSION['error'] = 'Medical Record Failed to Add';
        header('Location:student-details.php?id=' . $student);
    }
}

if (isset($_POST['update_medical_record'])) {
    $id = $_POST['user_id'];
    $student = $_POST['student'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];
    $allergy = $_POST['allergy'];
    $med = $_POST['med'];
    $medical = implode(',', $med);

    $sql = "UPDATE medical_record SET q1='$q1',q2='$q2',q3='$q3',q4='$q4',q5='$q5',allergy='$allergy',med='$medical' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = 'Medical Record Updated Successfully';
        header('Location:student-details.php?id=' . $student);
    } else {
        $_SESSION['error'] = 'Medical Record Failed to Update';
        header('Location:student-details.php?id=' . $student);
    }
}

if (isset($_POST['delete_medical'])) {
    $id = $_POST['user_id'];

    $sql = "DELETE FROM medical_record WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Medical Record Deleted Successfully";
        header('Location:student-details.php?id=' . $student);
    } else {
        $_SESSION['error'] = "Medical Record Deleted Unsuccessfull";
        header('Location:student-details.php?id=' . $student);
    }
}
