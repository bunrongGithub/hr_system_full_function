<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/asset_transfer/";

if (isset($_POST["btnadd"])) {
   $_transfer = $_POST['txt_tran_ref'];
   $_transfer_from = $_POST['txt_tran_from'];
   $_recieve_date = $_POST['txt_date'];
   $_strt_qty = $_POST['txt_qty'];
   $_strt_price = $_POST['txt_price'];
   $_strt_mou = $_POST['txt_mou'];
   $_strt_total = $_POST['txt_total'];
   $_strt_status = $_POST['txt_status'];
   $_strt_reason = $_POST['txt_reason'];

   $sql = "INSERT INTO admin_stationary_receive
                        ( 
                           adstrt_qty,
                           adstrt_mou,
                           adstrt_unit_price,
                           adstrt_total,
                           adstrt_transfer_no,
                           adstrt_transfer_location,
                           adstrt_date,
                           adstrt_status,
                           adstrt_note,
                           adstrt_userid,
                           adstrt_created_date
                        )
                  VALUES 
                  (
                     '$_strt_qty',
                     '$_strt_mou',
                     '$_strt_price',
                     '$_strt_total',
                     '$_transfer',
                     '$_transfer_from',
                     '$_recieve_date',
                     '$_strt_status',
                     '$_strt_reason',
                     '$user_id',
                     'now()'
                  )";
   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_receive.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $_strt_id = $_POST['edit_txt_id'];
   $_strt_transfer_no = $_POST['edit_txt_tran_no'];
   $_strt_stransfer_from = $_POST['edit_txt_tran_from'];
   $_strt_qty = $_POST['edit_txt_qty'];
   $_strt_date = $_POST['edit_txt_date'];
   $_strt_price = $_POST['edit_txt_price'];
   $_strt_mou = $_POST['edit_txt_mou'];
   $_strt_total = $_POST['edit_txt_total'];
   $_strt_status = $_POST['edit_txt_status'];
   $_strt_noted = $_POST['edit_txt_reason'];

   $sql = "UPDATE admin_stationary_receive SET 
                        adstrt_qty = '$_strt_qty',
                        adstrt_mou ='$_strt_mou',
                        adstrt_unit_price = '$_strt_price',
                        adstrt_total = '$_strt_total',
                        adstrt_transfer_no = '$_strt_transfer_no',
                        adstrt_transfer_location = '$_strt_stransfer_from',
                        adstrt_date = '$_strt_date',
                        adstrt_status ='$_strt_status',
                        adstrt_note = '$_strt_noted',
                        adstrt_userid = '$user_id',
                        adstrt_updated_date = 'NOW()' WHERE adstrt_id = '$_strt_id'
                        ";

   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_receive.php?message=update');
   exit();
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM admin_stationary_receive WHERE adstrt_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: admin_stationary_receive.php?message=delete");
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
               Stationary Receive Transfer
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
                                             <label>Transfer Nº :</label>
                                             <select class="form-control" id="txt_tran_ref" name="txt_tran_ref" data-live-search="true">
                                                <option disabled selected>Please Select Transfer No</option>
                                                <?php
                                                $sql = 'SELECT adstt_id
                                                                  ,adstt_transfer_no
                                                                  FROM admin_stationary_transfer';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['adstt_id'] . '" title="' . $row['adstt_transfer_no'] . '"> Code: ' . $row['adstt_id'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adstt_transfer_no'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Transfer From:</label>
                                             <input class="form-control" id="txt_tran_from" name="txt_tran_from" type="text">
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Receive Date:</label>
                                             <input class="form-control" id="txt_date" name="txt_date" type="date">
                                          </div>
                                          <p id='amount_data'></p>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>QTY:</label>
                                             <input class="form-control" id="txt_qty" name="txt_qty" type="number">
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>MOU:</label>
                                             <select class="form-control" id="txt_mou" name="txt_mou">
                                                <?php
                                                $sql = 'SELECT tasim_id,tasim_name FROM txt_admin_stationary_in_mou';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Unit Price:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="txt_price" name="txt_price" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Total Amount:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="txt_total" name="txt_total" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Status:</label>
                                             <select class="form-control" id="txt_status" name="txt_status">
                                                <?php
                                                $sql = 'SELECT * FROM txt_admin_asset_receive_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tadsrs_id'] . '">' . $row['tadsrs_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                             <label>Reason:</label>
                                             <input class="form-control" id="txt_reason" name="txt_reason" type="text">
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
                                          <input type="hidden" name="edit_txt_id" id="edit_txt_id">
                                          <div class="form-group col-xs-6">
                                             <label>Transfer Nº :</label>
                                             <select class="form-control" id="edit_txt_tran_no" name="edit_txt_tran_no" data-live-search="true">
                                                <option disabled selected>Please Select Transfer No</option>
                                                <?php
                                                $sql = 'SELECT adstt_id
                                                                  ,adstt_transfer_no
                                                                  FROM admin_stationary_transfer';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['adstt_id'] . '" title="' . $row['adstt_transfer_no'] . '"> Code: ' . $row['adstt_id'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adstt_transfer_no'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Transfer From:</label>
                                             <input class="form-control" id="edit_txt_tran_from" name="edit_txt_tran_from" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Receive Date:</label>
                                             <input class="form-control" id="edit_txt_date" name="edit_txt_date" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>QTY:</label>
                                             <input class="form-control" id="edit_txt_qty" name="edit_txt_qty" type="number">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>MOU:</label>
                                             <select class="form-control" id="edit_txt_mou" name="edit_txt_mou">
                                                <?php
                                                $sql = 'SELECT tasim_id,tasim_name FROM txt_admin_stationary_in_mou';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Unit Price:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_txt_price" name="edit_txt_price" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Total Amount:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_txt_total" name="edit_txt_total" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
                                             <select class="form-control" id="edit_txt_status" name="edit_txt_status">
                                                <?php
                                                $sql = 'SELECT * FROM txt_admin_asset_receive_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tadsrs_id'] . '">' . $row['tadsrs_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Reason:</label>
                                             <input class="form-control" id="edit_txt_reason" name="edit_txt_reason" type="text">
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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>ST.Code</th>
                                    <th>ST.Type</th>
                                    <th>ST.Name</th>
                                    <th>QTY</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                    <th>Transfer No</th>
                                    <th>Transfer From</th>
                                    <th>Receive Date</th>
                                    <th>Status</th>
                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_stationary_receive A
                                                LEFT JOIN admin_stationary_transfer B on B.adstt_id = A.adstrt_transfer_no
                                                LEFT JOIN stationary_code C ON C.sc_id = B.adstt_code
                                                LEFT JOIN text_asset_code_creation_type D ON D.acct_id = B.adstt_type
                                                LEFT JOIN txt_admin_asset_receive_status E ON E.tadsrs_id = A.adstrt_status
                                 ";
                                 $result = $connect->query($sql);
                                 $_i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $_count = $_i++;
                                    $_strt_code = $row['sc_stationary_code'];
                                    $_strt_type = $row['acct_name'];
                                    $_strt_name = $row['adstt_name'];
                                    $_strt_qty = $row['adstrt_qty'];
                                    $_strt_price = $row['adstrt_unit_price'];
                                    $_strt_total = $row['adstrt_total'];
                                    $_strt_trasfer_no = $row['adstt_transfer_no'];
                                    $_strt_transfer_from = $row['adstrt_transfer_location'];
                                    $_strt_recieve_date = $row['adstrt_date'];
                                    $_strt_status = $row['tadsrs_name'];
                                 ?>
                                    <tr>
                                       <td><?php echo $_count; ?></td>
                                       <td><?php echo $_strt_code; ?></td>
                                       <td><?php echo $_strt_type; ?></td>
                                       <td><?php echo $_strt_name; ?></td>
                                       <td><?php echo $_strt_qty; ?></td>
                                       <td><?php echo $_strt_price; ?></td>
                                       <td><?php echo $_strt_total; ?></td>
                                       <td><?php echo $_strt_trasfer_no; ?></td>
                                       <td><?php echo $_strt_transfer_from; ?></td>
                                       <td><?php echo $_strt_recieve_date; ?></td>
                                       <td><?php echo $_strt_status; ?></td>
                                       <td>
                                          <a onclick="doUpdate(
                                             '<?=$row['adstrt_id'];?>',
                                             '<?=$row['adstrt_qty'];?>',
                                             '<?=$row['adstrt_mou'];?>',
                                             '<?=$row['adstrt_unit_price'];?>',
                                             '<?=$row['adstrt_total'];?>',
                                             '<?=$row['adstrt_transfer_no'];?>',
                                             '<?=$row['adstrt_transfer_location'];?>',
                                             '<?=$row['adstrt_date'];?>',
                                             '<?=$row['adstrt_status'];?>',
                                             '<?=$row['adstrt_note'];?>',//id,qty,mou,price,total,transfer_no,transfer_from,date,status,noted
                                          );" data-toggle="modal" data-target="#myModal_update"  style="color: #fff;" class="btn btn-sm btn-primary" href=""><i class="fa fa-edit"></i></a>
                                          <a style="color: #fff;" onclick="return confirm ('Ara you sure delete?') " class="btn btn-sm btn-danger" href="./admin_stationary_receive.php?del_id=<?php echo $row['adstrt_id'];?>"><i class="fa fa-trash-o"></i></a>
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
      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }

      function show_edit_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_edit_photo").src = src;
         }
      }

      function doUpdate(id,qty,mou,price,total,transfer_no,transfer_from,date,status,noted) {
         $("#edit_txt_id").val(id);
         $("#edit_txt_tran_no").val(transfer_no).change();
         $("#edit_txt_tran_from").val(transfer_from);
         $("#edit_txt_date").val(date);
         $("#edit_txt_qty").val(qty);
         $("#edit_txt_mou").val(mou).change();
         $("#edit_txt_price").val(price);
         $("#edit_txt_total").val(total);
         $("#edit_txt_status").val(status).change();
         $("#edit_txt_reason").val(noted);
      }
      $('#txt_tran_ref').change(function() {
         $('.show_hid').css("visibility", "visible");
         var transfer_id = $("#txt_tran_ref").val();
         if (transfer_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_admin_asset.php',
               data: {
                  txt_stafer_id: transfer_id
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_stationary_manage").addClass("active");
         $("#station_receive").addClass("active");
         $("#station_receive").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>