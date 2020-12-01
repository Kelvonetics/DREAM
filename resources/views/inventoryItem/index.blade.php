@extends('templates.default')

@section('content')


<style>
	.in-stock
	{
		color:#306;
	}
	.limited
	{
		color:amber
	}
	.out-stock
	{
		color:red;
	}
</style>


<div class="main-content" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;">
	<h1>      <i class="fa fa-briefcase"></i>    Inventory Item </h1> 
	<p class="lead"> The inventory item module  allows you to efficiently manage your entire inventory. </p>
	 </div>
	
	
	<div class="">
	  
	<div class="row  m-b-40">
	
	<!-- left content -->
	  <div class="col-md-12 col-md-pull-0"> 
		<a href="{{route('inventoryItem.add')}}" title = 'Create New Inventory Item' class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;" data-tooltip="true"> <i class="fa fa-plus"></i> New Inventory</a>
		<div class="well white">

		@if(session('info'))
			<div class="alert" style="background-color:#ACE1AF">
				{{session('info')}}
			</div>
		@endif

    <table id="example" class="table table-full table-full-small item" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th> Item Name</th>
				<th> Serial No </th>
				<th>  Cost </th>
				<th> Category </th>
				<th> Manufacturer </th>
				<th> Quantity </th>
				<th ></th>
			</tr>
        </thead>
        <tbody>
		@if($inventoryitems) 
            @foreach ($inventoryitems as $inventoryitems)
            <tr>
				<td>{{$inventoryitems->InvItemName}}</td>
				<td>{{$inventoryitems->SerialNo}}</td>
				<td><?= '$' ?>{{$inventoryitems->Cost}} </td>
				<td>
				<?php
					$id = $inventoryitems->InvCatId;
					$invcategory = DB::table('invcategory')->where('InvCatId', '=', $id)->first();
				?> @if($invcategory) {{$invcategory->InvName}} @endif
			</td>
			<td>
				<?php			
					$id = $inventoryitems->VendorId;
					$vendor = DB::table('vendor')->where('VendorId', '=', $id)->first();
				?> @if($vendor) {{$vendor->VendorName}} @endif
			</td>
				<td>
					<?php  $qty = $inventoryitems->Quantity;         $instock = "5";	    $limited = "1";     $outofstock = "0";  ?>						
                    @if($qty > $instock)                                <i style="color:#3EB489;"> In Stock </i>
                    @elseif($qty >= $limited && $qty <= $instock)      <i style="color:#FFBF00;"> Limited Stock </i> 
                    @elseif($qty <= $outofstock)                       <i style="color:#E30022;"> Out Of Stock </i> 
                    @else
                    @endif
				</td>

				<td class="">
                    <a href="{{route('inventoryItem.edit', $inventoryitems->InvId)}}" class="btn btn-primary fa fa-edit" style="color:#fff; font-size:9px" data-tooltip='true' title='Manage'> </a>	
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
		$('.item').dataTable();
	});
</script>


@stop