<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST["txt_job_id"];
   $v_ref = $_POST["txt_ref"];
   $v_salary = $_POST["txt_salary"];
   $v_date = $_POST["txt_date"];
   $v_note = $_POST["txt_note"];

   $sql = "INSERT INTO salary_confirmation_letter 
                        ( scl_er_id , scl_ref, scl_date, scl_salary, scl_note, created_at, scl_user_id)
                  VALUES 
                    ('$v_job_id', '$v_ref', '$v_date', '$v_salary', '$v_note','$datetime','$user_id')";
   $result = mysqli_query($connect, $sql);
   header('location:salary_confirm_letter.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["salary_con_id"];
   $v_job_id = $_POST["edit_job_id"];
   $v_ref = $_POST["edit_ref"];
   $v_salary = $_POST["edit_salary"];
   $v_date = $_POST["edit_date"];
   $v_note = $_POST["edit_note"];

   $sql = "UPDATE salary_confirmation_letter SET 
    scl_er_id = '$v_job_id', 
    scl_ref = '$v_ref',
    scl_salary = '$v_salary',
    scl_date = '$v_date', 
    scl_note = '$v_note' WHERE scl_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:salary_confirm_letter.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM salary_confirmation_letter WHERE scl_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: salary_confirm_letter.php?message=delete");
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
               Salary Confirmation Letter
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
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>SCL No:</label>
                                             <input type="text" class="form-control" id="txt_ref" name="txt_ref" required />
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Issue Date:</label>
                                             <input type="date" class="form-control" id="txt_date" name="txt_date" required />
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Basic Salary:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input type="number" class="form-control" id="txt_salary" name="txt_salary" step="0.01" required />
                                             </div>
                                          </div>
                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="txt_note" name="txt_note"></textarea>
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
                                          <input type="hidden" id="salary_con_id" name="salary_con_id" />
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
                                             <label>SCL No:</label>
                                             <input type="text" class="form-control" id="edit_ref" name="edit_ref" required />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Issue Date:</label>
                                             <input type="date" class="form-control" id="edit_date" name="edit_date" required />
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Basic Salary:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input type="number" class="form-control" id="edit_salary" name="edit_salary" step="0.01" required />
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
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
                        <!-- Modal Update-->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>SCL No</th>
                                    <th>Job ID</th>
                                    <th>Full Name</th>
                                    <th>Gender/Position</th>
                                    <th>Company</th>
                                    <th>Date</th>
                                    <th>Basic Salary</th>
                                    <th>Note</th>
                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM salary_confirmation_letter 
                                                                  LEFT JOIN employee_registration ON employee_registration.er_id = salary_confirmation_letter.scl_er_id 
                                                                  LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                  LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                  LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                  LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                  LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                  LEFT JOIN user ON user.id = salary_confirmation_letter.scl_user_id";
                                    $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_ref = $row["scl_ref"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_date = $row["scl_date"];
                                    $v_salary = $row["scl_salary"];
                                    $v_note = $row["scl_note"];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td><?php echo $v_ref; ?></td>
                                       <td><?php echo $v_er_job_id; ?></td>
                                       <td><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en; ?></td>
                                       <td><?php echo "<i>Gender: </i> " . $v_gender_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                       <td><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id; ?></td>
                                       <td><?php echo $v_date; ?></td>
                                       <td><?php echo $v_salary; ?></td>
                                       <td><?php echo $v_note; ?></td>
                                       <td>
                                          <a target="_blank" href="./recommendation_letter.php?data=<?=$row['scl_id'];?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a>
                                          <a onclick="doUpdate(<?php echo $row['scl_id']; ?>,
                                                        '<?php echo $row['scl_ref']; ?>',
                                                        '<?php echo $row['er_id']; ?>',
                                                        '<?php echo $row['scl_date']; ?>',
                                                        '<?php echo $row['scl_salary']; ?>',
                                                        '<?php echo $row['scl_note']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="salary_confirm_letter.php?del_id=<?php echo $row['scl_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, ref, er_id, date, salary, note) {

         $('#salary_con_id').val(id);
         $('#edit_ref').val(ref);
         $('#edit_job_id').val(er_id).change();
         $('#edit_date').val(date);
         $('#edit_salary').val(salary);
         $('#edit_note').val(note);
      }

      $('#txt_job_id').change(function() {
         $('.show_hid').css("visibility", "visible");
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_staff_update").addClass("active");
         $("#salary_con").addClass("active");
         $("#salary_con").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>