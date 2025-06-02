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
                        <div class="col-sm-6">
                            <h1 class="m-0">Generate QR CODE</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                                <li class="breadcrumb-item active">Generate QR CODE</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Generate QR CODE</h3>
                        </div>
                        <div class="card-body">
                            <form action="qr-code_action.php" method="GET">
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Grade:</label>
                                            <select name="grade" id="grade" required class="form-control">
                                                <option value="" selected disabled>-- Select Grade --</option>
                                                <?php
                                                $grades = mysqli_query($conn, "SELECT DISTINCT grade FROM tbluser ORDER BY grade ASC");
                                                while ($g = mysqli_fetch_assoc($grades)) {
                                                    echo "<option value='{$g['grade']}'>{$g['grade']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Section:</label>
                                            <select name="section" id="section" required class="form-control">
                                                <option value="" selected disabled>-- Select Section --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('grade').addEventListener('change', function () {
                                            var grade = this.value;
                                            var sectionSelect = document.getElementById('section');
                                            sectionSelect.innerHTML = '<option value="" selected disabled>-- Select Section --</option>';

                                            fetch('get_sections.php?grade=' + grade)
                                                .then(response => response.json())
                                                .then(data => {
                                                    data.forEach(function (section) {
                                                        var option = document.createElement('option');
                                                        option.value = section;
                                                        option.textContent = section;
                                                        sectionSelect.appendChild(option);
                                                    });
                                                });
                                        });
                                    </script>
                                </div>
                                <button type="submit" class="btn btn-primary w-25 float-right">Generate QR</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div> <!-- /.container -->
        </div> <!-- /.content-wrapper -->

    </div>

    <?php include('../../includes/scripts.php'); ?>
    <?php include('../../includes/footer.php'); ?>
    