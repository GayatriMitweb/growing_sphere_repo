<div class="row">
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="profile_box main_block">
        	 	<h3>Customer Details</h3>
        		<?php $sq_customer = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$sq_visa_info[customer_id]'")); ?>
				<span class="main_block"> 
				    <i class="fa fa-user-o" aria-hidden="true"></i>
				    <?php echo $sq_customer['first_name'].' '.$sq_customer['middle_name'].' '.$sq_customer['last_name'].'&nbsp'.'('.get_visa_booking_id($visa_id,$year).')'; ?>
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
		 <div class="profile_box main_block" style="min-height: 141px;">
	        <h3>Costing Details</h3>
            <?php 
	            $sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$sq_visa_info[taxation_id]'"));
	            $sq_tax_type = mysql_fetch_assoc(mysql_query("select * from tax_type_master where tax_type_id='$sq_taxation[tax_type_id]'"));          ?>
	        <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-12 right_border_none_sm_xs" style="border-right: 1px solid #ddd">
	                <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Basic Amount <em>:</em></label> ".$sq_visa_info['visa_issue_amount']; ?>
	                </span>
		        	<span class="main_block">
		        	  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		        	  <?php echo "<label>Service charge <em>:</em></label> ".$sq_visa_info['service_charge']; ?>
		        	</span>
				    <span class="main_block">
				      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
				      <?php echo "<label>".get_tax_name()."(%) <em>:</em></label> ".$sq_visa_info['service_tax']; ?> 
				    </span>
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <?php echo "<label>Tax Amount <em>:</em></label> ".$sq_visa_info['service_tax_subtotal']; ?>
	        	    </span>
				 </div>
				 <div class="col-md-6 col-sm-6 col-xs-12">
	        	    <span class="main_block">
	        	      <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        	      <div class='highlighted_cost'> <?php echo "<label>Net Total  <em>:</em></label> ".$sq_visa_info['visa_total_cost']; ?></div>
	        	    </span>
	        		<span class="main_block">
	        		  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	        		  <?php echo "<label>Due Date <em>:</em></label> ".get_date_user($sq_visa_info['due_date']);?> 
	        		</span>
					<span class="main_block">
		              <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
		              <?php echo "<label>Booking Date <em>:</em></label> ".date('d-m-Y',strtotime($sq_visa_info['created_at'])); ?>
		            </span>
	        	 </div>
	        	</div>
			</div>
    </div>
</div>
<div class="row">    
  	<div class="col-xs-12">
  		<div class="profile_box main_block" style="margin-top: 25px">
           	<h3 class="editor_title">Passenger Details</h3>
                <div class="table-responsive">
                    <table id="tbl_dynamic_visa_update" name="tbl_dynamic_visa_update" class="table table-bordered no-marg">
                     <thead>
                       <tr class="table-heading-row">
                       	<th>S_No.</th>
                       	<th>Name</th>
                       	<th>Date_Of_Birth</th>
                       	<th>Adol</th>
                       	<th>Visa_country</th>
                       	<th>Visa_Type</th>
                       	<th>Passport_Id</th>
                       	<th>Issue_Date</th>
                       	<th>Expire_Date</th>
                       	<th>Nationality</th>
                       	<th>Documents</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php 
                       $offset = "_u";
                       $sq_entry_count = mysql_num_rows(mysql_query("select * from visa_master_entries where visa_id='$visa_id'"));
                       if($sq_entry_count==0){
                       		include_once('visa_member_tbl.php');	
                       }
                       else{
                       		$count = 0;
                       		$sq_entry = mysql_query("select * from visa_master_entries where visa_id='$visa_id'");
                            $bg="";
                       		while($row_entry = mysql_fetch_assoc($sq_entry)){
                       			if($row_entry['status']=="Cancel")
                       			{
                       				$bg="danger";
                       			}
                       			else
                       			{
                       				$bg="#fff";
                       			}
                       			$count++;
                       			?>
								 <tr class="<?php echo $bg; ?>">
								    <td><?php echo $count; ?></td>
								    <td><?php echo $row_entry['first_name']." ".$row_entry['last_name']; ?></td>
								    <td><?= get_date_user($row_entry['birth_date']) ?></td>
									<td><?php echo $row_entry['adolescence']; ?></td>
								    <td><?php echo $row_entry['visa_country_name']; ?></td>
								    <td><?php echo $row_entry['visa_type']; ?></td>
								    <td><?php echo $row_entry['passport_id']; ?> </td>
								    <td><?php echo get_date_user($row_entry['issue_date']); ?></td>
								    <td><?php echo get_date_user($row_entry['expiry_date']); ?></td>
								    <td><?php echo $row_entry['nationality']; ?></td>
								    <td>
								    	<?php echo $row_entry['received_documents'];  ?>
								    </td>
								</tr>  
								<script>
									$("#birth_date<?= $offset.$count ?>_d, #expiry_date<?= $offset ?>1").datetimepicker({ timepicker:false, format:'d-m-Y' });
								</script>      
                       			<?php

                       		}

                       }
                       ?>
                     </tbody>
                    </table>
                </div>
                
        </div>  
    </div>
</div>  
           