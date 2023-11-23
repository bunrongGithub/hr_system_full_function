<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];
   $sql = "DELETE FROM loan_request where lr_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header(('location:loan_request.php?message=delete'));
}

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');
if (isset($_POST["btnadd"])) {
   $v_txt_job_id = $_POST["txt_job_id"];
   $v_request_no = $_POST["txt_request_no"];
   $v_loan_amount = $_POST["txt_loan_amount"];
   $v_loan_rate = $_POST["txt_loan_rate"];
   $v_request_date = $_POST["txt_request_date"];
   $v_loan_term_id = $_POST["txt_loan_term_id"];
   $v_reason = $_POST["txt_reason"];
   $v_status_id = 1;
   $v_note = $_POST["txt_note"];
   $user_id = $_SESSION['user_id'];
   $datetime = date('Y-m-d H:i:s');

   $sql = "INSERT INTO loan_request 
                        (lr_job_id
                        ,lr_request_no
                        ,lr_loan_amount
                        ,lr_loan_rate
                        ,lr_request_date
                        ,lr_loan_term_id
                        ,lr_reason
                        ,lr_status_id
                        ,lr_note
                        ,lr_user_id
                        ,created_at)
                    VALUES
                        ('$v_txt_job_id'
                        ,'$v_request_no'
                        ,'$v_loan_amount'
                        ,'$v_loan_rate'
                        ,'$v_request_date'
                        ,'$v_loan_term_id'
                        ,'$v_reason'
                        ,'$v_status_id'
                        ,'$v_note'
                        ,'$user_id'
                        ,'$datetime')
                        ";
   $result = mysqli_query($connect, $sql);
   header('location: loan_request.php?message=success');
   exit();
}

if (isset($_POST["btnupdate"])) {
   $v_e_id = $_POST["txt_e_id"];
   $v_e_note = $_POST['txt_edit_loan_note'];
   $v_e_reason = $_POST['txt_edit_loan_reason'];
   $v_e_req_no = $_POST['txt_edit_loan_no'];
   $v_e_req_date = $_POST['txt_edit_loan_date'];
   $v_e_req_amount = $_POST['txt_edit_loan_amount'];
   $v_e_req_rate = $_POST['txt_edit_loan_rate'];
   $v_e_req_term = $_POST['txt_edit_loan_term'];
   $sql = "UPDATE loan_request SET lr_note = '$v_e_note'
                                 , lr_reason = '$v_e_reason'
                                 , lr_request_no = '$v_e_req_no'
                                 , lr_request_date = '$v_e_req_date'
                                 , lr_loan_amount = '$v_e_req_amount'
                                 , lr_loan_rate = '$v_e_req_rate'
                                 , lr_loan_term_id = '$v_e_req_term' WHERE lr_id = '$v_e_id'
                                 ";
   mysqli_query($connect,$sql);
   header('location: loan_request.php?message=update');
   exit();
}
/** directory */
$Dir = "../img/upload/loan_request/";
if (isset($_POST['btn_file'])) {
   $v_id = $_POST['txt_id'];
   $v_file = @$_FILES['txt_file'];
   $Dir .= basename($_FILES['txt_file']['name']);
   $file_type = strtolower(pathinfo($Dir, PATHINFO_EXTENSION));
   if ($file_type == 'pdf') {
      if ($v_file['name'] != "") {
         $new_name = date("Ymd") . "-" . rand(1111, 9999) . ".pdf";
         move_uploaded_file($v_file['tmp_name'], "../img/upload/loan_request/" . $new_name);
      }
   }

   $v_status = $_POST['txt_status'];
   $sql = "UPDATE loan_request SET lr_status_id = '$v_status', lr_attach_file = '$new_name' where lr_id = '$v_id'";
   mysqli_query($connect, $sql);
   header('location: loan_request.php?message=update');
   exit();
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
            <h1 class="text-primary">Loan Requeset<h1>
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
                           <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> Add New</h3>
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
                                             <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                <label>Request_No:</label>
                                                <input class="form-control" id="txt_request_no" name="txt_request_no" type="text" required>
                                             </div>
                                             <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                <label>Loan_Amount:</label>
                                                <input class="form-control" id="txt_loan_amount" name="txt_loan_amount" type="text" required>
                                             </div>
                                             <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                <label>Loan_Rate: (Input 1 mean 1%)</label>
                                                <input class="form-control" id="txt_loan_rate" name="txt_loan_rate" type="number" required>
                                             </div>
                                             <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                <label>Request_Date:</label>
                                                <input class="form-control" id="txt_request_date" name="txt_request_date" type="date" required>
                                             </div>
                                             <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                <label>Loan_Term:</label>
                                                <select class="selectpicker form-control" id="txt_loan_term_id" name="txt_loan_term_id" data-live-search="true" required="required">
                                                   <option disabled selected>Please Select...</option>
                                                   <?php
                                                   $sql = 'SELECT * FROM text_loan_request_loan_term';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['tlt_id'] . '">' . $row['tlt_name'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>Reason:</label>
                                                <input class="form-control" id="txt_reason" name="txt_reason" type="text" required>
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>Note:</label>
                                                <input class="form-control" id="txt_note" name="txt_note" type="text">
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
               <!--End modal Add New-->

               <!-- modal edit -->

               <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;Upload File</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" id="txt_id" name="txt_id">
                              <input type="hidden" name="txt_old_file" id="txt_old_file">
                              <div class="col-xs-12">
                                 <div class="col-xs-6 form-group">
                                    <label for="">File:</label>
                                    <input required type="file" name="txt_file" class="form-control" accept="application/pdf" id="txt_file" onchange="loadfile(event);">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Status:</label>
                                    <select required name="txt_status" class="form-control select2" data-live-search="true" id="txt_status">
                                       <?php
                                       $sql = "SELECT * FROM text_loan_request_status ORDER BY ts_name ASC";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row_se = mysqli_fetch_assoc($result)) {
                                          if ($row_se['ts_id'] == $row['lr_status_id']) {
                                       ?>
                                             <option selected value="<?= $row_se['ts_id']; ?>"><?= $row_se['ts_name']; ?></option>
                                          <?php
                                          } else {
                                          ?>
                                             <option value="<?= $row_se['ts_id']; ?>"><?= $row_se['ts_name']; ?></option>
                                       <?php
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                           <button type="submit" name="btn_file" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
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
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="txt_e_id" id="txt_e_id">
                              <div class="col-md-12">
                                 <div class="col-xs-6 form-group">
                                    <label for="">Loan Requeset No:</label>
                                    <input type="text" name="txt_edit_loan_no" class="form-control" id="txt_edit_loan_no">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Loan Requeset Date:</label>
                                    <input type="date" name="txt_edit_loan_date" class="form-control" id="txt_edit_loan_date">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Loan Amount:</label>
                                    <input type="text" name="txt_edit_loan_amount" class="form-control" id="txt_edit_loan_amount">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Loan_Rate: (Input 1 mean 1%):</label>
                                    <input type="text" name="txt_edit_loan_rate" class="form-control" id="txt_edit_loan_rate">
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Loan_Term::</label>
                                    <select name="txt_edit_loan_term" class="form-control" data-live-search="true" id="txt_edit_loan_term">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = 'SELECT * FROM text_loan_request_loan_term';
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value="' . $row['tlt_id'] . '">' . $row['tlt_name'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Reason:</label>
                                    <textarea cols="2" name="txt_edit_loan_reason" class="form-control" id="txt_edit_loan_reason"></textarea>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="">Note:</label>
                                    <textarea cols="2" name="txt_edit_loan_note" class="form-control" id="txt_edit_loan_note"></textarea>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="btnupdate" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update</button>
                                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 connectedSortable">
                  <div style="margin-top: -2%;" class="box">
                     <table id="info_data" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">Job_Id/Reqest_ID</th>
                              <th class="text-center">Employee_Info</th>
                              <th class="text-center">Compnay_Info</th>
                              <th class="text-center">Salary/Loan_Info</th>
                              <th class="text-center">Date/Term</th>
                              <th class="text-center">Status/File</th>
                              <th class="text-center">User/Create_At</th>
                              <th class="text-center">Note</th>
                              <th class="text-center" style="width: 100px;"><i class="fa fa-cog"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM loan_request A
                                                      LEFT JOIN employee_registration B ON B.er_id=A.lr_job_id
                                                      LEFT JOIN gender C ON C.ge_id=B.er_gender_id
                                                      LEFT JOIN position D ON D.position_id=B.er_position_id
                                                      LEFT JOIN company E ON E.c_id=B.er_company_id
                                                      LEFT JOIN user_branch F ON F.ub_id=B.er_branch_id
                                                      LEFT JOIN department G ON G.de_id=B.er_department_id
                                                      LEFT JOIN text_loan_request_loan_term H ON H.tlt_id=A.lr_loan_term_id
                                                      LEFT JOIN text_loan_request_status I ON I.ts_id=A.lr_status_id
                                                      LEFT JOIN user J ON J.id=A.lr_user_id
                                          ";
                           $result = $connect->query($sql);
                           $i = 1;
                           while ($row = mysqli_fetch_assoc($result)) {
                              $v_i = $i++;
                              $v_request_no = $row["lr_request_no"];
                              $v_job_id = $row["er_job_id"];
                              $v_employee_name = $row["er_name_en"];
                              $v_gender_id = $row["ge_name"];
                              $v_position_id = $row["position"];
                              $v_branch_id = $row["ub_name"];
                              $v_department_id = $row["de_name"];
                              $v_company_id = $row["c_name_en"];
                              $v_basic_salary = $row["er_salary"];
                              $v_loan_amount = $row["lr_loan_amount"];
                              $v_loan_rate = $row["lr_loan_rate"];
                              $v_request_date = $row["lr_request_date"];
                              $v_loan_term_id = $row["tlt_name"];
                              $v_reason = $row["lr_reason"];
                              $v_status_id = $row["ts_name"];
                              $v_attach_file = $row["lr_attach_file"];
                              $v_user_id = $row["username"];
                              $v_created_at = $row["created_at"];
                              $v_note = $row["lr_note"];
                           ?>
                              <tr>
                                 <td class="text-center" style="vertical-align: middle;"><?php echo $v_i; ?></td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Job_ID: </i><?php echo $v_job_id; ?><br>
                                    <i>Request_ID: </i><?php echo $v_request_no; ?>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Name: </i><?php echo $v_employee_name; ?> <br>
                                    <i>Sex: </i><?php echo $v_gender_id; ?> <br>
                                    <i>Position: </i><?php echo $v_position_id; ?>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                    <i>Branch: </i><?php echo $v_branch_id; ?> <br>
                                    <i>Department: </i> <?php echo $v_department_id; ?> <br>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Salary: </i><?php echo number_format($v_basic_salary) . '$'; ?><br>
                                    <i>Loan Amount: </i><?php echo number_format($v_loan_amount) . '$'; ?><br>
                                    <i>Loan Rate: </i><?php echo $v_loan_rate; ?>% <br>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Request Date: </i><?php echo $v_request_date; ?><br>
                                    <i>Term: </i><?php echo $v_loan_term_id; ?><br>
                                    <i>Reason: </i><?php echo $v_reason; ?><br>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Status: </i><?php echo $v_status_id; ?><br>
                                    <i>File: </i><br>
                                    <?php
                                    if ($v_attach_file == "") {
                                    ?>
                                       <a target=”_blank” href="../img/file/image_no_file.png">
                                          <img height="50px" src="../img/file/image_no_file.png">
                                       </a>
                                    <?php
                                    } else {
                                    ?>
                                       <a target=”_blank” href="../img/upload/loan_request/<?php echo $row['lr_attach_file']; ?>">
                                          <img height="50px" src="../img/file/pdf_image.png">
                                       </a>
                                    <?php
                                    }
                                    ?>
                                    <a onclick="diFile('<?= $row['lr_id']; ?>','<?= $row['lr_attach_file']; ?>','<?= $row['lr_status_id']; ?>');" data-toggle="modal" data-target="#modal_file">
                                       <i style="cursor: pointer;" class="fa fa-pencil"></i>
                                    </a>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <i>Input By: </i><?php echo $v_user_id; ?><br>
                                    <i>Date :</i><?php echo $v_created_at; ?>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <?php echo $v_note; ?>
                                 </td>
                                 <td class="text-center" style="vertical-align: middle;">
                                    <!--insert-->
                                    <a onclick="doUpdate(
                                       '<?=$row['lr_id'];?>',
                                       '<?=$row['lr_request_no'];?>',
                                       '<?=$row['lr_loan_amount'];?>',
                                       '<?=$row['lr_loan_rate'];?>',
                                       '<?=$row['lr_request_date'];?>',
                                       '<?=$row['lr_loan_term_id'];?>',
                                       '<?=$row['lr_reason'];?>',
                                       '<?=$row['lr_note'];?>',
                                    );" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                       <i style="color: white;" class="fa fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <a onclick="return confirm('Are you sure to delete ?');" href="loan_request.php?del_id=<?php echo $row['lr_id']; ?>" class="btn btn-danger btn-sm">
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
         $('#txt_job_id').change(function() {
            $('.show_hid').css("visibility", "visible");
            var job_id = $("#txt_job_id").val();
            if (job_id) {
               $.ajax({
                  type: 'POST',
                  url: 'fetch_pay_ot.php',
                  data: {
                     'pay_ot_job_id': job_id
                  },
                  success: function(html) {
                     $('#amount_data').html(html);
                  }
               });
            }
         })

         function diFile(id, file, status) {
            $("#txt_id").val(id);
            $("#txt_file").val(file);
            $("#txt_status").val(status).change();
         }

         function doUpdate(id,no,amount ,rate,date,term_id,reason,note) {
            var rate_5 = Math.floor(rate)+"%";
            var $_mount =amount+"$";
            $("#txt_e_id").val(id);
            $("#txt_edit_loan_no").val(no);
            $("#txt_edit_loan_amount").val($_mount);
            $("#txt_edit_loan_rate").val(rate_5);
            $("#txt_edit_loan_date").val(date);
            $("#txt_edit_loan_term").val(term_id).change();
            $("#txt_edit_loan_reason").val(reason);
            $("#txt_edit_loan_note").val(note);

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
            $("#menu_loan").addClass("active");
            $("#loan_request").addClass("active");
            $("#loan_request").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>

</body>

</html>