@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>



<style>
.option { font-size:16px; margin:3px 5px; color:#999 }
.part-active { border-radius:12px; }
.parts { padding:8px 0px; border-radius:12px; display:none }
.labour-active { border-radius:12px; }
.labours { padding:8px 15px; border-radius:12px; display:none }

.pad{
    margin-top: 5px;
    border:1px solid #ddd;
}
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
    padding:7.5px;
    border-radius:2px;
    color:#999;
    margin:0px 0px;
}
.sel-opt-left
{
    border:thin #ede solid;
    width:97%;
    padding:7.5px;
    border-radius:2px;
    color:#999;
    margin:auto 2% auto 3%;
}
.sel-opt-right
{
    border:thin #ede solid;
    width:95%;
    padding:7.5px;
    border-radius:2px;
    color:#999;
    margin:auto 2% auto 2%;
}

.inp
{
    border:thin #ede solid;
    width:98%;	padding:5px;	
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
    color:#666; margin:auto 2% auto 3%;
}
.label-right
{
    color:#666; margin:auto 4% auto 2%;
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
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
  background-color:#f00;
  color:#fff;
}
.btn-circle-green
{
  width: 30px;
  height: 25px;
  text-align: center;
  padding: 4px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
  background-color:#396;
  color:#fff;
}
.right-card-view
{
    padding:1px 25px 1px 10px; margin-top:-25px;
}
.white-card
{
    margin:-15px -20px 0px 6px;
}
.grey-card
{
    padding:1px 5px;  margin:0px -20px 0px -25px;
}
.action-link
{
    color:blue; text-decoration:none;
}

</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
  <section class="forms-basic">
	<div class="page-header">
	  <h1>      <i class="fa fa-briefcase"></i>    Inventory Item    </h1>
	</div>

     <!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
	  
		<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
		<div class="well white white-card" style="margin-top:-10px"> 

            <center> <img src="{{URL::asset('assets/img/part6.jpg')}}" class="img-responsive" height="150" width="150"> </center>
			
		</div>  	
		
		
			<!-- quick report div  -->

			

			<!-- quick information div  -->
			<div class="grey-card">
			<div style="margin:-10px 15px 0px -10px">
             
			</div>
			</div>
		
	  </div>

              
			  
   <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
      <form method="post" action="{{route('inventoryItem.insert')}}" role="form">
			<fieldset>

                @if(count($errors) > 0)
			   		@foreach($errore->all() as $error)
			   			<div class="alert alert-danger"> {{ $error }} </div>
			   		@endforeach
			   	@endif

			<table id="example" class="table" cellspacing="1" width="100%" border="0">
			<CAPTION>Part Details</CAPTION>
			<tr class="box-section">
				<td width="50%">
				<div class="form-group">
				<label for="InvCatId" class="control-label label-left" required><i class="fa fa-list"></i> Category</label>
					<select class='sel-opt-left' name='InvCatId' id='InvCatId' required>
						<option value="">Select Category Name</option>
						@if($invcategorys)
						@foreach ($invcategorys as $invcategorys)
                            <option value="{{{$invcategorys->InvCatId}}}"> {{ $invcategorys->InvName }} </option>
                        @endforeach
						@endif
					</select>	
				</div>
				
							  
				<div class="form-group">
					<label for="InvItemName" class="control-label label-left" required><i class="fa fa-list"></i> Item Name</label>
					<input type="text" name="InvItemName" id="InvItemName" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2% auto 3%; color:#999" Required onblur="convert_name()"> 
				</div>							
			  </td>
				<td width="50%"> 
				
				<div class="form-group">
				<label for="VendorId" class="control-label label-right" required><i class="fa fa-list"></i> Manufacturer</label>
				<select class='sel-opt-right' name='VendorId' id='VendorId' required>
					 <option value="">Select Manufacturer</option>
					     
				</select>
				</div>
								
					<div class="form-group">	  
						<label for="SerialNo" class="control-label label-right" required><i class="fa fa-book"></i> Serial Number</label>
							<input type="text" name="SerialNo" id="SerialNo" style="border:thin #ede solid;	width:95%;	padding:5px;	border-radius:2px;margin:auto 0% auto 2%; color:#999" onkeyup="convert_serial()" Required> 	 						
				    </div>
				</td>
			</tr>

			<tr class="lead" style="text-align:left;">
				<td style="margin-left:-15px"> Cost </td>
				<td>  </td>
			</tr>

			<tr class="box-section">
				<td width="50%"> 
							  
				<div class="form-group">
					<label for="Quantity" class="control-label label-left"><i class="fa fa-hourglass-3"></i> Quantity</label>
					<input type="number" name="Quantity" id="Quantity" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2% auto 3%; color:#999" Required>
				</div>							
				</td>
				<td width="50%"> 
				<div class="form-group">
					<label for="Cost" class="control-label label-right"><i class="fa fa-usd"></i> Cost</label>
					<input type="text" name="Cost" id="Cost" style="border:thin #ede solid;	width:95%;	padding:5px;	border-radius:2px;margin:auto 0% auto 2%; color:#999" Required>
				</div> 
				</td>
			</tr>
			
			<tr class="box-section">
				<td width="50%"> 
					<div class="form-group">
						<label for="Active"  class="control-label label-left"> <i class="fa fa-toggle-on"></i> Make Active </label>
						<div class="radio">						
							<table width="45%" style="margin-left:15px">
							  <tr>
								<td><label class="pull-left">  
								  <input type="radio" name="Active" value="1" id="Active_0" checked />&nbsp;&nbsp;&nbsp; Yes 
								  </label></td>

								<td><label class="pull-right">  
								  <input type="radio" name="Active" value="0" id="Active_1" />&nbsp;&nbsp;&nbsp; No
								  </label></td>
							  </tr>
							</table>
						</div>
					</div>
					 	
				</td>
				<td width="50%"> 
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				</td>
			</tr>

		</table>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Add Item</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			  </div>
				

			  
			  
			</fieldset>
		  </form>
		  </div>
		</div>


  </section>
</div>


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_name() 
	{
		var str = document.getElementById('InvItemName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('InvItemName').value = cap;
	}
	
	function convert_serial() 
	{
		var str = document.getElementById('SerialNo').value;
		var cap = str.toUpperCase(); 			document.getElementById('SerialNo').value = cap;
	}
</script>

<!-- SCRIPT TO LOAD VENDOR / Manufacturer -->
<script>
	$(document).ready(function()
	{
		$('#InvCatId').change(function(e)
		{
			console.log(e);
			var invcatid = e.target.value;
			//var InvCatId = $(this).val(); $.get('{{url('make-models')}}?MakeId=' + makeid, function(data)
			$.get('{{url('invcat-vendors')}}?InvCatId=' + invcatid, function(data)
			{  //success data
				$('#VendorId').empty();
				$('#VendorId').append('<option value=""> Select Vendor \ Manufacturer </option>')
				$.each(data, function(index, vendorObj)
				{
					$('#VendorId').append('<option value="'+ vendorObj.VendorId +'"> '+vendorObj.VendorName+' </option>')
				});
			});
				
			
		});
	});
</script> 





@stop