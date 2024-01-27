<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

$id = $_GET['id'];
$sql_sub = "SELECT * FROM loan_schedule A
        LEFT JOIN loan_request B ON B.lr_id=A.ls_request_no
        LEFT JOIN text_loan_request_loan_term C ON C.tlt_id=B.lr_loan_term_id
        WHERE ls_id='$id'
        ";
$result_sub = $connect->query($sql_sub);
$row_sub = $result_sub->fetch_assoc();

$get_loan_term_id = $row_sub["lr_loan_term_id"];
$get_first_payback_date = $row_sub["lr_first_payback_date"];
$get_total_loan_interest = $row_sub["lr_total_loan_interest"];
$get_loan_amount = $row_sub["lr_loan_amount"];
$get_loan_rate = $row_sub["lr_loan_rate"];
$get_total_monthly_payment = $row_sub["lr_total_monthly_payment"];

if (isset($_GET['del_id'])) {
   $del_id = $_GET['del_id'];
   $id = $_GET['id'];
   $sql = "DELETE FROM loan_schedule_sub where lss_id = '$del_id'";
   $result = mysqli_query($connect, $sql);
   header("location: loan_payment_schedule_view.php?id=$id");
}

if (isset($_POST["btnadd"])) {
   if ($get_loan_term_id == 1) {
      // insert line1
      $id = $_GET['id'];
      $v_first_payback_date = $get_first_payback_date;
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }
      $v_total_loan_interest = $get_total_loan_interest;
      $v_interest = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment = $get_total_monthly_payment;
      $v_balance = $v_total_loan_interest - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            , '$v_first_payback_date'
                            ,'$v_total_loan_interest'
                            ,'$v_interest'
                            ,'$v_total_monthly_payment'
                            ,'$v_balance'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line2
      $id = $_GET['id'];
      $v_first_payback_date_2 = date('Y-m-d', strtotime($v_first_payback_date . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_2 = $v_balance;
      $v_interest_2 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_2 = $get_total_monthly_payment;
      $v_balance_2 = $v_total_loan_interest_2 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_2'
                            ,'$v_total_loan_interest_2'
                            ,'$v_interest_2'
                            ,'$v_total_monthly_payment_2'
                            ,'$v_balance_2'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line3
      $id = $_GET['id'];
      $v_first_payback_date_3 = date('Y-m-d', strtotime($v_first_payback_date_2 . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_3 = $v_balance_2;
      $v_interest_3 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_3 = $get_total_monthly_payment;
      $v_balance_3 = $v_total_loan_interest_3 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_3'
                            ,'$v_total_loan_interest_3'
                            ,'$v_interest_3'
                            ,'$v_total_monthly_payment_3'
                            ,'$v_balance_3'
                        )
                        ";
      $result = mysqli_query($connect, $sql);
   } elseif ($get_loan_term_id == 2) {
      // insert line1
      $id = $_GET['id'];
      $v_first_payback_date = $get_first_payback_date;
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }
      $v_total_loan_interest = $get_total_loan_interest;
      $v_interest = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment = $get_total_monthly_payment;
      $v_balance = $v_total_loan_interest - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            , '$v_first_payback_date'
                            ,'$v_total_loan_interest'
                            ,'$v_interest'
                            ,'$v_total_monthly_payment'
                            ,'$v_balance'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line2
      $id = $_GET['id'];
      $v_first_payback_date_2 = date('Y-m-d', strtotime($v_first_payback_date . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_2 = $v_balance;
      $v_interest_2 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_2 = $get_total_monthly_payment;
      $v_balance_2 = $v_total_loan_interest_2 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_2'
                            ,'$v_total_loan_interest_2'
                            ,'$v_interest_2'
                            ,'$v_total_monthly_payment_2'
                            ,'$v_balance_2'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line3
      $id = $_GET['id'];
      $v_first_payback_date_3 = date('Y-m-d', strtotime($v_first_payback_date_2 . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_3 = $v_balance_2;
      $v_interest_3 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_3 = $get_total_monthly_payment;
      $v_balance_3 = $v_total_loan_interest_3 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_3'
                            ,'$v_total_loan_interest_3'
                            ,'$v_interest_3'
                            ,'$v_total_monthly_payment_3'
                            ,'$v_balance_3'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line4
      $id = $_GET['id'];
      $v_first_payback_date_4 = date('Y-m-d', strtotime($v_first_payback_date_3 . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_4 = $v_balance_3;
      $v_interest_4 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_4 = $get_total_monthly_payment;
      $v_balance_4 = $v_total_loan_interest_4 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_4'
                            ,'$v_total_loan_interest_4'
                            ,'$v_interest_4'
                            ,'$v_total_monthly_payment_4'
                            ,'$v_balance_4'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line5
      $id = $_GET['id'];
      $v_first_payback_date_5 = date('Y-m-d', strtotime($v_first_payback_date_4 . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_5 = $v_balance_4;
      $v_interest_5 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_5 = $get_total_monthly_payment;
      $v_balance_5 = $v_total_loan_interest_5 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_5'
                            ,'$v_total_loan_interest_5'
                            ,'$v_interest_5'
                            ,'$v_total_monthly_payment_5'
                            ,'$v_balance_5'
                        )
                        ";
      $result = mysqli_query($connect, $sql);

      // insert line6
      $id = $_GET['id'];
      $v_first_payback_date_6 = date('Y-m-d', strtotime($v_first_payback_date_5 . ' + 1 month'));
      if ($get_loan_term_id = 1) {
         $v_loan_term_id = 3;  // 3 months
      } elseif ($get_loan_term_id = 2) {
         $v_loan_term_id = 6;  // 6 months
      } else {
         $v_loan_term_id = 0;
      }

      $v_total_loan_interest_6 = $v_balance_5;
      $v_interest_6 = $get_loan_amount * ($get_loan_rate / 100);
      $v_total_monthly_payment_6 = $get_total_monthly_payment;
      $v_balance_6 = $v_total_loan_interest_6 - $v_total_monthly_payment;
      $sql = "INSERT INTO loan_schedule_sub 
                        (lss_loan_sched_id
                            , lss_date
                            ,lss_priciple
                            ,lss_interest
                            ,lss_total
                            ,lss_balance
                        )
                    VALUES
                        ('$id'
                            ,'$v_first_payback_date_6'
                            ,'$v_total_loan_interest_6'
                            ,'$v_interest_6'
                            ,'$v_total_monthly_payment_6'
                            ,'$v_balance_6'
                        )
                        ";
      $result = mysqli_query($connect, $sql);
   }
   header("location: loan_payment_schedule_view.php?id=$id");
   exit();
}

if (isset($_POST["btnupdate"])) {
   $id = $_GET['id'];
   $edit_cgd_id = $_POST["edit_cgd_id"];
   $edit_document_name = $_POST["edit_document_name"];

   $sql = "UPDATE company_gov_document SET
                        cgd_doc_name = '$edit_document_name'
                        WHERE cgd_id = $edit_cgd_id";
   $result = mysqli_query($connect, $sql);
   header("location:company_governance_edit.php?id=$id");
}

if (isset($_POST['btn_add_pdf'])) {
   $id = $_GET['id'];
   $v_image = @$_FILES['cgd_attach_file'];
   $v_id = @$_POST['cgd_com_gov_id'];
   if ($v_image["name"] != "") {
      $old_image = @$_POST['txt_old_img'];
      if (file_exists("../img/file/" . $old_image) and $old_image != 'blank.png') {
         unlink("../img/file/" . $old_image);
      }

      $new_name = date("Ymd") . "_" . rand(1111, 9999) . ".pdf";
      move_uploaded_file($v_image["tmp_name"], "../img/file/" . $new_name);

      $query_update = "UPDATE company_gov_document SET
                              cgd_attach_file='$new_name' 
                        WHERE cgd_com_gov_id='$v_id'";

      if ($connect->query($query_update)) {
         header("Location: company_governance_edit.php?id=$id");
         $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>';
      } else {
         $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';
      }
   }
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
         </section>
         <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <form action="" method="post" enctype="multipart/form-data">

                     <div class="col-md-6">
                        <div class="form-group col-xs-4">
                           <label for="">Loan_Amount:</label>
                           <input class="form-control" readonly type="text" name="edit_loan_amount" value="<?php echo $row_sub['lr_loan_amount']; ?>">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Frist_Payback_Date:</label>
                           <input class="form-control" readonly type="date" name="edit_first_payback_date" value="<?php echo $row_sub['lr_first_payback_date']; ?>">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Loan_Term:</label>
                           <input class="form-control" readonly type="text" name="edit_loan_term" value="<?php echo $row_sub['tlt_name']; ?>">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Interest_Rate:</label>
                           <input class="form-control" readonly type="text" name="edit_interest_rate" value="<?php echo $row_sub['lr_loan_rate']; ?> %">
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group col-xs-4">
                           <label for="">Total_Interest_Rate:</label>
                           <input class="form-control" readonly type="text" name="edit_total_interest_rate" value="<?php echo $row_sub['lr_total_interest_rate']; ?> %">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Total_Loan & Interest:</label>
                           <input class="form-control" readonly type="text" name="edit_total_loan_interest" value="<?php echo $row_sub['lr_total_loan_interest']; ?> %">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Monthly_Pay:</label>
                           <input class="form-control" readonly type="text" name="edit_total_monthly_payment" value="<?php echo $row_sub['lr_total_monthly_payment']; ?> %">
                        </div>
                        <div class="form-group col-xs-4">
                           <label for="">Repayment_date:</label>
                           <input class="form-control" readonly type="text" name="edit_interest_rate" value="<?php echo $row_sub['ls_repayment_date']; ?>">
                        </div>

                     </div>

                  </form>
               </div>
            </div>
            <div class="content">
               <div class="col-xs-12 connectedSortable">
                  <form action="" method="post" enctype="multipart/form-data">
                     <a href="loan_payment_schedule.php" class="btn btn-danger btn-sm">
                        <i style="color:white;" class="fa fa-undo"></i> Back
                     </a>
                     <button type="submit" name="btnadd" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Loan Calculation
                     </button>
                  </form>
                  <div class="box border">
                     <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No.</th>
                              <th>Date</th>
                              <th>Principle</th>
                              <th>Interest</th>
                              <th>Total_Pay</th>
                              <th>Loan_Balance</th>
                              <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $id = $_GET['id'];
                           $sql = "SELECT * FROM loan_schedule_sub A
                                            WHERE lss_loan_sched_id=$id
                                            ";
                           $result = $connect->query($sql);
                           $i = 1;
                           $v_interest_total = 0;
                           $v_total_total = 0;
                           while ($row = $result->fetch_assoc()) {
                              $v_i = $i++;
                              $v_date = $row["lss_date"];
                              $v_priciple = $row["lss_priciple"];
                              $v_interest = $row["lss_interest"];
                              $v_total = $row["lss_total"];
                              $v_balance = $row["lss_balance"];

                              $v_interest_total += $row["lss_interest"];
                              $v_total_total += $row["lss_total"];
                           ?>
                              <tr>
                                 <td align="center"><?php echo $v_i; ?></td>
                                 <td align="right"><?php echo $v_date; ?></td>
                                 <td align="right"><?php echo $v_priciple; ?></td>
                                 <td align="right"><?php echo $v_interest; ?></td>
                                 <td align="right"><?php echo $v_total; ?></td>
                                 <td align="right"><?php echo $v_balance; ?></td>
                                 <td align="center">
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="loan_payment_schedule_view.php?del_id=<?php echo $row['lss_id']; ?>&id=<?php echo $row['lss_loan_sched_id']; ?>" class="btn btn-danger btn-sm">
                                       <i style="color:white;" class="fa fa-trash"></i>
                                    </a>
                                 </td>
                              </tr>
                              <!-- Start Upload File -->
                              <div class="modal fade" id="exampleModal_upload<?php echo $row['cgd_com_gov_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h3 class="modal-title" id="exampleModalLabel">Upload PDF File</h3>
                                       </div>
                                       <div class="modal-body">
                                          <p>
                                             This page can upload <b> file pdf <b> only.
                                          </p>
                                          <form action="" method="POST" role="form" enctype="multipart/form-data">
                                             <input type="hidden" name="cgd_com_gov_id" value="<?php echo $row["cgd_com_gov_id"] ?>">
                                             <input type="hidden" name="txt_old_img" value="<?= @$_GET['sent_img'] ?>">
                                             <div class="row">
                                                <duv class="col-xs-6">
                                                   <img src="../img/file/<?= @$_GET['cgd_attach_file'] ?>" alt="">
                                                   <div class="form-group">
                                                      <label for="">Upload Here</label>
                                                      <input required="" type="file" class="form-control" id="preview" name="cgd_attach_file" onchange="loadFile(event)" />
                                                   </div>
                                                </duv>
                                             </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="submit" name="btn_add_pdf" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Upload</button>
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- End Upload -->
                           <?php
                           }
                           ?>
                        </tbody>

                        <tfoot>
                           <tr>
                              <td align="right" colspan="3"><b> Total </b></td>
                              <td align="right">
                                 <?php
                                 $v_interest_total_get = number_format($v_interest_total, 2);
                                 echo $v_interest_total_get;
                                 ?>
                              </td>
                              <td align="right">
                                 <?php
                                 $v_total_total_get = number_format($v_total_total, 2);
                                 echo $v_total_total_get;
                                 ?>
                              </td>
                           </tr>
                        </tfoot>

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
         function doUpdate(cgd_id, cgd_doc_name) {
            $('#edit_cgd_id').val(cgd_id);
            $('#edit_document_name').val(cgd_doc_name);
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

         function loadFile(e) {
            var output = document.getElementById('preview');
            output.width = 100;
            output.src = URL.createObjectURL(e.target.files[0]);
         }
      </script>

</body>

</html>