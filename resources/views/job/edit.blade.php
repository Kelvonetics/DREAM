@extends('templates.default')

@section('content')



<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
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
.sel-opt-full
	{
		border:thin #ede solid;
		width:100%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto -1%;
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
		color:#666; margin:auto 2%;
	}
.label-left
	{
		color:#666; margin:auto 2% auto 4%;
	}
.label-right
	{
		color:#666; margin:auto 0% auto 3%;
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
		margin:-15px -12px 0px 6px;
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


<?php 
	$c_id = $job->ClientId;
	$client_details = DB::table('client')->where('ClientId', '=', $c_id)->first(); 
?>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
	<section class="forms-basic">
	<div class="page-header">
	
		<h1>      <i class="fa fa-gears"></i>  Client Job Management  </h1> <br>
		
	</div>

              
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
          
      <center> <img src="{{URL::asset('assets/img/job2.png')}}" class="img-responsive" height="150" width="150"> </center>
          
      </div>  	
      
      
          <!-- quick report div  -->
          <div class="grey-card" style="padding:0px 0px 0px 25px">
          <table class="table" width="105%" cellpadding="0">
              <tr>
                  <td style="width:95%"> 
                      <h4 class="grey-text m-b-30">   Quick Reports  </h4>
                              </td>
                  <td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
              </tr>
          </table>
          
              <div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
              
              <div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Add New Client Job'>+</a></div>
                <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Jobs </a></div>
              </div>

              </div>
          </div>
          

          <!-- quick information div  -->
          <div class="grey-card">
          <div style="margin:-10px 15px 0px 10px">
              <?php  //$this->element('asset_insight');?> 
          </div>
          </div>
      
    </div>
			  
			  
	<!-- left content -->
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
		<div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
		<div>

	    <form class="form-horizontal" method="post" action="{{ url('/job/update', array($job->JobId)) }}">
		<fieldset>
		  @if($job)
		  <legend>Job Number : #0000 {{$job->JobId}}  </legend>
		  @endif 
		   <div class="big-text" style="margin:0px 0px 40px -15px">
				<div class="col-md-11 big-text">@if($job) <?= 'Start : '.$job->ScheduleStartDate.' '.' End : '.$job->ScheduleEndDate; ?> @endif  
			    </div>
				
				
				<div class="col-md-11 big-text"> 
					<?php 
						$cl_id = $job->ClientId;
						$client = DB::table('client')->where('ClientId', '=', $cl_id)->first();	
					  ?>
					  @if($client) {{$client->FirstName.' '.$client->LastName}} @endif  
			    </div>
				<div class="col-md-11 big-text">@if($job) <?= $job->Street; ?> @endif	    </div>
				<div class="col-md-11 big-text">@if($job) <?= $job->City.', '.' '. $job->State; ?> @endif </div>
				<div class="col-md-11 big-text"> 
                <?php 
					$ctyid = $job->CountryId;
					$Country = DB::table('country')->where('CountryName', '=', $ctyid)->first();
				?>
				@if($Country) {{$Country->CountryName}} @endif 
				</div>
		   </div>
				
				
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="">
		<CAPTION>Job Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 

				<input type='hidden' id='JID' name='JID'value="<?= $job->JobId; ?>"/>
					<input type='hidden' id='ScheduleStartDate' class="datepicker" name='ScheduleStartDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 2% auto 4%; color:#999" maxlenght="10"@if($job)
					value="{{$job->ScheduleStartDate}}"@endif readonly /> 	
					
				<div class="form-group">
				<label for="ActualStartDate" class="control-label label-left"><i class="fa fa-calendar"></i> Actual Start Date </label>
					<input type='text' id='ActualStartDate' class="datepicker" name='ActualStartDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 2% auto 4%; color:#999"@if($job) value="{{$job->ActualStartDate}}"@endif maxlenght="10"/>
				</div>
							  
				<div class="form-group">
				  <label for="Type" class="control-label label-left"><i class="fa fa-cogs"></i> Job Type * </label>
					 <select class='sel-opt-left' name='Type' id='Type' required>
					 @if($job)
					 <option value="{{{ $job->Type }}}"> {{ $job->Type }} </option>
                     @endif   

					 @if($jobtypes)
                        @foreach ($jobtypes as $jobtypes)
                            <option value="{{{ $jobtypes->JobType }}}"> {{ $jobtypes->JobType }} </option>
                        @endforeach
					@endif
					</select>
				</div>							
			  </td>
				<td width="50%"> 

					<input type='hidden' id='ScheduleEndDate' name='ScheduleEndDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 0% auto 3%; color:#999" maxlenght="10"@if($job) value="{{$job->ScheduleStartDate}}"@endif readonly /> 	

					<div class="form-group">
						<label for="ActualEndDate" class="control-label label-right"><i class="fa fa-calendar"></i> Actual End Date  </label>
						<input type='text' id='ActualEndDate' class="datepicker" name='ActualEndDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 0% auto 3%; color:#999"@if($job) value="{{$job->ActualEndDate}}"@endif maxlenght="10"/></div>
								
					<div class="form-group">	  
					  <div class="controls">
					  <label for="Status" class="control-label label-right"><i class="fa fa-book"></i> Job Status * </label>  
						 <select class='sel-opt-right' name='Status' id='Status' required>
						 @if($job)
						 <option value="{{{ $job->Status }}}"> {{ $job->Status }} </option>
						 @endif
                        
						 @if($jobstatus)
                            @foreach ($jobstatus as $jobstatus)
                                <option value="{{{ $jobstatus->JobStatus }}}"> {{ $jobstatus->JobStatus }} </option>
                            @endforeach
						@endif
						</select>
					</div>							
				</div>
				</td>
			</tr>
			
			<tr class="box-section">
				<td width="100%" colspan="2"> 
				<div class="form-group">
				<label for="Description" class="control-label"><i class="fa fa-commenting"></i> Note * </label>
					<textarea rows="3" name="Description" id="Description" onkeyup="convert_desc()" placeholder="Notes" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px; margin:auto 1% auto 2%; color:#999" required>@if($job){{ $job->Description }}@endif</textarea>	
				</div>							
			  </td>
			</tr>
			
			<tr>
				<td>  </td>
				<td>  </td>
			</tr>
		</table> 
		
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Client Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">	  
				  <label for="ClientId" class="control-label label-left"><i class="fa fa-female"></i> Client</label>
				<select class='sel-opt-left' name='ClientId' id='ClientId' required>
				@if($client)
				<option class='option' value="{{$client->ClientId}}">{{$client->FirstName.' '.$client->LastName}}</option>
				@endif							
				</select>
				</div>
				
				<div class="form-group col-md-12" style="margin-left:-15px">	  
					<label for="Active"> <i class="fa fa-toggle-on"></i> Client Address Info  </label>
					<div class="radio" style="margin-left:25px">
						<div class="col-md-6">
							<input type="radio" name="Active" value="1" id="Active_0" class="added" checked />&nbsp; Existing Address 
						</div>

						<div class="col-md-6">
							<input type="radio" name="Active" value="0" id="Active_1" class="add" />&nbsp; Other Address   
						</div>
					</div>
				</div>
				
				</td>
				<td width="50%"> 
					<div class="form-group">
						<label for="ContactPerson" class="control-label label-right"><i class="fa fa-user"></i> Contact Person * </label>  
						<input type="text" name="ContactPerson" id="ContactPerson" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 0% auto 3%; color:#999"@if($job) value="{{$job->ContactPerson}}"@endif required> 
					</div>
				</td>
			</tr>
			
			
			<tr class="box-section">				
				<td width="102%" colspan="2">
					<div class="form-group" id="address">	  
					    <label for="Street" class="control-label" style=""><i class="fa fa-map-marker"></i> Address</label>
						<input type="text" name="Street" id="Street" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px; margin:auto 1% auto 2%; color:#999"@if($client_details) value="{{$client_details->Address}}"@endif Required onkeyup="convert_stre()">
					</div>
				</td>
            </tr>

            <tr class="box-section">				
				<td width="50%">	
					
					<div class="form-group" id="citys">	  
					   <label for="City" class="control-label label-left" required><i class="fa fa-map-marker"></i> City</label>
						<input type="text" name="City" id="City" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 2% auto 4%; color:#999"@if($client_details) value="{{$client_details->City}}"@endif Required >
					</div>

                	<div class="form-group">
						<label for="CountryId" class="control-label label-left" required><i class="fa fa-globe"></i> Country</label>
							<!-- Country dropdown list by Kelvin -->
						<select class="sel-opt-left" name="CountryId" id="CountryId" required style="">
						@if($client_details)
						<option value="{{{ $client_details->Country }}}"> {{ $client_details->Country }} </option>
						@endif
                        
						@if($countrys)
                            @foreach ($countrys as $countrys)
                                <option value="{{{ $countrys->CountryName }}}"> {{ $countrys->CountryName }} </option>
                            @endforeach
						@endif
						</select> 

					</div>						
				</td>
            				
				<td width="50%">

                <div class="form-group" id="states">	  
						<label for="State" class="control-label label-right" required><i class="fa fa-map-marker"></i> State</label>
						<input type="text" name="State" id="State" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 0% auto 3%; color:#999" Required onkeyup="convert_state()"@if($client_details) value="{{$client_details->State}}"@endif>
					</div>
					
					<div class="form-group" id="phones">
						<label for="Phone" class="control-label label-right" required><i class="fa fa-phone"></i> Phone</label>
						<input type="text" name="Phone" id="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 0% auto 3%; color:#999"@if($client_details) value="{{ $client_details->Phone }}"@endif Required>
					</div>
				</td>
			</tr>
			

			
			<tr>
				<td> 
					<div class="form-group">
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$job->CreatedBy}}" readonly > 
                        
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
					</div>
				</td>
				<td>  </td>
			</tr>
		</table>  
				
		
						
		<div class="form-group" style="margin-left:2px">
		<button type="submit" class="btn btn-primary" id="updJobBtn">Update Client Job</button>
		<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
	
	</form>
	</div>
            
           
              
	</div>
	</section>
</div>
 
<script>
	$(document).ready( function () 
	{
		
		//alert(clids);
		//on load to load city state street country and phone
			var ClientId = $('#ClientId').val();
				$.ajax({
					url:"loadClientDetails",
					method:"POST",
					data:{clientId:ClientId},
					dataType:"text",
					success:function(data)
					{
						$('#Streets').hide();
						$('#address').html(data);  
					}
				});
				
				$.ajax({
					url:"loadClientDetails",
					method:"POST",
					data:{clientId:ClientId},
					dataType:"text",
					success:function(data)
					{
						$('#Citys').hide();
						$('#city').html(data);  
					}
				});
				
				var ClientId = $(this).val();
				$.ajax({
					url:"loadClientDetails",
					method:"POST",
					data:{clientId:ClientId},
					dataType:"text",
					success:function(data)
					{
						$('#States').hide();
						$('#state').html(data);  
					}
				});

				var ClientId = $(this).val();
				$.ajax({
					url:"loadClientDetails",
					method:"POST",
					data:{clientId:ClientId},
					dataType:"text",
					success:function(data)
					{
						$('#Phones').hide();
						$('#phone').html(data);  
					}
				});
				
				/*var ClientId = $(this).val();
				$.ajax({
					url:"loadcountry",
					method:"POST",
					data:{clientId:ClientId},
					dataType:"text",
					success:function(data)
					{
						$('#CountryId').html(data);  
					}
				});
				*/

	});
</script>

<script>	  //AJAX FUNCTION TO UPDATE JOB

$(document).ready(function()
	{
		$("#updJobBtn").click(function(e)
		{
            var r = confirm("Are You Sure You Want To Make Changes To Job Profile # {0}?");
			if (r == true) 
			{
                var _url_id = "{{$job->JobId}}";
                var JobNumber = $("#JobNumber").val();
                var Type = $("#Type").val();
                var Status = $("#Status").val();
                var Description = $("#Description").val();
                var ScheduleStartDate = $("#ScheduleStartDate").val();
                var ScheduleEndDate = $("#ScheduleEndDate").val();
                var ClientId = $("#ClientId").val();
                var CountryId = $("#CountryId").val();
                var State = $("#State").val();
                var City = $("#City").val();
                var Street = $("#Street").val();
                var JobNotesId = $("#JobNotesId").val();
                var CreatedBy = $("#CreatedBy").val();
                var created = date("Y-M-d");
                var updated_at = date("Y-m-d");
                var _token = $("#_token").val();
                // Returns successful data submission message when the entered information is stored in database.
                var jobdata = 'JobNumber='+ JobNumber + '&Type='+ Type + '&Description='+ Description + '&Status='+ Status + '&ScheduleStartDate='+ ScheduleStartDate + '&ScheduleEndDate='+ ScheduleEndDate + '&ClientId='+ ClientId + '&CountryId='+ CountryId + '&State='+ State + '&City='+ City + '&Street='+ Street + '&JobNotesId='+ JobNotesId + '&CreatedBy='+ CreatedBy + '&created='+ created + '&updated_at='+ updated_at + '&_token='+ _token;

                e.preventDefault();
                // AJAX Code To Submit Form.
                $.ajax(
                {
                    type: "POST",
                    url:"/job/update/"+_url_id,
                    data: jobdata,
                    cache: false,
                    success: function()
                    {
                        alert('Job Updated Successful !');	
                    }
                });
            }
            else 
			{
				e.preventDefault();
			}
		
		});
		return false;
	});
</script>


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_desc() 
	{
		var str = document.getElementById('Description').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Description').value = cap;
	}
	
	function convert_state() 
	{
		var str = document.getElementById('State').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('State').value = cap;
	}
	
	function convert_city() 
	{
		var str = document.getElementById('City').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('City').value = cap;
	}
	
	function convert_lga() 
	{
		var str = document.getElementById('LGA').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LGA').value = cap;
	}
	
	function convert_stre() 
	{
		var str = document.getElementById('Street').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Street').value = cap;
	}
</script>

<!-- DATE TIME PICKERS --> 
<script>
	$(function () {
		$('#ServiceDate').datetimepicker();
	});
	
	$(function () {
		$('#ServiceCompletionDate').datetimepicker();
	});

    $(function () {
      
        $('#ScheduleEndDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ScheduleStartDate").on("dp.change", function (e) {
            $('#ScheduleEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ScheduleEndDate").on("dp.change", function (e) {
            $('#ScheduleStartDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
	
	$(function () {
      
        $('#ActualEndDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ActualStartDate").on("dp.change", function (e) {
            $('#ActualEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ActualEndDate").on("dp.change", function (e) {
            $('#ActualStartDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>

<!-- SCRIPT TO RETREIVE CLIENT DETAILS -->
<script>
	$(document).ready(function()
	{          	
		$('#ClientId').change(function()
		{
			var CId = $(this).val();    //alert('Cient ' + CId);
            $.get('{{('loadClientDetails')}}?ClientId=' + CId, function(data)
            {  //success data
                data = data[0].Address; //alert('Cient Addr ' + data);
                $('#Street').val(data);  
            });

            $.get('{{url('loadClientDetails')}}?ClientId=' + CId, function(data)
            {  //success data
                data = data[0].City;
                $('#City').val(data);  
            });

            $.get('{{url('loadClientDetails')}}?ClientId=' + CId, function(data)
            {  //success data
                data = data[0].State;
                $('#State').val(data);  
            });

            $.get('{{url('loadClientDetails')}}?ClientId=' + CId, function(data)
            {  //success data
                data = data[0].Phone;
                $('#Phone').val(data);  
            });
			
            $.get('{{url('loadClientDetails')}}?ClientId=' + CId, function(data) 
            {
            	$('#CountryId').empty();
                $.each(data, function(index, countryObj)
                {                     
                    $('#CountryId').append('<option value="'+ countryObj.Country +'"> '+countryObj.Country+' </option>')
                });
            });           
            

		});

		
		
	});
</script>

<script>
	$(document).ready(function()
	{	
		$('.add').on('change', function()
		{ 
		   if(this.checked) // if changed state is "CHECKED"
			{//alert();
				var str = document.getElementById('Street').value;   			document.getElementById('Street').value = '';
				var cit = document.getElementById('City').value;  				document.getElementById('City').value = ''; 
				var sta = document.getElementById('State').value;  				document.getElementById('State').value = ''; 
				var pho = document.getElementById('Phone').value; 				document.getElementById('Phone').value = ''; 
				//var cou = $('#CountryId').val();	$('#CountryId').val([]);
                $('#CountryId').empty();
			}
		});

	});
	
	$(document).ready(function()
	{		
		$('#Active_0').click(function()
		{ 
			$('#ClientId').val([]);
			document.getElementById('ClientId').focus();

		});
	});
</script>




@stop