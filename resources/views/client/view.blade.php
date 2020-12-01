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
.left-side
{
	margin-top:-50px;
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
		padding:10px 5px;
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

.sel-opt-full
	{
		border:thin #ede solid;
		width:96%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 1% auto 2%;
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
		color:#666; margin:auto 0% auto 3%;
	}
.label-full
	{
		color:#666; margin:auto 1% auto 2%;
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
.notif
	{
		background-color:red;     /* #E52B50 */
		color:white;
	}
.modal 
	{
		max-width:900px;
	}
	
</style>

<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header"> <h1>      <i class="fa fa-female"></i>   Client Administration  </h1>
	  <p class="lead">  The client administration module allows you to manage and analyze customer interactions and data throughout the customer lifecycle, with 
	  <br> the goal of improving business relationships with your customers, assisting in customer retention and driving sales growth. 
	  </p>
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
	<div class="">
			
<div class="widget-content" id="tabCont">

<ul class="nav nav-tabs card" style="width:75%">

      <li><a class="active" data-toggle="tab" href="#profile"><span><i class="fa fa-male"></i> Profile</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#contact"><span><i class="fa fa-user"></i> Contacts</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#asset"><span><i class="fa fa-car"></i> Assets</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#quote"><span><i class="fa fa-tags"></i> Quotes</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#invoice"><span><i class="fa fa-file-text-o"></i> Invoices</span> </a> </li>	  
	  <li><a class="" data-toggle="tab" href="#email"><span><i class="fa fa-envelope"></i> E-mails</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#notes"><span><i class="fa fa-pencil"></i> Notes</span> </a> </li>
  
</ul>


	
	
<!-- right content -->
	<div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<a href="#" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More"> 
				<div class="badge notif"></div>  <i class="fa fa-area-chart"></i>
				</a>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>  	
			<div class="well white white-card"> 
			<a href="{{route('client.clientprofile', $id)}}" class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple pull-right" style="margin-right:-20px;" title="Upload Client Profile Photo"> <i class="fa fa-photo" style="color:red;"></i> </a>
			
				@if($client)

					<?php $pic = $client->ClientPicture;  
                    if ($pic != null)	{	$pix = '/assets/img/clients/'.@$pic; }         
                    else { $pix = '/assets/img/avatar.jpg';  } ?>

                @endif   
				
                <center> <img src="{{URL::asset($pix)}}" class="img-responsive" height="150" width="150"> </center>
			    
				<center> <i class="grey-text m-b-30" >   <?= $client->FirstName.' '.$client->LastName  ?> </i>  </center>
			</div>
			
				<!-- quick report div  -->
				<div class="grey-card" style="padding:0px 0px 0px 25px">
				<table class="table" width="105%" cellpadding="0">
					<tr>
						<td style="width:95%"> 
							<h4 class="grey-text m-b-30">   Quick Reports  </h4>
									</td>
						<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
					</tr>
				</table>
				
					<div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a href="" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn"  data-toggle="modal" data-target="#clientJobModal" title='Add New Client Job'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Jobs </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a href="" class="btn btn-circle-green" data-toggle="modal" data-target="#clientInvoiceModal" data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Add New Client Job'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Invoices From Last 30 Days </a></div>
                    </div>
					
                  </div>
				</div>
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
					<?php  //$this->element('asset_insight');?> 
				</div>
				</div>
			
		  </div>


		  
		  
<?php $ctid = $client->ClientId; ?>
<!-- TAB CONTENT FOR profile BEGIN -->  
<div class="tab-content">
  <div id="profile" class="tab-pane fade in active">
  <div class="widget widget-table action-table">

  
	 <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
	
		<div> 
		 <form class="form-horizontal" method="post" action="{{ url('/client/update', array($client->ClientId)) }}">
			<fieldset>
					
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Client Details </CAPTION>
			
					<tr class="box-section">
						<td width="50%">  
							<div class="form-group">
								<label for="FirstName" class="fm-label label-left"> <i class="fa fa-male" aria-hidden="true"></i> First Name </label>
								<input type="text" name="FirstName" id="FirstName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($client) value="{{$client->FirstName}}"@endif />
							</div>
							
							<div class="form-group">
								<label for="Email" class="fm-label label-left">  <i class="fa fa-envelope" aria-hidden="true"></i> E-mail</label>
								<input type="email" name="Email" id="Email" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($client) value="{{$client->Email}}"@endif />
							</div>
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="LastName" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-male" aria-hidden="true"></i> Last Name</label>
								<input type="text" name="LastName" id="LastName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($client) value="{{$client->LastName}}"@endif />
							</div>
								
							<div class="form-group">
								<label for="Phone" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-phone" aria-hidden="true"></i> Phone </label>
								<input type="text" name="Phone" id="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($client) value="{{$client->Phone}}"@endif />
							</div>
						</td>
					</tr>
					
					<tr class="box-section"> 
						<td width="100%" colspan="2">
							<div class="form-group">
								<label for="Company" class="fm-label label-full" style="margin-left:2%;"> <i class="fa fa-building" aria-hidden="true"></i> Company </label>
								<input type="text" name="Company" id="Company" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px;margin:auto 1% auto 2%; color:#999"@if($client) value="{{$client->Company}}"@endif />
							</div>
						</td> 						
					</tr>
				</table>

				
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Client Address</CAPTION>
			
					<tr class="box-section">
						<td width="50%">  
							<div class="form-group">
								<label for="Address" class="fm-label label-left"> <i class="fa fa-map-marker" aria-hidden="true"></i> Street Address * </label>
								<input type="text" name="Address" id="Address" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($client) value="{{$client->Address}}"@endif />
							</div>
							
							<div class="form-group">
								<label for="City" class="fm-label label-left"> <i class="fa fa-map-marker" aria-hidden="true"></i> City</label>
								<input type="text" name="City" id="City" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($client) value="<?= $client->City ?>"@endif />
							</div>
							
							<div class="form-group">
								<input type="hidden" name="CID" id="CID"@if($client) value="{{$client->ClientId}}"@endif />
							</div>
						
						
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="Address_2" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-map-marker" aria-hidden="true"></i> Street Address 2</label>
								<input type="text" name="Address_2" id="Address_2" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($client) value="{{$client->Address_2}}"@endif />
							</div>
								
							<div class="form-group">
								<label for="State" class="fm-label label-right" style="margin-left:3%;">  <i class="fa fa-map-marker" aria-hidden="true"></i> State </label>
								<input type="text" name="State" id="State" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($client) value="{{$client->State}}"@endif />
							</div>
							
							<div class="form-group">
								
							</div>
								
						</td>
					</tr>
					
					<tr class="box-section"> 
						<td width="100%" colspan="2">
							<div class="form-group">
								<label for="Country" class="fm-label label-full" style="margin-left:2%;"> <i class="fa fa-globe" aria-hidden="true"></i> Country</label>
							<select class='sel-opt-full' name='Country' id='Country' style="width:96%;margin-left:2%;" required>
							@if($client)
							<option value="{{{ $client->Country }}}"> {{ $client->Country }} </option>
							@endif
                                <option value="">Select Country</option>
							@if($countrys)
                                @foreach ($countrys as $countrys)
                                    <option value="{{{ $countrys->CountryName }}}"> {{ $countrys->CountryName }} </option>
                                @endforeach
							@endif							
							</select>	
						
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$client->CreatedBy}}" readonly >
                        <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
							</div>
						</td> 						
					</tr>
					<tr>
						<td colspan="4" class="pull-left" colspan="2"> 
							<div class="form-group" style="padding:10px">
								<button type="submit" class="btn btn-primary" id="edtCliBtn">Update Client Profile</button>
							</div> 
						</td>
					</tr>
				</table>

		
			</fieldset>
		</Form>
		</div>
 
		  
	
	</div>
	
   </div>
  </div>  

   
  
  <div id="contact" class="tab-pane fade in">
  <div class="widget widget-table action-table">

  
	 <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
	
		<div> 

		 <Form
			<fieldset>
					
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Contact Details</CAPTION>
			
					<tr class="box-section">
						<td width="50%">  
							<div class="form-group">
								<label for="ContFirstName" class="fm-label label-left"> <i class="fa fa-male" aria-hidden="true"></i> First Name </label>
								<input type="text" name="ContFirstName" id="ContFirstName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="" />
							</div>
							
							<div class="form-group">
								<label for="ContEmail" class="fm-label label-left">  <i class="fa fa-envelope" aria-hidden="true"></i> E-mail</label>
								<input type="email" name="ContEmail" id="ContEmail" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="" />
							</div>
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="ContLastName" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-male" aria-hidden="true"></i> Last Name</label>
								<input type="text" name="ContLastName" id="ContLastName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="" />
							</div>
								
							<div class="form-group">
								<label for="ContPhone" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-phone" aria-hidden="true"></i> Phone </label>
								<input type="text" name="ContPhone" id="ContPhone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="" />
							</div>
						</td>
					</tr>
					
					<tr class="box-section"> 
						<td width="100%" colspan="2">
							<div class="form-group">
								<label for="ContCompany" class="fm-label label-full"> <i class="fa fa-building" aria-hidden="true"></i> Company </label>
								<input type="text" name="ContCompany" id="ContCompany" style="border:thin #ede solid;	width:97%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 1.5%; color:#999" value="" />
							</div>
						</td> 						
					</tr>
				</table>

				
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Contact Address</CAPTION>
			
					<tr class="box-section">
						<td width="50%">  
							<div class="form-group">
								<label for="ContAddress" class="fm-label label-left"> <i class="fa fa-map-marker" aria-hidden="true"></i> Street Address * </label>
								<input type="text" name="ContAddress" id="ContAddress" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="" />
							</div>
							
							<div class="form-group">
								<label for="ContCity" class="fm-label label-left"> <i class="fa fa-map-marker" aria-hidden="true"></i> City</label>
								<input type="text" name="ContCity" id="ContCity" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="" />
							</div>
							
							<div class="form-group">
							
							</div>						
						
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="ContAddress_2" class="fm-label label-right" style="margin-left:3%;"> <i class="fa fa-map-marker" aria-hidden="true"></i> Street Address 2</label>
								<input type="text" name="ContAddress_2" id="ContAddress_2" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="" />
							</div>
								
							<div class="form-group">
								<label for="ContState" class="fm-label label-right" style="margin-left:3%;">  <i class="fa fa-map-marker" aria-hidden="true"></i> State </label>
								<input type="text" name="ContState" id="ContState" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="" />
							</div>
							
							<div class="form-group">
							
							</div>
								
						</td>
					</tr>
					
					<tr class="box-section"> 
						<td width="100%" colspan="2">
							<div class="form-group">
								<label for="ContCountry" class="fm-label label-full"> <i class="fa fa-globe" aria-hidden="true"></i> Country</label>
							<select class='sel-opt-full' name='ContCountry' id='ContCountry' style="width:97%" required>
                                <option value="{{{ $client->Country }}}"> {{ $client->Country }} </option>
                                <option value="">Select Country</option>
                                @foreach ($country as $country)
                                    <option value="{{{ $country->CountryName }}}"> {{ $country->CountryName }} </option>
                                @endforeach	
							
							</select>	
						
						<input type="hidden" name="ContCreatedBy" id="ContCreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
							</div>
						</td> 						
					</tr>
				</table>

			<div class="form-group" style="padding:20px 0px">
				<button type="button" class="btn btn-primary" id="edtContBtn">Update Client Contact</button>
			</div> 

		
			</fieldset>
		</Form>
		</div>
 
		  
	
	</div>
	
   </div>
  </div> 
 

 
  <div id="asset" class="tab-pane fade">
  <div class="widget widget-table action-table">

			
			
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   <br>
	
 
	  <a onclick="clientAsset({{ $client->ClientId }})" class="waves-effect waves-light btn btn-primary modalBtn"  data-toggle="modal" data-target="#clientAssetModal" title='Add New Client Asset' 
		href="" style="color:white"><i class="fa fa-plus"></i> New Vehicle</a>
		
		<a class="pull-right" href="#" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="No Of Day(s) To Maintenance"> 
				
		<?php		if(@$rem_dintval >= @$noOfDays){	echo '<div class="badge notif">'. @$noOfDays.' </div>';	} 	?>     </a>

		<div class="pad">
		  <table id="example" class="table table-full table-full-small casset" cellspacing="1" width="100%">
            <thead>
				<tr>
					<th> Id </th>
					<th> License Plate </th>
					<th> Make </th>
					<th> Model </th>
					<th> Type </th>
					<th> Vehicle Id No </th>
					<th> Year </th>
					<th> Due Date </th>
					<th> Status </th>
					<th> </th>
				</tr>
            </thead>
                <tbody>
                    @if($clientassets)
                    @foreach($clientassets as $clientassets)
					<?php $retired = DB::table('clientassetretiredetail')->where('AssetId', '=', $clientassets->AssetId)->first();  ?>
                    <tr @if($retired) style="color:#FF9966" @endif>	
                        <td> {{$clientassets->AssetId}} </td>
                        <td> {{$clientassets->LicensePlate}} </td>
                        <td> 
                            <?php                                
								$mkid = $clientassets->MakeId;
								$clientassetmake = DB::table('assetmake')->where('MakeId', '=', $mkid)->first(); 
                            ?> @if($clientassetmake) {{$clientassetmake->Make}} @endif
                        </td>
                        <td> 
                            <?php
                                $mdid = $clientassets->ModelId;
								$clientassetmodel = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first(); 
							?> @if($clientassetmodel) {{$clientassetmodel->ModelName}} @endif
                            </td>
                        <td> 
                            <?php
                                $atype = $clientassets->AssetTypeId;
								$clientassettype = DB::table('assettype')->where('AssetTypeId', '=', $atype)->first(); 
							?> @if($clientassettype) {{$clientassettype->AssetTypeName}} @endif 
                        </td>
                        <td> {{$clientassets->VIN}} </td>
                        <td> {{$clientassets->EqpYear}} </td>
						<td> 
							<?php
								$ca_id = $clientassets->AssetId;
								$Due_date = DB::table('clientschedulemaintenance')
								->where('AssetId', '=', $ca_id)->orderBy('SchMaintId', 'desc')->first();  
							?>
							@if($Due_date) {{ $Due_date->DueDate }} @endif
						</td>
						<td align="left" style="color:#fff"><?php $act = $clientassets->Active; if($act == 1) { ?>
						<?= $act ?><img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px">
								<?php } else { ?>
						<?= $act ?><img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px"> 
							<?php } ?>
						</td>
                        <td style="overflow:visible">		
                            <div class="dropdown" style="">
                                <button class="btn btn-success dropdown-toggle" type="button" id="{{$client->ClientId}}" data-toggle="dropdown" style="font-size:9px">
                                <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                    <li><a href="{{route('clientasset.edit', $clientassets->AssetId)}}" style="font-size:11px">View Profile</a></li>
                                    <li><a onclick="clientReset({{$clientassets->AssetId}})" role="menuitem" id="" data-toggle="modal" data-target="#reminderModal" style="font-size:11px">Reset Reminder</a></li> 

									<!-- LOGIN FOR ACTIVE AND INACTIVE -->
                                    @if($act == 1)
									<li><a onclick="clientInactive({{$clientassets->AssetId}})" role="menuitem" id="" data-toggle="modal" data-target="#inactiveModal" style="font-size:11px"> Make Inactive </a></li> 
									@elseif($act == 0)
									<li><a onclick="clientActive({{$clientassets->AssetId}})" role="menuitem" id="" data-toggle="modal" data-target="#activeModal" style="font-size:11px"> Make Active </a></li> 
									@endif

									<!-- LOGIN FOR RETIRE ASSET -->
									<?php 
										$rt_as_id = $clientassets->AssetId;
										$Retire = DB::table('clientassetretiredetail')->where('AssetId', '=', $rt_as_id)->first();
									?>
									@if(!$Retire)
                                    <li><a onclick="clientRetire({{$clientassets->AssetId}})" role="menuitem" id="retiredBtn" data-toggle="modal" data-target="#retireModal" style="font-size:11px">Retire Asset</a></li>
									@endIf
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
		

		
  
  <div id="quote" class="tab-pane fade">
  <div class="widget widget-table action-table">
	
	
	<!-- left content -->
		  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   <br>
		

			<a onclick="clientWorkOrder({{$client->ClientId}})" class="waves-effect waves-light modalBtn btn btn-primary" data-tooltip="true" data-toggle="modal" data-target="#quoteModal" title='Create New Client Quote' 
			href="" name="view" style="color:white"><i class="fa fa-plus"></i> New Quote</a> 

				<div  id="clientAsset"> 
		<div class="pad">
	  <table id="example" class="table table-full table-full-small workDTable" cellspacing="1" width="100%">					
		<thead>
		<tr>
			<th> WO No </th>
			<th> Plate No </th>
			<th> Start Date </th>
			<th> End Date </th>
			<th> Status </th>
			<th> Type </th>
			<th>  </th>
		</tr>
		</thead>
		
	<tbody>
		@if($clientworkorders)
		@foreach($clientworkorders as $clientworkorders)
        <tr>
            <td> {{$clientworkorders->WorkOrderNumber}} </td>
            <td> 
                <?php
                    $aid = $clientworkorders->AssetId;
                    $c_asset = DB::table('clientasset')->where('AssetId', '=', $aid)->first();
                 ?> @if($c_asset) {{$c_asset->LicensePlate}} @endif
             </td>
             <td> {{$clientworkorders->ServiceDate}} </td>
             <td> {{$clientworkorders->ServiceCompletionDate}} </td>
             <td align="left" style="color:#fff"><?php $act = $clientworkorders->WorkOrderStatusId; if($act == 1) { ?>
				<?= $act ?><img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px">
					 <?php } else { ?>
				<?= $act ?><img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px"> 
				 <?php } ?>
			 </td>
             <td> {{$clientworkorders->MaintenanceType}} </td>
			 <td class="actions">
                <a href="{{route('clientworkorder.edit', $clientworkorders->WorkOrderNumber)}}" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a>				
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
</div>		

 

  
  
  <div id="invoice" class="tab-pane fade">
  <div class="widget widget-table action-table">
    
	
	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   <br>

	  <a onclick="clientInvoice(<?= $client->ClientId ?>)" class="waves-effect waves-light modalBtn btn btn-primary" data-tooltip="true" data-toggle="modal" data-target="#invoiceModal" title='Create New Client Invoice' 
			href="#" name="view" style="color:white"><i class="fa fa-plus"></i> New Invoice</a> 
	<div class="pad">
    <table id="example" class="table table-full table-full-small invoiceDTable" cellspacing="1" width="100%">	
		<thead>
			<tr style="background-color:#f9f9f9;">
				<th> Invoice No </th>
				<th> Due Date </th>
				<th> Total Cost </th>
				<th> Status </th>
				<th> Payment </th>
				<th>  </th>
			</tr>
		</thead>
		<tbody>
			@if($invoices)
			@foreach($invoices as $invoices)
			<tr>	
                <td> {{$invoices->InvoiceNumber}} </td>
                <td> {{$invoices->DueDate}} </td>
                <td> {{$invoices->TotalCost}} </td>
                <td> {{$invoices->Status}} </td>
                <td> {{$invoices->PaymentMethod}} </td>
				<td class="actions">
                    <a href="{{route('invoice.edit', $invoices->InvoiceId)}}" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a>				
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
  
  
  

  

  
  <div id="email" class="tab-pane fade in ">
  <div class="widget widget-table action-table">

  
	 <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
	
		<div> 
		<?php   //$c_id = $client->ClientId; $session = $this->request->session();     $session->write('client_sess_id',$c_id);//Write  ?>
		 <form class="form-horizontal" method="post" action="{{ url('/client/updateClientEmail', array($client->ClientId)) }}">
			<fieldset>
					
				<div class="pad">
    <table class="table table-full table-full-small cemailDTable" cellspacing="1" width="100%">	
		<thead>
			<tr>
			<th> Client </th>
			<th> From </th>
			<th> Subject </th>
			<th> Message </th>	
			<th>  </th>				
			</tr>
		</thead>
		<tbody>
		@if($clientemails)	
			@foreach($clientemails as $clientemails)
			<tr>
                <td> {{$clientemails->ClientId}} </td>
                <td> {{$clientemails->FromAddress}} </td>
                <td> {{$clientemails->Subject}} </td>
                <td> {{$clientemails->Message}} </td>
				<td class="actions">
					<button type="button" class="btn btn-primary" style="font-size:10px">Manage</button>				
				</td>
				</tr>
			@endforeach
		@endif			
		</tbody>
    </table>
	</div>

		
			</fieldset>
		</Form>
		</div>
 
		  
	
	</div>
	
   </div>
  </div>
  
  
  <div id="notes" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	
<!-- left content -->
              <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
			
                <div class="pad"> 
	
	  
	  
                <form class="form-horizontal" method="POST" action="{{ url('/client/addNote') }}">
				<fieldset>
				  
				  <div class="form-group" style="padding:0px 10px">
					<textarea class="form-control vertical" rows="3" name="ClientNotes" id="ClientNotes" style="width:99%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0.5%; color:#999;" onkeyup="convert_notes()" required></textarea> 
					<span class="help-block"></span> 
				  </div>	  
					
					
					<div class="form-group">
						<input type="hidden" name="ClientId" id="ClientId" class="form-control"@if($client) value="{{$client->ClientId}}"@endif > 
					</div>					
					<input type="hidden" name="Hide" id="Hide" class="form-control" value="0"> 
					
					<div class="form-group">
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
					</div>						
					
					

				  <div class="form-group" style="padding:0px 15px"> 
					<button type="button" class="btn btn-primary" id="addNoteBtn">Add Notes</button>
					<button type="reset" class="btn btn-default">Cancel</button> 
				  </div>
				</fieldset>
			  </form>
	  
	  <div id="display">  </div>
        <table id="dnote" class="table table-full table-full-small dnote" cellspacing="1" width="100%">
			<thead>
				<tr>
					<th style="width:1%">User</th>
					<th style="width:91%">Notes</th>
					<th style="width:8%">Actions</th>
				</tr> 
			</thead>
			<tbody>


			</tbody>  
		</table>
	
	
	</div>
  </div>
	
  </div> 
  
  </div>
  

  
  
  
  
  </div>
  
  



</div>


</div>
</section>
</div>






<!-- client asset Modal -->							
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertClientAssetFromView') }}">	
<div id="clientAssetModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-car" aria-hidden="true"></i> New Client Asset </h4>
      </div>
      <div class="modal-body">

	  <input type="text" name="ClientId" id="Clientid" @if($id) value="{{$id}}" @endif class="form-control" readonly >
	  @include('modals.client-asset_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- client Quote Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertClientQuoteFromView') }}">	
<div id="quoteModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-wrench" aria-hidden="true"></i> New Client Quote </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.client-quote_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>						

    

<!-- client invoice Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertInvoiceFromView') }}">	
<div id="invoiceModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-sticky-note" aria-hidden="true"></i> New Client Invoice </h4>
      </div>
      <div class="modal-body">
      

	  @include('modals.invoice_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- client job Modal -->						


<!-- Active Modal -->						
<form class="form-horizontal" method="post" action="{{ url('/client/editactive') }}">
<div id="activeModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:80%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-sticky-note" aria-hidden="true"></i> Putting Asset Back In Service </h4>
      </div>
      <div class="modal-body">
       

	  <fieldset>
		<div class="row" style="margin:15px 2px">

		<input type="hidden" name="AssetId" id="assetID" class="form-control" Required> 
		<input type="hidden" name="ClientId" id="ClientId" class="form-control" value="{{$id}}" Required> 
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
			
			<center> <div class="form-group">
				<button type="submit" class="btn btn-primary" id="assetOutServBtns">Put Back In Service</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div></center> 
			

		</div>
		
	</fieldset>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 


<!-- InActive Modal -->						
<form class="form-horizontal" method="post" action="{{ url('/client/editinactive') }}">
<div id="inactiveModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:80%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-sticky-note" aria-hidden="true"></i> Putting Asset Out Of Service</h4>
      </div>
      <div class="modal-body">
       

	  <fieldset>
		<div class="row" style="margin:15px 2px">

		<input type="hidden" name="AssetId" id="asset_ID" class="form-control" Required> 
		<input type="hidden" name="ClientId" id="ClientId" class="form-control" value="{{$id}}" Required> 
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
			
			<center> <div class="form-group">
				<button type="submit" class="btn btn-primary" id="assetOutServBtns">Put Out Of Service</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div> </center>
			

		</div>
		
	</fieldset>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 

<!-- REMINDER MODAL -->
<div class="modal fade" id="reminderModal" role="dialog"  style="height:60%; margin:0.5% 50%">
	<div class="modal-header" style="margin:0px -25px">
	  <button type="button" class="close" data-dismiss="modal" style="color:red; margin-top:11px">&times;</button>
	  <h4 style="color:red;"> <i class="fa fa-clock-o"></i> Reset Reminder For Vehicle</h4>
	</div> 

    	<?php  //  $this->element('serv_reminder_modal');?> 
	</Form>
	
</div>

<!-- RETIRE MODAL -->
<form class="form-horizontal" method="post" action="{{ url('/client/retireclientasset') }}">
<div id="retireModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:80%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-recycle" aria-hidden="true"></i> Retire Client Vehicle</h4>
      </div>
      <div class="modal-body">
	  
	  @include('modals.clientassetretire_modal')
		
	


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- Recent client Jobs Modal -->						
<div id="clientJobModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="md md-check" aria-hidden="true"></i> Recent Client Jobs </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.last_clientjob_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Resent client Invoices Modal -->						
<div id="clientInvoiceModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="md md-iso" aria-hidden="true"></i> Recent Client Invoices </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.last_clientinvoice_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

















<script>      //AJAX FUNCTION TO SHOW EITHER ADD OR EDIT BUTTON
	$(document).ready(function()
	{		
		var s_mile = document.getElementById('MileInterval').value;	
		var s_date = document.getElementById('DateInterval').value;	
		if(s_date == '') {	$('#addSerDiv').show();	}		else{ $('#editSerDiv').show(); }
	});
</script>

<script>     //JAVASCRIPT FOR IDs
	
	function clientInvoice(id)
	{		   
		$('#Client_Id').val(id);   
	}
    
    function clientAsset(id)
	{       
		$('#Clientid').val(id);   
    }
	 
    function clientWorkOrder(id)
	{  
		$('#ClientID').val(id);   
    } 
	
    function clientJob(id)
	{     
		$('#ClientiD').val(id);   
    }
	
	function clientActive(id)
	{     
		$('#assetID').val(id);   
    }

	function clientInactive(id)
	{     
		$('#asset_ID').val(id);   
    }
	
	function clientRetire(id)
	{     
		$('#assetid').val(id);   
    }
	
</script>


<script>
$(document).ready(function()
	{
		$('#addAssetBtn').click(function()	{	$('#clientAsset').slideUp();  $('#newAssetDiv').slideDown(); $('#addAssetBtn').hide();	}); 
		$('#closeAssetBtn').click(function()  { $('#clientAsset').slideDown();  $('#newAssetDiv').hide(); 	$('#addAssetBtn').show();});		
	});

</script>
	
<script>	  //AJAX FUNCTION TO UPDATE CLIENT

$(document).ready(function()
	{
		$("#edtCliBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Client Profile # {0}?");
			if (r == true) 
			{
                var _url_id = "{{{$client->ClientId}}}";
				var FirstName = $("#FirstName").val();
				var LastName = $("#LastName").val();
				var Company = $("#Company").val();
				var Email = $("#Email").val();
				var Phone = $("#Phone").val();
				var Address = $("#Address").val();
				var Address_2 = $("#Address_2").val();
				var Country = $("#Country").val();
				var State = $("#State").val();
				var City = $("#City").val();
				var CreatedBy = $("#CreatedBy").val();
				var updated_at = date("Y-m-d H:i:s");
                var _token = $("#_token").val();
				// Returns successful data submission message when the entered information is stored in database.
				var datas = 'FirstName='+ FirstName + '&LastName='+ LastName + '&Company='+ Company + '&Email='+ Email + '&Phone='+ Phone + '&Address='+ Address + '&Address_2='+ Address_2 + '&Country='+ Country + '&State='+ State + '&City='+ City + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at + '&_token='+ _token;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
                    url: "/client/update/"+_url_id,
					data: datas,
					cache: false,
					success: function()
					{
						alert('Client Details Updated Successful !');									
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}
		
		});
		return false;
	});
</script>

<script>      //AJAX FUNCTION TO ADDING NEW NOTES
	$(document).ready(function()
	{	
		function displayFromDatabase()
		{	
			var pic = "{{URL::asset("assets/img/avatar.jpg")}}";
			 
			$.get('{{url('fetch-clientnotes')}}', function(data)
			{  //success data
				$.each(data, function(index, notesObj)
				{
					$('#dnote').append('<tr><td style="width:1%"> <center> <img src="'+pic+'" class="img-responsive" height="50" width="40"> </center> </td> <td style="width:91%">'+notesObj.ClientNotes+' </td> <td style="width:8%">'+notesObj.created+'<a href="#" id ="hideNoteBtn" type="button" class="btn btn-primary" style="color:white; font-size:9px; margin-left:20px">Hide</a></td> </tr>')
				});
			});											
		}
		
		displayFromDatabase();
		
		$("#addNoteBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Client Profile # {0}?");
			if (r == true) 
			{
				var ClientNotes = $("#ClientNotes").val();
				var ClientId = $("#ClientId").val();
				var Hide = $("#Hide").val();
				var _token = $("#_token").val();
				var CreatedBy = $("#CreatedBy").val();
				var created = date('Y-M-j');
				var updated_at = date('Y-m-j');
				if(ClientNotes == ' ')		{ alert('Please Type A Note'); ClientNotes.focus();  e.preventDefault();     return false;	}
				else
				{
					// Returns successful data submission message when the entered information is stored in database.
					var dataString = 'ClientNotes='+ ClientNotes + '&ClientId='+ ClientId + '&Hide='+ Hide + '&_token='+ _token + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at;
					
					e.preventDefault();
					// AJAX Code To Submit Form.
					$.ajax(
					{
						type: "POST",
						url: "/client/addNote",
						data: dataString,
						cache: false,
						success: function()
						{
							alert('Client Notes Added Successful');
							document.getElementById('ClientNotes').value = '';
							
							displayFromDatabase();		
						}
					});
				}
			} 
			else 
			{
				e.preventDefault();
			}
		});
		return false;
		
	});
	
	
</script>




<script>      //AJAX FUNCTION TO UPDATE SCHEDULE MAINTENANCE
	$(document).ready(function()
	{
		
		$("#updSerBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Client Asset Profile ?");
			if (r == true) 
			{
				var AssetId = $("#AID").val();
				var MileInterval = $("#MileInterval").val();
				var DateInterval = $("#DateInterval").val();
				var LastMaintMile = $("#LastMaintMile").val();
				var LastMaintDate = $("#LastMaintDate").val();
				var DateReminder = $("#DateReminder").val();
				var MileReminder = $("#MileReminder").val();
				var ClientEmail = $("#ClientEmail").val();
				var CurrentMile = $("#CurrentMile").val();
				var CreatedBy = $("#CreatedBy").val();
                var updated_at = date('Y-m-j');			

				// Returns successful data submission message when the entered information is stored in database.
				var smdata = 'AssetId='+ AssetId + '&MileInterval='+ MileInterval + '&DateInterval='+ DateInterval + '&LastMaintMile='+ LastMaintMile + '&LastMaintDate='+ LastMaintDate + '&DateReminder='+ DateReminder + '&MileReminder='+ MileReminder + '&CurrentMile='+ CurrentMile + '&ClientEmail='+ ClientEmail + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at;

				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "",
					data: smdata,
					cache: false,
					success: function()
					{
						alert('Client Asset Service Reminder Updated Successful');			
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}
		
		});
		return false;
	});
</script>

<script>      //AJAX FUNCTION TO ADD NEW SCHEDULE MAINTENANCE
	$(document).ready(function()
	{
		
		$("#addSerBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AID").val();
				var ClientId = $("#ClientId").val();
				var MileInterval = $("#MileInterval").val();
				var DateInterval = $("#DateInterval").val();
				var LastMaintMile = $("#LastMaintMile").val();
				var LastMaintDate = $("#LastMaintDate").val();
				var DateReminder = $("#DateReminder").val();
				var MileReminder = $("#MileReminder").val();
				var ClientEmail = $("#ClientEmail").val();
				var CurrentMile = $("#CurrentMile").val();
				var CreatedBy = $("#CreatedBy").val();
                var updated_at = date('Y-m-j');				

				// Returns successful data submission message when the entered information is stored in database.
				var smdata = 'AssetId='+ AssetId + 'ClientId='+ ClientId + '&MileInterval='+ MileInterval + '&DateInterval='+ DateInterval + '&LastMaintMile='+ LastMaintMile + '&LastMaintDate='+ LastMaintDate + '&DateReminder='+ DateReminder + '&MileReminder='+ MileReminder + '&CurrentMile='+ CurrentMile + '&ClientEmail='+ ClientEmail + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "",
					data: smdata,
					cache: false,
					success: function()
					{
						alert('New Client Asset Service Reminder Added Successful');			
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}
		
		});
		return false;
	});
</script>


<script>	  //AJAX FUNCTION TO UPDATE CLIENT ASSET STATUS

$(document).ready(function()
	{
		$("#assetOutServBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Put Asset Out Of Service ?");
			if(r == true) 
			{
				var AssetId = $("#AssetId").val();				
				var Active = '0';
				var updated_at = date("Y-m-d H:i:s");
				var data = 'Active='+ Active + '&updated_at='+ updated_at;
				
				e.preventDefault();
				$.ajax(
				{
					type: "POST",
					url: "",
					data: data,
					cache: false,
					success: function()
					{
						alert('Client Asset Has Been Put Out Of Service !');									
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}

		
		});
		return false;
	});
</script>


<script>	  //DATATABLES
	$(document).ready(function()
	{
		$('.casset').dataTable();
	});

	$(document).ready(function()
	{
		$('.invoiceDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.workDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.jobDTable').dataTable();
	});

	$(document).ready(function()
		{
			$('.cemailDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.cnotes').dataTable();
	});

</script>


<script>

	$(document).ready(function(e) 
	{
		$('#txt').click(function()
		{
			$('#p_div').hide();
		})
	});

</script>







<script>	  //AJAX FUNCTION TO UPDATE JOB

$(document).ready(function()
	{
		$("#updJobBtn").click(function(e)
		{
			var JobNumber = $("#JobNumber").val();
			var Type = $("#Type").val();
			var Status = $("#Status").val();
			var Description = $("#Description").val();
			var ScheduleStartDate = $("#ScheduleStartDate").val();
			var ScheduleEndDate = $("#ScheduleEndDate").val();
			var ClientId = $("#ClientId").val();
			var CountryId = $("#CountryId").val();
			var State = $("#State").val();
			var City = $("#City").val();
			var Street = $("#Street").val();
			var JobNotesId = $("#JobNotesId").val();
			var CreatedBy = $("#CreatedBy").val();
			var created = '';
			var updated_at = '';
			// Returns successful data submission message when the entered information is stored in database.
			var jobdata = 'JobNumber='+ JobNumber + '&Type='+ Type + '&Description='+ Description + '&Status='+ Status + '&ScheduleStartDate='+ ScheduleStartDate + '&ScheduleEndDate='+ ScheduleEndDate + '&ClientId='+ ClientId + '&CountryId='+ CountryId + '&State='+ State + '&City='+ City + '&Street='+ Street + '&JobNotesId='+ JobNotesId + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at;
			
			e.preventDefault();
			// AJAX Code To Submit Form.
			$.ajax(
			{
				type: "POST",
				url: "",
				data: jobdata,
				cache: false,
				success: function()
				{
					alert('New Job Added Successful !');	
				}
			});
		
		});
		return false;
	});
</script>


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_desc() 
	{
		var str = document.getElementById('Description').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Description').value = cap;
	}
	
	function convert_state() 
	{
		var str = document.getElementById('State').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('State').value = cap;
	}
	
	function convert_city() 
	{
		var str = document.getElementById('City').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('City').value = cap;
	}
	
	function convert_lga() 
	{
		var str = document.getElementById('LGA').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LGA').value = cap;
	}
	
	function convert_stre() 
	{
		var str = document.getElementById('Street').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Street').value = cap;
	}
	
	function convert_notes() 
	{
		var str = document.getElementById('ClientNotes').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   { 
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 			document.getElementById('ClientNotes').value = cap;
	}
</script>

<!-- DATE TIME PICKERS --> 
<script>
	$(function () {
		$('#ServiceDate').datetimepicker();
	});
	
	$(function () {
		$('#ServiceCompletionDate').datetimepicker();
	});

    $(function () {
      
        $('#ScheduleEndDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ScheduleStartDate").on("dp.change", function (e) {
            $('#ScheduleEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ScheduleEndDate").on("dp.change", function (e) {
            $('#ScheduleStartDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>

<!-- SCRIPT TO RETREIVE CLIENT DETAILS -->
<script>
	$(document).ready(function()
	{
		$('#ClientId').change(function()
		{
			var ClientId = $(this).val();
			$.ajax({
				url:"loadaddress",
				method:"POST",
				data:{clientId:ClientId},
				dataType:"text",
				success:function(data)
				{
					$('#Streets').hide();
					$('#address').html(data);  
				}
			});
			
			$.ajax({
				url:"loadcity",
				method:"POST",
				data:{clientId:ClientId},
				dataType:"text",
				success:function(data)
				{
					$('#Citys').hide();
					$('#city').html(data);  
				}
			});
			
			var ClientId = $(this).val();
			$.ajax({
				url:"loadstate",
				method:"POST",
				data:{clientId:ClientId},
				dataType:"text",
				success:function(data)
				{
					$('#States').hide();
					$('#state').html(data);  
				}
			});

			var ClientId = $(this).val();
			$.ajax({
				url:"loadphone",
				method:"POST",
				data:{clientId:ClientId},
				dataType:"text",
				success:function(data)
				{
					$('#Phones').hide();
					$('#phone').html(data);  
				}
			});
			
			var ClientId = $(this).val();
			$.ajax({
				url:"loadcountry",
				method:"POST",
				data:{clientId:ClientId},
				dataType:"text",
				success:function(data)
				{
					$('#CountryId').html(data);  
				}
			});

		});

		
		
	});
</script>


<script>
	$(document).ready(function()
	{	
		$('.add').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{//alert();
				var str = document.getElementById('Street').value;   			document.getElementById('Street').value = '';
				var cit = document.getElementById('City').value;  				document.getElementById('City').value = ''; 
				var sta = document.getElementById('State').value;  				document.getElementById('State').value = ''; 
				var pho = document.getElementById('Phone').value; 				document.getElementById('Phone').value = ''; 
				var cou = $('#CountryId').val();									$('#CountryId').val([]);
			}
		});

	});
	
	$(document).ready(function()
	{		
		$('#Active_0').click(function()
		{ 
			$('#ClientId').val([]);
			document.getElementById('ClientId').focus();

		});
	});
</script>


<!-- SCRIPT TO DISPLAY ALERT OF NO ASSET FOR CLIENT -->
<script>
	$(document).ready(function()
	{
		$('#noAsset').click(function()
		{
			alert('This Client Has No Vehicle Yet, Create An Asset Before Service Reminder Can Be Set');
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
	


<!-- SCRIPT GET VEHICLE MODEL BASED ON MAKE SELECTED -->
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
				$('#ModelId').append('<option value=""> Select Vehicle Make </option>')
				$.each(data, function(index, modelObj)
				{
					$('#ModelId').append('<option value="'+ modelObj.ModelId +'"> '+modelObj.ModelName+' </option>')
				});
			});				
		});
	});
</script> 







@stop