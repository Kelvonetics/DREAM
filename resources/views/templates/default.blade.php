
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Best Fleet Management System Around">
    <meta name="author" content="Rytegate Technologies">
    <meta name="msapplication-TileColor" content="#9f00a7">
    <meta name="msapplication-TileImage" content="{{URL::asset('assets/img/favicon/mstile-144x144.png')}}">
    <meta name="msapplication-config" content="{{URL::asset('assets/img/favicon/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="{{URL::asset('assets/img/favicon/manifest.json')}}">
    <link rel="shortcut icon" href="{{URL::asset('assets/img/dr.png')}}">
    <title>Dream360- Fleet Management System</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>  
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>  <![endif]-->
    <link href="{{URL::asset('assets/css/vendors.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/css/styles.min.css')}}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script charset="utf-8" src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <style type="text/css"> 
        
    </style>
  </head>


  <!-- LOGGED IN USER  -->
  <?php  $auth_user = Auth::user();  $photos = $auth_user->UserPicture; ?>

  <!-- USER ROLE -->
  <?php  $r_id = $auth_user->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();   ?>
 

  <body scroll-spy="" id="top" class=" theme-template-dark theme-pink alert-open alert-with-mat-grow-top-right">
    <main>

      <aside class="sidebar fixed" style="width: 260px; left: 0px;">
        <div class="brand-logo">
           <div style="margin:5px auto -3px 25px"> <img src="{{URL::asset('assets/img/dreamlogowhite.png')}}" class="img-responsive" height="60%" width="60%"> </div>
            </div>
        <div class="user-logged-in">
          <div class="content">

            <a href="#" title="Change Profile Photo">
            <img src="{{URL::asset('assets/img/users/'.$photos)}}" class="img-responsive" height="55" width="35" style="float:right;marg-top-20px; border-radius:18px">
          </a>

            <div class="user-name"> {{$auth_user->FirstName.' '.$auth_user->LastName}} </div>
            <div class="user-email"> {{$auth_user->email}} </div>
            <div class="user-actions"> <a class="m-r-5" href="#">Profile</a> 
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"> Logout
                </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
             </div>
          </div>
        </div>
        <ul class="menu-links">
          <li icon="md md-blur-on"> <a href="{{ url('/') }}"><i class="md md-blur-on"></i>&nbsp;<span>Dashboard</span></a></li>
          
          <!-- USER ADMINISTRATION AUTHORIZATION -->
          <?php $UserAd = $perm->UserAd;  ?>
          @if($UserAd)
          <li> <a href="#" data-toggle="collapse" data-target="#user" class="collapsible-header"><i class="md md-people"></i>&nbsp;User Administration</a>
            <!-- USER PROFILE AUTHORIZATION -->
            <?php $UserPr = $perm->UserPr;  ?>
            @if($UserPr)
            <ul id="user" class="collapse">
              <li name="user">
                <a href="{{route('user.index')}}"> <span> <i class="md md-person-add"></i>&nbsp; User Profile </span></a>
              </li>
            </ul>
            @endif
          </li>
          @endif

          <!-- DRIVER ADMINISTRATION AUTHORIZATION -->
          <?php $DriverAd = $perm->DriverAd;  ?>
          @if($DriverAd)
          <li> <a href="#" data-toggle="collapse" data-target="#driver" class="collapsible-header"><i class="md md-person"></i>&nbsp;Driver Administration</a>
            <!-- DRIVER PROFILE AUTHORIZATION -->
            <?php $DriverPr = $perm->DriverPr;  ?>
            @if($DriverPr)
            <ul id="driver" class="collapse">
              <li name="dprofile">
                <a href="{{route('operator.index')}}"> <span><i class="md md-person-add"></i>&nbsp; Driver Profile </span></a>
              </li>
            </ul>
            @endif
          </li>
          @endif

          <!-- ASSET MANAGEMENT AUTHORIZATION -->
          <?php $AssetMa = $perm->AssetMa;  ?>
          @if($AssetMa)
          <li> <a href="#" data-toggle="collapse" data-target="#vehicle" class="collapsible-header"><i class="md md-local-shipping"></i>&nbsp;Asset Management</a>
            <ul id="vehicle" class="collapse">
              <!-- VEHICLE PROFILE AUTHORIZATION -->
              <?php $VehiclePr = $perm->VehiclePr;  ?>
              @if($VehiclePr)
              <li name="vprofile">
                <a href="{{route('asset.index')}}"> <span><i class="md md-directions-car"></i>&nbsp; Vehicle Profile </span></a>
              </li>
              @endif

              <!-- WORK ORDER AUTHORIZATION -->
              <?php $WorkOr = $perm->WorkOr;  ?>
              @if($WorkOr)
              <li name="order">
                <a href="{{route('workorder.index')}}"> <span><i class="md md-layers"></i>&nbsp; Work Order </span></a>
              </li>
              @endif

              <!-- INVENTORY ITEM AUTHORIZATION -->
              <?php $InventoryIt = $perm->InventoryIt;  ?>
              @if($InventoryIt)
              <li name="inventory">
                <a href="{{route('inventoryItem.index')}}"> <span><i class="md md-iso"></i>&nbsp; Inventory Item </span></a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          <!-- CLIENT MANAGEMENT AUTHORIZATION -->
          <?php $ClientAd = $perm->ClientAd;  ?>
          @if($ClientAd)
          <li> <a href="#" data-toggle="collapse" data-target="#client" class="collapsible-header"><i class="md md-group"></i>&nbsp;Client Management</a>
            <ul id="client" class="collapse">
              <!-- CLIENT PROFILE AUTHORIZATION -->
              <?php $ClientPr = $perm->ClientPr;  ?>
              @if($ClientPr)
              <li name="cprofile">
                <a href="{{route('client.index')}}"> <span><i class="md md-group-add"></i>&nbsp; Client Profile </span></a>
              </li>
              @endif

              <!-- CLIENT VEHICLE AUTHORIZATION -->
              <?php $ClientVe = $perm->ClientVe;  ?>
              @if($ClientVe)
              <li name="clientAsset">
                <a href="{{route('clientasset.index')}}"> <span><i class="md md-directions-car"></i>&nbsp; Client Asset </span></a>
              </li>
              @endif

              <!-- CLIENT QUOTE AUTHORIZATION -->
              <?php $ClientWo = $perm->ClientWo;  ?>
              @if($ClientWo)
              <li name="quote">
                <a href="{{route('clientworkorder.index')}}"> <span><i class="md md-layers"></i>&nbsp; Client Quote </span></a>
              </li>
              @endif
              
              <li name="invoice">
                <a href="{{route('invoice.index')}}"> <span><i class="md md-iso"></i>&nbsp; Invoice</span></a>
              </li>
            </ul>
          </li>
          @endif

          <!-- JOB MANAGEMENT AUTHORIZATION -->
          <?php $JobMa = $perm->JobMa;  ?>
          @if($JobMa)
          <li> <a href="#" data-toggle="collapse" data-target="#job" class="collapsible-header"><i class="md md-extension"></i>&nbsp;Job Management</a>
            <!-- JOB AUTHORIZATION -->
            <?php $Job = $perm->Job;  ?>
            @if($Job)
            <ul id="job" class="collapse">
              <li name="cprofile">
                <a href="{{route('job.index')}}"> <span><i class="md md-explore"></i>&nbsp; Jobs </span></a>
              </li>
            </ul>
            @endif
          </li>
          @endif

          <!-- WORKFORCE SCHEDULER AUTHORIZATION -->
          <?php $WorkforceSc = $perm->WorkforceSc;  ?>
          @if($WorkforceSc)
          <li> <a href="#" data-toggle="collapse" data-target="#scheduler" class="collapsible-header"><i class="md md-sync"></i>&nbsp;Workforce Scheduler</a>
            <ul id="scheduler" class="collapse">
              <!-- ASSIGN VEHICLE AUTHORIZATION -->
              <?php $AssignVe = $perm->AssignVe;  ?>
              @if($AssignVe)
              <li name="cprofile">
                <a href="{{route('asset.assignvehicle')}}"> <span><i class="md md-check"></i>&nbsp; Assign Vehicle </span></a>
              </li>
              @endif

              <!-- ASSIGN JOB AUTHORIZATION -->
              <?php $AssignJo = $perm->AssignJo;  ?>
              @if($AssignJo)
              <li name="cprofile">
                <a href="{{route('job.assignjob')}}"> <span><i class="md md-check"></i>&nbsp; Assign Job </span></a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          <!-- COMMUNITY AUTHORIZATION -->
          <?php $Community = $perm->Community;  ?>
          @if($Community)
          <li> <a href="#" data-toggle="collapse" data-target="#Community" class="collapsible-header"><i class="md md-group-work"></i>&nbsp;Community</a>
            <ul id="Community" class="collapse">
              <li name="cprofile">
                <a href="{{route('workshop.index')}}"> <span><i class="md md-local-shipping"></i>&nbsp; Auto Workshop </span></a>
              </li>
              <li name="cprofile">
                <a href="{{route('community.ride-share-index')}}"> <span><i class="md md-share"></i>&nbsp; Ride Share</span></a>
              </li>
              <li name="cprofile">
                <a href="#"> <span><i class="md md-local-car-wash"></i>&nbsp; Road Assistance </span></a>
              </li>
              <li name="cprofile">
                <a href="#"> <span><i class="md md-nature-people"></i>&nbsp; D.R.E.A.M Marketplace </span></a>
              </li>
            </ul>
          </li>
          @endif

          <!-- REPORT AUTHORIZATION -->
          <?php $Report = $perm->Report;  ?>
          @if($Report)
          <li> <a href="#" data-toggle="collapse" data-target="#Report" class="collapsible-header"><i class="md md-sort"></i>&nbsp;Report</a>
            <ul id="Report" class="collapse">
              <li name="cprofile">
                <a href="#"> <span><i class="md md-tune"></i>&nbsp; Vehicle Report</span></a>
              </li>
             
              <li name="cprofile">
                <a href="#"> <span><i class="md md-tune"></i>&nbsp;Job Report </span></a>
              </li>
            </ul>
          </li>
          @endif

          <!-- SYSTEM CONFIGURATION AUTHORIZATION -->
          <?php $SysteCo = $perm->SysteCo;  ?>
          @if($SysteCo)
          <li> <a href="#" data-toggle="collapse" data-target="#sysconf" class="collapsible-header"><i class="md md-settings"></i>&nbsp;System Configuration</a>
            <ul id="sysconf" class="collapse">
              <li> <a href="{{route('role.index')}}"><span><i class="md md-account-circle" style="width:20px"></i>&nbsp; User Role</span></a></li>       
              <li> <a href="{{route('userposition.index')}}"><span><i class="md md-perm-identity" style="width:20px"></i> &nbsp; User Position</span></a></li>
              <li> <a href="{{route('department.index')}}"><span><i class="md md-business" style="width:20px"></i> &nbsp; User Department</span></a></li>
              <li> <a href="{{route('companylocation.index')}}"><span><i class="md md-pin-drop" style="width:20px"></i>&nbsp; Company Location</span></a></li>
              <li> <a href="{{route('assetmake.index')}}"><span><i class="md md-directions-car" style="width:20px"></i> &nbsp; Vehicle Make</span></a></li>
              <li> <a href="{{route('assetmodel.index')}}"><span><i class="md md-directions-car" style="width:20px"></i> &nbsp; Vehicle Model</span></a></li>
              <li> <a href="{{route('assettype.index')}}"><span><i class="md md-directions-car" style="width:20px"></i> &nbsp; Vehicle Type</span></a></li>
              <li> <a href="{{route('vendor.index')}}"><span><i class="md md-directions-bus" style="width:20px"></i> &nbsp; Vendor</span></a></li>
              <li> <a href="{{route('invcategory.index')}}"><span><i class="md md-storage" style="width:20px"></i> &nbsp; Inventory  Category</span></a></li>
              <li> <a href="{{route('workorderlabour.index')}}"><span><i class="md md-layers" style="width:20px"></i> &nbsp; WorkOrder Labour</span></a></li>
              <li> <a href="{{route('autodealer.index')}}"><span><i class="md md-camera-front" style="width:20px"></i> &nbsp; Auto Dealer</span></a></li>
            </ul>
          </li>
          @endif
        
        </ul>
      </aside>

      <div class="main-container">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header pull-left">
              <button type="button" class="navbar-toggle pull-left m-15" data-activates=".sidebar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Dream360</a></li>
                <li class="active">Dashboard</li>
              </ul>
            </div>
            <ul class="nav navbar-nav navbar-right navbar-right-no-collapse">
              <li class="dropdown pull-right">
                <button class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple" data-template-url="#"> <i class="md md-more-vert f20"></i> </button>
              </li>
              <li class="dropdown pull-right">
                <a class="dropdown-toggle btn btn-round-sm btn-link withoutripple" href="{{ url('/settings') }}" style="margin-top:-10px;color:#E32636"> <i class="md md-settings f20"></i> </a>
              </li>
              <li navbar-search="" class="pull-right">
                <div>
                  <div class="mat-slide-right pull-right">
                    <form class="search-form form-inline pull-left ">
                      <div class="form-group">
                        <label class="sr-only" for="search-input">Search</label>
                        <input type="text" class="form-control" id="search-input" placeholder="Search" autofocus=""> </div>
                    </form>
                  </div>
                  <div class="pull-right">
                    <button class="btn btn-sm btn-link pull-left withoutripple"> <i class="md md-search f20"></i> </button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">












            <!-- OUR CONTENT -->
            <section class="forms-advanced">
            
                @yield('content')

            </section>










        </div>
      </div>
    </main>


    <style>
    .glyphicon-spin-jcs {
      -webkit-animation: spin 1000ms infinite linear;
      animation: spin 1000ms infinite linear;
    }
    
    @-webkit-keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
      }
    }
    
    @keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
      }
    }
    </style>
    <label style="visibility: hidden; position: absolute; overflow-x: hidden; overflow-y: hidden; width: 0px; height: 0px; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; " tabindex="-1">upload
      <input type="file" ngf-select="">
    </label>
    <label style="visibility: hidden; position: absolute; overflow-x: hidden; overflow-y: hidden; width: 0px; height: 0px; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; " tabindex="-1">upload
      <input type="file" ngf-drop="" ngf-select="" ngf-drag-over-class="dragover" ngf-multiple="true" ngf-allow-dir="true" ngf-accept="'.jpg,.png,.gif'" multiple="multiple" accept=".jpg,.png,.gif">
    </label>

    <script charset="utf-8" src="{{URL::asset('assets/js/vendors.min.js')}}"></script>
    <script charset="utf-8" src="{{URL::asset('assets/js/app.min.js')}}"></script>
    <script charset="utf-8" src="{{URL::asset('assets/js/Chart.min.js')}}"></script>
    <!-- <script charset="utf-8" src="{{URL::asset('assets/js/js.js')}}"></script> -->

    <script>
      $(document).ready(function()
      {
        $('#example').dataTable();
      });
    </script>


  </body>
</html>