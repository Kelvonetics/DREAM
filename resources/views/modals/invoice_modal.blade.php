<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>

<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.box-section 
	{ 
		border:#eee thin solid;margin:7px 0px; 
	}
	
.labour-box 
	{ 
		 padding:1px 15px; 
	}
.cost-box 
	{ 
		border:#eee thin solid; margin-top:5px;
	}
	
.sel-opt
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:97%;
		padding:5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:5px;
		border-radius:2px;
		color:#999;
		margin:auto 4% auto 0%;
	}
.sel-opt-full
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 1.5%;
	}

.inp
	{
		border:thin #ede solid;
		width:98%;	padding:10px 5px;	
		border-radius:2px;
		margin:auto -2% auto 2%;
		color:#999;
	}

label 
	{
		color:#666;
	}
.label-left
	{
		color:#666; margin:auto 2% auto 4%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 0%;
	}
.label-full
	{
		color:#666; margin:auto 4% auto 1.5%;
	}
.tab-top-bottom
	{
		height:15px;
	}
.costtd
	{
		vertical-align:top; text-align:left;
	}
.part-div
	{
		margin:15px 0px;
	}
.btn-circle 
	{
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
.btn-circle-red 
{
    width: 20px;
    height: 20px;
    text-align: center;
    padding: 1px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
    background-color: transparent;
    border: #E34234 thin solid;
    color: #E34234;
    margin-top:15px;
}
</style>



	
<span style="margin:-95px 0px 35px 0px; font-size:15px"> Invoice Number : #0000{{ $tot_inv }} </span> <br> <br>
	<fieldset>  <!-- <i class="lead pull left"> Invoice Date Details </i> --> 
		<div class="row" style="margin:-10px 1px; border:#eee thin solid">		  
			<div class="col-md-4 col-md-pull-0" style="margin:-10px 0px">				
			
				
				<?php  //$session = $this->request->session();  		$client_email = $session->read('client_sess_email');	//Write?>
                <input type="hidden" name='InvoiceNumber' id='InvoiceNumber'@if($tot_inv) value="{{ $tot_inv }}"@endif required readonly>
				<input type="hidden" name='ClientId' id='Client_Id' required>
				<input type="hidden" name='Email' id='Email' value="<?php //$client_email ?>" required>
				
				<div class="form-group">
					<label for="DueDate" class="control-label label-left" required> <span class="fa fa-calendar"></span> Due Date</label>
					<input type="text" name="DueDate" id="DueDate" class="datepicker" placeholder="MM/DD/YYYY" style="border:thin #ede solid;	width:95%;	padding:4px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required> 
				</div>

			</div>
		</div>
		
			
	
		
		<!-- multiple creation of items div --> 
		 
		<div class="row" style="margin:15px 1px; border:#eee thin solid">		  		
		
		<table class="table" cellspacing="1" width="100%" border="0" id="dynamic_invoice" style="">
		<i class="lead pull-left">Invoice Items</i> 
		
		<tr id="row1">      

			<td width="6%"> 
			<div class="form-group"> <div class="controls" >		  
				<label for="Quantity1" class="control-label" style="margin-left:25%; color:#666"><span class="fa fa-hourglass-3"></span> Qty </label>
					<input type="number" name="Quantity1" id="Quantity1" style="border:thin #ede solid;	width:96%;	padding: 4px;	border-radius:2px;margin:auto -1% auto 25%; color:#999" placeholder="Qty" value="1" Required > 
				</div>  
			</div>
			</td>
			
			<td width="68%" style="vertical-align:top; text-align:left; border: none;"> 
			<div class="form-group"><div class="controls" > 
				<label for="Description1" class="control-label" style="margin-left:6%; color:#666"><span class="fa fa-sticky-note"></span> Description </label>
					<input type="text" name="Description1" id="Description1"  style="border:thin #ede solid;	width:92.5%;	padding: 4px;	border-radius:2px;margin:auto -4% auto 6%; color:#999" placeholder="Invoice Description" Required >	 
				</div>  
				<input type="hidden" name="count" id="count" value="1" class="form-control">		
			</div>			
			</td>	
			
			<td width="11%" style="vertical-align:top; text-align:left; border: none;"> 	
			<div class="form-group">		
				<label for="Price1" class="control-label" style="margin-left:10%; color:#666"><span class="fa fa-usd"></span> Unit Price </label>
					<input type="number" name="Price1" id="Price1" class="price" style="border:thin #ede solid;	width:85%;	padding: 4px;	border-radius:2px;margin:auto -18% auto 10%; color:#999" onkeyup="checkPrice(this)" Required  value="0">  		
			</div>			
			</td>
			<td width="11%" style="vertical-align:top; text-align:left; border: none;"> 	
			<div class="form-group">		
				<label for="Amount1" class="control-label" style="margin-left:12%; color:#666"><span class="fa fa-usd"></span> Total </label>
					<input type="number" name="Amount1" id="Amount1" class="amount" style="border:thin #ede solid;	width:85%;	padding: 4px;	border-radius:2px;margin:auto -4% auto 12%; color:#999" onkeyup="checkAmount(this)" Required  value="0">  		
			</div>			
			</td>
			
			<td width="1%" style="vertical-align:middle; border: none;">
			<button type="button" name="remove" id="'+i+'" class="btn btn-circle-red btn_remove" style="">X</button> 
			</td>		
		</tr>

		
			
		</table>
		
		
		
		<table class="table" cellspacing="1" width="100%" border="0" style="">
		<tr><td> <button name="addPartBtn" type="button" id="addPartBtns" class="btn btn-circle">+</button>  <i> Add Invoice </i>  </td></tr>
		</table>


		</div>	
		


		<!-- <i class="lead pull left" style="margin:2px 15px">  </i> -->
		<div class="row" style="margin:-10px 1px; border:#eee thin solid; background-color:#f9f9f9"> 
		<table class="" width="100%" border="0" cellspacing="5" cellpadding="10">
			<tr>
				<td width="81%"> <span class="pull-right"><span class="fa fa-usd"></span> Sub &nbsp;Total : &nbsp; </span> </td>       
				<td width="13%"> <span id="SubTotal" value="0"></span>  </td>
			</tr>
			<tr>
				<td width="81%"> <span class="pull-right"><span class="fa fa-usd"></span> Total Cost : &nbsp;</span> </td>       
				<td width="13%"> <span id="TotalCost" value="0"></span> 
				<input type="hidden" name="Total_Cost" id="Total_Cost" value="">
				 </td>
			</tr>
		</table>

		</div>

		
		<div class="row" style="margin:5px 1px; border:#eee thin solid"> 
			<div class="col-md-12 col-md-pull-0" style="">		
				
				<div class="form-group">
					<label for="Notes" class="control-label" style="margin-left:1.5%" required><span class="fa fa-book"></span> Notes </label>
					<textarea name="Notes" id="Notes" class="inp-textarea" style="border:thin #ede solid;	width:97%;	padding: 7px;	border-radius:4px;margin:auto 1.5% auto 1.5%; color:#999" maxsize="70px" Required > </textarea>
				</div>   
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
			</div>
		</div>
		
		<div class="row" style="margin:15px 2px">	
			
			<div class="col-md-12 col-md-pull-0" style="">
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Create Invoice</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				  </div>
			</div>
			
                    <input type="hidden" name="Tax" id="Tax" class="" value="5" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%" Required > 
					<input type="hidden" name="SubTotals" id="SubTotals" class="" value="0" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%" Required> 
                    <input type="hidden" name="TotalDue" id="TotalDue" class="" value="0000" style="border:thin #ede solid;	width:95%;	padding:10px 5px; border-radius:4px;margin:auto 2% auto 0%" Required> 
                    <input type="hidden" name="PaymentMethod" id="PaymentMethod" class="form-control" value="Bank Transfer" readonly >
                    <input type="hidden" name="WorkOrderId" id="WorkOrderId" class="" value="1" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%" Required > 
                    <input type="hidden" name="Status" id="Status" class="form-control" value="Unpaid" readonly >  
                    <input type="hidden" name="CreatedDate" id="CreatedDate" class="form-control datepicker" value="" Required>
					<input type="hidden" name="DatePaid" id="DatePaid" class="datepicker" value="" style="border:thin #ede solid;	width:95%;	padding:10px 5px;	border-radius:4px;margin:auto 2% auto 0%"  Required> 
                    <input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 



		</div>
		
	
	
	 
	</fieldset>



	
	

	
	


<!--script for dublicating form -->
<script>
    $(document).ready(function ()
	{	  //$('#addPartBtns').click(function(){ alert(); });	
		//for Part
		var i = 1;				totalAmount(i); 
        $('#addPartBtns').on('click', function () 			//
		{  
            i++;		    
			$('#dynamic_invoice').append(
			'<tr id="row'+i+'">		<td width="6%"> 	<div class="form-group"> <div class="controls" style="margin-left:25%; color:#666">	<label for="Quantity'+i+'" class="control-label" ><span class="fa fa-hourglass-3"></span> Qty </label>	<input type="number" class="qty" name="Quantity'+i+'" id="Quantity'+i+'" style="border:thin #ede solid;	width:130%;	padding: 4px;	border-radius:2px;margin:auto -1% auto 1%; color:#999" value="1"> </div> 			</div>	</td>	<td width="68%" style="vertical-align:top; text-align:left; border: none;"> 		<div class="form-group"><div class="controls" > 	<label for="Description'+i+'" class="control-label" style="margin-left:6%; color:#666"><span class="fa fa-sticky-note"></span> Description </label>	<input type="text" name="Description'+i+'" id="Description'+i+'"  style="border:thin #ede solid;	width:92.5%;	padding: 4px;	border-radius:2px;margin:auto -4% auto 6%; color:#999">	 </div> 	</div>	</td>		<td width="11%" style="vertical-align:top; text-align:left; border: none;">      	<div class="form-group">		<label for="Price'+i+'" class="control-label" style="margin-left:10%; color:#666"><span class="fa fa-usd"></span> Unit Price </label>		<input type="number" name="Price'+i+'" id="Price'+i+'" class="price" style="border:thin #ede solid;	width:85%;	padding: 4px;	border-radius:2px;margin:auto -18% auto 10%; color:#999" onkeyup="checkPrice(this)" Required  value="0">   	</div>		</td>       <td width="11%" style="vertical-align:top; text-align:left; border: none;">      	<div class="form-group">		<label for="Amount'+i+'" class="control-label" style="margin-left:12%; color:#666"><span class="fa fa-usd"></span> Total </label>		<input type="number" name="Amount'+i+'" id="Amount'+i+'" class="amount" style="border:thin #ede solid;	width:85%;	padding: 4px;	border-radius:2px;margin:auto -4% auto 12%; color:#999" onkeyup="checkAmount(this)" Required  value="0">   	</div>		</td> 	<td width="1%" style="vertical-align:middle; border: none;">			<button type="button" name="remove" id="'+i+'" class="btn btn-circle-red btn_remove" style="">X</button> </td>		</tr>'						
		);
			//INCREAMENTING THE NUMBER OF COUNT
			document.getElementById('count').value = i;
			
			totalAmount(i);
			
        });
		
		//Function To load all labour Description
		//getLabour();
		
		
		$(document).on('click', '.btn_remove', function ()
		{
			var button_id = $(this).attr("id");
			$('#row'+button_id+"").remove();
			
			//reducing the count value
			document.getElementById('count').value = --i;
			
			//re-calculating the total amount
			var sub_total = 0; var total_cost = 0;
			$('.amount').each(function()
			{
				sub_total += parseInt($(this).val());
			});
			
			//$('#total').html('$' + sub_total);
			document.getElementById("SubTotal").innerHTML = sub_total; 
			
			document.getElementById("SubTotals").value = sub_total;
			total_cost = parseInt(sub_total * 1.05);
			document.getElementById("TotalCost").innerHTML = total_cost;
			document.getElementById("Total_Cost").value = parseInt(total_cost);
		});

    });
	
</script> 



<script>
	function totalAmount(i)
	{
		var q = 0; var p = 0; var amt = 0;  
		var ct = document.getElementById("count").value;
		$('.price').keyup(function()
		{
				q = document.getElementById('Quantity'+i+'').value; 
				p = document.getElementById('Price'+i+'').value; 
				amt = (p * q);
				document.getElementById('Amount'+i+'').value = parseInt(amt); 
	
			
			var sub_total = 0; var total_cost = 0;
			$('.amount').each(function()
			{
				sub_total += parseInt($(this).val());
			});
			
			total_cost = parseInt(sub_total * 1.05);
			document.getElementById("SubTotal").innerHTML = parseInt(sub_total); 
			document.getElementById("SubTotals").value = parseInt(sub_total); 
			
			document.getElementById("TotalCost").innerHTML = parseInt(total_cost); 
			document.getElementById("Total_Cost").value = parseInt(total_cost);
			
			
		
			$('.amount').keyup(function()
			{
				var sub_total = 0; var total_cost = 0;
				$('.amount').each(function()
				{
					sub_total += parseInt($(this).val());
				});
				
				//$('#total').html('$' + sub_total);
				document.getElementById("SubTotal").innerHTML = sub_total; 
				
				document.getElementById("SubTotals").value = sub_total;
				total_cost = parseInt(sub_total * 1.05);
				document.getElementById("TotalCost").innerHTML = total_cost; 
				document.getElementById("Total_Cost").value = parseInt(total_cost);
			});
		
		//amaking sure the amount value is never empty to avoid NAN Not A Number 
		});

		
	
	}
	
	function checkAmount(field) 
	{  
		if (field.value == '') 
		{
			var fid = field.id;
			document.getElementById(fid).value = 0;
			//$('.amount').val(0);
		}
		else 
		{	
			//WHEN INVOICE IS UPDATED
			var total_cost = 0; var amount = 0;
			$('.amount').each(function()
			{
				amount += parseInt($(this).val());
			});
			
			total_cost = parseInt(amount * 1.05);
			document.getElementById("SubTotal").innerHTML = amount;
			document.getElementById("SubTotals").value = amount;
			document.getElementById("TotalCost").innerHTML = total_cost; 
			document.getElementById("Total_Cost").value = parseInt(total_cost);
			
		}
	}

</script>

