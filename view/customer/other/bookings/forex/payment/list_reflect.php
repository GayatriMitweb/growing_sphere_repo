<?php
include "../../../../../../model/model.php";
$customer_id = $_SESSION['customer_id'];

$booking_id = $_POST['booking_id'];
?>

<div class="row mg_tp_20"> <div class="col-md-12"> <div class="table-responsive">
<table class="table table-bordered cust_table" id="tbl_list_f1" style="margin:20px 0 !important;">
	<thead>
		<tr class="table-heading-row">
			<th>S_No.</th>
			<th>Booking_ID</th>
			<th>Payment_Date</th>
			<th>Mode</th>
			<th>Bank_Name</th>
			<th>Tansaction_ID</th>
			<th class="text-right success">Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$query = "SELECT * from forex_booking_payment_master where 1";		
		if($booking_id!=""){
			$query .= " and booking_id='$booking_id'";
		}
		$query .= " and booking_id in (select booking_id from forex_booking_master where customer_id='$customer_id')";
		$bg;
		$count = 0;
		$total_paid_amt=0;

		$sq_pending_amount=0;
		$sq_cancel_amount=0;
		$sq_paid_amount=0;
		$Total_payment=0;
	
		$sq_payment = mysql_query($query);		

		while($row_payment = mysql_fetch_assoc($sq_payment)){
			$date = $row_payment['payment_date'];
			$yr = explode("-", $date);
			$year =$yr[0];
			$count++;

			$sq_bus_info = mysql_fetch_assoc(mysql_query("select * from forex_booking_master where booking_id='$row_payment[booking_id]'"));
			$date = $sq_bus_info['created_at'];
			$yr = explode("-", $date);
			$year1 =$yr[0];
			$sq_customer_info = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$sq_bus_info[customer_id]'"));
			
			$bg='';
			$sq_paid_amount = $sq_paid_amount + $row_payment['payment_amount'];
			if($row_payment['clearance_status']=="Pending"){ 
				$bg='warning';
				$sq_pending_amount = $sq_pending_amount + $row_payment['payment_amount'];
			}
			else if($row_payment['clearance_status']=="Cancelled"){ 
				$bg='danger';
				$sq_cancel_amount = $sq_cancel_amount + $row_payment['payment_amount'];
			}

			?>
			<tr class="<?= $bg?>">				
				<td><?= $count ?></td>		
				<td><?= get_forex_booking_id($row_payment['booking_id'],$year1); ?></td>
				<td><?= date('d-m-Y', strtotime($row_payment['payment_date'])) ?></td>
				<td><?= $row_payment['payment_mode'] ?></td>
				<td><?= $row_payment['bank_name'] ?></td>
				<td><?= $row_payment['transaction_id'] ?></td>	
				<td class="text-right success"><?= $row_payment['payment_amount'] ?></td>			
			</tr>
			<?php
		}
		?>
	</tbody>
	<tfoot>
		<tr class="active">
			<th colspan="1" class="text-right info">Total Paid : <?= number_format($sq_paid_amount,2) ?></th>			
			<th colspan="2" class="text-right warning">Total Pending : <?= number_format($sq_pending_amount,2) ?></th>			
			<th colspan="2" class="text-right danger">Total Cancel : <?= number_format($sq_cancel_amount,2) ?></th>			
			<th colspan="2" class="text-right success"> Total Payment : <?= number_format(($sq_paid_amount - $sq_pending_amount - $sq_cancel_amount),2) ?></th>
		</tr>
	</tfoot>	
</table>

</div> </div> </div>
<script type="text/javascript">
$('#tbl_list_f1').dataTable({
	"pagingType": "full_numbers"
});
</script>