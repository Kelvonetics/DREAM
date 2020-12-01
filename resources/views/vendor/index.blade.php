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
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 3%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 4% auto 0%;
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
		color:#666; margin:auto 2% auto 3%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 0%;
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
</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-briefcase"></i>     Vendor </h1> 
    <p class="lead"> The part vendor module  allows you to efficiently manage your entire part vendor. </p>  <br>
	 <a href="{{route('vendor.add')}}" class='btn btn-primary' style='font-size:10px;color:white' title='Create New Vendor For Part'>New Vendor</a>
	   
	</div>
	
	
	<div class="">



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
        <center> <img src="{{URL::asset('assets/img/part5.jpg')}}" class="img-responsive" height="150" width="150"> </center>
            
        </div>  	

            <!-- quick information div  -->
            <div class="grey-card">
            <div style="margin:-10px 15px 0px 10px">
            
            </div>
            </div>
        
      </div>


      <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
				
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


        <table id="example" class="table table-full table-full-small vendor" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th> Vendor Id </th>
                <th> Vendor Category </th>
                <th> Vendor Name </th>
                <th scope="col" class="actions pull-right"></th>
            </tr>
        </thead>
        <tbody>
		@if($vendors)
            @foreach ($vendors as $vendors)
            <tr>
                <td>{{$vendors->VendorId}}</td>
                <td>
					<?php
						$id = $vendors->InvCatId;
						$invcategory = DB::table('invcategory')->where('InvCatId', '=', $id)->first();
					?> @if($invcategory) {{$invcategory->InvName}} @endif
				</td>
                <td>{{$vendors->VendorName}}</td>

                <td class="actions pull-right">					
                <a href="{{route('vendor.edit', $vendors->VendorId)}}" class='btn btn-info fa fa-edit' style='color:white; font-size:9px'></a>	 
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






<script>
	$(document).ready(function()
	{
		$('.vendor').dataTable();
	});
</script>


@stop