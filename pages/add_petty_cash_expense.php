<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_pe_pce_no = $_POST["txt_pe_pce_no"];
    $v_pe_date = $_POST["txt_pe_date"];
    $v_pe_cpc_id = $_POST["txt_cpc_code"];
    $v_pe_expense_description = $_POST["txt_pe_expense_description"];
    $v_exchange_rate = $_POST["exchange_rate"];
    $v_original_amount = $_POST["original_amount"];
    $v_pe_total_amount = $_POST["pe_total_amount"];
    $v_pe_note = $_POST["txt_pe_note"];
    $v_pe_expense_currency_type = $_POST["txt_pe_expense_currency_type"];

    $sql = "INSERT INTO pettycash_exp 
                        ( pe_pce_no,
                          pe_date,
                          pe_cpc_id,
                          pe_expense_description,
                          exchange_rate,
                          original_amount,
                          pe_total_amount,
                          pe_note,
                          pe_expense_currency_type
                        )
                  VALUES 
                    ('$v_pe_pce_no',
                    '$v_pe_date',
                    '$v_pe_cpc_id',
                    '$v_pe_expense_description',
                    '$v_exchange_rate',
                    '$v_original_amount',
                    '$v_pe_total_amount',
                    '$v_pe_note',
                    '$v_pe_expense_currency_type'

                    )";
    $result = mysqli_query($connect, $sql);
    header('location:add_petty_cash_expense.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["pe_id"];
    $v_pe_pce_no = $_POST["edit_pe_pce_no"];
    $v_pe_amount_usd = $_POST["edit_pe_amount_usd"];
    $v_pe_amount_khr = $_POST["edit_pe_amount_khr"];
    $v_original_amount = $_POST["edit_original_amount"];
    $v_exchange_rate = $_POST["edit_exchange_rate"];
    $v_pe_expense_description = $_POST["edit_pe_expense_description"];
    $v_pe_total_amount = $_POST["edit_pe_total_amount"];
    $v_pe_expense_currency_type = $_POST["edit_pe_expense_currency_type"];
    $v_pe_ref = $_POST["edit_pe_ref"];
    $v_pe_invoice_no = $_POST["edit_pe_invoice_no"];
    $v_pe_date = $_POST["edit_pe_date"];
    $v_pe_note = $_POST["edit_pe_note"];

    $sql = "UPDATE pettycash_exp SET pe_pce_no = '$v_pe_pce_no', 
                                     pe_amount_usd = '$v_pe_amount_usd',
                                     pe_amount_khr = '$v_pe_amount_khr',
                                     original_amount = '$v_original_amount',
                                     exchange_rate = '$v_exchange_rate',
                                     pe_expense_description = '$v_pe_expense_description',
                                     pe_total_amount = '$v_pe_total_amount',
                                     pe_expense_currency_type = '$v_pe_expense_currency_type',
                                     pe_ref = '$v_pe_ref',
                                     pe_invoice_no = '$v_pe_invoice_no',
                                     pe_date = '$v_pe_date',
                                     pe_note = '$v_pe_note' WHERE pe_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:add_petty_cash_expense.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM pettycash_exp WHERE pe_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: add_petty_cash_expense.php?message=delete");
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
                    Add Petty Cash Expense
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
                                                    <form name="form1" method="post" enctype="multipart/form-data" action="">
                                                        <div class="col-md-6">
                                                            <div class="col-md-12">
                                                                <label for="">Code:</label>
                                                                <select class="form-control" name="txt_cpc_code" id="txt_cpc_code" data-live-search="true" required="required">
                                                                    <option disabled selected>Please Select PCR No</option>
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
                                                            <div class="col-md-12" style="margin-top: 40px;">
                                                                <label>Original Amount:</label>
                                                                <input class="form-control" name="original_amount" type="text">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Total Amount:</label>
                                                                <input class="form-control" onClick="computeSalary();" name="pe_total_amount" type="text" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-md-12" style="text-align: center; margin-top: 20px;">
                                                                <label>Expense Currency Type:</label>
                                                                <div class="col-md-12">
                                                                    <input class="form-control" id="txt_pe_expense_currency_type" name="txt_pe_expense_currency_type" onClick="computeSalary();" type="radio" name="contact" id="contact_usd" value="USD" />
                                                                    <label for="contact_usd">USD</label>
                                                                    <input class="form-control" id="txt_pe_expense_currency_type" name="txt_pe_expense_currency_type" type="radio" name="contact" id="contact_khr" value="KHR" />
                                                                    <label for="contact_khr">KHR</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Input Date:</label>
                                                                <input class="form-control" id="txt_pe_date" name="txt_pe_date" type="date">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>PCE No:</label>
                                                                <input class="form-control" id="txt_pe_pce_no" name="txt_pe_pce_no" type="text">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Note:</label>
                                                                <input class="form-control" id="txt_pe_note" name="txt_pe_note" type="text">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label>Expense Description:</label>
                                                                <input class="form-control" id="txt_pe_expense_description" name="txt_pe_expense_description" type="text">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Exchange Rate:</label>
                                                                <input class="form-control" onClick="computeSalary();" name="exchange_rate" type="text">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer" style="margin-top: 400px;">
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
                                                        <input type="hidden" id="pe_id" name="pe_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Pce No:</label>
                                                            <input class="form-control" id="edit_pe_pce_no" name="edit_pe_pce_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Amount Usd:</label>
                                                            <input class="form-control" id="edit_pe_amount_usd" name="edit_pe_amount_usd" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Amount khr:</label>
                                                            <input class="form-control" id="edit_pe_amount_khr" name="edit_pe_amount_khr" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Original Amount:</label>
                                                            <input class="form-control" id="edit_original_amount" name="edit_original_amount" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Exchange Rate:</label>
                                                            <input class="form-control" id="edit_exchange_rate" name="edit_exchange_rate" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Expense Discription:</label>
                                                            <input class="form-control" id="edit_pe_expense_description" name="edit_pe_expense_description" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Total Amount:</label>
                                                            <input class="form-control" id="edit_pe_total_amount" name="edit_pe_total_amount" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Expense Currency Type:</label>
                                                            <input class="form-control" id="edit_pe_expense_currency_type" name="edit_pe_expense_currency_type" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Ref:</label>
                                                            <input class="form-control" id="edit_pe_ref" name="edit_pe_ref" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Invoice No</label>
                                                            <input class="form-control" id="edit_pe_invoice_no" name="edit_pe_invoice_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Date:</label>
                                                            <input class="form-control" id="edit_pe_date" name="edit_pe_date" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Pe Note:</label>
                                                            <input class="form-control" id="edit_pe_note" name="edit_pe_note" type="text">
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
                                                <th>PCE No</th>
                                                <th>Input Date</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Expense Description</th>
                                                <th>Amount</th>
                                                <th>Note</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM pettycash_exp A
                                                    LEFT JOIN create_petty_cash B ON B.cpc_id = A.pe_cpc_id

                                                   ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_pe_pce_no = $row["pe_pce_no"];
                                                $v_pe_date = $row["pe_date"];
                                                $v_pe_cpc_id = $row["cpc_code"];
                                                $v_cpc_description = $row["cpc_description"];
                                                $v_pe_expense_currency_type = $row["pe_expense_currency_type"];
                                                $v_cpc_currency = $row["cpc_currency"];
                                                $v_pe_expense_description = $row["pe_expense_description"];
                                                $v_pe_amount_usd = $row["pe_amount_usd"];
                                                $v_pe_amount_khr = $row["pe_amount_khr"];
                                                $v_pe_total_amount = $row["pe_total_amount"];
                                                $v_pe_note = $row["pe_note"];
                                                $v_original_amount = $row["original_amount"];
                                                $v_exchange_rate = $row["exchange_rate"];
                                                $v_pe_ref = $row["pe_ref"];
                                                $v_pe_invoice_no = $row["pe_invoice_no"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_pe_pce_no; ?></td>
                                                    <td><?php echo $v_pe_date; ?></td>
                                                    <td><?php echo $v_pe_cpc_id; ?></td>
                                                    <td><?php echo $v_cpc_description; ?></td>
                                                    <td><?php echo $v_pe_expense_description; ?></td>
                                                    <td>
                                                        <?php
                                                            if($v_pe_expense_currency_type == 'USD'){
                                                                echo 'USD' . '&nbsp'. $v_pe_total_amount; 
                                                            }
                                                            else{
                                                                echo 'KHR' . '&nbsp'. $v_pe_total_amount;
                                                            }
                                                         ?>

                                                    </td>
                                                    <td><?php echo $v_pe_note; ?></td>
                                                    <td>
                                                        <a onclick="doUpdate(<?php echo $row['pe_id']; ?>,
                                                        '<?php echo $v_pe_pce_no; ?>',
                                                        '<?php echo $v_pe_amount_usd; ?>',
                                                        '<?php echo $v_pe_amount_khr; ?>',
                                                        '<?php echo $v_original_amount; ?>',
                                                        '<?php echo $v_exchange_rate; ?>',
                                                        '<?php echo $v_pe_expense_description; ?>',
                                                        '<?php echo $v_pe_total_amount; ?>',
                                                        '<?php echo $v_pe_expense_currency_type; ?>',
                                                        '<?php echo $v_pe_ref; ?>',
                                                        '<?php echo $v_pe_invoice_no; ?>',
                                                        '<?php echo $v_pe_date; ?>',
                                                        '<?php echo $v_pe_note; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="add_petty_cash_expense.php?del_id=<?php echo $row['pe_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, pe_pce_no, pe_amount_usd, pe_amount_khr, original_amount, exchange_rate, pe_expense_description, pe_total_amount, pe_expense_currency_type, pe_ref, pe_invoice_no, pe_date, pe_note ) {

            $('#pe_id').val(id);
            $('#edit_pe_pce_no').val(pe_pce_no);
            $('#edit_pe_amount_usd').val(pe_amount_usd);
            $('#edit_pe_amount_khr').val(pe_amount_khr);
            $('#edit_original_amount').val(original_amount);
            $('#edit_exchange_rate').val(exchange_rate);
            $('#edit_pe_expense_description').val(pe_expense_description);
            $('#edit_pe_total_amount').val(pe_total_amount);
            $('#edit_pe_expense_currency_type').val(pe_expense_currency_type);
            $('#edit_pe_ref').val(pe_ref);
            $('#edit_pe_invoice_no').val(pe_invoice_no);
            $('#edit_pe_date').val(pe_date);
            $('#edit_pe_note').val(pe_note);

        }

        $('#txt_cpc_code').change(function() {
            $('.show_hid').css("visibility", "visible");
            var cpc_code = $("#txt_cpc_code").val();
            if (cpc_code) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_add_petty_cash_expense.php',
                    data: {
                        'add_petty_cash_expense_cpc_code': cpc_code
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

        function computeSalary() {
            var original_amountData = document.form1.original_amount.value;
            var exchange_rateData = document.form1.exchange_rate.value;
            var txt_pe_expense_currency_typeData = document.form1.txt_pe_expense_currency_type.value;
            if (txt_pe_expense_currency_typeData == 'USD') {
                var amount = parseFloat(original_amountData) * parseFloat(exchange_rateData);
                document.form1.pe_total_amount.value = amount;
            } else {
                var amount = parseFloat(original_amountData) / parseFloat(exchange_rateData);
                document.form1.pe_total_amount.value = amount;
            }


        }

        $(function() {
            $("#menu_pc_manage").addClass("active");
            $("#pc_add_expense").addClass("active");
            $("#pc_add_expense").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>