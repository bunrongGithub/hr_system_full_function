<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');
if (isset($_GET['id'])) {
   $v_data_id = $_GET['id'];
   $sql = "SELECT * FROM loan_schedule
           LEFT JOIN loan_request on loan_request.lr_id=loan_schedule.ls_request_no
           LEFT JOIN text_loan_request_loan_term on text_loan_request_loan_term.tlt_id=loan_request.lr_loan_term_id
           WHERE ls_id = '$v_data_id' limit 1";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>

<head>
   <title>HR Sytem</title>
   <?php
   include "title_icon.php";
   ?>
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Khmer&family=Merriweather:ital,wght@0,300;0,400;1,400&family=Moul&family=Roboto+Mono:ital,wght@0,400;0,500;1,300;1,400&display=swap');

      table {
         width: 100%;
         border-collapse: collapse;
         margin: auto;
         font-family: 'Roboto Mono', monospace, 'Moul', serif, 'Moul', serif;
      }

      .table-row-head>th {
         padding: 15px 0;
         /* background-color: blue; */
      }

      th,
      td {
         border: 1px solid black;
         padding: 5px;
         text-align: center;
      }

      th {
         background-color: #fff;
      }

      td {
         text-align: left;
      }

      .row-empty .empty {
         padding: 10px;
         border: 2px solid #ccc;
      }

      .infor_em {
         font-family: 'Merriweather', serif;
         text-align: left;
         width: 100px;
      }

      caption {
         font-size: xx-large;
         margin-top: 60px;
         margin-bottom: 30px;
      }

      .head_gray_color tr td:nth-child(2) {
         background-color: #ddd;
         text-align: right;
      }

      .head_gray_color tr td:nth-child(4) {
         text-align: right;
      }

      /* .head_gray_color tr td:nth-last-child(1){
         background-color: #fff;
      } */
      .t_body_color tr td:nth-child(1) {
         text-align: center;
      }

      .t_body_color tr td:nth-child(2) {
         background-color: #ddd;
         text-align: right;
      }

      .t_body_color tr td:nth-child(3) {
         text-align: right;
      }

      .t_body_color tr td:nth-child(4) {
         text-align: right;
      }

      .t_body_color tr td:nth-child(5) {
         text-align: right;
      }

      .t_body_color tr td:nth-child(6) {
         text-align: right;
      }

      @page {
         margin-top: 50px;
      }

      p {
         font-size: 12px;
      }
   </style>
</head>

<body onload="window.print();" >
   <table>
      <caption>តារាងបង់ប្រាក់កម្ចីប្រចាំខែ</caption>
      <thead>
         <tr>
            <td class="infor_em">Job ID</td>
            <td class="infor_em"></td>
            <td class="infor_em">Gender</td>
            <td class="infor_em"></td>
            <td class="infor_em">Department</td>
            <td class="infor_em"></td>

         </tr>
         <tr>
            <td style="font-size: 12px;" class="infor_em">Employee Name</td>
            <td class="infor_em"></td>
            <td class="infor_em">Position</td>
            <td class="infor_em"></td>
            <td class="infor_em">Branch</td>
            <td class="infor_em"></td>

         </tr>
      </thead>
      <tbody class="head_gray_color">
         <tr>
            <td colspan="2">
               <p>ប្រាក់ដើមខ្ចីសរុប (Loan Amount)</p>
            </td>
            <td><?php echo $row['lr_loan_amount']; ?></td>
            <td colspan="2">
               <p>ចំនួនការប្រាក់សរុប (Total Interest Rate)</p>
            </td>
            <td><?php echo $row['lr_total_interest_rate']; ?></td>
         </tr>
         <tr>
            <td colspan="2">
               <p>កាលបរិច្ឆេទកម្ចី (Loan Request Date)</p>
            </td>
            <td><?php echo $row['lr_request_date']; ?></td>
            <td colspan="2">
               <p>សរុបប្រាក់ដើម និងការ (Total Loan & Interes)</p>
            </td>
            <td><?php echo $row['lr_total_loan_interest']; ?></td>
         </tr>
         <tr>
            <td colspan="2">
               <p>រយៈពេលកម្ចី (Loan Term)</p>
            </td>
            <td><?php echo $row['tlt_name']; ?></td>
            <td colspan="2">
               <p>ប្រាក់បង់ប្រចាំខែសរុប (Total Monthly Payement)</p>
            </td>
            <td><?php echo $row['lr_total_monthly_payment']; ?></td>
         </tr>
         <tr>
            <td colspan="2">
               <p>អត្រាការប្រាក់ក្នុង 1 ខែ</p>
            </td>
            <td><?php echo $row['lr_loan_rate']; ?></td>
            <td colspan="2">
               <p>ថ្ងៃបង់ប្រាក់ (Repayment Date)</p>
            </td>
            <td><?php echo $row['ls_repayment_date']; ?></td>
         </tr>
         <tr class='row-empty'>
            <td class="empty"></td>
            <td style="background-color: white;" class="empty"></td>
            <td class="empty"></td>
            <td class="empty"></td>
            <td class="empty"></td>
            <td class="empty"></td>
         </tr>
      </tbody>
   </table>
   <table>
      <thead>
         <tr class="table-row-head">
            <th>No</th>
            <th>Date</th>
            <th>Priciple</th>
            <th>Interest</th>
            <th>Total Monthly Payment</th>
            <th>Loan Balance</th>

         </tr>
      </thead>
      <tbody class="t_body_color">
         <?php
         if (isset($_GET['id'])) {
            $v_get_id = $_GET['id'];
            $sql = "SELECT * FROM loan_schedule_sub where lss_loan_sched_id = '$v_get_id'";
            $result = $connect->query($sql);
            $i = 1;
            $total_inter = 0;
            $total_total_pay = 0;
            while ($row_sub = mysqli_fetch_assoc($result)) {
               $v_i = $i++;
               $v_date = $row_sub['lss_date'];
               $v_priciple = $row_sub['lss_priciple'];
               $v_interest = $row_sub['lss_interest'];
               $v_total = $row_sub['lss_total'];
               $v_balance = $row_sub['lss_balance'];

               $total_inter += $row_sub['lss_interest'];
               $total_total_pay += $row_sub['lss_total'];
         ?>
               <tr>
                  <td><?php echo $v_i; ?></td>
                  <td><?php echo $v_date; ?></td>
                  <td><?php echo $v_priciple; ?></td>
                  <td><?php echo $v_interest; ?></td>
                  <td><?php echo $v_total; ?></td>
                  <td><?php echo $v_balance; ?></td>
               </tr>
            <?php
            };
            ?>
            <tr>
               <td colspan="3">Total</td>
               <td style="background-color:#fff;">
                  <?php
                  $v_total_inter_get = number_format($total_inter, 2);
                  echo $v_total_inter_get;
                  ?>
               </td>
               <td>
                  <?php
                     $total_total_pay_get = number_format($total_total_pay, 2);
                     echo $total_total_pay_get;
                     ?>
                  </td>
               <td></td>
            </tr>
         <?php
         }
         ?>
      </tbody>
   </table>
</body>
</html>