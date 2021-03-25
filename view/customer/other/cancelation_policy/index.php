<?php
include "../../../../model/model.php";
require_once('../../layouts/admin_header.php');
$sq_app = mysql_fetch_assoc(mysql_query("select policy_url from app_settings where setting_id='1'"));
$newUrl = preg_replace('/(\/+)/','/',$sq_app['policy_url']);      
$newUrl = str_replace("../","", $newUrl);  
$policy_url = BASE_URL.$newUrl;
?>
<input type="hidden" value="<?= $policy_url ?>" id="policy_url1">
<script>
function backup_application()
{
	var policy_url1 = $('#policy_url1').val();
	if(policy_url1 == ''){
		alert("Sorry!Policy not uploaded.");
		return false;
	}
	else{
		var anchor = document.createElement('a');
		anchor.href = policy_url1;
		anchor.target = '_blank';
		anchor.download = policy_url1;
		anchor.click();
	}
}
backup_application();
</script>
<?php require_once('../../layouts/admin_footer.php'); ?>