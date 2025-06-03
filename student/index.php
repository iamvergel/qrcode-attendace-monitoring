<?php
include('../admin/config/dbconn.php');
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <div class="modal fade" id="CancelModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Cancel Appointment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <form action="request_action.php" method="POST">
                  <div class="modal-body">
                     <input type="hidden" name="app_id" id="app_id">
                     <p> Do you want to cancel Appointment?</p>
                  </div>

                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     <button type="submit" name="cancel-appointment" class="btn btn-primary ">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="content-wrapper">
         <div class="content-header">

         </div>
         <section class="content">
            <div class="container-fluid">
               <?php
               if (isset($_SESSION['message'])) {
                  if (strpos($_SESSION['message'], 'success') !== false) {
                     $alert_class = 'alert-success';
                  } else {
                     $alert_class = 'alert-danger';
                  }
                  ?>
                  <div class="alert <?php echo $alert_class; ?> alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h5><i class="icon fas fa-ban"></i> <?php echo $_SESSION['message']; ?></h5>
                  </div>
                  <?php
                  unset($_SESSION['message']);
               }
               ?>
               <div class="row">
                  <div class="col-md-12">
                     <?php
                     include('../admin/message.php');
                     ?>
                  </div>
                  <div class="col-md-4">
                     <div class="card card-primary card-outline">
                        <div class="card-header">
                           <h5 class="card-title m-0">Student Info</h5>
                        </div>
                        <div class="card-body box-profile">
                           <div class="text-center">
                              <?php
                              if (isset($_SESSION['auth'])) {
                                 $sql = "SELECT * FROM tbluser WHERE id = '" . $_SESSION['auth_user']['user_id'] . "'";
                                 $query_run = mysqli_query($conn, $sql);
                                 while ($row = mysqli_fetch_array($query_run)) {
                                    ?>
                                 </div>
                                 <h3 class="profile-username text-center"><?= $row['fname'] . ' ' . $row['lname'] ?></h3>
                                 <p class="text-muted text-center"><?= $row['email'] ?></p>
                                 <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                       <b>LRN</b>
                                       <p class="float-right text-muted m-0"><?= $row['lrn'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Grade</b>
                                       <p class="float-right text-muted m-0"><?= $row['grade'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Strand</b>
                                       <p class="float-right text-muted m-0"><?= $row['strand'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Section</b>
                                       <p class="float-right text-muted m-0"><?= $row['section'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Gender</b>
                                       <p class="float-right text-muted m-0"><?= $row['gender'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Birthdate</b>
                                       <p class="float-right text-muted m-0"><?= $row['dob'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Phone</b>
                                       <p class="float-right text-muted m-0"><?= $row['phone'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                       <b>Address</b>
                                       <p class="float-right text-muted m-0"><?= $row['address'] ?></p>
                                    </li>
                                 </ul>
                                 <?php
                                 }
                              } else {
                                 echo "Not Logged in";
                              }

                              ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="card">
                        <div class="card-header p-2">
                           <ul class="nav nav-pills" id="custom-tabs-three-tab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" href="attendance-tab" data-toggle="tab"
                                    data-target="#attendance" role="tab" aria-controls="attendance"
                                    aria-selected="true">Attendance</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="myattendance-tab" data-toggle="tab"
                                    data-target="#myattendance" role="tab" aria-controls="myattendance"
                                    aria-selected="false">Attendance History</a>
                              </li>
                           </ul>
                        </div>
                        <div class="card-body">
                           <div class="tab-content" id="custom-tabs-three-tabContent">
                              <div class="tab-pane fade show active" id="attendance" role="tabpanel"
                                 aria-labelledby="attendance-tab">
                                 <div class="row">
                                    <?php
                                    date_default_timezone_set("Asia/Manila");

                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $today = date('Y-m-d');

                                    $time_in_check = "SELECT * FROM attendance WHERE user_id='$user_id' AND DATE(timestamp) = '$today' AND status='Time In'";
                                    $time_in_result = mysqli_query($conn, $time_in_check);

                                    $time_out_check = "SELECT * FROM attendance WHERE user_id='$user_id' AND DATE(timestamp) = '$today' AND status='Time Out'";
                                    $time_out_result = mysqli_query($conn, $time_out_check);

                                    $time_in_disabled = mysqli_num_rows($time_in_result) > 0 ? "disabled" : "";
                                    $time_out_disabled = mysqli_num_rows($time_out_result) > 0 || mysqli_num_rows($time_in_result) == 0 ? "disabled" : "";

                                    if ($time_out_disabled == "disabled" && $time_in_disabled == "disabled") {
                                       echo "<div class='alert text-success border-success bg-transparent alert-dismissible' role='alert'>
                                       <i class='fas fa-check-circle me-1'></i> Daily Attendance Logged
                                    </div>";
                                    }
                                    ?>

                                    <div class="col-sm-12 mb-2">
                                       <button
                                          style="display: <?php echo $time_in_disabled == "disabled" ? "none" : "block"; ?>"
                                          class="btn btn-outline-success w-100 float-left" data-toggle="modal"
                                          data-target="#cameraModal" <?php echo $time_in_disabled; ?>>
                                          <i class="fa fa-camera"> </i> Attendance Time-in
                                       </button>
                                    </div>

                                    <div class="col-sm-12 mb-2">
                                       <button
                                          style="display: <?php echo $time_out_disabled == "disabled" ? "none" : "block"; ?>"
                                          class="btn btn-outline-danger w-100 float-left" data-toggle="modal"
                                          data-target="#cameraoutModal" <?php echo $time_out_disabled; ?>>
                                          <i class="fa fa-camera"> </i> Attendance Time-out
                                       </button>
                                    </div>

                                    <!-- camera modal -->
                                    <div class="modal fade" id="cameraoutModal" tabindex="-1"
                                       aria-labelledby="cameraoutModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="cameraoutModalLabel">Scan QR Code</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p class="text-center">Please scan the QR code to mark your attendance
                                                </p>
                                                <div id="readerout" width="100%" class="mx-auto"></div>
                                                <div id="scan-resultout"
                                                   class="mt-2 text-center text-success font-weight-bold"></div>
                                             </div>

                                             <form id="attendance-form-out" class="d-none"
                                                action="attendance_action.php" method="POST">
                                                <input type="hidden" name="user_id" id="user_idout">
                                                <div class="form-group">
                                                   <label>Full Name</label>
                                                   <input type="text" id="full_nameout" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Grade & Section</label>
                                                   <input type="text" id="grade_sectionout" class="form-control"
                                                      readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Personal Email</label>
                                                   <input type="email" id="personal_emailout" class="form-control"
                                                      readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Guardian Email</label>
                                                   <input type="email" id="guardian_emailout" class="form-control"
                                                      readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Status</label>
                                                   <select name="status" class="form-control" required>
                                                      <option value="Time Out">Time Out</option>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label>Time</label>
                                                   <input type="text" name="time" id="current_timeout"
                                                      class="form-control" readonly>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Submit
                                                   Attendance</button>
                                             </form>


                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <!-- camera modal -->
                                    <div class="modal fade" id="cameraModal" tabindex="-1"
                                       aria-labelledby="cameraModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="cameraModalLabel">Scan QR Code</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p class="text-center">Please scan the QR code to mark your attendance
                                                </p>
                                                <div id="reader" width="100%" class="mx-auto"></div>
                                                <div id="scan-result"
                                                   class="mt-2 text-center text-success font-weight-bold"></div>
                                             </div>

                                             <form id="attendance-form" class="d-none" action="attendance_action.php"
                                                method="POST">
                                                <input type="hidden" name="user_id" id="user_id">
                                                <div class="form-group">
                                                   <label>Full Name</label>
                                                   <input type="text" id="full_name" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Grade & Section</label>
                                                   <input type="text" id="grade_section" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Personal Email</label>
                                                   <input type="email" id="personal_email" class="form-control"
                                                      readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Guardian Email</label>
                                                   <input type="email" id="guardian_email" class="form-control"
                                                      readonly>
                                                </div>
                                                <div class="form-group">
                                                   <label>Status</label>
                                                   <select name="status" class="form-control" required>
                                                      <option value="Time In">Time In</option>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label>Time</label>
                                                   <input type="text" name="time" id="current_time" class="form-control"
                                                      readonly>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Submit
                                                   Attendance</button>
                                             </form>


                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 mb-2">

                                 </div>
                              </div>
                              <div class="tab-pane fade" id="myattendance" role="tabpanel"
                                 aria-labelledby="myattendance-tab">
                                 <?php
                                 $id = $_SESSION['auth_user']['user_id'];

                                 $sql = "
                                    SELECT 
                                       DATE(timestamp) AS date,
                                       (
                                             SELECT timestamp 
                                             FROM attendance 
                                             WHERE user_id = '$id' 
                                             AND DATE(timestamp) = DATE(a.timestamp) 
                                             AND status = 'Time In'
                                             ORDER BY timestamp ASC LIMIT 1
                                       ) AS time_in,
                                       (
                                             SELECT timestamp 
                                             FROM attendance 
                                             WHERE user_id = '$id' 
                                             AND DATE(timestamp) = DATE(a.timestamp) 
                                             AND status = 'Time Out'
                                             ORDER BY timestamp DESC LIMIT 1
                                       ) AS time_out,
                                       a.grade,
                                       a.section,
                                       a.fname,
                                       a.lname,
                                       MAX(a.attendance_status) AS attendance_status
                                    FROM attendance a
                                    WHERE a.user_id = '$id'
                                    GROUP BY DATE(timestamp), a.grade, a.section, a.fname, a.lname
                                    ORDER BY date DESC
                                 ";

                                 $query_run = mysqli_query($conn, $sql);
                                 ?>

                                 <table id="myattendance-table" class="table table-hover" style="width:100%;">
                                    <thead>
                                       <tr>
                                          <th class="bg-light">Date</th>
                                          <th class="bg-light">Time In</th>
                                          <th class="bg-light">Time Out</th>
                                          <th class="bg-light">Grade</th>
                                          <th class="bg-light">Section</th>
                                          <!-- <th class="bg-light">Full Name</th> -->
                                          <th class="bg-light">Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php while ($row = mysqli_fetch_array($query_run)) { ?>
                                          <tr>
                                             <td><?= $row['date']; ?></td>
                                             <td><?= date('h:i A', strtotime($row['time_in'])); ?></td>
                                             <td>
                                                <?= $row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : 'Not yet'; ?>
                                             </td>
                                             <td><?= $row['grade']; ?></td>
                                             <td><?= $row['section']; ?></td>
                                             <!-- <td><?= $row['fname'] . ' ' . $row['lname']; ?></td> -->
                                             <td><?= $row['attendance_status']; ?></td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <!-- /.card -->
                     </div>
                  </div>
                  <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <?php include('includes/footer.php'); ?>
      <?php include('includes/scripts.php'); ?>
      <script>
         let html5QrCode;
         let cameraId;

         $('#cameraModal').on('shown.bs.modal', function () {
            html5QrCode = new Html5Qrcode("reader");

            Html5Qrcode.getCameras().then(devices => {
               cameraId = devices.length > 1 ? devices[1].id : devices[0].id;

               html5QrCode.start(
                  cameraId,
                  { fps: 10, qrbox: 250 },
                  async (decodedText) => {
                     decodedText = decodedText.trim();

                     $('#scan-result').text("Scanned: " + decodedText);

                     try {
                        const response = await fetch(`get_user_by_id.php?id=${decodedText}`);
                        const data = await response.json();

                        if (data.success) {
                           const user = data.user;

                           document.getElementById("user_id").value = user.id;
                           document.getElementById("full_name").value = user.fname + ' ' + user.lname;
                           document.getElementById("grade_section").value = user.grade + ' - ' + user.strand + ' - ' + user.section;
                           document.getElementById("personal_email").value = user.email;
                           document.getElementById("guardian_email").value = user.gemail;

                           const now = new Date();
                           let hours = now.getHours();
                           const ampm = hours >= 12 ? 'PM' : 'AM';
                           hours = hours % 12 || 12;
                           const minutes = now.getMinutes().toString().padStart(2, '0');
                           document.getElementById("current_time").value = `${hours}:${minutes} ${ampm}`;
                        } else {
                           $('#scan-result').text("User not found.");
                        }
                     } catch (err) {
                        console.error("Fetch error:", err);
                        $('#scan-result').text("Error fetching data.");
                     }

                     // Stop scanner
                     html5QrCode.stop().then(() => console.log("Scanner stopped."));

                     // Auto submit the form
                     document.getElementById("attendance-form").submit();
                  },
                  errorMessage => {
                     console.warn(errorMessage);
                  }
               ).catch(err => {
                  console.error("QR scanner error:", err);
               });
            }).catch(err => {
               console.error("Camera error:", err);
            });
         });

         $('#cameraModal').on('hidden.bs.modal', function () {
            if (html5QrCode) {
               html5QrCode.stop().then(() => html5QrCode.clear());
            }
         });

         $('#cameraoutModal').on('shown.bs.modal', function () {
            html5QrCode = new Html5Qrcode("readerout");

            Html5Qrcode.getCameras().then(devices => {
               cameraId = devices.length > 1 ? devices[1].id : devices[0].id;

               html5QrCode.start(
                  cameraId,
                  { fps: 10, qrbox: 250 },
                  async (decodedText) => {
                     decodedText = decodedText.trim();

                     $('#scan-resultout').text("Scanned: " + decodedText);

                     try {
                        const response = await fetch(`get_user_by_id.php?id=${decodedText}`);
                        const data = await response.json();

                        if (data.success) {
                           const user = data.user;

                           document.getElementById("user_idout").value = user.id;
                           document.getElementById("full_nameout").value = user.fname + ' ' + user.lname;
                           document.getElementById("grade_sectionout").value = user.grade + ' - '  + user.strand + ' - ' + user.section;
                           document.getElementById("personal_emailout").value = user.email;
                           document.getElementById("guardian_emailout").value = user.gemail;

                           const now = new Date();
                           let hours = now.getHours();
                           const ampm = hours >= 12 ? 'PM' : 'AM';
                           hours = hours % 12 || 12;
                           const minutes = now.getMinutes().toString().padStart(2, '0');
                           document.getElementById("current_timeout").value = `${hours}:${minutes} ${ampm}`;
                        } else {
                           $('#scan-resultout').text("User not found.");
                        }
                     } catch (err) {
                        console.error("Fetch error:", err);
                        $('#scan-resultout').text("Error fetching data.");
                     }

                     // Stop scanner
                     html5QrCode.stop().then(() => console.log("Scanner stopped."));

                     // Auto submit the form
                     document.getElementById("attendance-form-out").submit();
                  },
                  errorMessage => {
                     console.warn(errorMessage);
                  }
               ).catch(err => {
                  console.error("QR scanner error:", err);
               });
            }).catch(err => {
               console.error("Camera error:", err);
            });
         });

         $('#cameraoutModal').on('hidden.bs.modal', function () {
            if (html5QrCode) {
               html5QrCode.stop().then(() => html5QrCode.clear());
            }
         });
      </script>

      <script>
         var table4 = $('#myattendance-table').DataTable({
            responsive: true,
            searching: false,
            paging: true,
            info: true,
         });

         $('.nav-pills a').on('shown.bs.tab', function (event) {
            var tabID = $(event.target).attr('data-target');
            if (tabID === '#attendance') {
               table1.columns.adjust().responsive.recalc();
            }
            if (tabID === '#myattendance') {
               table4.columns.adjust().responsive.recalc();
            }
         });

         $(document).on('click', '.cancelbtn', function () {
            var userid = $(this).data('id');
            console.log(userid);
            $('#app_id').val(userid);
            $('#CancelModal').modal('show');
         })
      </script>