<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 

<fieldset>		
	
	<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>File Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
					<label for="FuelPurchaseDate" class="control-label" style="margin:auto 0% auto 5%; color:#666" required> <span class="fa fa-calendar"></span> Fuel Purchase Date</label>
					<input type="text" name="FuelPurchaseDate" id="FuelPurchaseDate" class="datepicker" style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 2% auto 5%; color:#999" placeholder="MM/DD/YYYY" Required> 
				</div>

				<div class="form-group">
					<label for="NoLitres" class="control-label" style="margin:auto 0% auto 5%; color:#666" required><i class="fa fa-calculator" aria-hidden="true"></i> Litres (L)</label>
					<input type="number" name="NoLitres" id="NoLitres" style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 2% auto 5%; color:#999" placeholder="Number of Litres (L)" Required> 
				</div>
				
				<div class="form-group">
					<div class="controls">  <label for="FullTank" class="control-label" style="margin:auto 0% auto 5%; color:#666" required><span class="fa fa-tint"></span> Full Tank</label>
					<select class='sel-opt' name='FullTank' id='FullTank' style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 2% auto 5%; color:#999" required>
						<option value=""> Select an Option </option>
						<option value="Yes"> Yes </option>
						<option value="No"> No </option>
				   </select>
				  </div>
				</div>
				
				<div class="form-group">
					<div class="controls"> 
						<input type="hidden" name="MakeId" id="MakeId" class="form-control" value="" Required>
				  </div>
				</div>
				
				
				
				
			  </td>
			  
				<td width="50%"> 						
				<div class="form-group">
					<label for="EqpCurrMileage" class="control-label" style="margin:auto 0% auto 5%; color:#666" required><span class="fa fa-safari"></span> Odometer Reading</label>
					<input type="number" name="EqpCurrMileage" id="EqpCurrMileage" style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 0% auto 5%; color:#999" placeholder="Odometer Reading at Time of Purchase (km)" Required> 
				</div>
				
				<div class="form-group">
					<label for="FuelCost" class="control-label" style="margin:auto 0% auto 5%; color:#666" required><span class="fa fa-usd"></span> Total Cost</label>
					<input type="number" name="FuelCost" id="FuelCost" style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 0% auto 5%; color:#999" placeholder="Cost Of Fuel Purchase" Required> 
				</div>
				
				
				
				
				<div class="form-group">
					<label for="UserId" class="control-label" style="margin:auto 0% auto 5%; color:#666"><i class="fa fa-user"></i> Purchaser Name</label>
					<select class='sel-opt' name='UserId' id='UserId' style="border:thin #ede solid;	width:90%;	padding:5px;	border-radius:2px;margin:auto 0% auto 5%; color:#999" required>
						<option value="">Select a name</option>
						@if($user)
						@foreach ($user as $user)
							<option value="{{{ $user->UserId }}}"> {{ $user->FirstName.' '.$user->LastName  }} </option>
						@endforeach
						@endif
					 </select>
				</div>
				
				<div class="form-group">
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
					<input type="hidden" name="Active" id="Active" class="form-control" value="1" readonly >
                    <input type="hidden" name="AssetId" id="Asset_id" class="form-control" required>
				    <input type="hidden" name="ModelId" id="ModelId" class="form-control" value="" Required>
				
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				</div>
				</td>
			</tr>
			
			
			<tr class="box-section">
			<td colspan="2">
				<div class="form-group">
					<label for="FuelStation" class="control-label" style="margin:auto 0% auto 2%; color:#666" required><span class="fa fa-tint"></span> Fuel Station</label>
					<input type="text" name="FuelStation" id="FuelStation" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px;margin:auto 2% auto 2%; color:#999" placeholder="Fuel Purchased Location" Required onblur="convert_fuel()"> 
				</div>
			</td>
			</tr>
			<tr class="">
				<td colspan="2"> 
					<div class="form-group" style="">
						<button type="submit" class="btn btn-primary">Add Fuel Log</button>
						<button type="reset" class="btn btn-default">Cancel</button>
					</div>
				</td>
			</tr>

		</table>

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