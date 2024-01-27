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
   $sql = "DELETE FROM loan_schedule where ls_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:loan_payment_schedule.php?message=delete'));
}

if (isset($_POST["btnadd"])) {
   $v_request_no = $_POST['request_no'];
   $v_start_date = $_POST['start_date'];
   $v_end_date = $_POST['end_date'];
   $v_repayment_date = $_POST['repayment_date'];
   $v_user = $_POST['user'];
   $v_remark = $_POST["remark"];
   $datetime = date('Y-m-d H:i:s');

   $sql = "INSERT INTO loan_schedule
                        (
                            ls_request_no
                           ,ls_start_date
                           ,ls_end_date
                           ,ls_repayment_date
                           ,ls_user_id
                           ,ls_note
                           ,created_at
                        )
                    VALUES
                        (
                            '$v_request_no'
                           ,'$v_start_date'
                           ,'$v_end_date'
                           ,'$v_repayment_date'
                           ,'$v_user'
                           ,'$v_remark'
                           ,'$datetime'
                        )";
   $result = mysqli_query($connect, $sql);
   header('location: loan_payment_schedule.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["loan_schedule_id"];
   $edit_start_date = $_POST["edit_start_date"];
   $edit_end_date = $_POST["edit_end_date"];
   $edit_repayment_date = $_POST["edit_repayment_date"];
   $edit_user = $_POST["edit_user"];
   $edit_note = $_POST["edit_note"];

   $sql = "UPDATE loan_schedule SET
                        ls_start_date = '$edit_start_date',
                        ls_end_date = '$edit_end_date',
                        ls_repayment_date = '$edit_repayment_date',
                        ls_user_id = '$edit_user',
                        ls_note = '$edit_note'
                        WHERE ls_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:loan_payment_schedule.php?message=update');
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
            <h1 class="text-primary">Loan Payment Schedule<h1>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                     <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                     Add New
                  </button>
         </section>
         <section class="content">
            <div class="row">
               <!-- Modal Add New -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width: 900px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> Pay New OT</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-12">
                                       <div class="col-md-12">
                                          <label for="">Loan Request No:</label>
                                          <select class="form-control" name="request_no" id="request_no" data-live-search="true" required="required">
                                             <option disabled selected>Select Loan Request No</option>
                                             <?php
                                             $sql = 'SELECT * FROM loan_request
                                                                    LEFT JOIN employee_registration on employee_registration.er_id=loan_request.lr_job_id';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['lr_id'] . '" titile="' . $row['lr_request_no'] . '" > ID:' . $row['lr_request_no'] . ' &nbsp &nbsp &nbsp &nbsp Name:' . $row['er_name_kh'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-12">
                                          <div id="amount_data"></div>
                                          <div class="form-group col-xs-4 show_hid" style="visibility: hidden;">
                                             <label for="">Start Date:</label>
                                             <input class="form-control" type="date" name="start_date" id="">
                                          </div>
                                          <div class="form-group col-xs-4 show_hid" style="visibility: hidden;">
                                             <label for="">End Date:</label>
                                             <input class="form-control" type="date" name="end_date" id="">
                                          </div>
                                          <div class="form-group col-xs-4 show_hid" style="visibility: hidden;">
                                             <label for="">Repayment Date:</label>
                                             <input class="form-control" type="date" name="repayment_date" id="">
                                          </div>
                                          <div class="form-group col-xs-4 show_hid" style="visibility: hidden;">
                                             <label for="ot-type">Input By</label>
                                             <select class="form-control select2" name="user" id="">
                                                <option value="">===Select===</option>
                                                <?php
                                                $v_sellect = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                                while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                ?>
                                                   <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-12 show_hid" style="visibility: hidden;">
                                             <label for="">Remark:</label>
                                             <textarea class="form-control" type="text" name="remark" id=""></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer col-md-12">
                                       <button name="btnadd" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End modal Add New-->

               <!-- modal edit -->
               <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
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
                                 <input class="hidden" type="text" name="loan_schedule_id" id="loan_schedule_id">
                                 <div class="form-group col-xs-6">
                                    <label for="">Start Date:</label>
                                    <input class="form-control" type="date" name="edit_start_date" id="edit_start_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">End Date:</label>
                                    <input class="form-control" type="date" name="edit_end_date" id="edit_end_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Repayment Date:</label>
                                    <input class="form-control" type="date" name="edit_repayment_date" id="edit_repayment_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="ot-type">Input By</label>
                                    <select class="form-control select2" name="edit_user" id="edit_user">
                                       <option value="">===Select===</option>
                                       <?php
                                       $v_sellect = mysqli_query($connect, "SELECT * FROM user ORDER BY username ASC");
                                       while ($row = mysqli_fetch_assoc($v_sellect)) {
                                       ?>
                                          <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label for="">Remark:</label>
                                    <textarea class="form-control" type="text" name="edit_note" id="edit_note"></textarea>
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
               <!-- end modal edit -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box border">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Job_Id</th>
                              <th>Employee Info</th>
                              <th>Compnay Info</th>
                              <th>Loan Amount</th>
                              <th>Loan Rate</th>
                              <th>Monthly Payment Amount</th>
                              <th>Loan Term</th>
                              <th>Input BY/Date</th>
                              <th>Note</th>
                              <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM loan_schedule A 
                                             LEFT JOIN loan_request B on B.lr_id=A.ls_request_no
                                             LEFT JOIN employee_registration C on C.er_id=B.lr_job_id
                                             LEFT JOIN gender D on D.ge_id=B.lr_gender_id
                                             LEFT JOIN position E on E.position_id=B.lr_position_id
                                             LEFT JOIN company F on F.c_id=B.lr_company_id
                                             LEFT JOIN user_branch G on G.ub_id=B.lr_branch_id
                                             LEFT JOIN department H on H.de_id=B.lr_department_id
                                             LEFT JOIN user I on I.id=A.ls_user_id
                                             LEFT JOIN text_loan_request_loan_term J on J.tlt_id=B.lr_loan_term_id
                                             ";
                           $result = $connect->query($sql);
                           $i = 1;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_job_id = $row["er_job_id"];
                              $v_name_kh = $row["er_name_kh"];
                              $v_gender_id = $row["ge_name"];
                              $v_position_id = $row["position"];
                              $v_company_id = $row["c_name_kh"];
                              $v_ub_id = $row["ub_name"];
                              $v_department_id = $row["de_name"];
                              $v_id = $row["username"];
                              $v_loan_amount = $row["lr_loan_amount"];
                              $v_loan_rate = $row["lr_loan_rate"];
                              $v_total_monthly_payment = $row["lr_total_monthly_payment"];
                              $v_tlt_name = $row["tlt_name"];
                              $v_note = $row["ls_note"];
                           ?>
                              <tr>
                                 <td><?php echo $v_i; ?></td>
                                 <td><?php echo $v_job_id; ?></td>
                                 <td>
                                    <i>Name: </i><?php echo $v_name_kh; ?> <br>
                                    <i>Sex: </i><?php echo $v_gender_id; ?> <br>
                                    <i>Position: </i><?php echo $v_position_id; ?>
                                 </td>
                                 <td>
                                    <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                    <i>Branch: </i><?php echo $v_ub_id; ?> <br>
                                    <i>Department: </i> <?php echo $v_department_id; ?> <br>
                                 </td>
                                 <td><?php echo $v_loan_amount; ?>$</td>
                                 <td><?php echo $v_loan_rate; ?>%</td>
                                 <td><?php echo $v_total_monthly_payment; ?>$</td>
                                 <td><?php echo $v_tlt_name; ?></td>
                                 <td>
                                    <i>Input By: </i><?php echo $v_id; ?><br>
                                    <i>Date :</i><?php echo $datetime; ?>
                                 </td>
                                 <td><?php echo $v_note; ?></td>
                                 <td width="150px">
                                    <a href="loan_payment_schedule_view.php?id=<?php echo $row['ls_id']; ?>" class="btn btn-info btn-sm">
                                       <i style="color:white;" class="fa fa-eye"></i>
                                    </a>
                                    <a target="_blank" href="loan_payment_schedule_print.php?id=<?php echo $row['ls_id']; ?>" class="btn btn-success btn-sm">
                                       <i style="color:white;" class="fa fa-print"></i>
                                    </a>
                                    <!--insert-->
                                    <a onclick="doUpdate(
                                                                    '<?php echo $row['ls_id']; ?>',
                                                                    '<?php echo $row['ls_start_date']; ?>',
                                                                    '<?php echo $row['ls_end_date']; ?>',
                                                                    '<?php echo $row['ls_repayment_date']; ?>',
                                                                    '<?php echo $row['ls_user_id']; ?>',
                                                                    '<?php echo $row['ls_note']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="loan_payment_schedule.php?del_id=<?php echo $row['ls_id']; ?>" class="btn btn-danger btn-sm">
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
         $('#request_no').change(function() {
            $('.show_hid').css("visibility", "visible");
            var job_id = $("#request_no").val();
            if (job_id) {
               $.ajax({
                  type: 'POST',
                  url: 'fetch_request_no.php',
                  data: {
                     'loan_requeest_id': job_id
                  },
                  success: function(html) {
                     $('#amount_data').html(html);
                  }
               });
            }
         })

         function doUpdate(id, start_date, end_date, repayment_date, user, note) {
            $('#loan_schedule_id').val(id);
            $('#edit_start_date').val(start_date);
            $('#edit_end_date').val(end_date);
            $('#edit_repayment_date').val(repayment_date);
            $('#edit_user').val(user).change();
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
            $("#menu_loan").addClass("active");
            $("#loan_payment_schedule").addClass("active");
            $("#loan_payment_schedule").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>
</body>
</html>