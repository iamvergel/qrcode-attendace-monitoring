<?php
session_start();
include('includes/header.php');
include('admin/config/dbconn.php');
if (isset($_SESSION['auth'])) {
  if ($_SESSION['auth_role'] == "admin") {
    $_SESSION['status'] = "You are already logged in";
    header('Location: admin/index.php');
    exit(0);
  } else if ($_SESSION['auth_role'] == "student") {
    $_SESSION['status'] = "You are already logged in";
    header('Location: patient/index.php');
    exit(0);
  }
}
?>


<body>
  <div class="py-3">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12 col-md-offset-3 col-sm-6 col-sm-offset-3">
          <div class="card card-outline card-primary">
            <?php
            if (isset($_SESSION['auth_status'])) {
              ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['auth_status']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"></span>
                </button>
              </div>
              <?php
              unset($_SESSION['auth_status']);
            }
            ?>
            <div class="card-body register-card-body">
              <a href="index.php">
                <h3 class="login-box-msg text-primary font-weight-bold"><?= $system_name ?></h3>
              </a>
              <p class="login-box-msg">Please register an account to access the attendance system.</p>
              <?php include('admin/message.php'); ?>
              <form action="register_action.php" method="post" enctype="multipart/form-data">
                <h5 class="fs-3 text-start">Personal Information :</h5>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="lrn" placeholder="Student LRN" pattern="[0-9]*"
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

                <h5 class="fs-3 text-start pt-3">Guardian Information :</h5>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="gfname" placeholder="Guardian First name"
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
                      <input type="text" class="form-control" name="glname" placeholder="Guardian Last name"
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
                  <div class="input-group col-sm-6 mb-3">
                    <input type="email" class="form-control" name="gemail" placeholder="Guardian Email"
                      pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group col-sm-6 mb-3">
                    <input type="text" autocomplete="off" class="form-control js-phone" pattern="^(09|\+639)\d{9}$"
                      placeholder="Guardian Phone Number" name="gphone" required>
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
                      title="Must contain at least one number and one uppercase and lowercase letter,at least one special character, and at least 8 or more characters"
                      placeholder="Password" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="fas fa-eye" id="eye"></i>
                      </div>
                    </div>
                  </div>

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
                      <div id="password-strength" class="progress-bar bg-success progress-bar-striped"
                        role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
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
                  <div class="form-group col-sm-6">
                    <button type="button" onclick="window.location.href='index.php'"
                      class="btn btn-block btn-secondary">I
                      already have an account</button>
                  </div>
                  <div class="form-group col-sm-6">
                    <button type="submit" name="register_btn" id="register"
                      class="btn btn-block btn-primary">Register</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('includes/scripts.php'); ?>

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
</body>

</html>