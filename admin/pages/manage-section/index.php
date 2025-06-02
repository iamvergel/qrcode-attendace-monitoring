<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddSectionModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Grade & Section</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="section_action.php" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="grade">Grade</label>
                <span class="text-danger">*</span>
                <select name="grade" class="form-control" required>
                  <option selected disabled value="">Select Grade</option>
                  <option value="Grade 11">Grade 11</option>
                  <option value="Grade 12">Grade 12</option>
                </select>
              </div>
              <div class="form-group">
                <label for="strand">Strand</label>
                <span class="text-danger">*</span>
                <input type="text" name="strand" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="section">Section</label>
                <span class="text-danger">*</span>
                <input type="text" name="section" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                  <option value="active" selected>Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="insert_grade_section" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditGradeSectionModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Grade & Section</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="section_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="edit_id" id="edit_id">
              <div class="form-group">
                <label for="edit_grade">Grade</label>
                <span class="text-danger">*</span>
                <select name="grade" id="edit_grade" class="form-control" required>
                  <option selected disabled value="">Select Grade</option>
                  <option value="Grade 11">Grade 11</option>
                  <option value="Grade 12">Grade 12</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit_strand">Strand</label>
                <span class="text-danger">*</span>
                <input type="text" name="strand" id="edit_strand" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="edit_section">Section</label>
                <span class="text-danger">*</span>
                <input type="text" name="section" id="edit_section" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="edit_status">Status</label>
                <select name="status" id="edit_status" class="form-control" required>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="update_grade_section" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" id="edit_fname" class="form-control" pattern="[a-zA-Z'-'\s]*"
                      required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" id="edit_address" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_phone" name="phone" class="form-control js-phone"
                      pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6 auto">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" name="email" id="edit_email" class="form-control email_id"
                      pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" class="form-control" required>
                    <span class="email_error text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
                <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control"
                  required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="doc_image">Upload Image</label>
                    <input type="file" id="edit_docimage" name="edit_docimage" />
                    <input type="hidden" name="old_image" id="old_image" />
                    <div id="uploaded_image"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="updateadmin" class="btn btn-primary">Submit</button>
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
              <h1>Manage Section</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Manage Section</li>
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
                  <h3 class="card-title">Section List</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                    data-target="#AddSectionModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Section</button>
                </div>
                <div class="card-body">
                  <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="export">Grade</th>
                        <th class="export">Strand</th>
                        <th class="export">Secrion</th>
                        <th class="export" width="10%">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody><?php
                    $i = 1;
                    $user = $_SESSION['auth_user']['user_id'];
                    $sql = "SELECT * FROM grade_section";
                    $query_run = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($query_run)) { ?>
                        <tr>
                          <td><?php echo $row['grade']; ?></td>
                          <td><?php echo $row['strand']; ?></td>
                          <td><?php echo $row['section']; ?></td>
                          <td><?php
                          if ($row['id'] == $user) {
                          } else {
                            if ($row['status'] == 'active') {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-primary activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                          }
                          ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editAdminbtn"><i
                                class="fas fa-edit"></i></button>
                            <!-- <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteAdminbtn"><i
                                class="far fa-trash-alt"></i></button> -->
                          </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="search">Grade</th>
                        <th class="search">Strand</th>
                        <th class="search">Secrion</th>
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
          url: 'admin_action.php',
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
          url: "section_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_grade').val(value['grade']);
              $('#edit_strand').val(value['strand']);
              $('#edit_section').val(value['section']);
              $('#edit_status').val(value['status']);
            });

            $('#EditGradeSectionModal').modal('show');
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
        var next_status = 'active';
        if (status == 1) {
          next_status = 'inactive';
        }

        if (confirm("Are you sure you want to " + next_status + " it?")) {
          $.ajax({
            type: "post",
            url: "section_action.php",
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