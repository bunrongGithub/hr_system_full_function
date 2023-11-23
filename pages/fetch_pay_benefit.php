<?php
include '../config/db_connect.php';
if (isset($_POST['pay_benefit_job_id']) && !empty($_POST['pay_benefit_job_id'])) {
    $query = 'SELECT * FROM employee_registration
        LEFT JOIN gender on gender.ge_id=employee_registration.er_gender_id
        LEFT JOIN position on position.position_id=employee_registration.er_position_id
        LEFT JOIN user_branch on user_branch.ub_id=employee_registration.er_branch_id
        LEFT JOIN department on department.de_id=employee_registration.er_department_id
        LEFT JOIN company on company.c_id=employee_registration.er_company_id
        WHERE employee_registration.er_id = "'. $_POST['pay_benefit_job_id'] .'"';
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo'<div class="form-group col-xs-12">
            <label>Employee Name KH:</label>
            <input type="text" class="form-control" id="txt_name_kh" name="txt_name_kh" value="' . $row["er_name_kh"] . '" readonly />
            </div>';
            echo'<div class="form-group col-xs-12">
            <label>Gender:</label>
            <input type="text" class="form-control" id="txt_ge_name" name="txt_ge_name" value="' . $row["ge_name"] . '" readonly />
            </div>';
            echo'<div class="form-group col-xs-12">
            <label>Position:</label>
            <input type="text" class="form-control" id="txt_position" name="txt_position" value="' . $row["position"] . '" readonly />
            </div>';
            echo'<div class="form-group col-xs-12">
            <label>Branch:</label>
            <input type="text" class="form-control" id="txt_ub_name" name="txt_ub_name" value="' . $row["ub_name"] . '" readonly />
            </div>';
            echo'<div class="form-group col-xs-12">
            <label>Department:</label>
            <input type="text" class="form-control" id="txt_de_name" name="txt_de_name" value="' . $row["de_name"] . '" readonly />
            </div>';
            echo'<div class="form-group col-xs-12">
            <label>Company:</label>
            <input type="text" class="form-control" id="txt_c_name_kh" name="txt_c_name_kh" value="' . $row["c_name_kh"] . '" readonly />
            </div>';
        }
    }
}
?>
