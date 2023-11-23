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
   $ic_date = $_POST['ic_date'];
   $ic_letter_no = $_POST['ic_letter_no'];
   $ic_description = $_POST['ic_description'];
   $ic_letter_type_id = $_POST['ic_letter_type_id'];
   $ic_note = $_POST['ic_note'];
   $query = "INSERT INTO info_center (ic_date,ic_letter_no,ic_description,ic_letter_type_id,ic_note ) 
        VALUES ( '$ic_date','$ic_letter_no','$ic_description','$ic_letter_type_id','$ic_note')";
   $queryrun = mysqli_query($connect, $query);
   if ($queryrun) {
      header("location:info_center.php");
      exit();
   } else {
      header("location:info_center.php");
      echo "<script>alert ('Insert faile');</script>";
      exit();
   }
}
// Update

// if (isset($_POST["update"])) {
//     $ic_id = $_POST['ic_id'];
//     $updateid = $_POST["brand_id"];
//     $v_name = $_POST["edit_name"];
//     $v_note = $_POST["edit_note"];

//     $sql = "UPDATE user_branch set 
//                         ub_name = '$v_name'
//                         , ub_note = '$v_note' 
//                   WHERE 
//                     ic_id = '$ic_id' ";
//     $result = mysqli_query($connect, $sql);
//     header('location:info_center.php?message=update');
// }


if (isset($_POST['btn_add'])) {
   $v_image = @$_FILES['ic_attach_file'];
   $v_id = @$_POST['ic_id'];
   if ($v_image["name"] != "") {
      $old_image = @$_POST['txt_old_img'];
      if (file_exists("../img/file/" . $old_image) and $old_image != 'blank.png') {
         unlink("../img/file/" . $old_image);
      }

      $new_name = date("Ymd") . "_" . rand(1111, 9999) . ".pdf";
      move_uploaded_file($v_image["tmp_name"], "../img/file/" . $new_name);

      $query_update = "UPDATE info_center SET
                              ic_attach_file='$new_name' 
                        WHERE ic_id='$v_id'";

      if ($connect->query($query_update)) {
         header("Location: info_center.php");
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
if (isset($_POST['btn_update'])) {
   $v_id = $_POST['txt_id'];
   $v_date = $_POST['txt_date'];
   $v_letter_no = $_POST['txt_letter_no'];
   $v_desc = $_POST['txt_desc']; 
   $v_type = $_POST['letter_type'];
   $v_note = $_POST['txt_note']; 
   $v_company = $_POST['txt_company']; 
   $v_branch = $_POST['txt_branch']; 
   $v_deparment = $_POST['txt_department'];
   $v_user = $_POST['txt_user']; 
   $sql = "UPDATE info_center set ic_date = '$v_date'
                                 , ic_letter_no = '$v_letter_no' 
                                 , ic_description = '$v_desc'
                                 , ic_letter_type_id = '$v_type'
                                 , ic_note = '$v_note'
                                 , ic_company_id = '$v_company'
                                 , ic_branch_id = '$v_branch'
                                 , ic_department_id = '$v_deparment'
                                 , ic_user_id = '$v_user'
                                 where ic_id = '$v_id'";
   mysqli_query($connect,$sql);

   header("location:info_center.php?message=update");
   exit();
}
// End Edit
if (isset($_GET['ic_id'])) {
   $ic_id = $_GET['ic_id'];
   $delte = "DELETE FROM info_center WHERE ic_id = '" . $ic_id . "'";
   if (mysqli_query($connect, $delte)) {
      header("location:info_center.php");
      exit();
   } else {
      echo "Error deleting record";
   }
}

// delete 



// End delete 

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
               Information Center
            </h1>

         </section>

         <!-- Main content -->
         <!-- Modal Add New  -->
         <section class="content">
            <!-- top row -->
            <div class="row">

               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel">Update Information Center </h4>

                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="txt_id" id="txt_id">
                              <div class="col-xs-12">
                                 <div class="col-xs-6 form-group">
                                    <label for="">Date:</label>
                                    <input type="date" name="txt_date" class="form-control" id="txt_date">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Letter_No :</label>
                                    <input type="text" class="form-control" name="txt_letter_no"  id="txt_letter_no" placeholder="">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Description:</label>
                                    <input type="text" class="form-control" name="txt_desc"  id="txt_desc" placeholder="">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Letter_type:</label>
                                    <select name="letter_type" data-live-search="true" class="form-control" id="letter_type">
                                       <option selected value=""></option>
                                       <?php 
                                       $sql = "SELECT * FROM text_letter_type";
                                       $result = mysqli_query($connect,$sql);
                                       while($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="'.$row['let_id'].'">'.$row['let_name'].'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                              
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Company:</label>
                                    <select name="txt_company" data-live-search="true" class="form-control" id="txt_company">
                                       <option selected value=""></option>
                                       <?php 
                                       $sql = "SELECT * FROM company";
                                       $result = mysqli_query($connect,$sql);
                                       while($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="'.$row['c_id'].'">'.$row['c_name_kh'].'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Branch:</label>
                                    <select name="txt_branch" data-live-search="true" class="form-control" id="txt_branch">
                                       <option selected value=""></option>
                                       <?php 
                                       $sql = "SELECT * FROM user_branch";
                                       $result = mysqli_query($connect,$sql);
                                       while($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="'.$row['ub_id'].'">'.$row['ub_name'].'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">Department:</label>
                                    <select name="txt_department" data-live-search="true" class="form-control" id="txt_department">
                                       <option selected value=""></option>
                                       <?php 
                                       $sql = "SELECT * FROM department";
                                       $result = mysqli_query($connect,$sql);
                                       while($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="'.$row['de_id'].'">'.$row['de_name'].'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="date">User:</label>
                                    <select name="txt_user" data-live-search="true" class="form-control" id="txt_user">
                                       <option selected value=""></option>
                                       <?php 
                                       $sql = "SELECT * FROM user";
                                       $result = mysqli_query($connect,$sql);
                                       while($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="'.$row['id'].'">'.$row['username'].'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-12 form-group">
                                    <label for="">Note:</label>
                                    <textarea name="txt_note" class="form-control" id="txt_note"rows="2"></textarea>
                                 </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btn_update" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>

                           <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
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
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="date">Date :</label>
                                                <input type="date" class="form-control" id="exampleFormControlInput1" name="ic_date" placeholder="" value="<?php echo $today; ?>">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="date">Letter_No :</label>
                                                <input type="text" class="form-control" name="ic_letter_no" id="exampleFormControlInput1" placeholder="">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="date">Description:</label>
                                                <input type="text" class="form-control" name="ic_description" id="exampleFormControlInput1" placeholder="">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label for="">Letter_Type:</label>
                                             <select class="form-control select2" style="width: 100%;" name="ic_letter_type_id">
                                                <option hidden value="">==== Select ====</option>
                                                <?php
                                                $v_select = mysqli_query($connect, "SELECT * FROM  text_letter_type ORDER BY let_name");
                                                while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                                   <option value="<?php echo $row['let_id']; ?>"><?php echo $row['let_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Note:</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="ic_note" rows="3"></textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-6">

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
                                    <th scope="col">Date</th>
                                    <th scope="col">Letter_No</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Attach_File(PDF)</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Company</th>
                                    <th scope="col" style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM info_center A
                                                    LEFT JOIN text_letter_type B ON B.let_id=A.ic_letter_type_id
                                                    LEFT JOIN company D ON D.c_id=A.ic_company_id 
                                                    LEFT JOIN user_branch E ON E.ub_id=A.ic_branch_id 
                                                    LEFT JOIN department F ON F.de_id=A.ic_department_id
                                                    LEFT JOIN user G ON G.id=A.ic_user_id
                                                    ";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_date = $row["ic_date"];
                                    $v_letter_no = $row["ic_letter_no"];
                                    $ic_description = $row["ic_description"];
                                    $ic_letter_type_id = $row["let_name"];
                                    $v_attach_file = $row["ic_attach_file"];
                                    // $v_company = $row["ic_attach_file"];
                                    $ic_note = $row["ic_note"];

                                    $v_company_id = $row["c_name_kh"];
                                    $v_branch_id = $row["ub_name"];
                                    $v_department_id = $row["de_name"];
                                    $v_user_id = $row["username"];
                                 ?>
                                    <tr>
                                       <td scope="row"><?php echo $v_i; ?></td>
                                       <td scope="row"><?php echo $v_date; ?></td>
                                       <td scope="row"><?php echo $v_letter_no; ?></td>
                                       <td scope="row"><?php echo $ic_description; ?></td>
                                       <td scope="row"><?php echo $ic_letter_type_id; ?></td>
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
                                             <a target=”_blank” href="../img/file/<?= $row['ic_attach_file']; ?>">
                                                <img height="50px" src="../img/file/pdf_image.png">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a onclick="doUpdate(<?php echo $row['ic_id']; ?>)" data-toggle="modal" data-target="#exampleModal_u<?php echo $row['ic_id']; ?>">
                                             <i style="cursor: pointer;" class="fa fa-pencil"></i></a>

                                       </td>
                                       <td scope="row">
                                          <?php echo $ic_note; ?>
                                       </td>

                                       <td scope="row">
                                          <i> Company:</i> <?php echo $v_company_id; ?>
                                          <br> <i>Branch:</i> <?php echo $v_branch_id; ?>
                                          <br> <i>Department:</i> <?php echo $v_department_id; ?>
                                          <br> <i>User:</i> <?php echo $v_user_id; ?>
                                       </td>
                                       <td scope="row">
                                          <a data-toggle="modal" data-target="#view_modal<?= $row['ic_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a>
                                          <a onclick="doUpdate('<?= $row['ic_id']; ?>',
                                                               '<?= $row['ic_date']; ?>',
                                                               '<?= $row['ic_letter_no']; ?>',
                                                               '<?= $row['ic_description']; ?>',
                                                               '<?= $row['ic_letter_type_id']; ?>',
                                                               '<?= $row['ic_note']; ?>',
                                                               '<?= $row['ic_company_id']; ?>',
                                                               '<?= $row['ic_branch_id']; ?>',
                                                               '<?= $row['ic_department_id']; ?>',
                                                               '<?= $row['ic_user_id']; ?>',
                                                               );" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="info_center.php?ic_id=<?php echo $row['ic_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                    <!-- view_modal-->
                                    <div class="modal fade" id="view_modal<?= $row['ic_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title text-primary " id="exampleModalLabel"><i class="fa fa-eye"></i>&nbsp;View Information Center</h4>
                                             </div>
                                             <div class="modal-body">
                                                <form action="" enctype="multipart/form-data" method="post">
                                                   <div class="col-xs-12">
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Date:</label>
                                                         <input type="date" name="" value="<?= $row['ic_date']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Letter_No:</label>
                                                         <input type="text" name="" value="<?= $row['ic_letter_no']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Description:</label>
                                                         <input type="text" name="" value="<?= $row['ic_description']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Letter_Type:</label>
                                                         <input type="text" name="" value="<?= $row['let_name']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-12 form-group">
                                                         <label for="">Letter_Type:</label>
                                                         <textarea type="text" name="" value="<?= $row['ic_id']; ?>" id="" class="form-control"><?= $row['ic_note']; ?></textarea>
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Company:</label>
                                                         <input type="text" name="" value="<?= $row['c_name_kh']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Branch:</label>
                                                         <input type="text" name="" value="<?= $row['ub_name']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">Department:</label>
                                                         <input type="text" name="" value="<?= $row['de_name']; ?>" id="" class="form-control">
                                                      </div>
                                                      <div class="col-xs-6 form-group">
                                                         <label for="">User:</label>
                                                         <input type="text" name="" value="<?= $row['username']; ?>" id="" class="form-control">
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button> -->
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end_view_modal -->
                                    <!-- Start Upload File -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_u<?php echo $row['ic_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                   <input type="hidden" name="ic_id" value="<?php echo $row["ic_id"] ?>">
                                                   <input type="hidden" name="txt_old_img" value="<?= @$_GET['sent_img'] ?>">
                                                   <div class="row">
                                                      <duv class="col-xs-6">
                                                         <img src="../img/file/<?= @$_GET['ic_attach_file'] ?>" alt="">
                                                         <div class="form-group">
                                                            <label for="">Upload Here</label>
                                                            <input required="" type="file" class="form-control" accept="application/pdf" id="preview" name="ic_attach_file" onchange="loadFile(event)" />
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
      function doUpdate(id, date,letter_no,desc,letter_type,note,company_id,branch,department,user_id) {
         $('#txt_id').val(id);
         $("#txt_date").val(date);
         $("#txt_letter_no").val(letter_no);
         $("#txt_desc").val(desc);
         $("#letter_type").val(letter_type).change();
         $("#txt_note").val(note)
         $("#txt_company").val(company_id).change();
         $("#txt_branch").val(branch).change();
         $("#txt_department").val(department).change();
         $("#txt_user").val(user_id).change();
      }

      $(function() {
         $("select").selectpicker();
         $("#info_center").addClass("active");
         $("#info_center").css("background-color", "##367fa9");
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