@extends('templates.default')

@section('content')






<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
    <div class="page-header" style="margin-bottom:10px;">
		<h1>      <i class="md md-sort"></i>     Asset Report Management </h1> 
		<p class="lead"> The Asset Management module  allows you to efficiently manage your entire asset lifecycle. <br> With real-time visibility into asset performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
	</div>



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
									@foreach ($asset as $asset)
									<tr>                      	
										<td> {{ $asset->AssetId }} </td>
										<td>{{ $asset->LicensePlate }}</td>
										<td>
												<?php   $mkid = $asset->MakeId;
												$assetmake = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();
												echo $assetmake->Make;
												?>
										</td>
										<td>
												<?php   $mdid = $asset->ModelId;
														$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
														echo $assetmodel->ModelName;
												?>
										</td>
											<td>{{ $asset->EqpYear }}</td>
											<td>{{ $asset->VIN }}</td>
											<td>
											<?php 
												$did = $asset->DeptId;
												$department = DB::table('department')->where('DeptId', '=', $did)->first();
												echo $department->DeptName;
											?>
										</td>
											<td>
											<?php 
												$lid = $asset->LocationId;
												$companylocation = DB::table('companylocation')->where('LocationId', '=', $lid)->first();
												echo $companylocation->LocationName;
											?>
										</td>
										<td>
										<?php $asid = $asset->AssetId; 
											$assetavailability = DB::table('assetavailability')->where('AssetId', '=', $asid)->first();
											if($assetavailability) {$act = $assetavailability->Status;}   
											
											if ($act == 0) { ?> <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px"> 
										<?php } else if ($act == 1) { ?>   <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px">
										<?php } ?>
									
								</td>  
		                        <td style="overflow:visible">
									<div class="dropdown" style="">
                     <a href="{{route('report.vehicle-report', $asset->AssetId)}}" class="btn btn-success" style="font-size:10px; color:#fff">View Report</a>
									 </div> 
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









@stop








