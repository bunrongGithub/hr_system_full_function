<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/staff_register_img/";

if (isset($_POST["btnupdate"])) {
   $id = $_POST["er_edit_id"];
   $v_job_id = $_POST["edit_job_id"];
   $v_namekh = $_POST["edit_namekh"];
   $v_nameen = $_POST["edit_nameen"];
   $v_tel = $_POST["edit_tel"];
   $v_gender = $_POST["edit_gender"];
   $v_position = $_POST["edit_position"];
   $v_department = $_POST["edit_department"];
   $v_branch = $_POST["edit_branch"];
   $v_company = $_POST["edit_company"];
   $v_address = $_POST["edit_address"];
   $v_bank_name = $_POST["edit_bank_name"];
   $v_bank_num = $_POST["edit_bank_num"];
   $v_con_period = $_POST["edit_con_period"];
   $v_date_from = $_POST["edit_date_from"];
   $v_date_to = $_POST["edit_date_to"];
   $v_salary = $_POST["edit_salary"];
   $v_salary_tax = $_POST["edit_salary_tax"];
   $v_child = $_POST["edit_child"];
   $v_spouse = $_POST["edit_spouse"];
   $v_family_status = $_POST["edit_family_status"];
   $v_edu_level = $_POST["edit_edu_level"];
   $v_probat_per = $_POST["edit_probat_per"];
   $v_pro_date_from = $_POST["edit_pro_date_from"];
   $v_pro_date_to = $_POST["edit_pro_date_to"];
   $v_note = $_POST["edit_note"];

   $sql = "UPDATE employee_registration SET er_job_id = '$v_job_id',
    er_name_kh = '$v_namekh',
    er_name_en = '$v_nameen',
    er_tel = '$v_tel',
    er_gender_id = '$v_gender',
    er_position_id = '$v_position',
    er_department_id = '$v_department',
    er_branch_id = '$v_branch',
    er_company_id = '$v_company',
    er_address = '$v_address',
    er_bank_acc_name = '$v_bank_name',
    er_bank_acc_num = '$v_bank_num',
    er_contract_period = '$v_con_period',
    er_period_from = '$v_date_from',
    er_period_to = '$v_date_to',
    er_salary = '$v_salary',
    er_salary_tax = '$v_salary_tax',
    er_children = '$v_child',
    er_spouse = '$v_spouse',
    er_family_status_id = '$v_family_status',
    er_education_level = '$v_edu_level',
    er_probation_period = '$v_probat_per',
    er_probation_per_from = '$v_pro_date_from',
    er_probation_per_to = '$v_pro_date_to',
    er_note = '$v_note' WHERE er_id = $id ";

   $result = mysqli_query($connect, $sql);
   header('location:staff_registration.php?message=update');
}


if (isset($_POST["btnimage"])) {
   $id = $_POST["er_img_id"];
   if (!empty($_FILES['edit_photo']['name'])) {
      /////////////////upload image//////////////////////
      $v_filename = date("Ymd") . "_id" . $v_job_id . "_" . basename($_FILES['edit_photo']['name']);
      $v_filefullname = $targetDir . date("Ymd") . "_id" . $v_job_id . "_" . basename($_FILES['edit_photo']['name']);
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_filefullname);
      ////////////////////////////////////////////////////
      $sql = "UPDATE employee_registration SET er_photo = '$v_filename' WHERE er_id = $id";
      $result = mysqli_query($connect, $sql);
   }
   header('location:staff_registration.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM employee_registration WHERE er_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_registration.php?message=delete");
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
   <!-- Daterange picker -->
   <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <!-- bootstrap wysihtml5 - text editor -->
   <link href="../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
   <!-- DATA TABLES -->
   <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   <!-- Theme style -->
   <link href="../css/style.css" rel="stylesheet" type="text/css" />
   <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
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
               Employee
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
                        <div class="modal fade" id="myModal_update" role="dialog">
                           <div class="modal-dialog modal-lg modal-dialog-scrollable">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information </h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="er_edit_id" name="er_edit_id" />
                                          <div class="form-group col-xs-4">
                                             <label>Job ID:</label>
                                             <input type="text" class="form-control" id="edit_job_id" name="edit_job_id" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Name KH:</label>
                                             <input type="text" class="form-control" id="edit_namekh" name="edit_namekh" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Name EN:</label>
                                             <input type="text" class="form-control" id="edit_nameen" name="edit_nameen" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>TEL:</label>
                                             <input type="text" class="form-control" id="edit_tel" name="edit_tel" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Gender:</label>
                                             <select class="form-control" id="edit_gender" name="edit_gender">
                                                <?php
                                                $sql = 'SELECT * FROM gender';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ge_id'] . '">' . $row['ge_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Position:</label>
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
                                          <div class="form-group col-xs-4">
                                             <label>Company:</label>
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
                                          <div class="form-group col-xs-4">
                                             <label>Branch:</label>
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
                                          <div class="form-group col-xs-4">
                                             <label>Department:</label>
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
                                          <div class="form-group col-xs-4">
                                             <label>Address:</label>
                                             <input type="text" class="form-control" id="edit_address" name="edit_address" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Bank Name:</label>
                                             <input type="text" class="form-control" id="edit_bank_name" name="edit_bank_name" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Bank Number:</label>
                                             <input type="number" class="form-control" id="edit_bank_num" name="edit_bank_num" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Contract Period:</label>
                                             <input type="text" class="form-control" id="edit_con_period" name="edit_con_period" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>From Date:</label>
                                             <input type="date" class="form-control" id="edit_date_from" name="edit_date_from" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>To Date:</label>
                                             <input type="date" class="form-control" id="edit_date_to" name="edit_date_to" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Salary:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" class="form-control" id="edit_salary" name="edit_salary" step="0.01" required />
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Salary TAX:</label>
                                             <input type="text" class="form-control" id="edit_salary_tax" name="edit_salary_tax" step="0.01" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Family Status:</label>
                                             <select class="form-control" id="edit_family_status" name="edit_family_status">
                                                <?php
                                                $sql = 'SELECT * FROM text_family_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['fs_id'] . '">' . $row['fs_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Children:</label>
                                             <input type="number" class="form-control" id="edit_child" name="edit_child" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Spouse:</label>
                                             <input type="number" class="form-control" id="edit_spouse" name="edit_spouse" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Education Level:</label>
                                             <input type="text" class="form-control" id="edit_edu_level" name="edit_edu_level" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Probation Period:</label>
                                             <input type="text" class="form-control" id="edit_probat_per" name="edit_probat_per" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Probation From:</label>
                                             <input type="date" class="form-control" id="edit_pro_date_from" name="edit_pro_date_from" required />
                                          </div>
                                          <div class="form-group col-xs-4">
                                             <label>Probation To:</label>
                                             <input type="date" class="form-control" id="edit_pro_date_to" name="edit_pro_date_to" required />
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="edit_note" name="edit_note"></textarea>
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
                        <!-- Modal -->
                        <!-- Mod img-fluidal Image-->
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
                                          <input type="hidden" id="er_img_id" name="er_img_id" />
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
                        <!-- Modal Image-->
                        <a href="staff_register.php" style="color:white; margin-bottom: 2%;" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New </a>

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped text-center">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Job ID</th>
                                    <th>Full Name</th>
                                    <th>Gender/Position</th>
                                    <th>Company</th>
                                    <th>Bank</th>
                                    <th>Bank Account</th>
                                    <th>Salary</th>
                                    <th>Photo</th>
                                    <th>Note</th>
                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM employee_registration 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_family_status ON text_family_status.fs_id = employee_registration.er_family_status_id ";
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
                                    $v_acc_name = $row["er_bank_acc_name"];
                                    $v_acc_num = $row["er_bank_acc_num"];
                                    $v_salary = $row["er_salary"];
                                    $v_photo = $row["er_photo"];
                                    $v_note = $row["er_note"];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td style="vertical-align: middle;"><?php echo $v_er_job_id; ?></td>
                                       <td style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en; ?></td>
                                       <td style="vertical-align: middle;"><?php echo "<i>Gender: </i> " . $v_gender_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                       <td style="vertical-align: middle;"><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id; ?></td>
                                       <td style="vertical-align: middle;"><?php echo $v_acc_name; ?></td>
                                       <td style="vertical-align: middle;"><?php echo $v_acc_num; ?></td>
                                       <td style="vertical-align: middle;"><?php echo $v_salary; ?></td>
                                       <td style="vertical-align: middle;"><img class="rounded img-fuild" src="../img/<?php if ($v_photo != '') {
                                                                                                                           echo 'upload/staff_register_img/' . $v_photo;
                                                                                                                        } else {
                                                                                                                           echo 'no_image.jpg';
                                                                                                                        } ?>" style="width:100px; height:100px;" />
                                          <a style="float:right; cursor:pointer;" onclick="doImage(<?php echo $row['er_id']; ?>,
                                                        '<?php echo $v_photo; ?>')" data-toggle="modal" data-target="#myModal_image">
                                             <i style="color:#3c8dbc;" class="fa fa-pencil "></i>
                                          </a>
                                       </td>
                                       <td style="vertical-align: middle;"><?php echo $v_note; ?></td>
                                       <td style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_registration.php?id=<?php echo $row['er_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a href="staff_qrcode.php?empid=<?php echo $row['er_id']; ?>&branchid=<?php echo $row['er_branch_id']; ?>" class="btn btn-success btn-sm"><i style="color:white;" class="fa fa-qrcode"></i></a>
                                          <a onclick="doUpdate(<?php echo $row['er_id']; ?>,
                                                        '<?php echo $row['er_job_id']; ?>',
                                                        '<?php echo $row['er_name_kh']; ?>',
                                                        '<?php echo $row['er_name_en']; ?>',
                                                        '<?php echo $row['er_tel']; ?>',
                                                        '<?php echo $row['er_gender_id']; ?>',
                                                        '<?php echo $row['er_position_id']; ?>',
                                                        '<?php echo $row['er_department_id']; ?>',
                                                        '<?php echo $row['er_branch_id']; ?>',
                                                        '<?php echo $row['er_company_id']; ?>',
                                                        '<?php echo $row['er_address']; ?>',
                                                        '<?php echo $row['er_bank_acc_name']; ?>',
                                                        '<?php echo $row['er_bank_acc_num']; ?>',
                                                        '<?php echo $row['er_contract_period']; ?>',
                                                        '<?php echo $row['er_period_from']; ?>',
                                                        '<?php echo $row['er_period_to']; ?>',
                                                        '<?php echo $row['er_salary']; ?>',
                                                        '<?php echo $row['er_salary_tax']; ?>',
                                                        '<?php echo $row['er_children']; ?>',
                                                        '<?php echo $row['er_spouse']; ?>',
                                                        '<?php echo $row['er_family_status_id']; ?>',
                                                        '<?php echo $row['er_education_level']; ?>',
                                                        '<?php echo $row['er_probation_period']; ?>',
                                                        '<?php echo $row['er_probation_per_from']; ?>',
                                                        '<?php echo $row['er_probation_per_to']; ?>',
                                                        '<?php echo $row['er_note']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_registration.php?del_id=<?php echo $row['er_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
   <!-- daterangepicker -->
   <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


   <script type="text/javascript">
      function doUpdate(id, job_id, namekh, nameen, tel, gender, position,
         department, branch, company, address, bank_name, bank_acc, contract,
         con_from, con_to, salary, salarytax, child, spouse, f_status,
         edu_lvl, probation, pro_from, pro_to, note) {

         $('#er_edit_id').val(id);
         $('#edit_job_id').val(job_id);
         $('#edit_namekh').val(namekh);
         $('#edit_nameen').val(nameen);
         $('#edit_tel').val(tel);
         $('#edit_gender').val(gender).change();
         $('#edit_position').val(position).change();
         $('#edit_company').val(company).change();
         $('#edit_branch').val(branch).change();
         $('#edit_department').val(department).change();
         $('#edit_address').val(address);
         $('#edit_bank_name').val(bank_name);
         $('#edit_bank_num').val(bank_acc);
         $('#edit_con_period').val(contract);
         $('#edit_date_from').val(con_from);
         $('#edit_date_to').val(con_to);
         $('#edit_salary').val(salary);
         $('#edit_salary_tax').val(salarytax);
         $('#edit_family_status').val(f_status).change();
         $('#edit_child').val(child);
         $('#edit_spouse').val(spouse);
         $('#edit_edu_level').val(edu_lvl);
         $('#edit_probat_per').val(probation);
         $('#edit_pro_date_from').val(pro_from);
         $('#edit_pro_date_to').val(pro_to);
         $('#edit_note').val(note);

      }

      function doImage(id, photo) {
         $('#er_img_id').val(id);

         if (photo == '' || photo == 'NULL') {
            document.getElementById('show_photo').setAttribute('src', '../img/no_image.jpg');
         } else {
            document.getElementById('show_photo').setAttribute('src', '../img/upload/staff_register_img/' + photo);
         }
      }

      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_staff_update").addClass("active");
         $("#registration").addClass("active");
         $("#registration").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>