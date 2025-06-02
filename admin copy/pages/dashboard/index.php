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
            if (isset($_SESSION['auth'])) {
              $user_id = $_SESSION['auth_user']['user_id'];
              $sql_user_count = "SELECT grade, strand, section FROM tbluser WHERE id = '$user_id'";
              $query_run_user_count = mysqli_query($conn, $sql_user_count);
              $row_user_count = mysqli_fetch_assoc($query_run_user_count);
              $grade = $row_user_count['grade'];
              $strand = $row_user_count['strand'];
              $section = $row_user_count['section'];

              $sql_user_count = "SELECT COUNT(*) AS total_users FROM tbluser WHERE role = 'student' AND grade = '$grade' AND strand = '$strand' AND section = '$section'";
              $query_run_user_count = mysqli_query($conn, $sql_user_count);
              $row_user_count = mysqli_fetch_assoc($query_run_user_count);
              $total_users = $row_user_count['total_users'];
            }
            ?>

            <div class="col-lg-12 mb-3 mt-0 mt-lg-3">
              <div class="small-box bg-info px-5">
                <div class="inner">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold" style="font-size: 2rem;">Students <br /> <small
                        style="font-size: 1rem;">Total Students</small></span>
                    <h1 class="font-weight-bold" style="font-size: 5rem;"><?php echo $total_users; ?></h1>
                  </div>

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