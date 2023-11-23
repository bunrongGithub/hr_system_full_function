<?php
include '../config/db_connect.php';

///////////////// Termination /////////////////////////////
if (isset($_POST['ter_job_id']) && !empty($_POST['ter_job_id'])) {
  
      echo '<div class="form-group col-xs-12">
      <label>Total Warning:</label>';
      
      $sqls = 'SELECT count(wa_id) as co_wa_id FROM warning where wa_job_id ='.$_POST["ter_job_id"];
      $results = mysqli_query($connect, $sqls);
      while ($rows = mysqli_fetch_assoc($results)) {
        echo '<input class="form-control" id="txt_warning"
         name="txt_warning" 
         type="number" 
         value="'.$rows["co_wa_id"].'" readonly> 
        </div>';        
      }
      
    }
