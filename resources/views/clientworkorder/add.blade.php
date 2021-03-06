@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>



<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.box-section 
	{ 
		border:#eee thin solid;margin:7px 0px; 
	}
	
.labour-box 
	{ 
		 padding:1px 15px; 
	}
.cost-box 
	{ 
		border:#eee thin solid; margin-top:5px;
	}

.sel-opt-part
	{
		border:thin #ede solid;
		width:102%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:0px -4% 0px -2%;
	}	

.sel-opt
	{
		border:thin #ede solid;
		width:99%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:95%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:95%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 1.5% auto 1%;
	}

.inp
	{
		border:thin #ede solid;
		width:98%;	padding:10px 5px;	
		border-radius:2px;
		margin:auto -2% auto 2%;
		color:#999;
	}

label 
	{
		color:#666;
	}
.label-left
	{
		color:#666; margin:auto 2% auto 4%;
	}
.label-right
	{
		color:#666; margin:auto 1.5% auto 1%;
	}
.tab-top-bottom
	{
		height:15px;
	}
.costtd
	{
		vertical-align:top; text-align:left;
	}
.part-div
	{
		margin:15px 0px;
	}
.btn-circle 
	{
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
.btn-circle-red
	{
	  width: 20px;
	  height: 20px;
	  text-align: center;
	  padding: 1px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:transparent;
	  border:#E34234 thin solid;
	  color:#E34234;
	}
.btn-circle-red:hover
	{
	  width: 20px;
	  height: 20px;
	  text-align: center;
	  padding: 1px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:#E34234;
	  color:#fff;
	}
.btn-circle-green
	{
	  width: 30px;
	  height: 25px;
	  text-align: center;
	  padding: 4px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:#396;
	  color:#fff;
	}
.right-card-view
	{
		padding:1px 25px 1px 10px; margin-top:-30px;
	}
.white-card
	{
		margin:-15px -20px 0px 6px;
	}
.grey-card
	{
		padding:1px 5px;  margin:0px -20px 0px -25px;
	}
.action-link
	{
		color:blue; text-decoration:none;
	}
</style>





<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="forms-basic">
           <div class="page-header">
	  <h1>      <i class="fa fa-wrench"></i>  Quote     </h1>
	  
	  <p class="lead"> 
        DREAM's quote management module gives you the flexibility you need to effectively manage any type of vehicle asset related repair, 
<br> or work activity. This module offers a single familiar tool for scheduling, managing and collecting data for all work activities. </p>
	</div>
            
			
		<!-- right content -->
        <div class="col-md-3 col-md-push-9 left-side" style="margin:-60px -20px 0px 10px; background-color:#F9F9F9">
        <div class="pull-right" style="margin:-25px -20px 0px 0px">
          <ul class="list-unstyled">
            <li class="dropdown">
              <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
            </li>
          </ul>
        </div>
        
          <div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
          <div class="well white white-card" style="margin-top:0px"> 				 
          <center> <img src="{{URL::asset('assets/img/invoice.jpg')}}" class="img-responsive" height="150" width="150"> </center>
              
          </div>  	
          
          
              <!-- quick report div  -->

              

              <!-- quick information div  -->
              <div class="grey-card">
              <div style="margin:-10px 15px 0px 10px">
                  <?php //$this->element('insight'); ?> 
              </div>
              </div>
          
        </div>

              
			  
           <!-- left content -->
              <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
			  <div> 
              <form method="post" action="{{route('clientworkorder.insert')}}" role="form">
		<fieldset>
		<?php 
			$total_WO = DB::table('clientworkorder')->distinct()->get(['WorkOrderNumber'])->count();  ++$total_WO; 
        ?>
		  <legend>Quote Number : #0000 @if($total_WO) <?= $total_WO ?>@endif </legend> 
		  
		  
		  <div class="form-group">
					<input type ='hidden' name="WorkOrderNumber" id="" class='form-control' placeholder='WorkOrder No' @if($total_WO) value="{{$total_WO}}"@endif Required readonly />
		  </div> 
				
				
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
        @if(count($errors) > 0)
            @foreach($errors->all() as $errors)
                <div class="alert alert-danger"> {{ $errors }} </div>
            @endforeach
        @endif
		<CAPTION>Quote Details</CAPTION>
			<tr class="box-section">
				<td width="100%" colspan="2">
					<div class="form-group col-md-12">	  
						<label for="ClientId" class="control-label" ><i class="fa fa-female"></i> Client </label>
						<select class='sel-opt' name='ClientId' id='ClientId' required style="width:100%">
						   <option value="">Select Client</option>
						   @if($clients)
						   @foreach ($clients as $clients)
                                <option value="{{{ $clients->ClientId }}}"> {{ $clients->FirstName.' '.$clients->LastName }} </option>
                            @endforeach
							@endif
						</select>
					</div>
				</td>
			</tr>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
				<label for="ServiceDate" class="control-label label-left"><i class="fa fa-calendar"></i> Service Start Date</label>
					<input type='text' id='ServiceDate' class="datepicker" name='ServiceDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" maxlenght="10" required/> 	
				</div>
							  
				<div class="form-group">
				  <label for="MaintenanceType" class="control-label label-left"><i class="fa fa-cogs"></i> Maintenance Type</label>
					 <select class='sel-opt-left' name='MaintenanceType' id='MaintenanceType' required>
					   <option value="">Select Maintenance Type</option>
                       @if($maintenances)
					    @foreach ($maintenances as $maintenances)
                            <option value="{{{ $maintenances->MaintenanceType }}}"> {{ $maintenances->MaintenanceType }} </option>
                        @endforeach
						@endif
				</select>
				</div>							
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
						<label for="ServiceCompletionDate" class="control-label label-right"><i class="fa fa-calendar"></i> Service Completion Date</label>  
							<input type='text' id='ServiceCompletionDate' name='ServiceCompletionDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:95%;	padding:5px;	border-radius:2px;margin:auto 1.5% auto 1%; color:#999" maxlenght="10" required/> 	
					</div>
								
					<div class="form-group">	  
					  <div class="controls">
					  <label for="WorkOrderStatus" class="control-label label-right"><i class="fa fa-book"></i> Work Order Status</label>  
						 <select class='sel-opt-right' name='WorkOrderStatusId' id='WorkOrderStatusId' required>
						   <option value="">Select Status</option>
						   @if($workorderstatus)
						   @foreach ($workorderstatus as $workorderstatus)
                                <option value="{{{ $workorderstatus->WorkOrderStatusId }}}"> {{ $workorderstatus->WorkOrderStatus }} </option>
                            @endforeach
							@endif
						</select>
					</div>							
				</div>
				</td>
			</tr>
			
			<tr class="lead" style="text-align:left; margin-left:-15px">
				<td > Vehicle Details </td>
				<td>  </td>
			</tr>
			

			<tr class="box-section">
				<td> 
					<div class="form-group">	  
					  <div class="controls">
					  <label for="AssetId" class="control-label label-left"><i class="fa fa-car"></i> Vehicle License Plate Number</label>
						 <select class='sel-opt-left' name='AssetId' id='AssetId' required>
						  <option class='opt' value=''>License Plate \ Make \ Model</option> 
														
						</select>
					</div>
					</div>
				</td>
				<td> 
					<div class="form-group">
						<label for="OdometerReading" class="control-label label-right"><i class="fa fa-road"></i> Odometer Reading</label>  
						<input type="number" name="OdometerReading" id="OdometerReading" style="border:thin #ede solid;	width:95%;	padding:5px;	border-radius:2px;margin:auto 1.5% auto 1%; color:#999" required> 
					</div>
				</td>
			</tr>
			
			<tr>
				<td>  </td>
				<td>  </td>
			</tr>
		</table>  
				
		<input type="hidden" name="AAId" id="AAId" value="">   <input type="hidden" name="shopemail" id="shopemail" value="">
		
		<!-- part sections -->
		<legend>Parts & Labour</legend>
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_part" style="">
		<i class="lead">Part Items</i> <br>
		
		

		
			
		</table>
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addPartBtn" type="button" id="addPartBtn" class="btn btn-circle">+</button>  <i> Add Part </i>  </td></tr>
		</table>
			   
				<!-- *#*#*##*#*#**#*#*#*#*#####################################********************** -->
				

		
			
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_labour" style="">
		<i class="lead">Labour </i>	<br>
		
			
			
		</table>
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addLabourBtn" type="button" id="addLabourBtn" class="btn btn-circle">+</button>  <i> Add Labour </i>  </td></tr>
		</table>
		
		<legend>Others Details</legend>
		<table class="table" cellspacing="1" width="101%" border="0" style="">
		
		<tr class=""> <td> <h4>Total </h4></td> <td></td> </tr>
		<tr style="background-color:#f9f9f9; width:104%">
			<td width="70%"  style="height:45px;"> 					
			</td>
			
			<td width="30%" style=" text-align:left;"> 
				<div class="form-group">
				<label for="TotalCost" class="control-label" > VAT incl &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-usd"></i> Total Cost : </label> <span id="TCost"> </span>		
					<input type="number" name="TotalCost" id="TotalCost" value="0" style="border:thin #ede solid;	width:89%;	padding:10px 5px;	border-radius:2px;margin:auto 2%; color:#999"  list="tcost" ><!-- 
					<datalist id="tcost">


					</datalist> -->
				</div>
			</td>
			
		</tr>

		
			<tr id=""  class="">
				<td width="100%"  class="box-section labour-box" colspan="2"> 
					<div class="form-group labour-box">	  
							<label for="Comment" class="control-label" ><i class="fa fa-pencil"></i> Comment</label>
								<textarea name="Comment" id="Comment" onkeyup="convert_comm()" placeholder="Comment" style="border:thin #ede solid;	width:100%;	padding:5px;	border-radius:2px;margin:auto 0% auto 0%; color:#999"></textarea>					</div>				
				</td>
				
			</tr>
		
			<tr class="lead"> <td>  </td> <td></td> </tr>	
			<tr id=""  class="box-section">
				<td width="100%"  class="" colspan="2"> 
					<div class="form-group col-md-6">	  
						 <label for="ServiceReminder"> Reset Service Reminder </label>
							<div class="radio" style="margin-left:15px">
								<div class="col-md-3">  
										  <input type="radio" name="ServiceReminder" value="1" id="ServiceReminder_0" />&nbsp; Yes  
								</div>
								<div class="col-md-3">  
								  <input type="radio" name="ServiceReminder" value="0" id="ServiceReminder_1" checked/>&nbsp; No
								</div>
							</div>
					</div>
					
					<div class="form-group col-md-6">	  
					</div>
				</td>
			</tr>
		
		
		</table>	

		
	
						  
				<div class="form-group">
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
				</div>
				
			  
			  
			  
				
			  <div class="form-group">
				<button type="submit" class="btn btn-primary">Create Quote</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			  </div>
			</fieldset>
			
		  </form>
		 </div>
                
          </div> 

            
           
              
            
          </section>
        </div>

		
		

		
<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_comm() 
	{
		var str = document.getElementById('Comment').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Comment').value = cap;
	}
</script>

<!-- DATE TIME PICKERS --> 
<script type="text/javascript">
    $(function () {
      
        $('#ServiceCompletionDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ServiceDate").on("dp.change", function (e) {
            $('#ServiceCompletionDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ServiceCompletionDate").on("dp.change", function (e) {
            $('#ServiceDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>



<!--script for dublicating form -->
<script>
    $(document).ready(function ()
	{		
		//for Part
		var i = 0;		var c = 0;
        $('#addPartBtn').on('click', function () 			//
		{
            i++;  
			$('#dynamic_part').append(
			'<tr id="row'+i+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-4"> <div class="controls" >		  <label for="InvCatId'+i+'" class="control-label"> <i class="fa fa-list"></i> Part Category</label>		<select class="sel-opt" name="InvCatId'+i+'" id="InvCatId'+i+'">			<option value=""> Select Part Category </option>	</select> </div>  </div><div class="form-group col-md-8">				<div class="controls" > <label for="InvId'+i+'" class="control-label" > <i class="fa fa-list"></i>Item Name </label>		<select class="sel-opt-part" name="InvId'+i+'" id="InvId'+i+'">	<option value="">Select Part</option>  </select>	  </div>  <input type="hidden" name="count" id="count" value="'+i+'" class="form-control">		</div>			</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="PartCost'+i+'" class="control-label" > <i class="fa fa-usd"></i> Cost : <span id="pl"> </span></label>  <br>							<input type="number" name="PartCost'+i+'" id="PartCost'+i+'" class="pcost" value="0" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:98%;	padding:5px;	border-radius:2px;margin:auto 2px; color:#999"> 		</div>			</td><td width="2%" style="vertical-align:middle; border: none;"><button type="button" name="remove" id="'+i+'" class="btn btn-circle-red btn_remove" style="">X</button> </td>		</tr>'						
		);
			getVendor(i);
        });
		
		//Function To load all labour Description
		//getLabour();
		
		
		$(document).on('click', '.btn_remove', function ()
		{
			var button_id = $(this).attr("id");
			$('#row'+button_id+"").remove();
			
			//reducing the count value
			document.getElementById('count').value = --i;
			
			//WHEN PARTS IS UPDATED
			//re-calculating the total amount			
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost); 
			document.getElementById("TotalCost").value = parseInt(total_cost);  
		});
			
    });
	
	
	$(document).ready(function ()
	{		
		//for labour
		var c = 0;
        $('#addLabourBtn').on('click', function () 			//
		{
            c++;
			$('#dynamic_labour').append(
			'<tr id="rows'+c+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-12"> <div class="controls">		  <label for="LabourId'+c+'" class="control-label"> <i class="fa fa-list"></i> Labour Description</label> 	<select class="sel-opt" name="LabourId'+c+'" id="LabourId'+c+'" style="width:100%"><option class="option" value=""> Select Labour Description </option>   </select> </div>   <input type="hidden" name="ct" id="ct" value="'+c+'" class="form-control"> </div>		</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="LabourCost'+c+'" class="control-label" > <i class="fa fa-usd"></i> Cost</label>  <br>							<input type="number" name="LabourCost'+c+'" id="LabourCost'+c+'" class="lcost" value="0" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:98%;	padding:5px;	border-radius:2px;margin:auto 2px; color:#999"> 		</div>			</td><td width="2%" style="vertical-align:middle; text-align:left; border: none;"> <button type="button" name="delete" id="'+c+'" class="btn btn-circle-red btn_delete">X</button></td>		</tr>'						
		);
			getLabour(c);	 
        });
		
		//Function To load all labour Description
		
		
		$(document).on('click', '.btn_delete', function ()
		{
			var button_id = $(this).attr("id");
			$('#rows'+button_id+"").remove();
			
			//reducing the count value
			document.getElementById('ct').value = --c;
			
			//WHEN PARTS IS UPDATED
			//re-calculating the total amount			
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});

			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = total_cost; 
			document.getElementById("TotalCost").value = parseInt(total_cost); 
		});

    });

	
</script> 



<script> 	  //ALL FUNCTIONS TO LOAD VENDOR, PARTS, CATEGORY AND SERIAL NUMBER 
	function getVendor(i)
		{ 
			InvCatId = i;  
            $.get('{{url('loadcategory')}}?InvCatId=' + InvCatId, function(data)
            {  //success data
                $('#InvCatId').empty();
                $.each(data, function(index, cateObj)
                {
                    $('#InvCatId'+i+'').append('<option value="'+ cateObj.InvCatId +'"> '+cateObj.InvName+' </option>')
                });
            });	


			$('#InvCatId'+i+'').change(function(e)
            {
                console.log(e);  var icId = $(this).val();
                $.get('{{url('loadpart')}}?InvCatId=' + icId, function(data)
                {  //success data
                    $('#InvId'+i+'').empty();
                    $('#InvId'+i+'').append('<option value=""> Select Item Part </option>')
                    $.each(data, function(index, partObj)
                    {                        
                        $('#InvId'+i+'').append('<option value="'+ partObj.InvId +'"> '+partObj.InvItemName+' </option>')
                    });
                });				
            });

			
			$('#InvId'+i+'').change(function(e)
            {
                console.log(e);  var icId = $(this).val();
                $.get('{{url('loadcost')}}?InvId=' + icId, function(data)
                {  //success data   data = JSON.parse(data);  alert(data[0].name); 
                    
                    data = data[0].Cost; 
                        
                        var cost = parseInt(data);  
						document.getElementById('PartCost'+i+'').value = cost;
						
						var total_cost = 0; var p_total = 0; l_total = 0;
						$('.pcost').each(function()
						{
							p_total += parseInt($(this).val());
						});
						
						$('.lcost').each(function()
						{
							l_total += parseInt($(this).val());
						});
						
						total_cost = parseInt((p_total + l_total) * 1.05);			
						document.getElementById("TCost").innerHTML = parseInt(total_cost); 
						document.getElementById("TotalCost").value = parseInt(total_cost); 

                });				
            });
			

			
		}

	
		
	function getLabour(c)
    { 
        LabourId = c;  
        $.get('{{url('loadlabour')}}?LabourId=' + LabourId, function(data)
        {  //success data
            $('#LabourId').empty();
            $('#LabourId').append('<option value=""> Select Labour Description </option>')
            $.each(data, function(index, labourObj)
            {
                $('#LabourId'+c+'').append('<option value="'+ labourObj.LabourId +'"> '+labourObj.LabourDesc+' </option>')
            });
        });	


        $('#LabourId'+c+'').change(function(e)
        {
            console.log(e);  var LabourId = $(this).val();
            $.get('{{url('loadlabourcost')}}?LabourId=' + LabourId, function(data)
            {  //success data
                data = data[0].LabourCost; 
                var cost = parseInt(data);  
                document.getElementById('LabourCost'+c+'').value = cost;
                
                var total_cost = 0; var p_total = 0; l_total = 0;
                $('.pcost').each(function()
                {
                    p_total += parseInt($(this).val());
                });
                
                $('.lcost').each(function()
                {
                    l_total += parseInt($(this).val());
                });
                
                total_cost = parseInt((p_total + l_total) * 1.05);			
                document.getElementById("TCost").innerHTML = parseInt(total_cost); 
                document.getElementById("TotalCost").value = parseInt(total_cost);

            });				
        });
        
        
    }
		
		
</script>

<script>	  //FUNCTION TO CALCULATE TOTAL COST FOR PART LABOUR

	$(document).ready(function()
	{
		var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
			
			
		//WHEN PARTS IS UPDATED
		$('.pcost').keyup(function()
		{ 
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
		});
		
		
		//WHEN LABOUR IS UPDATED
		$('.lcost').keyup(function()
		{ 
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
		});
		
	

		
	
	});
	//making sure the amount value is never empty to avoid NAN Not A Number 
	function checkAmount(field) 
	{  
		if (field.value == '') 
		{
			var fid = field.id;
			document.getElementById(fid).value = 0;
			//$('.amount').val(0);
		}
		else 
		{	
			//WHEN PARTS IS UPDATED
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
			
			
			//WHEN LABOUR IS UPDATED
		$('.lcost').keyup(function()
		{ 
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
		});
		}
	}
	
	

</script>


<script>	  //FUNCTION TO CALCULATE TOTAL COST FOR PART LABOUR
	$(document).ready(function()
	{
		$(".pcost" ).change(function() 
		{
			//WHEN PARTS IS UPDATED
			var total_cost = 0; var p_total = 0; l_total = 0;
			$('.pcost').each(function()
			{
				p_total += parseInt($(this).val());
			});
			
			$('.lcost').each(function()
			{
				l_total += parseInt($(this).val());
			});
			
			total_cost = parseInt((p_total + l_total) * 1.05);			
			document.getElementById("TCost").innerHTML = parseInt(total_cost);  
			document.getElementById("TotalCost").value = parseInt(total_cost); 
			
			
			//WHEN LABOUR IS UPDATED
            $('.lcost').keyup(function()
            { 
                var total_cost = 0; var p_total = 0; l_total = 0;
                $('.pcost').each(function()
                {
                    p_total += parseInt($(this).val());
                });
                
                $('.lcost').each(function()
                {
                    l_total += parseInt($(this).val());
                });
                
                total_cost = parseInt((p_total + l_total) * 1.05);			
                document.getElementById("TCost").innerHTML = parseInt(total_cost); 
				document.getElementById("TotalCost").value = parseInt(total_cost);  
            });
		});
	});

</script>



<script> // retrieving the Schedule Maintenance Id
	$(document).ready(function()
	{
		$('#AssetId').change(function()
		{
			var AssetId = $(this).val();      //alert(AssetId);
			document.getElementById('AAId').value = AssetId;
			
		});
	});
</script> 



<script>      //RETRIEVING CLIENT ASSET
	$(document).ready(function()
	{
        $('#ClientId').change(function()
		{
			var ClientId = $(this).val();
            $.get('{{url('fetchasset')}}?ClientId=' + ClientId, function(data)
            {  //success data
                $('#AssetId').empty();
                $.each(data, function(index, assetObj)
                {
                    $('#AssetId').append('<option value=""> Select Client Asset </option>')
                    $('#AssetId').append('<option value="'+ assetObj.AssetId +'"> '+assetObj.LicensePlate+' </option>')
                });
            });	

            $.get('{{url('fetchclientemail')}}?ClientId=' + ClientId, function(data)
            {  //success data
                data = data[0].Email; 
                document.getElementById('shopemail').value = data.trim();
            });	
		});
		
	});
</script>








@stop