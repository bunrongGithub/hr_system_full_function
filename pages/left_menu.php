<!-- Left side column. contains the logo and sidebar -->

<?php 

$sql = "select * from users"

?>



<aside class="left-side sidebar-offcanvas">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
         <div class="pull-left image">
            <img src="../img/avatar5.png" class="img-circle" alt="User Image" />
         </div>
         <div class="pull-left info">
            <p>Hello, <span><?php echo strtoupper($username) ?></p></span>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
         <li id="menu_home">
            <a href="dashboard.php">
               <i class="fa fa-dashboard"></i> <span>Home</span>
            </a>
         </li>
         <li id="info_center">
            <a href="./info_center.php">
               <i class="fa fa-info-circle"></i> <span>Information Center</span>
               <!--<small class="badge pull-right bg-green">new</small>-->
            </a>
         </li>
         <li id="menu_task_manager" class="treeview">
            <a href="#">
               <i class="fa fa-user-circle-o"></i>
               <span>Task Management</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="company_task"><a href="company_task.php"><i class="fa fa-exchange"></i> Company Task</a></li>
               <li id="branch_task"><a href="branch_task.php"><i class="fa fa-exchange"></i> Branch Task</a></li>
               <li id="depart_task"><a href="department_task.php"><i class="fa fa-exchange"></i> Department Task</a></li>
               <li id="person_task"><a href="personal_task.php"><i class="fa fa-exchange"></i> Personal Task</a></li>
               <li id="working_report"><a href="working_report.php"><i class="fa fa-exchange"></i> Working Report</a></li>
            </ul>
         </li>
         <li id="menu_admin" class="treeview">
            <a href="#">
               <i class="fa fa-check-square-o"></i>
               <span>Admin Management</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="e_from"><a href="e_form.php"><i class="fa fa-arrow-right"></i> E-Form</a></li>
               <li id="asset_re"><a href="asset_requisition.php"><i class="fa fa-arrow-right"></i> Asset Requisition</a></li>
               <li id="stationary"><a href="stationary_requisition.php"><i class="fa fa-arrow-right"></i> Stationary Requisition</a></li>

               <li id="supplier_contract"><a href="./supplier_contract.php"><i class="fa fa-arrow-right"></i> Supplier Contract</a></li>
               <li id="company_governance"><a href="./company_governance.php"><i class="fa fa-arrow-right"></i>Company Governance</a></li>
               <li id="message_to_user"><a href="./message_to_user.php"><i class="fa fa-arrow-right"></i> Message To User</a></li>
            </ul>
         </li>
         <li id="menu_admin_manage" class="treeview">
            <a href="#">
               <i class="fa fa-balance-scale"></i>
               <span> Asset Management</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="asset_in"><a href="admin_asset_in.php"><i class="fa fa-hand-o-right"></i> Asset In</a></li>
               <li id="asset_transfer"><a href="admin_asset_transfer.php"><i class="fa fa-hand-o-right"></i> Asset Transfer</a></li>
               <li id="asset_broken"><a href="admin_asset_broken.php"><i class="fa fa-hand-o-right"></i> Asset Broken</a></li>
               <li id="asset_replace"><a href="admin_asset_replace.php"><i class="fa fa-hand-o-right"></i> Asset Replacement</a></li>
               <li id="asset_mainten"><a href="admin_asset_maintenance.php"><i class="fa fa-hand-o-right"></i> Asset Maintenance</a></li>
               <li id="asset_receive"><a href="admin_asset_receive.php"><i class="fa fa-hand-o-right"></i> Asset Receive Transfer</a></li>
               <li id="asset_depre"><a href="admin_asset_depreciation.php"><i class="fa fa-hand-o-right"></i> Asset Depreciation</a></li>
               <li id="asset_usage"><a href="admin_asset_usage.php"><i class="fa fa-hand-o-right"></i> Employee Asset Usage</a></li>
               <li id="asset_balance"><a href="admin_asset_balance.php"><i class="fa fa-print"></i> Asset Balance</a></li>
            </ul>
         </li>
         <li id="menu_stationary_manage" class="treeview">
            <a href="#">
               <i class="fa fa-folder-open"></i>
               <span>Stationary Management</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="station_in"><a href="admin_stationary_in.php"><i class="fa fa-caret-square-o-right"></i> Stationary In</a></li>
               <li id="station_transfer"><a href="admin_stationary_transfer.php"><i class="fa fa-caret-square-o-right"></i> Stationary Transfer</a></li>
               <li id="station_usage"><a href="admin_stationary_usage.php"><i class="fa fa-caret-square-o-right"></i> Stationary Usage (Out)</a></li>
               <li id="station_receive"><a href="admin_stationary_receive.php"><i class="fa fa-caret-square-o-right"></i> Stationary Receive Transfer</a></li>
               <li id="station_balance"><a href=""><i class="fa fa-print"></i> Stationary Balance</a></li>
            </ul>
         </li>
         <li id="menu_staff" class="treeview">
            <a href="#">
               <i class="fa fa-user"></i>
               <span>Staff Movement</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="staff_move"><a href="staff_movement.php"><i class="fa fa-arrow-right"></i> Staff Movement</a></li>
               <li id="request_salary"><a href="staff_request_up_salary.php"><i class="fa fa-arrow-right"></i> Request Up Salary</a></li>
               <li id="request_position"><a href="staff_request_new_position.php"><i class="fa fa-arrow-right"></i> Request New Position</a></li>
               <li id="resign"><a href="staff_resign.php"><i class="fa fa-arrow-right"></i> Resign</a></li>
               <li id="termination"><a href="staff_termination.php"><i class="fa fa-arrow-right"></i> Termination</a></li>
               <li id="job_hang_out"><a href="staff_job_hangout.php"><i class="fa fa-arrow-right"></i> Job Hang Out</a></li>
               <li id="mission"><a href="staff_mission.php"><i class="fa fa-arrow-right"></i> Mission</a></li>
               <li id="warning"><a href="staff_warning.php"><i class="fa fa-arrow-right"></i> Warning</a></li>
            </ul>
         </li>
         <li id="menu_staff_update" class="treeview">
            <a href="#">
               <i class="fa fa-user-plus"></i>
               <span>Staff Update</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="staff_update"><a href="staff_status_update.php"><i class="fa fa-user-plus"></i> Staff Update History</a></li>
               <li id="staff_doc"><a href="staff_documents.php"><i class="fa fa-file-text"></i> Staff Document</a></li>
               <li id="training"><a href="staff_training.php"><i class="fa fa-graduation-cap"></i> Training</a></li>
               <li id="evaluation"><a href="staff_evaluate.php"><i class="fa fa-calendar-check-o"></i> Evaluation</a></li>
               <li id="registration"><a href="staff_registration.php"><i class="fa fa-arrow-right"></i> Register & Update</a></li>
               <li id="salary_con"><a href="salary_confirm_letter.php"><i class="fa fa-print"></i> Salary Confirmation Letter</a></li>
               <li id="recomm_letter"><a href="recommen_letter.php"><i class="fa fa-print"></i> Recommendation Letter</a></li>
            </ul>
         </li>
         <li id="menu_attendance" class="treeview">
            <a href="#">
               <i class="fa fa-group"></i> <span>Attendance Management</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="roster"><a href="roster.php"><i class="fa fa-check"></i> Roster Creation</a></li>
               <li id="dayoff"><a href="dayoff_request.php"><i class="fa fa-check"></i> Dayoff Change Request</a></li>
               <li id="ot_request"><a href="ot_request.php"><i class="fa fa-check"></i> OT Request</a></li>
               <li id="leave_request"><a href="staff_leave_request.php"><i class="fa fa-check"></i> Leave Request</a></li>
               <li id="atten_entry"><a href="attendance_entry.php"><i class="fa fa-check"></i> Attendance Entry</a></li>
            </ul>
         </li>
         <li id="menu_job" class="treeview">
            <a href="#"><i class="fa fa-shopping-bag"></i> <span>Job & Recruiting</span>
               <i class="fa fa-angle-left pull-right"></i>
               <!--<small class="badge pull-right bg-red">3</small>-->
            </a>
            <ul class="treeview-menu">
               <li id="recruiting"><a href="recruiting.php"><i class="fa fa-user-circle-o"></i> Recruiting</a></li>
               <li id="interview"><a href="interview.php"><i class="fa fa-user-secret"></i> Interview</a></li>
               <li id="selection"><a href="selection.php"><i class="fa fa-users"></i> Selection</a></li>
            </ul>
         </li>
         <li id="menu_pc_manage" class="treeview">
            <a href="#">
               <i class="fa fa-money"></i> <span>Petty Cash Management</span>
               <i class="fa fa-angle-left pull-right"></i>
               <!--<small class="badge pull-right bg-yellow">12</small>-->
            </a>
            <ul class="treeview-menu">
               <li id="pc_create"><a href="./create_petty_cash.php"><i class="fa fa-check"></i> Create Petty Cash</a></li>
               <li id="pc_request"><a href="./petty_cash_request.php"><i class="fa fa-check"></i> Petty Cash Request</a></li>
               <li id="pc_in"><a href="./add_petty_cash_in.php"><i class="fa fa-check"></i> Add Petty Cash In</a></li>
               <li id="pc_add_expense"><a href="./add_petty_cash_expense.php"><i class="fa fa-check"></i> Add Petty Cash Expense</a></li>
               <li id="pc_transfer_in_branch"><a href="./petty_cash_transfer_in_branch.php"><i class="fa fa-check"></i>Petty Cash Transfer in Branch</a></li>
               <li id="pc_transfer_to_branch"><a href="./petty_cash_transfer_to_branch.php"><i class="fa fa-check"></i>Petty Cash Transfer to Branch</a></li>
               <li id="pc_report"><a href="./petty_cash_report.php"><i class="fa fa-check"></i>Petty Cash Report</a></li>
            </ul>
         </li>
         <li id="menu_salary" class="treeview">
            <a href="#">
               <i class="fa fa-usd"></i> <span>Salary & Payroll</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="pay_ot"><a href="pay_ot.php"><i class="fa fa-arrow-right"></i> Pay OT</a></li>
               <li id="pay_nssf"><a href="pay_nssf.php"><i class="fa fa-arrow-right"></i> Pay NSSF</a></li>
               <li id="pay_pension"><a href="pay_pension.php"><i class="fa fa-arrow-right"></i> Pay Pension</a></li>
               <li id="staff_loan"><a href="employee_loan_payment.php"><i class="fa fa-arrow-right"></i> Employee Loan Payment</a></li>
               <li id="pay_commission"><a href="pay_commission.php"><i class="fa fa-arrow-right"></i> Pay Commission</a></li>
               <li id="pay_benefit"><a href="pay_benefit.php"><i class="fa fa-arrow-right"></i> Pay Benefit</a></li>
               <li id="pay_seniority"><a href="pay_seniority.php"><i class="fa fa-arrow-right"></i> Pay Seniority</a></li>
               <li id="pay_roll"><a href="payroll.php"><i class="fa fa-arrow-right"></i> Pay Roll</a></li>
               <li id="salary_payment"><a href="pages/examples/invoice.html"><i class="fa fa-arrow-right"></i> Salary Payment</a></li>
               <li id="salary_pay_slip"><a href="./salary_pay_slip.php"><i class="fa fa-arrow-right"></i> Salary Pay Slip</a></li>
            </ul>
         </li>
         <li id="menu_loan" class="treeview">
            <a href="#">
               <i class="fa fa-credit-card"></i> <span>Employee Loan</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="loan_request"><a href="loan_request.php"><i class="fa fa-arrow-right"></i> Loan Request</a></li>
               <li id="loan_payment_schedule"><a href="loan_payment_schedule.php"><i class="fa fa-arrow-right"></i> Loan Payment Schedule</a></li>
               <li id="loan_balance"><a href="./employee_loan_balance.php"><i class="fa fa-arrow-right"></i> Employee Loan Balance
                  </a></li>
            </ul>
         </li>
         <li id="menu_payment" class="treeview">
            <a href="#">
               <i class="fa fa-cc-paypal"></i> <span>Payment</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="payment"><a href="payment.php"><i class="fa fa-arrow-right"></i>New Payment</a></li>
               <li id="payment_history"><a href="payment_history.php"><i class="fa fa-arrow-right"></i>Payment History</a></li>
               <li id=""><a href=""><i class="fa fa-arrow-right"></i>Your Accurate AP</a></li>
               <li id=""><a href=""><i class="fa fa-arrow-right"></i>Key Summary of Contract</a></li>
            </ul>
         </li>
         <li id="menu_report" class="treeview">
            <a href="#">
               <i class="fa fa-file"></i> <span>Report</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="employee_profile"><a href="./report_employee_profile.php"><i class="fa fa-arrow-right"></i> Employee Profile</a></li>
               <li id=""><a href="report_attendance.php"><i class="fa fa-arrow-right"></i> Report Attendance</a></li>
               <li id="re_salary"><a href=report_salary.php"><i class="fa fa-arrow-right"></i> Report Salary</a></li>
            </ul>
         </li>
         <li id="menu_setting" class="treeview">
            <a href="#">
               <i class="fa fa-gear"></i> <span>Setting</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="user"><a href="user.php"><i class="fa fa-arrow-right"></i> User</a></li>
               <li id="user_role"><a href="user_role.php"><i class="fa fa-arrow-right"></i> User Role</a></li>
               <li id="company"><a href="company.php"><i class="fa fa-arrow-right"></i> Company</a></li>
               <li id="g_company"><a href="group_company.php"><i class="fa fa-arrow-right"></i> Company Group</a></li>
               <li id="branch"><a href="branch.php"><i class="fa fa-arrow-right"></i> Branch</a></li>
               <li id="department"><a href="department.php"><i class="fa fa-arrow-right"></i> Department</a></li>
               <li id="position"><a href="position.php"><i class="fa fa-arrow-right"></i> Position</a></li>
               <li id="tax"><a href="tax_on_salary.php"><i class="fa fa-arrow-right"></i> Tax On Salary</a></li>
               <li id="set_benefit"><a href="set_benefit.php"><i class="fa fa-arrow-right"></i> Set Benefit</a></li>
               <li id="set_commission"><a href="set_commission.php"><i class="fa fa-arrow-right"></i> Commission</a></li>
               <li id="overtime"><a href="overtime.php"><i class="fa fa-arrow-right"></i> Overtime</a></li>
               <li id="leave"><a href="set_leave.php"><i class="fa fa-arrow-right"></i> Leave</a></li>
               <li id="seniority"><a href="seniority.php"><i class="fa fa-arrow-right"></i> Seniority</a></li>
               <li id="nssf"><a href="set_nssf.php"><i class="fa fa-arrow-right"></i> NSSF</a></li>
               <li id="pension"><a href="pension.php"><i class="fa fa-arrow-right"></i> Pension</a></li>
               <li id="job_card"><a href="job_card_id.php"><i class="fa fa-arrow-right"></i> Job ID Card</a></li>
               <li id="name_card"><a href="name_card.php"><i class="fa fa-arrow-right"></i> Name Card</a></li>
               <li id="s_s"><a href="sign_stamp.php"><i class="fa fa-arrow-right"></i> Signature & Stamp</a></li>
               <li id="asset_code"><a href="asset_code_creation.php"><i class="fa fa-arrow-right"></i> Asset Code Creation</a></li>
               <li id="stationary_code"><a href="stationary_code_creation.php"><i class="fa fa-arrow-right"></i> Stationary Code Creation</a></li>
               <li id="status_working_report"><a href="status_working_report.php"><i class="fa fa-arrow-right"></i>Status Working Report</a></li>
               <li id="status_movement"><a href="status_staff_movement.php"><i class="fa fa-arrow-right"></i>Status Staff Movement</a></li>
               <li id="status_up_salary"><a href="status_staff_request_up_salary.php"><i class="fa fa-arrow-right"></i>Status Request Up Salary</a></li>
               <li id="status_new_pos"><a href="status_request_new_position.php"><i class="fa fa-arrow-right"></i>Status Request New Position</a></li>
               <li id="status_terminate"><a href="status_staff_termination.php"><i class="fa fa-arrow-right"></i>Status Staff Termination</a></li>
               <li id="status_warning"><a href="status_warning.php"><i class="fa fa-arrow-right"></i>Status Warning</a></li>
               <li id="uom"><a href="./uom.php"><i class="fa fa-arrow-right"></i>Unit of Measure</a></li>

               <li id="about"><a href="about.php"><i class="fa fa-power-off"></i> About System</a></li>
            </ul>
         </li>
         <li>
            <a href="signout.php">
               <i class="fa fa-power-off"></i> <span>Logout</span>
               <!--<small class="badge pull-right bg-yellow">12</small>-->
            </a>
         </li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>