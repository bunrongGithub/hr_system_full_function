<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/staff_document/";

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST["txt_job_id"];
   $v_namekh = $_POST["txt_name_kh"];
   $v_nameen = $_POST["txt_name_kh"];
   $v_position_id = $_POST["txt_position"];
   $v_branch_id = $_POST["txt_branch"];
   $v_department_id = $_POST["txt_department"];
   $v_salary = $_POST["txt_salary"];
   $v_salary_tax = $_POST["txt_salary_tax"];
   $v_from_date = $_POST["txt_date_from"];
   $v_to_date = $_POST["txt_date_to"];
   $v_note = $_POST["txt_note"];
   $v_ssu_no = $_POST['ssu_no'];
   $v_company = $_POST['txt_company'];
   $v_reason = $_POST['txt_reason'];
   $v_status_id = $_POST['txt_status']; 
   $sql = "INSERT INTO employee_update 
                        (empu_new_company_id,empu_ssu_no, empu_employee_id ,empu_namekh, empu_nameen, empu_new_position,
                        empu_new_branch, empu_new_department, empu_salary, empu_salary_tax, 
                        empu_from_date, empu_to_date, empu_note, created_at, empu_user_id,empu_reason,empu_status_id)
                  VALUES 
                    ('$v_company','$v_ssu_no','$v_job_id', '$v_namekh', '$v_nameen', '$v_position_id',
                    '$v_branch_id', '$v_department_id', '$v_salary', '$v_salary_tax', 
                    '$v_from_date', '$v_to_date', '$v_note','$datetime','$user_id','$v_reason','$v_status_id')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_status_update.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_update_id"];
   $v_job_id = $_POST["edit_job_id"];
   $v_namekh = $_POST["edit_name_kh"];
   $v_nameen = $_POST["edit_name_kh"];
   $v_position_id = $_POST["edit_position"];
   $v_branch_id = $_POST["edit_branch"];
   $v_department_id = $_POST["edit_department"];
   $v_salary = $_POST["edit_salary"];
   $v_salary_tax = $_POST["edit_salary_tax"];
   $v_from_date = $_POST["edit_date_from"];
   $v_to_date = $_POST["edit_date_to"];
   $v_note = $_POST["edit_note"];
   $v_edit_reson = $_POST['edit_reson'];
   $v_edit_status = $_POST['edit_status'];
   $V_edit_company = $_POST['edit_company']; 

   $sql = "UPDATE employee_update SET 
    empu_employee_id = '$v_job_id', 
    empu_namekh = '$v_namekh',
    empu_nameen = '$v_nameen', 
    empu_new_position = '$v_position_id', 
    empu_new_branch = '$v_branch_id', 
    empu_new_department = '$v_department_id',
    empu_salary = '$v_salary',
    empu_salary_tax = '$v_salary_tax',
    empu_from_date = '$v_from_date',
    empu_to_date = '$v_to_date',
    empu_note = '$v_note',
    empu_new_company_id = '$V_edit_company',
    empu_reason = '$v_edit_reson',
    empu_status_id = '$v_edit_status' WHERE empu_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:staff_status_update.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM employee_update WHERE empu_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_status_update.php?message=delete");
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
               Employee Update
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
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-6">
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
                                          <div class="show_hid form-group col-xs-6"style="display: none;">
                                             <label for="ssu_no">SSU No:</label>
                                             <input style="font-weight: 800;" type="text" name="ssu_no" class="form-control" id="ssu_no">
                                          </div>
                                          <p id="amount_data"></p>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Company:</label>
                                             <select class="form-control" id="txt_company" name="txt_company">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM company';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Position:</label>
                                             <select class="form-control" id="txt_position" name="txt_position">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM position';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                      
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Branch:</label>
                                             <select class="form-control" id="txt_branch" name="txt_branch">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM user_branch';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Department:</label>
                                             <select class="form-control" id="txt_department" name="txt_department">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM department';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Salary:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="txt_salary" name="txt_salary" type="number" step="0.01" required>
                                             </div>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>New Salary Tax:</label>
                                             <input type="number" class="form-control" id="txt_salary_tax" name="txt_salary_tax" required />
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>Status:</label>
                                             <select class="form-control" id="txt_status" name="txt_status">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM text_staff_status_update_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tssus_id'] . '">' . $row['tssus_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="show_hid form-group col-lg-12" style="display: none;">
                                             <label>Apply Date:</label>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>From Date:</label>
                                             <input type="date" class="form-control" id="txt_date_from" name="txt_date_from" required />
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>To Date:</label>
                                             <input type="date" class="form-control" id="txt_date_to" name="txt_date_to" required />
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="txt_note" name="txt_note"></textarea>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="display: none;">
                                             <label>Reason:</label>
                                             <textarea class="form-control" rows="2" id="txt_reason" name="txt_reason"></textarea>
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
                                          <input type="hidden" id="staff_update_id" name="staff_update_id" />
                                          <div class="form-group col-xs-12">
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
                                             <label>Employee Name KH:</label>
                                             <input type="text" class="form-control" id="edit_name_kh" name="edit_name_kh" readonly />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Employee Name EN:</label>
                                             <input type="text" class="form-control" id="edit_name_en" name="edit_name_en" readonly />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Company:</label>
                                             <select class="form-control" id="edit_company" name="edit_company">
                                                <?php
                                                $sql = 'SELECT * FROM company';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Position:</label>
                                             <select class="form-control" id="edit_position" name="edit_position">
                                                <?php
                                                $sql = 'SELECT * FROM position';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Branch:</label>
                                             <select class="form-control" id="edit_branch" name="edit_branch">
                                                <?php
                                                $sql = 'SELECT * FROM user_branch';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Department:</label>
                                             <select class="form-control" id="edit_department" name="edit_department">
                                                <?php
                                                $sql = 'SELECT * FROM department';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Salary:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_salary" name="edit_salary" type="number" step="0.01" required>
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>New Salary Tax:</label>
                                             <input type="number" class="form-control" id="edit_salary_tax" name="edit_salary_tax" required />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
                                             <select class="form-control" id="edit_status" name="edit_status">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM text_staff_status_update_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tssus_id'] . '">' . $row['tssus_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-lg-12">
                                             <label>Apply Date:</label>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>From Date:</label>
                                             <input type="date" class="form-control" id="edit_date_from" name="edit_date_from" required />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>To Date:</label>
                                             <input type="date" class="form-control" id="edit_date_to" name="edit_date_to" required />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="edit_note" name="edit_note"></textarea>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Reason:</label>
                                             <textarea class="form-control" rows="2" id="edit_reson" name="edit_reson"></textarea>
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

                        <!-- .box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center" >No</th>
                                    <th class="text-center" >SSU_No</th>
                                    <th class="text-center" >Job ID</th>
                                    <th class="text-center" >Full_Name/Gender</th>
                                    <th class="text-center" >Current_Information</th>
                                    <th class="text-center" >New_Information</th>
                                    <th class="text-center" >New_Salary/Tax_Salary</th>
                                    <th class="text-center" >Applied Date</th>
                                    <th class="text-center" >Reason</th>
                                    <th class="text-center" >Status</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM employee_update 
                                                               LEFT JOIN employee_registration ON employee_registration.er_id = employee_update.empu_employee_id 
                                                               LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                               LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                               LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                               LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                               LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                               LEFT JOIN user ON user.id = employee_update.empu_user_id
                                                               LEFT JOIN text_staff_status_update_status ON text_staff_status_update_status.tssus_id = employee_update.empu_status_id";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_salary = $row["empu_salary"];
                                    $v_salary_tax = $row["empu_salary_tax"];
                                    $v_from_date = $row["empu_from_date"];
                                    $v_to_date = $row["empu_to_date"];
                                    $v_note = $row["empu_note"];
                                    $v_ssu_no = $row['empu_ssu_no'];
                                    $v_reason = $row['empu_reason'];
                                    $v_new_company_id = $row['empu_new_company_id'];
                                    $v_new_branch = $row['empu_new_branch'];
                                    $v_new_department = $row['empu_new_department'];
                                    $v_new_position = $row['empu_new_position'];
                                    $v_status = $row['tssus_name'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;" ><?=$v_ssu_no;?></td>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo $v_er_job_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en."<br/><i>Gender: </i> " . $v_gender_id; ?></td>
                                       
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;" >
                                          <?php 
                                             echo "<i>Company:</i>";
                                             $v_new_company_id = @$row['empu_new_company_id'];
                                             $sqls = "SELECT * FROM company WHERE c_id = '$v_new_company_id'" ;
                                             $results = $connect->query($sqls);
                                             $rows = $results->fetch_assoc();
                                             $rows_show = @$rows['c_name_kh'];
                                             echo $rows_show;
                                             echo "<br/><i>Branch: </i> ";
                                             $v_new_branch = @$row['empu_new_branch'];
                                             //echo $v_new_branch;
                                             $sqls = "SELECT * FROM  user_branch where ub_id = '$v_new_branch'";
                                             $results = $connect->query($sqls);
                                             $rows = $results->fetch_assoc();
                                             $rows_show = @$rows['ub_name'];
                                             echo $rows_show;
                                             echo '<br/><i>Department: </i> ';
                                             $v_new_department = @$row['empu_new_department'];
                                             $sqls = "SELECT * FROM department WHERE de_id = '$v_new_department'";
                                             $results = $connect->query($sqls);
                                             $rows = $results->fetch_assoc();
                                             $rows_show = @$rows["de_name"];
                                             echo $rows_show;
                                             echo "<br/><i>Position: <i/>";
                                             $v_new_position = @$row['empu_new_position'];
                                             $sqls = 'SELECT * FROM position WHERE position_id ='.$v_new_position.'';
                                             $results = $connect->query($sqls);
                                             $rows = $results->fetch_assoc();
                                             $rows_show = @$rows['position'];
                                             echo $rows_show;
                                          ?>
                                             
                                          </td>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo "<i>New Salary: </i>".number_format($v_salary).'$' ."<br/><i>New Tax Salary: </i>" .number_format($v_salary_tax).'$'; ?></td>

                                       <td class="text-center" style="vertical-align: middle;" ><?php echo "<i>From Date: </i> " . $v_from_date . "<br/><i>To Date: </i> " . $v_to_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo $v_reason; ?></td>
                                       <td class="text-center" style="vertical-align: middle;" ><?php echo $v_status; ?></td>

                                       <td class="text-center" style="vertical-align: middle;" >
                                          <!-- <a href="edit_staff_status_update.php?id=<?php echo $row['empu_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(<?php echo $row['empu_id']; ?>,
                                                        '<?php echo $row['er_id']; ?>',
                                                        '<?php echo $row['er_name_kh']; ?>',
                                                        '<?php echo $row['er_name_en']; ?>',
                                                        '<?php echo $row['empu_new_position']; ?>',
                                                        '<?php echo $row['empu_new_branch']; ?>',
                                                        '<?php echo $row['empu_new_department']; ?>',
                                                        '<?php echo $row['empu_salary']; ?>',
                                                        '<?php echo $row['empu_salary_tax']; ?>',
                                                        '<?php echo $row['empu_from_date']; ?>',
                                                        '<?php echo $row['empu_to_date']; ?>',
                                                        '<?php echo $row['empu_note']; ?>',
                                                        '<?php echo $row['empu_new_company_id'];?>',
                                                        '<?php echo $row['empu_reason'];?>',
                                                        '<?php echo $row['empu_status_id'];?>',)" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_status_update.php?del_id=<?php echo $row['empu_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, er_id, namekh, nameen, position, branch, department, salary,
         salary_tax, from_date, to_date, note,company,reson,status_id) {

         $('#staff_update_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#edit_name_kh').val(namekh);
         $('#edit_name_en').val(nameen);
         $('#edit_position').val(position).change();
         $('#edit_branch').val(branch).change();
         $('#edit_department').val(department).change();
         $('#edit_salary').val(salary);
         $('#edit_salary_tax').val(salary_tax);
         $('#edit_date_from').val(from_date);
         $('#edit_date_to').val(to_date);
         $('#edit_note').val(note);
         $('#edit_company').val(company).change();
         $('#edit_reson').val(reson);
         $('#edit_status').val(status_id).change();
      }

      $('#txt_job_id').change(function() {
         $('.show_hid').css("display", "block");
         var job_id = $("#txt_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_staff.php',
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
         $("#menu_staff_update").addClass("active");
         $("#staff_update").addClass("active");
         $("#staff_update").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>