@extends('templates.default')

@section('content')

<?php  $auth_user = Auth::user(); ?>

<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-briefcase"></i>    Work Order Management </h1> 
	<p class="lead"> DREAM's work order management module gives you the flexibility you need to effectively manage any type of vehicle asset related
	 repair, or work activity. <br> This module offers a single familiar tool for scheduling, managing and collecting data for all work activities. </p>
	 </div>
	
	
	<div class="">
              
			  
	<?php     // $session = $this->request->session(); 
	//$roled = $this->request->Session()->read('Auth.User.RoleId');  $role_name = $session->read('role_name');  ?>  
	<div class="row  m-b-40">

	<!-- left content -->
	  <div class="col-md-12 col-md-pull-0"> 

	  <!-- HIDE ADD BUTTON IF USER IS NOT FLEET MANAGER -->
		<?php
			$rol = $auth_user->RoleId;  $RFM = DB::table('role')->where('RoleId', '=', $rol)->first();  
			if($RFM->RoleName == "Fleet Manager")
			{
		?>
        <a href="{{ route('workorder.add') }}" class="btn" style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;"> <i class="fa fa-plus"></i> New WorkOrder</a>

			<?php } ?>
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

    <table id="example" class="table table-full table-full-small order" cellspacing="0" width="100%">					
		<thead>
			<tr style="background-color:#f9f9f9;">
                <th> WO No </th>
				<th> Plate </th>
				<th> Make </th>
				<th> Model </th>
				<th> Start </th>
				<th> End </th>
				<th> Status </th>
				<th> State </th>
				<th> Workshop </th>
				<th scope="col" class="actions"></th>
			</tr>
		</thead>	
		<tbody>


		<!-- DISPLAY ORDER FOR FLEET MANAGERS -->
		<?php
			$roled = $auth_user->RoleId;  $RF = DB::table('role')->where('RoleId', '=', $roled)->first();  
			if($RF->RoleName == "Fleet Manager")
			{
		?>
					
		<?php  
			$email = $auth_user->email;   $shop = $auth_user->WorkShopId;   $roled = $auth_user->RoleId;
			$Role = DB::table('role')->where('RoleId', '=', $roled)->first();
			$shopEmail = DB::table('workshopemail')
			->where('Status', '=', 'Pending Approval')
			->orWhere('Status', '=', 'Approved')
			->orWhere('Status', '=', 'Declined')
			->where('State', '=', '2')
			->orWhere('State', '=', '3')
			->orderBy('WorkOrderNumber', 'desc')->get();    
		?>

		@if($shopEmail)
        @foreach ($shopEmail as $shopEmail)

        <?php
          $workorders = DB::table('workorder')->where('WorkShopId', '=', $shopEmail->WorkShopId)->orderBy('WorkOrderNumber', 'desc')->get(); 
        ?>
		@if($workorders)
        @foreach ($workorders as $workorders)
            <tr>
                <td>{{$workorders->WorkOrderNumber}}</td>
				<td>    <?php $as_id = $workorders->AssetId; ?>
					<?php 
						$asset = DB::table('asset')->where('AssetId', '=', $as_id)->first();      	
					?> @if($asset) {{$asset->LicensePlate}} @endif
				</td>
				<td>
					<?php 
						$mk_id = $asset->MakeId;
						$assetmake = DB::table('assetmake')->where('MakeId', '=', $mk_id)->first();     
					?> @if($assetmake) {{$assetmake->Make}} @endif
				</td>
                <td>
					<?php
						$md_id = $asset->ModelId;
						$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $md_id)->first(); 
					?> @if($assetmodel) {{$assetmodel->ModelName}} @endif
				</td>
                <td>{{$workorders->ServiceDate}}</td>
				<td>{{$workorders->ServiceCompletionDate}}</td>
				<td>
					<?php 						
						$stid = $workorders->WorkOrderStatusId;
                   if($stid == 1){					
					?>
					 <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
                    
                    <?php  }elseif($stid==2){ ?>
                    
					<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                    
                   <?php  }elseif($stid==3){ ?>
                    
                      <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">
                    
                   <?php } ?>
				</td>
				
				<td>
					<?php 
						$wrk_no = $workorders->WorkOrderNumber;
						
						$total_pd = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '2')->where('Status', '=', 'Pending Approval ')->where('RoleId', '<>', $roled)->count(); 
						if($total_pd == '1'){ echo '<span style="color:#FFBF00;"> Pending Approval </span>'; }
						
						$total_ap = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Approved')->where('RoleId', '=', $roled)->count(); 
						if($total_ap == '1'){ echo '<span style="color:#339966;"> Approved </span>'; }
						
						$total_dc = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Declined')->where('RoleId', '=', $roled)->count();
						if($total_dc == '1'){ echo '<span style="color:red"> Declined </span>'; }			
					?>
				</td>
				
				<td>
					<?php 
						$wsid = $workorders->WorkShopId;
						$workshop = DB::table('workshop')->where('WorkShopId', '=', $wsid)->first(); 
					?> @if($workshop) {{$workshop->WorkShopName}} @endif
				</td>
                <td class="actions"> 
				<!-- if approved display a different button -->
				<?php
				if($total_ap == '1')
				{ ?>
					<a href="#" class="btn fa fa-edit" id="" style="color:white; font-size:9px;background-color:#396" Disabled></a>
				<?php  
				}
				else if($total_dc == '1')
				{ ?>
					<a href="#" class="btn btn-primary fa fa-edit" id="" style="color:white; font-size:9px;" Disabled></a>
				<?php  
				}
				//FOR PENDING FLEET MANAGER REVIEW
				else if($total_pd == '1')  //&& $role_name == 'Fleet Manager'
				{  ?>
					<a href="{{route('workorder.approve_decline', $workorders->WOId)}}" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></a>
				<?php 
				}
				else if($total_pd == '1') //&& $role_name == 'Vendor/Mechanic' 
				{  ?>
					<button type="button" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></button>
				<?php 
				}
				?>
				
                </td>
            </tr>
        @endforeach
		@endif

		@endforeach
		@endif
		<?php } ?>				






		<!-- FOR VENDORS -->
		<?php
			$roled = $auth_user->RoleId;    $RM = DB::table('role')->where('RoleId', '=', $roled)->first();
			if($RM->RoleName == "Vendor/Mechanic")
			{
		?>
					
		<?php  
			$email = $auth_user->email;   $shop = $auth_user->WorkShopId;   $roled = $auth_user->RoleId;
			$Role = DB::table('role')->where('RoleId', '=', $roled)->first();
			$shopEmail = DB::table('workshopemail')
			->where('Status', '=', 'Vendor Review')
            ->orWhere('Status', '=', 'Approved')
            ->orWhere('Status', '=', 'Declined')
            ->where('State', '=', '1')->orWhere('State', '=', '3')            
            ->orderBy('WorkOrderNumber', 'desc')->get();  
		?>

		@if($shopEmail)
        @foreach ($shopEmail as $shopEmail)

        <?php
          $workorders = DB::table('workorder')->where('WorkShopId', '=', $shopEmail->WorkShopId)->orderBy('WorkOrderNumber', 'desc')->get(); 
        ?>
		@if($workorders)
        @foreach ($workorders as $workorders)
            <tr>
                <td>{{$workorders->WorkOrderNumber}}</td>
				<td>    <?php $as_id = $workorders->AssetId; ?>
					<?php 
						$asset = DB::table('asset')->where('AssetId', '=', $as_id)->first();    
					?> @if($asset) {{$asset->LicensePlate}} @endif
				</td>
				<td>
					<?php 
						$mk_id = $asset->MakeId;
						$assetmake = DB::table('assetmake')->where('MakeId', '=', $mk_id)->first();  
					?> @if($assetmake) {{$assetmake->Make}} @endif
				</td>
                <td>
					<?php
						$md_id = $asset->ModelId;
						$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $md_id)->first();      	echo $assetmodel->ModelName;
					?> @if($assetmodel) {{$assetmodel->ModelName}} @endif
				</td>
                <td>{{$workorders->ServiceDate}}</td>
				<td>{{$workorders->ServiceCompletionDate}}</td>
				<td>
					<?php 						
						$stid = $workorders->WorkOrderStatusId;
                   if($stid == 1){					
					?>
					 <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
                    
                    <?php  }elseif($stid==2){ ?>
                    
					<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                    
                   <?php  }elseif($stid==3){ ?>
                    
                      <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">
                    
                   <?php } ?>
				</td>
				
				<td>
					<?php 
						$wrk_no = $workorders->WorkOrderNumber;
						$total_vr = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '1')->where('Status', '=', 'Vendor Review')->count(); 
						if($total_vr == '1'){ echo '<span style="color:#007FFF"> Vendor Review  </span>'; }
						
						$total_ap = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Approved')->count(); 
						if($total_ap == '1'){ echo '<span style="color:#339966;"> Approved </span>'; }
						
						$total_dc = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Declined')->count();
						if($total_dc == '1'){ echo '<span style="color:red"> Declined </span>'; }			
					?>
				</td>
				
				<td>
					<?php 
						$wsid = $workorders->WorkShopId;
						$workshop = DB::table('workshop')->where('WorkShopId', '=', $wsid)->first();    ;
					?> @if($workshop) {{$workshop->WorkShopName}} @endif
				</td>
                <td class="actions"> 
				<!-- if approved display a different button -->
				<?php
				if($total_ap == '1')
				{ ?>
					<a href="{{route('workorder.approved', $workorders->WOId)}}" class="btn fa fa-edit" id="" style="color:white; font-size:9px;background-color:#396"></a>
				<?php  
				}
				else if($total_dc == '1')
				{ ?>
					<a href="{{route('workorder.edit', $workorders->WOId)}}" class="btn btn-primary fa fa-edit" id="" style="color:white; font-size:9px;"></a>
				<?php  
				
				}
				//FOR VENDOR REVIEW
				else if($total_vr == '1')  //&& $role_name == 'Vendor/Mechanic'
				{  ?>
					<a href="{{route('workorder.edit', $workorders->WOId)}}" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></a>
				<?php 
				}
				else if($total_vr == '1') //&& $role_name == 'Fleet Manager' 
				{  ?>
					<button type="button" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></button>
				<?php 
				}
				?>
				
                </td>
            </tr>
        @endforeach
		@endif

		@endforeach
		@endif

		<?php } ?>

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
		$('.order').dataTable();
	});
	
</script>









@stop