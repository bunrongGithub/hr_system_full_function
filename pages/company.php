<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_namekh = $_POST["txt_namekh"];
   $v_nameen = $_POST["txt_nameen"];
   $v_namech = $_POST["txt_namech"];
   $v_phone = $_POST["txt_phone"];
   $v_address = $_POST["txt_address"];
   $v_note = $_POST["txt_note"];

   $sql = "INSERT INTO company 
                        ( c_name_kh , c_name_en , c_name_ch ,
                         c_phone , c_location , c_note ) 
                  VALUES 
                    ('$v_namekh' , '$v_nameen' , '$v_namech' , 
                    '$v_phone' ,  '$v_address', '$v_note' )";
   $result = mysqli_query($connect, $sql);
   header('location:company.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["company_id"];
   $v_namekh = $_POST["edit_namekh"];
   $v_nameen = $_POST["edit_nameen"];
   $v_namech = $_POST["edit_namech"];
   $v_phone = $_POST["edit_phone"];
   $v_address = $_POST["edit_address"];
   $v_note = $_POST["edit_note"];

   $sql = "UPDATE company SET c_name_kh = '$v_namekh' , c_name_kh = '$v_nameen' , 
                            c_name_ch = '$v_namech' , c_phone = '$v_phone' , 
                            c_address = '$v_address' , c_note = '$v_note' WHERE c_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:company.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM company WHERE c_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: company.php?message=delete");
}

if(isset($_POST['upload'])){
   $img_id = $_POST['image'];
   $new_image = $_FILES['new_img']['name'];
   $old_img = $_POST['image_old'];
   if($new_image !== ""){
      $update_filename = $_FILES['new_img']['name'];

   }else{
      $update_filename = $old_img;
   }
   if(file_exists("../img" . $_FILES['new_img']['name'])){
      $filename = $_FILES['new_img']['name'];
      $_SESSION['status'] = "Image  already exists";
      header('location:company.php');
      exit();
   }else{
      $query = "UPDATE company SET c_logo = '$update_filename' where c_id = '$img_id'";
      $query_run = mysqli_query($connect,$query);
      if($query_run){
         if($_FILES['new_img']['name'] !==""){
            move_uploaded_file($_FILES['new_img']['tmp_name'],"../img/".$_FILES['new_img']['name']);
            unlink("../img/".$old_img);
         }
         $_SESSION['status'] = 'updated success';
         header('location:company.php');
         exit();
      }
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
               Company Register
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
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
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
                                          <div class="form-group col-xs-6">
                                             <label>Name Khmer:</label>
                                             <input class="form-control" id="txt_namekh" name="txt_namekh" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Name English:</label>
                                             <input class="form-control" id="txt_nameen" name="txt_nameen" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Name Chinese:</label>
                                             <input class="form-control" id="txt_namech" name="txt_namech" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Phone:</label>
                                             <input class="form-control" id="txt_phone" name="txt_phone" type="number">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Location:</label>
                                             <input class="form-control" id="txt_address" name="txt_address" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
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
                                          <input type="hidden" id="company_id" name="company_id" />
                                          <div class="form-group col-xs-6">
                                             <label>Name Khmer:</label>
                                             <input class="form-control" id="edit_namekh" name="edit_namekh" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Name English:</label>
                                             <input class="form-control" id="edit_nameen" name="edit_nameen" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Name Chinese:</label>
                                             <input class="form-control" id="edit_namech" name="edit_namech" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Phone:</label>
                                             <input class="form-control" id="edit_phone" name="edit_phone" type="number">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Location:</label>
                                             <input class="form-control" id="edit_address" name="edit_address" type="text">
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
                        <!-- Modal Update-->

                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Name_KH</th>
                                    <th>Name_EN</th>
                                    <th>Name_CH</th>
                                    <th class="text-center" >Logo</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th style="width: 110px; ">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM company";
                                 $result = $connect->query($sql);

                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_namekh = $row["c_name_kh"];
                                    $v_nameen = $row["c_name_en"];
                                    $v_namech = $row["c_name_ch"];
                                    $v_phone = $row["c_phone"];
                                    $v_address = $row["c_location"];
                                    $v_note = $row["c_note"];
                                    $v_logo = $row['c_logo'];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td><?php echo $v_namekh; ?></td>
                                       <td><?php echo $v_nameen; ?></td>
                                       <td><?php echo $v_namech; ?></td>
                                       <td class="text-center">
                                          <?php
                                          if ($v_logo == "") {
                                          ?>
                                             <a target="_blank" href="../img/no_image.jpg">
                                                <img width="50px" src="../img/no_image.jpg" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a target="_blank" href="../img/<?=$v_logo; ?>">
                                                <img height="50px" src="../img/<?= $v_logo ?>" alt="">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a style="cursor: pointer;" onclick="doUpdate(<?php echo $row['c_id']; ?>)" data-toggle="modal" data-target="#modal_image<?php echo $row['c_id'] ?>">
                                             <i class="fa fa-pencil text-info"></i><br><b>Upload here</b>
                                          </a>
                                          <?php
                                          ?>
                                       </td>
                                       <td><?php echo $v_phone; ?></td>
                                       <td><?php echo $v_address; ?></td>
                                       <td><?php echo $v_note; ?></td>
                                       <td style="text-align:center;">
                                          <a href="company_auth_user.php?sent_id=<?php echo $row['c_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-key"></i></a>
                                          <!-- <a href="edit_user.php?id=<?php echo $row['c_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(<?php echo $row['c_id']; ?>,
                                                        '<?php echo $v_namekh; ?>',
                                                        '<?php echo $v_nameen; ?>',
                                                        '<?php echo $v_namech; ?>',
                                                        '<?php echo $v_phone; ?>',
                                                        '<?php echo $v_address; ?>',
                                                        '<?php echo $v_note; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="company.php?del_id=<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                       </td>
                                    </tr>


                                    <!-- Modal image-->
                                    <div class="modal fade" id="modal_image<?php echo $row['c_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title text-primary" id="exampleModalLabel"> <i class="fa fa-edit"></i> Upload Image</h3>
                                             </div>
                                             <div class="modal-body">
                                                <form method="POST" action="" enctype="multipart/form-data">
                                                   <input type="hidden" name="image" value="<?php echo $row['c_id']?>" id="">
                                                   
                                                   <div class="form-group">
                                                      <input class="form-control" type="file" name="new_img" value="" id="preview"/>
                                                      <input type="hidden" name="image_old" value="<?php if(isset($row['c_logo'])){echo $row['c_logo'];} ?>" id="">
                                                   </div>
                                                   <div class="form-group">
                                                      <button class="btn btn-primary btn-sm" type="submit" name="upload"> <i class="fa fa-save" ></i> UPLOAD</button>
                                                      <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-undo" ></i> Close</button>
                                                   </div>
                                                </form>
                                             </div>
                                             
                                          </div>
                                       </div>
                                    </div>
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
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>>

   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->


   <script type="text/javascript">
      function doUpdate(id, namekh, nameen, namech, phone, address, note) {
         $('#company_id').val(id);
         $('#edit_namekh').val(namekh);
         $('#edit_nameen').val(nameen);
         $('#edit_namech').val(namech);
         $('#edit_phone').val(phone);
         $('#edit_address').val(address);
         $('#edit_note').val(note);
      }
      $(function() {
         $("#menu_setting").addClass("active");
         $("#company").addClass("active");
         $("#company").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>