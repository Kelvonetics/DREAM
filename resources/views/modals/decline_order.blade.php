<?php  $auth_user = Auth::user(); ?>

<fieldset>
	<div style="padding:0px 10px"> 
    <div class="form-group">
        <label for="Reason" class="control-label" style="margin-left:10px"> <span class="fa fa-pencil"></span> Reason</label>
        <textarea type="text" name="Reason" id="Reason" class="" style="border:thin #ede solid;	width:98%;	padding:10px 5px;	border-radius:2px;margin:auto 3% auto 1%; color:#999" onkeyup="convert_reas()" Required></textarea>
    </div>

    <?php $wo_id = $workorder->WOId;    $wo_no = $workorder->WorkOrderNumber;  
    $allShopEmail = DB::table('workshopemail')->where('WOId', '=', $wo_id)->where('State', '=', '2')->first();
    ?>

    <div class="form-group">
        <input type="hidden" name="MechanicEmail" id="MechanicEmail"@if($allShopEmail) value="{{$allShopEmail->Email}}"@endif> 
        <!-- vendor -->
        <input type="hidden" name="FleetManagerEmail" id="FleetManagerEmail"@if($allShopEmail) value="{{$allShopEmail->FleetManagerEmail}}"@endif> 
        <!-- for fleet manager -->
    </div>
    

    
    <div class="form-group">
        <input type="hidden" name="ShopEmailId" id="ShopEmailId"
        @if($allShopEmail) value="{{$allShopEmail->ShopEmailId}}"@endif>
        <input type="hidden" name="WorkShopId" id="WorkShopId"
        @if($allShopEmail) value="{{$allShopEmail->WorkShopId}}"@endif>
        <input type="hidden" name="RoleId" id="RoleId" value="{{$auth_user->RoleId}}"> 
        <input type="hidden" name="WOId" id="WOId"
        @if($allShopEmail) value="{{$allShopEmail->WOId}}"@endif> 
        <input type="hidden" name="WorkOrderNumber" id="WorkOrderNumber"
        @if($allShopEmail) value="{{$allShopEmail->WorkOrderNumber}}"@endif>
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 
    </div>
 
    


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="reset" class="btn btn-default">Cancel</button>
        </div>
    </div>

</fieldset>

	


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_reas() 
	{
		var str = document.getElementById('Reason').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Reason').value = cap;
	}
</script>


<script>
	$(document).ready(function()
	{
		{
			document.getElementById(Reason).readOnly = false;      //alert(s_id);
		}
	});
</script>

