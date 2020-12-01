<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>
<fieldset>
	<table id="example" class="table" cellspacing="1" width="100%" border="0">
	<CAPTION>Primary Details</CAPTION>
		<tr class="box-section">
			<td width="50%"> 
			<div class="form-group">	  
					<div class="controls">
					<label for="MakeId" class="control-label label-left" style="margin-left:"> <i class="fa fa-car"></i> Vehicle Make</label>
					<select class='sel-opt-left' name='MakeId' id='MakeId' style="border:thin #ede solid;	width:93%;	padding:7.5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required>
						<option class="option" value=""> Select Vehicle Make </option>
						@if($assetmakes)
						@foreach ($assetmakes as $assetmakes)
							<option value="{{{ $assetmakes->MakeId }}}"> {{ $assetmakes->Make }} </option>
						@endforeach
						@endif
					</select>
					</div>							
			</div>
			
			
			
			<div class="form-group">
				<label for="LicensePlate" class="control-label label-left" style="" required> <i class="fa fa-car"></i> License Plate</label>
				<input type="text" name="LicensePlate" id="LicensePlate" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required onkeyup="convert_case()">
			</div>
										
			</td>
			<td width="50%"> 
			
				<div class="form-group">
					<div class="controls">  <label for="ModelId" class="control-label label-right" style="margin-left:3%;" required> <i class="fa fa-car"></i> Vehicle Model</label>
						<select class='sel-opt-right' name='ModelId' id='ModelId' style="border:thin #ede solid;	width:93%;	padding:7.5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" required>
							<option class="option" value=""> Select A Make First </option>
						</select>
					</div>
				</div>
							
				<div class="form-group">
					<label for="VIN" class="control-label label-right" style="margin-left:3%;" required> <i class="fa fa-car"></i> Vehicle Identification No</label>
					<input type="text" name="VIN" id="VIN" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"  Required onkeyup="convert_vin()">
				</div>
				
				<div class="form-group">
				
				</div>
				
			</td>
		</tr>

		
		<tr class="lead" style="text-align:left; margin-left:-15px">
			<td colspan="2"> Secondary Details </td>
		</tr>
		

		<tr class="box-section">
			<td> 
				<div class="form-group">
				<label for="EqpYear" class="control-label label-left" style="" required> <i class="fa fa-calendar"></i> Vehicle Year</label>
				<input type="text" name="EqpYear" id="EqpYear" placeholder="YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px; margin:auto 1% auto 4%; color:#999" maxlength="4" Required>
			</div>
				<div class="form-group">    <label for="AssetTypeId" class="control-label label-left" style="" required> <i class="fa fa-car"></i> Vehicle Body Type</label>
				<select class='sel-opt-left' name='AssetTypeId' id='AssetTypeId' style="border:thin #ede solid;	width:93%;	padding:7.5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required>
					<option value="">Select Vehicle Body  Type </option>
					@if($assettypes)					
					@foreach ($assettypes as $assettypes)
						<option value="{{{ $assettypes->AssetTypeId }}}"> {{ $assettypes->AssetTypeName }} </option>
					@endforeach
					@endif
				</select>
				</div>
				
				
			</td>
			<td> 
				<div class="form-group">    <label for="FuelTypeId" class="control-label label-right" style="margin-left:3%;" > <i class="fa fa-tint"></i> Fuel Type</label>
				<select class='sel-opt-right' name='FuelTypeId' id='FuelTypeId' style="border:thin #ede solid;	width:93%;	padding:7.5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" required>
					<option value="">Select FuelType </option>
					@if($fueltypes)					
					@foreach ($fueltypes as $fueltypes)
						<option value="{{{ $fueltypes->FuelTypeId }}}"> {{ $fueltypes->FuelType }} </option>
					@endforeach
					@endif
					</select>
				</div>
				<div class="form-group">    <label for="Color" class="control-label label-right" style="margin-left:3%;"> <i class="fa fa-toggle-on"></i> Color</label>
				<select class='sel-opt-right' name='Color' id='Color' style="border:thin #ede solid;	width:93%;	padding:7.5px;	border-radius:4px;margin:auto 0% auto 3%; color:#999" required>
					<option value="">Select Asset Color </option>
					@if($colors)
					@foreach ($colors as $colors)
						<option value="{{{ $colors->Color }}}"> {{ $colors->Color }} </option>
					@endforeach
					@endif
					</select>
				</div>
			</td>
		</tr>
		
		<tr>
			<td> 
				<input type="text" name="ClientId" id="Clientid" value="" class="form-control" readonly >

				
			</td>
			<td> 
				
			</td>
		</tr>
		
		<tr>
			<td> 
				<div class="form-group" style="margin-left:2px">
					<button type="submit" class="btn btn-primary">Create Asset</button>
					<button type="reset" class="btn btn-default">Cancel</button>
					</div>
			</td>
			<td> 
				<div class="form-group">
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >

					<input type="hidden" name="Active" id="Active" class="form-control" value="1" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</div>
			</td>
		</tr>
	</table> 

			
</fieldset>
		
	
	