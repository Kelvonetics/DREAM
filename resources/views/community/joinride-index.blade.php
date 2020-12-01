@extends('templates.default')

@section('content')



<!-- LOGGED IN USER  --> <?php  $auth_user = Auth::user();  ?> 

<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.pad
{
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
		width:92%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 5%;
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
		color:#666; margin:auto 0% auto 5%;
	}
.label-center
	{
		color:#666; margin:auto 0% auto 2%;
	}
.label-full
	{
		color:#666; margin:auto 0% auto 2%;
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

</style>



<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;"><h1>      <i class="fa fa-taxi"></i>  Ride Join</h1>  
	<p class="lead"> All join ride. </p>	
		
		</div>

	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

    <!-- left content -->
        <div class="col-md-12 col-md-push-0"> 
        <a href="{{route('community.ride-share-index')}}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;font-size:10px"> <i class="fa fa-plus"></i> Join A Ride</a>  
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

    <table id="example" class="table table-full table-full-small job" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th> FirstName </th>
                <th> LastName </th>
				<th> Email </th>
				<th> Phone</th>
				<th> Street </th>
				<th> State </th>
				<th> Seats </th>
                <th> Status </th>
				<th style="" scope="col" class=""></th>
			</tr>
        </thead>
        <tbody>
		@if($joinride)
            @foreach ($joinride as $joinride)
            <tr>
                <td>{{$joinride->FirstName}}</td>
				<td>{{$joinride->LastName}}</td>
				<td>{{$joinride->Email}}</td>
                <td>{{$joinride->Phone}}</td>                
				<td>{{$joinride->Street}}</td>
				<td>{{$joinride->State}}</td>
                <td>{{$joinride->NoOfSeats}}</td>
                <td>                
                    @if($joinride->Status == '0') <span style="color:#FFBF00"> Pending </span>
                    @else if($joinride->Status == '1')  <span style="color:green"> Approved </span>
                    @endif
                </td>
                
				<td style="overflow:visible">
				    <a href="#" class="btn btn-success" style="font-size:11px;color:#fff" title="Approve or Decline">Action</a> 
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

















@stop