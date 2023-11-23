<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $sql = "DELETE FROM supplier_contract where sc_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header(('location:supplier_contract.php?message=delete'));
}
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('Y-m');

if (isset($_POST["btnadd"])) {
    $v_txt_supplier_name = $_POST["txt_supplier_name"];
    $v_txt_supplier_description = $_POST["txt_supplier_description"];
    $v_txt_tel = $_POST["txt_tel"];
    $v_txt_email = $_POST["txt_email"];
    $v_txt_start = $_POST["txt_start"];
    $v_txt_end = $_POST["txt_end"];
    $v_txt_period = $_POST["txt_period"];
    $v_txt_note = $_POST["txt_note"];
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO supplier_contract
                        (
                            sc_supplier_name,
                            sc_supplier_description,
                            sc_tel,
                            sc_email,
                            sc_start,
                            sc_end,
                            sc_period,
                            sc_note,
                            sc_create_at
                        )
                    VALUES
                        (
                            '$v_txt_supplier_name',
                            '$v_txt_supplier_description',
                            '$v_txt_tel',
                            '$v_txt_email',
                            '$v_txt_start',
                            '$v_txt_end',
                            '$v_txt_period',
                            '$v_txt_note',
                            '$datetime'
                        )
                        ";
    $result = mysqli_query($connect, $sql);
    header('location: supplier_contract.php?message=success');
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["supplier_contract_id"];
    $edit_supplier_name = $_POST["edit_supplier_name"];
    $edit_supplier_description = $_POST["edit_supplier_description"];
    $edit_tel = $_POST["edit_tel"];
    $edit_email = $_POST["edit_email"];
    $edit_start = $_POST["edit_start"];
    $edit_end = $_POST["edit_end"];
    $edit_period = $_POST["edit_period"];
    $edit_sc_note = $_POST["edit_sc_note"];

    $sql = "UPDATE supplier_contract SET
                        sc_supplier_name = '$edit_supplier_name',
                        sc_supplier_description = '$edit_supplier_description',
                        sc_tel = '$edit_tel',
                        sc_email = '$edit_email',
                        sc_start = '$edit_start',
                        sc_end = '$edit_end',
                        sc_period = '$edit_period',
                        sc_note = '$edit_sc_note'
                        WHERE sc_id = $id";
    $result = mysqli_query($connect, $sql);
    header('location:supplier_contract.php?message=update');
}

if (isset($_POST['btn_add_pdf'])) {
    $v_image = @$_FILES['sc_file'];
    $v_id = @$_POST['sc_id'];
    if ($v_image["name"] != "") {
        $old_image = @$_POST['txt_old_img'];
        if (file_exists("../img/file/" . $old_image) and $old_image != 'blank.png') {
            unlink("../img/file/" . $old_image);
        }

        $new_name = date("Ymd") . "_" . rand(1111, 9999) . ".pdf";
        move_uploaded_file($v_image["tmp_name"], "../img/file/" . $new_name);

        $query_update = "UPDATE supplier_contract SET
                              sc_file='$new_name' 
                        WHERE sc_id='$v_id'";

        if ($connect->query($query_update)) {
            header("Location: supplier_contract.php");
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
                <h1 class="text-primary">Supplier Contract<h1>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            Add New
                        </button>
            </section>
            <!-- modal -->
            <!-- Modal add new -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" style="width: 750px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Supplier Contract</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group col-xs-6">
                                        <label for="">Supplier Name:</label>
                                        <input class="form-control" type="text" name="txt_supplier_name" id="">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Supplier Description:</label>
                                        <input class="form-control" type="text" name="txt_supplier_description" id="">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <h3><b>Contact Info.</b></h3>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <h3><b>Contract Period.</b></h3>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Tel:</label>
                                        <input class="form-control" type="text" name="txt_tel" id="">
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label for="">Start:</label>
                                        <input class="form-control" type="date" name="txt_start" id="">
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label for="">End:</label>
                                        <input class="form-control" type="date" name="txt_end" id="">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Email:</label>
                                        <input class="form-control" type="email" required name="txt_email" id="">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Period:</label>
                                        <input class="form-control" type="text" name="txt_period" id="">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Remark:</label>
                                        <textarea class="form-control" name="txt_note" id="" type="text"></textarea>
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
            <!-- Modal -->
            <!-- modal edit -->
            <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width: 750px;">
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
                                    <input class="hidden" type="text" name="supplier_contract_id" id="supplier_contract_id">
                                    <div class="form-group col-xs-6">
                                        <label for="">Supplier Name:</label>
                                        <input class="form-control" type="text" name="edit_supplier_name" id="edit_supplier_name">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Supplier Description:</label>
                                        <input class="form-control" type="text" name="edit_supplier_description" id="edit_supplier_description">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <h3><b>Contact Info.</b></h3>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <h3><b>Contract Period.</b></h3>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Tel:</label>
                                        <input class="form-control" type="text" name="edit_tel" id="edit_tel">
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label for="">Start:</label>
                                        <input class="form-control" type="date" name="edit_start" id="edit_start">
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label for="">End:</label>
                                        <input class="form-control" type="date" name="edit_end" id="edit_end">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Email:</label>
                                        <input class="form-control" type="email" required name="edit_email" id="edit_email">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Period:</label>
                                        <input class="form-control" type="text" name="edit_period" id="edit_period">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Remark:</label>
                                        <textarea class="form-control" type="text" name="edit_sc_note" id="edit_sc_note"></textarea>
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
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 connectedSortable">
                        <div class="box border">
                            <table id="info_data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Description</th>
                                        <th>Contact Info</th>
                                        <th>Period Contract</th>
                                        <th>Attach File</th>
                                        <th>Note</th>
                                        <th style="width: 100px;"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM supplier_contract ";
                                    $result = $connect->query($sql);
                                    // $row=$result->fetch_assoc();
                                    // echo $row['ef_date'];
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $v_i = $i++;
                                        $v_supplier_name = $row["sc_supplier_name"];
                                        $v_supplier_description = $row["sc_supplier_description"];
                                        $v_tel = $row["sc_tel"];
                                        $v_email = $row["sc_email"];
                                        $v_start = $row["sc_start"];
                                        $v_end = $row["sc_end"];
                                        $v_period = $row["sc_period"];
                                        $v_attach_file = $row["sc_file"];
                                        $v_note = $row["sc_note"];
                                    ?>
                                        <tr>
                                            <td><?php echo $v_i; ?></td>
                                            <td><?php echo $v_supplier_name; ?></td>
                                            <td><?php echo $v_supplier_description; ?></td>
                                            <td>
                                                <i>Tel: </i><?php echo $v_tel; ?><br>
                                                <i>Email: </i><?php echo $v_email; ?>
                                            </td>
                                            <td>
                                                <i>Start: </i><?php echo $v_start; ?> <br>
                                                <i>End: </i><?php echo $v_end; ?> <br>
                                                <i>Period: </i><?php echo $v_period; ?>
                                            </td>
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
                                                    <a target=”_blank” href="../img/file/<?= $row['sc_file']; ?>">
                                                        <img height="50px" src="../img/file/pdf_image.png">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a onclick="doUpdate(<?php echo $row['sc_id']; ?>)" data-toggle="modal" data-target="#exampleModal_upload<?php echo $row['sc_id']; ?>">
                                                    <i style="cursor: pointer;" class="fa fa-pencil"></i></a>
                                            </td>
                                            <td><?php echo $v_note; ?></td>
                                            <td>
                                                <!--insert-->
                                                <a onclick="doUpdate(
                                                                    '<?php echo $row['sc_id']; ?>',
                                                                    '<?php echo $row['sc_supplier_name']; ?>',
                                                                    '<?php echo $row['sc_supplier_description']; ?>',
                                                                    '<?php echo $row['sc_tel']; ?>',
                                                                    '<?php echo $row['sc_email']; ?>',
                                                                    '<?php echo $row['sc_start']; ?>',
                                                                    '<?php echo $row['sc_end']; ?>',
                                                                    '<?php echo $row['sc_period']; ?>',
                                                                    '<?php echo $row['sc_note']; ?>'
                                                                    )" data-toggle="modal" data-target="#modalupdate" class="btn btn-primary btn-sm">
                                                    <i style="color: white;" class="fa fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a onclick="return confirm('Are you sure to delete ?');" href="supplier_contract.php?del_id=<?php echo $row['sc_id']; ?>" class="btn btn-danger btn-sm">
                                                    <i style="color:white;" class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Start Upload File -->
                                        <div class="modal fade" id="exampleModal_upload<?php echo $row['sc_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <input type="hidden" name="sc_id" value="<?php echo $row["sc_id"] ?>">
                                                            <input type="hidden" name="txt_old_img" value="<?= @$_GET['sent_img'] ?>">
                                                            <div class="row">
                                                                <duv class="col-xs-6">
                                                                    <img src="../img/file/<?= @$_GET['sc_file'] ?>" alt="">
                                                                    <div class="form-group">
                                                                        <label for="">Upload Here</label>
                                                                        <input required="" type="file" class="form-control" id="preview" name="sc_file" onchange="loadFile(event)" />
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
            function doUpdate(id, supplier_name, supplier_description, tel, email, start, end, period, sc_note) {
                $('#supplier_contract_id').val(id);
                $('#edit_supplier_name').val(supplier_name);
                $('#edit_supplier_description').val(supplier_description);
                $('#edit_tel').val(tel);
                $('#edit_email').val(email);
                $('#edit_start').val(start);
                $('#edit_end').val(end);
                $('#edit_period').val(period);
                $('#edit_sc_note').val(sc_note);
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
                $("#menu_admin").addClass("active");
                $("#supplier_contract").addClass("active");
                $("#supplier_contract").css("background-color", "##367fa9");

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