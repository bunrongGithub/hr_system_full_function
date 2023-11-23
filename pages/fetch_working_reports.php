<?php 
   include '../config/db_connect.php';
   if(isset($_POST['data_task_no']) &&  !empty($_POST['data_task_no'])){
      $query = 'SELECT * FROM company_task WHERE company_task.ct_id = "'.$_POST['data_task_no'].'"';
      $result = mysqli_query($connect,$query);
      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_assoc($result)){
            echo '<div class="form-group col-xs-6">
            <label>Description:</label>
            <input class="form-control" id="id_description" value="'.$row['ct_description'].'" name="txt_description" type="text">
         </div>';
         }
      }
   }
?>