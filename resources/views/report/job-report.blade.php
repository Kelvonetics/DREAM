@include('templates.config')
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
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 3%;
	}

.inp
	{
		border:thin #ede solid;
		width:98%;	padding:7.5px;	
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
		color:#666; margin:auto 0% auto 3%;
	}
.label-center
	{
		color:#666; margin:auto 0% auto 2%;
	}
.label-full
	{
		color:#666; margin:auto 0% auto 2%;
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
</style>



{!! Charts::styles() !!}
{!! Charts::scripts() !!}




<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	  <h1>      <i class="md md-sort"></i>   Job Report View  </h1> 
	  	@if(count($errors) > 0)
			@foreach($errors->all() as $errors)
				<div class="alert alert-danger" style="width:75%"> {{ $errors }} </div>
			@endforeach
		@endif

		@if(session('info'))
		<div class="alert" style="background-color:#ACE1AF; width:75%">
			{{session('info')}}
		</div>
		@endif
	</div>

	  
	</div>
	<div class="">
              

<div class="widget-content" id="tabCont">

<ul class="nav nav-tabs card" style="width:75%">
    <li><a class="active" data-toggle="tab" href="#cliented"><span><i class="fa fa-female"></i> Clients </span> </a> </li>  
      <li><a class="" data-toggle="tab" href="#type"><span><i class="md md-extension"></i> Type</span> </a> </li>
	  </li>  
      <li><a class="" data-toggle="tab" href="#status"><span><i class="md md-extension"></i> Status</span> </a> </li>
	  <li><a class="" data-toggle="tab" href="#city"><span><i class="fa fa-globe"></i> City</span> </a> </li> 
      <li><a class="" data-toggle="tab" href="#state"><span><i class="fa fa-globe"></i> State</span> </a> </li>	
</ul>

	<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-95px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<a href="" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="No Of Day(s) To Maintenance"> 
				
                     <i class="fa fa-area-chart">			 </i>    
                     
				</a>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed
			
			
			</h4> </div>
			<div class="well white white-card"> 

			<center> <img src="{{URL::asset('assets/img/job2.png')}}" class="img-responsive" height="150" width="150"> </center>				
				
			</div>  	
			
			
				<!-- quick report div  -->
				<div class="grey-card" style="padding:0px 0px 0px 25px">
				<table class="table" width="105%" cellpadding="0">
					<tr>
						<td style="width:95%"> 
							<h4 class="grey-text m-b-30">   Quick Reports  </h4>
									</td>
						<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
					</tr>
				</table>
				
					<div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
				
					
                  </div>
				</div>
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
					<?php //$this->element('insight'); ?> 
				</div>
				</div>
			
		  </div>

		  
		  
		  
		  
		  
<!-- TAB CONTENT FOR profile BEGIN -->  
<div class="tab-content">

  
  <div id="cliented" class="tab-pane fade in active">
  <div class="widget widget-table action-table">

	<div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    		

		<!-- Main Application (Can be VueJS or other JS framework) -->
		<div class="app">
			<center>
				{!! $client_job_chart->html() !!}
			</center>
		</div>
		{!! $client_job_chart->script() !!}

	</div>

   </div>
  </div>
  
  

  <div id="type" class="tab-pane fade">
  <div class="widget widget-table action-table">

	  
	<!-- left content -->
    <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	<div class="pad">

   <!-- Main Application (Can be VueJS or other JS framework) -->
		<div class="app">
			<center>
				{!! $job_type_chart->html() !!}
			</center>
		</div>
		{!! $job_type_chart->script() !!}

	
	</div>
  </div>

  </div>
  </div>


  <div id="status" class="tab-pane fade">
  <div class="widget widget-table action-table">

	  
	<!-- left content -->
    <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	<div class="pad">

   <!-- Main Application (Can be VueJS or other JS framework) -->
		<div class="app">
			<center>
				{!! $job_status_chart->html() !!}
			</center>
		</div>
		{!! $job_status_chart->script() !!}

	
	</div>
  </div>

  </div>
  </div>



  <div id="city" class="tab-pane fade">
  <div class="widget widget-table action-table">
			
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">    <br> 
	
		<div class="pad">
				 
		<!-- Main Application (Can be VueJS or other JS framework) -->
		<div class="app">
			<center>
				{!! $job_city_chart->html() !!}
			</center>
		</div>
		{!! $job_city_chart->script() !!}


    </div>
	</div>
	
  </div>
  </div>


  <div id="state" class="tab-pane fade">
  <div class="widget widget-table action-table ">
  
			 
			  
	  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

		<div> 
				 
			<!-- Main Application (Can be VueJS or other JS framework) -->
			<div class="app">
						<center>
							{!! $job_state_chart->html() !!}
						</center>
					</div>
					{!! $job_state_chart->script() !!}

			</div>
		  
		  </div>
		  </div>
		  

   
  </div>
  </div>










  </div>
  
  
  </div>
  </div>
  </div>
</section> 

</div>














<script> //get id functions

	function pullId(id)
	{
		$('#Asset_id').val(id);   
    }
    
    function workOrder(id)
	{
		$('#Assetid').val(id);   
    }
    
    function Expensed(id)
	{
		$('#AssetIds').val(id);   
    }
    
    function FileUpload(id)
	{
		$('#Asset_Id').val(id);   
    }
	function AssProfileUpload(id)
	{
		$('#Ass_Id').val(id);   
    }
	
</script>





@stop