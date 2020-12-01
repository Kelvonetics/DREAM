<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 

<fieldset>
	<div class="row" style="margin:-8px 2px">
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
			<CAPTION>Incident Details</CAPTION>
				<tr class="box-section">
					<td width="50%"> 
					<div class="form-group">
						<label for="IncidentDate" class="control-label label-left"> <span class="fa fa-calendar"></span> Date Of Incident</label>
						<input type="text" name="IncidentDate" id="IncidentDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="MM/DD/YYYY" Required> 
					</div>
					
					<div class="form-group">
						<label for="IncidentVehicle" class="control-label label-left"><span class="fa fa-car"></span> Incident Vehicle</label>
						<select class='sel-opt-left' name='IncidentVehicle' id='IncidentVehicle' required>
						<option value="">Select Incident Vehicle </option>
						@if($asset)
							@foreach ($asset as $asset)
								<option value="{{{ $asset->AssetId }}}"> {{ $asset->LicensePlate }} </option>
							@endforeach
						@endif
						</select>
					</div>
					
												
					</td>
					<td width="50%"> 
					
						<div class="form-group">
							<label for="IncidentType" class="control-label label-right"><span class="fa fa-list"></span> Incident Type</label>
							<input type="text" name="IncidentType" id="IncidentType" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" placeholder="Driver Incident Type" Required> 
						</div>

						<div class="form-group" style="">
							<label for="file" class="control-label label-right" ><i class="fa fa-file" aria-hidden="true"></i> Expense File </label>  
							<input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" value="" Required >
						</div>
						
							<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
							<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
					</td>
				</tr>

				<tr class="box-section">
					<td colspan="2"> 							
						<div class="controls"> 
							<label for="Notes" class="control-label" style="margin-left:1%"><span class="fa fa-pencil"></span> Notes</label>
							<textarea name="Notes" id="Notes" style="border:thin #ede solid;	width:99%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0.5%; color:#999; min-height: 70px;" Required></textarea>
						</div>
					</td>
				</tr>
				
				
				<tr>
					<td colspan="2"> 
						<div class="form-group" style="padding-left:7px">
							<button type="submit" class="btn btn-primary">Report Incident</button>
							<button type="reset" class="btn btn-default">Cancel</button>
						</div>
					</td>
					<input type="hidden" name="OperatorId" id="OperatorId" class="form-control">
					
				</tr>
			</table>

	</div>

</fieldset>
	


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_fuel() 
	{
		var str = document.getElementById('FuelStation').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('FuelStation').value = cap;
	}
</script>