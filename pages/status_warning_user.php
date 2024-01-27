<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['del_id'])) {
    $v_status_id = $_GET['sent_id'];
    $id = $_GET['del_id'];
    $sql = "DELETE FROM text_warning_status_user where wsu_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: status_warning_user.php?sent_id=$v_status_id");
}

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

$v_status_id = $_GET['sent_id'];
if (isset($_POST["btnadd"])) {  
    $v_name = $_POST["txt_user_id"];
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO text_warning_status_user
                        (wsu_user_id
                        , wsu_status_id
                        , created_at)
                    VALUES
                        ('$v_name'
                        , '$v_status_id'
                        , '$datetime'
                        )";
    $result = mysqli_query($connect, $sql);
    header("location: status_warning_user.php?sent_id=$v_status_id");
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["edit_id"];
    $edit_name = $_POST["edit_name"];

    $sql = "UPDATE text_warning_status_user SET
                        wsu_user_id = '$edit_name'
                        WHERE wsu_id = $id";
    $result = mysqli_query($connect, $sql);
    header("location: status_warning_user.php?sent_id=$v_status_id");
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
                <h1 class="text-primary">Status Staff Warning (User Auth)<h1>
                        
                    <a href="status_warning.php" class="btn btn-danger btn-sm">
                        <i style="color:white;" class="fa fa-undo"></i>
                        Back
                    </a>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        Add New
                    </button>
            </section>
            <section class="content">
                <div class="row">
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
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
                                                                <div class="form-group col-xs-6">
                                                                    <label for="ot-type">User:</label>
                                                                    <select class="form-control select2" name="txt_user_id" id="">
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
                                <!-- Modal -->
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
                                            <input class="hidden" type="text" name="edit_id" id="edit_id">
                                            <div class="form-group col-xs-6">
                                                <label for="ot-type">User</label>
                                                <select class="form-control select2" name="edit_name" id="edit_name">
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
                                        <th class="text-center" >Status</th>
                                        <th class="text-center" >User</th>
                                        <th class="text-center" >Date</th>
                                        <th class="text-center"  style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_GET['sent_id'];
                                    $sql = "SELECT * FROM text_warning_status_user A
                                            LEFT JOIN text_warning_status B ON B.tws_id=A.wsu_status_id
                                            LEFT JOIN user C ON C.id=A.wsu_user_id
                                            WHERE wsu_status_id=$id
                                            ";
                                    $result = $connect->query($sql);
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_status_id = $row["tws_name"];
                                        $v_user_id = $row["username"];
                                        $created_at = $row["created_at"];
                                    ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_i; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_status_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $v_user_id; ?></td>
                                            <td class="text-center" style="vertical-align: middle;" ><?php echo $created_at; ?></td>
                                            
                                            <td class="text-center" style="vertical-align: middle;" >
                                                
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['wsu_id']; ?>',
                                                                    '<?php echo $row['wsu_user_id']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="status_warning_user.php?del_id=<?php echo $row['wsu_id']; ?>&sent_id=<?php echo $row['wsu_status_id']; ?>" class="btn btn-danger btn-sm">
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
            function doUpdate(id, name) {
                $('#edit_id').val(id);
                $('#edit_name').val(name);
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
                $("#menu_setting").addClass("active");
                $("#status_warning").addClass("active");
                $("#status_warning").css("background-color", "##367fa9");
                $('#info_data').dataTable();
            });
        </script>

</body>

</html>