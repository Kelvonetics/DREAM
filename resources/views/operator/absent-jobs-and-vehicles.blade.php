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
</style>


	
<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="fa fa-male"></i>   Operators Jobs And Vehicles </h1> 
      <?php
        $OPS = DB::table('operator')->where('UserId', '=', $id)->first();
        $Leave = DB::table('driverleave')->where('OperatorId', '=', $OPS->OperatorId)->first();	
        $start = $Leave->LeaveStartDate;   $end = $Leave->LeaveEndDate;
 
        $starts = str_replace("/","-", $start);  $ends = str_replace("/","-", $end); 
        $s_y = substr($starts, 6, 9);  $s_md = substr($starts, 0, 5);  $l_start = $s_y.'-'.$s_md;
        $e_y = substr($ends, 6, 9);  $e_md = substr($ends, 0, 5);  $l_end = $e_y.'-'.$e_md;
    ?>
	
      <p class="lead">
      <?= 'Leave From : '. $l_start.' '.'&nbsp&nbsp&nbsp&nbsp '.' Leave To : '. $l_end.' 23:59:59'; ?> 
      </p>  
	</div>
	<div class="">
    

<!-- right content -->
	  <div class="col-md-3 col-md-push-9 left-side" style="margin:0px -20px 0px 10px; background-color:#F9F9F9">
	  <div class="pull-right" style="margin:-25px -20px 0px 0px">
		<ul class="list-unstyled">
		  <li class="dropdown">
			<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
		  </li>
		</ul>
	  </div>
	  
		<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
		<div class="well white white-card"> 				            
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
			<div class="grey-card" style="padding:0px 0px 0px 25px">
			<table class="table" width="105%" cellpadding="0">
				<tr>
					<td style="width:95%"> 
						<h4 class="grey-text m-b-30">   Quick Reports  </h4>
								</td>
					<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
				</tr>
			</table>
			
			</div>
			

			<!-- quick information div  -->
			<div class="grey-card">
			<div style="margin:-10px 15px 0px 10px">
			</div>
			</div>
		
	  </div>



	
	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">  <br> 
		<i class="lead" style="padding:1px"> List Of All Vehicles Assigned To Driver Within The Specified Date Range </i>
		<div class="pad"> 
		
			<table id="example" class="table table-full table-full-small absVehicleDTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th> LicensePlate</th>
						<th> Assigned From </th>
						<th> Assigned To </th>
						<th> Department </th>
					</tr>
				</thead>
				<tbody>
					<?php $conn = connect();
					 $sql ="select * FROM assignasset WHERE EXISTS(SELECT * FROM asset WHERE asset.AssetId = assignasset.AssetId AND '{$l_start}' >= assignasset.StartTime AND assignasset.UserId = '{$id}')";
						$result = $conn->query($sql);                    
						if ($result->num_rows > 0)
						{
							while($record = $result->fetch_array())
							 {
								?>
								<tr>
									<td> 
										<?php	
                                            $asid = $record['AssetId'];
                                            $plateNO = DB::table('asset')->where('AssetId', '=', $asid)->first();
										?> @if($plateNO) {{$plateNO->LicensePlate}} @endif
									</td>
									<td> <?= $record['StartTime']; ?>  </td>
									<td> <?= $record['EndTime']; ?>  </td>
									<td>
										<?php	
                                            $did = $record['DeptId'];
                                            $dept = DB::table('department')->where('DeptId', '=', $did)->first();
										?> @if($dept) {{$dept->DeptName}} @endif
									</td>
								</tr>
							 <?php    
							 }  						
						} 
						
					$conn->close();  ?>
				</tbody>
			</table>
		
		</div>

		<br>
		<i class="lead" style="margin:20px 1px 2px 1px"> List Of All Jobs Assigned To Driver Within The Specified Date Range </i>
		<div class="pad"> 

			<table id="example" class="table table-full table-full-small absJobDTable" cellspacing="0" width="100%">
				<thead>
					<tr style="background-color:#f9f9f9;">
						<th> Client</th>
						<th> Type </th>
						<th> Status </th>
						<th> Description </th>
						<th> Assigned From </th>
						<th> Assigned To </th>
					</tr>
				</thead>
				<tbody>
					<?php $conn = connect();
					 $sql ="select * FROM job WHERE EXISTS(SELECT * FROM assignjob WHERE assignjob.JobId = job.JobId AND job.ScheduleStartDate >= '{$start}' AND assignjob.UserId = '{$id}')";
						$results = $conn->query($sql);                    
						if ($results->num_rows > 0)
						{
                        while($records = $results->fetch_array())
                            {
					?>
                            <tr>
                                <td> 
                                    <?php	
                                        $clid = $records['ClientId'];
                                        $client = DB::table('client')->where('ClientId', '=', $clid)->first();
                                    ?> @if($client) {{$client->FirstName.' '.$client->LastName}} @endif
                                </td>
                                <td> <?= $records['Type']; ?>  </td>
                                <td> <?= $records['Status']; ?>  </td>
                                <td> <?= $records['Description']; ?>  </td>
                                <td> <?= $records['ScheduleStartDate']; ?>  </td>
                                <td> <?= $records['ScheduleEndDate']; ?>  </td>
                            </tr>
							 <?php    
							 }  
						
						} 
						
					$conn->close();  ?>
				</tbody>
			</table>
		
		</div>
		
		</div>

		

</div>



</section>
</div>

	
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
				var update_at = '2016';
				// Returns successful data submission message when the entered information is stored in database.
				var data = 'FirstName='+ FirstName + '&LastName='+ LastName + '&Company='+ Company + '&Email='+ Email + '&Phone='+ Phone + '&Address='+ Address + '&Country='+ Country + '&State='+ State + '&City='+ City + '&CreatedBy='+ CreatedBy + '&created='+ created + '&update_at='+ update_at;
				
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
	$('.absVehicleDTable').dataTable();
	$('.absJobDTable').dataTable();
});
</script>




@stop