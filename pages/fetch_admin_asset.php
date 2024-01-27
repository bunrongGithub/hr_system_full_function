<?php
include '../config/db_connect.php';
if (isset($_POST['txt_asset_in_id']) && !empty($_POST['txt_asset_in_id'])) {
   $query = 'SELECT * FROM admin_asset_transfer
         LEFT JOIN assest_code_creation ON assest_code_creation.ac_id =  admin_asset_transfer.adasst_code WHERE admin_asset_transfer.adasst_id = "' . $_POST['txt_asset_in_id'] . '"';
   $result = mysqli_query($connect, $query);
   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
         echo '<div class="form-group col-xs-6">
            <label>Transfer From:</label>
            <input type="text" class="form-control" id="txt_transfer_from" name="txt_transfer_from" value="' . $row["adasst_transfer_form"] . '" readonly />
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Transfer_To:</label>
            <input type="text" class="form-control" id="txt_transfer_to" name="txt_transfer_to" value="' . $row["adasst_transfer_to"] . '" readonly />
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Category:</label>
            <input type="text" class="form-control" id="txt_category" name="txt_category" value="' . $row["as_asset_category"] . '" readonly />
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Asset_Name:</label>
            <input type="text" class="form-control" id="txt_asset_name" name="txt_asset_name" value="' . $row["adasst_asset_name"] . '" readonly />
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Receive Date:</label>
            <input required type="date" class="form-control" id="receive_date" name="receive_date"/>
            </div>';
         echo '<div class="form-group col-xs-3">
            <label>QTY:</label>
            <input type="number" value="' . $row['adasst_qty'] . '" class="form-control" id="txt_qty" name="txt_qty"/>
            </div>';
?>
         <div class="form-group col-xs-3">
            <label>Mou:</label>
            <select class="form-control" id="txt_mou" name="txt_mou">
               <option disabled selected></option>
               <?php
               $sql = 'SELECT * FROM text_asset_in_mou';
               $result = mysqli_query($connect, $sql);
               while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
               }
               ?>
            </select>
         </div>
         <?php
         echo '<div class="form-group col-xs-6">
            <label>Unit_Price:</label>
            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input required type="text" class="form-control" id="unit_price" name="txt_unit_price"/>
            </div>
            </div>';
         echo '<div class="form-group col-xs-6">
            <label>Total_Amount:</label>
            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input required type="text" class="form-control" id="txt_total_amount" name="txt_total_amount"/>
            </div>
            </div>';
         ?>
         <div class="form-group col-xs-6">
            <label>Status:</label>
            <select class="form-control" id="txt_status" name="txt_status">
               <option disabled selected></option>
               <?php
               $sql = 'SELECT * FROM txt_admin_asset_receive_status';
               $result = mysqli_query($connect, $sql);
               while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['tadsrs_id'] . '">' . $row['tadsrs_name'] . '</option>';
               }
               ?>
            </select>
         </div>
         <?php
         echo '<div class="form-group col-xs-12">
            <label>Remark:</label>
            <textarea type="text" required class="form-control" rows="2" id="txt_remark" name="txt_remark"></textarea>
            </div>';

         ?>
      <?php
      }
   }
}
/** fetch statinary transfer */
if (isset($_POST['txt_stafer_id']) && !empty($_POST['txt_stafer_id'])) {
   $_post_data = $_POST['txt_stafer_id'];
   $sql = "SELECT * FROM admin_stationary_transfer A 
                        LEFT JOIN stationary_code B ON B.sc_id = A.adstt_code
                        LEFT JOIN text_asset_code_creation_type C ON C.acct_id = A.adstt_type
            where adstt_id = '$_post_data'";
   $result = $connect->query($sql);
   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
         <div class="form-group col-xs-6">
            <label>ST. Code:</label>
            <input readonly class="form-control" value="<?=$row['sc_stationary_code'];?>" id="txt_code" name="txt_code" type="text">
         </div>
         <div class="form-group col-xs-6">
            <label>ST. Name:</label>
            <input readonly class="form-control"value="<?=$row['adstt_name'];?>" id="txt_name" name="txt_name" type="text">
         </div>
         <div class="form-group col-xs-6">
            <label>ST. Type:</label>
            <input readonly class="form-control"value="<?=$row['acct_name'];?>" id="txt_name" name="txt_name" type="text">
         </div>
<?php
      }
   }
}
if(isset($_POST['txt_emp_stationary_usage'])&& !empty($_POST['txt_emp_stationary_usage'])){
   $_post_id = $_POST['txt_emp_stationary_usage'];
   $table_emp = "employee_registration";
   $table_position = "position";
   $sql = "SELECT er_job_id,
                  er_name_kh,
                  er_id,
                  er_position_id,
                  position
               FROM ".$table_emp . "
               LEFT JOIN ".$table_position
               . " on ".$table_position.".position_id = ".$table_emp. ".er_position_id
   WHERE er_id = ".$_post_id;
   $result = $connect->query($sql);
   if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result))
      {
         ?>
         <div class="form-group col-xs-6">
            <label>Employee Name:</label>
            <input readonly class="form-control" value="<?=$row['er_name_kh'];?>" id="" name="" type="text">
         </div>
         <div class="form-group col-xs-6">
            <label>Position:</label>
            <input readonly class="form-control" value="<?=$row['position'];?>" id="" name="" type="text">
         </div>
         <?php
      }
   }
}
?>