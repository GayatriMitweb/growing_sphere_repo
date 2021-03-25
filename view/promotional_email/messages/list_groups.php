<?php 
include "../../../model/model.php";
$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$branch_status = $_POST['branch_status'];

$query1 = "select * from email_group_master where 1";
if($branch_status=='yes' && $role=='Branch Admin'){
  $query1 .=" and branch_admin_id = '$branch_admin_id'";
}
$sq_email = mysql_query($query1);
 
?>
<div class="col-md-4">
	<select name="group_name" class="form-control" id="group_name" title="Group Name">
		<option value="">Select Email Group</option>
	<?php 
	while($row_email = mysql_fetch_assoc($sq_email)){   ?>
		<option value="<?php echo $row_email['email_group_id']; ?>"><?php echo $row_email['email_group_name']; ?></option>
		<?php } ?>
	</select>
</div>
<div class="col-md-3">
	<button class="btn btn-success btn-sm" id="send" onclick="mail_send()"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Send</button>
</div>

