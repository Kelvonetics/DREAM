<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 

<fieldset>

		
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
			<CAPTION>Leave Details</CAPTION>
				<tr class="box-section">
					<td width="50%">
					<div class="form-group">
						<label for="LeaveStartDate" class="control-label label-left"> <span class="fa fa-calendar"></span> Leave Start Date</label>
						<input type="text" name="LeaveStartDate" id="LeaveStartDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 3%; color:#999" placeholder="MM/DD/YYYY" Required> 
					</div>
					
					<div class="form-group">
						<label for="LeaveType" class="control-label label-left"><span class="fa fa-list"></span> Leave Type</label>
						<select class='sel-opt-left' name='LeaveType' id='LeaveType' required>
						<option value="">Select Leave Type </option>
						@if($leavetype) 
							@foreach ($leavetype as $leavetype)
                                <option value="{{{ $leavetype->LeaveTypeId }}}"> {{ $leavetype->LeaveType }} </option>
                            @endforeach
						@endif
						</select>

					</div>

					<input type="hidden" name="OperatorId" id="OpId" class="form-control" Required>
                    <input type="hidden" name="UserId" id="UserId" class="form-control"@if($opUser)  value="<?= $opUser->UserId ?>"@endif Required>					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">						
												
				  </td>
					<td width="50%"> 
						<div class="form-group">
							<label for="LeaveEndDate" class="control-label label-right"> <span class="fa fa-calendar"></span> Leave End Date</label>
							<input type="text" name="LeaveEndDate" id="LeaveEndDate" class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" Required> 
						</div>
						
						<div class="form-group">
							<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly>
						</div>
	
					</td>
				</tr>				

				<tr class="box-section">
					<td colspan="2"> 							
						<div class="controls"> 
							<label for="LeaveReason" class="control-label" style="margin-left:1%"><span class="fa fa-sticky-note"></span> Leave Reason</label>
							<input type="text" name="LeaveReason" id="LeaveReason" style="border:thin #ede solid;	width:99%;	padding:5px;	border-radius:2px;margin:auto 2% auto 0.5%; color:#999; min-height: 70px;" onkeyup="convert_reason()" Required>
						</div>
					</td>
				</tr>
				
				
				<tr>
					<td colspan="2"> 
						<div class="form-group" style="padding-left:7px">
							<button type="submit" class="btn btn-primary">Add Leave Detail</button>
							<button type="reset" class="btn btn-default">Cancel</button>
						</div>
					</td>
				</tr>
			</table>


</fieldset>




<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_reason() 
	{
		var str = document.getElementById('LeaveReason').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LeaveReason').value = cap;
	}
</script>

<script>
    $(function () {
      
        $('#LeaveEndDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#LeaveStartDate").on("dp.change", function (e) {
            $('#LeaveEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#LeaveEndDate").on("dp.change", function (e) {
            $('#LeaveStartDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>



