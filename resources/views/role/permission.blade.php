@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?> 

<!-- Script to change the value of the clicked checkedbox  -->
<script>
$(document).ready(function()
{
    $('input[type=checkbox]').click(function () 
    {
        var id = this.id; //retrieving the clicked id of the checkedbox
        id = id += 's';  
        var val = document.getElementById(id).value;  
        if(val == 0){ document.getElementById(id).value = '1'; }
        else if(val == 1){ document.getElementById(id).value = '0'; }

    });
});
</script>



<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-universal-access"></i>  Users Permission </h1> 
	<p class="lead"> Set Permission for User Role  

    <?php
        $rid = $role->RoleId;
        $Role = DB::table('role')->where('RoleId', '=', $rid)->first();

        $permission = DB::table('permission')->where('RoleId', '=', $rid)->first();
    ?> <lead style="margin-left:10px;color:#999; font-side:20px">@if($Role) {{$Role->RoleName}}@endif</legend> 

    </p>
	</div>
	<form class="form-horizontal" method="post" action="{{ url('/role/permission_update', array($role->RoleId)) }}">

<div class="row  m-b-40 well white" style="margin-top:20px;" >

    <div class="row" style=""> <input type="hidden"@if($permission) value="{{$permission->RoleId}}"@endif name="RoleId" id="RoleId" />
    
        <div class="col-md-3"> 
            <label> <i class="fa fa-user"></i> User Administration </label>
            <input  id="UserAds" name="UserAd" type="hidden"  @if($permission) value="{{$permission->UserAd}}" @endif >
            <input  id="UserAd" type="checkbox" class="pull-left" @if($permission) @if($permission->UserAd == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-street-view"></i> User Profile </label>
            <input  id="UserPrs" name="UserPr" type="hidden"  @if($permission) value="{{$permission->UserPr}}" @endif >
            <input  id="UserPr" type="checkbox" class="pull-left" @if($permission) @if($permission->UserPr == 1) echo checked @endif @endif /> 
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-user-plus"></i> Driver Administration </label>
            <input  id="DriverAds" name="DriverAd" type="hidden"  @if($permission) value="{{$permission->DriverAd}}" @endif >
            <input  id="DriverAd" type="checkbox" class="pull-left" @if($permission) @if($permission->DriverAd == 1) echo checked @endif @endif /> 
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-street-view"></i> Driver Profile </label>
            <input  id="DriverPrs" name="DriverPr" type="hidden"  @if($permission) value="{{$permission->DriverPr}}" @endif >
            <input  id="DriverPr" type="checkbox" class="pull-left" @if($permission) @if($permission->DriverPr == 1) echo checked @endif @endif />
        </div>

    </div>
    <hr>
    <div class="row" style="">

        <div class="col-md-3"> 
            <label> <i class="fa fa-car"></i> Asset Management </label>
            <input  id="AssetMas" name="AssetMa" type="hidden"  @if($permission) value="{{$permission->AssetMa}}" @endif >
            <input  id="AssetMa" type="checkbox" class="pull-left" @if($permission) @if($permission->AssetMa == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-car"></i> Vehicle Profile </label>
            <input  id="VehiclePrs" name="VehiclePr" type="hidden"  @if($permission) value="{{$permission->VehiclePr}}" @endif >
            <input  id="VehiclePr"type="checkbox" class="pull-left" @if($permission) @if($permission->VehiclePr == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-briefcase"></i> Inventory Items </label>
            <input  id="InventoryIts" name="InventoryIt" type="hidden"  @if($permission) value="{{$permission->InventoryIt}}" @endif >
            <input  id="InventoryIt" type="checkbox" class="pull-left" @if($permission) @if($permission->InventoryIt == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-wrench"></i> Work Order </label>
            <input  id="WorkOrs" name="WorkOr" type="hidden"  @if($permission) value="{{$permission->WorkOr}}" @endif >
            <input  id="WorkOr" type="checkbox" class="pull-left" @if($permission) @if($permission->WorkOr == 1) echo checked @endif @endif />
        </div>

    </div>
    <hr>
    <div class="row" style="">  

        <div class="col-md-3"> 
            <label> <i class="fa fa-female"></i> Client Administration </label>
            <input  id="ClientAds" name="ClientAd" type="hidden"  @if($permission) value="{{$permission->ClientAd}}" @endif >
            <input  id="ClientAd" type="checkbox" class="pull-left" @if($permission) @if($permission->ClientAd == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-street-view"></i> Client Profile </label>
            <input  id="ClientPrs" name="ClientPr" type="hidden"  @if($permission) value="{{$permission->ClientPr}}" @endif >
            <input  id="ClientPr" type="checkbox" class="pull-left" @if($permission) @if($permission->ClientPr == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-car"></i> Client Asset </label>
            <input  id="ClientVes" name="ClientVe" type="hidden"  @if($permission) value="{{$permission->ClientVe}}" @endif >
            <input  id="ClientVe" type="checkbox" class="pull-left" @if($permission) @if($permission->ClientVe == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-wrench"></i> Client Quote </label>
            <input  id="ClientWos" name="ClientWo" type="hidden"  @if($permission) value="{{$permission->ClientWo}}" @endif >
            <input  id="ClientWo" type="checkbox" class="pull-left" @if($permission) @if($permission->ClientWo == 1) echo checked @endif @endif />
        </div>

    </div>
    <hr>
    <div class="row" style="">      

        <div class="col-md-3"> 
            <label> <i class="fa fa-bar-chart"></i> Report</label>
            <input  id="Reports" name="Report" type="hidden"  @if($permission) value="{{$permission->Report}}" @endif >
            <input  id="Report" type="checkbox" class="pull-left" @if($permission) @if($permission->Report == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-cog"></i> System Configuration</label>
            <input  id="SysteCos" name="SysteCo" type="hidden"  @if($permission) value="{{$permission->SysteCo}}" @endif >
            <input  id="SysteCo" type="checkbox" class="pull-left" @if($permission) @if($permission->SysteCo == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-puzzle-piece"></i> Job Management </label>
            <input  id="JobMas" name="JobMa" type="hidden"  @if($permission) value="{{$permission->JobMa}}" @endif >
            <input  id="JobMa" type="checkbox" class="pull-left" @if($permission) @if($permission->JobMa == 1) echo checked @endif @endif />
        </div> 

        <div class="col-md-3"> 
            <label> <i class="fa fa-cogs"></i> Job  </label>
            <input  id="Jobs" name="Job" type="hidden"  @if($permission) value="{{$permission->Job}}" @endif >
            <input  id="Job" type="checkbox" class="pull-left" @if($permission) @if($permission->Job == 1) echo checked @endif @endif />
        </div>

    </div>
    <hr>
    <div class="row" style="">

        <div class="col-md-3"> 
            <label> <i class="fa fa-clock-o"></i> Workforce Scheduler</label>
            <input  id="WorkforceScs" name="WorkforceSc" type="hidden"  @if($permission) value="{{$permission->WorkforceSc}}" @endif >
            <input  id="WorkforceSc" type="checkbox" class="pull-left" @if($permission) @if($permission->WorkforceSc == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="fa fa-truck"></i> Assign Vehicle</label>
            <input  id="AssignVes" name="AssignVe" type="hidden"  @if($permission) value="{{$permission->AssignVe}}" @endif >
            <input  id="AssignVe" type="checkbox" class="pull-left" @if($permission) @if($permission->AssignVe == 1) echo checked @endif @endif />
        </div>

        <div class="col-md-3"> 
            <label> <i class="md md-sync"></i> Assign Job </label>
            <input  id="AssignJos" name="AssignJo" type="hidden"  @if($permission) value="{{$permission->AssignJo}}" @endif >
            <input  id="AssignJo" type="checkbox" class="pull-left" @if($permission) @if($permission->AssignJo == 1) echo checked @endif @endif />
        </div> 

        <div class="col-md-3"> 
            <label> <i class="md md-group-work"></i> Community </label>
            <input  id="Communitys" name="Community" type="hidden"  @if($permission) value="{{$permission->Community}}" @endif >
            <input  id="Community" type="checkbox" class="pull-left" @if($permission) @if($permission->Community == 1) echo checked @endif @endif />
        </div>
        <input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly >
    </div>

    <br>

<div class="form-group">
   <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
    <button type="submit" class="btn btn-primary pull-right" name="updated" id="updated" > Update Permissions </button>   
</div>
   

       
  </div>        

        
        
    </Form>

      
		
	
</section>
</div>	
		


@stop