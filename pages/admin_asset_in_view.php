<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$id ?? $_GET['id'];
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM admin_asset_in WHERE adassi_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   $_code = $row['adassi_code_id'];
   $_category = $row['adassi_category_id'];
   $_as_type = $row['adassi_type'];
   $_qty = $row['adassi_qty'];
   $_total = $row['adassi_total'];
   $_status = $row['adassi_status'];
   $_contact = $row['adassi_contact'];
   $_mou = $row['adassi_mou'];
   $_period = $row['adassi_war_peri'];
   $_location = $row['adassi_location'];
   $_as_no =  $row['adassi_no'];
   $_as_name = $row['adassi_asset_name'];
   $_pa_no_ref = $row['adassi_ref'];
   $_current_price = $row['adassi_unit_price'];
   $_strat_date = $row['adassi_date'];
   $_suppler_name = $row['adassi_supplier_name'];
   $_inv_no_ref = $row['adassi_inv_ref'];
   $_inspection = $row['adassi_insepection'];
   $_condition = $row['adassi_war_con'];
   $_comment = $row['adassi_note'];
   $_img = $row['adassi_img'];
}
if (isset($_GET['deleted'])) {
   $id_del = $_GET['deleted'];
   $sql = "DELETE FROM admin_asset_in_material where adasim_id = '$id_del'";
   $result = mysqli_query($connect, $sql);
   header("location:admin_asset_in_view.php?id=" . $id . "");
   exit();
}
if(isset($_POST['btn_update'])){
   $_post_id = $_POST['edit_txt_id'];
   $_post_qty = $_POST['edit_mater_qty'];
   $_post_material_name = $_POST['edit_mater_name'];
   $_post_mou = $_POST['edit_mater_mou'];
   $sql = "UPDATE admin_asset_in_material SET 
                                       adasim_name = '$_post_material_name',
                                       adasim_qty = '$_post_qty',
                                       adasim_mou = '$_post_mou' WHERE adasim_id = $_post_id";
   $result = mysqli_query($connect,$sql);
   header("location:admin_asset_in_view.php?id=" . $id . "");
   exit();
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
   <style>
      @media print {
         .no_print {
            display: none !important;
         }

         .dataTables_empty {
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

         .btn_no_print {
            display: none !important;
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
            <h1>Admin Asset In</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title text-primary" id="exampleModalLabel">Update Material</h4>
                              </div>
                              <form action="" method="post">
                                 <input type="hidden" name="edit_txt_id" id="edit_txt_id">
                                 <div class="modal-body">
                                    <div class="col-xs-12 form-group">
                                    <div class="form-group col-xs-6">
                                       <label for="">Material Name:</label>
                                       <input type="text" name="edit_mater_name" class="form-control" id="edit_mater_name">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">QTY:</label>
                                       <input type="text" name="edit_mater_qty" class="form-control" id="edit_mater_qty">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Mou:</label>
                                       <select type="text" name="edit_mater_mou" class="form-control" id="edit_mater_mou">
                                          <option value="">select</option>
                                          <?php 
                                             $sql = "SELECT * FROM text_asset_in_mou";
                                                $result = $connect->query($sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                   echo '<option value="'.$row['aim_id'].'">'.$row['aim_name'].'</option>';
                                                }
                                          ?>
                                       </select>
                                    </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="reset"  class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit"name="btn_update" class="btn btn-sm btn-primary">Save</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-12">
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Code:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY ac_asset_code ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_code == $row_se['ac_id']) {
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
                                 <label for="">Asset Category:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY as_asset_category ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_category == $row_se['ac_id']) {
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
                                 <label for="">Asset Type:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_as_type == $row_se['acct_id']) {
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
                                 <label for="">QTY:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_qty ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Total Amount:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_total . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Status:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_in_status ORDER BY ais_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_status == $row_se['ais_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['ais_id'] ?>"><?php echo $row_se['ais_name']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['ais_id'] ?>"><?php echo $row_se['ais_name']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="edit_contact" class="form-label">Contact:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" value="<?= $_contact ?>" name="edit_contact" id="edit_contact" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Mou:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_in_mou ORDER BY aim_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_mou == $row_se['aim_id']) {
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
                                 <label for="">Warranty Period:</label>
                                 <input style="font-weight: 800;" type="number" name="" value="<?= $_period ?>" id="" class="form-control">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="edit_location" class="form-label">Location:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <input value="<?= $_location ?>" type="text" name="edit_location" id="edit_location" class="form-control">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Asset No:</label>
                                 <input style="font-weight: 800;" type="text" name="" value="<?= $_as_no ?>" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Name:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_as_name ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">PA No Ref.:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM asset_requisiton ORDER BY as_pa_no ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_pa_no_ref == $row_se['as_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Current Unit Price:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_current_price . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Strat Date:</label>
                                 <input style="font-weight: 800;" type="date" value="<?= $_strat_date ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Supplier Name:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $_suppler_name ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Inv.No.Ref:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $_inv_no_ref ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Inspection:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $_inspection ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Warranty Condition:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $_condition ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-md-12 ">
                                 <label for="">Comment:</label>
                                 <textarea style="font-weight: 800;" class="form-control" name="edit_comment" id="edit_comment" rows="1"><?= $_comment ?></textarea>
                              </div>
                           </div>
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label>Photo:</label><br />
                                 <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($_img != '') {
                                                                                                                                          echo 'upload/asset_in/' . $_img;
                                                                                                                                       } else {
                                                                                                                                          echo 'no_image.jpg';
                                                                                                                                       } ?>" width="300x" height="300px">
                                 <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*"></input>
                              </div>
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
                                    <th class="text-center">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql_mat = "SELECT * FROM admin_asset_in_material A 
                                    LEFT JOIN text_asset_in_mou B ON B.aim_id = A.adasim_mou
                                    WHERE adasim_material_id = $id";
                                 $query = $connect->query($sql_mat);
                                 $i = 1;
                                 while ($row_mat = $query->fetch_assoc()) {
                                    $_count_i = $i++;
                                    $_materail_name = $row_mat['adasim_name'];
                                    $_materail_qty = $row_mat['adasim_qty'];
                                    $_materail_mou = $row_mat['aim_name'];
                                 ?>
                                    <tr>
                                       <td class="text-center"><?= $_count_i ?></td>
                                       <td class="text-center"><?= $_materail_name ?></td>
                                       <td class="text-center"><?= $_materail_qty ?></td>
                                       <td class="text-center"><?= $_materail_mou ?></td>
                                       <td class="text-center" style="width: 100px; vertical-align: middle; ">
                                          <a style="color: white;" class="btn btn_no_print btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="admin_asset_in_view.php?deleted=<?= $row_mat['adasim_id'] ?>&id=<?= $id ?>">
                                             <i class="fa fa-trash"></i>
                                          </a>
                                          <a style="color: white;" onclick="doUpdate('<?= $row_mat['adasim_id']; ?>',
                                                                                 '<?=$row_mat['adasim_name'];?>',
                                                                                 '<?=$row_mat['adasim_qty'];?>',
                                                                                 '<?=$row_mat['adasim_mou'];?>',//name,qty,mou 
                                                                              );" class="btn btn_no_print btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                        <div class="form-group col-xs-12 text-right">
                           <a href="admin_asset_in.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
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
   <script type='text/javascript'>
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_in").addClass("active");
         $("#asset_in").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });

      function doUpdate(id,name,qty,mou) {
         $("#edit_txt_id").val(id);
         $("#edit_mater_name").val(name);
         $("#edit_mater_qty").val(qty);
         $("#edit_mater_mou").val(mou).change();
      }
      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }
   </script>
</body>

</html>