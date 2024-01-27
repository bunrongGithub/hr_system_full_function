<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM admin_asset_receive LEFT JOIN admin_asset_transfer ON admin_asset_transfer.adasst_id = admin_asset_receive.adassrt_tran_id
   LEFT JOIN assest_code_creation ON assest_code_creation.ac_id = admin_asset_transfer.adasst_code 
   LEFT JOIN text_asset_code_creation_type ON text_asset_code_creation_type.acct_id = admin_asset_transfer.adasst_type 
   LEFT JOIN txt_admin_asset_receive_status ON txt_admin_asset_receive_status.tadsrs_id = admin_asset_receive.adassrt_status 
   LEFT JOIN text_asset_in_mou ON text_asset_in_mou.aim_id = admin_asset_receive.adassrt_mou where adassrt_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   $_transfer_no = $row['adasst_transfer_no'];
   $_transfer_from = $row['adasst_transfer_form'];
   $_transfer_to = $row['adasst_transfer_to'];
   $_transfer_code = $row['ac_asset_code'];
   $_category = $row['as_asset_category'];
   $_asset_type = $row['acct_name'];
   $_asset_name = $row['adasst_asset_name'];
   $_asset_date = $row['adassrt_date'];
   $_receive_date = $row['adasstr_receive_date'];
   $_status = $row['tadsrs_name'];
   $_asset_total = number_format($row['adassrt_total']);
   $_asset_price = number_format($row['adassrt_c_price']);
   $_asset_qty = number_format($row['adasst_qty']);
   $_as_remark = $row['adassrt_note'];
   $_as_mou = $row['aim_name'];
   $_img = $row['adassrt_img'];
}
if(isset($_GET['del_id'])){
   $del_id = $_GET['del_id']; 
   $sql = "DELETE FROM admin_asset_receive_material WHERE adassrtm_id = $del_id";
   mysqli_query($connect,$sql);
   header("location:edit_admin_asset_receive.php?id=$id");
   exit();
}
?>
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

<body class='skin-black'>
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1>Admin Asset Receive</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-8">
                           <div class="col-xs-6 form-group">
                              <label for="">Transfer_No:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_transfer_no ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Transfer_From:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_transfer_from; ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Transfer_To:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_transfer_to; ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Asset_Code:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_transfer_code; ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Asset_Category:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_category ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Asset_Type:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_asset_type ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Asset_Name:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_asset_name ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Start Date:</label>
                              <input style="font-weight: 800;" type="date" name="" class="form-control" value="<?= $_asset_date ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Receive Date:</label>
                              <input style="font-weight: 800;" type="date" name="" class="form-control" value="<?= $_receive_date ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Status:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_status ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">QTY:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_asset_qty ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Unit_Price:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_asset_price . '$'; ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Total Amount:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_asset_total . '$'; ?>" id="">
                           </div>
                           <div class="col-xs-6 form-group">
                              <label for="">Mou:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_as_mou ?>" id="">
                           </div>
                           <div class="col-xs-12 form-group">
                              <label for="">Remark:</label>
                              <input style="font-weight: 800;" type="text" name="" class="form-control" value="<?= $_as_remark ?>" id="">
                           </div>
                        </div>
                        <div class="row col-xs-4">
                           <div class="form-group col-xs-12">
                              <label>Photo:</label><br />
                              <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($_img != '') {
                                                                                                                                       echo 'upload/asset_receive/receive_photo/' . $_img;
                                                                                                                                    } else {
                                                                                                                                       echo 'no_image.jpg';
                                                                                                                                    } ?>" width="300x" height="300px">
                              <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*"></input>
                           </div>
                        </div>
                        <div class="row col-xs-10">
                           <table id='info_data' class="table table-striped table-responsive table-bordered">
                              <thead>
                                 <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Material Name</th>
                                    <th class="text-center">QTY</th>
                                    <th style="width: 150px;" class="text-center">Mou</th>
                                    <th class="text-center">Remark</th>
                                    <th class="th_none_display text-center">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_receive_material a 
                                    left join text_asset_in_mou b on b.aim_id = a.adassrtm_mou
                                    where adasstrtm_material_id = $id";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $_count_row = $i++;
                                    $_mat_name = $row['adassrtm_name'];
                                    $_mat_qty = $row['adassrtm_qty'];
                                    $_mat_mou = $row['aim_name'];
                                    $_mat_remark = $row['adassrtm_note'];
                                 ?>
                                    <tr>
                                       <td class="text-center"><?php echo $_count_row; ?></td>
                                       <td class="text-center"><?php echo $_mat_name; ?></td>
                                       <td class="text-center"><?php echo $_mat_qty; ?></td>
                                       <td class="text-center"><?php echo $_mat_mou; ?></td>
                                       <td class="text-center"><?php echo $_mat_remark; ?></td>
                                       <td class="text-center">
                                          <a onclick="return confirm('Are you sure delete?'); " style="color: #fff;" class="btn btn-sm btn-danger" href="./edit_admin_asset_receive.php?id=<?=$id?>&del_id=<?=$row['adassrtm_id'];?>"><i class="fa fa-trash-o" ></i></a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                        <div class="form-group col-xs-12 text-right">
                           <a href="./admin_asset_receive.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
                        </div>
                     </form>
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
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
   <script>
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_receive").addClass("active");
         $("#asset_receive").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>