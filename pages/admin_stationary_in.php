<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_POST['btnadd'])) {
   $_stt_ps_no_ref = $_POST['ps_no_ref'];
   $_stt_date = $_POST['st_in_date'];
   $_stt_type = $_POST['st_type'];
   $_stt_contact = $_POST['contact'];
   $_stt_code = $_POST['st_code'];
   $_stt_supplier_name = $_POST['supplier_name'];
   $_stt_name = $_POST['st_name'];
   $_stt_inv_no_ref = $_POST['inv_no_ref'];
   $_stt_mou = $_POST['st_mou'];
   $_stt_qty = $_POST['st_qty'];
   $_stt_amount = $_POST['st_amount'];
   $_stt_using_by = $_POST['st_using_by'];
   $_stt_price = $_POST['st_price'];
   $_stt_comment = $_POST['st_comment'];
   $sql = "INSERT INTO `admin_stationary_in`(
                                       adsti_ps_id,
                                       adsti_type,
                                       adsti_code,
                                       adsti_name,
                                       adsti_qty,
                                       adsti_mou,
                                       adsti_unit_price,
                                       adsti_useby,
                                       adsti_date,
                                       adsti_supplier_name,
                                       adsti_contact,
                                       adsti_inv_ref,
                                       adsti_total,
                                       adsti_created_date,
                                       adsti_userid,
                                       adsti_note
                                             ) VALUES(
                                                '$_stt_ps_no_ref'
                                                ,'$_stt_type'
                                                ,'$_stt_code'
                                                ,'$_stt_name'
                                                ,'$_stt_qty'
                                                ,'$_stt_mou'
                                                ,'$_stt_price'
                                                ,'$_stt_using_by'
                                                ,'$_stt_date'
                                                ,'$_stt_supplier_name'
                                                ,'$_stt_contact'
                                                ,'$_stt_inv_no_ref'
                                                ,'$_stt_amount'
                                                ,now()
                                                ,'$user_id'
                                                ,'$_stt_comment'
                                             )";
   $result = mysqli_query($connect, $sql);
   header("location:admin_stationary_in.php?message=success");
   exit();
}
/** FILE */
$_Dir = '../img/file/admin_stationary_file/';
if (isset($_POST['btn_file'])) {
   $_stt_id = $_POST['st_id'];
   $_stt_old_file = $_POST['st_old_file'];
   $_stt_file = $_FILES['st_file']['name'];
   if (!empty($_stt_file)) {
      $_file = $_FILES['st_file'];
      $_Dir .= basename($_stt_file);
      $_file_type = strtolower(pathinfo($_Dir, PATHINFO_EXTENSION));
      if ($_file_type == 'pdf') {
         $new_name = date("Ymd") . "-" . rand(111, 999) . ".pdf";
         move_uploaded_file($_file['tmp_name'], '../img/file/admin_stationary_file/' . $new_name);
         $sql = "UPDATE `admin_stationary_in` SET adsti_file = '$new_name' WHERE adsti_id = '$_stt_id'";
         mysqli_query($connect, $sql);
         header("location:admin_stationary_in.php?message=update");
         exit();
      }
   }
}
if (isset($_GET['id'])) {
   $_id_delete = $_GET['id'];
   $sql = "DELETE FROM `admin_stationary_in` where adsti_id = '$_id_delete'";
   mysqli_query($connect, $sql);
   header("location:admin_stationary_in.php?message=delete");
   exit();
}

/** UPDATE */
if(isset($_POST['btn_update'])){
   $_stt_id = $_POST['edit_st_id']; 
   $_stt_ps_no = $_POST['edit_ps_no_ref']; 
   $_stt_date = $_POST['edit_st_in_date'];
   $_stt_type = $_POST['edit_st_type']; 
   $_stt_sup_name = $_POST['edit_supplier_name']; 
   $_stt_code = $_POST['edit_st_code']; 
   $_stt_contact = $_POST['edit_contact']; 
   $_stt_name = $_POST['edit_st_name']; 
   $_stt_inv_ref = $_POST['edit_inv_no_ref']; 
   $_stt_qty = $_POST['edit_st_qty']; 
   $_stt_mou = $_POST['edit_st_mou'];
   $_stt_price = $_POST['edit_st_price'];
   $_stt_total = $_POST['edit_st_amount']; 
   $_stt_using_by = $_POST['edit_st_using_by']; 
   $_stt_com = $_POST['edit_st_comment']; 

   $sql = "UPDATE `admin_stationary_in` SET 
                                       adsti_ps_id = '$_stt_ps_no', 
                                       adsti_type = '$_stt_type',
                                       adsti_code ='$_stt_code',
                                       adsti_name ='$_stt_name',
                                       adsti_qty = '$_stt_qty',
                                       adsti_mou = '$_stt_mou',
                                       adsti_unit_price = '$_stt_price',
                                       adsti_useby ='$_stt_using_by',
                                       adsti_date = '$_stt_date',
                                       adsti_supplier_name = '$_stt_sup_name',
                                       adsti_contact = '$_stt_contact',
                                       adsti_inv_ref = '$_stt_inv_ref',
                                       adsti_total = '$_stt_total',
                                       adsti_created_date = NOW(),
                                       adsti_userid = '$user_id',
                                       adsti_note = '$_stt_com' WHERE adsti_id = '$_stt_id'
   ";
      mysqli_query($connect, $sql);
      header("location:admin_stationary_in.php?message=update");
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

<body class=" skin-black ">

   <?php include('header.php') ?>
   <div class="wrapper rowoffcanvas row-offcanvas-left">
      <!-- Include left Menu -->
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
            <h1>
               Stationary In
            </h1>
         </section>
         <section class="content">
            <div class="row">
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
                                 <div class="col-xs-12 form-group">
                                    <div class=" form-group col-xs-6">
                                       <label for="">PS No Ref:</label>
                                       <select name="ps_no_ref" data-live-search='true' id="" class="form-control">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM `stationary_requisition` ORDER BY sr_ps_no ASC";
                                          $result  = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value=" . $row['sr_id'] . " >" . $row['sr_ps_no'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">ST In.Date:</label>
                                       <input type="date" name="st_in_date" id="st_in_date" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">ST Type:</label>
                                       <select name="st_type" data-live-search='true' id="" class="form-control">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM `text_stationary_type` ORDER BY st_name ASC";
                                          $result  = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value=" . $row['st_id'] . " >" . $row['st_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">Supplier Name:</label>
                                       <input type="text" name="supplier_name" id="supplier_name" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">ST Code:</label>
                                       <select name="st_code" data-live-search='true' id="" class="form-control">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "select * from stationary_code";
                                          $result = mysqli_query($connect,$sql);
                                          while($row = mysqli_fetch_assoc($result)){
                                             ?>
                                             <option value="<?=$row['sc_id'];?>"><?=$row['sc_stationary_code']?></option>
                                             <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">Contact:</label>
                                       <input type="text" name="contact" id="" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">ST Name:</label>
                                       <input type="text" name="st_name" id="" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">Inv No Ref:</label>
                                       <input type="text" name="inv_no_ref" id="" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-3">
                                       <label for="">Qty:</label>
                                       <input type="number" step="0.1" name="st_qty" id="" class="form-control">
                                    </div>
                                    <div class=" form-group col-xs-3">
                                       <label for="">Mou:</label>
                                       <select name="st_mou" data-live-search='true' id="" class="form-control">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM `txt_admin_stationary_in_mou` ORDER BY tasim_name ASC";
                                          $result  = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value=" . $row['tasim_id'] . " >" . $row['tasim_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="number" step="0.1" name="st_price" id="" class="form-control">
                                       </div>
                                    </div>
                                    <div class=" form-group col-xs-6">
                                       <label for="">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="number" step="0.1" name="st_amount" id="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Using By:</label>
                                       <select name="st_using_by" data-live-search='true' id="" class="form-control">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM `department` ORDER BY de_name ASC";
                                          $result  = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value=" . $row['de_id'] . " >" . $row['de_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label for="">Comment:</label>
                                    <textarea name="st_comment" id="" class="form-control" cols="" rows="2"></textarea>
                                 </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                           <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- file modal  -->
               <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel">Upload File*(PDF)</h4>
                        </div>
                        <div class="modal-body">
                           <form method="post" enctype="multipart/form-data" action="">
                              <input type="hidden" name="st_id" id="st_id">
                              <input type="hidden" name="old_file" id="old_file">
                              <div class="col-xs-12 form-group">
                                 <label for="">Attach File:</label>
                                 <input type="file" name="st_file" class="form-control" accept="application/pdf" id="">
                              </div>

                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btn_file" class="btn btn-sm btn-primary"> <i class="fa fa-save"></i> Save</button>
                           <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-undo"></i> Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end file modal    -->
               <!-- view modal  -->
               <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary " id="exampleModalLabel"> <i class="fa fa-eye"></i>&nbsp; View Admin Stationary In</h4>

                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <div class="col-xs-12 form-group">
                                 <div class=" form-group col-xs-6">
                                    <label for="">PS No Ref:</label>
                                    <?php
                                    $sql = "SELECT * FROM `stationary_requisition` ORDER BY sr_ps_no ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='ps_no_ref' name='ps_no_ref' class ='form-control'>";
                                    ?>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST In.Date:</label>
                                    <input type="date" name="st_in_date" id="v_st_in_date" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Type:</label>
                                    <?php
                                    $sql = "SELECT * FROM `text_stationary_type` ORDER BY st_name ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='v_st_type' name='v_st_type' class ='form-control'>";
                                    ?>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Supplier Name:</label>
                                    <input type="text" name="supplier_name" id="v_supplier_name" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Code:</label>
                                    <?php
                                    $sql = "SELECT * FROM `stationary_code` ORDER BY sc_stationary_code ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='v_st_code' name='v_st_type' class ='form-control'>";
                                    ?>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Contact:</label>
                                    <input type="text" name="contact" id="v_contact" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Name:</label>
                                    <input type="text" name="st_name" id="v_st_name" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Inv No Ref:</label>
                                    <input type="text" name="inv_no_ref" id="v_inv_no_ref" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-3">
                                    <label for="">Qty:</label>
                                    <input type="number" step="0.1" name="st_qty" id="v_st_qty" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-3">
                                    <label for="">Mou:</label>

                                    <?php
                                    $sql = "SELECT * FROM `txt_admin_stationary_in_mou` ORDER BY tasim_name ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='v_st_mou' name='v_st_mou' class ='form-control'>";
                                    ?>

                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Unit Price:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" step="0.1" name="st_price" id="v_st_price" class="form-control">
                                    </div>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Total Amount:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" step="0.1" name="st_amount" id="v_st_amount" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Using By:</label>

                                    <?php
                                    $sql = "SELECT * FROM `department` ORDER BY de_name ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='v_st_using_by' name='v_st_using_by' class ='form-control'>";
                                    ?>

                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">User:</label>
                                    <?php
                                    $sql = "SELECT * FROM `user` ORDER BY username ASC";
                                    $result  = $connect->query($sql);
                                    $row = $result->fetch_array();
                                    echo "<input type ='text' id='user_id' name='user_id' class ='form-control'>";
                                    ?>
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Comment:</label>
                                 <textarea name="st_comment" id="v_st_comment" class="form-control" cols="" rows="2"></textarea>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end view modal  -->
               <!-- modal_update  -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"> <i class="fa fa-edit"></i>&nbsp; Update Stationary In</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="edit_st_id" id="edit_st_id">
                              <div class="col-xs-12 form-group">
                                 <div class=" form-group col-xs-6">
                                    <label for="">PS No Ref:</label>
                                    <select name="edit_ps_no_ref" data-live-search='true' id="edit_ps_no_ref" class="form-control">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM `stationary_requisition` ORDER BY sr_ps_no ASC";
                                       $result  = $connect->query($sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=" . $row['sr_id'] . " >" . $row['sr_ps_no'] . "</option>";
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST In.Date:</label>
                                    <input type="date" name="edit_st_in_date" id="edit_st_in_date" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Type:</label>
                                    <select name="edit_st_type" data-live-search='true' id="edit_st_type" class="form-control">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM `text_stationary_type` ORDER BY st_name ASC";
                                       $result  = $connect->query($sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=" . $row['st_id'] . " >" . $row['st_name'] . "</option>";
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Supplier Name:</label>
                                    <input type="text" name="edit_supplier_name" id="edit_supplier_name" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Code:</label>
                                    <select name="edit_st_code" data-live-search='true' id="edit_st_code" class="form-control">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM `stationary_code` ORDER BY sc_stationary_code ASC";
                                       $result  = $connect->query($sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=" . $row['sc_id'] . " >" . $row['sc_stationary_code'] . "</option>";
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Contact:</label>
                                    <input type="text" name="edit_contact" id="edit_contact" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">ST Name:</label>
                                    <input type="text" name="edit_st_name" id="edit_st_name" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Inv No Ref:</label>
                                    <input type="text" name="edit_inv_no_ref" id="edit_inv_no_ref" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-3">
                                    <label for="">Qty:</label>
                                    <input type="number" step="0.1" name="edit_st_qty" id="edit_st_qty" class="form-control">
                                 </div>
                                 <div class=" form-group col-xs-3">
                                    <label for="">Mou:</label>
                                    <select name="edit_st_mou" data-live-search='true' id="edit_st_mou" class="form-control">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM `txt_admin_stationary_in_mou` ORDER BY tasim_name ASC";
                                       $result  = $connect->query($sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=" . $row['tasim_id'] . " >" . $row['tasim_name'] . "</option>";
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Unit Price:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" step="0.1" name="edit_st_price" id="edit_st_price" class="form-control">
                                    </div>
                                 </div>
                                 <div class=" form-group col-xs-6">
                                    <label for="">Total Amount:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" step="0.1" name="edit_st_amount" id="edit_st_amount" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Using By:</label>
                                    <select name="edit_st_using_by" data-live-search='true' id="edit_st_using_by" class="form-control">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM `department` ORDER BY de_name ASC";
                                       $result  = $connect->query($sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=" . $row['de_id'] . " >" . $row['de_name'] . "</option>";
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Comment:</label>
                                 <textarea name="edit_st_comment" id="edit_st_comment" class="form-control" cols="" rows="2"></textarea>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btn_update" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                           <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                        </button>
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>ST.Code</th>
                                    <th>ST.Type</th>
                                    <th>ST.Name</th>
                                    <th>ST In Date</th>
                                    <th>QTY</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                    <th>Supplier Name</th>
                                    <th>Contact</th>
                                    <th>PS No Ref.</th>
                                    <th>INV No.Ref</th>
                                    <th>Attach File</th>
                                    <th style="width: 130px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM `admin_stationary_in` A
                                                LEFT JOIN `text_stationary_type` B ON B.st_id = A.adsti_type
                                                LEFT JOIN `stationary_code` C ON C.sc_id = A.adsti_code
                                                LEFT JOIN `stationary_requisition` D ON D.sr_id = A.adsti_ps_id
                                                LEFT JOIN `user` E on E.id = A.adsti_userid
                                                LEFT JOIN `txt_admin_stationary_in_mou` F ON F.tasim_id = A.adsti_mou
                                                LEFT JOIN `department` G ON G.de_id = A.adsti_useby
                                                ";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $_count_i = $i++;
                                    $_stt_type = $row['st_name'];
                                    $_stt_code = $row['sc_stationary_code'];
                                    $_stt_ps_no_ref = $row['sr_ps_no'];
                                    $_stt_name = $row['adsti_name'];
                                    $_stt_date = $row['adsti_date'];
                                    $_stt_qty = $row['adsti_qty'];
                                    $_stt_price = $row['adsti_unit_price'];
                                    $_stt_amount = $row['adsti_total'];
                                    $_stt_supplier_name = $row['adsti_supplier_name'];
                                    $_stt_contact = $row['adsti_contact'];
                                    $_stt_inv_ref = $row['adsti_inv_ref'];
                                    $_stt_file = $row['adsti_file'];
                                 ?>
                                    <tr>
                                       <td><?php echo $_count_i; ?></td>
                                       <td><?php echo $_stt_code; ?></td>
                                       <td><?php echo $_stt_type; ?></td>
                                       <td><?php echo $_stt_name; ?></td>
                                       <td><?php echo $_stt_date; ?></td>
                                       <td><?php echo $_stt_qty; ?></td>
                                       <td><?php echo $_stt_price; ?></td>
                                       <td><?php echo $_stt_amount; ?></td>
                                       <td><?php echo $_stt_supplier_name; ?></td>
                                       <td><?php echo $_stt_contact; ?></td>
                                       <td><?php echo $_stt_ps_no_ref; ?></td>
                                       <td><?php echo $_stt_inv_ref; ?></td>
                                       <td>
                                          <?php
                                          if ($_stt_file == '') {
                                          ?>
                                             <a target="_blank" href="../img/file/image_no_file.png">
                                                <img width="50" src="../img/file/image_no_file.png" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target="_blank" href="../img/file/admin_stationary_file/<?php echo $_stt_file; ?>">
                                                <img width="50" src="../img/file/pdf_image.png" alt="">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a onclick="doFile('<?php echo $row['adsti_id']; ?>','<?php echo $row['adsti_file']; ?>');" data-toggle="modal" data-target="#modal_file" style="float: right;"><i class="fa fa-pencil "></i></a>
                                       </td>
                                       <td style="vertical-align: middle; text-align: center; ">
                                          <a onclick="do_view(
                                             '<?= $row['username']; ?>',
                                             '<?= $row['sr_ps_no']; ?>',
                                             '<?= $row['adsti_date']; ?>',
                                             '<?= $row['st_name']; ?>',
                                             '<?= $row['adsti_supplier_name']; ?>',
                                             '<?= $row['sc_stationary_code']; ?>',
                                             '<?= $row['adsti_contact']; ?>',
                                             '<?= $row['adsti_name']; ?>',
                                             '<?= $row['adsti_inv_ref']; ?>',
                                             '<?= $row['adsti_qty']; ?>',
                                             '<?= $row['tasim_name']; ?>',
                                             '<?= $row['adsti_unit_price']; ?>',
                                             '<?= $row['adsti_total']; ?>',
                                             '<?= $row['de_name']; ?>',
                                             '<?= $row['adsti_note']; ?>',
                                             );" data-toggle="modal" data-target="#modal_view" style="color: #fff;" class="btn btn-sm btn-primary">
                                             <i class=" fa fa-eye"></i>
                                          </a>
                                          <a 
                                             onclick="doUpdate(
                                                '<?=$row['adsti_id'];?>',
                                                '<?=$row['adsti_ps_id'];?>',
                                                '<?=$row['adsti_type'];?>',
                                                '<?=$row['adsti_code'];?>',
                                                '<?=$row['adsti_name'];?>',
                                                '<?=$row['adsti_qty'];?>',
                                                '<?=$row['adsti_mou'];?>',
                                                '<?=$row['adsti_unit_price'];?>',
                                                '<?=$row['adsti_total'];?>',
                                                '<?=$row['adsti_useby'];?>',
                                                '<?=$row['adsti_date'];?>',
                                                '<?=$row['adsti_contact'];?>',
                                                '<?=$row['adsti_inv_ref'];?>',
                                                '<?=$row['adsti_note'];?>',
                                                '<?= $row['adsti_supplier_name'];?>',
                                             );"
                                             data-toggle="modal" 
                                             data-target="#modal_update" 
                                             style="color: #fff;" 
                                             class="btn btn-sm btn-info">
                                             <i 
                                                class="fa fa-edit">
                                             </i>
                                          </a>
                                          <a onclick="return confirm('Are you sure you delete?')" href="admin_stationary_in.php?id=<?= $row['adsti_id']; ?>" style="color: #fff;" class="btn btn-sm btn-danger">
                                             <i class="fa fa-trash-o"></i>
                                          </a>
                                       </td>
                                    </tr>
                                 <?php
                                 };
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
      function doUpdate(
         id,ps_no,st_type,code,name,qty,mou,unitprice,total,useby,date,contact,inv,note,supplier_name
      ){
         $("#edit_st_id").val(id);
         $("#edit_ps_no_ref").val(ps_no).change();
         $("#edit_st_type").val(st_type).change();
         $("#edit_st_code").val(code).change();
         $("#edit_st_name").val(name);
         $("#edit_st_qty").val(qty);
         $("#edit_st_mou").val(mou).change();
         $("#edit_st_price").val(unitprice);
         $("#edit_st_amount").val(total);
         $("#edit_st_using_by").val(useby).change();
         $("#edit_st_in_date").val(date);
         $("#edit_contact").val(contact);
         $("#edit_inv_no_ref").val(inv);
         $("#edit_st_comment").val(note);
         $("#edit_supplier_name").val(supplier_name);
      }
      function do_view(user_id, ps_no_ref, stt_date, stt_type, supper_name, stt_code, contact, stt_name, inv_ref, qty, mou, price, total, using_by, note) {
         $("#user_id").val(user_id);
         $("#ps_no_ref").val(ps_no_ref);
         $("#v_st_in_date").val(stt_date);
         $("#v_st_type").val(stt_type);
         $("#v_supplier_name").val(supper_name);
         $("#v_st_code").val(stt_code);
         $("#v_contact").val(contact);
         $("#v_st_name").val(stt_name);
         $("#v_inv_no_ref").val(inv_ref);
         $("#v_st_qty").val(qty);
         $("#v_st_mou").val(mou);
         $("#v_st_price").val(price);
         $("#v_st_amount").val(total);
         $("#v_st_using_by").val(using_by);
         $("#v_st_comment").val(note);
      }
      function doFile(id, file) {
         var st_id = id;
         var st_file = file;
         $("#st_id").val(st_id);
         $("#old_file").val(st_file);
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_stationary_manage").addClass("active");
         $("#station_in").addClass("active");
         $("#station_in").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>