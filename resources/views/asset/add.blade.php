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
	
.pad{
        margin-top: 5px;
        border:1px solid #ddd;
	}
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
		width:97%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 3%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 4% auto 0%;
	}

.inp
	{
		border:thin #ede solid;
		width:98%;	padding:5px;	
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
		color:#666; margin:auto 2% auto 3%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 2%;
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
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:#f00;
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
		padding:1px 25px 1px 10px; margin-top:-25px;
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
	  <h1>      <i class="fa fa-car"></i>      Asset Management   </h1>
		<p  class="lead"> The Asset Management module  allows you to efficiently manage your entire asset lifecycle. With real-time visibility into asset                     
			<br>performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
	</div>

	  
	  <!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card"> 

			<center> <img src="{{URL::asset('assets/img/nocar.jpg')}}" class="img-responsive" height="150" width="150"> </center>	
				
			</div>  	
			
			
				<!-- quick report div  -->
				<div class="grey-card" style="padding:0px 0px 0px 25px">
				<table class="table" width="105%" cellpadding="0">
					<tr>
						<td style="width:95%"> 
							<h4 class="grey-text m-b-30">   Quick Reports  </h4>
									</td>
						<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
					</tr>
				</table>
				
					<div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px; color:#fff"><a onclick="workOrder('$asset->AssetId')" href="#" class="btn btn-circle-green" data-tooltip="true" data-toggle="modal" data-target="#workModal" title='Create Work Order For Asset'>+</a></div>
                      <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href=""> Service Appointments </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a onclick="pullId('$asset->AssetId')" href="" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn"  data-toggle="modal" data-target="#fuelModal" title='Add New Fuel Log'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#"> Jobs </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green">+</a></div>
                      <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href="#"> Fuel Purchases </a></div>
                    </div>
					
                  </div>
				</div>
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
					<?php  //$this->element('insight');  ?> 
				</div>
				</div>
			
		  </div>

	  
	  
	 
	 
	 
	 
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

		<div>
	

		<form method="post" action="{{route('asset.insert')}}" role="form">
			<fieldset>
			   <legend>Create vehicle profile</legend>
			   @if(count($errors) > 0)
			   		@foreach($errore->all() as $error)
			   			<div class="alert alert-danger"> {{ $error }} </div>
			   		@endforeach
			   	@endif
			  <table id="example" class="table" cellspacing="1" width="100%" border="0">
				<CAPTION>Primary Details</CAPTION>
					<tr class="box-section">
						<td width="50%"> 
						<div class="form-group">	  
							  <div class="controls">
							  <label for="MakeId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle Make</label>
								<select class='sel-opt' name='MakeId' id='MakeId' style="margin:auto 2%;" required>
									<option class="option" value=""> Select Vehicle Make </option>
									@if($assetmake)
									@foreach ($assetmake as $assetmake)
										<option value="{{{$assetmake->MakeId}}}"> {{ $assetmake->Make }} </option>
									@endforeach
									@endif
							   </select>
							  </div>							
						</div>
						
						
						
						<div class="form-group">
							<label for="LicensePlate" class="control-label label-left" required> <i class="fa fa-car"></i> License Plate</label>
							<input type="text" name="LicensePlate" id="LicensePlate" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required onblur="convert_case()">
						</div>
													
					  </td>
						<td width="50%"> 
						
							<div class="form-group">
								<div class="controls">  <label for="ModelId" class="control-label label-right" required> <i class="fa fa-car"></i> Vehicle Model</label>
									<select class='sel-opt-right' name='ModelId' id='ModelId' style="margin:auto 2%;" required>
										<option value=""> Select Vehicle Model </option>
										
								   </select>
							  </div>
							</div>
										
							<div class="form-group">
								<label for="VIN" class="control-label label-right" required> <i class="fa fa-car"></i> Vehicle Identification No</label>
								<input type="text" name="VIN" id="VIN" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%;"  Required onblur="convert_vin()">
							</div>
							
							<div class="form-group">
							
							</div>
							
						</td>
					</tr>
					
					
					<tr class="lead" style="text-align:left; margin-left:-15px">
						<td colspan="2"> Location </td>
					</tr>
					

					<tr class="box-section">
						<td> 
							<div class="form-group">    <label for="DeptId" class="control-label label-left"> <i class="fa fa-building"></i> Department</label>
							<select class='sel-opt' name='DeptId' id='DeptId' style="margin:auto 2%;" required>
							<option value="">Select Asset Department </option>
							@if($department)
								@foreach ($department as $department)
									<option value="{{{ $department->DeptId }}}"> {{ $department->DeptName }} </option>
								@endforeach
							@endif
							 </select>
							</div>
						</td>
						<td> 
							<div class="form-group">   <label for="LocationId" class="control-label  label-right"> <i class="fa fa-map-marker"></i> Company Location </label>
								<select class='sel-opt' name='LocationId' id='LocationId' style="margin:auto 2%;" required>
									<option value="">Select Company Location</option>
									@if($companylocation)
									@foreach ($companylocation as $location)
										<option value="{{{ $location->LocationId }}}"> {{ $location->LocationName }} </option>
									@endforeach
									@endif
								 </select>
							</div>
						</td>
					</tr>
					
					<tr class="lead" style="text-align:left; margin-left:-15px">
						<td colspan="2"> Secondary Details </td>
					</tr>
					

					<tr class="box-section">
						<td> 
							<div class="form-group">
							<label for="EqpYear" class="control-label label-left" required> <i class="fa fa-calendar"></i> Vehicle Year</label>
							<input type="text" name="EqpYear" id="EqpYear" placeholder="YYYY" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" maxlength="4" Required>
						</div>
							<div class="form-group">    <label for="AssetTypeId" class="control-label label-left" required> <i class="fa fa-car"></i> Vehicle Body Type</label>
							<select class='sel-opt' name='AssetTypeId' id='AssetTypeId' style="margin:auto 2%;" required>
								   <option value="">Select Vehicle Body Type </option>
									@if($assettype)
									@foreach ($assettype as $type)
										<option value="{{{ $type->AssetTypeId }}}"> {{ $type->AssetTypeName }} </option>
									@endforeach
									@endif
							 </select>
							</div>
							
							
						</td>
						<td> 
							<div class="form-group">    <label for="FuelTypeId" class="control-label label-right"> <i class="fa fa-tint"></i> Fuel Type</label>
							<select class='sel-opt' name='FuelTypeId' id='FuelTypeId' style="margin:auto 2%;" required>
								<option value="">Select FuelType </option>
								@if($fueltype)
								@foreach ($fueltype as $fuel)
									<option value="{{{ $fuel->FuelTypeId }}}"> {{ $fuel->FuelType }} </option>
								@endforeach
								@endif
							 </select>
							</div>
							<div class="form-group">    <label for="Color" class="control-label label-right"> <i class="fa fa-toggle-on"></i> Color</label>
							<select class='sel-opt' name='Color' id='Color' style="margin:auto 2%;" required>
								<option value="">Select Asset Color </option>
								@if($colors)
								@foreach ($colors as $colors)
									<option value="{{{ $colors->Color }}}"> {{ $colors->Color }} </option>
								@endforeach
								@endif
							 </select>
							</div>
						</td>
					</tr>
					
					<tr>
						<td> 
							
						</td>
						<td> 
							
						</td>
					</tr>
					
					<tr>
						<td> 
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Create Asset</button>
								<button type="reset" class="btn btn-default">Cancel</button>
							  </div>
						</td>
						<td> 
							<div class="form-group">
								<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >

								<input type="hidden" name="Active" id="Active" class="form-control" value="1" readonly >

								<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
							</div>
						</td>
					</tr>
				</table> 

			  
	</fieldset>
  </form>

</div>
</div>

	
   

  </section>
</div>

 
 		
		
<script>
	$(document).ready(function()
	{
		$('#MakeId').change(function(e)
		{
			console.log(e);
			var makeid = e.target.value;
			$.get('{{url('make-models')}}?MakeId=' + makeid, function(data)
			{  //success data
				$('#ModelId').empty();
				$('#ModelId').append('<option value=""> Select Model  </option>')
				$.each(data, function(index, modelObj)
				{
					$('#ModelId').append('<option value="'+ modelObj.ModelId +'"> '+modelObj.ModelName+' </option>')
				});
			});				
		});
	});
</script> 



 
<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_case() 
	{
		var str = document.getElementById('LicensePlate').value;
		var cap = str.toUpperCase(); 			document.getElementById('LicensePlate').value = cap;
	}
    
    function convert_vin() 
	{
		var str = document.getElementById('VIN').value;
		var cap = str.toUpperCase(); 			document.getElementById('VIN').value = cap;
	}
</script>

		<!-- var str = document.getElementById('LicensePlate').value;
		capitalizedString = str.charAt(0).toUpperCase() + str.slice(1);
		document.getElementById('LicensePlate').value = capitalizedString; -->




@stop