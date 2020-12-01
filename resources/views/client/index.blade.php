@extends('templates.default')

@section('content')


<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.pad{
        margin-top: 5px;
        border:1px solid #ddd;
	}
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
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:92%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 1% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:92%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 4%;
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
		color:#666; margin:auto 0% auto 4%;
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
.box-right
	{
		border:1px solid #ddd;
		padding:8px 15px;
	}
.notif
	{
		background-color:red;     <!-- #E52B50 -->
		color:white;
	}

	/*  .modal 
	{
		max-width:900px;
	} */
</style>

<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;">
	<h1>      <i class="fa fa-female"></i>     Client Administration  </h1> 
	<p class="lead"> The client administration module allows you to manage and analyze customer interactions and data throughout the customer lifecycle, <br>  with the goal of improving business relationships with your customers, assisting in customer retention and driving sales growth. </p>
		
			
		
		</div>
	
	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

<!-- left content -->
  <div class="col-md-12 col-md-pull-0"> 

     <a href="{{ route('client.add') }}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63; font-size:11px"> <i class="fa fa-plus"></i>  New Client</a>
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
				
    <table id="example" class="table table-full table-full-small client" cellspacing="0" width="100%">

        <thead>
            <tr style="">
				<th> First Name </th>
				<th> Last Name </th>
				<th> Email </th>
				<th> Company </th>
				<th> Address </th>
				<th> City </th>
				<th> State </th>
				<th> Country </th>
				<th class=""></th>
			</tr>
        </thead>
        <tbody>
		@if($clients)
            @foreach ($clients as $clients)
            <tr>
                <td>{{$clients->FirstName}}</td>
                <td>{{$clients->LastName}}</td>
                <td>{{$clients->Email}}</td>
                <td>{{$clients->Company}}</td>
				<td>{{$clients->Address}}</td>
				<td>{{$clients->City}}</td>
				<td>{{$clients->State}}</td>
				<td>{{$clients->Country}}</td>
				<td style="overflow:visible">
				<div class="dropdown" style="">
					<button class="btn btn-success dropdown-toggle" type="button" id="{{$clients->ClientId}}" data-toggle="dropdown" style="font-size:9px">
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li><a href="{{route('client.view', $clients->ClientId)}}" role="" style="font-size:11px">View Profile</a></li>
					  <li><a onclick="clientAsset({{$clients->ClientId}})" role="menuitem" id="" data-toggle="modal" data-target="#clientAssetModal" style="font-size:11px">Create Client Vehicle Profile</a></li>
					  <li><a role="menuitem"  name="index" data-toggle="modal" data-target="#quoteModal" style="font-size:11px">Create Client Quote</a></li>
					  <li><a onclick="clientInvoice({{$clients->ClientId}})" role="menuitem" id="" data-toggle="modal" data-target="#invoiceModal" style="font-size:11px">Create Client Invoice</a></li>
					  <li><a onclick="clientJob({{$clients->ClientId}})" role="menuitem" id="" data-toggle="modal" data-target="#jobModal" style="font-size:11px">Create Client Job</a></li>
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
</div>
</section>


</div>





<!-- client asset Modal -->							
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertClientAssetFromIndex') }}">	
<div id="clientAssetModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:55%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-car" aria-hidden="true"></i> New Client Asset </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.client-asset_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- client Quote Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertClientQuoteFromIndex') }}">	
<div id="quoteModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:55%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-wrench" aria-hidden="true"></i> New Client Quote </h4>
      </div>
      <div class="modal-body">
       

	  @include('modals.client_quote_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>


<!-- client invoice Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/client/insertInvoiceFromIndex') }}">	
<div id="invoiceModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:55%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-sticky-note" aria-hidden="true"></i> New Client Invoice </h4>
      </div>
      <div class="modal-body">
      

	  @include('modals.invoice_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>



<!-- client job Modal -->						






<script>
	$(document).ready(function()
	{
		$('.client').dataTable();
	});
	
	$(document).ready(function()
	{
		$('.casset').dataTable();
	});

	$(document).ready(function()
	{
		$('.invoiceDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.workDTable').dataTable();
	});

	$(document).ready(function()
	{
		$('.jobDTable').dataTable();
	});

	
	function clientInvoice(id)
	{		   
		$('#Client_Id').val(id);   
	}
    
    function clientAsset(id)
	{       
		$('#Clientid').val(id);   
    }
	 
    /*function clientWorkOrder(id)
	{  
		$('#ClientID').val(id);   
    }*/
	
    function clientJob(id)
	{     
		$('#ClientiD').val(id);   
    }
</script>
	

<script>
	$(document).ready(function()
	{
		$('#MakeId').change(function(e)
		{
			console.log(e);
			var makeid = e.target.value;
			$.get('/make-models?MakeId=' + makeid, function(data)
			{  //success data
				$('#ModelId').empty();
				$('#ModelId').append('<option value=""> Select Vehicle Make </option>')
				$.each(data, function(index, modelObj)
				{
					$('#ModelId').append('<option value="'+ modelObj.ModelId +'"> '+modelObj.ModelName+' </option>')
				});
			});				
		});
	});
</script> 

<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_case() 
	{
		var str = document.getElementById('LicensePlate').value;
		var cap = str.toUpperCase(); 			document.getElementById('LicensePlate').value = cap;
	}
    
    function convert_vin() 
	{
		var str = document.getElementById('VIN').value;
		var cap = str.toUpperCase(); 			document.getElementById('VIN').value = cap;
	}
</script>



@stop