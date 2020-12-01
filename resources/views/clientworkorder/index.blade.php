@extends('templates.default')

@section('content')



<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-bwrench"></i>   Client Quote</h1> 
	<p class="lead"> DREAM's quote management module gives you the flexibility you need to effectively manage any type of vehicle asset related
	 repair, or work activity. <br> This module offers a single familiar tool for scheduling, managing and collecting data for all work activities. </p>
	 </div>
	
	
	<div class="">
              
			  
	<?php     // $session = $this->request->session(); 
	//$roled = $this->request->Session()->read('Auth.User.RoleId');  $role_name = $session->read('role_name');  ?>  
	<div class="row  m-b-40">

	<!-- left content -->
	  <div class="col-md-12 col-md-pull-0"> 
        <a href="{{ route('clientworkorder.add') }}" class="btn" style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;"> <i class="fa fa-plus"></i> New Quote</a>
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
			<tr style="">
                <th> WO No </th>
				<th> Plate </th>
				<th> Make </th>
				<th> Model </th>
				<th> Start </th>
				<th> End </th>
				<th> Status </th>
				<th> State </th>
				<th scope="col" class="actions"></th>
			</tr>
		</thead>	
		<tbody>
		@if($clientworkorders)			
		@foreach ($clientworkorders as $clientworkorders)
            <tr>
                <td>{{$clientworkorders->WorkOrderNumber}}</td>
				<td> 
					<?php 
						$as_id = $clientworkorders->AssetId;
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
						$md_id = $asset->MakeId;
						$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $md_id)->first();
					?> @if($assetmodel) {{$assetmodel->ModelName}} @endif
				</td>
                <td>{{$clientworkorders->ServiceDate}}</td>
				<td>{{$clientworkorders->ServiceCompletionDate}}</td>
				<td>
					<?php 						
						$stid = $clientworkorders->WorkOrderStatusId;
                   if($stid == 1){					
					?>					 
                     <span style="color:white;font-size:1px"><?= $stid ?></span>
					 <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-11px">
                    <?php  }elseif($stid==2){ ?>

                    <span style="color:white;font-size:1px"><?= $stid ?></span>
					<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-11px">
                    
                   <?php  }elseif($stid==3){ ?>
                      
					  <span style="color:white;font-size:1px"><?= $stid ?></span>
                      <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px" style="margin-top:-11px">
                      
                   <?php } ?>
				</td>
				
				<td> <span style="color:#FFBF00;"> Pending Review </span>
                    <?php 
						/*$wrk_no = $clientworkorders->WorkOrderNumber;										
						$sql = "SELECT * FROM clientemail WHERE WorkOrderNumber = '{$wrk_no}' AND State = '1' AND Status = 'Unread' ";
						$result = $conn->query($sql);  		$total_vr = mysqli_num_rows($result); 
						if($total_vr == '1'){ echo '<span style="color:blue"> Vendor Review  </span>'; }
						
						$sql2 = "SELECT * FROM clientemail WHERE WorkOrderNumber = '{$wrk_no}' AND State = '2' AND Status = 'Unread' ";
						$result2 = $conn->query($sql2);  		$total_pd = mysqli_num_rows($result2); 
						if($total_pd == '1'){ echo '<span style="color:#FFBF00;"> Pending </span>'; }
						
						$sql4 = "SELECT * FROM clientemail WHERE WorkOrderNumber = '{$wrk_no}' AND State = '4' AND Status = 'Unread' ";
						$result4 = $conn->query($sql4);  		$total_ap = mysqli_num_rows($result4); 
						if($total_ap == '1'){ echo '<span style="color:#339966;"> Approved </span>'; }
						
						$sql5 = "SELECT * FROM clientemail WHERE WorkOrderNumber = '{$wrk_no}' AND State = '5' AND Status = 'Unread' ";
						$result5 = $conn->query($sql5);  		$total_dc = mysqli_num_rows($result5); 
						if($total_dc == '1'){ echo '<span style="color:red"> Declined </span>'; }*/
						
					?>
				</td>
				
                <td class="actions"> 
                <a href="{{route('clientworkorder.edit', $clientworkorders->WOId)}}" class="btn fa fa-edit" id="" style="color:white; font-size:9px;background-color:#396"></a>


				<!-- if approved display a different button -->
				<?php
				/*if($total_ap == '1')
				{ ?>
					<a href="{{route('clientworkorder.edit', $clientworkorders->WOId)}}" class="btn fa fa-edit" id="" style="color:white; font-size:9px;background-color:#396"></a>
				<?php  
				}
				else if($total_dc == '1')
				{ ?>
					<a href="{{route('clientworkorder.edit', $clientworkorders->WOId)}}" class="btn btn-primary fa fa-edit" id="" style="color:white; font-size:9px;"></a>
				<?php  
				}
				//FOR PENDING FLEET MANAGER REVIEW
				else if($total_pd == '1')  //&& $role_name == 'Fleet Manager'
				{  ?>
					<a href="{{route('clientworkorder.edit', $clientworkorders->WOId)}}" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></a>
				<?php 
				}
				else if($total_pd == '1') //&& $role_name == 'Vendor/Mechanic' 
				{  ?>
					<button type="button" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></button>
				<?php 
				}
				//FOR VENDOR REVIEW
				else if($total_vr == '1')  //&& $role_name == 'Vendor/Mechanic'
				{  ?>
					<a href="{{route('clientworkorder.edit', $clientworkorders->WOId)}}" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></a>
				<?php 
				}
				else if($total_vr == '1') //&& $role_name == 'Fleet Manager' 
				{  ?>
					<button type="button" class="btn btn-success fa fa-edit" id="" style="color:white; font-size:9px"></button>
				<?php 
				} $conn->close();  */
				?>
				
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
		$('.order').dataTable();
	});
	
</script>









@stop