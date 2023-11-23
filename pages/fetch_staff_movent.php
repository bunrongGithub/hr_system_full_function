<?php 
   include '../config/db_connect.php';
   if(isset($_POST['staff_job_id']) && !empty($_POST['staff_job_id'])){
      $query = 'SELECT * FROM employee_registration
         LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id
         LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
         LEFT JOIN user_branch on user_branch.ub_id = employee_registration.er_branch_id
         LEFT JOIN department ON department.de_id = employee_registration.er_department_id
         LEFT JOIN position ON position.position_id = employee_registration.er_position_id
         WHERE employee_registration.er_id = "'.$_POST['staff_job_id'].'"';
      $result = mysqli_query($connect,$query);
      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_assoc($result)){
            echo '<div class="form-group col-xs-12">
            <label>Employee Name KH:</label>
            <input type="text" class="form-control" id="txt_name_kh" name="txt_name_kh" value="' . $row["er_name_kh"] . '" readonly />
            </div>';
            echo '<div class="form-group col-xs-12">
            <label>Employee Name EN:</label>
            <input type="text" class="form-control" id="txt_name_en" name="txt_name_en" value="' . $row["er_name_en"] . '" readonly />
            </div>';
            echo '<div class="form-group col-xs-12">
            <label>Gender:</label>
            <input type="text" class="form-control" id="txt_gender" name="txt_gender" value="' . $row["ge_name"] . '" readonly />
            </div>';
            echo '<h3><strong>Current Info.</strong></h3>';
               echo '<div class="form-group col-xs-12">
               <label>Company:</label>
               <input type="text" class="form-control" id="txt_company" name="txt_company" value="' . $row['c_name_kh'] . '"readonly/>
               </div>';
               echo '<div class="form-group col-xs-12">
               <label>Branch:</label>
               <input type="text" class="form-control" id="txt_branch" name="txt_branch" value="' . $row['ub_name'] . '"readonly/>
               </div>';
               echo '<div class="form-group col-xs-12">
               <label>Deparment:</label>
               <input type="text" class="form-control" id="txt_deparment" name="txt_deparment" value="' . $row['de_name'] . '"readonly/>
               </div>';
               echo '<div class="form-group col-xs-12">
               <label>Position:</label>
               <input type="text" class="form-control" id="txt_posiontion" name="txt_posiontion" value="' . $row['position'] . '"readonly/>
               </div>';
               echo '<div class="form-group col-xs-12">
               <label>Salary:</label>
               <input type="text" class="form-control" id="txt_salary" name="txt_salary" value="' . $row['er_salary'] .'$'. '"readonly/>
               </div>';
               echo '<div class="form-group col-xs-12">
               <label>Tax Salary:</label>
               <input type="text" class="form-control" id="txt_tax_salary" name="txt_tax_salary" value="' . $row['er_salary_tax'] .'$'. '"readonly/>
               </div>';
         }
      }
   }
?>