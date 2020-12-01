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



					  


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="fa fa-car"></i>   Corporate Vehicle Assignment  </h1> 
	  <p class="lead"> The corporate vehicle assignment module allows you to assign vehicles to drivers. The table below 
	  shows a list of drivers that are available <br> for the date and time period specified in the search filter below.  </p> 
	    
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
	
	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">
             			 
				
           
             <!-- left content -->
              <div class="col-md-12" style="margin-top:-40px"> <br>
                <div class="well white">				

					<!-- Modal -->						
					<div id="assignModal" class="modal fade" role="dialog" style="height:60%; margin:0.5% 50%">
					  <!-- Modal content-->
						<div class="modal-content">        </div>
					</div>

								
				<?php // $this->Form->create(null, array('controller' => 'Users', 'url' => '/users/searchdriver')); ?>				
				<?php /*$session = $this->request->session();	
                $fr_date = @$_POST['fromdatetime'];
				$session->write('from', $fr_date);	
                $session->write('to',@$_POST['todatetime']); //Write */  ?>

				<form method="get" action="{{route('asset.availvehicles')}}" role="form">
				<?php 
					$fr_date = @$_POST['fromdatetime'];  $to_date = @$_POST['todatetime'];
					session(['fr' => $fr_date]); session()->put('to', $to_date);
				?>
				<div class="row">
					<div class='col-sm-3'>
						<div class="form-group">
						<div class='input-group date'>
                            <input type="hidden" value="<?= date("m/d/Y 00:00"); ?>" id="defaultFrom" />
							<input type='text' class="form-control" id='fromdatetime' name='fromdatetime' placeholder="Available From"  value="<?= date("m/d/Y 00:00"); ?>"  /> 	
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						</div>
					</div>
					
					<div class='col-sm-3'>
						<div class="form-group">
						<div class='input-group date'>
                            <input type="hidden" value="<?= date("m/d/Y 23:59"); ?>" id="defaultTo" />
							<input type='text' class="form-control" id='todatetime' name='todatetime' placeholder="Available To" value="<?= date("m/d/Y 23:59"); ?>" /> 	
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							<button type="submit" class='btn btn-default fa fa-search' id="search_btn" style="margin-top:-5px"  ></button></span>						
						</div>
						</div>
					</div>

				</div>
				
			</Form>
					
					
				
	<!-- UNASSIGNED DRIVERS -->
	<div id="unAssignDrvDiv">

	<table class="table table-full table-full-small drivertab driverDTable" cellspacing="0">
		<thead>
		<tr>
				<th>Vehicle</th>
				<th>Name</th>
				<th>Department</th>									
				<th>Booked From</th>
				<th>Booked To</th>
				<!-- <th>Availability</th> -->
				<th>Free From</th>
				<th>Free To</th>
				<th></th>
		</tr>						
	</thead>
		
		
	<tbody id="tbody">

		<?php		      
		@$start_dt = strtotime($_POST['fromdatetime']);  
		@$end_dt =  strtotime($_POST['todatetime']);  
			$today_from = date("Y-m-d 00:00:00"); $today_to = date("Y-m-d 23:59:00");	
			if($start_dt == "")  { 
				$q_start_dt =  strtotime($today_from);
			}else{
				$q_start_dt =  $start_dt;
			}  
		
			if($end_dt == "") { 
				$q_end_dt =  strtotime($today_to); 
			}else{ 
				$q_end_dt = $end_dt; 
			}

			$st_query = date('Y-m-d H:i:s', $q_start_dt);
			$end_query = date('Y-m-d H:i:s', $q_end_dt);
			
			
			//convrt the date n time
		
				$assets = DB::table('assignasset')
				->where('StartTime', '>=', $today_from)
				->where('EndTime', '<=', $today_to)
				->orderBy('AssetId', 'asc')->get(); 
				?>   

				@if($assets)
				@foreach($assets as $assets)			
					<tr style="color:#E52B50">
							
					<td>  <span style="color:#fff">0</span> 
						<img src="{{URL::asset('assets/img/cross.png')}}" class="img-cent" height="12px" width="12px" style="margin:0px 7px 0px -10px;">
						<?php
							$assetid = $assets->AssetId;
							$asset = DB::table('asset')->where('AssetId', '=', $assetid)->first(); 
						?> 
						@if($asset) {{$asset->LicensePlate}} @endif
					</td>
					<td>
						<img src="{{URL::asset('assets/img/cross.png')}}" class="img-cent" height="12px" width="12px" style="margin-right:7px;">
						<?php
							$uid = $assets->UserId;
							$user = DB::table('users')->where('UserId', '=', $uid)->first();
						?>
						@if($user) {{$user->FirstName.' '.$user->LastName}} @endif
					</td>
					<td>
					<?php
						$did = $assets->DeptId;
						$dept = DB::table('department')->where('DeptId', '=', $did)->first(); 
					?>
					@if($dept) {{$dept->DeptName}} @endif
					</td>
					
					
					<td> @if($assets) {{$assets->StartTime}} @endif  </td>
						
					<td> @if($assets) {{$assets->EndTime}} @endif  </td>
					
					<!-- <td align="left"> <img src="../img/pass.png" class="img-responsive" height="10px" width="12px">  </td>-->	

					<td>  @if($assets) {{$assets->AvailFrom}} @endif    </td>
						
					<td>  @if($assets) {{$assets->AvailTo}}  @endif  </td>
						
				<td>   
				<?php   $uid = $assets->UserId; ?>
				<a class="waves-effect waves-light btn assignBtn btn-warning" onclick="assign(<?= $assets->DeptId.','.$assets->UserId ?>)" data-toggle="modal" title="Assign Driver" data-target="#assignAsset" href="#" style="color:#fff;font-size:10px"> + </a>							
			</td>
			</tr>

			@endforeach
			@endif
				
			<?php    
				$conn = connect();
				$sql1 = "SELECT * from operator WHERE NOT EXISTS (SELECT * FROM assignasset WHERE assignasset.UserId = operator.UserId AND assignasset.StartTime >= '{$st_query}' AND assignasset.EndTime <= '{$end_query}')";
				$result1 = $conn->query($sql1);
				if (@$result1->num_rows > 0)
				{
					while($records = $result1->fetch_assoc())
					{
						
					echo  '<tr> 	<td>'; ?>
					
					<span style="color:#fff">1</span> 											
				<img src="{{URL::asset('assets/img/pass.png')}}" class="img-responsive" height="10px" width="12px" style="margin-top:-25px;">
					
				
				</td>	<td>

					<?php
						$u_id = $records['UserId'];
						$User = DB::table('users')->where('UserId', '=', $u_id)->first();
					?>
					<img src="{{URL::asset('assets/img/pass.png')}}"height="10px" width="12px" style="margin-right:7px;">
					
					@if($User) {{$User->FirstName.' '.$User->LastName}} @endif

				</td>	<td>

					<?php
						$did = $records['DeptId'];
						$department = DB::table('department')->where('DeptId', '=', $did)->first();
					?>
					@if($department) {{$department->DeptName}} @endif
						

					
					<?php 		
						echo'<td> Free </td>';//echo'<td>'.date ("Y-M-d H:i:s",  $q_start_dt).'</td>';
						echo'<td> Free </td>'; //echo'<td>'.date ("Y-M-d H:i:s", $q_end_dt).'</td>';
						
						//echo '<td align="left"> <img src="../img/pass.png" class="img-responsive" height="10px" width="12px">  </td>';

						echo'<td>'.date ("Y-M-d H:i:s",  $q_start_dt).'</td>';   
						echo'<td>' .'2100-01-01 00:00' .'</td>';
				
						echo '<td class="actions">';		$uid = $records['UserId'];
						
					?>
						<a class="waves-effect waves-light btn assignBtn btn-success" onclick="assign(<?= $records['DeptId'].','.$records['UserId'] ?>)"  data-toggle="modal" data-target="#assignAsset" href="#" style="color:#fff;font-size:10px"> + </a>								
				</td>
			</tr>
				<?php 
					//elseif   //2017-03-28 0:00:00  
					}  
				
				}
		
			$conn->close(); ?>
		
		</tbody>
  
        </table>
		
	</div>
	
	
	</div>
	<!-- END OF UNASSIGNED DRIVERS -->
	


	</div>

	
	</div>
  </div>
	</div>
</div>
</section>


</div> 
<?php  //$this->element('assign_driver_modal'); ?> 

<!-- Assign Asset Modal -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/insertasset') }}">	
    <div id="assignAsset" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
    <div class="modal-dialog" style="width:100%;">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 style="color:red;"> <i class="fa fa-car" aria-hidden="true"></i>  Assignment  Range </h4>
        </div>
        <div class="modal-body">
        

        @include('modals.assignasset_modal')


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>
    </Form> 



<?php  $dated = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($end_query)));   ?>






<script>
$(document).ready(function()
	{		
		$("#unAssBtn").click(function()	 {	$('#assignDrvDiv').hide();	 $('#unAssignDrvDiv').show(); 	$('#unAssBtn').hide();	});
	});
</script>

<script>		
	$(document).ready(function()	
		{		
			//$("button").click(function() {  var uid = this.id;  alert(uid);		});	
			
			$("#addSerBtn").click(function(e)
			{
				var AssetId = document.getElementById();
				var MileInterval = $("#MileInterval").val();
				var DateInterval = $("#DateInterval").val();
				var LastMaintMile = $("#LastMaintMile").val();
				var LastMaintDate = $("#LastMaintDate").val();
				var DateReminder = $("#DateReminder").val();
				var MileReminder = $("#MileReminder").val();
				var CurrentMile = $("#CurrentMile").val();
				var CreatedBy = $("#CreatedBy").val();
				var created = '2016';
				var updated_at = '2016';
				// Returns successful data submission message when the entered information is stored in database.
				var smdata = 'AssetId='+ AssetId + '&MileInterval='+ MileInterval + '&DateInterval='+ DateInterval + '&LastMaintMile='+ LastMaintMile + '&LastMaintDate='+ LastMaintDate + '&DateReminder='+ DateReminder + '&MileReminder='+ MileReminder + '&CurrentMile='+ CurrentMile + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at;
				
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
						alert('New Schedule Maintenance Added Successful');			
					}
				});
			
			});
			return false;
		});
	
</script>

<script>
	//$(document).ready(function()	{		$("button").click(function() {    alert(this.id);		});	});
</script>
<!-- DATE TIME PICKERS --> 
<script>	
	$(function () {
        $(function () {
			$('#fromdatetime').datetimepicker();
		});
		
		$(function () {
			$('#todatetime').datetimepicker();
		});
	
	
        $('#todatetime').datetimepicker({
            useCurrent: false //Important!
        });
        $("#fromdatetime").on("dp.change", function (e) {
            $('#todatetime').data("DateTimePicker").minDate(e.date);
        });
        $("#todatetime").on("dp.change", function (e) {
            $('#fromdatetime').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>



<script>

    //loading of the assign modal
    $('#assign').on('show.bs.modal',function(e)
	{
        
      var to = $('#todatetime').val();
	  var from = $('#fromdatetime').val();
      var default_from = $('#defaultFrom').val();
      var default_to = $('#defaultTo').val();
        
         newfrom = convertDateTo24Hour(from);
		 newfrom += ':00';
         $('#StartTime').val(newfrom);
      
		 var avialf = convertDateTo24Hour(to);
         newto = convertDateTo24Hour(to);
		 newto += ':00'
         $('#EndTime').val(newto);
		
		//setting availFrom   2017-04-01 20:00
		var all = avialf.substr(0, 10); 
		

		var se = avialf.substr(14, 15); var sec = parseInt(se);
		if(sec == '59')
		{
			sec = '00'; 					 var av = avialf.substr(11, 12); var min = parseInt(av);		min = min + 1;
		}
		else
		{
			sec = sec + 1;				 	 var av = avialf.substr(11, 12); var min = parseInt(av);
		}

		
		var av_fr = all;
		av_fr += ':';
		av_fr += min;
		av_fr += ':'; 
		av_fr += sec;
		av_fr += ':00';
		$('#AvailFrom').val(av_fr);
		 
         var uid = '<?php echo 1 ?>';
        $.get('/getdrivername?UserId=' + uid, function(data)
        {  //success data
            data = data[0].FirstName; 
            document.getElementById('driversName').innerHTML = data; 
        });

		assign(deptid, userid);
        
    });

    function assign(deptid, userid)
	{  //loading deptId and userId in the modal
        $('#deptid').val(deptid);  
        $('#userid').val(userid);
        $('#StartTime').val('<?php echo $st_query; ?>');  
        $('#EndTime').val('<?php echo $end_query; ?>'); 
        $('#AvailFrom').val('<?php echo $dated; ?>');        
    }
    
	function convertDateTo24Hour(date)  //var av_fr = all;
	{
		var elem = date.split(' ');
		var stSplit = elem[1].split(":");
		var stHour = stSplit[0];
		var stMin = stSplit[1];
		var stAmPm = elem[2];
		var newhr = 0;
		var ampm = '';
		var newtime = '';
		var elem = elem[0];
		var mydate = new Date(elem);

		var dateString = (mydate.getFullYear() + '-'
		+ ('0' + (mydate.getMonth() + 1)).slice(-2)
		+ '-' + ('0' + (mydate.getDate())).slice(-2));
	  
		if (stAmPm == 'PM')
		{ 
			if (stHour != 12)
			{
				stHour = stHour*1+12;
			}      
		}
		else if(stAmPm == 'AM' && stHour == '12')
		{
			stHour = stHour -12;
		}
		else
		{
			stHour = stHour;
		}
		stHour = stHour + 0;
		return dateString+" "+stHour+':'+stMin;
	}
    

    

	//click on search button to check for assigned drivers
	$('#search_btn').on('click',function()
	{
	var to = $('#todatetime').val();
	var from = $('#fromdatetime').val();   
        
		$.ajax(
		{
			url: "",
			type: "POST",
			async: false,
			data:{'fromdatetime':from,'todatetime':to},
			success: function(data)	{		$('#tbody').html(data);     }
		});
		
	});
    
    
</script>			
		
<script>
	$(document).ready(function()
	{
		$('.driverDTable').dataTable();
	});

	function warn() 
	{
		var strconfirm = confirm("Are you sure you want to delete?");
		if (strconfirm == true) 
		{
			return true;
		}
	}
</script>
  
  
  


@stop