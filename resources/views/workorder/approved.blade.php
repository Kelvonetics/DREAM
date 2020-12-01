@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<?php
	$user_roleid = '9';	
	//RETRIEVING THE USER ROLE ID
	//$user_roleid = $this->request->Session()->read('Auth.User.RoleId');
	//RETRIVING THE WORK ORDER WORK FLOW ID
	$workflow = DB::table('workflow')->where('WorkFlowName', '=', 'Work Order')->first();
	$wflowId = $workflow->Settings;
	
?>

<?php 
	$idd = $workorder->WOId;    $wo = $workorder->WOId;
	$date = DB::table('workorder')->where('WOId', '=', $wo)->first();
	$order_ct = DB::table('workorder')->where('WOId', '=', $wo)->count();

		 if($order_ct < 10)	{	@$numb .= '0000';	}	
	else if($order_ct >= 10){	@$numb .= '000';	}
	else if($order_ct >= 100){	@$numb .= '00'; 	}	
	else if($order_ct >= 1000){	@$numb .= '0';		}
	else {		};
 ?>






<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
    <section class="forms-basic">
	<div class="page-header">
         <h1>      <i class="md md-layers"></i>    Convert This Order To PDF	  </h1>
			  
    </div>      
            


	  <div class="col-md-10 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>

<div id="HTMLtoPDF">

	  <h2>Work Order  Dates :  <span style="font-size:16px"> <?=  $date->ServiceDate.' &nbsp; - &nbsp; '.$date->ServiceCompletionDate;   ?> </span></h2>

	<p>
		<div class="row">
			<div class="col-md-6">
				<span> Actual Start Dates : @if($date) <?=  $date->ActualStartDate;   ?>@endif </span>
			</div>
			<div class="col-md-6">
				<span style="margin-left:50px"> Actual End Dates : @if($date) <?=  $date->ActualEndDate;   ?> @endif</span>	 
			</div>
		</div>	 
		
	</p>

	<p>
		<div class="row">
			<div class="col-md-2">
				<span> Plate : </span>  <span> <?php  $a = $date->AssetId; $allasset = DB::table('asset')->where('AssetId', '=', $a)->first();  ?>
				@if($allasset) {{$allasset->LicensePlate}} @endif </span>
			</div>
			<div class="col-md-4">
				<span style="margin-left:50px"> Mileage: </span>  <span>@if($date) <?=  $date->OdometerReading;   ?>@endif </span>	 
			</div>
			<div class="col-md-6">
				<span style="margin-left:50px"> Workshop :  
				<?php 
					$num = $workorder->WorkShopId;
					$shop = DB::table('workshop')->where('WorkShopId', '=', $num)->first();
				?> @if($date) {{$shop->WorkShopName}} @endif
				</span>	
			</div>
		</div> 
			
	</p>

	<h3>WorkOrder Parts </h3>

	<p>
		<?php	
			$wko_no = $workorder->WorkOrderNumber; 
			$records = DB::table('workorderitem')->where('WorkOrderNumber', '=', $wko_no)
			->where('Type', '=', 'part')->orderBy('WOId', 'desc')->get();  
		?>
		@if($records)	
		@foreach($records as $records)

		<div class="row">
			<div class="col-md-4">
				<?php $cid = $records->InvCatId; 
					$invcategory = DB::table('invcategory')->where('InvCatId', '=', $cid)->first();
					if($invcategory) { ?> {{$invcategory->InvName}} <?php }  
				?>
			</div>
			<div class="col-md-4">
				<?php $pid = $records->InvId;
					$inventoryitem = DB::table('inventoryitem')->where('InvId', '=', $pid)->first();
					if($inventoryitem) { ?> {{$inventoryitem->InvItemName}} <?php }  
				?> 
			</div>
			<div class="col-md-4">{{$records->PartCost}} </div>
		</div>
		<hr>

		@endforeach
		@endif
	</p>


	<h3>WorkOrder Labour </h3>

	<p>
		<?php	
			$wko_no = $workorder->WorkOrderNumber; 
			$record = DB::table('workorderitem')->where('WorkOrderNumber', '=', $wko_no)
			->where('Type', '=', 'labour')->orderBy('WOId', 'desc')->get(); 
		?>
		@if($record)	
		@foreach($record as $record)

		<div class="row">
			<div class="col-md-8">
				<?php $lid = $record->LabourId; 
					$workorderlabour = DB::table('workorderlabour')->where('LabourId', '=', $lid)->first();
					if($workorderlabour) { ?> {{$workorderlabour->LabourDesc}} <?php }  
				?>
			</div>
			<div class="col-md-4">{{$record->LabourCost}} 

			</div>
		</div>
		<hr>

		@endforeach
		@endif
	</p>


      
	<p>
		<div class="row">
			<div class="col-md-4"> Total Cost
				<?php $wko_no = $workorder->WorkOrderNumber; 
					$total = DB::table('workorderitem')->where('WorkOrderNumber', '=', $wko_no)
					->where('Type', '=', 'part')->orderBy('WOId', 'desc')->first();
				?> @if($date) {{$total->TotalCost}} @endif
			</div>
			<div class="col-md-4"> Payment Made : 0.0000 </div>

			<div class="col-md-4"> Balance :@if($total) {{$total->TotalCost}}@endif </div>
		</div>
	</p>	
		
			 	  
 </div>
		 
	
	<div class="form-group" style="">
		<a href="#" class="btn btn-success" style="background-color:#396; color:#fff" onclick="HTMLtoPDF()">Download In PDF</a>
	</div>
  
  
   </div>
  
  
 
 
 
 
</div>
 
 
 
  </section>
</div>


<script charset="utf-8" src="{{URL::asset('assets/js/jquery-2.1.3.js')}}"></script>
<script charset="utf-8" src="{{URL::asset('assets/js/jspdf.js')}}"></script>
<script charset="utf-8" src="{{URL::asset('assets/js/pdfFromHTML.js')}}"></script>		



@stop