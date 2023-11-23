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
    $sql = "DELETE FROM pay_nssf where pn_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header(('location:pay_nssf.php?message=delete'));
}

if (isset($_POST["btnadd"])) {
    $v_txt_job_id = $_POST["txt_job_id"];
    $v_txt_nssf_card_no = $_POST["txt_nssf_card_no"];
    $v_txt_monthly_exchange_rate = $_POST["txt_monthly_exchange_rate"];
    $v_txt_tax_salary = $_POST["txt_tax_salary"];
    $v_txt_tax_salary_in_khr = $_POST["txt_tax_salary_in_khr"];
    $v_txt_health_risk_rate = $_POST["txt_health_risk_rate"];
    $v_txt_working_risk_rate = $_POST["txt_working_risk_rate"];
    $v_txt_health_risk = $_POST["txt_health_risk"];
    $v_txt_working_risk = $_POST["txt_working_risk"];
    $v_txt_total_nssf_amount = $_POST["txt_total_nssf_amount"];
    $v_txt_remark = $_POST["txt_remark"];
    $datetime = date('Y-m-d H:i:s');
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];


    $sql = "INSERT INTO pay_nssf
                        (
                            pn_job_id,
                            pn_nssf_card_no,
                            pn_monthly_exchange_rate,
                            pn_tax_salary,
                            pn_tax_salary_in_khr,
                            pn_health_risk_rate,
                            pn_work_risk_rate,
                            pn_heath_risk,
                            pn_working_risk,
                            pn_total_nssf_amount,
                            pn_note,
                            created_at,
                            pn_user_id
                        )
                    VALUES
                        (
                            '$v_txt_job_id',
                            '$v_txt_nssf_card_no',
                            '$v_txt_monthly_exchange_rate',
                            '$v_txt_tax_salary',
                            '$v_txt_tax_salary_in_khr',
                            '$v_txt_health_risk_rate',
                            '$v_txt_working_risk_rate',
                            '$v_txt_health_risk',
                            '$v_txt_working_risk',
                            '$v_txt_total_nssf_amount',
                            '$v_txt_remark',
                            '$datetime',
                            '$user_id'
                        )
                        ";
    $result = mysqli_query($connect, $sql);
    header('location: pay_nssf.php?message=success');
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["pay_nssf_id"];
    $edit_nssf_card_no = $_POST["edit_nssf_card_no"];
    $edit_monthly_exchange_rate = $_POST["edit_monthly_exchange_rate"];
    $edit_tax_salary = $_POST["edit_tax_salary"];
    $edit_tax_salary_in_khr = $_POST["edit_tax_salary_in_khr"];
    $edit_health_risk_rate = $_POST["edit_health_risk_rate"];
    $edit_work_risk_rate = $_POST["edit_work_risk_rate"];
    $edit_heath_risk = $_POST["edit_heath_risk"];
    $edit_working_risk = $_POST["edit_working_risk"];
    $edit_total_nssf_amount = $_POST["edit_total_nssf_amount"];
    $edit_note = $_POST["edit_note"];


    $sql = "UPDATE pay_nssf SET
                        pn_nssf_card_no = '$edit_nssf_card_no',
                        pn_monthly_exchange_rate = '$edit_monthly_exchange_rate',
                        pn_tax_salary = '$edit_tax_salary',
                        pn_tax_salary_in_khr = '$edit_tax_salary_in_khr',
                        pn_health_risk_rate = '$edit_health_risk_rate',
                        pn_work_risk_rate = '$edit_work_risk_rate',
                        pn_heath_risk = '$edit_heath_risk',
                        pn_working_risk = '$edit_working_risk',
                        pn_total_nssf_amount = '$edit_total_nssf_amount',
                        pn_note = '$edit_note'
                        WHERE pn_id = $id";
    $result = mysqli_query($connect, $sql);
    header('location:pay_nssf.php?message=update');
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
                <h1 class="text-primary">Pay NSSF<h1>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            Add New
                        </button>
            </section>
            <section class="content">
                <div class="row">
                    <!-- Modal Add New -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: 900px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> Pay New NSSF</h3>
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
                                                                <label for="">NSSF Card No:</label>
                                                                <input class="form-control" type="text" name="txt_nssf_card_no" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Monthly Exchange Rate:</label>
                                                                <input class="form-control" type="text" name="txt_monthly_exchange_rate" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Tax Salary:</label>
                                                                <input class="form-control" type="text" name="txt_tax_salary" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Tax Salary In KHR:</label>
                                                                <input class="form-control" type="text" name="txt_tax_salary_in_khr" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Health Risk Rate:</label>
                                                                <input class="form-control" type="text" name="txt_health_risk_rate" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Working Risk Rate:</label>
                                                                <input class="form-control" type="text" name="txt_working_risk_rate" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Health Risk:</label>
                                                                <input class="form-control" type="text" name="txt_health_risk" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Working Risk:</label>
                                                                <input class="form-control" type="text" name="txt_working_risk" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Total NSSF Amount:</label>
                                                                <input class="form-control" type="text" name="txt_total_nssf_amount" id="">
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
                    <!--End modal Add New-->

                    <!--modal edit-->

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
                                            <input class="hidden" type="text" name="pay_nssf_id" id="pay_nssf_id">
                                            <div class="form-group col-xs-6">
                                                <label for="">NSSF Card No:</label>
                                                <input class="form-control" type="text" name="edit_nssf_card_no" id="edit_nssf_card_no">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Monthly Exchange Rate:</label>
                                                <input class="form-control" type="text" name="edit_monthly_exchange_rate" id="edit_monthly_exchange_rate">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Tax Salary:</label>
                                                <input class="form-control" type="text" name="edit_tax_salary" id="edit_tax_salary">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Tax Salary In KHR:</label>
                                                <input class="form-control" type="text" name="edit_tax_salary_in_khr" id="edit_tax_salary_in_khr">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Health Risk Rate:</label>
                                                <input class="form-control" type="text" name="edit_health_risk_rate" id="edit_health_risk_rate">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Working Risk Rate:</label>
                                                <input class="form-control" type="text" name="edit_work_risk_rate" id="edit_work_risk_rate">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Health Risk:</label>
                                                <input class="form-control" type="text" name="edit_heath_risk" id="edit_heath_risk">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Working Risk:</label>
                                                <input class="form-control" type="text" name="edit_working_risk" id="edit_working_risk">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Total NSSF Amount:</label>
                                                <input class="form-control" type="text" name="edit_total_nssf_amount" id="edit_total_nssf_amount">
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

                    <div class="col-xs-12 connectedSortable">
                        <div style="margin-top: -2%;" class="box">
                            <table id="info_data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" >No.</th>
                                        <th class="text-center" >Job_Id</th>
                                        <th class="text-center" >NSSF Card No.</th>
                                        <th class="text-center" >Employee Info</th>
                                        <th class="text-center" >Tax Salary</th>
                                        <th class="text-center" >Company Info</th>
                                        <th class="text-center" >Health Risk Rate</th>
                                        <th class="text-center" >Working Risk Rate</th>
                                        <th class="text-center" >Health Risk</th>
                                        <th class="text-center" >Working Risk</th>
                                        <th class="text-center" >Total NSSF Amount</th>
                                        <th class="text-center" >Note</th>
                                        <th class="text-center"  style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM pay_nssf A 
                                            LEFT JOIN employee_registration B on B.er_id=A.pn_job_id
                                            LEFT JOIN gender C on C.ge_id=B.er_gender_id 
                                            LEFT JOIN position D on D.position_id=B.er_position_id
                                            LEFT JOIN company E on E.c_id=B.er_company_id
                                            LEFT JOIN user_branch F on F.ub_id=B.er_branch_id
                                            LEFT JOIN department G on G.de_id=B.er_department_id
                                            ";
                                    $result = $connect->query($sql);
                                    // $row=$result->fetch_assoc();
                                    // echo $row['ef_date'];
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_job_id = $row["er_job_id"];
                                        $v_nssf_card_no = $row["pn_nssf_card_no"];
                                        $v_name_kh = $row["er_name_kh"];
                                        $v_gender_id = $row["ge_name"];
                                        $v_position_id = $row["position"];
                                        $v_tax_salary = $row["pn_tax_salary"];
                                        $v_company_id = $row["c_name_kh"];
                                        $v_branch_id = $row["ub_name"];
                                        $v_department_id = $row["de_name"];
                                        $v_health_risk_rate = $row["pn_health_risk_rate"];
                                        $v_work_risk_rate = $row["pn_work_risk_rate"];
                                        $v_heath_risk = $row["pn_heath_risk"];
                                        $v_working_risk = $row["pn_working_risk"];
                                        $v_total_nssf_amount = $row["pn_total_nssf_amount"];
                                        $v_note = $row["pn_note"];
                                    ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_i; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_job_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_nssf_card_no; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><i>Name: </i><?php echo $v_name_kh; ?> <br> <i>Sex: </i><?php echo $v_gender_id; ?> <br> <i>Position: </i><?php echo $v_position_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_tax_salary; ?>$</td>
                                            <td class="text-center" style="vertical-align: middle;" >
                                                <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                                <i>Branch: </i><?php echo $v_branch_id; ?> <br>
                                                <i>Department: </i><?php echo $v_department_id; ?> <br>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_health_risk_rate; ?>%</td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_work_risk_rate; ?>%</td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_heath_risk; ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_working_risk; ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_total_nssf_amount; ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?php echo $v_note; ?></td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['pn_id']; ?>',
                                                                    '<?php echo $v_nssf_card_no; ?>',
                                                                    '<?php echo $row['pn_monthly_exchange_rate']; ?>',
                                                                    '<?php echo $v_tax_salary; ?>',
                                                                    '<?php echo $row['pn_tax_salary_in_khr']; ?>',
                                                                    '<?php echo $v_health_risk_rate; ?>',
                                                                    '<?php echo $v_work_risk_rate; ?>',
                                                                    '<?php echo $v_heath_risk; ?>',
                                                                    '<?php echo $v_working_risk; ?>',
                                                                    '<?php echo $v_total_nssf_amount; ?>',
                                                                    '<?php echo $v_note; ?>'
                                                                    )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="pay_nssf.php?del_id=<?php echo $row['pn_id']; ?>" class="btn btn-danger btn-sm">
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
                $('#txt_job_id').change(function() {
                    $('.show_hid').css("visibility", "visible");
                    var job_id = $("#txt_job_id").val();
                    if (job_id) {
                        $.ajax({
                            type: 'POST',
                            url: 'fetch_pay_nssf.php',
                            data: {
                                'pay_nssf_job_id': job_id
                            },
                            success: function(html) {
                                $('#amount_data').html(html);
                            }
                        });
                    }
                })

                function doUpdate(id, nssf_card_no, monthly_exchange_rate, tax_salary, tax_salary_in_khr, health_risk_rate, work_risk_rate, heath_risk, working_risk, total_nssf_amount, note) {
                    $('#pay_nssf_id').val(id);
                    $('#edit_nssf_card_no').val(nssf_card_no);
                    $('#edit_monthly_exchange_rate').val(monthly_exchange_rate);
                    $('#edit_tax_salary').val(tax_salary);
                    $('#edit_tax_salary_in_khr').val(tax_salary_in_khr);
                    $('#edit_health_risk_rate').val(health_risk_rate);
                    $('#edit_work_risk_rate').val(work_risk_rate);
                    $('#edit_heath_risk').val(heath_risk);
                    $('#edit_working_risk').val(working_risk);
                    $('#edit_total_nssf_amount').val(total_nssf_amount);
                    $('#edit_note').val(note);
                }

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
                    $("#menu_salary").addClass("active");
                    $("#pay_nssf").addClass("active");
                    $("#pay_nssf").css("background-color", "##367fa9");

                    $('#info_data').dataTable();
                });
            </script>

</body>

</html>