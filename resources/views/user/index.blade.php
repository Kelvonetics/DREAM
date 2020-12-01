@extends('templates.default')

@section('content')



<div class="main-content" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
	<section class="tables-data">
	<div class="page-header" style="margin-bottom:10px;">
	<h1>      <i class="fa fa-users"></i>    User Administration </h1>
			<p class="lead"> The user administration module allows you to create a new user, view a list of users you previously created and modify an existing user's details. </p
	
		</div>
	
	
	<div class="">
              
			  
			  
	<div class="row  m-b-40">

    <!-- left content -->
        <div class="col-md-12 col-md-pull-0"> 
        <a href="{{ route('user.add') }}" class="btn " style="margin-bottom:5px;box-shadow:0px 0px 0px; color:#fff;background-color:#e91e63; font-size:11px"> <i class="fa fa-plus"></i>  New User</a> 
        <div class="well white">

        @if(session('info'))
            <div class="alert alert-success">
                {{session('info')}}
            </div>
        @endif	
				
    <table id="example" class="table table-full table-full-small user" cellspacing="0" width="100%">
		<thead>	
			<tr style="">
				<th> First Name </th>
				<th> Last Name </th>
				<th> Department </th>
				<th> Position </th>
				<th> Email </th>
				<th> Location </th>
				<th> Status </th>
				<th> </th>
			</tr>
		</thead>	
            
			<tbody>
			@if($users) 
            @foreach ($users as $users)
            <tr>
				<td>{{$users->FirstName}}</td>
                <td>{{$users->LastName}}</td>
                <td>
				<?php 
					$did = $users->DeptId;
					$department = DB::table('department')->where('DeptId', '=', $did)->first();
				?> @if($department) {{$department->DeptName}} @endif
			</td>
			<td>
				<?php 
					$pid = $users->PositionId;
					$position = DB::table('userposition')->where('PositionId', '=', $pid)->first();
				?> @if($position) {{$position->PositionName}} @endif
			</td>
                <td>{{$users->email}}</td>
                <td>
					<?php 
						$lid = $users->LocationId;
						$location = DB::table('companylocation')->where('LocationId', '=', $lid)->first();
					?>   @if($location) {{$location->LocationName}} @endif
				</td>

				<td align="left" style="color:#fff">	
						@if($users->Active == 1)
                         <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px"> 
						@elseif($users->Active == 0)
                        <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                        @endif
				</td>
				<td>
				<a class="btn btn-success fa fa-edit" href="{{route('user.edit', $users->UserId)}}" id="{{$users->UserId}}" style="font-size:9px; color:#fff"></a> 
			  </td>

            </tr>
            @endforeach
			@endif
        </tbody>
				</table>


		

</div>
  </div>
	
	
</div>
</div>
</section>


</div>

<script>
	$(document).ready(function()
	{
		$('.user').dataTable();
	});
</script>
 

<script>      //AJAX FUNCTION TO ADD USER AS OPERATOR
	$(document).ready(function()
	{
		
		$("#assignOp").click(function(ad)
		{
			var UserId = "{{$users->UserId}}";
			var DeptId = "{{$users->DeptId}}";
			var Status = "Assigned";
			var CreatedBy = "Donald Trump";
			var created = '2017';
			var modified = '2017';
			// Returns successful data submission message when the entered information is stored in database.
			var psdata = 'UserId='+ UserId + '&DeptId='+ DeptId + '&Status='+ Status + '&CreatedBy='+ CreatedBy + '&created='+ created + '&modified='+ modified;
			
			ad.preventDefault();
			// AJAX Code To Submit Form.
			$.ajax(
			{
				type: "POST",
				url: "",
				data: psdata,
				cache: false,
				success: function()				{					alert('User Added As Operator Successful');						}
			});	
		});
		return false;

	});
	
</script>

<script>      // FUNCTION 
	$(document).ready(function()
	{
		 $('#pnate').change(function() 
		 {
			
		 });
	});
	
</script>






<!-- Edit User Modal -->						
<div class="modal fade" id="userModal" role="dialog"  style="height:60%; margin:0.5% 50%">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
	  <h4 style="color:red; margin-left:-18px"> User Administration </h4>
	</div> 

	
							
</div>




@stop