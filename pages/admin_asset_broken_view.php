<?php

include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_GET['view_id'])) {
   $id = $_GET['view_id'];
   $sql = "SELECT * FROM admin_asset_broken WHERE adassb_id = $id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
}
if (isset($_GET['id'])) {
   $id_del = $_GET['id'];
   $sql = "delete from admin_asset_broken_material where adsbm_id = '$id_del'";
   $result = mysqli_query($connect, $sql);
   header("location:admin_asset_broken.php?message=delete");
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
         .btn_no_print,.dataTables_empty,.th_none_display,.form-none_display {
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
            <h1>Admin Asset Broken</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  
                  <div class="box-header">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-12">
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Code:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY ac_asset_code ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($row['adassb_code'] == $row_se['ac_id']) {
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
                                       if ($row['adassb_type'] == $row_se['acct_id']) {
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
                                       if ($row['adassb_category'] == $row_se['ac_id']) {
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
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $row['adassb_asset_name'] ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">QTY:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $row['adassb_qty'] ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Mou:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_in_mou ORDER BY aim_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($row['adassb_mou'] == $row_se['aim_id']) {
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
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $row['adassb_total'] . '$' ?>" class="form-control">
                                 </div>
                              </div>
                           </div>
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Broken No:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $row['adassb_broken_no'] ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Broken Date:</label>
                                 <input style="font-weight: 800;" type="date" value="<?= $row['adassb_broken_date'] ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Broken By Whom:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $row['adassb_broken_by'] ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Strat Date:</label>
                                 <input style="font-weight: 800;" type="date" value="<?= $row['adassb_date'] ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Current Unit Price:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $row['adassb_unit_price'] . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Status:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_broken_status ORDER BY tasb_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($row['adassb_status'] == $row_se['tasb_id']) {
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
                                 <label for="">Reason:</label>
                                 <textarea style="font-weight: 800;" type="" value="<?= $row['adassb_reason'] ?>" name="" id="" rows="2" class="form-control"><?= $row['adassb_reason'] ?></textarea>
                              </div>
                           </div>

                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label>Photo:</label><br />
                                 <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($row['adassb_img'] != '') {
                                                                                                                                          echo 'upload/asset_broken/' . $row['adassb_img'];
                                                                                                                                       } else {
                                                                                                                                          echo 'no_image.jpg';
                                                                                                                                       } ?>" width="300x" height="300px">
                                 <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*" onchange="show_photo_pre(event);"></input>
                              </div>
                           </div>
                           <div class="row col-xs-10">
                              <table id='info_data' class="table table-striped table-responsive table-bordered">
                                 <thead>
                                    <tr>
                                       <th class="text-center">No</th>
                                       <th class="text-center">Material ID</th>
                                       <th class="text-center">Material Name</th>
                                       <th class="text-center">QTY</th>
                                       <th style="width: 150px;" class="text-center">Mou</th>
                                       <th class="th_none_display text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if (isset($_GET['view_code'])) {
                                       $materail_code_id = $_GET['view_code'];
                                       $sql_m = "SELECT admin_asset_broken_material.adsbm_id,
                                                      admin_asset_broken_material.adssbm_material_id,
                                                      admin_asset_broken_material.adsbm_material_name,
                                                      admin_asset_broken_material.adsbm_qty,
                                                      admin_asset_broken_material.adsbm_mou
                                                      FROM admin_asset_broken_material LEFT JOIN admin_asset_broken
                                                      ON admin_asset_broken.adssb_material_id = admin_asset_broken_material.adssbm_material_id
                                                      WHERE admin_asset_broken.adassb_id = '$id'";
                                                      
                                       $result_m = mysqli_query($connect, $sql_m);
                                       $i = 1;
                                       while ($row_m = mysqli_fetch_assoc($result_m)) {
                                          $v_i = $i++;
                                    ?>
                                          <tr>
                                             <td class="text-center"><?= $v_i; ?></td>
                                             <td class="text-center"><input type="text" class="form-control" value="<?=$row_m['adssbm_material_id']; ?>"></td>
                                             <td class="text-center"><input type="text" class="form-control" value="<?=$row_m['adsbm_material_name']; ?>"></td>
                                             <td class="text-center"><input type="text" class="form-control" value="<?=number_format($row_m['adsbm_qty']); ?>"></td>
                                             <td class="text-center">
                                             <?php 
                                                      $mou_id = $row_m['adsbm_mou'];
                                                      if($mou_id == null || $mou_id== 0){
                                                         echo $mou_id=null;
                                                      }else{
                                                          $sql = "SELECT * FROM text_asset_in_mou WHERE aim_id = '$mou_id'";
                                                      $result = $connect->query($sql);
                                                      $row = $result->fetch_assoc();
                                                      echo $row['aim_name']; 
                                                      }
                                                                                                      ?>
                                             </td>
                                             <td class="th_none_display text-center" style="width: 100px; vertical-align: middle; ">
                                                <a style="color: white;" class="btn btn_no_print btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="admin_asset_broken_view.php?id=<?= $row_m['adsbm_id']; ?>"><i class="fa fa-trash"></i></a>
                                             </td>
                                          </tr>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                           <div class="form-group col-xs-12 text-right">
                              <button type="submit" onclick="window.print();" class="no_print btn btn-success btn-lg"><i class="fa fa-print fa-fw"></i> Print</button>
                              <a href="admin_asset_broken.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
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
         $("#asset_broken").addClass("active");
         $("#asset_broken").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
      function doUpdate(id){
         $("#eidt_id").val();
      }
   </script>
</body>

</html>