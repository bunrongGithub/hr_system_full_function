<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/signature_stamp/";

if (isset($_POST["btnadd"])) {
    $v_company = $_POST["txt_company"];
    $v_emp = $_POST["txt_emp"];
    $v_position = $_POST["txt_position"];

    $sql = "INSERT INTO signature_stamp 
                        ( sst_company_id , sst_employee_id , sst_position_id ) 
                  VALUES 
                    ('$v_company' , '$v_emp' , '$v_position')";
    $result = mysqli_query($connect, $sql);
    header('location:sign_stamp.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["sign_id"];
    $v_company = $_POST["edit_company"];
    $v_emp = $_POST["edit_emp"];
    $v_position = $_POST["edit_position"];

    $sql = "UPDATE signature_stamp SET sst_company_id = '$v_company' , 
                                    sst_employee_id = '$v_emp' , 
                                    sst_position_id = '$v_position' WHERE sst_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:sign_stamp.php?message=update');
}


if (isset($_POST["btnimage"])) {
    $id = $_POST["img_id"];
    $v_signature = '';
    $v_stamp = '';
    $signature = '';
    $stamp = '';
    if (!empty($_FILES['img_signature']['name'])) {
        $v_signature = date("Ymd") . "_" . basename($_FILES['img_signature']['name']);
        $signature = $targetDir . date("Ymd") . "_" . basename($_FILES['img_signature']['name']);
        move_uploaded_file($_FILES['img_signature']['tmp_name'], $signature);
        $sql = "UPDATE job_card_id SET jci_card_image = '$v_signature' WHERE jci_id = $id";
        $result = mysqli_query($connect, $sql);
    }
    if (!empty($_FILES['img_stamp']['name'])) {
        $v_stamp = date("Ymd") . "_" . basename($_FILES['img_stamp']['name']);
        $stamp = $targetDir . date("Ymd") . "_" . basename($_FILES['img_stamp']['name']);
        move_uploaded_file($_FILES['img_stamp']['tmp_name'], $stamp);
        $sql = "UPDATE job_card_id SET jci_card_back_image = '$v_stamp' WHERE jci_id = $id";
        $result = mysqli_query($connect, $sql);
    }

    header('location:sign_stamp.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM signature_stamp WHERE sst_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: sign_stamp.php?message=delete");
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
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="../css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-black">
    <?php include('header.php') ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Include left Menu -->
        <?php include "left_menu.php" ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <div class="col-xs-12">
                <?php
                if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                    echo '<div class="alert alert-success">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Add Data</h4>';
                    echo '</div>';
                } else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                    echo '<div class="alert alert-info">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Update Data</h4>';
                    echo '</div>';
                } else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                    echo '<div class="alert alert-danger">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Delete Data</h4>';
                    echo '</div>';
                }
                ?>
            </div>
            <section class="content-header">
                <h1>
                    Signature & Stamp
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="row">

                    <div class="col-xs-12 connectedSortable">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <div class="form-group col-xs-6">
                                                            <label>Company Name:</label>
                                                            <select class="form-control" id="txt_company" name="txt_company" required="required">
                                                                <option disabled selected>Please Select Company</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Employee Name:</label>
                                                            <select class="form-control" id="txt_emp" name="txt_emp" required="required">
                                                                <option disabled selected>Please Select Employee Name</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_id'] . '">' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Postion:</label>
                                                            <select class="form-control" id="txt_position" name="txt_position" required="required">
                                                                <option disabled selected>Please Select Postion</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM position';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <!-- Modal Update-->
                                <div class="modal fade" id="myModal_update" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="sign_id" name="sign_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Company Name:</label>
                                                            <select class="form-control" id="edit_company" name="edit_company" required="required">
                                                                <option disabled selected>Please Select Company</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_id'] . '">' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Employee Name:</label>
                                                            <select class="form-control" id="edit_emp" name="edit_emp" required="required">
                                                                <option disabled selected>Please Select Branch</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['ub_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Postion:</label>
                                                            <select class="form-control" id="edit_position" name="edit_position" required="required">
                                                                <option disabled selected>Please Select Branch</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM position';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="btnupdate" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Update-->
                                <!-- Modal img-fluidal Image-->
                                <div class="modal fade" id="myModal_image" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="img_id" name="img_id" />
                                                        <div class="row">
                                                            <div class="form-group col-xs-6">
                                                                <label>Upload Signature Here:</label>
                                                                <input type="file" id="img_signature" name="img_signature" values="upload" class="form-control" accept="image/*" onchange="show_signature(event);"></input>
                                                            </div>
                                                            <div class="form-group col-xs-6">
                                                                <label>Upload Stamp Here:</label>
                                                                <input type="file" id="img_stamp" name="img_stamp" values="upload" class="form-control" accept="image/*" onchange="show_stamp(event);"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-xs-6">
                                                                <img id="show_sign" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." width="240px">
                                                            </div>
                                                            <div class="form-group col-xs-6">
                                                                <img id="show_stamp" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." width="240px">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="btnimage" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Image-->

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Company</th>
                                                <th>Employee</th>
                                                <th>Position</th>
                                                <th>Signature</th>
                                                <th>Stamp</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM signature_stamp LEFT JOIN company ON company.c_id = sst_company_id 
                                            LEFT JOIN employee_registration on employee_registration.er_id = sst_employee_id 
                                            LEFT JOIN position on position.position_id = sst_position_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_company = $row["c_name_kh"];
                                                $v_emp = $row["er_name_kh"];
                                                $v_position = $row["position"];
                                                $v_signature = $row["sst_esign"];
                                                $v_stamp = $row["sst_estamp"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_company; ?></td>
                                                    <td><?php echo $v_emp; ?></td>
                                                    <td><?php echo $v_position; ?></td>
                                                    <td style="text-align: center;" ><?php
                                                        if ($v_signature != '') {
                                                            echo '<img src="../img/upload/signature_stamp/' . $v_signature . '" width="120px" height="100px"/>';
                                                        } else {
                                                            echo '<img src="../img/no_image.jpg" width="120px" height="100px"/>';
                                                        }
                                                        ?>
                                                        <a style="float:right; cursor:pointer;" onclick="doImage(<?php echo $row['sst_id']; ?>,
                                                        '<?php echo $v_signature; ?>',
                                                        '<?php echo $v_stamp; ?>')" data-toggle="modal" data-target="#myModal_image">
                                                            <i style="color:#3c8dbc;" class="fa fa-pencil "></i>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;"><?php 
                                                        if ($v_stamp != '') {
                                                            echo '<img src="../img/upload/signature_stamp/' . $v_stamp . '" width="120px" height="100px"/>';
                                                        } else {
                                                            echo '<img src="../img/no_image.jpg" width="120px" height="100px"/>';
                                                        } ?>
                                                        <a style="float:right; cursor:pointer;" onclick="doImage(<?php echo $row['sst_id']; ?>,
                                                        '<?php echo $v_signature; ?>',
                                                        '<?php echo $v_stamp; ?>')" data-toggle="modal" data-target="#myModal_image">
                                                            <i style="color:#3c8dbc;" class="fa fa-pencil "></i>
                                                        </a>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="edit_sign_stamp.php?id=<?php echo $row['sst_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['sst_id']; ?>,
                                                        '<?php echo $row['sst_company_id']; ?>',
                                                        '<?php echo $row['sst_employee_id']; ?>',
                                                        '<?php echo $row['sst_position_id']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="sign_stamp.php?del_id=<?php echo $row['sst_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
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
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../js/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- fullCalendar -->
    <script src="../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


    <script type="text/javascript">
        function doUpdate(id, companyid, employeeid, positionid) {
            $('#jobc_id').val(id);
            $('#edit_company').val(companyid);
            $('#edit_emp').val(employeeid);
            $('#edit_position').val(positionid);
        }

        function doImage(id, img_sign, img_stamp) {
            $('#img_id').val(id);

            if (img_sign == '') {
                document.getElementById('show_sign').setAttribute('src', '../img/no_image.jpg');
            } else {
                document.getElementById('show_sign').setAttribute('src', '../img/upload/signature_stamp/' + img_sign);
                // $('#card_front').val(cardf);
            }
            if (img_stamp == '') {
                document.getElementById('show_stamp').setAttribute('src', '../img/no_image.jpg');
            } else {
                document.getElementById('show_stamp').setAttribute('src', '../img/upload/signature_stamp/' + img_stamp);
                // $('#card_back').val(cardb);
            }
        }

        function show_signature(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("show_sign").src = src;
            }
        }

        function show_stamp(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("show_stamp").src = src;
            }
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#s_s").addClass("active");
            $("#s_s").css("background-color", "##367fa9");
            
            $('#info_data').dataTable();
        });
    </script>
</body>

</html>