<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<fieldset>	
	<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>File Details</CAPTION>
			
			<tr class="lead" style="text-align:left;">
				<td colspan="2"> 
                <div class="form-group" style="">
                    <label for="file" class="control-label" style="margin:auto 2% auto 0.5%;"><i class="fa fa-file" aria-hidden="true"></i> Profile Photo </label>  
                    <input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:99%;	padding:5px;	border-radius:4px; margin:auto 2% auto 0%; color:#999" value="" Required >
                </div>
					<input type="hidden" name="UserId" id="UserId" value="{{$id}}" class="form-control">				
				</td>
			</tr>
			<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
			<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">

			<tr class="">
				<td colspan="2"> 
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Upload File</button>
						<button type="reset" class="btn btn-default">Cancel</button>
					</div>
				</td>
			</tr>

		</table>

</fieldset>
