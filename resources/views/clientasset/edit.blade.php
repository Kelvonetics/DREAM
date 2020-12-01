@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>




<?php 
	$caid = $clientasset->AssetId;  $casset = DB::table('clientasset')->where('AssetId', '=', $caid)->first();
?>

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
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:0px 0px;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 4%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:93%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 3%;
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
</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
    <section class="forms-basic">
    <div class="page-header">
        <h1>      <i class="fa fa-car"></i>    Client  Asset Management   </h1>
        <p  class="lead"> The Client  Asset Management module  allows you to efficiently manage your entire Client  asset lifecycle. With real-time visibility into  <br> Client  asset    performance and powerful analytics, it’s easier to ultimately maximize your return on Client  assets (ROA). </p>
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
        <div class="well white white-card"> 

        <center> <img src="{{URL::asset('assets/img/nocar.jpg')}}" class="img-responsive" height="150" width="150"> </center>				 
            <?php 
            /* $conn = connect();
            $id = $asset->AssetId;
            $sql1 = "SELECT * FROM assetattachment WHERE AssetId = '{$id }'";
            $results = $conn->query($sql1);
            if ($results->num_rows > 0)	
            {	
                $photo = $results->fetch_assoc(); $type = @$photo['FileType'];  
                if ($type == 'image/jpeg' || $type == 'image/gif' || $type == 'image/png')	{	$pix = @$photo['name'];  $pic = '/uploads/files/'.@$pix; }
                else { $pic = '/img/nocar.jpg';  }
            }
            else { $pic = '/img/nocar.jpg';  }	 ?>   
            
              <center> <?php echo $this->Html->image($pic, array('alt' => 'Asset Photo', 'height' => '30%', 'width' => '70%', 'style' => 'border-radius:18px'));  ?> </center>
            
            <center> <i class="grey-text m-b-30" >
            <?php $conn = connect();					$MKid = $asset->MakeId;			$MDid = $asset->ModelId;
            $sql = "SELECT * FROM assetmake WHERE MakeId = '{$MKid }'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)	
            {
                $ass_mk = $result->fetch_assoc();  echo $ass_mk['Make'];
            }
            $sql2 = "SELECT * FROM assetmodel WHERE ModelId = '{$MDid }'";
            $result2 = $conn->query($sql2);   $ass_md = $result2->fetch_assoc();
            ?>
           
            <?= ' '.$ass_md['ModelName']. ' &nbsp; &nbsp; '.$asset->LicensePlate  ?>
            </i>  </center> */ ?>
            
        </div>  	
        
        
            <!-- quick report div  -->
            <div class="grey-card" style="padding:0px 0px 0px 25px">
            <table class="table" width="105%" cellpadding="0">
                <tr>
                    <td style="width:95%"> 
                        <h4 class="grey-text m-b-30">   Quick Reports  </h4>
                                </td>
                    <td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
                </tr>
            </table>
            
                <div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
                
                <div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                  <div class="pull-right" style="margin:-5px -25px; color:#fff"><a onclick="workOrder('$clientasset->AssetId')" href="#" class="btn btn-circle-green" data-tooltip="true" data-toggle="modal" data-target="#workModal" title='Create Work Order For Client Asset'>+</a></div>
                  <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href="">Last 10 Service Appointments </a></div>
                </div>
                
                <div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                  <div class="pull-right" style="margin:-5px -25px"><a onclick="pullId('$asset->AssetId')" href="" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn"  data-toggle="modal" data-target="#fuelModal" title='Add New Fuel Log'>+</a></div>
                  <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Jobs </a></div>
                </div>
                
                <div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                  <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green">+</a></div>
                  <div class="w600 f11"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Fuel Purchases </a></div>
                </div>
                
              </div>
            </div>
            

            <!-- quick information div  -->
            <div class="grey-card">
            <div style="margin:-10px 15px 0px 10px">
                <?php  //$this->element('insight');  ?> 
            </div>
            </div>
        
      </div>

  
  
  <!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   

		<div>
	

		<form class="form-horizontal" method="post" action="{{ url('/clientasset/update', array($clientasset->AssetId)) }}">
        <fieldset>
		<legend>Edit vehicle profile</legend>
        @if(count($errors) > 0)
            @foreach($errors->all() as $errors)
                <div class="alert alert-danger"> {{ $errors }} </div>
            @endforeach
        @endif  

        @if(session('info'))
            <div class="alert" style="background-color:#ACE1AF">
                {{session('info')}}
            </div>
        @endif
			
			  <table id="example" class="table" cellspacing="1" width="100%" border="0">
				<CAPTION>Primary Details</CAPTION>
					<tr class="box-section">
						<td width="50%"> 
						<div class="form-group">	  
							  <div class="controls">
							  <label for="MakeId" class="control-label label-left"> <i class="fa fa-car"></i> Vehicle Make</label>
								<select class='sel-opt-left' name='MakeId' id='MakeId' required>
									<?php 
										$mkid = $clientasset->MakeId;
										$make = DB::table('assetmake')->where('MakeId', '=', $mkid)->first();
										if($make) 
										{
											echo "<option class='option' value=\"".$make->MakeId."\">".$make->Make."</option>";
										}
										else {  }
									?>
									<option class="option" value=""> Select Vehicle Make </option>
									@if($assetmake)
									@foreach ($assetmake as $assetmake)
										<option value="{{{$assetmake->MakeId}}}"> {{ $assetmake->Make }} </option>
									@endforeach
									@endif
							   </select>
							  </div>							
						</div>
						
						
						
						<div class="form-group">
							<label for="LicensePlate" class="control-label label-left"><i class="fa fa-car"></i> License Plate</label>
							<input type="text" name="LicensePlate" id="LicensePlate" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" value="{{$clientasset->LicensePlate}}" Required onkeyup="convert_case()">
						</div>
													
					  </td>
						<td width="50%"> 
						
							<div class="form-group">
								<div class="controls">  
								<label for="ModelId" class="control-label label-right"><i class="fa fa-car"></i> Vehicle Model</label>
									<select class='sel-opt' name='ModelId' id='ModelId' style="margin:auto 0% auto 3%;" required>
										<?php 
											$mdid = $clientasset->ModelId;
											$model = DB::table('assetmodel')->where('ModelId', '=', $mdid)->first();
											if ($model) 
											{
												echo "<option class='option' value=\"".$model->ModelId."\">".$model->ModelName."</option>";
											}
											else {  }
										?>
								   </select>
							  </div>
							</div>
										
							<div class="form-group">
								<label for="VIN" class="control-label label-right"><i class="fa fa-car"></i> Vehicle Identification No</label>
								<input type="text" name="VIN" id="VIN" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999"@if($clientasset) value="{{$clientasset->VIN}}"@endif Required onkeyup="convert_vin()">
							</div>
							
							<div class="form-group">
							
							</div>
							
						</td>
					</tr>

					
					<tr class="lead" style="text-align:left; margin-left:-15px">
						<td colspan="2"> Secondary Details </td>
					</tr>
					

					<tr class="box-section">
						<td> 
							<div class="form-group">
							<label for="EqpYear" class="control-label label-left"><i class="fa fa-calendar"></i> Vehicle Year</label>
							<input type="text" name="EqpYear" id="EqpYear" placeholder="YYYY" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"@if($clientasset) value="{{$clientasset->EqpYear}}"@endif maxlength="4" Required>
						</div>
							<div class="form-group">    
							<label for="AssetTypeId" class="control-label label-left"><i class="fa fa-car"></i> Vehicle Body Type</label>
							<select class='sel-opt-left' name='AssetTypeId' id='AssetTypeId' required>
							   
								<?php
								$tid = $clientasset->AssetTypeId;
								$type = DB::table('assettype')->where('AssetTypeId', '=', $tid)->first();
								?>
								@if ($type) 
								<option class='option' value="{{$type->AssetTypeId}}"> {{$type->AssetTypeName}}</option>
								@endif
								<option value="">Select Vehicle Body  Type </option>
                                    @if($assettypes)
									@foreach ($assettypes as $assettypes)
										<option value="{{{$assettypes->AssetTypeId}}}"> {{ $assettypes->AssetTypeName }} </option>
									@endforeach
									@endif
							 </select>
							</div>
							
							
						</td>
						<td> 
							<div class="form-group">    
							<label for="FuelTypeId" class="control-label label-right"> <i class="fa fa-tint"></i> Fuel Type</label>
							<select class='sel-opt-right' name='FuelTypeId' id='FuelTypeId' required>
								<?php
								$fid = $casset->FuelTypeId;
								$fueltype = DB::table('fueltype')->where('FuelTypeId', '=', $fid)->first();
								?>
								@if ($fueltype) 
								<option class='option' value="{{$fueltype->FuelTypeId}}">{{$fueltype->FuelType}}</option>
								@endif
								
								<option value="">Select Vehicle Fuel  Type </option>'
                                    @if($fueltypes)
									@foreach ($fueltypes as $fueltypes)
										<option value="{{{$fueltypes->FuelTypeId}}}"> {{ $fueltypes->FuelType }} </option>
									@endforeach
									@endif
							 </select>
							</div>
							<div class="form-group">    
							<label for="Color" class="control-label label-right"><i class="fa fa-adjust"></i> Color</label>
							<select class='sel-opt-right' name='Color' id='Color' required>
								@if($casset)
								<option class='option' value="{{$casset->Color}}">{{$casset->Color}}</option>
								@endif

								<option value="">Select Vehicle Color </option>
                                    @if($color)
									@foreach ($color as $color)
										<option value="{{{$color->Color}}}"> {{ $color->Color }} </option>
									@endforeach
									@endif
							 </select>
							</div>
						</td>
					</tr>
					
					<tr class="lead" style="text-align:left; margin-left:-15px">
						<td colspan="2"> Client Details </td>
					</tr>
					

					<tr class="box-section">
						<td> 
							<div class="form-group">    
							<label for="ClientId" class="control-label label-left"><i class="fa fa-car"></i>Client</label>
							<select class='sel-opt-left' name='ClientId' id='ClientId' required>
                            <?php
								$id = $casset->ClientId;
								$Client = DB::table('client')->where('ClientId', '=', $id)->first();
							?>
                                @if ($Client) 
                                <option class='option' value="{{$Client->ClientId}}">
								{{$Client->FirstName.' '.$Client->LastName.}}</option>
                                @endif
                             
                                <option value="">Select Client </option>
                                @if ($Clients)
								@foreach ($clients as $clients)
                                <option value="{{{$clients->ClientId}}}"> {{ $clients->FirstName.' '.$clients->LastName }} </option>
                                @endforeach
								@endif
							 </select>
							</div>
							
							
						</td>
						<td> 
							<div class="form-group"> <label for="Active" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> Make Active </label>
						<div class="radio" style="margin-left:25px">
							 <?php  if($casset->Active == '1'){ 
							  echo '<label> <input type="radio" name="Active" value="1" id="Active_0" checked /> Yes </label>  
							 <label style="margin-left:20px">  <input type="radio" name="Active" value="0" id="Active_1" />  No  </label> '; } ?>

							  
							 <?php  if($casset->Active == '0'){ 
							  echo '<label> <input type="radio" name="Active" value="1" id="Active_2" /> Yes </label>
							 <label style="margin-left:20px"> <input type="radio" name="Active" value="0" id="Active_3" checked  />  No </label> '; } ?>
								  
						</div>
					</div>
						</td>
					</tr>
					
					<tr>
						<td> 
							
						</td>
						<td> 
							
						</td>
					</tr>
					
					<tr>
						<td> 
							<div class="form-group" style="margin-left:-5px">
								<button type="submit" class="btn btn-primary">Update Asset</button>
								<button type="reset" class="btn btn-default">Cancel</button>
							  </div>
						</td>
						<td> 
							<div class="form-group">
								<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
							</div>
						</td>
					</tr>
				</table> 

			  
	</fieldset>
		
		</form>

</div>
</div>

	
   

  </section>
</div>
		
<script>
	$(document).ready(function()
	{
		$('#MakeId').change(function(e)
		{
			console.log(e);
			var makeid = e.target.value;
			$.get('{{url('make-models')}}?MakeId=' + makeid, function(data)
			{  //success data
				$('#ModelId').empty();
				$('#ModelId').append('<option value=""> Select Vehicle Model  </option>')
				$.each(data, function(index, modelObj)
				{
					$('#ModelId').append('<option value="'+ modelObj.ModelId +'"> '+modelObj.ModelName+' </option>')
				});
			});				
		});
	});
</script>  


<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_case() 
	{
		var str = document.getElementById('LicensePlate').value;
		var cap = str.toUpperCase(); 			document.getElementById('LicensePlate').value = cap;
	}
    
    function convert_vin() 
	{
		var str = document.getElementById('VIN').value;
		var cap = str.toUpperCase(); 			document.getElementById('VIN').value = cap;
	}
</script>




@stop