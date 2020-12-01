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
		padding:10px 5px;
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
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto -1%;
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
		color:#666; margin:auto 2% auto -1%;;
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
.datepicker
{
	width:100%; overflow:;
}
</style>





<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="forms-basic">
	<div class="page-header">
	  <h1>      <i class="fa fa-wrench"></i>    Work Order Management    </h1>
	  <p class="lead"> 
		DREAM's work order management module gives you the flexibility you need to effectively manage any type of vehicle asset related repair, 
		<br> or work activity. This module offers a single familiar tool for scheduling, managing and collecting data for all work activities. </p>
	</div>
            
			
		<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-5px -20px 0px 10px; background-color:#F9F9F9">
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
      <form method="post" action="{{route('workorder.insert')}}" role="form">
		<fieldset>
		<?php
			$total_WO = DB::table('workorder')->distinct()->get(['WOId'])->count();    
        ?>
		@if($total_WO) <?php ++$total_WO;  ?>
		  <legend>Work Order Number : #0000{{$total_WO}}</legend> 
		@else <?php $total_WO = 1;  ?>
		  <legend>Work Order Number : #0000{{$total_WO}}</legend> 
		@endif  
		  
		  <div class="form-group">
			<?php  $WO = $total_WO; ?>
			<input type ='hidden' name="WorkOrderNumber" id="" class='form-control' placeholder='WorkOrder No' @if($total_WO) value="{{$total_WO}}"@endif Required readonly />
		  </div> 
		
		<div class="form-group">
			<?php $WOid = $wo_count; ?>
			<input type ='hidden' name="WOId" id="WOId" class='form-control' placeholder='WorkOrder ID'@if($wo_count) value="{{$wo_count}}"@endif Required readonly />
		  </div>
				
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Work Order Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
					<div class="control">
					<label for="ServiceDate" class="control-label label-left"><i class="fa fa-calendar"></i> Service Start Date</label>
						<input type='text' id='ServiceDate' class="datepicker" name='ServiceDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" required/> 	
					</div>
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
							<input type='text' id='ServiceCompletionDate' name='ServiceCompletionDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999"  required/> 	
					</div>
								
					<div class="form-group">
					  <label for="WorkOrderStatus" class="control-label label-right"><i class="fa fa-book"></i> Work Order Status</label>
						<input type="hidden" name="WorkOrderStatusId" id="WorkOrderStatusId" value="1">	<!-- HIDDEN INPUT FOR STATUS -->
						
						 <select class='sel-opt-right' name='' id='' required>
						   <!--  <option value="">Select Status</option>  -->
						   @if($workorderstatus)
                           @foreach ($workorderstatus as $workorderstatus)
                                <option value="{{{ $workorderstatus->WorkOrderStatusId }}}"> {{ $workorderstatus->WorkOrderStatus }} </option>
                            @endforeach
							@endif
						</select>
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
							<?php	
								$allasset = DB::table('asset')->where('Active', '=', '1')->orderBy('LicensePlate', 'asc')->get();
							?>

								@foreach($allasset as $allasset)
								<?php
									$mk_id = $allasset->MakeId;    $md_id = $allasset->ModelId;
									$allmake = DB::table('assetmake')->where('MakeId', '=', $mk_id)->orderBy('Make', 'asc')->first();

									$allmodel = DB::table('assetmodel')->where('ModelId', '=', $md_id)->orderBy('ModelName', 'asc')->first();

									echo   "<option class='option' value=\"".$allasset->AssetId."\">".$allasset->LicensePlate.' &nbsp;&nbsp; &nbsp;  '.$allmake->Make.' &nbsp; &nbsp; &nbsp;  '.$allmodel->ModelName."</option>";
								?>
								@endforeach							
						</select>
					</div>
					</div>
				</td>
				<td> 
					<div class="form-group">
						<label for="OdometerReading" class="control-label label-right"><i class="fa fa-road"></i> Odometer Reading</label>  
						<input type="number" name="OdometerReading" id="OdometerReading" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999" required> 
					</div>
				</td>
			</tr>
		</table>  

		<input type="hidden" name="SchMaintId" id="SchMaintId" value="">   <!-- Login user roleid -->
		<input type="hidden" name="shopemail" id="shopemail" value="">
		<input type="hidden" name="FleetManagerEmail" id="FleetManagerEmail" value="{{$auth_user->email}}"><!-- Login user email -->
		<input type="hidden" name="RoleId" id="RoleId" value="{{$auth_user->RoleId}}">  <!-- Login user roleid -->
		
		<!-- part sections -->
		<legend>Parts & Labour</legend>
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_part" style="">
		<i class="lead">Part Items</i> <br>
		
		

		
			
		</table>
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addPartBtn" type="button" id="addPartBtn" class="btn btn-circle" disabled>+</button>  <i> Add Part </i>  </td></tr>
		</table>
			   
				<!-- *#*#*##*#*#**#*#*#*#*#####################################********************** -->
				
				
				<!-- HIDDEN DIV FOR Labour BEGIN -->

		
			
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_labour" style="">
		<i class="lead">Labour </i>	<br>
		
			
			
		</table>
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addLabourBtn" type="button" id="addLabourBtn" class="btn btn-circle" disabled>+</button>  <i> Add Labour </i>  </td></tr>
		</table>
		
		<legend>Other Details</legend>
		<table class="table" cellspacing="1" width="101%" border="0" style="">
		
		<tr class=""> <td> <h4>Total </h4></td> <td></td> </tr>
		<tr style="background-color:#f9f9f9; width:104%">
			<td width="80%"  style="height:45px;"> 					
			</td>
			
			<td width="20%" style=" text-align:left;"> 
				<div class="form-group">
				<label for="TotalCost" class="control-label" > <i class="fa fa-usd"></i> Total Cost : </label> <span id="TCost"> </span>		

				</div>
			</td>
			
		</tr>

		
			<tr class="lead"> <td>  </td> <td></td> </tr>
			<tr id=""
				<td width="100%"  class="box-section labour-box" colspan="2"> 
					<div class="form-group labour-box">	  
						<label for="WorkShopId" class="control-label" ><i class="fa fa-building"></i> Service Workshop</label>
						<select class='sel-opt' name='WorkShopId' id='WorkShopId' required style="">
						   <option value="">Select WorkShop</option>
						   @if($workshops)
                            @foreach ($workshops as $workshops)
                                <option value="{{{ $workshops->WorkShopId }}}"> {{ $workshops->WorkShopName }} </option>
                            @endforeach
							@endif
						</select>
					</div>
					
				</td>
				
			</tr>
		
			<tr id=""  class="">
				<td width="100%"  class="box-section labour-box" colspan="2"> 
					<div class="form-group labour-box">	  
						<label for="Comment" class="control-label" ><i class="fa fa-commenting"></i> Comment</label>
						<textarea rows="3" name="Comment" id="Comment" onkeyup="convert_comm()" placeholder="Comment" style="border:thin #ede solid;	width:100%;	padding:5px;	border-radius:2px;margin:auto 0% auto 0%; color:#999"></textarea>					</div>				
				</td>
				
			</tr>
		
			<tr class="lead"> <td>  </td> <td></td> </tr>	
			<tr id=""  class="box-section">
				<td width="100%"  class="" colspan="2"> 
					<div class="form-group col-md-6">	  
						<label for="Active"> Out of Service </label>
							<div class="radio" style="margin-left:18px">
								<div class="col-md-3">	 <input type="radio" name="Active" value="1" id="Active_0" />&nbsp; Yes </div>

								<div class="col-md-3">   <input type="radio" name="Active" value="0" id="Active_1" checked />&nbsp; No  </div>
							</div>
					</div>
					
					<div class="form-group col-md-6">	  
						 <label for="ServiceReminder"> Reset Service Reminder </label>
							<div class="radio" style="margin-left:18px">
								<div class="col-md-3">  
									<input type="radio" name="ServiceReminder" value="1" id="ServiceReminder_0" />&nbsp; Yes  
								</div>
								<div class="col-md-3">  
								    <input type="radio" name="ServiceReminder" value="0" id="ServiceReminder_1" checked />&nbsp; No
								</div>
							</div>
					</div>
				</td>
			</tr>
		
		
		</table>	

			
						  
			<div class="form-group">
				<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
			</div>


			
		  <div class="form-group">
			<button type="submit" class="btn btn-primary" id="worder">Create Work Order</button>
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
<script>
	/*$(function () {
		$('#ServiceDate').datetimepicker();
	});
	
	$(function () {
		$('#ServiceCompletionDate').datetimepicker();
	});*/

    $(function () 
	{
      
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
			'<tr id="row'+i+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-4"> <div class="controls" >		  <label for="InvCatId'+i+'" class="control-label"> <i class="fa fa-list"></i> Part Category</label>		<select class="sel-opt" name="InvCatId'+i+'" id="InvCatId'+i+'">			<option value=""> Select Part Category </option>	</select> </div>  </div><div class="form-group col-md-8">				<div class="controls" > <label for="InvId'+i+'" class="control-label" > <i class="fa fa-list"></i>Item Name </label>		<select class="sel-opt-part" name="InvId'+i+'" id="InvId'+i+'">	<option value="">Select Part</option>  </select>	  </div>  <input type="hidden" name="count" id="count" value="'+i+'" class="form-control">		</div>			</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="PartCost'+i+'" class="control-label" > <i class="fa fa-usd"></i> Cost : <span id="pl"> </span></label>  <br>							<input type="number" name="PartCost'+i+'" id="PartCost'+i+'" class="pcost" value="0" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:98%;	padding:10px 5px;	border-radius:2px;margin:auto 2px; color:#999"> 		</div>			</td><td width="2%" style="vertical-align:middle; border: none;"><button type="button" name="remove" id="'+i+'" class="btn btn-circle-red btn_remove" style="">X</button> </td>		</tr>'						
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
			'<tr id="rows'+c+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-12"> <div class="controls">		  <label for="LabourId'+c+'" class="control-label"> <i class="fa fa-list"></i> Labour Description</label> 	<select class="sel-opt" name="LabourId'+c+'" id="LabourId'+c+'" style="width:100%"><option class="option" value=""> Select Labour Description </option>   </select> </div>   <input type="hidden" name="ct" id="ct" value="'+c+'" class="form-control"> </div>		</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="LabourCost'+c+'" class="control-label" > <i class="fa fa-usd"></i> Cost</label>  <br>							<input type="number" name="LabourCost'+c+'" id="LabourCost'+c+'" class="lcost" value="0" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:98%;	padding:10px 5px;	border-radius:2px;margin:auto 2px; color:#999"> 		</div>			</td><td width="2%" style="vertical-align:middle; text-align:left; border: none;"> <button type="button" name="delete" id="'+c+'" class="btn btn-circle-red btn_delete">X</button></td>		</tr>'						
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
		});

    });

	
</script> 



<script> 	  //ALL FUNCTIONS TO LOAD VENDOR, PARTS, CATEGORY AND SERIAL NUMBER 
	function getVendor(i)
		{ 
			InvCatId = i;
			$.ajax({
					url:"loadcategory",
					method:"POST",
					data:{invCatId:InvCatId},
					dataType:"text",
					success:function(data)
					{
						$('#InvCatId'+i+'').html(data);
					}
				});
			
			$('#InvCatId'+i+'').change(function()
			{
				var InvCatId = $(this).val();
				$.ajax({
					url:"loadpart",
					method:"POST",
					data:{invCatId:InvCatId},
					dataType:"text",
					success:function(data)
					{
						$('#InvId'+i+'').html(data);
					}
				});
			});

			
			$('#InvId'+i+'').change(function()
			{
				var InvId = $(this).val();
				$.ajax({
					url:"loadcost",
					method:"POST",
					data:{invId:InvId},
					dataType:"text",
					success:function(data)
					{
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
					}
				});
			});
			

			
		}

	
		
	function getLabour(c)
		{ 
			LabourId = c;
			$.ajax({
				url:"loadlabour",
				method:"POST",
				data:{},
				dataType:"text",
				success:function(data)
				{
					$('#LabourId'+c+'').html(data);
				}
			});
			
			$('#LabourId'+c+'').change(function()
			{
				var LabourId = $(this).val();
				$.ajax({
					url:"loadlabourcost",
					method:"POST",
					data:{labourId:LabourId},
					dataType:"text",
					success:function(data)
					{
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
					}
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
		});
		}
	}
	
	

</script>


<script>	  //FUNCTION TO CALCULATE TOTAL COST FOR PART LABOUR
	$(document).ready(function()
	{
		$( ".pcost" ).change(function() 
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
			});
		});
	});

</script>



<script> // retrieving the Schedule Maintenance Id And work shop email  
	$(document).ready(function()
	{
		$('#AssetId').change(function(e)
		{//console.log(e);
			var asset_id = $(this).val();     //var asset_id = e.target.value;
			$.get('{{url('fetchschmaintid')}}?AssetId=' + asset_id, function(data)
			{  //success data					
				data = data[0].SchMaintId;   //alert('For Data Sch M Id ' + data);
				$('#SchMaintId').val(parseInt(data));
			});	
		});
		
		//retrieving the email address of workshop seleted
		$('#WorkShopId').change(function(e)
		{
			console.log(e);
			var shop_id = e.target.value;   
			$.get('{{url('fetchshopemail')}}?WorkShopId=' + shop_id, function(data)
			{  //success data					
				data = data[0].Email;   
				$('#shopemail').val(data);
			});	
		});
		
	});
</script> 

<script> //making Status readonly
	$(document).ready(function()
	{
		$('#WorkOrderStatusId').attr('readOnly','readOnly');			
	});
</script>








@stop