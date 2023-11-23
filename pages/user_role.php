<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$today = date('Y-m-d');

if (isset($_POST["btnadd"])) {
    $txt_menu_id = $_POST["txt_menu_id"];
    $txt_username = $_POST["txt_username"];
    $txt_create = $_POST["txt_create"];
    $txt_view = $_POST["txt_view"];
    $txt_update = $_POST["txt_update"];
    $txt_delete = $_POST["txt_delete"];
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO user_role 
                        (
                            ur_menu_id, 
                            ur_user_id, 
                            ur_is_create, 
                            ur_is_read, 
                            ur_is_update, 
                            ur_is_delete, 
                            created_at 
                        ) 
                  VALUES 
                        (
                            '$txt_menu_id', 
                            '$txt_username', 
                            '$txt_create', 
                            '$txt_view', 
                            '$txt_update', 
                            '$txt_delete', 
                            '$datetime'
                        )";
    $result = mysqli_query($connect, $sql);
    header('location:user_role.php?message=success');
    exit();
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["user_role_id"];
    $v_menu_id = $_POST["edit_menu_id"];
    $v_username = $_POST["edit_username"];
    $v_create = $_POST["edit_create"];
    $v_view = $_POST["edit_view"];
    $v_update = $_POST["edit_update"];
    $v_delete = $_POST["edit_delete"];

    $sql = "UPDATE user_role SET ur_menu_id = '$v_menu_id', 
                                ur_user_id = '$v_username', 
                                ur_is_create = '$v_create', 
                                ur_is_read = '$v_view', 
                                ur_is_update = '$v_update', 
                                ur_is_delete = '$v_delete' WHERE ur_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:user_role.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM user_role WHERE ur_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: user_role.php?message=delete");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
                <h1 class="text-primary">
                    User Role
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="row">

                    <div class="col-xs-12 connectedSortable">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
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
                                                                <div class="form-group col-xs-6">
                                                                    <label for="ot-type">Menu:</label>
                                                                    <select class="form-control select2" name="txt_menu_id" id="">
                                                                        <option value="">===Select===</option>
                                                                        <?php
                                                                        $v_sellect = mysqli_query($connect, "SELECT * FROM menu_left ORDER BY ml_name ASC");
                                                                        while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['ml_id'] ?>"><?php echo $row['ml_name'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label>Username:</label>
                                                                    <select class="form-control" id="" name="txt_username" required="required">
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
                                                                <div class="form-group col-xs-6">
                                                                    <label>Create:</label>
                                                                    <select class="form-control" id="" name="txt_create" required="required">
                                                                        <option value="">===Select===</option>
                                                                        <?php
                                                                        $v_sellect = mysqli_query($connect, "SELECT * FROM text_yes_no ORDER BY yn_name ASC");
                                                                        while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['yn_id'] ?>"><?php echo $row['yn_name'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label>View:</label>
                                                                    <select class="form-control" id="" name="txt_view" required="required">
                                                                        <option value="">===Select===</option>
                                                                        <?php
                                                                        $v_sellect = mysqli_query($connect, "SELECT * FROM text_yes_no ORDER BY yn_name ASC");
                                                                        while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['yn_id'] ?>"><?php echo $row['yn_name'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label>Update:</label>
                                                                    <select class="form-control" id="" name="txt_update" required="required">
                                                                        <option value="">===Select===</option>
                                                                        <?php
                                                                        $v_sellect = mysqli_query($connect, "SELECT * FROM text_yes_no ORDER BY yn_name ASC");
                                                                        while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['yn_id'] ?>"><?php echo $row['yn_name'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label>Delete:</label>
                                                                    <select class="form-control" id="" name="txt_delete" required="required">
                                                                        <option value="">===Select===</option>
                                                                        <?php
                                                                        $v_sellect = mysqli_query($connect, "SELECT * FROM text_yes_no ORDER BY yn_name ASC");
                                                                        while ($row = mysqli_fetch_assoc($v_sellect)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['yn_id'] ?>"><?php echo $row['yn_name'] ?></option>
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
                                                        <input type="hidden" id="user_role_id" name="user_role_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Menu:</label>
                                                            <select class="form-control" id="edit_menu_id" name="edit_menu_id" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM menu_left';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ml_id'] . '">' . $row['ml_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Username:</label>
                                                            <select class="form-control" id="edit_username" name="edit_username" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM user';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Create:</label>
                                                            <select class="form-control" id="edit_create" name="edit_create" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_yes_no';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['yn_id'] . '">' . $row['yn_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>View:</label>
                                                            <select class="form-control" id="edit_view" name="edit_view" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_yes_no';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['yn_id'] . '">' . $row['yn_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Update:</label>
                                                            <select class="form-control" id="edit_update" name="edit_update" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_yes_no';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['yn_id'] . '">' . $row['yn_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Delete:</label>
                                                            <select class="form-control" id="edit_delete" name="edit_delete" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_yes_no';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['yn_id'] . '">' . $row['yn_name'] . '</option>';
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

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Menu</th>
                                                <th>Username</th>
                                                <th>Create</th>
                                                <th>View</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM user_role AS A
                                                            LEFT JOIN user AS B ON B.id=A.ur_user_id
                                                            LEFT JOIN menu_left AS C ON C.ml_id=A.ur_menu_id
                                                            ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_menu_id = $row["ml_name"];
                                                $v_user_id = $row["username"];
                                                $v_is_create = $row["ur_is_create"];
                                                $v_is_read = $row["ur_is_read"];
                                                $v_is_update = $row["ur_is_update"];
                                                $v_is_delete = $row["ur_is_delete"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_menu_id; ?></td>
                                                    <td><?php echo $v_user_id; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($v_is_create == 0) {
                                                            echo "No";
                                                        } else {
                                                            echo "Yes";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($v_is_read == 0) {
                                                            echo "No";
                                                        } else {
                                                            echo "Yes";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($v_is_update == 0) {
                                                            echo "No";
                                                        } else {
                                                            echo "Yes";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($v_is_delete == 0) {
                                                            echo "No";
                                                        } else {
                                                            echo "Yes";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <a onclick="doUpdate(<?php echo $row['ur_id']; ?>,
                                                        '<?php echo $row['ur_menu_id']; ?>',
                                                        '<?php echo $row['ur_user_id']; ?>',
                                                        '<?php echo $row['ur_is_create']; ?>',
                                                        '<?php echo $row['ur_is_read']; ?>',
                                                        '<?php echo $row['ur_is_update']; ?>',
                                                        '<?php echo $row['ur_is_delete']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="user_role.php?del_id=<?php echo $row['ur_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(ur_id, ur_menu_id, ur_user_id, ur_is_create, ur_is_read, ur_is_update, ur_is_delete) {
            $('#user_role_id').val(ur_id);
            $('#edit_menu_id').val(ur_menu_id).change();
            $('#edit_username').val(ur_user_id);
            $('#edit_create').val(ur_is_create);
            $('#edit_view').val(ur_is_read);
            $('#edit_update').val(ur_is_update);
            $('#edit_delete').val(ur_is_delete);
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#pension").addClass("active");
            $("#pension").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>