@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 

<?php
	
	//limit caracters
	function custom_echo($x, $length)
	{
	  if(strlen($x)<=$length)
	  {
		echo $x;
	  }
	  else
	  {
		$y=substr($x,0,$length) . '...';
		echo $y;
	  }
	}
?>

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
		border:#eee thin solid; 
		margin:7px 0px; 
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
		padding:5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 4% auto 0%;
	}

.sel-opt-full
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 1.5%;
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
</style>




		
<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="fa fa-male"></i>   Driver Administration  </h1>  
	  <p class="lead"> The driver administration module allows you to convert system users to drivers for proper documentation and administration, <br> view a list of drivers and modify existing driver details.	   </p> <br>
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
      <li><a class="" data-toggle="tab" href="#incident"><span><i class="fa fa-car"></i> Incident</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#certifications"><span><i class="fa fa-certificate"></i> Certifications</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#leave"><span><i class="fa fa-coffee"></i> Leave</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#notes"><span><i class="fa fa-sticky-note"></i> Notes</span> </a> </li>
 
</ul>


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

		
		<a onclick="UserProfileUpload({{$id}})" href="#" class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple pull-right" data-toggle="modal" data-target="#userprofileModal" style="margin-right:-20px;" title="Edit User Profile Photo"> <i class="fa fa-photo" style="color:red;"></i> </a>
				
				<?php	
					$user_pic = DB::table('users')->where('UserId', '=', $id)->first();				
					if($user_pic)	
					{	
						$pic = $user_pic->UserPicture;   if($pic == ''){ $pic = "avatar.jpg"; }
					}
					else{ $pic = "avatar.jpg";  }
				?>

			<center> <img src="{{URL::asset('assets/img/users/'.$pic)}}" class="img-responsive" height="150" width="150">
			<span style=""> <?= $user_pic->FirstName. ' '.$user_pic->LastName; ?> </span> 
			</center>

			
		</div>
		
			<!-- quick report div  -->
			<?php //$operator = DB::table('assignasset')->where('UserId', '=', $id)->get();  ?>
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
				  <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn" title='Add New Client Job'>+</a></div>
				  <div class="w600"><a style="color:#2196F3;font-weight:lighter" 
				  href="{{route('job.driver-resent-jobs', $id)}}">Last 10 Jobs Assigned To Driver </a></div>
				</div>
				
				<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
				  <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Assign Vehicle To Driver'>+</a></div>
				  <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="{{route('asset.driver-resent-assets', $id)}}">Last 10 Vehicle Assigned To Driver  </a></div>
				</div>
				
			  </div>
			</div>
			

			<!-- quick information div  -->
			<div class="grey-card">
			<div style="margin:-10px 15px 0px 10px">
			</div>
			</div>
		
	  </div>




<!-- TAB CONTENT FOR profile BEGIN -->  


<div class="tab-content">
  <div id="profile" class="tab-pane fade in active">
  <div class="widget widget-table action-table">
  
	  
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
	
		<div>
		
        <form class="form-horizontal" method="post" action="{{ url('/operator/update', array($operator->OperatorId)) }}">
			<fieldset>
					
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Drivers Details</CAPTION>
			
					<tr class="box-section">  
						<td width="50%">  
							<div class="form-group">
								<label for="FirstName" class="fm-label label-left"> <i class="fa fa-male" aria-hidden="true"></i> First Name </label>
								<input type="text" name="FirstName" id="FirstName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999"@if($opUser)  value="{{$opUser->FirstName}}"@endif readonly />
							</div>
							
							<div class="form-group">
								<label for="Email" class="fm-label label-left">  <i class="fa fa-envelope" aria-hidden="true"></i> E-mail</label>
								<input type="email" name="Email" id="Email" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999"@if($opUser)  value="{{$opUser->email}}"@endif readonly />
							</div>
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="LastName" class="fm-label label-right"> <i class="fa fa-male" aria-hidden="true"></i> Last Name</label>
								<input type="text" name="LastName" id="LastName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($opUser) value="{{$opUser->LastName}}"@endif readonly />
							</div>
								
							<div class="form-group">
								<label for="Phone" class="fm-label label-right"> <i class="fa fa-phone" aria-hidden="true"></i> Phone </label>
								<input type="text" name="Phone" id="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999"@if($opUser) value="{{$opUser->Phone}}"@endif readonly />
							</div>
						</td>
					</tr>
					
					
				</table>

				
				<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
				<CAPTION>Job Profile</CAPTION>
			
					<tr class="box-section">
						<td width="50%">  
							<div class="form-group">
								<label for="RoleId" class="fm-label label-left"> <i class="fa fa-users" aria-hidden="true"></i> Role * </label>
								<input type="text" name="RoleId" id="RoleId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 4%; color:#999" value="<?php
									$role = DB::table('role')->where('RoleId', '=', $opUser->RoleId)->first();
								?>" @if($role) {{$role->RoleName}} @endif readonly />
							</div>
							
							<div class="form-group">
								
							</div>
						
						
						</td>

						<td width="50%">
							<div class="form-group">
								<label for="PositionId" class="fm-label label-right"> <i class="fa fa-street-view" aria-hidden="true"></i> Position </label>
								<input type="text" name="PositionId" id="PositionId" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" value="<?php
									$Position = DB::table('userposition')->where('PositionId', '=', $opUser->PositionId)->first();
								?>
								" @if($Position) {{$Position->PositionName}} @endif readonly />
							</div>
							
							<div class="form-group">
							
							</div>
								
						</td>
					</tr>
					<tr class="box-section"> 
						<td width="100%" colspan="2">
							<div class="form-group">
								<label for="DeptId" class="fm-label label-full"> <i class="fa fa-building" aria-hidden="true"></i> Department </label>
								<input type="text" name="DeptId" id="DeptId" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px;margin:auto 1% auto 2%; color:#999" value="<?php
									$department = DB::table('department')->where('DeptId', '=', $opUser->DeptId)->first();
								?>
								" @if($department) {{$department->DeptName}} @endif readonly />
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
  


<div id="incident" class="tab-pane fade">
  <div class="widget widget-table action-table">

    
	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> <br>  

	<a class="waves-effect waves-light btn modalBtn btn-primary"  data-toggle="modal" data-target="#incidentModal" title='Report New Driver Incident' data-tooltip="true" 
	href="#" style="color:white"><i class="fa fa-plus"></i> New Incident</a>	

	<div class="pad"> 
	
		<table id="ex" class="table table-full table-full-small inci" cellspacing="0" width="100%">
			<thead>
				<tr style="">
					<th> Id</th>
					<th> Plate No </th>
					<th> Incident Date </th>
					<th> Incident Type </th>
					<th> Driver </th>
					<th> Note </th>
				</tr>
			</thead>
			<tbody>
				<?php
					$op_id = $operator->OperatorId;
					$records = DB::table('driverincident')->where('OperatorId', '=', $op_id)->orderBy('IncidentId', 'desc')->take(10)->get();  ?>

					@if($records)
					@foreach($records as $records)
					<tr>	
						<td>
							{{$records->IncidentId}}								
						</td>	<td>							
							<?php 
								$asid = $records->IncidentVehicle;
								$asset = DB::table('asset')->where('AssetId', '=', $asid)->first();
							?> @if($asset) {{$asset->LicensePlate}} @endif
						</td>	<td>
								{{$records->IncidentDate }}								
						</td>	<td>
								{{$records->IncidentType }}
						</td>	<td>
							<?php
								$opid = $records->OperatorId;
								$operator = DB::table('operator')->where('OperatorId', '=', $opid)->first();
								$us_id = $operator->UserId;	
								
								$users = DB::table('users')->where('UserId', '=', $us_id)->first();
							?> @if($users) {{$users->FirstName.' '.$users->LastName}} @endif
						</td>	<td style="width:30%">
							<?php
								$note = $records->Notes; 
								$notes = substr($note, 0, 50); 
								echo $notes.' ...';
							?>	
						</td>  </tr>
					@endforeach
					@endif
				</tbody>
			</table>
							
				
	</div>
   </div>
		  
		

	
  </div>  
</div>


<div id="certifications" class="tab-pane fade">
  <div class="widget widget-table action-table">
  
    <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">  <br> 

  
	<a onclick="certification(<?= $operator->OperatorId ?>)" class="waves-effect waves-light btn modalBtn btn-primary"  data-tooltip="true"  data-toggle="modal" data-target="#certModal" title='Add New Driver Certification' 
	href="#" style="color:white"><i class="fa fa-plus"></i> New Certificate</a>

	<div class="pad"> 

	<table id="example" class="table table-full table-full-small cert" cellspacing="0" width="100%">
		<thead>
			<tr style="background-color:#f9f9f9;">
				<th> Id</th>
				<th> Driver </th>
				<th> Category </th>
				<th> Description </th>
				<th> Expiry Date </th>
				<th> Certificate </th>
			</tr>
		</thead>
		<tbody>
			<?php
				$op_id = $operator->OperatorId;
				$records = DB::table('drivercertification')->where('OperatorId', '=', $op_id)->orderBy('CertificateId', 'desc')->take(10)->get();  ?>

				@if($records)
				@foreach($records as $records)
				<tr>	
					<td>{{$records->CertificateId}}</td>	
					<td>
						<?php 
							$opid = $records->OperatorId;
							$ops = DB::table('operator')->where('OperatorId', '=', $opid)->first();
							$user_id = $ops->UserId;

							$users = DB::table('users')->where('UserId', '=', $user_id)->first();
						?> @if($users) {{$users->FirstName.' '.$users->FirstName}} @endif
					</td>	
					<td>
						<?php 
							$Cid = $records->Category;
							$cartCate = DB::table('certificatecategory')->where('CategoryId', '=', $Cid)->first();
						?> @if($cartCate) {{$cartCate->Category}} @endif
					</td>	
					<td>{{$records->Description}}</td>	
					<td>{{$records->CertificateExpiryDate}}</td>	
					<td>{{$records->name}}</td>  
				</tr>
			@endforeach
			@endif
		</tbody>
	</table>
				
	</div>
   </div> 
			   
			   

</div>			
</div>


<div id="leave" class="tab-pane fade">
  <div class="widget widget-table action-table">
	
	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">  <br> 
	
		<a onclick="leaved(<?= $operator->OperatorId ?>)" class="waves-effect waves-light btn modalBtn btn-primary" data-tooltip="true"  data-toggle="modal" data-target="#leaveModal" title='Add Driver Leave Details' 
		href="#" style="color:white"><i class="fa fa-plus"></i> New Leave</a>
		<div class="pad"> 

			<table id="example" class="table table-full table-full-small leave" cellspacing="0" width="100%">
				<thead>
					<tr style="background-color:#f9f9f9;">
						<th> Driver </th>
						<th> Leave From </th>
						<th> Leave To </th>
						<th> Leave Type </th>
						<th> Leave Reason </th>
						<th>  </th>
					</tr>
				</thead>
				<tbody>
				<?php
					$op_id = $operator->OperatorId;
					$record = DB::table('driverleave')->where('OperatorId', '=', $op_id)->orderBy('LeaveId', 'desc')->take(10)->get();
					$User = DB::table('operator')->where('OperatorId', '=', $op_id)->first();
				?>
				@if($record)
					@foreach($record as $record)
					<tr>
						<td> 
							<?php 
								$opid = $record->OperatorId;
								$ops = DB::table('operator')->where('OperatorId', '=', $opid)->first();
								$user_id = $ops->UserId;

								$users = DB::table('users')->where('UserId', '=', $user_id)->first();
							?> @if($users) {{$users->FirstName.' '.$users->FirstName}} @endif
						</td>
						<td>{{$record->LeaveStartDate}}</td>
						<td>{{$record->LeaveEndDate}}</td>
						<td> 
							<?php 
								$type = $record->LeaveType;
								$leave_type = DB::table('leavetype')->where('LeaveTypeId', '=', $type)->first();
							?> @if($leave_type) {{$leave_type->LeaveType}} @endif
						</td>
						<td>{{$record->LeaveReason}}</td>
						<td>
							<a href="{{route('operator.absent-jobs-and-vehicles', $User->UserId)}}" class='btn' style='color:#666; font-size:9px'> Jobs N Vehicles </a>
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
  
  
  
  <div id="notes" class="tab-pane fade">
  <div class="widget widget-table action-table">
  
	
	  

	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

         <div class="pad">
	  
	  
		 <form class="form-horizontal" method="POST" action="{{ url('/operator/addNote') }}">	
		<fieldset>
			<!-- <span class="help-block">Please Fill Out Details For Asset Notes Below.</span> -->
			
			<div class="form-group" style="padding:0px 10px">

			<textarea class="form-control vertical" rows="3" name="Notes" id="Notes" style="width:99%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0.5%; color:#999;" onkeyup="convert_notes()" required></textarea> 
			<!-- <span class="help-block"></span> -->
			</div>
			
			

			<div class="form-group"> 
				<input type="hidden" name="Hide" id="Hide" class="form-control" value="0">
				<input type="hidden" name="UserId" id="UserId" class="form-control" value="{{$opUser->UserId}}">
				<input type="hidden" name="OperatorId" id="Id" class="form-control"  value="<?= $operator->OperatorId ?>">  						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
				<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}"> 	
			</div>						
			
			
				
			<div class="form-group" style="padding:0px 15px">
			<button type="submit" class="btn btn-primary" id="addNoteBtn">Add Notes</button>
			<button type="reset" class="btn btn-default">Cancel</button> 
			</div>
		</fieldset>
		</form>
	  
	  <div id="display">
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
	  <input type="hidden" name="UID" value="{{$id}}" >
  </div>
  </div>







  </div>
  </div>
  

</div>
</div>







</div>
</section>
</div>




<!-- incident Modal -->		
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addIncident') }}">	
<div id="incidentModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-truck" aria-hidden="true"></i> Driver Incident </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.incident_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 
							



<!-- certification Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addCertificate') }}">	
<div id="certModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-certificate" aria-hidden="true"></i> Driver Certification </h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.certificate_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- Leave Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addLeave') }}">	
<div id="leaveModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-coffee" aria-hidden="true"></i> Driver Leave </h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.leave_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>




<!-- Asset Profile Photo Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/uploadProfilePhoto') }}">	
<div id="userprofileModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-upload" aria-hidden="true"></i> Upload User Profile Photo</h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.userprofilePhoto_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>









<script> //get id functions
	function UserProfileUpload(id)
	{
		$('#UserId').val(id);   
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
			var r = confirm("Are You Sure You Want To Make Changes To Asset Profile # {0}?");
			if (r == true) 
			{
				var FirstName = $("#FirstName").val();
				var LastName = $("#LastName").val();
				var Company = $("#Company").val();
				var Email = $("#Email").val();
				var Phone = $("#Phone").val();
				var Address = $("#Address").val();
				var Country = $("#Country").val();
				var State = $("#State").val();
				var City = $("#City").val();
				var CreatedBy = $("#CreatedBy").val();
				var created = '2016';
				var modified = '2016';
				// Returns successful data submission message when the entered information is stored in database.
				var data = 'FirstName='+ FirstName + '&LastName='+ LastName + '&Company='+ Company + '&Email='+ Email + '&Phone='+ Phone + '&Address='+ Address + '&Country='+ Country + '&State='+ State + '&City='+ City + '&CreatedBy='+ CreatedBy + '&created='+ created + '&modified='+ modified;
				
				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "",
					data: data,
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


<script>
	$(document).ready(function()
	{
		$('#MakeId').change(function()
		{
			var MakeId = $(this).val();
			$.ajax({
				url:"",
				method:"POST",
				data:{makeId:MakeId},
				dataType:"text",
				success:function(data)
				{
					$('#ModelId').html(data);
				}
			});
		});
	});
</script>

<script>      //AJAX FUNCTION TO ADDING NEW NOTES
	$(document).ready(function()
	{	
		function displayFromDatabase()
		{	
			var pic = "{{URL::asset("assets/img/avatar.jpg")}}";
			var UId = $("#UserId").val();
			 
			$.get('{{url('fetch-operatornotes')}}', function(data)
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
			var r = confirm("Are You Sure You Want To Make Changes To Drivers Profile # {0}?");
			if (r == true) 
			{
				var Notes = $("#Notes").val();
				var OperatorId = $("#Id").val();
				var Hide = $("#Hide").val();
				var UserId = $("#UserId").val();
				var _token = $("#_token").val();
				var CreatedBy = $("#CreatedBy").val();
				var updated_at = $("#updated_at").val();
				if(Notes == '')		{ alert('Please Type A Note'); Notes.focus();  e.preventDefault();     return false;	}
				else
				{
					// Returns successful data submission message when the entered information is stored in database.
					var dataString = 'Notes='+ Notes + '&OperatorId='+ OperatorId + '&Hide='+ Hide + '&UserId='+ UserId + '&_token='+ _token + '&CreatedBy='+ CreatedBy + '&updated_at='+ updated_at;
					
					e.preventDefault();
					// AJAX Code To Submit Form.
					$.ajax(
					{
						type: "POST",
						url: "/operator/addNote",
						data: dataString,
						cache: false,
						success: function()
						{
							alert('Driver Notes Added Successful');
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


<script>
	$(document).ready(function()
	{
		$('.job').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.assignasset').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.cert').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.leave').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.inci').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.dnote').dataTable();
	});
</script>

<script>

	
	function certification(id)
	{
		$('#Operatorid').val(id);   
    }
	
	function leaved(id)
	{
		$('#OpId').val(id);   
    }
</script>

<script>   //function to capitalise notes
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



@stop