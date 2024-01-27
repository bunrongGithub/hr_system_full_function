<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_pca_no = $_POST["txt_add_no"];
   $v_amount_usd = $_POST["txt_amount_usd"];
   $v_amount_khr = $_POST["txt_amount_khr"];
   $v_ref = $_POST["txt_ref"];
   $v_note = $_POST["txt_note"];
   $v_company = $_POST["txt_company"];
   $v_branch = $_POST["txt_branch"];
   $v_department = $_POST["txt_department"];

   $sql = "INSERT INTO pettycash_add 
                        ( pa_addc_no , pa_amount_usd, pa_amount_khr, pa_ref,
                         pa_date, pa_company_id, pa_branch_id, pa_department_id, pa_note, pa_user_id, created_at)
                  VALUES 
                    ('$v_pca_no', '$v_amount_usd', '$v_amount_khr', '$v_ref',
                    '$yeardate',  '$v_company',  '$v_branch',  '$v_department', '$v_note', '$user_id', '$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:pettycash_mgt.php?message=success');
}


if (isset($_POST["btnadd_exp"])) {
   $v_exp_no = $_POST["txt_exp_no"];
   $v_amount_usd = $_POST["txt_amount_usd_exp"];
   $v_amount_khr = $_POST["txt_amount_khr_exp"];
   $v_company = $_POST["txt_company_exp"];
   $v_branch = $_POST["txt_branch_exp"];
   $v_department = $_POST["txt_department_exp"];
   $v_ref = $_POST["txt_ref_exp"];
   $v_inv = $_POST["txt_inv_exp"];
   $v_note = $_POST["txt_note_exp"];

   $sql = "INSERT INTO pettycash_exp 
                        ( pe_exp_no , pe_amount_usd, pe_amount_khr,
                         pe_ref, pe_invoice_no, pe_date, pe_note, pe_company_id, pe_branch_id, pe_department_id, pe_user_id, created_at)
                  VALUES 
                    ('$v_exp_no', '$v_amount_usd', '$v_amount_khr',
                    '$v_ref', '$v_inv', '$yeardate', '$v_note','$v_company','$v_branch','$v_department','$user_id', '$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:pettycash_mgt.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["pca_id"];
   $v_pca_no = $_POST["edit_add_no"];
   $v_amount_usd = $_POST["edit_amount_usd"];
   $v_amount_khr = $_POST["edit_amount_khr"];
   $v_ref = $_POST["edit_ref"];
   $v_note = $_POST["edit_note"];
   $v_company = $_POST["edit_company"];
   $v_branch = $_POST["edit_branch"];
   $v_department = $_POST["edit_department"];

   $sql = "UPDATE pettycash_add SET pa_addc_no = '$v_pca_no', 
                                pa_amount_usd = '$v_amount_usd', 
                                pa_amount_khr = '$v_amount_khr', 
                                pa_ref = '$v_ref', 
                                pa_company_id = '$v_company', 
                                pa_branch_id = '$v_branch', 
                                pa_department_id = '$v_department', 
                                pa_note = '$v_note' WHERE pa_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:pettycash_mgt.php?message=update');
}

if (isset($_POST["btnupdate_exp"])) {
   $id = $_POST["pce_id"];
   $v_exp_no = $_POST["edit_exp_no"];
   $v_amount_usd = $_POST["edit_amount_usd_exp"];
   $v_amount_khr = $_POST["edit_amount_khr_exp"];
   $v_company = $_POST["edit_company_exp"];
   $v_branch = $_POST["edit_branch_exp"];
   $v_department = $_POST["edit_department_exp"];
   $v_ref = $_POST["edit_ref_exp"];
   $v_inv = $_POST["edit_inv_exp"];
   $v_note = $_POST["edit_note_exp"];

   $sql = "UPDATE pettycash_exp SET pe_exp_no = '$v_exp_no', 
                                pe_amount_usd = '$v_amount_usd', 
                                pe_amount_khr = '$v_amount_khr', 
                                pe_ref = '$v_ref', 
                                pe_invoice_no = '$v_inv', 
                                pe_note = '$v_note',
                                pe_company_id = '$v_company', 
                                pe_branch_id = '$v_branch', 
                                pe_department_id = '$v_department' WHERE pe_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:pettycash_mgt.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM pettycash_add WHERE pa_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: pettycash_mgt.php?message=delete");
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
               Petty Cash Management
            </h1>

         </section>

         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <table style="width:50%; margin-bottom: 20px; margin-left: 20px;">
                           <tr>
                              <td style="width:15%;">Petty Cash Add:</td>
                              <td style="width:10%;">
                                 USD
                                 <?php
                                 $sql_add = "SELECT SUM(pa_amount_usd) AS sumaddusd FROM pettycash_add
                                                  ";
                                 $result_add = $connect->query($sql_add);
                                 $row_add = $result_add->fetch_assoc();
                                 $amount_add_usd = $row_add["sumaddusd"];
                                 echo $amount_add_usd;
                                 ?>
                              </td>
                              <td style="width:10%;">
                                 KHR
                                 <?php
                                 $sql_add = "SELECT SUM(pa_amount_khr) AS sumaddkhr FROM pettycash_add
                                                  ";
                                 $result_add = $connect->query($sql_add);
                                 $row_add = $result_add->fetch_assoc();
                                 $amount_add_khr = $row_add["sumaddkhr"];
                                 echo $amount_add_khr;
                                 ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="width:15%;">Petty Cash Expense: </td>
                              <td style="width:10%;">
                                 USD
                                 <?php
                                 $sql_add = "SELECT SUM(pe_amount_usd) AS sumaddusd FROM pettycash_exp 
                                                    ";
                                 $result_add = $connect->query($sql_add);
                                 $row_add = $result_add->fetch_assoc();
                                 $amount_exp_usd = $row_add["sumaddusd"];
                                 echo $amount_exp_usd;
                                 ?>
                              </td>
                              <td style="width:10%;">
                                 KHR
                                 <?php
                                 $sql_add = "SELECT SUM(pe_amount_khr) AS sumaddkhr FROM pettycash_exp 
                                                    ";
                                 $result_add = $connect->query($sql_add);
                                 $row_add = $result_add->fetch_assoc();
                                 $amount_exp_khr = $row_add["sumaddkhr"];
                                 echo $amount_exp_khr;
                                 ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="width:15%;">Petty Cash Balance: </td>
                              <td style="width:10%;">
                                 <b>
                                    USD
                                    <?php
                                    $balance_usd = $amount_add_usd - $amount_exp_usd;
                                    echo number_format($balance_usd, 2);
                                    ?>
                                 </b>
                              </td>
                              <td style="width:10%;">
                                 <b>
                                    KHR
                                    <?php
                                    $balance_khr = $amount_add_khr - $amount_exp_khr;
                                    echo $balance_khr;
                                    ?>
                                 </b>
                              </td>
                           </tr>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Cash Add</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-12">
                                             <label>Cash Add No:</label>
                                             <select class="form-control" id="txt_add_no" name="txt_add_no">
                                                <option value="" disabled selected> Please select Reference</option>
                                                <?php
                                                $sql = 'SELECT * FROM pettycash_request WHERE pc_status_id = 3 ';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['pc_id'] . '">' . $row['pc_pcr_no'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>

                                          <p id="amount_data"></p>

                                          <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                             <label>Reference No:</label>
                                             <input class="form-control" id="txt_ref" name="txt_ref" type="text">
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
                        <div class="modal fade" id="myModalexp" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Cash Expense</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-6">
                                             <label>Expense No:</label>
                                             <input class="form-control" id="txt_exp_no" name="txt_exp_no" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Reference No:</label>
                                             <input class="form-control" id="txt_ref_exp" name="txt_ref_exp" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount USD:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="txt_amount_usd_exp" name="txt_amount_usd_exp" type="number" step="0.01" required>
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount KHR:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">៛</div>
                                                <input class="form-control" id="txt_amount_khr_exp" name="txt_amount_khr_exp" type="number" step="100" required>
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Company Name:</label>
                                             <select class="form-control" id="txt_company_exp" name="txt_company_exp" required="required">
                                                <option disabled selected>Please Select Company</option>
                                                <?php
                                                $sql = 'SELECT * FROM company';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Branch Name:</label>
                                             <select class="form-control" id="txt_branch_exp" name="txt_branch_exp" required="required">
                                                <option disabled selected>Please Select Branch</option>
                                                <?php
                                                $sql = 'SELECT * FROM user_branch';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Department Name:</label>
                                             <select class="form-control" id="txt_department_exp" name="txt_department_exp" required="required">
                                                <option disabled selected>Please Select Department</option>
                                                <?php
                                                $sql = 'SELECT * FROM department';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Invoice No:</label>
                                             <input class="form-control" id="txt_inv_exp" name="txt_inv_exp" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="txt_note_exp" name="txt_note_exp"></textarea>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btnadd_exp" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
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
                                          <input type="hidden" id="pca_id" name="pca_id" />
                                          <div class="form-group col-xs-12">
                                             <label>Cash Add No:</label>
                                             <select class="form-control" id="edit_add_no" name="edit_add_no" disabled>
                                                <option value="" disabled selected> Please select Reference</option>
                                                <?php
                                                $sql = 'SELECT * FROM pettycash_request';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['pc_id'] . '">' . $row['pc_pcr_no'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount USD:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_amount_usd" name="edit_amount_usd" type="number" step="0.01" required>
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount KHR:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">៛</div>
                                                <input class="form-control" id="edit_amount_khr" name="edit_amount_khr" type="number" step="100" required>
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Company Name:</label>
                                             <select class="form-control" id="edit_company" name="edit_company" required="required">
                                                <option disabled selected>Please Select Company</option>
                                                <?php
                                                $sql = 'SELECT * FROM company';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Branch Name:</label>
                                             <select class="form-control" id="edit_branch" name="edit_branch" required="required">
                                                <option disabled selected>Please Select Branch</option>
                                                <?php
                                                $sql = 'SELECT * FROM user_branch';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Department Name:</label>
                                             <select class="form-control" id="edit_department" name="edit_department" required="required">
                                                <option disabled selected>Please Select Department</option>
                                                <?php
                                                $sql = 'SELECT * FROM department';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Reference No:</label>
                                             <input class="form-control" id="edit_ref" name="edit_ref" type="text">
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
                        <div class="modal fade" id="myModal_update_exp" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="pce_id" name="pce_id" />
                                          <div class="form-group col-xs-6">
                                             <label>Expense No:</label>
                                             <input class="form-control" id="edit_exp_no" name="edit_exp_no" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Reference No:</label>
                                             <input class="form-control" id="edit_ref_exp" name="edit_ref_exp" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount USD:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_amounte_usd_exp" name="edit_amount_usd_exp" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Amount KHR:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">៛</div>
                                                <input class="form-control" id="edit_amounte_khr_exp" name="edit_amount_khr_exp" type="number" step="100">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Company Name:</label>
                                             <select class="form-control" id="edit_company_exp" name="edit_company_exp" required="required">
                                                <option disabled selected>Please Select Company</option>
                                                <?php
                                                $sql = 'SELECT * FROM company';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Branch Name:</label>
                                             <select class="form-control" id="edit_branch_exp" name="edit_branch_exp" required="required">
                                                <option disabled selected>Please Select Branch</option>
                                                <?php
                                                $sql = 'SELECT * FROM user_branch';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Department Name:</label>
                                             <select class="form-control" id="edit_department_exp" name="edit_department_exp" required="required">
                                                <option disabled selected>Please Select Department</option>
                                                <?php
                                                $sql = 'SELECT * FROM department';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Invoice No:</label>
                                             <input class="form-control" id="edit_inv_exp" name="edit_inv_exp" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Note:</label>
                                             <textarea class="form-control" rows="2" id="edit_note_exp" name="edit_note_exp"></textarea>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btnupdate_exp" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>

                              </div>
                           </div>
                        </div>
                        <!-- Modal Update-->

                        <!-- /.box-header -->
                        <div>
                           <div class="col-md-6">
                              <!-- left side -->
                              <h3 class="text-primary">Cash Add</h3>
                              <div class="box-body table-responsive">
                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                                 <table id="info_data" class="table table-bordered table-striped">
                                    <thead>
                                       <tr>
                                          <th>No</th>
                                          <th>Add No</th>
                                          <th>Amount USD</th>
                                          <th>Amount KHR</th>
                                          <th>Date</th>
                                          <th style="width: 110px;">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $sql = "SELECT * FROM pettycash_add LEFT JOIN pettycash_request on pettycash_request.pc_id = pettycash_add.pa_addc_no
                                                                                        LEFT JOIN department on department.de_id = pettycash_add.pa_department_id 
                                                                                        LEFT JOIN user_branch on user_branch.ub_id = pettycash_add.pa_branch_id
                                                                                        LEFT JOIN company on company.c_id = pettycash_add.pa_company_id";
                                       $result = $connect->query($sql);

                                       $i = 1;
                                       while ($row = $result->fetch_assoc()) {
                                          $v_i = $i++;
                                          $v_addc_no = $row["pc_pcr_no"];
                                          $v_amount_usd = $row["pa_amount_usd"];
                                          $v_amount_khr = $row["pa_amount_khr"];
                                          $v_date = $row["pa_date"];
                                       ?>
                                          <tr>
                                             <td><?php echo $v_i; ?></td>
                                             <td><?php echo $v_addc_no; ?></td>
                                             <td><?php echo $v_amount_usd; ?></td>
                                             <td><?php echo $v_amount_khr; ?></td>
                                             <td><?php echo $v_date; ?></td>
                                             <td>
                                                <!-- <a href="edit_pettycash_mgt.php?id=<?php echo $row['pa_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                <a onclick="doUpdate(<?php echo $row['pa_id']; ?>,
                                                        '<?php echo $row['pa_addc_no']; ?>',
                                                        '<?php echo $v_amount_usd; ?>',
                                                        '<?php echo $v_amount_khr; ?>',
                                                        '<?php echo $v_date; ?>',
                                                        '<?php echo $row['pa_company_id'] ?>',
                                                        '<?php echo $row['pa_branch_id'] ?>',
                                                        '<?php echo $row['pa_department_id'] ?>',
                                                        '<?php echo $row['pa_note']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure to delete ?');" href="pettycash_mgt.php?del_id=<?php echo $row['pa_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                             </td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div><!-- /.box-body -->
                           </div>
                           <div class="col-md-6">
                              <!-- left side -->
                              <h3 class="text-primary">Cash Expense</h3>
                              <div class="box-body table-responsive">
                                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalexp" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                                 <table id="info_data1" class="table table-bordered table-striped">
                                    <thead>
                                       <tr>
                                          <th>No</th>
                                          <th>Expense No</th>
                                          <th>Amount USD</th>
                                          <th>Amount KHR</th>
                                          <th>Date</th>
                                          <th>Invocie No</th>
                                          <th style="width: 110px;">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $sql = "SELECT * FROM pettycash_exp LEFT JOIN department on department.de_id = pettycash_exp.pe_department_id 
                                                                                          LEFT JOIN user_branch on user_branch.ub_id = pettycash_exp.pe_branch_id
                                                                                          LEFT JOIN company on company.c_id = pettycash_exp.pe_company_id";
                                       $result = $connect->query($sql);

                                       $i = 1;
                                       while ($row = $result->fetch_assoc()) {
                                          $v_i = $i++;
                                          $v_minc_no = $row["pe_pce_no"];
                                          $v_amount_usd = $row["pe_amount_usd"];
                                          $v_amount_khr = $row["pe_amount_khr"];
                                          $v_date = $row["pe_date"];
                                          $v_invoice_no = $row["pe_invoice_no"];
                                       ?>
                                          <tr>
                                             <td><?php echo $v_i; ?></td>
                                             <td><?php echo $v_minc_no; ?></td>
                                             <td><?php echo $v_amount_usd; ?></td>
                                             <td><?php echo $v_amount_khr; ?></td>
                                             <td><?php echo $v_date; ?></td>
                                             <td><?php echo $v_invoice_no; ?></td>
                                             <td>
                                                <!-- <a href="edit_pettycash_mgt.php?id=<?php echo $row['pe_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                <a onclick="doUpdateexp(<?php echo $row['pe_id']; ?>,
                                                        '<?php echo $v_minc_no; ?>',
                                                        '<?php echo $v_amount_usd; ?>',
                                                        '<?php echo $v_amount_khr; ?>',
                                                        '<?php echo $v_date; ?>',
                                                        '<?php echo $v_invoice_no; ?>',
                                                        '<?php echo $row['pe_company_id'] ?>',
                                                        '<?php echo $row['pe_branch_id'] ?>',
                                                        '<?php echo $row['pe_department_id'] ?>',
                                                        '<?php echo $row['pe_note'] ?>')" data-toggle="modal" data-target="#myModal_update_exp" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure to delete ?');" href="pettycash_mgt.php?del_id=<?php echo $row['pe_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                             </td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div><!-- /.box-body -->
                           </div>
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
      function doUpdate(id, adds_no, amount_usd, amount_khr, date, company, branch, department, note) {

         $('#pca_id').val(id);
         $('#edit_add_no').val(adds_no).change();
         $('#edit_amount_usd').val(amount_usd);
         $('#edit_amount_khr').val(amount_khr);
         $('#edit_ref').val(date);
         $('#edit_company').val(company).change();
         $('#edit_branch').val(branch).change();
         $('#edit_department').val(department).change();
         $('#edit_note').val(note);
      }

      function doUpdateexp(id, exp_no, amount_usd, amount_khr, date, inv_no, company, branch, department, note) {

         $('#pce_id').val(id);
         $('#edit_exp_no').val(exp_no);
         $('#edit_amounte_usd_exp').val(amount_usd);
         $('#edit_amounte_khr_exp').val(amount_khr);
         $('#edit_ref_exp').val(date);
         $('#edit_inv_exp').val(inv_no);
         $('#edit_company_exp').val(company).change();
         $('#edit_branch_exp').val(branch).change();
         $('#edit_department_exp').val(department).change();
         $('#edit_note_exp').val(note);
      }

      $('#txt_add_no').change(function() {
         $('.show_hid').css("visibility", "visible");
         var add_no = $("#txt_add_no").val();
         // alert(add_no);
         if (add_no) {
            $.ajax({
               type: 'POST',
               url: 'fetch_data.php',
               data: {
                  'id': add_no
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("#menu_pc_manage").addClass("active");
         $("#pc_mgt").addClass("active");
         $("#pc_mgt").css("background-color", "##367fa9");

         $('#info_data').dataTable();
         $('#info_data1').dataTable();
      });
   </script>
</body>

</html>