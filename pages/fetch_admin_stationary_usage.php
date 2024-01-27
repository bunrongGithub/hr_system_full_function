<?php 
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if(isset($_POST['staff_job_id']) && !empty($_POST['staff_job_id'])){
   $_stu_job_id = $_POST['staff_job_id'];
   $sql = "SELECT er_position_id,
                  er_name_kh,
                  er_id,
                  position
               FROM `employee_registration` A
               LEFT JOIN `position` B ON `B`.`position_id` = `A`.`er_position_id`
               WHERE er_id = '$_stu_job_id'
   ";
   $result = mysqli_query($connect,$sql);
   if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
         echo '<div class="form-group col-xs-6">
            <label>Employee Name KH:</label>
            <input type="text" class="form-control" id="txt_name_kh" name="txt_name_kh" value="' . $row["er_name_kh"] . '"readonly/>
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Position:</label>
            <input type="text" class="form-control" id="txt_name_kh" name="txt_name_kh" value="' . $row["position"] . '"readonly/>
            </div>';
      }
   }
}
?>
