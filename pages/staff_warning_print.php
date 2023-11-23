<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM warning left join employee_registration on employee_registration.er_id = warning.wa_job_id
   left join company on company.c_id = employee_registration.er_company_id WHERE wa_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
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
   <link rel="stylesheet" href="./staff_resign_print.css">
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
   <style>
      @media print {
         #medaiprint {
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
               Warning
            </h1>
         </section>
         <section class="content">
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <div class="box-body table-responsive">
                           <div class="container">
                              <div class="col-md-12">
                                 <form action="" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="" value="<?php echo $row['wa_id'] ?>" id="">
                                    <div class="header_logo">
                                       <div style=" width: 130px; height: 150px; border: 1px solid gray; box-shadow: 0px 16px 48px 0px rgba(0, 0, 0, 0.176); ">
                                          <img style="width: 100%; height: 100%; " src="../img/<?php echo $row['c_logo']; ?>" alt="">
                                       </div>
                                       <div class="header_text">
                                          <h1>Warning Letter</h1>
                                       </div>
                                    </div>
                                    <div class="header_input">
                                       <div class="input_div">
                                          <label for="job_id">Job ID:</label>
                                          <input disabled type="text" class="input_header" name="job_id" id="job_id" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['er_job_id'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div">
                                          <label for="rnp_no">Warning Nº:</label>
                                          <input type="text" class="input_header" name="rnp_no" id="rnp_no" value="<?php echo $row['wa_no'] ?>">
                                       </div>
                                       <div class="input_div">
                                          <label for="date">Warning Date:</label>
                                          <input type="date" class="input_header" name="date" id="date" value="<?php echo $row['wa_warning_date'] ?>">
                                       </div>
                                    </div>
                                    <div class="header_input">
                                       <div class="input_div">
                                          <label class="form-label" for="name_kh">Name KH:</label>
                                          <input disabled type="text" class="input_header" name="name_kh" id="name_kh" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['er_name_kh'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div">
                                          <label class="form-label" for="name_en">Name EN:</label>
                                          <input disabled type="text" class="input_header" name="name_en" id="name_en" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['er_name_en'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div">
                                          <label class="form-label" for="name_en">Gender:</label>
                                          <input disabled type="text" class="input_header" name="name_en" id="name_en" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['ge_name'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                    </div>
                                    <div class="current_info">
                                       <div class="input_div_info">
                                          <label class="form-label" for="company">Company:</label>
                                          <input disabled type="text" class="input_header" name="company" id="company" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration LEFT JOIN company ON company.c_id = employee_registration.er_company_id WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['c_name_kh'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div_info">
                                          <label class="form-label" for="branch">Branch:</label>
                                          <input disabled type="text" class="input_header" name="branch" id="branch" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['ub_name'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div_info">
                                          <label class="form-label" for="department">Department:</label>
                                          <input disabled type="text" class="input_header" name="department" id="department" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration LEFT JOIN department ON department.de_id = employee_registration.er_department_id WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['de_name'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                       <div class="input_div_info">
                                          <label class="form-label" for="position">Position:</label>
                                          <input disabled type="text" class="input_header" name="position" id="position" value="
                                             <?php
                                             $job_id = @$row['wa_job_id'];
                                             $sql = "SELECT * FROM employee_registration LEFT JOIN position ON position.position_id = employee_registration.er_position_id WHERE er_id = '$job_id'";
                                             $result = $connect->query($sql);
                                             $result_row = $result->fetch_assoc();
                                             $result_row_show = @$result_row['position'];
                                             echo $result_row_show;
                                             ?>
                                          ">
                                       </div>
                                    </div>
                                    <div class="header_input">
                                       <div class="input_div">
                                          <label for="">Total Warning:</label>
                                          <input type="number" class="input_header" value="<?php echo $row['wa_total_warning'] ?>">
                                       </div>
                                       <div class="input_div">
                                          <label for="">Mistake:</label>
                                          <input type="text" class="input_header" value="<?php
                                                                                          $mistake_id =  $row['wa_mistake_id'];
                                                                                          $mis_query = "SELECT * FROM text_warning_mistake WHERE twm_id = '$mistake_id'";
                                                                                          $mis_result = $connect->query($mis_query);
                                                                                          $mis_row = $mis_result->fetch_assoc();
                                                                                          $mis_show = $mis_row['twm_name'];
                                                                                          echo $mis_show;
                                                                                          ?>">
                                       </div>
                                       <div class="input_div">
                                          <label for="">Description:</label>
                                          <input type="text" class="input_header" value="<?php echo $row['wa_finding_description'] ?>">
                                       </div>
                                    </div>
                                    <div class="infor_reason">
                                       <label class="form-label" for="">Comment:</label>
                                       <textarea name="" id="" rows="1"><?php echo $row['wa_comment'] ?></textarea>
                                    </div>
                                    <div class="infor_reason">
                                       <label class="form-label" for="">Noted:</label>
                                       <textarea name="" id="" rows="1"><?php echo $row['wa_noted'] ?></textarea>
                                    </div>
                                    <div style="margin-bottom: 25px;" class="col-md-12">
                                       <div class="col-xs-3">
                                          <label class="form-label" for="">Requested By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 1px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Confirmed By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 1px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Verified By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 1px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Approved By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 1px solid gray ; " type="text">
                                       </div>
                                    </div>
                                    <div style="margin-top: 10px;">
                                       <a id="medaiprint" style="color: white;" onclick="window.print();" class="btn btn-lg btn-success" href=""><i class="fa fa-print"></i></a>
                                       <a id="medaiprint" style="color: white;" class="btn btn-lg btn-danger" href="./staff_warning.php"><i class="fa fa-undo"></i></a>
                                    </div>
                                 </form>
                              </div>
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

</body>

</html>