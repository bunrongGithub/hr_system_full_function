<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
   <!-- font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Document</title>
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="row" style="display: flex;">
               <div class="col-6" style="width: 100%; height: 100%; margin-top: 10px;">
                  <img src="../img/avatar.png" alt="" style="width: 100px; height: 100px">
                  <div class="row">
                     <div class="col-12" style="margin-top: 30px;">
                        <h4 style="font-weight: bold;">Company Name........................</h4>
                        <h4 style="font-weight: bold;">Department........................</h4>
                        <h4 style="font-weight: bold;">Branch........................</h4>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <h2 style="font-weight: bold;">Leave Summary</h2>
                     </div>
                  </div>
               </div>
               <div class="col-3" style="width: 100%; height: 100%; margin-top: 30px;">
                  <h3>Attendance_Report</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="col-md-12" style="margin-top: 30px;">
         <form method="post" enctype="multipart/form-data" action="">
            <div class="form-group col-xs-6">
               <label>Job ID:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>
            <div class="form-group col-xs-6">
               <label>Name:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>
            <div class="form-group col-xs-6">
               <label>Gender:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>
            <div class="form-group col-xs-6">
               <label>Current Position::</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>
            <div class="form-group col-xs-6">
               <label>Date:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="date">
            </div>
            <div class="form-group col-xs-6">
               <label>Form:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>
            <div class="form-group col-xs-6">
               <label>To:</label>
               <input class="form-control" id="txt_name" name="txt_name" type="text">
            </div>

         </form>
      </div>
   </div>
   <div class="container">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th scope="col" <?php echo  $v_er_name_en; ?>>No</th>
               <th scope="col">Leave type</th>
               <th scope="col">User</th>
               <th scope="col">balance</th>
            </tr>
         </thead>
         <tbody>

         </tbody>
      </table>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div style="margin-top: 10px;" class="col-md-12">
               <a id="medaiprint" style="color: white;" onclick="window.print();" class="btn btn-lg btn-success" href=""><i class="fa fa-print"></i></a>
               <a id="medaiprint" style="color: white;" class="btn btn-lg btn-danger" href="view_report_attendance.php"><i class="fa fa-undo"></i></a>
            </div>
         </div>
      </div>
   </div>
</body>

</html>