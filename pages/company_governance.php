<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];
   $sql = "DELETE FROM company_governance where cg_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:company_governance.php?message=delete'));
}

if (isset($_POST["btnadd"])) {
   $v_txt_document_name = $_POST["txt_document_name"];
   $v_txt_company_mane = $_POST["txt_company_mane"];
   $v_txt_branch_mane = $_POST["txt_branch_mane"];
   $v_txt_expired_start = $_POST["txt_expired_start"];
   $v_txt_expired_end = $_POST["txt_expired_end"];
   $v_txt_expired_period = $_POST["txt_expired_period"];
   $v_txt_alert_from = $_POST["txt_alert_from"];
   $v_txt_alert_to = $_POST["txt_alert_to"];
   $v_txt_alert_time = $_POST["txt_alert_time"];
   $v_text_remark = $_POST["text_remark"];
   $datetime = date('Y-m-d H:i:s');

   $sql = "INSERT INTO company_governance
                        (
                            cg_document,
                            cg_company_id,
                            cg_branch_id,
                            cg_expired_start,
                            cg_expired_end,
                            cg_expired_period,
                            cg_alert_from,
                            cg_alert_to,
                            cg_alert_qty,
                            cg_note,
                            cg_create_at
                        )
                    VALUES
                        (
                            '$v_txt_document_name',
                            '$v_txt_company_mane',
                            '$v_txt_branch_mane',
                            '$v_txt_expired_start',
                            '$v_txt_expired_end',
                            '$v_txt_expired_period',
                            '$v_txt_alert_from',
                            '$v_txt_alert_to',
                            '$v_txt_alert_time',
                            '$v_text_remark',
                            '$datetime'
                        )
                        ";
   $result = mysqli_query($connect, $sql);
   header("location: company_governance.php?message=success");
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["company_governance_id"];
   $edit_document = $_POST["edit_document"];
   $edit_company = $_POST["edit_company"];
   $edit_branch = $_POST["edit_branch"];
   $edit_start = $_POST["edit_start"];
   $edit_end = $_POST["edit_end"];
   $edit_period = $_POST["edit_period"];
   $edit_from = $_POST["edit_from"];
   $edit_to = $_POST["edit_to"];
   $edit_qty = $_POST["edit_qty"];
   $edit_note = $_POST["edit_note"];

   $sql = "UPDATE company_governance SET
                        cg_document = '$edit_document',
                        cg_company_id = '$edit_company',
                        cg_branch_id = '$edit_branch',
                        cg_expired_start = '$edit_start',
                        cg_expired_end = '$edit_end',
                        cg_expired_period = '$edit_period',
                        cg_alert_from = '$edit_from',
                        cg_alert_to = '$edit_to',
                        cg_alert_qty = '$edit_qty',
                        cg_note = '$edit_note'
                        WHERE cg_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:company_governance.php?message=update');
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
            <h1 class="text-primary">Company Governance<h1>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                     Add New
                  </button>
         </section>
         <!-- Modal add new -->
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="width: 750px;">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Company Governance</h4>
                  </div>
                  <form method="post" enctype="multipart/form-data" action="">
                     <div class="modal-body">
                        <div class="col-md-12">
                           <div class="col-md-4">
                              <div class="form-group col-md-12">
                                 <label for="">Document Name:</label>
                                 <input class="form-control" type="text" name="txt_document_name" id="">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Company Name:</label>
                                 <select class="form-control select2" name="txt_company_mane" id="">
                                    <option value=""></option>
                                    <?php
                                    $v_sellect = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                    ?>
                                       <option value="<?php echo $row['c_id'] ?>"><?php echo $row['c_name_kh'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Branch Name:</label>
                                 <select class="form-control select2" name="txt_branch_mane" id="">
                                    <option value=""></option>
                                    <?php
                                    $v_sellect = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                    ?>
                                       <option value="<?php echo $row['ub_id'] ?>"><?php echo $row['ub_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-8">
                              <div class="form-group col-xs-12">
                                 <h3><b>Expired Document</b></h3>
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Start:</label>
                                 <input class="form-control" type="date" name="txt_expired_start" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">End:</label>
                                 <input class="form-control" type="date" name="txt_expired_end" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Period:</label>
                                 <input class="form-control" type="text" name="txt_expired_period" id="">
                              </div>
                              <div class="form-group col-xs-12">
                                 <h3><b>Duration Alert</b></h3>
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">From:</label>
                                 <input class="form-control" type="date" name="txt_alert_from" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">To:</label>
                                 <input class="form-control" type="date" name="txt_alert_to" id="">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Alert Time:</label>
                                 <input class="form-control" type="text" name="txt_alert_time" id="">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Remark:</label>
                                 <textarea class="form-control" name="text_remark" id="" cols="30" rows=""></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                           <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        </div>

                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- end Modal add new -->
         <!-- modal edit -->
         <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 750px;">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                  </div>
                  <div class="modal-body">
                     <div class="col-md-12">
                        <form action="" method="post" enctype="multipart/form-data">
                           <input class="hidden" type="text" name="company_governance_id" id="company_governance_id">
                           <div class="col-md-4">
                              <div class="form-group col-md-12">
                                 <label for="">Document Name:</label>
                                 <input class="form-control" type="text" name="edit_document" id="edit_document">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Company Name:</label>
                                 <select class="form-control select2" name="edit_company" id="edit_company">
                                    <option value=""></option>
                                    <?php
                                    $v_sellect = mysqli_query($connect, "SELECT * FROM company ORDER BY c_name_kh ASC");
                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                    ?>
                                       <option value="<?php echo $row['c_id'] ?>"><?php echo $row['c_name_kh'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Branch Name:</label>
                                 <select class="form-control select2" name="edit_branch" id="edit_branch">
                                    <option value=""></option>
                                    <?php
                                    $v_sellect = mysqli_query($connect, "SELECT * FROM user_branch ORDER BY ub_name ASC");
                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                    ?>
                                       <option value="<?php echo $row['ub_id'] ?>"><?php echo $row['ub_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-8">
                              <div class="form-group col-xs-12">
                                 <h3><b>Expired Document</b></h3>
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Start:</label>
                                 <input class="form-control" type="date" name="edit_start" id="edit_start">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">End:</label>
                                 <input class="form-control" type="date" name="edit_end" id="edit_end">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Period:</label>
                                 <input class="form-control" type="text" name="edit_period" id="edit_period">
                              </div>
                              <div class="form-group col-xs-12">
                                 <h3><b>Duration Alert</b></h3>
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">From:</label>
                                 <input class="form-control" type="date" name="edit_from" id="edit_from">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">To:</label>
                                 <input class="form-control" type="date" name="edit_to" id="edit_to">
                              </div>
                              <div class="form-group col-xs-6">
                                 <label for="">Alert Time:</label>
                                 <input class="form-control" type="text" name="edit_qty" id="edit_qty">
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="">Remark:</label>
                                 <textarea class="form-control" name="edit_note" id="edit_note" cols="30" rows=""></textarea>
                              </div>
                           </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- end edit -->
         <section class="content">
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box border">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Document Name</th>
                              <th>Company Name</th>
                              <th>Branch Name</th>
                              <th>Expired Document</th>
                              <th>Document List </th>
                              <th>Note</th>
                              <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM company_governance A
                                            LEFT JOIN company B on B.c_id=A.cg_company_id 
                                            LEFT JOIN user_branch C on C.ub_id=A.cg_branch_id
                                           ";
                           $result = $connect->query($sql);
                           // $row=$result->fetch_assoc();
                           // echo $row['ef_date'];
                           $i = 1;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_document_name = $row["cg_document"];
                              $v_company_id = $row["c_name_kh"];
                              $v_branch_id = $row["ub_name"];
                              $v_expired_start = $row["cg_expired_start"];
                              $v_expired_end = $row["cg_expired_end"];
                              $v_expired_period = $row["cg_expired_period"];
                              $v_expired_period = $row["cg_expired_period"];
                              $v_note = $row["cg_note"];
                           ?>
                              <tr>
                                 <td><?php echo $v_i; ?></td>
                                 <td><?php echo $v_document_name; ?></td>
                                 <td><?php echo $v_company_id; ?></td>
                                 <td><?php echo $v_branch_id; ?></td>
                                 <td>
                                    <i>Start:</i> <?php echo $v_expired_start; ?> <br>
                                    <i>End: </i> <?php echo $v_expired_end; ?> <br>
                                    <i>Period: </i> <?php echo $v_expired_period; ?>
                                 </td>
                                 <td>
                                    <?php
                                    $v_cg_id = $row["cg_id"];
                                    $sql_sub = "SELECT * FROM company_gov_document A
                                                                WHERE cgd_com_gov_id='$v_cg_id'
                                                                ";
                                    $result_sub = $connect->query($sql_sub);

                                    $isub = 1;
                                    while ($row_sub = $result_sub->fetch_assoc()) {
                                       $v_isub = $isub++;
                                       $v_document_name = $row_sub["cgd_doc_name"];
                                    ?>
                                       <a style="color: black;text-decoration: underline;" href="../img/file/<?= $row_sub['cgd_attach_file']; ?>"><?php echo $v_isub . ' - ' . $v_document_name ?></a><br>
                                    <?php
                                    }
                                    ?>
                                 </td>
                                 <td><?php echo $v_note; ?></td>
                                 <td width="110px">
                                    <a href="company_governance_edit.php?id=<?php echo $row['cg_id']; ?>" class="btn btn-info btn-sm">
                                       <i style="color:white;" class="fa fa-eye"></i>
                                    </a>
                                    <!--insert-->
                                    <a onclick="doUpdate(
                                                                    '<?php echo $row['cg_id']; ?>',
                                                                    '<?php echo $row['cg_document']; ?>',
                                                                    '<?php echo $row['cg_company_id']; ?>',
                                                                    '<?php echo $row['cg_branch_id']; ?>',
                                                                    '<?php echo $row['cg_expired_start']; ?>',
                                                                    '<?php echo $row['cg_expired_end']; ?>',
                                                                    '<?php echo $row['cg_expired_period']; ?>',
                                                                    '<?php echo $row['cg_alert_from']; ?>',
                                                                    '<?php echo $row['cg_alert_to']; ?>',
                                                                    '<?php echo $row['cg_alert_qty']; ?>',
                                                                    '<?php echo $row['cg_note']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="company_governance.php?del_id=<?php echo $row['cg_id']; ?>" class="btn btn-danger btn-sm">
                                       <i style="color:white;" class="fa fa-trash"></i>
                                    </a>
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

         </section>


      </aside>

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

      <!-- page script -->
      <script type="text/javascript">
         function doUpdate(id, document, company, branch, start, end, period, from, to, qty, note) {
            $('#company_governance_id').val(id);
            $('#edit_document').val(document);
            $('#edit_company').val(company).change();
            $('#edit_branch').val(branch).change();
            $('#edit_start').val(start);
            $('#edit_end').val(end);
            $('#edit_period').val(period);
            $('#edit_from').val(from);
            $('#edit_to').val(to);
            $('#edit_qty').val(qty);
            $('#edit_note').val(note);
         }
         $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
               "bPaginate": true,
               "bLengthChange": false,
               "bFilter": false,
               "bSort": true,
               "bInfo": true,
               "bAutoWidth": false
            });
         });
         $(function() {
            $("select").selectpicker();
            $("#menu_admin").addClass("active");
            $("#company_governance").addClass("active");
            $("#company_governance").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
         window.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
               var no = 1;
               $(".add-row").on('click', function() {
                  var document = "<td><input class='form-control' name='txt_document_list[]' id='txt_document_list' type='text'></td>";
                  var file = "<td><input class='form-control' name='txt_file[]' id='txt_file' type='file'></td>";
                  var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
                  var markup = "<tr>" + "<td><input disable type='text' class='form-control' value='" + no + "' name='auto_count_id[]' id='auto_count_id'/></td>" + document + file + remove_button + "</tr>";
                  $("#asset_table").append(markup); //    $("thead tr")[i].append(action);
                  no++;
                  $("#asset_table").on('click', '.remove-row', function() {
                     $(this).closest("tr").remove();
                     if (("#asset_table")) {
                        no = 1;
                     }
                  });
               });
            });
         });
      </script>

</body>

</html>