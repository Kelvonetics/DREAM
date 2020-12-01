<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<fieldset>


<table id="example" class="table" cellspacing="1" width="100%" border="0">
<CAPTION>Expense Details</CAPTION>
    <tr class="box-section">
        <td width="50%"> 
        <div class="form-group">
          <label for="ExpenseType" class="control-label label-left" ><i class="fa fa-list" aria-hidden="list-alt"></i> Expense Type</label>
            <select class='sel-opt-left' name='ExpenseType' id='ExpenseType' required>
                <option class="option" value=""> Select Expense Type</option>
                @if($expensetypes)
                @foreach ($expensetypes as $expensetypes)
                    <option value="{{{ $expensetypes->Type }}}"> {{ $expensetypes->Type }} </option>
                @endforeach
                @endif
            </select>
         </div>
            
        <div class="form-group">
            <label for="Amount" class="control-label label-left" ><i class="fa fa-usd" aria-hidden="true"></i> Expense Amount</label>
            <input type="number" name="Amount" id="Amount" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="Expense Amount" Required>
        </div>
            
        <div class="form-group">
            <label for="Supplier" class="control-label label-left" ><i class="fa fa-male" aria-hidden="true"></i> Supplier</label>
            <input type="text" name="Supplier" id="Supplier" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" placeholder="Expense Supplier" Required onblur="convert_supp()">
        </div>
        <input type="hidden" name="AssetId" id="AssetIds" class="form-control">
      </td>
      
        <td width="50%"> 
            
                        
            <div class="form-group">
                <label for="Description" class="control-label label-right" ><i class="fa fa-pencil" aria-hidden="true"></i> Expense Description</label>
                <input type="text" name="Description" id="Description" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" placeholder="Description For Expense" Required onblur="convert_desc()">
            </div>
            
            <div class="form-group">
                <label for="PaidDate" class="control-label label-right" ><i class="fa fa-calendar" aria-hidden="true"></i> Expense Date</label>
                <input type="text" name="PaidDate" id="PaidDate" class="datepicker" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" placeholder="MM/DD/YYYY" Required>
            </div>
            
            <div class="form-group" style="">
                <label for="file" class="control-label label-right" ><i class="fa fa-file" aria-hidden="true"></i> Expense File </label>  
                <input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:4px; margin:auto 0% auto 3%; color:#999" value="" Required >
            </div>
            <input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
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
                <button type="submit" class="btn btn-primary">Add Expense</button>
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

