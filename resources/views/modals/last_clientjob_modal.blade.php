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
						$client = DB::table('client')->where('ClientId', '=', $clid)->first();					echo $client->FirstName.' '.$client->LastName;
					?>
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
					<button class="btn btn-primary dropdown-toggle" type="button" id="<?= $jobs->JobId ?>" data-toggle="dropdown" style="font-size:9px">actions
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