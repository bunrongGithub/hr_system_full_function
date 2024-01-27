<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
   $_id = $_GET['id'];
   $sql = "SELECT * FROM `admin_asset_depreciation` A
            LEFT JOIN `assest_code_creation` B ON B.ac_id = A.adassd_code
            LEFT JOIN `text_asset_code_creation_type` C ON C.acct_id = A.adassd_type
            LEFT JOIN `text_asset_in_mou` D ON D.aim_id = A.adassd_mou
            WHERE adassd_id= '$_id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   /** DATA View */
   $v_code =  $row['ac_asset_code'];
   $v_type = $row['acct_name'];
   $v_name = $row['adassd_asset_name'];
   $v_category = $row['as_asset_category'];
   $v_qty = $row['adassd_qty'];
   $v_mou = $row['aim_name'];
   $v_price = $row['adassd_price'];
   $v_amount = $row['adassd_amount'];
   $v_date = $row['adassd_date'];
   $v_depre_no = $row['adassd_depre_no'];
   $v_depre_date = $row['adassd_depre_date'];
   $v_depre_age = $row['adassd_depre_age'];
   $v_depre_pay_day = $row['adassd_depre_payday'];
   $v_depre_amount_pay_month = $row['adassd_depre_amount_per_month'];
   $v_depre_total_amount = $row['adassd_depre_total_amount'];
   $v_noted = $row['adassd_note'];
   $v_img = $row['adassd_img'];
}
if (isset($_GET['del_id'])) {
   $del_id = $_GET['del_id'];
   $_id = $_GET['id'];
   $materil = $_GET['material'];
   $sql = "DELETE FROM `admin_asset_depreciation_material` WHERE adassd_m_id = '$del_id'";
   $result = $connect->query($sql);
   if ($result) {
      header('location:admin_asset_depreciation_view.php?id=' . $_id . '');
      exit();
   }
}
if (isset($_POST['add_materail'])) {
   if ((empty($_POST['asset_material_id'])) and (empty($_POST['asset_material'])) and (empty($_POST['asset_qty_insert'])) and (empty($_POST['asset_in_mou']))) {
      $_id = $_GET['id'];
      $materil = $_GET['material'];
      header('location:admin_asset_depreciation_view.php?id=' . $_id . '&material=' . $materil . '');
      return;
      // exit();
   }
   if ((!empty($_POST['asset_material_id'])) and (!empty($_POST['asset_material'])) and (!empty($_POST['asset_qty_insert'])) and (!empty($_POST['asset_in_mou']))) {
      $_post_mat_id = $_POST['asset_material_id'];
      $_post_mat_name = $_POST['asset_material'];
      $_post_qty = $_POST['asset_qty_insert'];
      $_post_mou = $_POST['asset_in_mou'];
      //$_post_note = $_POST['asset_remark'];
      $_id = $_GET['id'];
      $materil = $_GET['material'];
      $value_materia = 0;
      for ($value_material = 0; $value_material < count($_post_mat_name); $value_material++) {
         $sql_ = "INSERT INTO `admin_asset_depreciation_material`(
            adassd_m_material_id,
            adassd_m_name,
            adassd_m_qty,
            asdassd_m_mou
         ) VALUES (
            '" . $_post_mat_id[$value_material] . "',
            '" . $_post_mat_name[$value_material] . "',
            '" . $_post_qty[$value_material] . "',
            '" . $_post_mou[$value_material] . "'
         )";
         mysqli_query($connect, $sql_);
      }
   }
   header('location:admin_asset_depreciation_view.php?id=' . $_id . '&material=' . $materil . '');
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

<body class="skin-black">
   <?php include('header.php') ?>
   <div class=" wrapper row-offcanvas row-offcanvas-left ">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1>Admin Asset Depreciation</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-12">
                           <div class="row col-xs-8">
                              <div class="form-group col-xs-6">
                                 <label for="">Asset Code:</label>
                                 <input class="form-control" type="text" value="<?= $v_code; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Asset Type:</label>
                                 <input class="form-control" type="text" value="<?= $v_type; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Asset Name:</label>
                                 <input class="form-control" type="text" value="<?= $v_name; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Asset Category:</label>
                                 <input class="form-control" type="text" value="<?= $v_category; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-3">
                                 <label for="">QTY:</label>
                                 <input class="form-control" type="text" value="<?= $v_qty; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-3">
                                 <label for="">Mou:</label>
                                 <input class="form-control" type="text" value="<?= $v_mou; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Price:</label>
                                 <input class="form-control" type="text" value="<?= $v_price; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Total Amount:</label>
                                 <input class="form-control" type="text" value="<?= $v_amount; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Start Date:</label>
                                 <input class="form-control" type="text" value="<?= $v_date; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Depreciation No:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_no; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Depreciation Date:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_date; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Depreciation Age:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_age; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Depreciation pay day:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_pay_day . '$'; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Depreciation amount pay month:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_amount_pay_month . '$'; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Deprecation Total Amount:</label>
                                 <input class="form-control" type="text" value="<?= $v_depre_total_amount . '$'; ?>" readonly name="" id="">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Note:</label>
                                 <textarea class="form-control" rows="2" type="text" value="" readonly name="" id=""><?= $v_noted . '$'; ?></textarea>
                              </div>
                           </div>
                           <div class="row col-xs-4">

                              <label>Photo:</label><br />
                              <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($v_img != '') {
                                                                                                                                       echo 'upload/asset_depreciation/' . $v_img;
                                                                                                                                    } else {
                                                                                                                                       echo 'no_image.jpg';
                                                                                                                                    } ?>" width="300x" height="300px">
                              <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*" onchange="show_photo_pre(event);"></input>

                           </div>
                           <div class="row col-xs-10">
                              <table id='info_data' class="table table-new table-striped table-responsive table-bordered">
                                 <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Material Name</th>
                                    <th class="text-center">QTY</th>
                                    <th style="width: 150px;" class="text-center">Mou</th>
                                    <th class="text-center">Remark</th>
                                    <th class="text-center">Action</th>
                                 </tr>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_depreciation_material WHERE adassd_m_material_id = $_id";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $_count_row = $i++;
                                    $_mat_name = $row['adassd_m_name'];
                                    $_mat_qty = $row['adassd_m_qty'];
                                    $_mat_mou = $row['asdassd_m_mou'];
                                    $_mat_remark = $row['adassd_m_note'];
                                 ?>
                                    <tr>
                                       <td><?php echo $_count_row;?></td>
                                       <td><?php echo $_mat_name?></td>
                                       <td><?php echo $_mat_qty?></td>
                                       <td><?php echo $_mat_mou?></td>
                                       <td><?php echo $_mat_remark?></td>
                                       <td class="text-center" >
                                          <a style="color: #fff;" onclick="return confirm('Are you sure delete?'); " 
                                          class="btn btn-sm btn-danger" 
                                          href="admin_asset_depreciation_view.php?id=<?php echo $_id?>&del_id=<?php echo $row['adassd_m_id'];?>">
                                             <i class="fa fa-trash-o"></i>
                                          </a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </table>
                           </div>
                           <div class="form-group col-xs-12 text-right">
                              <a href="admin_asset_depreciation.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
                           </div>
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
   <script type="text/javascript">
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_depre").addClass("active");
         $("#asset_depre").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>