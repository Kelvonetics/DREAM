<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<fieldset>
	
		
<table id="example" class="table" cellspacing="1" width="100%" border="0">
	<CAPTION>Certification Details</CAPTION>
		<tr class="box-section">
			<td width="50%">
			<div class="form-group">
				<label for="Category " class="control-label label-left"><span class="fa fa-certificate"></span> Certificate Category</label>
				<select class='sel-opt-left' name='Category' id='Category' required>
				<option value="">Select Certificate Category </option>
				@if($category)
					@foreach ($category as $category)
						<option value="{{{ $category->CategoryId }}}"> {{ $category->Category }} </option>
					@endforeach
				@endif
				</select>
			</div>
			
			<div class="form-group" style="">
				<label for="file" class="control-label label-left" ><i class="fa fa-file" aria-hidden="true"></i> Expense File </label>  
				<input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 3%; color:#999" value="" Required >
			</div>
			
			<input type="hidden" name="OperatorId" id="Operatorid" class="form-control" Required>
			<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">		
										
			</td>
			<td width="50%"> 
				<div class="form-group">
					<label for="CertificateExpiryDate" class="control-label label-right" required> <span class="fa fa-calendar"></span> Expiry Date</label>
					<input type="text" name="CertificateExpiryDate" id="CertificateExpiryDate" class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" Required> 
				</div>
				
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
				
			</td>
		</tr>				

		<tr class="box-section">
			<td colspan="2"> 							
				<div class="controls"> 
					<label for="Description" class="control-label" style="margin-left:1%"><span class="fa fa-pencil"></span> Description</label>
					<input type="text" name="Description" id="Description" style="border:thin #ede solid;	width:99%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0.5%; color:#999; min-height: 70px;" Required>
				</div>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="2"> 
				<div class="form-group" style="padding-left:7px">
					<button type="submit" class="btn btn-primary">Add Certification</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				</div>
			</td>
		</tr>
	</table>

	

</fieldset>

