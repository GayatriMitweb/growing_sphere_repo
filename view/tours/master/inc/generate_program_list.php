<?php
include '../../../../model/model.php';
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$daysLeft = abs(strtotime($from_date) - strtotime($to_date));
$days = $daysLeft/(60 * 60 * 24);
?>
<div class="panel panel-default panel-body app_panel_style feildset-panel mg_tp_30">
<legend>Tour Itinerary</legend>
<table id="dynamic_table_list_group" style="width:100%" name="dynamic_table_list_group">

<?php 
	for($i = 0; $i<=$days; $i++) { 
?>

		<tr>
			<td class='col-md-1 pad_8'><input type="text" id="day" name="day" class="form-control mg_bt_10" placeholder="Day <?php echo $i+1; ?>" title="Day" value="" disabled> </td>

			<td class='col-md-2 pad_8'><input type="text" id="special_attaraction<?php echo $i+1; ?>" name="special_attaraction" class="form-control mg_bt_10" placeholder="*Special Attraction" onchange="validate_spaces(this.id);validate_spattration(this.id);" title="Special Attraction" value=""> 

	  		</td> 

			<td class='col-md-6 pad_8' style="max-width: 594px;overflow: hidden;"><textarea id="day_program<?php echo $i; ?>" name="day_program" class="form-control mg_bt_10"  onchange="validate_spaces(this.id);validate_dayprogram(this.id);" placeholder="*Day<?php echo $i+1;?> Program" title="Day-wise Program" rows="3" value=""></textarea>

	  		</td>

	  		<td class='col-md-2 pad_8'><input type="text" id="overnight_stay<?php echo $i+1; ?>" name="overnight_stay" class="form-control mg_bt_10" placeholder="*Overnight Stay" onchange="validate_spaces(this.id);validate_onstay(this.id);" title="Overnight Stay"  value=""> 

	  		</td>
	  		<td class='col-md-1 pad_8'><select id="meal_plan<?php echo $i+1; ?>" title="Meal Plan" name="meal_plan" class="form-control">
          <?php get_mealplan_dropdown(); ?>
	  		           </select>
	  		</td>
	  	</tr>

<?php } ?>	

</table>
</div>
<script>

// function upload_user_pic_attch()
// {
//     var btnUpload=$('#photo_upload_btn_p');
//     $(btnUpload).find('span').text('Upload Itinerary');
//     $("#photo_upload_url_i").val('');

//     new AjaxUpload(btnUpload, {
//       action: 'inc/upload_pdf.php',
//       name: 'uploadfile',
//       onSubmit: function(file, ext)
//       {  
//         if (! (ext && /^(pdf)$/.test(ext))){ 
//          error_msg_alert('Only PDF files are allowed');

//          return false;

//         }

//         $(btnUpload).find('span').text('Uploading...');

//       },

//       onComplete: function(file, response){
      	
//         if(response==="error"){          

//           error_msg_alert("File is not uploaded.");           

//           $(btnUpload).find('span').text('Upload');

//         }else

//         { 

//           $(btnUpload).find('span').text('Uploaded');

//           $("#photo_upload_url_i").val(response);

//         }

//       }

//     });

// }
// upload_user_pic_attch();
</script>