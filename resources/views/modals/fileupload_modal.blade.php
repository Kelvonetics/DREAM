<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 
<fieldset>	
	<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>File Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
					<label for="Category" class="control-label label-left"> <i class="fa fa-list-alt" aria-hidden="true"></i> Category</label>
					<select class='sel-opt-left' name='Category' id='Category' required>
					   <option value="">Select File Category</option>
                       @if($photocategory)
					   @foreach ($photocategory as $photocategory)
                          <option value="{{{ $photocategory->PhotoCategoryId }}}"> {{ $photocategory->Category }} </option>
                       @endforeach
					   @endif
					</select>
				</div>
			  </td>
			  
				<td width="50%"> 					
					<div class="form-group">
						<label for="ExpirationDate" class="control-label label-right"> <i class="fa fa-calendar"></i> Expiration Date</label>
						<input type="text" name="ExpirationDate" id="ExpirationDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999" placeholder="File Expiration Date" Required>
					</div>			
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
				</td>
			</tr>
			
			<tr class="box-section" style="text-align:left;">
				<td colspan="2"> 
					<div class="form-group">
						<label for="Description" class="control-label label-full"> <i class="fa fa-sticky-note"></i> Description</label>
						<input type="textarea" name="Description" id="Description" style="border:thin #ede solid;	width:96%;	padding:7.5px;	border-radius:2px;margin:auto 0% auto 2%; color:#999" placeholder="File Upload Description" Required>
					</div>
					
				</td>
			</tr>
			
			<tr class="box-section" style="text-align:left;">
				<td colspan="2"> 
                <div class="form-group" style="">
                    <label for="file" class="control-label label-full" ><i class="fa fa-file" aria-hidden="true"></i> Expense File </label>  
                    <input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px; margin:auto -2% auto 2%; color:#999" value="" Required>
                </div>
					<input type="hidden" name="AssetId" id="Asset_Id" class="form-control">	
					
					<input type="hidden" name="Asset_Id" id="Asset_Id" value="" class="form-control">

					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">	
				</td>
			</tr>
			

			<tr class="box-section">
				<td colspan="2"> 
					<div class="form-group" style="padding:10px 25px">
						<button type="submit" class="btn btn-primary">Upload File</button>
						<button type="reset" class="btn btn-default">Cancel</button>
					</div>
				</td>
			</tr>

		</table>

</fieldset>

	