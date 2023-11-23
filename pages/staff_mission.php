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
   $v_applied_date = $_POST['applied_date'];
   $v_direction = $_POST['direction'];
   $v_date_from = $_POST['date_from'];
   $v_date_to = $_POST['date_to'];
   $v_period = $_POST['period'];
   $v_transportation = $_POST['transportation'];
   $v_status = $_POST['status'];
   $v_company_vehicle = $_POST['company_vehicle'];
   $v_objective = $_POST['objective'];
   $v_noted = $_POST['noted'];
   $v_comment = $_POST['comment'];
   $sql = "INSERT INTO mission (mi_misson_no
                              ,mi_job_id
                              ,mi_date_applied
                              ,mi_mission_direction
                              ,mi_date_from
                              ,mi_date_to
                              ,mi_period
                              ,mi_transportation
                              ,mi_status_id
                              ,mi_company_vihicle_no
                              ,mi_objective
                              ,mi_note
                              ,mi_comment,created_at) VALUES('$v_ref_no'
                                                      ,'$v_job_id'
                                                      ,'$v_applied_date'
                                                      ,'$v_direction'
                                                      ,'$v_date_from'
                                                      ,'$v_date_to'
                                                      ,'$v_period'
                                                      ,'$v_transportation'
                                                      ,'$v_status'
                                                      ,'$v_company_vehicle'
                                                      ,'$v_objective'
                                                      ,'$v_noted'
                                                      ,'$v_comment','$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_mission.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_mission_id"];
   $v_ref_no = $_POST["edit_ref"];
   $v_job_id = $_POST["edit_job_id"];

   $v_edit_applied_date = $_POST['edit_applied_date'];

   $v_edit_direction = $_POST['edit_direction'];

   $v_edit_date_from = $_POST['edit_date_from'];

   $v_edit_date_to = $_POST['edit_date_to'];

   $v_edit_period = $_POST['edit_period'];

   $v_edit_transportation = $_POST['edit_transportation'];

   $v_edit_status = $_POST['edit_status'];

   $v_edit_company_vehicle = $_POST['edit_company_vehicle'];

   $v_edit_objective = $_POST['edit_objective'];

   $v_edit_noted = $_POST['edit_noted'];

   $v_edit_comment = $_POST['edit_comment'];

   $sql = "UPDATE mission SET 
                           mi_misson_no = '$v_ref_no',
                           mi_job_id = '$v_job_id',
                           mi_date_applied = '$v_edit_applied_date',
                           mi_mission_direction = '$v_edit_direction',
                           mi_date_from = '$v_edit_date_from',
                           mi_date_to = '$v_edit_date_to',
                           mi_period = '$v_edit_period',
                           mi_transportation = '$v_edit_transportation',
                           mi_status_id = '$v_edit_status',
                           mi_company_vihicle_no = '$v_edit_company_vehicle',
                           mi_objective = '$v_edit_objective',
                           mi_note = '$v_edit_noted',
                           mi_comment = '$v_edit_comment',
                           updated_at = '$datetime'   WHERE mi_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:staff_mission.php?message=update');
   exit();
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM mission WHERE mi_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_mission.php?message=delete");
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
               Mission
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
                                             <div class="col-md-4">
                                                <div class=" show_hid col-md-12" style="display: none;">
                                                   <label>Mission Nº:</label>
                                                   <input class="form-control" id="txt_ref" name="txt_ref" type="text" required>
                                                </div>
                                                <div id="amount_data"></div>
                                             </div>
                                             <div class="col-md-8">
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="applied_date">Applied Date:</label>
                                                   <input class="form-control" type="date" name="applied_date" id="applied_date">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="direction">Direction:</label>
                                                   <input class="form-control" type="text" name="direction" id="direction">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="date_from">Date From:</label>
                                                   <input class="form-control" type="date" name="date_from" id="date_from">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="date_to">Date To:</label>
                                                   <input class="form-control" type="date" name="date_to" id="date_to">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="period">Period:</label>
                                                   <input class="form-control" type="number" name="period" id="period">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="transportation">Transportation:</label>
                                                   <input class="form-control" type="text" name="transportation" id="transportation">
                                                </div>
                                                <div class="show_hid form-group col-md-6" style="display: none;">
                                                   <label for="status">Mission Status:</label>
                                                   <select class="form-control" name="status" id="status" data-live-search="true">
                                                      <option selected value=""></option>
                                                      <?php
                                                      $sql = "SELECT * FROM text_mission_status";
                                                      $result = $connect->query($sql);
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                         echo "<option value='" . $row['tms_id'] . "' >" . $row['tms_name'] . "</option>";
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="display: none;">
                                                   <label for="company_vehicle">Company Vehicle Plate Nº:</label>
                                                   <input class="form-control" type="text" name="company_vehicle" id="company_vehicle">
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="display: none;">
                                                   <label for="objective">Objective:</label>
                                                   <input class="form-control" type="text" name="objective" id="objective">
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="display: none;">
                                                   <label for="noted">Noted:</label>
                                                   <input class="form-control" type="text" name="noted" id="noted">
                                                </div>
                                                <div class="show_hid form-group col-md-12" style="display: none;">
                                                   <label for="comment">Mission Comment:</label>
                                                   <input class="form-control" type="text" name="comment" id="comment">
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
                                          <input type="hidden" id="staff_mission_id" name="staff_mission_id" />
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
                                             <label>Mission Nº:</label>
                                             <input class="form-control" id="edit_ref" name="edit_ref" type="text">
                                          </div>

                                          <div class="form-group col-xs-6">
                                             <label>Applied Date:</label>
                                             <input class="form-control" id="edit_applied_date" name="edit_applied_date" type="date">
                                          </div>

                                          <div class="form-group col-xs-6">
                                             <label>Mission Direction:</label>
                                             <input class="form-control" id="edit_direction" name="edit_direction" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Date From:</label>
                                             <input class="form-control" id="edit_date_from" name="edit_date_from" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Date To:</label>
                                             <input class="form-control" id="edit_date_to" name="edit_date_to" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Period:</label>
                                             <input class="form-control" id="edit_period" name="edit_period" type="number">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Mission Transportation:</label>
                                             <input class="form-control" id="edit_transportation" name="edit_transportation" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Mission Status:</label>
                                             <select name="edit_status" id="edit_status" data-live-search="true">
                                                <option selected value=""></option>
                                                <?php
                                                $sql = "SELECT * FROM text_mission_status";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tms_id'] . '" >' . $row['tms_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="edit_company_vehicle">Company Vehicle Plate Nº:</label>
                                             <input class="form-control" type="text" name="edit_company_vehicle" id="edit_company_vehicle">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="edit_objective">Objective:</label>
                                             <input class="form-control" type="text" name="edit_objective" id="edit_objective">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="edit_noted">Noted:</label>
                                             <input class="form-control" type="text" name="edit_noted" id="edit_noted">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="edit_comment">Mission Comment:</label>
                                             <input class="form-control" type="text" name="edit_comment" id="edit_comment">
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
                                    <th class="text-center">Mission Nº</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Employee Information</th>
                                    <th class="text-center">Mission Information</th>
                                    <th class="text-center">Transportation</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM mission 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = mission.mi_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_mission_status ON text_mission_status.tms_id = mission.mi_status_id";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_ref_no = $row["mi_misson_no"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_mission_dir = $row["mi_mission_direction"];
                                    $v_note = $row["mi_note"];
                                    $v_status_id = $row["tms_name"];
                                    $v_date_from = $row['mi_date_from'];
                                    $v_date_to = $row['mi_date_to'];
                                    $v_objective = $row['mi_objective'];
                                    $v_transportation = $row['mi_transportation'];
                                    $v_applied_date = $row['mi_date_applied'];
                                    $v_period = $row['mi_period'];
                                    $v_company_vihicle_no = $row['mi_company_vihicle_no'];
                                    $v_comment = $row['mi_comment'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_ref_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_job_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender: </i> " . $v_gender_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Company: </i> " . $v_company_id . "<br/><i>Branch: </i>" . $v_branch_id . "<br/><i>Department: </i>" . $v_department_id . "<br/><i>Position: </i> " . $v_position_id ?></td>
                                       <!-- mission_info -->
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "Date From: " . $v_date_from . "<br/>To: " . $v_date_to . "<br/>Objective: " . $v_objective . "<br/>Direcion: " . $v_mission_dir; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_transportation ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_note; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_mission.php?id=<?php echo $row['jh_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(
                                                         '<?php echo $row['mi_id']; ?>',
                                                         '<?php echo $row['mi_job_id']; ?>',
                                                         '<?php echo $v_ref_no ?>',
                                                         '<?php echo $v_applied_date ?>',
                                                         '<?php echo $v_mission_dir ?>',
                                                         '<?php echo $v_date_from ?>',
                                                         '<?php echo $v_date_to ?>',
                                                         '<?php echo $v_period ?>',
                                                         '<?php echo $v_transportation ?>',
                                                         '<?php echo $row['mi_status_id'] ?>',
                                                         '<?php echo $v_company_vihicle_no?>',
                                                         '<?php echo $v_objective?>',
                                                         '<?php echo $v_note?>',
                                                         '<?php echo $v_comment?>'
                                                         )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                         <a style="color: white;" class="btn btn-sm btn-info" href="staff_mission_print.php?id=<?php echo $row['mi_id'];?>"><i class="fa fa-eye"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_mission.php?del_id=<?php echo $row['mi_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, job_id, mission_no, applied_date, mis_direction, date_from, date_to, period, transport, status,company_plate_no,objective,note,cm) {
         $('#staff_mission_id').val(id);
         $('#edit_job_id').val(job_id).change();
         $('#edit_ref').val(mission_no)
         $('#edit_applied_date').val(applied_date)
         $('#edit_direction').val(mis_direction)
         $('#edit_date_from').val(date_from)
         $('#edit_date_to').val(date_to)
         $('#edit_period').val(period)
         $('#edit_transportation').val(transport)
         $('#edit_status').val(status).change();
         $('#edit_company_vehicle').val(company_plate_no)
         $('#edit_objective').val(objective);
         $('#edit_noted').val(note);
         $('#edit_comment').val(cm);
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
         $("#mission").addClass("active");
         $("#mission").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>