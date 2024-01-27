<!-- header logo: style can be found in header.less -->
<header class="header">
   <a href="dashboard.php" class="logo">
      <!-- Add the class icon to your logo image or logo icon to add the margining -->
      HR System
   </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </a>
      <div class="navbar-right">
         <ul class="nav navbar-nav">

            <!-- group -->
            <li class="dropdown user user-menu">

               <div style="padding-top: 7px; width: 180px;">
                  <select class="form-control select2" name="show_group" id="show_group" onchange="GotoGroup()">

                     <option value="<?php echo $row['cg_id'] ?>"> Group</option>
                     <?php

                     $v_sellect = mysqli_query($connect, "SELECT * FROM user_auth_company_group A
                                                                            LEFT JOIN company_group B ON B.cg_id=A.uacg_com_group_id
                                                                            WHERE uacg_user_id = $user_id
                                                                            ORDER BY uacg_com_group_id ASC");
                     while ($row = mysqli_fetch_assoc($v_sellect)) {
                     ?>
                        <option value="<?php echo $row['cg_id'] ?>"><?php echo $row['cg_name'] ?></option>
                     <?php
                     }
                     ?>
                  </select>
               </div>
            </li>

            <li class="dropdown user user-menu">
               <div style="padding-top: 7px; width: 10px;">
                  <div>
            </li>
            <!-- Company -->
            <li class="dropdown user user-menu">

               <div style="padding-top: 7px; width: 180px;">
                  <select class="form-control select2" name="show_company" id="show_company" onchange="GotoCompany()">
                     <option value="<?php echo $row['c_id'] ?>"> Company</option>
                     <?php

                     $v_sellect = mysqli_query($connect, "SELECT * FROM user_auth_company A
                                                                            LEFT JOIN company B ON B.c_id=A.uac_company_id
                                                                            WHERE uac_user_id = $user_id
                                                                            ORDER BY uac_company_id ASC");
                     while ($row = mysqli_fetch_assoc($v_sellect)) {
                     ?>
                        <option value="<?php echo $row['c_id'] ?>"><?php echo $row['c_name_en'] ?></option>
                     <?php
                     }
                     ?>
                  </select>
               </div>
            </li>
            <li class="dropdown user user-menu">
               <div style="padding-top: 7px; width: 10px;">
                  </div>
            </li>
            <li class="dropdown user user-menu">
               <div style="padding-top: 7px; width: 180px;">

                  <select class="form-control select2" name="show_branch" id="show_branch" onchange="GotoBranch()">
                     <option value="<?php echo $row['ub_id'] ?>"> Branch </option>
                     <?php
                     $v_sellect = mysqli_query($connect, "SELECT * FROM user_auth_branch A
                                                                            LEFT JOIN user_branch B ON B.ub_id=A.uab_branch_id
                                                                            WHERE uab_user_id = $user_id
                                                                            ORDER BY uab_branch_id ASC");
                     while ($row = mysqli_fetch_assoc($v_sellect)) {
                     ?>
                        <option value="<?php echo $row['ub_id'] ?>"> <?php echo $row['ub_name'] ?></option>
                     <?php
                     }
                     ?>
                  </select>
               </div>
            </li>
            <li class="dropdown user user-menu">
               <div style="padding-top: 7px; width: 10px;">
                  <div>
            </li>
            <li class="dropdown user user-menu">
               <div style="padding-top: 7px; width: 180px;">
                  <select class="form-control select2" name="show_department" id="show_department" onchange="GotoDepartment()">
                     <option value="<?php echo $row['de_id'] ?>"> Department </option>
                     <?php
                     $v_sellect = mysqli_query($connect, "SELECT * FROM user_auth_department A
                                                                        LEFT JOIN department B ON B.de_id=A.uad_dep_id
                                                                        ORDER BY uad_dep_id ASC");
                     while ($row = mysqli_fetch_assoc($v_sellect)) {
                     ?>
                        <option value="<?php echo $row['de_id'] ?>"> <?php echo $row['de_name'] ?></option>
                     <?php
                     }
                     ?>
                  </select>
               </div>
            </li>

            <!-- Messages: style can be found in dropdown.less-->

            <li class="dropdown messages-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-success">4</span>
               </a>
               <ul class="dropdown-menu">
                  <li class="header">You have 4 11111</li>
                  <li>
                     <!-- inner menu: contains the actual data -->
                     <ul class="menu">
                        <li><!-- start message -->
                           <a href="#">
                              <div class="pull-left">
                                 <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                              </div>
                              <h4>
                                 Support Team
                                 <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li><!-- end message -->
                        <li>
                           <a href="#">
                              <div class="pull-left">
                                 <img src="../img/avatar2.png" class="img-circle" alt="user image" />
                              </div>
                              <h4>
                                 AdminLTE Design Team
                                 <small><i class="fa fa-clock-o"></i> 2 hours</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <div class="pull-left">
                                 <img src="../img/avatar.png" class="img-circle" alt="user image" />
                              </div>
                              <h4>
                                 Developers
                                 <small><i class="fa fa-clock-o"></i> Today</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <div class="pull-left">
                                 <img src="../img/avatar2.png" class="img-circle" alt="user image" />
                              </div>
                              <h4>
                                 Sales Department
                                 <small><i class="fa fa-clock-o"></i> Yesterday</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <div class="pull-left">
                                 <img src="../img/avatar.png" class="img-circle" alt="user image" />
                              </div>
                              <h4>
                                 Reviewers
                                 <small><i class="fa fa-clock-o"></i> 2 days</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
               </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-warning"></i>
                  <span class="label label-warning">10</span>
               </a>
               <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                     <!-- inner menu: contains the actual data -->
                     <ul class="menu">
                        <li>
                           <a href="#">
                              <i class="ion ion-ios7-people info"></i> 5 new members joined today
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <i class="fa fa-users warning"></i> 5 new members joined
                           </a>
                        </li>

                        <li>
                           <a href="#">
                              <i class="ion ion-ios7-cart success"></i> 25 sales made
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <i class="ion ion-ios7-person danger"></i> You changed your username
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
               </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-tasks"></i>
                  <span class="label label-danger">9</span>
               </a>
               <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                     <!-- inner menu: contains the actual data -->
                     <ul class="menu">
                        <li><!-- Task item -->
                           <a href="#">
                              <h3>
                                 Design some buttons
                                 <small class="pull-right">20%</small>
                              </h3>
                              <div class="progress xs">
                                 <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">20% Complete</span>
                                 </div>
                              </div>
                           </a>
                        </li><!-- end task item -->
                        <li><!-- Task item -->
                           <a href="#">
                              <h3>
                                 Create a nice theme
                                 <small class="pull-right">40%</small>
                              </h3>
                              <div class="progress xs">
                                 <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">40% Complete</span>
                                 </div>
                              </div>
                           </a>
                        </li><!-- end task item -->
                        <li><!-- Task item -->
                           <a href="#">
                              <h3>
                                 Some task I need to do
                                 <small class="pull-right">60%</small>
                              </h3>
                              <div class="progress xs">
                                 <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">60% Complete</span>
                                 </div>
                              </div>
                           </a>
                        </li><!-- end task item -->
                        <li><!-- Task item -->
                           <a href="#">
                              <h3>
                                 Make beautiful transitions
                                 <small class="pull-right">80%</small>
                              </h3>
                              <div class="progress xs">
                                 <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">80% Complete</span>
                                 </div>
                              </div>
                           </a>
                        </li><!-- end task item -->
                     </ul>
                  </li>
                  <li class="footer">
                     <a href="#">View all tasks</a>
                  </li>
               </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="glyphicon glyphicon-user"></i>
                  <span><?php echo  strtoupper($username) ?> <i class="caret"></i></span>
               </a>
               <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header bg-light-blue">
                     <img src="../img/avatar5.png" class="img-circle" alt="User Image" />
                     <p>
                        Name: <?php echo ucfirst($username); ?><br>

                        <span style="text-transform: uppercase;"> webdevelopment</span>

                     </p>


                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                     <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                     </div>
                     <div class="pull-right">
                        <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
                     </div>
                  </li>
               </ul>
            </li>

         </ul>
      </div>
   </nav>
</header>
<script>
   //select send id to url
   function GotoGroup() {
      group = document.getElementById('show_group');
      if (group.value != 0) {
         window.location.href = 'dashboard.php?group=' + group.value;
      }
   }

   function GotoCompany() {
      company = document.getElementById('show_company');
      if (company.value != 0) {
         window.location.href = 'dashboard.php?company=' + company.value;
      }
   }

   function GotoBranch() {
      branch = document.getElementById('show_branch');
      if (branch.value != 0) {
         window.location.href = 'dashboard.php?branch=' + branch.value;
      }
   }

   function GotoDepartment() {
      department = document.getElementById('show_department');
      if (department.value != 0) {
         window.location.href = 'dashboard.php?department=' + department.value;
      }
   }
</script>