<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
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
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-primary card-outline">
                                                        <?php
                                                        if (isset($_GET['id'])) {
                                                            $user_id = $_GET['id'];
                                                            $user = "SELECT * FROM tbluser WHERE id='$user_id'";
                                                            $users_run = mysqli_query($conn, $user);

                                                            if (mysqli_num_rows($users_run) > 0) {
                                                                foreach ($users_run as $user) {
                                                        ?>
                                                                    <div class="card-body box-profile">
                                                                        <h4 class="profile-username text-center"><?= $user['fname'] . ' ' . $user['lname'] ?></h4>
                                                                        <p class="text-muted text-center"><?= $user['email'] ?></p>
                                                                        <ul class="list-group list-group-unbordered mb-3">
                                                                            <li class="list-group-item">
                                                                                <b>Gender</b>
                                                                                <p class="float-right text-muted m-0"><?= $user['gender'] ?></p>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Birthdate</b>
                                                                                <p class="float-right text-muted m-0"><?= $user['dob'] ?></p>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Phone</b>
                                                                                <p class="float-right text-muted m-0"><?= $user['phone'] ?></p>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>Address</b>
                                                                                <p class="float-right text-muted m-0"><?= $user['address'] ?></p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header p-2">
                                                            <ul class="nav nav-pills" id="custom-tabs-three-tab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" href="appointment-tab" data-toggle="tab" data-target="#appointment" role="tab" aria-controls="appointment" aria-selected="true">Attendace History</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                                                <div class="tab-pane fade show active" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                                                                    <!-- Appointment-->
                                                                    <table id="appointmenttable" class="table table-hover table-borderless" style="width:100%;">
                                                                        <thead class="bg-light">
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <th>Time</th>
                                                                                <th>Doctor</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            if (isset($_GET['id'])) {
                                                                                $user_id = $_GET['id'];
                                                                                $user = "SELECT a.schedule,a.id,a.starttime,a.status,a.endtime,d.name as dname FROM tbldoctor d INNER JOIN tblappointment a WHERE a.doc_id = d.id AND a.student_id ='$user_id' ORDER BY a.schedule";
                                                                                $users_run = mysqli_query($conn, $user);

                                                                                if (mysqli_num_rows($users_run) > 0) {
                                                                                    foreach ($users_run as $user) {
                                                                            ?>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <?= date('d-M-Y', strtotime($user['schedule'])) ?></td>
                                                                                            <td><?= $user['starttime'] . ' - ' . $user['endtime'] ?></td>
                                                                                            <td><?= $user['dname'] ?></td>
                                                                                            <td>
                                                                                                <?php
                                                                                                if ($user['status'] == 'Treated') {
                                                                                                    echo $user['status'] = '<span class="badge badge-primary">Treated</span>';
                                                                                                } else if ($user['status'] == 'Confirmed') {
                                                                                                    echo $user['status'] = '<span class="badge badge-success">Confirmed</span>';
                                                                                                } else if ($user['status'] == 'Pending') {
                                                                                                    echo $user['status'] = '<span class="badge badge-warning">Pending</span>';
                                                                                                } else if ($user['status'] == 'Cancelled') {
                                                                                                    echo $user['status'] = '<span class="badge badge-danger">Cancelled</span>';
                                                                                                } else {
                                                                                                    echo $user['status'] = '<span class="badge badge-secondary">Reschedule</span>';
                                                                                                }

                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                            <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script>
        $(document).ready(function() {

            $('#checkBtn').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if (!checked) {
                    alert("Please, check None option if the student does not have illness ");
                    return false;
                }
            });

            $('#checkBtn2').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if (!checked) {
                    alert("Please, check None option if the student does not have illness ");
                    return false;
                }
            });

            var table1 = $('#appointmenttable').DataTable({
                responsive: true,
                searching: true,
                paging: true,
                info: true,
            });
            var table2 = $('#prescriptiontable').DataTable({
                responsive: true,
                searching: true,
                paging: true,
                info: true,
            });
            var table3 = $('#treatmenttable').DataTable({
                responsive: true,
            });
            var table4 = $('#paymenttable').DataTable({
                responsive: true,
            });

            $('.nav-pills a').on('shown.bs.tab', function(event) {
                var tabID = $(event.target).attr('data-target');
                if (tabID === '#appointment') {
                    table1.columns.adjust().responsive.recalc();
                }
                if (tabID === '#prescription') {
                    table2.columns.adjust().responsive.recalc();
                }
                if (tabID === '#payment') {
                    table4.columns.adjust().responsive.recalc();
                }
            });


            $('.nav-tabs a').on('shown.bs.tab', function(event) {
                var tabID = $(event.target).attr('data-target');
                if (tabID === '#treatment') {
                    table3.columns.adjust().responsive.recalc();
                }
            });

            $(document).on('click', '.deleteDentalbtn', function() {
                var userid = $(this).data('id');

                if (confirm("Are you sure you want to delete this data?")) {
                    $.ajax({
                        type: "post",
                        url: "medical_action.php",
                        data: {
                            'delete_dental': true,
                            'user_id': userid,
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
            $(document).on('click', '.editDentalbtn', function() {
                var userid = $(this).data('id');

                $.ajax({
                    type: "post",
                    url: "medical_action.php",
                    data: {
                        'dental_editbtn': true,
                        'user_id': userid,
                    },
                    success: function(response) {
                        $.each(response, function(key, value) {
                            $('#edit_id').val(value['id']);
                            $('#student_id').val(value['student_id']);
                            $('#edit_dentist').val(value['dentist']);
                            $('#edit_visit').val(value['visit']);
                            $('#EditDentalModal').modal('show');
                        });
                    }
                });

            });
            $(document).on('click', '.deleteMedicalbtn', function() {
                var userid = $(this).data('id');

                if (confirm("Are you sure you want to delete this data?")) {
                    $.ajax({
                        type: "post",
                        url: "medical_action.php",
                        data: {
                            'delete_medical': true,
                            'user_id': userid,
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });

            $(document).on('click', '.editMedicalbtn', function() {
                var userid = $(this).data('id');
                $('#EditMedicalModal').modal('show');

            });
        });
    </script>
    <?php include('../../includes/footer.php'); ?>