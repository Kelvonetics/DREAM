@include('templates.config')
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


.input
{
	border:thin #ede solid;
	width:5%;
	padding:10px 5px;
	border:none;
	margin:auto 5px;
}
.img-cent
{
     margin: 0 auto;
}
 
</style>


<?php 
	@$q_dateFrm = $_POST['dateFrom'];	@$q_dateTo = $_POST['dateTo'];  
	$todayFrm = date('m/d/Y 00:00:00'); $todayTo = date('m/d/Y').' 23:59:59';	
	if($q_dateFrm == "") { $q_dateFrm = $todayFrm;  }   //else { $q_dateFrm = $dateFrm; }
	if($q_dateTo == "") { $q_dateTo = $todayTo;  }   //else {  $q_dateTo = $dateTo; }
	//$q_dateFrm = substr($dateFrm,0, 16);  $q_dateTo = substr($dateTo,0, 16);04/03/2017 11:00:00
?>
					  


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
    <h1>      <i class="fa fa-car"></i> Corporate Job Assignment   </h1>
    <p class="lead"> The user administration module allows you to create a new user, view a list of users you previously created and modify an existing user's details. </p> 
	    
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
	</div>



    <div class="row" style="border:thin dotted #f9f9f9">
	  <!-- left content -->
	  <div class="col-md-12" style="margin-top:0px">
	  <form method="get" action="{{route('job.availjobs')}}" role="form">
	  <table id="" class="table table-full table-full-small" cellspacing="0" width="60%" border="0">
		<tr>
		<td>
		<div class='input-group date'>
			<input type="hidden" value="" id="defaultFrom" />
			<input type='text' class="form-control" id='dateFrom' name='dateFrom' placeholder="Available From"  value="<?= $_GET['dateFrom']; ?>"  /> 	
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>

		</td>
		<td>
		<div class='input-group date'>
			<input type="hidden" value="" id="defaultTo" />
			<input type='text' class="form-control" id='dateTo' name='dateTo' placeholder="Available To"  value="<?= $_GET['dateTo']; ?>"  /> 	
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>

		</td>
		<td>
			 <button type="submit" class='btn btn-default fa fa-search pull-left' style="margin-left:-5px"></button>
		</td>
		</tr>
	  </table>
	  </Form>
	  <div class="well white">

		<!-- LIST OF UNASSIGNED DRIVERS -->
		
		<div>
		  <table id="example" class="table table-full table-full-small assjobsDTable" cellspacing="0" width="100%">
			<thead>
			   <tr>							
					<th>Job</th>
					<th>Operator</th>
					<th>Department</th>
					<th>Booked From</th>
					<th>Booked To</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php						
					$fr = $_GET['dateFrom'];		$to = $_GET['dateTo']; 
					$today_from = date("m/d/Y 00:00:00"); 		$today_to = date("m/d/Y 23:59:59");	
					if($fr == "")  
					{ 
						$q_start_dt =  strtotime($today_from);
					}else
					{
						$q_start_dt =  $fr;
					}  
				
					if($to == "") 
					{ 
						$q_end_dt = strtotime($today_to); 
					}else
					{ 
						$q_end_dt = $to; 
					}

					//$st_query = date('m/d/Y H:i:s', $q_start_dt);
					//$end_query = date('m/d/Y H:i:s', $q_end_dt);
					$conn = connect();

					$A = '10/26/2017 00:00:00';
					$B = '10/26/2017 23:59:59';
					$conn = connect();
					//$sql2 ="SELECT * FROM operator JOIN assignjob ON operator.UserId = assignjob.UserId WHERE(assignjob.JobStartDateTime //BETWEEN '{$q_dateFrm}' AND '{$q_dateTo}') OR (assignjob.JobEndDateTime BETWEEN '{$q_dateFrm}' AND '{$q_dateTo}')";
					

					$jobs = DB::table('assignjob')
					->where('JobStartDateTime', '>=', $q_start_dt)
					->where('JobEndDateTime', '<=', $q_end_dt)->get(); 
					?>
					@if($jobs)
					@foreach($jobs as $jobs)
						
						<tr style="color:#E52B50">
							<td>
							<img src="{{URL::asset('assets/img/cross.png')}}" class="img-cent" height="12px" width="12px" style="margin-right:4px;">
								<?php $gotJob = ' Has A Job '; echo $gotJob. '&nbsp;&nbsp;'; ?>			
							</td>
							<td>
								<?php
									$uid = $jobs->UserId;
									$user = DB::table('users')->where('UserId', '=', $uid)->first(); 
								?> @if($user) {{$user->FirstName.' '.$user->LastName}} @endif
							</td>
							<td>
								<?php
									$did = $jobs->DeptId;
									$dept = DB::table('department')->where('DeptId', '=', $did)->first(); 
								?> @if($dept) {{$dept->DeptName}} @endif
							</td>
							<td>
								{{$jobs->JobStartDateTime}}
							</td>
							<td>
								{{$jobs->JobEndDateTime}}
							</td>
							<td>
							<a class="waves-effect waves-light btn assignBtn btn-warning"  onclick="assign(<?= $jobs->DeptId.','.$jobs->UserId ?>)" data-toggle="modal" title="Job Already Assigned To Operator" data-target="#assignJob" href="#" style="color:#fff;font-size:10px"> + </a>
							</td>
						</tr>
						
						
					@endforeach
					@endif
					<?php
						$alljobs = DB::table('operator')
						->where('UserId', '!=', $jobs->UserId)->distinct()->get(); 
					?>

					@if($alljobs)
					@foreach($alljobs as $alljobs)
					<tr style="color:">
							<td>
							<img src="{{URL::asset('assets/img/pass.png')}}" class="img-cent" height="12px" width="12px" style="margin-right:4px;">
								<?php $gotJob = ' No Job '; echo $gotJob. '&nbsp;&nbsp;'; ?>			
							</td>
							<td>
								<?php
									$uid = $alljobs->UserId;
									$user = DB::table('users')->where('UserId', '=', $uid)->first(); 
								?> @if($user) {{$user->FirstName.' '.$user->LastName}} @endif
							</td>
							<td>
								<?php
									$did = $alljobs->DeptId;
									$dept = DB::table('department')->where('DeptId', '=', $did)->first();
								?> @if($dept) {{$dept->DeptName}} @endif
							</td>
							<td>
								{{ 'Available' }}
							</td>
							<td>
								{{ 'Available' }}
							</td>
							<td>
							<a class="waves-effect waves-light btn assignBtn btn-success"  onclick="assign(<?= $alljobs->DeptId.','.$alljobs->UserId ?>)" data-toggle="modal" title="Assign Job To Operator" data-target="#assignJob" href="#" style="color:#fff;font-size:10px"> + </a>
							</td>
						</tr>
					@endforeach

					
			</tbody>
		  </table>
		</div>
				
	

	
	</div>
  </div>

</section>


</div>




<!-- Assign Job Modal -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/job/insertjob') }}">	
    <div id="assignJob" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
    <div class="modal-dialog" style="width:100%;">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 style="color:red;"> <i class="fa fa-car" aria-hidden="true"></i>  Job Assignment  Range </h4>
        </div>
        <div class="modal-body">
        

        @include('modals.assignjob_modal')


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
		$("#unAssBtn").click(function()	 {	$('#assignJobDiv').hide();	 $('#unAssignJobDiv').show(); 	$('#unAssBtn').hide();	});
	});

    //setting USERID DEPTID JOBSTARTDATETIME JOBENDDATETIME 
    function assign(deptid, userid)
        {  //loading deptId and userId in the modal
            $('#deptid').val(deptid);  
            $('#userid').val(userid);
            $('#JobStartDateTime').val('<?= $_GET['dateFrom']; ?>');  
            $('#JobEndDateTime').val('<?= $_GET['dateTo']; ?>');         
        }

</script>


<script>
	$(document).ready(function()
	{
		$('.assjobsDTable').dataTable();
		
		$('.assjobsDTable').dataTable().Sort = "UserId asc";
		var sortedCol = $('.assjobsDTable').dataTable().fnSettings().aaSorting[0][0];
			//alert(sortedCol+' ');
	});
</script>


<script>  //DATE PICKER SCRIPT
    $(function () 
	{    
        $('#dateTo').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#dateFrom").on("dp.change", function (e) {
            $('#dateTo').data("DateTimePicker").minDate(e.date);
        });
        $("#dateTo").on("dp.change", function (e) {
            $('#dateFrom').data("DateTimePicker").maxDate(e.date);
        });
      
    });
	
	

	$(function () 
	{
		$('#dateFrom').datetimepicker().format('DD/MM/YYYY HH:mm:ss');
	});
	
	$(function () 
	{
		$('#dateTo').datetimepicker();
	});

</script>









@stop