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
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 5%;
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
		color:#666; margin:auto 0% auto 5%;
	}
.label-center
	{
		color:#666; margin:auto 0% auto 2%;
	}
.label-full
	{
		color:#666; margin:auto 0% auto 2%;
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
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;"><h1>      <i class="md md-share"></i> Manage Ride Share</h1>  
	<p class="lead"> The ride share module  allows you to efficiently manage your sharing of carpool. With real-time visibility into drivers and passager  <br>
	performance and powerful analytics, it’s easier to ultimately maximize your return on sharing rides (ROA). </p>	
		
		</div>

        <!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-20px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card"> 

			<center> <img src="{{URL::asset('assets/img/rideshare2.jpg')}}" class="img-responsive" height="200" width="200"> </center>	
				
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
                      <div class="pull-right" style="margin:-5px -25px; color:#fff"><a onclick="workOrder('$asset->AssetId')" href="#" class="btn btn-circle-green" data-tooltip="true" data-toggle="modal" data-target="#workModal" title='Create Work Order For Asset'>View</a></div>
                      <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href=""> Ride Share History </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a onclick="pullId('$asset->AssetId')" href="" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn"  data-toggle="modal" data-target="#fuelModal" title='Add New Fuel Log'>View</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#"> Frequent Routes </a></div>
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
    <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:0px 0px 0px 10px">   
        <div class="">

        @if(count($errors) > 0)
			@foreach($errors->all() as $errors)
				<div class="alert alert-danger"> {{ $errors }} </div>
			@endforeach
		@endif

		@if(session('info'))
			<div class="alert" style="background-color:#ACE1AF">
				{{session('info')}}
			</div>		
		@endif

        <form class="form-horizontal" method="post" action="{{ url('/community/rideshare-update', array($rideshares->RideShareId)) }}">
      <LEGEND> Edit Ride Share </LEGEND>

        <fieldset id="profiles">
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
		<CAPTION>Primary Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group"> 
				<label for="AssetId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle </label>
					<select class='sel-opt-left ronly' name='AssetId' id='AssetId' required>
                        <?php
                            $asId = $rideshares->AssetId; 
                            $asset = DB::table('asset')->where('AssetId', '=', $asId)->first();
                        ?>
                        @if($asset)
						<option value="{{{ $asset->AssetId }}}"> {{ $asset->LicensePlate }} </option>
						@endif
                        <option class="option" value=""> Select Vehicle </option>
						@if($assets)
						@foreach ($assets as $assets)
							<option value="{{{ $assets->AssetId }}}"> {{ $assets->LicensePlate }} </option>
						@endforeach
						@endif
					</select>	
				</div>
					
				<div class="form-group">
					<label for="DepartureDate" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i> DepartureDate </label>
						<input type="text" class="datepicker" name="DepartureDate" id="DepartureDate" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($rideshares) value="{{$rideshares->DepartureDate}}"@endif required />	
				</div>

                <div class="form-group">
					<label for="DepartureCity" class="control-label label-left"> <i class="fa fa-globe" aria-hidden="true"></i> Departure City </label>
						<input type="text" class="" name="DepartureCity" id="DepartureCity" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($rideshares) value="{{$rideshares->DepartureCity}}"@endif required />	
				</div>

                <div class="form-group">
					<label for="Duration" class="control-label label-left"> <i class="fa fa-hourglass-3" aria-hidden="true"></i> Duration In Hours </label>
						<input type="number" class="" name="Duration" id="Duration" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($rideshares) value="{{$rideshares->Duration}}"@endif required />	
				</div>

                <div class="form-group"> 
				<label for="AssetId" class="control-label label-left"> <i class="fa fa-users"></i> No Of Passengers </label>
					<select class='sel-opt-left ronly' name='NoOfPassengers' id='NoOfPassengers' required>
					@if($rideshares) <option class="option" value="{{$rideshares->NoOfPassengers}}">
                        {{$rideshares->NoOfPassengers.'  Passengers'}} </option> 
					@endif
                        <option class="option" value=""> Select Number Of Passengers </option>
                        <option class="option" value="1"> 1 Passengers </option>
                        <option class="option" value="2"> 2 Passengers </option>
                        <option class="option" value="3"> 3 Passengers </option>
                        <option class="option" value="4"> 4 Passengers </option>
                        <option class="option" value="5"> 5 Passengers </option>
                        <option class="option" value="20"> 10 + Passengers </option>
                        <option class="option" value="20"> 20 + Passengers </option>
                        <option class="option" value="30"> 30 + Passengers </option>
                        <option class="option" value="40"> 40 + Passengers </option>
                        <option class="option" value="50"> 50 + Passengers </option>
					</select>	
				</div>

                <div class="form-group"> <label for="Status" style="margin-left:25px"> <i class="fa fa-question"></i> Is This Ride Still Available? </label>
                    <div class="radio" style="margin:3px 25px"> 
                        @if($rideshares->Status == '1')
                            <label> <input type="radio" name="Status" value="1" id="Status_0" checked /> Yes </label>  
                            <label style="margin-left:10px">  <input type="radio" name="Status" value="0" id="Status_1" />  No  </label>

                            
                            @elseif($rideshares->Status == '0')
                            <label> <input type="radio" name="Status" value="1" id="Status_2" /> Yes </label>
                            <label style="margin-left:10px"> <input type="radio" name="Status" value="0" id="Status_3" checked  />  No </label>
                        @endif	  
                    </div>
				</div>
				
			  </td>




				<td width="50%"> 
				
				<div class="form-group">
				  <label for="UserId" class="control-label label-right"> <i class="fa fa-user" aria-hidden="true"></i> Driver </label>
					<select class='sel-opt-right ronly' name='UserId' id='UserId' required>
                        <?php
                            $usId = $rideshares->UserId; 
                            $driver = DB::table('users')->where('UserId', '=', $usId)->first();
                        ?>
                        @if($driver)
						<option value="{{{ $driver->UserId }}}"> {{ $driver->FirstName.' '.$driver->LastName }} </option>
						@endif
						
                        <option class="option"> Select Driver </option>
						@if($operators)
						@foreach ($operators as $operators)  
                        <?php 
                            $opsId = $operators->UserId; 
                            $drivers = DB::table('users')->where('UserId', '=', $opsId)->first();
                         ?>
							<option value="{{{ $drivers->UserId }}}"> {{ $drivers->FirstName.' '.$drivers->LastName }} </option>
						@endforeach
						@endif
				 </select>
				</div>
								
				<div class="form-group">
					<label for="DepartureTime" class="control-label label-right"> <i class="fa fa-calendar" aria-hidden="true"></i>  Departure Time</label>
						<input type="text" class="timepicker" name="DepartureTime" id="DepartureTime" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999"@if($rideshares) value="{{$rideshares->DepartureTime}}"@endif required />
				</div>

                <div class="form-group">
					<label for="DestinationCity" class="control-label label-right"> <i class="fa fa-globe" aria-hidden="true"></i>  Destination City</label>
						<input type="text" class="" name="DestinationCity" id="DestinationCity" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999"@if($rideshares) value="{{$rideshares->DestinationCity}}"@endif required />
				</div>

                <div class="form-group"> <label for="Stoppages" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> Stoppages </label>
                    <div class="radio" style="margin:3px 25px"> 
                            @if($rideshares->Stoppages == '1')
                                <label> <input type="radio" name="Stoppages" value="1" id="Stoppages_0" checked /> Yes </label>  
                                <label style="margin-left:10px">  <input type="radio" name="Stoppages" value="0" id="Stoppages_1" />  No  </label>

                                
                                @elseif($rideshares->Stoppages == '0')
                                <label> <input type="radio" name="Stoppages" value="1" id="Stoppages_2" /> Yes </label>
                                <label style="margin-left:10px"> <input type="radio" name="Stoppages" value="0" id="Stoppages_3" checked  />  No </label>
                            @endif	  
                    </div>
					</div>

                    <div class="form-group">
					<label for="Cost" class="control-label label-right"> <i class="fa fa-usd" aria-hidden="true"></i> Cost \ Contribution</label>
						<input type="text" class="" name="Cost" id="Cost" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999"@if($rideshares) value="{{$rideshares->Cost}}"@endif required />
				</div>

				</td>
			</tr>

			<tr>
				<td>
					<div class="form-group" style="padding:20px 5px">
						<button type="submit" class="btn btn-primary" id="assetUpd">Update Share Ride</button>
					</div>
				</td>
				<td>
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</td>
			</tr>

		</table>
		
	

	</fieldset>
    </form>





	
</div>
</div>
</section>

</div>



@stop