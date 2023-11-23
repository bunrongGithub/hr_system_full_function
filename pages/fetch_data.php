<?php
include '../config/db_connect.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
  $query = 'SELECT * FROM pettycash_request 
  -- LEFT JOIN company on company.c_id = pettycash_request.pc_company_id 
  --                                           LEFT JOIN user_branch on user_branch.ub_id = pettycash_request.pc_branch_id 
  --                                           LEFT JOIN department on department.de_id = pettycash_request.pc_department_id 
                                            WHERE pc_id = ' . $_POST['id'];
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Amount USD:</label>
      <div class="input-group ">
        <div class="input-group-addon">$</div>
      <input class="form-control" id="txt_amount_usd" name="txt_amount_usd" type="number" step="0.01" value =' . $row['pc_amount_usd'] . ' step="0.1" required>
        </div>
      </div>';

      echo '<div class="form-group col-xs-6">
          <label>Amount KHR:</label>
          <div class="input-group ">
            <div class="input-group-addon">៛</div>
          <input class="form-control" id="txt_amount_khr" name="txt_amount_khr" type="number" value =' . $row['pc_amount_khr'] . ' step="100" required>
        </div>
      </div>';

      echo '<div class="form-group col-xs-6">
          <label>Company Name:</label>
          <select class="form-control" id="txt_company" name="txt_company">';
      $sqls = 'SELECT * FROM company';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['c_id'] . '"';
        if ($rows['c_id'] == $row['pc_company_id']) {
          echo 'selected>' . $rows['c_name_kh'] . '</option>';
        } else {
          echo '>' . $rows['c_name_kh'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
          <label>Branch Name:</label>
             <select class="form-control" id="txt_branch" name="txt_branch">
             ';
      $sqls = 'SELECT * FROM user_branch';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['ub_id'] . '"';
        if ($rows['ub_id'] == $row['pc_branch_id']) {
          echo 'selected>' . $rows['ub_name'] . '</option>';
        } else {
          echo '>' . $rows['ub_name'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
           <label>Department Name:</label>
           <select class="form-control" id="txt_department" name="txt_department">';
      $sqls = 'SELECT * FROM department';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['de_id'] . '"';
        if ($rows['de_id'] == $row['pc_department_id']) {
          echo 'selected>' . $rows['de_name'] . '</option>';
        } else {
          echo '>' . $rows['de_name'] . '</option>';
        }
      }
      echo '</select>
      </div>
      ';
    }
  }
}

/////////////////OT Request/////////////////////////////
if (isset($_POST['ot_request_job_id']) && !empty($_POST['ot_request_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id
                                            LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id
                                             WHERE employee_registration.er_job_id = "' . $_POST['ot_request_job_id'].'"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Employee Name:</label>
      <select class="form-control" id="txt_emp_id" name="txt_emp_id" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM employee_registration';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['er_id'] . '"';
        if ($rows['er_id'] == $row['er_id']) {
          echo 'selected>' . $rows['er_name_kh'] . '</option>';
        } else {
          echo '>' . $rows['er_name_kh'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Gender:</label>
      <select class="form-control" id="txt_otr_gender" name="txt_otr_gender" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM gender';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['ge_id'] . '"';
        if ($rows['ge_id'] == $row['er_gender_id']) {
          echo 'selected>' . $rows['ge_name'] . '</option>';
        } else {
          echo '>' . $rows['ge_name'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Position:</label>
      <select class="form-control" id="txt_position" name="txt_position" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM position';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['position_id'] . '"';
        if ($rows['position_id'] == $row['er_position_id']) {
          echo 'selected>' . $rows['position'] . '</option>';
        } else {
          echo '>' . $rows['position'] . '</option>';
        }
      }
      echo '</select>
      </div>';
    }
  }
}

/////////////////Dayoff Change Request/////////////////////////////
if (isset($_POST['dcr_job_id']) && !empty($_POST['dcr_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id
                                            LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id
                                             WHERE employee_registration.er_job_id = "' . $_POST['dcr_job_id'].'"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Employee Name:</label>
      <select class="form-control" id="txt_emp_id" name="txt_emp_id" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM employee_registration';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['er_id'] . '"';
        if ($rows['er_id'] == $row['er_id']) {
          echo 'selected>' . $rows['er_name_kh'] . '</option>';
        } else {
          echo '>' . $rows['er_name_kh'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Gender:</label>
      <select class="form-control" id="txt_gender" name="txt_gender" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM gender';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['ge_id'] . '"';
        if ($rows['ge_id'] == $row['er_gender_id']) {
          echo 'selected>' . $rows['ge_name'] . '</option>';
        } else {
          echo '>' . $rows['ge_name'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Position:</label>
      <select class="form-control" id="txt_position" name="txt_position" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM position';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['position_id'] . '"';
        if ($rows['position_id'] == $row['er_position_id']) {
          echo 'selected>' . $rows['position'] . '</option>';
        } else {
          echo '>' . $rows['position'] . '</option>';
        }
      }
      echo '</select>
      </div>';
    }
  }
}

/////////////////Attendance Entry/////////////////////////////
if (isset($_POST['ae_job_id']) && !empty($_POST['ae_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id
                                            LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id
                                             WHERE employee_registration.er_job_id = "' . $_POST['ae_job_id'].'"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Employee Name:</label>
      <select class="form-control" id="txt_emp_id" name="txt_emp_id" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM employee_registration';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['er_id'] . '"';
        if ($rows['er_id'] == $row['er_id']) {
          echo 'selected>' . $rows['er_name_kh'] . '</option>';
        } else {
          echo '>' . $rows['er_name_kh'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Gender:</label>
      <select class="form-control" id="txt_gender" name="txt_gender" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM gender';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['ge_id'] . '"';
        if ($rows['ge_id'] == $row['er_gender_id']) {
          echo 'selected>' . $rows['ge_name'] . '</option>';
        } else {
          echo '>' . $rows['ge_name'] . '</option>';
        }
      }
      echo '</select>
      </div>';
    }
  }
}

/////////////////Dayoff Change Request/////////////////////////////
if (isset($_POST['rc_detail_job_id']) && !empty($_POST['rc_detail_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id
                                            LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id
                                             WHERE employee_registration.er_job_id = "' . $_POST['rc_detail_job_id'].'"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Employee Name:</label>
      <select class="form-control" id="txt_emp_id" name="txt_emp_id" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM employee_registration';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['er_id'] . '"';
        if ($rows['er_id'] == $row['er_id']) {
          echo 'selected>' . $rows['er_name_kh'] . '</option>';
        } else {
          echo '>' . $rows['er_name_kh'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Gender:</label>
      <select class="form-control" id="txt_gender" name="txt_gender" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM gender';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['ge_id'] . '"';
        if ($rows['ge_id'] == $row['er_gender_id']) {
          echo 'selected>' . $rows['ge_name'] . '</option>';
        } else {
          echo '>' . $rows['ge_name'] . '</option>';
        }
      }
      echo '</select>
      </div>';

      echo '<div class="form-group col-xs-6">
      <label>Position:</label>
      <select class="form-control" id="txt_position" name="txt_position" data-live-search="true" required="required">';
      $sqls = 'SELECT * FROM position';
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<option value ="' . $rows['position_id'] . '"';
        if ($rows['position_id'] == $row['er_position_id']) {
          echo 'selected>' . $rows['position'] . '</option>';
        } else {
          echo '>' . $rows['position'] . '</option>';
        }
      }
      echo '</select>
      </div>';
    }
  }
}
