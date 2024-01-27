<?php
include '../config/db_connect.php';


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
   <style>
      @media print {
         #medaiprint {
            display: none !important;
         }
      }
   </style>
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

         </div>
         <section class="content-header">
            <h1>
               Employee Profile
            </h1>
         </section>

         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <!-- Modal -->

                        <!-- Modal -->
                        <!-- Modal Update-->

                        <!-- Modal Update-->

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-hover table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th style="vertical-align: middle; text-align: center; ">No.</th>
                                    <th style="vertical-align: middle; text-align: center; ">Job ID </th>
                                    <th style="vertical-align: middle; text-align: center; ">Name KH</th>
                                    <th style="vertical-align: middle; text-align: center; ">Name EN</th>
                                    <th style="vertical-align: middle; text-align: center; ">Gender</th>
                                    <th style="vertical-align: middle; text-align: center; ">Current Position</th>
                                    <th style="vertical-align: middle; text-align: center; ">Current Salary</th>
                                    <th style="vertical-align: middle; text-align: center; ">Current Branch</th>
                                    <th style="vertical-align: middle; text-align: center; ">Current Department</th>
                                    <th style="vertical-align: middle; text-align: center; ">Current Company</th>
                                    <th style="vertical-align: middle; text-align: center; ">View Detail</th>

                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM employee_registration 
                                         LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id
                                         LEFT JOIN position ON position.position_id = employee_registration.er_position_id
                                         LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                         LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                         LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id
                                         ";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row['er_name_kh'];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position = $row["position"];
                                    $v_er_salary = $row["er_salary"];
                                    $v_ub_name = $row["ub_name"];
                                    $v_de_name = $row["de_name"];
                                    $v_c_name_en = $row["c_name_en"];


                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_job_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_name_kh; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_name_en; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_gender_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_position; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_salary; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_ub_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_de_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_c_name_en; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a style="color: black;" class="btn btn-info btn-sm" href="report_employee_profile_view.php?id=<?php echo $row['er_id']; ?>"><i class="fa fa-eye"></i></a>
                                          <a href="report_employee_profile_print.php?id=<?php echo $row['er_id']; ?>" class="btn btn-success btn-sm btn_do_print"><i class="fa fa-print"></i></a>
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
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


   <script type="text/javascript">
      $(function() {
         $("select").selectpicker();
         $("#menu_report").addClass("active");
         $("#employee_profile").addClass("active");
         $("#employee_profile").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });

      function printPage(id) {
         var table = document.createElement("table");
         var row = table.insertRow();
         var cell1 = row.insertCell();
         cell1.textContent = id;
         var tableContainer = document.getElementById("datatable");
         tableContainer.appendChild(table);
         window.print(tableContainer);
         document.getElementById("body").innerHTML;
         var body = document.getElementById("dataPrint").innerHTML;
      }
   </script>
</body>

</html>