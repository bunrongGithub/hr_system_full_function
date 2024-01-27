<?php
require './function.php';
////////////// Add new /////////////////
if(request('btnadd')){
   $data = [
      'aim_name' => $_POST['uom']
   ];
   $require=['aim_name'];
   Validator::has_require($data,$require) ? 
      $insert  =insert($data,'text_asset_in_mou',$connect) : redirect('validate','uom');
      $insert ? redirect('success','uom'):'';
}
/////////////// Update /////////////////////// 
if(request('btnupdate')){
   $data = [
      'aim_id' => $_POST['txt_id'],
      'aim_name' => $_POST['txt_uom']
   ];
   $update('text_asset_in_mou',$data,'aim_id',$data['aim_id'],$connect)? redirect('update','uom'):'';
}
//////////////// delete ///////////////////////// 
if(get_req('delete')){
   $deletes= $delete('delete','text_asset_in_mou','aim_id',$connect);
   $deletes ? redirect('delete','uom'):'';
}

?>
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
      <?php include "left_menu.php" ?>
      <aside class="right-side">
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
            if (!empty($_GET['message']) && $_GET['message'] == 'validate') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>All field are require!</h4>';
               echo '</div>';
            }
            if (!empty($_GET['message']) && $_GET['message'] == 'validate_img') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>Please select the images before submited!</h4>';
               echo '</div>';
            }
            if (!empty($_GET['message']) && $_GET['message'] == 'notsuccess') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>Fall updated!</h4>';
               echo '</div>';
            }
            ?>
         </div>
         <section class="content-header">
            <h1>Unit Of Measure</h1>
         </section>
         <section class="content">
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLabel">Add New</h4>
                              </div>
                              <form action="" enctype="multipart/form-data" method="post">
                                 <div style="margin-bottom: 30px;" class="modal-body">
                                       <div class="col-xs-12 ">
                                          <label for="">Unit Of Measure:</label>
                                          <input type="text" name="uom" class="form-control" id="">
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnadd" class="btn btn-sm btn-primary">Save</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="update_uom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLabel">Update</h4>
                              </div>
                              <form action="" method="post">
                                 <input type="hidden" id="txt_id" name="txt_id">
                                 <div style="margin-bottom: 30px;" class="modal-body">
                                       <div class="col-xs-12 ">
                                          <label for="">Unit Of Measure:</label>
                                          <input type="text" name="txt_uom" class="form-control" id="txt_uom">
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnupdate" class="btn btn-sm btn-primary">Save</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="box header">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                        </button>
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-hover table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>UOM</th>
                                    <th style="width: 80px;" >Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "select * from text_asset_in_mou";
                                 $stmt  = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $stmt->fetch_assoc()) {
                                    $v_i = $i++;
                                    $uom = $row['aim_name'];
                                 ?>
                                    <tr>
                                       <td><?php echo $v_i; ?></td>
                                       <td>
                                          <?= $uom ?></td>
                                          <td class="text-center" >
                                          <a  
                                             onclick="doUpdate(<?=$row['aim_id'];?>,'<?=$row['aim_name'];?>');"
                                             data-toggle="modal" data-target="#update_uom" 
                                             class="btn btn-sm btn-info" href="#">
                                                <i class="fa fa-edit" ></i>
                                          </a>
                                             <a onclick=" return confirm('Are you sure delete?') " class="btn btn-sm btn-danger" href="./uom.php?delete=<?=$row['aim_id']?>"><i class="fa fa-trash-o" ></i></a>
                                          </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
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
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
   <script type='text/javascript'>


      function doUpdate(id,name){
         $("#txt_id").val(id);
         $("#txt_uom").val(name);
      }

      $(function() {
         $("select").selectpicker();
         $("#menu_setting").addClass("active");
         $("#uom").addClass("active");
         $("#uom").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>