<?php
include '../config/db_connect.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_POST['btnadd'])) {
   $v_asset_code = $_POST['asset_code'];
   $v_asset_type = $_POST['asset_type'];
   $v_asset_category_id = $_POST['asset_category'];
   $v_description_one = $_POST['description_1'];
   $v_description_two = $_POST['description_2'];
   $v_note = $_POST['note'];
   $v_user_id = $_POST['user'];
   $sql = "INSERT INTO assest_code_creation (ac_asset_code
                                                ,ac_asset_type_id
                                                ,as_asset_category
                                                ,ac_description1
                                                ,ac_description2
                                                ,ac_note
                                                ,ac_user_id
                                                ,created_at
                                             ) 
                                             VALUES ('$v_asset_code'
                                                      ,'$v_asset_type'
                                                      ,'$v_asset_category_id'
                                                      ,'$v_description_one'
                                                      ,'$v_description_two'
                                                      ,'$v_note'
                                                      ,'$v_user_id'
                                                      ,'$datetime'
                                                   )";
   $result = mysqli_query($connect, $sql);
   header('location:asset_code_creation.php?message=success');
   exit();
}
if(isset($_POST['update'])){
   $v_id = $_POST['ac_id_update'];
   $v_asset_code_update = $_POST['asset_code_update'];
   $v_asset_type_update = $_POST['asset_type_update'];
   $v_asset_category_update = $_POST['asset_category_update'];
   $v_description_one_update = $_POST['description1_update'];
   $v_description_two_update = $_POST['description2_update'];
   $v_user_id_update = $_POST['user_update'];
   $v_note_update = $_POST['note_update'];
   $sql = "UPDATE assest_code_creation SET ac_asset_code = '$v_asset_code_update'
                                                , ac_asset_type_id = '$v_asset_type_update'
                                                , as_asset_category_id = '$v_asset_category_update'
                                                , ac_description1 = '$v_description_one_update'
                                                , ac_description2 = '$v_description_two_update'
                                                , ac_user_id = '$v_user_id_update'
                                                , ac_note = '$v_note_update'
                                                , updated_at = '$datetime' WHERE ac_id = '$v_id'";
   if (mysqli_query($connect, $sql)) {
      echo "Updating succeefully.";
   } else {
      throw new mysqli_sql_exception(mysqli_errno($connect));
   }
   header('location:asset_code_creation.php?message=update');
   exit();
}
if (isset($_GET['id'])) {
   $id = $_GET['id'];

   $sql = "DELETE FROM assest_code_creation WHERE ac_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header('location:asset_code_creation.php?message=delete');
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
         }else if(!empty($_GET['message']) && $_GET['message'] == 'delete'){
            echo '<div class="alert alert-danger">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4>Success delete data.</h4>';
            echo '</div>';
         }
         ?>
         <section class="content-header">
            <h1 class="text-primary">Asset Code Creation</h1>
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</button>
         </section>
         <section>
            <div class="row">
               <!--Add new modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"> <i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</h4>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                       <div class="form-group col-xs-6">
                                          <label for="asset_code">Asset Code:</label>
                                          <input type="text" class="form-control" name="asset_code" id="asset_code">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="asset_type">Asset Type:</label>
                                          <select class="form-control select2" name="asset_type" id="asset_type">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type order by acct_name asc");
                                             while ($row = mysqli_fetch_assoc($v_select)) { ?>
                                                <option value="<?php echo $row['acct_id'] ?>"><?php echo $row['acct_name']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="asset_category">Asset Category:</label>
                                          <input class="form-control select2" name="asset_category" id="asset_category"/>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="description_1">Description_en:</label>
                                          <input class="form-control" type="text" name="description_1" id="description_1">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="description_2">Description_kh:</label>
                                          <input class="form-control" type="text" name="description_2" id="description_2">
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="user">User:</label>
                                          <select class="form-control select2" name="user" id="user">
                                             <option value="">==== Select ====</option>
                                             <?php
                                             $v_select = mysqli_query($connect, "SELECT * FROM user order by username asc");
                                             while ($row = mysqli_fetch_assoc($v_select)) {
                                             ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['username']; ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-xs-6">
                                          <label for="note">Note:</label>
                                          <textarea class="form-control" name="note" id="note" rows="2"></textarea>
                                       </div>
                                    </div>
                                    <div class="modal-footer col-md-12">
                                       <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
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
                        <table id="table_asset_code" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th style="text-align: center;">No.</th>
                                 <th style="text-align: center;">Asset Code</th>
                                 <th style="text-align: center;">Asset Type</th>
                                 <th style="text-align: center;" >Asset Category</th>
                                 <th style="text-align: center;">Description_en</th>
                                 <th style="text-align: center;">Description_kh</th>
                                 <th style="text-align:center;width:150px;">Note</th>
                                 <th style="text-align: center;">User</th>
                                 <th style="text-align:center;width:130px;"><i class="fa fa-cog"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sql = "SELECT * FROM `assest_code_creation` A 
                                 LEFT JOIN `text_asset_code_creation_type` B ON B.acct_id = A.ac_asset_type_id
                                 LEFT JOIN `user` C ON C.id = A.ac_user_id
                                ";
                              $result = $connect->query($sql);
                              $i = 1;
                              while ($row = $result->fetch_assoc()) {
                                 $v_1 = $i++;
                                 $v_id = $row['ac_id'];
                                 $v_asset_code = $row['ac_asset_code'];
                                 $v_asset_type = $row['acct_name'];
                                 $v_description_one = $row['ac_description1'];
                                 $v_description_two = $row['ac_description2'];
                                 $v_note = $row['ac_note'];
                                 $v_user_id = $row['username'];
                                 $v_asset_category_id = $row['as_asset_category'];
                              ?>
                                 <tr>
                                    <td style="text-align: center;"><?php echo $v_id; ?></td>
                                    <td style="text-align: center;"><?php echo $v_asset_code; ?></td>
                                    <td style="text-align: center;"><?php echo $v_asset_type; ?></td>
                                    <td style="text-align: center;"><?php echo $v_asset_category_id; ?></td>
                                    <td style="text-align: center;"><?php echo $v_description_one; ?></td>
                                    <td style="text-align: center;"><?php echo $v_description_two; ?></td>
                                    <td style="text-align: center;"><?php echo $v_note; ?></td>
                                    <td style="text-align: center;"><?php echo $v_user_id; ?></td>
                                    <td style="text-align: center;">
                                       <a onclick="doUpdate(<?php echo $row['ac_id']; ?>)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_view<?= $row['ac_id'];?>">
                                          <i style="color:white;" class="fa fa-eye"></i>
                                       </a>
                                       <a onclick="doUpdate(<?php echo $row['ac_id']; ?>)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_update<?= $row['ac_id'];?>">
                                          <i style="color:white;" class="fa fa-edit"></i>
                                       </a>
                                       <!--<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>-->
                                       <a onclick="return confirm('Are you sure delete')" href="asset_code_creation.php?id=<?php echo $row['ac_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <!-- modal_view  -->
                                 <div class="modal fade" id="modal_view<?= $row['ac_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h2 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-eye" ></i> View Asset Code Creation</h2>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="ac_id_update" id="" value="<?= $row['ac_id'];?>">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_code">Asset Code:</label>
                                                         <input class="form-control" type="text" name="asset_code_update" id="asset_code" value="<?= $row['ac_asset_code'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_type">Asset Type:</label>
                                                         <select class="form-control select2" name="asset_type_update" id="asset_type">
                                                            <?php
                                                               $v_select = mysqli_query($connect,"SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                                               while($row_se = mysqli_fetch_assoc($v_select)){
                                                                  if($row['ac_asset_type_id'] == $row_se['acct_id']){
                                                                     ?>
                                                                     <option selected="selected" value="<?php echo $row_se['acct_id']; ?>"><?php echo $row_se['acct_name']; ?></option>
                                                                     <?php
                                                                  }else{
                                                                     ?>
                                                                     <option value="<?php echo $row_se['acct_id']; ?>"><?php echo $row_se['acct_name']; ?></option>
                                                                     <?php
                                                                  }
                                                               }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_category">Asset Category:</label>
                                                         <input class="form-control select2" name="asset_category_update" id="asset_category" value="<?= $row['as_asset_category']?>" />
                                                      </div>
                                                   </div>
                                                   
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="description1">Description_en:</label>
                                                         <input class="form-control" type="text" name="description1_update" id="description1" value="<?= $row['ac_description1'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="description2">Description_kh:</label>
                                                         <input class="form-control" type="text" name="description2_update" id="description2" value="<?= $row['ac_description2'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                               $v_select = mysqli_query($connect,"SELECT * FROM user ORDER BY username ASC");
                                                               while($row_se = mysqli_fetch_assoc($v_select)){
                                                                  if($row['ac_user_id'] == $row_se['id']){
                                                                     ?>
                                                                     <option selected="selected" value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                                     <?php
                                                                  }else{
                                                                     ?>
                                                                     <option value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
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
                                                         <textarea class="form-control" rows="2" name="note_update" id="note" value="" ><?= $row['ac_note'];?></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo" ></i>Back</button>
                                          </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal fade" id="modal_update<?= $row['ac_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                             <h2 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit" ></i>Edit Asset Code Creation</h2>
                                          </div>
                                          <div class="modal-body">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="ac_id_update" id="" value="<?= $row['ac_id'];?>">
                                                <div class="row">
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_code">Asset Code:</label>
                                                         <input class="form-control" type="text" name="asset_code_update" id="asset_code" value="<?= $row['ac_asset_code'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_type">Asset Type:</label>
                                                         <select class="form-control select2" name="asset_type_update" id="asset_type">
                                                            <?php
                                                               $v_select = mysqli_query($connect,"SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                                               while($row_se = mysqli_fetch_assoc($v_select)){
                                                                  if($row['ac_asset_type_id'] == $row_se['acct_id']){
                                                                     ?>
                                                                     <option selected="selected" value="<?php echo $row_se['acct_id']; ?>"><?php echo $row_se['acct_name']; ?></option>
                                                                     <?php
                                                                  }else{
                                                                     ?>
                                                                     <option value="<?php echo $row_se['acct_id']; ?>"><?php echo $row_se['acct_name']; ?></option>
                                                                     <?php
                                                                  }
                                                               }
                                                            ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="asset_category">Asset Category:</label>
                                                         <input class="form-control select2" name="asset_category_update" id="asset_category" value="<?= $row['as_asset_category']?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="description1">Description_en:</label>
                                                         <input class="form-control" type="text" name="description1_update" id="description1" value="<?= $row['ac_description1'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="description2">Description_kh:</label>
                                                         <input class="form-control" type="text" name="description2_update" id="description2" value="<?= $row['ac_description2'];?>" >
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-6">
                                                      <div class="form-group">
                                                         <label for="user">User:</label>
                                                         <select class="form-control select2" name="user_update" id="user">
                                                            <?php
                                                               $v_select = mysqli_query($connect,"SELECT * FROM user ORDER BY username ASC");
                                                               while($row_se = mysqli_fetch_assoc($v_select)){
                                                                  if($row['ac_user_id'] == $row_se['id']){
                                                                     ?>
                                                                     <option selected="selected" value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
                                                                     <?php
                                                                  }else{
                                                                     ?>
                                                                     <option value="<?php echo $row_se['id']; ?>"><?php echo $row_se['username']; ?></option>
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
                                                         <textarea class="form-control" rows="2" name="note_update" id="note" value="" ><?= $row['ac_note'];?></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button name="update" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>Update</button>
                                             <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo" ></i>Back</button>
                                          </div>
                                          </form>
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
         $("#asset_code").addClass("active");
         $("#asset_code").css("background-color", "##367fa9");
         $('#table_asset_code').dataTable();
      });
   </script>
</body>

</html>