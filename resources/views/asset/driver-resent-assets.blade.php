@extends('templates.default')

@section('content')






<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
    <div class="page-header" style="margin-bottom:10px;">
		<h1>      <i class="fa fa-car"></i> Drivers Resent Ten (10) Assets </h1> 
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
                <th>Plate No</th>
                <th>Make</th>
                <th>Model</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Department</th>
                <th>Location</th>
                <th>Status</th>
                <th style="width:60px"> </th>
            </tr>
            </thead>

                <tbody>
                @if($resent_assets )
                    @foreach ($resent_assets as $resent_assets)
                    <?php 
                        $retired = DB::table('assetretiredetail')->where('AssetId', '=', $resent_assets->AssetId)->first();
                        $Asset = DB::table('asset')->where('AssetId', '=', $resent_assets->AssetId)->first();	
                    ?>
                    <tr @if($retired) style="color:#FF9966" @endif>
                        <td>
                            <?php   
                                $plate = DB::table('asset')->where('AssetId', '=', $resent_assets->AssetId)->first();
                            ?>
                            @if($plate) {{$plate->LicensePlate}} @endif
                        </td>
                        <td>
                            <?php   
                                $assetmake = DB::table('assetmake')->where('MakeId', '=', $Asset->MakeId)->first();
                            ?>
                            @if($assetmake) {{$assetmake->Make}} @endif
                        </td>
                        <td>
                            <?php
                                $assetmodel = DB::table('assetmodel')->where('ModelId', '=', $Asset->ModelId)->first();
                            ?>
                            @if($assetmodel) {{$assetmodel->ModelName}} @endif
                        </td>
                            <td> @if($resent_assets) {{ $resent_assets->StartTime }} @endif</td>
                            <td> @if($resent_assets) {{ $resent_assets->EndTime }} @endif</td>
                            <td>
                            <?php 
                                $department = DB::table('department')
                                ->where('DeptId', '=', $Asset->DeptId)->first();
                            ?>
                            @if($department) {{ $department->DeptName }} @endif
                        </td>
                            <td>
                            <?php 
                                $companylocation = DB::table('companylocation')->where('LocationId', '=', $Asset->LocationId)->first();
                            ?>
                            @if($companylocation) {{ $companylocation->LocationName }} @endif
                        </td>
                        <td>
                        <?php
                            $assetavailability = DB::table('assetavailability')->where('AssetId', '=', $Asset->AssetId)->first();
                            if($assetavailability) {$act = $assetavailability->Status;} 
                        ?>  
                        @if($assetavailability) 
                            <?php    if ($act == 0) { ?> <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px"> 
                            <?php } else if ($act == 1) { ?>   <i style="color:#fff;"><?= $act ?> </i> <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-10px">
                            <?php } ?>
                        @endif
                    
                </td>  
                <td style="overflow:visible">
                    <a href="#" class="btn btn-primary fa fa-edit" style="font-size:9px; color:#fff"> </a>
                </td>                       
            </tr>
        @endforeach
        @enfif
    </tbody>
    </table>



        </div>
        </div>
    </div>
    </section>
    </div>















@stop








