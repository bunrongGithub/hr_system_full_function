<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_noted = $_POST['txt_noted'];
   $v_com = $_POST['txt_com'];
   $v_desc = $_POST['txt_desc'];
   $v_status = $_POST['txt_status'];
   $v_total_working = $_POST['txt_total_working'];
   $v_mistake = $_POST['txt_mistake'];
   $v_warning_date = $_POST['warning_date'];
   $v_warning_no = $_POST['warning_no'];
   $v_job_id = $_POST['txt_job_id'];

   $sql = "INSERT INTO warning (wa_noted
                              ,wa_comment
                              ,wa_finding_description
                              ,wa_status_id
                              ,wa_total_warning
                              ,wa_mistake_id
                              ,wa_warning_date
                              ,wa_no,wa_job_id,created_at) VALUES ('$v_noted','$v_com','$v_desc','$v_status','$v_total_working','$v_mistake','$v_warning_date','$v_warning_no','$v_job_id','$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:staff_warning.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["staff_warning_id"];

   $v_job_id = $_POST["edit_job_id"];

   $v_edit_no = $_POST['edit_no'];

   $v_edit_date = $_POST['edit_date'];

   $v_edit_total_working = $_POST['edit_total_working'];

   $v_edit_mistake = $_POST['edit_mistake'];

   $v_edit_status = $_POST['edit_status'];

   $v_edit_desc = $_POST['edit_desc'];

   $v_edit_com = $_POST['edit_com'];
   $v_edit_noted = $_POST['edit_noted'];

   $sql = "UPDATE warning SET wa_job_id = '$v_job_id',
                              wa_no = '$v_edit_no',
                              wa_warning_date = '$v_edit_date',
                              wa_total_warning = '$v_edit_total_working',
                              wa_mistake_id = '$v_edit_mistake',
                              wa_status_id = '$v_edit_status',
                              wa_finding_description = '$v_edit_desc',
                              wa_comment = '$v_edit_com',
                              wa_noted = '$v_edit_noted',
                              updated_at = '$datetime' where wa_id = '$id'
                              ";
   $result = mysqli_query($connect, $sql);
   header('location:staff_warning.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM warning WHERE wa_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: staff_warning.php?message=delete");
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
               Warning
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
                                                   <div class="show_hid col-md-12" style="display: none;">
                                                      <label for="warning_no">Warning No:</label>
                                                      <input class="form-control" type="text" name="warning_no" id="warning_no" required>
                                                   </div>
                                                   <div id="amount_data"></div>
                                                </div>
                                                <div class="col-md-8">
                                                   <div class="show_hid form-group col-md-6" style="display: none;">
                                                      <label for="warning_date">Warning Date:</label>
                                                      <input class="form-control" type="date" name="warning_date" id="warning_date">
                                                   </div>
                                                   <div class="show_hid form-group col-xs-6" style="display: none;">
                                                      <label>Mistake:</label>
                                                      <select class="form-control" id="txt_mistake" name="txt_mistake" required>
                                                         <?php
                                                         $sql = 'SELECT * FROM text_warning_mistake';
                                                         $result = mysqli_query($connect, $sql);
                                                         while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row['twm_id'] . '" >' . $row['twm_name'] . '</option>';
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-md-12">
                                                      <div class="show_hid form-group col-md-6" style="display: none;">
                                                         <label>Total Warning Unit Now:</label>
                                                         <input class="form-control" id="txt_total_working" name="txt_total_working" type="number" required>
                                                      </div>
                                                      <div class="show_hid form-group col-xs-6" style="display: none;">
                                                         <label>Status:</label>
                                                         <select class="form-control" id="txt_status" name="txt_status" required>
                                                            <?php
                                                            $sql = 'SELECT * FROM text_warning_status';
                                                            $result = mysqli_query($connect, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                               echo '<option value="' . $row['tws_id'] . '"> ' . $row['tws_name'] . '</option>';
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label>Description:</label>
                                                      <textarea class="form-control" rows="2" id="txt_desc" name="txt_desc"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="txt_com" >Comment:</label>
                                                      <textarea class="form-control" rows="2" id="txt_com" name="txt_com"></textarea>
                                                   </div>
                                                   <div class="show_hid form-group col-md-12" style="display: none;">
                                                      <label for="txt_noted" >Noted:</label>
                                                      <textarea class="form-control" rows="2" id="txt_noted" name="txt_noted"></textarea>
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
                                          <input type="hidden" id="staff_warning_id" name="staff_warning_id" />
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
                                             <label>Warning No:</label>
                                             <input class="form-control" id="edit_no" name="edit_no" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Warning Date:</label>
                                             <input class="form-control" id="edit_date" name="edit_date" type="date" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Total Warning Unit Now:</label>
                                             <input class="form-control" id="edit_total_working" name="edit_total_working" type="number" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Mistake:</label>
                                             <select class="form-control" id="edit_mistake" name="edit_mistake" required>
                                                <?php
                                                $sql = 'SELECT * FROM text_warning_mistake';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['twm_id'] . '" >' . $row['twm_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
                                             <select class="form-control" id="edit_status" name="edit_status" required>
                                                <?php
                                                $sql = 'SELECT * FROM text_warning_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tws_id'] . '"> ' . $row['tws_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Descrpition:</label>
                                             <input class="form-control" id="edit_desc" name="edit_desc" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Comment:</label>
                                             <input class="form-control" id="edit_com" name="edit_com" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Noted:</label>
                                             <input class="form-control" id="edit_noted" name="edit_noted" type="text" required>
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
                                    <th class="text-center">Warning No</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Full Name/Gender</th>
                                    <th class="text-center">Employee Information</th>
                                    <th class="text-center">Total Warning</th>
                                    <th class="text-center">Warning Date</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Mistake</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM warning 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = warning.wa_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_warning_mistake ON text_warning_mistake.twm_id = warning.wa_mistake_id 
                                                                LEFT JOIN text_warning_status ON text_warning_status.tws_id = warning.wa_status_id";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_date = $row["wa_warning_date"];
                                    $v_er_job_id = $row["er_job_id"];
                                    $v_er_name_kh = $row["er_name_kh"];
                                    $v_er_name_en = $row["er_name_en"];
                                    $v_gender_id = $row["ge_name"];
                                    $v_position_id = $row["position"];
                                    $v_company_id = $row["c_name_kh"];
                                    $v_department_id = $row["de_name"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_t_working = $row["wa_total_warning"];
                                    $v_status_id = $row["tws_name"];
                                    $v_desc = $row["wa_finding_description"];
                                    $v_no = $row['wa_no'];
                                    $v_comment = $row['wa_comment'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_no?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_er_job_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en . "<br/><i>Gender: </i> " . $v_gender_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo "<i>Company: </i>" . $v_company_id . "<br/><i>Branch: </i>" . $v_branch_id . "<br/><i>Department: </i>" . $v_department_id . "<br/><i>Position: </i>" . $v_position_id ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_t_working; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_desc; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $row['twm_name']; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php echo $v_status_id; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <!-- <a href="edit_staff_warning.php?id=<?php echo $row['wa_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(<?php echo $row['wa_id']; ?>,
                                                        '<?php echo $row['er_id']; ?>',
                                                        '<?php echo $v_no; ?>',
                                                        '<?php echo $v_date; ?>',
                                                        '<?php echo $v_t_working; ?>',
                                                        '<?php echo $row['wa_mistake_id']; ?>',
                                                        '<?php echo $row['wa_status_id']; ?>',
                                                        '<?php echo $v_desc; ?>',
                                                        '<?php echo $v_comment?>',
                                                        '<?php echo $row['wa_noted']?>'
                                                        )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a style="color: white;" class="btn btn-sm btn-info" href="staff_warning_print.php?id=<?php echo $row['wa_id']?>"><i class="fa fa-eye" ></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="staff_warning.php?del_id=<?php echo $row['wa_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, er_id,v_no, date, t_working, mistake, status, desc,comment,note) {

         $('#staff_warning_id').val(id);
         $('#edit_job_id').val(er_id).change();
         $('#edit_no').val(v_no);
         $('#edit_date').val(date);
         $('#edit_total_working').val(t_working);
         $('#edit_mistake').val(mistake).change();
         $('#edit_status').val(status).change();
         $('#edit_desc').val(desc);
         $('#edit_com').val(comment);
         $('#edit_noted').val(note);
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
         $("#warning").addClass("active");
         $("#warning").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>