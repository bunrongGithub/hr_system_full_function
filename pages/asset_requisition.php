<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "DELETE FROM asset_requisiton where as_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:asset_requisition.php?message=delete'));
}
if (isset($_POST['btnadd'])) {
   $v_pa_no = $_POST['pa_no'];
   $v_asset_type = $_POST['asset_type'];
   $v_description = $_POST['description'];
   $v_qty = $_POST['qty'];
   $v_unit_price = $_POST['unit_price'];
   $v_as_total_amount = $_POST['total_amount'];
   $v_use_by = $_POST['use_by'];
   $v_note = $_POST['note'];
   $v_date_requisition = $_POST['date_requisition'];

   $sql = "INSERT INTO asset_requisiton (
                                 as_pa_no
                                 , as_asset_type_id
                                 , as_description
                                 , as_qty
                                 , as_unit_price
                                 , as_total_amount
                                 , as_use_by_id
                                 , as_note
                                 , as_date_requisition
                                 , created_date
                                    )VALUES (
                                       '$v_pa_no'
                                       ,'$v_asset_type'
                                       ,'$v_description'
                                       ,'$v_qty'
                                       ,'$v_unit_price'
                                       ,'$v_as_total_amount'
                                       ,'$v_use_by'
                                       ,'$v_note'
                                       ,'$v_date_requisition'
                                       ,'$datetime'
                                    )";
   $result = mysqli_query($connect, $sql);
   header('location: asset_requisition.php?message=success');
}
if (isset($_POST['btn_update'])) {
   $v_as_id_update = $_POST['as_id_update'];
   $v_as_pa_no_update = $_POST['pa_na_update'];
   $v_as_asset_type_id_update = $_POST['asset_type_update'];
   $v_as_description_update = $_POST['descriptio_update'];
   $v_as_qty_update = $_POST['qty_update'];
   $v_as_unit_price_update = $_POST['unit_price_update'];
   $v_as_total_amount_update = $_POST['total_amount_update'];
   $v_as_date_requisition_update = $_POST['as_date_update'];
   $v_as_use_by_update = $_POST['as_use_by'];
   $v_as_status_update = $_POST['status_update'];
   $v_as_company_update = $_POST['company_update'];
   $v_as_branch_update = $_POST['branch_update'];
   $v_department_update = $_POST['department_update'];
   $v_note_update = $_POST['note_update'];
   $v_user_update = $_POST['user_update'];
   $sql = "UPDATE asset_requisiton SET as_pa_no = '$v_as_pa_no_update'
                                       , as_asset_type_id = '$v_as_asset_type_id_update'
                                       , as_description = '$v_as_description_update'
                                       , as_qty = '$v_as_qty_update'
                                       , as_unit_price = '$v_as_unit_price_update'
                                       , as_total_amount = '$v_as_total_amount_update'
                                       , as_date_requisition = '$v_as_date_requisition_update'
                                       , as_use_by_id = '$v_as_use_by_update'
                                       , as_status_id = '$v_as_status_update'
                                       , as_company_id = '$v_as_company_update'
                                       , as_branch_id = '$v_as_branch_update'
                                       , as_department_id = '$v_department_update'
                                       , as_note = '$v_note_update'
                                       , as_user_id = '$v_user_update'
                                       , updated_date = '$datetime' WHERE as_id = '$v_as_id_update'";
   mysqli_query($connect, $sql);
   header('location:asset_requisition.php?message=update');
   exit();
}
if (isset($_POST['update_status'])) {
   $v_as_id_status = $_POST['as_id_status'];
   $v_status_update = $_POST['as_status_update'];

   $sql = "UPDATE asset_requisiton SET as_status_id = '$v_status_update' WHERE as_id = '$v_as_id_status'";
   mysqli_query($connect, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">

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

<body id="body" class="skin-black">
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
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
            <h1 class="text-primary">Asset Requisition</h1>
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</button>
         </section>
         <section>
            <div class="row">
               <!-- modal add New -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i>Add New</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group col-xs-6">
                                       <label for="pa_no">PA No:</label>
                                       <input class="form-control" type="text" name="pa_no" id="pa_no">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="asset_type">Asset Type:</label>
                                       <select class="form-control select2" name="asset_type" id="asset_type">
                                          <option value="">==== Select ====</option>
                                          <?php
                                          $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                          ?>
                                             <option value="<?php echo $row['acct_id']; ?>"><?php echo $row['acct_name']; ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="description">Description:</label>
                                       <input class="form-control" type="text" name="description" id="description">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="qty">Qty:</label>
                                       <input class="form-control" type="text" name="qty" id="qty">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="unit_price">Unit Price</label>
                                       <input class="form-control" type="text" name="unit_price" id="unit_price" placeholder="$">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="total_amount">Total Amount:</label>
                                       <input class="form-control " type="text" name="total_amount" id="total_amount" placeholder="$">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="use_by">Use By:</label>
                                       <select class="form-control select2" name="use_by" id="use_by">
                                          <option value="">==== Select ====</option>
                                          <?php
                                          $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_id ASC");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                          ?>
                                             <option value="<?= $row['de_id'] ?>"><?= $row['de_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="date_requisition">Date Requisition:</label>
                                       <input class="form-control" type="date" name="date_requisition" id="date_requisition">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="note">Noted:</label>
                                       <textarea name="note" id="note" rows="2" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="modal-footer">
                                       <button name="btnadd" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>&nbsp;Save</button>
                                       <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>

                     </div>
                  </div>
               </div>
               <!-- end modal add new  -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="table_asset_requisition" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th class="text-center">No.</th>
                                 <th class="text-center">PA No</th>
                                 <th class="text-center">Asset Type</th>
                                 <th class="text-center">Description</th>
                                 <th class="text-center">Qty</th>
                                 <th class="text-center">Unit Price</th>
                                 <th class="text-center">Total Amount</th>
                                 <th class="text-center">Use By</th>
                                 <th class="text-center">Date Requisition</th>
                                 <th class="text-center">Status</th>
                                 <th class="text-center" style="width: 100px;">Noted</th>
                                 <th class="text-center">Company</th>
                                 <th class="text-center" style="width:160px"><i class="fa fa-cog"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM asset_requisiton A
                                                LEFT JOIN user B ON B.id = A.as_user_id
                                                LEFT JOIN text_asset_req_status C ON C.ars_id = A.as_status_id
                                                LEFT JOIN company D ON D.c_id = A.as_company_id
                                                LEFT JOIN user_branch E ON E.ub_id = A.as_branch_id
                                                LEFT JOIN department F on F.de_id = A.as_department_id
                                                LEFT JOIN text_asset_code_creation_type G ON G.acct_id = A.as_asset_type_id";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_1 = $i++;
                                 $v_as_id = $row['as_id'];
                                 $v_as_pa_no = $row['as_pa_no'];
                                 $v_as_asset_type_id = $row['acct_name'];
                                 $v_as_description = $row['as_description'];
                                 $v_as_qty = $row['as_qty'];
                                 $v_as_unit_price = $row['as_unit_price'];
                                 $v_as_total_amount = $row['as_total_amount'];
                                 $v_as_user_id = $row['username'];
                                 $v_as_date_requisition = $row['as_date_requisition'];
                                 $v_as_status_id = $row['ars_name'];
                                 $v_as_company_id = $row['c_name_kh'];
                                 $v_as_branch_id = $row['ub_name'];
                                 $v_as_noted = $row['as_note'];
                                 $v_as_department_id = $row['de_name'];
                                 $v_use_by_department = $row['as_use_by_id'];
                                 $v_as_total_amount = $v_as_qty * $v_as_unit_price;
                              ?>
                                 <tr>
                                    <td class="text-center"><?= $v_as_id; ?></td>
                                    <td class="text-center"><?= $v_as_pa_no; ?></td>
                                    <td class="text-center"><?= $v_as_asset_type_id; ?></td>
                                    <td class="text-center"><?= $v_as_description; ?></td>
                                    <td class="text-center"><?= $v_as_qty; ?></td>
                                    <td class="text-center"><?= $v_as_unit_price; ?>$</td>
                                    <td class="text-center"><?= $v_as_total_amount; ?>$</td>
                                    <td class="text-center">
                                       <?php
                                       $v_use_by_department = @$row['as_use_by_id'];
                                       $sql_use_by = "SELECT * FROM department WHERE de_id = '$v_use_by_department'";
                                       $result_use_by = $connect->query($sql_use_by);
                                       $row_use_by = $result_use_by->fetch_assoc();
                                       $v_use_by_show = @$row_use_by['de_name'];
                                       echo @$v_use_by_show;
                                       ?>
                                    </td>
                                    <td class="text-center"><?= $v_as_date_requisition; ?></td>
                                    <td class="text-center">
                                       <?= $v_as_status_id; ?><br>
                                       <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_status<?= $row['as_id']; ?>"><i class="fa fa-check"></i>Answer</a>
                                    </td>
                                    <td><?= $v_as_noted; ?></td>
                                    <td>
                                       <span><i>Company: </i></span>
                                       <?= $v_as_company_id; ?><br>
                                       <span><i>Branch: </i></span>
                                       <?= $v_as_branch_id; ?>
                                       <br>
                                       <span><i>Department: </i></span>
                                       <?= $v_as_department_id; ?><br>
                                       <span><i>User:</i></span>
                                       <?= $v_as_user_id; ?>

                                    </td>
                                    <td class="text-center">
                                       <a onclick="doUpdate(<?= $row['as_id']; ?>);" data-toggle="modal" data-target="#exampleModal<?= $row['as_id']; ?>" class="btn btn-info btn-sm">
                                          <i class="fa fa-eye"></i>
                                       </a>
                                       <a onclick="doUpdate(<?= $row['as_id']; ?>" data-toggle="modal" data-target="#exampleModal<?= $row['as_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                       <a href="asset_requisition_print.php?id=<?php echo $row['as_id']; ?>" class="btn btn-success btn-sm btn_do_print" ><i class="fa fa-print"></i></a>
                                       <a onclick="return confirm('Are you sure delete?')" href="asset_requisition.php?id=<?= $row['as_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <!-- modal_status -->
                                 <div class="modal fade" id="modal_status<?= $row['as_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Update Status</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="as_id_status" id="" value="<?= $row['as_id'] ?>">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="form-group col-xs-12">
                                                         <label for="as_status_update">Status:</label>
                                                         <select class="form-control select2" name="as_status_update" id="as_status_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_asset_req_status ORDER BY ars_name");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_status_id'] == $row_se['ars_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['ars_id']; ?>"><?php echo $row_se['ars_name'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['ars_id']; ?>"><?php echo $row_se['ars_name'] ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                      <div class="modal-footer">
                                                         <button type="submit" name="update_status" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                                                         <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end_modal_status -->
                                 <!-- modal_update -->
                                 <div class="modal fade" id="exampleModal<?= $row['as_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary " id="exampleModalLabel"><i class="fa fa-edit fa-fw"></i>Edit Asset Requisition</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" value="<?= $row['as_id']; ?>" name="as_id_update">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="form-group col-xs-6">
                                                         <label for="pa_na_update">PA No:</label>
                                                         <input class="form-control" value="<?= $row['as_pa_no'] ?>" type="text" name="pa_na_update" id="pa_na_update">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="asset_type_update">Asset Type:</label>
                                                         <select class="form-control select2" name="asset_type_update" id="asset_type_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_asset_type_id'] == $row_se['acct_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['acct_id'] ?>"><?= $row_se['acct_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['acct_id'] ?>"><?= $row_se['acct_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="descriptio_update">Description:</label>
                                                         <input class="form-control" value="<?= $row['as_description'] ?>" type="text" name="descriptio_update" id="descriptio_update">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="qty_update">Qty:</label>
                                                         <input class="form-control input_field" type="number" name="qty_update" id="qty_update" value="<?= $row['as_qty']; ?>">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="unit_price_update">Unit Price:</label>
                                                         <input class="form-control input_field" value="<?= $row['as_unit_price']; ?>" type="number" name="unit_price_update" id="unit_price_update">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="total_amount_update">Total Amount:</label>
                                                         <input class="form-control input_field" value="<?= $row['as_total_amount'] ?>" type="number" name="total_amount_update" id="total_amount_update">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="as_date_update">Date Requisition:</label>
                                                         <input class="form-control" value="<?= $row['as_date_requisition'] ?>" type="date" name="as_date_update" id="as_date_update">
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="as_use_by">Use By:</label>
                                                         <select class="form-control select2" name="as_use_by" id="as_use_by">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_use_by_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="status_update">Status:</label>
                                                         <select class="form-control select2" name="status_update" id="status_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_asset_req_status ORDER BY ars_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_status_id'] == $row_se['ars_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['ars_id'] ?>"><?= $row_se['ars_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['ars_id'] ?>"><?= $row_se['ars_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="company_update">Company:</label>
                                                         <select class="form-control select2" name="company_update" id="company_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_company_id'] == $row_se['c_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['c_id'] ?>"><?= $row_se['c_name_kh']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['c_id'] ?>"><?= $row_se['c_name_kh']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="branch_update">Branch:</label>
                                                         <select class="form-control select2" name="branch_update" id="branch_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_branch_id'] == $row_se['ub_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['ub_id'] ?>"><?= $row_se['ub_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['ub_id'] ?>"><?= $row_se['ub_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="department_update">Department:</label>
                                                         <select class="form-control select2" name="department_update" id="department_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_department_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['de_id'] ?>"><?= $row_se['de_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-6">
                                                         <label for="department_update">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user_update">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['as_user_id'] == $row_se['id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['id'] ?>"><?= $row_se['username']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['id'] ?>"><?= $row_se['username']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                      <div class="form-group col-xs-12">
                                                         <label for="note_update">Note:</label>
                                                         <textarea class="form-control" name="note_update" id="note_update" rows="2"><?= $row['as_note'] ?></textarea>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                      <div class="modal-footer">
                                                         <button type="submit" name="btn_update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
                                                         <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end modal_update -->
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

   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script type="text/javascript">
      function doUpdate(id, name, note) {
         $('#position_id').val(id);
         $('#edit_name').val(name);
         $('#edit_note').val(note);
      }
      $(function() {
         $("#menu_admin").addClass("active");
         $("#asset_re").addClass("active");
         $("#asset_re").css("background-color", "##367fa9");
         $('#table_asset_requisition').dataTable();
      });
      const qty = document.getElementById("qty");
      const unit_price = document.getElementById("unit_price");
      const total_amount = document.getElementById("total_amount");
      qty.addEventListener('input', calculateTotal);
      unit_price.addEventListener('input', calculateTotal);

      function calculateTotal() {
         total_amount.value = qty.value * unit_price.value;
      }
      const qtyUpdate = document.getElementById("qty_update");
      const unit_priceUpdate = document.getElementById("unit_price_update");
      const totalAmountUpdate = document.getElementById("total_amount_update");

      qtyUpdate.addEventListener('input', removeValue());
      unit_priceUpdate.addEventListener('input', removeValue());

      function removeValue() {
         qtyUpdate.value === "" && unit_priceUpdate.value !== "" ? totalAmountUpdate.value = "" : "";
      }
      qtyUpdate.addEventListener("input", UpdateTotalAmount);
      unit_priceUpdate.addEventListener("input", UpdateTotalAmount);

      function UpdateTotalAmount() {
         const valueQty = qtyUpdate.value;
         const valueUnite_price = unit_priceUpdate.value;
         totalAmountUpdate.value = valueQty * valueUnite_price;
      }

      function printPage(id) {
         var table = document.createElement("table");
         var row = table.insertRow();
         var cell1 = row.insertCell();
         cell1.textContent = id;
         var tableContainer = document.getElementById("datatable");
         tableContainer.appendChild(table);
         window.print(tableContainer);
         document.getElementById("body").innerHTML;
         var body = document.getElementById("dataPrint").innerHTML;
      }
   </script>
</body>
</html>