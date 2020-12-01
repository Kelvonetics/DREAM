@extends('templates.default')

@section('content')



<style>
    .amber-yellow
    {
        background-color:#FFA812;
    }
    .notif
    {
        background-color:red;     <!-- #E52B50 -->
        color:white;
    }
</style>


<!-- default values -->

<?php 
    $Un_Assign = 5;
    $noOfAvail = 12;
    $Ass_Assign = 7;
    $noOfSev = 3;

    $total_driver = 11;
    $engaged = 2;

    $tot_order = 14;
    $WOinPro = 4;
    $newWO = 9;

    $tot_job = 11;
    $inPro = 3;
?>




<div class="row"  style="margin-top:-50px">

  <div class="dashboard grey lighten-3">
    <div class="row no-gutter">
      <div class="col-sm-12 col-md-12 col-lg-9" style="background:#F9F9F9; margin-left:-15px;">
        <div class="p-20 clearfix" style="">
          <div class="pull-right"> <a href="#" target="_blank" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="More On"><i class="fa fa-arrows"></i></a>
            <div class="btn btn-round-sm btn-link" data-toggle="tooltip" title="Upload media"><i class="fa fa-upload"></i></div>
            <div class="btn btn-round-sm btn-link" data-toggle="tooltip" title="Write new document"><i class="fa fa-file"></i></div>
            <div class="btn btn-round-sm btn-link" data-toggle="tooltip" title="Add new user"><i class="fa fa-user-plus"></i></div>
          </div>
          <h4 class="grey-text">          <i class="fa fa-dashboard" style="color:lightblue"></i>          <span class="hidden-xs">Dream360 Home </span>        </h4> 
        </div>

                
    <div class="p-20 no-p-t">
    
    <!-- CARD BEGIN -->
      <div class="row gutter-14 kpi-dashboard">
      
        <!-- Vehicle card -->
      
        <div class="col-md-4">
          <div class="card small">
          <?php //$coll = '9'; ?>

      @if($Un_Assign > 10 )
              <div class="theme-lighten-1 p-10" style="height:50px">
            @elseif($Un_Assign >= 5 && $Un_Assign <= 10 )
        <div class="amber-yellow p-10" style="height:50px"> 
            @elseif($Un_Assign >= 0 && $Un_Assign <= 4 )
        <div class="green lighten-1 p-10" style="height:50px"> 
      @endif

              <div class="pull-right">
                <div class="white-text"> <i class="fa fa-line-chart text-rgb-5" style="color:#fff"></i> 3% </div>
              </div>
              <h4 class="no-margin white-text w600">Vehicle Status</h4>
              <div class="f11 white-text" style="opacity:0.8"> <i class="fa fa-calendar" aria-hidden="true"></i>
                <?= $date = date("Y-M-d"); ?>
              </div>
              <div class="p-10 p-t-30">
                <div id="chart-line-1"></div>
              </div>
            </div>
            
            
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                      {{$noOfAvail}} 
                  </h3>
                  <p class="grey-text w600">Total Vehicle</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $Ass_Assign }}
                  </h3>
                  <p class="grey-text w600">Assigned</p>
                </div>
                
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                    {{ $noOfSev }} 
                  </h3>
                  <p class="grey-text w600">In Service</p>
                </div>

                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $Un_Assign }} 
                  </h3>
                  <p class="grey-text w600">Unassigned</p>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        
        <!-- Driver card -->
        
        <div class="col-md-4">
          <div class="card small">
          <?php $idle = '9'; ?>
 
      @if($idle > 10 )
              <div class="theme-lighten-1 p-10" style="height:50px">
            @elseif($idle >= 5 && $idle <= 10 )
        <div class="amber-yellow p-10" style="height:50px"> 
            @elseif($idle >= 0 && $idle <= 4 )
        <div class="green lighten-1 p-10" style="height:50px"> 
      @endif
    
                        
            <!--   <div class="theme-secondary-lighten-1 p-10" style="height:50px">  -->
              <div class="pull-right">
                <div class="white-text"> <i class="fa fa-line-chart text-rgb-5" style="color:#fff"> </i> 6% </div>
              </div>
              <h4 class="no-margin white-text w600">Driver Status</h4>
              <div class="f11 white-text" style="opacity:0.8">  <i class="fa fa-calendar" aria-hidden="true"></i>
              <?= date("Y-M-d"); ?>  </div>
              <div class="p-10 p-t-30">
                <div id="chart-line-2"></div>
              </div>
            </div>
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                    {{ $total_driver }}
                  </h3>
                  <p class="grey-text w600">Total Drivers</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $engaged }}
                  </h3>
                  <p class="grey-text w600">Engaged</p>
                </div>
                
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                    {{ '0' }}
                  </h3>
                  <p class="grey-text w600">Absent Today</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $idle }}
                  </h3>
                  <p class="grey-text w600">Idle</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- JOB card -->
        
        <div class="col-md-4">
          <div class="card small">
          <?php $jobdue = '13'; ?>
 
      @if($jobdue > 10 )
              <div class="theme-lighten-1 p-10" style="height:50px">
            @elseif($jobdue >= 5 && $jobdue <= 10 )
        <div class="amber-yellow p-10" style="height:50px"> 
            @elseif($jobdue >= 0 && $jobdue <= 4 )
        <div class="green lighten-1 p-10" style="height:50px"> 
      @endif
                        
            <!--  <div class="green lighten-1 p-10" style="height:50px">  -->
              <div class="pull-right">
                <div> <i class="fa fa-line-chart text-rgb-5" style="color:white"> </i> 9% </div>
              </div>
              <h4 class="no-margin white-text w600"> Job Status</h4>
              <div class="f11" style="opacity:0.8"> <i class="fa fa-calendar" aria-hidden="true"></i> 
              <?= $date = date("Y-M-d");  ?></div>
              <div class="p-10 p-t-30">
                <div id="chart-line-3"></div>
              </div>
            </div>
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300"> {{ $tot_job }}  </h3>
                  <p class="grey-text w600">Total Jobs</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300"> {{ $inPro }} </h3>
                  <p class="grey-text w600">In Progress</p>
                </div>
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300"> {{ $jobdue }} </h3>
                  <p class="grey-text w600">Due Today</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300"> 0 </h3>
                  <p class="grey-text w600">Unassigned</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- SECOND CARD INFO -->
      
      
      <!-- WORK ORDER card -->
      <div class="row gutter-14 kpi-dashboard">
      
      <div class="col-md-4">
          <div class="card small">
           <?php $WOdue = '13'; ?>
 
       @if($WOdue > 10 )
              <div class="theme-lighten-1 p-10" style="height:50px">
            @elseif($WOdue >= 5 && $WOdue <= 10 )
        <div class="amber-yellow p-10" style="height:50px"> 
            @elseif($WOdue >= 0 && $WOdue <= 4 )
        <div class="green lighten-1 p-10" style="height:50px"> 
      @endif
                        
            <!--  <div class="theme-lighten-1 p-10" style="height:50px">  -->
              <div class="pull-right">
                <div> <i class="fa fa-line-chart text-rgb-5" style="color:white"> </i> 29% </div>               
              </div>
              <h4 class="no-margin white-text w600">Work Order Status</h4>
              <div class="f11" style="opacity:0.8"> <i class="fa fa-calendar" aria-hidden="true"></i>
                <?= $date = date("Y-M-d");  ?>
              </div>
              <div class="p-10 p-t-30">
                <div id="chart-line-1"></div>
              </div>
            </div>
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                    {{$tot_order}}
                  </h3>
                  <p class="grey-text w600">Total WO</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $WOinPro }}
                  </h3>
                  <p class="grey-text w600">In Progress</p>
                </div>
                
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                    {{ $newWO }}
                  </h3>
                  <p class="grey-text w600">New WO</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                    {{ $WOdue }}
                  </h3>
                  <p class="grey-text w600">Due Today</p>
                </div>
                
              </div>
            </div>
          </div>
        </div>
       
       <!-- EXPENSE card  NOTE FOR DATABASE DATA  -->
       <div class="col-md-4">
          <div class="card small">
            <div class="theme-secondary-lighten-1 p-10" style="height:50px">
              <div class="pull-right">
                <div> <i class="fa fa-line-chart text-rgb-5" style="color:white"> </i> 42% </div>
              </div>
              <h4 class="no-margin white-text w600">Today's Expenses</h4>
              <div class="f11" style="opacity:0.8">  <i class="fa fa-calendar" aria-hidden="true"></i>
              <?= $date = date("Y-M-d"); ?>  </div>
              <div class="p-10 p-t-30">
                <div id="chart-line-2"></div>
              </div>
            </div>
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                        <?php   $noOfExp = 5;   echo  $noOfExp; ?>   <!-- GET SQL QUERY -->
                  </h3>
                  <p class="grey-text w600">All Expenses</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                        <?php   $noOfRexp = 4;  echo  $noOfRexp; ?>   <!-- GET SQL QUERY -->
                  </h3>
                  <p class="grey-text w600">Regular </p>
                </div>
                
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">
                        <?php           $today = date('M/d/Y');     $noOfOff = 8;   echo  $noOfOff; ?>   <!-- GET SQL QUERY -->
                  </h3>
                  <p class="grey-text w600">Official </p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">
                        <?php       $today = date('m/d/Y'); $noOfUnOff = 7; echo  $noOfUnOff; ?>   <!-- GET SQL QUERY -->
                  </h3>
                  <p class="grey-text w600">Unofficial </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <!-- INCIDENT card -->
        <div class="col-md-4">
          <div class="card small">
            <div class="green lighten-1 p-10" style="height:50px">
              <div class="pull-right">
                <div> <i class="fa fa-line-chart text-rgb-5" style="color:white"> </i> 05% </div>
              </div>
              <h4 class="no-margin white-text w600"> Today's Incidents</h4>
              <div class="f11" style="opacity:0.8"> <i class="fa fa-calendar" aria-hidden="true"></i> 
              <?= $date = date("Y-M-d"); ?></div>
              <div class="p-10 p-t-30">
                <div id="chart-line-3"></div>
              </div>
            </div>
            <div class="card-content p-10">
              <div class="row">
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">43</h3>
                  <p class="grey-text w600">Total Incidents</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">39 </h3>
                  <p class="grey-text w600">InProgress</p>
                </div>
                <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                  <h3 class="no-margin w300">12</h3>
                  <p class="grey-text w600">New Incident</p>
                </div>
                <div class="col-md-6 text-center">
                  <h3 class="no-margin w300">7 </h3>
                  <p class="grey-text w600">Complete</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      
      </div>
      
      

      
      
      <!-- END OF CARD -->
      
      
      <!-- WORK ORDER NOTIFICATION  --> 
      <?php //$email = $this->request->Session()->read('Auth.User.email');   $shop = $this->request->Session()->read('Auth.User.WorkShopId');   $roled = $this->request->Session()->read('Auth.User.RoleId'); ?>
      <div class="row gutter-14">
        <div class="col-md-12 col-md-5">
          <div class="card">
            <div class="card-header relative">
              <div class="card-title" style="margin:0px 0px -15px -11px">
                    <?php //if($role_name == 'Vendor/Mechanic'){ echo 'Pending Review - Work Order'; }
                        //else if($role_name == 'Fleet Manager'){ echo 'Pending Approvals - Work Order'; } ?>
            {{ 'Work Order Status' }}
              </div>

              <a href="#" title = 'View All Orders' class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
        <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
            <tr>                    
                <th scope="col" style="font-weight:normal">WO NO</th>
                <th scope="col" style="font-weight:normal">Vehicle</th>
                <th scope="col" style="font-weight:normal">Due Date</th>
                <th scope="col" style="font-weight:normal">Status</th>
                <th scope="col" style="font-weight:normal">State</th>
                <th scope="col" style="font-weight:normal">Total Amt</th>
                <th scope="col" style="font-weight:normal">Action</th>
            </tr>
        <tbody>
      <!-- POPULATE TABLE WITH WORKORDER DATA -->
    </tbody>
        </table>
              
            </div>
          </div>
        </div>
    
      </div>
      
      
      
    <!-- INVOICE NOTIFICATION  --> 

      <div class="row gutter-14">
        <div class="col-md-12 col-md-5">
          <div class="card">
            <div class="card-header relative">
              <div class="card-title" style="margin:0px 0px -15px -11px">
                    <?php //if($roled == '10'){ echo 'Pending Approvals - Invoice'; } ?>   {{ 'Pending Approvals - Invoice' }}
              </div>

              <a href="#" title = 'View All Invoices' class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
        <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
            <tr>                    
                <th scope="col" style="font-weight:normal">INV NO</th>
                <th scope="col" style="font-weight:normal">Client</th>
                <th scope="col" style="font-weight:normal">Date</th>
                <th scope="col" style="font-weight:normal">Status</th>
                <th scope="col" style="font-weight:normal">State</th>
                <th scope="col" style="font-weight:normal">Total Amt</th>
                <th scope="col" style="font-weight:normal">Action</th>
            </tr>
        <tbody>
        <!-- POPULATE TABLE WITH INVOICE DATA -->
    </tbody>
    </table>
    
  </div>
  </div>
</div>

</div>
      
      
      
      
      
      <div class="row gutter-14">
   
   
        <div class="col-md-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title" style="margin:0px 0px 0px -11px">Latest Schedule Maintenance</div>
              <div class="small grey-text" style="margin:0px 0px 0px -11px">Overview of the last 3 Schedule Maintenance</div>
            
            <a href="#" title = 'View All Maintenance'class="btn btn-info pull-right"     style="margin:-15px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">

             <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
                    <tr>
                        <th scope="col" style="font-weight:normal">License Plate</th>
                        <th scope="col" style="font-weight:normal">Mile Int</th>
                        <th scope="col" style="font-weight:normal">Date Int</th>
                        <th scope="col" style="font-weight:normal">Late Mile</th>
                        <th scope="col" style="font-weight:normal">Last Date</th>
                        <th scope="col" style="font-weight:normal">Curr Mile</th>
                    </tr>
            <tbody>
                <!-- POPULATE TABLE WITH Schedule Maintenance DATA -->
                </tbody>
                </table>
            
            </div>
          </div>
        </div>

      </div>
      
      <div class="row gutter-14">
        <div class="col-md-12 col-md-5">
          <div class="card">
            <div class="card-header relative">
              <div class="card-title" style="margin:0px 0px 0px -11px">Todays Jobs</div>
              <div class="small grey-text" style="margin:0px 0px 0px -11px">The Last 3 Jobs From Dream 360</div>
                <a href="#" title = 'View All Fuel Logs' class="btn btn-info pull-right"     style="margin:-15px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
              <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
                    <tr>
                        <th scope="col" style="font-weight:normal">ID</th>
                        <th scope="col" style="font-weight:normal">Type</th>                            
                        <th scope="col" style="font-weight:normal">Status</th>
                        <th scope="col" style="font-weight:normal">Start Date</th>
                        <th scope="col" style="font-weight:normal">End Date</th>
                        <th scope="col" style="font-weight:normal">Street</th>
                        <th scope="col" style="font-weight:normal">Client</th>
                    </tr>
            <tbody>
                  <!-- POPULATE TABLE WITH JOBS DATA -->
                </tbody>
                </table>
              
            </div>
          </div>
        </div>


        
      </div>
      
      <div class="row gutter-14">
        <div class="col-lg-12 col-md-6">
          <div class="todo-widget card bordered small">
            <div class="card-header">
              <div class="action pull-right">
                <button type="button" class="btn btn-round btn-flat btn-default" data-title="Clear completed" data-toggle="tooltip"> <i class="fa fa-check"></i> </button>
              </div>
              <h2 class="card-title"><i class="fa fa-user-secret theme-primary"></i> Todo's</h2> </div>
            <div class="card-content">
              <ul class="list-unstyled">
                <li>
                  <div class="checkbox"> <span class="pull-right">            <button type="button" class="btn btn-round btn-flat btn-default">              <i class="fa fa-pencil"></i>            </button>          </span>
                    <label class=" strike">
                      <input type="checkbox"> Asset Configuration</label>
                  </div>
                </li>
                <li>
                  <div class="checkbox"> <span class="pull-right">            <button type="button" class="btn btn-round btn-flat btn-default">              <i class="fa fa-pencil"></i>            </button>          </span>
                    <label>
                      <input type="checkbox"> Assigning Operator To Equipment </label>
                  </div>
                </li>
                <li>
                  <div class="checkbox"> <span class="pull-right">            <button type="button" class="btn btn-round btn-flat btn-default">              <i class="fa fa-pencil"></i>           </button>          </span>
                    <label>
                      <input type="checkbox"> View Fuel Report And Log </label>
                  </div>
                </li>
              </ul>
            </div>
            <div class="card-action clearfix">
              <form class="form">
                <div class="form-group input-group">
                  <input id="todo-title" class="form-control ng-animate ng-touched-add" type="text" data-ng-animate="2" style="">
                  <div class="input-group-btn p-l-10">
                    <button type="button" class="btn btn-default">Add</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      
      </div>

    </div>
  </div>


  <div class="col-lg-3 col-md-12" style="">
    <div class="p-20">
      <div class="pull-right">
        <ul class="list-unstyled">
          <li class="dropdown">
            <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
          </li>
        </ul>
      </div>
      <h4 class="grey-text m-b-30">Action feed</h4>
      <div class="card">
        <div class="p-10 p-l-20 p-r-20 clearfix">
          <div class="badge pull-right">4</div>
          <div class="w600 f11 grey-text">Insights</div>
        </div>
        <div class="table-responsive">
          <table class="table table-small grey-text">
            <colgroup>
              <col width="">
                <col width="60">
                  <col width="50">
            </colgroup>
            <tbody>
              <tr>
                <td> Driver Incidents Weekly</td>
                <td>3</td>
                <td><i class="fa fa-caret-up green-text"></i></td>
              </tr>
              <tr>
                <td>Job Assignment Weekly</td>
                <td>7</td>
                <td><i class="fa fa-caret-up green-text"></i></td>
              </tr>
              <tr>
                <td>Workorder Weekly</td>
                <td>12</td>
                <td><i class="fa fa-caret-down red-text"></i></td>
              </tr>
              <tr>
                <td>Fuel Purchase Weekly</td>
                <td>16</td>
                <td><i class="fa fa-caret-up green-text"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="p-h-40">
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a aria-controls="home" role="tab" data-toggle="tab" href="#tab-notif">Notifications</a></li>
          <li role="presentation"><a aria-controls="home" role="tab" data-toggle="tab" href="#tab-reminder">Reminder</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content m-t-10">
          
          <!-- EMAIL NOTIFICATION  -->
          <div role="tabpanel" class="tab-pane active" id="tab-notif">
            <ul class="timeline">
      <li>
                            <div class="timeline-badge"><i class="fa fa-envelope"></i></div>
                            <div class="timeline-panel">
                              <div class="timeline-heading">
                                <h4 class="timeline-title">{{ 'Email'}}</h4> </div>
                              <div class="timeline-body"> <span spanlaceholder-p=""></span> <small class=""><i class="fa fa-timer"></i>{{ 'Message' }}</small> <small class="text-muted"><i class="md md-timer"></i> {{date('Y-M-d')}}</small></div>
                            </div>
                        </li>
            </ul>
          </div>
        
          <!-- SERVICE REMINDER  -->
          <div role="tabpanel" class="tab-pane" id="tab-reminder">
            <ul class="timeline">
              <li>
                <div class="timeline-badge"> <i class="icon-circle theme-border"></i> </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4 class="timeline-title">E-mail confirmation</h4> </div>
                  <div class="timeline-body">
                    <p>A new user has registered and confirmed his account</p> <small class="text-muted"><i class="md md-timer"></i> 11 hours ago</small> </div>
                </div>
              </li>
             
            </ul>
          </div>
         
        </div>
      </div>
    </div>

    <div id="chart-pagesviews"></div>
  </div>
</div>
</div>


</div>

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

        <script>
            $(document).ready(function()
            {
                $('#example').dataTable();
            });
        </script>



@stop