<?php
include '../config/db_connect.php';

///////////////// Roster Detail Show/////////////////////////////
if (isset($_POST['rc_detail_job_id']) && !empty($_POST['rc_detail_job_id'])) {
  $query = 'SELECT * FROM employee_registration LEFT JOIN position on position.position_id = employee_registration.er_position_id
                                            LEFT JOIN gender on gender.ge_id = employee_registration.er_gender_id
                                             WHERE employee_registration.er_job_id = "' . $_POST['rc_detail_job_id'] . '"';
  $result = mysqli_query($connect, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="form-group col-xs-6">
      <label>Employee Name:</label>
      <select class="form-control" id="txt_rcd_emp_id" name="txt_rcd_emp_id" data-live-search="true" required="required">';
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
      <select class="form-control" id="txt_rcd_gender" name="txt_rcd_gender" data-live-search="true" required="required">';
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
      <select class="form-control" id="txt_rcd_position" name="txt_rcd_position" data-live-search="true" required="required">';
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


///////////////// Roster Detail Insert/////////////////////////////
if (
  isset($_POST['date']) && !empty($_POST['date']) &&
  isset($_POST['desc']) && !empty($_POST['desc'])
) {

  $v_month = $_POST["month"];
  $v_jobid = $_POST["jobid"];
  $v_emp = $_POST["emp"];
  $v_gender = $_POST["gender"];
  $v_position = $_POST["position"];
  $date = $_POST["date"];
  $name = $_POST["desc"];
  $query = '';
  for ($count = 0; $count < count($date); $count++) {
    $date_clean = mysqli_real_escape_string($connect, $date[$count]);
    $name_clean = mysqli_real_escape_string($connect, $name[$count]);

    if ($date_clean != '' && $name_clean != '') {
      $query .= "INSERT INTO roster_creation_detail (rcd_roster_id, rcd_date, rcd_note, rcd_er_id,rcd_job_id, rcd_gender, rcd_position)
       VALUES ('$v_month',' $date_clean','$name_clean','$v_emp','$v_jobid','$v_gender','$v_position'); ";
    }
  }
  if ($query != '') {
    if (mysqli_multi_query($connect, $query)) {
      header('location:roster.php?message=success');
    }
  }
}

///////////////// Roster Filter Show/////////////////////////////
if (isset($_POST['filter_id']) && !empty($_POST['filter_id'])) {
  echo '<div class="box-body table-responsive">
          <table class="table table-bordered table-striped">';

  $sql = "SELECT * FROM roster_creation WHERE rc_id = ".$_POST['filter_id'];
  $result = $connect->query($sql);
  $row = $result->fetch_assoc();
  echo ' <h1 class="text-center text-uppercase"><u> ROSTER LIST '.$row['rc_name'].'</u></h1><br/>
            <thead>
              <tr>
              <th>No</th>
              <th>Job ID</th>
              <th>Name KH</th>
              <th>Gender</th>
              <th>Position</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>6</th>
              <th>7</th>
              <th>8</th>
              <th>9</th>
              <th>10</th>
              <th>11</th>
              <th>12</th>
              <th>13</th>
              <th>14</th>
              <th>15</th>
              <th>16</th>
              <th>17</th>
              <th>18</th>
              <th>19</th>
              <th>20</th>
              <th>21</th>
              <th>22</th>
              <th>23</th>
              <th>24</th>
              <th>25</th>
              <th>26</th>
              <th>27</th>
              <th>28</th>';
              

  switch ($row['rc_day']) {
    case 29:
      echo '<th>29</th> ';
      break;
    case 30:
      echo '<th>29</th><th>30</th> ';
      break;
    case 31:
      echo '<th>29</th><th>30</th><th>31</th> ';
      break;
  }
  echo '
        </tr>
        </thead>
        <tbody>';
  $i = 1;
  $sql = "SELECT er_job_id,rcd_roster_id, rcd_er_id, 
              er_name_kh, ge_name, position FROM roster_creation_detail 
              LEFT JOIN roster_creation ON roster_creation.rc_id = roster_creation_detail.rcd_roster_id 
              LEFT JOIN position ON position.position_id = roster_creation_detail.rcd_position 
              LEFT JOIN gender ON gender.ge_id = roster_creation_detail.rcd_gender 
              LEFT JOIN employee_registration ON employee_registration.er_id = roster_creation_detail.rcd_er_id 
              WHERE roster_creation_detail.rcd_roster_id = ".$_POST['filter_id']." 
              GROUP BY rcd_er_id , rcd_roster_id";
  $result = $connect->query($sql);
  while ($rows = $result->fetch_assoc()) {

    echo ' <tr>
            <td>' . $i . '</td>
            <td>' . $rows['er_job_id'] . '</td>
            <td>' . $rows['er_name_kh'] . '</td>
            <td>' . $rows['ge_name'] . '</td>
            <td>' . $rows['position'] . '</td>';
    $sqld = "SELECT rcd_date FROM roster_creation_detail 
                    WHERE rcd_roster_id = 2 
                    AND rcd_er_id = " . $rows['rcd_er_id'] . ";";
    $results = mysqli_query($connect, $sqld);
    $arraydate = array();
    while ($rowsd = mysqli_fetch_array($results)) {
      $arraydate[] = $rowsd['rcd_date'];
    }
    if (in_array('1', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('2', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('3', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('4', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('5', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('6', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('7', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('8', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('9', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('10', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('11', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('12', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('13', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('14', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('15', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('16', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('17', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('18', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('19', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('20', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('21', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('22', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('23', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('24', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('25', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('26', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('27', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';
    if (in_array('28', $arraydate))
      echo '<td style ="background-color: red;">DO</td>';
    else
      echo '<td>W</td>';

    switch ($row['rc_day']) {
      case 29:
        if (in_array('29', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        break;
      case 30:
        if (in_array('29', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        if (in_array('30', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        break;
      case 31:
        if (in_array('29', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        if (in_array('30', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        if (in_array('31', $arraydate))
          echo '<td style ="background-color: red;">DO</td>';
        else
          echo '<td>W</td>';
        break;
    }
    echo '</tr>';
    $i++;
  }
  echo '
         </tbody>
        </table>
      </div>';
}
