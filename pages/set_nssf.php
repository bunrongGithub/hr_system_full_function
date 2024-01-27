<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_range_from = $_POST["txt_range_from"];
    $v_range_to = $_POST["txt_range_to"];
    $v_accident_rate = $_POST["txt_accident_rate"];
    $v_health_rate = $_POST["txt_health_rate"];
    $v_year = $_POST["txt_year"];
    $v_date_from = $_POST["txt_date_from"];
    $v_date_to = $_POST["txt_date_to"];

    $sql = "INSERT INTO set_nssf 
                        ( sn_range_from , sn_range_to , sn_acci_rate , sn_heath_rate , sn_year , sn_date_from , sn_date_to ) 
                  VALUES 
                    ('$v_range_from', '$v_range_to', '$v_accident_rate', '$v_health_rate', '$v_year', '$v_date_from', '$v_date_to')";
    $result = mysqli_query($connect, $sql);
    header('location:set_nssf.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["nssf_id"];
    $v_range_from = $_POST["edit_range_from"];
    $v_range_to = $_POST["edit_range_to"];
    $v_accident_rate = $_POST["edit_accident_rate"];
    $v_health_rate = $_POST["edit_health_rate"];
    $v_year = $_POST["edit_year"];
    $v_date_from = $_POST["edit_date_from"];
    $v_date_to = $_POST["edit_date_to"];

    $sql = "UPDATE set_nssf SET sn_range_from = '$v_range_from', 
                                sn_range_to = '$v_range_to', 
                                sn_acci_rate = '$v_accident_rate', 
                                sn_heath_rate = '$v_health_rate', 
                                sn_year = '$v_year', 
                                sn_date_from = '$v_date_from',
                                sn_date_to = '$v_date_to' WHERE sn_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:set_nssf.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM set_nssf WHERE ot_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: set_nssf.php?message=delete");
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
                        NSSF (National Social Security Fund)
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
                                                            <label>Range From:</label>
                                                            <input class="form-control" id="txt_range_from" name="txt_range_from" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Range To:</label>
                                                            <input class="form-control" id="txt_range_to" name="txt_range_to" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Accident Rate:</label>
                                                            <input class="form-control" id="txt_accident_rate" name="txt_accident_rate" type="number"  step="0.01">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Health Rate:</label>
                                                            <input class="form-control" id="txt_health_rate" name="txt_health_rate" type="number"  step="0.01">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Year:</label>
                                                            <input class="form-control" id="txt_year" name="txt_year" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Date From</label>
                                                            <input class="form-control" id="txt_date_from" name="txt_date_from" type="date">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Date To</label>
                                                            <input class="form-control" id="txt_date_to" name="txt_date_to" type="date">
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
                                                        <input type="hidden" id="nssf_id" name="nssf_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Range From:</label>
                                                            <input class="form-control" id="edit_range_from" name="edit_range_from" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Range To:</label>
                                                            <input class="form-control" id="edit_range_to" name="edit_range_to" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Accident Rate:</label>
                                                            <input class="form-control" id="edit_accident_rate" name="edit_accident_rate" type="number"  step="0.01">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Health Rate:</label>
                                                            <input class="form-control" id="edit_health_rate" name="edit_health_rate" type="number"  step="0.01">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Year:</label>
                                                            <input class="form-control" id="edit_year" name="edit_year" type="number">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Date From</label>
                                                            <input class="form-control" id="edit_date_from" name="edit_date_from" type="date">
                                                        </div> 
                                                        <div class="form-group col-xs-6">
                                                            <label>Date To</label>
                                                            <input class="form-control" id="edit_date_to" name="edit_date_to" type="date">
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
                                                <th>Year</th>
                                                <th>Salary</th>
                                                <th>Work Accident Rate</th>
                                                <th>Health Care Rate</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM set_nssf";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_year = $row["sn_year"];
                                                $v_range_from = $row["sn_range_from"];
                                                $v_range_to = $row["sn_range_to"];
                                                $v_accident_rate = $row["sn_acci_rate"];
                                                $v_health_rate = $row["sn_heath_rate"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_year; ?></td>
                                                    <td><?php echo "From: ".$v_range_from." - To: ".$v_range_to; ?></td>
                                                    <td><?php echo $v_accident_rate." %"; ?></td>
                                                    <td><?php echo $v_health_rate." %"; ?></td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="edit_set_nssf.php?id=<?php echo $row['sn_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['sn_id']; ?>,
                                                        '<?php echo $v_range_from; ?>',
                                                        '<?php echo $v_range_to; ?>',
                                                        '<?php echo $v_accident_rate; ?>',
                                                        '<?php echo $v_health_rate; ?>',
                                                        '<?php echo $row['sn_year']; ?>',
                                                        '<?php echo $row['sn_date_from']; ?>',
                                                        '<?php echo $row['sn_date_to']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="set_nssf.php?del_id=<?php echo $row['sn_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, range_from, range_to, accident_rate, health_rate, year, date_from, date_to) {
            $('#nssf_id').val(id);
            $('#edit_range_from').val(range_from);
            $('#edit_range_to').val(range_to);
            $('#edit_accident_rate').val(accident_rate);
            $('#edit_health_rate').val(health_rate);
            $('#edit_year').val(year);
            $('#edit_date_from').val(date_from);
            $('#edit_date_to').val(date_to);
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#nssf").addClass("active");
            $("#nssf").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>