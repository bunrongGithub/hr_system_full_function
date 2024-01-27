<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


$table_input = "admin_asset_usage(adasss_code,
               adasss_category
               ,adasss_asset_name
               ,adasss_qty
               ,adasss_price
               ,adasss_mou
               ,adasss_amount
               ,adasss_er_id
               ,adasss_using_date,
               adasss_withdrawn_date
               ,adasss_created_date
               ,adasss_userid)";
if(isset($_POST['btnadd'])){
   $txt_code = $_POST['txt_code'];
   $txt_category = $_POST['txt_category']; 
   $txt_name = $_POST['txt_name']; 
   $txt_qty = $_POST['txt_qty'];
   $txt_price = $_POST['txt_price'];
   $txt_mou = $_POST['txt_mou']; 
   $txt_amount = $_POST['txt_amount']; 
   $txt_job_id = $_POST['txt_job_id'];
   $txt_using_date = $_POST['txt_using_date'];
   $txt_withdraw_date = $_POST['txt_withdraw_date'];
   $sql = "INSERT INTO ".$table_input." VALUES(
                                             '$txt_code'
                                             ,'$txt_category'
                                             ,'$txt_name'
                                             ,'$txt_qty'
                                             ,'$txt_price'
                                             ,'$txt_mou'
                                             ,'$txt_amount'
                                             ,'$txt_job_id'
                                             ,'$txt_using_date'
                                             ,'$txt_withdraw_date'
                                             ,'$datetime'
                                             ,'$user_id'
                                             )";
   $result = mysqli_query($connect,$sql);
   if($result){
      header('location:admin_asset_usage.php?message=success');
      exit();
   }

}
if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];
   $sql = "DELETE FROM admin_asset_usage WHERE adasss_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: admin_asset_usage.php?message=delete");
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
               Asset Usage
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
                                          <div class="col-xs-12 form-group">
                                             <div class="col-xs-6 form-group">
                                                <label for="">Asset Code:</label>
                                                <select name="txt_code" data-live-search="true" class="form-control" id="txt_code">
                                                   <option value="">Please select Code</option>
                                                   <?php
                                                   $table = "assest_code_creation";
                                                   $sql = "SELECT * FROM " . $table;
                                                   $result = $connect->query($sql);
                                                   while ($row = $result->fetch_assoc()) {
                                                   ?>
                                                      <option value="<?= $row['ac_id']; ?>"><?php echo $row['ac_asset_code']; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="col-xs-6 form-group">
                                                <label for="">Job ID:</label>
                                                <select name="txt_job_id" data-live-search="true" class="form-control" id="txt_job_id">
                                                   <option value="">Please select Job ID</option>
                                                   <?php
                                                   $table = "employee_registration";
                                                   $sql = "SELECT * FROM " . $table;
                                                   $result = $connect->query($sql);
                                                   while ($row = $result->fetch_assoc()) {
                                                   ?>
                                                      <option value="<?= $row['er_id']; ?>"><?php echo "ID : " . $row['er_job_id']; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <p id="amount_data"></p>
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Asset Name:</label>
                                                <input type="text" class="form-control" name="txt_name" id="txt_name">
                                             </div>
                                             
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Asset Category:</label>
                                                <select class="form-control" data-live-search="true" name="txt_category" id="txt_category">
                                                   <option value=""></option>
                                                   <?php
                                                   $table = "assest_code_creation";
                                                   $sql = "SELECT * FROM " . $table;
                                                   $result = $connect->query($sql);
                                                   while ($row = $result->fetch_assoc()) {
                                                   ?>
                                                      <option value="<?= $row['ac_id']; ?>"><?php echo $row['as_asset_category']; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             
                                             <div style="display: none;" class="col-xs-3 show_hid form-group">
                                                <label for="">Qty:</label>
                                                <input type="text" class="form-control" name="txt_qty" id="txt_qty">
                                             </div>
                                             <div style="display: none;" class="col-xs-3 show_hid form-group">
                                                <label for="">MOU:</label>
                                                <select class="form-control" data-live-search="true" name="txt_mou" id="txt_mou">
                                                   <option value=""></option>
                                                   <?php
                                                   $table = "text_asset_in_mou";
                                                   $sql = "SELECT * FROM " . $table;
                                                   $result = $connect->query($sql);
                                                   while ($row = $result->fetch_assoc()) {
                                                   ?>
                                                      <option value="<?= $row['aim_id']; ?>"><?php echo $row['aim_name']; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Price:</label>
                                                <input type="text" class="form-control" name="txt_price" id="txt_price">
                                             </div>
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Amount:</label>
                                                <input type="text" class="form-control" name="txt_amount" id="txt_amount">
                                             </div>
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Using Date:</label>
                                                <input type="date" class="form-control" name="txt_using_date" id="txt_using_date">
                                             </div>
                                             <div style="display: none;" class="col-xs-6 show_hid form-group">
                                                <label for="">Withdraw Date:</label>
                                                <input type="date" class="form-control" name="txt_withdraw_date" id="txt_withdraw_date">
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
                           <div class="modal-dialog" style="">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="asset_usage_id" name="asset_usage_id" />
                                          
                                          <div class="row col-xs-6">
                                             
                                             <div class="form-group col-xs-12">
                                                <label>Asset Category:</label>
                                                <input class="form-control" id="edit_category" name="edit_category" type="text">
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Asset Code:</label>
                                                <input class="form-control" id="edit_code" name="edit_code" type="text">
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Asset Type:</label>
                                                <select class="form-control" id="edit_asset_type" name="edit_asset_type">
                                                   <?php
                                                   $sql = 'SELECT * FROM text_asset_in_type';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['ait_id'] . '">' . $row['ait_name'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Asset Name:</label>
                                                <input class="form-control" id="edit_name" name="edit_name" type="text">
                                             </div>
                                             <!-- <p id='amount_data'></p> -->
                                             <div class="form-group col-xs-6">
                                                <label>QTY:</label>
                                                <input class="form-control" id="edit_qty" name="edit_qty" type="number">
                                             </div>
                                             <div class="form-group col-xs-6">
                                                <label>MOU:</label>
                                                <select class="form-control" id="edit_mou" name="edit_mou">
                                                   <?php
                                                   $sql = 'SELECT * FROM text_asset_in_mou';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Amount:</label>
                                                <div class="input-group ">
                                                   <div class="input-group-addon">$</div>
                                                   <input class="form-control" id="edit_amount" name="edit_amount" type="number" step="0.01">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row col-xs-6">
                                             <div class="form-group col-xs-12">
                                                <label>Job ID:</label>
                                                <select class="form-control" id="edit_er_id" name="edit_er_id" data-live-search="true">
                                                   <option disabled selected>Please Select Job ID</option>
                                                   <?php
                                                   $sql = 'SELECT * FROM employee_registration';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Employee Name:</label>
                                                <input class="form-control" id="edit_emp_name" name="edit_emp_name" type="text">
                                             </div>
                                             <div class="form-group col-xs-12">
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
                                             <div class="form-group col-xs-12">
                                                <label>Using Date:</label>
                                                <input class="form-control" id="edit_use_date" name="edit_use_date" type="date">
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Withdrawn Date:</label>
                                                <input class="form-control" id="edit_drawn_date" name="edit_drawn_date" type="date">
                                             </div>
                                             <div class="form-group col-xs-12">
                                                <label>Status:</label>
                                                <select class="form-control" id="edit_status" name="edit_status">
                                                   <?php
                                                   $sql = 'SELECT * FROM text_asset_in_status';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['ais_id'] . '">' . $row['ais_name'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
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
                                    <th>Asset Code</th>
                                    <th>Asset Type</th>
                                    <th>Asset Name</th>
                                    <th>Start Date</th>
                                    <th>QTY</th>
                                    <th>Unit Price</th>
                                    <th>Employee Name</th>
                                    <th>Position</th>
                                    <th>Using Date</th>
                                    <th>Withdraw Date</th>
                                    <th>Status</th>
                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_usage 
                                                                  LEFT JOIN text_asset_in_type ON text_asset_in_type.ait_id = admin_asset_usage.adasss_type 
                                                                  LEFT JOIN text_asset_in_status ON text_asset_in_status.ais_id = admin_asset_usage.adasss_status
                                                                  LEFT JOIN employee_registration ON employee_registration.er_id = admin_asset_usage.adasss_er_id  
                                                                  LEFT JOIN position ON position.position_id = employee_registration.er_position_id ";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_asset_code = $row["adasss_code"];
                                    $v_type = $row["ait_name"];
                                    $v_asset_name = $row["adasss_asset_name"];
                                    $v_date = $row["adasss_using_date"];
                                    $v_qty = $row["adasss_qty"];
                                    $v_uprice = $row["adasss_price"];
                                    $v_emp_name = $row["er_name_kh"];
                                    $v_position = $row["position"];
                                    $v_using_date = $row["adasss_using_date"];
                                    $v_drawn_date = $row["adasss_withdrawn_date"];
                                    $v_status_id = $row["ais_name"];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td><?php echo $v_asset_code; ?></td>
                                       <td><?php echo $v_type; ?></td>
                                       <td><?php echo $v_asset_name; ?></td>
                                       <td><?php echo $v_date; ?></td>
                                       <td><?php echo $v_qty; ?></td>
                                       <td><?php echo $v_uprice; ?></td>
                                       <td><?php echo $v_emp_name; ?></td>
                                       <td><?php echo $v_position; ?></td>
                                       <td><?php echo $v_using_date; ?></td>
                                       <td><?php echo $v_drawn_date; ?></td>
                                       <td><?php echo $v_status_id; ?></td>
                                       <td>
                                          <!-- <a href="edit_admin_asset_usage.php?id=<?php echo $row['adasss_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="admin_asset_usage.php?del_id=<?php echo $row['adasss_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      // Get references to the input elements
      const qtyInput = document.getElementById("txt_qty");
      const priceInput = document.getElementById("txt_price");
      const amountInput = document.getElementById("txt_amount");

      // Add event listeners to the quantity and price inputs
      qtyInput.addEventListener("input", calculateTotal);
      priceInput.addEventListener("input", calculateTotal);

      function calculateTotal() {
         // Get the entered quantity and price values
         const qty = parseFloat(qtyInput.value);
         const price = parseFloat(priceInput.value);

         // Handle potential errors
         if (isNaN(qty) || isNaN(price)) {
            amountInput.value = ""; // Clear the amount if input is invalid
            return;
         }

         // Calculate the total amount
         const total = qty * price;

         // Update the total value in the amount input field
         amountInput.value = total.toFixed(2) +"$"; // Display with 2 decimal places
      }

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

      function doUpdate(id, category, code, type, name, qty, mou, amount,
         emp_id, emp_name, emp_position, using_date, drawn_date, status, photo) {

         $('#asset_usage_id').val(id);
         $('#edit_category').val(category);
         $('#edit_code').val(code);
         $('#edit_asset_type').val(type).change();
         $('#edit_name').val(name);
         $('#edit_qty').val(qty);
         $('#edit_mou').val(mou).change();
         $('#edit_amount').val(amount);
         $('#edit_er_id').val(emp_id).change();
         $('#edit_emp_name').val(emp_name);
         $('#edit_position').val(emp_position);
         $('#edit_use_date').val(using_date);
         $('#edit_drawn_date').val(drawn_date);
         $('#edit_status').val(status);

         if (photo == '' || photo == 'NULL') {
            document.getElementById('show_edit_photo').setAttribute('src', '../img/no_image.jpg');
         } else {
            document.getElementById('show_edit_photo').setAttribute('src', '../img/upload/asset_broken/' + photo);
         }
      }
      $("#txt_code").change(function() {
         $('.show_hid').css("display", "block");
      });
      $('#txt_job_id').change(function() {
         var job_id = $("#txt_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_admin_asset.php',
               data: {
                  txt_emp_stationary_usage: job_id
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_usage").addClass("active");
         $("#asset_usage").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>