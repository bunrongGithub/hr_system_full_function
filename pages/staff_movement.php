<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST['txt_job_id'];
   $v_sm_no = $_POST['sm_no'];
   $v_company = $_POST['cunrrent_company'];
   $v_branch = $_POST['cunrrent_branch'];
   $v_department = $_POST['cunrrent_deparment'];
   $v_position = $_POST['cunrrent_position'];
   $v_salary = $_POST['current_salary'];
   $v_tax_salary = $_POST['current_tax_salary'];
   $v_current_reason = $_POST['current_reason'];
   $v_current_comment_one = $_POST['current_comment_one'];
   $v_current_comment_two = $_POST['current_comment_two'];
   $v_cunrrent_status = $_POST['cunrrent_status'];

   $sql = "INSERT INTO staff_movement(sm_no,sm_job_id,
                                       sm_new_info_company
                                       ,sm_new_info_branch
                                       ,sm_new_info_department
                                       ,sm_new_info_position
                                       ,sm_salary
                                       ,sm_tax_salary
                                       ,sm_reason
                                       ,sm_comment_en
                                       ,sm_comment_kh
                                       ,sm_status
                                       ,created_at) VALUES ('$v_sm_no'
                                                            ,'$v_job_id'
                                                            ,'$v_company'
                                                            ,'$v_branch'
                                                            ,'$v_department'
                                                            ,'$v_position'
                                                            ,'$v_salary'
                                                            ,'$v_tax_salary'
                                                            ,'$v_current_reason'
                                                            ,'$v_current_comment_one'
                                                            ,'$v_current_comment_two'
                                                            ,'$v_cunrrent_status'
                                                            ,'$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_movement.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_movement_id"];
   $v_job_id = $_POST["edit_job_id"];
   $v_sm_no = $_POST['new_sm_no'];
   $v_input_by = $_POST["input_by"];
   $v_apllied_date = $_POST['apllied_date'];

   $v_new_company = $_POST['new_company'];
   $v_new_branch = $_POST['new_branch'];
   $v_new_department = $_POST['new_department'];

   $v_new_position = $_POST['new_position'];

   $v_new_salary = $_POST['new_salary'];

   $v_new_tax_salary = $_POST['new_tax_salary'];

   $v_new_status = $_POST['new_status'];

   $v_new_reason = $_POST['new_reason'];

   $v_new_comment_one = $_POST['new_comment_one'];

   $v_new_comment_two = $_POST['new_comment_two'];

   $v_pnew_noted = $_POST['new_noted'];

   $sql = "UPDATE staff_movement SET 
    sm_job_id = '$v_job_id', 
    sm_no = '$v_sm_no',
    sm_user_id = '$v_input_by',
    sm_applied_date = '$v_apllied_date',
   sm_new_info_company = '$v_new_company',
   sm_new_info_branch = '$v_new_branch',
   sm_new_info_department = '$v_new_department',
   sm_new_info_position = '$v_new_position',
   sm_salary = '$v_new_salary',
   sm_tax_salary = '$v_new_tax_salary',
   sm_status = '$v_new_status',
   sm_reason = '$v_new_reason',
   sm_comment_en = '$v_new_comment_one',
   sm_comment_kh = '$v_new_comment_two',
   sm_note = '$v_pnew_noted',
   updated_at = '$datetime'   WHERE sm_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:staff_movement.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM staff_movement WHERE sm_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_movement.php?message=delete");
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
               Staff Movement
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
                                                <!-- col_current_info -->
                                                <div class="col-md-4">
                                                   <div class="show_hid col-md-12" style="visibility: hidden;">
                                                      <label for="sm_no">SM No:</label>
                                                      <input class="form-control" type="text" name="sm_no" id="sm_no">
                                                   </div>
                                                   <div id="amount_data"></div>
                                                </div>
                                                <!-- col_new_info -->
                                                <div class=" col-md-8">
                                                   <h3 class="show_hid col-md-12" style="visibility: hidden;">
                                                      <strong>New Info:</strong>
                                                   </h3>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="cunrrent_company">Company:</label>
                                                      <select class="form-control" name="cunrrent_company" id="cunrrent_company" data-live-search="true">
                                                         <option disabled selected value="">=== Select ===</option>
                                                         <?php
                                                         $sql = "SELECT * FROM company order by c_name_kh asc";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                         ?>
                                                            <option value="<?php echo $row['c_id'] ?>"><?php echo $row['c_name_kh'] ?></option>
                                                         <?php
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="cunrrent_branch">Branch:</label>
                                                      <select class="form-control" name="cunrrent_branch" id="cunrrent_branch" data-live-search="true">
                                                         <option disabled selected value="">=== Select ===</option>
                                                         <?php
                                                         $sql = "SELECT * FROM user_branch ORDER BY ub_name ASC";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value=' . $row['ub_id'] . '>' . $row['ub_name'] . '</option>';
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="cunrrent_deparment">Department:</label>
                                                      <select class="form-control" name="cunrrent_deparment" id="cunrrent_deparment" data-live-search="true">
                                                         <option disabled selected value="">=== Select ===</option>
                                                         <?php
                                                         $sql = "SELECT * FROM department ORDER BY de_name ASC";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value=' . $row['de_id'] . '>' . $row['de_name'] . '</option>';
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="cunrrent_position">Position:</label>
                                                      <select class="form-control" name="cunrrent_position" id="cunrrent_position" data-live-search="true">
                                                         <option disabled selected value="">=== Select ===</option>
                                                         <?php
                                                         $sql = "SELECT * FROM position ORDER BY position ASC";
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value=' . $row['position_id'] . '>' . $row['position'] . '</option>';
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="current_salary">Salary:</label>
                                                      <input class="form-control" type="text" name="current_salary" id="current_salary">
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="current_tax_salary">Tax Salary:</label>
                                                      <input class="form-control" type="text" name="current_tax_salary" id="current_tax_salary">
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                      <label for="current_reason">Reason :</label>
                                                      <textarea class="form-control" type="text" name="current_reason" id="current_reason" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                      <label for="current_comment_one">Comment 1 :</label>
                                                      <textarea class="form-control" type="text" name="current_comment_one" id="current_comment_one" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="visibility: hidden;">
                                                      <label for="current_comment_two">Comment 2 :</label>
                                                      <textarea class="form-control" type="text" name="current_comment_two" id="current_comment_two" rows="2"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-6" style="visibility: hidden;">
                                                      <label for="cunrrent_status">Status:</label>
                                                      <select class="form-control" name="cunrrent_status" id="cunrrent_status" data-live-search="true">
                                                         <option disabled selected value="">=== Select ===</option>
                                                         <?php
                                                            $user_id = $_SESSION['user_id'];
                                                            $sql = "SELECT * FROM text_staff_moment_status A
                                                                              LEFT JOIN text_staff_moment_status_user B ON B.smsu_status_id=A.sms_id
                                                                              WHERE smsu_user_id=$user_id
                                                                              ORDER BY sms_name ASC";
                                                            $result = mysqli_query($connect, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                               echo '<option value=' . $row['sms_id'] . '>' . $row['sms_name'] . '</option>';
                                                            }
                                                         ?>
                                                      </select>
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
                                          <input type="hidden" id="staff_movement_id" name="staff_movement_id" />
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
                                             <label for="new_sm_no">SM No:</label>
                                             <input class="form-control" type="text" name="new_sm_no" id="new_sm_no">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="input_by">Input By:</label>
                                             <select class="form-control" name="input_by" id="input_by" data-live-search="true">
                                                <?php
                                                $sql = "SELECT * FROM user order by username asc";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['id'] . '" >' . $row['username'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="apllied_date">Applied Date:</label>
                                             <input class="form-control" name="apllied_date" id="apllied_date" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="new_company">Company:</label>
                                             <select class="form-control" name="new_company" id="new_company" data-live-search="true">
                                                <?php
                                                $sql = "SELECT * FROM company order by c_name_kh ASC";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '" >' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="new_branch">Branch:</label>
                                             <select class="form-control" name="new_branch" id="new_branch" data-live-search="true">
                                                <?php
                                                $sql = "SELECT * FROM user_branch order by ub_name ASC";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '" >' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="new_department">Department:</label>
                                             <select class="form-control" name="new_department" id="new_department" data-live-search="true">
                                                <?php
                                                $sql = "SELECT * FROM department order by de_name ASC";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '" >' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="new_position">Position:</label>
                                             <select class="form-control" name="new_position" id="new_position" data-live-search="true">
                                                <?php
                                                $sql = "SELECT * FROM position order by position ASC";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['position_id'] . '" >' . $row['position'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="">Salary:</label>
                                             <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" type="text" name="new_salary" id="new_salary">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="">Tax Salary:</label>
                                             <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" type="text" name="new_tax_salary" id="new_tax_salary">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="new_status">Status:</label>
                                             <select class="form-control" name="new_status" id="new_status" data-live-search="true">
                                                <?php
                                                $user_id = $_SESSION['user_id'];
                                                $sql = "SELECT * FROM text_staff_moment_status A
                                                                  LEFT JOIN text_staff_moment_status_user B ON B.smsu_status_id=A.sms_id
                                                                  WHERE smsu_user_id=$user_id
                                                                  order by sms_name ASC";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['sms_id'] . '" >' . $row['sms_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label for="">Reason:</label>
                                             <textarea class="form-control" name="new_reason" id="new_reason" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label for="new_comment_one">Comment 1:</label>
                                             <textarea class="form-control" name="new_comment_one" id="new_comment_one" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label for="new_comment_two">Comment 2:</label>
                                             <textarea class="form-control" name="new_comment_two" id="new_comment_two" rows="1"></textarea>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label for="new_noted">Noted:</label>
                                             <textarea class="form-control" name="new_noted" id="new_noted" rows="1"></textarea>
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
                                    <th>No</th>
                                    <th class="text-center">SM No</th>
                                    <th>Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Current Info</th>
                                    <th class="text-center">New Info</th>
                                    <th class="text-center">Applied Date</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Input By/Date</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM staff_movement 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = staff_movement.sm_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN user ON user.id = staff_movement.sm_user_id
                                                                LEFT JOIN text_staff_moment_status ON text_staff_moment_status.sms_id = staff_movement.sm_status
                                                                ";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_sm_no = $row['sm_no'];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_current_info = $row["sm_current_info"];
                                    $v_new_info = $row["sm_new_info"];
                                    $v_note = $row["sm_note"];
                                    $v_salary = $row['er_salary'];
                                    $v_tax_salary = $row['er_salary_tax'];
                                    $v_new_company_info = $row['sm_new_info_company'];
                                    $v_new_branch = $row['sm_new_info_branch'];
                                    $v_new_department = $row['sm_new_info_department'];
                                    $v_new_position = $row['sm_new_info_position'];
                                    $v_new_salary = $row['sm_salary'];
                                    $v_new_tax_salary = $row['sm_tax_salary'];
                                    $v_applied_date = $row['sm_applied_date'];
                                    $v_reason = $row['sm_reason'];
                                    $v_status = $row['sms_name'];
                                    $v_comment_one = $row['sm_comment_en'];
                                    $v_comment_two = $row['sm_comment_kh'];

                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_sm_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_job_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo  "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender:</i>" . $v_gender_id; ?></td>

                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id . "<br/><i>Position: </i> " . $v_position_id . "<br/><i>Salary: <i/>" . $v_salary . "$" . "<br/><i>Tax Salary: </i>" . $v_tax_salary . "$"; ?></td>
                                       <!-- current_information_employee -->
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          //new_company
                                          $v_new_company_info = @$row['sm_new_info_company'];
                                          $sql_new_company = "SELECT * FROM company WHERE c_id = '$v_new_company_info'";
                                          $result_new_company = $connect->query($sql_new_company);
                                          $row_company = $result_new_company->fetch_assoc();
                                          $row_company_show = @$row_company['c_name_kh'];
                                          echo "<i>Company: </i>" . $row_company_show;
                                          //new_branch 
                                          $v_new_branch = @$row['sm_new_info_branch'];
                                          $sql_new_branch = "SELECT * FROM user_branch WHERE ub_id = '$v_new_branch'";
                                          $result_new_branch = $connect->query($sql_new_branch);
                                          $row_branch = $result_new_branch->fetch_assoc();
                                          $row_new_branch_show = @$row_branch['ub_name'];
                                          echo "<br/><i>Branch: </i>" . $row_new_branch_show;
                                          //new deparment
                                          $v_new_department = @$row['sm_new_info_department'];
                                          $v_sql_new_deparment = "SELECT * FROM department WHERE de_id = '$v_new_department'";
                                          $result_new_department = $connect->query($v_sql_new_deparment);
                                          $row_new_dep = $result_new_department->fetch_assoc();
                                          $row_new_dep_show = @$row_new_dep['de_name'];
                                          echo "<br/><i>Deparment: </i>" . $row_new_dep_show;
                                          //new_positions
                                          $v_new_position = @$row['sm_new_info_position'];
                                          $sql_new_pos = "SELECT * FROM position WHERE position_id = '$v_new_position'";
                                          $result_new_pos = $connect->query($sql_new_pos);
                                          $row_new_pos = $result_new_pos->fetch_assoc();
                                          $row_new_pos_show = @$row_new_pos['position'];
                                          echo "<br/><i>Position: </i>" . $row_new_pos_show;
                                          //new_salary
                                          echo "<br/><i>Salary: </i>" . $v_new_salary . "$";
                                          //tax_salary
                                          echo "<br/><i>Tax Salary: </i>" . $v_new_tax_salary . "$";

                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_applied_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_reason; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Input By: </i> " . $row['username'] . "<br/><i>Date: </i> " . $row['created_at']; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_movement.php?id=<?php echo $row['sm_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate('<?php echo $row['sm_id']; ?>',
                                                            '<?php echo $row['er_id']; ?>',
                                                            '<?php echo $v_applied_date; ?>',
                                                            '<?php echo $v_new_salary; ?>',
                                                            '<?php echo $v_new_tax_salary; ?>',
                                                            '<?php echo $row['id']; ?>',
                                                            '<?php echo $row['sm_new_info_company']; ?>',
                                                            '<?php echo $row['sm_new_info_branch']; ?>',
                                                            '<?php echo $row['sm_new_info_department']; ?>',
                                                            '<?php echo $row['sm_new_info_position']; ?>',
                                                            '<?php echo $row['sms_id']; ?>',
                                                            '<?php echo $v_reason; ?>',
                                                            '<?php echo $v_comment_one; ?>',
                                                            '<?php echo $v_comment_two; ?>',
                                                            '<?php echo $v_note; ?>',
                                                            '<?php echo $v_sm_no; ?>',
                                                         )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a href="staff_movement_print.php?id=<?php echo $row['sm_id'];?>" style="color: #fff;" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_movement.php?del_id=<?php echo $row['sm_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>

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
      function doUpdate(id, er_id, date, new_salary, new_tax_salary, user_id, company_id, branch, dep, position, sms_status, reason, comment_one, comment_two, noted, sm_no) {
         $('#staff_movement_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#apllied_date').val(date);
         $('#new_salary').val(new_salary);
         $('#new_tax_salary').val(new_tax_salary);
         $('#input_by').val(user_id).change();
         $('#new_company').val(company_id).change();
         $('#new_branch').val(branch).change();
         $('#new_department').val(dep).change();
         $('#new_position').val(position).change();
         $('#new_status').val(sms_status).change();
         $('#new_reason').val(reason);
         $('#new_comment_one').val(comment_one);
         $('#new_comment_two').val(comment_two);
         $('#new_noted').val(noted);
         $('#new_sm_no').val(sm_no);

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
         $("#staff_move").addClass("active");
         $("#staff_move").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>