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
		@if($clientInvoices)			
		@foreach ($clientInvoices as $clientInvoices)
            <tr>
				<td>{{$clientInvoices->InvoiceNumber}}</td>
				<td>{{$clientInvoices->CreatedDate}}</td>
				<td>{{$clientInvoices->DueDate}}</td>
				<td>
					<?php 
						$invno = $clientInvoices->InvoiceNumber;	
						$invoiceitem = DB::table('invoiceitem')->where('InvoiceNumber', '=', $invno)->first();
					?>
					@if($invoiceitem) {{$invoiceitem->Amount}} @endif
				</td>
                <td> {{$clientInvoices->TotalCost}} </td>
				<td> <?= '000000' ?> </td>
                <td>{{$clientInvoices->Status}}</td>				
				<td>
					<?php 
						$ctid = $clientInvoices->ClientId;
						$client = DB::table('client')->where('ClientId', '=', $ctid)->first();
					?>@if($client) {{$client->FirstName.' '.$client->LastName}} @endif
				</td>
				<td style="overflow:visible">
				 <div class="dropdown" style="">
					<button class="btn btn-success dropdown-toggle" type="button" id="<?= $clientInvoices->InvoiceId ?>" data-toggle="dropdown" style="font-size:9px">actions
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li><a href="{{route('invoice.edit', $clientInvoices->InvoiceId)}}" role="" style="font-size:11px">Edit Invoice</a></li>
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