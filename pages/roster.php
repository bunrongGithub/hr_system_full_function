<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
   $v_name = $_POST["txt_month"];
   $v_date = $_POST["txt_day"];

   $sql = "INSERT INTO roster_creation 
                        ( rc_name, rc_day, rc_status)
                  VALUES 
                    ('$v_name','$v_date',1)";
   $result = mysqli_query($connect, $sql);
   header('location:roster.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["roster_creat_id"];
   $v_month = $_POST["edit_month"];
   $v_approv_date = $_POST["edit_approve_date"];
   $v_date = $_POST["edit_day"];
   $v_status = $_POST["edit_status"];

   $sql = "UPDATE roster_creation SET 
    rc_id = '$id', 
    rc_name = '$v_month', 
    rc_approve_date = '$v_approv_date',
    rc_day = '$v_date',
    rc_status = '$v_status' WHERE rc_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:roster.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM roster_creation WHERE rc_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: roster.php?message=delete");
}

///////detail////////

if (isset($_POST["btnupdate_detail"])) {
   $id = $_POST["roster_detail_id"];
   $v_month = $_POST["edit_rcd_month"];
   $v_date = $_POST["edit_rcd_date"];
   $v_jobid = $_POST["edit_rcd_job_id"];
   $v_empid = $_POST["edit_rcd_emp_id"];
   $v_gender = $_POST["edit_rcd_gender"];
   $v_position = $_POST["edit_rcd_position"];

   $sql = " UPDATE roster_creation_detail SET 
    rcd_roster_id ='$v_month', rcd_date ='$v_date', rcd_er_id ='$v_empid', 
    rcd_job_id='$v_jobid', rcd_gender ='$v_gender', rcd_position ='$v_position' 
    WHERE rcd_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:roster.php?message=update');
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM roster_creation_detail WHERE rcd_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: roster.php?message=delete");
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
            ?>
         </div>
         <section class="content-header">
            <div class="row">
               <div class="col-xs-10">
                  <h1>
                     Roster Creation
                  </h1>
               </div>
               <div class="col-xs-2 text-right">
                  <h1>
                     <a href="roster_filter.php" class="btn btn-outline-dark btn-lg"><i class="fa fa-list "></i> SHOW ROSTER</a>
                  </h1>
               </div>
            </div>
         </section>

         <!-- Main content -->
         <section class="content">
            <!-- top row -->
            <div class="row">
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box-header">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-12">
                                             <label>Month:</label>
                                             <input class="form-control" id="txt_month" name="txt_month" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-12">
                                             <label>Day:</label>
                                             <select class="form-control" id="txt_day" name="txt_day" required onclick="if(this.options.length>2){this.size=2;}">
                                                <option value="28">28 Day</option>
                                                <option value="29">29 Day</option>
                                                <option value="30" selected>30 Day</option>
                                                <option value="31">31 Day</option>
                                             </select>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Modal -->
                        <!-- Modal Update-->
                        <div class="modal fade" id="myModal_update" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="roster_creat_id" name="roster_creat_id" />
                                          <div class="form-group col-md-6">
                                             <label>Month:</label>
                                             <input class="form-control" id="edit_month" name="edit_month" type="text" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Approve Date:</label>
                                             <input class="form-control" id="edit_approve_date" name="edit_approve_date" type="date" required>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Day:</label>
                                             <select class="form-control" id="edit_day" name="edit_day" required>
                                                <option value="28">28 Day</option>
                                                <option value="29">29 Day</option>
                                                <option value="30">30 Day</option>
                                                <option value="31">31 Day</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
                                             <select class="form-control" id="edit_status" name="edit_status" required>
                                                <option disabled selected>Please Select Status</option>
                                                <?php
                                                $sql = 'SELECT * FROM text_petty_cash_status';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tpc_id'] . '">' . $row['tpc_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>

                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btnupdate" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>

                              </div>
                           </div>
                        </div>
                        <!-- Modal Update-->

                        <!-- Modal Detail-->
                        <div class="modal fade" id="myModal_detail" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <div class="form-group col-xs-12">
                                             <label>Month:</label>
                                             <select class="form-control" id="txt_rcd_month" name="txt_month" data-live-search="true" required>
                                                <option disabled selected>Please Select Month</option>
                                                <?php
                                                $sql = 'SELECT * FROM roster_creation where rc_status = 3 order by rc_id desc';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['rc_id'] . '">' . $row['rc_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Job ID:</label>
                                             <select class="form-control" id="txt_rcd_job_id" name="txt_rcd_job_id" required="required">
                                                <option disabled selected>Please Select Job ID</option>
                                                <?php
                                                $sql = 'SELECT * FROM employee_registration ';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <p id="amount_data"></p>

                                          <div class="form-group col-xs-12">
                                             <table class="table table-bordered" id="crud_table">
                                                <tr>
                                                   <th>Date</th>
                                                   <th>Description</th>
                                                   <th width="10%"><button type="button" name="add" id="add" class="btn btn-success btn-xs">+ Add Row</button></th>

                                                </tr>
                                                <tr>
                                                   <td contenteditable="true" class="date"></td>
                                                   <td contenteditable="true" class="name">OFF</td>
                                                   <td></td>
                                                </tr>
                                             </table>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" id="btnadd_detail" name="btnadd_detail" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Modal Detail-->
                        <!-- Modal Update Detail-->
                        <div class="modal fade" id="myModal_update_detail" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="roster_detail_id" name="roster_detail_id" />
                                          <div class="form-group col-md-6">
                                             <label>Month:</label>
                                             <select class="form-control" id="edit_rcd_month" name="edit_rcd_month" required>
                                                <option disabled>Please Select Month</option>
                                                <?php
                                                $sql = 'SELECT * FROM roster_creation where rc_status = 3 order by rc_id desc';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['rc_id'] . '">' . $row['rc_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Job ID:</label>
                                             <select class="form-control" id="edit_rcd_job_id" name="edit_rcd_job_id" data-live-search="true" required="required">
                                                <option disabled selected>Please Select Job ID</option>
                                                <?php
                                                $sql = 'SELECT * FROM employee_registration';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Employee Name:</label>
                                             <select class="form-control" id="edit_rcd_emp_id" name="edit_rcd_emp_id" data-live-search="true" required="required">
                                                <?php
                                                $sql = 'SELECT * FROM employee_registration';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['er_id'] . '">' . $row['er_name_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Gender:</label>
                                             <select class="form-control" id="edit_rcd_gender" name="edit_rcd_gender" data-live-search="true" required="required">
                                                <?php
                                                $sql = 'SELECT * FROM gender';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['ge_id'] . '">' . $row['ge_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Position:</label>
                                             <select class="form-control" id="edit_rcd_position" name="edit_rcd_position" data-live-search="true" required="required">
                                                <?php
                                                $sql = 'SELECT * FROM position';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Date:</label>
                                             <input class="form-control" id="edit_rcd_date" name="edit_rcd_date" type="number" required>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" name="btnupdate_detail" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                    </div>
                                    </form>
                                 </div>

                              </div>
                           </div>
                        </div>
                        <!-- Modal Update Detail-->
                        <!-- /.box-header -->
                        <div class="col-md-6">
                           <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                              <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                           <div class="box-body table-responsive">
                              <table id="info_data" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Month</th>
                                       <th>Issue Date</th>
                                       <th>Approve Date</th>
                                       <th>Staus</th>
                                       <th style="width: 110px;">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $sql = "SELECT * FROM roster_creation 
                                                                        LEFT JOIN text_petty_cash_status ON text_petty_cash_status.tpc_id = roster_creation.rc_status 
                                                                        ORDER BY roster_creation.rc_id DESC";
                                    $result = $connect->query($sql);
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                       $v_i = $i++;
                                       $v_name = $row["rc_name"];
                                       $v_issue_date = $row["rc_issue_date"];
                                       $v_approve_date = $row["rc_approve_date"];
                                       $v_status = $row["tpc_name"];
                                    ?>
                                       <tr>
                                          <td><?php echo $v_i; ?></td>
                                          <td><?php echo $v_name; ?></td>
                                          <td><?php echo $v_issue_date; ?></td>
                                          <td><?php echo $v_approve_date; ?></td>
                                          <td><?php echo $v_status; ?></td>
                                          <td>
                                             <!-- <a href="edit_roster.php?id=<?php echo $row['rc_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                             <a onclick="doUpdate(<?php echo $row['rc_id']; ?>,
                                                        '<?php echo $v_name; ?>',
                                                        '<?php echo $v_approve_date; ?>',
                                                        '<?php echo $row['rc_approve_date']; ?>',
                                                        '<?php echo $row['rc_status']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                             <a onclick="return confirm('Are you sure to delete ?');" href="roster.php?del_id=<?php echo $row['rc_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                          </td>
                                       </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_detail" style="margin-bottom: 2%;">
                              <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>

                           <div class="box-body table-responsive">
                              <table id="info_data1" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Month</th>
                                       <th>Job ID</th>
                                       <th>Name KH</th>
                                       <th>Gender</th>
                                       <th>Position</th>
                                       <th>Date</th>
                                       <th>Note</th>
                                       <th style="width: 110px;">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $sql = "SELECT * FROM roster_creation_detail 
                                                                                        LEFT JOIN roster_creation ON roster_creation.rc_id = roster_creation_detail.rcd_roster_id 
                                                                                        LEFT JOIN position ON position.position_id = roster_creation_detail.rcd_position 
                                                                                        LEFT JOIN gender ON gender.ge_id = roster_creation_detail.rcd_gender 
                                                                                        LEFT JOIN employee_registration ON employee_registration.er_id = roster_creation_detail.rcd_er_id 
                                                                                        ORDER BY roster_creation_detail.rcd_id DESC";
                                    $result = $connect->query($sql);

                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                       $v_i = $i++;
                                       $v_name = $row["rc_name"];
                                       $v_rcd_job_id = $row["rcd_job_id"];
                                       $v_er_name_kh = $row["er_name_kh"];
                                       $v_gender_id = $row["ge_name"];
                                       $v_position_id = $row["position"];
                                       $v_date = $row["rcd_date"];
                                       $v_note = $row["rcd_note"];
                                    ?>
                                       <tr>
                                          <td><?php echo $v_i; ?></td>
                                          <td><?php echo $v_name; ?></td>
                                          <td><?php echo $v_rcd_job_id; ?></td>
                                          <td><?php echo $v_er_name_kh; ?></td>
                                          <td><?php echo $v_gender_id; ?></td>
                                          <td><?php echo $v_position_id; ?></td>
                                          <td><?php echo $v_date; ?></td>
                                          <td><?php echo $v_gender_id; ?></td>
                                          <td>
                                             <!-- <a href="edit_roster.php?id=<?php echo $row['rcd_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                             <a onclick="doUpdate_detail(<?php echo $row['rcd_id']; ?>,
                                                        '<?php echo $row['rcd_roster_id']; ?>',
                                                        '<?php echo $row['rcd_date']; ?>',
                                                        '<?php echo $row['rcd_er_id']; ?>',
                                                        '<?php echo $row['rcd_job_id']; ?>',
                                                        '<?php echo $row['rcd_gender']; ?>',
                                                        '<?php echo $row['rcd_position']; ?>')" data-toggle="modal" data-target="#myModal_update_detail" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                             <a onclick="return confirm('Are you sure to delete ?');" href="roster.php?del_id=<?php echo $row['rcd_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                          </td>
                                       </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div><!-- /.box -->
                  </div><!-- /.col -->
               </div>
               <!-- /.row -->
         </section><!-- /.content -->
      </aside><!-- /.right-side -->
   </div><!-- ./wrapper -->

   <!-- jQuery 2.0.2 -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
      function doUpdate(id, month, approve, day, status) {

         $('#roster_creat_id').val(id);
         $('#edit_month').val(month);
         $('#edit_approve_date').val(approve);
         $('#edit_day').val(day).change();
         $('#edit_status').val(status).change();
      }

      function doUpdate_detail(id, roster_id, date, er_id, job_id, gender, position) {
         $('#roster_detail_id').val(id);
         $('#edit_rcd_month').val(roster_id);
         $('#edit_rcd_date').val(date);
         $('#edit_rcd_job_id').val(job_id).change();
         $('#edit_rcd_emp_id').val(er_id).change();
         $('#edit_rcd_gender').val(gender).change();
         $('#edit_rcd_position').val(position).change();
      }

      $('#txt_rcd_job_id').change(function() {
         $('.show_hid').css("visibility", "visible");
         var job_id = $("#txt_rcd_job_id").val();
         if (job_id) {
            $.ajax({
               type: 'POST',
               url: 'fetch_roster.php',
               data: {
                  rc_detail_job_id: job_id
               },
               success: function(html) {
                  $('#amount_data').html(html);
               }
            });
         }
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_attendance").addClass("active");
         $("#roster").addClass("active");
         $("#roster").css("background-color", "##367fa9");

         $('#info_data').dataTable();
         $('#info_data1').dataTable();
         $('#info_data2').dataTable();

         ///////////////////table/////////////////////////////

         var count = 1;
         $('#add').click(function() {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='date'></td>";
            html_code += "<td contenteditable='true' class='name'>OFF</td>";
            html_code += "<td><button type='button' name='remove' data-row='row" + count +
               "'class='btn btn-danger btn-xs remove'>- Remove</button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
         });

         $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
         });

         $('#btnadd_detail').click(function() {
            var v_month = $("#txt_rcd_month").val();
            var v_jobid = $("#txt_rcd_job_id").val();
            var v_emp = $("#txt_rcd_emp_id").val();
            var v_gender = $("#txt_rcd_gender").val();
            var v_position = $("#txt_rcd_position").val();
            var date = [];
            var desc = [];
            $('.date').each(function() {
               date.push($(this).text());
            });
            $('.name').each(function() {
               desc.push($(this).text());
            });
            $.ajax({
               url: "fetch_roster.php",
               type: "POST",
               data: {
                  month: v_month,
                  jobid: v_jobid,
                  emp: v_emp,
                  gender: v_gender,
                  position: v_position,
                  date: date,
                  desc: desc
               },

               success: function(data) {
                  alert(data);
                  $("td[contentEditable='true']").text("");
                  for (var i = 2; i <= count; i++) {
                     $('tr#' + i + '').remove();
                  }
               }
            });
         });
         ///////////////////end table/////////////////////////////
      });
   </script>
</body>

</html>