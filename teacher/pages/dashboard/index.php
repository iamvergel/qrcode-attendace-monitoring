<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed" style="overflow-x: hidden;">
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row px-5">
            <?php
            // Get all users count
            $sql_user_count = "SELECT COUNT(*) AS total_users FROM tbluser";
            $query_run_user_count = mysqli_query($conn, $sql_user_count);
            $row_user_count = mysqli_fetch_assoc($query_run_user_count);
            $total_users = $row_user_count['total_users'];
            ?>

            <div class="col-lg-12 mb-3 mt-0 mt-lg-3">
              <div class="small-box bg-info px-5">
                <div class="inner">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold" style="font-size: 2rem;">Immaculada Students <br /> <small style="font-size: 1rem;">Total Students</small></span>
                    <h1 class="font-weight-bold" style="font-size: 5rem;"><?php echo $total_users; ?></h1>
                  </div>
                   
                </div>
              </div>
            </div>

            <?php
            // Fetch Grade 11 students based on section
            $sql_grade11 = "SELECT COUNT(*) AS total_grade11 FROM tbluser WHERE grade = 'Grade 11'";
            $query_run_grade11 = mysqli_query($conn, $sql_grade11);
            $row_grade11 = mysqli_fetch_assoc($query_run_grade11);
            $total_grade11 = $row_grade11['total_grade11'];

            // Fetch Grade 12 students based on section
            $sql_grade12 = "SELECT COUNT(*) AS total_grade12 FROM tbluser WHERE grade = 'Grade 12'";
            $query_run_grade12 = mysqli_query($conn, $sql_grade12);
            $row_grade12 = mysqli_fetch_assoc($query_run_grade12);
            $total_grade12 = $row_grade12['total_grade12'];
            ?>

            <div class="col-lg-6 mb-3 mt-0">
              <div class="small-box bg-primary">
                <div class="inner">
                  <div class="d-flex justify-content-between align-items-end">
                    <span style="font-size: 2rem;">Grade 11</span>
                    <h3><?php echo $total_grade11; ?></h3>
                  </div>
                  <p>Total number of Grade 11 students</p>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-3 mt-0">
              <div class="small-box bg-success">
                <div class="inner">
                  <div class="d-flex justify-content-between align-items-end">
                    <span style="font-size: 2rem;">Grade 12</span>
                    <h3><?php echo $total_grade12; ?></h3>
                  </div>
                  <p>Total number of Grade 12 students</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('../../includes/scripts.php'); ?>
  <?php include('../../includes/footer.php'); ?>