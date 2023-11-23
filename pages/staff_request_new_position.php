<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST["txt_job_id"];
   $v_rnp_no = $_POST["rnp_no"];
   $v_cunrrent_position = $_POST["cunrrent_position"];
   $v_applied_date = $_POST["applied_date"];
   $v_reason = $_POST["reason"];
   $v_comment_one = $_POST["comment_one"];
   $v_comment_two = $_POST["comment_two"];
   $v_comment_tree = $_POST["comment_tree"];
   $v_status = $_POST["status"];
   $v_input_by = $_POST["input_by"];
   $v_noted = $_POST["noted"];
   $sql = "INSERT INTO request_new_position 
                        ( rn_job_id,
                        rn_rnp_no,
                        rn_new_position,
                        rn_appled_date,
                        rn_reason,
                        comment_1,
                        comment_2,
                        comment_3,
                        rn_status,
                        rn_user_id,
                        rn_note,
                        created_at) VALUES 
                                       ('$v_job_id'
                                       ,'$v_rnp_no'
                                       ,'$v_cunrrent_position'
                                       ,'$v_applied_date'
                                       ,'$v_reason'
                                       ,'$v_comment_one'
                                       ,'$v_comment_two'
                                       ,'$v_comment_tree'
                                       ,'$v_status'
                                       ,'$v_input_by'
                                       ,'$v_noted'
                                       ,'$datetime')";
   $result = mysqli_query($connect, $sql);
   //update position registration
   $v_job_id = $_POST["txt_job_id"];
   $v_cunrrent_position = $_POST["cunrrent_position"];
   $sql = "UPDATE employee_registration SET er_position_id = '$v_cunrrent_position'
                                       WHERE er_id = $v_job_id";

   $result = mysqli_query($connect, $sql);
   //update position registration
   header('location:staff_request_new_position.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_new_pos_id"];
   $v_job_id = $_POST["edit_job_id"];
   $v_edit_rnp_no = $_POST['edit_rnp_no'];
   $v_edit_input_by = $_POST['edit_input_by'];
   $v_edit_new_position = $_POST['edit_new_position'];
   $v_edit_status = $_POST['edit_status'];
   $v_edit_reason = $_POST['edit_reason'];
   $v_edit_comment_one = $_POST['edit_comment_one'];
   $v_edit_comment_two = $_POST['edit_comment_two'];
   $v_edit_comment_tree = $_POST['edit_comment_tree'];
   $v_edit_noted = $_POST['edit_noted'];
   $v_edit_applied_date = $_POST['edit_applied_date'];

   $sql = "UPDATE request_new_position SET 
    rn_job_id = '$v_job_id',
    rn_rnp_no = '$v_edit_rnp_no',
    rn_user_id = '$v_edit_input_by',
    rn_new_position = '$v_edit_new_position',
    rn_status = '$v_edit_status',
    rn_reason = '$v_edit_reason',
    comment_1 = '$v_edit_comment_one',
    comment_2 = '$v_edit_comment_two',
    comment_3 = '$v_edit_comment_tree',
    rn_note = '$v_edit_noted',
    created_at = '$datetime',
    rn_appled_date = '$v_edit_applied_date'
     WHERE rn_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:staff_request_new_position.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM request_new_position WHERE rn_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_request_new_position.php?message=delete");
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
               echo '<div class="alert alert-info">';
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
               Request New Position
            </h1>
         </section>
         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <!-- Modal_add_new-->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog" style="width: 950px;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-12">
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
                                             <!-- current_info  -->
                                             <div class="col-md-4">
                                                <div class="show_hid col-md-12" style="visibility: hidden;">
                                                   <label for="rnp_no">RNP No:</label>
                                                   <input class="form-control" type="text" name="rnp_no" id="rnp_no">
                                                </div>
                                                <div id="amount_data"></div>
                                             </div>
                                             <!-- new_info -->
                                             <div class="col-md-8">
                                                <h3 class="show_hid col-md-12" style="visibility: hidden;">
                                                   <strong>New Info:</strong>
                                                </h3>
                                                <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                   <label for="cunrrent_position">New Position:</label>
                                                   <select class="form-control" name="cunrrent_position" id="cunrrent_position" data-live-search="true">
                                                      <option disabled selected value="">===== Select =====</option>
                                                      <?php
                                                      $sql = "SELECT * FROM position order by position asc";
                                                      $result = mysqli_query($connect, $sql);
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                      ?>
                                                         <option value="<?php echo $row['position_id'] ?>"><?php echo $row['position'] ?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                   <label for="input_by">Input By:</label>
                                                   <select class="form-control" name="input_by" id="input_by" data-live-search="true">
                                                      <option disabled selected value="">=== Select ===</option>
                                                      <?php 
                                                         $sql = "SELECT * FROM user order by username asc";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                         ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                                                         <?php
                                                         }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                   <label for="applied_date">Apllied Date</label>
                                                   <input class="form-control" type="date" name="applied_date" id="applied_date">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                   <label for="status">Stutus:</label>
                                                   <select class="form-control" name="status" id="status" data-live-search="true">
                                                      <option disabled selected value="">=== Select ===</option>
                                                      <?php 
                                                         $sql = "SELECT * FROM text_requ_new_pos_status order by trnp_name asc";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                         ?>
                                                            <option value="<?php echo $row['trnp_id'] ?>"><?php echo $row['trnp_name'] ?></option>
                                                         <?php
                                                         }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                   <label for="reason">Reason:</label>
                                                   <textarea class="form-control" type="date" name="reason" rows="2" id="reason"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                   <label for="comment_one">Comment 1:</label>
                                                   <textarea class="form-control" type="date" name="comment_one" rows="2" id="comment_one"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                   <label for="comment_two">Comment 2:</label>
                                                   <textarea class="form-control" type="date" name="comment_two" rows="2" id="comment_two"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                   <label for="comment_tree">Comment 3:</label>
                                                   <textarea class="form-control" type="date" name="comment_tree" rows="2" id="comment_tree"></textarea>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                   <label for="noted">Noted:</label>
                                                   <textarea class="form-control" type="date" name="noted" rows="2" id="noted"></textarea>
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
                        <!-- Modal_add_new -->
                        <!-- Modal_Update-->
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
                                          <input type="hidden" id="staff_new_pos_id" name="staff_new_pos_id" />
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
                                             <label class="form-label" for="edit_rnp_no">RNP No:</label>
                                             <input class="form-control" type="text" name="edit_rnp_no" id="edit_rnp_no">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label class="form-label" for="edit_input_by">Input By:</label>
                                             <select class="form-control" name="edit_input_by" id="edit_input_by" data-live-search="true">
                                                <option  selected value=""></option>
                                                <?php 
                                                   $sql = "SELECT * FROM user";
                                                   $result = mysqli_query($connect,$sql);
                                                   while($row = mysqli_fetch_assoc($result)){
                                                      echo '<option value="'. $row['id'] .'" >'. $row['username'] .'</option>';
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label class="form-label" for="edit_applied_date">Applied Date:</label>
                                             <input class="form-control" type="date" name="edit_applied_date" id="edit_applied_date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label class="form-label" for="edit_new_position">New Position:</label>
                                             <select class="form-control" name="edit_new_position" id="edit_new_position" data-live-search="true">
                                                <option  selected value=""></option>
                                                <?php 
                                                   $sql = "SELECT * FROM position";
                                                   $result = mysqli_query($connect,$sql);
                                                   while($row = mysqli_fetch_assoc($result)){
                                                      echo '<option value="'. $row['position_id'] .'" >'. $row['position'] .'</option>';
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label class="form-label" for="edit_status">Status:</label>
                                             <select class="form-control" name="edit_status" id="edit_status" data-live-search="true">
                                                <option  selected value=""></option>
                                                <?php 
                                                   $sql = "SELECT * FROM text_requ_new_pos_status";
                                                   $result = mysqli_query($connect,$sql);
                                                   while($row = mysqli_fetch_assoc($result)){
                                                      echo '<option value="'. $row['trnp_id'] .'" >'. $row['trnp_name'] .'</option>';
                                                   }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label class="form-label" for="edit_reason">Reason:</label>
                                             <textarea class="form-control" name="edit_reason" id="edit_reason" rows="2"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label class="form-label" for="edit_comment_one">Comment 1:</label>
                                             <textarea class="form-control" name="edit_comment_one" id="edit_comment_one" rows="2"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label class="form-label" for="edit_comment_two">Comment 2:</label>
                                             <textarea class="form-control" name="edit_comment_two" id="edit_comment_two" rows="2"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label class="form-label" for="edit_comment_tree">Comment 3:</label>
                                             <textarea class="form-control" name="edit_comment_tree" id="edit_comment_tree" rows="2"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label class="form-label" for="edit_noted">Noted:</label>
                                             <textarea class="form-control" name="edit_noted" id="edit_noted" rows="2"></textarea>
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
                        <!-- Modal_Update -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">RNP No</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Current Position</th>
                                    <th class="text-center">New Position</th>
                                    <th class="text-center">Applied Date</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Input By/Date</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM request_new_position 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = request_new_position.rn_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_requ_new_pos_status ON text_requ_new_pos_status.trnp_id = request_new_position.rn_status 
                                                                LEFT JOIN user ON user.id = request_new_position.rn_user_id";
                                 $resultl = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $resultl->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_date = $row["rn_appled_date"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_rnp_no = $row['rn_rnp_no'];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_reason = $row["rn_reason"];
                                    $v_status_id = $row["trnp_name"];
                                    $v_note = $row["rn_note"];
                                    $user_id_input = $row['username'];
                                    $v_creat_at = $row['created_at'];
                                    $v_comment_1 = $row['comment_1'];
                                    $v_commment_2 = $row['comment_2'];
                                    $v_commment_3 = $row['comment_3'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i;?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_rnp_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Job_id: </i> " . $v_er_job_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender: </i> " . $v_gender_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_position_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          $v_new_position =  @$row['rn_new_position'];
                                          $sql = "SELECT * FROM position WHERE position_id = '$v_new_position'";
                                          $result = $connect->query($sql);
                                          $result_row = $result->fetch_assoc();
                                          $v_new_pos_show = @$result_row['position'];
                                          echo $v_new_pos_show;
                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_date;?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_reason; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_note; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Input By: </i> " . $user_id_input . "<br/><i>Date: </i> " . $v_creat_at; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_request_new_position.php?id=<?php echo $row['rn_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate('<?php echo $row['rn_id']; ?>',
                                                            '<?php echo $row['er_id'];?>',
                                                            '<?php echo $v_rnp_no;?>',
                                                            '<?php echo $row['id'];?>',
                                                            '<?php echo $v_date;?>',
                                                            '<?php echo $row['rn_new_position'];?>',
                                                            '<?php echo $row['rn_status']; ?>',
                                                            '<?php echo $v_reason;?>',
                                                            '<?php echo $v_comment_1;?>',
                                                            '<?php echo $v_commment_2;?>',
                                                            '<?php echo $v_commment_3;?>',
                                                            '<?php echo $v_note;?>',)" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                            <a style="color: white;" class="btn btn-sm btn-info" href="staff_request_new_position_print.php?id=<?php echo $row['rn_id'];?>"><i class="fa fa-eye"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_request_new_position.php?del_id=<?php echo $row['rn_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id,er_id,rnp_no,user_id,applied_dates,position,status,reason,cm1,cm2,cm3,noted) {
         $('#staff_new_pos_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#edit_rnp_no').val(rnp_no);
         $('#edit_input_by').val(user_id).change();
         $('#edit_applied_date').val(applied_dates);
         $('#edit_new_position').val(position).change();
         $('#edit_status').val(status).change();
         $('#edit_reason').val(reason);
         $('#edit_comment_one').val(cm1);
         $('#edit_comment_two').val(cm2);
         $('#edit_comment_tree').val(cm3);
         $('#edit_noted').val(noted);

      }
      $('#txt_job_id').change(function() {
         $('.show_hid').css("visibility", "visible");
         var job_id = $("#txt_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_staff_movent.php',
               data: {
                  'staff_job_id': job_id
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
         $("#request_position").addClass("active");
         $("#request_position").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>