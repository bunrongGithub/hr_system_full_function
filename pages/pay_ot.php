<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $sql = "DELETE FROM pay_ot where po_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header(('location:pay_ot.php?message=delete'));
}
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');
if (isset($_POST["btnadd"])) {
    $v_txt_job_id = $_POST["txt_job_id"];
    $v_ot_request_no = $_POST["ot_request_no"];
    $v_ot_type = $_POST["ot_type"];
    $v_ot_rate = $_POST["ot_rate"];
    $v_ot_date = $_POST["ot_date"];
    $v_start_time = $_POST["start_time"];
    $v_end_time = $_POST["end_time"];
    $v_total_time = $_POST["total_time"];
    $v_total_amount_ot = $_POST["total_amount_ot"];
    $v_user = $_POST['user'];
    $v_remark = $_POST["remark"];
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO pay_ot
                        (po_job_id
                        ,po_ot_request_no_id
                        ,po_ot_type_id
                        ,po_ot_rate
                        ,po_ot_date
                        ,po_start_time
                        ,po_end_time
                        ,po_total_time
                        ,po_total_amount
                        ,po_user_id
                        ,po_note
                        ,created_at)
                    VALUES
                        ('$v_txt_job_id'
                        ,'$v_ot_request_no'
                        ,'$v_ot_type'
                        ,'$v_ot_rate'
                        ,'$v_ot_date'
                        ,'$v_start_time'
                        ,'$v_end_time'
                        ,'$v_total_time'
                        ,'$v_total_amount_ot'
                        ,'$v_user'
                        ,'$v_remark'
                        ,'$datetime')
                        ";
    $result = mysqli_query($connect, $sql);
    header('location: pay_ot.php?message=success');
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["pay_ot_id"];
    $edit_ot_request_no_id = $_POST["edit_ot_request_no_id"];
    $edit_ot_type = $_POST["edit_ot_type"];
    $edit_ot_rate = $_POST["edit_ot_rate"];
    $edit_ot_date = $_POST["edit_ot_date"];
    $edit_start_time = $_POST["edit_start_time"];
    $edit_end_time = $_POST["edit_end_time"];
    $edit_total_time = $_POST["edit_total_time"];
    $edit_total_amount = $_POST["edit_total_amount"];
    $edit_user = $_POST["edit_user"];
    $edit_note = $_POST["edit_note"];


    $sql = "UPDATE pay_ot SET
                        po_ot_request_no_id = '$edit_ot_request_no_id',
                        po_ot_type_id = '$edit_ot_type',
                        po_ot_rate = '$edit_ot_rate',
                        po_ot_date = '$edit_ot_date',
                        po_start_time = '$edit_start_time',
                        po_end_time = '$edit_end_time',
                        po_total_time = '$edit_total_time',
                        po_total_amount = '$edit_total_amount',
                        po_user_id = '$edit_user',
                        po_note = '$edit_note'
                        WHERE po_id = $id";
    $result = mysqli_query($connect, $sql);
    header('location:pay_ot.php?message=update');
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
                <h1 class="text-primary">Pay OT<h1>
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
                                    <h3 class="modal-title text-light-blue" id="exampleModalLabel"><i class="fa fa-plus-square-o"></i> Pay New OT</h3>
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
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label for="ot-type">OT Request NO.</label>
                                                                <select class="form-control select2" name="ot_request_no" id="ot_request_no">
                                                                    <option value="">===Select===</option>
                                                                    <?php
                                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM ot_request ORDER BY otr_no ASC");
                                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['otr_id'] ?>"><?php echo $row['otr_no'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="ot-type">OT Type</label>
                                                                <select class="form-control select2" name="ot_type" id="">
                                                                    <option value="">===Select===</option>
                                                                    <?php
                                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_ot_type ORDER BY pot_name ASC");
                                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['pot_id'] ?>"><?php echo $row['pot_name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">OT Rate:</label>
                                                                <input class="form-control" type="text" name="ot_rate" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">OT Date:</label>
                                                                <input class="form-control" type="date" name="ot_date" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Start Time:</label>
                                                                <input class="form-control" type="date" name="start_time" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">End Time:</label>
                                                                <input class="form-control" type="date" name="end_time" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Total Time:</label>
                                                                <input class="form-control" type="text" name="total_time" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="">Total Amount OT:</label>
                                                                <input class="form-control" type="text" name="total_amount_ot" id="">
                                                            </div>
                                                            <div class="form-group col-xs-6 show_hid" style="visibility: hidden;">
                                                                <label for="ot-type">Input By</label>
                                                                <select class="form-control select2" name="user" id="">
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
                                                            <div class="form-group col-xs-12 show_hid" style="visibility: hidden;">
                                                                <label for="">Remark:</label>
                                                                <textarea class="form-control" type="text" name="remark" id=""></textarea>
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
                                            <input class="hidden" type="text" name="pay_ot_id" id="pay_ot_id">
                                            <div class="form-group col-xs-6">
                                                <label for="ot-type">OT Request NO.</label>
                                                <select class="form-control select2" name="edit_ot_request_no_id" id="edit_ot_request_no_id">
                                                    <option value="">===Select===</option>
                                                    <?php
                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM ot_request ORDER BY otr_no ASC");
                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                    ?>
                                                        <option value="<?php echo $row['otr_id'] ?>"><?php echo $row['otr_no'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="ot-type">OT Type</label>
                                                <select class="form-control select2" name="edit_ot_type" id="edit_ot_type">
                                                    <option value="">===Select===</option>
                                                    <?php
                                                    $v_sellect = mysqli_query($connect, "SELECT * FROM text_pay_ot_type ORDER BY pot_name ASC");
                                                    while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                    ?>
                                                        <option value="<?php echo $row['pot_id'] ?>"><?php echo $row['pot_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">OT Rate:</label>
                                                <input class="form-control" type="text" name="edit_ot_rate" id="edit_ot_rate">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">OT Date:</label>
                                                <input class="form-control" type="date" name="edit_ot_date" id="edit_ot_date">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Start Time:</label>
                                                <input class="form-control" type="date" name="edit_start_time" id="edit_start_time">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">End Time:</label>
                                                <input class="form-control" type="date" name="edit_end_time" id="edit_end_time">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Total Time:</label>
                                                <input class="form-control" type="text" name="edit_total_time" id="edit_total_time">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label for="">Total Amount OT:</label>
                                                <input class="form-control" type="text" name="edit_total_amount" id="edit_total_amount">
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
                                            <div class="form-group col-xs-12">
                                                <label for="">Remark:</label>
                                                <textarea class="form-control" type="text" name="edit_note" id="edit_note"></textarea>
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
                                        <th class="text-center" >No.</th>
                                        <th class="text-center" >Job_Id</th>
                                        <th class="text-center" >Employee Info</th>
                                        <th class="text-center" >Compnay Info</th>
                                        <th class="text-center" >OT Type</th>
                                        <th class="text-center" >OT Rate</th>
                                        <th class="text-center" >OT Date</th>
                                        <th class="text-center" >Total Time</th>
                                        <th class="text-center" >Total Amount OT</th>
                                        <th class="text-center" >Input BY/Date</th>
                                        <th class="text-center" >Note</th>
                                        <th class="text-center"  style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM pay_ot A 
                                            LEFT JOIN employee_registration B on B.er_id=A.po_job_id
                                            LEFT JOIN gender C on C.ge_id=B.er_gender_id
                                            LEFT JOIN position D on D.position_id=B.er_position_id
                                            LEFT JOIN company E on E.c_id=B.er_company_id
                                            LEFT JOIN user_branch F on F.ub_id=B.er_branch_id
                                            LEFT JOIN department G on G.de_id=B.er_department_id
                                            LEFT JOIN user H on H.id=A.po_user_id
                                            LEFT JOIN text_pay_ot_type I on I.pot_id=A.po_ot_type_id
                                            LEFT JOIN ot_request J on J.otr_id=A.po_ot_request_no_id
                                            ";
                                    $result = $connect->query($sql);
                                    // $row=$result->fetch_assoc();
                                    // echo $row['ef_date'];
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_job_id = $row["er_job_id"];
                                        $v_otr_no = $row["otr_no"];
                                        $v_name_kh = $row["er_name_kh"];
                                        $v_gender_id = $row["ge_name"];
                                        $v_position_id = $row["position"];
                                        $v_company_id = $row["c_name_kh"];
                                        $v_ub_id = $row["ub_name"];
                                        $v_department_id = $row["de_name"];
                                        $v_id = $row["username"];
                                        $v_pot_id = $row["pot_name"];
                                        $v_ot_rate = $row["po_ot_rate"];
                                        $v_ot_date = $row["po_ot_date"];
                                        $v_total_time = $row["po_total_time"];
                                        $v_total_amount = $row["po_total_amount"];
                                        $v_note = $row["po_note"];
                                        $v_created_at = $row["created_at"];
                                    ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_i; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_job_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" >
                                                <i>Name: </i><?php echo $v_name_kh; ?> <br>
                                                <i>Sex: </i><?php echo $v_gender_id; ?> <br>
                                                <i>Position: </i><?php echo $v_position_id; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;" >
                                                <i>Company Name: </i><?php echo $v_company_id; ?> <br>
                                                <i>Branch: </i><?php echo $v_ub_id; ?> <br>
                                                <i>Department: </i> <?php echo $v_department_id; ?> <br>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_pot_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_ot_rate; ?>%</td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_ot_date; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_total_time; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_total_amount; ?>$</td>
                                            <td class="text-center" style="vertical-align: middle;" >
                                                <i>Input By: </i><?php echo $v_id; ?><br>
                                                <i>Date :</i><?php echo $v_created_at; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_note; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" >
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['po_id']; ?>',
                                                                    '<?php echo $row['po_ot_request_no_id']; ?>',
                                                                    '<?php echo $row['po_ot_type_id']; ?>',
                                                                    '<?php echo $v_ot_rate; ?>',
                                                                    '<?php echo $v_ot_date; ?>',
                                                                    '<?php echo $row['po_start_time']; ?>',
                                                                    '<?php echo $row['po_end_time']; ?>',
                                                                    '<?php echo $v_total_time; ?>',
                                                                    '<?php echo $v_total_amount; ?>',
                                                                    '<?php echo $row['po_user_id']; ?>',
                                                                    '<?php echo $v_note; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="pay_ot.php?del_id=<?php echo $row['po_id']; ?>" class="btn btn-danger btn-sm">
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

            function doUpdate(id, ot_request_no, ot_type, ot_rate, ot_date, start_time, end_time, total_time, total_amount, user, note) {
                $('#pay_ot_id').val(id);
                $('#edit_ot_request_no_id').val(ot_request_no);
                $('#edit_ot_type').val(ot_type);
                $('#edit_ot_rate').val(ot_rate);
                $('#edit_ot_date').val(ot_date);
                $('#edit_start_time').val(start_time);
                $('#edit_end_time').val(end_time);
                $('#edit_total_time').val(total_time);
                $('#edit_total_amount').val(total_amount);
                $('#edit_user').val(user);
                $('#edit_note').val(note);
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
                $("#menu_salary").addClass("active");
                $("#pay_ot").addClass("active");
                $("#pay_ot").css("background-color", "##367fa9");
                $('#info_data').dataTable();
            });
        </script>

</body>

</html>