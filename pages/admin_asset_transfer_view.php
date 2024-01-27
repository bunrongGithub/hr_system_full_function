<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$id_select ?? $_GET['id'];
if (isset($_GET['id'])) {
   $id_select = $_GET['id'];
   $SQL = "SELECT * FROM admin_asset_transfer WHERE adasst_id = '$id_select'";
   $result = mysqli_query($connect, $SQL);
   $row = mysqli_fetch_assoc($result);
   /** row  */
   $_code = $row['adasst_code'];
   $_type = $row['adasst_type'];
   $_category = $row['adasst_category'];
   $_asset_name = $row['adasst_asset_name'];
   $_asset_qty = $row['adasst_qty'];
   $_asset_mou = $row['adasst_mou'];
   $_total = $row['adasst_total'];
   $_transfer_no = $row['adasst_transfer_no'];
   $_transfer_from = $row['adasst_company_transfer_from'];
   $_transfer_to = $row['adasst_company_transfer_to'];
   $_transfer_date = $row['adasst_transfer_date'];
   $_current_price = $row['adasst_unit_price'];
   $_status = $row['adasst_status'];
   $_date = $row['adasst_date'];
   $_reason = $row['adasst_reason'];
   $_img = $row['adasst_img'];
   $_branch_tf_from = $row['adasst_branch_tf_from'];
   $_branch_tf_to = $row['adasst_branch_tf_to'];
}
if (isset($_GET['deleted'])) {
   $id_select ?? $_GET['id'];
   $id_delete = $_GET['deleted'];
   $sql = "DELETE from admin_asset_transfer_material where adasstm_id = $id_delete";
   $result = mysqli_query($connect, $sql);
   header("location: admin_asset_transfer_view.php?id=" . $id_select . "");
   exit();
}
if (isset($_POST['btn_update'])) {
   $_post_id = $_POST['mat_id'];
   $_post_mat_name = $_POST['mat_name'];
   $_post_qty = $_POST['mat_qty'];
   $_post_remark = $_POST['mat_remark'];
   $_post_mou = $_POST['mat_mou'];
   $_sql = "UPDATE admin_asset_transfer_material SET adasstm_name ='$_post_mat_name',
                                                      adasstm_qty ='$_post_qty',
                                                      adasstm_remark='$_post_remark',
                                                      adasstm_mou='$_post_mou' WHERE adasstm_id = '$_post_id'";
   $result = mysqli_query($connect, $_sql);
   header("location: admin_asset_transfer_view.php?id=" . $id_select . "");
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

         .form-none_display {
            border: none;
            outline: none;
         }

         .th_none_display {
            display: none;
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
            <h1>Admin Asset Transfer</h1>
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
                                 <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                              </div>
                              <form action="" enctype="multipart/form-data" method="post">
                                 <input type="hidden" id="mat_id" name="mat_id">
                                 <div class="modal-body">
                                    <div class="col-xs-12">
                                       <div class="col-xs-6">
                                          <label for="">Material_Name:</label>
                                          <input type="text" name="mat_name" class="form-control" id="mat_name">
                                       </div>
                                       <div class="col-xs-6">
                                          <label for="">QTY:</label>
                                          <input type="text" name="mat_qty" class="form-control" id="mat_qty">
                                       </div>
                                       <div class="col-xs-6">
                                          <label for="mat_mou" class="form-label">Mou:</label>
                                          <select name="mat_mou" id="mat_mou" class="form-control" data-live-search="true">
                                             <option selected value=""></option>
                                             <?php
                                             $sql = "SELECT * FROM text_asset_in_mou";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['aim_id'] . '>' . $row['aim_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-xs-6">
                                          <label for="">Remark:</label>
                                          <textarea rows="2" name="mat_remark" class="form-control" id="mat_remark"></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btn_update" class="btn btn-sm btn-primary">Save</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-12">
                           <div class="row_asset row col-xs-4">
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
                                 <label for="">Asset Type:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php

                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_type == $row_se['acct_id']) {
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
                              <?php
                              if ($_branch_tf_from != 0) {
                                 $sql = "select ub_id,ub_name as name from user_branch where ub_id = $_branch_tf_from";
                                 $stmt = $connect->query($sql);
                                 $fetch = $stmt->fetch_assoc();
                                 $rows_branch_tf_from = $fetch['name'];
                              }else{
                                 $rows_branch_tf_from = 0;
                              }
                              ?>
                              <div class="form-group col-xs-12">
                                 <label for="">Branch Transfer From:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $rows_branch_tf_from ?>" name="" id="" class="form-control">
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
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_total . '$' ?>" class="form-control">
                                 </div>
                              </div>
                           </div>
                  
                           <div class="row_asset row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Transfer No:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $_transfer_no ?>" name="" id="" class="form-control">
                              </div>
                              <?php
                              if ($_transfer_from != 0) {
                                 $sql = "select c_id,c_name_kh as name from company where c_id = $_transfer_from";
                                 $stmt = $connect->query($sql);
                                 $fetch = $stmt->fetch_assoc();
                                 $rows_company_tf_from = $fetch['name'];
                              }else{
                                 $rows_company_tf_from = 0;
                              }
                              ?>
                              <div class="form-group col-xs-12">
                                 <label for="">Company Transfer From:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $rows_company_tf_from ?>" name="" id="" class="form-control">
                              </div>
                              <?php
                              if ($_transfer_to != 0) {
                                 $sql = "select c_id,c_name_kh as name from company where c_id = $_transfer_to";
                                 $stmt = $connect->query($sql);
                                 $fetch = $stmt->fetch_assoc();
                                 $rows_company_tf_to = $fetch['name'];
                              }else{
                                 $rows_company_tf_to = 0;
                              }
                              ?>
                              
                              <div class="form-group col-xs-12">
                                 <label for="">Company Transfer To:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $rows_company_tf_to ?>" name="" id="" class="form-control">
                              </div>
                           
                              <?php
                              if ($_branch_tf_to != 0) {
                                 $sql = "select ub_id,ub_name as name from user_branch where ub_id = $_branch_tf_to";
                                 $stmt = $connect->query($sql);
                                 $fetch = $stmt->fetch_assoc();
                                 $rows_branch_tf_to = $fetch['name'];
                              }else{
                                 $rows_branch_tf_to = 0;
                              }
                              ?>
                              <div class="form-group col-xs-12">
                                 <label for="">Branch Transfer To:</label>
                                 <input style="font-weight: 800;" type="text" value="<?= $rows_branch_tf_to ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Transfer Date:</label>
                                 <input style="font-weight: 800;" type="date" value="<?= $_transfer_date ?>" name="" id="" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Current Unit Price:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_current_price . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Status:</label>
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
                              <div class="form-group col-xs-12">
                                 <label for="">Start Date:</label>
                                 <input style="font-weight: 800;" type="date" value="<?= $_date ?>" name="" id="" class="form-control">
                              </div>

                           </div>

                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label>Photo:</label><br />
                                 <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($_img != '') {
                                                                                                                                          echo 'upload/asset_transfer/' . $_img;
                                                                                                                                       } else {
                                                                                                                                          echo 'no_image.jpg';
                                                                                                                                       } ?>">
                                 <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*""></input>
                              </div>
                           </div>
                           <div class=" form-group col-xs-8">
                                 <label for="">Reason:</label>
                                 <textarea style="font-weight: 800;" type="" value="<?= $_reason ?>" name="" id="" rows="2" class="form-control"><?= $_reason ?></textarea>
                              </div>
                              <div class="row col-xs-10">
                                 <table id='info_data' class="table table-striped table-responsive table-bordered">
                                    <thead>
                                       <tr>
                                          <th class="text-center">No</th>
                                          <th class="text-center">Material Name</th>
                                          <th class="text-center">QTY</th>
                                          <th style="width: 150px;" class="text-center">Mou</th>
                                          <th style="width: 150px;" class="text-center">Remark</th>
                                          <th class="th_none_display text-center">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $sql_mat = "SELECT * FROM admin_asset_transfer_material 
                                                   LEFT JOIN text_asset_in_mou ON text_asset_in_mou.aim_id = admin_asset_transfer_material.adasstm_mou
                                       WHERE adasstm_materail_id = $id_select";
                                       $_query_mat = $connect->query($sql_mat);
                                       $i = 1;
                                       while ($row_mat = $_query_mat->fetch_assoc()) {
                                          $_count_i = $i++;
                                          $_material_name = $row_mat['adasstm_name'];
                                          $_material_qty = $row_mat['adasstm_qty'];
                                          $_material_mou = $row_mat['aim_name'];
                                          $_mater_remark = $row_mat['adasstm_remark'];
                                       ?>
                                          <tr>
                                             <td class="text-center"><?= $_count_i; ?></td>
                                             <td class="text-center"><?= $_material_name ?></td>
                                             <td class="text-center"><?= $_material_qty ?></td>
                                             <td class="text-center"><?= $_material_mou ?></td>
                                             <td class="text-center"><?= $_mater_remark ?></td>
                                             <td class="th_none_display text-center" style="width: 100px; vertical-align: middle; ">
                                                <a onclick="doUpdate('<?= $row_mat['adasstm_id']; ?>',
                                                                     '<?= $row_mat['adasstm_name']; ?>',
                                                                     '<?= $row_mat['adasstm_qty']; ?>',
                                                                     '<?= $row_mat['adasstm_remark']; ?>',
                                                                     '<?= $row_mat['adasstm_mou']; ?>',
                                                                     );" style="color: white;" class="btn btn_no_print btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                   <i class="fa fa-edit"></i>
                                                </a>
                                                <a style="color: white;" class="btn btn_no_print btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="admin_asset_transfer_view.php?id=<?= $id_select ?>&deleted=<?= $row_mat['adasstm_id']; ?>">
                                                   <i class="fa fa-trash">
                                                   </i>
                                                </a>
                                             </td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="form-group col-xs-12 text-right">
                              <a href="admin_asset_transfer.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
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
         $("#asset_transfer").addClass("active");
         $("#asset_transfer").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });

      function doUpdate(id, name, qty, remark, mou) {
         // console.log(id,name,qty,remark,mou);
         $("#mat_id").val(id);
         $("#mat_name").val(name);
         $("#mat_qty").val(qty);
         $("#mat_remark").val(remark);
         $("#mat_mou").val(mou).change();
      }
   </script>
</body>

</html>