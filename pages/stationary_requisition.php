<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');
if (isset($_POST['btnadd'])) {
   $v_ps_no = $_POST['ps_no'];
   $v_use_by = $_POST['use_bu'];
   $v_stationary_type = $_POST['stationary_type'];
   $v_stationary_code = $_POST['stationary_code'];
   $v_description = $_POST['description'];
   $v_date = $_POST['date'];
   $v_qty = $_POST['qty'];
   $v_unit_price = $_POST['unit_price'];
   $v_total_amount = $_POST['total_amount'];
   $v_noted = $_POST['noted'];
   $sql = "INSERT INTO stationary_requisition (sr_ps_no
                              , sr_use_by
                              , sr_sationary_type_id
                              , sr_stationary_code_id
                              , sr_description
                              , sr_date
                              , sr_qty
                              , sr_unit_price
                              , sr_amount
                              , sr_note
                              , created_at
                                 ) VALUES ('$v_ps_no'
                                 , '$v_use_by'
                                 , '$v_stationary_type'
                                 , '$v_stationary_code'
                                 , '$v_description'
                                 , '$v_date'
                                 , '$v_qty'
                                 , '$v_unit_price'
                                 , '$v_total_amount'
                                 , '$v_noted'
                                 , '$datetime')";
   $result = mysqli_query($connect, $sql);
   header('location:stationary_requisition.php?message=success');
   exit();
}
if (isset($_POST['btnUpdate'])) {
   $v_id_update = $_POST['sr_id_update'];
   $v_ps_no_update = $_POST['ps_no_update'];
   $v_stationary_code_update = $_POST['stationary_code_update'];
   $v_stationary_type_update = $_POST['stationary_type_update'];
   $v_description_update = $_POST['description_update'];
   $v_qty_update = $_POST['qty_update'];
   $v_unit_price_update = $_POST['unit_price_update'];
   $v_total_amount_update = $_POST['total_amount_update'];
   $v_date_update = $_POST['date_update'];
   $v_use_by_update = $_POST['use_by_update'];

   $v_company_update = $_POST['company_update'];

   $v_branch_update = $_POST['branch_update'];

   $v_department_update = $_POST['department_update'];

   $v_user_update = $_POST['user_update'];
   $v_noted_update = $_POST['noted_update'];

   $sql = "UPDATE stationary_requisition SET sr_ps_no = '$v_ps_no_update'
                                             , sr_stationary_code_id = '$v_stationary_code_update'
                                             , sr_sationary_type_id = '$v_stationary_type_update'
                                             , sr_description = '$v_description_update'
                                             , sr_qty = '$v_qty_update'
                                             , sr_unit_price = '$v_unit_price_update'
                                             , sr_amount = '$v_total_amount_update'
                                             , sr_date = '$v_date_update'
                                             , sr_use_by = '$v_use_by_update'
                                             , sr_company_id = '$v_company_update'
                                             , sr_branch_id = '$v_branch_update'
                                             , sr_department_id = '$v_department_update'
                                             , sr_user_id = '$v_user_update'
                                             , sr_note = '$v_noted_update'
                                             ,updated_at = '$datetime' WHERE sr_id = '$v_id_update'";
   mysqli_query($connect, $sql);
   header('location:stationary_requisition.php?message=update');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
<body class="skin-black">
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php
      include('left_menu.php')
      ?>
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
            echo '<h4>Success delete data.</h4>';
            echo '</div>';
         }
         ?>

         <section class="content-header">
            <h1 class="text-primary">Stationary Requisition</h1>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</button>
         </section>
         <section>
            <div class="row">
               <!-- modal_add_new -->
               <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-primary " id="exampleModalLabel"><i class="fa fa-plus-square-o"></i>Add New</h3>
                        </div>
                        <div class="modal-body">
                           <form action="" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group col-xs-6">
                                       <label for="ps_no">PS No:</label>
                                       <input class="form-control" type="text" name="ps_no" id="ps_no">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="use_by">Use By:</label>
                                       <select class="form-control select2" name="use_bu" id="use_by">
                                          <option value="">==== Select ====</option>
                                          <?php
                                          $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                          ?>
                                             <option value="<?php echo $row['de_id'] ?>"><?php echo $row['de_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="stationary_type">Stationary Type:</label>
                                       <select class="form-control select2" name="stationary_type" id="stationary_type">
                                          <option value="">==== Select ====</option>
                                          <?php
                                          $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type ORDER BY st_name ASC");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                          ?>
                                             <option value="<?php echo $row['st_id'] ?>"><?php echo $row['st_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="stationary_code">Stationary Code:</label>
                                       <select class="form-control select2" name="stationary_code" id="stationary_code">
                                          <option value="">==== Select ====</option>
                                          <?php
                                          $v_select = mysqli_query($connect, "SELECT * FROM stationary_code ORDER BY sc_stationary_code ASC");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                          ?>
                                             <option value="<?php echo $row['sc_id'] ?>"><?php echo $row['sc_stationary_code'] ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="from-group col-xs-6">
                                       <label for="description">Description:</label>
                                       <input class="form-control" type="text" name="description" id="description">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="date">Date Requisition:</label>
                                       <input class="form-control" type="date" name="date" id="date">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="qty">Qty:</label>
                                       <input class="form-control" type="text" name="qty" id="qty">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="unit_price">Unit Price:</label>
                                       <input class="form-control" type="text" name="unit_price" id="unit_price" placeholder="$">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="total_amount">Total Amount:</label>
                                       <input class="form-control" type="text" name="total_amount" id="total_amount" placeholder="$">
                                    </div>
                                    <div class="form-group col-xs-12">
                                       <label for="noted">Noted</label>
                                       <textarea class="form-control" name="noted" id="noted" rows="2"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="modal-footer">
                                       <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                                       <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-trash fa-fw"></i> Close</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end_modal_new -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="table_stationary_requisition" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th class="text-center">No.</th>
                                 <th class="text-center">PS No</th>
                                 <th class="text-center">Stationary Code</th>
                                 <th class="text-center">Stationary Type</th>
                                 <th class="text-center">Description</th>
                                 <th class="text-center">Qty</th>
                                 <th class="text-center">Unit Price</th>
                                 <th class="text-center">Total Amount</th>
                                 <th class="text-center">Date Requisition</th>
                                 <th class="text-center">Noted</th>
                                 <th class="text-center">Used By</th>
                                 <th class="text-center">Company</th>
                                 <th class="text-center" style="width: 170px;"><i class="fa fa-cog"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM stationary_requisition A
                                          LEFT JOIN text_stationary_type B ON B.st_id = A.sr_sationary_type_id
                                          LEFT JOIN company C ON C.c_id = A.sr_company_id
                                          LEFT JOIN user_branch D ON D.ub_id = A.sr_branch_id
                                          LEFT JOIN department E ON E.de_id = A.sr_department_id
                                          LEFT JOIN user F ON F.id = A.sr_user_id
                                          LEFT JOIN stationary_code G ON G.sc_id = A.sr_stationary_code_id";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_ps_no = $row['sr_ps_no'];
                                 $v_stationary_code_id = $row['sc_stationary_code'];
                                 $v_stationary_type_id = $row['st_name'];
                                 $v_description = $row['sr_description'];
                                 $v_qty = $row['sr_qty'];
                                 $v_unit_price = $row['sr_unit_price'];
                                 $v_total_amount = $row['sr_amount'];
                                 $v_date_requisition = $row['sr_date'];
                                 $v_noted = $row['sr_note'];
                                 $v_use_by = $row['sr_use_by'];
                                 $v_company_id = $row['c_name_kh'];
                                 $v_branch_id = $row['ub_name'];
                                 $v_department_id = $row['de_name'];
                                 $v_user_id = $row['username'];
                                 $v_total_amount = $v_qty * $v_unit_price;
                              ?>
                                 <tr>
                                    <td class="text-center"><?php echo $v_i; ?></td>
                                    <td class="text-center"><?php echo $v_ps_no; ?></td>
                                    <td class="text-center"><?php echo $v_stationary_code_id; ?></td>
                                    <td class="text-center"><?php echo $v_stationary_type_id; ?></td>
                                    <td class="text-center"><?php echo $v_description; ?></td>
                                    <td class="text-center"><?php echo $v_qty; ?></td>
                                    <td class="text-center"><?php echo $v_unit_price; ?>$</td>
                                    <td class="text-center"><?php echo $v_total_amount; ?>$</td>
                                    <td class="text-center"><?php echo $v_date_requisition; ?></td>
                                    <td class="text-center"><?php echo $v_noted; ?></td>
                                    <td class="text-center">
                                       <?php
                                       $v_use_by = @$row['sr_use_by'];
                                       $sql_use_by = "SELECT * FROM department WHERE de_id = '$v_use_by'";
                                       $sql_result = $connect->query($sql_use_by);
                                       $row_use_by = $sql_result->fetch_assoc();
                                       $v_use_by_show = @$row_use_by['de_name'];
                                       echo $v_use_by_show;
                                       ?>
                                    </td>
                                    <td>
                                       <span><i>Company: </i></span>
                                       <?php echo $v_company_id; ?><br>
                                       <span><i>Branch: </i></span>
                                       <?php echo $v_branch_id; ?><br>
                                       <span><i>Department: </i></span>
                                       <?php echo $v_department_id; ?><br>
                                       <span><i>User: </i></span>
                                       <?php echo $v_user_id; ?>
                                    </td>
                                    <td class="text-center">
                                       <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_view<?= $row['sr_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                       <a href="" onclick="doUpdate(<?= $row['sr_id'] ?>);" data-toggle="modal" data-target="#modalUpdate<?= $row['sr_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                       <a href="stationary_requisition_print.php?Id=<?php echo $row['sr_id'] ?>" class="btn btn-sm btn-success print-button"><i class="fa fa-print"></i></a>
                                       <a href="" class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <!-- modal_view -->
                                 <div class="modal fade" id="modal_view<?= $row['sr_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit fa-fw"></i>View Stationary Requisition</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" enctype="multipart/form-data" method="post">
                                                <input type="hidden" name="sr_id_update" value="<?= $row['sr_id']; ?>" id="">
                                                <div class="row">
                                                   <div class=" form-group col-md-12">
                                                      <div class=" form-group col-xs-6">
                                                         <label for="ps_no">PS No:</label>
                                                         <input class="form-control" type="text" name="ps_no_update" id="ps_no" value="<?= $row['sr_ps_no']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="stationary_code">Stationary Code:</label>
                                                         <select class="form-control select2" name="stationary_code_update" id="stationary_code">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM stationary_code ORDER BY sc_stationary_code ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_stationary_code_id'] == $row_se['sc_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['sc_id'] ?>"><?php echo $row_se['sc_stationary_code'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['sc_id'] ?>"><?php echo $row_se['sc_stationary_code'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="stationary_type">Stationary Type:</label>
                                                         <select class="form-control select2" name="stationary_type_update" id="stationary_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type ORDER BY st_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_sationary_type_id'] == $row_se['st_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['st_id'] ?>"><?php echo $row_se['st_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['st_id'] ?>"><?php echo $row_se['st_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="description">Description:</label>
                                                         <input class="form-control" type="text" name="description_update" id="description" value="<?= $row['sr_description']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="qty">Qty:</label>
                                                         <input class="form-control" type="text" name="qty_update" id="qty" value="<?= $row['sr_qty']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="unit_price">Unit Price:</label>
                                                         <input class="form-control" type="text" name="unit_price_update" id="unit_price" value="<?= $row['sr_unit_price'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="total_amount">total_amount:</label>
                                                         <input class="form-control" type="text" name="total_amount_update" id="total_amount" value="<?= $row['sr_amount'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="date">Date Requisition:</label>
                                                         <input class="form-control" type="date" name="date_update" id="date" value="<?= $row['sr_date'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="use_by">Use By:</label>
                                                         <select class="form-control select2" name="use_by_update" id="use_by">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_use_by'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="company">Company:</label>
                                                         <select class="form-control select2" name="company_update" id="company">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_company_id'] == $row_se['c_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['c_id'] ?>"><?= $row_se['c_name_kh'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['c_id'] ?>"><?php echo $row_se['c_name_kh'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="branch">Branch:</label>
                                                         <select class="form-control select2" name="branch_update" id="branch">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_branch_id'] == $row_se['ub_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['ub_id'] ?>"><?= $row_se['ub_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['ub_id'] ?>"><?php echo $row_se['ub_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="department">Department:</label>
                                                         <select class="form-control select2" name="department_update" id="department">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_department_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_user_id'] == $row_se['id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['id'] ?>"><?= $row_se['username'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['id'] ?>"><?php echo $row_se['username'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="col-xs-12 form-group">
                                                         <label for="noted">Noted:</label>
                                                         <textarea name="noted_update" id="noted" class="form-control" rows="2"><?php echo $row['sr_note'] ?></textarea>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer col-md-12">
                                                      <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                                                   </div>
                                                </div>
                                                <div id="datatable"></div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end_modal_view -->
                                 <!-- modal_update -->
                                 <div class="modal fade" id="modalUpdate<?= $row['sr_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit fa-fw"></i>Edit Stationary Requisition</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" enctype="multipart/form-data" method="post">
                                                <input type="hidden" name="sr_id_update" value="<?= $row['sr_id']; ?>" id="">
                                                <div class="row">
                                                   <div class=" form-group col-md-12">
                                                      <div class=" form-group col-xs-6">
                                                         <label for="ps_no">PS No:</label>
                                                         <input class="form-control" type="text" name="ps_no_update" id="ps_no" value="<?= $row['sr_ps_no']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="stationary_code">Stationary Code:</label>
                                                         <select class="form-control select2" name="stationary_code_update" id="stationary_code">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM stationary_code ORDER BY sc_stationary_code ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_stationary_code_id'] == $row_se['sc_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['sc_id'] ?>"><?php echo $row_se['sc_stationary_code'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['sc_id'] ?>"><?php echo $row_se['sc_stationary_code'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="stationary_type">Stationary Type:</label>
                                                         <select class="form-control select2" name="stationary_type_update" id="stationary_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type ORDER BY st_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_sationary_type_id'] == $row_se['st_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['st_id'] ?>"><?php echo $row_se['st_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['st_id'] ?>"><?php echo $row_se['st_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="description">Description:</label>
                                                         <input class="form-control" type="text" name="description_update" id="description" value="<?= $row['sr_description']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="qty_update">Qty:</label>
                                                         <input class="form-control" type="text" name="qty_update" id="qty_update" value="<?= $row['sr_qty']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="unit_price_update">Unit Price:</label>
                                                         <input class="form-control" type="text" name="unit_price_update" id="unit_price_update" value="<?= $row['sr_unit_price'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="total_amount_update">total_amount:</label>
                                                         <input class="form-control" type="text" name="total_amount_update" id="total_amount_update" value="<?= $row['sr_amount'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="date">Date Requisition:</label>
                                                         <input class="form-control" type="date" name="date_update" id="date" value="<?= $row['sr_date'] ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="use_by">Use By:</label>
                                                         <select class="form-control select2" name="use_by_update" id="use_by">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_use_by'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="company">Company:</label>
                                                         <select class="form-control select2" name="company_update" id="company">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_company_id'] == $row_se['c_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['c_id'] ?>"><?= $row_se['c_name_kh'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['c_id'] ?>"><?php echo $row_se['c_name_kh'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="branch">Branch:</label>
                                                         <select class="form-control select2" name="branch_update" id="branch">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_branch_id'] == $row_se['ub_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['ub_id'] ?>"><?= $row_se['ub_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['ub_id'] ?>"><?php echo $row_se['ub_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="department">Department:</label>
                                                         <select class="form-control select2" name="department_update" id="department">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_department_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['de_id'] ?>"><?php echo $row_se['de_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sr_user_id'] == $row_se['id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['id'] ?>"><?= $row_se['username'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['id'] ?>"><?php echo $row_se['username'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="col-xs-12 form-group">
                                                         <label for="noted">Noted:</label>
                                                         <textarea name="noted_update" id="noted" class="form-control" rows="2"><?php echo $row['sr_note'] ?></textarea>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer col-md-12">
                                                      <button type="submit" name="btnUpdate" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                                                      <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end_modal_update -->
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
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>>

   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script type="text/javascript">
      function doUpdate(id, name, note) {
         $('#position_id').val(id);
         $('#edit_name').val(name);
         $('#edit_note').val(note);
      }
      $(function() {
         $("#menu_admin").addClass("active");
         $("#stationary").addClass("active");
         $("#stationary").css("background-color", "##367fa9");
         $('#table_stationary_requisition').dataTable();
      });
      const qty = document.getElementById("qty");
      const unit_price = document.getElementById("unit_price");
      const total_amount = document.getElementById("total_amount");
      qty.addEventListener('input', calTotal);
      unit_price.addEventListener('input', calTotal);

      function calTotal() {
         total_amount.value = qty.value * unit_price.value;
      }
      // function printPage(id) {
      //    var table = document.createElement("table");
      //    var row = table.insertRow();
      //    var cell1 = row.insertCell();
      //    cell1.textContent = id;
      //    var tableContainer = document.getElementById("datatable");
      //    tableContainer.appendChild(table);
      //    var printWindow = window.open('', '_blank');
      //    printWindow.open=tableContainer;
      //    window.print();
      //    document.getElementById("body").innerHTML;
      //    var body = document.getElementById("dataPrint").innerHTML;
      // }
   </script>
</body>

</html>