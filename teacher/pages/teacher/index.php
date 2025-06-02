<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddAdminModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Teacher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="register_action.php" method="post" enctype="multipart/form-data">
            <h5 class="fs-3 text-start px-3">Personal Information :</h5>
            <div class="modal-body px-3">
              <div class="row">
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lrn" placeholder="Employee ID" pattern="[0-9]*"
                      inputmode="numeric" maxlength="12" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <script>
                    const inputElement = document.querySelector('input[name="lrn"]');
                    inputElement.addEventListener('input', (e) => {
                      const value = e.target.value;
                      if (value.length > 12) {
                        e.target.value = value.slice(0, 12);
                      }
                      e.target.value = value.replace(/\D/g, '');
                    });
                  </script>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fname" placeholder="First name"
                      pattern="[a-zA-Z'-'\s]*" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lname" placeholder="Last name"
                      pattern="[a-zA-Z'-'\s]*" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <select class="custom-select mb-3" id="gradeDropdown" name="grade" required>
                    <option selected disabled value="">Select Grade</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <select class="custom-select mb-3" id="strandDropdown" name="strand" required>
                    <option selected disabled value="">Select Strand</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <select class="custom-select mb-3" id="sectionDropdown" name="section" required>
                    <option selected disabled value="">Select Section</option>
                  </select>
                </div>


                <div class="col-sm-3">
                  <div class="input-group mb-3">
                    <input type="text" autocomplete="off" name="birthday" class="form-control" id="datepicker"
                      placeholder="mm/dd/yyyy" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select mb-3" name="gender" required>
                    <option selected disabled value="">Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-6 mb-3">
                  <input type="text" class="form-control" name="address" placeholder="Address" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-marker-alt"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group col-sm-6 mb-3">
                  <input type="text" autocomplete="off" class="form-control js-phone" pattern="^(09|\+639)\d{9}$"
                    placeholder="Personal Phone" name="phone" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group col-sm-6 mb-3">
                  <input type="email" class="form-control" name="email" placeholder="Personal Email"
                    pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
              </div>

              <h5 class="fs-3 text-start pt-3 d-none">Guardian Information :</h5>

              <div class="row d-none">
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="gfname" placeholder="Guardian First name" value="n/a">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="glname" placeholder="Guardian Last name" value="n/a">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row d-none">
                <div class="input-group col-sm-6 mb-3">
                  <input type="email" class="form-control" name="gemail" placeholder="Guardian Email"
                    value="sample@gmail.com">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group col-sm-6 mb-3">
                  <input type="text" autocomplete="off" class="form-control js-phone" pattern="^(09|\+639)\d{9}$"
                    placeholder="Guardian Phone Number" name="gphone" value="9999999999">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group col-sm-6">
                  <input type="password" class="form-control" id="password" name="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter,atleast one special character, and at least 8 or more characters"
                    placeholder="Password" required>
                  <div class="input-group-append" onclick="togglePassword()">
                    <div class="input-group-text">
                      <i class="fas fa-eye" id="eye"></i>
                    </div>
                  </div>
                </div>
                <script>
                  function togglePassword() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                      x.type = "text";
                      document.getElementById("eye").className = "fas fa-eye-slash";
                    } else {
                      x.type = "password";
                      document.getElementById("eye").className = "fas fa-eye";
                    }
                  }
                </script>

                <div class="input-group col-sm-6">
                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                    placeholder="Confirm Password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <p>Password Strength: <span id="result"> </span></p>
                  <div class="progress">
                    <div id="password-strength" class="progress-bar bg-success progress-bar-striped" role="progressbar"
                      aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                  </div>
                  <ul class="list-unstyled">
                    <li class=""><span class="low-upper-case"><i class="fal fa-exclamation-triangle"
                          aria-hidden="true"></i></span>&nbsp; Contain lowercase &amp; uppercase</li>
                    <li class=""><span class="one-number"><i class="fal fa-exclamation-triangle"
                          aria-hidden="true"></i></span> &nbsp;Contain number (0-9)</li>
                    <li class=""><span class="one-special-char"><i class="fal fa-exclamation-triangle"
                          aria-hidden="true"></i></span> &nbsp;Contain Special Character (!@#$%^&*).</li>
                    <li class=""><span class="eight-character"><i class="fal fa-exclamation-triangle"
                          aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
                  </ul>
                </div>
              </div>

              <div class="row">
                <!-- <div class="form-group col-sm-6">
                  <button type="button" onclick="window.location.href='index.php'" class="btn btn-block btn-secondary">I
                    already have an account</button>
                </div> -->
                <div class="form-group col-sm-6">
                  <button type="submit" name="register_btn" id="register"
                    class="btn btn-block btn-primary">Register</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ViewAdminModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Teacher Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="admin_viewing_data row px-2">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditAdminModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Teacher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="teacher_action.php" method="post" enctype="multipart/form-data">
            <h5 class="fs-3 text-start px-3">Personal Information :</h5>
            <div class="modal-body px-3">
              <div class="row">
                <div class="col-sm-6">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lrn" id="edit_lrn" placeholder="Employee ID" pattern="[0-9]*"
                      inputmode="numeric" maxlength="12" required readonly>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <script>
                    const inputElement = document.querySelector('input[name="lrn"]');
                    inputElement.addEventListener('input', (e) => {
                      const value = e.target.value;
                      if (value.length > 12) {
                        e.target.value = value.slice(0, 12);
                      }
                      e.target.value = value.replace(/\D/g, '');
                    });
                  </script>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fname" id="edit_fname" placeholder="First name"
                      pattern="[a-zA-Z'-'\s]*" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lname" id="edit_lname" placeholder="Last name"
                      pattern="[a-zA-Z'-'\s]*" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="current_grade"
                      pattern="[a-zA-Z'-'\s]*" required readonly>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="current_strand"
                      pattern="[a-zA-Z'-'\s]*" readonly>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="current_section"
                      pattern="[a-zA-Z'-'\s]*" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <select class="custom-select mb-3" id="edit_gradeDropdown" name="grade" required>
                    <option selected disabled value="">Select Grade</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                  </select>
                </div>

                <div class="col-sm-4">
                  <select class="custom-select mb-3" id="edit_strandDropdown" name="strand" required>
                    <option selected disabled value="">Select Strand</option>
                  </select>
                </div>

                <div class="col-sm-4">
                  <select class="custom-select mb-3" id="edit_sectionDropdown" name="section" required>
                    <option selected disabled value="">Select Section</option>
                  </select>
                </div>


                <div class="col-sm-3">
                  <div class="input-group mb-3">
                    <input type="text" autocomplete="off" name="birthday" class="form-control" id="edit_datepicker"
                      placeholder="mm/dd/yyyy" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select mb-3" name="gender" id="edit_gender" required>
                    <option selected disabled value="">Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group col-sm-6 mb-3">
                  <input type="text" class="form-control" name="address" id="edit_address" placeholder="Address" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-marker-alt"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group col-sm-6 mb-3">
                  <input type="text" autocomplete="off" class="form-control js-phone" id="edit_phone" pattern="^(09|\+639)\d{9}$"
                    placeholder="Personal Phone" name="phone" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="input-group col-sm-6 mb-3">
                  <input type="email" class="form-control" name="email" id="edit_email" placeholder="Personal Email"
                    pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" required readonly>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- <div class="form-group col-sm-6">
                  <button type="button" onclick="window.location.href='index.php'" class="btn btn-block btn-secondary">I
                    already have an account</button>
                </div> -->
                <div class="form-group col-sm-12 ">
                  <button type="submit" name="updateadmin" 
                    class="btn btn-block btn-primary w-25 float-right">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="DeleteAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="admin_action.php" method="POST">
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
              <h1>Teacher</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Teacher</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include('../../message.php'); ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Teachers List</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                    data-target="#AddAdminModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Teacher</button>
                </div>
                <div class="card-body">
                  <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="export">Name</th>
                        <th class="export">Employee ID</th>
                        <th class="export">Grade</th>
                        <th class="export">Strand</th>
                        <th class="export">Section</th>
                        <th class="export">Gender</th>
                        <th class="export">Email</th>
                        <th class="export">Status</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody><?php
                    $i = 1;
                    $user = $_SESSION['auth_user']['user_id'];
                    $sql = "SELECT * FROM tbluser WHERE role='teacher' ORDER BY id DESC";
                    $query_run = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($query_run)) { ?>
                        <tr>
                          <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                          <td><?php echo $row['lrn']; ?></td>
                          <td><?php echo $row['grade'] ?></td>
                          <td><?php echo $row['strand']; ?></td>
                          <td><?php echo $row['section']; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php
                          if ($row['id'] == $user) {
                          } else {
                            if ($row['verify_status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['verify_status'] . '" class="btn btn-sm btn-primary activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['verify_status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                          }
                          ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editAdminbtn"><i
                                class="fas fa-edit"></i></button>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm viewAdminbtn"><i
                                class="far fa-eye"></i></button>
                          </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="search">Name</th>
                        <th class="search">Employee ID</th>
                        <th class="search">Grade</th>
                        <th class="search">Strand</th>
                        <th class="search">Section</th>
                        <th class="search">Gender</th>
                        <th class="search">Email</th>
                        <th class="search">Status</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('../../includes/scripts.php'); ?>
  <script>
    $(document).ready(function () {
      $('#gradeDropdown').on('change', function () {
        let grade = $(this).val();
        if (grade) {
          $.ajax({
            url: 'get_strands.php',
            method: 'POST',
            data: { grade: grade },
            dataType: 'json',
            success: function (response) {
              console.log(response);
              $('#strandDropdown').empty().append('<option selected disabled value="">Select Strand</option>');
              $('#sectionDropdown').empty().append('<option selected disabled value="">Select Section</option>');
              $.each(response, function (index, value) {
                $('#strandDropdown').append('<option value="' + value + '">' + value + '</option>');
              });
            }
          });
        }
      });

      // When Strand changes, load sections
      $('#strandDropdown').on('change', function () {
        let grade = $('#gradeDropdown').val();
        let strand = $(this).val();
        if (grade && strand) {
          $.ajax({
            url: 'get_sections.php',
            method: 'POST',
            data: { grade: grade, strand: strand },
            dataType: 'json',
            success: function (response) {
              $('#sectionDropdown').empty().append('<option selected disabled value="">Select Section</option>');
              $.each(response, function (index, value) {
                $('#sectionDropdown').append('<option value="' + value + '">' + value + '</option>');
              });
            }
          });
        }
      });

      $('#edit_gradeDropdown').on('change', function () {
        let grade = $(this).val();
        if (grade) {
          $.ajax({
            url: 'get_strands.php',
            method: 'POST',
            data: { grade: grade },
            dataType: 'json',
            success: function (response) {
              console.log(response);
              $('#edit_strandDropdown').empty().append('<option selected disabled value="">Select Strand</option>');
              $('#edit_sectionDropdown').empty().append('<option selected disabled value="">Select Section</option>');
              $.each(response, function (index, value) {
                $('#edit_strandDropdown').append('<option value="' + value + '">' + value + '</option>');
              });
            }
          });
        }
      });

      // When Strand changes, load sections
      $('#edit_strandDropdown').on('change', function () {
        let grade = $('#edit_gradeDropdown').val();
        let strand = $(this).val();
        if (grade && strand) {
          $.ajax({
            url: 'get_sections.php',
            method: 'POST',
            data: { grade: grade, strand: strand },
            dataType: 'json',
            success: function (response) {
              $('#edit_sectionDropdown').empty().append('<option selected disabled value="">Select Section</option>');
              $.each(response, function (index, value) {
                $('#edit_sectionDropdown').append('<option value="' + value + '">' + value + '</option>');
              });
            }
          });
        }
      });
    });
  </script>
  <script>
    $('#password').keyup(function () {
      var password = $('#password').val();
      if (checkStrength(password) == false) {
        password.setCustomValidity('');

      }
    });

    function checkStrength(password) {
      var strength = 0;

      //If password contains both lower and uppercase characters, increase strength value.
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        strength += 1;
        $('.low-upper-case').addClass('text-success');
        $('.low-upper-case i').removeClass('fa-exclamation-triangle').addClass('fa-check');
        $('#popover-password-top').addClass('hide');

      } else {
        $('.low-upper-case').removeClass('text-success');
        $('.low-upper-case i').addClass('fa-exclamation-triangle').removeClass('fa-check');
        $('#popover-password-top').removeClass('hide');
      }

      //If it has numbers and characters, increase strength value.
      if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
        strength += 1;
        $('.one-number').addClass('text-success');
        $('.one-number i').removeClass('fa-exclamation-triangle').addClass('fa-check');
        $('#popover-password-top').addClass('hide');

      } else {
        $('.one-number').removeClass('text-success');
        $('.one-number i').addClass('fa-exclamation-triangle').removeClass('fa-check');
        $('#popover-password-top').removeClass('hide');
      }

      //If it has one special character, increase strength value.
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
        $('.one-special-char').addClass('text-success');
        $('.one-special-char i').removeClass('fa-exclamation-triangle').addClass('fa-check');
        $('#popover-password-top').addClass('hide');

      } else {
        $('.one-special-char').removeClass('text-success');
        $('.one-special-char i').addClass('fa-exclamation-triangle').removeClass('fa-check');
        $('#popover-password-top').removeClass('hide');
      }

      if (password.length > 7) {
        strength += 1;
        $('.eight-character').addClass('text-success');
        $('.eight-character i').removeClass('fa-exclamation-triangle').addClass('fa-check');
        $('#popover-password-top').addClass('hide');

      } else {
        $('.eight-character').removeClass('text-success');
        $('.eight-character i').addClass('fa-exclamation-triangle').removeClass('fa-check');
        $('#popover-password-top').removeClass('hide');
      }

      // If value is less than 2

      if (strength < 2) {
        $('#result').removeClass()
        $('#password-strength').addClass('bg-danger');

        $('#result').addClass('text-danger').text('Very Weak');
        $('#password-strength').css('width', '10%');
      } else if (strength == 2) {
        $('#result').addClass('good');
        $('#password-strength').removeClass('bg-danger');
        $('#password-strength').addClass('bg-warning');
        $('#result').addClass('text-warning').text('Weak')
        $('#password-strength').css('width', '60%');
        return 'Weak'
      } else if (strength == 4) {
        $('#result').removeClass()
        $('#result').addClass('strong');
        $('#password-strength').removeClass('bg-warning');
        $('#password-strength').addClass('bg-success');
        $('#result').addClass('text-success').text('Very Strong');
        $('#password-strength').css('width', '100%');

        return 'Strong'
      }
    }
  </script>
  <script>
    $(document).ready(function () {
      $('#admin_table tfoot th.search').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" class="search-input form-control form-control-sm"/>');
      });
      var table = $('#admin_table').DataTable({
        "dom": "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "responsive": true,
        "searching": true,
        "paging": true,
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
        initComplete: function () {
          // Apply the search
          this.api().columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
              if (that.search() !== this.value) {
                that
                  .search(this.value)
                  .draw();
              }
            });
          });
        }
      });

      $(document).on('click', '.viewAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'teacher_action.php',
          type: 'post',
          data: {
            'checking_viewAdmintbtn': true,
            'user_id': userid,
          },
          success: function (response) {

            $('.admin_viewing_data').html(response);
            $('#ViewAdminModal').modal('show');
          }
        });
      });

      //Admin Edit Modal
      $(document).on('click', '.editAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "teacher_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_lrn').val(value['lrn']);
              $('#edit_fname').val(value['fname']);
              $('#edit_lname').val(value['lname']);
              $('#current_grade').val(value['grade']);
              $('#current_strand').val(value['strand']);
              $('#current_section').val(value['section']);
              $('#edit_datepicker').val(moment(value['dob']).format('MM/DD/YYYY'));
              $('#edit_gender').val(value['gender']);
              $('#edit_address').val(value['address']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
            });

            $('#EditAdminModal').modal('show');
          }
        });
      });
      //Admin Delete Modal
      $(document).on('click', '.deleteAdminbtn', function () {

        var user_id = $(this).data('id');
        $('#delete_id').val(user_id);
        $('#DeleteAdminModal').modal('show');
      });

      $(document).on('click', '.activatebtn', function () {
        var userid = $(this).data('id');
        var status = $(this).data('status');
        var next_status = 'Active';
        if (status == 1) {
          next_status = 'Inactive';
        }

        if (confirm("Are you sure you want to " + next_status + " it?")) {
          $.ajax({
            type: "post",
            url: "teacher_action.php",
            data: {
              'change_status': true,
              'user_id': userid,
              'status': status,
              'next_status': next_status
            },
            success: function (response) {
              location.reload();
            }
          });
        }
      });


    });
  </script>


  <?php include('../../includes/footer.php'); ?>