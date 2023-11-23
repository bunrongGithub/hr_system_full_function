<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

$id = $_GET['id'];
$sql_gov = "SELECT * FROM company_governance A
        LEFT JOIN company B ON B.c_id=A.cg_company_id
        LEFT JOIN user_branch C ON C.ub_id=A.cg_branch_id
        WHERE cg_id='$id'
        ";
$result_gov = $connect->query($sql_gov);
$row_gov = $result_gov->fetch_assoc();


if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $id = $_GET['id'];
    $sql = "DELETE FROM company_gov_document where cgd_id = '$del_id'";
    $result = mysqli_query($connect, $sql);
    header("location: company_governance_edit.php?id=$id");
}

if (isset($_POST["btnadd"])) {
    $id = $_GET['id'];
    $v_document_name = $_POST["txt_document_name"];

    $sql = "INSERT INTO company_gov_document 
                        (
                            cgd_com_gov_id,
                            cgd_doc_name
                        )
                    VALUES
                        (
                            '$id',
                            '$v_document_name'
                        )
                        ";
    $result = mysqli_query($connect, $sql);
    $sql_m = "UPDATE company_governance SET 
                            cg_document_list_id = $id";
    $result = mysqli_query($connect, $sql_m);
    header("location: company_governance_edit.php?id=$id");
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_GET['id'];
    $gov_id = $_POST["company_governance_edit_id"];
    $edit_document_name = $_POST["edit_document_name"];

    $sql = "UPDATE company_gov_document SET
                        cgd_doc_name = '$edit_document_name'
                        WHERE cgd_id = $gov_id";
    $result = mysqli_query($connect, $sql);
    header("location:company_governance_edit.php?id=$id");
}

if (isset($_POST['btn_add_pdf'])) {
    $cgd_id = $_POST['cgd_id'];
    $id = $_GET['id'];
    $v_image = @$_FILES['cgd_attach_file'];    
    if ($v_image["name"] != "") {
        $old_image = @$_POST['txt_old_img'];
        if (file_exists("../img/file/" . $old_image) and $old_image != 'blank.png') {
            unlink("../img/file/" . $old_image);
        }

        $new_name = date("Ymd") . "_" . rand(1111, 9999) . ".pdf";
        move_uploaded_file($v_image["tmp_name"], "../img/file/" . $new_name);

        $query_update = "UPDATE company_gov_document SET
                              cgd_attach_file='$new_name' 
                        WHERE cgd_id=$cgd_id";

        if ($connect->query($query_update)) {
            header("Location:company_governance_edit.php?id=$id");
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
                <h1 class="text-primary">Company Governance Edit<h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-md-3">
                                    <div class="form-group col-md-12">
                                        <label for="">Document Name:</label>
                                        <input class="form-control" readonly type="text" name="edit_document" value="<?php echo $row_gov['cg_document']; ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Company Name:</label>
                                        <input class="form-control" readonly type="text" name="edit_company_name" value="<?php echo $row_gov['c_name_kh']; ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Branch Name:</label>
                                        <input class="form-control" readonly type="text" name="edit_branch_name" value="<?php echo $row_gov['ub_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group col-xs-12">
                                        <h4><b>Expired Document</b></h4>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Start:</label>
                                        <input class="form-control" readonly type="date" name="edit_start" value="<?php echo $row_gov['cg_expired_start']; ?>">
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">End:</label>
                                        <input class="form-control" readonly type="date" name="edit_end" value="<?php echo $row_gov['cg_expired_end']; ?>">
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Period:</label>
                                        <input class="form-control" readonly type="text" name="edit_period" value="<?php echo $row_gov['cg_expired_period']; ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <h4><b>Duration Alert</b></h4>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">From:</label>
                                        <input class="form-control" readonly type="date" name="edit_from" value="<?php echo $row_gov['cg_alert_from']; ?>">
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">To:</label>
                                        <input class="form-control" readonly type="date" name="edit_to" value="<?php echo $row_gov['cg_alert_to']; ?>">
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Alert Time:</label>
                                        <input class="form-control" readonly type="text" name="edit_qty" value="<?php echo $row_gov['cg_alert_qty']; ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Remark:</label>
                                        <textarea class="form-control" readonly name="edit_note" id="edit_note" cols="30" rows=""><?php echo $row_gov['cg_note']; ?></textarea>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="content">
                    <div class="col-xs-12 connectedSortable">
                        <a href="company_governance.php" class="btn btn-danger btn-sm">
                            <i style="color:white;" class="fa fa-undo"></i> Back
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            Add New
                        </button>
                        <!-- Modal add new -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog" style="width: 350px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New </h4>
                                    </div>
                                    <form method="post" enctype="multipart/form-data" action="">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label for="">Document List:</label>
                                                    <input class="form-control" type="text" name="txt_document_name">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end Modal add new -->
                        <!-- modal edit -->
                        <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width: 350px;">
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
                                                <input class="hidden" type="text" name="company_governance_edit_id" id="company_governance_edit_id">
                                                <div class="form-group col-md-12">
                                                    <label for="">Document Name:</label>
                                                    <input class="form-control" type="text" name="edit_document_name" id="edit_document_name">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end edit -->
                        <div class="box border">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Document List</th>
                                        <th>Attach File</th>
                                        <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM company_gov_document A
                                            WHERE cgd_com_gov_id=$id
                                            ";
                                    $result = $connect->query($sql);
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_doc_name = $row["cgd_doc_name"];
                                        $v_attach_file = $row["cgd_attach_file"];
                                    ?>
                                        <tr>
                                            <td><?php echo $v_i; ?></td>
                                            <td><?php echo $v_doc_name; ?></td>
                                            <td scope="row">
                                                <?php
                                                if ($v_attach_file == "") {
                                                ?>
                                                    <a target=”_blank” href="../img/file/image_no_file.png">
                                                        <img height="50px" src="../img/file/image_no_file.png">
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a target=”_blank” href="../img/file/<?= $row['cgd_attach_file']; ?>">
                                                        <img height="50px" src="../img/file/pdf_image.png">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a onclick="doUpdate(<?php echo $row['cgd_id']; ?>)" data-toggle="modal" data-target="#exampleModal_upload<?php echo $row['cgd_id']; ?>">
                                                    <i style="cursor: pointer;" class="fa fa-pencil"></i></a>
                                            </td>
                                            <td>
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['cgd_id']; ?>',
                                                                    '<?php echo $row['cgd_doc_name']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="company_governance_edit.php?del_id=<?php echo $row['cgd_id']; ?>&id=<?php echo $row['cgd_com_gov_id']; ?>" class="btn btn-danger btn-sm">
                                                    <i style="color:white;" class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Start Upload File -->
                                        <div class="modal fade" id="exampleModal_upload<?php echo $row['cgd_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <input type="hidden" name="cgd_id" value="<?php echo $row["cgd_id"] ?>">
                                                            <input type="hidden" name="txt_old_img" value="<?= @$_GET['cgd_attach_file'] ?>">
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
            function doUpdate(cgd_id,cgd_doc_name) {
                $('#company_governance_edit_id').val(cgd_id);
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
                $("#menu_task_manager").addClass("active");
                $("#company_task").addClass("active");
                $("#company_task").css("background-color", "##367fa9");
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