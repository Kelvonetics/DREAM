@extends('templates.default')

@section('content')






<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
    <div class="page-header" style="margin-bottom:10px;">
		<h1>      <i class="fa fa-car"></i>     Asset Management </h1> 
		<p class="lead"> The Asset Management module  allows you to efficiently manage your entire asset lifecycle. <br> With real-time visibility into asset performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
	</div>

		<a href="{{ route('asset.add') }}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63; font-size:11px"> <i class="fa fa-plus"></i>  New Vehicle</a>


            <div class="card">
              <div>
                <div class="datatables">
				
				
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
				
				<table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>Id</th>
						<th>Plate No</th>
						<th>Make</th>
						<th>Model</th>
						<th>Year</th>
						<th>VIN</th>
						<th>Department</th>
						<th>Location</th>
		                <th>Status</th>
						<th style="width:60px"> </th>
		            </tr>
								</thead>

								<tbody>
								@if($asset)
									@foreach ($asset as $asset)
									<?php $retired = DB::table('assetretiredetail')->where('AssetId', '=', $asset->AssetId)->first();  ?>
                    <tr @if($retired) style="color:#FF9966" @endif>	                      	
										<td> {{ $asset->AssetId }} </td>
										<td> {{ $asset->LicensePlate }}  </td>
										<td>
												<?php   $mkid = $asset->MakeId;
												$assetmake = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();
												?>
												@if($assetmake){{ $assetmake->Make }} @endif 
										</td>
										<td>
												<?php   $mdid = $asset->ModelId;
														$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
												?>@if($assetmodel){{ $assetmodel->ModelName }} @endif 
										</td>
											<td>{{ $asset->EqpYear }} </td>
											<td>{{ $asset->VIN }}  </td>
											<td>
											<?php 
												$did = $asset->DeptId;
												$department = DB::table('department')->where('DeptId', '=', $did)->first();
											?>@if($department){{ $department->DeptName }} @endif 
										</td>
											<td>
											<?php 
												$lid = $asset->LocationId;
												$companylocation = DB::table('companylocation')->where('LocationId', '=', $lid)->first();
											?>@if($companylocation){{ $companylocation->LocationName }} @endif 
										</td>
										<td>
										<?php $asid = $asset->AssetId; 
											$assetavailability = DB::table('assetavailability')->where('AssetId', '=', $asid)->first();
											if($assetavailability) 
											{
												$act = $assetavailability->Status; 
											
											if ($act == 0) { ?> <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px"> 
										<?php } else if ($act == 1) { ?>   <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px">
										
										<?php }  
										
											else { ?>   <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px">
										<?php } } ?>

									
								</td>  
		            <td style="overflow:visible">
									<div class="dropdown" style="">
										<button class="btn btn-primary dropdown-toggle"  type="button" id="{{{ $asset->AssetId }}}" data-toggle="dropdown" style="font-size:9px">actions
										<span class="caret"></span>
										</button>
										 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
										  <li><a href="{{route('asset.view', $asset->AssetId)}}" role="" style="font-size:11px">View Profile</a></li>
										  <li><a onclick="workOrder({{ $asset->AssetId }})"  role="menuitem" id="" data-toggle="modal" data-target="#workModal" style="font-size:11px">Create Work Order</a></li>
										  <li><a onclick="pullId({{ $asset->AssetId }})" role="menuitem" data-toggle="modal" data-target="#fuelModal" style="font-size:11px" name="ix">Log Fuel Purchase</a></li>
										  <li><a onclick="Expense({{ $asset->AssetId }})" role="menuitem" id="" data-toggle="modal" data-target="#expenseModal" style="font-size:11px">Create New Expense</a></li>
										  <li><a onclick="FileUpload({{ $asset->AssetId }})" role="menuitem" id="" data-toggle="modal" data-target="#fileModal" style="font-size:11px">Upload File</a></li>
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
          </section>
        </div>















<!-- work order Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/addAssignVehicle') }}">	
<div id="workModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-layer" aria-hidden="true"></i> Work Order </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.workorder-modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 





<!-- log fuel Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/addFuel') }}">	
<div id="fuelModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-tint" aria-hidden="true"></i> Log Fuel </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.fuel-modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form> 





<!-- Asset Expense Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/addAssetExpenseFromIndex') }}">	
<div id="expenseModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-briefcase" aria-hidden="true"></i> Asset Expense </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.expense-modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>

<!-- File Upload Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/asset/uploadAssetFileFromIndex') }}">	
<div id="fileModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-upload" aria-hidden="true"></i> Upload File </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.fileupload_modal')


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
		$('.test').dataTable();
	});
    
    function pullId(id){
   	$('#Asset_id').val(id);   
    }
    
    function workOrder(id){
   	$('#Assetid').val(id);   
    }
    
    function Expense(id){
   	$('#AssetIds').val(id);   
    }
    
    function FileUpload(id){
   	$('#Asset_Id').val(id);   
    }
</script>





<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
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
.sel-opt-full
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 1.5%;
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
		color:#666; margin:auto 4% auto 2%;
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
	.modal 
	{
		max-width:900px;
	}

	*
    {
        font-size: 13px;
    }
</style>






		
<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_comm() 
	{
		var str = document.getElementById('Comment').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Comment').value = cap;
	}
</script>



<!-- DATE TIME PICKERS --> 
<script type="text/javascript">
	$(function () {
		$('#ServiceDate').datetimepicker();
	});
	
	$(function () {
		$('#ServiceCompletionDate').datetimepicker();
	});

    $(function () {
      
        $('#ServiceCompletionDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ServiceDate").on("dp.change", function (e) {
            $('#ServiceCompletionDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ServiceCompletionDate").on("dp.change", function (e) {
            $('#ServiceDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>


<script> // retrieving the Schedule Maintenance Id And work shop email
	$(document).ready(function()
	{
		//retrieving the email address of workshop
		$('#WorkShopId').change(function()
		{
			var WorkShopId = $(this).val(); 	document.getElementById('shopemail').value = WorkShopId; //alert(WorkShopId);		
			$.ajax({"fetchshopemail",
				method:"POST",
				data:{shopId:WorkShopId},
				dataType:"text",
				success:function(data)
				{ 
					document.getElementById('shopemail').value = data.trim();					
				}
				
			});	
		});
		
		//retrieving the email address of workshop
		
	});
</script>





@stop








