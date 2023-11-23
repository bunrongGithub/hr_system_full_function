<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/asset_receive/receive_photo/";

if (isset($_POST["btnadd"])) {

   $v_transfer_id = $_POST['txt_tran_ref'];
   $v_from = $_POST['txt_transfer_from']; // auto 
   $v_to = $_POST['txt_transfer_to']; // auto
   $v_cotegory = $_POST['txt_category']; // auto
   $v_name = $_POST['txt_asset_name']; // auto
   $v_receive_date = $_POST['receive_date'];
   $v_qty = $_POST['txt_qty']; // auto
   $v_mou = $_POST['txt_mou'];
   $v_unit_price = $_POST['txt_unit_price'];
   $v_total = $_POST['txt_total_amount'];
   $v_remark = $_POST['txt_remark'];
   $v_material_id = $_POST['txt_material_id'];
   $v_status = $_POST['txt_status'];
   if (!empty($_FILES['txt_image']['name'])) {
      /////////////////upload image//////////////////////
      $v_imagename = date("Ymd") . "_" . basename($_FILES['txt_image']['name']);
      $v_imagefullname = $targetDir . $v_imagename;
      move_uploaded_file($_FILES['txt_image']['tmp_name'], $v_imagefullname);
      ////////////////////////////////////////////////////
   }
   $sql = "INSERT INTO admin_asset_receive(adassrt_tran_id
                                       ,adasstr_receive_date
                                       ,adassrt_mou
                                       ,adassrt_c_price
                                       ,adassrt_total
                                       ,adassrt_note
                                       ,adassrt_material_id
                                       ,adassrt_userid
                                       ,adassrt_created_date
                                       ,adassrt_status
                                       ,adassrt_img
                                       )
                                       VALUES('$v_transfer_id'
                                             ,'$v_receive_date'
                                             ,'$v_mou'
                                             ,'$v_unit_price'
                                             ,'$v_total'
                                             ,'$v_remark'
                                             ,'$v_material_id'
                                             ,'$user_id'
                                             ,NOW()
                                             ,'$v_status'
                                             ,'$v_imagename');";
   mysqli_query($connect, $sql);
   /**    Material form */
   if (isset($_POST['asset_material']) || isset($_POST['asset_remark']) || isset($_POST['asset_qty_insert'])) {
      for ($a = 0; $a < count($_POST['asset_material']); $a++) {
         $sql_m = "INSERT INTO admin_asset_receive_material(
                                                         adassrtm_name
                                                         ,adassrtm_qty
                                                         ,adassrtm_mou
                                                         ,adasstrtm_material_id
                                                         ,adassrtm_note
                                                         ,adassrtm_cteate_at
                                                      )VALUES(
                                                         '" . $_POST['asset_material'][$a] . "'
                                                         ,'" . $_POST['asset_qty_insert'][$a] . "'
                                                         ,'" . $_POST['asset_in_mou'][$a] . "'
                                                         ,'" . $v_material_id . "'
                                                         ,'" . $_POST['asset_remark'][$a] . "'
                                                         ,'$datetime'
                                                      )";
         mysqli_query($connect, $sql_m);
      }
   }
   header('location:admin_asset_receive.php?message=success');
   exit();
}
/** IMAGES */
if (isset($_POST['btnimage'])) {
   $v_photo_id = $_POST['asset_photo'];
   $v_photo = $_FILES['edit_photo']['name'];
   if (!empty($v_photo)) {
      $v_photo_name = date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      $v_photo_fullname = $targetDir . $v_photo_name;
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_photo_fullname);
      $sql = "UPDATE admin_asset_receive SET adassrt_img = '$v_photo_name' WHERE adassrt_id = '$v_photo_id'";
      mysqli_query($connect, $sql);
      header("location:admin_asset_receive.php?message=update");
      exit();
   }
}
/** update */
if(isset($_POST['btnupdate'])){
   $v_id = $_POST['txt_id'];
   $v_transfer_no = $_POST['edit_tran_ref'];
   $v_start_date = $_POST['edit_start_date']; 
   $v_receive_date = $_POST['edit_date']; 
   $v_price = $_POST['edit_price']; 
   $v_total = $_POST['edit_total']; 
   $v_status = $_POST['edit_status']; 
   $v_note = $_POST['edit_note']; 
   $sql = "UPDATE admin_asset_receive SET adassrt_tran_id = '$v_transfer_no'
                                          ,adassrt_date = '$v_start_date'
                                          ,adasstr_receive_date = '$v_receive_date'
                                          ,adassrt_c_price = '$v_price'
                                          ,adassrt_total = '$v_total'
                                          ,adassrt_status = '$v_status'
                                          ,adassrt_note = '$v_note'
                                          ,adassrt_updated_date = NOW() WHERE adassrt_id = '$v_id'
                                          ";
   mysqli_query($connect,$sql);
   header("location:admin_asset_receive.php?message=update");
   exit();
}
if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM admin_asset_receive WHERE adassrt_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: admin_asset_receive.php?message=delete");
}
if(isset($_GET['del_id_m'])){
   $id_m = $_GET['del_id_m'];
   $sql_m = "DELETE FROM admin_asset_receive_material WHERE adassrtm_id = '$id_m'";
   $result = mysqli_query($connect, $sql_m);
   header("location: admin_asset_receive.php?message=delete");
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
               Asset Receive Transfer
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
                           <div class="modal-dialog" style="width: 60%;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="row col-xs-4">
                                             <div class="form-group col-xs-12">
                                                <label>Photo:</label><br />
                                                <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="650px;">
                                                <input type="file" name="txt_image" class="form-control" onchange="show_photo_pre(event);" id="txt_image">
                                             </div>
                                          </div>
                                          <div class="row col-xs-8">
                                             <div class="form-group col-xs-12">
                                                <label>Transfer Nº :</label>
                                                <select class="form-control" id="txt_tran_ref" name="txt_tran_ref" data-live-search="true">
                                                   <option disabled selected>Please Select Transfer No</option>
                                                   <?php
                                                   $sql = 'SELECT * FROM admin_asset_transfer LEFT JOIN assest_code_creation ON assest_code_creation.ac_id = admin_asset_transfer.adasst_code';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['adasst_id'] . '" title="' . $row['adasst_transfer_no'] . '"> Code: ' . $row['ac_asset_code'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adasst_transfer_no'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div id="amount_data"></div>
                                             <div class="form-group col-md-12">
                                                <table id="asset_table" class="table table-bordered">
                                                   <thead>
                                                      <tr>
                                                         <th>No.</th>
                                                         <th>Material Name</th>
                                                         <th>Qty</th>
                                                         <th style="width: 100px;">Mou</th>
                                                         <th>Remark</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                </table>
                                                <div class="box-body">
                                                   <div class="button-group">
                                                      <a style="color: #fff;" href="javascript:void(0)" class="add-row btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add Item</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
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
                     <div class="modal fade" id="myModal_update" role="dialog">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                              </div>
                              <div class="modal-body">
                                 <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="txt_id" id="txt_id">
                                    <div class="col-xs-12">
                                       <div class="form-group col-xs-12">
                                          <label>Transfer Nº :</label>
                                          <select class="form-control" id="edit_tran_ref" name="edit_tran_ref" data-live-search="true">
                                             <?php
                                             $sql = 'SELECT * FROM admin_asset_transfer LEFT JOIN assest_code_creation ON assest_code_creation.ac_id = admin_asset_transfer.adasst_code';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['adasst_id'] . '" title="' . $row['adasst_transfer_no'] . '"> Code: ' . $row['ac_asset_code'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adasst_transfer_no'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>Sart Date:</label>
                                          <input class="form-control" id="edit_start_date" name="edit_start_date" type="date">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>Receive Date:</label>
                                          <input class="form-control" id="edit_date" name="edit_date" type="date">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>Unit Price:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input class="form-control" id="edit_price" name="edit_price" type="text">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>Total Amount:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input class="form-control" id="edit_total" name="edit_total" type="text">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>Status:</label>
                                          <select class="form-control" id="edit_status" name="edit_status">
                                             <option disabled selected></option>
                                             <?php
                                             $sql = 'SELECT * FROM txt_admin_asset_receive_status';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['tadsrs_id'] . '">' . $row['tadsrs_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="">Remark:</label>
                                          <textarea name="edit_note" class="form-control" id="edit_note"  rows="2"></textarea>
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
                     <div class="modal fade" id="modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLongTitle">Update Image</h4>
                              </div>
                              <div class="modal-body">
                                 <form action="" enctype="multipart/form-data" method="post">
                                    <input type="hidden" id="asset_photo" name="asset_photo" />
                                    <input type="hidden" name="txt_old_img" id="txt_old_img">
                                    <div class="row">
                                       <div class="col xs-12">
                                          <div class="form-group col-lg-12">
                                             <img id="v_show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="...">
                                             <br />
                                             <label>Upload Photo Here:</label>
                                             <input type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*" onchange="show_edit_photo_pre(event);"></input>
                                          </div>
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
                     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 1%;">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>

                     <!-- /.box-header -->
                     <div class="box-body table-responsive">
                        <table id="info_data" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Code</th>
                                 <th>Type</th>
                                 <th>Asset Name</th>
                                 <th>Start Date</th>
                                 <th>QTY</th>
                                 <th>Unit Price</th>
                                 <th>Total</th>
                                 <th>Transfer No</th>
                                 <th>Transfer From</th>
                                 <th>Receive Date</th>
                                 <th>Asset Status</th>
                                 <th>Photo</th>
                                 <th style="width: 110px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM admin_asset_receive 
                                             LEFT JOIN admin_asset_transfer ON admin_asset_transfer.adasst_id = admin_asset_receive.adassrt_tran_id
                                             LEFT JOIN assest_code_creation ON assest_code_creation.ac_id = admin_asset_transfer.adasst_code
                                             LEFT JOIN text_asset_code_creation_type ON text_asset_code_creation_type.acct_id = admin_asset_transfer.adasst_type
                                             LEFT JOIN txt_admin_asset_receive_status ON txt_admin_asset_receive_status.tadsrs_id = admin_asset_receive.adassrt_status";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_code = $row["ac_asset_code"];
                                 $v_as_name = $row["adasst_asset_name"];
                                 $v_type = $row['acct_name'];
                                 $v_start_date = $row['adassrt_date'];
                                 $v_qty = $row['adasst_qty'];
                                 $v_transfer_no = $row['adasst_transfer_no'];
                                 $v_unit_price = $row['adassrt_c_price'];
                                 $v_total = $row['adassrt_total'];
                                 $v_transfer_from = $row['adasst_transfer_form'];
                                 $v_receive_date = $row['adasstr_receive_date'];
                                 $v_status = $row['tadsrs_name'];
                                 $v_img = $row['adassrt_img'];
                              ?>
                                 <tr>
                                    <td><?= $v_i; ?></td>

                                    <td>
                                       <?php echo $v_code; ?>
                                    </td>
                                    <td><?= $v_type; ?></td>
                                    <td><?php echo $v_as_name; ?></td>
                                    <td><?= $v_start_date; ?></td>
                                    <td><?= $v_qty; ?></td>
                                    <td><?= number_format($v_unit_price) . '$'; ?></td>
                                    <td><?= number_format($v_total) . '$';?></td>
                                    <td><?= $v_transfer_no; ?></td>
                                    <td><?= $v_transfer_from; ?></td>
                                    <td><?= $v_receive_date; ?></td>
                                    <td><?php echo $v_status; ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                       <a target="_blank" href="../../hr_system_v1/img/upload/asset_receive/receive_photo/<?php echo $row['adassrt_img']; ?>">
                                          <img class="rounded img-fuild" src="../img<?php if ($v_img != '') {
                                                                                       echo '/upload/asset_receive/receive_photo/' . $v_img;
                                                                                    } else {
                                                                                       echo '/no_image.jpg';
                                                                                    } ?>" ismap style="width:50px; height:50px;" />
                                       </a>
                                       <a style="float:right; cursor:pointer;" onclick="doImage('<?= $row['adassrt_id']; ?>','<?= $v_img ?>');" data-toggle="modal" data-target="#modal_image">
                                          <i style="color:#3c8dbc;" class="fa fa-pencil"></i>
                                       </a>
                                    </td>
                                    <td>
                                       <a href="edit_admin_asset_receive.php?id=<?php echo $row['adassrt_id']; ?>&&materia_id=<?=$row['adassrt_material_id'];?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a>
                                       <a onclick="doUpdate(
                                                         '<?= $row['adassrt_id']; ?>',
                                                         '<?= $row['adassrt_tran_id']; ?>',
                                                         '<?= $row['adasstr_receive_date']; ?>',
                                                         '<?= $row['adassrt_c_price']; ?>',
                                                         '<?= $row['adassrt_total']; ?>',
                                                         '<?= $row['adassrt_date']; ?>',
                                                         '<?= $row['adassrt_status']; ?>',
                                                         '<?= $row['adassrt_note']; ?>',
                                                         );" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Are you sure to delete ?');" href="admin_asset_receive.php?del_id=<?php echo $row['adassrt_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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

      function doImage(id, photo) {
         $("#asset_photo").val(id);
         $("#txt_old_img").val(photo);
         if (photo == "" || photo == "NULL") {
            document.getElementById("v_show_photo").setAttribute('src', '../img/no_image.jpg');
         } else {
            document.getElementById("v_show_photo").setAttribute("src", "../img/upload/asset_receive/receive_photo/" + photo);
         }
      }

      function show_edit_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("v_show_photo").src = src;
         }
      }

      function doUpdate(id, tran_id, receive_date, price, total, date,status,note) {
         $("#txt_id").val(id);
         $("#edit_tran_ref").val(tran_id).change();
         $("#edit_date").val(receive_date);
         $("#edit_price").val(price);
         $("#edit_total").val(total);
         $("#edit_start_date").val(date);
         $("#edit_status").val(status).change();
         $("#edit_note").val(note)
      }


      $('#txt_tran_ref').change(function() {
         $('.show_hid').css("visibility", "visible");
         var job_id = $("#txt_tran_ref").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_admin_asset.php',
               data: {
                  'txt_asset_in_id': job_id
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_receive").addClass("active");
         $("#asset_receive").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
      window.addEventListener('DOMContentLoaded', function() {
         $(document).ready(function() {
            var no = 1;
            $(".add-row").on('click', function() {
               // var material_no = "<td><input class='form-control' type='text' name='asset_material_no[]' id='asset_material_no'/></td>";
               var material = "<td><input class='form-control'required name='asset_material[]' id='asset_material' type='text'></td>";
               var qty = "<td><input class='form-control'required name='asset_qty_insert[]' id='asset_qty_insert' type='number'></td>";
               var mou = `<td>
                                 <select class='form-control'required name='asset_in_mou[]' id='asset_in_mou'data-live-search="true">
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
               var Remark = "<td><input class='form-control'required name='asset_remark[]' id='asset_remark' type='text'></td>";
               var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
               //    var action = "<th class='text-center'><i class='fa fa-cog' ></i></th>";
               var markup = "<tr>" + "<td>" + no + "</td>" + material + qty + mou + Remark + remove_button + "</tr>";
               $("#asset_table").append(markup); //    $("thead tr")[i].append(action);
               no++;
               $("#asset_table").on('click', '.remove-row', function() {
                  $(this).closest("tr").remove();
                  if (("#asset_table")) {
                     no = 1;
                  }
               });
            });
         });
      });
   </script>
</body>

</html>