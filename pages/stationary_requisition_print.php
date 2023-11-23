<?php
include '../config/db_connect.php';
if (isset($_GET["Id"])) {
   $id = $_GET["Id"];
   $sql = "SELECT * FROM stationary_requisition where sr_id=$id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_array($result);
}
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
   <?php include "title_icon.php"; ?>
   <meta content='width=device-width,
            initial-scale=1,
            maximum-scale=1,
            user-scalable=no' name='viewport'>
   <!--bootstrap 3.0.2-->
<link rel="stylesheet" href="../css/bootstrap.min.css" type='text/css' />
<!-- font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
   <style>
      @media print{
         *{
            box-shadow: none !important;
            border:  none !important;
         }
         .btn-don-show {
            display: none;
         }
         .NoPrint{
            display: none;
         }
         #NoPrint{
            display: none;
         }
         .image_{
            box-shadow: 100px 100px 0 0;
         }
      }
   </style>
</head>

<body class="skin-black pace-done">
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php
      include('left_menu.php')
      ?>
      <aside class="right-side">
         <section class="content-header">
            <h3 class="text-primary">Stationary Requisition</h3>
         </section>
         <section class="content" >
            <div class="row">
               <div class="col-md-12">
                  <div class="col-xs-12 connectedSortable">
                     <div class="box">
                        <div class="box-header">
                           <div class="col-xs-2"></div>
                           <form action="" method="post" enctype="multipart/form-data">
                              <input type="hidden" value="<?php echo $row['sr_id'] ?>">
                              <div class="mt-5" >
                                 <div class="col-md-8">
                                    <div  style=" margin-top:50px; width: 100px; height:100px;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="image_ mt-5 shadow-sm">
                                       <?php  
                                          $v_company_id = @$row['sr_company_id'];
                                             $sql = "SELECT * FROM company where c_id = '$v_company_id'";
                                             $query_img = $connect->query($sql);
                                             $img_c_row = $query_img->fetch_assoc();
                                             $img_c_show = @$img_c_row['c_logo'];
                                             ?>
                                             <img width="100%" height="100%" src="../img/<?php echo $img_c_show;?>" alt="">
                                             <?php
                                       ?>
                                       
                                    </div>
                                    <div class=" text-center">
                                       <h3 for="">Stationary Requisition</h3>
                                    </div><br>
                                    <div style="font-size: 17px;" class="col-xs-6">
                                       <span>Requisition Date:</span>
                                       <?php echo $row['sr_date']; ?>
                                    </div>
                                    <div style="font-size: 17px;" class="text-center col-xs-6">
                                       <span>PS No:</span>
                                       <?php echo $row['sr_ps_no']; ?>
                                    </div>
                                    <div class="col-xs-6"></div>
                                    <div style="font-size: 17px;" class=" text-center col-xs-6">
                                       <span>Used By:</span>
                                       <?php
                                       $v_use_by_department = @$row['sr_use_by'];
                                       $sql_use_by = "SELECT * FROM department WHERE de_id = '$v_use_by_department'";
                                       $result_use_by = $connect->query($sql_use_by);
                                       $row_use_by = $result_use_by->fetch_assoc();
                                       $v_use_by_show = @$row_use_by['de_name'];
                                       echo @$v_use_by_show;
                                       ?>
                                    </div>
                                    <div class="col-md-12">
                                       <table class="table table-hover table-bordered table-striped">
                                          <thead>
                                             <tr>
                                                <th class="col-xs-2">No.</th>
                                                <th class="col-xs-2">Stationary Type</th>
                                                <th class="col-xs-2">Description</th>
                                                <th class="col-xs-2">Qty</th>
                                                <th class="col-xs-2">Unit_Price</th>
                                                <th class="col-xs-2">Total Amount</th>
                                             </tr>
                                          </thead>
                                          <tbody id="tBody">
                                             <tr id="tRow">
                                                <td>
                                                   <input class="form-control" type="text" name="" id="" value="<?php echo $row['sr_id']; ?>">
                                                </td>
                                                <td>
                                                   <select class="form-control" name="" id="">
                                                      <?php
                                                   // $station_type = @$row['sr_sationary_type_id'];
                                                   // $sql_station_type = "SELECT * FROM text_stationary_type WHERE st_id ='$station_type'";
                                                   // $result_station_type = $connect->query($sql_station_type);
                                                   // $row_station = $result_station_type->fetch_assoc();
                                                   // $row_station_show = @$row_station['st_name'];
                                                   $v_select = mysqli_query($connect,"SELECT * FROM  text_stationary_type ORDER BY st_name ASC");
                                                   while($row_se = mysqli_fetch_assoc($v_select)){
                                                      if($row['sr_sationary_type_id'] == $row_se['st_id']){
                                                         ?>
                                                         <option selected="selected" value="<?php echo $row_se['st_id']?>"><?php echo $row_se['st_name'] ?></option>
                                                         <?php
                                                      }else{
                                                         ?>
                                                         <option value="<?php echo $row_se['st_id']?>"><?php echo $row_se['st_name'] ?></option>
                                                         <?php
                                                      }
                                                   }
                                                   ?>
                                                   </select>
                                                </td>
                                                <td>
                                                   <input class="form-control" type="text" name="" value="<?php echo $row['sr_description'] ?>" id="" >
                                                </td>
                                                <td>
                                                   <input type="text" name="qty" class="form-control" value="<?php echo $row['sr_qty'] ?>" id="">
                                                </td>
                                                <td>
                                                   <input class="form-control" type="text" name="price" value="<?php echo $row['sr_unit_price'] . '$' ?>" >
                                                </td>
                                                <td>
                                                   <input class="form-control" type="text" value="<?php echo $row['sr_amount'] . '$' ?>" name="amount" id="">
                                                </td>
                                            </tr>
                                          </tbody>
                                          <tbody id="tBody_2">
                                             <tr id="tRow_2">

                                             </tr>
                                          </tbody>
                                          <tfoot>
                                             <tr>
                                                <td colspan="4" ></td>
                                                <td >Total Amount</td>
                                                <td><input type="text" class="form-control" value="<?php echo $row['sr_amount'].'$'?>"></td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                    </div>
                                    <div class="col-md-12 form-group">
                                       <label for="">Noted:</label>
                                       <textarea class="form-control" name="" id="" rows="2"><?php echo $row['sr_note'] ?></textarea>
                                    </div>
                                    <div class="col-md-4">
                                       <label for="">Request by:</label><br>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-4">
                                       <label for="">Confirm by:</label><br>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-4">
                                       <label for="">Apprpved by:</label><br>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="btn-don-show col-md-12">
                                          <div class="col-md-10"></div>
                                          <button id="btn_done_show" type="button" onclick="print()" class="btn btn-success btn-sm"><i class="fa fa-print"></i>
                                             Print</button>
                                          <a style="color: #fff;" href="stationary_requisition.php" id="btn_done_show" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</a>
                                    </div>
                                 </div>
                           </form>
                           <div class="col-xs-2"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </aside>
   </div>
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
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>>

   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script type="text/javascript">
      function doUpdate(id, name, note) {
         $('#position_id').val(id);
         $('#edit_name').val(name);
         $('#edit_note').val(note);
      }
      $(function() {
         $("#menu_admin").addClass("active");
         $("#stationary").addClass("active");
         $("#stationary").css("background-color", "##367fa9");
         $('#table_stationary_requisition').dataTable();
      });
      </script>
</body>

</html>