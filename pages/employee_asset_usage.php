<?php
   include'../config/db_connect.php';
   $user_id = $_SESSION["user_id"];
   $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
   <head>
         <meta charset="UTF-8">
         <?php include "title_icon.php"; ?>
         <meta 
            content = 'width=device-width,
            initial-scale=1,
            maximum-scale=1,
            user-scalable=no'
            name = 'viewport'
         >
         <!--bootstrap 3.0.2-->
         <link rel="stylesheet" href="../css/bootstrap.min.css" type='text/css'/>
         <!-- font Awesome -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
   </head>
      <body class = 'skin-black'>
         <?php include('header.php') ?>
         <div class="wrapper row-offcanvas row-offcanvas-left">
            <!--Include left menu-->
            <?php include "left_menu.php" ?>
            <aside class ="right-side">
               <section class="content-header">
                  <h1>Employee Asset Usage</h1>
               </section>
            </aside>
         </div>
      </body>
</html>