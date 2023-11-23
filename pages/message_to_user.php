<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

// Add New Iteme

if (isset($_POST['submit'])) {
   $v_from_user = $_POST['txt_from_user'];
   $v_to_user = $_POST['txt_to_user'];
   $v_date_info = $_POST['txt_date_info'];
   $v_message_info = $_POST['txt_message_info'];
   $user_id = $_SESSION['user_id'];
   $datetime = date('Y-m-d H:i:s');

   $query = "INSERT INTO message_to_user (mu_from_user,mu_to_user,mu_message_info,mu_input_date,mu_user_id,mu_create_at ) 
        VALUES ( '$v_from_user','$v_to_user','$v_message_info','$v_date_info','$user_id','$datetime')";
   $queryrun = mysqli_query($connect, $query);
   if ($queryrun) {
      header("location:message_to_user.php");
      exit();
   } else {
      header("location:message_to_user.php");
      echo "<script>alert ('Insert faile');</script>";
      exit();
   }
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM message_to_user WHERE mu_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: message_to_user.php?message=delete");
}
// Upload File pdfs

if (isset($_POST['btn_add'])) {
   $v_image = @$_FILES['mu_attach_file'];
   $v_id = @$_POST['mu_id'];
   if ($v_image["name"] != "") {
      $old_image = @$_POST['txt_old_img'];
      if (file_exists("../img/file/" . $old_image) and $old_image != 'blank.png') {
         unlink("../img/file/" . $old_image);
      }

      $new_name = date("Ymd") . "_" . rand(1111, 9999) . ".pdf";
      move_uploaded_file($v_image["tmp_name"], "../img/file/" . $new_name);

      $query_update = "UPDATE message_to_user SET
                              mu_attach_file='$new_name' 
                        WHERE mu_id='$v_id'";

      if ($connect->query($query_update)) {
         header("Location: message_to_user.php");
         $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>';
      } else {
         $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';
      }
   }
}


// Edit 
if (isset($_POST['update'])) {
   $update_id = $_POST['mu_id'];
   $from_user_update = $_POST['from_user_update'];
   $to_user_update = $_POST['to_user_update'];
   $input_date_update = $_POST['input_date_update'];
   $info_update_update = $_POST['info_update_update'];
   $user_id = $_SESSION['user_id'];

   $query_update = "UPDATE message_to_user SET
                            mu_from_user = '$from_user_update',
                            mu_to_user = '$to_user_update',
                            mu_input_date ='$input_date_update', 
                            mu_message_info = '$info_update_update',
                            mu_user_id = '$user_id'
                            WHERE mu_id ='" . $update_id . "'";

   $update_run = mysqli_query($connect, $query_update);
   if ($query_run == true) {
      header("location: message_to_user.php");
      exit();
   } else {
      header("location: message_to_user.php");
      exit();
   }
}
// End Edit


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
               Message To User
            </h1>

         </section>

         <!-- Main content -->
         <!-- Modal Add New  -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin: 1%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="post">
                                       <div class="row">

                                          <div class="form-group col-xs-6">
                                             <label for="">From_User:</label>
                                             <select class="form-control select2" style="width: 100%;" name="txt_from_user">
                                                <option hidden value="">==== Select ====</option>
                                                <?php
                                                $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username");
                                                while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="">To_User:</label>
                                             <select class="form-control select2" style="width: 100%;" name="txt_to_user">
                                                <option hidden value="">==== Select ====</option>
                                                <?php
                                                $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username");
                                                while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Date_Input:</label>
                                             <input class="form-control" name="txt_date_info" type="date">
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Message_Info:</label>
                                             <textarea class="form-control" name="txt_message_info" cols="2" ></textarea>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Modal -->

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">From_User</th>
                                    <th scope="col">To_User</th>
                                    <th scope="col">Message_Info</th>
                                    <th scope="col">Input_Date</th>
                                    <th scope="col">Attach_File</th>
                                    <th scope="col" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM message_to_user A
                                                    ";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_from_user = $row["mu_from_user"];
                                    $sql_from = "SELECT * FROM user A
                                                                    LEFT JOIN position B ON B.position_id=A.position_id
                                                                    WHERE id = '$v_from_user'
                                                                    ";
                                    $result_from = $connect->query($sql_from);
                                    $row_from = $result_from->fetch_assoc();
                                    $get_user_from = $row_from['username'];
                                    $get_pos_from = $row_from['position'];
                                    $v_to_user = $row["mu_to_user"];
                                    $sql_to = "SELECT * FROM user A
                                                                    LEFT JOIN position B ON B.position_id=A.position_id
                                                                    WHERE id = '$v_to_user'
                                                                    ";
                                    $result_to = $connect->query($sql_to);
                                    $row_to = $result_to->fetch_assoc();
                                    $get_user_to = $row_to['username'];
                                    $get_pos_to = $row_to['position'];
                                    $v_message_info = $row["mu_message_info"];
                                    $v_input_date = $row["mu_input_date"];
                                    $v_attach_file = $row["mu_attach_file"];
                                 ?>
                                    <tr>
                                       <td scope="row"><?php echo $v_i; ?></td>
                                       <td scope="row">
                                          <?php echo $get_user_from; ?><br>
                                          <?php echo $get_pos_from; ?>
                                       </td>
                                       <td scope="row">
                                          <?php echo $get_user_to; ?><br>
                                          <?php echo $get_pos_to; ?>
                                       </td>
                                       <td scope="row"><?php echo $v_message_info; ?></td>
                                       <td scope="row"><?php echo $v_input_date; ?></td>
                                       <td scope="row">
                                          <?php
                                          if ($v_attach_file == "") {
                                          ?>
                                             <a target=”_blank” href="../img/file/image_no_file.png">
                                                <img height="50px" src="../img/file/image_no_file.png">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target=”_blank” href="../img/file/<?= $row['mu_attach_file']; ?>">
                                                <img height="50px" src="../img/file/pdf_image.png">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a onclick="doUpdate(<?php echo $row['mu_id']; ?>)" data-toggle="modal" data-target="#exampleModal_u<?php echo $row['mu_id']; ?>">
                                             <i style="cursor: pointer;" class="fa fa-pencil"></i></a>

                                       </td>

                                       <td scope="row">
                                          <!-- <a href="" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(<?php echo $row['mu_id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal1<?= $row['mu_id']; ?>"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="message_to_user.php?del_id=<?php echo $row['mu_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                    <!-- Start Upload File -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_u<?php echo $row['mu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLabel">Upload PDF File</h3>
                                             </div>
                                             <div class="modal-body">
                                                <p>
                                                   This page can upload <b> file pdf <b> only.
                                                </p>
                                                <form action="" method="POST" role="form" enctype="multipart/form-data">
                                                   <input type="hidden" name="mu_id" value="<?php echo $row["mu_id"] ?>">
                                                   <input type="hidden" name="txt_old_img" value="<?= @$_GET['sent_img'] ?>">
                                                   <div class="row">
                                                      <duv class="col-xs-6">
                                                         <img src="../img/file/<?= @$_GET['mu_attach_file'] ?>" alt="">
                                                         <div class="form-group">
                                                            <label for="">Upload Here</label>
                                                            <input required="" type="file" class="form-control" id="preview" name="mu_attach_file" onchange="loadFile(event)" />
                                                         </div>

                                                      </duv>
                                                   </div>

                                             </div>
                                             <div class="modal-footer">
                                                <button type="submit" name="btn_add" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Upload</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- End Upload -->

                                    <!-- Start Edite modal -->
                                    <div class="modal fade" id="exampleModal1<?= $row['mu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLabel">Edit </h3>
                                             </div>
                                             <div class="modal-body">
                                                <form action="" method="post">

                                                   <div class="row">
                                                      <input type="hidden" name="mu_id" value="<?php echo $row["mu_id"] ?>">
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label for="exampleFormControlSelect1">From_User</label>
                                                            <select class="form-control select2" style="width: 100%;" name="from_user_update">
                                                               <?php
                                                               $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                               while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                                  if ($row["mu_from_user"] == $row_se["id"]) {
                                                               ?>
                                                                     <option selected="selected" value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <option value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                               <?php
                                                                  }
                                                               }
                                                               ?>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label for="exampleFormControlSelect1">To_User</label>
                                                            <select class="form-control select2" style="width: 100%;" name="to_user_update">
                                                               <?php
                                                               $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                               while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                                  if ($row["mu_to_user"] == $row_se["id"]) {
                                                               ?>
                                                                     <option selected="selected" value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <option value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                               <?php
                                                                  }
                                                               }
                                                               ?>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Date_Input :</label>
                                                            <input type="date" name="input_date_update" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['mu_input_date']; ?>">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <div class="form-group">
                                                            <label>Message_Info :</label>
                                                            <textarea type="text" name="info_update_update" class="form-control" id="exampleFormControlInput1"><?php echo $row['mu_message_info']; ?></textarea>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group float-right">
                                                            <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Update</button>
                                                            <button type="reset" class="btn btn-danger " data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Back</button>
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             </form>
                                          </div>
                                       </div>

                                    </div>
                                    <!-- End Edite -->
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

   <!-- add new calendar event modal -->

   <!-- add new calendar event modal -->

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
      function doUpdate(id, username, note) {
         $('#brand_id').val(id);
         $('#edit_name').val(username);
         $('#edit_note').val(note);
      }

      $(function() {
         $("#menu_admin").addClass("active");
         $("#message_to_user").addClass("active");
         $("#message_to_user").css("background-color", "##367fa9");
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