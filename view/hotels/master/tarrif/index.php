<?php 

include "../../../../model/model.php";

?>

<div class="row text-right">

    <div class="col-xs-12 mg_bt_20">

        <button class="btn btn-info btn-sm ico_left" id="btn_save_modal" onclick="vendor_price_save_modal()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tariff</button>

    </div>

</div>



<div class="app_panel_content Filter-panel">

    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">

            <select id="city_id_filter" name="city_id_filter" onchange="hotel_name_list_load(this.id);vendor_price_list_reflect();" class="form-control" style="width:100%" title="Select City Name" onchange="list_reflect()">


            </select>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">

            <select id="hotel_id_filter" name="hotel_id_filter" style="width:100%" onchange="vendor_price_list_reflect();" title="Select Hotel Name" class="form-control">

                <option value="">Select Hotel</option>

            </select>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">

            <input type="text" placeholder="From date" title="From Date" onchange="vendor_price_list_reflect();" class="form-control" id="from_date_filter"/>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">

            <input type="text" placeholder="To date" title="To Date" onchange="vendor_price_list_reflect();" class="form-control" id="to_date_filter"/>

        </div>

    </div>

</div>

<div id="div_request_list" class="main_block loader_parent mg_tp_20">
    <div class="table-responsive">
        <table id="hotel_tariff" class="table table-hover" style="margin: 20px 0 !important;">         
        </table>
    </div>
</div>

<div id="div_bid_modal"></div>



<script>

$('#tbl_req_list').dataTable();

$('#hotel_id_filter').select2();

$('#from_date_filter,#to_date_filter').datetimepicker({ timepicker:false, format:'d-m-Y' });
city_lzloading('#city_id_filter');

var columns =  [
    { title: "S_NO" },
    { title: "Hotel" },
    { title: "Room_Category" },
    { title: "Valid_From" },
    { title: "Valid_To" },
    { title: "Single_Bed" },
    { title: "Double_Bed" },
    { title: "Triple_Bed" },
    { title: "Extra_Bed" },
    { title: "Meal_Plan" },
    { title: "&nbsp;&nbsp;&nbsp;Actions", className:"text-center" }
    ];
function vendor_price_list_reflect()

{
    $('#div_request_list').append('<div class="loader"></div>');
	var city_id = $('#city_id_filter').val();

	var hotel_id = $('#hotel_id_filter').val();

	var from_date = $('#from_date_filter').val();

	var to_date = $('#to_date_filter').val();



	// $.post('tarrif/vendor_price_list_reflect.php', {hotel_id : hotel_id, city_id : city_id, from_date : from_date , to_date : to_date }, function(data){

	// 	$('#div_request_list').html(data);

    // });
    $.post('tarrif/vendor_price_list_reflect.php', {hotel_id : hotel_id, city_id : city_id, from_date:from_date, to_date:to_date}, function(data){
        setTimeout(() => {
        pagination_load(data,columns, false,false, 20, 'hotel_tariff') // third parameter is for bg color show yes or 
        $('.loader').remove();
        }, 1000);
    });

}
vendor_price_list_reflect();

function vendor_price_edit_modal(entry_id)

{

	$.post('tarrif/vendor_price_edit.php', { entry_id : entry_id }, function(data){

		$('#div_bid_modal').html(data);

	});

}

function vendor_price_save_modal()

{

	$.post('tarrif/vendor_price_save.php', {  }, function(data){

		$('#div_bid_modal').html(data);

	});

}

//**Hotel Name load start**//

function hotel_name_list_load(id)

{

  var city_id = $("#"+id).val();



  $.get( "tarrif/hotel_name_load.php" , { city_id : city_id } , function ( data ) {



        $ ("#hotel_id_filter").html( data ) ;                            

  } ) ;   
}
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>