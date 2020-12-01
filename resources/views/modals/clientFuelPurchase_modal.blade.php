<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<fieldset>


<table id="example" class="table" cellspacing="1" width="100%" border="0">
<CAPTION>Expense Details</CAPTION>
    <tr class="box-section">
        <td width="50%"> 
            <div class="form-group">
                <label for="FuelPurchaseDate" class="control-label label-left" ><i class="fa fa-calendar" aria-hidden="true"></i> Fuel Purchase Date</label>
                <input type="text" name="FuelPurchaseDate" id="FuelPurchaseDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" placeholder="MM/DD/YYYY" Required>
            </div>
            
            <div class="form-group">
                <label for="EqpCurrMileage" class="control-label label-left" ><i class="fa fa-ordometer" aria-hidden="true"></i> Current Mileage</label>
                <input type="text" name="EqpCurrMileage" id="EqpCurrMileage" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="" Required>
            </div>
            
            <div class="form-group">
                <label for="FuelCost" class="control-label label-left" ><i class="fa fa-usd" aria-hidden="true"></i> Fuel Cost</label>
                <input type="text" name="FuelCost" id="FuelCost" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" Required>
            </div>
        <input type="hidden" name="AssetId" id="Asset_Ids" class="form-control">
       </td>
      
        <td width="50%"> 
            <div class="form-group">
                <label for="FuelStation" class="control-label label-right" ><i class="fa fa-tint" aria-hidden="true"></i> Fuel Station</label>
                <input type="text" name="FuelStation" id="FuelStation" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" Required onblur="convert_desc()">
            </div>
                        
            <div class="form-group">
                <label for="NoLitres" class="control-label label-right" ><i class="fa fa-tint" aria-hidden="true"></i> No Of Litres</label>
                <input type="text" name="NoLitres" id="NoLitres" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" Required onblur="convert_desc()">
            </div>
            
            <div class="form-group">
            <label for="FullTank" class="control-label label-right" ><i class="fa fa-tint" aria-hidden="list-alt"></i> Is Full Tank ?</label>
                <select class='sel-opt-left' name='FullTank' id='FullTank' required>
                    <option class="option" value=""> Select</option>
                    <option class="option" value="Yes"> Yes</option>
                    <option class="option" value="No"> No</option>
                </select>
            </div>
            
            <div class="form-group"> 
            <label for="UserId" class="control-label label-right"> <i class="fa fa-user"></i> Purchaser </label>
                <select class='sel-opt-left ronly' name='UserId' id='UserId' required>
                    <option class="option" value=""> Select Vehicle Make </option>
                    @if($User)
                    @foreach ($User as $User)
                        <option value="{{{ $User->UserId }}}"> {{ $User->FirstName.' '.$User->LastName }} </option>
                    @endforeach
                    @endif
                </select>	
            </div>
            <input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" 
            value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
            <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
        </td>
    </tr>
    
    <tr class="lead" style="text-align:left;">
        <td> </td>
        <td>  </td>
    </tr>
    

    <tr class="box-section">
        <td colspan="2"> 
            <div class="form-group">
                    <button type="submit" class="btn btn-primary">Log Fuel</button>
                    <button type="reset" class="btn btn-default">Cancel</button>						
            </div>
        </td>
    </tr>

</table>

</fieldset>
	




<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
function convert_cate() 
{
var str = document.getElementById('Category').value;
var splitStr = str.toLowerCase().split(' ');
for (var i = 0; i < splitStr.length; i++) 
{ 
   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
}
// Directly return the joined string
var cap = splitStr.join(' '); 			document.getElementById('Category').value = cap;
}

function convert_desc() 
{
var str = document.getElementById('Description').value;
var splitStr = str.toLowerCase().split(' ');
for (var i = 0; i < splitStr.length; i++) 
{ 
   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
}
// Directly return the joined string
var cap = splitStr.join(' '); 			document.getElementById('Description').value = cap;
}

function convert_supp() 
{
var str = document.getElementById('Supplier').value;
var splitStr = str.toLowerCase().split(' ');
for (var i = 0; i < splitStr.length; i++) 
{ 
   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
}
// Directly return the joined string
var cap = splitStr.join(' '); 			document.getElementById('Supplier').value = cap;
}
</script>	

