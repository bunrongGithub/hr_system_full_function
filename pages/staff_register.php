<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/staff_register_img/";

if (isset($_POST["btnadd"])) {
    $v_filename = '';
    $v_job_id = $_POST["txt_job_id"];
    $v_namekh = $_POST["txt_namekh"];
    $v_nameen = $_POST["txt_nameen"];
    $v_tel = $_POST["txt_tel"];
    $v_gender = $_POST["txt_gender"];
    $v_position = $_POST["txt_position"];
    $v_department = $_POST["txt_department"];
    $v_branch = $_POST["txt_branch"];
    $v_company = $_POST["txt_company"];
    $v_address = $_POST["txt_address"];
    $v_bank_name = $_POST["txt_bank_name"];
    $v_bank_num = $_POST["txt_bank_num"];
    $v_con_period = $_POST["txt_con_period"];
    $v_date_from = $_POST["txt_date_from"];
    $v_date_to = $_POST["txt_date_to"];
    $v_salary = $_POST["txt_salary"];
    $v_salary_tax = $_POST["txt_salary_tax"];
    $v_child = $_POST["txt_child"];
    $v_spouse = $_POST["txt_spouse"];
    $v_family_status = $_POST["txt_family_status"];
    $v_edu_level = $_POST["txt_edu_level"];
    $v_probat_per = $_POST["txt_probat_per"];
    $v_pro_date_from = $_POST["txt_pro_date_from"];
    $v_pro_date_to = $_POST["txt_pro_date_to"];
    $v_note = $_POST["txt_note"];

    if (!empty($_FILES['txt_photo']['name'])) {
        /////////////////upload image//////////////////////
        $v_filename = date("Ymd") . "_id" . $v_job_id . "_" . basename($_FILES['txt_photo']['name']);
        $v_filefullname = $targetDir . date("Ymd") . "_id" . $v_job_id . "_" . basename($_FILES['txt_photo']['name']);
        move_uploaded_file($_FILES['txt_photo']['tmp_name'], $v_filefullname);
        ////////////////////////////////////////////////////
    }


    $sql = "INSERT INTO employee_registration 
                        ( er_job_id,er_name_kh,er_name_en,er_tel,er_gender_id,er_position_id,
                        er_department_id,er_branch_id,er_company_id,er_address,er_bank_acc_name,
                        er_bank_acc_num,er_contract_period,er_period_from,er_period_to,er_salary,
                        er_salary_tax,er_children,er_spouse,er_family_status_id,er_education_level,
                        er_probation_period,er_probation_per_from,er_probation_per_to,er_photo,er_note)
                  VALUES 
                    ('$v_job_id', '$v_namekh', '$v_nameen', '$v_tel','$v_gender','$v_position',
                    '$v_department', '$v_branch','$v_company','$v_address','$v_bank_name',
                    '$v_bank_num','$v_con_period','$v_date_from','$v_date_to','$v_salary',
                    '$v_salary_tax','$v_child','$v_spouse','$v_family_status','$v_edu_level',
                    '$v_probat_per','$v_pro_date_from','$v_pro_date_to','$v_filename','$v_note')";
    $result = mysqli_query($connect, $sql);
    header('location:staff_registration.php?message=success');
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <?php
    include "title_icon.php";
    ?>
    <!-- <title>HR System | Dashboard</title>
        <link rel = "icon" href = "../img/login_logo.png" 
        type = "image/x-icon"> -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 4.6 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-black">
    <?php include('header.php') ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Include left Menu -->
        <?php include "left_menu.php" ?>
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <section class="content-header">
                <h1>
                    Employee Register
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="col-xs-12 connectedSortable">
                    <div class="box">
                        <div class="box-header">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="row col-xs-12">

                                        <div class="row col-xs-3">
                                            <div class="form-group col-xs-12">
                                                <label>Job ID:</label>
                                                <input type="text" class="form-control" id="txt_job_id" name="txt_job_id" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>TEL:</label>
                                                <input type="text" class="form-control" id="txt_tel" name="txt_tel" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Company:</label>
                                                <select class="form-control" id="txt_company" name="txt_company">
                                                    <?php
                                                    $sql = 'SELECT * FROM company';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Position:</label>
                                                <select class="form-control" id="txt_position" name="txt_position">
                                                    <?php
                                                    $sql = 'SELECT * FROM position';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>From Date:</label>
                                                <input type="date" class="form-control" id="txt_date_from" name="txt_date_from" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Salary:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="text" class="form-control" id="txt_salary" name="txt_salary" step="0.01" required />
                                                </div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Children:</label>
                                                <input type="number" class="form-control" id="txt_child" name="txt_child" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Probation Period:</label>
                                                <input type="text" class="form-control" id="txt_probat_per" name="txt_probat_per" required />
                                            </div>
                                        </div>
                                        <div class="row col-xs-3">
                                            <div class="form-group col-xs-12">
                                                <label>Name KH:</label>
                                                <input type="text" class="form-control" id="txt_namekh" name="txt_namekh" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Address:</label>
                                                <input type="text" class="form-control" id="txt_address" name="txt_address" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Branch:</label>
                                                <select class="form-control" id="txt_branch" name="txt_branch">
                                                    <?php
                                                    $sql = 'SELECT * FROM user_branch';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Family Status:</label>
                                                <select class="form-control" id="txt_family_status" name="txt_family_status">
                                                    <?php
                                                    $sql = 'SELECT * FROM text_family_status';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['fs_id'] . '">' . $row['fs_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>To Date:</label>
                                                <input type="date" class="form-control" id="txt_date_to" name="txt_date_to" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Salary TAX:</label>
                                                <input type="text" class="form-control" id="txt_salary_tax" name="txt_salary_tax" step="0.01" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Spouse:</label>
                                                <input type="number" class="form-control" id="txt_spouse" name="txt_spouse" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Probation From:</label>
                                                <input type="date" class="form-control" id="txt_pro_date_from" name="txt_pro_date_from" required />
                                            </div>
                                        </div>
                                        <div class="row col-xs-3">
                                            <div class="form-group col-xs-12">
                                                <label>Name EN:</label>
                                                <input type="text" class="form-control" id="txt_nameen" name="txt_nameen" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Gender:</label>
                                                <select class="form-control" id="txt_gender" name="txt_gender">
                                                    <?php
                                                    $sql = 'SELECT * FROM gender';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['ge_id'] . '">' . $row['ge_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Department:</label>
                                                <select class="form-control" id="txt_department" name="txt_department">
                                                    <?php
                                                    $sql = 'SELECT * FROM department';
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Contract Period:</label>
                                                <input type="text" class="form-control" id="txt_con_period" name="txt_con_period" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Bank Name:</label>
                                                <input type="text" class="form-control" id="txt_bank_name" name="txt_bank_name" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Bank Number:</label>
                                                <input type="number" class="form-control" id="txt_bank_num" name="txt_bank_num" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Education Level:</label>
                                                <input type="text" class="form-control" id="txt_edu_level" name="txt_edu_level" required />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Probation To:</label>
                                                <input type="date" class="form-control" id="txt_pro_date_to" name="txt_pro_date_to" required />
                                            </div>
                                        </div>
                                        <div class="row col-xs-3">
                                            <div class="form-group col-xs-12">
                                                <label>Photo:</label><br />
                                                <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="280px">
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Upload:</label>
                                                <input type="file" class="form-control" id="txt_photo" name="txt_photo" values="upload" accept="image/*" onchange="show_photo_pre(event);" />
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Note:</label>
                                                <textarea class="form-control" rows="2" id="txt_note" name="txt_note"></textarea>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                    <div class="form-group col-xs-12 text-right">
                                        <button type="submit" name="btnadd" class="btn btn-primary btn-lg"><i class="fa fa-save fa-fw"></i> Save</button>
                                        <a href="staff_registration.php" style="color:white;" class="btn btn-danger btn-lg"><i class="fa fa-undo"></i> Close </a>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


    <script type="text/javascript">
        function doImage(id, cardf) {
            $('#img_id').val(id);

            if (cardf == '') {
                document.getElementById('show_photo').setAttribute('src', '../img/no_image.jpg');
            } else {
                document.getElementById('show_photo').setAttribute('src', '../img/upload/job_card/' + cardf);
            }
        }

        function show_photo_pre(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("show_photo").src = src;
            }
        }

        $(function() {
            $("select").selectpicker();
            $("#menu_staff_update").addClass("active");
            $("#registration").addClass("active");
            $("#registration").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>