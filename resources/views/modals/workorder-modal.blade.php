<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

	<fieldset>
		   @if($wo_count) <legend>Work Order Number : #0000{{ $wo_count }}</legend> @endif
		  				
				
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Work Order Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
				<div class="form-group">
				<label for="ServiceDate" class="control-label label-left" style="margin-left:4%; color:#666"><i class="fa fa-calendar"></i> Service Start Date</label>
					<input type='text' id='ServiceDate' class="datepicker" name='ServiceDate' placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" maxlenght="10" required/> 	
				</div>
							  
				<div class="form-group">
				  <input type="hidden" name="WorkOrderNumber" id="WorkOrderNumber" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" @if($wo_count) value="{{ $wo_count }}"@endif>

				  <input type="hidden" name="MaintenanceType" id="MaintenanceType" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 4% auto 0%; color:#999" value="Unscheduled" >
				  
				  <input type="hidden" name="AssetId" id="Assetid" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" >
				  
				  <input type="hidden" name="Active" id="Active" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999" value="0" >
				</div>							
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
						<label for="ServiceCompletionDate" class="control-label label-right" style="margin-left:3%; color:#666"><i class="fa fa-calendar"></i> Service Completion Date</label>  
							<input type='text' id='ServiceCompletionDate' name='ServiceCompletionDate' class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999" maxlenght="10" required/> 	
					</div>
								
					<div class="form-group">	  
					  <div class="controls">  					  
						 <input type="hidden" name="WorkOrderStatusId" id="WorkOrderStatusId" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 4% auto 0%; color:#999" value="1" > 
						 <!-- THIS IS FOR Service Reminder WITH VALUE OF 0 BY DEFAULT -->
						 <input type="hidden" name="ServiceReminder" id="ServiceReminder" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 4% auto 0%; color:#999" value="0" >
					</div>							
				</div>
				</td>
			</tr>
			
			<tr class="lead" style="text-align:left;">
				<td><p style="margin-left:-8px"> Vehicle Details </p> </td>
				<td>  </td>
			</tr>
			

			<tr class="box-section">
				<td colspan="2"> 
					<div class="form-group">
						<label for="WorkShopId" class="control-label label-left"  style="margin:auto 2% auto 2%; color:#666"><i class="fa fa-building"></i> Service Workshop</label>
						<select class='sel-opt-full' name='WorkShopId' id='WorkShopId' style="border:thin #ede solid;	width:96%;	padding:7.5px;	border-radius:2px;margin:auto 2% auto 2%; color:#999" required>
						   <option value="">Select WorkShop</option>
						   @if($workshop) 
							@foreach ($workshop as $workshop)
								<option value="{{{ $workshop->WorkShopId }}}"> {{ $workshop->WorkShopName }} </option>
							@endforeach	
							@endif	
						</select>
					</div>
				</td>
			</tr>

		</table>  
	
	
		<table class="table" cellspacing="1" width="101%" border="0" style="">
		<CAPTION>Other Details</CAPTION>
		
		<tr id=""  class="">
			<td width="100%"  class="box-section labour-box" colspan="2"> 
				<div class="form-group labour-box">	  
					<label for="Comment" class="control-label" ><i class="fa fa-pencil"></i> Comment</label>
					<textarea rows="3" name="Comment" id="Comment" onblur="convert_comm()" placeholder="Comment" style="border:thin #ede solid;	width:100%;	padding:5px;	border-radius:2px;margin:auto 0% auto 0%; color:#999"></textarea>	
					
					<input type="hidden" name="OdometerReading" id="OdometerReading" class="form-control" value="000000" readonly >	
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly>
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				</div>				
			</td>
			
		</tr>

		</table>	

	  
		
	  <div class="form-group"  style="margin-left:1px">
		<button type="submit" class="btn btn-primary">Create Work Order</button>
		<button type="reset" class="btn btn-default">Cancel</button>
	  </div>
	</fieldset>
		
					










		
<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_comm() 
	{
		var str = document.getElementById('Comment').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Comment').value = cap;
	}
</script>



<!-- DATE TIME PICKERS --> 
<script type="text/javascript">
	$(function () {
		$('#ServiceDate').datetimepicker();
	});
	
	$(function () {
		$('#ServiceCompletionDate').datetimepicker();
	});

    $(function () {
      
        $('#ServiceCompletionDate').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#ServiceDate").on("dp.change", function (e) {
            $('#ServiceCompletionDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ServiceCompletionDate").on("dp.change", function (e) {
            $('#ServiceDate').data("DateTimePicker").maxDate(e.date);
        });
      
    });
</script>


<script> // retrieving the Schedule Maintenance Id And work shop email
	$(document).ready(function()
	{
		//retrieving the email address of workshop
		$('#WorkShopId').change(function()
		{
			var WorkShopId = $(this).val(); 	document.getElementById('shopemail').value = WorkShopId; //alert(WorkShopId);		
			$.ajax({"fetchshopemail",
				method:"POST",
				data:{shopId:WorkShopId},
				dataType:"text",
				success:function(data)
				{ 
					document.getElementById('shopemail').value = data.trim();					
				}
				
			});	
		});
		
		//retrieving the email address of workshop
		
	});
</script>












