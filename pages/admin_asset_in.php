<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$targetDir = "../img/upload/asset_in/";
$target_file = "../img/file/";

$v_image = '';
if (isset($_POST['btnadd'])) {
   $v_image = $_FILES['asset_image']['name'];
   $v_filename = '';
   $v_asset_no = $_POST['asset_no'];
   $v_asset_pano_ref = $_POST['asset_pano_ref'];
   $v_asset_category = $_POST['asset_category'];
   $v_asset_code = $_POST['asset_code'];
   $v_asset_type = $_POST['asset_type'];
   $v_asset_unit_price = $_POST['asset_unit_price'];
   $v_asset_total_amount = $_POST['asset_total_amount'];
   $v_asset_location = $_POST['asset_location'];
   $v_asset_start_date = $_POST['asset_start_date'];
   $v_asset_status = $_POST['asset_status'];
   $v_asset_supplier_name = $_POST['asset_supplier_name'];
   $v_asset_inv_no_ref = $_POST['asset_inv_no_ref'];
   $v_asset_contact = $_POST['asset_contact'];
   $v_asset_WarrantyPeriod = $_POST['asset_WarrantyPeriod'];
   $v_asset_Warranty_Condition = $_POST['asset_Warranty_Condition'];
   $v_asset_Inspection = $_POST['asset_Inspection'];
   // $v_assert_no_insert = $_POST['asset_no_insert']; //
   //$v_asset_mater_name = $_POST['asset_material']; //
   //$v_qty_insert = $_POST['asset_qty_insert']; //
   //$v_asset_inmou = $_POST['asset_in_mou'];
   //$v_asset_remark = $_POST['asset_remark']; //
   //$v_material_support = [$v_assert_no_insert,$v_asset_mater_name,$v_qty_insert,$v_asset_inmou];
   $v_asset_name = $_POST['asset_name'];
   $v_asset_comment = $_POST['asset_comment'];
   $v_asset_qty = $_POST['asset_qty'];
   $v_asset_mou = $_POST['asset_mou'];
   if (!empty($_FILES['asset_attach_file']['name'])) {
      $v_file = $_FILES['asset_attach_file'];
      $target_file .= basename($_FILES['asset_attach_file']['name']);
      $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      if ($file_type === "pdf") {
         $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pdf";
         move_uploaded_file($v_file['tmp_name'], "../img/file/" . $new_name);
      }
   }
   $v_img_name = '';
   if (!empty($v_image)) {
      $v_img_name = date("Ymd") . '_' . basename($_FILES['asset_image']['name']);
      $v_img_fullname = $targetDir . date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      move_uploaded_file($_FILES['asset_image']['tmp_name'], $v_img_fullname);
   }
   $v_material_id = $_POST['material_id'];
   $sql_insert = "INSERT INTO admin_asset_in(adassi_img,adassi_no,adassi_ref,adassi_category_id
                                            ,adassi_code_id,adassi_type,adassi_unit_price
                                            ,adassi_total,adassi_location,adassi_date
                                            ,adassi_status,adassi_supplier_name,adassi_inv_ref
                                            ,adassi_contact,adassi_war_peri,adassi_war_con
                                            ,adassi_insepection,adassi_asset_name,adassi_note
                                            ,adassi_qty,adassi_mou,adassi_file,adassi_created_date,material_id)
                                            VALUES ('$v_img_name','$v_asset_no','$v_asset_pano_ref','$v_asset_category'
                                                ,'$v_asset_code','$v_asset_type','$v_asset_unit_price'
                                                ,'$v_asset_total_amount','$v_asset_location','$v_asset_start_date'
                                                ,'$v_asset_status','$v_asset_supplier_name','$v_asset_inv_no_ref'
                                                ,'$v_asset_contact','$v_asset_WarrantyPeriod','$v_asset_Warranty_Condition'
                                                ,'$v_asset_Inspection','$v_asset_name','$v_asset_comment'
                                                ,'$v_asset_qty','$v_asset_mou','$new_name',NOW(),'$v_material_id')";
   $result = mysqli_query($connect, $sql_insert);
   if (!empty($_POST['asset_material']) || !empty($_POST['asset_remark'])) {
      for ($a = 0; $a < count($_POST['asset_material']); $a++) {
         $sql_m = "INSERT INTO admin_asset_in_material(
                                                         adasim_name
                                                         ,adasim_qty
                                                         ,adasim_mou
                                                         ,adasim_material_id
                                                         ,adasim_remark
                                                      )VALUES(
                                                         '" . $_POST['asset_material'][$a] . "'
                                                         ,'" . $_POST['asset_qty_insert'][$a] . "'
                                                         ,'" . $_POST['asset_in_mou'][$a] . "'
                                                         ,'" . $v_material_id . "'
                                                         ,'" . $_POST['asset_remark'][$a] . "'
                                                      )";
         mysqli_query($connect, $sql_m);
      }
      header('location:admin_asset_in.php?message=success');
      exit();
   }
}
if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];
   $sql_delete = "DELETE FROM admin_asset_in WHERE adassi_id = $id";
   $result = mysqli_query($connect, $sql_delete);
   header("location: admin_asset_in.php?message=delete");
   exit();
}
if (isset($_POST["btnimage"])) {
   $id = $_POST['asset_photo'];
   if (!empty($_FILES['edit_photo']['name'])) {
      $v_filename = date("Ymd") . "_id" . $id . basename($_FILES['edit_photo']['name']);
      $v_filefullname = $targetDir . date("Ymd") . "_id" . $id . basename($_FILES['edit_photo']['name']);
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_filefullname);
      $sql = "UPDATE admin_asset_in SET adassi_img = '$v_filename' where adassi_id = $id";
      $result = mysqli_query($connect, $sql);
   }
   header('location:admin_asset_in.php?message=success');
   exit();
}

if (isset($_POST['btnUdate'])) {
   $v_asset_no = $_POST['edit_asset_no'];
   $v_category = $_POST['edit_category'];
   $v_code = $_POST['edit_code'];
   $v_edit_as_type = $_POST['edit_as_type'];
   $v_edit_name = $_POST['edit_name'];
   $v_edit_qty = $_POST['edit_qty'];
   $v_edit_unit_price = $_POST['edit_unit_price'];
   $v_edit_total_amount = $_POST['edit_total_amount'];
   $v_edit_mou = $_POST['edit_mou'];
   $v_edit_start_date = $_POST['edit_start_date'];
   $v_edit_status = $_POST['edit_status'];
   $v_edit_supplier = $_POST['edit_supplier'];
   $v_edit_inv_no_ref = $_POST['edit_inv_no_ref'];
   $v_edit_contact = $_POST['edit_contact'];
   $v_edit_warry_period = $_POST['edit_warry_period'];
   $v_edit_warry_con = $_POST['edit_warry_con'];
   $v_edit_Inspection = $_POST['edit_Inspection'];
   $v_edit_location = $_POST['edit_location'];
   $v_edit_comment = $_POST['edit_comment'];



   $sql_update = "UPDATE admin_asset_in SET adassi_no = '$v_asset_no'
                                          ,adassi_category_id='$v_category'
                                          ,adassi_code_id = '$v_code'
                                          ,adassi_type = '$v_edit_as_type'
                                          ,adassi_asset_name = '$v_edit_name'
                                          ,adassi_qty = '$v_edit_qty'
                                          ,adassi_unit_price='$v_edit_unit_price'
                                          ,adassi_total = '$v_edit_total_amount'
                                          ,adassi_mou = '$v_edit_mou'
                                          ,adassi_date = '$v_edit_start_date'
                                          ,adassi_status = '$v_edit_status'
                                          ,adassi_supplier_name = '$v_edit_supplier'
                                          ,adassi_inv_ref = '$v_edit_inv_no_ref'
                                          ,adassi_contact = '$v_edit_contact'
                                          ,adassi_war_peri = '$v_edit_warry_period'
                                          ,adassi_war_con = '$v_edit_warry_con'
                                          ,adassi_insepection = '$v_edit_Inspection'
                                          ,adassi_location = '$v_edit_location'
                                          ,adassi_note = '$v_edit_comment'
                                          ,adassi_updated_date = NOW()";
   $result_up = mysqli_query($connect, $sql_update);
   header('location:admin_asset_in.php?message=update');
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">

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
      <?php include "left_menu.php" ?>
      <aside class="right-side">
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
            <h1>Admin Asset In</h1>
         </section>
         <section class="content">
            <div class="row">
               <!-- modal_add_new  -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width: 750px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i>Add New</h4>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                           <div class="modal-body">
                              <div class="col-md-12">
                                 <div class="form-group col-md-4">
                                    <label style="font-size: 20px;" for="">Asset Photo</label>
                                    <figure class="figure">
                                       <img src="../img/no_image.jpg" id="asset_show_photo" class="rounded img-thumbnail img-fuild" height="900px;" alt="..." />
                                    </figure>
                                    <input class="form-control" type="file" name="asset_image" id="asset_image" accept="image/*" onchange="show_photo_pre_add(event);">
                                    <div class=" col-md-12">
                                       <label for="asset_Inspection">Inspection:</label>
                                       <input class="form-control" type="text" name="asset_Inspection" id="asset_Inspection">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_WarrantyPeriod">Warranty Period:</label>
                                       <input class="form-control" type="number" name="asset_WarrantyPeriod" id="asset_WarrantyPeriod">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_Warranty_Condition">Warranty Condition:</label>
                                       <input class="form-control" type="text" name="asset_Warranty_Condition" id="asset_Warranty_Condition">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_location">Location:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                          <input class="form-control" type="text" name="asset_location" id="asset_location">
                                       </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="material_id">Material ID</label>
                                       <input required type="number" name="material_id" class="form-control" id="material_id">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="col-md-12">
                                       <label style="font-size: 20px;" for="">Asset Information</label>
                                    </div>
                                    <div class="col-md-12">
                                       <label for="asset_no">Asset No:</label>
                                       <input class="form-control" type="text" name="asset_no" id="asset_no">
                                    </div>
                                    <div class="col-md-12">
                                       <label for="asset_pano_ref">PA No Ref.</label>
                                       <select class="form-control" name="asset_pano_ref" id="asset_pano_ref" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM asset_requisiton";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['as_id'] . '">' . $row['as_pa_no'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12">
                                       <label for="asset_category">Asset Category:</label>
                                       <select name="asset_category" id="asset_category" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ac_id'] . '">' . $row['as_asset_category'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12">
                                       <label for="asset_code">Asset Code:</label>
                                       <select name="asset_code" id="asset_code" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ac_id'] . '">' . $row['ac_asset_code'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_type">Asset Type:</label>
                                       <select name="asset_type" id="asset_type" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_code_creation_type";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['acct_id'] . '">' . $row['acct_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_name">Asset Name:</label>
                                       <input class="form-control" type="text" name="asset_name" id="asset_name">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_qty">Qty:</label>
                                       <input class="form-control" type="number" name="asset_qty" id="asset_qty">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_mou">Mou:</label>
                                       <select class="form-control" name="asset_mou" id="asset_mou" data-live-search="true">
                                          <option selected value="">
                                             <?php
                                             $sql = "SELECT * FROM text_asset_in_mou";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                             }
                                             ?>
                                          </option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class=" col-md-12">
                                       <label style="font-size: 20px;" for="">Calendar Selection</label>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_start_date">Start Date:</label>
                                       <input class="form-control" type="date" name="asset_start_date" id="asset_start_date">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_status">Status:</label>
                                       <select class="form-control" data-live-search="true" name="asset_status" id="asset_status">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_status";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ais_id'] . '">' . $row['ais_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_supplier_name">Supplier Name:</label>
                                       <input class="form-control" type="text" name="asset_supplier_name" id="asset_supplier_name">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_contact">Contact:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                          <input class="form-control" type="text" name="asset_contact" id="asset_contact">
                                       </div>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_inv_no_ref">Inv. No. Ref:</label>
                                       <input class="form-control" type="text" name="asset_inv_no_ref" id="asset_inv_no_ref">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_attach_file">Attach Inv.No:</label>
                                       <input class="form-control" required type="file" accept=".pdf" name="asset_attach_file" id="asset_attach_file" onchange="loadFile(event);">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_unit_price">Unit Price:</label>
                                       <input class="form-control" type="text" name="asset_unit_price" id="asset_unit_price">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="asset_total_amount">Total Amount:</label>
                                       <input class="form-control" type="text" name="asset_total_amount" id="asset_total_amount">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group col-md-12 ">
                                 <label for="asset_comment">Comment:</label>
                                 <textarea class="form-control" name="asset_comment" id="asset_comment" rows="1"></textarea>
                              </div>
                              <div class="form-group col-md-12">
                                 <table id="asset_table" class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th class="text-center">No.</th>
                                          <th class="text-center">Material Name</th>
                                          <th class="text-center">Qty</th>
                                          <th style="width: 200px;" class="text-center">Mou</th>
                                          <th class="text-center">Remark</th>
                                          <th class="text-center"><i class="fa fa-cog"></i></th>
                                       </tr>
                                    </thead>
                                 </table>
                                 <div class="box-body">
                                    <div class="button-group">
                                       <a href="javascript:void(0)" class="add-row btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add Item</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                              <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;&nbsp;Close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_add_new  -->
               <!-- modal_imag  -->
               <div class="modal fade" id="myModal_image" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Image</h4>
                        </div>
                        <div class="modal-body">
                           <div class="col-md-12">
                              <form method="post" enctype="multipart/form-data" action="">
                                 <input type="hidden" id="asset_photo" name="asset_photo" />
                                 <input type="hidden" name="txt_old_img" id="txt_old_img">
                                 <div class="form-group col-lg-12">
                                    <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="...">
                                    <br />
                                    <label>Upload Photo Here:</label>
                                    <input type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*" onchange="show_photo_pre(event);"></input>
                                 </div>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="btnimage" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end_modal_image  -->
               <!-- modal_view  -->
               <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width: 800px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Admin Asset In</h4>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form accept-charset="utf-8" role="form" action="" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="v_asset_id" id="v_asset_id">
                                    <input type="hidden" name="v_old_img" id="v_old_img">
                                    <div class="col-md-12">
                                       <div class="col-xs-4">
                                          <div class="form-group col-md-12">
                                             <h3>Asset Photo</h3>
                                          </div>
                                          <div class="col-md-12">
                                             <figure class="figure">
                                                <img src="" id="v_show_photo" class="img-responsive figure-img img-fluid rounded" alt="" />
                                             </figure>
                                             <input style="visibility: hidden;" type="file" name="logofile" id="logofile" onchange="show_photo_pre(event);">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-4">
                                          <div class="form-group col-md-12">
                                             <h3>Asset Information</h3>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="">Asset No:</label>
                                             <input class="form-control" name="v_asset_no" id="v_asset_no" type="text">
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_pano_ref" class="form-label">PA No Ref. </label>
                                             <select name="v_pano_ref" id="v_pano_ref" class="form-control" data-live-search="true">
                                                <option disabled value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM asset_requisiton";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option disabled value="' . $row['as_id'] . '">' . $row['as_pa_no'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_category">Asset Categoty:</label>
                                             <select class="form-control" name="v_category" id="v_category" data-live-search="true">
                                                <option disabled value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM assest_code_creation";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option disabled value="' . $row['ac_id'] . '" >' . $row['as_asset_category'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_as_code">Asset Code:</label>
                                             <select class="form-control" name="v_as_code" id="v_as_code" data-live-search="true">
                                                <option disabled value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM assest_code_creation";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option disabled value="' . $row['ac_id'] . '" >' . $row['ac_asset_code'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_asset_type">Asset Type:</label>
                                             <select class="form-control" name="v_asset_type" id="v_asset_type" data-live-search="true">
                                                <option disabled value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM text_asset_code_creation_type";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option disabled value="' . $row['acct_id'] . '" >' . $row['acct_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_asset_name">Asset Name:</label>
                                             <input type="text" name="v_asset_name" id="v_asset_name" class="form-control">
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_qty">QTY:</label>
                                             <input class="form-control" type="text" name="v_qty" id="v_qty">
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_unit_price">Unit Price:</label>
                                             <input class="form-control" type="text" name="v_unit_price" id="v_unit_price">
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_total_am">Total Amount:</label>
                                             <input class="form-control" type="text" name="v_total_am" id="v_total_am">
                                          </div>

                                       </div>
                                       <div class="form-group col-xs-4">
                                          <div class="form-group col-md-12">
                                             <h3>Auto Calendar</h3>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_start_date">Asset Start Date:</label>
                                             <input class="form-control" name="v_start_date" id="v_start_date" type="date">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_status">Asset Status</label>
                                             <select class="form-control" name="v_status" id="v_status" data-live-search="true">
                                                <option disabled value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM text_asset_in_status";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option disabled value="' . $row['ais_id'] . '" >' . $row['ais_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_supplier_name">Supplier Name:</label>
                                             <input class="form-control" type="text" name="v_supplier_name" id="v_supplier_name">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_contact">Contact :</label>
                                             <input class="form-control" type="text" name="v_contact" id="v_contact">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_inv_no_ref">Inv. No. Ref.</label>
                                             <input class="form-control" type="text" name="v_inv_no_ref" id="v_inv_no_ref">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_warry_period">Warranty Period</label>
                                             <input class="form-control" type="number" name="v_warry_period" id="v_warry_period">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_warry_condition">Warranty Condition</label>
                                             <input class="form-control" type="text" name="v_warry_condition" id="v_warry_condition">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="v_Inspection">Inspection:</label>
                                             <input class="form-control" type="text" name="v_Inspection" id="v_Inspection">
                                          </div>
                                          <div class="col-md-12 form-group">
                                             <label for="v_location">Location:</label>
                                             <input class="form-control" type="text" name="v_location" id="v_location">
                                          </div>
                                       </div>
                                       <div class="form-group col-md-4">
                                       </div>
                                       <div class="form-group col-md-8">
                                          <label for="v_asset_type">Mou:</label>
                                          <select class="form-control" name="v_mou" id="v_mou" data-live-search="true">
                                             <option disabled value=""></option>
                                             <?php
                                             $sql = "SELECT * FROM text_asset_in_mou";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option disabled value="' . $row['aim_id'] . '" >' . $row['aim_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>

                                       <div class="col-md-12 form-group">
                                          <label for="v_commment">Comment:</label>
                                          <textarea class="form-control" name="v_commment" id="v_commment" rows="2"></textarea>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end_modal_view  -->
               <!-- .modal_update  -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-primary" id="exampleModalLongTitle"><i class="fa fa-edit"></i>&nbsp;Update Asset In</h3>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="id_update" id="id_update">
                              <div class="col-md-12">
                                 <div class="col-md-6">
                                    <div class=" col-md-12">
                                       <h3>Asset Information</h3>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_asset_no" class="form-label">Asset No</label>
                                       <input type="text" name="edit_asset_no" id="edit_asset_no" class="form-control">
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_pano_ref" class="form-label">PA No Ref. </label>
                                       <select name="edit_pano_ref" id="edit_pano_ref" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM asset_requisiton";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['as_id'] . '">' . $row['as_pa_no'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_category" class="form-label">Asset Category:</label>
                                       <select name="edit_category" id="edit_category" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ac_id'] . '">' . $row['as_asset_category'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_code" class="form-label">Asset Code:</label>
                                       <select name="edit_code" id="edit_code" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ac_id'] . '">' . $row['ac_asset_code'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_as_type" class="form-label">Asset Type:</label>
                                       <select name="edit_as_type" id="edit_as_type" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_code_creation_type";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['acct_id'] . '">' . $row['acct_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_name" class="form-label">Asset Name:</label>
                                       <input type="text" name="edit_name" id="edit_name" class="form-control" />
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_qty" class="form-label">QTY:</label>
                                       <input type="number" name="edit_qty" id="edit_qty" class="form-control" />
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_unit_price" class="form-label">Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="number" name="edit_unit_price" id="edit_unit_price" class="form-control" />
                                       </div>
                                    </div>
                                    <div class="col-md-12 ">
                                       <label for="edit_total_amount" class="form-label">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_total_amount" id="edit_total_amount" class="form-control" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class=" col-md-12">
                                       <h3>Calendar Selection</h3>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_start_date" class="form-label">Start Date:</label>
                                       <input type="date" name="edit_start_date" id="edit_start_date" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_status" class="form-label">Asset Status:</label>
                                       <select name="edit_status" id="edit_status" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_status";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['ais_id'] . '">' . $row['ais_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_supplier" class="form-label">Supplier Name:</label>
                                       <input type="text" name="edit_supplier" id="edit_supplier" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_contact" class="form-label">Contact:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                          <input type="text" name="edit_contact" id="edit_contact" class="form-control">
                                       </div>
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_inv_no_ref" class="form-label">Inv. No. Ref:</label>
                                       <input type="text" name="edit_inv_no_ref" id="edit_inv_no_ref" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_warry_period" class="form-label">Warranty Period</label>
                                       <input type="number" name="edit_warry_period" id="edit_warry_period" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_warry_con" class="form-label">Warranty Condition</label>
                                       <input type="text" name="edit_warry_con" id="edit_warry_con" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_Inspection" class="form-label">Inspection:</label>
                                       <input type="text" name="edit_Inspection" id="edit_Inspection" class="form-control">
                                    </div>
                                    <div class=" col-md-12">
                                       <label for="edit_location" class="form-label">Location:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                          <input type="text" name="edit_location" id="edit_location" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 ">
                                    <label for="">Comment:</label>
                                    <textarea class="form-control" name="edit_comment" id="edit_comment" rows="2"></textarea>
                                 </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btnUdate" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
                           <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Back</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_update  -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                        </button>
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-hover table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Asset Code</th>
                                    <th class="text-center">Asset Type</th>
                                    <th class="text-center">Asset Name</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Supplier Name</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">PA No Ref.</th>
                                    <th class="text-center">Inv No Ref.</th>
                                    <th class="text-center">Asset Status</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Attah File</th>
                                    <th style="width: 140px;" class="text-center"><i class="fa fa-cog"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql_query = "SELECT * FROM admin_asset_in LEFT JOIN assest_code_creation ON assest_code_creation.ac_id = admin_asset_in.adassi_code_id
																		left join text_asset_in_mou on text_asset_in_mou.aim_id = admin_asset_in.adassi_mou
                                                                        LEFT JOIN text_asset_code_creation_type ON text_asset_code_creation_type.acct_id = admin_asset_in.adassi_type
                                                                        left join asset_requisiton on asset_requisiton.as_id = admin_asset_in.adassi_ref
                                                                        left join text_asset_in_status on text_asset_in_status.ais_id = admin_asset_in.adassi_status
                                                                        left join admin_asset_in_material on admin_asset_in_material.adasim_id = admin_asset_in.material_id";
                                 $result_query = $connect->query($sql_query);
                                 $i = 1;
                                 while ($row = $result_query->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_asset_code = $row['ac_asset_code'];
                                    $v_asset_type = $row['acct_name'];
                                    $v_asset_name = $row['adassi_asset_name'];
                                    $v_asset_start_date = $row['adassi_date'];
                                    $v_asset_qty = $row['adassi_qty'];
                                    $v_asset_unit_price = $row['adassi_unit_price'];
                                    $v_total_amount = $row['adassi_total'];
                                    $v_asset_supplier_name = $row['adassi_supplier_name'];
                                    $v_asset_contact = $row['adassi_contact'];
                                    $v_pano_ref = $row['as_pa_no'];
                                    $v_inv_no_ref = $row['adassi_inv_ref'];
                                    $v_asset_in_status = $row['ais_name'];
                                    $v_asset_img = $row['adassi_img'];
                                    $v_asset_file = $row['adassi_file'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_code; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_type; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_start_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_qty; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo number_format($v_asset_unit_price) . "$"; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo number_format($v_total_amount) . "$" ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_supplier_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_contact; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_pano_ref; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_inv_no_ref; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_asset_in_status; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a target="_blank" href="../../hr_system_v1/img/upload/asset_in/<?php echo $row['adassi_img'] ?>">
                                             <img class="rounded img-fuild" src="../img<?php if ($v_asset_img != '') {
                                                                                          echo '/upload/asset_in/' . $v_asset_img;
                                                                                       } else {
                                                                                          echo '/no_image.jpg';
                                                                                       } ?>" ismap style="width:100px; height:100px;" />
                                          </a>
                                          <a style="float:right; cursor:pointer;" onclick="doImage(<?php echo $row['adassi_id']; ?>,
                                                      '<?php echo $v_asset_img; ?>')" data-toggle="modal" data-target="#myModal_image">
                                             <i style="color:#3c8dbc;" class="fa fa-pencil "></i>
                                          </a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          if ($v_asset_file == '') {
                                          ?>
                                             <a target="_blank" href="../img/file/image_no_file.png">
                                                <img width="50px" height="50px" src="../img/file/image_no_file.png" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target="_blank" href="../img/file/<?php echo $v_asset_file; ?>">
                                                <img width="50px" height="50px" src="../img/file/pdf_image.png" alt="">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a style="color: white;" class="btn btn-sm btn-info" href="admin_asset_in_view.php?id=<?= $row['adassi_id'] ?>&&material_id=<?= $row['material_id']; ?>"><i class="fa fa-eye"></i></a>
                                          <a onclick="DoUpdate('<?php echo $row['adassi_id']; ?>',
                                                               '<?php echo $row['adassi_no']; ?>',
                                                               '<?php echo $row['adassi_date']; ?>',
                                                               '<?php echo $row['adassi_category_id']; ?>',
                                                               '<?php echo $row['adassi_status']; ?>',
                                                               '<?php echo $row['adassi_code_id']; ?>',
                                                               '<?php echo $row['adassi_supplier_name']; ?>',
                                                               '<?php echo $row['adassi_type']; ?>',
                                                               '<?php echo $v_asset_contact; ?>',
                                                               '<?php echo $v_asset_name; ?>',
                                                               '<?php echo $v_inv_no_ref; ?>',
                                                               '<?php echo $v_asset_qty; ?>',
                                                               '<?php echo $row['adassi_war_peri']; ?>',
                                                               '<?php echo $row['adassi_unit_price']; ?>',
                                                               '<?php echo $row['adassi_war_con']; ?>',
                                                               '<?php echo $v_total_amount; ?>',
                                                               '<?php echo $row['adassi_insepection']; ?>',
                                                               '<?php echo $row['adassi_mou']; ?>',
                                                               '<?php echo $row['adassi_location']; ?>',
                                                               '<?php echo $row['adassi_note']; ?>',
                                                               '<?php echo $row['adassi_ref']; ?>',
                                                               )" style="color: white;" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#modal_update"><i class="fa fa-edit"></i></a>
                                          <a style="color: white;" class="btn-sm btn-danger btn" onclick="return confirm('Are you sure to delete?');" href="admin_asset_in.php?del_id=<?php echo $row['adassi_id']; ?>"><i class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
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
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
   <script type="text/javascript">
      function DoUpdate(id, as_no, as_date, as_category, status, as_code, supplier, as_type, contact, as_name, as_inv_no, as_qty, warry_period, unit_price, warry_con, tatal_amount, Inspection, mou, location, comment, pano_ref) {
         $("#id_update").val(id);
         $("#edit_asset_no").val(as_no);
         $("#edit_start_date").val(as_date);
         $("#edit_category").val(as_category).change();
         $("#edit_status").val(status).change();
         $("#edit_code").val(as_code).change();
         $("#edit_supplier").val(supplier);
         $("#edit_as_type").val(as_type).change();
         $("#edit_contact").val(contact);
         $("#edit_name").val(as_name);
         $("#edit_inv_no_ref").val(as_inv_no);
         $("#edit_qty").val(as_qty);
         $("#edit_warry_period").val(warry_period);
         $("#edit_unit_price").val(unit_price);
         $("#edit_warry_con").val(warry_con);
         $("#edit_total_amount").val(tatal_amount);
         $("#edit_Inspection").val(Inspection);
         $("#edit_mou").val(mou).change();
         $("#edit_location").val(location);
         $("#edit_comment").val(comment);
         $("#edit_pano_ref").val(pano_ref).change();
      }

      function doUpdate(id, asset_img, asset_no, start_date, category, status, asset_code, supplier_name, location, asset_type, contact, asset_name, inv_no_ref, v_qty, asset_in_mou, warry_period, warry_con, Inspection, comment, Unit_price, v_total_am, pano_ref) {
         $("#v_asset_id").val(id);
         if (asset_img == "" || asset_img == "NULL") {
            document.getElementById("v_show_photo").setAttribute("src", '../img/no_image.jpg');
         } else {
            document.getElementById("v_show_photo").setAttribute("src", '../img/upload/asset_in/' + asset_img);
         }
         $("#v_old_img").val(asset_img);
         $("#v_asset_no").val(asset_no);
         $("#v_start_date").val(start_date);
         $("#v_category").val(category).change();
         $("#v_status").val(status).change();
         $("#v_as_code").val(asset_code).change();
         $("#v_supplier_name").val(supplier_name);
         $("#v_location").val(location);
         $("#v_asset_type").val(asset_type).change();
         $("#v_contact").val(contact);
         $("#v_asset_name").val(asset_name);
         $("#v_inv_no_ref").val(inv_no_ref);
         $("#v_qty").val(v_qty);
         $("#v_mou").val(asset_in_mou).change();
         $("#v_warry_period").val(warry_period);
         $("#v_warry_condition").val(warry_con);
         $("#v_Inspection").val(Inspection);
         $("#v_commment").val(comment);
         $("#v_unit_price").val(Unit_price);
         $("#v_total_am").val(v_total_am);
         $("#v_pano_ref").val(pano_ref).change();
      }
      window.addEventListener('DOMContentLoaded', function() {
         $(document).ready(function() {
            var no = 1;
            $(".add-row").on('click', function() {
               // var material_no = "<td><input class='form-control' type='text' name='asset_material_no[]' id='asset_material_no'/></td>";
               var material = "<td><input class='form-control' name='asset_material[]' id='asset_material' type='text'></td>";
               var qty = "<td><input class='form-control' name='asset_qty_insert[]' id='asset_qty_insert' type='number'></td>";
               var mou = `<td>
                                 <select class='form-control' name='asset_in_mou[]' id='asset_in_mou'data-live-search="true">
                                    <option selected></option>
                                    <?php
                                    $sql = "SELECT * FROM text_asset_in_mou";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                       echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                    }
                                    ?>
                                 </select>
                              </td>`;
               var Remark = "<td><input class='form-control' name='asset_remark[]' id='asset_remark' type='text'></td>";
               var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
               //    var action = "<th class='text-center'><i class='fa fa-cog' ></i></th>";
               var markup = "<tr>" + "<td><input disable type='text' class='form-control' value='" + no + "' name='auto_count_id[]' id='auto_count_id'/></td>" + material + qty + mou + Remark + remove_button + "</tr>";
               $("#asset_table").append(markup); //    $("thead tr")[i].append(action);
               no++;
               $("#asset_table").on('click', '.remove-row', function() {
                  $(this).closest("tr").remove();
                  if ($("#asset_table")) {
                     no = 1;
                  }
               });
            });
         });
      });

      function loadFile(event) {
         var output = document.getElementById('file_upload');
         output.width = 50;
         output.scr = URL.createObjectURL(event.target.file[0])
      }
      var loadFile = function(event) {
         var output = document.getElementById('image_to_display');
         output.src = URL.createObjectURL(event.target.files[0]);
      };

      function doImage(id, photo) {
         $('#asset_photo').val(id);
         if (photo == '' || photo == "NULL") {
            document.getElementById('show_photo').setAttribute('src', '../img/no_image.jpg');
         } else {
            document.getElementById('show_photo').setAttribute('src', '../img/upload/asset_in/' + photo);
         }
         $("#txt_old_img").val(photo);
      }

      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }

      function show_photo_pre_add(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('asset_show_photo').src = src;
         }
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_in").addClass("active");
         $("#asset_in").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
      $(document).ready(function() {
         $('.qms-modal').resizable({
            //alsoResize: ".modal-dialog",
            minHeight: 300,
            minWidth: 300
         });
         $('.qms-dialog').draggable();
         $('#qmsManual').on('show.bs.modal', function() {
            $(this).find('.modal-body').css({
               'max-height': '100%'
            });
         });
      });
   </script>
</body>

</html>