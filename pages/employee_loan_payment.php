<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $sql = "DELETE FROM employee_loan_payment where elp_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header(('location:employee_loan_payment.php?message=delete'));
}

if (isset($_POST["btnadd"])) {
    $v_txt_job_id = $_POST["txt_job_id"];
    $v_txt_loan_request_no = $_POST["txt_loan_request_no"];
    $v_txt_total_loan = $_POST["txt_total_loan"];
    $v_txt_amount_to_pay = $_POST["txt_amount_to_pay"];
    $v_txt_payment_date = $_POST["txt_payment_date"];
    $v_txt_total_paid_loan = $_POST["txt_total_paid_loan"];
    $v_txt_loan_balance = $_POST["txt_loan_balance"];
    $v_txt_status = $_POST["txt_status"];
    $v_txt_applied = $_POST["txt_applied"];
    $v_txt_user = $_POST["txt_user"];
    $v_txt_remark = $_POST["txt_remark"];
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO employee_loan_payment
                        (
                            elp_job_id,
                            elp_loan_request_no,
                            elp_total_loan,
                            elp_amount_to_pay,
                            elp_payment_date,
                            elp_total_paid_loan,
                            elp_loan_balance,
                            elp_status_id,
                            elp_applied_deduction_to_salary,
                            elp_user_id,
                            elp_note,
                            created_at
                        )
                    VALUES
                        (
                            '$v_txt_job_id',
                            '$v_txt_loan_request_no',
                            '$v_txt_total_loan',
                            '$v_txt_amount_to_pay',
                            '$v_txt_payment_date',
                            '$v_txt_total_paid_loan',
                            '$v_txt_loan_balance',
                            '$v_txt_status',
                            '$v_txt_applied',
                            '$v_txt_user',
                            '$v_txt_remark',
                            '$datetime'
                        )
                        ";
    $result = mysqli_query($connect, $sql);
    header('location: employee_loan_payment.php?message=success');
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["emp_loan_payment_id"];
    $edit_request_no = $_POST["edit_request_no"];
    $edit_total_loan = $_POST["edit_total_loan"];
    $edit_amount_to_pay = $_POST["edit_amount_to_pay"];
    $edit_payment_date = $_POST["edit_payment_date"];
    $edit_total_paid_loan = $_POST["edit_total_paid_loan"];
    $edit_loan_balance = $_POST["edit_loan_balance"];
    $edit_status = $_POST["edit_status"];
    $edit_user = $_POST["edit_user"];
    $edit_applied = $_POST["edit_applied"];
    $edit_note = $_POST["edit_note"];

    $sql = "UPDATE employee_loan_payment SET
                        elp_loan_request_no = '$edit_request_no',
                        elp_total_loan = '$edit_total_loan',
                        elp_amount_to_pay = '$edit_amount_to_pay',
                        elp_payment_date = '$edit_payment_date',
                        elp_total_paid_loan = '$edit_total_paid_loan',
                        elp_loan_balance = '$edit_loan_balance',
                        elp_status_id = '$edit_status',
                        elp_user_id = '$edit_user',
                        elp_applied_deduction_to_salary = '$edit_applied',
                        elp_note = '$edit_note'
                        WHERE elp_id = $id";
    $result = mysqli_query($connect, $sql);
    header('location:employee_loan_payment.php?message=update');
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
        <aside class="right-side">
            <section class="content-header">
                <h1 class="text-primary">Employee Loan Payment<h1>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            Add New
                        </button>
            </section>
            <section class="content">
                <div class="row">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: 900px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> New Employee Loan Payment</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <div class="col-md-12">
                                                        <label for="">Job ID:</label>
                                                        <select class="form-control" name="txt_job_id" id="txt_job_id" data-live-search="true" required="required">
                                                            <option disabled selected>Please Select Job ID</option>
                                                            <?php
                                                            $sql = 'SELECT * FROM employee_registration';
                                                            $result = mysqli_query($connect, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $row['er_id'] . '" titile="' . $row['er_job_id'] . '" > ID:' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name:' . $row['er_name_kh'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <div id="amount_data"></div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Loan Request No:</label>
                                                                <input class="form-control" type="text" name="txt_loan_request_no" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Total Loan:</label>
                                                                <input class="form-control" type="text" name="txt_total_loan" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Amount to Pay:</label>
                                                                <input class="form-control" type="text" name="txt_amount_to_pay" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Payment Date:</label>
                                                                <input class="form-control" type="date" name="txt_payment_date" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Total Paid Loan:</label>
                                                                <input class="form-control" type="text" name="txt_total_paid_loan" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Loan Balance:</label>
                                                                <input class="form-control" type="text" name="txt_loan_balance" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Status</label>
                                                                <select class="form-control select2" name="txt_status" id="">
                                                                    <option value="">===Select===</option>
                                                                    <?php
                                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM text_employee_loan_payment_status ORDER BY lps_name ASC");
                                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['lps_id'] ?>"><?php echo $row['lps_name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Input By</label>
                                                                <select class="form-control select2" name="txt_user" id="">
                                                                    <option value="">===Select===</option>
                                                                    <?php
                                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Applied Deduction to Salary: </label>
                                                                <input class="form-control" type="checkbox" name="txt_applied" id="txt_applied" value="1">
                                                            </div>
                                                            <div class="form-group col-xs-12 show_hid" style="visibility: hidden;">
                                                                <label for="">Remark:</label>
                                                                <textarea class="form-control" type="text" name="txt_remark" id="" cols="30" rows="2"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer col-md-12">
                                                    <button name="btnadd" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end add new -->

                    <!-- edit -->
                    <div class="modal fade" id="myModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input class="hidden" type="text" name="emp_loan_payment_id" id="emp_loan_payment_id">
                                            <div class="form-group col-xs-6">
                                                <label for="">Loan Request No:</label>
                                                <input class="form-control" type="text" name="edit_request_no" id="edit_request_no">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Total Loan:</label>
                                                <input class="form-control" type="text" name="edit_total_loan" id="edit_total_loan">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Amount to Pay:</label>
                                                <input class="form-control" type="text" name="edit_amount_to_pay" id="edit_amount_to_pay">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Payment Date:</label>
                                                <input class="form-control" type="date" name="edit_payment_date" id="edit_payment_date">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Total Paid Loan:</label>
                                                <input class="form-control" type="text" name="edit_total_paid_loan" id="edit_total_paid_loan">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Loan Balance:</label>
                                                <input class="form-control" type="text" name="edit_loan_balance" id="edit_loan_balance">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Status</label>
                                                <select class="form-control select2" name="edit_status" id="edit_status">
                                                    <option value="">===Select===</option>
                                                    <?php
                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM text_employee_loan_payment_status ORDER BY lps_name ASC");
                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                    ?>
                                                        <option value="<?php echo $row['lps_id'] ?>"><?php echo $row['lps_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Input By</label>
                                                <select class="form-control select2" name="edit_user" id="edit_user">
                                                    <option value="">===Select===</option>
                                                    <?php
                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Applied Deduction to Salary: </label>
                                                <input class="form-control" type="checkbox" name="edit_applied" id="edit_applied" value="1">
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label for="">Remark:</label>
                                                <textarea class="form-control" type="text" name="edit_note" id="edit_note" cols="30" rows="2"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end edit -->
                    <div class="col-xs-12 connectedSortable">
                        <div class="box border">
                            <table id="info_data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Job_Id</th>
                                        <th>Employee Info</th>
                                        <th>Company Info</th>
                                        <th>Total Loan</th>
                                        <th>Amount To Pay</th>
                                        <th>Total Paid Loan</th>
                                        <th>Laon Balance</th>
                                        <th>Payment Date</th>
                                        <th>Status</th>
                                        <th>Input By</th>
                                        <th>Note</th>
                                        <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM employee_loan_payment A 
                                            LEFT JOIN employee_registration B on B.er_id=A.elp_job_id
                                            LEFT JOIN gender C on C.ge_id=B.er_gender_id
                                            LEFT JOIN position D on D.position_id=B.er_position_id
                                            LEFT JOIN company E on E.c_id=B.er_company_id
                                            LEFT JOIN user_branch F on F.ub_id=B.er_branch_id
                                            LEFT JOIN department G on G.de_id=B.er_department_id
                                            LEFT JOIN user H on H.id=A.elp_user_id
                                            LEFT JOIN text_employee_loan_payment_status I on I.lps_id=A.elp_status_id
                                            ";
                                    $result = $connect->query($sql);
                                    // $row=$result->fetch_assoc();
                                    // echo $row['ef_date'];
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_job_id = $row["er_job_id"];
                                        $v_name_kh = $row["er_name_kh"];
                                        $v_gender_id = $row["ge_name"];
                                        $v_position_id = $row["position"];
                                        $v_company_id = $row["c_name_kh"];
                                        $v_branch_id = $row["ub_name"];
                                        $v_department_id = $row["de_name"];
                                        $v_user_id = $row["username"];
                                        $v_total_loan = $row["elp_total_loan"];
                                        $v_amount_to_pay = $row["elp_amount_to_pay"];
                                        $v_total_paid_loan = $row["elp_total_paid_loan"];
                                        $v_loan_balance = $row["elp_loan_balance"];
                                        $v_payment_date = $row["elp_payment_date"];
                                        $v_status_id = $row["lps_name"];
                                        $v_note = $row["elp_note"];
                                    ?>
                                        <tr>
                                            <td><?php echo $v_i; ?></td>
                                            <td><?php echo $v_job_id; ?></td>
                                            <td>
                                                <i>Name: </i><?php echo $v_name_kh; ?><br>
                                                <i>Sex: </i><?php echo $v_gender_id; ?><br>
                                                <i>Position: </i><?php echo $v_position_id; ?>
                                            </td>
                                            <td>
                                                <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                                <i>Branch: </i><?php echo $v_branch_id; ?> <br>
                                                <i>Department: </i><?php echo $v_department_id; ?>
                                            </td>
                                            <td><?php echo $v_total_loan; ?>$</td>
                                            <td><?php echo $v_amount_to_pay; ?>$</td>
                                            <td><?php echo $v_total_paid_loan; ?>$</td>
                                            <td><?php echo $v_loan_balance; ?>$</td>
                                            <td><?php echo $v_payment_date; ?></td>
                                            <td><?php echo $v_status_id; ?></td>
                                            <td>
                                                <i>Input by: </i><?php echo $v_user_id; ?><br>
                                                <i>Date: </i><?php echo $datetime; ?>
                                            </td>
                                            <td><?php echo $v_note; ?></td>
                                            <td>
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['elp_id']; ?>',
                                                                    '<?php echo $row['elp_loan_request_no']; ?>',
                                                                    '<?php echo $v_total_loan; ?>',
                                                                    '<?php echo $v_amount_to_pay; ?>',
                                                                    '<?php echo $v_payment_date; ?>',
                                                                    '<?php echo $v_total_paid_loan; ?>',
                                                                    '<?php echo $v_loan_balance; ?>',
                                                                    '<?php echo $row['elp_status_id']; ?>',
                                                                    '<?php echo $row['elp_user_id']; ?>',
                                                                    '<?php echo $row['elp_applied_deduction_to_salary']; ?>',
                                                                    '<?php echo $v_note; ?>'
                                                                    )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="employee_loan_payment.php?del_id=<?php echo $row['elp_id']; ?>" class="btn btn-danger btn-sm">
                                                    <i style="color:white;" class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>

                        </div>

                    </div>


                </div>

            </section>


        </aside>
        <div>

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
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

            <!-- page script -->
            <script type="text/javascript">
                function doUpdate(id, request_no, total_loan, amount_to_pay, payment_date, total_paid_loan, loan_balance, status, user, applied, note) {
                    $('#emp_loan_payment_id').val(id);
                    $('#edit_request_no').val(request_no);
                    $('#edit_total_loan').val(total_loan);
                    $('#edit_amount_to_pay').val(amount_to_pay);
                    $('#edit_payment_date').val(payment_date);
                    $('#edit_total_paid_loan').val(total_paid_loan);
                    $('#edit_loan_balance').val(loan_balance);
                    $('#edit_status').val(status);
                    $('#edit_user').val(user);
                    $('#edit_applied').val(applied);
                    $('#edit_note').val(note);
                }

                $('#txt_job_id').change(function() {
                    $('.show_hid').css("visibility", "visible");
                    var job_id = $("#txt_job_id").val();
                    if (job_id) {
                        $.ajax({
                            type: 'POST',
                            url: 'fecth_emp_loan_payment.php',
                            data: {
                                'emp_loan_payment_id': job_id
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
                    $("select").selectpicker();
                    $("#menu_salary").addClass("active");
                    $("#staff_loan").addClass("active");
                    $("#staff_loan").css("background-color", "##367fa9");
                    $('#info_data').dataTable();
                });
            </script>

</body>

</html>