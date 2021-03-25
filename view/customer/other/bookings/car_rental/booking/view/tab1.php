<div class="row">
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="profile_box main_block">
        	 	<h3>Customer Details</h3>
        		<?php $sq_customer = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$sq_booking[customer_id]'")); ?>
				<span class="main_block"> 
				    <i class="fa fa-user-o" aria-hidden="true"></i>
				    <?php echo $sq_customer['first_name'].' '.$sq_customer['middle_name'].' '.$sq_customer['last_name'].'&nbsp'.'('.get_car_rental_booking_id($booking_id,$year).')'; ?>
				</span>
				<?php  
		        	  if($sq_customer['type'] == 'Corporate'){
		        	?>
        	 		<span class="main_block">
		                  <i class="fa fa-building-o" aria-hidden="true"></i>
		                  <?php echo $sq_customer['company_name'] ?>
		            </span>
		            <?php  } ?>
				<span class="main_block">
				    <i class="fa fa-envelope-o" aria-hidden="true"></i>
				    <?php echo $sq_customer['email_id']; ?>
				</span>	
				<span class="main_block">
				    <i class="fa fa-phone" aria-hidden="true"></i>
				    <?php echo $sq_customer['contact_no']; ?> 
				</span>			        	
	    </div> 
	</div>
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="profile_box main_block">
        	 	<h3>Costing Details</h3>     
        	 	<div class="col-sm-6 col-xs-12">   	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Daily Min Avg <em>:</em></label> ".$sq_booking['daily_min_average'];?> 
	        		</span>        	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Rate Per Km <em>:</em></label> ".$sq_booking['rate_per_km'];?> 
	        		</span>        	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Extra Km <em>:</em></label> ".$sq_booking['extra_km'];?> 
	        		</span>        	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Total Amount <em>:</em></label> ".$sq_booking['km_total_fee'];?> 
	        		</span>        	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Basic Amount <em>:</em></label> ".$sq_booking['actual_cost'];?> 
	        		</span>        	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_booking['service_tax'];?> 
	        		</span>  
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Tax Amount <em>:</em></label> ".$sq_booking['service_tax_subtotal'];?> 
	        		</span> 
	        	</div>    	 	
	        	<div class="col-sm-6 col-xs-12">           	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Driver Allowance <em>:</em></label> ".$sq_booking['driver_allowance'];?> 
	        		</span>           	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Permit Charges <em>:</em></label> ".$sq_booking['permit_charges'];?> 
	        		</span>           	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Toll & Parking <em>:</em></label> ".$sq_booking['toll_and_parking'];?> 
	        		</span>           	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>State Entry Tax <em>:</em></label> ".$sq_booking['state_entry_tax'];?> 
	        		</span>               	 	
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Total <em>:</em></label> ".$sq_booking['total_fees'];?> 
	        		</span> 
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Due Date <em>:</em></label> ".get_date_user($sq_booking['due_date']);?> 
	        		</span>
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Booking Date <em>:</em></label> ".get_date_user($sq_booking['created_at']);?> 
	        		</span>
				</div>	        		

        </div>
    </div>
</div>
<div class="row">    
  	<div class="col-xs-12">
  		<div class="profile_box main_block" style="margin-top: 25px">
           	<h3 class="editor_title">Vehicle Details</h3>
                <div class="table-responsive">
                    <table id="tbl_dynamic_visa_update" name="tbl_dynamic_visa_update" class="table table-bordered no-marg">
                     <thead>
                       <tr class="table-heading-row">
                       	<th>S_No.</th>
                       	<th>Vehicle_Name</th>
                       	<th>Vehicle_No</th>
                       	<th>Driver_Name</th>
                       	<th>Mobile_No</th>
                       	<th>Type</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php 
                        $count = 1;
                       $sq_vehicle_entries = mysql_query("select * from car_rental_booking_vehicle_entries where booking_id='$booking_id'");
					   while($row_vehicle = mysql_fetch_assoc($sq_vehicle_entries)){				   	
					   	
						$sq_vehicle = mysql_fetch_assoc(mysql_query("select * from car_rental_vendor_vehicle_entries where vehicle_id='$row_vehicle[vehicle_id]'"));
                       			?>
								 <tr>
								    <td><?php echo $count; ?></td>
								    <td><?php echo$sq_vehicle['vehicle_name']; ?></td>
								    <td><?= $sq_vehicle['vehicle_no'] ?></td>
									<td><?php echo $sq_vehicle['vehicle_driver_name']; ?></td>
								    <td><?php echo $sq_vehicle['vehicle_mobile_no']; ?></td>
								    <td><?php echo $sq_vehicle['vehicle_type']; ?></td>
								</tr>   
                       			<?php
                       			$count++;
                       }
                       ?>
                     </tbody>
                    </table>
                </div>
                
        </div>  
    </div>
</div>   
           