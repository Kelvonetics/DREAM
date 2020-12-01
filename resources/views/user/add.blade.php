@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>


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
.label-left
	{
		color:#777; margin:auto 2% auto 6%;
	}
.label-right
	{
		color:#777; margin:auto 0% auto 3%;
	}
.label-center
	{
		color:#777; margin:auto -2% auto 4.5%;
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



<div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="margin-top:-100px">
  <section class="forms-basic">
	<div class="page-header">
	  <h1>      <i class="fa fa-user"></i>    User Administration  </h1>
		<p class="lead"> The user administration module allows you to create a new user, view a list of users you previously created and modify an existing user's details. </p>
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
            <center> <img src="{{URL::asset('assets/img/avatar.jpg')}}" class="img-responsive" height="150" width="150"> </center>
				
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
              
			
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('/user/insert') }}">
		<fieldset>
        <legend> New User </legend>             
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>User Details</CAPTION>
        <tr class="box-section">
        <td width="50%"> 
            <div class="form-group">
             <label for="FirstName" class="help-block label-center">  <i class="fa fa-male" aria-hidden="true"></i> First Name * </label>
                <input type="text" name="FirstName" placeholder="FirstName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" onblur="convert_fname()" required>	
            </div>
                          
            <div class="form-group">
              <label for="email" class="help-block label-center">  <i class="fa fa-envelope" aria-hidden="true"></i> E-mail * </label>
              <input type="email" name="email" placeholder="Email" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" required>
            </div>							
      </td>
        <td width="50%"> 
        
            <div class="form-group">
             <label for="LastName" class="help-block label-right">  <i class="fa fa-male" aria-hidden="true"></i> Last Name </label>
             <input type="text" name="LastName" placeholder="LastName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%; color:#999" onblur="convert_lname()" required>	
            </div>
                        
            <div class="form-group">	  
              <div class="controls">
                <label for="Phone" class="help-block label-right">  <i class="fa fa-phone" aria-hidden="true"></i> Phone * </label>
                <input type="text" name="Phone" placeholder="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 0% auto 3%;; color:#999" onblur="phonecheck()" required> 
            </div>							
        </div>
        </td>

    </tr>
			
			<tr class="box-section" style="color:#999">
				<td width="100%"  class="" colspan="2"> 
                <div class="form-group col-md-4" style="margin-left:-1%">	  
						<label for="Sex" class="help-block label-center" style="margin-left:0px">  <i class="fa fa-male" aria-hidden="true"></i> Gender </label>
                            <div class="radio" style="margin-left:-1%"> 
								  <label> <input type="radio" name="Sex" value="Male" id="Sex_0" /> Male </label>  
								  <label style="margin-left:0px">  <input type="radio" name="Sex" value="Female" id="Sex_1" />  Female  </label> 	  
							</div>
					</div>
					
					<div class="form-group col-md-4" style="margin-left:0.5%">  
						 <label for="VIP" class="help-block label-center" style="margin-left:5px">  <i class="fa fa-user-secret" aria-hidden="true"></i> Is VIP </label>
                            <div class="radio" style="margin-left:0px"> 
								  <label> <input type="radio" name="VIP" value="1" id="VIP_0" /> Yes </label>  
								 <label style="margin-left:10px">  <input type="radio" name="VIP" value="0" id="VIP_1" checked />  No  </label>  
							</div>
					</div>
					
					<div class="form-group col-md-4" style="margin-left:0.5%">	  
						<label for="Active" class="help-block label-center" style="margin-left:5px"> <i class="fa fa-toggle-on" aria-hidden="true"></i>  Active </label>
                        <div class="radio" style="margin-left:0px"> 
                            <label> <input type="radio" name="Active" value="1" id="Active_0" checked /> Yes </label>  
                            <label style="margin-left:10px">  <input type="radio" name="Active" value="0" id="Active_1" />  No  </label>
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
						<label for="DeptId" class="help-block label-left"> <i class="fa fa-bank" aria-hidden="true"></i>  Department * </label>
						<select class='sel-opt-left' name='DeptId' id='DeptId' onclick='gendercheck()' required>
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
					 <label for="LocationId" class="help-block label-center"> <i class="fa fa-map-marker" aria-hidden="true"></i>  Location * </label>
						<select class='sel-opt' name='LocationId' id='LocationId' required>
							<option value="">Select Company Location</option>
							@if($flow) 
							@foreach ($companylocations as $companylocations)
                                <option value="{{{$companylocations->LocationId}}}"> {{ $companylocations->LocationName }} </option>
                            @endforeach
							@endif
						</select>	
					</div>

				</td>
				<td width="33%"> 

					 <div class="form-group">  <label for="PositionId" class="help-block label-right"> <i class="fa fa-street-view" aria-hidden="true"></i> Job Title </label>
						<select class='sel-opt' name='PositionId' id='PositionId'>
							<option value="">Select User Position</option>
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
                    <input type="password" name="password" id="password" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto 2% auto 6%; color:#999" Required> 
					</div>
							
			    </td>
				<td width="33%"> 
				
					<div class="form-group">   <label for="repassword" class="help-block label-center">  <i class="fa fa-key" aria-hidden="true"></i>  Confirm Password </label>
                    <input type="password" name="repassword" id="repassword" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:2px;margin:auto -2% auto 4.5%; color:#999" onblur="confirmPass()" Required>
					</div>

				</td>
				<td width="33%"> 

					<div class="form-group">   <label for="RoleId" class="help-block label-right">  <i class="fa fa-users" aria-hidden="true"></i> Role </label>
						<select class='sel-opt' name='RoleId' id='RoleId'>
							<option value="">Select User Role</option>
							@if($roles) 
							@foreach ($roles as $roles)
                                <option value="{{{$roles->RoleId}}}"> {{ $roles->RoleName }} </option>
                            @endforeach
							@endif
						 </select>
					</div>
				</td>
			</tr>
			
			<tr class="box-section">
				<td width="33%"> 
					<div class="form-group">   <label for="name" class="help-block label-left"> <i class="fa fa-photo" aria-hidden="true"></i>  Profile Picture </label> 
                    <input type="file" name="name" id="name" class="form-control" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 6%; color:#999" value="" Required >
					</div>							
			    </td>
				<td width="33%"> 
				
					<div class="form-group">
						
					</div>

				</td>
				<td width="33%"> 

					<div class="form-group" id="shop" style="display:none">   <label for="RoleId" class="help-block label-right">  <i class="fa fa-bank" aria-hidden="true"></i> Workshop </label>
						<select class='sel-opt' name='WorkShopId' id='WorkShopId'>
							<option value="">Select Vendor Workshop</option>
							@if($workshops) 
							@foreach ($workshops as $workshops)
                                <option value="{{{$workshops->WorkShopId}}}"> {{ $workshops->WorkShopName }} </option>
                            @endforeach
							@endif
						 </select>
					</div>
				</td>
			</tr>
			
		</table>			 
					 
							
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">						
			<tr class="box-section">
				<td width="50%"> 
					
					<div class="form-group" style="margin-left:2%">
                        <button type="submit" class="btn btn-primary" id="newUserBtn">Create User</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>		
			    </td>
				<td width="50%"> 
					<div class="form-group">
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
					</div>	
					<div class="form-group">
						<input type="hidden" name="DomainId" id="DomainId" class="form-control" value="0" readonly > 
					</div>
					
					<div class="form-group">
						<input type="hidden" name="DOB" id="DOB" class="form-control" value="<?= date("M-d-Y") ?>" readonly > 
                        <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
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
	
	//displaying company location
	$(document).ready(function()
	{
		$('#newUserBtn').click(function()
		{
			//$('#ucompany').slideDown();
		});
	});
	
</script>		  
		

<script>
	$(document).ready(function()
	{
		$('#RoleId').change(function()
		{
			var RoleId = $(this).val();    var role_ID = "9";
			if(RoleId == role_ID){ $('#shop').slideDown();  }
			else { $('#shop').slideUp() }
			
			//if(role_name == '9'){ $('#shop').slideDown();  }
			//else { $('#shop').slideUp() }

		});

	});
	
	
	//checking if value entered is a valid telephone number
		function phonecheck()  
		{  
			var val = document.getElementById('Phone').value;
			if (/^\d{11}$/.test(val)) {	// value is ok, use it			
			} 
			else 
			{
				alert("Invalid number; must be eleven digits and Numbers only")
				//val.focus()
				return false
			}
		}
		
		
		function gendercheck()  
		{
			//VALIDATING GENSER
			var Sex_0 = document.getElementById('Sex_0').value;    var Sex_1 = document.getElementById('Sex_1').value;
			if(Sex_0 != 'Male' && Sex_1 != 'Female')
			{
				alert('Sorry, Please Select Gender');
			}
		}
	
</script>






@stop