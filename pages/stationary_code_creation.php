<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_POST["btnadd"])) {
   $v_stationary_code = $_POST['stationary_code'];
   $v_stationary_type = $_POST['stationary_type'];
   $v_stationary_description1 = $_POST['stationary_description_en'];
   $v_stationary_description2 = $_POST['stationary_description_kh'];
   $v_note_id = $_POST['note_id'];
   $sql = "INSERT INTO stationary_code
                  (sc_stationary_code
                     ,sc_statinary_type_id
                     ,sc_description_en
                     ,sc_description_kh
                     ,sc_node
                     ,created_date
                  )VALUES(
                     '$v_stationary_code'
                     ,'$v_stationary_type'
                     ,'$v_stationary_description1'
                     ,'$v_stationary_description2'
                     ,'$v_note_id'
                     ,'$datetime'
                  )";
   $result = mysqli_query($connect, $sql);
   header('location:stationary_code_creation.php?message=success');
   exit();
}
if(isset($_POST['btnUpdate'])){
   $v_sc_id_update = $_POST['sc_id_update'];
   $v_stationary_code_update = $_POST['stationary_code_update'];
   $v_statinary_type_update = $_POST['stationary_type_update'];
   $v_description_en_update = $_POST['stationary_description1_update'];
   $v_description_kh_update = $_POST['stationary_description2_update'];
   $v_company_update = $_POST['company_update'];
   $v_branch_update = $_POST['branch_update'];
   $v_department_update = $_POST['Department_update'];
   $v_note_update = $_POST['note_update'];
   $v_user_update = $_POST['User_update'];
   $sql = "UPDATE stationary_code SET sc_stationary_code = '$v_stationary_code_update'
                                                   , sc_statinary_type_id = '$v_statinary_type_update'
                                                   , sc_description_en = '$v_description_en_update'
                                                   , sc_description_kh = '$v_description_kh_update'
                                                   , sc_company_id = '$v_company_update'
                                                   , sc_branch_id = '$v_branch_update'
                                                   , sc_department_id = '$v_department_update'
                                                   , sc_user_id = '$v_user_update'
                                                   , sc_node = '$v_note_update'
                                                   , updated_date = '$datetime' WHERE sc_id = '$v_sc_id_update'";
   if(mysqli_query($connect,$sql)){
      echo "Updating seccessfully.";
   }else{
      throw new mysqli_sql_exception(mysqli_errno($connect));
   }
   header('location:stationary_code_creation.php?message=update');
   exit();
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
         }else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
            echo '<div class="alert alert-info">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4>Success Update Data</h4>';
            echo '</div>';
         }
         ?>
         <section class="content-header">
            <h1>Stationary Code Creation</h1>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square-o"></i>Add New</button>
         </section>
         <section>
            <div class="row">
               <!-- modal add new  -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i>Add New </h4>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                       <div class="form-group col-xs-6">
                                          <label for="stationary_code">Stationary Code:</label>
                                          <input class="form-control" type="text" name="stationary_code" id="stationary_code">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="stationary_type">Stationary Type:</label>
                                          <select class="form-control select2" name="stationary_type" id="stationary_type">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type ORDER BY st_name ASC");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?= $row['st_id']; ?>"><?= $row['st_name']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="stationary_description1">Description_en:</label>
                                          <input class="form-control" type="text" name="stationary_description_en" id="stationary_description1">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="stationary_description2">Description_kh:</label>
                                          <input class="form-control" type="text" name="stationary_description_kh" id="stationary_description2">
                                       </div>
                                       <div class="form-group col-xs-12">
                                          <label for="note">Note:</label>
                                          <textarea class="form-control" name="note_id" id="note" rows="2"></textarea>
                                       </div>
                                    </div>
                                    <div class="modal-footer col-md-12">
                                       <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>Save</button>
                                       <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <!-- end modal add new  -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="table_stationary_code_creation" class="table table-bordered table-hover table-striped">
                           <thead>
                              <tr>
                                 <th style="text-align: center;">No.</th>
                                 <th style="text-align: center;">Stationary Code</th>
                                 <th style="text-align: center;">Stationary Type</th>
                                 <th style="text-align: center;">Description_en</th>
                                 <th style="text-align: center;">Description_kh</th>
                                 <th style="text-align: center;width:150px;">Note</th>
                                 <th style="text-align:center;">Company</th>
                                 <th style="text-align: center;width:120px;"><i class="fa fa-cog"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM stationary_code A
                                             LEFT JOIN text_stationary_type B  ON B.st_id = A.sc_statinary_type_id
                                             LEFT JOIN company C ON C.c_id = A.sc_company_id
                                             LEFT JOIN user_branch D ON D.ub_id = A.sc_branch_id
                                             LEFT JOIN department E ON E.de_id = A.sc_department_id
                                             LEFT JOIN user F ON F.id = A.sc_user_id";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_id = $row['sc_id'];
                                 $v_stationary_code = $row['sc_stationary_code'];
                                 $v_statinary_type_id = $row['st_name'];
                                 $v_description_en = $row['sc_description_en'];
                                 $v_description_kh = $row['sc_description_kh'];
                                 $v_note = $row['sc_node'];
                                 $v_company_id = $row['c_name_kh'];
                                 $v_branch_id = $row['ub_name'];
                                 $v_department_id = $row['de_name'];
                                 $v_user_id = $row['username'];
                              ?>
                                 <tr>
                                    <td style="text-align:center;"><?= $v_id; ?></td>
                                    <td style="text-align:center;"><?= $v_stationary_code; ?></td>
                                    <td style="text-align:center;"><?= $v_statinary_type_id; ?></td>
                                    <td style="text-align:center;"><?= $v_description_en; ?></td>
                                    <td style="text-align:center;"><?= $v_description_kh; ?></td>
                                    <td style="text-align:center;"><?= $v_note; ?></td>
                                    <td>
                                       <span><i>Company: </i></span>
                                       <?= $v_company_id; ?><br>
                                       <span><i>Branch: </i></span>
                                       <?= $v_branch_id; ?><br>
                                       <span><i>Department: </i></span>
                                       <?= $v_department_id; ?><br>
                                       <span><i>User: </i></span>
                                       <?= $v_user_id; ?>
                                    </td>
                                    <td>
                                       <a onclick="doUpdate(<?php echo $row['sc_id'];?>)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_view<?= $row['sc_id'];?>">
                                          <i class="fa fa-eye"></i>
                                       </a>
                                       <a onclick="doUpdate(<?php echo $row['sc_id'];?>)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_update<?= $row['sc_id'];?>" >
                                          <i class="fa fa-edit"></i>
                                       </a>
                                       <a onclick="return confirm('Are you sure delete?')" href="stationary_code_creation.php?id=<?php echo $row['sc_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <!-- modal_view -->
                                 <div class="modal fade" id="modal_view<?= $row['sc_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-eye"></i> View Stationary Code Creation</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="sc_id_update" class="form-control" value="<?= $row['sc_id']; ?>" id="">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="stationary_code">Stationary Code:</label>
                                                         <input class="form-control" value="<?= $row['sc_stationary_code']; ?>" type="text" name="stationary_code_update" id="stationary_code">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="stationary_type">Stationary Type:</label>
                                                         <select class="form-control select2" name="stationary_type_update" id="stationary_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type order by st_name asc");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sc_statinary_type_id'] == $row_se['st_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['st_id']; ?>"><?php echo $row_se['st_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['st_id']; ?>"><?php echo $row_se['st_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="stationary_description1">Description_en:</label>
                                                      <input class="form-control" type="text" name="stationary_description1_update" id="stationary_description1" value="<?= $row['sc_description_en']; ?>">
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="stationary_description2">Description_kh:</label>
                                                      <input class="form-control" type="text" name="stationary_description2_update" id="stationary_description2" value="<?= $row['sc_description_kh']; ?>">
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="company">Company:</label>
                                                      <select class="form-control select2" style="width:100%;" name="company_update" id="company">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_company_id'] == $row_se['c_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['c_id']; ?>"><?= $row_se['c_name_kh'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['c_id']; ?>"><?= $row_se['c_name_kh'] ?></option>
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
                                                            if ($row['sc_branch_id'] == $row_se['ub_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['ub_id']; ?>"><?= $row_se['ub_name'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['ub_id']; ?>"><?= $row_se['ub_name'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="Department">Department:</label>
                                                      <select class="form-control select2" name="Department_update" id="Department">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_department_id'] == $row_se['de_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['de_id']; ?>"><?= $row_se['de_name'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['de_id']; ?>"><?= $row_se['de_name'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="User">User:</label>
                                                      <select class="form-control select2" name="User_update" id="User">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_user_id'] == $row_se['id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-12">
                                                      <label for="note">Note:</label>
                                                      <textarea class="form-control" name="note_update" id="note" rows="2"><?= $row['sc_node']; ?></textarea>
                                                   </div>
                                                   <div class="modal-footer col-md-12">
                                                      <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- end_modal_view -->
                                 <!-- modal_update -->
                                 <div class="modal fade" id="modal_update<?= $row['sc_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Edit Stationary Code Creation</h3>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="sc_id_update" class="form-control" value="<?= $row['sc_id']; ?>" id="">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="stationary_code">Stationary Code:</label>
                                                         <input class="form-control" value="<?= $row['sc_stationary_code']; ?>" type="text" name="stationary_code_update" id="stationary_code">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="stationary_type">Stationary Type:</label>
                                                         <select class="form-control select2" name="stationary_type_update" id="stationary_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_stationary_type order by st_name asc");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['sc_statinary_type_id'] == $row_se['st_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?= $row_se['st_id']; ?>"><?php echo $row_se['st_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['st_id']; ?>"><?php echo $row_se['st_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="stationary_description1">Description_en:</label>
                                                      <input class="form-control" type="text" name="stationary_description1_update" id="stationary_description1" value="<?= $row['sc_description_en']; ?>">
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="stationary_description2">Description_kh:</label>
                                                      <input class="form-control" type="text" name="stationary_description2_update" id="stationary_description2" value="<?= $row['sc_description_kh']; ?>">
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="company">Company:</label>
                                                      <select class="form-control select2" style="width:100%;" name="company_update" id="company">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_company_id'] == $row_se['c_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['c_id']; ?>"><?= $row_se['c_name_kh'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['c_id']; ?>"><?= $row_se['c_name_kh'] ?></option>
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
                                                            if ($row['sc_branch_id'] == $row_se['ub_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['ub_id']; ?>"><?= $row_se['ub_name'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['ub_id']; ?>"><?= $row_se['ub_name'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="Department">Department:</label>
                                                      <select class="form-control select2" name="Department_update" id="Department">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_department_id'] == $row_se['de_id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['de_id']; ?>"><?= $row_se['de_name'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['de_id']; ?>"><?= $row_se['de_name'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-6">
                                                      <label for="User">User:</label>
                                                      <select class="form-control select2" name="User_update" id="User">
                                                         <?php
                                                         $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                         while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                            if ($row['sc_user_id'] == $row_se['id']) {
                                                         ?>
                                                               <option selected="selected" value="<?= $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                               <option value="<?= $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                         <?php
                                                            }
                                                         }
                                                         ?>
                                                      </select>
                                                   </div>
                                                   <div class="form-group col-xs-12">
                                                      <label for="note">Note:</label>
                                                      <textarea class="form-control" name="note_update" id="note" rows="2"><?= $row['sc_node']; ?></textarea>
                                                   </div>
                                                   <div class="modal-footer col-md-12">
                                                      <button type="submit" name="btnUpdate" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i>Update</button>
                                                      <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</button>
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
         $("#menu_setting").addClass("active");
         $("#stationary_code").addClass("active");
         $("#stationary_code").css("background-color", "##367fa9");
         $('#table_stationary_code_creation').dataTable();
      });
   </script>
</body>

</html>