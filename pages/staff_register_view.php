<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

$id = $_GET['id'];
$sql_reg = "SELECT * FROM employee_registration
        LEFT JOIN company on company.c_id=employee_registration.er_company_id
        LEFT JOIN position on position.position_id=employee_registration.er_position_id
        LEFT JOIN user_branch on user_branch.ub_id=employee_registration.er_branch_id
        LEFT JOIN text_family_status on text_family_status.fs_id=employee_registration.er_family_status_id
        LEFT JOIN gender on gender.ge_id=employee_registration.er_gender_id
        LEFT JOIN department on department.de_id=employee_registration.er_department_id
        WHERE er_id='$id'
        ";
$result_reg = $connect->query($sql_reg);
$row_reg = $result_reg->fetch_assoc();

$show_photo = $row_reg['er_photo'];


if (isset($_GET['del_id'])) {
   $del_id = $_GET['del_id'];
   $id = $_GET['id'];
   $sql = "DELETE FROM benefit_info where bi_id = '$del_id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_register_view.php?id=$id");
}

if (isset($_POST["btnadd"])) {
   $id = $_GET['id'];
   $v_benefit_type = $_POST["txt_benefit_type"];
   $v_amount = $_POST["txt_amount"];

   $sql = "INSERT INTO benefit_info 
                        (
                            bi_register_id,
                            bi_benefit_type_id,
                            bi_amount
                        )
                    VALUES
                        (
                            '$id',
                            '$v_benefit_type',
                            '$v_amount'
                        )
                        ";
   $result = mysqli_query($connect, $sql);
   header("location: staff_register_view.php?id=$id");
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_GET['id'];
   $edit_reg_view_id = $_POST["register_view_id"];
   $edit_benefit_type = $_POST["edit_benefit_type"];
   $edit_amount = $_POST["edit_amount"];

   $sql = "UPDATE benefit_info SET
                        bi_benefit_type_id = '$edit_benefit_type',
                        bi_amount = '$edit_amount'
                        WHERE bi_id = $edit_reg_view_id";
   $result = mysqli_query($connect, $sql);
   header("location:staff_register_view.php?id=$id");
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
            <h1 class="text-primary"> Staff Register View<h1>
         </section>
         <section class="content">
            <!-- top row -->
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <!-- /.box-header -->
                     <div class="box-body">
                        <form method="post" enctype="multipart/form-data" action="">
                           <div class="row col-xs-12">
                              <div class="row col-xs-3">
                                 <div class="form-group col-xs-12">
                                    <label>Job ID:</label>
                                    <input type="text" class="form-control" name="txt_job_id" readonly value="<?php echo $row_reg['er_job_id']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>TEL:</label>
                                    <input type="text" class="form-control" name="txt_tel" readonly value="<?php echo $row_reg['er_tel']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Company:</label>
                                    <input class="form-control" type="text" name="txt_company" id="" readonly value="<?php echo $row_reg['c_name_kh']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Position:</label>
                                    <input class="form-control" type="text" name="txt_position" id="" readonly value="<?php echo $row_reg['position']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>From Date:</label>
                                    <input type="date" class="form-control" id="txt_date_from" name="txt_date_from" readonly value="<?php echo $row_reg['er_period_from']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Salary:</label>
                                    <div class="input-group ">
                                       <div class="input-group-addon">$</div>
                                       <input type="text" class="form-control" id="txt_salary" name="txt_salary" step="0.01" readonly value="<?php echo $row_reg['er_salary']; ?>" />
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Children:</label>
                                    <input type="number" class="form-control" id="txt_child" name="txt_child" readonly value="<?php echo $row_reg['er_children']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Probation Period:</label>
                                    <input type="text" class="form-control" id="txt_probat_per" name="txt_probat_per" readonly value="<?php echo $row_reg['er_probation_period']; ?>" />
                                 </div>
                              </div>
                              <div class="row col-xs-3">
                                 <div class="form-group col-xs-12">
                                    <label>Name KH:</label>
                                    <input type="text" class="form-control" id="txt_namekh" name="txt_namekh" readonly value="<?php echo $row_reg['er_name_kh']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Address:</label>
                                    <input type="text" class="form-control" id="txt_address" name="txt_address" readonly value="<?php echo $row_reg['er_address']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Branch:</label>
                                    <input class="form-control" type="text" name="txt_branch" readonly value="<?php echo $row_reg['ub_name']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Family Status:</label>
                                    <input class="form-control" type="text" name="txt_family" readonly value="<?php echo $row_reg['fs_name']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>To Date:</label>
                                    <input type="date" class="form-control" id="txt_date_to" name="txt_date_to" readonly value="<?php echo $row_reg['er_period_to']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Salary TAX:</label>
                                    <input type="text" class="form-control" id="txt_salary_tax" name="txt_salary_tax" step="0.01" readonly value="<?php echo $row_reg['er_salary_tax']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Spouse:</label>
                                    <input type="number" class="form-control" id="txt_spouse" name="txt_spouse" readonly value="<?php echo $row_reg['er_spouse']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Probation From:</label>
                                    <input type="date" class="form-control" id="txt_pro_date_from" name="txt_pro_date_from" readonly value="<?php echo $row_reg['er_probation_per_from']; ?>" />
                                 </div>
                              </div>
                              <div class="row col-xs-3">
                                 <div class="form-group col-xs-12">
                                    <label>Name EN:</label>
                                    <input type="text" class="form-control" id="txt_nameen" name="txt_nameen" readonly value="<?php echo $row_reg['er_name_en']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Gender:</label>
                                    <input class="form-control" type="text" name="txt_gender" readonly value="<?php echo $row_reg['ge_name']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Department:</label>
                                    <input class="form-control" type="text" name="txt_department" readonly value="<?php echo $row_reg['de_name']; ?>">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Contract Period:</label>
                                    <input type="text" class="form-control" id="txt_con_period" name="txt_con_period" readonly value="<?php echo $row_reg['er_contract_period']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Bank Name:</label>
                                    <input type="text" class="form-control" id="txt_bank_name" name="txt_bank_name" readonly value="<?php echo $row_reg['er_bank_acc_name']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Bank Number:</label>
                                    <input type="number" class="form-control" id="txt_bank_num" name="txt_bank_num" readonly value="<?php echo $row_reg['er_bank_acc_num']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Education Level:</label>
                                    <input type="text" class="form-control" id="txt_edu_level" name="txt_edu_level" readonly value="<?php echo $row_reg['er_education_level']; ?>" />
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Probation To:</label>
                                    <input type="date" class="form-control" id="txt_pro_date_to" name="txt_pro_date_to" readonly value="<?php echo $row_reg['er_period_to']; ?>" />
                                 </div>
                              </div>
                              <div class="row col-xs-3">
                                 <div class="form-group col-xs-12">
                                    <label>Photo:</label><br />
                                    <img id="show_photo" class="rounded img-thumbnail img-fuild" src="<?php echo 'upload/staff_register_view_img/' . $show_photo; ?>" height="280px">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label>Note:</label>
                                    <input class="form-control" name="txt_note" readonly value="<?php echo $row_reg['er_note']; ?>"></input>
                                 </div>
                              </div>
                           </div><!-- /.row -->
                        </form>
                     </div><!-- /.box-body -->
                  </div><!-- /.box -->
               </div><!-- /.col -->
            </div>
            <div class="content">
               <div class="col-xs-12 connectedSortable">
                  <a href="staff_registration.php" class="btn btn-danger btn-sm">
                     <i style="color:white;" class="fa fa-undo"></i> Back
                  </a>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                     Add New
                  </button>
                  <!-- Modal add new -->
                  <div class="modal fade" id="myModal" role="dialog">
                     <div class="modal-dialog" style="width: 450px;">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New </h4>
                           </div>
                           <form method="post" enctype="multipart/form-data" action="">
                              <div class="modal-body">
                                 <div class="col-md-12">
                                    <div class="form-group col-xs-12">
                                       <label>Benefit Type:</label>
                                       <select class="form-control" name="txt_benefit_type">
                                          <option value="">Select benefit type</option>
                                          <?php
                                          $sql = 'SELECT * FROM set_benefit';
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['sb_id'] . '">' . $row['sb_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-12">
                                       <label>Amount:</label>
                                       <input type="text" class="form-control" name="txt_amount" />
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- end Modal add new -->
                  <!-- modal edit -->
                  <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document" style="width: 450px;">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                           </div>
                           <div class="modal-body">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <input class="hidden" type="text" name="register_view_id" id="register_view_id">
                                    <div class="form-group col-xs-12">
                                       <label>Benefit Type:</label>
                                       <select class="form-control" name="edit_benefit_type" id="edit_benefit_type">
                                          <option value="">Select benefit type</option>
                                          <?php
                                          $sql = 'SELECT * FROM set_benefit';
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value="' . $row['sb_id'] . '">' . $row['sb_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-12">
                                       <label>Amount:</label>
                                       <input type="text" class="form-control" name="edit_amount" id="edit_amount" />
                                    </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                 <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end edit -->
                  <div class="box border">
                     <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Benefit Type</th>
                              <th>Amount</th>
                              <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $id = $_GET['id'];
                           $sql = "SELECT * FROM benefit_info
                                            LEFT JOIN set_benefit on set_benefit.sb_id=benefit_info.bi_benefit_type_id
                                            WHERE bi_register_id=$id
                                            ";
                           $result = $connect->query($sql);
                           $i = 1;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_name = $row["sb_name"];
                              $v_amount = $row["bi_amount"];
                           ?>
                              <tr>
                                 <td><?php echo $v_i; ?></td>
                                 <td><?php echo $v_name; ?></td>
                                 <td><?php echo $v_amount; ?></td>
                                 <td>
                                    <!--insert-->
                                    <a onclick="doUpdate(
                                                                    '<?php echo $row['bi_id']; ?>',
                                                                    '<?php echo $row['bi_benefit_type_id']; ?>',
                                                                    '<?php echo $row['bi_amount']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="staff_register_view.php?del_id=<?php echo $row['bi_id']; ?>&id=<?php echo $row['bi_register_id']; ?>" class="btn btn-danger btn-sm">
                                       <i style="color:white;" class="fa fa-trash"></i>
                                    </a>
                                 </td>
                              </tr>
                           <?php
                           }
                           ?>
                        </tbody>

                     </table>

                  </div>

               </div>

            </div>

         </section>


      </aside>

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

      <!-- page script -->
      <script type="text/javascript">
         function doUpdate(id, benefit_type, amount) {
            $('#register_view_id').val(id);
            $('#edit_benefit_type').val(benefit_type).change();
            $('#edit_amount').val(amount);
         }
         $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
               "bPaginate": true,
               "bLengthChange": false,
               "bFilter": false,
               "bSort": true,
               "bInfo": true,
               "bAutoWidth": false
            });
         });
         $(function() {
            $("select").selectpicker();
            $("#menu_task_manager").addClass("active");
            $("#company_task").addClass("active");
            $("#company_task").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });

         function loadFile(e) {
            var output = document.getElementById('preview');
            output.width = 100;
            output.src = URL.createObjectURL(e.target.files[0]);
         }
      </script>

</body>

</html>