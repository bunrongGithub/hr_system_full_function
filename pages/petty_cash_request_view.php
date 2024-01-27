<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM pettycash_request A LEFT JOIN create_petty_cash B ON B.cpc_id = A.pc_cpc_id
 WHERE pc_id = '$id'";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_array($result);
   $v_pc_pcr_no = $row['pc_pcr_no'];
   $v_pc_request_date = $row['pc_request_date'];
   $v_pc_cpc_id = $row['cpc_code'];
   $v_cpc_description = $row['cpc_description'];
   $v_cpc_currency = $row['cpc_currency'];
   $v_pc_amount_usd = $row['pc_amount_usd'];
   $v_pc_reason = $row['pc_reason'];
   $v_cpc_applied_date = $row['cpc_applied_date'];
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
      @media print {
         .btn-don-show {
            display: none;
         }

         .NoPrint {
            display: none;
         }

         #NoPrint {
            display: none;
         }
      }

      @media print {

         button,
         a {
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
            <h3 class="text-primary">Employee Profile</h3>
         </section>
         <div class="container">
            <section class="content">
               <div class="row">
                  <div class="col-xs-12 connectedSortable">
                     <div class="box">
                        <div class="box-header">
                           <div class="box-body table-responsive">
                              <div class="col-md-12">
                                 <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="" value="<?php echo $row['pc_id'] ?>" id="">
                                    <div class="form-group col-md-12">
                                       <div class="col-md-12">
                                          <div style=" margin-left: 13px; padding: 0; width: 100px; height: 110px; border: 1px solid gray; box-shadow: 0px 16px 48px 0px rgba(0, 0, 0, 0.176); ">
                                             <img style="width: 100%; height: 100%; " src="../img/<?php echo $row['c_logo']; ?>" alt="">
                                          </div>
                                       </div>
                                       <div class="text-center  col-md-12" style="margin-top: -65px;">
                                          <h3 for="">Employee Profile</h3>
                                       </div><br>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">PCR No:</label>
                                       <input disabled type="text" class="form-control" name="er_id" id="er_id" value="<?php echo $v_pc_pcr_no ?>">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Request Date:</label>
                                       <input disabled type="text" class="form-control" name="er_id" id="er_id" value="<?php echo $v_pc_request_date ?>">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Code:</label>
                                       <input disabled type="text" class="form-control" name="cpc_id" id="cpc_id" value="
                                                    <?php
                                                      $sql = "SELECT * FROM create_petty_cash LEFT JOIN pettycash_request ON create_petty_cash.cpc_id = pettycash_request.pc_cpc_id WHERE cpc_code = '$v_pc_cpc_id'";
                                                      $result = $connect->query($sql);
                                                      $result_row = $result->fetch_assoc();
                                                      $result_row_show = @$result_row['cpc_code'];
                                                      echo $result_row_show;
                                                      ?>
                                                ">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Description:</label>
                                       <input disabled type="text" class="form-control" name="cpc_description" id="cpc_description" value="
                                                    <?php
                                                      $sql = "SELECT * FROM create_petty_cash LEFT JOIN pettycash_request ON create_petty_cash.cpc_id = pettycash_request.pc_cpc_id WHERE cpc_code = '$v_pc_cpc_id'";
                                                      $result = $connect->query($sql);
                                                      $result_row = $result->fetch_assoc();
                                                      $result_row_show = @$result_row['cpc_description'];
                                                      echo $result_row_show;
                                                      ?>
                                                ">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Currency:</label>
                                       <input disabled type="text" class="form-control" name="cpc_currency" id="cpc_currency" value="
                                                <?php
                                                $sql = "SELECT * FROM create_petty_cash LEFT JOIN pettycash_request ON create_petty_cash.cpc_id = pettycash_request.pc_cpc_id WHERE cpc_code = '$v_pc_cpc_id'";
                                                $result = $connect->query($sql);
                                                $result_row = $result->fetch_assoc();
                                                $result_row_show = @$result_row['cpc_currency'];
                                                echo $result_row_show;
                                                ?>
                                                ">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Amount:</label>
                                       <input disabled type="text" class="form-control" name="er_id" id="er_id" value="<?php echo $v_pc_amount_usd ?>">
                                    </div>
                                    <div class="col-md-12">
                                       <label class="form-label" for="er_id">Reason:</label>
                                       <input disabled type="text" class="form-control" name="er_id" id="er_id" value="<?php echo $v_pc_reason ?>">
                                    </div>
                                    <div class="col-md-12">
                                       <label class="form-label" for="pc_id">Comment 1:</label>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-12">
                                       <label class="form-label" for="pc_id">Comment 2:</label>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-12">
                                       <label class="form-label" for="pc_id">Comment 3:</label>
                                       <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-6">
                                       <label class="form-label" for="er_id">Applied Date:</label>
                                       <input disabled type="text" class="form-control" name="cpc_applied_date" id="cpc_applied_date" value="
                                                <?php
                                                $sql = "SELECT * FROM create_petty_cash LEFT JOIN pettycash_request ON create_petty_cash.cpc_id = pettycash_request.pc_cpc_id WHERE cpc_code = '$v_pc_cpc_id'";
                                                $result = $connect->query($sql);
                                                $result_row = $result->fetch_assoc();
                                                $result_row_show = @$result_row['cpc_applied_date'];
                                                echo $result_row_show;
                                                ?>
                                                ">
                                    </div>
                                    <div class="col-md-12">
                                       <div class="col-xs-3">
                                          <label class="form-label" for="">Requested By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 2px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Confirmed By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 2px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Verified By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 2px solid gray ; " type="text">
                                       </div>
                                       <div class="col-xs-3">
                                          <label for="">Approved By</label>
                                          <input class="form-control" style="border: none; outline: none; border-bottom: 2px solid gray ; " type="text">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-12" style="margin-top: 10px;">
                                       <a href="./petty_cash_request.php" style="color:white;" class="no_print btn btn-danger btn-sm"><i class="fa fa-undo"></i> Close </a>
                                    </div>
                              </div>

                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
         </section>
   </div>
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
      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_pc_manage").addClass("active");
         $("#pc_request").addClass("active");
         $("#pc_request").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>