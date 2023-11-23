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

   $sql = "DELETE FROM eform WHERE ef_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header('location:e-form.php?message=delete');
}

if (isset($_POST["btnadd"])) {
   $v_e_form_name = $_POST['e-form-name'];
   $v_e_form_type = $_POST['e-form-type'];
   $v_company = $_POST['company'];
   $v_branch = $_POST['branch'];
   $v_department = $_POST['department'];
   $v_note = $_POST['txt_note'];
   $v_user = $_POST['user'];

   $sql = "INSERT INTO eform
                  (ef_name
                  ,ef_type_id
                  ,ef_company_id
                  ,ef_branch_id
                  ,ef_dep_id
                  ,ef_note
                  ,created_at
                  ,ef_user_id
                  )
               VALUES (
                  '$v_e_form_name'
                  ,'$v_e_form_type'
                  ,'$v_company'
                  ,'$v_branch'
                  ,'$v_department'
                  ,'$v_note'
                  ,'$datetime'
                  ,'$v_user'
               )";
   $result = mysqli_query($connect, $sql);
   header('location:e-form.php?message=success');
}

if (isset($_POST['update'])) {
   $v_id = $_POST['ef_id_update'];
   $v_e_form_name = $_POST['e_form_name_update'];
   $v_e_form_type = $_POST['e_form_type_update'];
   $v_ef_company_id = $_POST['ef_company_update'];
   $v_ef_branch_id = $_POST['ef_branch_update'];
   $v_ef_dep_id = $_POST['ef_dep_update'];
   $v_ef_note = $_POST['ef_note_update'];
   $v_ef_user = $_POST['user_update'];

   $sql = "UPDATE eform SET ef_name = '$v_e_form_name'
                              , ef_type_id = '$v_e_form_type'
                              , ef_company_id = '$v_ef_company_id'
                              , ef_branch_id = '$v_ef_branch_id'
                              , ef_dep_id = '$v_ef_dep_id'
                              , ef_note = '$v_ef_note'
                              , ef_user_id = '$v_ef_user'
                              , updated_at = '$datetime'
                              WHERE ef_id = '$v_id'
                           ";
   if (mysqli_query($connect, $sql)) {
      echo "Updating succeefully.";
   } else {
      throw new mysqli_sql_exception(mysqli_errno($connect));
   }
   header('location:e-form.php?message=update');
   exit();
}
if (isset($_POST['btn_add'])) {
   $v_image = @$_FILES['ef_file'];
   $v_id = @$_POST['ef_id'];
   $target_file = "../img/file" . basename($_FILES["ef_file"]["name"]);
   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   if (($imageFileType === "pdf") || ($imageFileType === "docx") ||( $imageFileType === "xlsx") || ($imageFileType === "pptx")) {
      if($imageFileType ==="pdf"){
         if ($v_image['name'] != "") {
            $old_image = @$_POST['txt_old_img'];
            if (file_exists("../img/file" . $old_image) and $old_image != 'blank.png') {
               unlink("../img/file" . $old_image);
            }
            $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pdf";
            move_uploaded_file($v_image['tmp_name'], "../img/file/" . $new_name);
   
            $query_update = "UPDATE eform SET ef_file = '$new_name' where ef_id = '$v_id'";
            if ($connect->query($query_update)) {
               header("location:e-form.php?message=update_file");
            } else {
               header('location:e-form.php?message=update_file_error');
            }
         }
      }else if($imageFileType === "docx"){
         if ($v_image['name'] != "") {
            $old_image = @$_POST['txt_old_img'];
            if (file_exists("../img/file" . $old_image) and $old_image != 'blank.png') {
               unlink("../img/file" . $old_image);
            }
            $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".docx";
            move_uploaded_file($v_image['tmp_name'], "../img/file/" . $new_name);
            $query_update = "UPDATE eform SET ef_file = '$new_name' where ef_id = '$v_id'";
            if ($connect->query($query_update)) {
               header("location:e-form.php?message=update_file");
            } else {
               header('location:e-form.php?message=update_file_error');
            }
         }
      }else if($imageFileType === "xlsx"){
         if ($v_image['name'] != "") {
            $old_image = @$_POST['txt_old_img'];
            if (file_exists("../img/file" . $old_image) and $old_image != 'blank.png') {
               unlink("../img/file" . $old_image);
            }
            $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".xlsx";
            move_uploaded_file($v_image['tmp_name'], "../img/file/" . $new_name);
   
            $query_update = "UPDATE eform SET ef_file = '$new_name' where ef_id = '$v_id'";
            if ($connect->query($query_update)) {
               header("location:e-form.php?message=update_file");
            } else {
               header('location:e-form.php?message=update_file_error');
            }
         }
      }else if($imageFileType === "pptx"){
         if ($v_image['name'] != "") {
            $old_image = @$_POST['txt_old_img'];
            if (file_exists("../img/file" . $old_image) and $old_image != 'blank.png') {
               unlink("../img/file" . $old_image);
            }
            $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pptx";
            move_uploaded_file($v_image['tmp_name'], "../img/file/" . $new_name);
            $query_update = "UPDATE eform SET ef_file = '$new_name' where ef_id = '$v_id'";
            if ($connect->query($query_update)) {
               header("location:e-form.php?message=update_file");
            } else {
               header('location:e-form.php?message=update_file_error');
            }
         }
      }
   }else{
      header('location:e-form.php?message=update_file_error');
      exit();
   }
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
         } else if (!empty($_GET['message']) && $_GET['message'] == 'update_file') {
            echo '<div class="alert alert-info">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4><strong>Success Upload file</strong></h4>';
            echo '</div>';
         } else if (!empty($_GET['message']) && $_GET['message'] == 'update_file_error') {
            echo '<div class="alert alert-danger">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4><strong>Error Upload file this file is not PDF, docx, pptx or xlsx.</strong></h4>';
            echo '</div>';
         }
         ?>
         <section class="content-header">
            <h1 class="text-primary">E-Form</h1>
            <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
         </section>
         <section>
            <div class="row">
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
                           <div class="row">
                              <div class="col-md-12">
                                 <form method="post" enctype="multipart/form-data" action="">
                                    <div class="col-md-12">
                                       <div class="form-group col-xs-6">
                                          <label for="e-form-name">E-form Name:</label>
                                          <input class="form-control" name="e-form-name" id="e-form-name" type="text">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="e-form-type">E-form-Type:</label>
                                          <select class="form-control select2" style="width: 100%;" name="e-form-type" id="e-form-type">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM text_eform_type order by eft_name asc");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?php echo $row['eft_id']; ?>"><?php echo $row['eft_name']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="company">Company:</label>
                                          <select name="company" id="company" class="form-control select2" style="width:100%;">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name_kh']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="branch">Branch:</label>
                                          <select name="branch" id="branch" class="form-control select2" style="width:100;">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, " SELECT * FROM user_branch ORDER BY ub_name ASC");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?php echo $row['ub_id']; ?>"><?php echo $row['ub_name']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6 ">
                                          <label for="department">Department:</label>
                                          <select name="department" id="department" class="form-control select2" style="width:100%;">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?php echo $row['de_id'] ?>"><?php echo $row['de_name']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="user">User:</label>
                                          <select class="form-control select2" style="width: 100;" name="user" id="user">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['username']; ?></option>
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
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Back</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end modal add new -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-body table-responsive">
                        <table id="table_e_form" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No.</th>
                                 <th>E-form Name</th>
                                 <th>E-form-Type</th>
                                 <th>Eligibility Company</th>
                                 <th>Attach file</th>
                                 <th>Note</th>
                                 <th style="width:130px;text-align:center;">
                                    <i class="fa fa-cog"></i>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM eform A 
                                    LEFT JOIN text_eform_type B ON B.eft_id = A.ef_type_id
                                    LEFT JOIN company C ON C.c_id = A.ef_company_id
                                    LEFT JOIN user_branch D ON D.ub_id = A.ef_branch_id
                                    LEFT JOIN department E ON E.de_id = A.ef_dep_id
                                    LEFT JOIN user F ON F.id = A.ef_user_id";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_i = $i++;
                                 $v_id = $row['ef_id'];
                                 $v_e_form_name = $row['ef_name'];
                                 $v_e_form_type = $row['eft_name'];
                                 $v_company_id = $row['c_name_kh'];
                                 $v_branch_id = $row['ub_name'];
                                 $v_department_id = $row['de_name'];
                                 $v_attach_file = $row['ef_file'];
                                 $v_note = $row['ef_note'];
                                 $v_user_id = $row['username'];
                              ?>
                                 <tr>

                                    <td><?php echo $v_id; ?></td>
                                    <td><?php echo $v_e_form_name; ?></td>
                                    <td><?php echo $v_e_form_type; ?></td>
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
                                       <?php
                                       if ($v_attach_file == "") {
                                       ?>
                                          <a target="_blank" href="../img/file/image_no_file.png">
                                             <img height="50px" src="../img/file/image_no_file.png" alt="">
                                          </a>
                                       <?php
                                       } else {
                                       ?>
                                          <a target="_blank" href="../img/file/<?= $row['ef_file']; ?>">
                                             <img height="50px" src="../img/file/pdf_image.png.jpg" alt="">
                                          </a>
                                       <?php
                                       }
                                       ?>
                                       <a onclick="doUpdate(<?php echo $row['ef_id']; ?>)" data-toggle="modal" data-target="#exampleModal_file<?php echo $row['ef_id']; ?>" href="">
                                          <i class="fa fa-pencil"></i>
                                       </a>
                                    </td>
                                    <td><?php echo $v_note; ?></td>
                                    <td>
                                       <a onclick="doUpdate(<?php echo $row['ef_id']; ?>)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalView<?= $row['ef_id']; ?>"><i class="fa fa-eye"></i></a>
                                       <a onclick="doUpdate(<?php echo $row['ef_id']; ?>)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUdate<?= $row['ef_id']; ?>"><i class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Are you sure to delete?');" href="e-form.php?id=<?php echo $row['ef_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <!-- modal_update_file -->
                                 <div class="modal fade" id="exampleModal_file<?php echo $row['ef_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h3 class="modal-title" id="exampleModalLabel">Upload PDF File</h3>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                                This page can upload <b> file pdf, docx, pptx, xlsx<b> only.
                                             </p>
                                             <form action="" method="post" role="form" enctype="multipart/form-data">
                                                <input type="hidden" name="ef_id" value="<?php echo $row['ef_id'] ?>">
                                                <input type="hidden" name="txt_old_img" id="" value="<?= @$_GET['sent_img']; ?>">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <img src="../img/file/<?= @$_GET['ef_file'] ?>" alt="">
                                                      <div class="form-group">
                                                         <label for="">Upload Here</label>
                                                         <input required="" class="form-control" type="file" name="ef_file" id="preview" onchange="loadFile(event)" />
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button name="btn_add" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>Save</button>
                                                   <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!--end modal_update_file -->
                                 <!-- modal update -->
                                 <div class="modal fade" id="modalView<?= $row['ef_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h2 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-eye"></i> View E-form</h2>
                                          </div>
                                          <div class="modal-body">
                                             <form method="post" enctype="multipart/form-data" action="">
                                                <input type="hidden" name="ef_id_update" value="<?php echo $row['ef_id']; ?>">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="e_form_name">E-form Name:</label>
                                                         <input class="form-control" type="text" name="e_form_name_update" id="e_form_name" value="<?php echo $row['ef_name']; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="e_form_type">E-form-Type:</label>
                                                         <select class="form-control select2" style="width: 100%;" name="e_form_type_update" id="e_form_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_eform_type ORDER BY eft_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_type_id'] == $row_se['eft_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['eft_id']; ?>"><?php echo $row_se['eft_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['eft_id']; ?>"><?php echo $row_se['eft_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="company">Company:</label>
                                                         <select class="form-control select2" style="width: 100%;" name="ef_company_update" id="company">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_company_id'] == $row_se['c_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['c_id'] ?>"><?php echo $row_se['c_name_kh']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['c_id']; ?>"><?php echo $row_se['c_name_kh']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="branch">Branch:</label>
                                                         <select class="form-control select2" name="ef_branch_update" id="branch">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_branch_id'] == $row_se['ub_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['ub_id'] ?>"><?php echo $row_se['ub_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['ub_id']; ?>"><?php echo $row_se['ub_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>

                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="department">Department:</label>
                                                         <select class="form-control select2" name="ef_dep_update" id="department">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_dep_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['de_id']; ?>"><?php echo $row_se['de_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user order by username asc");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_user_id'] == $row_se['id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['id']; ?>"><?= $row_se['username']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <label for="note">Note:</label>
                                                         <textarea class="form-control" name="ef_note_update" id="note" rows="2"><?php echo $row['ef_note']; ?></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal fade" id="modalUdate<?= $row['ef_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h2 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Edit E-form</h2>
                                          </div>
                                          <div class="modal-body">
                                             <form method="post" enctype="multipart/form-data" action="">
                                                <input type="hidden" name="ef_id_update" value="<?php echo $row['ef_id']; ?>">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="e_form_name">E-form Name:</label>
                                                         <input class="form-control" type="text" name="e_form_name_update" id="e_form_name" value="<?php echo $row['ef_name']; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="e_form_type">E-form-Type:</label>
                                                         <select class="form-control select2" style="width: 100%;" name="e_form_type_update" id="e_form_type">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM text_eform_type ORDER BY eft_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_type_id'] == $row_se['eft_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['eft_id']; ?>"><?php echo $row_se['eft_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['eft_id']; ?>"><?php echo $row_se['eft_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="company">Company:</label>
                                                         <select class="form-control select2" style="width: 100%;" name="ef_company_update" id="company">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_company_id'] == $row_se['c_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['c_id'] ?>"><?php echo $row_se['c_name_kh']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['c_id']; ?>"><?php echo $row_se['c_name_kh']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="branch">Branch:</label>
                                                         <select class="form-control select2" name="ef_branch_update" id="branch">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_branch_id'] == $row_se['ub_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['ub_id'] ?>"><?php echo $row_se['ub_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['ub_id']; ?>"><?php echo $row_se['ub_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>

                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="department">Department:</label>
                                                         <select class="form-control select2" name="ef_dep_update" id="department">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM department ORDER BY de_name ASC");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_dep_id'] == $row_se['de_id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['de_id'] ?>"><?php echo $row_se['de_name']; ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?php echo $row_se['de_id']; ?>"><?php echo $row_se['de_name']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                            $v_select = mysqli_query($connect, "SELECT * FROM user order by username asc");
                                                            while ($row_se = mysqli_fetch_assoc($v_select)) {
                                                               if ($row['ef_user_id'] == $row_se['id']) {
                                                            ?>
                                                                  <option selected="selected" value="<?php echo $row_se['id']; ?>"><?= $row_se['username'] ?></option>
                                                               <?php
                                                               } else {
                                                               ?>
                                                                  <option value="<?= $row_se['id']; ?>"><?= $row_se['username']; ?></option>
                                                            <?php
                                                               }
                                                            }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <label for="note">Note:</label>
                                                         <textarea class="form-control" name="ef_note_update" id="note" rows="2"><?php echo $row['ef_note']; ?></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button name="update" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i>Update</button>
                                                   <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- End modal update -->
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
         $("#e_from").addClass("active");
         $("#e_from").css("background-color", "##367fa9");
         $('#table_e_form').dataTable();
      });

      function loadFile(e) {
         var output = document.getElementById('preview');
         output.width = 100;
         output.src = URL.createObjectURL(e.target.file[0]);
      }
   </script>
</body>

</html>