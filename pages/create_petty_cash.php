<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_cpc_code = $_POST["txt_cpc_code"];
   $v_cpc_description = $_POST["txt_cpc_description"];
   $v_cpc_currency = $_POST["txt_cpc_currency"];
   $v_cpc_status = $_POST["txt_cpc_status"];
   $v_cpc_applied_date = $_POST["txt_cpc_applied_date"];
   $v_cpc_note = $_POST["txt_cpc_note"];

   $sql = "INSERT INTO create_petty_cash 
                        ( cpc_code , cpc_description, cpc_currency, cpc_status,
                        cpc_applied_date,  cpc_note)
                  VALUES 
                    ('$v_cpc_code', '$v_cpc_description', '$v_cpc_currency', '$v_cpc_status',
                    '$v_cpc_applied_date','$v_cpc_note')";
   $result = mysqli_query($connect, $sql);
   header('location:create_petty_cash.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["cpc_id"];
   $v_cpc_code = $_POST["edit_cpc_code"];
   $v_cpc_description = $_POST["edit_cpc_description"];
   $v_cpc_currency = $_POST["edit_cpc_currency"];
   $v_cpc_status = $_POST["edit_cpc_status"];
   $v_cpc_applied_date = $_POST["edit_cpc_applied_date"];
   $v_cpc_note = $_POST["edit_cpc_note"];

   $sql = "UPDATE create_petty_cash SET cpc_code = '$v_cpc_code',
                                 cpc_description = '$v_cpc_description',
                                 cpc_currency = '$v_cpc_currency',
                                 cpc_status = '$v_cpc_status',
                                 cpc_applied_date = '$v_cpc_applied_date',
                                 cpc_note = '$v_cpc_note' WHERE cpc_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:create_petty_cash.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM create_petty_cash WHERE cpc_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: create_petty_cash.php?message=delete");
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
   <!-- bootstrap 3.0.2 -->
   <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
               Create Petty Cash
            </h1>

         </section>

         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">

               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create New</button>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-6" style="margin-top: 15px;">
                                             <label>Code:</label>
                                             <input class="form-control" id="txt_cpc_code" name="txt_cpc_code" type="text">
                                          </div>
                                          <div class="form-group col-xs-6" style="margin-top: 40px;">
                                             <label>Status:</label>
                                             <input class="form-control" id="txt_cpc_status" name="txt_cpc_status" type="checkbox" name="contact" id="contact_active" value="Active" />
                                             <label for="contact_active">Active</label>
                                             <input class="form-control" id="txt_cpc_status" name="txt_cpc_status" type="checkbox" name="contact" id="contact_inactive" value="Inactive" />
                                             <label for="contact_inactive">Inactive</label>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Applied Date:</label>
                                             <input class="form-control" id="txt_cpc_applied_date" name="txt_cpc_applied_date" type="date" required>
                                          </div>
                                          <div class="form-group col-xs-6" style="margin-top: -75px;">
                                             <label>Description:</label>
                                             <input class="form-control" id="txt_cpc_description" name="txt_cpc_description" required="required">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Currency:</label>
                                             <input class="form-control" id="txt_cpc_currency" name="txt_cpc_currency" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Note:</label>
                                             <input class="form-control" id="txt_cpc_note" name="txt_cpc_note" type="text" required>
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
                                          <input type="hidden" id="cpc_id" name="cpc_id" />

                                          <div class="form-group col-xs-6">
                                             <label>Code:</label>
                                             <input class="form-control" id="edit_cpc_code" name="edit_cpc_code" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Description:</label>
                                             <input class="form-control" id="edit_cpc_description" name="edit_cpc_description" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Currency:</label>
                                             <input class="form-control" id="edit_cpc_currency" name="edit_cpc_currency" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Starus:</label>
                                             <input class="form-control" id="edit_cpc_status" name="edit_cpc_status" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Applied Date:</label>
                                             <input class="form-control" id="edit_cpc_applied_date" name="edit_cpc_applied_date" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Note:</label>
                                             <input class="form-control" id="edit_cpc_note" name="edit_cpc_note" type="text">
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

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Currency</th>
                                    <th>Status</th>

                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM create_petty_cash";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_cpc_code = $row["cpc_code"];
                                    $v_cpc_description = $row["cpc_description"];
                                    $v_cpc_currency = $row["cpc_currency"];
                                    $v_cpc_status = $row["cpc_status"];
                                    $v_cpc_applied_date = $row["cpc_applied_date"];
                                    $v_cpc_note = $row["cpc_note"];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td><?php echo $v_cpc_code; ?></td>
                                       <td><?php echo $v_cpc_description; ?></td>
                                       <td><?php echo $v_cpc_currency; ?></td>
                                       <td><?php echo $v_cpc_status; ?></td>
                                       <td class="text-center" >
                                       <a onclick="doUpdate(<?php echo $row['cpc_id']; ?>,
                                                         '<?php echo $v_cpc_code; ?>',
                                                         '<?php echo $v_cpc_description; ?>',
                                                         '<?php echo $v_cpc_currency; ?>',
                                                         '<?php echo $v_cpc_status; ?>',
                                                         '<?php echo $row['cpc_applied_date']; ?>',
                                                         '<?php echo $row['cpc_status']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="create_petty_cash.php?del_id=<?php echo $row['cpc_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


   <script type="text/javascript">
      function doUpdate(id, cpc_code, cpc_description, cpc_currency, cpc_status, cpc_applied_date, cpc_note) {

         $('#cpc_id').val(id);
         $('#edit_cpc_code').val(cpc_code);
         $('#edit_cpc_description').val(cpc_description);
         $('#edit_cpc_currency').val(cpc_currency);
         $('#edit_cpc_status').val(cpc_status);
         $('#edit_cpc_applied_date').val(cpc_applied_date);
         $('#edit_cpc_note').val(cpc_note);




      }

      $(function() {
         $("#menu_pc_manage").addClass("active");
         $("#pc_create").addClass("active");
         $("#pc_create").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>