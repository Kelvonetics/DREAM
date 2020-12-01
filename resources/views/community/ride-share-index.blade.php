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
	<div class="page-header" style="margin-bottom:10px;"><h1>      <i class="md md-share"></i>  Ride Share</h1>  
	<p class="lead"> The ride share module  allows you to efficiently manage your sharing of carpool. With real-time visibility into drivers and passager  <br>
	performance and powerful analytics, it’s easier to ultimately maximize your return on sharing rides (ROA). </p>	
		
		</div>

	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

    <!-- left content -->
        <div class="col-md-12 col-md-push-0"> 
        <a data-toggle="modal" data-target="#rideshare"class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;font-size:10px"> <i class="fa fa-plus"></i> Share A Ride</a>  
        <div class="well white">

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

    <table id="example" class="table table-full table-full-small job" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th> Driver </th>
                <th> Vehicle </th>
				<th> Departure Date </th>
				<th> Departure Time</th>
				<th> Departure City </th>
				<th> Destination City </th>
				<th> Cost </th>
                <th> Availability </th>
				<th style="" scope="col" class="action"></th>
			</tr>
        </thead>
        <tbody>
		@if($rideshare)
            @foreach ($rideshare as $rideshare)
            <tr>
                <td>
					<?php
						$uid = $rideshare->UserId;
                        $driver = DB::table('users')->where('UserId', '=', $uid)->first();		
					?> @if($driver) {{$driver->FirstName.' '.$driver->LastName}} @endif
				</td>
                <td>
					<?php
						$aid = $rideshare->AssetId;
						$asset = DB::table('asset')->where('AssetId', '=', $aid)->first();
					?> @if($asset) {{$asset->LicensePlate}} @endif
				</td>
                <td>{{$rideshare->DepartureDate}}</td>
				<td>{{$rideshare->DepartureTime}}</td>
				<td>{{$rideshare->DepartureCity}}</td>
                <td>{{$rideshare->DestinationCity}}</td>
                <td>{{ 'N'.$rideshare->Cost}}</td> 
                <td>
                    <?php
                         $rshare = DB::table('rideshare')->where('RideShareId', '=', $rideshare->RideShareId)->first();

                         $count_jshare = DB::table('joinride')->where('RideShareId', '=', $rideshare->RideShareId)->count();
                         if($count_jshare >= $rshare->NoOfPassengers){ echo '<span style="color:#DC143C">Filled</span>'; }
                         else if($count_jshare < $rshare->NoOfPassengers){ echo '<span style="color:#6495ED">Available</span>'; }
                    ?>
                </td> 
				<td style="overflow:visible">
				<div class="dropdown" style="">
					<button class="btn btn-primary dropdown-toggle" type="button" id="<?= $rideshare->RideShareId ?>" data-toggle="dropdown" style="font-size:9px">actions
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li>

                      <!-- LOGIN TO CHECK IF RIDE SEAT IS FULL -->                     
                       <?php  if($count_jshare >= $rshare->NoOfPassengers) {  }

                        else if($count_jshare < $rshare->NoOfPassengers){
                       ?>
                        <a onclick="rideShare({{ $rideshare->RideShareId }})" role="menuitem" data-toggle="modal" data-target="#joinride" style="font-size:11px"> Join Ride</a>
                        <?php } ?>
					  </li>
                      <li>
					    <a href="#" style="font-size:11px">View</a>
					  </li>
					  <li>
                        <a role="menuitem" href="{{route('community.rideshare-edit', $rideshare->RideShareId)}}" style="font-size:11px">Manage</a>
                    </li>
					  
					</ul> 
				 </div> 
			  </td>

            </tr>
            @endforeach
			@endif
        </tbody>
    </table>


</div>
  </div>
	
	
</div>
</div>
</section>

</div>




<!-- Ride Share Modal -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/community/insert-rideshare') }}">	
<div id="rideshare" class="modal fade" role="dialog" style="height:70%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;"> <i class="fa fa-car" aria-hidden="true"></i> New Ride Share </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.rideshare_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 


<!-- Ride Share Modal -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/community/insert-joinride') }}">	
<div id="joinride" class="modal fade" role="dialog" style="height:70%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;"> <i class="fa fa-car" aria-hidden="true"></i> Join Ride </h4>
        
        <div class="form-group"> <label for="mail" class="control-label"> Already A User? </label>            
            <input type="email" class="" name="mail" id="mail" style="border:thin #ede solid;	width:40%;	padding:3px 5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="Email" />	
        </div>

        <div class="form-group">
            
            <select class='pull-right sel-opt-right' style="border:thin #ede solid;	width:40%;	padding:3px 5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" name='RideShare_Id' id='RideShare_Id' required>
                <option class="option"> Select Your Full Name </option>
				@if($joinride)
					@foreach ($joinride as $joinride)  
						<option value="{{{ $joinride->RideShareId }}}"> {{ $joinride->FirstName.' '.$joinride->LastName }} </option>
					@endforeach
				@endif
            </select>
            <label for="UserId" class="pull-right control-label label-right"> <i class="fa fa-user" aria-hidden="true"></i> Driver </label>
        </div>

      </div>
      <div class="modal-body">
       

	  @include('modals.joinride_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 












<script>
    function rideShare(id){ 	$('#RideShareId').val(id);    }
</script>





<script>
	$(document).ready(function()
	{
		$('#RideShareId').change(function(e)
		{
			console.log(e);
			var id = e.target.value;
			$.get('/fetchjoinrideuser?RideShareId=' + id, function(data)
			{  //success data  
                fname = data[0].FirstName;
                document.getElementById('FirstName').value = fname;
			});				
		});
	});
</script> 





<script>
	$(document).ready(function()
	{
		$('.job').dataTable();
	});
</script>	

<script>
     $(document).ready(function() {
      $('.progress .progress-bar').css("width",
                function() {
                    return $(this).attr("aria-valuenow") + "%";
                }
        )
    });
 </script>




@stop