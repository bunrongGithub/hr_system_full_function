<?php
include '../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_name = $_POST["txt_name"];
    $v_position = $_POST["txt_position"];
    $v_department = $_POST["txt_department"];
    $v_branch = $_POST["txt_branch"];
    $v_company = $_POST["txt_company"];
    $v_password = md5($_POST["txt_pwd"]);

    $sql = "INSERT INTO user 
                        ( username , password , position_id , u_department_id ,
                         u_branch_id , u_company_id ) 
                  VALUES 
                    ('$v_name' , '$v_password' '$v_position' , '$v_department' , 
                    '$v_branch' , '$v_company' )";
    $result = mysqli_query($connect, $sql);
    header('location:user.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["user_id"];
    $v_name = $_POST["edit_name"];
    $v_position = $_POST["edit_position"];
    $v_department = $_POST["edit_department"];
    $v_branch = $_POST["edit_branch"];
    $v_company = $_POST["edit_company"];

    $sql = "UPDATE user SET username = '$v_name' , position_id = $v_position , 
                            u_department_id = $v_department , u_branch_id = $v_branch , 
                            u_company_id = $v_company WHERE id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:user.php?message=update');
}


if (isset($_POST["btnpwdupdate"])) {
    $id = $_POST["user_id"];
    $v_password = md5($_POST["pwd_edit"]);

    $sql = "UPDATE user SET password = '$v_password' WHERE id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:user.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM user WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: user.php?message=delete");
}


?>
<!DOCTYPE html>
<html>

<head>
    <style>
        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-wrapper i {
            padding-right: 0.5em;
            position: absolute;
            top: 8px;
            right: 0;
        }
    </style>
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
                    User
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
                                                            <label>User Name:</label>
                                                            <input class="form-control" name="txt_name" type="text" required="required">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="txt_position" name="txt_position" required="required">
                                                                <option required="required" value="" disabled selected>Please Select Postion</option>
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
                                                            <label>Employee Name:</label>
                                                            <input class="form-control" name="txt_empName" type="text" required="required">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Sale Time:</label>
                                                            <input class="form-control" name="txt_saleTime" type="text" required="required">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Password:</label>
                                                            <div class="input-wrapper">
                                                                <input class="form-control" id="txt_pwd" name="txt_pwd" type="password" autocomplete="off" onkeyup="checkPasswordStrength();">
                                                                <i class="fa fa-eye-slash" for='txt_pwd' id="showpass"></i>
                                                            </div>
                                                            <p id="password-strength-status"></p>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Confirm Password:</label>
                                                            <div class="input-wrapper">
                                                                <input class="form-control" id="" name="txt_con_pwd" type="password" autocomplete="off" onkeyup="matchPassword();">
                                                                <i class="fa fa-eye-slash" for='txt_con_pwd' id="showconpass"></i>
                                                            </div>
                                                            <p id="match"></p>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
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
                                                        <input type="hidden" id="user_id" name="user_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>User Name:</label>
                                                            <?php /*if ($_SESSION['user_id'] = $_POST["user_id"]) {
                                                                echo '<input class="form-control" id="edit_name" name="edit_name" type="text" readonly>';
                                                            } 
                                                            else {
                                                                echo '<input class="form-control" id="edit_name" name="edit_name" type="text">';
                                                            }*/ ?>
                                                            <input class="form-control" id="edit_name" name="edit_name" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="edit_position" name="edit_position" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM position';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <!-- <input class="form-control" name="txt_position"></input> -->
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Department:</label>
                                                            <select class="form-control" id="edit_department" name="edit_department" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM department';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch:</label>
                                                            <select class="form-control" id="edit_branch" name="edit_branch" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM user_branch';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
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
                                <!-- Modal Update Password-->
                                <div class="modal fade" id="myModal_pwd" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Change Password </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="pwd_user_id" name="pwd_user_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>User Name:</label>
                                                            <input class="form-control" id="pwd_edit_name" name="pwd_edit_name" type="text" readonly>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="pwd_edit_position" name="pwd_edit_position" disabled selected>
                                                                <?php
                                                                $sql = 'SELECT * FROM position';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <!-- <input class="form-control" name="txt_position"></input> -->
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Password:</label>
                                                            <div class="input-wrapper">
                                                                <input class="form-control" id="pwd_edit" name="pwd_edit" type="password" autocomplete="off" onkeyup="edit_checkPasswordStrength();">
                                                                <i class="fa fa-eye-slash" for='pwd_edit' id="edit_showpass"></i>
                                                            </div>
                                                            <p id="edit_password-strength-status"></p>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Confirm Password:</label>
                                                            <div class="input-wrapper">
                                                                <input class="form-control" id="con_pwd_edit" name="con_pwd_edit" type="password" autocomplete="off" onkeyup="edit_matchPassword();">
                                                                <i class="fa fa-eye-slash" for='con_pwd_edit' id="edit_showconpass"></i>
                                                            </div>
                                                            <p id="edit_match"></p>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="btnpwdupdate" name="btnpwdupdate" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Update Password-->

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User Name</th>
                                                <th>Password</th>
                                                <th>Position</th>
                                                <th>Information</th>
                                                <th style="width: 110px; ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM user LEFT JOIN position on position.position_id = user.position_id 
                                                                    LEFT JOIN department on department.de_id = user.u_department_id 
                                                                    LEFT JOIN user_branch on user_branch.ub_id = user.u_branch_id
                                                                    LEFT JOIN company on company.c_id = user.u_company_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_name = $row["username"];
                                                $v_pass = $row["password"];
                                                $v_position = $row["position"];
                                                $v_department = $row["de_name"];
                                                $v_branch = $row["ub_name"];
                                                $v_company = $row["c_name_kh"];
                                                $v_datetime = $row["u_datetime"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_name; ?></td>
                                                    <td>******
                                                        <a style="float:right; cursor:pointer;" onclick="doPWD(<?php echo $row['id']; ?>,
                                                        '<?php echo $v_name; ?>',
                                                        '<?php echo $v_position; ?>')" data-toggle="modal" data-target="#myModal_pwd"><i style="color:#3c8dbc;" class="fa fa-pencil "></i></a>
                                                    </td>
                                                    <td><?php echo $v_position; ?></td>
                                                    <td>
                                                        <div>
                                                            <span style="font-style: italic;">Department: </span>
                                                            <?php echo $v_department; ?>
                                                        </div>
                                                        <div>
                                                            <span style="font-style: italic;">Branch: </span>
                                                            <?php echo $v_branch; ?>
                                                        </div>
                                                        <div>
                                                            <span style="font-style: italic;">Company: </span>
                                                            <?php echo $v_company; ?>
                                                        </div>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['id']; ?>,
                                                        '<?php echo $v_name; ?>',
                                                        '<?php echo $row['position_id'] ?>',
                                                        '<?php echo $row['u_department_id'] ?>',
                                                        '<?php echo $row['u_branch_id']; ?>',
                                                        <?php echo $row['u_company_id']; ?>)" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="user.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, username, position, department, branch, company) {
            $('#user_id').val(id);
            $('#edit_name').val(username);
            $('#edit_position').val(position).change();
            $('#edit_department').val(department).change();
            $('#edit_branch').val(branch).change();
            $('#edit_company').val(company).change();

            if (id == <?php echo $user_id; ?>) {
                document.getElementById('edit_name').setAttribute('readonly', true);
            } else {
                document.getElementById('edit_name').setAttribute('readonly', false);
            }

        }

        function doPWD(id, username, position) {
            $('#pwd_user_id').val(id);
            $('#pwd_edit_name').val(username);
            $('#pwd_edit_position').val(position).change();
        }

        $(function() {
            $("#menu_setting").addClass("active");
            $("#user").addClass("active");
            $("#user").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });

        /////////////////////////////// CHECK EDIT PASSWORD ///////////////////////////////////////////////////
        var edit_passField = document.querySelector("#pwd_edit");
        var edit_showpass = document.querySelector("#edit_showpass");
        edit_showpass.addEventListener("click", () => {
            if (edit_passField.type === "password") {
                edit_passField.type = "text";
                edit_showpass.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                edit_passField.type = "password";
                edit_showpass.classList.replace("fa-eye", "fa-eye-slash");
            }
        });

        var edit_conpassField = document.querySelector("#con_pwd_edit");
        var edit_conshowpass = document.querySelector("#edit_showconpass");
        edit_conshowpass.addEventListener("click", () => {
            if (edit_conpassField.type === "password") {
                edit_conpassField.type = "text";
                edit_conshowpass.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                edit_conpassField.type = "password";
                edit_conshowpass.classList.replace("fa-eye", "fa-eye-slash");
            }
        });

        function edit_checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            var password = $('#pwd_edit').val().trim();
            if (password.length < 6) {
                $('#edit_password-strength-status').removeClass();
                $('#edit_password-strength-status').addClass('weak-password');
                $('#edit_password-strength-status').html("Weak Password (should be at least 6 characters.)");
                $("#edit_password-strength-status").css("color", "red");
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#edit_password-strength-status').removeClass();
                    $('#edit_password-strength-status').addClass('strong-password');
                    $('#edit_password-strength-status').html("Strong Password");
                    $("#edit_password-strength-status").css("color", "green");
                } else {
                    $('#edit_password-strength-status').removeClass();
                    $('#edit_password-strength-status').addClass('medium-password');
                    $('#edit_password-strength-status').html("Medium Password (should include alphabets, numbers and special characters.)");
                    $("#edit_password-strength-status").css("color", "#fd0");
                }
            }
        }

        function edit_matchPassword() {
            var pwd = $("#pwd_edit").val();
            var con_pwd = $("#con_pwd_edit").val();
            if (pwd != con_pwd) {
                $("#edit_match").text("** Password and Confirm Password are not Matched!");
                $("#edit_match").css("color", "Red");
                document.getElementById('btnpwdupdate').disabled = true;
            } else {
                $("#edit_match").text("");
                document.getElementById('btnpwdupdate').disabled = false;
            }
        }

        /////////////////////////////// CHECK PASSWORD ///////////////////////////////////////////////////
        var passField = document.querySelector("#txt_pwd");
        var showpass = document.querySelector("#showpass");
        showpass.addEventListener("click", () => {
            if (passField.type === "password") {
                passField.type = "text";
                showpass.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passField.type = "password";
                showpass.classList.replace("fa-eye", "fa-eye-slash");
            }
        });

        var conpassField = document.querySelector("#txt_con_pwd");
        var conshowpass = document.querySelector("#showconpass");
        conshowpass.addEventListener("click", () => {
            if (conpassField.type === "password") {
                conpassField.type = "text";
                conshowpass.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                conpassField.type = "password";
                conshowpass.classList.replace("fa-eye", "fa-eye-slash");
            }
        });

        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            var password = $('#txt_pwd').val().trim();
            if (password.length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak Password (should be at least 6 characters.)");
                $("#password-strength-status").css("color", "red");
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong Password");
                    $("#password-strength-status").css("color", "green");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium Password (should include alphabets, numbers and special characters.)");
                    $("#password-strength-status").css("color", "#fd0");
                }
            }
        }

        function matchPassword() {
            var pwd = $("#txt_pwd").val();
            var con_pwd = $("#txt_con_pwd").val();
            if (pwd != con_pwd) {
                $("#match").text("** Password and Confirm Password are not Matched!");
                $("#match").css("color", "Red");
                document.getElementById('btnadd').disabled = true;
            } else {
                $("#match").text("");
                document.getElementById('btnadd').disabled = false;
            }
        }
    </script>
</body>

</html>