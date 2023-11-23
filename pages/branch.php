<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


if (isset($_POST["btnadd"])) {
    $v_code = $_POST["txt_code"];
    $v_name = $_POST["txt_name"];
    $v_tel = $_POST["txt_tel"];
    $v_company = $_POST["txt_company"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO user_branch 
                        (ub_code 
                        , ub_name 
                        , ub_tel
                        , ub_company_id 
                        , ub_note
                        ) 
                  VALUES 
                    ('$v_code'
                    , '$v_name'
                    , '$v_tel'
                    , '$v_company'
                    , '$v_note'
                    )";
    $result = mysqli_query($connect, $sql);
    header('location:branch.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $updateid = $_POST["brand_id"];
    $v_code = $_POST["edit_code"];
    $v_name = $_POST["edit_name"];
    $v_tel = $_POST["edit_tel"];
    $v_company = $_POST["edit_company"];
    $v_note = $_POST["edit_note"];

    $sql = "UPDATE user_branch set 
                        ub_code = '$v_code'
                        , ub_name = '$v_name'
                        , ub_tel = '$v_tel'
                        , ub_company_id = '$v_company'
                        , ub_note = '$v_note' 
                  WHERE 
                    ub_id = '$updateid' ";
    $result = mysqli_query($connect, $sql);
    header('location:branch.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM user_branch WHERE ub_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: branch.php?message=delete");
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
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                <h1>
                    Branch
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="row">
                    <div class="col-xs-12 connectedSortable">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
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
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Code:</label>
                                                            <input class="form-control" id="txt_code" name="txt_code" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Name:</label>
                                                            <input class="form-control" name="txt_name" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Tel:</label>
                                                            <input class="form-control" name="txt_tel" type="text" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Company:</label>
                                                            <select class="form-control" id="txt_company" name="txt_company" required="required">
                                                            <option required="required" value="" disabled selected>Please Select Company</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="note">Note:</label>
                                                            <textarea class="form-control" rows="2" name="txt_note"></textarea>
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
                                                <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Update Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="brand_id" name="brand_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Code:</label>
                                                            <input class="form-control" id="edit_code" name="edit_code" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Name:</label>
                                                            <input class="form-control" id="edit_name" name="edit_name" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Tel:</label>
                                                            <input class="form-control" id="edit_tel" name="edit_tel" type="text" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Company:</label>
                                                            <select class="form-control" id="edit_company" name="edit_company" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="note">Note:</label>
                                                            <textarea class="form-control" rows="2" id="edit_note" name="edit_note"></textarea>
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
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Branch Code</th>
                                                <th scope="col">Branch</th>
                                                <th scope="col">Telephone</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Noted</th>
                                                <th scope="col" style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM user_branch LEFT JOIN company ON company.c_id = ub_company_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_code = $row["ub_code"];
                                                $v_name = $row["ub_name"];
                                                $v_tel = $row["ub_tel"];
                                                $v_comp_id = $row["c_name_kh"];
                                                $v_note = $row["ub_note"];
                                            ?>
                                                <tr>
                                                    <td scope="row"><?php echo $v_i; ?></td>
                                                    <td scope="row"><?php echo $v_code; ?></td>
                                                    <td scope="row"><?php echo $v_name; ?></td>
                                                    <td scope="row"><?php echo $v_tel; ?></td>
                                                    <td scope="row"><?php echo $v_comp_id; ?></td>
                                                    <td scope="row"><?php echo $v_note; ?></td>
                                                    <td scope="row">
                                                        <!-- <a href="edit_branch.php?id=<?php echo $row['ub_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['ub_id']; ?>,
                                                        '<?php echo $v_code; ?>',
                                                        '<?php echo $v_name; ?>',
                                                        '<?php echo $v_tel; ?>',
                                                        '<?php echo $row['ub_company_id']; ?>',
                                                        '<?php echo $v_note; ?>')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_update" aria-hidden="true"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="branch.php?del_id=<?php echo $row['ub_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- add new calendar event modal -->


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
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


    <script type="text/javascript">
        function doUpdate(id, code, branch_name, tel, company_id, note) {
            $('#brand_id').val(id);
            $('#edit_code').val(code);
            $('#edit_name').val(branch_name);
            $('#edit_tel').val(tel);
            $('#edit_company').val(company_id).change();
            $('#edit_note').val(note);
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#branch").addClass("active");
            $("#branch").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>