<fieldset>

<table width="100%" border="0" cellspacing="5" cellpadding="10"style="margin:0% 1% 0% 1%">
	<tr>
		<td width="50%">
			<label for="RetireDate" class="control-label" required><i class="fa fa-calendar" aria-hidden="true"></i>    Retirement Date </label>
			<input type="text" name="RetireDate" id="RetireDate" class="datepicker" placeholder="MM-DD-YYYY" Required  style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%"  />
		</td>

		<td width="50%">	<label for="RetireMileage" class="control-label"><i class="fa fa-road" aria-hidden="true"></i>  Retirement Mileage (km)</label>
			<input type="text" name="RetireMileage" id="RetireMileage" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" Required />
		</td>
	</tr>
	
	<tr style="height:10px"> <td> </td> <td> </td> </tr>
	
	<tr>

		<td>	<label for="DisposalMethod" class="control-label"> <i class="fa fa-recycle" aria-hidden="true"></i>  Disposal Method </label>
			<input type="text" name="DisposalMethod" id="DisposalMethod" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" Required />
		</td>

		<td>	<label for="RetireSalePrice" class="control-label"> <i class="fa fa-usd" aria-hidden="true"></i> Sale Price</label>
			<input type="text" name="RetireSalePrice" id="RetireSalePrice" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px;margin:auto 6% auto -1%" Required />
		</td>
	</tr>
	
	<tr style="height:10px"> <td> </td> <td> </td> </tr>
	
	<tr>

		<td>	<label for="RetireReason" class="control-label"> <i class="fa fa-quote-right"></i> Reason </label>
			<select class='sel-opt' name='RetireReason' id='RetireReason' style="margin:auto 2% auto 0%;width:93%" required>
			
				<option value=""> Select Asset Retirement Reason </option>
				@if($retirereason)
				@foreach ($retirereason as $retirereason)
					<option value="{{ $retirereason->Reason }}"> {{ $retirereason->Reason }} </option>
				@endforeach
				@endif
			</select>
		</td>

		<td>	
		<input type="hidden" name="AssetId" id="assetid" class="form-control" value="" readonly>
		<input type="hidden" name="ClientId" id="ClientId" class="form-control" value="{{$id}}" readonly>		
		</td>
	</tr>	

	<tr style="height:10px"> <td> </td> <td> </td> </tr>
	
	<tr>

		<td colspan="2">	<label for="RetireComment" class="control-label"> <i class="fa fa-commenting" aria-hidden="true"></i> Note </label>
			<textarea name="RetireComment" id="RetireComment" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px;margin:auto 2% auto 0%" maxlenght="70" required></textarea>
		</td>

			
		

		
		<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
		
	</tr>
	
	<tr style="height:10px"> <td> </td> <td> </td> </tr>
	
	<tr>
		<td colspan="4" class="pull-left"> 
			<div class="form-group" style="padding:20px 0px;" id="">
				<button type="submit" class="btn btn-primary" id="addRetBtn">Retire Asset</button>
			</div> 
		</td>
	</tr>
	
</table>

</fieldset>