@extends('templates.default')

@section('content')


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
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto -2% auto 4.5%;
	}
.sel-opt-left
	{
		border:thin #ede solid;
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 2% auto 6%;
	}
.sel-opt-right
	{
		border:thin #ede solid;
		width:91%;
		padding:7.5px;
		border-radius:2px;
		color:#999;
		margin:auto 0% auto 3%;
	}
.label 
	{
		color:#666;
	}

.label-left
	{
		color:#666; margin:auto 2% auto 6%;
	}
.label-right
	{
		color:#666; margin:auto 0% auto 3%;
	}
.label-center
	{
		color:#666; margin:auto -2% auto 4.5%;
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

<div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
  <section class="forms-basic">
	<div class="page-header">
	  <h1>      <i class="fa fa-user"></i>    User Administration   </h1>
	  <p class="lead"> The user administration module allows you to create a new user, view a list of users you previously created and modify an existing <br>  user's details. </p>
	</div>
	
	
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

			<a onclick="UserProfileUpload({{$users->UserId}})" href="#" class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple pull-right" data-toggle="modal" data-target="#userprofileModal" style="margin-right:-20px;" title="Edit User Profile Photo"> <i class="fa fa-photo" style="color:red;"></i> </a>
				
				<?php
					$user_pic = DB::table('users')->where('UserId', '=', $id)->first();
					if($user_pic)	
					{	
						$pic = $user_pic->UserPicture;   if($pic == ''){ $pic = "avatar.jpg"; }
					}
					else{ $pic = "avatar.jpg";  }
				?>

			<center> <img src="{{URL::asset('assets/img/users/'.$pic)}}" class="img-responsive" height="150" width="150">
			<span style=""> <?= $user_pic->FirstName. ' '.$user_pic->LastName; ?> </span> 
			</center>
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

      <form class="form-horizontal" method="post" action="{{ url('/user/update', array($users->UserId)) }}">	 
		<fieldset>
        <legend> Edit User </legend>     
        @if(count($errors) > 0)
            @foreach($errore->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif  

        @if(session('info'))
			<div class="alert" style="background-color:#ACE1AF">
				{{session('info')}}
			</div>
		@endif      
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>User Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
					<div class="form-group">
					 <label for="FirstName" class="help-block label-center">  <i class="fa fa-male" aria-hidden="true"></i> First Name * </label>
						<input type="text" name="FirstName" placeholder="FirstName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" onblur="convert_fname()"
						@if($users) value="{{$users->FirstName}}"@endif required>	
					</div>
								  
					<div class="form-group">
					  <label for="email" class="help-block label-center">  <i class="fa fa-envelope" aria-hidden="true"></i> E-mail * </label>
                      <input type="email" name="email" placeholder="Email" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999"@if($users) value="{{$users->email}}"@endif required>
					</div>							
			  </td>
				<td width="50%"> 
				
					<div class="form-group">
					 <label for="LastName" class="help-block label-right">  <i class="fa fa-male" aria-hidden="true"></i> Last Name </label>
                     <input type="text" name="LastName" placeholder="LastName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999" onblur="convert_lname()"@if($users) value="{{$users->LastName}}"@endif required>	
					</div>
								
					<div class="form-group">	  
					  <div class="controls">
						<label for="Phone" class="help-block label-right">  <i class="fa fa-phone" aria-hidden="true"></i> Phone * </label>
                        <input type="text" name="Phone" placeholder="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%;; color:#999"@if($users) value="{{$users->Phone}}"@endif required> 
					</div>							
				</div>
				</td>

			</tr>
			
			<tr class="box-section">
				<td width="100%"  class="" colspan="2"> 
                <div class="row">
					<div class="form-group col-md-4" style="margin-left:0.5%">	  
						<label for="Sex" class="help-block label-center" style="margin-left:0px">  <i class="fa fa-female" aria-hidden="true"></i> Gender </label>
							<div class="radio" style="margin-left:0px"> 
								 @if($users->Sex == 'Male')
								  <label> <input type="radio" name="Sex" value="Male" id="Sex_0" checked /> Male </label>  
								  <label style="margin-left:0px">  <input type="radio" name="Sex" value="Female" id="Sex_1" />  Female  </label>
								  
								 @elseif($users->Sex == 'Female')
								  <label> <input type="radio" name="Sex" value="Male" id="Sex_2" /> Male </label>
								  <label style="margin-left:0px"> <input type="radio" name="Sex" value="Female" id="Sex_3" checked  />  Female </label> 
								 @endif	  
							</div>
					</div>
					
					<div class="form-group col-md-4" style="margin-left:0.5%">	  
						 <label for="VIP" class="help-block label-center" style="margin-left:5px">  <i class="fa fa-user-secret" aria-hidden="true"></i> Is VIP  </label>
							<div class="radio" style="margin-left:0px"> 
								  @if($users->VIP == '1') 
								  <label> <input type="radio" name="VIP" value="1" id="VIP_0" checked /> Yes </label>  
								 <label style="margin-left:10px">  <input type="radio" name="VIP" value="0" id="VIP_1" />  No  </label>
								  
								  @elseif($users->VIP == '0')
								  <label> <input type="radio" name="VIP" value="1" id="VIP_2" /> Yes </label>
								 <label style="margin-left:10px"> <input type="radio" name="VIP" value="0" id="VIP_3" checked  />  No </label>
                                 @endif	  
							</div>
					</div>
					
					<div class="form-group col-md-4" style="margin-left:0.5%">	  
						<label for="Active" class="help-block label-center" style="margin-left:5px">  <i class="fa fa-toggle-on" aria-hidden="true"></i> Active </label>
							<div class="radio" style="margin-left:0px"> 
								  @if($users->Active == '1')
								  <label> <input type="radio" name="Active" value="1" id="Active_0" checked /> Yes </label>  
								 <label style="margin-left:10px">  <input type="radio" name="Active" value="0" id="Active_1" />  No  </label>

								  
								  @elseif($users->Active == '0')
								  <label> <input type="radio" name="Active" value="1" id="Active_2" /> Yes </label>
								 <label style="margin-left:10px"> <input type="radio" name="Active" value="0" id="Active_3" checked  />  No </label>
                                 @endif	  
							</div>
					</div>
                    </div>
				</td>
			</tr>
		
		</table>
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Job Profile</CAPTION>				
			<tr class="box-section">
				<td width="33%"> 
					<div class="form-group">
						<label for="DeptId" class="help-block label-left">  <i class="fa fa-bank" aria-hidden="true"></i> Department * </label>
						<select class='sel-opt-left' name='DeptId' id='DeptId' required>
                        <option @if($department) value="{{{$department->DeptId}}}"@endif>@if($department) {{ $department->DeptName }} @endif</option>
                        <option value=""> Select Department </option>
                            @if($departments)
							@foreach ($departments as $departments)
                                <option value="{{{$departments->DeptId}}}"> {{ $departments->DeptName }} </option>
                            @endforeach
							@endif
                        </select>	
					</div>
							
			    </td>
				<td width="33%"> 
				
					<div class="form-group">
					 <label for="LocationId" class="help-block label-center"> <i class="fa fa-map-marker" aria-hidden="true"></i> Location * </label>
						<select class='sel-opt' name='LocationId' id='LocationId' required>
                        <option @if($companylocation) value="{{{$companylocation->LocationId}}}"@endif >@if($companylocation) {{ $companylocation->LocationName }} @endif </option>
                        <option value=""> Select Company Location </option>
                            @if($companylocations)
							@foreach ($companylocations as $companylocations)
                                <option value="{{{$companylocations->LocationId}}}"> {{ $companylocations->LocationName }} </option>
                            @endforeach
							@endif
						</select>	
					</div>

				</td>
				<td width="33%"> 

					<div class="form-group">   <label for="PositionId" class="help-block label-right">  <i class="fa fa-street-view" aria-hidden="true"></i> Job Title </label>
						<select class='sel-opt-right' name='PositionId' id='PositionId' required>
                        <option @if($userposition) value="{{{$userposition->PositionId}}}"@endif >@if($userposition) {{ $userposition->PositionName }} @endif</option>
                        <option value=""> Select User Position </option>
                            @if($userpositions)
							@foreach ($userpositions as $userpositions)
                                <option value="{{{$userpositions->PositionId}}}"> {{ $userpositions->PositionName }} </option>
                            @endforeach
							@endif
						</select>
					</div> 
				</td>
			</tr>
		
		</table>
					 
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Login Credentials</CAPTION>				
			<tr class="box-section">
				<td width="33%"> 
					<div class="form-group">   <label for="password" class="help-block label-left">  <i class="fa fa-lock" aria-hidden="true"></i> Password </label>
						<input type="password" name="password" id="password" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto 2% auto 6%; color:#999"@if($users) value="{{$users->password}}"@endif Required> 
					</div>
							
			    </td>
				<td width="33%"> 
				
					<div class="form-group">   <label for="repassword" class="help-block label-center">  <i class="fa fa-key" aria-hidden="true"></i> Confirm Password </label>
						<input type="password" name="repassword" id="repassword" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto -2% auto 4.5%; color:#999"@if($users) value="{{$users->password}}"@endif onblur="confirmPass()" Required>
					</div>
					
					<div class="form-group">
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="" readonly > 
					</div>
					<div class="form-group">
						<input type="hidden" name="DomainId" id="DomainId" class="form-control" value="{{$users->DomainId}}" readonly > 
					</div>
					<div class="form-group">
						<input type="hidden" name="DOB" id="DOB" class="form-control"@if($users) value="{{$users->DOB}}"@endif readonly > 
					</div>
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				</td>
				<td width="33%"> 

					<div class="form-group">   <label for="RoleId" class="help-block label-right">  <i class="fa fa-users" aria-hidden="true"></i> Role </label>
						<select class='sel-opt-right' name='RoleId' id='RoleId' required>
                        @if($role)
						<option value="{{{$role->RoleId}}}"> {{ $role->RoleName }} </option>
						@endif
                        <option value=""> Select User Role </option>
						@if($roles)
                            @foreach ($roles as $roles)
                                <option value="{{{$roles->RoleId}}}"> {{ $roles->RoleName }} </option>
                            @endforeach
						@endif
						 </select>
					</div>
					</div>
				</td>
			</tr>
		
		</table>			 
					 
							
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">			
			<tr class="box-section">
				<td width="50%"> 
					
					<div class="form-group">
                        <button type="submit" class="btn btn-primary" id="updUserBtns">Update User</button>
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
  </div>

</section>
 </div>





<!-- Asset Profile Photo Modal -->						
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/user/uploadProfilePhoto') }}">	
<div id="userprofileModal" class="modal fade" role="dialog" style="height:60%; margin:2% auto;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;">  <i class="fa fa-upload" aria-hidden="true"></i> Upload User Profile Photo</h4>
      </div>
      <div class="modal-body" style="margin-top:-20px">
       

	  		@include('modals.userprofilePhoto_modal')


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</Form>







<script> //get id functions
	function UserProfileUpload(id)
	{
		$('#UserId').val(id);   
    }	
</script>
 
 <!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_fname() 
	{
		var str = document.getElementById('FirstName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('FirstName').value = cap;
	}
	
	function convert_lname() 
	{
		var str = document.getElementById('LastName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LastName').value = cap;
	}
	
	function confirmPass()
	{
		var pass = document.getElementById('password').value;
		var repass = document.getElementById('repassword').value;
		if(pass != repass) 
		{ 
			alert('Password Mismatch, Re Enter Password');
			var pass = document.getElementById('password').value = '';
			var repass = document.getElementById('repassword').value = '';
			var pass = document.getElementById('password').focus();
		}
	}
	
	function convert_jobT() 
	{
		var str = document.getElementById('JobTitle').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) 
	   {
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('JobTitle').value = cap;
	}
</script>


<script>	  //AJAX FUNCTION TO UPDATE USER

$(document).ready(function()
	{
		$("#updUserBtn").click(function(e)
		{
			var r = confirm("Are You Sure You Want To Make Changes To User Profile # {0}?");
			if (r == true) 
			{
				var _url_id = "{{{$users->UserId}}}";
				var FirstName = $("#FirstName").val();
				var LastName = $("#LastName").val();
				var email = $("#email").val();
				var Phone = $("#Phone").val();
				var Sex = $("#Sex").val();
				var RoleId = $("#RoleId").val();
				var DeptId = $("#DeptId").val();
				var PositionId = $("#PositionId").val();
				var LocationId = $("#LocationId").val();
				var VIP = $("#VIP").val();
				var Active = $("input[name='Active']:checked").val();
				var CreatedBy = $("#CreatedBy").val();
				var _token = $("#_token").val();

				// Returns successful data submission message when the entered information is stored in database.
				var user_data = 'FirstName='+ FirstName + '&LastName='+ LastName + '&email='+ email + '&Phone='+ Phone + '&Sex='+ Sex + '&RoleId='+ RoleId + '&DeptId='+ DeptId + '&PositionId='+ PositionId + '&LocationId='+ LocationId + '&VIP='+ VIP + '&Active='+ Active + '&CreatedBy='+ CreatedBy + '&_token='+ _token;

				e.preventDefault();
				// AJAX Code To Submit Form.
				$.ajax(
				{
					type: "POST",
					url: "/user/update/"+_url_id,
					data: user_data,
					cache: false,
					success: function()
					{
						alert('User Profile Updated Successfully !');									
					}
				});
			} 
			else 
			{
				e.preventDefault();
			}
		
		});
		return false;
	});
</script>

@stop