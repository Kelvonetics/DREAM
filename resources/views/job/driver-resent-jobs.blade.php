@extends('templates.default')

@section('content')


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;"><h1>      <i class="fa fa-gears"></i>  Drivers Ten (10) Resent  Jobs  </h1>  
	
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
		@if($resent_jobs)
            @foreach ($resent_jobs as $resent_jobs)
			<?php   $Job = DB::table('job')->where('JobId', '=', $resent_jobs->JobId)->first();	 ?>
            <tr>
                <td>
					<?php
						$clid = $Job->ClientId;
						$client = DB::table('client')->where('ClientId', '=', $clid)->first();					echo $client->FirstName.' '.$client->LastName;
					?>
				</td>
                <td>{{$Job->Type}}</td>
				<td>{{$resent_jobs->JobStartDateTime}}</td>
				<td>{{$resent_jobs->JobEndDateTime}}</td>
                <td align="left">
                   @if($Job->Status == 'Complete')
						<img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
				   @elseif($Job->Status=='Not Started')
						<img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                   @elseif($Job->Status=='In Progress')
					    <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">         
				   @endif
				</td>
                <td>{{$Job->Street}}</td>
                <td>{{$Job->State}}</td>
				<td>{{$Job->CountryId}}</td>

				<td style="overflow:visible">
					<a href="{{route('job.edit', $resent_jobs->JobId)}}" class="btn btn-primary fa fa-edit" style="font-size:9px; color:#fff"></a>					 
			  </td>

            </tr>
            @endforeach
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