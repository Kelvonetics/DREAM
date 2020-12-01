@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  --> <?php  $auth_user = Auth::user();  ?> 

<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	
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
		margin:auto 2%;
	}


label 
	{
		color:#666;
		margin:auto 2%;
	}
.tab-top-bottom
	{
		height:15px;
	}

.part-div
	{
		margin:15px 0px;
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
	  <h1>      <i class="fa fa-female"></i>    Client Asset Profile  </h1>
		<p class="lead"> The client asset profile module allows you to configure and setup asset profile settings. </p>
	</div>
            
			
		<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-0px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card"> 			
				
			<?php
				$Clientassetattachment = DB::table('clientassetattachment')->where('AssetId', '=', $id)->orderBy('AssetAttachId', 'desc')->first();

				$clientasset = DB::table('clientasset')->where('AssetId', '=', $id)->first();

				$assetmake = DB::table('assetmake')->where('MakeId', '=', $clientasset->MakeId)->first();    
				$assetmodel = DB::table('assetmodel')->where('ModelId', '=', $clientasset->ModelId)->first();
			?>

				@if($Clientassetattachment)

					<?php $pic = $Clientassetattachment->name;  
						if ($pic != null)	{	$pix = '/assets/img/assets/'.@$pic; }         
					?>

				@else

                	<?php $pix = '/assets/img/nocar.jpg';  ?>

                @endif
			    
				<center> <i class="grey-text m-b-30" >
					<span class="pull-left"> <?= $clientasset->LicensePlate .' ' ?> </span> 
					<span style=""> <?= $assetmake->Make.' '.$assetmodel->ModelName ?> </span>
				 </i>  </center>	
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

      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('/clientasset/updateClientAssetProfile', array($id)) }}">	 
		<fieldset>
        <legend> Client Asset Profile </legend>             		 
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Login Credentials <i class="pull-right"> Change Your Password And Profile Picture </i></CAPTION>				
			<tr class="box-section">
				<td width="33%"> 
						
			    </td>
				<td width="33%"> 
					<div class="form-group">  
                    <label for="file" class="control-label label-full" ><i class="fa fa-photo" aria-hidden="true"></i> Upload Photo </label>  
                    <input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:4px; margin:auto -2% auto 2%; color:#999" value="" Required>
					</div>
				</td>
				<td width="33%"> 

					<div class="form-group">
						<input type="hidden" name="AssetId" id="AssetId" class="form-control" value="<?= $id ?>" readonly >
						<input type="text" name="ClientId" id="ClientId" class="form-control" value="<?= $clientasset->ClientId ?>" readonly >
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
					<input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">  
					</div>
					
					
				</td>
			</tr>
		
		</table>			 
					 
							
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">			
			<tr class="box-section">
				<td width="50%"> 
					
					<div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>		
			    </td>
				<td width="50%"> 
					
				</td>
			</tr>
		
		</table>

						
                      
		</fieldset>
				  

	</Form>
		  
  </div>





  

</section>
</div>
		  
		  
<!-- SCRIPT TO  -->
<script>

</script>		  
		  



@stop