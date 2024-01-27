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
   $sql = "DELETE FROM loan_schedule where ls_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:loan_payment_schedule.php?message=delete'));
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
            <h1 class="text-primary">Employee Loan Balance
               <h1>
         </section>
         <section class="content">
            <div class="row">

               <div class="col-xs-12 connectedSortable">
                  <div class="box border">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Job Id</th>
                              <th>Employee Info</th>
                              <th>Compnay Info</th>
                              <th>Loan Request NO</th>
                              <th>Loan Amount</th>
                              <th>Loan Rate</th>
                              <th>Total Loan and Interest</th>
                              <th>Total Repayment</th>
                              <th>Loan Balance</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM loan_request A 
                                            LEFT JOIN employee_registration C on C.er_id=A.lr_job_id
                                            LEFT JOIN gender D on D.ge_id=C.er_gender_id
                                            LEFT JOIN position E on E.position_id=C.er_position_id
                                            LEFT JOIN company F on F.c_id=C.er_company_id
                                            LEFT JOIN user_branch G on G.ub_id=C.er_branch_id
                                            LEFT JOIN department H on H.de_id=C.er_department_id
                                            LEFT JOIN user I on I.id=A.lr_user_id
                                            ";
                           $result = $connect->query($sql);
                           $i = 1;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_job_id = $row["er_job_id"];
                              $v_name_kh = $row["er_name_kh"];
                              $v_gender_id = $row["ge_name"];
                              $v_position_id = $row["position"];
                              $v_company_id = $row["c_name_kh"];
                              $v_ub_id = $row["ub_name"];
                              $v_department_id = $row["de_name"];
                              $v_id = $row["username"];
                              $v_request_no = $row["lr_request_no"];
                              $v_loan_amount = $row["lr_loan_amount"];
                              $v_loan_rate = $row["lr_loan_rate"];
                           ?>
                              <tr>
                                 <td><?php echo $v_i; ?></td>
                                 <td><?php echo $v_job_id; ?></td>
                                 <td>
                                    <i>Name: </i><?php echo $v_name_kh; ?> <br>
                                    <i>Sex: </i><?php echo $v_gender_id; ?> <br>
                                    <i>Position: </i><?php echo $v_position_id; ?>
                                 </td>
                                 <td>
                                    <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                    <i>Branch: </i><?php echo $v_ub_id; ?> <br>
                                    <i>Department: </i> <?php echo $v_department_id; ?> <br>
                                 </td>
                                 <td>
                                    <a style="text-decoration: underline;" target="_blank" href="employee_loan_balance_print.php?id=<?php echo $row['lr_id']; ?>">
                                       <?php echo $v_request_no; ?>
                                    </a>
                                 </td>
                                 <td><?php echo $v_loan_amount; ?>$</td>
                                 <td><?php echo $v_loan_rate; ?>%</td>
                                 <td>
                                    <?php
                                    $v_id = $row['lr_id'];
                                    $sql_total_loan_inter = "SELECT * FROM loan_request WHERE lr_id=$v_id";
                                    $result_total_loan_inter = $connect->query($sql_total_loan_inter);
                                    $row_total_loan_inter = $result_total_loan_inter->fetch_assoc();
                                    $get_total_loan_interest = $row['lr_total_loan_interest'];
                                    echo $get_total_loan_interest;
                                    ?>$
                                 </td>
                                 <td>
                                    <?php
                                    $v_id = $row['lr_id'];
                                    $sql_total_month_pay = "SELECT * FROM loan_request WHERE lr_id=$v_id";
                                    $result_total_month_pay = $connect->query($sql_total_month_pay);
                                    $row_total_month_pay = $result_total_month_pay->fetch_assoc();
                                    $get_total_motnhly_payment = $row['lr_total_monthly_payment'];
                                    echo $get_total_motnhly_payment;
                                    ?>$
                                 </td>
                                 <td>
                                    <?php
                                    $get_loan_balance = $get_total_loan_interest - $get_total_motnhly_payment;
                                    echo $get_loan_balance;
                                    ?>$
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
         function doUpdate(id, start_date, end_date, repayment_date, user, note) {
            $('#loan_schedule_id').val(id);
            $('#edit_start_date').val(start_date);
            $('#edit_end_date').val(end_date);
            $('#edit_repayment_date').val(repayment_date);
            $('#edit_user').val(user).change();
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
            $("select").selectpicker();
            $("#menu_loan").addClass("active");
            $("#loan_balance").addClass("active");
            $("#loan_balance").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>

</body>

</html>