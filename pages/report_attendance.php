<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_name = $_POST["txt_name"];

   $sql = "INSERT INTO text_working_report_status  
                        ( twrs_name ) 
                  VALUES 
                  ('$v_name')";
                  
   $result = mysqli_query($connect, $sql);
   header('location:status_working_report.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["edit_twrs_id"];
   $v_name = $_POST["edit_name"];

   $sql = "UPDATE text_working_report_status SET twrs_name = '$v_name'
                                          WHERE twrs_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:status_working_report.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM text_working_report_status WHERE twrs_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: status_working_report.php?message=delete");
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
   <?php
   include "title_icon.php";
   ?>
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
               Attendance_Report
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
                                             <label>Job ID</label>
                                             <input class="form-control" id="txt_job_id" name="txt_job_id" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Company</label>
                                             <input class="form-control" id="txt_company" name="txt_company" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Branch</label>
                                             <input class="form-control" id="txt_branch" name="txt_branch" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Department</label>
                                             <input class="form-control" id="txt_department" name="txt_job_id" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Date</label>
                                             <input class="form-control" id="txt_date" name="txt_date" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>from</label>
                                             <input class="form-control" id="txt_from" name="txt_from" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>To</label>
                                             <input class="form-control" id="txt_to" name="txt_to" type="text">
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

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th rowspan="2" style="margin: auto;">No</th>
                                    <th rowspan="2" style="margin: auto;">Job ID</th>
                                    <th rowspan="2" style="margin: auto;">Name</th>
                                    <th rowspan="2" style="margin: auto;">Gender</th>
                                    <th rowspan="2" style="margin: auto;">Current Position</th>
                                    <th colspan="2">Annual Leave</th>
                                    <th colspan="2">Sick Leave</th>
                                    <th colspan="2">Maturity Leave</th>
                                    <th colspan="2">Special Leave</th>
                                    <th rowspan="2">Unpaid Leave</th>
                                    <th rowspan="2">Late</th>
                                    <th rowspan="2">Action</th>
                                 </tr>
                                 <tr>
                                    <th>User</th>
                                    <th>Balance</th>
                                    <th>User</th>
                                    <th>Balance</th>
                                    <th>User</th>
                                    <th>Balance</th>
                                    <th>User</th>
                                    <th>Balance</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM employee_registration
                                            LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id
                                            LEFT JOIN position ON position.position_id = employee_registration.er_gender_id
                                            LEFT JOIN user ON user.id = employee_registration.er_gender_id
                                            LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_gender_id
                                            ";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_er_id = $row["er_id"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_ge_name = $row["ge_name"];
                                    $v_position = $row["position"];
                                    $v_id = $row["id"];
                                    $v_ub_id = $row["ub_id"];
                                    $v_Unpaid_Leave = $row["Unpaid_Leave"];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td><?php echo $v_er_id; ?></td>
                                       <td><?php echo $v_er_name_en; ?></td>
                                       <td><?php echo $v_ge_name; ?></td>
                                       <td><?php echo $v_position; ?></td>
                                       <td><?php echo $v_id; ?></td>
                                       <td><?php echo $v_ub_id; ?></td>
                                       <td><?php echo $v_id; ?></td>
                                       <td><?php echo $v_ub_id; ?></td>
                                       <td><?php echo $v_id; ?></td>
                                       <td><?php echo $v_ub_id; ?></td>
                                       <td><?php echo $v_id; ?></td>
                                       <td><?php echo $v_ub_id; ?></td>
                                       <td><?php echo $v_Unpaid_Leave; ?></td>
                                       <td><?php echo $v_Unpaid_Leave; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a style="color: black;" class="btn btn-info btn-sm" href="view_report_attendance.php"><i class="fa fa-eye"></i></a>
                                          <a id="medaiprint" style="color: white;" onclick="window.print();" class="btn btn-sm btn-success" href=""><i class="fa fa-print"></i></a>
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
      function doUpdate(twrs_id, twrs_name) {
         $('#edit_twrs_id').val(twrs_id);
         $('#edit_name').val(twrs_name);
      }

      $(function() {
         $("#menu_setting").addClass("active");
         $("#status_working_report").addClass("active");
         $("#status_working_report").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>