<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "DELETE FROM working_report where wr_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:working_report.php?message=delete'));
}

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_POST["btnadd"])) {
   $v_task_no = $_POST["txt_task_no"];
   $v_description = $_POST["txt_description"];
   $v_result = $_POST["txt_result"];
   $v_input_date = $_POST["txt_input_date"];
   $v_status = $_POST["txt_status"];
   $v_note = $_POST["txt_note"];

   $sql = "INSERT INTO working_report 
                        (wr_task_no
                        , wr_description
                        , wr_result
                        , wr_input_date
                        , wr_status
                        , wr_note
                        ) 
                  VALUES 
                    ('$v_task_no'
                    , '$v_description'
                    , '$v_result'
                    , '$v_input_date'
                    , '$v_status'
                    , '$v_note'
                    )";
   $result = mysqli_query($connect, $sql);
   header('location: working_report.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["edit_wr_id"];
   $v_task_no = $_POST["edit_task_no"];
   $v_description = $_POST["edit_description"];
   $v_result = $_POST["edit_result"];
   $v_input_date = $_POST["edit_input_date"];
   $v_status = $_POST["edit_status"];
   $v_note = $_POST["edit_note"];

   $sql = "UPDATE working_report SET wr_task_no = '$v_task_no'
                                    , wr_description = '$v_description'
                                    , wr_result = '$v_result'
                                    , wr_input_date = '$v_input_date'
                                    , wr_status = '$v_status'
                                    , wr_note = '$v_note'
                                 WHERE wr_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:working_report.php?message=update');
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
         <section class="content-header">
            <h1 class="text-primary">Working Report</h1>
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
         </section>
         <section>
            <div class="row">
               <!-- Button trigger modal -->
               <!-- Modal add new-->
               <div class="modal fade" id="exampleModal" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h3>
                        </div>
                        <div class="modal-body">
                           <form method="post" enctype="multipart/form-data" action="">
                              <div class="col-md-12">
                                 <div class="form-group col-xs-6">
                                    <label for="">Task_No:</label>
                                    <select class="form-control select2" style="width: 100%;" id="txt_task_no" name="txt_task_no">
                                       <option value="">==== Select ====</option>
                                       <?php
                                       $v_select = mysqli_query($connect, "SELECT * FROM company_task ORDER BY ct_task_no ASC");
                                       while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                          <option value="<?php echo $row['ct_id']; ?>"><?php echo $row['ct_task_no']; ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div id="amount_data"></div>
                                 
                                 <div class="form-group col-xs-6">
                                    <label>Result:</label>
                                    <input class="form-control" id="id_result" name="txt_result" type="text">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label>Input_Date:</label>
                                    <input class="form-control" id="id_input_date" name="txt_input_date" type="date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Status%:</label>
                                    <select class="form-control select2" style="width: 100%;" name="txt_status">
                                       <option value="">==== Select ====</option>
                                       <?php
                                       $v_select = mysqli_query($connect, "SELECT * FROM text_working_report_status ORDER BY twrs_name ASC");
                                       while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                          <option value="<?php echo $row['twrs_id']; ?>"><?php echo $row['twrs_name']; ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label>Note:</label>
                                    <input class="form-control" id="id_note" name="txt_note" type="text">
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
               <!--end modal add new-->
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
                                                        <input type="hidden" id="edit_wr_id" name="edit_wr_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Task_No:</label>
                                                            <select class="form-control" id="edit_task_no" name="edit_task_no" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM company_task';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ct_id'] . '">' . $row['ct_task_no'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Description:</label>
                                                            <input class="form-control" id="edit_description" name="edit_description" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Result:</label>
                                                            <input class="form-control" id="edit_result" name="edit_result" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date_Input:</label>
                                                            <input class="form-control" id="edit_input_date" name="edit_input_date" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_working_report_status';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['twrs_id'] . '">' . $row['twrs_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Note:</label>
                                                            <input class="form-control" id="edit_note" name="edit_note" type="text">
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
               <div class="col-xs-12 connectedSortable">

                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="example" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>Task_No</th>
                                 <th>Desscription</th>
                                 <th>Result</th>
                                 <th>Input_Date</th>
                                 <th>Status%</th>
                                 <th style="width:130px; text-align:center;"><i class="fa fa-cog"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = " SELECT * FROM working_report A
                                          LEFT JOIN company_task B ON B.ct_id=A.wr_task_no
                                          LEFT JOIN text_working_report_status C ON C.twrs_id=A.wr_status
                                          ";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_task_no = $row['ct_task_no'];                                 
                                 $v_description = $row['wr_description'];
                                 $v_result = $row['wr_result'];
                                 $v_input_date = $row['wr_input_date'];
                                 $v_status = $row['twrs_name'];
                              ?>
                                 <tr>
                                    <td><?php echo $v_i; ?></td>
                                    <td><?php echo $v_task_no; ?></td>
                                    <td><?php echo $v_description; ?></td>
                                    <td><?php echo $v_result; ?></td>
                                    <td><?php echo $v_input_date; ?></td>
                                    <td><?php echo $v_status;  ?></td>
                                    <td>
                                       <a onclick="doUpdate(<?php echo $row['wr_id']; ?>,
                                                        '<?php echo $row['wr_task_no']; ?>',
                                                        '<?php echo $row['wr_description']; ?>',
                                                        '<?php echo $row['wr_result']; ?>',
                                                        '<?php echo $row['wr_input_date']; ?>',
                                                        '<?php echo $row['wr_status']; ?>',
                                                        '<?php echo $row['wr_note']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>-->
                                       <a onclick="return confirm('Are you sure delete?')" href="working_report.php?id=<?php echo $row['wr_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
               <!--end update data -->

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
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script type="text/javascript">
      function doUpdate(wr_id, wr_task_no, wr_description, wr_result, wr_input_date, wr_status, wr_note) {
         $('#edit_wr_id').val(wr_id);
         $('#edit_task_no').val(wr_task_no).change();
         $('#edit_description').val(wr_description);
         $('#edit_result').val(wr_result);
         $('#edit_input_date').val(wr_input_date);
         $('#edit_status').val(wr_status);
         $('#edit_note').val(wr_note);
      }
      $("#txt_task_no").change(function(){
         var task_no =$("#txt_task_no").val();
         if(task_no){
            $.ajax({
               type: "POST",
               url:'fetch_working_reports.php',
               data:{
                  'data_task_no':task_no
               },
               success:function(data){
                  $('#amount_data').html(data);
               }
            });
         }
      });
      
      $(function() {
         $("#menu_task_manager").addClass("active");
         $("#working_report").addClass("active");
         $("#working_report").css("background-color", "##367fa9");
         $('#example').dataTable();
      });
   </script>
</body>

</html>