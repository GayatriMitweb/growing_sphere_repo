<?php
include "../model.php";
$tax = $_POST['tax'];
$tax_id = $_POST['tax_id'];
if($tax_id != '0'){
?>
<option value="<?= $tax_id ?>"><?= $tax ?></option>
<?php } ?>
<option value="0">Tax(%)</option>
<?php
$sq_taxation = mysql_query("select * from taxation_master where active_flag='Active'");
while($row_taxation = mysql_fetch_assoc($sq_taxation)){
      $sq_tax_type = mysql_fetch_assoc(mysql_query("select * from tax_type_master where tax_type_id='$row_taxation[tax_type_id]'"));
      ?>
      <option value="<?= $row_taxation['taxation_id'] ?>"><?= $sq_tax_type['tax_type'].'-'.$row_taxation['tax_in_percentage'] ?></option>
<?php } ?>


