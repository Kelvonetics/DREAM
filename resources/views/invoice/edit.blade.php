@extends('templates.default')

@section('content')


<!-- INVOICE NUMBERS -->
<?php 
	$invid = $invoice->InvoiceId;    $invno = $invoice->InvoiceNumber;
	$Invoice = DB::table('invoice')->where('InvoiceId', '=', $invid)->first();
	$cts_inv = DB::table('invoice')->where('InvoiceId', '=', $invid)->count();

		 if($cts_inv < 10)	{	@$numb .= '0000';	}		
	else if($cts_inv >= 10){	@$numb .= '000';	}
	else if($cts_inv >= 100){	@$numb .= '00';   }	
	else if($cts_inv >= 1000){	@$numb .= '0';	}
	else {		};	
 ?>


<style>
.pad
{
	margin-top: 5px;
	border:1px solid #ddd;
}
.sel-opt
{
	border:thin #ede solid;
	width:100%;
	padding:5px;
	border-radius:1px;
	margin:auto 2% auto 0%;
	color:#999;
}

.sel-opt-left
{
	border:thin #ede solid;
	width:100%;
	padding:5px;
	border-radius:1px;
	margin:auto 2% auto 0%;
	color:#999;
}
.sel-opt-mid
{
	border:thin #ede solid;
	width:100%;
	padding:5px;
	border-radius:1px;
	margin:auto 2% auto 0%;
	color:#999;
}
.sel-opt-right
{
	border:thin #ede solid;
	width:100%;
	padding:5px;
	border-radius:1px;
	margin:auto 2% auto 0%;
	color:#999;
}
.input
{
	border:thin #ede solid;
	width:95%;
	padding:5px;
	border-radius:4px;
	margin:auto 5px;
}

.left-side
{
	margin-top:-50px;
}
.box-section 
	{ 
		width:95%; border:#eee thin solid; margin:7px auto; 
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
.big-text
	{
		font-size:13px; color:#666;
	}
.bigger-text
	{
		font-size:15px; color:#666;
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
</style>










<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="fa fa-female"></i>    Client Invoice </h1>
						 
	</div>
	
	<!-- right content -->
  <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
  <div class="pull-right" style="margin:-25px -20px 0px 0px">
	<ul class="list-unstyled">
	  <li class="dropdown">
		<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
	  </li>
	</ul>
  </div>
  
	<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
	<div class="well white white-card"> 		

    <center> <img src="{{URL::asset('assets/img/invoice.jpg')}}" class="img-responsive" height="150" width="150"> </center>
		
		
		
	</div>  	
	
	
		<!-- quick report div  -->
		<div class="grey-card" style="padding:0px 0px 0px 25px">
		<table class="table" width="105%" cellpadding="0">
			<tr>
				<td style="width:95%"> 
					<h4 class="grey-text m-b-30">   Quick Action  </h4>
							</td>
				<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
			</tr>
		</table>
		
		   <div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
			
			<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
			  <div class="pull-right" style="margin:-5px -25px; color:#fff"><a href="#" class="btn btn-circle-green" data-tooltip="true" data-toggle="modal" data-target="#workModal" title='Add New Payment'>+</a></div>
			  <div class="w600 f11"><a style="color:#21ff96F3;font-weight:lighter" href="#">Add New Payment</a></div>
			</div>
			
		  </div>
		</div>

		

		<!-- quick information div  -->
		<div class="grey-card">
		<div style="margin:-10px 15px 0px 10px">
			<?php  //$this->element('asset_insight');?> 
		</div>
		</div>
	
  </div>

	  
	<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 			
			
		<div class="" style="">		

		<p style="padding:5px 0px; font-color:#202020; font-size:17px">
		  <legend>Invoice Number : #{{$numb.$invoice->InvoiceNumber}} </legend>   
		  
		  <div class="lead" style="margin:-15px 0px 40px -15px">
			<div class="col-md-11 big-text"> 					Date :  {{$invoice->CreatedDate}}		    </div>
			
			<br><br>
			
			<div class="col-md-11 bigger-text" style="font-weight:bold"> 
			<?php  
				$ctid = $invoice->ClientId;
				$client = DB::table('client')->where('ClientId', '=', $ctid)->first();	
				echo $client->FirstName.' '.$client->LastName;					
			?> 	    
			</div>
			<div class="col-md-11 big-text"><?= $client->Address ?> </div>
			<div class="col-md-11 big-text"><?= $client->City.', ' . $client->State ?> </div>
			<div class="col-md-11 big-text"> 			<?= $client->Country.'.'  ?>		</div>
		 </div>

		</p>
		
		

        <form class="form-horizontal" method="post" action="{{ url('/invoice/update', array($invoice->InvoiceId)) }}">

        @if(count($errors) > 0)
            @foreach($errors->all() as $errors)
                <div class="alert alert-danger" style="width:75%"> {{ $errors }} </div>
            @endforeach
        @endif

        @if(session('info'))
            <div class="alert" style="background-color:#ACE1AF">
                {{session('info')}}
            </div>
        @endif
	<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px">
	<CAPTION>Invoice Details</CAPTION>
		<tr style="display:none">
		
			
		
			<td style="width:33%"> 
				<label for="InvoiceNumber" class="fm-label">  <i class="fa fa-file-text-o"></i> Invoice Number </label>
				<input type="hidden" name="InvoiceNumber" id="InvoiceNumber" class="" style="border:thin #ede solid;	width:100%;	padding:3px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" value="{{$invoice->InvoiceNumber}}" />
				<input type="hidden" name="InvoiceId"@if($invoice) value="{{$invoice->InvoiceId}}"@endif />
			</td>
			
			<td style="width:33%"> 	<label for="WorkOrderId " class="fm-label"> <i class="fa fa-wrench"></i> Work Order Id </label>
			<input type="hidden" name="WorkOrderId" id="WorkOrderId" class="" style="border:thin #ede solid;	width:100%;	padding:3px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"@if($invoice) value="{{$invoice->WorkOrderId}}"@endif />				
			</td>						
		
			<td style="width:33%"> 	
				<label for="ClientId" class="fm-label"> <i class="fa fa-female"></i> Client </label>
				<select class='sel-opt-right' name='ClientId' id='ClientId' required>
				@if($client)
				<option value="{{$client->ClientId}}"> {{$client->FirstName}}.' '.{{$client->LastName}}</option>
				@endif
				</select>
			</td>

		</tr>

		<tr style="display:none">
		
			<td>	<label for="CreatedDate" class="fm-label"> <i class="fa fa-calendar"></i> Created Date </label>
				 <input type="text" name="CreatedDate" id="CreatedDate" class="datepicker" style="border:thin #ede solid;	width:100%;	padding:3px;	border-radius:4px;margin:auto 2% auto 0%; color:#999" value="{{$invoice->CreatedDate}}" />
			</td>						
		
			<td>	
			</td>
			
			<td>	<label for="DatePaid" class="fm-label"> <i class="fa fa-calendar"></i> Date Paid </label>
					<input type="text" name="DatePaid" id="DatePaid" class="datepicker" style="border:thin #ede solid;	width:100%;	padding:3px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"@if($invoice) value="{{$invoice->DatePaid}}"@endif />
			</td>
		
		</tr>
		
		<tr class="box-section">
			<td style="width:33%">	<label for="DueDate" class="fm-label"> <i class="fa fa-calendar"></i> Due Date </label>
				 <input type="text" name="DueDate" id="DueDate" class="datepicker" style="border:thin #ede solid;	width:100%;	padding:3px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"@if($invoice) value="{{$invoice->DueDate}}"@endif />
			</td>
		
			<td style="width:33%"> 	<label for="PaymentMethod" class="fm-label"> <i class="fa fa-money"></i> Payment Method </label>
				<select class='sel-opt-mid' name='PaymentMethod' id='PaymentMethod' required>
				@if($invoice)
					<option value="{{{$invoice->PaymentMethod}}}">{{$invoice->PaymentMethod}}</option>
				@endif
                    <option value=""> Select Payment Type </option> 
					<option value="Bank Transfer"> Bank Transfer </option>						
					<option value="Bank Cheque"> Bank Cheque </option>
					<option value="Credit Card"> Credit Card </option>				
                </select>
			</td>						
		
			<td style="width:33%"> 	<label for="Status" class="fm-label"> <i class="fa fa-question"></i> Status </label>
			<select class='sel-opt-right' name='Status' id='Status' required>
			@if($invoice)
				<option value="{{{$invoice->Status}}}">{{$invoice->Status}}</option>
			@endif
				<option value=""> Select Invoice Status </option>
				<option value="Unpaid"> Unpaid </option>						
				<option value="Paid"> Paid</option>
				<option value="Cancelled"> Cancelled </option>			
			 </select>

				 <input type="hidden" name="Tax" id="Tax" class="" style="border:thin #ede solid;	width:95%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"@if($invoice) value="{{$Invoice->Tax}}"@endif />	
				 <input type="hidden" name="CreatedBy" id="CreatedBy" class="" style="border:thin #ede solid;	width:98%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0%" @if($invoice) value="{{$invoice->CreatedBy}}"@endif />	
			</td>
			
		</tr>
	</table>

		
<table class="table" cellspacing="1" width="97%" border="0" style="margin:-15px 0px 0px 0px">
	<CAPTION>Invoice Items</CAPTION>
	<tbody>
	
	<?php	
		$invno = $invoice->InvoiceNumber;
		$records = DB::table('invoiceitem')->where('InvoiceNumber', '=', $invno)
		->orderBy('ItemId', 'desc')->get();			  $i = 1;   ?>
		@if($records)
		@foreach($records as $records)
		<tr class="box-section">  
			<td style="width:7%"> <div class="form-group">
			
				<label for="Quantity".$i."" class="fm-label" style="margin-left:10px">  <i class="fa fa-hourglass-3"></i> Qty  </label>
				<input type="number" name="Quantity".$i."" id="Quantity".$i."" class="" style="border:thin #ede solid;	width:88%;	padding:3px;	border-radius:4px;margin:auto -1% auto 10%; color:#999" value="{{$records->Quantity}}" />
				<input type="hidden" name="ItemId".$i."" id="ItemId".$i."" value="{{$records->ItemId}}" />							
				
				</div> 
			</td>	
			<td style="width:66%">  <div class="form-group">
			
				<label for="Description".$i."" class="fm-label" style="margin-left:25px"> <i class="fa fa-pencil"></i> Description </label> <br>
				<input type="text" name="Description".$i."" id="Description".$i."" class="" style="border:thin #ede solid;	width:93%;	padding:3px;	border-radius:4px;margin:auto 0% auto 4%; color:#999" value="{{$records->Description}}" />
								
			   </div> 
			</td>	
			<td style="width:12%">  <div class="form-group">
			
				<label for="Price".$i."" class="fm-label" style="margin-left:0px"> <i class="fa fa-usd"></i> Unit Price </label>
				<input type="number" name="Price".$i."" id="Price".$i."" class="price" style="border:thin #ede solid;	width:87%;	padding:3px;	border-radius:4px;margin:auto 2% auto 2%; color:#999" value="{{$records->Price}}" />	

				</div> 
			</td>
			<td style="width:12%">  <div class="form-group">
			
				<label for="Amount".$i."" class="fm-label"> <i class="fa fa-usd"></i> Total </label>
				<input type="number" name="Amount".$i."" id="Amount".$i."" class="amount" style="border:thin #ede solid;	width:87%;	padding:3px;	border-radius:4px;margin:auto 0% auto 2%; color:#999" value="{{$records->Amount}}" />	

				</div> 
			</td>
		</tr> <?php 	$i++;		?>
		@endforeach
		@endif
	</tbody>
</table>		
		<input type="hidden" name="countinv" id="countinv" value="<?= --$i ?>" />
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
		
<table class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px; background-color:#f9f9f9">
	<tr>
		<td width="81%"> <span class="pull-right"> <i class="fa fa-usd"></i> Sub Total : &nbsp; </span> </td>       
		<td width="13%"> <span class="fa fa-usd" id="SubTotal"></span>  </td>
	</tr>
	<tr>
		<td width="81%"> <span class="pull-right"> <i class="fa fa-usd"></i> Total Cost : &nbsp;</span> </td>       
		<td width="13%"> <span class="fa fa-usd" id="TCost"></span>  </td>
		<input type="hidden" name="SubTotals" id="SubTotals"  value="" />
		
	</tr>
</table>
	
		
<table class="table" cellspacing="1" width="100%" border="0" style="margin-top:-15px;">
	<tr class="box-section">
		<td colspan="3">
			<label for="Notes" class="fm-label"> <i class="fa fa-commenting"></i> Invoice Note </label> <br>
			<input type="text" name="Notes" id="Notes" style="border:thin #ede solid;	width:100%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%; color:#999"@if($invoice) value="{{$invoice->Notes}}"@endif />
		</td>
	</tr>
	
	<tr style="height:10px"> <td class="lead"> Transactions </td> <td> </td> <td> </td> </tr> 
	
	<tr style="background-color:#f9f9f9">
		<td colspan="2"> <span class="pull-left"><span class="fa fa-calendar"></span> Date Paid : &nbsp; </span> </td>       
		<td width="13%"> <span id=""> @if($invoice) {{$invoice->DatePaid}} @endif </span>  </td>
	</tr>
	<tr style="background-color:#f9f9f9">
		<td colspan="2"> <span class="pull-right"> <i class="fa fa-usd"></i> Balance : &nbsp; </span> </td>       
		<td width="13%"> <span class="fa fa-usd" id="Balance"></span> </td>
	</tr>
	
	<tr>			
		<td  colspan="3">
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="updInv">Update Invoice</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div>
		</td>
	</tr>		
</table>			
		
	</Form>
	

		
	 </div>
	 
	 </div>


		 
		</section> 

</div>













<script>
	$(document).ready(function()
	{
		$('.vwinvDTable').dataTable();
	});
</script>

<script>  	  //AJAX FUNCTION TO UPDATE CLIENT
	$(document).ready(function()
	{
		
	});
</script>

<script>
	$(document).ready(function()
	{
		var sub_total = 0; var total_cost = 0;
			$('.amount').each(function()
			{
				sub_total += parseInt($(this).val());
			});
			
			total_cost = parseInt(sub_total * 1.05);
			document.getElementById("SubTotal").innerHTML = parseInt(sub_total); 
			document.getElementById("SubTotals").value = parseInt(total_cost); 
			
			document.getElementById("TCost").innerHTML = parseInt(total_cost); 
			
			document.getElementById("Balance").innerHTML = parseInt(total_cost); 
			
			
		
		$('.amount').keyup(function()
		{
			var sub_total = 0;
			$('.amount').each(function()
			{
				sub_total += parseInt($(this).val());
			});
			
			//$('#total').html('$' + sub_total);
			document.getElementById("SubTotal").innerHTML = parseInt(sub_total); 
			
			total_cost = parseInt(sub_total * 1.05);
			document.getElementById("TCost").innerHTML = parseInt(total_cost); 
			document.getElementById("Balance").innerHTML = parseInt(total_cost); 
		});
		
		//amaking sure the amount value is never empty to avoid NAN Not A Number 
	

		
	
	});
	
	function checkAmount(field) 
	{
		if (field.value == '') 
		{
			var fid = field.id;
			document.getElementById(fid).value = 0;
			//$('.amount').val(0);
		}
	}
</script>





@stop