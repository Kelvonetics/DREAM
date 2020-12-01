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
		color:#666; margin:auto 2% auto 3%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 0%;
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
.notif
	{
		background-color:red;     <!-- #E52B50 -->
		color:white;
	}
.modal 
	{
		max-width:900px;
	}
	
</style>





<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
	<section class="forms-basic">
	<div class="page-header">    <?php $date = date("m/d/Y") ?>
		<h1>      <i class="fa fa-user-plus"></i>    Driver Administration   </h1>  <p class="lead">  
		The driver administration module allows you to convert system users to 'drivers' for proper documentation and administration, <br> view a list of drivers and modify existing driver details.			  </p>
	</div>
           
             
              
			  
			  
	<div class="row  m-b-40">

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
		
               <center> <img src="{{URL::asset('assets/img/user3.png')}}" class="img-responsive" height="150" width="150"> </center>
			
			<center> <i class="grey-text m-b-30" >   <?=  $user['FirstName']. '  &nbsp; '.$user['LastName']   ?> </i>  </center>	
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
				
				
				
			  </div>
			</div>
			

			<!-- quick information div  -->
			<div class="grey-card">
			<div style="margin:-10px 15px 0px 10px">
				<?php  //$this->element('insight');?> 
			</div>
			</div>
		
	  </div>



     <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  
		<div>
        <form method="post" action="{{route('operator.insert')}}" role="form">
			<fieldset>
			  <legend>Assign Driver Priviledges </legend> <span class="help-block"></span>
			  
				  
				<div class="form-group">	  
					  <div class="controls">
					  <label for="UserId" class="control-label" required style="font-size:18px">
                            Assign driver priviledges to : @if($user) {{$user->FirstName.' '.$user->LastName}} @endif 
					  </label>  <button type="submit" class="btn btn-primary pull-right">Assign</button>
						<input type="hidden" name="UserId" id="UserId" class="form-control" @if($user)  value="{{$user->UserId}}"@endif readonly >
					  </div>							
				</div>  

					
				<div class="form-group">
					<input type="hidden" name="DeptId" id="DeptId" class="form-control"@if($user)  value="{{$user->DeptId}}"@endif readonly >
				</div>
				
				<div class="form-group">
					<input type="hidden" name="Status" id="Status" class="form-control" value="Assigned" readonly > 
				</div>
				
					
				<div class="form-group">
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
				</div>

				
			  <div class="form-group">
				
			  </div>
			</fieldset>
		  </form>
		</div>
             
      </div>     

    </div>        
           
             
           

          </section>
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
<script>
	$(document).ready(function()
	{
		$('#UserId').change(function(e)
		{
			console.log(e);
			var userid = e.target.value;
			$.get('{{url('user-department')}}?UserId=' + userid, function(data)
			{  //success data
				data = data[0].DeptId; 
                
                var deptid = parseInt(data);  
                document.getElementById('DeptId').value = deptid;
			});				
		});
	});
</script> 





@stop