<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST["txt_job_id"];

   $v_no = $_POST['jhr_no'];

   $v_applied_date = $_POST['applied_date'];

   $v_from = $_POST['from'];

   $v_to = $_POST['to'];

   $v_status = $_POST['status'];

   $v_period = $_POST['period'];

   $v_re_work_date = $_POST['re_work_date'];

   $v_reson = $_POST['reson'];

   $v_comment_1 = $_POST['comment_1'];
   $v_comment_2 = $_POST['comment_2'];
   $v_comment_3 = $_POST['comment_3'];
   $v_noted = $_POST['noted'];
   $sql = "INSERT INTO jobhangout (
      jh_job_id
      ,jh_no
      ,jh_applied_date
      ,jh_from
      ,jh_to
      ,jh_period
      ,jh_status_id
      ,jh_restart_date
      ,jh_reason
      ,jh_comment_1
      ,jh_comment_2
      ,jh_comment_3
      ,jh_note
      ,create_at
   ) VALUES ('$v_job_id','$v_no','$v_applied_date','$v_from','$v_to','$v_period','$v_status','$v_re_work_date','$v_reson','$v_comment_1','$v_comment_2','$v_comment_3','$v_noted','$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_job_hangout.php?message=success');
}
if (isset($_POST['btn_upload'])) {
   $id = $_POST['jhr_file_id'];
   $v_file_image = @$_FILES['file_upload'];
   $target_file = '../img/file/' . basename($_FILES['file_upload']['name']);
   $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   $old_file = $_POST['old_file'];
   if ($file_type == 'pdf') {
      if (file_exists("../img/file/" . $old_file) && $old_file != 'blank.png') {
         unlink('../img/file/' . $old_file);
      }
      $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pdf";
      move_uploaded_file($v_file_image['tmp_name'], "../img/file/" . $new_name);
      $query_update = "UPDATE jobhangout SET jh_attach_file = '$new_name' WHERE jh_id = '$id'";
      if ($connect->query($query_update)) {
         header('location:staff_job_hangout.php?message=update');
         exit();
      }
   }
}
if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_job_hangout_id"];
   $v_job_id = $_POST["edit_job_id"];

   $v_no = $_POST['edit_jhr_no'];

   $v_applied_date = $_POST['edit_applied_date'];

   $v_from = $_POST['edit_from'];

   $v_to =  $_POST['edit_to'];

   $v_status = $_POST['edit_status'];

   $v_period = $_POST['edit_period'];

   $v_rework_date = $_POST['edit_rework_date'];

   $v_reson = $_POST['edit_reson'];

   $v_comment_1 = $_POST['edit_comment_1'];

   $v_comment_2 = $_POST['edit_comment_2'];
   $v_comment_3 = $_POST['edit_comment_3'];
   $v_noted = $_POST['edit_noted'];
   $sql = "UPDATE jobhangout SET jh_job_id ='$v_job_id'
                                 ,jh_no = '$v_no'
                                 ,jh_applied_date = '$v_applied_date'
                                 ,jh_from = '$v_from'
                                 ,jh_to = '$v_to'
                                 ,jh_status_id = '$v_status'
                                 ,jh_period = '$v_period'
                                 ,jh_restart_date = '$v_rework_date'
                                 ,jh_reason = '$v_reson'
                                 ,jh_comment_1 = '$v_comment_1'
                                 ,jh_comment_2 = '$v_comment_2'
                                 ,jh_comment_3 = '$v_comment_3'
                                 ,jh_note = '$v_noted'
                                 ,update_at = '$datetime' WHERE  jh_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header('location:staff_job_hangout.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM jobhangout WHERE jh_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_job_hangout.php?message=delete");
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
               Job Hang Out
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
                           <div class="modal-dialog" style="width: 850px;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-md-12">
                                             <div class="col-md-12">
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
                                                   <div class="show_hid col-md-12" style="display: none;">
                                                      <label for="jhr_no">JHR No:</label>
                                                      <input class="form-control" type="text" name="jhr_no" id="jhr_no">
                                                   </div>
                                                   <div id="amount_data"></div>
                                                </div>
                                                <div class="col-md-8">
                                                   <div class="show_hid form-group col-md-6" style="display: none;">
                                                      <label for="applied_date">Apllied Date:</label>
                                                      <input class="form-control" type="date" name="applied_date" id="applied_date">
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="display: none;">
                                                      <label for="form">From:</label>
                                                      <input class="form-control" type="date" name="from" id="from">
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="display: none;">
                                                      <label for="to">To:</label>
                                                      <input class="form-control" type="date" name="to" id="to">
                                                   </div>
                                                   <div class="show_hid form-group col-xs-6" style="display: none;">
                                                      <label for="status">Status:</label>
                                                      <select class="form-control" name="status" id="status" data-live-search="true">
                                                         <option selected value=""></option>
                                                         <?php
                                                            $user_id = $_SESSION['user_id'];
                                                            $sql = "SELECT * FROM text_termination_status A
                                                                              LEFT JOIN text_termination_status_user B ON B.tsu_status_id=A.tts_id
                                                                              WHERE tsu_user_id=$user_id
                                                                              ";
                                                            $result = mysqli_query($connect, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                               echo '<option value=' . $row['tts_id'] . '>' . $row['tts_name'] . '</option>';
                                                            }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class=" form-group col-md-12">
                                                      <div class="show_hid form-group col-md-6" style="display: none;">
                                                         <label for="period">Period:</label>
                                                         <input class="form-control" type="number" name="period" id="period">
                                                      </div>
                                                      <div class="show_hid form-group col-md-6" style="display: none;">
                                                         <label for="re_work_date">Re-Work Date:</label>
                                                         <input class="form-control" type="date" name="re_work_date" id="re_work_date">
                                                      </div>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="reson">Reason:</label>
                                                      <textarea class="form-control" name="reson" id="reson" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="comment_1">Comment 1:</label>
                                                      <textarea class="form-control" name="comment_1" id="comment_1" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="comment_2">Comment 2:</label>
                                                      <textarea class="form-control" name="comment_2" id="comment_2" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="comment_3">Comment 3:</label>
                                                      <textarea class="form-control" name="comment_3" id="comment_3" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="noted">Noted:</label>
                                                      <textarea class="form-control" name="noted" id="noted" rows="2"></textarea>
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
                        <!-- Modal -->
                        <!-- modal_file  -->
                        <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit" aria-hidden="true"></i> Upload File(PDF)</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form action="" method="post" enctype="multipart/form-data">
                                          <input type="hidden" id="jhr_file_id" name="jhr_file_id">
                                          <div class="form-group col-lg-12">
                                             <strong class="form-label">The file upload only <span style="color:blue;">PDF <i class="fa fa-cloud-upload"></i></span></strong>
                                             <input type="hidden" name="old_file" id="old_file">
                                             <input class="form-control" type="File" id="file_upload" name="file_upload" accept=".pdf" onchange="loadFile(event);">
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btn_upload" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Save</button>
                                       <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end_modal_file -->
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
                                          <input type="hidden" id="staff_job_hangout_id" name="staff_job_hangout_id" />
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
                                             <label for="edit_jhr_no">JHR No:</label>
                                             <input class="form-control" type="text" name="edit_jhr_no" id="edit_jhr_no">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="edit_applied_date">Applied Date:</label>
                                             <input class="form-control" type="date" name="edit_applied_date" id="edit_applied_date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="edit_from">From:</label>
                                             <input class="form-control" type="date" name="edit_from" id="edit_from">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="edit_to">To:</label>
                                             <input class="form-control" type="date" name="edit_to" id="edit_to">
                                          </div>

                                          <div class="form-group col-xs-6">
                                             <label for="edit_status">Status:</label>
                                             <select class="form-control" name="edit_status" id="edit_status" data-live-search="true">
                                                <option selected value=""></option>
                                                <?php
                                                   $user_id = $_SESSION['user_id'];
                                                   $sql = "SELECT * FROM text_termination_status A
                                                                     LEFT JOIN text_termination_status_user B ON B.tsu_status_id=A.tts_id
                                                                     WHERE tsu_user_id=$user_id
                                                                     ";
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['tts_id'] . '" >' . $row['tts_name'] . '</option>';
                                                   }
                                                   ?>
                                             </select>
                                          </div>
                                    </div>
                                    <div class=" form-group col-md-12">
                                       <div class="form-group col-xs-6">
                                          <label for="edit_period">Period:</label>
                                          <input class="form-control" type="number" name="edit_period" id="edit_period">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="edit_rework_date">Re-work Date:</label>
                                          <input class="form-control" type="date" name="edit_rework_date" id="edit_rework_date">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="edit_reson">Reason:</label>
                                          <textarea class="form-control" name="edit_reson" id="edit_reson"rows="2"></textarea>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="edit_comment_1">Comment 1:</label>
                                          <textarea class="form-control" name="edit_comment_1" id="edit_comment_1"rows="1"></textarea>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="edit_comment_2">Comment 2:</label>
                                          <textarea class="form-control" name="edit_comment_2" id="edit_comment_2"rows="1"></textarea>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="edit_comment_3">Comment 3:</label>
                                          <textarea class="form-control" name="edit_comment_3" id="edit_comment_3"rows="1"></textarea>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="edit_noted">Noted:</label>
                                          <textarea class="form-control" name="edit_noted" id="edit_noted"rows="1"></textarea>
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
                                    <th class="text-center">JHR No</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Employee Information</th>
                                    <th class="text-center">Attach File</th>
                                    <th class="text-center">Hang Out Period</th>
                                    <th class="text-center">Applid Date</th>
                                    <th class="text-center">Re-Work Date</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM jobhangout 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = jobhangout.jh_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_termination_status ON text_termination_status.tts_id = jobhangout.jh_status_id";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_date = $row["jh_applied_date"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_restart_date = $row["jh_restart_date"];
                                    $v_note = $row["jh_note"];
                                    $v_status_id = $row["tts_name"];
                                    $v_j_no = $row['jh_no'];
                                    $v_attach_file = $row['jh_attach_file'];
                                    $v_from = $row['jh_from'];
                                    $v_to = $row['jh_to'];
                                    $v_reason = $row['jh_reason'];
                                    $v_period = $row['jh_period'];
                                    $v_comment_1 = $row['jh_comment_1'];
                                    $v_comment_2 = $row['jh_comment_2'];
                                    $v_comment_3 = $row['jh_comment_3'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_j_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Job_id: </i> " . $v_er_job_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender: </i> " . $v_gender_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Company: </i>" . $v_company_id . "<br/><i>Branch: </i>" . $v_branch_id . "<br/><i>Department: </i>" . $v_department_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          if ($v_attach_file == '') {
                                          ?>
                                             <a target="_blank" href="../img/file/image_no_file.png">
                                                <img width="50px" height="50px" src="../img/file/image_no_file.png" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target="_blank" href="../img/file/<?php echo $row['jh_attach_file'] ?>">
                                                <img width="50px" height="50px" src="../img/file/pdf_image.png" alt="">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a onclick="doFile('<?php echo $row['jh_id']; ?>','<?php echo $v_attach_file; ?>')" data-toggle="modal" data-target="#modal_file">
                                             <i class=" text-primary fa fa-pencil"></i><br><strong>Upload File Here(PDF)</strong>
                                          </a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          echo "<i>From: </i>" . $v_from . "<br/><i>To: </i>" . $v_to;
                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_restart_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_reason ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_job_hangout.php?id=<?php echo $row['jh_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(<?php echo $row['jh_id']; ?>,
                                                        '<?php echo $row['jh_job_id']; ?>',
                                                        '<?php echo $v_j_no ?>',
                                                        '<?php echo $v_date ?>',
                                                        '<?php echo $v_from ?>',
                                                        '<?php echo $v_to ?>',
                                                        '<?php echo $row['jh_status_id'] ?>',
                                                        '<?php echo $v_period ?>',
                                                        '<?php echo $v_restart_date?>',
                                                        '<?php echo $v_reason?>',
                                                        '<?php echo $v_comment_1?>',
                                                        '<?php echo $v_comment_2?>',
                                                        '<?php echo $v_comment_3?>',
                                                        '<?php echo $v_note?>',
                                                        )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a style="color: white;" class="btn btn-sm btn-info" href="staff_job_hang_out_print.php?id=<?php echo $row['jh_id']?>"><i class="fa fa-edit"></i></a>

                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_job_hangout.php?del_id=<?php echo $row['jh_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, er_id, no, applied_date, from, to, status, period,re_work_date,reason,cm1,cm2,cm3,note) {
         $('#staff_job_hangout_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#edit_jhr_no').val(no);
         $('#edit_applied_date').val(applied_date);
         $('#edit_from').val(from);
         $('#edit_to').val(to);
         $('#edit_status').val(status).change();
         $('#edit_period').val(period);
         $('#edit_rework_date').val(re_work_date);
         $('#edit_reson').val(reason);
         $('#edit_comment_1').val(cm1);
         $('#edit_comment_2').val(cm2);
         $('#edit_comment_3').val(cm3);
         $('#edit_noted').val(note);

      }

      function doFile(id, file) {
         $('#jhr_file_id').val(id);
         $('#old_file').val(file);
      }

      function loadFile(event) {
         var output = document.getElementById('file_upload');
         output.width = 50;
         output.scr = URL.createObjectURL(event.target.file[0])
      }
      $('#txt_job_id').change(function() {
         $('.show_hid').css("display", "block");
         var job_id = $("#txt_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_job_hang_out.php',
               data: {
                  'staff_job_id': job_id
               },
               success: function(data) {
                  $("#amount_data").html(data);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_staff").addClass("active");
         $("#job_hang_out").addClass("active");
         $("#job_hang_out").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>