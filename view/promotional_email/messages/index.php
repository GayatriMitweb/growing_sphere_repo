<?php
include "../../../model/model.php";
$branch_status = $_POST['branch_status'];
?>
<input type="hidden" id="branch_status" name="branch_status" value="<?= $branch_status ?>" >
<div class="app_panel_content Filter-panel">
	<div class="row">
		<div class="col-md-3">
		<?php $sq_template = mysql_query("select * from email_template_master order by template_type");	?>
			<select name="template_type" id="template_type" class="form-control" onchange="list_email_template()" title="Template Type">
				<option value="">Template Type</option>
				<?php 
				while($row_template = mysql_fetch_assoc($sq_template)){
				?>
					<option value="<?php echo $row_template['template_id']; ?>"><?php echo $row_template['template_type']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-9">
		<div id="div_group_list"></div>
		</div>
	</div>
</div>

</div>
<?php include_once('message_save_modal.php'); ?>
<script>
$('#template_type').select2();
function list_email_template()
{
	  var branch_status = $('#branch_status').val();
	$.post('messages/list_groups.php', { branch_status : branch_status }, function(data){
		$('#div_group_list').html(data);
	});
}
function mail_send(sms_message_id, offset){

	var template_type = $('#template_type').val();
	var group_name = $('#group_name').val();
	
	var base_url = $('#base_url').val();
	$('#send').button('loading');
	$.ajax({
		type:'post',
		url:base_url+'controller/promotional_email/message/mail_send.php',
		data:{ template_type : template_type, group_name : group_name },
		success:function(result){
			msg_alert(result);
			$('#send').button('reset');
			list_email_template();
		}
	});

}
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>