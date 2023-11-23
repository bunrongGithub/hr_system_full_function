<?php
include "../config/db_connect.php";
$errors = "";


// start post insert data
if(isset($_POST["btnadd"])){
    $v_pass = $_POST["txt_password"];
    $v_pass2 = $_POST["txt_password2"];

    if($v_pass==$v_pass2){
        $v_user = $_POST["txt_user"];

        $sql = "INSERT INTO user (username
                                , password
                                )
                            VALUES
                            ('$v_user'
                            ,md5('$v_pass')
                            )";
        $result = mysqli_query($connect, $sql);
        if($result){
            header('location: ../index.php?message=success');
        } 
    }else{
        $errors = "<div class = 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <h6>Your password not match, Please, Try again</h6></div>";
    }
}
// end post insert data
?>

<!DOCTYPE html>
<html class="bg-blue">

<head>
    <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <?php
    include "title_icon.php";
    ?>
    <!-- <link rel="icon" href="../img/login_logo.png" type="image/x-icon">
    <title>HR System | Registration Page</title> -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<style>
    .bg_lightgray {
        background-color: #EEEEEEEE;
    }
</style>

<body class="bg_lightgray">

    <div class="form-box" id="login-box">
        <div class="header">Register New Account</div>
        <form action="" method="post" role="form">
            <div class="body bg-gray">
            <?php
                echo  $errors;
                ?>
                <div class="form-group">
                    <input type="text" name="txt_user" class="form-control" placeholder="User" />
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password" class="form-control" placeholder="Password" />
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password2" class="form-control" placeholder="Retype password" />
                </div>
            </div>
            <div class="footer">

                <button type="submit" name="btnadd" class="btn bg-olive btn-block">Sign Up</button>

                <a href="../index.php" class="text-center">I already have an account</a>
            </div>
        </form>

        <div class="margin text-center">
            <!--
                <span>Register using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
            -->
            <br>            
            <br>            
            <br>

        </div>
    </div>


    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>