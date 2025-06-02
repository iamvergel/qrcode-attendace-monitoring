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
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Current Grade</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_grade" class="form-control" pattern="[a-zA-Z'-'\s]*"
                      readonly>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Current Strand</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_strand" class="form-control" pattern="[a-zA-Z'-'\s]*" readonly>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Current Section</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_section" class="form-control" pattern="[a-zA-Z'-'\s]*" readonly>
                  </div>
                </div>
                <div class="col-sm-6"></div>
                <h3>Edit Grade, Strand and Section</h3>
                <div class="col-sm-6 mb-2">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Grade</label>
                    <span class="text-danger">*</span>
                    <select class="custom-select mb-3" id="gradeDropdown" name="grade" required>
                      <option selected disabled value="">Select Grade</option>
                      <option value="Grade 11">Grade 11</option>
                      <option value="Grade 12">Grade 12</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Strand</label>
                  <span class="text-danger">*</span>
                  <select class="custom-select mb-3" id="strandDropdown" name="strand" required>
                    <option selected disabled value="">Select Strand</option>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label>Section</label>
                  <span class="text-danger">*</span>
                  <select class="custom-select mb-3" id="sectionDropdown" name="section" required>
                    <option selected disabled value="">Select Section</option>
                  </select>
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
              <h1 class="m-0">student</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">student</li>
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
                  <h3 class="card-title">student List</h3>
                  <!-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddstudentModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add student</button> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="studenttbl" class="table table-borderless table-hover" style="width: 100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="export">student</th>
                        <th class="export">LRN</th>
                        <th class="export">Grade</th>
                        <th class="export">Section</th>
                        <th class="export">Birthday</th>
                        <th class="export">Gender</th>
                        <th class="export">Contact</th>
                        <th class="export">Email</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="search">student</th>
                        <th class="search">LRN</th>
                        <th class="search">Grade</th>
                        <th class="search">Section</th>
                        <th class="search">Birthday</th>
                        <th class="search">Gender</th>
                        <th class="search">Contact</th>
                        <th class="search">Email</th>
                      </tr>
                    </tfoot>
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
      "order": [
        [1, "asc"]
      ],
      "language": {
        'search': '',
        'searchPlaceholder': "Search...",
        'emptyTable': "No results found",
      },
      "ajax": {
        "url": "student_table.php",
      },
      "columns": [
        {
          "data": 'fname',
          render: function (data, type, row) {
            return row.lname + ", " + row.fname;
          }
        },
        {
          "data": "lrn"
        },
        {
          "data": "grade"
        },
        {
          "data": "section"
        },
        {
          "data": "dob",
          render: function (data, type, row) {
            return moment(data).format("DD-MMM-YYYY")
          }
        },
        {
          "data": "gender"
        },
        {
          "data": "phone"
        },
        {
          "data": "email"
        },
        // {
        //   "data": 'id',
        //   render: function (data, type, row) {
        //     return '<div class="d-flex"> <button data-id="' + data + '" class="btn btn-sm btn-info editbtn mr-2"><i class="fas fa-edit"></i></button> <button data-id="' + data + '" class="btn btn-danger btn-sm deletebtn"><i class="far fa-trash-alt"></i></button> </div>';
        //   }
        // },//<a href="student_details.php?id=' + data + '" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
      ],
      "initComplete": function () {
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
      },
    });
    $('#studenttbl tfoot th.search').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" class="search-input form-control form-control-sm"/>');
    });

    $(document).ready(function () {

      $(document).on('click', '.viewbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'student_action.php',
          type: 'post',
          data: {
            userid: userid
          },
          success: function (response) {

            $('.student_viewing_data').html(response);
            $('#ViewstudentModal').modal('show');
          }
        });
      });

      $(document).on('click', '.editbtn', function () {
        var user_id = $(this).data('id');

        $.ajax({
          type: 'post',
          url: "student_action.php",
          data: {
            'checking_editbtn': true,
            'user_id': user_id,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['fname']);
              $('#edit_lname').val(value['lname']);
              $('#edit_grade').val(value['grade']);
              $('#edit_strand').val(value['strand']);
              $('#edit_section').val(value['section']);
              $('#edit_address').val(value['address']);
              $('#edit_dob').val(value['dob']);
              $('#edit_gender').val(value['gender']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#uploaded_image').html('<img src="../../../upload/students/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_cpassword').val(value['password']);
            });

            $('#EditstudentModal').modal('show');
          }
        });
      });

      $(document).on('click', '.deletebtn', function () {
        var user_id = $(this).data('id');
        $('#delete_id').val(user_id);
        $('#deletemodal').modal('show');

      });
    });
  </script>

  <?php include('../../includes/footer.php'); ?>