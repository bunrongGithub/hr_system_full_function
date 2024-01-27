<?php
require './function.php';
if (request('btnadd')) {
   /**
    * a data request
    */
   $data = [
      'paym_invoice_no' => $_POST['txt_invoice_no'],
      'paym_total' => $_POST['txt_total'],
      'paym_desc' => $_POST['txt_desc'],
      'paym_issue_date' => $_POST['txt_date'],
      'paym_user_id' => $user_id,
      'paym_created_at' => $datetime,
   ];
   /**
    * file that we need to requires
    */
   $require_fields = [
      'paym_total',
      'paym_invoice_no',
      'paym_user_id',
      'paym_desc',
      'paym_issue_date'
   ];
   Validator::has_require($data, $require_fields) ?
      /**
       * if the field is required it will be called the insert function 
       */
      $insert = insert($data, "payment", $connect)
      :
      redirect('validate', 'payment');
   $insert ?
      redirect('success', 'payment')
      :
      '';
}
/** let upload the images */
$image_dir = '../img/upload/payment';
if (request('btnimage')) {
   $data_params = [
      'img_key' => 'txt_image',
      'image_dir' => $image_dir,
      'table_name' => 'payment',
      'set_column_name' => 'paym_attach_invoice_file',
      'where_id_column_table' => 'paym_id',
      'post_id' => 'txt_id',
      'setRedictedErrorPage' => 'payment',
   ];
   $img = upload_img_only($data_params, $connect);
   $img ? redirect('update', 'payment') : redirect('notsuccess', 'payment');
}
/** opent status for paid */
$_file_dir = "../img/upload/payment/files/";


if (request('btnstatus')) {
   if (!empty($_FILES['txt_st_file']['name'])) {
      $_file = $_FILES['txt_st_file'];
      $_file_dir .= basename($_FILES['txt_st_file']['name']);
      $_file_type = strtolower(pathinfo($_file_dir, PATHINFO_EXTENSION));
      if ($_file_type == 'pdf') {
         $new_name = generateNewFileName();
         moveUploadedFile($new_name,$_file['tmp_name'],'../img/upload/payment/files/');
      }
   }
   $data = [
      'payms_payment_id' => $_POST['txt_status_id'],
      'payms_date' => $_POST['txt_st_payment_date'],
      'payms_paid' => $_POST['txt_st_paid'],
      'payms_file' => $new_name
   ];
   $data_require = ['payms_payment_id', 'payms_date', 'payms_paid'];
   Validator::has_require($data, $data_require) ?
      $insert = insert($data, 'txt_payment_status', $connect)
      :
      redirect('validate', 'payment');
   $data_update = [
      'paym_status' => $data['payms_payment_id']
   ];

   $update('payment', $data_update, 'paym_id', $data['payms_payment_id'], $connect) ?
      redirect('update', 'payment_history')
      :
      false;
}

/** let user delete the record */
if (get_req('delete')) {
   $result = $delete('delete', 'payment', 'paym_id', $connect);
   $result ? redirect('delete', 'payment') : '';
}

/** let user update the data */

if (request('btnupdate')) {
   $data = [
      'paym_id' => $_POST['txt_update_id'],
      'paym_desc' => $_POST['txt_update_desc'],
      'paym_total' => $_POST['txt_update_amount'],
      'paym_issue_date' => $_POST['txt_update_date'],
   ];
   $update('payment', $data, 'paym_id', $data['paym_id'], $connect);
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
            <h1>
               New Payment
            </h1>
         </section>
         <!-- Main content -->
         <section class="content">
            <!-- top row -->
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
                                 <h4 class="modal-title" id="exampleModalLabel">Add New Payment</h4>
                              </div>
                              <form action="" enctype="multipart/form-data" method="post">
                                 <div class="modal-body">
                                    <div class="col-xs-6 form-group">
                                       <label style="overflow: hidden; cursor: pointer; " id="autoRandomInvoice" for="">Invoice No(auto):
                                          <input type="checkbox" disabled name="" id="">
                                       </label>
                                       <input type="text" class="form-control" name="txt_invoice_no" id="txt_invoice_no">
                                    </div>
                                    <div class="col-xs-6 form-group">
                                       <label for="">Total Amount</label>
                                       <input type="text" class="form-control" name="txt_total" id="txt_total">
                                    </div>
                                    <div class="col-xs-6 form-group">
                                       <label for="txt_date">Issue Date:</label>
                                       <input type="date" class="form-control" name="txt_date" id="txt_date">
                                    </div>
                                    <div class="col-xs-6 form-group">
                                       <label for="">Description:</label>
                                       <input type="text" class="form-control" name="txt_desc" id="txt_desc">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnadd" class="btn btn-sm btn-primary">Save</button>
                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- // FILE MODAL  -->
                     <div class="modal fade" id="FILEMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLabel"></h4>
                              </div>
                              <form enctype="multipart/form-data" action="" method="post">
                                 <input type="hidden" name="txt_id" class="form-control" id="txt_id">
                                 <div class="modal-body">
                                    <div class="col-xs-12 form-group">
                                       <img width="550" height="500" class="rounded img-thumbnail img-fuild" id="txt_show_images" alt="....">
                                       <input onchange="eventChange(event)" accept="image/*" type="file" name="txt_image" class="form-control" id="txt_image">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnimage" class="btn btn-sm btn-primary">Save</button>
                                    <button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                     <div class="modal fade" id="doStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLabel">Update Status</h4>
                              </div>
                              <form enctype="multipart/form-data" method="post" action="">
                                 <input type="hidden" name="txt_status_id" class="form-control" id="txt_status_id">
                                 <div class="modal-body">
                                    <div class="col-xs-6">
                                       <label for="">Invoice No:</label>
                                       <input readonly type="text" name="txt_st_invoice" id="txt_st_invoice" class="form-control">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Payment Date:</label>
                                       <input type="date" name="txt_st_payment_date" id="txt_st_payment_date" class="form-control">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Description:</label>
                                       <input readonly type="text" name="txt_st_desc" id="txt_st_desc" class="form-control">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Attach FILE(PDF):</label>
                                       <input type="file" accept="application/pdf" name="txt_st_file" id="txt_st_file" class="form-control">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Total Amount:</label>
                                       <input type="text" readonly name="txt_st_amount" id="txt_st_amount" class="form-control">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Status:</label><br>
                                       <span>Paid: </span>
                                       <input type="radio" name="txt_st_paid" value="1" class="form-control" id="">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnstatus" class="btn btn-sm btn-primary">Save</button>
                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="doUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 <h4 class="modal-title" id="exampleModalLabel">Update</h4>
                              </div>
                              <form enctype="multipart/form-data" method="post" action="">
                                 <input type="hidden" name="txt_update_id" class="form-control" id="txt_update_id">
                                 <div class="modal-body">
                                    <div class="col-xs-6">
                                       <label for="">Description:</label>
                                       <input type="text" name="txt_update_desc" id="txt_update_desc" class="form-control">
                                    </div>
                                    <div class="col-xs-6 form-group">
                                       <label for="txt_date">Issue Date:</label>
                                       <input type="date" class="form-control" name="txt_update_date" id="txt_update_date">
                                    </div>
                                    <div class="col-xs-6">
                                       <label for="">Total Amount:</label>
                                       <input type="text" name="txt_update_amount" id="txt_update_amount" class="form-control">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="btnupdate" class="btn btn-sm btn-primary">Save</button>
                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="box-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Issue Date</th>
                                    <th>Description</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Attach File</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 //paym_id ,paym_issue_date,paym_invoice_no,paym_desc,paym_total,paym_status,paym_user_id,paym_created_at,paym_updated_at
                                 $sql = "select * from payment";
                                 $result = $connect->query($sql);
                                 $i = 1;

                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_invoice_no = $row['paym_invoice_no'];
                                    $v_desc = $row['paym_desc'];
                                    $v_total_amount = $row['paym_total'];
                                    $v_status = $row['paym_status'];
                                    $v_attach_invoice_file = $row['paym_attach_invoice_file'];
                                    $v_issue_date = $row['paym_issue_date'];
                                 ?>
                                    <tr>
                                       <td><?= $v_i ?></td>
                                       <td><?= $v_invoice_no; ?></td>
                                       <td><?= $v_issue_date; ?></td>
                                       <td><?= $v_desc; ?></td>
                                       <td><?= $v_total_amount; ?></td>
                                       <td class="text-center">
                                          <?php
                                          if ($v_status == '') {
                                          ?>
                                             <a data-toggle="modal" data-target="#doStatus" onclick="doStatus(
                                                <?= $row['paym_id']; ?>,
                                                '<?= $row['paym_invoice_no']; ?>',
                                                '<?= $row['paym_desc']; ?>',
                                                '<?= $row['paym_total']; ?>',
                                             )" style=" font-size:20px; text-decoration: underline; color:#0066CC; " href="#">open tatus
                                                <i class="fa fa-pencil"></i>
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a style=" font-size:20px; color:#0066CC; " href="#">Paid
                                                <i class="fa fa-check"></i>
                                             </a>
                                          <?php
                                          }
                                          ?>
                                       </td>
                                       <td class="text-center">
                                          <?php if ($v_attach_invoice_file != '') {
                                          ?>
                                             <a href="#">
                                                <img width="70" height="70" src="../img/invoice_image.png" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <img width="70" height="70" src="../img/no_image.jpg" alt="">
                                          <?php
                                          } ?>
                                          <a onclick="doImage('<?= $row['paym_id'] ?>','<?= $row['paym_attach_invoice_file'] ?>')" data-toggle="modal" data-target="#FILEMODAL" style="color: blue;" href="#">
                                             <i class="fa fa-pencil"></i>
                                          </a>
                                       </td>
                                       <td style="width: 140px;" class="text-center">
                                          <a data-toggle="modal" data-target="#doUpdate" style="color: #fff;" class="btn btn-sm btn-info" href="#" onclick="doUpdate(<?= $row['paym_id'] ?>,'<?= $row['paym_desc'] ?>','<?= $row['paym_total']; ?>','<?= $row['paym_issue_date']; ?>');">
                                             <i class="fa fa-edit"></i>

                                          </a>
                                          <a style="color: #ffff;" onclick="return confirm('Are you sure delete?') " class="btn btn-sm btn-danger" href="./payment.php?delete=<?= $row['paym_id'] ?>"><i class="fa fa-trash-o"></i></a>
                                       </td>
                                    </tr>
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

   <!-- page script -->
   <script type="text/javascript">
      function doUpdate(id, desc, total, date) {
         $("#txt_update_id").val(id);
         $("#txt_update_desc").val(desc);
         $("#txt_update_amount").val(total);
         $("#txt_update_date").val(date);
      }
      // Get the element references outside the event listener for efficiency
      const autoRandomInvoice = document.getElementById("autoRandomInvoice");
      const invoiceNumberElement = document.getElementById("txt_invoice_no");

      // Fetch PHP data dynamically within the event listener
      autoRandomInvoice.addEventListener("click", (e) => {
         fetch('fetch_inviove_number.php') // Replace with your actual PHP endpoint
            .then(response => response.json())
            .then(phpData => {
               let invoice = phpData.inv_no;
               const lastNumber = invoice.match(/\d+$/)[0];

               const nextNumber = Number(lastNumber) + 1;
               invoiceNumberElement.value = `TGH${nextNumber}`;
            })
            .catch(error => {
               console.error("Error fetching PHP data:", error);
            });
      }, false);

      function doImage(id, imageName) {
         if (imageName == null || imageName == '') {
            document.getElementById("txt_show_images").setAttribute("src", "../img/no_image.jpg");
         } else {
            document.getElementById("txt_show_images").setAttribute("src", "../img/invoice_image.png");
         }
         $("#txt_id").val(id);
      }

      function eventChange(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("txt_show_images").src = src;
         }
      }

      function doStatus(id, invoice_no, desc, total) {
         $("#txt_status_id").val(id);
         $("#txt_st_invoice").val(invoice_no);
         $("#txt_st_desc").val(desc);
         $("#txt_st_amount").val(total);
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_payment").addClass("active");
         $("#payment").addClass("active");
         $("#payment").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>