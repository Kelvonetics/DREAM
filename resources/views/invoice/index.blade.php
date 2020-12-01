@extends('templates.default')

@section('content')



<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-briefcase"></i> Invoice Management </h1> 
	<p class="lead"> DREAM's invoice module gives you the flexibility you need to effectively manage client invoice, or work activity. <br> This module offers a single familiar tool for generating invoice, managing and collecting data for all invoice activities. </p> <br>
    <a href="#" class="btn" style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;"> <i class="fa fa-plus"></i> New Invoice</a>
	</div>

		  
	<div class="row  m-b-40">

    <!-- left content -->
	<div class="col-md-12 col-md-pull-0" style="margin-top:-30px"> 
            
        <div class="well white">
		@if(session('info'))
			<div class="alert" style="background-color:#ACE1AF">
				{{session('info')}}
			</div>
		@endif

    <table id="example" class="table table-full table-full-small invoice" cellspacing="0" width="100%">					
		<thead>
			<tr>
				<th> Invoice No </th>
				<th> Date(Created) </th>
				<th> Due Date </th>
				<th> Amount </th>
				<th> Total </th>
				<th> Balance </th>
				<th> Status </th>
				<th> Client </th>
				<th scope="col" class="actions"> </th>
			</tr>
		</thead>	
		<tbody>
		@if($invoices)			
		@foreach ($invoices as $invoices)
            <tr>
				<td>{{$invoices->InvoiceNumber}}</td>
				<td>{{$invoices->CreatedDate}}</td>
				<td>{{$invoices->DueDate}}</td>
				<td>
					<?php 
						$invno = $invoices->InvoiceNumber;	
						$invoiceitem = DB::table('invoiceitem')->where('InvoiceNumber', '=', $invno)->first();
					?> @if($invoiceitem) {{$invoiceitem->Amount}} @endif
				</td>
                <td> {{$invoices->TotalCost}} </td>
				<td> <?= '000000' ?> </td>
                <td>{{$invoices->Status}}</td>				
				<td>
					<?php 
						$ctid = $invoices->ClientId;
						$client = DB::table('client')->where('ClientId', '=', $ctid)->first();
					?> @if($client) {{$client->FirstName.' '.$client->LastName}} @endif
				</td>
				<td style="overflow:visible">
				 <div class="dropdown" style="">
					<button class="btn btn-success dropdown-toggle" type="button" id="<?= $invoices->InvoiceId ?>" data-toggle="dropdown" style="font-size:9px">actions
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li><a href="{{route('invoice.edit', $invoices->InvoiceId)}}" role="" style="font-size:11px">Edit Invoice</a></li>
					  <li><a href="#" role="" style="font-size:11px">Convert To PDF</a></li>
					  <li><a href="#" role="" style="font-size:11px">Email To Client</a></li>
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




<?php //$tableName = 'invoice'; $count = getTotalNoOfInvoice($tableName); ?>

<!-- client invoice Modal -->						



<script>
	$(document).ready(function()
	{
		$('.invoice').dataTable();
	});
</script>







@stop