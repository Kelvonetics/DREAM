@extends('templates.default')

@section('content')


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
		width:93%;
		padding:5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:93%;
		padding:5px;
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
		margin:auto -1% auto 3%;
	}

.inp
	{
		border:thin #ede solid;
		width:93%;	padding:5px;	
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
		color:#666; margin:auto -1% auto 3%;
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
</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-taxi"></i>     Auto Dealer </h1> 
            <p class="lead"> The auto dealer Make module  allows you to efficiently manage your entire  auto dealer. With real-time visibility into  auto dealer <br>performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
	</div>
	
	
	<div class="">
              
		 <!-- right content -->
         <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
         <div class="pull-right" style="margin:-25px -20px 0px 0px">
         <ul class="list-unstyled">
             <li class="dropdown">
             <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
             </li>
         </ul>
         </div>
 
         <div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
         <div class="well white white-card"> 				 
         <center> <img src="{{URL::asset('assets/img/nocar.jpg')}}" class="img-responsive" height="150" width="150"> </center>
             
         </div>  	
 
             <!-- quick information div  -->
             <div class="grey-card">
             <div style="margin:-10px 15px 0px 10px">
             
             </div>
             </div>
 
         </div>
  

		<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
		
      <form class="form-horizontal" method="post" action="{{ url('/autodealer/update', array($autodealer->DealerId)) }}">
      <LEGEND> Edit Auto Dealer </LEGEND>
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
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Dealer Details</CAPTION>
			<tr class="box-section">
				<td width="50%">
					<div class="form-group">
						<label for="DealerName" class="control-label label-left"> <i class="fa fa-user"></i> Dealer Name</label>
						<input type="text" name="DealerName" id="DealerName" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"@if($autodealer) value="{{$autodealer->DealerName}}"@endif Required onkeyup="convert_name()">
					</div>
					
					<div class="form-group">
						<label for="DealerEmail" class="control-label label-left"> <i class="fa fa-envelope"></i> Dealer Email</label>
						<input type="email" name="DealerEmail" id="DealerEmail" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"@if($autodealer) value="{{$autodealer->DealerEmail}}"@endif Required>
					</div>					
			  </td>
				<td width="50%"> 
					<div class="form-group">
						<label for="PhoneNo" class="control-label label-right"><i class="fa fa-phone"></i> Phone Number</label>
						<input type="text" name="PhoneNo" id="PhoneNo" style="border:thin #ede solid;	width:93%;	padding:5px;  border-radius:2px;margin:auto -1% auto 3%; color:#999"@if($autodealer) value="{{$autodealer->PhoneNo}}"@endif Required> 
					</div>
					
					<div class="form-group" style="margin-left:-25px"> 
					<label for="Active" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> Make Active </label>
                        <div class="radio" style="margin-left:25px"> 
                            @if($autodealer->Active == '1')
                                <label> <input type="radio" name="Active" value="1" id="Active_0" checked /> Yes </label>  
                                <label style="margin-left:10px">  <input type="radio" name="Active" value="0" id="Active_1" />  No  </label>
                                
                             @elseif($autodealer->Active == '0')
                                <label> <input type="radio" name="Active" value="1" id="Active_2" /> Yes </label>
                                <label style="margin-left:10px"> <input type="radio" name="Active" value="0" id="Active_3" checked  />  No </label>
                            @endif	  
                        </div>
					</div> 
				</td>

			</tr>
			
			<tr> <td style="margin-left:-15px"> Dealer Address </td><td> </td> </tr>
			
			<tr class="box-section">
				<td colspan="2">
					<div class="form-group">
						<label for="DealerAddress" class="control-label label-left" style="margin-left:20px"><i class="fa fa-map-marker"></i> Dealer Address</label>
						<input type="text" name="DealerAddress" id="DealerAddress" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px;margin:auto 2% auto 2%; color:#999"@if($autodealer) value="{{$autodealer->DealerAddress}}"@endif Required onkeyup="convert_addr()">
					</div>
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control"@if($autodealer) value="{{$autodealer->CreatedBy}}"@endif readonly >
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
			  </td>
			</tr>
			
			<tr class="box-section">
				<td width="50%">
					<div class="form-group">
						<label for="DealerState" class="control-label label-left"><i class="fa fa-map-marker"></i> Dealer State</label>
						<input type="text" name="DealerState" id="DealerState" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"@if($autodealer) value="{{$autodealer->DealerState}}"@endif Required onkeyup="convert_state()">
					</div>		
			  </td>
				<td width="50%"> 
					<div class="form-group">
						<label for="CountryId" class="control-label label-right"><i class="fa fa-globe"></i> Dealer Country</label>
						<select class='sel-opt-right' name='CountryId' id='CountryId'required>
							<?php
								$adcid = $autodealer->CountryId;
								$Country = DB::table('country')->where('CountryId', '=', $adcid)->first();
							 ?>
							 @if($Country)<option value="{{{ $Country->CountryId }}}"> {{ $Country->CountryName }} </option>@endif
                            <option value="">Select Dealer Country</option>
							@if($country)
                            @foreach ($country as $country)
                                <option value="{{{ $country->CountryId }}}"> {{ $country->CountryName }} </option>
                            @endforeach	
							@endif					
						</select>
					</div>
				</td>

			</tr>
			
			
			
			<tr>
			<td colspan="2">
				<div class="form-group" style="margin-left:-6px">
					<button type="submit" class="btn btn-primary">Update Auto Dealer</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				</div>
			</td>
			</tr>
		</table>
		</Form>
	</div>
	</div>
	
	
	</div>

</section>


</div>







<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_name() 
	{
		var str = document.getElementById('DealerName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('DealerName').value = cap;
	}
	
	function convert_addr() 
	{
		var str = document.getElementById('DealerAddress').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('DealerAddress').value = cap;
	}
	
	function convert_state() 
	{
		var str = document.getElementById('DealerState').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('DealerState').value = cap;
	}
</script>





@stop