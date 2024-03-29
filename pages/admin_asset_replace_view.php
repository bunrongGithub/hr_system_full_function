<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM admin_asset_replacement WHERE adassr_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   $_code = $row['adassr_code'];
   $_replace_no = $row['adassr_replace_no'];
   $_type = $row['adassr_type'];
   $_category = $row['adassr_category'];
   $_pa_no_ref = $row['adassr_ref'];
   $_as_total = $row['adassr_total'];
   $_as_price = $row['adassr_unit_price'];
   $_as_qty = $row['adassr_qty'];
   $_as_name = $row['adassr_asset_name'];
   $_as_mou = $row['adassr_mou'];
   $_replace_date = $row['ada_ssr_replace_date'];
   $_start_date = $row['adassr_date'];
   $_inv_ref_no = $row['adassr_inv_ref'];
   $_status = $row['adassr_status'];
   $_supp_name = $row['adassr_supplier_name'];
   $_replce_to_code = $row['adassr_replace_code'];
   $_location = $row['adassr_location'];
   $_contact = $row['adassr_contact'];
   $_wan_per = $row['adassr_war_peri'];
   $_war_cond = $row['adassr_war_con'];
   $_insp = $row['adassr_insepection'];
   $_user_input = $row['adassr_userid'];
   $_img = $row['adassr_img'];
}
if (isset($_GET['del_id'])) {
   $id_del = $_GET['del_id'];
   $sql = "delete from admin_replacement_material where adrm_id = '$id_del'";
   $result = mysqli_query($connect, $sql);
   header("location:admin_asset_replace_view.php?id=".$id."");
   exit();
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
            ?>
         </div>
         <section class="content-header">
            <h1>Admin Asset Replacement</h1>
         </section>
         <section class="content">
            <div class="col-xs-12 connectedSortable">
               <div class="box">
                  <div class="box-header">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="row col-xs-12">
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Replace_No:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_replace_no ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Code:</label>
                                 <select readonly class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY ac_asset_code ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_code == $row_se['ac_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['ac_asset_code']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['ac_asset_code']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Type:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_code_creation_type ORDER BY acct_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_type == $row_se['acct_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['acct_id'] ?>"><?php echo $row_se['acct_name']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Category:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM assest_code_creation ORDER BY as_asset_category ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_category == $row_se['ac_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['as_asset_category']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['ac_id'] ?>"><?php echo $row_se['as_asset_category']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">PA No Ref:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM asset_requisiton ORDER BY as_pa_no ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_pa_no_ref == $row_se['as_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Asset Name:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_as_name ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">QTY:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_as_qty ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Current Unit Price:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_as_price . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Total Amount:</label>
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_as_total . '$' ?>" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Mou:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_in_mou ORDER BY aim_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_as_mou == $row_se['aim_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['aim_id'] ?>"><?php echo $row_se['aim_name']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['aim_id'] ?>"><?php echo $row_se['aim_name']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Inv Ref No:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_inv_ref_no ?>" class="form-control">
                              </div>
                           </div>
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label for="">Start_Date:</label>
                                 <input style="font-weight: 800;" type="date" name="" id="" value="<?= $_start_date ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Replace_Date:</label>
                                 <input style="font-weight: 800;" type="date" name="" id="" value="<?= $_replace_date ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Status:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM text_asset_broken_status ORDER BY tasb_name ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_status == $row_se['tasb_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['tasb_id'] ?>"><?php echo $row_se['tasb_name']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['tasb_id'] ?>"><?php echo $row_se['tasb_name']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Supplier_Name:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_supp_name ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Replace_To_Code:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM asset_requisiton ORDER BY as_pa_no ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_replce_to_code == $row_se['as_id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['as_id'] ?>"><?php echo $row_se['as_pa_no']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Location:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_location ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Contact:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_contact ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Warranty Period:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_wan_per ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Warranty Condition:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_war_cond ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">Inspection:</label>
                                 <input style="font-weight: 800;" type="text" name="" id="" value="<?= $_insp ?>" class="form-control">
                              </div>
                              <div class="form-group col-xs-12">
                                 <label for="">User_Input:</label>
                                 <select class="form-control select2" name="" id="">
                                    <?php
                                    $v_select = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                    while ($row_se = mysqli_fetch_assoc($v_select)) {
                                       if ($_user_input == $row_se['id']) {
                                    ?>
                                          <option selected="selected" value="<?php echo $row_se['id'] ?>"><?php echo $row_se['username']; ?></option>
                                       <?php
                                       } else {
                                       ?>
                                          <option disabled value="<?php echo $row_se['id'] ?>"><?php echo $row_se['username']; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="row col-xs-4">
                              <div class="form-group col-xs-12">
                                 <label>Photo:</label><br />
                                 <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/<?php if ($_img != '') {
                                                                                                                                          echo 'upload/asset_replacement/image/' . $_img;
                                                                                                                                       } else {
                                                                                                                                          echo 'no_image.jpg';
                                                                                                                                       } ?>" width="300x" height="300px">
                                 <input style="visibility: hidden;" type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*"></input>
                              </div>
                           </div>
                           <div class="row col-xs-10">
                              <table id='info_data' class="table table-striped table-responsive table-bordered">
                                 <thead>
                                    <tr>
                                       <th class="text-center">No</th>
                                       <th class="text-center">Material Name</th>
                                       <th class="text-center">QTY</th>
                                       <th style="width: 150px;" class="text-center">Mou</th>
                                       <th style="width: 150px;" class="text-center">Remark</th>
                                       <th class="th_none_display text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $sql = "SELECT * FROM admin_replacement_material a 
                                                   LEFT JOIN text_asset_in_mou b on b.aim_id = a.adrm_mou_id
                                    WHERE adrm_material_id='$id'";
                                    $result = $connect->query($sql);
                                    $i=1;
                                    while ($row = $result->fetch_assoc()) {
                                       $_count_i =$i++;
                                       $_mat_name = $row['adrm_material_name'];
                                       $_mat_qty = $row['adrm_qty'];
                                       $_mat_muo = $row['aim_name'];
                                       $_mat_remark = $row['adrm_remark'];
                                    ?>
                                       <tr>
                                          <td class="text-center"><?=$_count_i?></td>
                                          <td class="text-center"><?=$_mat_name?></td>
                                          <td class="text-center"><?=$_mat_qty?></td>
                                          <td class="text-center"><?=$_mat_muo?></td>
                                          <td class="text-center"><?=$_mat_remark?></td>
                                          <td class="th_none_display text-center" style="width: 100px; vertical-align: middle; ">
                                             <a style="color: white;" class="btn btn_no_print btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="./admin_asset_replace_view.php?del_id=<?= $row['adrm_id']; ?>&&id=<?=$id?>"><i class="fa fa-trash"></i></a>
                                          </td>
                                       </tr>
                                    <?php
                                    }

                                    ?>

                                 </tbody>
                              </table>
                           </div>
                           <div class="form-group col-xs-12 text-right">
                              <a href="admin_asset_replace.php" style="color:white;" class="no_print btn btn-danger btn-lg"><i class="fa fa-undo"></i> Back </a>
                           </div>
                        </div>
                     </form>
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
   <!-- daterangepicker -->
   <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
   <script type="text/javascript">
      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_broken").addClass("active");
         $("#asset_broken").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });

      function doUpdate(id) {
         $("#eidt_id").val();
      }
   </script>
</body>

</html>