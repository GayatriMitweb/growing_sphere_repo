<div class="row mg_bt_20">
	<div class="col-md-6 col-sm-12 col-xs-12 mg_bt_20_xs">
		<div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Train Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Subtotal <em>:</em></label> ".$sq_package_info['train_expense']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Service charge <em>:</em></label> ".$sq_package_info['train_service_charge']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_package_info['train_service_tax']; ?> 
				    </span>
				</div>
				<div class="col-sm-6 col-xs-12">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$sq_package_info['train_service_tax_subtotal']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label> ".$sq_package_info['total_train_expense']; ?> 
	        	    </span>
	        	</div>
			</div>	
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		 <div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Flight Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Subtotal <em>:</em></label> ".$sq_package_info['plane_expense']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Service charge <em>:</em></label> ".$sq_package_info['plane_service_charge']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_package_info['plane_service_tax']; ?> 
				    </span>
				</div>
				<div class="col-sm-6 col-xs-12">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Tax Amount <em>:</em></label> ".$sq_package_info['plane_service_tax_subtotal']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label> ".$sq_package_info['total_plane_expense']; ?> 
	        	    </span>
	        	 </div>
			</div>
    	</div>
	</div>
</div>

<div class="row mg_bt_20">
	<div class="col-md-6 col-sm-12 col-xs-12 mg_bt_20_xs">
		<div class="profile_box main_block" style="min-height: 141px;">
			<h3>Cruise Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Subtotal <em>:</em></label> ".$sq_package_info['cruise_expense']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Service charge <em>:</em></label> ".$sq_package_info['cruise_service_charge']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_package_info['cruise_service_tax']; ?> 
				    </span>
				</div>
				<div class="col-sm-6 col-xs-12">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$sq_package_info['cruise_service_tax_subtotal']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label> ".$sq_package_info['total_cruise_expense']; ?> 
	        	    </span>
	        	</div>
			</div>	
	       
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 mg_bt_20_xs">
		<div class="profile_box main_block" style="min-height: 141px;">
			<h3>Visa Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Country Name <em>:</em></label> ".$sq_package_info['visa_country_name']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Amount <em>:</em></label> ".$sq_package_info['visa_amount']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>Service Charge <em>:</em></label> ".$sq_package_info['visa_service_charge']; ?> 
				    </span>
				</div>
				<div class="col-sm-6 col-xs-12">
				    <?php   
                        $sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_package_info[visa_taxation_id]'"));
                    ?>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_taxation['tax_in_percentage']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$sq_package_info['visa_service_tax_subtotal']; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label>" .$sq_package_info['visa_total_amount'] ?>
	        	    </span>
	        	</div>
			</div>
	       
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		 <div class="profile_box main_block" style="min-height: 141px;">
	         <h3>Insurance Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Company Name <em>:</em></label> ".$sq_package_info['insuarance_company_name']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Amount <em>:</em></label> ".$sq_package_info['insuarance_amount']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>Service Charge <em>:</em></label> ".$sq_package_info['insuarance_service_charge']; ?> 
				    </span>
				</div>
				<?php   
                    $sq_taxation1 = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_package_info[insuarance_taxation_id]'"));
                ?>
				<div class="col-sm-6 col-xs-12">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_taxation1['tax_in_percentage']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()." Amount <em>:</em></label> ".$sq_package_info['insuarance_service_tax_subtotal']; ?> 
	        	    </span>
	        	
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label> ".$sq_package_info['insuarance_total_amount']; ?> 
	        	    </span>
	        	</div>
			</div>	
    	</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 mg_bt_20_xs">
		<div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Tour Amount</h3>
	        <div class="row">
	            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Subtotal <em>:</em></label> ".$sq_package_info['total_hotel_expense']; ?>
	                </span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>Tour Amount <em>:</em></label> ".$sq_package_info['subtotal']; ?> 
				    </span>
				    <?php 
	        	       	$currency_code = $sq_package_info['currency_code'];
	        	    	$sq_currency = mysql_fetch_assoc(mysql_query("select * from currency_name_master where currency_code='$currency_code'")); 
	        	    ?>
				    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Currency <em>:</em></label> ".$sq_currency['currency_name']; ?>
	        	    </span>
				</div>
				<div class="col-sm-6 col-xs-12 right_border_none_sm_xs">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>ROE Amount <em>:</em></label> ".$sq_package_info['rue_cost']; ?> 
	        	    </span>
	        	<?php   
                        $sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_package_info[tour_taxation_id]'"));
                    ?>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_taxation['tax_in_percentage']; ?> 
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Tax Amount <em>:</em></label> ".$sq_package_info['tour_service_tax_subtotal']; ?>
	        	    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Total Amount <em>:</em></label>" .$sq_package_info['tour_cost_total'] ?> 
	        	    </span>
	        	</div>
			</div>	
		</div>
	</div>
  </div>
  <div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		 <div class="profile_box main_block">
	        <h3 class="editor_title">Total Tour Amount</h3>
	        <div class="panel panel-default panel-body app_panel_style">
	        	<div class="row">
		            <div class="col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
		                <span class="main_block">
		                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		                  <?php echo "<label>Visa Amount <em>:</em></label> ".$sq_package_info['visa_total_amount']; ?>
		                </span>
			        	<span class="main_block">
			        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
			        	  <?php echo "<label>Insurance Amount <em>:</em></label> ".$sq_package_info['insuarance_total_amount']; ?>
			        	</span>
			        	<span class="main_block">
					      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
					      <?php echo "<label>Tour Amount <em>:</em></label> ".$sq_package_info['tour_cost_total']; ?> 
					    </span>
					</div>
					<div class="col-sm-6 col-xs-12">
		        	    <span class="main_block">
		        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	      <?php echo "<label>Travel Amount <em>:</em></label> "?><em class="theme_col"><?php echo $sq_package_info['total_travel_expense']; ?></em>
		        	    </span>
		        	    <span class="main_block">
		        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	      <?php echo "<label>Tour Amount <em>:</em></label> "?><em class="theme_col"><?php echo $sq_package_info['actual_tour_expense']; ?> </em>
	        	    	</span>
	       		        <span class="main_block" style="min-width: 161px;height: 28px;border: 1px solid #62dac4;background-color: #52c5c5;color: white;text-align:center;padding-top: 3px;">
		        	      	<?php echo "<label>Booking Amount <em>:</em></label> ".number_format(($sq_package_info['actual_tour_expense'] + $sq_package_info['total_travel_expense']),2); ?>
		        	    </span>
		        	</div>
				</div>
	        </div>
    	</div>
	</div>
</div>