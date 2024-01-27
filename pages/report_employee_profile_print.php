<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM employee_registration A LEFT JOIN gender B ON B.ge_id = A.er_gender_id
   LEFT JOIN company C ON C.c_id = A.er_company_id LEFT JOIN department D ON D.de_id = A.er_department_id 
   LEFT JOIN position E ON E.position_id = A.er_position_id LEFT JOIN user_branch F ON F.ub_id = A.er_branch_id WHERE er_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_array($result);
   $v_job_id = $row['er_job_id'];
   $v_name = $row['er_name_kh'];
   $v_name1 = $row['er_name_en'];
   $v_gender = $row['er_gender_id'];
   $v_position = $row['er_position_id'];
   $v_branch= $row['er_branch_id'];
   $v_department = $row['er_department_id'];
   $v_company = $row['er_company_id'];
   $v_er_address = $row['er_address'];
   $v_er_contract = $row['er_contract_period'];
   $v_er_idcard = $row['er_idcard_no'];
   $v_er_nssf = $row['er_nssf_no'];
   $v_bank_name = $row['er_bank_acc_name'];
   $v_bank_num = $row['er_bank_acc_num'];
   $v_spouse = $row['er_spouse'];
   $v_children = $row['er_children'];
   $v_er_startwork = $row['er_startwork_date'];
   $v_er_endwork= $row['er_startwork_date'];
   $v_commodity = $row['er_commodity'];
   $v_renew_workdate = $row['er_renew_workdate'];
   $v_transportation_fee = $row['er_transportation_fee'];
   $v_transportation_support = $row['er_transportation_support'];
   $v_food_drink = $row['er_food_drink'];
   $v_insurance = $row['er_insurance'];
   $v_phone_card = $row['er_phone_card'];
   $v_traning_time = $row['er_traning_time'];
   $v_workplace_time = $row['er_workplace_time'];
   $v_total_eva_time = $row['er_total_eva_time'];
   $v_upgrade_position_time = $row['er_upgrade_position_time'];
   $v_total_warning_time = $row['er_total_warning_time'];
   $v_total_annual_leave = $row['er_total_annual_leave'];
   $v_employee_document_list = $row['er_employee_document_list'];
}
// print_r($v_position)
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
    <style>
      @media print{
         .btn-don-show {
            display: none;
         }
         .NoPrint{
            display: none;
         }
         #NoPrint{
            display: none;
         }
      }
      @media print {
         button,a {
            display: none !important;
         }
      }
   </style>
</head>

<body class="skin-black">
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
         <section class="content-header">
            <h1>
                Employee Profile
            </h1>
         </section>
         <section class="content">
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <div class="box-body table-responsive">
                           <div class="col-md-12">
                              <form action="" method="post" enctype="multipart/form-data">
                                 <input type="hidden" name="" value="<?php echo $row['er_id'] ?>" id="">
                                 <div class="form-group col-md-12">
                                    <div class="col-md-4">
                                       <div class="col-md-4" style=" margin-left: 13px; padding: 0; width: 110px; height: 110px; border: 1px solid gray; box-shadow: 0px 16px 48px 0px rgba(0, 0, 0, 0.176); ">
                                          <img style="width: 100%; height: 100%; " src="../img/<?php echo $row['c_logo']; ?>" alt="">   
                                       </div>
                                       <div class="col-md-8">
                                           <h3 style="font-weight: bold;">Company Name KH</h3>
                                           <h3 style="font-weight: bold;">Company Name EN</h3>
                                       </div>
                                       <div class="col-md-12">
                                          <h2 style="font-weight: bold;">Employee Profile</h2>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="col-md-4" style="margin-top: 15px; padding: 0; width: 130px; height: 163px; border: 1px solid gray; box-shadow: 0px 16px 48px 0px rgba(0, 0, 0, 0.176); ">
                                             <img style="width: 100%; height: 100%; " src="../img/<?php echo $row['c_logo']; ?>" alt="">
                                          </div>
                                       </div> 
                                       <div class="col-md-8">
                                          <label class="form-label" for="er_id">Job ID:</label>
                                          <input disabled type="text" class="form-control" name="er_id" id="er_id" value="<?php echo $v_job_id ?>">
                                       </div>
                                       <div class="col-md-8" >
                                          <label class="form-label" for="er_name_kh">Name KH:</label>
                                          <input disabled type="text" class="form-control" name="er_name_kh" id="er_name_kh" value="<?php echo $v_name ?>">
                                       </div>
                                       <div class="col-md-8">
                                          <label class="form-label" for="er_name_en">Name EN:</label>
                                          <input disabled type="text" class="form-control" name="er_name_en" id="er_name_en" value="<?php echo $v_name1 ?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_gender_id">Gender:</label>
                                          <input disabled type="text" class="form-control" name="er_gender_id" id="er_gender_id" value="
                                          <?php
                                             $sql = "SELECT * FROM gender LEFT JOIN employee_registration ON gender.ge_id = employee_registration.er_gender_id WHERE ge_id = '$v_gender'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['ge_name'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_position_id">Current Position:</label>
                                          <input disabled type="text" class="form-control" name="er_position_id" id="er_position_id" value="
                                          <?php
                                             $sql = "SELECT * FROM position LEFT JOIN employee_registration ON position.position_id = employee_registration.er_position_id WHERE position_id = '$v_position'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = $result_row['position'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_position_id">Current Position:</label>
                                          <input disabled type="text" class="form-control" name="er_position_id" id="er_position_id" value="
                                          <?php
                                             $sql = "SELECT * FROM position LEFT JOIN employee_registration ON position.position_id = employee_registration.er_position_id WHERE position_id = '$v_position'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = $result_row['position'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_branch_id">Current Branch:</label>
                                          <input disabled type="text" class="form-control" name="er_branch_id" id="er_branch_id" value="
                                          <?php   
                                             $sql = "SELECT * FROM user_branch LEFT JOIN employee_registration ON user_branch.ub_id = employee_registration.er_branch_id WHERE ub_id = '$v_branch'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['ub_name'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_department_id">Current Department:</label>
                                          <input disabled type="text" class="form-control" name="er_department_id" id="er_department_id" value="
                                          <?php  
                                             $sql = "SELECT * FROM department LEFT JOIN employee_registration ON department.de_id = employee_registration.er_department_id WHERE de_id = '$v_department'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = $result_row['de_name'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_company_id">Current Company:</label>
                                          <input disabled type="text" class="form-control" name="er_company_id" id="er_company_id" value="
                                          <?php
                                             $sql = "SELECT * FROM company LEFT JOIN employee_registration ON company.c_id = employee_registration.er_company_id WHERE c_id = '$v_company'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = $result_row['c_name_en'];
                                             echo $result_row_show;
                                          ?>
                                          ">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="name_en">Employee Address:</label>
                                          <input disabled type="text" class="form-control" name="name_en" id="name_en" value="<?php echo $v_er_address?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_contract_period">Contact:</label>
                                          <input disabled type="text" class="form-control" name="er_contract_period" id="er_contract_period" value="<?php echo $v_er_contract?>">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_idcard_no">ID Card No:</label>
                                          <input disabled type="text" class="form-control" name="er_idcard_no" id="er_idcard_no" value="<?php echo $v_er_idcard?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_nssf_no">NSSF No:</label>
                                          <input disabled type="text" class="form-control" name="er_nssf_no" id="er_nssf_no" value="<?php echo $v_er_nssf?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="job_id">Job Contract No:</label>
                                          <input disabled type="text" class="form-control" name="job_id" id="job_id" value="">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_bank_acc_name">Bank Name:</label>
                                          <input disabled type="text" class="form-control" name="er_bank_acc_name" id="er_bank_acc_name" value="<?php echo $v_bank_name?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_bank_acc_num">Bank Account No:</label>
                                          <input disabled type="text" class="form-control" name="er_bank_acc_num" id="er_bank_acc_num" value="<?php echo $v_bank_num?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="job_id">Employee Status:</label>
                                          <input disabled type="text" class="form-control" name="job_id" id="job_id" value="">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_spouse">Spouse:</label>
                                          <input disabled type="text" class="form-control" name="er_spouse" id="er_spouse" value="<?php echo $v_spouse?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_children">No Of Children:</label>
                                          <input disabled type="text" class="form-control" name="er_children" id="er_children" value="<?php echo $v_children?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_startwork_date">Start Working Date:</label>
                                          <input disabled type="text" class="form-control" name="er_startwork_date" id="er_startwork_date" value="<?php echo $v_er_startwork?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_endwork_date">End Working Date:</label>
                                          <input disabled type="text" class="form-control" name="er_endwork_date" id="er_endwork_date" value="<?php echo $v_er_endwork?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="name_en">Start Working Positior:</label>
                                          <input disabled type="text" class="form-control" name="name_en" id="name_en" value="">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_renew_workdate">Renew Working Date:</label>
                                          <input disabled type="text" class="form-control" name="er_renew_workdate" id="er_renew_workdate" value="<?php echo $v_renew_workdate?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_commodity">Commodity:</label>
                                          <input disabled type="text" class="form-control" name="er_commodity" id="er_commodity" value="<?php echo $v_commodity?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_transportation_fee">Transportation Fee:</label>
                                          <input disabled type="text" class="form-control" name="er_transportation_fee" id="er_transportation_fee" value="<?php echo $v_transportation_fee?>">
                                       </div>
                                    </div>
                                    <div class="col-md-4">  
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_transportation_support">Transportation Support:</label>
                                          <input disabled type="text" class="form-control" name="jober_transportation_support_id" id="er_transportation_support" value="<?php echo $v_transportation_support?>">
                                       </div>                             
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_food_drink">TFood & Drink:</label>
                                          <input disabled type="text" class="form-control" name="er_food_drink" id="er_food_drink" value="<?php echo $v_food_drink?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_insurance">Insurance:</label>
                                          <input disabled type="text" class="form-control" name="er_insurance" id="er_insurance" value="<?php echo $v_insurance?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_phone_card">Phone Card:</label>
                                          <input disabled type="text" class="form-control" name="er_phone_card" id="er_phone_card" value="<?php echo $v_phone_card?>">
                                       </div>                            
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_traning_time">Training Time:</label>
                                          <input disabled type="text" class="form-control" name="er_traning_time" id="er_traning_time" value="<?php echo $v_traning_time?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_workplace_time">Workplace Change Time:</label>
                                          <input disabled type="text" class="form-control" name="er_workplace_time" id="er_workplace_time" value="<?php echo $v_workplace_time?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_total_eva_time">Total Evaluation time:</label>
                                          <input disabled type="text" class="form-control" name="er_total_eva_time" id="er_total_eva_time" value="<?php echo $v_total_eva_time?>">
                                       </div>                          
                                       <div class="col-md-12">
                                          <label class="form-label" for="name_kh">Total Evaluation Salary time:</label>
                                          <input disabled type="text" class="form-control" name="name_kh" id="name_kh" value="">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_upgrade_position_time">Total Upgrade Position Time:</label>
                                          <input disabled type="text" class="form-control" name="er_upgrade_position_time" id="er_upgrade_position_time" value="<?php echo $v_upgrade_position_time?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_total_warning_time">Total Warning:</label>
                                          <input disabled type="text" class="form-control" name="er_total_warning_time" id="er_total_warning_time" value="<?php echo $v_total_warning_time?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_total_annual_leave">Total Annual leave:</label>
                                          <input disabled type="text" class="form-control" name="er_total_annual_leave" id="er_total_annual_leave" value="<?php echo $v_total_annual_leave?>">
                                       </div>
                                       <div class="col-md-12">
                                          <label class="form-label" for="er_employee_document_list">Employee Document List:</label>
                                          <input disabled type="text" class="form-control" name="er_employee_document_list" id="er_employee_document_list" value="<?php echo $v_employee_document_list?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div style="margin-top: 10px;" class="col-md-12">
                                    <button id="btn_done_show" type="button" onclick="print()" class="btn btn-success btn-sm"><i class="fa fa-print"></i>
                                          Print</button>
                                    <a href="./report_employee_profile.php" id="btn_done_show" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i>Back</a>
                                 </div>       
                              </form>
                           </div>
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
   <script type="text/javascript">
   </script>
</body>

</html>