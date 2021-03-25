<form id="frm_tour_master_save"> 

        <h3 class="editor_title">Costing Details</h3>
        <div class="panel panel-default panel-body app_panel_style">
            <div class="row text-center">   

                <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="txt_tour_cost" name="txt_tour_cost" onchange="validate_balance(this.id)" class="form-control" placeholder="*Adult Cost" title="Adult Cost"  maxlength="10"/>

                </div>

                <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="txt_child_with_cost" name="txt_child_with_cost" onchange="validate_balance(this.id)" class="form-control"  placeholder="*CWB Cost" title="CWB Cost" maxlength="10" />

                </div>
                <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="txt_child_without_cost" name="txt_child_without_cost" onchange="validate_balance(this.id)" class="form-control"  placeholder="CWOB Cost" title="CWOB Cost" maxlength="10" />

                </div>                         

                <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="txt_infant_cost" name="txt_infant_cost" onchange="validate_balance(this.id)" class="form-control"  placeholder="*Infant Cost" title="Infant Cost" maxlength="10" />

                </div>  

                    

            </div>
            <div class="row mg_tp_10 text-center"> 

            <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                <input type="text" id="with_bed_cost" onchange="validate_balance(this.id)" name="with_bed_cost" placeholder="*Extra bed cost" title="Extra bed cost">

            </div>  
                <!-- <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="visa_country_name1" pattern="[A-Za-z]" name="visa_country_name1" placeholder="Visa Country Name" title="Visa Country Name">

                </div> 

                <div class="col-md-3 col-sm-6 mg_bt_10_xs"> 

                    <input type="text" id="company_name1" name="company_name1" placeholder="Insurance Company Name" title="Insurance Company" >

                </div> -->

            </div>
        </div>
              

    

        



        <div class="row mg_tp_20">                         

            <div class="col-md-6 col-sm-6 mg_bt_10_sm_xs">
                <h3 class="editor_title">Inclusions</h3>
                <textarea class="feature_editor" id="inclusions" name="inclusions" placeholder="*Inclusions" title="Inclusions" rows="4"></textarea>

            </div>      

            <div class="col-md-6 col-sm-6"> 
                <h3 class="editor_title">Exclusions</h3>
                <textarea class="feature_editor" id="exclusions" name="exclusions" class="form-control"  placeholder="*Exclusions" title="Exclusions" rows="4"></textarea>

            </div>   

        </div>



        <div class="row mg_bt_10 mg_tp_20 text-center">

          <button class="btn btn-info btn-sm ico_left" type="button" onclick="switch_to_tab3()"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Previous</button>

      &nbsp;&nbsp;

                <button class="btn btn-sm btn-success" id="btn_save" ><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Save</button>

        </div>

</form>



<script>

function switch_to_tab3(){ $('a[href="#tab3"]').tab('show'); }

</script>