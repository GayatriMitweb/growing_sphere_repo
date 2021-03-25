<div class="row">
	<div class="col-md-6">
		<div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Train Amount</h3>
	        <?php
	        	$train_expense = $sq_tour_deatils['train_expense'];
	        	if($train_expense ==""){
	        		$train_expense = 0.00;
	        	}
	        	else{
	        		$train_expense = $sq_tour_deatils['train_expense'];
	        	}

	        	$train_service_charge = $sq_tour_deatils['train_service_charge'];
	        	if($train_service_charge ==""){
	        		$train_service_charge = 0.00;
	        	}
	        	else{
	        		$train_service_tax = $sq_tour_deatils['train_service_charge'];
	        	}

	        	$train_service_tax = $sq_tour_deatils['train_service_tax'];
	        	if($train_service_tax ==""){
	        		$train_service_tax = 0.00;
	        	}
	        	else{
	        		$train_service_tax = $sq_tour_deatils['train_service_tax'];
	        	}
	        	$train_service_tax_subtotal = $sq_tour_deatils['train_service_tax_subtotal'];
	        	if($train_service_tax_subtotal ==""){
	        		$train_service_tax_subtotal = 0.00;
	        	}
	        	else{
	        		$train_service_tax_subtotal = $sq_tour_deatils['train_service_tax_subtotal'];
	        	}

	        	$total_train_expense = $sq_tour_deatils['total_train_expense'];
	        	if($total_train_expense==""){
	        		$total_train_expense = 0.00;
	        	}
	        	else{
	        		$total_train_expense = $sq_tour_deatils['total_train_expense'];
	        	}
	        ?>

	        <div class="row">
	            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
	                <span class="main_block">
		                <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		                <?php echo "<label>Subtotal <em>:</em></label> ".$train_expense; ?>
	                </span>
		        	<span class="main_block">
		        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  	<?php echo "<label>Service charge <em>:</em></label> ".$train_service_charge; ?>
		        	</span>
				    <span class="main_block">
				      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      	<?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$train_service_tax; ?> 
				    </span>
				</div>
				<div class="col-sm-6">
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$train_service_tax_subtotal; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount<em>:</em></label> ".$total_train_expense; ?> 
	        	    </span>
	        	</div>
			</div>	
		</div>
	</div>
	 <?php
        $plane_expense = $sq_tour_deatils['plane_expense'];
        	if($plane_expense==""){
        		$plane_expense = 0.00;
        	}
        	else{
        		$plane_expense = $sq_tour_deatils['plane_expense'];
        	}

        	$plane_service_charge = $sq_tour_deatils['plane_service_charge'];
        	if($plane_service_charge==""){
        		$plane_service_charge = 0.00;
        	}
        	else{
        		$plane_service_charge= $sq_tour_deatils['plane_service_charge'];
        	}
        	$plane_service_tax = ($sq_tour_deatils['plane_service_tax']!="") ? $sq_tour_deatils['plane_service_tax']: 0;
        	$plane_service_tax_subtotal = ($sq_tour_deatils['plane_service_tax_subtotal']!="") ? $sq_tour_deatils['plane_service_tax_subtotal']: 0;
        	$total_plane_expense= ($sq_tour_deatils['total_plane_expense']!="") ?$sq_tour_deatils['total_plane_expense']: 0;
    ?>
	<div class="col-md-6">
		 <div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Flight Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  	<?php echo "<label>Subtotal <em>:</em></label> ".$plane_expense; ?>
	                </span>
		        	<span class="main_block">
		        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  	<?php echo "<label>Service charge <em>:</em></label> ".$plane_service_charge; ?>
		        	</span>
				    <span class="main_block">
				      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      	<?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$plane_service_tax; ?> 
				    </span>
				</div>
				<div class="col-sm-6">
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Tax Amount <em>:</em></label> ".$plane_service_tax_subtotal; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount <em>:</em></label> ".$total_plane_expense; ?> 
	        	    </span>
	        	 </div>
			</div>
    	</div>
	</div>
</div>
<?php
	$visa_amount = ($sq_tour_deatils['visa_amount']!="") ?$sq_tour_deatils['visa_amount']: 0.00;
	$visa_service_charge = ($sq_tour_deatils['visa_service_charge']!="") ?$sq_tour_deatils['visa_service_charge']: 0.00;
	$visa_service_tax = ($sq_tour_deatils['visa_service_tax']!="") ? $sq_tour_deatils['visa_service_tax']: 0.00;
	$tax_in_percentage = ($sq_taxation['tax_in_percentage']!="") ?$sq_taxation['tax_in_percentage']: 0.00;
	$visa_service_tax_subtotal = ($sq_tour_deatils['visa_service_tax_subtotal']!="") ?$sq_tour_deatils['visa_service_tax_subtotal']: 0;
	$visa_total_amount= ($sq_tour_deatils['visa_total_amount']!="") ?$sq_tour_deatils['visa_total_amount']: 0.00;
?>
<div class="row">
	<?php
        $cruise_expense = $sq_tour_deatils['cruise_expense'];
        	if($cruise_expense==""){
        		$cruise_expense = 0.00;
        	}
        	else{
        		$cruise_expense = $sq_tour_deatils['cruise_expense'];
        	}

        	$cruise_service_charge = $sq_tour_deatils['cruise_service_charge'];
        	if($cruise_service_charge==""){
        		$cruise_service_charge = 0.00;
        	}
        	else{
        		$cruise_service_charge= $sq_tour_deatils['cruise_service_charge'];
        	}
        	$cruise_service_tax = ($sq_tour_deatils['cruise_service_tax']!="") ? $sq_tour_deatils['cruise_service_tax']: 0;
        	$cruise_service_tax_subtotal = ($sq_tour_deatils['cruise_service_tax_subtotal']!="") ? $sq_tour_deatils['cruise_service_tax_subtotal']: 0;
        	$total_cruise_expense= ($sq_tour_deatils['total_cruise_expense']!="") ?$sq_tour_deatils['total_cruise_expense']: 0;
    ?>
	<div class="col-md-6">
		 <div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Cruise Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  	<?php echo "<label>Subtotal <em>:</em></label> ".$cruise_expense; ?>
	                </span>
		        	<span class="main_block">
		        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  	<?php echo "<label>Service charge <em>:</em></label> ".$cruise_service_charge; ?>
		        	</span>
				    <span class="main_block">
				      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      	<?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$cruise_service_tax; ?> 
				    </span>
				</div>
				<div class="col-sm-6">
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Tax Amount <em>:</em></label> ".$cruise_service_tax_subtotal; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount <em>:</em></label> ".$total_cruise_expense; ?> 
	        	    </span>
	        	 </div>
			</div>
    	</div>
	</div>
	<div class="col-md-6">
		<div class="profile_box main_block" style="min-height: 141px;">
			<h3>Visa Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  	<?php echo "<label>Country Name <em>:</em></label> ".$sq_tour_deatils['visa_country_name']; ?>
	                </span>
		        	<span class="main_block">
		        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  	<?php echo "<label>Amount <em>:</em></label> ".$visa_amount; ?>
		        	</span>
				    <span class="main_block">
				      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      	<?php echo "<label>Service Charge <em>:</em></label> ".$visa_service_charge; ?> 
				    </span>
				</div>
				<div class="col-sm-6">
				    <?php   
                        $sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_tour_deatils[visa_taxation_id]'"));
                    ?>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$visa_service_tax; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$visa_service_tax_subtotal; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount <em>:</em></label>" .$visa_total_amount ?>
	        	    </span>
	        	</div>
			</div>
		</div>
	</div>
	<?php
		$insurance_amount = ($sq_tour_deatils['insuarance_amount']!="") ? $sq_tour_deatils['insuarance_amount']: 0.00;
		$insuarance_service_charge = ($sq_tour_deatils['insuarance_service_charge']!="") ?$sq_tour_deatils['insuarance_service_charge']: 0.00;
		$insuarance_service_tax = ($sq_tour_deatils['insuarance_service_tax']!="") ? $sq_tour_deatils['insuarance_service_tax']: 0.00;
		$insuarance_service_tax_subtotal = ($sq_tour_deatils['insuarance_service_tax_subtotal']!="") ? $sq_tour_deatils['insuarance_service_tax_subtotal']: 0.00;
		$insuarance_total_amount= ($sq_tour_deatils['insuarance_total_amount']!="") ? $sq_tour_deatils['insuarance_total_amount']: 0.00;
	?>
</div>
<div class="row">
	<div class="col-md-6">
		 <div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Insurance Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  	<?php echo "<label>Company Name <em>:</em></label> ".$sq_tour_deatils['insuarance_company_name']; ?>
	                </span>
		        	<span class="main_block">
		        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  	<?php echo "<label>Amount <em>:</em></label> ".$insurance_amount ?>
		        	</span>
				    <span class="main_block">
				      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      	<?php echo "<label>Service Charge <em>:</em></label> ".$insuarance_service_charge; ?> 
				    </span>
				</div>
				<div class="col-sm-6">
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$insuarance_service_tax; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$insuarance_service_tax_subtotal; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount <em>:</em></label> ".$insuarance_total_amount; ?> 
	        	    </span>
	        	</div>
			</div>	
    	</div>
	</div>

	<div class="col-md-6">
		<div class="profile_box main_block" style="min-height: 225px;">
	        <h3>Tour Amount</h3>
			<?php
				$adult_expense = ($sq_tour_deatils['adult_expense']!="") ? $sq_tour_deatils['adult_expense']: 0.00;
				$children_expense = ($sq_tour_deatils['children_expense']!="") ? $sq_tour_deatils['children_expense']: 0.00;
				
				$infant_expense= ($sq_tour_deatils['infant_expense']!="") ? $sq_tour_deatils['infant_expense']: 0.00;
				$tour_fee= ($sq_tour_deatils['tour_fee']!="") ? $sq_tour_deatils['tour_fee']: 0.00;
			?>
	        <?php
				$sq1 = mysql_query("select * from travelers_details where traveler_group_id ='$sq_group_info[traveler_group_id]' and adolescence='Adult' and status='Active'");
				$total_adult = mysql_num_rows($sq1);

				$sq1 = mysql_query("select * from travelers_details where traveler_group_id ='$sq_group_info[traveler_group_id]' and adolescence='Children' and status='Active' ");
				$total_children = mysql_num_rows($sq1);

				$sq1 = mysql_query("select * from travelers_details where traveler_group_id ='$sq_group_info[traveler_group_id]' and adolescence='Infant' and status='Active' ");
				$total_infant = mysql_num_rows($sq1);

				$total_seats = $total_adult + $total_children + $total_infant;
			?>
	        <div class="row">
				<div class="col-sm-6">
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Adult Cost <em>:</em></label> ".$adult_expense; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Children Cost <em>:</em></label> ".$children_expense; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Infant Cost <em>:</em></label>" .$infant_expense ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      	<?php echo "<label>Total Amount <em>:</em></label>" .$tour_fee ?> 
	        	    </span>
	        	</div>
			</div>	
		</div>
	</div>
</div>
<div class="row">
	<?php
		$tour_amount = ($sq_tour_deatils['tour_fee_subtotal_1']!="") ? $sq_tour_deatils['tour_fee_subtotal_1']: 0.00;
		$tour_fee_subtotal_2 = ($sq_tour_deatils['tour_fee_subtotal_2']!="") ? $sq_tour_deatils['tour_fee_subtotal_2']: 0.00;
		
		$visa_total_amount= ($sq_tour_deatils['visa_total_amount']!="") ? $sq_tour_deatils['visa_total_amount']: 0.00;
		$insuarance_total_amount= ($sq_tour_deatils['insuarance_total_amount']!="") ? $sq_tour_deatils['insuarance_total_amount']: 0.00;
		$tour_total_amount= ($sq_tour_deatils['total_tour_fee']!="") ? $sq_tour_deatils['total_tour_fee']: 0.00;
		$travel_total_amount= ($sq_tour_deatils['total_travel_expense']!="") ? $sq_tour_deatils['total_travel_expense']: 0.00;
		$final_total_amount= (($sq_tour_deatils['total_tour_fee'] + $sq_tour_deatils['total_travel_expense'])!="") ? ($sq_tour_deatils['total_tour_fee'] + $sq_tour_deatils['total_travel_expense']): 0.00;
		$final_total_amount = number_format($final_total_amount, 2);
	?>


	<h3 class="editor_title">Total Tour Amount</h3>
	<div class="panel panel-default panel-body app_panel_style">
		<div class="col-md-12">
			 <div class="profile_box main_block">
		        <div class="row">
		            <div class="col-sm-6 right_border_none_sm" style="border-right: 1px solid #ddd">
		                <span class="main_block">
		                  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		                  	<?php echo "<label>Repeater's Discount <em>:</em></label> ".$sq_tour_deatils['repeater_discount']; ?>
		                </span>
			        	<span class="main_block">
			        	  	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
			        	  	<?php echo "<label>Adjustment Discount <em>:</em></label> ".$sq_tour_deatils['adjustment_discount']; ?>
			        	</span>
			        	<?php $total_discount = $sq_tour_deatils['repeater_discount'] + $sq_tour_deatils['adjustment_discount']; ?>
			        	<span class="main_block">
					      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
					      	<?php echo "<label>Total Discount <em>:</em></label> ".$total_discount; ?> 
					    </span>
					    <span class="main_block">
					      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
					      	<?php echo "<label>Subtotal <em>:</em></label> ".$tour_amount; ?> 
					    </span>
					    <?php

						$sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_tour_deatils[tour_taxation_id]'"));
						$gst = ($sq_taxation['tax_in_percentage']!="") ? $sq_taxation['tax_in_percentage']: 0.00;

						?>
		        	    <span class="main_block">
			        	    <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
			        	    <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> " .$gst; ?> 
		        	    </span>
		        	    <span class="main_block">
			        	    <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
			        	    <?php echo "<label>".get_tax_name()." Amount <em>:</em></label> " .$sq_tour_deatils['service_tax']; ?> 
		        	    </span>
					</div>
					<div class="col-sm-6">
		        	    <span class="main_block">
		        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	      <?php echo "<label>Tour Amount <em>:</em></label> " .$tour_fee_subtotal_2; ?> 
	        	    	</span>
	        	    	<span class="main_block">
		        	      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	      	<?php echo "<label>Visa Amount <em>:</em></label> " .$visa_total_amount ?> 
		        	    </span>
		        	    <span class="main_block">
			        	    <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
			        	    <?php echo "<label>Insurance Amount <em>:</em></label> ".$insuarance_total_amount; ?>
	        	    	</span>
	       		        <span class="main_block">
	       		        	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	      	<?php echo "<label>Total Tour Amount <em>:</em></label> "?><em class="theme_col"><?php echo $tour_total_amount; ?></em> 
		        	    </span>
		        	    <span class="main_block">
					      	<i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
					      	<?php echo "<label>Travel Amount <em>:</em></label> "?><em class="theme_col"><?php echo $travel_total_amount; ?> </em>
					    </span>
		        	    <span class="main_block" style="min-width: 161px;height: 28px;border: 1px solid #62dac4;background-color: #52c5c5;color: white;text-align:center;padding-top: 3px;">
		        	      	<?php echo "<label>Booking Amount <em>:</em></label> ".$final_total_amount; ?> 
		        	    </span>
		        	</div>
				</div>
	    	</div>
		</div>
	</div>
</div>