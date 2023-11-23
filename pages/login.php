<?php
include '../config/db_connect.php';
$errors = "";
if (!empty($_POST)) {
    $v_username = $_POST['txt_username'];
    $v_password = md5($_POST['txt_password']);

    if (empty($v_username) == true or empty($v_password) == true) {
        $errors = "<div class = 'alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <h6>No Input User/ Password</h6></div>";
    } else {
        // if username exists
        $sql = "SELECT * FROM user WHERE username = '$v_username'";
        $query = $connect->query($sql);
        if ($query->num_rows > 0) {
            // check username and password
            // $password = md5($password);
            $v_password_get = $v_password;
            $sql = "SELECT * FROM user WHERE username = '$v_username' and 
            password = '$v_password_get' ";
            $query = $connect->query($sql);
            $result = $query->fetch_array();
            $connect->close();

            if ($query->num_rows > 0) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];

                header("location: dashboard.php");
                exit();
            } else {
                $errors = "<div class = 'alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <h6>Incorrect PASSWORD</h6></div>";
            }
        } else {
            $errors = "<div class = 'alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <h6>Incorrect USERNAME</h6></div>";
        }
    }
    header('location:dashboard.php');
    exit();
}

?>
<!DOCTYPE html>
<html class="bg-blue">

<head>
    <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" href="../img/login_logo.png" type="image/x-icon">
    <title>HR System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />


</head>
<div class = "col-xs-12">
                    <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
<body class="bg-white">


    <div class="form-box" id="login-box">
        <div class="header">
            <img src="../img/login_logo.png" width="120px" />

        </div>
        <Form class="form-horizontal" action="login.php" method="post" data-toggle="validator" role="form">
            <div class="body bg-gray">
                <?php
                echo  $errors;
                ?>
                <div class="form-group">
                    <input type="text" name="txt_username" class="form-control" placeholder="User" />
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password" class="form-control" placeholder="Password" />
                </div>
            </div>

            <div class="footer">
               <button type="submit" class="btn bg-olive btn-block">Sign In</button>
            </div>
            <div>
            Ready have account? <a href="pages/register.php">Register Here</a>
            </div>
            <br>
            <br>
            <br>
            
        </Form>
        

    </div>



    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>