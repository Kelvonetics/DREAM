@extends('templates.default')

@section('content')




<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
    <div class="page-header" style="margin-bottom:10px;">
    <h1>      <i class="fa fa-briefcase"></i>     Client Asset Management </h1> 
    <p class="lead"> The client Asset Management module  allows you to efficiently manage your entire client asset lifecycle. <br> With real-time visibility into client asset performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
        
            
        
        </div>
	
	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

    <!-- left content -->
        <div class="col-md-12 col-md-pull-0"> 
        <a onclick="clientAsset()" class="waves-effect waves-light btn btn-primary modalBtn" title='Add New Client Asset' 
		href="{{ route('clientasset.add') }}" style="color:white;font-size:10px"><i class="fa fa-plus"></i> New Vehicle</a>

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

    <table id="example" class="table table-full table-full-small test" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>Plate No</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
				<th>VIN</th>              
				<th> Type</th>
				<th>Client Name</th>		
				<th>Company</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($clientassets)
			@foreach ($clientassets as $clientassets)
            <?php $retired = DB::table('clientassetretiredetail')->where('AssetId', '=', $clientassets->AssetId)->first();  ?>
                    <tr @if($retired) style="color:#FF9966" @endif>	
                <td>{{$clientassets->LicensePlate}}</td>
				<td>
					<?php 
						$mkid = $clientassets->MakeId;
						$assetmake = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();	
					?> @if($assetmake) {{$assetmake->Make}} @endif
				</td>
                <td>
					<?php
						$mdid = $clientassets->ModelId;	
						$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
					?> @if($assetmodel) {{$assetmodel->ModelName}} @endif
				</td>
				<td>{{$clientassets->EqpYear}}</td>
				<td>{{$clientassets->VIN}}</td>
				<td>
					<?php 
						$tid = $clientassets->AssetTypeId;
						$assettype = DB::table('assettype')->where('AssetTypeId', '=', $tid)->first();
					?> @if($assettype) {{$assettype->AssetTypeName}} @endif
				</td>
				
				<td>
					<?php 
						$cnid = $clientassets->ClientId;	
						$Client = DB::table('client')->where('ClientId', '=', $cnid)->first();				
					?> @if($Client) {{$Client->FirstName." ".$Client->LastName}} @endif
				</td>
				<td> {{ $Client->Company }} </td>
				<td align="left" style="color:#fff"><?php $act = $clientassets->Active; if($act == 1) { ?>
				   <?= $act ?><img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px">
						<?php } else { ?>
				   <?= $act ?><img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-15px"> 
					<?php } ?>
				</td>
                <td class="actions">
                    <a href="{{route('clientasset.view', $clientassets->AssetId)}}" class="btn btn-success" style="font-size:11px; color:white">View Profile</a>
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

<script>
	$(document).ready(function()
	{
		$('.test').dataTable();
	});
</script>



@stop