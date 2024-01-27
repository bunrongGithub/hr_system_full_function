<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_job_id = $_POST['stu_job_id'];
   $v_category = $_POST["stu_category"];
   $v_code = $_POST["stu_code"];
   $v_type = $_POST["stu_type"];
   $v_name = $_POST["stu_name"];
   $v_qty = $_POST["stu_qty"];
   $v_mou = $_POST["stu_mou"];
   $v_price = $_POST["stu_price"];
   $v_amount = $_POST["stu_total"];
   $v_note = $_POST["stu_comment"];
   $v_using_date = $_POST['stu_date'];

   $sql = "INSERT INTO admin_stationary_usage  
                        ( 
                        adstu_code,
                        adstu_type,
                        adstu_name,
                        adstu_category,
                        adstu_qty,
                        adstu_mou,
                        adstu_unit_price,
                        adstu_total,
                        adstu_er_id,
                        adstu_using_date,
                        adstu_note,
                        adstu_created_date )
                  VALUES (
                     '$v_code',
                     '$v_type',
                     '$v_name',
                     '$v_category',
                     '$v_qty',
                     '$v_mou',
                     '$v_price',
                     '$v_amount',
                     '$v_job_id',
                     '$v_using_date',
                     '$v_note',
                     now()
                  )";
   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_usage.php?message=success');
   exit();
}
if (isset($_POST["btnupdate"])) {
   $_stu_id = $_POST['stu_edit_id'];
   $_stu_job_id = $_POST['stu_edit_job_id'];
   $_stu_type = $_POST['stu_edit_type'];
   $_stu_code = $_POST['stu_edit_code'];
   $_stu_name = $_POST['stu_edit_name'];
   $_stu_category = $_POST['stu_edit_category'];
   $_stu_date = $_POST['stu_edit_date'];
   $_stu_qty =  $_POST['stu_edit_qty'];
   $_stu_price = $_POST['stu_edit_price'];
   $_stu_mou = $_POST['stu_edit_mou'];
   $_stu_amount = $_POST['stu_edit_total'];
   $_stu_comment = $_POST['stu_edit_comment'];
   $sql = "UPDATE admin_stationary_usage SET 
                        adstu_code ='$_stu_code',
                        adstu_type ='$_stu_type',
                        adstu_name ='$_stu_name',
                        adstu_category ='$_stu_category',
                        adstu_qty ='$_stu_qty',
                        adstu_mou ='$_stu_mou',
                        adstu_unit_price ='$_stu_price',
                        adstu_total ='$_stu_amount',
                        adstu_er_id ='$_stu_job_id',
                        adstu_using_date ='$_stu_date',
                        adstu_note ='$_stu_comment',
                        adstu_updated_date = 'now()' WHERE adstu_id = '$_stu_id'";

   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_usage.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM admin_stationary_usage WHERE adstu_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: admin_stationary_usage.php?message=delete");
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
               Stationary Usage
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
                                          <div class="col-xs-6">
                                             <label for="">Job ID:</label>
                                             <select name="stu_job_id" class="form-control" data-live-search="true" id="emp_job_id">
                                                <option aria-readonly="true" value="">Please Select Job ID:</option>
                                                <?php
                                                $sql = "SELECT er_id,
                                                         er_job_id,
                                                         er_name_kh
                                                   FROM employee_registration";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                   echo "<option value=" . $row['er_id'] . " >ID:&nbsp;&nbsp;&nbsp;&nbsp;" . $row['er_job_id'] . "&nbsp;&nbsp;&nbsp;Name:&nbsp;&nbsp;&nbsp;&nbsp;" . $row['er_name_kh'] . "</option>";
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div id="amount_data"></div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>ST.Type:</label>
                                             <select class="form-control show_hid" id="stu_type" name="stu_type" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM `text_ stationary_requisition_type`';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['srt_id'] . '">' . $row['srt_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>ST.Code:</label>
                                             <select class="form-control show_hid" id="stu_code" name="stu_code" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT sc_id,sc_stationary_code FROM `stationary_code`';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['sc_id'] . '">' . $row['sc_stationary_code'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>ST.Name:</label>
                                             <input class="form-control" id="stu_name" name="stu_name" type="text">
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>ST.Catagory:</label>
                                             <select class="form-control show_hid" id="stu_category" name="stu_category" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT sc_id,
                                                            sc_description_en 
                                                            FROM `stationary_code`';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['sc_id'] . '">' . $row['sc_description_en'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>Using Date:</label>
                                             <input class="form-control" id="stu_date" name="stu_date" type="date">
                                          </div>
                                          <div style="visibility: hidden;" class="for-group show_hid col-xs-6">
                                             <label for="">Qty:</label>
                                             <input id="stu_qty" name="stu_qty" class="form-control" type="number">
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-6">
                                             <label>Mou:</label>
                                             <select class="form-control show_hid" id="stu_mou" name="stu_mou" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                $sql = 'SELECT tasim_id,
                                                               tasim_name FROM `txt_admin_stationary_in_mou`';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div style="visibility: hidden;" class="for-group show_hid col-xs-6">
                                             <label for="">Current Price:</label>
                                             <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input id="stu_price" name="stu_price" class="form-control" type="text">
                                             </div>
                                          </div>
                                          <div style="visibility: hidden;" class="mt-5 for-group show_hid col-xs-6">
                                             <label for="">Total Amount:</label>
                                             <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input id="stu_total" name="stu_total" class="form-control" type="text">
                                             </div>
                                          </div>
                                          <div style="visibility: hidden;" class="form-group show_hid col-xs-12">
                                             <label>Comment:</label>
                                             <textarea class="form-control" id="stu_comment" name="stu_comment" type="text"></textarea>
                                          </div>
                                    </div>
                                    <div class="modal-footer mb-5 ">
                                       <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
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
                                       <input type="hidden" name="stu_edit_id" id="stu_edit_id">
                                       <div class="col-xs-6">
                                          <label for="">Job ID:</label>
                                          <select name="stu_edit_job_id" class="form-control" data-live-search="true" id="emp_edit_job_id">
                                             <option aria-readonly="true" value="">Please Select Job ID:</option>
                                             <?php
                                             $sql = "SELECT er_id,
                                                         er_job_id,
                                                         er_name_kh
                                                   FROM employee_registration";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value=" . $row['er_id'] . " >ID:&nbsp;&nbsp;&nbsp;&nbsp;" . $row['er_job_id'] . "&nbsp;&nbsp;&nbsp;Name:&nbsp;&nbsp;&nbsp;&nbsp;" . $row['er_name_kh'] . "</option>";
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>ST.Type:</label>
                                          <select class="form-control" id="stu_edit_type" name="stu_edit_type" data-live-search="true">
                                             <option value=""></option>
                                             <?php
                                             $sql = 'SELECT * FROM `text_ stationary_requisition_type`';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['srt_id'] . '">' . $row['srt_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>ST.Code:</label>
                                          <select class="form-control" id="stu_edit_code" name="stu_edit_code" data-live-search="true">
                                             <option value=""></option>
                                             <?php
                                             $sql = 'SELECT sc_id,sc_stationary_code FROM `stationary_code`';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['sc_id'] . '">' . $row['sc_stationary_code'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>ST.Name:</label>
                                          <input class="form-control" id="stu_edit_name" name="stu_edit_name" type="text">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label>ST.Catagory:</label>
                                          <select class="form-control" id="stu_edit_category" name="stu_edit_category" data-live-search="true">
                                             <option value=""></option>
                                             <?php
                                             $sql = 'SELECT sc_id,
                                                            sc_description_en 
                                                            FROM `stationary_code`';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['sc_id'] . '">' . $row['sc_description_en'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group  col-xs-6">
                                          <label>Using Date:</label>
                                          <input class="form-control" id="stu_edit_date" name="stu_edit_date" type="date">
                                       </div>
                                       <div class="for-group col-xs-6">
                                          <label for="">Qty:</label>
                                          <input id="stu_edit_qty" name="stu_edit_qty" class="form-control" type="number">
                                       </div>
                                       <div class="form-group  col-xs-6">
                                          <label>Mou:</label>
                                          <select class="form-control" id="stu_edit_mou" name="stu_edit_mou" data-live-search="true">
                                             <option value=""></option>
                                             <?php
                                             $sql = 'SELECT tasim_id,
                                                               tasim_name FROM `txt_admin_stationary_in_mou`';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="for-group col-xs-6">
                                          <label for="">Current Price:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input id="stu_edit_price" name="stu_edit_price" class="form-control" type="text">
                                          </div>
                                       </div>
                                       <div class="mt-5 for-group col-xs-6">
                                          <label for="">Total Amount:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input id="stu_edit_total" name="stu_edit_total" class="form-control" type="text">
                                          </div>
                                       </div>
                                       <div class="form-group col-xs-12">
                                          <label>Comment:</label>
                                          <textarea class="form-control" id="stu_edit_comment" name="stu_edit_comment" type="text"></textarea>
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnupdate" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                    <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
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
                                 <th>ST.Code</th>
                                 <th>ST.Type</th>
                                 <th>ST.Name</th>
                                 <th>QTY</th>
                                 <th>Current Price</th>
                                 <th>Total Amount</th>
                                 <th>Job ID</th>
                                 <th>Employee Name</th>
                                 <th>Position</th>
                                 <th>Using Date</th>
                                 <th style="width: 110px;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM admin_stationary_usage A
                                                                  LEFT JOIN `stationary_code` B ON B.sc_id = A.adstu_code
                                                                  LEFT JOIN `employee_registration` C ON C.er_id = A.adstu_er_id  
                                                                  LEFT JOIN `position` D ON D.position_id = C.er_position_id 
                                                                  LEFT JOIN `text_stationary_type` E ON E.st_id = A.adstu_type
                                                               ";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $_count_row = $i++;
                                 $_stu_code = $row['sc_stationary_code'];
                                 $_stu_type = $row['st_name'];
                                 $_stu_name = $row['adstu_name'];
                                 $_stu_qty = $row['adstu_qty'];
                                 $_stu_current_price = $row['adstu_unit_price'];
                                 $_stu_amount = $row['adstu_total'];
                                 $_stu_job_id = $row['er_job_id'];
                                 $_stu_emp_name = $row['er_name_kh'];
                                 $_stu_position = $row['position'];
                                 $_stu_using_date = $row['adstu_using_date'];
                              ?>
                                 <tr>
                                    <td><?= $_count_row;?></td>
                                    <td><?= $_stu_code;?></td>
                                    <td><?= $_stu_type;?></td>
                                    <td><?= $_stu_name;?></td>
                                    <td><?= $_stu_qty;?></td>
                                    <td><?= $_stu_current_price;?></td>
                                    <td><?= $_stu_amount;?></td>
                                    <td><?= $_stu_job_id;?></td>
                                    <td><?= $_stu_emp_name;?></td>
                                    <td><?= $_stu_position;?></td>
                                    <td><?= $_stu_using_date;?></td>
                                    <td>
                                       <a onclick="doUpdate(
                                          '<?=$row['adstu_id'];?>',
                                          '<?=$row['adstu_type'];?>',
                                          '<?=$row['adstu_code'];?>',
                                          '<?=$row['adstu_name'];?>',
                                          '<?=$row['adstu_category'];?>',
                                          '<?=$row['adstu_qty'];?>',
                                          '<?=$row['adstu_mou'];?>',
                                          '<?=$row['adstu_unit_price'];?>',
                                          '<?=$row['adstu_total'];?>',
                                          '<?=$row['adstu_er_id'];?>',
                                          '<?=$row['adstu_using_date'];?>',
                                          '<?=$row['adstu_note'];?>', //id,stu_type,stu_code,stu_name,stu_category,stu_qty,stu_mou,stu_price,stu_total,stu_job_id,stu_date,stu_note
                                       );" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Are you sure to delete ?');" href="admin_stationary_usage.php?del_id=<?php echo $row['adstu_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }

      function show_edit_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_edit_photo").src = src;
         }
      }
      $('#emp_job_id').change(function() {
         $('.show_hid').css("visibility", "visible");
         var job_id = $('#emp_job_id').val();
         //console.log(job_id);
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_admin_stationary_usage.php',
               data: {
                  'staff_job_id': job_id
               },
               success: function(data) {
                  $("#amount_data").html(data);
               }
            });
         }
      });
      function doUpdate(id,stu_type,stu_code,stu_name,stu_category,stu_qty,stu_mou,stu_price,stu_total,stu_job_id,stu_date,stu_note){
         $("#stu_edit_id").val(id);
         $("#stu_edit_type").val(stu_type).change();
         $("#stu_edit_code").val(stu_code).change();
         $("#stu_edit_name").val(stu_name);
         $("#stu_edit_category").val(stu_category).change();
         $("#stu_edit_qty").val(stu_qty);
         $("#stu_edit_mou").val(stu_mou).change();
         $("#stu_edit_price").val(stu_price);
         $("#stu_edit_total").val(stu_total);
         $("#emp_edit_job_id").val(stu_job_id).change();
         $("#stu_edit_date").val(stu_date);
         $("#stu_edit_comment").val(stu_note);
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_stationary_manage").addClass("active");
         $("#station_usage").addClass("active");
         $("#station_usage").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>
</html>