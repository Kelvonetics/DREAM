@extends('templates.default')

@section('content')


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;"><h1>      <i class="fa fa-gears"></i>  Client Jobs  </h1>  
	<p class="lead"> The job module  allows you to efficiently manage your entire job. With real-time visibility into job  <br>
	performance and powerful analytics, it’s easier to ultimately maximize your return on assets (ROA). </p>
		
			
		
		</div>

	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

    <!-- left content -->
        <div class="col-md-12 col-md-push-0"> 
        <a href="{{ route('job.add') }}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63;font-size:10px"> <i class="fa fa-plus"></i>  New jOB</a>  
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
				<th> Id</th>
				<th> Client </th>
				<th> Job Type </th>
				<th> Start Date </th>
				<th> End Date </th>
				<th> Status </th>
				<th> Address </th>
				<th> State </th>
				<th> Country </th>
				<th style="" scope="col" class="action"></th>
			</tr>
        </thead>
        <tbody>
		@if($jobs)
            @foreach ($jobs as $jobs)
            <tr>
				<td>{{$jobs->JobId}}</td>
                <td>
					<?php
						$clid = $jobs->ClientId;
						$client = DB::table('client')->where('ClientId', '=', $clid)->first();
					?> @if($client) {{$client->FirstName.' '.$client->LastName}} @endif
				</td>
                <td>{{$jobs->Type}}</td>
				<td>{{$jobs->ScheduleStartDate}}</td>
				<td>{{$jobs->ScheduleEndDate}}</td>
                <td align="left">
                   @if($jobs->Status == 'Complete')
						<img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
				   @elseif($jobs->Status=='Not Started')
						<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                   @elseif($jobs->Status=='In Progress')
					    <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">         
				   @endif
				</td>
                <td>{{$jobs->Street}}</td>
                <td>{{$jobs->State}}</td>
				<td>{{$jobs->CountryId}}</td>

				<td style="overflow:visible">
				<div class="dropdown" style="">
					<button class="btn btn-primary dropdown-toggle" type="button"@if($jobs) id="<?= $jobs->JobId ?>"@endif data-toggle="dropdown" style="font-size:9px">actions
					<span class="caret"></span></button>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
					  <li>
					  <a href="{{route('job.edit', $jobs->JobId)}}" role="" style="font-size:11px">View Profile</a>
					  </li>
					  <li><a onclick="vehicleHist({{$jobs->JobId}})" role="menuitem" id="" data-toggle="modal" data-target="#vhistModal" style="font-size:11px">View Vehicle History</a></li>
					  <li><a onclick="uploadFile({{$jobs->JobId}})" role="menuitem"  name="index" data-toggle="modal" data-target="#fileModal" style="font-size:11px">Upload Job Files</a></li>
					  
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


	<?php  //$this->element('vehicleHistory_modal');?> 	
							



<!-- client work order Modal -->						

		<?php //  $this->element('jobfile_modal');?> 


























<script>
	$(document).ready(function()
	{
		$('.job').dataTable();
	});
</script>	

<script>
     $(document).ready(function() {
      $('.progress .progress-bar').css("width",
                function() {
                    return $(this).attr("aria-valuenow") + "%";
                }
        )
    });
 </script>




@stop