<?php include "../../../../../../model/model.php"; 
include_once('../itc_report/vendor_generic_functions.php');
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$branch_status = $_POST['branch_status'];
$role = $_POST['role'];
$branch_admin_id = $_POST['branch_admin_id'];
$taxation_id = $_POST['taxation_id'];
$array_s = array();
$temp_arr = array();

$query = "select * from vendor_estimate where status ='' ";
if($from_date !='' && $to_date != ''){
	$from_date = get_date_db($from_date);
	$to_date = get_date_db($to_date);
	$query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
	$query .= " and taxation_id = '$taxation_id'";
}
include "../../../../../../model/app_settings/branchwise_filteration.php";
$sq_setting = mysql_fetch_assoc(mysql_query("select * from app_settings where setting_id='1'"));

$count = 1;
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
	$taxable_amount = $row_query['basic_cost'] + $row_query['non_recoverable_taxes'] + $row_query['service_charge'] + $row_query['other_charges'];
	$vendor_name = get_vendor_name($row_query['vendor_type'],$row_query['vendor_type_id']);
	$vendor_info = get_vendor_info($row_query['vendor_type'], $row_query['vendor_type_id']);
	$hsn_code = get_service_info($row_query['estimate_type']);

	$sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$vendor_info[state_id]'"));
	$sq_supply = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_setting[state_id]'"));
	
	$tax_per = $row_query['service_tax'];
	$tax_amount = $row_query['service_tax_subtotal'];
	
	$temp_arr = array( "data" => array(
		(int)($count++),
		$row_query['estimate_type'],
		$vendor_name ,
		$row_query['estimate_id'],
		get_date_user($row_query['created_at']), 
		($vendor_info['service_tax'] == '') ? 'NA' : $vendor_info['service_tax'],
		($vendor_info['service_tax'] == '') ? 'Unregistered' : 'Registered' ,
		$row_query['service_tax'],
		number_format($taxable_amount,2),
		$tax_amount

		), "bg" =>$bg);
		array_push($array_s,$temp_arr);
	}
echo json_encode($array_s);			 
?>	
		