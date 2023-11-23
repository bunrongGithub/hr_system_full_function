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
   $sql = "DELETE FROM pay_commission where pcom_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:pay_commission.php?message=delete'));
}

if (isset($_POST["btnadd"])) {
   $v_txt_job_id = $_POST["txt_job_id"];
   $v_txt_target_amount = $_POST["txt_target_amount"];
   $v_txt_achieved_amount_in_month = $_POST["txt_achieved_amount_in_month"];
   $v_txt_commission_rate = $_POST["txt_commission_rate"];
   $v_txt_commission_amount = $_POST["txt_commission_amount"];
   $v_txt_commission_paid_amount = $_POST["txt_commission_paid_amount"];
   $v_txt_total_commission_to_amount = $_POST["txt_total_commission_to_amount"];
   $v_txt_other_incentives = $_POST["txt_other_incentives"];
   $v_txt_payment_date = $_POST["txt_payment_date"];
   $v_txt_status = $_POST["txt_status"];
   $v_txt_user = $_POST["txt_user"];
   $v_txt_remark = $_POST["txt_remark"];
   $datetime = date('Y-m-d H:i:s');

   $sql = "INSERT INTO pay_commission
                        (
                            pcom_job_id,
                            pcom_target_amount,
                            pcom_achieved_amount_in_month,
                            pcom_commission_rate,
                            pcom_commission_amount,
                            pcom_commission_paid_amount,
                            pcom_total_commission_to_pay,
                            pcom_other_incentives,
                            pcom_payment_date,
                            pcom_status_id,
                            pcom_user_id,
                            pcom_note,
                            created_at
                        )
                    VALUES
                        (
                            '$v_txt_job_id',
                            '$v_txt_target_amount',
                            '$v_txt_achieved_amount_in_month',
                            '$v_txt_commission_rate',
                            '$v_txt_commission_amount',
                            '$v_txt_commission_paid_amount',
                            '$v_txt_total_commission_to_amount',
                            '$v_txt_other_incentives',
                            '$v_txt_payment_date',
                            '$v_txt_status',
                            '$v_txt_user',
                            '$v_txt_remark',
                            '$datetime'
                        )";
   $result = mysqli_query($connect, $sql);
   header('location: pay_commission.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["pay_com_id"];
   $edit_achieved = $_POST["edit_achieved"];
   $edit_target_amount = $_POST["edit_target_amount"];
   $edit_commission_rate = $_POST["edit_commission_rate"];
   $edit_commission_amount = $_POST["edit_commission_amount"];
   $edit_commission_paid_amount = $_POST["edit_commission_paid_amount"];
   $edit_total_commission = $_POST["edit_total_commission"];
   $edit_incentives = $_POST["edit_incentives"];
   $edit_payment_date = $_POST["edit_payment_date"];
   $edit_status = $_POST["edit_status"];
   $edit_user = $_POST["edit_user"];
   $edit_note = $_POST["edit_note"];

   $sql = "UPDATE pay_commission SET
                        pcom_achieved_amount_in_month = '$edit_achieved',
                        pcom_target_amount = '$edit_target_amount',
                        pcom_commission_rate = '$edit_commission_rate',
                        pcom_commission_amount = '$edit_commission_amount',
                        pcom_commission_paid_amount = '$edit_commission_paid_amount',
                        pcom_total_commission_to_pay = '$edit_total_commission ',
                        pcom_other_incentives = '$edit_incentives',
                        pcom_payment_date = '$edit_payment_date',
                        pcom_status_id = '$edit_status',
                        pcom_user_id = '$edit_user',
                        pcom_note = '$edit_note'
                        WHERE pcom_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:pay_commission.php?message=update');
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
         <section class="content-header">
            <h1 class="text-primary">Pay Commission<h1>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                     <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                     Add New
                  </button>
         </section>
         <section class="content">
            <div class="row">
               <!-- modal add new -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width: 900px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> Pay New Commission</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-12">
                                       <div class="col-md-12">
                                          <label for="">Job ID:</label>
                                          <select class="form-control" name="txt_job_id" id="txt_job_id" data-live-search="true" required="required">
                                             <option disabled selected>Please Select Job ID</option>
                                             <?php
                                             $sql = 'SELECT * FROM employee_registration';
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['er_id'] . '" titile="' . $row['er_job_id'] . '" > ID:' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name:' . $row['er_name_kh'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="col-md-4">
                                             <div id="amount_data"></div>
                                          </div>
                                          <div class="col-md-8">
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Achieved Amount in Month:</label>
                                                <input class="form-control" type="text" name="txt_achieved_amount_in_month" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Target Amount:</label>
                                                <input class="form-control" type="text" name="txt_target_amount" id="">
                                             </div>
                                             <div class="form-group col-xs-4 show_hid" style="display: none;">
                                                <input class="form-control" type="radio" name="txt_target" id="" value="1"> Less Than Target
                                             </div>
                                             <div class="form-group col-xs-4 show_hid" style="display: none;">
                                                <input class="form-control" type="radio" name="txt_target" id="" value="2"> Reach Target
                                             </div>
                                             <div class="form-group col-xs-4 show_hid" style="display: none;">
                                                <input class="form-control" type="radio" name="txt_target" id="" value="3"> Over Target
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Commission Rate:</label>
                                                <input class="form-control" type="text" name="txt_commission_rate" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Commission Amount:</label>
                                                <input class="form-control" type="text" name="txt_commission_amount" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Commission Paid Amount:</label>
                                                <input class="form-control" type="text" name="txt_commission_paid_amount" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Total Commission To Pay:</label>
                                                <input class="form-control" type="text" name="txt_total_commission_to_amount" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Other Incentives:</label>
                                                <input class="form-control" type="text" name="txt_other_incentives" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Payment Date:</label>
                                                <input class="form-control" type="date" name="txt_payment_date" id="">
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Status</label>
                                                <select class="form-control select2" name="txt_status" id="">
                                                   <option value="">===Select===</option>
                                                   <?php
                                                   $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_commission_status ORDER BY pcs_name ASC");
                                                   while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                   ?>
                                                      <option value="<?php echo $row['pcs_id'] ?>"><?php echo $row['pcs_name'] ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="ot-type">Input By</label>
                                                <select class="form-control select2" name="txt_user" id="">
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
                                             <div class="form-group col-xs-6 show_hid" style="display: none;">
                                                <label for="">Applied Increase to Salary:</label>
                                                <input class="form-control" type="checkbox" name="txt_check" id="">
                                             </div>
                                             <div class="form-group col-xs-12 show_hid" style="display: none;">
                                                <label for="">Remark:</label>
                                                <textarea class="form-control" name="txt_remark" id="" cols="30" rows="2"></textarea>
                                             </div>
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
               <!-- end add new -->

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
                                 <input class="hidden" type="text" name="pay_com_id" id="pay_com_id">
                                 <div class="form-group col-xs-6">
                                    <label for="">Achieved Amount in Month:</label>
                                    <input class="form-control" type="text" name="edit_achieved" id="edit_achieved">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Target Amount:</label>
                                    <input class="form-control" type="text" name="edit_target_amount" id="edit_target_amount">
                                 </div>
                                 <div class="form-group col-xs-4">
                                    <input class="form-control" type="radio" name="txt_target" id="" value="1"> Less Than Target
                                 </div>
                                 <div class="form-group col-xs-4">
                                    <input class="form-control" type="radio" name="txt_target" id="" value="2"> Reach Target
                                 </div>
                                 <div class="form-group col-xs-4">
                                    <input class="form-control" type="radio" name="txt_target" id="" value="3"> Over Target
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Commission Rate:</label>
                                    <input class="form-control" type="text" name="edit_commission_rate" id="edit_commission_rate">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Commission Amount:</label>
                                    <input class="form-control" type="text" name="edit_commission_amount" id="edit_commission_amount">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Commission Paid Amount:</label>
                                    <input class="form-control" type="text" name="edit_commission_paid_amount" id="edit_commission_paid_amount">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Total Commission To Pay:</label>
                                    <input class="form-control" type="text" name="edit_total_commission" id="edit_total_commission">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Other Incentives:</label>
                                    <input class="form-control" type="text" name="edit_incentives" id="edit_incentives">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Payment Date:</label>
                                    <input class="form-control" type="date" name="edit_payment_date" id="edit_payment_date">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Status</label>
                                    <select class="form-control select2" name="edit_status" id="edit_status">
                                       <option value="">===Select===</option>
                                       <?php
                                       $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_commission_status ORDER BY pcs_name ASC");
                                       while ($row = mysqli_fetch_assoc($v_sellect)) {
                                       ?>
                                          <option value="<?php echo $row['pcs_id'] ?>"><?php echo $row['pcs_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
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
                                 <div class="form-group col-xs-6">
                                    <label for="">Applied Increase to Salary:</label>
                                    <input class="form-control" type="checkbox" name="txt_check" id="">
                                 </div>
                                 <div class="form-group col-xs-12">
                                    <label for="">Remark:</label>
                                    <textarea class="form-control" name="edit_note" id="edit_note" cols="30" rows="2"></textarea>
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
               <div class="col-xs-12 connectedSortable">
                  <div class="box border">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Job_Id</th>
                              <th>Employee Info</th>
                              <th>Company Info</th>
                              <th>Target Amount</th>
                              <th>Commission Rate</th>
                              <th>Commission Amount</th>
                              <th>Commission Paid Amount</th>
                              <th>Payment Date</th>
                              <th>Status</th>
                              <th>Input By</th>
                              <th>Note</th>
                              <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM pay_commission A
                                            LEFT JOIN employee_registration B on B.er_id=A.pcom_job_id 
                                            LEFT JOIN gender C on C.ge_id=B.er_gender_id
                                            LEFT JOIN position D on D.position_id=B.er_position_id
                                            LEFT JOIN company E on E.c_id=B.er_company_id
                                            LEFT JOIN user_branch F on F.ub_id=B.er_branch_id
                                            LEFT JOIN department G on G.de_id=B.er_department_id
                                            LEFT JOIN user H on H.id=A.pcom_user_id
                                            LEFT JOIN text_pay_commission_status I on I.pcs_id=A.pcom_status_id
                                            ";
                           $result = $connect->query($sql);
                           // $row=$result->fetch_assoc();
                           // echo $row['ef_date'];
                           $i = 1;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_job_id = $row["er_job_id"];
                              $v_name_kh = $row["er_name_kh"];
                              $v_gender_id = $row["ge_name"];
                              $v_position_id = $row["position"];
                              $v_company_id = $row["c_name_kh"];
                              $v_branch_id = $row["ub_name"];
                              $v_department_id = $row["de_name"];
                              $v_user_id = $row["username"];
                              $v_target_amount = $row["pcom_target_amount"];
                              $v_commission_rate = $row["pcom_commission_rate"];
                              $v_commission_amount = $row["pcom_commission_amount"];
                              $v_commission_paid_amount = $row["pcom_commission_paid_amount"];
                              $v_payment_date = $row["pcom_payment_date"];
                              $v_status_id = $row["pcs_name"];
                              $v_note = $row["pcom_note"];
                           ?>
                              <tr>
                                 <td><?php echo $v_i; ?></td>
                                 <td><?php echo $v_job_id; ?></td>
                                 <td>
                                    <i>Name: </i><?php echo $v_name_kh; ?><br>
                                    <i>Sex: </i><?php echo $v_gender_id; ?><br>
                                    <i>Position: </i><?php echo $v_position_id; ?>
                                 </td>
                                 <td>
                                    <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                    <i>Branch: </i><?php echo $v_branch_id; ?> <br>
                                    <i>Department: </i><?php echo $v_department_id; ?> <br>
                                 </td>
                                 <td><?php echo $v_target_amount; ?>$</td>
                                 <td><?php echo $v_commission_rate; ?>%</td>
                                 <td><?php echo $v_commission_amount; ?>$</td>
                                 <td><?php echo $v_commission_paid_amount; ?>$</td>
                                 <td><?php echo $v_payment_date; ?></td>
                                 <td><?php echo $v_status_id; ?></td>
                                 <td>
                                    <i>User: </i><?php echo $v_user_id; ?><br>
                                    <i>Date: </i><?php echo $datetime; ?>
                                 </td>
                                 <td><?php echo $v_note; ?></td>
                                 <td>
                                    <!--insert-->
                                    <a onclick="doUpdate(
                                                                    '<?php echo $row['pcom_id']; ?>',
                                                                    '<?php echo $row['pcom_achieved_amount_in_month']; ?>',
                                                                    '<?php echo $v_target_amount; ?>',
                                                                    '<?php echo $v_commission_rate; ?>',
                                                                    '<?php echo $v_commission_amount; ?>',
                                                                    '<?php echo $v_commission_paid_amount; ?>',
                                                                    '<?php echo $row['pcom_total_commission_to_pay']; ?>',
                                                                    '<?php echo $row['pcom_other_incentives']; ?>',
                                                                    '<?php echo $v_payment_date; ?>',
                                                                    '<?php echo $row['pcom_status_id']; ?>',
                                                                    '<?php echo $row['pcom_user_id']; ?>',
                                                                    '<?php echo $v_note; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="pay_commission.php?del_id=<?php echo $row['pcom_id']; ?>" class="btn btn-danger btn-sm">
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
      <div>

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
            function doUpdate(id, achieved, target_amount, commission_rate, commission_amount, commission_paid_amount, total_commission, incentives, payment_date, status, user, note) {
               $('#pay_com_id').val(id);
               $('#edit_achieved').val(achieved);
               $('#edit_target_amount').val(target_amount);
               $('#edit_commission_rate').val(commission_rate);
               $('#edit_commission_amount').val(commission_amount);
               $('#edit_commission_paid_amount').val(commission_paid_amount);
               $('#edit_total_commission').val(total_commission);
               $('#edit_incentives').val(incentives);
               $('#edit_payment_date').val(payment_date);
               $('#edit_status').val(status);
               $('#edit_user').val(user);
               $('#edit_note').val(note);
            }

            $('#txt_job_id').change(function() {
               $('.show_hid').css("display", "block");
               var job_id = $("#txt_job_id").val();
               if (job_id) {
                  $.ajax({
                     type: 'POST',
                     url: 'fetch_pay_commission.php',
                     data: {
                        'pay_commission_job_id': job_id
                     },
                     success: function(html) {
                        $('#amount_data').html(html);
                     }
                  });
               }
            })
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
               $("#menu_salary").addClass("active");
               $("#pay_commission").addClass("active");
               $("#pay_commission").css("background-color", "##367fa9");
               $('#info_data').dataTable();
            });
         </script>

</body>

</html>