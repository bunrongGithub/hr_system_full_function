<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$_get_data = 'GET';
if ($_SERVER['REQUEST_METHOD'] != $_get_data) {
   header("location:admin_asset_depreciation.php");
   exit();
}

if (isset($_GET['id'])) {
   $_id = $_GET['id'];
   if ($_id == 0) {
      header("location:admin_asset_depreciation.php");
      exit();
   }
   $sql = "SELECT * FROM `admin_asset_depreciation` A
                  
   ";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);
   $dep_total_amount = $row['adassd_depre_total_amount'];
   $dep_age = $row['adassd_depre_age'];
   $dep_pay_month = $row['adassd_depre_amount_per_month'];
}

?>
<!DOCTYPE html>
<html>

<head>
   <title>HR System</title>
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Khmer&family=Moul&display=swap');

      body {
         font-family: Arial, sans-serif;
         margin: 40px;
      }

      .container {
         width: 800px;
         background-color: #f5f5f5;
         padding: 20px;
         margin: 0 auto;
         border-radius: 5px;
         box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
      }

      table tr {
         border-bottom: 1px solid #ddd;
      }

      table tr td {
         /* border-bottom: 1px solid #ddd; */
         border-left: 1px solid #ddd;
      }

      table,
      .header-table {
         width: 100%;
         border-collapse: collapse;
         border: 1px solid #ddd;
      }

      th,
      td {
         font-size: 14px;
         padding: 8px;
      }

      th {
         background-color: #545555;
         color: #fff;
         font-weight: bold;
         font-family: Arial, Helvetica, sans-serif;
      }

      td {
         text-align: center;
      }

      .payment-date,
      .remark {
         width: 100px;
      }

      .balance {
         width: 150px;
         /* text-align: right; */
      }

      .remark {
         width: 50px;

         text-align: center;
      }

      .remark span {
         font-weight: bold;
      }

      h1 {
         font-size: 24px;
         color: #333;
         font-size: 20px;
         margin-bottom: 20px;
         text-align: center;
         font-family: "Moul";
      }

      tr {
         background-color: #fff;
      }

      .header-table {
         border: 3px solid #ddd;
         margin-bottom: 30px;
      }

      .header-row {
         border: 1px solid #ddd;
      }

      .header-row td {
         border-left: 1px solid #ddd;
      }

      .header-row td:nth-child(1) {
         border-left: 1px solid #ddd;
         text-align: end;
         font-family: "Khmer";
         font-weight: bold;
         width: 250px;
      }

      .header-row td:nth-child(2) {

         display: flex;
         justify-content: space-between;
         align-items: center;
         text-align: center;
         /* background-color: #333; */
      }

      .header-row td:nth-child(3) {
         border-left: 1px solid #ddd;
         /* text-align: end; */
         font-family: "Khmer";
         font-weight: bold;
         /* width: 250px; */
      }

      .letter-heade-table {
         width: 100%;
         border-collapse: collapse;
         border: 1px solid #ddd;
      }

      .letter-heade-table .letter-heade-row {
         border: 1px solid #ddd;
      }

      .letter-heade-table .letter-heade-row td {
         border-left: 1px solid #ddd;
         padding: 10px;
      }

      .td-branch {
         /* border-left: 1px solid #ddd; */
         text-align: end;
         font-family: "Khmer";
         font-weight: bold;
         width: 250px;
      }

      .td-position {
         /* border-left: 1px solid #ddd; */
         text-align: end;
         font-family: "Khmer";
         font-weight: 600;
         width: 250px;
      }
   </style>
</head>

<body onload="window.print();" >
   <div class="container">
      <table class="letter-heade-table">
         <tr class="letter-heade-row">
            <td></td>
            <td></td>
            <td class="td-branch">ផ្សារទំនើមសុីត្រាសាខាមណ្ឌលគីរី</td>
         </tr>
         <tr class="letter-heade-row">
            <td></td>
            <td></td>
            <td class="td-position">ការិយាល័យកណ្ដាលរតនគីរិ</td>
         </tr>
      </table>
      <h1>តារាងបង់រំលស់​ <span style="font-family: Arial, Helvetica, sans-serif; font-weight: 500; ">120001​​</span>តម្លៃសម្ភារះបរិក្ខាការិយាល័យ</h1>
      <table class="header-table">
         <tr class="header-row">
            <td>ថ្លៃដើមសម្ភារះបរិក្ខាការិយាល័យ</td>
            <td>
               <span>$</span>
               <span><?php echo $dep_total_amount; ?></span>
            </td>
            <td style="width: 36%;" rowspan="3">
               ការបង់រំលស់ផ្នែកលើលទ្ធភាពប្រើប្រាស់ ៥ឆ្នាំ
            </td>
         </tr>
         <tr class="header-row">
            <td>រយះពេលប្រើប្រាស់</td>
            <td>
               <span></span>
               <span><?php echo $dep_age; ?> <span style="font-family: khmer;">ខែ</span></span>
            </td>​
         <tr class="header-row">
            <td>ទឹកប្រាក់បង់រំលស់ប្រចាំខែ</td>
            <td>
               <span>$</span>
               <span><?php echo $dep_pay_month; ?></span>
            </td>
         </tr>
      </table>
      <table>
         <thead>
            <tr>
               <th>NO</th>
               <th class="payment-date">Payment Date</th>
               <th>Monthly Depreciation Amount</th>
               <th class="balance">Balance</th>
               <th class="remark">Remark</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $result = mysqli_query($connect, $sql);

            $v_age_pay = $row['adassd_depre_age'];
            $v_dep_start_date = $row['adassd_depre_date'];
            $v_get_pay_month = $row['adassd_depre_amount_per_month'];
            $v_get_total_depreciation = $row['adassd_depre_total_amount'];
            $v_cal_total = $v_get_total_depreciation;
            for ($_age_pay = 1; $_age_pay <= $v_age_pay; $_age_pay++) {
            ?>
               <tr>
                  <td><?= $_age_pay; ?></td>
                  <td>
                     <?php
                     if ($_age_pay == 1) {
                        echo $v_dep_start_date;
                     } else {
                        $v_dep_start_date = $row['adassd_depre_date'];
                        $v_index = $_age_pay - 1;
                        $v_next_month = date('Y-m-d', strtotime($v_dep_start_date . "+ " . $v_index . "month"));
                        echo $v_next_month;
                     }
                     ?>
                  </td>
                  <td><?= $v_get_pay_month . '$'; ?></td>
                  <td>
                     <?php
                           $v_total = $v_cal_total - $v_get_pay_month;
                           $v_cal_total = $v_total;
                           
                           echo $v_total = round($v_total, 2);
                     ?>
                  </td>
                  <td></td>
               </tr>
               
            <?php
            }
            ?>
            <tr>
                  <td></td>
                  <td></td>
                  <td>
                     <?php echo $v_get_total_depreciation . '$' ;?>
                  </td>
                  <td></td>
                  <td></td>
            </tr>
         </tbody>
      </table>