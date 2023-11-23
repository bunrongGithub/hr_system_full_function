<?php
include '../config/db_connect.php';

///////////////// Staff Status Update /////////////////////////////
if (isset($_POST['staff_job_id']) && !empty($_POST['staff_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id 
                                                LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id 
                                                WHERE employee_registration.er_id = "' . $_POST['staff_job_id'] . '"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      echo '<div class="form-group col-xs-6">
      <label>Employee Name KH:</label>
      <input type="text" class="form-control" id="txt_name_kh" name="txt_name_kh" value="' . $row["er_name_kh"] . '" readonly />
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Employee Name EN:</label>
      <input type="text" class="form-control" id="txt_name_en" name="txt_name_en" value="' . $row["er_name_en"] . '" readonly />
      </div>';
    }
  }
}
