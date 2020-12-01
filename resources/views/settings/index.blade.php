@include('templates.config')
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
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 3%;
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
		color:#666; margin:auto 2% auto 3%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 0%;
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
		<h1>      <i class="fa fa-cogs"></i>    General Settings </h1> 	<p class="lead"> Configure The System settings</p>           
	</div>
	
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
  
<div class="">
              
  

<div class="widget-content" id="tabCont">

<ul class="nav nav-tabs card" style="width:75%">

      <li><a class="active" data-toggle="tab" href="#notification"><span><i class="fa fa-bell"></i> Notifications</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#workflow"><span><i class="fa fa-arrows-h"></i> Workflow</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#config"><span><i class="fa fa-envelope"></i> Configuration</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#subscription"><span><i class="fa fa-envelope"></i> Subscription</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#cloud"><span><i class="fa fa-cloud"></i> Link</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#automation"><span><i class="fa fa-magic"></i> Automation</span> </a> </li>
      <li><a class="" data-toggle="tab" href="#settings"><span><i class="fa fa-cog"></i> General </span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#driver"><span><i class="fa fa-user"></i> Driver Schedule</span> </a> </li>
	
 
</ul>


<!-- right content -->
	<div class="col-md-3 col-md-push-9 left-side" style="margin:-90px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card"> 		 
				
                <center> <img src="{{URL::asset('assets/img/settings.png')}}" class="img-responsive" height="150" width="150"> </center>

			</div>  	
			
			
				<!-- quick report div  -->
				
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
                
				</div>
				</div>
			
	</div>

		  






<!-- TAB CONTENT FOR notification BEGIN -->  

<div class="tab-content" style="">
  <div id="notification" class="tab-pane fade in active">
  <div class="widget widget-table action-table ">


	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
      <form class="form-horizontal" method="post" action="{{ url('/settings/update_stock', array($stock->ItemStockSettingId)) }}">
      	 <fieldset>
	 
    <table width="100%" border="0" cellspacing="5" cellpadding="10" style="">
		<caption> Inventory Item Notification Setting </caption>
		<tr>
			<td width="30%">
				<label for="InStock" class="control-label" required>In Stock Quantity</label>
				<input type="text" name="InStock" id="InStock" Required  style="border:thin #ede solid;	width:93%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"
				@if($stock) value="{{$stock->InStock}}" @endif>
			</td>

			<td width="30%">	<label for="Limited" class="fm-label"> Limited Quantity</label>
				<input type="text" name="Limited" id="Limited" style="border:thin #ede solid; width:93%;	padding:10px 5px;	border-radius:4px;margin:auto 6% auto -1%; color:#999"@if($stock) value="{{$stock->Limited}}"@endif />
			</td>
			
			<td width="30%">	<label for="OutOfStock" class="fm-label"> Out Of Stock</label>
				<input type="text" name="OutOfStock" id="OutOfStock" style="border:thin #ede solid; width:93%;	padding:10px 5px;	border-radius:4px;margin:auto 6% auto -1%; color:#999"@if($stock) value="{{$stock->OutOfStock}}"@endif />				
			</td>
			<td width="10%">				
				<button type="submit" class="btn btn-primary" id="notifSetBtns" style="margin-top:28px">Update Setting</button>
				
				<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
			</td>
		</tr>
		
	</table>
	</fieldset>
	</Form>	
	</div>
	
  </div>
  </div>
  
  
  <div id="workflow" class="tab-pane fade in">
  <div class="widget widget-table action-table ">

	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">				 	
		@if($flow)
            <?php if($flow_tot == 0)  { ?>
                <form class="form-horizontal" method="post" action="{{ url('/settings/insert_flow') }}">
            <?php }
                
            elseif($flow_tot > 0) { ?>
                <form class="form-horizontal" method="post" action="{{ url('/settings/update_flow_WorkOrder', array($flow->WorkFlowId)) }}">
            <?php } ?>
        @endif
                
        <div class="row" style="padding:8px 2px 2px 2px;">
                
            <div class="col-md-2" style="text-align:right; padding-top:10px">   Status Update Settings </div>
            
            <div class="col-md-10 box-right">  
                <div class="radio" style="margin:0px 2px">
                    <div class="col-md-2">						 									
                        <input type="radio" name="Active" value="1" id="Active_0" class="check_yes" />&nbsp; Yes 
                    </div>
                    <div class="col-md-2">						 									 
                        <input type="radio" name="Active" value="0" id="Active_1" class="check_no" />&nbsp; No 
                    </div>
                </div>
				
				
				
				
				<div id="workorder" class="" style="display:none; padding:10px 2px"> 
				<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
					
					<tr style="height:10px"> <td> </td> <td> </td> </tr>
					
					<tr>

						<td colspan="2">	
						<i class="lead"> Select The Role To Notify When Updating Work Order </i> <br>
						<label for="RoleId" class="fm-label"> <i class="fa fa-male" aria-hidden="true"></i> RoleId Settings </label>
							<select class='sel-opt' name='RoleId' id='RoleId' style="margin:auto 2% auto 0%;width:98%" required>
							 <?php					
								$work = DB::table('workflow')->where('WorkFlowName', '=', 'Work Order')->first();	
                                $Role = DB::table('role')->where('RoleId', '=', $work->RoleId)->first();	
                                $Roles = DB::table('role')->get();	
                             ?>		
                                @if($Role)	
                                    <option value="{{$Role->RoleId}}"> {{$Role->RoleName}} </option>
                                @endif						
								<option value=""> Select Role </option>
								@if($Roles)
                                @foreach($Roles as $Roles)	
                                    <option value="{{$Roles->RoleId}}"> {{$Roles->RoleName}} </option>
                                @endforeach
								@endif
							 </select>
						</td>
						
					</tr>

					<tr style="height:10px"> <td> </td> <td> </td> </tr>

					<tr>
						<td colspan="2">	
							<div class="form-group">
							<label for="RoleId" class="fm-label" style="margin-left:15px"> <i class="fa fa-cogs" aria-hidden="true"></i> Settings Name </label>
								<input type="text" name="WorkFlowName" id="WorkFlowName" style="border:thin #ede solid;	width:94%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 2%; color:#999" value="Work Order" />
								<input type="hidden" name="roId" id="roId" style="border:thin #ede solid;	width:97%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 3%; color:#999"@if($flow) value="{{$flow->WorkFlowId}}"@endif />
							</div>
						</td>
					</tr>


					<tr style="height:10px"> <td> </td> <td> </td> </tr>
					
					
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
					<tr>
						<td colspan="4" class="pull-left"> 
							<div class="form-group" style="padding:20px 0px;" id="addActDiv">
								<button type="submit" class="btn btn-primary" id="">Update Workflow</button>
							</div> 

						</td>
					</tr>
					
				</table>
		
				</div>
				
				</div> 
				
				
			</div>
		</Form>
				
				
				
			
        <!-- PENDING AND APPROVAL -->				
        @if($flow_PA)
            <?php if($flow_PA_tot == 0)  { ?>
                <form class="form-horizontal" method="post" action="{{ url('/settings/insert_flow_PendingApproval') }}">
            <?php }  else if ($flow_PA_tot > 0) { ?>
                <form class="form-horizontal" method="post" action="{{ url('/settings/update_flow_PendingApproval', array($flow_PA->WorkFlowId)) }}">
            <?php } ?>
        @endif
				
                
			<div class="row" style="padding:8px 2px 2px 2px;">
					
                <div class="col-md-2" style="text-align:right; padding-top:10px">   Pending/Approved Settings </div>
                
                <div class="col-md-10 box-right">  
                    <div class="radio" style="margin:0px 2px">
                        <div class="col-md-2">						 									
                            <input type="radio" name="pna" value="1" id="Active_0" class="pa_yes" />&nbsp; Yes 
                        </div>
                        <div class="col-md-2">						 									 
                            <input type="radio" name="pna" value="0" id="Active_1" class="pa_no" />&nbsp; No 
                        </div>
                    </div>
						
						
						
						
						<div id="pendapprove" class="" style="display:none; padding:10px 2px"> 
						<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
							
							<tr style="height:10px"> <td> </td> <td> </td> </tr>

							<tr>

								<td colspan="2">	
								<i class="lead"> Select The Role To Notify When Pending And Approved Work Order </i> <br>
								<label for="RoleId" class="fm-label"> <i class="fa fa-male" aria-hidden="true"></i> RoleId Settings </label>
								<select class='sel-opt' name='RoleId' id='RoleId' style="margin:auto 2% auto 0%;width:98%" required>
								<?php					
								   $work = DB::table('workflow')->where('WorkFlowName', '=', 'Pending And Approved')->first();	
								   $Role = DB::table('role')->where('RoleId', '=', $work->RoleId)->first();	
								   $Roles = DB::table('role')->get();	
								?>		
								   @if($Role)	
									   <option value="{{$Role->RoleId}}"> {{$Role->RoleName}} </option>
								   @endif						
								   <option value=""> Select Role </option>
								   @if($Roles)
								   @foreach($Roles as $Roles)	
									   <option value="{{$Roles->RoleId}}"> {{$Roles->RoleName}} </option>
								   @endforeach
								   @endif
								</select>
								</td>
								
							</tr>

							<tr style="height:10px"> <td> </td> <td> </td> </tr>

							<tr>
								<td colspan="2">	
									<div class="form-group">
									<label for="RoleId" class="fm-label" style="margin-left:15px"> <i class="fa fa-cogs" aria-hidden="true"></i> Settings Name </label>
										<input type="text" name="WorkFlowName" id="WorkFlowName" style="border:thin #ede solid;	width:94%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 2%; color:#999" value="Pending And Approved" />
										<input type="hidden" name="roId" id="roId" style="border:thin #ede solid;	width:97%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 3%; color:#999"@if($flow) value="{{$flow->WorkFlowId}}"@endif />
									</div>
								</td>
							</tr>


							<tr style="height:10px"> <td> </td> <td> </td> </tr>


							
							
							<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
							<tr>
								<td colspan="4" class="pull-left"> 
									<div class="form-group" style="padding:20px 0px;" id="">
										<button type="submit" class="btn btn-primary" id="">Update Workflow</button>
									</div> 

								</td>
							</tr>
							
						</table>
				
						</div>
						
						</div> 
						
						
					</div>
				</Form>
				
				
				
				
				
				
				
				<!-- DECLINED -->
				@if($flow_DC)
                    <?php if($flow_DC_tot == 0)  { ?>
                        <form class="form-horizontal" method="post" action="{{ url('/settings/insert_flow_Declined') }}">
                    <?php } else if ($flow_DC_tot > 0) { ?>
                        <form class="form-horizontal" method="post" action="{{ url('/settings/update_flow_Declined', array($flow_DC->WorkFlowId)) }}">
                    <?php } ?>
                @endif
				
			<div class="row" style="padding:8px 2px 2px 2px;">
					
				<div class="col-md-2" style="text-align:right; padding-top:10px">   Declined Settings </div>
				
				<div class="col-md-10 box-right">  
					<div class="radio" style="margin:0px 2px">
						<div class="col-md-2">						 									
							<input type="radio" name="d" value="1" id="Active_0" class="d_yes" />&nbsp; Yes 
						</div>
						<div class="col-md-2">						 									 
							<input type="radio" name="d" value="0" id="Active_1" class="d_no" />&nbsp; No 
						</div>
					</div>
						
						
						
				
				<div id="declined" class="" style="display:none; padding:10px 2px"> 
				<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
					
					<tr style="height:10px"> <td> </td> <td> </td> </tr>
					
					<tr>

					<tr>

						<td colspan="2">	
						<i class="lead"> Select The Role To Notify When Declined Work Order </i> <br>
						<label for="RoleId" class="fm-label"> <i class="fa fa-male" aria-hidden="true"></i> RoleId Settings </label>
						<select class='sel-opt' name='RoleId' id='RoleId' style="margin:auto 2% auto 0%;width:98%" required>
						<?php					
						   $work = DB::table('workflow')->where('WorkFlowName', '=', 'Declined')->first();	
						   $Role = DB::table('role')->where('RoleId', '=', $work->RoleId)->first();	
						   $Roles = DB::table('role')->get();	
						?>		
						   @if($Role)	
							   <option value="{{$Role->RoleId}}"> {{$Role->RoleName}} </option>
						   @endif						
						   <option value=""> Select Role </option>
						   @if($Roles)
						   @foreach($Roles as $Roles)	
							   <option value="{{$Roles->RoleId}}"> {{$Roles->RoleName}} </option>
						   @endforeach
						   @endif
						</select>
						</td>
						
					</tr>

					<tr style="height:10px"> <td> </td> <td> </td> </tr>

					<tr>
						<td colspan="2">	
							<div class="form-group">
							<label for="RoleId" class="fm-label" style="margin-left:15px"> <i class="fa fa-cogs" aria-hidden="true"></i> Settings Name </label>
								<input type="text" name="WorkFlowName" id="WorkFlowName" style="border:thin #ede solid;	width:94%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 2%; color:#999" value="Declined" />
								<input type="hidden" name="roId" id="roId" style="border:thin #ede solid;	width:97%;	padding:5px 5px;	border-radius:4px;margin:auto 2% auto 3%; color:#999"@if($flow) value="{{$flow->WorkFlowId}}"@endif />
							</div>
						</td>
					</tr>


					<tr style="height:10px"> <td> </td> <td> </td> </tr>
					
					
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
					<tr>
						<td colspan="4" class="pull-left"> 
							<div class="form-group" style="padding:20px 0px;" id="">
								<button type="submit" class="btn btn-primary" id="">Update Workflow</button>
							</div> 

						</td>
					</tr>
					
				</table>
		
				</div>
				
				</div> 
				
				
			</div>
		</Form>
			
	  </div>
	  
  </div>
  </div>
  
  
 <div id="config" class="tab-pane fade in">
  <div class="widget widget-table action-table ">

    <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
			<h3>Email Configuration</h3>
            <form class="form-horizontal" method="post" action="{{ url('/settings/insert_mailConfig') }}">
				<fieldset>
				  
					<div class="form-group col-md-6">
					<label class="label-control">SMTP Port Number</label>
					<input type="text" placeholder="enter the smtp Port Number" name="port"  style="border:thin #ede solid; width:97%;	padding:10px 5px;	border-radius:4px;margin:auto 1% auto 0%; color:#999">
					</div>
					<div class="form-group col-md-6">
					<label class="label-control">SMTP Host </label>
					<input type="text" placeholder="enter the smtp Host" name="host"  style="border:thin #ede solid; width:97%;	padding:10px 5px;	border-radius:4px;margin:auto 1% auto 0%; color:#999">
					</div>
					<div class="form-group col-md-6">
					<label class="label-control">SMTP Email Adress</label>
					<input type="text" placeholder="enter the Email Address" name="username"  style="border:thin #ede solid; width:97%;	padding:10px 5px;	border-radius:4px;margin:auto 1% auto 0%; color:#999">
					</div>
					<div class="form-group col-md-6">
					<label class="label-control">SMTP Email Password</label>
					<input type="password" placeholder="enter Password" name="password"  style="border:thin #ede solid; width:97%;	padding:10px 5px;	border-radius:4px;margin:auto 1% auto 0; color:#999">
					</div>		

				   <div class="form-group">
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-primary">Clear</button>
				  </div>

				</fieldset>

			</form>
			
		</div>
			
  </div>
  </div>
  
  
  <div id="subscription" class="tab-pane fade in">
  <div class="widget widget-table action-table ">

	<div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
        <h3>Send Mail</h3>
        <form class="form-horizontal" method="post" action="{{ url('/settings/insert_sendmail') }}">
            <fieldset>				  
                <div class="form-group">
                <label class="label-control">Recievers Email Address</label>
                <input type="email" placeholder="enter recievers email" name="reciever" class="form-control">
                </div>
                
                <div class="form-group">
                <label class="label-control">Sender Email Adress</label>
                <input type="email" placeholder="enter the Email Address" name="sender" class="form-control">
                </div>
                <div class="form-group">
                <label class="label-control">Message</label>
                <textarea class="form-control" name="message"></textarea>
                </div>		
        
                <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-primary">Clear</button>
                </div>
            </fieldset>
        </Form>			
	</div>
    
  </div>
  </div>
  
  
  <div id="cloud" class="tab-pane fade in">
  <div class="widget widget-table action-table ">
<div>
	<!-- TOTAL DISTANCE -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
		<div class="row" style="padding:8px 2px 2px 2px;">
		
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Total Distance </div>
			
			<div class="col-md-10 box-right">  
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">						 									
						<input type="radio" name="Active" value="1" id="Active_0" class="tdist_yes" />&nbsp; Yes 
					</div>
					<div class="col-md-2">						 									 
						<input type="radio" name="Active" value="0" id="Active_1" class="tdist_no" />&nbsp; No 
					</div>
				</div>
			
			
			
			
			<div id="totdist" class="" style="display:none; padding:10px 2px"> <br> 
				<i class="lead">Import CSV file for vehicle total distance </i>

                <form action="{{ url('/settings/upload_totaldistance') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="upload_file"> Import File :</label>
                        <input type="file" name="upload_file" class="form-control">
                    </div>
                    <input class="btn btn-success" type="submit" value="Upload csv File" name="submit">
                </form>
                
			</div>
			
			</div> 
			
			
		</div>

	  </div>
	  
	  
	<!-- IMEI MAPPING -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
		<div class="row" style="padding:8px 2px 2px 2px;">
		
			<div class="col-md-2" style="text-align:right; padding-top:10px">  IMEI mapping </div>
			
			<div class="col-md-10 box-right">  
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">						 									
						<input type="radio" name="Active" value="1" id="Active_0" class="imei_yes" />&nbsp; Yes 
					</div>
					<div class="col-md-2">						 									 
						<input type="radio" name="Active" value="0" id="Active_1" class="imei_no" />&nbsp; No 
					</div>
				</div>
			
			
			
			
			<div id="mapping" class="" style="display:none; padding:10px 2px"> <br> 
				<i class="lead">Import CSV file for vehicle to IMEI mapping </i>
				
					<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
						<tr>
							<td>
								<div class="group-control"> Import File : 
                                <input type="file" name="sel_imei_map_file" id="sel_imei_map_file" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" value="" Required >
                                </div>
							</td>
							<td>
								<button type="submit" class="btn btn-primary" name="imei_map">Upload CSV File</button>
							</td>
						</tr>
					</table>					
				
			</div>
			
			</div> 
			
			
		</div>
	
	  </div>
	  
	 
	<!-- VEHICLE HISTORY -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 303px">
		<div class="row" style="padding:8px 2px 2px 2px;">
		
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Vehicle History </div>
			
			<div class="col-md-10 box-right">  
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">						 									
						<input type="radio" name="Active" value="1" id="Active_0" class="hist_yes" />&nbsp; Yes 
					</div>
					<div class="col-md-2">						 									 
						<input type="radio" name="Active" value="0" id="Active_1" class="hist_no" />&nbsp; No 
					</div>
				</div>
			
			
			
			
			<div id="history" class="" style="display:none; padding:10px 2px"> <br> 
				<i class="lead">Import CSV file for vehicle history </i>

                <table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
                    <tr>
                        <td>
                            <div class="group-control"> Import File : 
                            <input type="file" name="sel_vec_hist_file" id="sel_vec_hist_file" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" value="" Required >
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary" name="veh_hist">Upload CSV File</button>
                        </td>
                    </tr>
                </table>					
				
			</div>
			
			</div> 
			
			
		</div>
	
	  </div>
	  
		  
	  <!-- ASSET RECORD UPLOAD -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 303px">
		<div class="row" style="padding:8px 2px 2px 2px;">
		
			<div class="col-md-2" style="text-align:right; padding-top:10px">  Asset Record </div>
			
			<div class="col-md-10 box-right">  
				<div class="radio" style="margin:0px 2px">
					<div class="col-md-2">						 									
						<input type="radio" name="Active" value="1" id="Active_0" class="asset_yes" />&nbsp; Yes 
					</div>
					<div class="col-md-2">						 									 
						<input type="radio" name="Active" value="0" id="Active_1" class="asset_no" />&nbsp; No 
					</div>
				</div>
			
			
			
			
			<div id="asset" class="" style="display:none; padding:10px 2px"> <br> 
				<i class="lead">Import CSV file for asset \ vehicle </i>
                
					<table width="100%" border="0" cellspacing="5" cellpadding="10" style="margin:5% 5% 0% 1%">
						<tr>
							<td>
								<div class="group-control"> Import File : 
                                <input type="file" name="asset_file" id="asset_file" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" value="" Required >
                                </div>
							</td>
							<td>
								<button type="submit" class="btn btn-primary" name="asset_btn">Upload CSV File</button>
							</td>
						</tr>
					</table>
			</div>
			
			</div> 
			
			
		</div>
	
	  </div>
	  
	  
  </div>  
  </div>
  </div>


  <div id="automation" class="tab-pane fade in">
  <div class="widget widget-table action-table ">
	
	<div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
	<table>
          <tr>
		  <td>	
			  <label for="MileReminder" class="fm-label"> <i class="fa fa-road" aria-hidden="true"></i>  No. of miles before service mileage to send reminder. (km) </label>
				<input type="text" name="MileReminder" id="MileReminder" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%"  />
		  </td>     
		  
		  
		  
		<td>	<label for="DateReminder" class="fm-label">  <i class="fa fa-calendar" aria-hidden="true"></i> No. of days before service due date to send reminder.(days) </label>
		<input type="text" name="DateReminder" id="DateReminder" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%"  />
			</td>
		  </tr>
	  </table>
    </div>
	
  </div>
  </div>
  
 
 <div id="settings" class="tab-pane fade in">
  <div class="widget widget-table action-table ">

	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
	  
	  </div>
    
  </div>
  </div>
  
  
  <div id="driver" class="tab-pane fade in">
  <div class="widget widget-table action-table ">

	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">
	  
	  </div>
    
  </div>
  </div>
  
  
  
  </div>

</div>
  
</section>


</div>








<script>
	$(document).ready(function()
	{
		$('.test').dataTable();
	});
</script>


<script>	  //AJAX FUNCTION TO UPDATE ASSET

$(document).ready(function()
	{
		$("#notifSetBtn").click(function(ps)
		{
			var r = confirm("Are You Sure You Want To Make Notification Setting ?");
			if (r == true) 
			{
				var InStock = $("#InStock").val();
				var Limited = $("#Limited").val();
				var OutOfStock = $("#OutOfStock").val();
				var CreatedBy = $("#CreatedBy").val();

				// Returns successful data submission message when the entered information is stored in database.
				var assetpro = 'InStock='+ InStock + '&Limited='+ Limited + '&OutOfStock='+ OutOfStock + '&CreatedBy='+ CreatedBy;

				ps.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "",
					data: assetpro,
					cache: false,
					success: function()
					{
						alert('Item Stock Notification Setting Updated !');		

						document.getElementById("InStock").value = '';    
						document.getElementById("Limited").value = '';   
						document.getElementById("OutOfStock").value = '';
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


<!-- SCRIPT TO Display divs for workflow  -->
<script>
	$(document).ready(function()
	{	
	//for status update work order
		$('.check_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#workorder').slideDown('fast');	
			}
		})
		
		$('.check_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#workorder').fadeOut();
			}
		})
		
		//for pending and approved
		
		$('.pa_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#pendapprove').slideDown('fast');	
			}
		})
		
		$('.pa_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#pendapprove').fadeOut();
			}
		})
		
		//for  declined
		
		$('.d_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#declined').slideDown('fast');	
			}
		})
		
		$('.d_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#declined').fadeOut();
			}
		})
	})
</script>

<!-- SCRIPT TO Display divs for csv file uploads  -->
<script>
	$(document).ready(function()
	{	
	//cloud link
		$('.tdist_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#totdist').slideDown('fast');	
			}
		})
		
		$('.tdist_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#totdist').fadeOut();
			}
		})
		
		$('.imei_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#mapping').slideDown('fast');	
			}
		})
		
		$('.imei_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#mapping').fadeOut();
			}
		})
		
		$('.hist_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#history').slideDown('fast');	
			}
		})
		
		$('.hist_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#history').fadeOut();
			}
		})
		
		$('.asset_yes').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#asset').slideDown('fast');	
			}
		})
		
		$('.asset_no').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{
				$('#asset').fadeOut();
			}
		})
		
	})
</script>





@stop