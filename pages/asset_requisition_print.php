<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM asset_requisiton WHERE as_id = $id";
   $result = $connect ->query($sql);
}
?>
<html>

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
         .btn-don-show {
            display: none;
         }
         .NoPrint{
            display: none;
         }
         #NoPrint{
            display: none;
         }
      }
   </style>
</head>

<body class="skin-black">

   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1 class="text-primary">Asset Requisition</h1>
         </section>
         <section class="content" >
            <div class="row">
                  <div class="col-xs-12 connectedSortable">
                     <div class="box">
                        <div class="box-header">
                           <div class="col-xs-2"></div>
                           <div class="col-md-8">
                              <form action="" method="post" enctype="multipart/form-data">
                                 <input type="hidden" value="<?php echo $row['as_id'] ?>" name="" id="">
                                 <div class="row">
                                    <div  class="" style="
                                                            width: 100px;
                                                            height: 150px;
                                                            text-align: center;
                                                            border:1px solid #3434;
                                                            margin-top:50px;
                                                            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
                                                            ">
                                       <?php 
                                          $company_id = @$row['as_company_id'];
                                          $company_sql = "SELECT * FROM company where c_id = '$company_id'";
                                          $company_img = $connect->query($company_sql);
                                          $company_img_row = $company_img->fetch_assoc();
                                          $company_img_show = @$company_img_row['c_logo'];
                                          ?>
                                          <img style="width: 100%; height:100%; " src="../img/<?php echo @$company_img_show ?>" name="" alt="no_img" id="">
                                    </div>
                                    <div class=" text-center">
                                       <h3 for="">Asset Requisition</h3>
                                    </div><br>
                                    <div style="font-size: 17px;" class="col-xs-6">
                                       <span>Requisition Date:</span>
                                       <?php echo $row['as_date_requisition']; ?>
                                    </div>
                                    <div style="font-size: 17px;" class="text-center col-xs-6">
                                       <span>PA No:</span>
                                       <?php echo $row['as_pa_no']; ?>
                                    </div>
                                    <div class="col-xs-6"></div>
                                    <div style="font-size: 17px;" class=" text-center col-xs-6">
                                       <span>Used By:</span>
                                       <?php
                                       $v_use_by_department = @$row['as_use_by_id'];
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
                                                <th class="col-xs-2">Asset Type</th>
                                                <th class="col-xs-2">Description</th>
                                                <th class="col-xs-2">Qty</th>
                                                <th class="col-xs-2">Unit_Price</th>
                                                <th class="col-xs-2">Total Amount</th>
                                             </tr>
                                          </thead>
                                          <tbody id="tBody">
                                             <tr id="tRow">
                                                <td>
                                                   <input class="form-control" type="text" name="" id="" value="<?php echo $row['as_id']; ?>">
                                                </td>
                                                <td>
                                                   <select class="form-control" name="" id="">
                                                      <?php
                                                      $v_select = mysqli_query($connect, "SELECT * FROM  text_asset_code_creation_type ORDER BY acct_name ASC");
                                                      while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                         if ($row['as_asset_type_id'] == $row_se['acct_id']) {
                                                      ?>
                                                            <option selected="selected" value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name'] ?></option>
                                                         <?php
                                                         } else {
                                                         ?>
                                                            <option value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name'] ?></option>
                                                      <?php
                                                         }
                                                      }
                                                      ?>
                                                   </select>
                                                </td>
                                                <td>
                                                   <input class="form-control" type="text" name="" value="<?php echo $row['as_description'] ?>" id="">
                                                </td>
                                                <td>
                                                   <input type="text" name="qty" class="form-control" value="<?php echo $row['as_qty'] ?>" id="">
                                                </td>
                                                <td>
                                                   <input type="text" name="qty" class="form-control" value="<?php echo $row['as_unit_price'] . '$' ?>" id="">
                                                </td>
                                                <td>
                                                   <input type="text" name="qty" class="form-control" value="<?php echo $row['as_total_amount'] . '$' ?>" id="">
                                                </td>
                                              </tr>

                                          </tbody>
                                          <tbody id="tBody_2">
                                             <tr id="tRow_2">

                                             </tr>
                                          </tbody>
                                          <tfoot>
                                             <tr>
                                                <td colspan="4"></td>
                                                <td>Total Amount</td>
                                                <td><input type="text" class="form-control" value="<?php echo $row['as_total_amount'] . '$' ?>"></td>
                                             </tr>
                                          </tfoot>
                                       </table>

                                    </div>
                                    <div class="col-md-12 form-group">
                                       <label for="">Noted:</label>
                                       <textarea class="form-control" name="" id="" rows="2"><?php echo $row['as_note'] ?></textarea>
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
                                       <a href="./asset_requisition.php" id="btn_done_show" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="col-md-2"></div>
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
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script>
      function BtnAdd(){
         var v = $("#tRow").clone().appendTo("#tBody_2");
         $(v).find("input").val('');
      }
      function BtnDel(v){
         $(v).parent().parent().remove();
      }
   </script>
</body>

</html>