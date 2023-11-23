<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];
   $sql = "DELETE FROM payroll where pr_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:payroll.php?message=delete'));
}
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_POST["btnadd"])) {
   $v_txt_job_id = $_POST["txt_job_id"];
   $txt_month_year = $_POST["txt_month_year"];
   $txt_total_day_of_month = $_POST["txt_total_day_of_month"];
   $txt_start_date = $_POST["txt_start_date"];
   $txt_end_date = $_POST["txt_end_date"];
   $txt_working_fee_per_day = $_POST["txt_working_fee_per_day"];
   $txt_permission_paid = $_POST["txt_permission_paid"];
   $txt_permission_unpaid = $_POST["txt_permission_unpaid"];
   $txt_absent = $_POST["txt_absent"];
   $txt_att_working_days = $_POST["txt_att_working_days"];
   $txt_punishment = $_POST["txt_punishment"];
   $txt_total_roll_to_pay_amount = $_POST["txt_total_roll_to_pay_amount"];
   $txt_payment_date = $_POST["txt_payment_date"];
   $txt_status = $_POST["txt_status"];
   $txt_user = $_POST["txt_user"];
   $txt_remark = $_POST["txt_remark"];
   $datetime = date('Y-m-d H:i:s');

   $sql = "INSERT INTO payroll
                        (
                            pr_job_id,
                            pr_month_year_id,
                            pr_total_day_of_month,
                            pr_start_date,
                            pr_end_date,
                            pr_working_fee_per_day,
                            pr_leave_permission_paid,
                            pr_leave_permission_unpaid,
                            pr_leave_absent,
                            pr_att_working_days,
                            pr_punishment,
                            pr_total_roll_to_pay_amount,
                            pr_payment_date,
                            pr_status_id,
                            pr_user_id,
                            pr_note,
                            pr_created_at
                        )
                    VALUES
                        (
                            '$v_txt_job_id',
                            '$txt_month_year',
                            '$txt_total_day_of_month',
                            '$txt_start_date',
                            '$txt_end_date',
                            '$txt_working_fee_per_day',
                            '$txt_permission_paid',
                            '$txt_permission_unpaid',
                            '$txt_absent',
                            '$txt_att_working_days',
                            '$txt_punishment',
                            '$txt_total_roll_to_pay_amount',
                            '$txt_payment_date',
                            '$txt_status',
                            '$txt_user',
                            '$txt_remark',
                            '$datetime'
                        )
                        ";
   $result = mysqli_query($connect, $sql);
   header('location: payroll.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["payroll_id"];
   $edit_month_year_id = $_POST["edit_month_year_id"];
   $edit_total_day_of_month = $_POST["edit_total_day_of_month"];
   $edit_start_date = $_POST["edit_start_date"];
   $edit_end_date = $_POST["edit_end_date"];
   $edit_working_fee_per_day = $_POST["edit_working_fee_per_day"];
   $edit_permission_paid = $_POST["edit_permission_paid"];
   $edit_permission_unpaid = $_POST["edit_permission_unpaid"];
   $edit_absent = $_POST["edit_absent"];
   $edit_att_working_days = $_POST["edit_att_working_days"];
   $edit_punishment = $_POST["edit_punishment"];
   $edit_total_roll_to_pay_amount = $_POST["edit_total_roll_to_pay_amount"];
   $edit_payment_date = $_POST["edit_payment_date"];
   $edit_status_id = $_POST["edit_status_id"];
   $edit_user_id = $_POST["edit_user_id"];
   $edit_note = $_POST["edit_note"];

   $sql = "UPDATE payroll SET
                        pr_month_year_id = '$edit_month_year_id',
                        pr_total_day_of_month = '$edit_total_day_of_month',
                        pr_start_date = '$edit_start_date',
                        pr_end_date = '$edit_end_date',
                        pr_working_fee_per_day = '$edit_working_fee_per_day',
                        pr_leave_permission_paid = '$edit_permission_paid',
                        pr_leave_permission_unpaid = '$edit_permission_unpaid',
                        pr_leave_absent = '$edit_absent',
                        pr_att_working_days = '$edit_att_working_days',
                        pr_punishment = '$edit_punishment',
                        pr_total_roll_to_pay_amount = '$edit_total_roll_to_pay_amount',
                        pr_payment_date = '$edit_payment_date',
                        pr_status_id = '$edit_status_id',
                        pr_user_id = '$edit_user_id',
                        pr_note = '$edit_note'
                        WHERE pr_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:payroll.php?message=update');
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
            <h1 class="text-primary">Payroll<h1>
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
                           <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> New Payroll</h3>
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
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="ot-type">Month-Year:</label>
                                                <select class="form-control select2" name="txt_month_year" id="">
                                                   <option value=""></option>
                                                   <?php
                                                   $v_sellect = mysqli_query($connect, "SELECT * FROM text_payroll_month_year ORDER BY my_name ASC");
                                                   while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                   ?>
                                                      <option value="<?php echo $row['my_id'] ?>"><?php echo $row['my_name'] ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Total Day of Month:</label>
                                                <input class="form-control" type="text" name="txt_total_day_of_month" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Start Date:</label>
                                                <input class="form-control" type="date" name="txt_start_date" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">End Date:</label>
                                                <input class="form-control" type="date" name="txt_end_date" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Working Fee Per Day:</label>
                                                <input class="form-control" type="text" name="txt_working_fee_per_day" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Leave Permission Paid:</label>
                                                <input class="form-control" type="text" name="txt_permission_paid" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Leave Permission Unpaid:</label>
                                                <input class="form-control" type="text" name="txt_permission_unpaid" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Leave Absent:</label>
                                                <input class="form-control" type="text" name="txt_absent" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">ATT. Working Days:</label>
                                                <input class="form-control" type="text" name="txt_att_working_days" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Punishment:</label>
                                                <input class="form-control" type="text" name="txt_punishment" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Total Roll To Pay Amount:</label>
                                                <input class="form-control" type="text" name="txt_total_roll_to_pay_amount" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Payment Date:</label>
                                                <input class="form-control" type="date" name="txt_payment_date" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Status</label>
                                                <select class="form-control select2" name="txt_status" id="">
                                                   <option value=""></option>
                                                   <?php
                                                   $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_roll_status ORDER BY prs_name ASC");
                                                   while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                   ?>
                                                      <option value="<?php echo $row['prs_id'] ?>"><?php echo $row['prs_name'] ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="ot-type">Input By</label>
                                                <select class="form-control select2" name="txt_user" id="">
                                                   <option value=""></option>
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
                                             <div class="form-group col-xs-12 show_hid" style="display: none;">
                                                <label for="">Remark:</label>
                                                <textarea class="form-control" type="text" name="txt_remark" id=""></textarea>
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
               <!-- modal edit -->
               <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                 <input class="hidden" type="text" name="payroll_id" id="payroll_id">
                                 <div class="form-group col-xs-6">
                                    <label for="ot-type">Month-Year:</label>
                                    <select class="form-control select2" name="edit_month_year_id" id="edit_month_year_id">
                                       <option value=""></option>
                                       <?php
                                       $v_sellect = mysqli_query($connect, "SELECT * FROM text_payroll_month_year ORDER BY my_name ASC");
                                       while ($row = mysqli_fetch_assoc($v_sellect)) {
                                       ?>
                                          <option value="<?php echo $row['my_id'] ?>"><?php echo $row['my_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Total Day of Month:</label>
                                    <input class="form-control" type="text" name="edit_total_day_of_month" id="edit_total_day_of_month">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Start Date:</label>
                                    <input class="form-control" type="date" name="edit_start_date" id="edit_start_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">End Date:</label>
                                    <input class="form-control" type="date" name="edit_end_date" id="edit_end_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Working Fee Per Day:</label>
                                    <input class="form-control" type="text" name="edit_working_fee_per_day" id="edit_working_fee_per_day">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Leave Permission Paid:</label>
                                    <input class="form-control" type="text" name="edit_permission_paid" id="edit_permission_paid">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Leave Permission Unpaid:</label>
                                    <input class="form-control" type="text" name="edit_permission_unpaid" id="edit_permission_unpaid">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Leave Absent:</label>
                                    <input class="form-control" type="text" name="edit_absent" id="edit_absent">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">ATT. Working Days:</label>
                                    <input class="form-control" type="text" name="edit_att_working_days" id="edit_att_working_days">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Punishment:</label>
                                    <input class="form-control" type="text" name="edit_punishment" id="edit_punishment">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Total Roll To Pay Amount:</label>
                                    <input class="form-control" type="text" name="edit_total_roll_to_pay_amount" id="edit_total_roll_to_pay_amount">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Payment Date:</label>
                                    <input class="form-control" type="date" name="edit_payment_date" id="edit_payment_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Status</label>
                                    <select class="form-control select2" name="edit_status_id" id="edit_status_id">
                                       <option value=""></option>
                                       <?php
                                       $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_roll_status ORDER BY prs_name ASC");
                                       while ($row = mysqli_fetch_assoc($v_sellect)) {
                                       ?>
                                          <option value="<?php echo $row['prs_id'] ?>"><?php echo $row['prs_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="ot-type">Input By</label>
                                    <select class="form-control select2" name="edit_user_id" id="edit_user_id">
                                       <option value=""></option>
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
                                 <div class="form-group col-xs-12">
                                    <label for="">Remark:</label>
                                    <textarea class="form-control" type="text" name="edit_note" id="edit_note"></textarea>
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
                  <div class="box border">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Job_Id</th>
                              <th>Employee Info</th>
                              <th>Company Info</th>
                              <th>Month-Yeat</th>
                              <th>ATT.Working Days</th>
                              <th>Punishment</th>
                              <th>Total Roll To Pay Amount</th>
                              <th>Payment Date</th>
                              <th>Status</th>
                              <th>Input By</th>
                              <th>Note</th>
                              <th class="text-center" style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM payroll A
                                            LEFT JOIN employee_registration B on B.er_id=A.pr_job_id 
                                            LEFT JOIN gender C on C.ge_id=B.er_gender_id
                                            LEFT JOIN position D on D.position_id=B.er_position_id
                                            LEFT JOIN company E on E.c_id=B.er_company_id
                                            LEFT JOIN user_branch F on F.ub_id=B.er_branch_id
                                            LEFT JOIN department G on G.de_id=B.er_department_id
                                            LEFT JOIN user H on H.id=A.pr_user_id
                                            LEFT JOIN text_payroll_month_year I on I.my_id=A.pr_month_year_id
                                            LEFT JOIN text_pay_roll_status J on J.prs_id=A.pr_status_id
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
                              $v_month_year_id = $row["my_name"];
                              $v_att_working_days = $row["pr_att_working_days"];
                              $v_punishment = $row["pr_punishment"];
                              $v_total_roll_to_pay_amount = $row["pr_total_roll_to_pay_amount"];
                              $v_payment_date = $row["pr_payment_date"];
                              $v_status_id = $row["prs_name"];
                              $v_note = $row["pr_note"];
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
                                    <i>Department: </i><?php echo $v_department_id; ?> <br>
                                 </td>
                                 <td><?php echo $v_month_year_id; ?></td>
                                 <td><?php echo $v_att_working_days; ?>Days</td>
                                 <td><?php echo $v_punishment; ?>$</td>
                                 <td><?php echo $v_total_roll_to_pay_amount; ?>$</td>
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
                                                                    '<?php echo $row['pr_id']; ?>',
                                                                    '<?php echo $row['pr_month_year_id']; ?>',
                                                                    '<?php echo $row['pr_total_day_of_month']; ?>',
                                                                    '<?php echo $row['pr_start_date']; ?>',
                                                                    '<?php echo $row['pr_end_date']; ?>',
                                                                    '<?php echo $row['pr_working_fee_per_day']; ?>',
                                                                    '<?php echo $row['pr_leave_permission_paid']; ?>',
                                                                    '<?php echo $row['pr_leave_permission_unpaid']; ?>',
                                                                    '<?php echo $row['pr_leave_absent']; ?>',
                                                                    '<?php echo $row['pr_att_working_days']; ?>',
                                                                    '<?php echo $row['pr_punishment']; ?>',
                                                                    '<?php echo $row['pr_total_roll_to_pay_amount']; ?>',
                                                                    '<?php echo $row['pr_payment_date']; ?>',
                                                                    '<?php echo $row['pr_status_id']; ?>',
                                                                    '<?php echo $row['pr_user_id']; ?>',
                                                                    '<?php echo $row['pr_note']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="payroll.php?del_id=<?php echo $row['pr_id']; ?>" class="btn btn-danger btn-sm">
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
         function doUpdate(id, month_year_id, total_day_of_month, start_date, end_date, working_fee_per_day, permission_paid, permission_unpaid, absent, att_working_days, punishment, total_roll_to_pay_amount, payment_date, status_id, user_id, note) {
            $('#payroll_id').val(id);
            $('#edit_month_year_id').val(month_year_id).change();
            $('#edit_total_day_of_month').val(total_day_of_month);
            $('#edit_start_date').val(start_date);
            $('#edit_end_date').val(end_date);
            $('#edit_working_fee_per_day').val(working_fee_per_day);
            $('#edit_permission_paid').val(permission_paid);
            $('#edit_permission_unpaid').val(permission_unpaid);
            $('#edit_absent').val(absent);
            $('#edit_att_working_days').val(att_working_days);
            $('#edit_punishment').val(punishment);
            $('#edit_total_roll_to_pay_amount').val(total_roll_to_pay_amount);
            $('#edit_payment_date').val(payment_date);
            $('#edit_status_id').val(status_id).change();
            $('#edit_user_id').val(user_id).change();
            $('#edit_note').val(note);
         }
         $('#txt_job_id').change(function() {
            $('.show_hid').css("display", "block");
            var job_id = $("#txt_job_id").val();
            if (job_id) {
               $.ajax({
                  type: 'POST',
                  url: 'fetch_payroll.php',
                  data: {
                     'payroll_job_id': job_id
                  },
                  success: function(html) {
                     $('#amount_data').html(html);
                  }
               });
            }
         });
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
            $("#pay_roll").addClass("active");
            $("#pay_roll").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>

</body>

</html>