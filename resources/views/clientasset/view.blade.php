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
		background-color:red;     /* #E52B50 */
		color:white;
	}
</style>



<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="fa fa-taxi"></i>   Client Asset Management  </h1>  
	  <p class="lead"> The client asset management module  allows you to efficiently manage your entire client asset lifecycle. With real-time visibility into client asset <br> performance and 
	  powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p> <br>
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

      <li><a class="active" data-toggle="tab" href="#profile"><span><i class="fa fa-car"></i> Profile</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#summary"><span><i class="fa fa-info"></i> Purchase  Summary</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#expenses"><span><i class="fa fa-edit"></i> Expense</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#fuels"><span><i class="fa fa-tint"></i> Fuel</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#jobs"><span><i class="md md-explore"></i> Jobs</span> </a> </li>

	  <li><a class="" data-toggle="tab" href="#files"><span><i class="fa fa-file-text"></i> Files</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#setting"><span><i class="fa fa-gears"></i> Settings</span> </a> </li>
 
</ul>

	<?php 
		/* $rem_ldate = $serv_rem['LastMaintDate'];     
		$rem_dintvals = $serv_rem['DateInterval'];  $rem_dintval = $rem_dintvals * 30;
		$rem_drem = $serv_rem['DateReminder']; 
		$duedate = date('m/d/Y', strtotime($rem_ldate. ' + '.$rem_dintval.' days'));
		$startremdate = date('m/d/Y', strtotime($duedate. ' - '.$rem_drem.' days'));

		
		$today = date('m/d/Y');	
		$from = strtotime($today);
		$to = strtotime($startremdate);
		$noOfDays = floor( ($to - $from) /(60*60*24));
		*/
	?>
	<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-95px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<a href="" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="No Of Day(s) To Maintenance"> 
				<?php  
					/* if($rem_dintval >= $noOfDays && $ct_serv_rem > 0){	echo '<div class="badge notif">'. $noOfDays.' </div>';	}
					else if($startremdate >= $today){ echo '<div class="badge notif">'. $noOfDays.'</div>'; } 					
					else
					{ */ ?>     <i class="fa fa-area-chart">			 </i>    
				<?php	//}  ?>
				</a>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed
			
			<input type="hidden" name="aid" value="{{{ $clientasset->AssetId }}}"> 

			<?php 
			/*$plate = $asset->LicensePlate;				
			if($startremdate == $today)
			{  echo $startremdate.' Send Reminder'; 
				$conn = connect();   // getting vehicle maintenance workshop
				$shid = $serv_rem['WorkshopId'];
				
				// getting workship email address
				$sql22 = "SELECT * FROM workshop WHERE WorkShopId = '{$shid}'";
				$result22 = $conn->query($sql22); 
				$em = $result22->fetch_assoc();     $eml = $em['Email'];
				
				//SENDING THE EMAIL NOTIFICATION
				$send_to = $eml;
				$subject = "Service Reminder Notice ";
				$message = ' Hello, 
				Your Vehicle '.$plate.' Is Due For Maintenance In '.$rem_drem.' Days Time. '.$duedate
				.' This Is Just A Notification Email For Service Reminder 
				Thank You.';
				$headers = "From: notifications@dream360.com" .
				"CC: kelvonetics@gmail.com";

				@mail($send_to, $subject, $message, $headers);
				
			//echo'<script> window.location = "http://localhost/dream/asset/notifyreminder?query=email&mail='.$eml.'&date='.$rem_drem.'&id='.$id.'"; </script>'; 
			} 
			else {   }  */ ?>
			</h4> </div>
			<div class="well white white-card"> 

				<a href="{{route('clientasset.clientAssetProfile', $id)}}" class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple pull-right" style="margin-right:-20px;" title="Upload ClientAsset Profile Photo"> <i class="fa fa-photo" style="color:red;"></i> </a>
				
                <?php
                    $Clientassetattachment = DB::table('clientassetattachment')->where('AssetId', '=', $id)->orderBy('AssetAttachId', 'desc')->first();
                ?>

				@if($Clientassetattachment)

					<?php $pic = $Clientassetattachment->name;  
                        if ($pic != null)	{	$pix = '/assets/img/assets/'.@$pic; }         
                    ?>

                @else

                <?php $pix = '/assets/img/nocar.jpg';  ?>

                @endif   
				
                <center> <img src="{{URL::asset($pix)}}" class="img-responsive" height="150" width="150"> </center>
			<?php
				$mkid = $clientasset->MakeId;		$mdid = $clientasset->ModelId;
				$Asset_make = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();		
				$Asset_model = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
			?>
            <center>
			    <span class=""> <?= $clientasset->LicensePlate .' ' .'&nbsp;&nbsp;&nbsp;' ?> </span>             
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
						<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
					</tr>
				</table>
				
					<div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px; color:#fff"><a onclick="workOrder()" href="#" class="btn btn-circle-green" data-tooltip="true" data-toggle="modal" data-target="#" style="color:#fff"  title='Create Work Order For Asset'>+</a></div>
                      <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href="">Last 10 Service Appointments </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a onclick="pullId()" href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" style="color:#fff" data-toggle="modal" data-target="#" title='Add New Job'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="">Last 10 Jobs </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a onclick="pullId({{{$id}}})" href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn"  style="color:#fff"  data-toggle="modal" data-target="#fuelModal" title='Add New Fuel Log'>+</a></div>
                      <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href="">Last 10 Fuel Purchases </a></div>
                    </div>
					
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


  <div id="profile" class="tab-pane fade in active">
  <div class="widget widget-table action-table ">
  
			 
			  
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

		<div> 
		<?php //$id = $asset->AssetId; $session = $this->request->session();         $session->write('asset_sess_id',$id);//Write ?>
		 <?php //$this->Form->create($asset, ['id' => 'prof'], array('controller' => 'Asset', 'url' => '/asset/edit/', $id, )) ?>	 
				 
	<form class="form-horizontal" method="post" action="{{ url('/clientasset/update', array($clientasset->AssetId)) }}">
		 
     <fieldset id="profiles">
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
		<CAPTION>Primary Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group"> 
				<label for="MakeId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle Make </label>
					<select class='sel-opt-left ronly' name='MakeId' id='MakeId' required>
						@($assetmake) 
						<option value="{{{ $assetmake->MakeId }}}"> {{ $assetmake->Make }} </option>
						@endif
						<option class="option" value=""> Select Vehicle Make </option>
						
						@($assetmakes)
						@foreach ($assetmakes as $assetmakes)
							<option value="{{{ $assetmakes->MakeId }}}"> {{ $assetmakes->Make }} </option>
						@endforeach
						@endif
					</select>	
				</div>
					
				<div class="form-group">
					<label for="VIN" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i> Vehicle Identification Number</label>
						<input type="text" class="ronly" name="VIN" id="VIN" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@($clientasset) value="{{{ $clientasset->VIN }}} "@endif />	
				</div>
				
			  </td>
				<td width="50%"> 
				
				<div class="form-group">
				  <label for="ModelId" class="control-label label-right"> <i class="fa fa-car" aria-hidden="true"></i> Vehicle Model </label>
					<select class='sel-opt-right ronly' name='ModelId' id='ModelId' required>
					@($assetmodel)
					<option value="{{{ $assetmodel->ModelId }}}"> {{ $assetmodel->ModelName }} </option>
					@endif

						<!-- <option class="option" value=""> Select Vehicle Model</option> -->
						
						
				 </select>
				</div>
								
				<div class="form-group">
					<label for="LicensePlate" class="control-label label-right"> <i class="fa fa-taxi" aria-hidden="true"></i>  Vehicle License Plate</label>
						<input type="text" class=" ronly" name="LicensePlate" id="LicensePlate" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@($clientasset) value="{{{ $clientasset->LicensePlate }}}"@endif />
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
						<input type="text" class=" ronly" name="EqpYear" id="EqpYear" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999"@if($clientasset) value="{{{ $clientasset->EqpYear }}} "@endif />	
				</div>
				
				<div class="form-group">				
				<label for="AssetTypeId" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i>  Vehicle Body Type</label>
					<select class='sel-opt-left' name='AssetTypeId' id='AssetTypeId' required>
					@if($assettype)
					<option value="{{{ $assettype->AssetTypeId }}}"> {{ $assettype->AssetTypeName }} </option>
					@endif
						<option class="option" value=""> Select Vehicle Model</option>
					@if($assettypes)	
						@foreach ($assettypes as $assettypes)
							<option value="{{{ $assettypes->AssetTypeId }}}"> {{ $assettypes->AssetTypeName }} </option>
						@endforeach
					@endif
					 </select>
				</div>
				
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
				  <label for="FuelTypeId" class="control-label label-right"> <i class="fa fa-tint" aria-hidden="true"></i>  Vehicle Fuel Type</label>
					<select class='sel-opt-right' name='FuelTypeId' id='FuelTypeId' required>
					@if($fueltype)
					<option value="{{{ $fueltype->FuelTypeId }}}"> {{ $fueltype->FuelType }} </option>
					@endif

						<option class="option" value=""> Select Vehicle Fuel Type</option>
					@if($fueltypes)
						@foreach ($fueltypes as $fueltypes)
							<option value="{{{ $fueltypes->FuelTypeId }}}"> {{ $fueltypes->FuelType }} </option>
						@endforeach
					@endif
					 </select>
				</div>
								
				<div class="form-group">
					<label for="Color" class="control-label label-right"> <i class="fa fa-toggle-on" aria-hidden="true"></i>  Vehicle Color </label>
					<select class='sel-opt-right' name='Color' id='Color' required>
					@if($color)
					<option value="{{{ $color->Color }}}"> {{ $color->Color }} </option>
					@endif
						<option class="option" value=""> Select Vehicle Color</option>
					@if($colors)	
						@foreach ($colors as $colors)
							<option value="{{{ $colors->Color }}}"> {{ $colors->Color }} </option>
						@endforeach
					@endif
					</select>
				</div>
				</td>
			</tr>

            <tr class="box-section">
                <td> 
                    <div class="form-group">    
                    <label for="ClientId" class="control-label label-left"><i class="fa fa-car"></i>Client</label>
                    <select class='sel-opt-left' name='ClientId' id='ClientId' required>
                    <?php
                        $id = $cliented->ClientId;
						$Client = DB::table('client')->where('ClientId', '=', $id)->first();
					?>
                    @if ($Client)
                        <option class='option' value="{{$Client->ClientId}}">{{$Client->FirstName.' '.$Client->LastName}}</option>
                    @endif
                    </select>
                    </div>
                    
                    
                </td>
                <td> 
                    <div class="form-group"> <label for="Active" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> Make Active </label>
                    <div class="radio" style="margin-left:25px">
                        <?php  if($cliented->Active == '1'){ 
                        echo '<label> <input type="radio" name="Active" value="1" id="Active_0" checked /> Yes </label>  
                        <label style="margin-left:20px">  <input type="radio" name="Active" value="0" id="Active_1" />  No  </label> '; } ?>

                        
                        <?php  if($cliented->Active == '0'){ 
                        echo '<label> <input type="radio" name="Active" value="1" id="Active_2" /> Yes </label>
                        <label style="margin-left:20px"> <input type="radio" name="Active" value="0" id="Active_3" checked  />  No </label> '; } ?>
                            
                    </div>
                </div>
                </td>
            </tr>

		</table>
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px">
		
			<tr>
				<td colspan="4" class="pull-left" colspan="2"> 
                <div class="form-group">
                <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($cliented) value="{{$cliented->ClientId}}"@endif />
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</div>
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
  
  <div id="summary" class="tab-pane fade">
  <div class="widget widget-table action-table">

			
	 
		  
		<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    		
		<div>

		@if ($purch)
			<form class="form-horizontal" method="post" action="{{ url('/clientasset/updatePurchaseSummary', array($purch->PurchaseId)) }}">
		@else
			<form class="form-horizontal" method="post" action="{{ url('/clientasset/insertPurchaseSummary') }}">
		@endif
		 
			<fieldset>

		
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px">
				<CAPTION>Summary Details  </CAPTION>
			
					<tr class="box-section">
						<td width="50%">
							<div class="form-group">
								<label for="PurchaseDate" class="control-label label-left" required> <i class="fa fa-calendar" aria-hidden="true"></i> Vehicle Purchase Date</label>
								<input type="text" name="PurchaseDate" id="PurchaseDate" class="datepicker" placeholder="MM-DD-YYYY" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#99" @if($purch) value="{{{ $purch->PurchaseDate }}}" @endif>
							</div>
							
							<div class="form-group">
								<label for="PurchaseOrder" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i>  Purchase Order Number </label>
								<input type="text" name="PurchaseOrder" id="PurchaseOrder" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999" @if($purch) value="{{{ $purch->PurchaseOrder }}}" @endif required />
							</div>
							
							<div class="form-group">
								
							<label for="DealerId" class="control-label label-left"> <i class="fa fa-male" aria-hidden="true"></i>  Dealer </label>
							<select class='sel-opt-left m-bot15' name='DealerId' id='DealerId' required>

                            @if($purch)	 
							<?php										
								$dlId = $purch->DealerId; 
								$autodealer = DB::table('autodealer')->where('DealerId', '=', $dlId)->first();
							?>
								<option value="{{{ $autodealer->DealerId }}}"> {{ $autodealer->DealerName }} </option>
                            @endif
								<option class="option" value=""> Select Dealer Name</option>
								
								@foreach ($autodealers as $autodealers)
									<option value="{{{ $autodealers->DealerId }}}"> {{ $autodealers->DealerName }} </option>
								@endforeach
							 </select>
                            
							 <?php				
								$Client = DB::table('clientasset')->where('AssetId', '=', $id)->first();
							 ?>
								<input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />							
								
							</div>
						</td>
						
						

						<td width="50%">	
						<div class="form-group" style="margin-top:7px">
							<label for="PurchasePrice" class="control-label label-right"> <i class="fa fa-usd" aria-hidden="true"></i> Vehicle Purchase Price</label>
							<input type="text" name="PurchasePrice" id="PurchasePrice" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" @if($purch) value="{{{ $purch->PurchasePrice }}}" @endif required />

							<input type="hidden" name="AssetId" id="AssetId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"  value="@if($purch){{{ $clientasset->AssetId }}} @else {{{ $id }}} @endif " />
						</div>
						
						<div class="form-group">
							<label for="AssetCondition" class="control-label label-right"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i>  Condition</label>
							<select class='sel-opt-right m-bot15' name='AssetCondition' id='AssetCondition' required>
								<option value=" @if($purch){{{ $assetpurchasesummary->AssetCondition }}} @endif">  
								@if($purch){{ $assetpurchasesummary->AssetCondition }} @endif </option>

								<option class="option" value=""> Select Purchase Condition</option>
								@if($assetconditions)
								@foreach ($assetconditions as $assetconditions)
									<option value="{{{ $assetconditions->Condition }}}"> {{ $assetconditions->Condition }} </option>
								@endforeach
								@endif
							 </select>
						</div>
						
						<div class="form-group">
							<label for="PurchaseMileage" class="control-label label-right"> <i class="fa fa-road" aria-hidden="true"></i>  Mileage (km)</label>
							<input type="text" name="PurchaseMileage" id="PurchaseMileage" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" @if($purch) value="{{{ $purch->PurchaseMileage }}}" @endif required />
					
							<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}Created" readonly >
							<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
						</div>
						</td>
					</tr>

			
					
					<tr>
						<td colspan="4" class="pull-left"> 	
							<div class="form-group" style="padding:20px 0px; display:none" id="addPurDiv">
								<button type="submit" class="btn btn-primary" id="addPurcBtn" >Add Purchase</button>
							</div>
						
							<div class="form-group" style="padding:20px 0px; display:none" id="editPurDiv">
								<button type="submit" class="btn btn-primary" id="updPurcBtn" >Update Purchase Details</button>
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
  
  

  <div id="expenses" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	 
	<!-- left content -->
        <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
		<a onclick="Expensed(<?= $clientasset->AssetId ?>)" style="color:white" class="waves-effect btn btn-primary waves-light btn modalBtn"  data-toggle="modal" data-target="#expenseModal"
				href=""> <i class="fa fa-plus"></i> New Expense</a>

			<div class="pad">
				 
			  

     <!-- <div class="datatables" id="expTable">   -->         
	 <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th>Expense Id</th>
			<th> Type</th>
			<th>Amount</th>
			<th>Date</th>
			<th>Supplier</th>
			<th scope="col" class="actions"> Actions </th>
		</tr>
		</thead>

		<tbody>
		@if($assetexpense)
			@foreach ($assetexpense as $assetexpense)
				<tr>
					<td>     {{ $assetexpense->ExpenseId }}    	 </td>
					<td>     {{ $assetexpense->ExpenseType }}    </td>
					<td>     {{ $assetexpense->Amount }}         </td>
					<td>     {{ $assetexpense->PaidDate }}       </td>
					<td>     {{ $assetexpense->Supplier }}       </td>
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>
				</tr>
			@endforeach
		@endif
		 </tbody>
    </table>
    <!-- </div> -->	
	
	
  </div>
  </div>

  </div>
  </div>


  <div id="fuels" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	 
	<!-- left content -->
        <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
		<a onclick="fuel(<?= $clientasset->AssetId ?>)" style="color:white" class="waves-effect btn btn-primary waves-light btn modalBtn"  data-toggle="modal" data-target="#fuelModal"
				href=""> <i class="fa fa-plus"></i> New Fuel</a>

			<div class="pad">
				 
			  

     <!-- <div class="datatables" id="expTable">   -->         
     <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th>Purchase Date</th>
			<th>Station </th>
			<th>Litres</th>
			<th>Cost</th>
			<th>Curr Mileage</th>
            <th>Vehicle</th>
			<th scope="col" class="actions"> Actions </th>
		</tr>
		</thead>

		<tbody>
		@if($clientfuelpurchases)
			@foreach ($clientfuelpurchases as $clientfuelpurchases)
				<tr>

					<td>     {{ $clientfuelpurchases->FuelPurchaseDate }}    	 </td>
					<td>     {{ $clientfuelpurchases->FuelStation }}    </td>
					<td>     {{ $clientfuelpurchases->NoLitres }}         </td>
					<td>     {{ $clientfuelpurchases->FuelCost }}       </td>
					<td>     {{ $clientfuelpurchases->EqpCurrMileage }}       </td>
                    <td>     
                    <?php
                       $as_id = $clientfuelpurchases->AssetId;
                       $plate = DB::table('clientasset')->where('AssetId', '=', $as_id)->first();
                       echo $plate->LicensePlate;
                    ?>
                    </td>
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>

				</tr>
			@endforeach
		@endif
		 </tbody>
    </table>
    <!-- </div> -->	
	
	
  </div>
  </div>

  </div>
  </div>


  <div id="jobs" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	 
	<!-- left content -->
        <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
		<a onclick="Expensed(<?= $clientasset->AssetId ?>)" style="color:white" class="waves-effect btn btn-primary waves-light btn modalBtn"  data-toggle="modal" data-target="#jobModal"
				href=""> <i class="fa fa-plus"></i> New Job</a>

			<div class="pad">
				 
			  

     <!-- <div class="datatables" id="expTable">   -->         
     <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th>Job Type</th>
			<th>Start Date </th>
			<th>End Date</th>
			<th>Client</th>
			<th>Address</th>
            <th>Status</th>
			<th scope="col" class="actions"> Actions </th>
		</tr>
		</thead>

		<tbody>
		@if($jobs)
			@foreach ($jobs as $jobs)
				<tr>

					<td>     {{ $jobs->Type }}    </td>
					<td>     {{ $jobs->ScheduleStartDate }}    </td>
					<td>     {{ $jobs->ScheduleEndDate }}      </td>
					<td>     
                        <?php
                            $c_id = $jobs->ClientId;
                            $names = DB::table('client')->where('ClientId', '=', $c_id)->first();
                        ?>	@if($names) {{$names->FirstName.' '.$names->LastName}} @endif
                    </td>
					<td>     {{ $jobs->Street }}       </td>
                    <td>     {{ $jobs->Status }}       </td>
                    
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>

				</tr>
			@endforeach
		@endif
		 </tbody>
    </table>
    <!-- </div> -->	
	
	
  </div>
  </div>

  </div>
  </div>



  <div id="files" class="tab-pane fade">
  <div class="widget widget-table action-table">
			

	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	  <a onclick="FileUpload({{{ $id }}})" style="color:white" class="waves-effect btn btn-primary waves-light modalBtn" data-toggle="modal" data-target="#fileModal"
		href="#"> <i class=" fa fa-plus"></i> Upload File</a>
		<div> 	
			  

		<div class="pad">

		<table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th>File Description</th>
			<th> File Name</th>
			<th>File Category</th>
			<th>Expiration Date</th>
			<th scope="col" class="actions"> </th>
		</tr>
		</thead>
		<tbody>
			
		@if($clientassetattachment)	
			@foreach ($clientassetattachment as $clientassetattachment)
				<tr>

					<td>     {{ $clientassetattachment->Description }}    	 </td>
					<td>     {{ $clientassetattachment->name }}     </td>
					<td>     {{ $clientassetattachment->Category }}          </td>
					<td>     {{ $clientassetattachment->ExpirationDate }}        </td>
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Download </a> </td>

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






  
  <div id="setting" class="tab-pane fade">
  <div class="widget widget-table action-table">

  	<!-- left content -->
  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
           
		<!-- PUT OUT OF SERVICE -->
		<div class="row" style="padding:8px 2px 2px 2px;">
		

		
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Put Out Of Service </div>
			
			<div class="col-md-10 box-right" style="padding-left:30px">  
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">						 
						
						@if($clientassetavailability)
						<input type="radio" name="Active" value="1" id="Active_0" class="check_active" checked /> &nbsp; Yes
						@else
						<input type="radio" name="Active" value="0" id="Active_0" class="check_active" /> &nbsp; Yes 
						@endif
					</div>

					<div class="col-md-2">
						@if(!$clientassetavailability)
						<input type="radio" name="Active" value="1" id="Active_1" class="check_act" checked/> &nbsp; No
						@else 
						<input type="radio" name="Active" value="0" id="Active_1" class="check_act"/> &nbsp; No
						@endif  
					</div>
				</div>


				@if ($clientassetavailability)
					<form class="form-horizontal" method="post" action="{{ url('/clientasset/updateAvailability', array($clientassetavailability->AssetAvailId)) }}">
				@else
					<form class="form-horizontal" method="post" action="{{ url('/clientasset/insertAvailability') }}">
				@endif
				
				<div id="active" class="pos" style="padding:10px 2px"> 
			<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 1% 0% 1%">
				<tr>
					<td width="50%">
						<label for="StartDate" class="control-label" required><i class="fa fa-calendar" aria-hidden="true"></i> Start Date</label>
						<input type="text" name="StartDate" id="StartDate" class="datepicker" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" @if($clientassetavailability)value="{{{  $clientassetavailability->StartDate }}}"> @endif						
					</td>

					<td width="50%">	<label for="EndDate" class="control-label"><i class="fa fa-calendar" aria-hidden="true"></i>  End Date</label>
						<input type="text" name="EndDate" id="EndDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" @if($clientassetavailability)value="{{{ $clientassetavailability->EndDate }}}" /> @endif
					</td>
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td>	<label for="VendorId" class="control-label"> <i class="fa fa-male" aria-hidden="true"></i> Vendor / Workshop </label>
						<select class='sel-opt' name='VendorId' id='VendorId' style="margin:auto 2% auto 0%;width:93%" required>
							<option value="@if($clientassetavailability){{{ $assetavailworkid->WorkShopId }}} @endif"> 
							@if($clientassetavailability){{ $assetavailworkid->WorkShopName  }}@endif </option>
						  	<option value=""> Select Vendor Workshop </option>
						  	@if($workshops)
							  @foreach ($workshops as $workshops)
								<option value="{{{ $workshops->WorkShopId }}}">{{ $workshops->WorkShopName }}</option>
							  @endforeach
							@endif
						 </select>
					</td>

					<td>	<label for="WorkOrderId" class="control-label"> <i class="fa fa-wrench" aria-hidden="true"></i> Work Order Id</label>
						<input type="text" name="WorkOrderId" id="WorkOrderId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" value="@if($clientassetavailability){{{ $clientassetavailability->WorkOrderId  }}}@endif" />
					</td>
				</tr>

				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td colspan="2">	<label for="Reason" class="control-label"> <i class="fa fa-pencil" aria-hidden="true"></i>  Reason </label>
						<textarea type="" name="Reason" id="Reason" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%">@if($clientassetavailability) {{$clientassetavailability->Reason }} @endif </textarea>
					</td>

						
					
					<input type="hidden" name="AssetId" id="AssetId" class="form-control"@if($clientasset) value="{{{ $clientasset->AssetId }}}"@endif readonly >

                    <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($client)  value="{{$Client->ClientId}}"@endif />

					<input type="hidden" name="modi" id="modi" value="{{date("Y-m-d H:i:s")}}" />
					<input type="hidden" name="EDate" id="EDate" value="{{date("m/d/Y")}}" />
					
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
					
				</tr>

				
				<tr>
					<td colspan="4" class="pull-left"> 
						<div class="form-group" style="padding:20px 0px; display:none" id="addActDiv">
							<button type="submit" class="btn btn-primary" id="addActBtns">Update Setting</button>
						</div> 
						<div class="form-group" style="padding:20px 0px; display:none" id="editActDiv">
							<button type="submit" class="btn btn-primary" id="updActBtns">Update Setting</button>
						</div>
					</td>
				</tr>
				
			</table>
	
			</div>
			</div>
		</form>

		</div>

					



		<!-- RETIRE -->
		<div class="row" style="padding:8px 2px 2px 2px;">
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Retire Asset </div>
			
			<div class="col-md-10 box-right" style="padding-left:30px">    
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">
						@if($assetretirecount > 0)
						<input type="radio" name="Retire" value="1" id="Retire_0" class="check_retire" checked /> 
						&nbsp; Yes
						@else 
						<input type="radio" name="Retire" value="1" id="Retire_0" class="check_retire" /> &nbsp; Yes 
						@endif
					</div>

					<div class="col-md-2">
						@if($assetretirecount == 0)
						<input type="radio" name="Retire" value="0" id="Retire_1" class="check_ret" checked />
							&nbsp; No
						@else 
						<input type="radio" name="Retire" value="0" id="Retire_1" class="check_ret" /> &nbsp; No
						@endif   
					</div>
				</div>
			
		



		
		<div id="retire" class="" style="display:none; padding:10px 2px">  
		
		
		<div class="row" style="padding:8px 2px 2px 2px;">

		@if ($assetretiredetail)
			<form class="form-horizontal" method="post" action="{{ url('/assetretiredetail/update', array($assetretiredetail->RetireId)) }}">
		@else
			<form class="form-horizontal" method="post" action="{{ url('/clientasset/retireClientAsset', array($clientasset->AssetId)) }}">
		@endif				
	
			<table width="100%" border="0" cellspacing="5" cellpadding="10"style="margin:5% 1% 0% 1%">
				<tr>
					<td width="50%">
						<label for="RetireDate" class="control-label" required><i class="fa fa-calendar" aria-hidden="true"></i>    Retirement Date </label>
						<input type="text" name="RetireDate" id="RetireDate" class="datepicker" placeholder="MM-DD-YYYY" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" @if($assetretiredetail)value="{{{ $assetretiredetail->RetireDate }}}" @endif />
					</td>

					<td width="50%">	<label for="RetireMileage" class="control-label"><i class="fa fa-road" aria-hidden="true"></i>  Retirement Mileage (km)</label>
						<input type="text" name="RetireMileage" id="RetireMileage" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" @if($assetretiredetail)value="{{{ $assetretiredetail->RetireMileage }}}"  @endif Required />
					</td>
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td>	<label for="DisposalMethod" class="control-label"> <i class="fa fa-recycle" aria-hidden="true"></i>  Disposal Method </label>
						<input type="text" name="DisposalMethod" id="DisposalMethod" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" @if($assetretiredetail)value="{{{ $assetretiredetail->DisposalMethod }}}"  @endif Required />
					</td>

					<td>	<label for="RetireSalePrice" class="control-label"> <i class="fa fa-usd" aria-hidden="true"></i> Sale Price</label>
						<input type="text" name="RetireSalePrice" id="RetireSalePrice" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" @if($assetretiredetail)value="{{{ $assetretiredetail->RetireSalePrice }}}"  @endif Required />
					</td>
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td>	<label for="RetireReason" class="control-label"> <i class="fa fa-quote-right"></i> Reason </label>
						<select class='sel-opt' name='RetireReason' id='RetireReason' style="margin:auto 2% auto 0%;width:93%" required>
							
							@if($assetretiredetail)
							<option value="{{ $assetretiredetail->RetireReason }} "> 							{{ $assetretiredetail->RetireReason }} 										
							</option>
							@endif
							<option value=""> Select Asset Retirement Reason </option>
							@if($retirereason)
							@foreach ($retirereason as $retirereason)
								<option value="{{ $retirereason->RetireReason }}"> {{ $retirereason->RetireReason }} </option>
							@endforeach
							@endif
							</select>
					</td>

					<td>	

                    <input type="hidden" name="AssetId" id="AssetId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" value="{{$id}}" />
			
					
					</td>
				</tr>	

				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td colspan="2">	<label for="RetireComment" class="control-label"> <i class="fa fa-commenting" aria-hidden="true"></i> Note </label>
						<textarea name="RetireComment" id="RetireComment" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" required>@if($assetretiredetail) {{ $assetretiredetail->RetireComment }} @endif </textarea>
					</td>

						
					
					<input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />

					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
					
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>
					<td colspan="4" class="pull-left"> 
						<div class="form-group" style="padding:20px 0px; display:none" id="addRetDiv">
							<button type="submit" class="btn btn-primary" id="addRetBtn">Retire Vehicle</button>
						</div> 
					</td>
				</tr>
				
			</table>
			
			</form>
			</div>
			</div>
			
		</div></div>




		



		
		<div class="row" style="height:5px;">    </div>





			
		<!-- SERVICE REMINDER-->
		<div class="row" style="padding:8px 2px 2px 2px">
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Service Reminder </div>
			
			<div class="col-md-10 box-right" style="padding-left:30px">    
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">
							
						<input type="radio" name="Reminder" value="1" id="Reminder_0" class="check_reminder" />&nbsp; Yes 
					</div>

					<div class="col-md-2">
						<input type="radio" name="Reminder" value="0" id="Reminder_1" class="check_rem" checked />&nbsp; No   
					</div>
				</div>
			
		


		
		<div id="reminder" class="" style="display:none;"> 
		
			@if ($schedulemaintenance)
				<form class="form-horizontal" method="post" action="{{ url('/clientasset/updateClientMaintnance', array($schedulemaintenance->SchMaintId)) }}">
			@else
				<form class="form-horizontal" method="post" action="{{ url('/clientasset/insertClientMaintnance')}}">
			@endif
	
			<table width="100%" border="0" cellspacing="5" cellpadding="10"style="margin:5% 1% 0% 1%">
				<tr>
					<td width="50%">
						<label for="MileInterval" class="control-label" required><i class="fa fa-road" aria-hidden="true"></i> Mile Interval  </label>
						<input type="text" name="MileInterval" id="MileInterval" class="" placeholder="Mile Interval" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->MileInterval }}}" @endif >
					</td>

					<td width="50%">	<label for="DateInterval" class="control-label"> <i class="fa fa-calendar" aria-hidden="true"></i> Date Interval </label>
						<input type="text" name="DateInterval" id="DateInterval" placeholder="Date Interval" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->DateInterval }}}" @endif />
					</td>
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>
					<td width="50%">
						<label for="LastMaintMile" class="control-label" required><i class="fa fa-road" aria-hidden="true"></i> Last Maintenance Mile</label>
						<input type="text" name="LastMaintMile" id="LastMaintMile" class="" placeholder="Last Maintenance Mile" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->LastMaintMile }}}" @endif >
					</td>

					<td width="50%">	<label for="LastMaintDate" class="control-label"><i class="fa fa-calendar" aria-hidden="true"></i> Last Maintenance Date </label>
						<input type="text" name="LastMaintDate" id="LastMaintDate" placeholder="Last Maintenance Date" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->LastMaintDate }}}" @endif />
					</td>
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td width="50%">	<label for="DateReminder" class="control-label"> <i class="fa fa-calendar"></i> Date Reminder </label>
						<select class='sel-opt' name='DateReminder' id='DateReminder' style="margin:auto 2% auto 0%;width:93%" required>
								<option value="@if($schedulemaintenance) {{{ $schedulemaintenance->DateReminder }}}@endif"> @if($schedulemaintenance) {{ $schedulemaintenance->DateReminder }} @endif</option>

										<option value=""> Select Date Reminder </option>
										<option value="10"> Reminder Me 10 Days To Service </option>
										<option value="15"> Reminder Me 15 Days To Service </option>
										<option value="20"> Reminder Me 20 Days To Service </option>
										<option value="25"> Reminder Me 25 Days To Service </option>
										<option value="30"> Reminder Me 30 Days To Service </option>
										<option value="35"> Reminder Me 35 Days To Service </option>
										<option value="40"> Reminder Me 40 Days To Service </option>
										<option value="45"> Reminder Me 45 Days To Service </option>
										<option value="50"> Reminder Me 50 Days To Service </option>
										<option value="55"> Reminder Me 55 Days To Service </option>
										<option value="60"> Reminder Me 60 Days To Service </option>
										<option value="65"> Reminder Me 65 Days To Service </option>
										<option value="70"> Reminder Me 70 Days To Service </option>
										<option value="75"> Reminder Me 75 Days To Service </option>
										<option value="80"> Reminder Me 80 Days To Service </option>
										<option value="85"> Reminder Me 85 Days To Service </option>
										<option value="90"> Reminder Me 90 Days To Service </option>
										<option value="95"> Reminder Me 95 Days To Service </option>
										<option value="100"> Reminder Me 100 Days To Service </option>
							</select>
					</td>
					
					<td width="50%">	<label for="MileReminder" class="control-label"> <i class="fa fa-safari"></i> Mile Reminder </label>
						<input type="text" name="MileReminder" id="MileReminder" placeholder="Mile Reminder" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->MileReminder }}}" @endif>
					</td>
				</tr>

				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>

					<td width="50%">	<label for="CurrentMile" class="control-label"> <i class="fa fa-safari" aria-hidden="true"></i> Current Mileage  </label>
						<input type="text" name="CurrentMile" id="CurrentMile" placeholder="Current Mileage" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" @if($schedulemaintenance) value="{{{ $schedulemaintenance->CurrentMile }}}" @endif >
					</td>

					<td width="50%">	<label for="WorkshopId" class="control-label"> <i class="fa fa-wrench"></i> Workshop </label>
						<select class='sel-opt' name='WorkshopId' id='WorkshopId' style="margin:auto 2% auto 0%;width:93%" required>
							@if($schedulemaintenance) 
							<option value="{{{ $schworkshop->WorkShopId }}}">
							 {{ $schworkshop->WorkShopName }}</option> @endif
							<option value=""> Select Workshop </option>
                            <?php $works = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get(); ?>
							@if($works)
							@foreach ($works as $works)
								<option value="{{{ $works->WorkShopId }}}">  {{ $works->WorkShopName }}</option>
							@endforeach
							@endif
						</select>
					</td>	
					

					<input type="hidden" name="DueDate" id="DueDate" class="form-control" value="" readonly >
					<input type="hidden" name="AsId" id="AsId" class="form-control"@if($clientasset) value="{{{ $clientasset->AssetId }}}"@endif readonly >
                    <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly>
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
					
				</tr>
				
				<tr style="height:10px"> <td> </td> <td> </td> </tr>
				
				<tr>
					<td colspan="4" class="pull-left"> 
                        @if(!$schedulemaintenance)
						<div class="form-group" style="padding:20px 0px;" id="addRemDiv">
							<button type="submit" class="btn btn-primary" id="addRemBtns">Add Reminder</button>
						</div>
                        @else 
						<div class="form-group" style="padding:20px 0px;" id="editRemDiv">
							<button type="submit" class="btn btn-primary" id="updRemBtns">Update Reminder</button>
						</div>
                        @endif
					</td>
				</tr>
				
			</table>
			</form>
			
			</div>
			</div>
			
		</div>
		
		<div class="row" style="height:10px;">    </div>





  </div>
  </div>






  </div>
  
  
  </div>
  </div>
  </div>
</section> 

</div>















 








<!-- work order Modal -->						
<div class="modal fade" id="workModal" role="dialog"  style="height:60%; margin:0.5% 50%">
	
	<Form>
		<?php  //$this->element('workorder_modal');?> 
	</orm>	
								
</div>




<!-- client Asset Expense Modal -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/clientasset/insertClientAssetExpense') }}">	
<div id="expenseModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-sticky-note" aria-hidden="true"></i> Client Asset Expense </h4>
      </div>
      <div class="modal-body">
       

	  <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />
      @include('modals.expense_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 


<!-- log fuel Modal -->	
<form class="form-horizontal" method="POST" action="{{ url('/clientasset/insertClientAssetFuel') }}">	
<div id="fuelModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-tint" aria-hidden="true"></i> Client Fuel Log </h4>
      </div>
      <div class="modal-body">
       

	  <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />
      @include('modals.clientFuelPurchase_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 






<!-- Job Modal -->						



<!-- Client Asset Profile Photo Modal -->	
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/clientasset/uploadClientAssetFile') }}">	
<div id="fileModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;"> <i class="fa fa-upload" aria-hidden="true"></i>  Upload File </h4>
      </div>
      <div class="modal-body">
       
      <input type="hidden" name="ClientId" id="ClientId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999"@if($Client) value="{{$Client->ClientId}}"@endif />              
	  @include('modals.fileupload_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 


					
<!-- Asset Profile Photo Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/uploadProfilePhoto') }}">	
<div id="assetprofileModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-upload" aria-hidden="true"></i> Upload Asset Profile Photo</h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>









<script>      //DETERMINE WHICH BUTTON TO SHOW
	$(document).ready(function()
	{
		var p_date = document.getElementById('PurchaseDate').value;	
		var p_price = document.getElementById('PurchasePrice').value;	
		if(p_date == '' ) {	$('#addPurDiv').show();	}		else{ $('#editPurDiv').show(); }
		
		var s_mile = document.getElementById('MileInterval').value;	
		var s_date = document.getElementById('DateInterval').value;	
		if(s_date == '') {	$('#addSerDiv').show();	}		else{ $('#editSerDiv').show(); }
		
		var r_date = document.getElementById('RetireDate').value;	
		var r_mile = document.getElementById('RetireMileage').value;	
		if(r_date == '') {	$('#addRetDiv').show();	}		else{ $('#editRetDiv').show(); }
		
		var a_date = document.getElementById('StartDate').value;		
		if(a_date == '') {	$('#addActDiv').show();	}		else{ $('#editActDiv').show(); }
		
		var GPSIMEI = document.getElementById('GPSIMEI').value;		
		if(GPSIMEI == '') {	$('#addSccDiv').show();	}		else{ $('#editSccDiv').show(); }
		
		var MileInterval = document.getElementById('MileInterval').value;		
		if(MileInterval == '') {	$('#addRemDiv').show();	}		else{ $('#editRemDiv').show(); }
	});
</script>


<script>      //AJAX FUNCTION TO ADDING NEW NOTES
	$(document).ready(function()
	{	
		function displayFromDatabase()
		{	
			var pic = "{{URL::asset("assets/img/avatar.jpg")}}";
			 
			$.get('{{url('fetch-assetnotes')}}', function(data)
			{  //success data
				$.each(data, function(index, notesObj)
				{
					$('#dnote').append('<tr><td style="width:1%"> <center> <img src="'+pic+'" class="img-responsive" height="50" width="40"> </center> </td> <td style="width:91%">'+notesObj.Notes+' </td> <td style="width:8%">'+notesObj.created+'<a href="#" id ="hideNoteBtn" type="button" class="btn btn-primary" style="color:white; font-size:9px; margin-left:20px">Hide</a></td> </tr>')
				});
			});											
		}
		
		displayFromDatabase();
		
		$("#addNoteBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var Notes = $("#Notes").val();
				var AssetId = $("#Id").val();
				var Hide = $("#Hide").val();
				var UserId = $("#UserId").val();
				var _token = $("#_token").val();
				var CreatedBy = $("#CreatedBy").val();
				var created = date('Y-M-j');
				var updated_at = date('Y-m-j');
				if(Notes == ' ')		{ alert('Please Type A Note'); Notes.focus();  e.preventDefault();     return false;	}
				else
				{
					// Returns successful data submission message when the entered information is stored in database.
					var dataString = 'Notes='+ Notes + '&AssetId='+ AssetId + '&Hide='+ Hide + '&UserId='+ UserId + '&_token='+ _token + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at;
					
					e.preventDefault();
					// AJAX Code To Submit Form.
					$.ajax(
					{
						type: "POST",
						url: "/asset/addNote",
						data: dataString,
						cache: false,
						success: function()
						{
							alert('Asset Notes Added Successful');
							document.getElementById('Notes').value = '';
							
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

<script>      //AJAX FUNCTION TO HIDE A NOTE
	$(document).ready(function()
	{
		//function to returnt the clicked id
		function Notes(id)
		{
			return id;   
		}
		
		function displayFromDatabase()
		{
			$.ajax(
					{
						url: "<?php  ?>",
						type: "POST",
						async: false,
						data:{
							"display": 1
							},
						success: function(data)
						{						
							$("#display").html(data);
						}
					}		
				 );
		}
		
		displayFromDatabase();
		
		$("#hideNoteBt").click(function(e)
		{e.preventDefault();
			var nid = Note(id);
			alert(nid);
			/*var Id = $("#Id").val();
			var Hide = $("#Hide").val();
			var CreatedBy = $("#CreatedBy").val();
			
			if(Notes == '')		{ alert('Please Type A Note'); Notes.focus();  e.preventDefault();     return false;	}
			else
			{
				// Returns successful data submission message when the entered information is stored in database.
				var dataString = 'Notes='+ Notes + '&Id='+ Id + '&Hide='+ Hide + '&CreatedBy='+ CreatedBy;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "<?php  ?>",
					data: dataString,
					cache: false,
					success: function()
					{
						alert('Asset Notes Added Successful');
						document.getElementById('Notes').value = '';
						
						displayFromDatabase();		
					}
				});
			}*/
		});
		return false;
		
	});
	
	
</script> 


<script>	  //AJAX FUNCTION TO UPDATE ASSET

$(document).ready(function()
	{
		$("#assetUpd").click(function(ps)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var _url_id = "{{{$clientasset->AssetId}}}";
				var ClientId = $("#ClientId").val();
				var MakeId = $("#MakeId").val();
				var ModelId = $("#ModelId").val();
				var EqpYear = $("#EqpYear").val();
				var VIN = $("#VIN").val();
				var Color = $("#Color").val();
				var LicensePlate = $("#LicensePlate").val();
				var FuelTypeId = $("#FuelTypeId").val();
				var AssetTypeId = $("#AssetTypeId").val();
				var Active = $("input[name='Active']:checked").val();
				var update_at = date('Y-m-j');
				var _token = $("#_token").val();

				// Returns successful data submission message when the entered information is stored in database.
				var assetpro = 'ClientId='+ ClientId + '&MakeId='+ MakeId + '&ModelId='+ ModelId + '&EqpYear='+ EqpYear + '&VIN='+ VIN + '&Color='+ Color + '&LicensePlate='+ LicensePlate + '&FuelTypeId='+ FuelTypeId + '&AssetTypeId='+ AssetTypeId + '&Active='+ Active + '&update_at='+ update_at + '&_token='+ _token;

				ps.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "{{route('clientasset.update', array($clientasset->AssetId))}}",
					data: assetpro,
					cache: false,
					success: function()
					{
						alert('Vehicle Profile Updated Successfully !');									
					}
				});
			} 
			else 
			{
				ps.preventDefault();
			}
		
		});
		return false;
	});

</script>

<script>      //AJAX FUNCTION TO ADD PURCHASE SUMMARY
	$(document).ready(function()
	{
		
		$("#addPurcBtn").click(function(ad)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Client Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
                var ClientId = $("#ClientId").val();
				var PurchaseDate = $("#PurchaseDate").val();
				var PurchasePrice = $("#PurchasePrice").val();
				var PurchaseOrder = $("#PurchaseOrder").val();
				var AssetCondition = $("#AssetCondition").val();
				var DealerId = $("#DealerId").val();
				var PurchaseMileage = $("#PurchaseMileage").val();
				var CreatedBy = $("#CreatedBy").val();
                var created = date('Y-M-j');
                var updated_at = date('Y-m-j');

				// Returns successful data submission message when the entered information is stored in database.
				var psdata = 'AssetId='+ AssetId + 'ClientId='+ ClientId + '&PurchaseDate='+ PurchaseDate + '&PurchasePrice='+ PurchasePrice + '&PurchaseOrder='+ PurchaseOrder + '&AssetCondition='+ AssetCondition + '&DealerId='+ DealerId + '&PurchaseMileage='+ PurchaseMileage + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at;

				ad.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
                    type: "POST",
                    url: "{{route('clientasset.insertPurchaseSummary')}}",
                    data: psdata,
                    cache: false,
                    success: function()				
                    {					
                        alert('Purchase Summary Added Successful');						
                    }
				});
			} 
			else 
			{
				ad.preventDefault();
			}	
			
		});
		return false;

	});
	
</script>

<script>      //AJAX FUNCTION TO UPDATE PURCHASE SUMMARY
	$(document).ready(function()
	{
		
		$("#updPurcBtn").click(function(up)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
                var ClientId = $("#ClientId").val();
				var PurchaseDate = $("#PurchaseDate").val();
				var PurchasePrice = $("#PurchasePrice").val();
				var PurchaseOrder = $("#PurchaseOrder").val();
				var AssetCondition = $("#AssetCondition").val();
				var DealerId = $("#DealerId").val();
				var PurchaseMileage = $("#PurchaseMileage").val();
                var created = date('Y-M-j');
                var updated_at = date('Y-m-j');

				// Returns successful data submission message when the entered information is stored in database.
				var psdata = 'AssetId='+ AssetId + 'ClientId='+ ClientId + '&PurchaseDate='+ PurchaseDate + '&PurchasePrice='+ PurchasePrice + '&PurchaseOrder='+ PurchaseOrder + '&AssetCondition='+ AssetCondition + '&DealerId='+ DealerId + '&PurchaseMileage='+ PurchaseMileage + '&created='+ created + '&updated_at='+ updated_at;

				ad.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
                    type: "POST",
                    url: "{{route('clientasset.updatePurchaseSummary', array($clientasset->AssetId))}}",
                    data: psdata,
                    cache: false,
                    success: function()				
                    {					
                        alert('Purchase Summary Updated Successful');						
                    }
				});
			}  
			else 
			{
				up.preventDefault();
			}
			
		});
		return false;
		
	});
	
</script>

<script>      //AJAX FUNCTION TO UPDATE SCHEDULE MAINTENANCE
	$(document).ready(function()
	{
		
		$("#updRemBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AsId").val();
                var ClientId = $("#ClientId").val();
				var MileInterval = $("#MileInterval").val();
				var DateInterval = $("#DateInterval").val();
				var LastMaintMile = $("#LastMaintMile").val();
				var LastMaintDate = $("#LastMaintDate").val();
				var DateReminder = $("#DateReminder").val();
				var MileReminder = $("#MileReminder").val();
				var WorkshopId = $("#WorkshopId").val();
				var CurrentMile = $("#CurrentMile").val();
				var CreatedBy = $("#CreatedBy").val();                
                var updated_at = date('Y-m-j');

				// Returns successful data submission message when the entered information is stored in database.
				var smdata = 'AssetId='+ AssetId + '&ClientId='+ ClientId + '&MileInterval='+ MileInterval + '&DateInterval='+ DateInterval + '&LastMaintMile='+ LastMaintMile + '&LastMaintDate='+ LastMaintDate + '&DateReminder='+ DateReminder + '&MileReminder='+ MileReminder + '&CurrentMile='+ CurrentMile + '&WorkshopId='+ WorkshopId + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at;

				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "{{route('clientasset.updateClientMaintnance', array(<?php if($schedulemaintenance) echo $schedulemaintenance->SchMaintId; ?> ))}}",
					data: smdata,
					cache: false,
					success: function()
					{
						alert('Schedule Maintenance Updated Successful');			
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
		
		$("#addRemBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AsId").val();
                var ClientId = $("#ClientId").val();
				var MileInterval = $("#MileInterval").val();
				var DateInterval = $("#DateInterval").val();
				var LastMaintMile = $("#LastMaintMile").val();
				var LastMaintDate = $("#LastMaintDate").val();
				var DateReminder = $("#DateReminder").val();
				var MileReminder = $("#MileReminder").val();
				var WorkshopId = $("#WorkshopId").val();
				var CurrentMile = $("#CurrentMile").val();
				var CreatedBy = $("#CreatedBy").val();                
                var updated_at = date('Y-m-j');

				// Returns successful data submission message when the entered information is stored in database.
				var smdata = 'AssetId='+ AssetId + '&ClientId='+ ClientId + '&MileInterval='+ MileInterval + '&DateInterval='+ DateInterval + '&LastMaintMile='+ LastMaintMile + '&LastMaintDate='+ LastMaintDate + '&DateReminder='+ DateReminder + '&MileReminder='+ MileReminder + '&CurrentMile='+ CurrentMile + '&WorkshopId='+ WorkshopId + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at;

				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "{{route('clientasset.insertClientMaintnance')}}",
					data: smdata,
					cache: false,
					success: function()
					{
						alert('New Schedule Maintenance Saved Successful');			
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

<script>      //AJAX FUNCTION TO UPDATE RETIRE
	$(document).ready(function()
	{		
		$("#updRetBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Retire This Vehicle ?");
			if (r == true) 
			{
				var rmile = document.getElementById('RetireMileage').value;
				if(rmile != '')
				{
					e.preventDefault();
					alert('Sorry, This Vehicle Has Already Been Retired');	
				}
			} 
			else 
			{
				e.preventDefault();
			}
			/*var r = confirm("Are You Sure You Want To Retire This Vehicle ?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
				var RetireDate = $("#RetireDate").val();
				var RetireMileage = $("#RetireMileage").val();
				var DisposalMethod = $("#DisposalMethod").val();
				var RetireSalePrice = $("#RetireSalePrice").val();
				var RetireReason = $("#RetireReason").val();
				var RetireComment = $("#RetireComment").val();
				var Status = '1';
				var DomainId = $("#DomainId").val();
				var CreatedBy = $("#CreatedBy").val();

				// Returns successful data submission message when the entered information is stored in database.
				var rdata = 'AssetId='+ AssetId + '&RetireDate='+ RetireDate + '&RetireMileage='+ RetireMileage + '&DisposalMethod='+ DisposalMethod + '&RetireSalePrice='+ RetireSalePrice + '&RetireReason='+ RetireReason + '&RetireComment='+ RetireComment + '&DomainId='+ DomainId + '&Status='+ Status + '&CreatedBy='+ CreatedBy;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "<?php  ?>",
					data: rdata,
					cache: false,
					success: function()
					{
						alert('The Vehicle Has Been Retired');			
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}*/
		});
		return false;
	});
</script>

<script>      //AJAX FUNCTION TO UPDATE ACTIVE
	$(document).ready(function()
	{
		
		$("#updActBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
				var StartDate = $("#StartDate").val();
				var EndDate = $("#EndDate").val();
				var VendorId = $("#VendorId").val();
				var WorkOrderId = $("#WorkOrderId").val();
				var Reason = $("#Reason").val();
				var Status = '1';
				var CreatedBy = $("#CreatedBy").val();

				// Returns successful data submission message when the entered information is stored in database.
				var updata = 'AssetId='+ AssetId + '&StartDate='+ StartDate + '&EndDate='+ EndDate + '&VendorId='+ VendorId + '&WorkOrderId='+ WorkOrderId + '&Reason='+ Reason + '&Status='+ Status + '&CreatedBy='+ CreatedBy;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "<?php  ?>",
					data: updata,
					cache: false,
					success: function()
					{
						alert('Availability Setting Updated Successful');			
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


<script>      //AJAX FUNCTION TO ADD NEW ACTIVE
	$(document).ready(function()
	{
		
		$("#addActBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make This Asset Inactive ?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
				var StartDate = $("#StartDate").val();
				var EndDate = $("#EndDate").val();
				var VendorId = $("#VendorId").val();
				var WorkOrderId = $("#WorkOrderId").val();
				var Reason = $("#Reason").val();
				var Status = '1';
				var CreatedBy = $("#CreatedBy").val();

				// Returns successful data submission message when the entered information is stored in database.
				var adata = 'AssetId='+ AssetId + '&StartDate='+ StartDate + '&EndDate='+ EndDate + '&VendorId='+ VendorId + '&WorkOrderId='+ WorkOrderId + '&Reason='+ Reason + '&Status='+ Status + '&CreatedBy='+ CreatedBy;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "<?php  ?>",
					data: adata,
					cache: false,
					success: function()
					{
						alert('Availability For This Asset Now Unavailable');			
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

<script>      //AJAX FUNCTION TO ADD NEW RETIRE
	$(document).ready(function()
	{
		
		$("#addRetBtn").click(function(e)
		{
			 var r = confirm("Are You Sure You Want To Retire This Vehicle ?");
			if (r == true) 
			{
				var AssetId = $("#AssetId").val();
                var ClientId = $("#ClientId").val();
				var RetireDate = $("#RetireDate").val();
				var RetireMileage = $("#RetireMileage").val();
				var DisposalMethod = $("#DisposalMethod").val();
				var RetireSalePrice = $("#RetireSalePrice").val();
				var RetireReason = $("#RetireReason").val();
				var RetireComment = $("#RetireComment").val();
				var Status = '1';
				var CreatedBy = $("#CreatedBy").val();
                var created = date('Y-M-j');
                var updated_at = date('Y-m-j');

				// Returns successful data submission message when the entered information is stored in database.
				var rdata = 'AssetId='+ AssetId + '&ClientId='+ ClientId + '&RetireDate='+ RetireDate + '&RetireMileage='+ RetireMileage + '&DisposalMethod='+ DisposalMethod + '&RetireSalePrice='+ RetireSalePrice + '&RetireReason='+ RetireReason + '&RetireComment='+ RetireComment + '&Status='+ Status  + '&CreatedBy='+ CreatedBy + '&created='+ created  + '&updated_at='+ updated_at;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "{{route('clientasset.retireClientAsset', array($clientasset->AssetId))}}",
					data: rdata,
					cache: false,
					success: function()
					{
						alert('The Vehicle Has Been Retired');			
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




<script>
$(document).ready(function()
	{
		$('#editSummBtn').click(function()	{			$('#tabCont').slideUp();		$('#addSummary').slideDown();		});
		$('#hideSummBtn').click(function()	{			$('#addSummary').fadeOut();	$('#tabCont').slideDown();			});
	});
</script>

<!-- DATATABLES -->
<script> //dtables
	$(document).ready(function()
	{
	    $('#myTable').DataTable();
	});

	$(document).ready(function()
	{
		$('.fuelDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.anoteDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.orderDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.jobDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.ex').dataTable();
	});

	$(document).ready(function()
	{
		$('.fileDTable').dataTable();
	});
</script>


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
    
    function fuel(id)
	{
		$('#Asset_Ids').val(id);   
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
				var _url_id = "<?php if($clientassetavailability) { echo $clientassetavailability->AssetAvailId; }else { echo '0';} ?>";				
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
							url: "{{route('clientasset.putBackInService', array(<?php if($clientassetavailability) { echo $clientassetavailability->AssetAvailId; }else { echo '0';} ?>))}}",
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


<!-- SCRIPT TO MAKE ALL FIELDS READONLY IF THE ASSET IS RETIRED  -->
<script>
	$(document).ready(function()
	{
		var retired = "{{{ $assetretirecount }}}";
		//alert('Vehicle Status ' + avail);
		if(retired > 0)
		{
			$('#retire').show();
			$(':input').attr('readOnly','readOnly');
			var s_id;
			var x = document.getElementsByTagName("select");
			var i;
			for (i = 0; i < x.length; i++) 
			{
				s_id = x[i].id; 
				document.getElementById(s_id).disabled = true;      //alert(s_id);
			}
		}
		else {}
	});
</script>


<script>
function reply_click(clicked_id)
{
    alert(clicked_id);
}
</script>

<script>      //SHOWING ADD EXPENSE DIV
	$(document).ready(function()
	{	
		$('#showExpDiv').click(function()
		{
			$('#expDiv').slideDown();
			$('#expTable').hide();
		});
	});
</script>



<script>//script for asset make model dependency
	$(document).ready(function()
	{
		$('#MakeId').change(function(e)
		{
			console.log(e);
			var makeid = e.target.value;
			$.get('{{url('make-models')}}?MakeId=' + makeid, function(data)
			{  //success data
				$('#ModelId').empty();
				$('#ModelId').append('<option value=""> Select Vehicle Model  </option>')
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









@stop