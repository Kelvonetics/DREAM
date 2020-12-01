@include('templates.config')
@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>



<?php
		
	//RETRIEVING THE USER ROLE ID
	//$user_roleid = $this->request->Session()->read('Auth.User.RoleId');
	//RETRIVING THE WORK ORDER WORK FLOW ID
	/*$workflow = DB::table('workflow')->where('WorkFlowName', '=', 'Work Order')->first();
	$wflowId = $workflow->Settings;*/
	
?>

<!-- WORK ORDER NUMBERS -->
<?php 
	$idd = $clientworkorder->WOId;    $wo = $clientworkorder->WOId;
	$date = DB::table('clientworkorder')->where('WOId', '=', $wo)->first();
	$client_quote_ct = DB::table('clientworkorder')->where('WOId', '=', $wo)->count();

		 if($client_quote_ct < 10)	{	@$numb .= '0000';	}	
	else if($client_quote_ct >= 10){	@$numb .= '000';	}
	else if($client_quote_ct >= 100){	@$numb .= '00'; 	}	
	else if($client_quote_ct >= 1000){	@$numb .= '0';		}
	else {		};
 ?>



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
		width:108%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:0px -4% 0px 2%;
	}
.sel-opt
	{
		border:thin #ede solid;
		width:97%;
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
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 3%;
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
		color:#666; margin:auto 0%;
	}
.label-left
	{
		color:#666; margin:auto 4%;
	}
.label-right
	{
		color:#666; margin:auto 0% auto 3%;
	}
.part-label
    {
        color:#666; margin:auto 0% auto 2%;
    }
.labour-label
    {
        color:#666; margin:auto 0% auto 2%;
    }
.cost-label
    {
        color:#666; margin:auto 0% auto 5%;
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
	  margin-left:5px;
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
		padding:1px 25px 1px 10px; margin-top:-22px;
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
.big-text
{
	font-size:13px; color:#666;
}
.r-btn
{
	margin-top:10px;
}
</style>





<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
    <section class="forms-basic">
    <div class="page-header">
        <h1>      <i class="fa fa-briefcase"></i>    Client Quote	  </h1>
        <p class="lead"> 
DREAM's work order management module gives you the flexibility you need to effectively manage any type of vehicle asset related repair, 
<br> or work activity. This module offers a single familiar tool for scheduling, managing and collecting data for all work activities. </p>
    </div>
            
			
	<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-58px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-20px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card" style="margin-top:-10px"> 				 
            <center> <img src="{{URL::asset('assets/img/invoice.jpg')}}" class="img-responsive" height="150" width="150"> </center>
				
			</div>  	
			
			
				<!-- quick report div  -->

				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 13px 0px 10px">
					<?php  //$this->element('insight');?> 
				</div>
				</div>
			
		  </div>
            

	 <?php $idd = $clientworkorder->WorkOrderNumber;    $wo = $clientworkorder->WOId; 
			$cl = DB::table('clientworkorder')->where('WOId', '=', $wo)->get();
			  ?> @if($cl) <?php $cl_id = $cl->ClientId ?> @endif
			
   <!-- left content -->
    @if(count($errors) > 0)
        @foreach($errors->all() as $errors)
            <div class="alert alert-danger" style="width:75%"> {{ $errors }} </div>
        @endforeach
    @endif
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
      <form class="form-horizontal" method="post" action="{{ url('/clientworkorder/update', array($clientworkorder->WOId)) }}">
		<fieldset>
		  <legend>Work Order Number : #0000 @if($clientworkorder)
		  {{$clientworkorder->WorkOrderNumber}} @endif </legend> 
		  <div class="lead" style="margin:0px 0px 40px -15px">
				<div class="col-md-11" style="font-size:15px; color:#202020"> 
				<?php  $cl_id = $clientworkorder->ClientId;
					$cli = DB::table('client')->where('ClientId', '=', $cl_id)->first();
				 ?> @if($cli) {{$cli->FirstName.' '.$cli->LastName}} @endif
			    </div>
				<div class="col-md-11 big-text"> 
				@if($cli) <?=  $cli->Address.' '.$cli->Address_2  ?> @endif
				</div>
				<div class="col-md-11 big-text">
				@if($cli) <?=  $cli->City.' '.$cli->State; ?> @endif
				</div>
				<div class="col-md-11 big-text"> 
				@if($cli) <?=  $cli->Country ?> @endif
				</div>
		   </div> 
		  <div class="lead" style="margin:0px 0px 40px -15px">
				<div class="col-md-11 big-text"> 
				@if($date) <?=  $date->ServiceDate.' &nbsp; - &nbsp; '.$date->ServiceCompletionDate;   ?> @endif  
			    </div>
		   </div>
		  
		  <div class="form-group">  
          <input type="hidden" class="form-control" name="WorkOrderNumber" id="WorkOrderNumber" value="{{$clientworkorder->WorkOrderNumber}}" Required Readonly>
			<input type="hidden" class="form-control" name="WOId" id="WOId"@if($clientworkorder) value="{{$clientworkorder->WOId}}"@endif Required Readonly>
		 </div> 
				
				
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Client Work Order Details</CAPTION>
			<tr class="box-section">
				<td width="100%" colspan="2">
					<div class="form-group col-md-12">	  
						<label for="ClientId" class="control-label" ><i class="fa fa-female"></i> Client Name</label>
						<select class='sel-opt' name='ClientId' id='ClientId' required style="width:103.5%">	@if($cli)						   
							<option class='option' value="{{$cli->ClientId}}">{{$cli->FirstName.' '.$cli->LastName}}</option>
						@endif
						</select>
					</div>
				</td>
			</tr>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
				<label for="ActualStartDate" class="control-label label-left"><i class="fa fa-calendar"></i> Actual Start Date</label>
					<input type='text' id='ActualStartDate' class="datepicker" name='ActualStartDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" 
					@if($date) value="<?= $date->ActualStartDate ?>" maxlenght="10"@endif /> 	
				</div>
				
				<div class="form-group"> 
					<input type='hidden' id='ServiceDate' class="datepicker" name='ServiceDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" 
					@if($date) value="<?= $date->ServiceDate  ?>" maxlenght="10"@endif readonly required /> 	
				</div>
							  
				<div class="form-group">
				  <label for="MaintenanceType" class="control-label label-left"><i class="fa fa-list"></i> Maintenance Type</label>
					 <select class='sel-opt-left' name='MaintenanceType' id='MaintenanceType' required>					   
						@if($date)
						<option class='option' value="{{$date->MaintenanceType}}"> 
						{{$date->MaintenanceType}} </option>
						@endif
							<option value="">Select Maintenance Type</option>';	 ?>
                            if($maintenances)
                                @foreach ($maintenances as $maintenances)
                                    <option value="{{{ $maintenances->MaintenanceType }}}"> 
									{{ $maintenances->MaintenanceType }} </option>
                                @endforeach
							@endif
					</select>
				</div>							
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
						<label for="ActualEndDate" class="control-label label-right"><i class="fa fa-calendar"></i> Actual End Date</label>  
							<input type='text' id='ActualEndDate' name='ActualEndDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"
							@if($date) value="<?= $date->ActualEndDate  ?>"@endif maxlenght="10" /> 	
					</div>
					
					<div class="form-group">
							<input type='hidden' id='ServiceCompletionDate' name='ServiceCompletionDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"@if($date) 
							value="<?= $date->ServiceCompletionDate  ?>"@endif maxlenght="10" readonly required/> 	
					</div>
								
					<div class="form-group">	  
					  <div class="controls">
					  <label for="WorkOrderStatus" class="control-label label-right"><i class="fa fa-book"></i> Work Order Status</label>  
						 <select class='sel-opt-right' name='WorkOrderStatusId' id='WorkOrderStatusId' required>						   
							<?php 
								$num = $date->WorkOrderStatusId;
								$workorderstatus = DB::table('workorderstatus')->where('WorkOrderStatusId', '=', $num)->first();
							?>
							<option class='option' value="{{$workorderstatus->WorkOrderStatusId}}"> {{$workorderstatus->WorkOrderStatus}} </option>
								<!-- CHECK TO RESTRICT USERS FROM UPDATING WORK ORDER STATUS  -->				
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
							<?php		   
								$wkass = DB::table('clientworkorder')->where('WOId', '=', $wo)->first();
								$wkassid = $wkass->AssetId;

								$allasset = DB::table('clientasset')->where('AssetId', '=', $wkassid)->first();
								$mk_id = $allasset->MakeId;			$md_id = $allasset->ModelId;
  
								$allmake = DB::table('assetmake')->where('MakeId', '=', $mk_id)->orderBy('Make', 'asc')->first();	

								$allmodel = DB::table('assetmodel')->where('ModelId', '=', $md_id)->orderBy('ModelName', 'asc')->first();	
						
								echo   "<option class='option' value=\"".$allasset->AssetId."\">".$allasset->LicensePlate.' --> '.$allmake->Make.' --> '.$allmodel->ModelName."</option>";
							?>
						</select>
					</div>
					</div>
				</td>
				<td> 
					<div class="form-group">
						<label for="OdometerReading" class="control-label label-right"><i class="fa fa-road"></i> Odometer Reading</label>  
						<input type="number" name="OdometerReading" id="OdometerReading" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"@if($date) value="<?= $date->OdometerReading;  ?>"@endif required> 
					</div>
				</td>
			</tr>
			
			
		</table>  
				
		
		
		
			
		</table>
		
		
		<!-- part sections -->
		<legend>Parts & Labour</legend>
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_part" style="">
		<i class="lead">Part Items</i> <br>
		
		<?php	
			$wko_no = $clientworkorder->WorkOrderNumber; 
			$records = DB::table('clientworkorderitem')->where('WorkOrderNumber', '=', $wko_no)
			->where('Type', '=', 'part')->orderBy('WOId', 'desc')->get();			  $i = 1;   ?>
			@if($records) 
			@foreach($records as $records)
			<tr id="row".$i."">  <td width="85%"  class="box-section">
				<div class="form-group col-md-4">	  
					<div class="controls">
					<label for="InvCatId".$i."" class="fm-label"><i class="fa fa-list"></i> Category </label>
					
					
					<select class="sel-opt" name="InvCatId".$i."" id="InvCatId".$i."">  
					<?php $cid = $records->InvCatId;   
					
						$invcategory = DB::table('invcategory')->where('InvCatId', '=', $cid)->first();
						if($invcategory)
						{ ?>							
							<option class="option" value="{{$invcategory->InvCatId}}">{{$invcategory->InvName}}</option>
							<option value="">Select Status</option>
					<?php } {
							$invcategorys = DB::table('invcategory')->orderBy('InvName', 'desc')->get();
					?>
					@if($invcategorys) 
						@foreach ($invcategorys as $invcategorys)
						<option class="option" value="{{$invcategorys->InvCatId}}">{{$invcategorys->InvName}}</option>
						@endforeach
					@endif
					<?php  }  ?>

						
					</select>
					
					<input type="hidden" name="WOId".$i."" id="WOId".$i.""@if($records) value=."{{$records->WOId}}"@endif />
					<input type="hidden" name="WorkOrderNumber".$i."" id="WorkOrderNumber".$i.""@if($records)  value="{{$records->WorkOrderNumber}}"@endif />
					</div>  </div>     <div class="form-group col-md-8">   <div class="controls">
							
					<label for="InvId".$i."" class="fm-label labour-label"><i class="fa fa-list"></i> Item Name </label>	
					
					<select class="sel-opt-part" name="InvId".$i."" id="InvId".$i.""> 
					<?php $pid = $records->InvId;  
					
						$inventoryitem = DB::table('inventoryitem')->where('InvId', '=', $pid)->first();
						if($inventoryitem)
						{ ?>							
							<option class="option" value="{{$inventoryitem->InvId}}">{{$inventoryitem->InvItemName}}</option>
							<option value="">Select Parts</option>
					<?php } {
							$inventoryitems = DB::table('inventoryitem')->orderBy('InvItemName', 'desc')->get();
					?>
					@if($inventoryitems) 
						@foreach ($inventoryitems as $inventoryitems)
						<option class="option" value="{{$inventoryitems->InvId}}">{{$inventoryitems->InvItemName}}</option>
						@endforeach
					@endif
					<?php  }  ?>
					</select>			<?php $no = $i + 1;  ?>
					

				</div>   </div>
							
							
				<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 
					<div class="form-group">
						<label for="PartCost".$i."" class="fm-label cost-label"><i class="fa fa-usd"></i> Cost </label>
						<input type="number" name="PartCost".$i."" id="PartCost".$i."" class="pcost" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2px auto 10px; color:#999" @if($records) value="{{$records->PartCost}}"@endif /> 										   
					</div>


				</td>
				
				<td width="2%" style="vertical-align:middle; text-align:left; border: none;"> 
					
					<button type="button" name="remove" id="".$i."" class="btn btn-circle-red btn_remove">X</button>
				
				
				</td>  
			</tr>
				<!-- try putting $count_part variable in a session -->
                <?php $count_part = $i;	   $i++;	?>
		
			@endforeach
		@endif
		
		

		</table>
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addPartBtn" type="button" id="addPartBtn" class="btn btn-circle">+</button>  <i> Add Part </i> 
		<input type="hidden" name="count_part" id="count_part" value="<?= $count_part ?>" class="form-control">
		</td></tr>
		</table>
			   
				<!-- *#*#*##*#*#**#*#*#*#*#####################################********************** -->
				
			

		
			
		
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_labour" style="">
		<i class="lead">Labour </i>	<br>
		<?php	
			$wko_no = $clientworkorder->WorkOrderNumber; 
			$records = DB::table('clientworkorderitem')->where('WorkOrderNumber', '=', $wko_no)
			->where('Type', '=', 'labour')->orderBy('WOId', 'desc')->get();			  $c = 1;   ?>
			@if($records)
			@foreach($records as $records)
			<tr id="rows".$c.""  class="">
				<td width="85"  class="box-section labour-box"> 
				<div class="form-group col-md-12">	
					<label for="LabourId".$c."" class="fm-label"><i class="fa fa-list"></i> Labour Description </label>	
					<?php   ?>
					<select class="sel-opt" name="LabourId".$c."" id="LabourId".$c."" style="width:100%">
					<?php $lid = $records->LabourId; 
					
						$workorderlabour = DB::table('workorderlabour')->where('LabourId', '=', $lid)->first();
						if($workorderlabour)
						{ ?>
							
							<option class="option" value="{{$workorderlabour->LabourId}}">{{$workorderlabour->LabourDesc}}</option>
							<option value="">Select Labour Description</option>
					<?php } {
						$workorderlabours = DB::table('workorderlabour')->orderBy('LabourDesc', 'desc')->get();
					?>
					@if($workorderlabours)
						@foreach ($workorderlabours as $workorderlabours)
						<option class="option" value="{{$workorderlabours->LabourId}}">{{$workorderlabours->LabourDesc}}</option>
						@endforeach
					@endif
					<?php  }  ?>
					</select>
						
					<input type="hidden" name="WOId_l".$c."" id="WOId_l".$c.""@if($records) value="{{$records->WOId}}"@endif />
					<input type="hidden" name="WorkOrderNumber".$c."" id="WorkOrderNumber".$c.""@if($records) value="{{$records->WorkOrderNumber}}"@endif />
				</div>  <?php $no = $c + 1;  ?>
				</td>
				
				<td width="13%" style="vertical-align:top; text-align:left;"> 
				<div class="form-group">
					<label for="LabourCost" class="control-label cost-label" > <i class="fa fa-usd"></i> Cost</label>  <br>
					<input type="number" name="LabourCost".$c."" id="LabourCost".$c."" class="lcost" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2px auto 10px; color:#999"@if($records) value="{{$records->LabourCost}}"@endif /> 											   
				</div> 
				</td>
				
				<td width="2%" style="vertical-align:middle; text-align:left;"> 
				
				<button type="button" name="delete" id="".$c."" class="btn btn-circle-red btn_delete">X</button>
				
				</td> 
			</tr>
			<!-- try putting $count_lab variable in a session  -->
			<?php  $count_lab = $c;	  	$c++;  ?>
		@endforeach
		@endif
		
		
		
		</table>
		
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
			<tr><td> <button name="addLabourBtn" type="button" id="addLabourBtn" class="btn btn-circle">+</button>  <i> Add Labour </i>  
			<input type="hidden" name="count_lab" id="count_lab" value="<?= $count_lab ?>" class="form-control">
			</td></tr>
		</table>
		
		<legend>Other Details</legend>
		<table class="table" cellspacing="1" width="101%" border="0" style="">
		
		<tr class=""> <td> <h4>Total </h4></td> <td></td> </tr>
		<tr style="background-color:#f9f9f9; width:104%">
			<td width="70%"  style="height:45px;"> 					
			</td>
			
			<td width="30%" style=" text-align:left;"> 
				<div class="form-group">
					<label for="TotalCost" class="control-label" >VAT incl &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-usd"></i> Total Cost : <span id="TCost"></span></label> 
					<input type="hidden" name="TotalCost" id="TotalCost">
				</div>
			</td>
			
		</tr>


		
		<tr id=""  class="">
			<td width="100%"  class="box-section labour-box" colspan="2"> 
				<div class="form-group labour-box">	  
					<label for="Comment" class="control-label" ><i class="fa fa-commenting"></i> Comment</label>
						<textarea rows="3" name="Comment" id="Comment" onkeyup="convert_comm()" placeholder="Comment" style="border:thin #ede solid;	width:100%;	padding:5px;	border-radius:2px;margin:auto 0% auto 0%; color:#999">@if($date)<?= $date->Comment ?>@endif</textarea>					
				</div>				
			</td>			
		</tr>	
				
		</table>	

		  
			<div class="form-group">
				<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
			</div>
				
			 	  
			  
				
			  <div class="form-group">
				<button type="submit" class="btn btn-primary">Update Quote</button>
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
		
		//for actual start and end date pickers
		$("#ActualStartDate").on("dp.change", function (e) {
            $('#ActualEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ActualEndDate").on("dp.change", function (e) {
            $('#ActualStartDate').data("DateTimePicker").maxDate(e.date);
        });
    });
</script> 


<!--script for dublicating form -->
<script>
    $(document).ready(function ()
	{		
		//for Part
		var i = "<?= $count_part; ?>"; var z = 0;
        $('#addPartBtn').on('click', function () 			//
		{
            i++;  z++;
			$('#dynamic_part').append(
			'<tr id="row'+i+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-4"> <div class="controls" > <label for="InvCatId'+i+'" class="control-label"> <i class="fa fa-list"></i> Part Category</label>		<select class="sel-opt" name="InvCatId'+i+'" id="InvCatId'+i+'">			<option value=""> Select Part Category </option>	</select> </div>   </div><div class="form-group col-md-8">	<div class="controls ">  <label for="InvId'+i+'" class="control-label part-label" > <i class="fa fa-list"></i>Item Name </label>		<select class="sel-opt-part" name="InvId'+i+'" id="InvId'+i+'">	<option value="">Select Part</option>  </select>	</div>  <input type="hidden" name="count_part_new" id="count_part_new" value="'+z+'" class="form-control">		</div>			</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="PartCost'+i+'" class="control-label cost-label" > <i class="fa fa-usd"></i> Cost</label>  <br>		<input type="number" name="PartCost'+i+'" id="PartCost'+i+'" class="pcost" onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2px auto 10px; color:#999" value="0"> 		</div>	</td>	<td width="2%" style="vertical-align:middle; text-align:left; border: none;"> <button type="button" name="remove" id="'+i+'" class="btn btn-circle-red btn_remove">X</button>	</td>		</tr>'						
		);
			getVendor(i);  document.getElementById('count_part_new').value = z;
        });
		
		//Function To load all labour Description	
		
		$(document).on('click', '.btn_remove', function ()
		{
			var button_id = $(this).attr("id");
			$('#row'+button_id+"").remove();
			document.getElementById('count_part_new').value = --z;
		});

    });
	
	
	$(document).ready(function ()
	{		
		//for labour
		var c = "<?= $count_lab  ?>"; var y = 0;
        $('#addLabourBtn').on('click', function () 			//
		{
            c++; y++;
			$('#dynamic_labour').append(
			'<tr id="rows'+c+'">	<td width="85%"  class="box-section labour-box"> <div class="form-group col-md-12"> <div nclass="controls">		  <label for="LabourId'+c+'" class="control-label"> <i class="fa fa-list"></i> Labour Description</label> 	<select class="sel-opt" name="LabourId'+c+'" id="LabourId'+c+'" style="width:100%"><option class="option" value=""> Labour Description </option>   </select> </div> <input type="hidden" name="count_lab_new" id="count_lab_new" value="'+y+'" class="form-control">	 </div>			</td>	<td width="13%" style="vertical-align:top; text-align:left; border: none;"> 	<div class="form-group">		<label for="LabourCost'+c+'" class="control-label cost-label" > <i class="fa fa-usd"></i> Cost</label>  <input type="number" name="LabourCost'+c+'" id="LabourCost'+c+'" class="lcost"  onkeyup="checkAmount(this)" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2px auto 10px; color:#999" value="0"> 		</div>			</td> <td width="2%" style="vertical-align:middle; text-align:left; border:none;">  <button type="button" name="delete" id="'+c+'" class="btn btn-circle-red btn_delete">X</button> </td>		</tr>'						
		);
			getLabour(c);	 document.getElementById('count_lab_new').value = y;
        });
		
		//Function To load all labour Description
		
		
		$(document).on('click', '.btn_delete', function ()
		{
			var button_id = $(this).attr("id");
			$('#rows'+button_id+"").remove();
			document.getElementById('count_lab_new').value = --y;
		});

    });

	
</script> 



<script> 	  //ALL FUNCTIONS TO LOAD VENDOR, PARTS, CATEGORY AND SERIAL NUMBER 
	function getVendor(i)
    { 
        InvCatId = i;  
        $.get('/loadcategory?InvCatId=' + InvCatId, function(data)
        {  //success data
            $('#InvCatId').empty();
			$('#InvCatId').append('<option value=""> Select Part Category </option>')
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

<script>	  //FUNCTION TO CALCULATE TOTAL COST

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




@stop