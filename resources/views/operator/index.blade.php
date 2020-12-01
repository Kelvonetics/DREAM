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
		color:#666; margin:auto 2% auto 1.5%;
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
	<div class="page-header" style="margin-bottom:10px;">
	<h1>      <i class="fa fa-user-plus"></i>     Driver Administration </h1> 
	<p class="lead"> The driver administration module allows you to convert system users to drivers for proper documentation and administration, <br> view a list of drivers and modify existing driver details.  </p>

	 </div>
	
	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

  
	<!-- left content -->
	  <div class="col-md-12 col-md-pull-0"> 
		 <a href="{{ route('operator.add') }}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;font-size:10px"> <i class="fa fa-plus"></i>  New Driver</a>
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
				
    <table id="example" class="table table-full table-full-small ops" cellspacing="0" width="100%">

		<thead>
				<tr>
				<th> First Name </th>
				<th> Last Name </th>
				<th> Department </th>
				<th> Position </th>
				<th> Phone </th>
				<th> Email </th>
				<th> Status  </th>
				<th scope="col" class="actions"></th>
			</tr>
        </thead>
        <tbody>
				@if($users)
        @foreach ($users as $users)
        <tr>

				<td> 
					<?php		  	
						$id = $users->UserId;
						$user = DB::table('users')->where('UserId', '=', $id)->first();
					?> 
					@if($user) {{$user->FirstName}} @endif
				</td>
        <td>@if($user) {{$user->LastName}} @endif  </td>
				
				<td>
					<?php		  	
						$did = $users->DeptId;
						$department = DB::table('department')->where('DeptId', '=', $did)->first();
					?>
					@if($user) {{$department->DeptName}} @endif
				</td>

				<td>
					<?php 
						$po_id = $user->PositionId;						
						$position = DB::table('userposition')->where('PositionId', '=', $po_id)->first();
					?>
					@if($user) {{$position->PositionName}} @endif
				</td>
				
				<td> @if($user) {{$user->Phone}} @endif </td>
				<td> @if($user) {{$user->email}} @endif </td>
				<td align="left">
					@if($users->Active == 1)
							<img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
					@elseif($users->Active == 0)
							<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">       
					@endif
				</td>
				<td style="overflow:visible">
				<div class="dropdown" style="">
					<button class="btn btn-success dropdown-toggle" type="button" id="" data-toggle="dropdown" style="font-size:9px">actions
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li><a href="{{route('operator.view', $users->UserId)}}" role="" style="font-size:11px">View Profile</a></li>
					  <li><a onclick="incident({{$users->OperatorId}})" role="menuitem" id="" data-toggle="modal" data-target="#incidentModal" style="font-size:11px">Report Incident</a></li>
					  <li><a onclick="certification({{$users->OperatorId}})" role="menuitem" id="" data-toggle="modal" data-target="#certModal" style="font-size:11px">Add Certificate</a></li>
					  <li><a onclick="leave({{$users->OperatorId}})" role="menuitem" id="" data-toggle="modal" data-target="#leaveModal" style="font-size:11px">Assign Leave</a></li>
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


<!-- incident Modal -->		
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addIncidentFromIndex') }}">	
<div id="incidentModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-truck" aria-hidden="true"></i> Driver Incident </h4>
      </div>
      <div class="modal-body">
       

	  			@include('modals.index_incident_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 
							



<!-- certification Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addCertificateFromIndex') }}">	
<div id="certModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-certificate" aria-hidden="true"></i> Driver Certification </h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.index_certificate_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- Leave Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/operator/addLeaveFromIndex') }}">	
<div id="leaveModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-coffee" aria-hidden="true"></i> Driver Leave </h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.index_leave_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<script>
	$(document).ready(function()
	{
		$('.ops').dataTable();
	});
</script>	

<script>
	function incident(id)
	{
		$('#OperatorId').val(id);   
    }
	
	function certification(id)
	{
		$('#Operatorid').val(id);   
    }
	
	function leave(id)
	{
		$('#Operator_Id').val(id);   
    }
</script>





@stop