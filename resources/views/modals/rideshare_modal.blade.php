
<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>



 
<fieldset id="profiles">
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-10px">
		<CAPTION>Primary Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group"> 
				<label for="AssetId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle </label>
					<select class='sel-opt-left ronly' name='AssetId' id='AssetId' required>
                        <option class="option" value=""> Select Vehicle </option>
						@if($assets) 
						@foreach ($assets as $assets)
							<option value="{{{ $assets->AssetId }}}"> {{ $assets->LicensePlate }} </option>
						@endforeach
						@endif
					</select>	
				</div>
					
				<div class="form-group">
					<label for="DepartureDate" class="control-label label-left"> <i class="fa fa-car" aria-hidden="true"></i> DepartureDate </label>
						<input type="text" class="datepicker" name="DepartureDate" id="DepartureDate" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="MM/DD/YYYY" />	
				</div>

                <div class="form-group">
					<label for="DepartureCity" class="control-label label-left"> <i class="fa fa-globe" aria-hidden="true"></i> Departure City </label>
						<input type="text" class="" name="DepartureCity" id="DepartureCity" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" />	
				</div>

                <div class="form-group">
					<label for="Duration" class="control-label label-left"> <i class="fa fa-hourglass-3" aria-hidden="true"></i> Duration In Hours </label>
						<input type="text" class="" name="Duration" id="Duration" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" />	
				</div>

                <div class="form-group"> 
				<label for="AssetId" class="control-label label-left"> <i class="fa fa-users"></i> No Of Passengers </label>
					<select class='sel-opt-left ronly' name='NoOfPassengers' id='NoOfPassengers' required>
                        <option class="option" value=""> Select Number Of Passengers </option>
                        <option class="option" value="1"> 1 Passengers </option>
                        <option class="option" value="2"> 2 Passengers </option>
                        <option class="option" value="3"> 3 Passengers </option>
                        <option class="option" value="4"> 4 Passengers </option>
                        <option class="option" value="5"> 5 Passengers </option>
                        <option class="option" value="20"> 10 + Passengers </option>
                        <option class="option" value="20"> 20 + Passengers </option>
                        <option class="option" value="30"> 30 + Passengers </option>
                        <option class="option" value="40"> 40 + Passengers </option>
                        <option class="option" value="50"> 50 + Passengers </option>
					</select>	
				</div>
				
			  </td>




				<td width="50%"> 
				
				<div class="form-group">
				  <label for="UserId" class="control-label label-right"> <i class="fa fa-user" aria-hidden="true"></i> Driver </label>
					<select class='sel-opt-right ronly' name='UserId' id='UserId' required>
                        <option class="option"> Select Driver </option>
						@if($operators) 
						@foreach ($operators as $operators)  
                        <?php 
                            $opsId = $operators->UserId; 
                            $drivers = DB::table('users')->where('UserId', '=', $opsId)->first();
                         ?>
						 @if($drivers) 
							<option value="{{{ $drivers->UserId }}}"> {{ $drivers->FirstName.' '.$drivers->LastName }} </option>
						@endif
						@endforeach
						@endif
				 </select>
				</div>
								
				<div class="form-group">
					<label for="DepartureTime" class="control-label label-right"> <i class="fa fa-calendar" aria-hidden="true"></i>  Departure Time</label>
						<input type="text" class="timepicker" name="DepartureTime" id="DepartureTime" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" placeholder="HH : MM" />
				</div>

                <div class="form-group">
					<label for="DestinationCity" class="control-label label-right"> <i class="fa fa-globe" aria-hidden="true"></i>  Destination City</label>
						<input type="text" class="" name="DestinationCity" id="DestinationCity" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" />
				</div>

                <div class="form-group"> <label for="Stoppages" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> Stoppages </label>
						<div class="radio" style="margin-left:25px">
						
							<table width="45%">
							  <tr>
								<td><label class="pull-left">  
								  <input type="radio" name="Stoppages" value="1" id="Stoppages_0" checked />&nbsp;&nbsp;&nbsp; Yes 
								  </label></td>

								<td><label class="pull-right">  
								  <input type="radio" name="Stoppages" value="0" id="Stoppages_1" />&nbsp;&nbsp;&nbsp; No
								  </label></td>
							  </tr>
							</table>
						</div>
					</div>

                    <div class="form-group">
					<label for="Cost" class="control-label label-right"> <i class="fa fa-usd" aria-hidden="true"></i> Cost \ Contribution</label>
						<input type="text" class="" name="Cost" id="Cost" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" />
				</div>

				</td>
			</tr>

			<tr>
				<td>
					<div class="form-group" style="padding:20px 5px">
						<button type="submit" class="btn btn-primary" id="assetUpd">Share Ride</button>
					</div>
				</td>
				<td>
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</td>
			</tr>

		</table>
		
	

	</fieldset>
