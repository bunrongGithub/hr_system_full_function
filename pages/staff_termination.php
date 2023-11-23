<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_ref_no = $_POST["txt_ref"];

   $v_job_id = $_POST["txt_job_id"];

   $v_txt_date  = $_POST["txt_date"];


   $v_attach_file = $_FILES['attach_file'];
   $v_target_file = '../img/file' . basename($_FILES['attach_file']['name']);
   $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pdf";
   move_uploaded_file($v_attach_file['tmp_name'], "../img/file/" . $new_name);

   $v_txt_paid = $_POST["txt_paid"];
   $v_txt_staff = $_POST["txt_staff"];
   $v_total_warning = $_POST["total_warning"];
   $v_txt_l_amount = $_POST['txt_l_amount'];
   $v_status = $_POST['status'];
   $v_reason = $_POST['reason'];
   $v_commnet_1 = $_POST['commnet_1'];
   $v_commnet_2 = $_POST['commnet_2'];
   $v_commnet_3 = $_POST['commnet_3'];
   $v_noted  = $_POST['noted'];

   $sql = "INSERT INTO termination (te_employee_id
                     ,te_terninate_no
                     ,te_terminate_date
                     ,te_attach_file
                     ,te_paid_unpaid
                     ,te_staff_liability
                     ,te_total_warning
                     ,te_liability_amount
                     ,te_status_id
                     ,te_reason
                     ,te_comment_1
                     ,te_comment_2
                     ,te_comment_3
                     ,te_note
                     ,created_at) VALUES('$v_job_id',
                                          '$v_ref_no'
                                          ,'$v_txt_date'
                                          ,'$new_name'
                                          ,'$v_txt_paid'
                                          ,'$v_txt_staff'
                                          ,'$v_total_warning'
                                          ,'$v_txt_l_amount'
                                          ,'$v_status'
                                          ,'$v_reason '
                                          ,'$v_commnet_1'
                                          ,'$v_commnet_2'
                                          ,'$v_commnet_3'
                                          ,'$v_noted'
                                          ,'$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_termination.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_terminate_id"];
   $v_ref_no = $_POST["edit_ref"];
   $v_job_id = $_POST["edit_job_id"];
   $v_date = $_POST["edit_date"];
   $v_warning = $_POST["edit_warning"];
   $v_reason = $_POST["edit_reason"];
   $v_paid = $_POST["edit_paid"];
   $v_staff_l = $_POST["edit_staff"];
   $v_l_amount = $_POST["edit_l_amount"];
   $v_status = $_POST["edit_status"];


   $v_attach_file = $_FILES['attach_file'];
   $v_old_file = @$_POST['old_file'];
   $target_file = "../img/file" . basename($_FILES['attach_file']['name']);
   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   if(file_exists("../img/file/" . $v_old_file) and $v_old_file != 'blank.png'){
      unlink("../img/file/" . $old_image);
   }
   $new_name = date("Ymd") . '_' . rand(111,9999) . ".pdf";
   move_uploaded_file($v_attach_file['tmp_name'], "../img/file/" . $new_name);

   $v_edit_comment_1 = $_POST["edit_comment_1"];
   $v_edit_comment_2 = $_POST["edit_comment_2"];
   $v_edit_comment_3 = $_POST["edit_comment_3"];
   $v_edit_noted = $_POST['edit_noted'];

   $sql = "UPDATE termination SET te_employee_id = '$v_job_id'
                                 , te_terninate_no = '$v_ref_no'
                                 , te_terminate_date = '$v_date'
                                 , te_attach_file = '$new_name'
                                 , te_total_warning = '$v_warning'
                                 , te_reason = '$v_reason'
                                 , te_paid_unpaid = '$v_paid'
                                 , te_staff_liability = '$v_staff_l'
                                 , te_liability_amount = '$v_l_amount'
                                 , te_status_id = '$v_status '
                                 , te_comment_1 = '$v_edit_comment_1'
                                 , te_comment_2 = '$v_edit_comment_2'
                                 , te_comment_3 = '$v_edit_comment_3'
                                 , te_note = '$v_edit_noted'
                                 , updated_at = '$datetime'
                                 WHERE te_id = '$id'
   ";
   $result = mysqli_query($connect, $sql);
   header('location:staff_termination.php?message=update');
   exit();
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM termination WHERE te_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_termination.php?message=delete");
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
               Termination
            </h1>
         </section>

         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <!-- Modal_add_new -->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog" style="width:950px;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-md-12">
                                             <label>Job ID:</label>
                                             <select class="form-control" id="txt_job_id" name="txt_job_id" data-live-search="true" required="required">
                                                <option disabled selected>Please Select Job ID</option>
                                                <?php
                                                $sql = 'SELECT * FROM employee_registration';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['er_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="col-md-4">
                                                <div class="show_hid form-group col-md-12" style="display: none;">
                                                   <label>Termination Nº:</label>
                                                   <input class="form-control" id="txt_ref" name="txt_ref" type="text" required>
                                                </div>
                                                <div id="amount_data"></div>
                                             </div>
                                             <div class="col-md-8">
                                                <h3 class="show_hid form-group col-md-12" style="display: none;">
                                                   <strong>New Info:</strong>
                                                </h3>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label>Termination Date:</label>
                                                   <input class="form-control" id="txt_date" name="txt_date" type="date">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="attach_file">Attach File(PDF)</label>
                                                   <input class="form-control" type="file" name="attach_file" accept=".pdf" id="">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label>Paid / UnPaid:</label>
                                                   <select class="form-control" id="txt_paid" data-live-search="true" name="txt_paid">
                                                      <option selected value=""></option>
                                                      <option value=1>Paid</option>
                                                      <option value=2>UnPaid</option>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label>Staff Liabillity:</label>
                                                   <select class="form-control" id="txt_staff" data-live-search="true" name="txt_staff">
                                                      <option selected value=""></option>
                                                      <option value=1>No</option>
                                                      <option value=2>Yes</option>
                                                   </select> <input class="form-control" type="checkbox" name="" value=1 id="">Other
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display:none;">
                                                   <label for="total_warning">Total Warning</label>
                                                   <input class="form-control" type="number" name="total_warning" id="total_warning">
                                                </div>
                                                <div class="show_hid form-group col-xs-6" style="display: none;">
                                                   <label>Liabillity Amount:</label>
                                                   <input class="form-control" id="txt_l_amount" name="txt_l_amount" type="number" step="0.01" required>
                                                </div>
                                                <div class="show_hid form-group col-xs-6" style="display:none;">
                                                   <label class="form-label" for="status">Status:</label>
                                                   <select class="form-control" name="status" id="status" data-live-search="true">
                                                      <option selected value=""></option>
                                                      <?php
                                                      $sql = "SELECT * FROM text_termination_status";
                                                      $result = mysqli_query($connect, $sql);
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                         echo '<option value="' . $row['tts_id'] . '">' . $row['tts_name'] . '</option>';
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-xs-12" style="display:none;">
                                                   <label class="form-label" for="reason">Reason:</label>
                                                   <textarea class="form-control" name="reason" id="reason" rows="2"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-xs-12" style="display:none;">
                                                   <label class="form-label" for="commnet_1">Comment 1:</label>
                                                   <textarea class="form-control" name="commnet_1" id="commnet_1" rows="2"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-xs-12" style="display:none;">
                                                   <label class="form-label" for="commnet_2">Comment 2:</label>
                                                   <textarea class="form-control" name="commnet_2" id="commnet_2" rows="2"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-xs-12" style="display:none;">
                                                   <label class="form-label" for="commnet_3">Comment 3:</label>
                                                   <textarea class="form-control" name="commnet_3" id="commnet_3" rows="2"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-xs-12" style="display:none;">
                                                   <label class="form-label" for="noted">Noted:</label>
                                                   <textarea class="form-control" name="noted" id="noted" rows="2"></textarea>
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
                        <!-- end_Modal_add_new -->
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
                                          <input type="hidden" id="staff_terminate_id" name="staff_terminate_id" />
                                          <div class="form-group col-xs-6">
                                             <label>Job ID:</label>
                                             <select class="form-control" id="edit_job_id" name="edit_job_id" data-live-search="true" required="required">
                                                <option disabled selected>Please Select Job ID</option>
                                                <?php
                                                $sql = 'SELECT * FROM employee_registration';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['er_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Termination Nº:</label>
                                             <input class="form-control" id="edit_ref" name="edit_ref" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Termination Date:</label>
                                             <input class="form-control" id="edit_date" name="edit_date" type="date">
                                          </div>
                                          <div style="position: rerelative ;" class="show_hid form-group col-md-6">
                                             <label for="attach_file">Attach File(PDF)</label>
                                             <input type="hidden" name="old_file" id="old_file">
                                             <input class="form-control" type="file" name="attach_file" accept=".pdf" id="attach_file">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Total Warning:</label>
                                             <input class="form-control" id="edit_warning" name="edit_warning" type="number">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
                                             <select class="form-control" id="edit_status" name="edit_status">
                                                <?php
                                                $sql = 'SELECT * FROM text_termination_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tts_id'] . '"> ' . $row['tts_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Paid / UnPaid:</label>
                                             <select class="form-control" id="edit_paid" name="edit_paid">
                                                <option value=1>Paid</option>
                                                <option value=2>UnPaid</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Staff Liabillity:</label>
                                             <select class="form-control" id="edit_staff" name="edit_staff">
                                                <option value=1>No</option>
                                                <option value=2>Yes</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Liabillity Amount:</label>
                                             <input class="form-control" id="edit_l_amount" name="edit_l_amount" type="number" step="0.01">
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Reason:</label>
                                             <textarea class="form-control" name="edit_reason" id="edit_reason" rows="2"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Comment 1:</label>
                                             <textarea class="form-control" name="edit_comment_1" id="edit_comment_1" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Comment 2:</label>
                                             <textarea class="form-control" name="edit_comment_2" id="edit_comment_2" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Comment 3:</label>
                                             <textarea class="form-control" name="edit_comment_3" id="edit_comment_3" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Noted:</label>
                                             <textarea class="form-control" name="edit_noted" id="edit_noted" rows="1"></textarea>
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
                                    <th class="text-center">No</th>
                                    <th class="text-center">Terminate Nº</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Employee Information</th>
                                    <th class="text-center">Attach File</th>
                                    <th class="text-center">Terminate Date</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM termination 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = termination.te_employee_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_termination_status ON text_termination_status.tts_id = termination.te_status_id";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_ref_no = $row["te_terninate_no"];
                                    $v_date = $row["te_terminate_date"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_reason = $row["te_reason"];
                                    $v_paid = $row["te_paid_unpaid"];
                                    $v_staff_l = $row["te_staff_liability"];
                                    $v_l_amount = $row["te_liability_amount"];
                                    $v_t_warning = $row["te_total_warning"];
                                    $v_status_id = $row["tts_name"];
                                    $v_attach_file = $row['te_attach_file'];
                                    $v_comment_1 = $row['te_comment_1'];
                                    $v_comment_2 = $row['te_comment_2'];
                                    $v_comment_3 = $row['te_comment_3'];
                                    $v_noted = $row['te_note'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_ref_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Job_id: </i> " . $v_er_job_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender: </i> " . $v_gender_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Company: </i>" . $v_company_id . "<br/><i>Branch: </i>" . $v_branch_id  . "<br/><i>Department: </i>" . $v_department_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          if ($v_attach_file == '') {
                                          ?>
                                             <a target="_blank" href="../img/file/image_no_file.png">
                                                <img height="50px" src="../img/file/image_no_file.png" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target="_blank" href="../img/file/<?php echo $row['te_attach_file'] ?>">
                                                <img height="50px" src="../img/file/pdf_image.png" alt="">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_reason; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_termination.php?id=<?php echo $row['te_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(
                                                        '<?php echo $v_ref_no; ?>',//terminate no 
                                                        <?php echo $row['te_id']; ?>,//terminate id 
                                                        '<?php echo $row['er_id']; ?>',//terminate job id 
                                                        '<?php echo $v_date; ?>',//date
                                                        '<?php echo $v_t_warning; ?>',//total_warnings
                                                        '<?php echo $v_reason; ?>',//reason
                                                        '<?php echo $v_paid; ?>',//paid and unpaid
                                                        '<?php echo $v_staff_l; ?>',//staff_liability
                                                        '<?php echo $v_l_amount; ?>',//te_liability_amount
                                                        '<?php echo $row['te_status_id']; ?>',//status_id
                                                        '<?php echo $v_attach_file; ?>',
                                                        '<?php echo $v_comment_1; ?>',
                                                        '<?php echo $v_comment_2; ?>',
                                                        '<?php echo $v_comment_3; ?>',
                                                        '<?php echo $v_noted; ?>'
                                                        )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a style="color: #fff;" class="btn btn-sm btn-info" href="staff_termination_print.php?id=<?php echo $row['te_id']?>"><i class="fa fa-eye" ></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_termination.php?del_id=<?php echo $row['te_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(ref, id, er_id, date, t_warning, reason, paid,
         staff_l, l_amount, status, file, cm1, cm2, cm3, note) {

         $('#edit_ref').val(ref);
         $('#staff_terminate_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#edit_date').val(date);
         $('#edit_warning').val(t_warning);
         $('#edit_reason').val(reason);
         $('#edit_paid').val(paid).change();
         $('#edit_staff').val(staff_l).change();
         $('#edit_l_amount').val(l_amount);
         $('#edit_status').val(status).change();
         $('#old_file').val(file);
         $('#edit_comment_1').val(cm1);
         $('#edit_comment_2').val(cm2);
         $('#edit_comment_3').val(cm3);
         $('#edit_comment_3').val(cm3);
         $('#edit_noted').val(note);
      }
      $('#txt_job_id').change(function() {
         $('.show_hid').css("display", "block");
         var job_id = $("#txt_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_staff_movent.php',
               data: {
                  staff_job_id: job_id
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_staff").addClass("active");
         $("#termination").addClass("active");
         $("#termination").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>