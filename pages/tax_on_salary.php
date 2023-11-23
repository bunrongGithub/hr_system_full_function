<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {

    $v_amount_from = $_POST["txt_amount_from"];
    $v_amount_to = $_POST["txt_amount_to"];
    $v_rate = $_POST["txt_rate"];
    $v_spouse_children = $_POST["txt_spouse_children"];
    $v_deduct_tax_bias = $_POST["txt_deduct_tax_bias"];
    $v_year = $_POST["txt_year"];
    $v_date_from = $_POST["txt_date_from"];
    $v_date_to = $_POST["txt_date_to"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO tax_on_salary 
                        ( ts_amount_from, ts_amount_to, ts_rate, ts_spouse_children, ts_deduct_tax_bias, ts_year, ts_date_from, ts_date_to, ts_note ) 
                  VALUES 
                    ('$v_amount_from' ,'$v_amount_to' ,'$v_rate' ,'$v_spouse_children' ,'$v_deduct_tax_bias' ,'$v_year' ,'$v_date_from' ,'$v_date_to' , '$v_note' )";
    $result = mysqli_query($connect, $sql);
    header('location:tax_on_salary.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["tax_salary_id"];
    $v_amount_from = $_POST["edit_amount_from"];
    $v_amount_to = $_POST["edit_amount_to"];
    $v_rate = $_POST["edit_rate"];
    $v_spouse_children = $_POST["edit_spouse_children"];
    $v_deduct_tax_bias = $_POST["edit_deduct_tax_bias"];
    $v_year = $_POST["edit_year"];
    $v_date_from = $_POST["edit_date_from"];
    $v_date_to = $_POST["edit_date_to"];
    $v_note = $_POST["edit_note"];

    $sql = "UPDATE tax_on_salary SET ts_amount_from = '$v_amount_from' ,
                                    ts_amount_to = '$v_amount_to' ,
                                    ts_rate = '$v_rate' ,
                                    ts_spouse_children = '$v_spouse_children' ,
                                    ts_deduct_tax_bias = '$v_deduct_tax_bias' ,
                                    ts_year = '$v_year' ,
                                    ts_date_from = '$v_date_from' ,
                                    ts_date_to = '$v_date_to' ,
                                    ts_note = '$v_note' WHERE ts_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:tax_on_salary.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM tax_on_salary WHERE ts_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: tax_on_salary.php?message=delete");
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
                    Tax On Salary
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
                                                            <label>From:</label>
                                                            <input class="form-control" id="txt_amount_from" name="txt_amount_from" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>To:</label>
                                                            <input class="form-control" id="txt_amount_to" name="txt_amount_to" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Rate:</label>
                                                            <input class="form-control" id="txt_rate" name="txt_rate" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Spouse_Children:</label>
                                                            <input class="form-control" id="txt_spouse_children" name="txt_spouse_children" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Deduct_Tax_Bias:</label>
                                                            <input class="form-control" id="txt_deduct_tax_bias" name="txt_deduct_tax_bias" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Year:</label>
                                                            <input class="form-control" id="txt_year" name="txt_year" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date_From:</label>
                                                            <input class="form-control" id="txt_date_from" name="txt_amount_from" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date_To:</label>
                                                            <input class="form-control" id="txt_date_to" name="txt_date_to" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" rows="2" id="txt_note" name="txt_note"></textarea>
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
                                                        <input type="hidden" id="tax_salary_id" name="tax_salary_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>From:</label>
                                                            <input class="form-control" id="edit_amount_from" name="edit_amount_from" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>To:</label>
                                                            <input class="form-control" id="edit_amount_to" name="edit_amount_to" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Rate:</label>
                                                            <input class="form-control" id="edit_rate" name="txt_rate" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Spouse_Children:</label>
                                                            <input class="form-control" id="edit_spouse_children" name="edit_spouse_children" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Deduct_Tax_Bias:</label>
                                                            <input class="form-control" id="edit_deduct_tax_bias" name="edit_deduct_tax_bias" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Year:</label>
                                                            <input class="form-control" id="edit_year" name="edit_year" type="number">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date_From:</label>
                                                            <input class="form-control" id="edit_date_from" name="edit_amount_from" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date_To:</label>
                                                            <input class="form-control" id="edit_date_to" name="edit_date_to" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" rows="2" id="edit_note" name="edit_note"></textarea>
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

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Basic Salary</th>
                                                <th>Rate</th>
                                                <th>Spouse & Children</th>
                                                <th>Deduct Tax Bias</th>
                                                <th>Year</th>
                                                <th>Note</th>
                                                <th style="width: 110px; ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tax_on_salary";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_amount_from = $row["ts_amount_from"];
                                                $v_amount_to = $row["ts_amount_to"];
                                                $v_rate = $row["ts_rate"];
                                                $v_spouse_children = $row["ts_spouse_children"];
                                                $v_deduct_tax_bias = $row["ts_deduct_tax_bias"];
                                                $v_year = $row["ts_year"];
                                                $v_note = $row["ts_note"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo "From: " . $v_amount_from . " KHR To: " . $v_amount_to . " KHR"; ?></td>
                                                    <td><?php echo $v_rate . " %"; ?></td>
                                                    <td><?php echo $v_spouse_children . " KHR/Person"; ?></td>
                                                    <td><?php echo $v_deduct_tax_bias; ?></td>
                                                    <td><?php echo $v_year; ?></td>
                                                    <td><?php echo $v_note; ?></td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="edit_tax_on_salary.php?id=<?php echo $row['ts_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['ts_id']; ?>,
                                                        '<?php echo $v_amount_from; ?>',
                                                        '<?php echo $v_amount_to; ?>',
                                                        '<?php echo $v_rate; ?>',
                                                        '<?php echo $v_spouse_children; ?>',
                                                        '<?php echo $v_deduct_tax_bias; ?>',
                                                        '<?php echo $v_year; ?>',
                                                        '<?php echo $row['ts_date_from']; ?>',
                                                        '<?php echo $row['ts_date_to']; ?>',
                                                        '<?php echo $v_note; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="tax_on_salary.php?del_id=<?php echo $row['ts_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, amount_from, amount_to, rate, spouse_children, deduct_tax_bias, year, date_from, date_to, note) {
            $('#tax_salary_id').val(id);
            $('#edit_amount_from').val(amount_from);
            $('#edit_amount_to').val(amount_to);
            $('#edit_rate').val(rate);
            $('#edit_spouse_children').val(spouse_children);
            $('#edit_deduct_tax_bias').val(deduct_tax_bias);
            $('#edit_year').val(year);
            $('#edit_date_from').val(date_from);
            $('#edit_date_to').val(date_to);
            $('#edit_note').val(note);
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#tax").addClass("active");
            $("#tax").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>