<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];


if(isset($_POST["btnadd"])){
   $v_task_no = $_POST["txt_task_no"];
   $v_description = $_POST["txt_description"];
   $v_date_from = $_POST["txt_date_from"];
   $v_date_to = $_POST["txt_date_to"];
   $v_leader_user = $_POST["txt_leader_user"];
   $v_assign_to_user = $_POST["txt_assign_to_user"];
   $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO company_task 
                       (ct_task_no
                       , ct_description
                       , ct_date_from
                       , ct_date_to
                       , ct_leader_user_id
                       , ct_assign_user_id
                       , ct_note
                       , created_at
                       ) 
                 VALUES 
                   ('$v_task_no'
                   , '$v_description'
                   , '$v_date_from'
                   , '$v_date_to'
                   , '$v_leader_user'
                   , '$v_assign_to_user'
                   , '$v_note'
                   , '$datetime'
                   )";
    $result = mysqli_query($connect, $sql);
    header('location: company_task.php?message=success');
}
if(isset($_POST['update_answer'])){
   $v_id = $_POST['id_answer'];
   $v_status = $_POST['txt_status_update'];
   $sql = "UPDATE company_task SET ct_status_id = '$v_status' WHERE ct_id = '$v_id'";
   if(mysqli_query($connect,$sql)){
      echo "Updating succeefully.";
   }else{
      throw new mysqli_sql_exception(mysqli_errno($connect));
   }
if(mysqli_query($connect,$sql)){
   echo "Updating succeefully.";
}else{
   throw new mysqli_sql_exception(mysqli_errno($connect));
}
header("location: company_task.php?message=update");
}
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
   <?php include "title_icon.php"; ?>
   <meta content='width=device-width,
            initial-scale=1,
            maximum-scale=1,
            user-scalable=no' name='viewport'>
   <!--bootstrap 3.0.2-->
   <link rel="stylesheet" href="../css/bootstrap.min.css" type='text/css' />
   <!-- font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</head>

<body class='skin-black'>
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--Include left menu-->
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1 class="text-primary">Department Task</h1>
            <button  data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary btn-sm"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
         </section>
         <section>
            <div class="row">
               <!-- Modal Add New -->
               <div class="modal fade" id="exampleModal" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                        </div>
                        <div class="modal-body">
                           <form method="post" enctype="multipart/form-data" action="">
                              <div class="col-md-12">
                                 <div class="form-group col-xs-6">
                                    <label for="">Task_No:</label>
                                    <input class="form-control" name="txt_task_no" type="text">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Description:</label>
                                    <input class="form-control" name="txt_description" type="text">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Date_From:</label>
                                    <input class="form-control" name="txt_date_from" type="date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Date_To:</label>
                                    <input class="form-control" name="txt_date_to" type="date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Leader_User:</label>
                                    <select class="form-control select2" style="width: 100%;" name="txt_leader_user">
                                       <option value="">==== Select ====</option>
                                       <?php
                                       $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                       while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                          <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Assign_To_User:</label>
                                    <select class="form-control select2" style="width: 100%;" name="txt_assign_to_user">
                                       <option value="">==== Select ====</option>
                                       <?php
                                       $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY id");
                                       while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                          <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="note">Note:</label>
                                    <textarea class="form-control" rows="2" name="txt_note"></textarea>
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

               <!--End Modal Add New -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="table_department" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Task_No</th>
                                 <th>Desscription</th>
                                 <th>Date</th>
                                 <th>Status</th>
                                 <th>Leader_User</th>
                                 <th>Assign_To_User</th>
                                 <th>Company</th>
                                 <th>Note</th>
                                 <th  style="width:110px; text-align:center;"><i class="fa fa-cog" aria-hidden="true"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM company_task A
                                    LEFT JOIN text_company_task_status B ON B.cts_id = A.ct_status_id
                                    LEFT JOIN user C ON C.id=A.ct_leader_user_id
                                    LEFT JOIN company D ON D.c_id=A.ct_company_id 
                                    LEFT JOIN user_branch E ON E.ub_id=A.ct_branch_id 
                                    LEFT JOIN department F ON F.de_id=A.ct_department_id";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_task_no = $row['ct_task_no'];
                                 $v_descrioption = $row['ct_description'];
                                 $v_date_from = $row['ct_date_from'];
                                 $v_date_to = $row['ct_date_to'];
                                 $v_status_id = $row['cts_name'];
                                 $v_perinchar_user_id = $row['username'];
                                 $v_assign_user_id = $row['ct_assign_user_id'];
                                 $v_note = $row['ct_note'];
                                 $v_created_at = $row['created_at'];
                                 $v_company_id = $row["c_name_kh"];
                                 $v_branch_id = $row["ub_name"];
                                 $v_department_id = $row["de_name"];
                              ?>
                                 <tr>
                                    <td><?php echo $v_i; ?></td>
                                    <td><?php echo $v_task_no; ?></td>
                                    <td><?php echo $v_descrioption; ?></td>
                                    <td>
                                       From: <?php echo $v_date_from; ?>
                                       <br> To: <?php echo $v_date_to; ?>
                                    </td>
                                    <td class="text-center">
                                       <?php echo $v_status_id; ?><br>
                                       <a onclick="doUpdate(<?php echo $row['ct_id']; ?>)" data-toggle="modal" data-target="#editanswer<?= $row['ct_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> Answer</a>
                                    </td>
                                    <td><?php echo $v_perinchar_user_id; ?></td>
                                    <td>
                                       <?php
                                       $v_assign_user_id = @$row['ct_assign_user_id'];
                                       $sql_user = "SELECT * FROM user WHERE id = $v_assign_user_id";
                                       $result_user = $connect->query($sql_user);
                                       $row_user = $result_user->fetch_assoc();
                                       $v_assign_user_show = @$row_user['username'];
                                       echo @$v_assign_user_show;
                                       ?>
                                    </td>
                                    <td>
                                       <i> Company:</i> <?php echo $v_company_id; ?>
                                       <br> <i>Branch:</i> <?php echo $v_branch_id; ?>
                                       <br> <i>Department:</i> <?php echo $v_department_id; ?>
                                    </td>
                                    <td><?php echo $v_note; ?></td>
                                    <td></td>
                                 </tr>
                                  <!--start edit Answer-->
                                 <!-- Button trigger modal -->

                                 <!-- Modal -->
                                 <div class="modal fade" id="editanswer<?= $row['ct_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>Update Answer</h2>
                                          </div>
                                          <div class="modal-body">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <form method="post" enctype="multipart/form-data" action="">
                                                      <input type="hidden" name="id_answer" value="<?php echo $row['ct_id']; ?>">
                                                      <div class="form-group col-xs-12">
                                                         <label for="">Status:</label>
                                                         <select class="form-control select2" style="width: 100%;" name="txt_status_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_company_task_status ORDER BY cts_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row["ct_status_id"] == $row_se["cts_id"]) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['cts_id']; ?>"><?php echo $row_se['cts_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['cts_id']; ?>"><?php echo $row_se['cts_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-12 ">
                                                         <button type="submit" name="update_answer" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i>Update</button>
                                                         <a data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!--end edit Answer-->
                                 
                              <?php
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </aside>
   </div>
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
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
   <script type="text/javascript">
      function doUpdate(id, name, note) {
         $('#position_id').val(id);
         $('#edit_name').val(name);
         $('#edit_note').val(note);
      }
      $(function() {
         $("#menu_task_manager").addClass("active");
         $("#depart_task").addClass("active");
         $("#depart_task").css("background-color", "##367fa9");
         $('#table_department').dataTable();
      });
   </script>
</body>

</html>