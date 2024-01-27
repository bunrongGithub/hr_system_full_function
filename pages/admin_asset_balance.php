<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
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

      <!-- Right side column. Contains the navbar and content of the page -->
      <aside class="right-side">
         <!-- Content Header (Page header) -->
         <div class="col-xs-12">
         </div>
         <section class="content-header">
            <h1>
               Admin Asset Balance
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
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-responsive table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center" rowspan="2">No</th>
                                    <th class="text-center" colspan="6">Asset In</th>
                                    <th class="text-center" colspan="5">Asset Transfer</th>
                                    <th class="text-center" colspan="4">Asset Broken</th>
                                    <th class="text-center" colspan="4">Replacement</th>
                                    <th class="text-center" colspan="3">Maintenance</th>
                                    <th class="text-center" colspan="3">Depreciation</th>
                                    <th class="text-center" colspan="3">Remaining Balance</th>
                                 </tr>
                                 <tr>
                                    <th style="font-size: 12px;">Asset Code</th>
                                    <th style="font-size: 12px;">Asset Name</th>
                                    <th style="font-size: 12px;">Start Date</th>
                                    <th style="font-size: 12px;">Qty</th>
                                    <th style="font-size: 12px;">Price</th>
                                    <th style="font-size: 12px;">Amount</th>
                                    <!-- asset_in -->
                                    <th style="font-size: 12px;">Transfer No</th>
                                    <th style="font-size: 12px;">Transfer Date</th>
                                    <th style="font-size: 12px;">From </th>
                                    <th style="font-size: 12px;">To </th>
                                    <th style="font-size: 12px;">Qty</th>
                                    <!-- asset_transfer -->
                                    <th style="font-size: 12px;">Broken No</th>
                                    <th style="font-size: 12px;">Broken Date </th>
                                    <th style="font-size: 12px;">Qty</th>
                                    <th style="font-size: 12px;">Amount</th>
                                    <!-- asset_broken  -->
                                    <th style="font-size: 12px;">Replce No</th>
                                    <th style="font-size: 12px;">Replace Date</th>
                                    <th style="font-size: 12px;">Qty </th>
                                    <th style="font-size: 12px;">Amount</th>
                                    <!-- Replacement  -->
                                    <th style="font-size: 12px;">Maintenance No</th>
                                    <th style="font-size: 12px;">Maintenance Date</th>
                                    <th style="font-size: 12px;">Maintenance Fee</th>
                                    <!-- Maintenance -->
                                    <th style="font-size: 12px;">Depre.No</th>
                                    <th style="font-size: 12px;">Depre.Age</th>
                                    <th style="font-size: 12px;">Depre.Amount</th>
                                    <!-- Depreciation  -->
                                    <th style="font-size: 12px;">Qty</th>
                                    <th style="font-size: 12px;">Curren Price</th>
                                    <th style="font-size: 12px;">Total Amount</th>
                                    <!-- Balance -->
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $table_as_in = "admin_asset_in";
                                 $table_as_transfer = "admin_asset_transfer";
                                 $table_as_broken = "admin_asset_broken";
                                 $table_as_replacement = "admin_asset_replacement";
                                 $table_as_maintennace = "admin_asset_maintenance";
                                 $table_as_depreciation = "admin_asset_depreciation";
                                 $table_code_creation = "assest_code_creation";
                                 /**  SQL */
                                 $sql_as_in = "SELECT * FROM $table_as_in 
                                       LEFT JOIN $table_code_creation 
                                          ON $table_code_creation.ac_id = $table_as_in.adassi_code_id
                                       LEFT JOIN " . $table_as_transfer
                                    . " ON " . $table_as_transfer . ".adasst_code = " . $table_as_in . ".adassi_code_id
                                       LEFT JOIN " . $table_as_broken .
                                    " ON " . $table_as_broken . ".adassb_code = " . $table_as_in . ".adassi_code_id 
                                    LEFT JOIN " . $table_as_replacement . 
                                    " ON " . $table_as_replacement .".adassr_code = " . $table_as_in . ".adassi_code_id 
                                    LEFT JOIN ". $table_as_maintennace . " ON " . 
                                    $table_as_maintennace .".adassm_code = ".$table_as_in . ".adassi_code_id 
                                    LEFT JOIN ".$table_as_depreciation. " ON " .$table_as_depreciation.".adassd_code = ".$table_as_in . ".adassi_code_id"
                                 ;
                                 //echo $sql_as_in;
                                 $result = $connect->query($sql_as_in);
                                 $length_row = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $count_row = $length_row++;
                                 ?>
                                    <tr>
                                       <td><?php echo $count_row;?></td>
                                       <td><?php echo $row['ac_asset_code'];?></td>
                                       <td><?php echo $row['adassi_asset_name'];?></td>
                                       <td><?php echo $row['adassi_date'];?></td>
                                       <td><?php echo $row['adassi_qty']?></td>
                                       <td><?php echo $row['adassi_unit_price'];?></td>
                                       <td><?php echo $row['adassi_total'];?></td>
                                       <td><?php echo $row['adasst_transfer_no'];?></td>
                                       <td><?php echo $row['adasst_date'];?></td>
                                       <td><?php echo $row['adasst_transfer_form'];?></td>
                                       <td><?php echo $row['adasst_transfer_to'];?></td>
                                       <td><?php echo $row['adasst_qty'];?></td>
                                       <td><?php echo $row['adassb_broken_no'];?></td>
                                       <td><?php echo $row['adassb_date'];?></td>
                                       <td><?php echo $row['adassb_qty'];?></td>
                                       <td><?php echo $row['adassb_total'];?></td>
                                       <td><?php echo $row['adassr_replace_no'];?></td>
                                       <td><?php echo $row['adassr_date'];?></td>
                                       <td><?php echo $row['adassr_qty'];?></td>
                                       <td><?php echo $row['adassr_total'];?></td>
                                       <td><?php echo $row['adassm_mainten_no'];?></td>
                                       <td><?php echo $row['adassm_date'];?></td>
                                       <td><?php echo $row['adassm_maintenace_fee'];?></td>
                                       <td><?php echo $row['adassd_depre_no'];?></td>
                                       <td><?php echo $row['adassd_depre_age'];?></td>
                                       <td><?php echo $row['adassd_depre_total_amount'];?></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
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
         $("#menu_admin_manage").addClass("active");
         $("#asset_balance").addClass("active");
         $("#asset_balance").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>