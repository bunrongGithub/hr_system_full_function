<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_pc_pcr_no = $_POST["txt_pc_pcr_no"];
    $v_pc_request_date = $_POST["txt_pc_request_date"];
    $v_pc_amount_usd = $_POST["txt_pc_amount_usd"];
    $v_pc_expense_currency_type = $_POST["txt_pc_expense_currency_type"];
    $v_pc_cpc = $_POST["txt_cpc_code"];
    $v_pc_reason = $_POST["txt_pc_reason"];
    $v_pc_status_id = $_POST["txt_tpc_name"];





    $sql = "INSERT INTO pettycash_request 
                        ( pc_pcr_no, 
                         pc_request_date,
                         pc_amount_usd,
                         pc_expense_currency_type,
                         pc_cpc_id,
                         pc_reason,
                         pc_status_id
                        )
                  VALUES 
                    ('$v_pc_pcr_no',
                     '$v_pc_request_date',
                     '$v_pc_amount_usd', 
                     '$v_pc_expense_currency_type', 
                     '$v_pc_cpc',
                     '$v_pc_reason',
                     '$v_pc_status_id'
                     
                    )";
    $result = mysqli_query($connect, $sql);
    header('location:petty_cash_request.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["pc_id"];
    $v_pc_pcr_no = $_POST["edit_pc_pcr_no"];
    $v_pc_reason = $_POST["edit_pc_reason"];
    $v_pc_amount_usd = $_POST["edit_pc_amount_usd"];
    $v_pc_expense_currency_type = $_POST["edit_pc_expense_currency_type"];
    $v_pc_request_date = $_POST["edit_pc_request_date"];
    $v_pc_approved_date = $_POST["edit_pc_approved_date"];

    $sql = "UPDATE pettycash_request SET pc_pcr_no = '$v_pc_pcr_no',
                                 pc_reason = '$v_pc_reason',
                                 pc_amount_usd = '$v_pc_amount_usd',
                                 pc_expense_currency_type = '$v_pc_expense_currency_type',
                                 pc_request_date = '$v_pc_request_date',
                                 pc_approved_date = '$v_pc_approved_date' WHERE pc_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:petty_cash_request.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM pettycash_request WHERE pc_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: petty_cash_request.php?message=delete");
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
                    Petty Cash Request
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
                                                            <label>PCR No:</label>
                                                            <input class="form-control" id="txt_pc_pcr_no" name="txt_pc_pcr_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Applied Date:</label>
                                                            <input class="form-control" id="txt_pc_request_date" name="txt_pc_request_date" type="date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Code:</label>
                                                            <select class="form-control" name="txt_cpc_code" id="txt_cpc_code" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Code</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM create_petty_cash';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['cpc_id'] . '" titile="' . $row['cpc_code'] . '" > Code:' . $row['cpc_code'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="col-md-12">
                                                                <div id="amount_data"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount:</label>
                                                            <input class="form-control" id="txt_pc_amount_usd" name="txt_pc_amount_usd" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="txt_pc_reason" name="txt_pc_reason" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>status:</label>
                                                            <select class="form-control select2" style="width: 100%;" name="txt_tpc_name">
                                                                <option value="">==== Select ====</option>
                                                                <?php
                                                                $v_select = mysqli_query($connect, "SELECT * FROM text_petty_cash_status");
                                                                while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                                                    <option value="<?php echo $row['tpc_id']; ?>"><?php echo $row['tpc_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6" style="text-align: center; margin-top: 20px;">
                                                                <label>Expense Currency Type:</label>
                                                                <div class="col-md-12">
                                                                    <input class="form-control" id="txt_pc_expense_currency_type" name="txt_pc_expense_currency_type"  type="radio" name="contact" id="contact_usd" value="USD" />
                                                                    <label for="contact_usd">USD</label>
                                                                    <input class="form-control" id="txt_pc_expense_currency_type" name="txt_pc_expense_currency_type" type="radio" name="contact" id="contact_khr" value="KHR" />
                                                                    <label for="contact_khr">KHR</label>
                                                                </div>
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
                                                        <input type="hidden" id="pc_id" name="pc_id" />

                                                        <div class="form-group col-xs-6">
                                                            <label>PCR No:</label>
                                                            <input class="form-control" id="edit_pc_pcr_no" name="edit_pc_pcr_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="edit_pc_reason" name="edit_pc_reason" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount Usd:</label>
                                                            <input class="form-control" id="edit_pc_amount_usd" name="edit_pc_amount_usd" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Expense Currency Type:</label>
                                                            <input class="form-control" id="edit_pc_expense_currency_type" name="edit_pc_expense_currency_type" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Request Date:</label>
                                                            <input class="form-control" id="edit_pc_request_date" name="edit_pc_request_date" type="date">
                                                        </div>
                                                        
                                                        <div class="form-group col-xs-6">
                                                            <label>Approved Date:</label>
                                                            <input class="form-control" id="edit_pc_approved_date" name="edit_pc_approved_date" type="date">
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
                                                <th>PCR No</th>
                                                <th>Request Date</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM pettycash_request
                                                    LEFT JOIN create_petty_cash ON create_petty_cash.cpc_id = pettycash_request.pc_cpc_id
                                                    LEFT JOIN text_petty_cash_status ON text_petty_cash_status.tpc_id = pettycash_request.pc_status_id

                                                   ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_pc_pcr_no = $row["pc_pcr_no"];
                                                $v_pc_request_date = $row["pc_request_date"];
                                                $v_pc_approved_date = $row["pc_approved_date"];
                                                $v_pc_cpc_id = $row["cpc_code"];
                                                $v_cpc_description = $row["cpc_description"];
                                                $v_pc_amount_usd = $row["pc_amount_usd"];
                                                $v_pc_expense_currency_type = $row["pc_expense_currency_type"];
                                                $v_pc_reason = $row["pc_reason"];
                                                $v_pc_status_id = $row["tpc_name"];
                                                $v_cpc_applied_date = $row["cpc_applied_date"];
                                                $v_pc_status_id = $row["tpc_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_pc_pcr_no; ?></td>
                                                    <td><?php echo $v_pc_request_date; ?></td>
                                                    <td><?php echo $v_pc_cpc_id; ?></td>
                                                    <td><?php echo $v_cpc_description; ?></td>
                                                    <td>
                                                        <?php 
                                                        if($v_pc_expense_currency_type == 'USD'){
                                                            echo 'USD' . '&nbsp'. $v_pc_amount_usd; 
                                                        }   
                                                        else{
                                                            echo 'KHR' . '&nbsp'. $v_pc_amount_usd;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $v_pc_reason; ?></td>
                                                    <td><?php echo $v_pc_status_id; ?></td>
                                                    <td>
                                                        <a href="petty_cash_request_view.php?id=<?php echo $row['pc_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a>
                                                        <a onclick="doUpdate(<?php echo $row['pc_id']; ?>,
                                                        '<?php echo $v_pc_pcr_no ?>',
                                                        '<?php echo $v_pc_reason; ?>',
                                                        '<?php echo $v_pc_amount_usd; ?>',
                                                        '<?php echo $v_pc_expense_currency_type; ?>',
                                                        '<?php echo $v_pc_request_date; ?>',
                                                        '<?php echo $v_pc_approved_date; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="petty_cash_request.php?del_id=<?php echo $row['pc_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, pc_pcr_no, pc_reason, pc_amount_usd, pc_expense_currency_type, pc_request_date, pc_approved_date) {

            $('#pc_id').val(id);
            $('#edit_pc_pcr_no').val(pc_pcr_no);
            $('#edit_pc_reason').val(pc_reason);
            $('#edit_pc_amount_usd').val(pc_amount_usd);
            $('#edit_pc_expense_currency_type').val(pc_expense_currency_type);
            $('#edit_pc_request_date').val(pc_request_date);
            $('#edit_pc_approved_date').val(pc_approved_date);
            
            
            
            $('#edit_tpc_name').val(pc_status_id);
        }

        $('#txt_cpc_code').change(function() {
            $('.show_hid').css("visibility", "visible");
            var cpc_code = $("#txt_cpc_code").val();
            if (cpc_code) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_petty_cash_request.php',
                    data: {
                        'petty_cash_request_cpc_code': cpc_code
                    },
                    success: function(html) {
                        $('#amount_data').html(html);
                    }
                });
            }
        })

        $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });


        $(function() {
            $("#menu_menu_pc_manage").addClass("active");
            $("#pc_request").addClass("active");
            $("#pc_request").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>