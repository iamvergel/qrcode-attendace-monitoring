<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Add Modal -->
    <!-- <div class="modal fade" id="AddstudentModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add student</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="student_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" class="form-control" pattern="[a-zA-Z'-'\s]*" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="lname" class="form-control" pattern="[a-zA-Z'-'\s]*" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Gender</label>
                    <span class="text-danger">*</span>
                    <select class="form-control custom-select" name="gender" required>
                      <option selected disabled value="">Choose</option>
                      <option>Female</option>
                      <option>Male</option>
                      <option>Others</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 mb-2">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control js-phone" name="phone" pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6 mb-2 auto">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" name="email" class="form-control" pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="insertstudent" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div> -->

    <!--View Modal-->
    <!-- <div class="modal fade" id="ViewstudentModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">student Info</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="student_viewing_data">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> -->

    <!--Edit Modal-->
    <div class="modal fade" id="EditstudentModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit student</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="student_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6 mb-2">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Grade</label>
                    <select class="custom-select mb-3" name="grade" id="edit_grade" required>
                      <option selected disabled value="">Grade</option>
                      <option>Grade 11</option>
                      <option>Grade 12</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 mb-2">
                  <div class="form-group">
                    <label>Section</label>
                    <input type="text" class="form-control" name="section" placeholder="Section" id="edit_section"
                      pattern="[a-zA-Z'-'\s]*" required>
                  </div>
                </div>
              </div>
              <div class="row d-none">
                <div class="col-sm-6 mb-2">
                  <div class="form-group">
                    <label>First Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" id="edit_fname" class="form-control" pattern="[a-zA-Z'-'\s]*"
                      required>
                  </div>
                </div>
                <div class="col-sm-6 mb-2">
                  <div class="form-group">
                    <label>Last Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="lname" id="edit_lname" class="form-control" pattern="[a-zA-Z'-'\s]*"
                      required>
                  </div>
                </div>
              </div>
              <div class="row d-none">
                <div class="col-sm-6 mb-2 auto">
                  <div class="form-group">
                    <label>Birthdate</label>
                    <span class="text-danger">*</span>
                    <input type="text" autocomplete="off" id="edit_dob" name="birthday" class="form-control"
                      id="datepicker" required>
                  </div>
                </div>
                <div class="col-sm-6 mb-2 d-none">
                  <div class="form-group">
                    <label>Gender</label>
                    <span class="text-danger">*</span>
                    <select class="form-control custom-select" name="gender" id="edit_gender" required>
                      <option selected disabled value="">Choose</option>
                      <option>Female</option>
                      <option>Male</option>
                      <option>Others</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row d-none">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" id="edit_address" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row d-none">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_phone" class="form-control js-phone" name="phone"
                      pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6 mb-2 d-none">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" name="email" id="edit_email" class="form-control"
                      pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="edit_password" name="password" class="form-control" required>
                <input type="hidden" id="edit_cpassword" name="confirmPassword" class="form-control" required>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="updatedata" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/edit modal -->

    <!-- delete modal pop up modal -->
    <div class="modal fade" id="deletemodal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete student</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="student_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <p> Do you want to delete this data?</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="deletedata" class="btn btn-primary ">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Attendance Record</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Attendance Record</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php
              include('../../message.php');
              ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Attendance Record</h3>
                  <!-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddstudentModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add student</button> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                    if (isset($_SESSION['auth'])) {
                      $user_id = $_SESSION['auth_user']['user_id'];
                      $sql_user_count = "SELECT grade, strand, section FROM tbluser WHERE id = '$user_id'";
                      $query_run_user_count = mysqli_query($conn, $sql_user_count);
                      $row_user_count = mysqli_fetch_assoc($query_run_user_count);
                      $grade = $row_user_count['grade'];
                      $strand = $row_user_count['strand'];
                      $section = $row_user_count['section'];

                      $today = date('Y-m-d');
                      $sql = "
                        SELECT 
                            DATE(timestamp) AS date,
                            lrn,
                            fname,
                            lname,
                            grade,
                            section,
                            personal_email,
                            (
                                SELECT timestamp 
                                FROM attendance 
                                WHERE lrn = a.lrn AND DATE(timestamp) = DATE(a.timestamp) AND status = 'Time In'
                                ORDER BY timestamp ASC LIMIT 1
                            ) AS time_in,
                            (
                                SELECT timestamp 
                                FROM attendance 
                                WHERE lrn = a.lrn AND DATE(timestamp) = DATE(a.timestamp) AND status = 'Time Out'
                                ORDER BY timestamp DESC LIMIT 1
                            ) AS time_out,
                            MAX(status) AS latest_status,
                            MAX(attendance_status) AS attendance_status
                        FROM attendance a
                        WHERE a.grade = '$grade' AND a.strand = '$strand' AND a.section = '$section' AND DATE(a.timestamp) = '$today'
                        GROUP BY DATE(timestamp), lrn, fname, lname, grade, section, personal_email
                        ORDER BY date DESC
                    ";
                    } else {
                      $sql = "
                        SELECT 
                            DATE(timestamp) AS date,
                            lrn,
                            fname,
                            lname,
                            grade,
                            section,
                            personal_email,
                            attendance_status,
                            (
                                SELECT timestamp 
                                FROM attendance 
                                WHERE lrn = a.lrn AND DATE(timestamp) = DATE(a.timestamp) AND status = 'Time In'
                                ORDER BY timestamp ASC LIMIT 1
                            ) AS time_in,
                            (
                                SELECT timestamp 
                                FROM attendance 
                                WHERE lrn = a.lrn AND DATE(timestamp) = DATE(a.timestamp) AND status = 'Time Out'
                                ORDER BY timestamp DESC LIMIT 1
                            ) AS time_out,
                            MAX(status) AS latest_status
                        FROM attendance a
                        WHERE DATE(a.timestamp) = '$today'
                        GROUP BY DATE(timestamp), lrn, fname, lname, grade, section, personal_email, attendance_status
                        ORDER BY date DESC
                    ";
                    }

                    $result = $conn->query($sql);
                  ?>

                  <table id="studenttbl" class="table table-borderless table-hover" style="width: 100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="export">Student Name</th>
                        <th class="export">LRN</th>
                        <th class="export">Grade</th>
                        <th class="export">Section</th>
                        <th class="export">Personal Email</th>
                        <th class="export">Date</th>
                        <th class="export">Time In</th>
                        <th class="export">Time Out</th>
                        <th class="export">Status</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $date = date('F j, Y', strtotime($row['date']));
                          $time_in = $row['time_in'] ? date('h:i A', strtotime($row['time_in'])) : '—';
                          $time_out = $row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '—';

                          echo "<tr>
                                    <td>{$row['fname']} {$row['lname']}</td>
                                    <td>{$row['lrn']}</td>
                                    <td>{$row['grade']}</td>
                                    <td>{$row['section']}</td>
                                    <td>{$row['personal_email']}</td>
                                    <td>{$date}</td>
                                    <td>{$time_in}</td>
                                    <td>{$time_out}</td>
                                    <td>{$row['attendance_status']}</td>
                                    <td>
                                      <div class='dropdown'>
                                        <button class='btn btn-sm btn-secondary dropdown-toggle w-100' type='button' id='actionDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                          Action
                                        </button>
                                        <form action='student_action.php' method='POST' class='dropdown-menu' aria-labelledby='actionDropdown'>
                                          <input type='hidden' name='id' value='{$row['lrn']}'>
                                          <button type='submit' name='action' value='present' class='dropdown-item'>Mark Present</button>
                                          <button type='submit' name='action' value='late' class='dropdown-item'>Mark Late</button>
                                          <button type='submit' name='action' value='absent' class='dropdown-item'>Mark Absent</button>
                                        </form>
                                      </div>
                                    </td>
                                </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='10' class='text-center'>No records found.</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div> <!-- /.container -->
    </div> <!-- /.content-wrapper -->

  </div>

  <?php include('../../includes/scripts.php'); ?>
  <script>
    var table = $('#studenttbl').DataTable({
      "dom": "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": true,
      "searching": true,
      "paging": true,
      "responsive": true,
      "pagingType": "simple",
      "buttons": [{
        extend: 'copyHtml5',
        className: 'btn btn-outline-secondary btn-sm',
        text: '<i class="fas fa-clipboard"></i>  Copy',
        exportOptions: {
          columns: '.export'
        }
      },
      {
        extend: 'csvHtml5',
        className: 'btn btn-outline-secondary btn-sm',
        text: '<i class="far fa-file-csv"></i>  CSV',
        exportOptions: {
          columns: '.export'
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-outline-secondary btn-sm',
        text: '<i class="far fa-file-excel"></i>  Excel',
        exportOptions: {
          columns: '.export'
        }
      },
      {
        extend: 'pdfHtml5',
        className: 'btn btn-outline-secondary btn-sm',
        text: '<i class="far fa-file-pdf"></i>  PDF',
        exportOptions: {
          columns: '.export'
        }
      },
      {
        extend: 'print',
        className: 'btn btn-outline-secondary btn-sm',
        text: '<i class="fas fa-print"></i>  Print',
        exportOptions: {
          columns: '.export'
        }
      }
      ],
    });
  </script>

  <?php include('../../includes/footer.php'); ?>