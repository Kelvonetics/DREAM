@include('templates.config')
@extends('templates.default')

@section('content')



<!-- LOGGED IN USER  --> <?php  $auth_user = Auth::user();  ?> 

<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.pad
{
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
		width:92%;
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
		width:98%;	padding:7.5px;	
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
		color:#666; margin:auto 0% auto 3%;
	}
.label-center
	{
		color:#666; margin:auto 0% auto 2%;
	}
.label-full
	{
		color:#666; margin:auto 0% auto 2%;
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
.box-right
	{
		border:1px solid #ddd;
		padding:8px 15px;
	}
.notif
	{
		background-color:red;     <!-- #E52B50 -->
		color:white;
	}
</style>



{!! Charts::styles() !!}
{!! Charts::scripts() !!}




<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="md md-sort"></i>   Asset Report View  </h1> 
	  	@if(count($errors) > 0)
			@foreach($errors->all() as $errors)
				<div class="alert alert-danger" style="width:75%"> {{ $errors }} </div>
			@endforeach
		@endif

		@if(session('info'))
		<div class="alert" style="background-color:#ACE1AF; width:75%">
			{{session('info')}}
		</div>
		@endif
	</div>

	  
	</div>
	<div class="">
              

<div class="widget-content" id="tabCont">

<ul class="nav nav-tabs card" style="width:75%">
    <li><a class="active" data-toggle="tab" href="#service"><span><i class="fa fa-wrench"></i> Services History </span> </a> </li>  
      <li><a class="" data-toggle="tab" href="#jobs"><span><i class="md md-extension"></i> Job History</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#fuel"><span><i class="fa fa-tint"></i> Fuel Purchase</span> </a> </li> 
      <li><a class="" data-toggle="tab" href="#profile"><span><i class="fa fa-car"></i> Profile</span> </a> </li>	
</ul>

	<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-95px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<a href="" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="No Of Day(s) To Maintenance"> 
				
                     <i class="fa fa-area-chart">			 </i>    
                     
				</a>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed
			
			<input type="hidden" name="aid" value="{{{ $asset->AssetId }}}"> 
			
			</h4> </div>
			<div class="well white white-card"> 

				<a onclick="AssProfileUpload({{$asset->AssetId}})" href="#" class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple pull-right" data-toggle="modal" data-target="#assetprofileModal" style="margin-right:-20px;" title="Upload Asset Profile Photo"> <i class="fa fa-photo" style="color:red;"></i> </a>
				
				<?php
					$a_id = $asset->AssetId;
					$Asset_Pic = DB::table('assetattachment')->where('AssetId', '=', $a_id)->where('Category', '=', '1')->orderBy('AssetAttachId', 'desc')->first();
					if ($Asset_Pic)	
					{	
						$pic = $Asset_Pic->name;   
					}
					else{ $pic = "nocar.jpg";  }
				?>

			<center> <img src="{{URL::asset('assets/img/assets/'.$pic)}}" class="img-responsive" height="150" width="150">
			<?php
				$mkid = $asset->MakeId;		$mdid = $asset->ModelId;
				$Asset_make = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();		
				$Asset_model = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
			?>
			<span class="pull-left"> <?= $asset->LicensePlate .' ' ?> </span> 
			<span style=""> <?= $Asset_make->Make.' '.$Asset_model->ModelName ?> </span> 
			</center>				
				
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
				
					
                  </div>
				</div>
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
					<?php //$this->element('insight'); ?> 
				</div>
				</div>
			
		  </div>

		  
		  
		  
		  
		  
<!-- TAB CONTENT FOR profile BEGIN -->  
<div class="tab-content">

  
  <div id="service" class="tab-pane fade in active">
  <div class="widget widget-table action-table">

	<div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    		
		<div>		 
			<fieldset>

                 <!-- <div class="datatables" id="expTable">   -->         
                <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Mileage</th>
                        <th>Last Maintenance</th>
                        <th>Due Date</th>
                        <th>Workshop</th>
                        <th scope="col" class="">  </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                        $Schedulemaintenances = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->orderBy('SchMaintId', 'desc')->get();
                    ?>
                        @foreach ($Schedulemaintenances as $Schedulemaintenances)
                            <tr>

                                <td>   
                                    <?php   //$id = $asset->MakeId;
                                        $asset = DB::table('asset')->where('AssetId', '=', $id)->first();
                                        echo $asset->LicensePlate;
                                    ?> 
                                </td>
                                <td>     {{ $Schedulemaintenances->	CurrentMile }}    </td>
                                <td>     {{ $Schedulemaintenances->LastMaintDate }}         </td>
                                <td>     {{ $Schedulemaintenances->DueDate }}       </td>
                                <td>     
                                    <?php   $wid = $Schedulemaintenances->WorkshopId;
                                        $workshop = DB::table('workshop')->where('WorkShopId', '=', $wid)->first();
                                        echo $workshop->WorkShopName;
                                    ?> 
                                </td>
                                <td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- </div> -->
		
			</fieldset>
	    </div>

		

		<!-- Main Application (Can be VueJS or other JS framework) -->
		<div class="app">
			<center>
				{!! $vehicle_service_chart->html() !!}
			</center>
		</div>
		{!! $vehicle_service_chart->script() !!}

	</div>

   </div>
  </div>
  
  

  <div id="jobs" class="tab-pane fade">
  <div class="widget widget-table action-table">

	  
	<!-- left content -->
    <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	<div class="pad">

    <?php //$data = array(0, 10, 5, 2, 20, 30, 45); foreach ($data as $value) {  echo $value.', '; }  ?>
	

    <!--  <div id="chartContainer" style="height:270px; width:40%"></div> -->
	<!-- Main Application (Can be VueJS or other JS framework) -->
	<div class="app">
			<center>
				{!! $vehicle_job_chart->html() !!}
			</center>
		</div>
	</div>
	<!-- End Of Main Application -->
	{!! $vehicle_job_chart->script() !!}
	
  
  </div>

  </div>
  </div>



  <div id="fuel" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	
		<div> 	
			  

		<div class="pad">
				 
	<!--  <canvas id="myChart">  </canvas>  -->
	<!-- Main Application (Can be VueJS or other JS framework) -->
	<div class="app">
			<center>
				{!! $vehicle_fuel_chart->html() !!}
			</center>
		</div>
		{!! $vehicle_fuel_chart->script() !!}
	

       </div> 
    </div>
	</div>
	
  </div>
  </div>

  <div id="profile" class="tab-pane fade">
  <div class="widget widget-table action-table ">
  
			 
			  
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

		<div> 
				 
	<form class="form-horizontal" method="post" action="{{ url('/asset/update', array($asset->AssetId)) }}">
		 
     <fieldset id="profiles">
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
		<CAPTION>Primary Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group"> 
				<label for="MakeId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle Make </label>
					<select class='sel-opt-left ronly' name='MakeId' id='MakeId' required>
							<option value="{{{ $assetmake->MakeId }}}"> {{ $assetmake->Make }} </option>

						<option class="option" value=""> Select Vehicle Make </option>
						
						@foreach ($assetmakes as $assetmakes)
							<option value="{{{ $assetmakes->MakeId }}}"> {{ $assetmakes->Make }} </option>
						@endforeach
					</select>	
				</div>
					
				<div class="form-group">
					<label for="VIN" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i> Vehicle Identification Number</label>
						<input type="text" class="ronly" name="VIN" id="VIN" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="{{{ $asset->VIN }}} " />	
				</div>
				
			  </td>
				<td width="50%"> 
				
				<div class="form-group">
				  <label for="ModelId" class="control-label label-right"> <i class="fa fa-car" aria-hidden="true"></i> Vehicle Model </label>
					<select class='sel-opt-right ronly' name='ModelId' id='ModelId' required>
							<option value="{{{ $assetmodel->ModelId }}}"> {{ $assetmodel->ModelName }} </option>

						<option class="option" value=""> Select Vehicle Model</option>
						
						@foreach ($assetmodels as $assetmodels)
							<option value="{{{ $assetmodels->ModelId }}}"> {{ $assetmodels->ModelName }} </option>
						@endforeach
				 </select>
				</div>
								
				<div class="form-group">
					<label for="LicensePlate" class="control-label label-right"> <i class="fa fa-taxi" aria-hidden="true"></i>  Vehicle License Plate</label>
						<input type="text" class=" ronly" name="LicensePlate" id="LicensePlate" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="{{{ $asset->LicensePlate }}}" />
				</div>
				</td>
			</tr>

		</table>
		
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px">
		<CAPTION>Secondary Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
				<label for="EqpYear" class="control-label label-left"> <i class="fa fa-calendar" aria-hidden="true"></i>  Vehicle Year </label>
						<input type="text" class=" ronly" name="EqpYear" id="EqpYear" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999" value="{{{ $asset->EqpYear }}} " />	
				</div>
				
				<div class="form-group">				
				<label for="AssetTypeId" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i>  Vehicle Body Type</label>
					<select class='sel-opt-left' name='AssetTypeId' id='AssetTypeId' required>
							<option value="{{{ $assettype->AssetTypeId }}}"> {{ $assettype->AssetTypeName }} </option>

						<option class="option" value=""> Select Vehicle Model</option>
						
						@foreach ($assettypes as $assettypes)
							<option value="{{{ $assettypes->AssetTypeId }}}"> {{ $assettypes->AssetTypeName }} </option>
						@endforeach
					 </select>
				</div>
				
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
				  <label for="FuelTypeId" class="control-label label-right"> <i class="fa fa-tint" aria-hidden="true"></i>  Vehicle Fuel Type</label>
					<select class='sel-opt-right' name='FuelTypeId' id='FuelTypeId' required>
							<option value="{{{ $fueltype->FuelTypeId }}}"> {{ $fueltype->FuelType }} </option>

						<option class="option" value=""> Select Vehicle Fuel Type</option>
						
						@foreach ($fueltypes as $fueltypes)
							<option value="{{{ $fueltypes->FuelTypeId }}}"> {{ $fueltypes->FuelType }} </option>
						@endforeach
					 </select>
				</div>
								
				<div class="form-group">
					<label for="Color" class="control-label label-right"> <i class="fa fa-toggle-on" aria-hidden="true"></i>  Vehicle Color </label>
					<select class='sel-opt-right' name='Color' id='Color' required>
							<option value="{{{ $color->Color }}}"> {{ $color->Color }} </option>

						<option class="option" value=""> Select Vehicle Color</option>
						
						@foreach ($colors as $colors)
							<option value="{{{ $colors->Color }}}"> {{ $colors->Color }} </option>
						@endforeach
					 </select>
				</div>
				</td>
			</tr>

		</table>
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px">
		<CAPTION>Location</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
					<label for="DeptId" class="control-label label-left"> <i class="fa fa-building" aria-hidden="true"></i> Vehicle Department</label>
						<select class='sel-opt-left' name='DeptId' id='DeptId' required>
								<option value="{{{ $department->DeptId }}}"> {{ $department->DeptName }} </option>

							<option class="option" value=""> Select Vehicle Department</option>
							
							@foreach ($departments as $departments)
								<option value="{{{ $departments->DeptId }}}"> {{ $departments->DeptName }} </option>
							@endforeach
						 </select>
				</div>
				
				<div class="radio" style="display:none"> 
					  @if($asset->Active == '1') 
					   &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Active" value="1" id="Active_0" checked /> 
					  In Service   <br> <br> 
					  &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Active" value="0" id="Active_1" />  Not In Service
					  

					  @elseif($asset->Active == '0') 
					  &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="Active" value="1" id="Active_2" /> 
					  In Service 
					 <br> <br> 
					 &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="Active" value="0" id="Active_3" checked /> Not In Service
					 @endif										  
				</div>
				
				<div class="form-group">				
					<input type="hidden" name="GPSIMEI" id="GPSIMEI" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" value="{{{ $asset->GPSIMEI }}} " />
				</div>
				
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
						<label for="LocationId" class="control-label label-right"> <i class="fa fa-map-marker" aria-hidden="true"></i>  Vehicle Location</label>
							<select class='sel-opt-right' name='LocationId' id='LocationId' required>
								<option value="{{{ $location->LocationId }}}"> {{ $location->LocationName }} </option>

							<option class="option" value=""> Select Vehicle Location</option>
							
							@foreach ($locations as $locations)
								<option value="{{{ $locations->LocationId }}}"> {{ $locations->LocationName }} </option>
							@endforeach
							</select>
					</div>
								 
				<div class="form-group">
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="4" class="pull-left" colspan="2"> 
					<div class="form-group" style="padding:20px 0px">
						<button type="submit" class="btn btn-primary" id="assetUpd">Update Vehicle Profile</button>
					</div> 
				</td>
			</tr>
		</table>

	</fieldset>
	</form>
		  
		  </div>
		  </div>
		  

   
  </div>
  </div>










  </div>
  
  
  </div>
  </div>
  </div>
</section> 

</div>














<script> //get id functions

	function pullId(id)
	{
		$('#Asset_id').val(id);   
    }
    
    function workOrder(id)
	{
		$('#Assetid').val(id);   
    }
    
    function Expensed(id)
	{
		$('#AssetIds').val(id);   
    }
    
    function FileUpload(id)
	{
		$('#Asset_Id').val(id);   
    }
	function AssProfileUpload(id)
	{
		$('#Ass_Id').val(id);   
    }
	
</script>


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_cate() 
	{
		var str = document.getElementById('Category').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   { 
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 			document.getElementById('Category').value = cap;
	}
	
	function convert_desc() 
	{
		var str = document.getElementById('Description').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   { 
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 			document.getElementById('Description').value = cap;
	}
	
	function convert_supp() 
	{
		var str = document.getElementById('Supplier').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   { 
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 			document.getElementById('Supplier').value = cap;
	}
	
	function convert_notes() 
	{
		var str = document.getElementById('Notes').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   { 
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 			document.getElementById('Notes').value = cap;
	}
</script>

<!-- SCRIPT TO Display Out Of Service And Retire  -->
<script>
	$(document).ready(function() 
	{
		var acts = $('#Active_0').val();
		if(acts == '1')
		{ 		  
				$('.pos').slideDown();	
		}

		$('.check_active').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#active').slideDown();	
			}
		});
		
		$('.check_retire').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#retire').slideDown();	
			}
		});
		
		$('.check_sccind').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#scc').slideDown();
			}
		});
		
		$('.check_reminder').on('change', function()
		{ 
		   if(this.checked) 	//if changed state is "CHECKED"
			{
				$('#reminder').slideDown();	
			}
		});
		
		//out of service script
		$('.check_act').on('change', function(e)
		{ 
			if(this.checked) //IF NO IS CHECKED THAT IS PUTTING VEHICLE BACK IN SERVICE   // if changed state is "CHECKED"
			{	//showing active form if the vehicle is active 
				$('#active').slideDown('fast');
				
				var EDate = $("#EDate").val();
				var _url_id = "@if($assetavailability) {{{$assetavailability->AssetAvailId}}} @endif";				
				var r = confirm("Are You Sure You Want To Put Vehicle Back In Service Today : " + EDate + " " + _url_id + " ?");
				if (r == true) 
				{	
					if(_url_id == '') { alert('Sorry Vehicle Already In Service.'); }
					else
					{
						var EndDate = $("#EDate").val();				
						var Status = '0';
						var updated_at = $("#modi").val();
						var _token = $("#_token").val();

						var updata = 'EndDate='+ EndDate + '&Status='+ Status + '&updated_at='+ updated_at + '&_token='+ _token;
						
						e.preventDefault();
						// AJAX Code To Submit Form.
						$.ajax(
						{
							type: "POST",
							url: "/assetavailability/updateAssetAvail/"+_url_id,
							data: updata,
							cache: false,
							success: function()
							{
								alert('Vehicle Has Been Put Back In Service.');			
							}
						});
					}
				} 
				else 
				{ 
					e.preventDefault();
					document.getElementById('Active_0').checked = true;
				}
					$('#active').fadeOut();
			}
		});
		
		$('.check_ret').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#retire').fadeOut();
			}
		});
		
		$('.check_scc').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#scc').fadeOut();
			}
		});
		
		$('.check_rem').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#reminder').fadeOut();
			}
		});
	});
</script>



<script>
    /*var ctx = document.getElementById('myChart').getContext('2d');
    var assets = "<?php $Asset = DB::table('asset')->get();  ?>";
    var chart = new Chart(ctx, 
    {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: 
        {
            labels: 
            ["January", "February", "March", "April", "May", "June", "July"],
            datasets: 
            [
                {
                    label: "My First dataset",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }
            ]
        },

        //Configuration options go here
        options: {}
    });*/
</script>


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
   
    var arrLen = arr.length;
    
    var chart = new Chart(ctx, 
    {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: 
        {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: 
            [
                {  <?php $arr = array(0, 10, 5, 2, 20, 30, 45); ?>
                    label: "My First dataset",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php foreach ($arr as $value) {  echo $value.' '; } ?>],
                }
            ]
        },

        //Configuration options go here
        options: {}
    });
</script>

	

   <!--  <div id="chartContainer" style="height:270px; width:40%"></div>  -->


@stop