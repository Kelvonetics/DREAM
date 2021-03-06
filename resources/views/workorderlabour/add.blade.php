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
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:93%;
		padding:5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 4% auto 0%;
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
		color:#666; margin:auto 0% auto 3%;
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
.box-right
	{
		border:1px solid #ddd;
		padding:8px 15px;
	}
</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
<section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-wrench"></i>    Work Order Labour </h1> 
    <p class="lead"> The work order labour module  allows you to efficiently manage your entire work order labour. </p>
	</div>
	
	
	<div class="">
              
		<!-- right content -->
        <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
        <div class="pull-right" style="margin:-25px -20px 0px 0px">
          <ul class="list-unstyled">
            <li class="dropdown">
              <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
            </li>
          </ul>
        </div>
        
        <div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
        <div class="well white white-card"> 				 
        <center> <img src="{{URL::asset('assets/img/part1.jpg')}}" class="img-responsive" height="150" width="150"> </center>	
            
        </div>  	

            <!-- quick information div  -->
            <div class="grey-card">
            <div style="margin:-10px 15px 0px 10px">
             
            </div>
            </div>
        
      </div>
  

		<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
		
      <form method="post" action="{{route('workorderlabour.insert')}}" role="form">
      <LEGEND> New Work Order Labour </LEGEND>
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Labour Details</CAPTION>
			<tr class="box-section">
				<td width="50%">

                <div class="form-group">
                    <label for="LabourType" class="control-label label-left"><i class="fa fa-list"></i> Labour Type</label>
                    <input type="text" name="LabourType" id="LabourType" placeholder="Order Labour Type" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"  Required onblur="convert_type()"> 
                </div>
                <input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 

												
			  </td>
				<td width="50%"> 
                    
                    <div class="form-group">
                        <label for="LabourCost" class="control-label label-right"><i class="fa fa-usd"></i> Labour Cost</label>
                        <input type="text" name="LabourCost" id="LabourCost" placeholder="Order Labour Cost" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"  Required onblur="convert_cate()"> 
                    </div>
					</div>
					
				</td>

			</tr>

            <tr class="box-section">
            <td colspan="2">
                <div class="form-group">
                    <label for="LabourDesc" class="control-label" style="margin-left:2%"> <i class="fa fa-pencil"></i>  Description</label>
                    <textarea name="LabourDesc" id="LabourDesc" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required onkeyup="convert_desc()"></textarea> 
                </div> 							
            </td>
        </tr>
			
			<tr>
			<td colspan="2">
				<div class="form-group" style="margin-left:-6px">
					<button type="submit" class="btn btn-primary">Add Labour</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				</div>
			</td>
			</tr>
		</table>
		</Form>
	</div>
	</div>
	
	
	</div>

</section>


</div>






<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_type() 
	{
		var str = document.getElementById('LabourType').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LabourType').value = cap;
	}
		
	function convert_desc() 
	{
		var str = document.getElementById('LabourDesc').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LabourDesc').value = cap;
	}
</script>







@stop