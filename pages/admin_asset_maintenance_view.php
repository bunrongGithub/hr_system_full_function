<?php

include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM admin_asset_maintenance where adassm_id = $id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   $_asset_code = $row['adassm_code'];
   $_asset_type = $row['adassm_type'];
   $_asset_code = $row['adassm_category'];
   $_asset_qty = $row['adassm_qty'];
   $_asset_name = $row['adassm_asset_name'];
   $_asset_mou = $row['adassm_mou'];
   $_asset_total = $row['adassm_total'];
   $_asset_mainten_no = $row['adassm_mainten_no'];
   $_asset_note = $row['adassm_note'];
   $_asset_fee = $row['adassm_maintenace_fee'];
   $_asset_main_by = $row['adassm_mainten_by'];
   $_asset_main_date = $row['adassm_mainten_date'];
   $_asset_status = $row['adassm_status'];
   $_unit_price = $row['adassm_unit_price'];
   $_asset_start_date = $row['adassm_date'];
   $_img = $row['adassm_img'];
}
if (isset($_GET['id_del'])) {
   $id_del = $_GET['id_del'];
   $sql = "DELETE FROM admin_maintenance_material WHERE admm_id = $id_del";
   mysqli_query($connect, $sql);
   header("location:admin_asset_maintenance_view.php?id=$id");
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
   <style>
      @media print {
         .no_print {
            display: none !important;
         }

         #info_data_filter,
         #info_data_length {
            display: none;
            border: none;
         }

         #info_data {
            width: 100%;
         }

         .dataTables_paginate {
            display: none;
         }

         .dataTables_info {
            display: none;
         }

         .btn_no_print,
         .dataTables_empty,
         .th_none_display,
         .form-none_display {
            display: none !important;
         }
      }
   </style>
</head>

<body class='skin-black'>
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1>Admin Asset Maintenance</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-4">
                           <div class="col-xs-12 form-group">
                              <label for="">Asset Code:</label>
                              <select name="asset_code" class="form-control" id="asset_code" data-live-search='true'>
                                 <option aria-readonly="true" value=""></option>
                                 <?php
                                 $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY ac_asset_code ASC");
                                 while ($row_se = mysqli_fetch_assoc($v_select)) {
                                    if ($_asset_code == $row_se['ac_id']) {
                                 ?>
                                       <option selected="selected" value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['ac_asset_code']; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option disabled value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['ac_asset_code']; ?></option>
                                 <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Asset Type:</label>
                              <select class="form-control select2" name="" id="">
                                 <?php
                                 $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                 while ($row_se = mysqli_fetch_assoc($v_select)) {
                                    if ($_asset_type == $row_se['acct_id']) {
                                 ?>
                                       <option selected="selected" value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name']; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option disabled value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name']; ?></option>
                                 <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Asset Category:</label>
                              <select class="form-control select2" name="" id="">
                                 <?php
                                 $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY as_asset_category ASC");
                                 while ($row_se = mysqli_fetch_assoc($v_select)) {
                                    if ($_asset_code == $row_se['ac_id']) {
                                 ?>
                                       <option selected="selected" value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['as_asset_category']; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option disabled value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['as_asset_category']; ?></option>
                                 <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Asset Name:</label>
                              <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_asset_name ?>" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">QTY:</label>
                              <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_asset_qty ?>" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Mou:</label>
                              <select class="form-control select2" name="" id="">
                                 <?php
                                 $v_select = mysqli_query($connect, "SELECT * FROM text_asset_in_mou ORDER BY aim_name ASC");
                                 while ($row_se = mysqli_fetch_assoc($v_select)) {
                                    if ($_asset_mou == $row_se['aim_id']) {
                                 ?>
                                       <option selected="selected" value="<?php echo $row_se['aim_id'] ?>"><?php echo $row_se['aim_name']; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option disabled value="<?php echo $row_se['aim_id'] ?>"><?php echo $row_se['aim_name']; ?></option>
                                 <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Total Amount:</label>
                              <div class="input-group">
                                 <div class="input-group-addon">$</div>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_asset_total . '$' ?>" class="form-control">
                              </div>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Maintenance Reason:</label>
                              <textarea style="font-weight: 800;" type="" value="<?= $_asset_note ?>" name="" id="" rows="2" class="form-control"><?= $_asset_note ?></textarea>
                           </div>
                        </div>
                        <div class="row col-xs-4">
                           <div class="form-group col-xs-12">
                              <label for="">Maintenance No:</label>
                              <input style="font-weight: 800;" type="text" value="<?= $_asset_mainten_no ?>" name="" id="" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Maintenance Date:</label>
                              <input style="font-weight: 800;" type="date" value="<?= $_asset_main_date ?>" name="" id="" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Maintenance By:</label>
                              <input style="font-weight: 800;" type="text" value="<?= $_asset_main_by ?>" name="" id="" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Maintenance Fee:</label>
                              <input style="font-weight: 800;" type="text" value="<?= $_asset_fee ?>" name="" id="" class="form-control">
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Current Unit Price:</label>
                              <div class="input-group">
                                 <div class="input-group-addon">$</div>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_unit_price . '$' ?>" class="form-control">
                              </div>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Asset Status:</label>
                              <select class="form-control select2" name="" id="">
                                 <?php
                                 $v_select = mysqli_query($connect, "SELECT * FROM text_asset_broken_status ORDER BY tasb_name ASC");
                                 while ($row_se = mysqli_fetch_assoc($v_select)) {
                                    if ($_asset_status == $row_se['tasb_id']) {
                                 ?>
                                       <option selected="selected" value="<?php echo $row_se['tasb_id'] ?>"><?php echo $row_se['tasb_name']; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option disabled value="<?php echo $row_se['tasb_id'] ?>"><?php echo $row_se['tasb_name']; ?></option>
                                 <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group col-xs-12">
                              <label for="">Strat Date:</label>
                              <input style="font-weight: 800;" type="date" value="<?= $_asset_start_date = $row['adassm_date'] ?>" name="" id="" class="form-control">
                           </div>
                        </div>
                        <div class="row col-xs-4">
                           <div class="form-group col-xs-12">
                              <label>Photo:</label><br />
                              <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($_img != '') {
                                                                                                                                       echo 'upload/asset_maintenance/photo/' . $_img;
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
                                 $sql = "SELECT * FROM admin_maintenance_material a LEFT JOIN text_asset_in_mou b on b.aim_id = a.admm_mou
                                 where admm_material_id = $id";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $_count_row = $i++;
                                    $_mat_name = $row['admm_name'];
                                    $_mat_qty = $row['admm_qty'];
                                    $_mat_mou = $row['aim_name'];
                                    $_mat_remark = $row['admm_note'];
                                 ?>
                                    <tr>
                                       <td><?php echo $_count_row;?></td>
                                       <td><?php echo $_mat_name;?></td>
                                       <td><?php echo $_mat_qty;?></td>
                                       <td><?php echo $_mat_mou;?></td>
                                       <td><?php echo $_mat_remark;?></td>
                                       <td class="text-center" >
                                          <a onclick="return confirm('Are you sure to delete?'); " style="color: #fff;" class="btn btn-sm btn-danger" href="./admin_asset_maintenance_view.php?id=<?=$id?>&id_del=<?=$row['admm_id']?>"><i class="fa fa-trash-o" ></i></a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                        <div class="form-group col-xs-12 text-right">
                           <a href="./admin_asset_maintenance.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
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
   <!-- daterangepicker -->
   <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
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
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_mainten").addClass("active");
         $("#asset_mainten").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });

      function doUpdate(id) {
         $("#eidt_id").val();
      }
   </script>
</body>

</html>