@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>


<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	
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
		margin:auto 2%;
	}


label 
	{
		color:#666;
		margin:auto 2%;
	}
.tab-top-bottom
	{
		height:15px;
	}

.part-div
	{
		margin:15px 0px;
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
	  <h1>      <i class="fa fa-users"></i>   Driver Administration  </h1>
	  <p class="lead"> The driver administration module allows you to convert system users to 'drivers' for proper documentation and administration, 
		  <br> view a list of drivers and modify existing driver details. </p>
	</div>
	
	
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
				  <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn" title='Add New Client Job'>+</a></div>
				  <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Jobs </a></div>
				</div>
				
				<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
				  <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Add New Client Job'>+</a></div>
				  <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#"> Last 10 Vehicle Assignments  </a></div>
				</div>
				
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
                
        @if(session('info'))
            <div class="alert" style="background-color:#ACE1AF">
                {{session('info')}}
            </div>
        @endif		
				<!-- UNASSIGNED OPERATORS -->
			<div id="unAssignOpsDiv"> 

			  <table id="example" class="table table-full table-full-small opsDTable" cellspacing="0" width="100%">
				 <thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Department</th>
						<th scope="col">Position</th>
						<th scope="col" class="actions pull-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php				
						$records = DB::table('operator')
						->rightJoin('users', 'operator.UserId', '=', 'users.UserId')
						->where('operator.UserId', '=', NULL)->get();
					 ?>
						@if($records)
						@foreach($records as $records)
						<tr>	
							<td>
								<?php
									$uid = $records->UserId;
									$users = DB::table('users')->where('UserId', '=', $uid)->first(); 
								?>
								@if($users) {{$users->FirstName.' '.$users->LastName}} @endif
							</td>	
							<td>
								<?php
									$did = $records->DeptId;
									$department = DB::table('department')->where('DeptId', '=', $did)->first();
								?>
								@if($department) {{$department->DeptName}} @endif									
							</td>	
							<td>
								<?php
									$pid = $records->PositionId;
									$position = DB::table('userposition')->where('PositionId', '=', $pid)->first();
								?>	
								@if($position) {{$position->PositionName}} @endif	
							</td>
							<td class="actions pull-right">
								<a href="{{route('operator.addOperator', "$uid")}}" class="btn btn-primary" id="" style="color:white; font-size:10px;">Set Privilege</a>			
							</td>
						</tr>
					@endforeach	
					@endif	
				</tbody>
			</table>
	
  
		</div>
         
	
	</div>
  </div>

</section>


</div>

 
 
 <script>
$(document).ready(function()
	{
		$('#allOpsJob').click(function()	
		{		
			$('#unAssignOpsDiv').hide();			$('#assignOpsDiv').show();  		$('#allOpsJob').hide();
		});
		
		$('#closeBtn').click(function()	
		{		
			$('#unAssignOpsDiv').show();			$('#assignOpsDiv').hide();  		$('#allOpsJob').show();
		});
	});
</script>


<script>
$(document).ready(function()
{
	$('.opsDTable').dataTable();
});
</script








@stop