<?php
include "../../../../model/model.php";
$entry_id = $_POST['entry_id'];

$entry_row = mysql_fetch_assoc(mysql_query("select * from vendor_request_vendor_entries where entry_id='$entry_id'"));
?>

<form id="frm_tariff_save">
<div class="modal fade" id="price_save_modal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hotel Tariff</h4>
      </div>
      	<div class="modal-body">     

	            <div class="row mg_bt_20">

	            	<div class="col-md-4 mg_bt_10">

		                <select id="cmb_city_id" name="cmb_city_id" onchange="hotel_name_list_load(this.id)" class="city_master_dropdown" style="width:100%" title="Select City Name">


		                </select>

		            </div>

	            	<div class="col-md-4 mg_bt_10">

		                <select id="hotel_id1" name="hotel_id1" style="width:100%" title="Select Hotel Name">

		                    <option value="">*Select Hotel</option>

		                </select>

		            </div>

	            	<div class="col-md-4 mg_bt_10">

		                <select name="currency_code" id="currency_code1" title="Currency" style="width:100%">

		                <?php 

		                  $sq_currency = mysql_query("select * from currency_name_master order by default_currency desc");

		                  while($row_currency = mysql_fetch_assoc($sq_currency)){

		                    ?>

		                    <option value="<?= $row_currency['id'] ?>"><?= $row_currency['currency_code'] ?></option>

		                    <?php

		                  }

		                  ?>

		                </select>

		            </div>

	            </div>
				
      		<div class="panel panel-default panel-body app_panel_style"> 
      			<div class="row mg_bt_10">

	                <div class="col-md-12 text-right text_center_xs">
						<div class="col-md-6 text-left">
								<input type="button" class="btn btn-sm btnType" onclick="display_format_modal();" value="View CSV">
								<div class="div-upload  mg_bt_20" id="div_upload_button">
										<div id="tariff_csv_upload" class="upload-button1"><span>CSV</span></div>
										<span id="cust_status" ></span>
										<ul id="files" ></ul>
										<input type="hidden" id="txt_cust_csv_upload_dir" name="txt_cust_csv_upload_dir">
								</div>
						</div>

	                    <button type="button" class="btn btn-info btn-sm ico_left" onClick="addRow('table_vendor_pricing')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>

	                    <button type="button" class="btn btn-danger btn-sm ico_left" onClick="deleteRow('table_vendor_pricing')"><i class="fa fa-times"></i>&nbsp;&nbsp;Delete</button>

	                </div>

	            </div> 

	            <div class="row">

	                <div class="col-md-12">

	                    <div class="table-responsive">

	                    <?php $offset = "_u"; 

	                    $count = 1;?>

	                    <table id="table_vendor_pricing" name="table_vendor_pricing" class="table table-bordered no-marg pd_bt_51" style="min-width:1500px">

									 <tr>

									    <td><input class="css-checkbox" id="chk_ticket" type="checkbox" checked><label class="css-label" for="chk_ticket"> </label></td>

									    <td><input maxlength="15" value="<?= $count?>" type="text" name="username" placeholder="Sr. No." class="form-control" disabled /></td>

										<td><select name="room_cat" id="room_cat" style="width:145px;" title="Room Category" class="form-control app_select2"><?php get_room_category_dropdown(); ?></select></td>

									    <td><input type="text" id="from_date" class="form-control" name="from_date" placeholder="Valid From" title="Valid From" onchange="validate_validDate('from_date' , 'to_date');" value="<?= date('d-m-Y') ?>" /></td>

									    <td><input type="text" id="to_date" class="form-control" name="to_date" placeholder="Valid To " title="Valid To" onchange="validate_issueDate('from_date' ,'to_date')" value="<?= date('d-m-Y') ?>" /></td>

									    <td><input type="text" id="single_bed" name="single_bed" placeholder="Single Bed Cost" title="Single Bed Cost" onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="double_bed" name="double_bed" placeholder="Double Bed Cost" title="Double Bed Cost"  onchange="validate_balance(this.id)"/></td>

									    <td><input type="text" id="triple_bed" name="triple_bed" placeholder="Triple Bed Cost" title="Triple Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="quad_bed" name="quad_bed" placeholder="Quad Bed Cost" title="Quad Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="with_bed" name="with_bed" placeholder="Extra Bed Cost" title="Extra Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="queen" name="queen" placeholder="Queen Bed Cost" title="Queen Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="king" name="king" placeholder="King Bed Cost" title="King Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><input type="text" id="twin" name="twin" placeholder="Twin Bed Cost" title="Twin Bed Cost"  onchange="validate_balance(this.id)" /></td>

									    <td><select name="meal_plan" id="meal_plan" style="width: 100%" class="form-control app_select2">

										<?php get_mealplan_dropdown(); ?></td>

									</tr>  

		                    </table>

		                    </div>

		                </div>

		            </div>
	            </div>

	                  		

			<div class="row text-center mg_tp_20">

				<div class="col-md-12">

					<button class="btn btn-sm btn-success" id="btn_price_save"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save</button>

				</div>

			</div>

      	</div>      

    </div>

  </div>

</div>

</form>

<div id="div_tarrif_modal">

</div>

<script src="<?= BASE_URL ?>js/ajaxupload.3.5.js"></script>
<script>
$('#price_save_modal').modal('show');
$('#currency_code1,#meal_plan,#cmb_hotel_id,#room_cat').select2();
$('#to_date,#from_date').datetimepicker({ timepicker:false, format:'d-m-Y' });
$('#check_in,#check_out').datetimepicker({ datepicker:false, format:'H:i A',showMeridian: true });
city_lzloading('#cmb_city_id');
cust_csv_upload();
function cust_csv_upload(){
    var type="hotel_tariff_list";
		var btnUpload=$('#tariff_csv_upload');
    var status=$('#cust_status');
    new AjaxUpload(btnUpload, {
      action: 'tarrif/upload_tariff_csv.php',
      name: 'uploadfile',
      onSubmit: function(file, ext){

         if(!confirm('Do you want to import this file?')){
            return false;
          }

         if (! (ext && /^(csv)$/.test(ext))){ 
                    // extension is not allowed 
          status.text('Only excel sheet files are allowed');
          //return false;
        }
        status.text('Uploading...');
      },
      onComplete: function(file, response){
        //On completion clear the status
        status.text('');
        //Add uploaded file to list
        if(response==="error"){          
          alert("File is not uploaded.");           
          //$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
        } else{
          ///$('<li></li>').appendTo('#files').text(file).addClass('error');
          document.getElementById("txt_cust_csv_upload_dir").value = response;
          status.text('Uploading...');
          cust_csv_save();
          status.text('');
          
        }
      }
    });
}

function cust_csv_save(){
    var cust_csv_dir = document.getElementById("txt_cust_csv_upload_dir").value;
    var base_url = $('#base_url').val();
    $.ajax({
        type:'post',
        url: base_url+'controller/hotel/tariff_csv_save.php',
        data:{cust_csv_dir : cust_csv_dir },
        success:function(result){

            var table = document.getElementById("table_vendor_pricing");
            var pass_arr = JSON.parse(result);
            for(var i=0; i<pass_arr.length; i++){
                var row = table.rows[i]; 
                row.cells[2].childNodes[0].value = pass_arr[i]['room_cat'];
                row.cells[3].childNodes[0].value = pass_arr[i]['from_date'];
                row.cells[4].childNodes[0].value = pass_arr[i]['to_date'];
                row.cells[5].childNodes[0].value = pass_arr[i]['single_bed'];
                row.cells[6].childNodes[0].value = pass_arr[i]['double_bed'];
                row.cells[7].childNodes[0].value = pass_arr[i]['triple_bed'];
                row.cells[8].childNodes[0].value = pass_arr[i]['quad_bed'];
                row.cells[9].childNodes[0].value = pass_arr[i]['extra_bed'];
                row.cells[10].childNodes[0].value = pass_arr[i]['queen_bed'];
                row.cells[11].childNodes[0].value = pass_arr[i]['king_bed'];
                row.cells[12].childNodes[0].value = pass_arr[i]['twin_bed'];
                row.cells[13].childNodes[0].value = pass_arr[i]['meal_plan'];

                if(i!=pass_arr.length-1){
                    if(table.rows[i+1]==undefined){
                        addRow('table_vendor_pricing');
                    }
                }
            $(row.cells[13].childNodes[0]).trigger('change');

            }
        }
    });
}

function display_format_modal(){
    var base_url = $('#base_url').val();
    window.location = base_url+"images/csv_format/hotel_tariff_import.csv";
}


//**Hotel Name load start**//

function hotel_name_list_load(id){
  var city_id = $("#"+id).val();
  $.get( "tarrif/hotel_name_load.php" , { city_id : city_id } , function ( data ) {
        $ ("#hotel_id1").html( data );
  });
}

$('#frm_tariff_save').validate({
	rules:{ 
	},
	submitHandler:function(form){

		var base_url = $('#base_url').val();
		var city_id = $('#cmb_city_id').val();
		var hotel_id = $('#hotel_id1').val();
		var currency_code = $('#currency_code1').val();

		var from_date_arr = new Array();
		var to_date_arr = new Array();		
		var single_bed_arr = new Array();		
		var double_bed_arr = new Array();
		var triple_bed_arr = new Array();
		var quad_bed_arr = new Array();
		var with_bed_arr = new Array();
		var without_bed_arr = new Array();
		var queen_arr = new Array();
		var king_arr = new Array();
		var twin_arr = new Array();
		var meal_plan_arr = new Array();

		if(hotel_id == ''){
			error_msg_alert("Select Hotel!");
			return false;
		}

		var table = document.getElementById("table_vendor_pricing");
		var rowCount = table.rows.length;
        for(var i=0; i<rowCount; i++){
          var row = table.rows[i];
          if(row.cells[0].childNodes[0].checked){

			  var without_bed_cost = row.cells[2].childNodes[0].value;	
			  var from_date = row.cells[3].childNodes[0].value;
			  var to_date = row.cells[4].childNodes[0].value;		
			  var single_bed_cost = row.cells[5].childNodes[0].value;
			  var double_bed_cost = row.cells[6].childNodes[0].value;	
			  var triple_bed_cost = row.cells[7].childNodes[0].value;	
			  var quad_bed_cost = row.cells[8].childNodes[0].value;
			  var with_bed_cost = row.cells[9].childNodes[0].value;	
			  var queen = row.cells[10].childNodes[0].value;			
			  var king = row.cells[11].childNodes[0].value;		
			  var twin = row.cells[12].childNodes[0].value;		
			  var meal_plan = row.cells[13].childNodes[0].value;		

  		      if(row.cells[14]){
			  	var entry_id = row.cells[9].childNodes[0].value;	
			  }
			  else{
			  	var entry_id = "";
			  }

			  without_bed_arr.push(without_bed_cost);
			  from_date_arr.push(from_date);
			  to_date_arr.push(to_date);
			  single_bed_arr.push(single_bed_cost);
			  double_bed_arr.push(double_bed_cost); 
			  triple_bed_arr.push(triple_bed_cost); 
			  quad_bed_arr.push(quad_bed_cost); 
			  with_bed_arr.push(with_bed_cost); 
			  queen_arr.push(queen);
			  king_arr.push(king);
			  twin_arr.push(twin);
			  meal_plan_arr.push(meal_plan);
          }
        }

		$('#btn_price_save').button('loading');
		$.ajax({
			type:'post',
			url: base_url+'controller/vendor/hotel_pricing/vendor_price_save.php',
			data:{ city_id : city_id,hotel_id : hotel_id,from_date_arr : from_date_arr, to_date_arr : to_date_arr, single_bed_arr : single_bed_arr, double_bed_arr : double_bed_arr, triple_bed_arr : triple_bed_arr, with_bed_arr: with_bed_arr,without_bed_arr : without_bed_arr,currency_code : currency_code, quad_bed_arr : quad_bed_arr,queen_arr : queen_arr, king_arr : king_arr, twin_arr : twin_arr, meal_plan_arr : meal_plan_arr},
			success:function(result){
				msg_alert(result);
				$('#btn_price_save').button('reset');
				$('#price_save_modal').modal('hide');
				$('#price_save_modal').on('hidden.bs.modal', function(){
					vendor_price_list_reflect();
				});
			}
		});
	}
});
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>