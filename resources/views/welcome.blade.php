@extends('templates.default')

@section('content')

<?php  $auth_user = Auth::user(); ?>


<style>
    .amber-yellow
    {
        background-color:#FFA812;
    }
    .notif
    {
        background-color:red;     /* #E52B50 */
        color:white;
    }
</style>


<!-- Dashboard data infomation -->
<?php   
  $Today = date('Y-M-j'); $dueToday = date('m/d/Y'); 
  $s_time = date('Y-m-d').' 00:00:00';   $e_time = date('Y-m-d').' 23:59:00';

     $Un_Assign = DB::table('assignasset')
     ->where('StartTime', '<>', $s_time)->where('EndTime', '<>', $e_time)->count();
     $Ass_Assign = DB::table('assignasset')
     ->where('StartTime', '>=', $s_time)->where('EndTime', '<=', $e_time)->count();
     $noOfSev = DB::table('asset')->where('Active', '=', '1')->count();
     $noOfAvail = DB::table('asset')->count();

     $total_driver = DB::table('operator')->count();
     $engaged = DB::table('operator')
     ->rightJoin('assignasset', 'operator.UserId', '=', 'assignasset.UserId')
     ->where('assignasset.StartTime', '>=', $s_time)->where('assignasset.EndTime', '<=', $e_time)
     ->count();
     $idle = DB::table('assignasset')
     ->where('StartTime', '<>', $s_time)->where('EndTime', '<>', $e_time)->distinct('UserId')->count();

     $tot_order = DB::table('workorder')->count();
     $WOinPro = DB::table('workorder')->where('WorkOrderStatusId', '=', '2')->count();
     $newWO = DB::table('workorder')->where('created', '=', $Today)->count();
     $WOdue  = DB::table('workorder')->where('ServiceCompletionDate', '=', $dueToday)->count();

     $tot_job = DB::table('job')->count();
     $inPro = DB::table('job')->where('Status', '=', 'In Progress')->count();    
     $jobdue = DB::table('job')->where('ScheduleEndDate', '=', $dueToday)->count();

     $noOfExp = DB::table('assetexpense')->count();
     $payToday = DB::table('assetexpense')->where('PaidDate', '=', $dueToday)->count();
     $noOfOff  = DB::table('assetexpense')->where('ExpenseType', '=', 'Official Expense')->count();
     $noOfUnOff  = DB::table('assetexpense')->where('ExpenseType', '=', 'Unofficial Expense')->count();

     $tot_inc = DB::table('driverincident')->count();
     $new_inc = DB::table('driverincident')->where('created', '=', $Today)->count();
     $inc_ass  = DB::table('driverincident')->groupBy('IncidentVehicle')
     ->orderBy('count', 'desc')
     ->get(['IncidentVehicle', DB::raw('count(IncidentVehicle) as count')])->first();
     

     /* $inc_ops  = DB::table('driverincident')->groupBy('OperatorId')
     ->orderBy('count', 'desc')
     ->get(['OperatorId', DB::raw('count(OperatorId) as count')])->first(); */

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
          <h4 class="grey-text">          <i class="fa fa-dashboard" style="color:lightblue"></i>          <span class="hidden-xs">Dream360 Dashboard </span>   
          <?php 
          
            $dueRemDate = DB::table('schedulemaintenance')->where('AssetId', '=', '1')->orderBy('SchMaintId', 'desc')->take(1)->first(); ?>
            @if($dueRemDate)	
            <?php
            if($dueRemDate->DueReminderDate == date('m/d/Y'))
            {  
              echo "Today";
              $addr = 'kelvin.o@rytegate.com';
              //SENDING THE EMAIL NOTIFICATION
              $send_to = $addr;
              $subject = "Service Reminder Notice ";
              $message = ' Hello, 
              Your Vehicle Is Due For Maintenance In '. ' Days Time. '.$dueRemDate->DueReminderDate
              .' This Is Just A Notification Email For Service Reminder 
              Thank You.';
              $headers = "From: notifications@dream360.com" .
              "CC: kelvonetics@gmail.com";

              @mail($send_to, $subject, $message, $headers);
              

            } 
            else {  }  
          ?>
          @endif
               </h4> 
        </div>

                
 
      

      
      
      <!-- END OF CARD -->
      <div class="p-20 no-p-t">
      
      <!-- WORK ORDER NOTIFICATION  --> 
      <?php $email = $auth_user->email;   $shop = $auth_user->WorkShopId;   $roled = $auth_user->RoleId; ?>

      <div class="row gutter-14">
        <div class="col-md-12 col-md-5">
          <div class="card">
            <div class="card-header relative">
              <div class="card-title" style="margin:0px 0px -15px -11px">
                  <?php 
                      $Role = DB::table('role')->where('RoleId', '=', $roled)->first();
                      /*$role_name = $Role->RoleName; echo $role_name;*/
                      if($Role->RoleName == "Vendor/Mechanic"){ echo "Pending Review - Work Order"; }
                      else if($Role->RoleName == "Fleet Manager"){ echo "Pending Approvals - Work Order"; } 
                    ?>
              </div>

              <a href="{{route('workorder.index')}}" title ='View All Orders' class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
        <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
            <tr>                    
                <th scope="col" style="font-weight:normal"> &nbsp;&nbsp;&nbsp; WO NO</th>
                <th scope="col" style="font-weight:normal">Vehicle</th>
                <th scope="col" style="font-weight:normal">Due Date</th>
                <th scope="col" style="font-weight:normal">Status</th>
                <th scope="col" style="font-weight:normal">State</th>
                <th scope="col" style="font-weight:normal">Total Amt</th>
                <th scope="col" style="font-weight:normal" class="pull-right"></th>
            </tr>
        <tbody>
        
        <!-- DISPLAY ORDER FOR FLEET MANAGERS -->  
        <?php
        $roled = $auth_user->RoleId;  $RF = DB::table('role')->where('RoleId', '=', $roled)->first();  
        if($RF->RoleName == "Fleet Manager")
        {
      ?>
      <?php  
          $order_mail = DB::table('workorder')
          ->leftJoin('workshopemail', 'workorder.WorkOrderNumber', '=', 'workshopemail.WorkOrderNumber')
          ->where('workshopemail.Status', '=', 'Pending Approval')
          ->where('workshopemail.State', '=', '2')     
          ->take(5)->get();
      ?> 

          @foreach ($order_mail as $order_mail)
         <tr>
            <td>{{$order_mail->WorkOrderNumber}}</td>
            <td>    <?php $as_id = $order_mail->AssetId; ?>
              <?php 
                $asset = DB::table('asset')->where('AssetId', '=', $as_id)->first();      				echo $asset->LicensePlate;
              ?>
            </td>
            <td>{{$order_mail->ServiceCompletionDate}}</td>
            <td>
              <?php 						
                $stid = $order_mail->WorkOrderStatusId;
                if($stid == 1){					
              ?>
              <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
                        
                  <?php  }elseif($stid==2){ ?>
                        
              <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                        
                  <?php  }elseif($stid==3){ ?>
                    
                      <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">
                    
                  <?php } ?>
            </td>
            
            <td>
              <?php 
                $wrk_no = $order_mail->WorkOrderNumber;
                
                $total_pd = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '2')->where('Status', '=', 'Pending Approval')->where('RoleId', '<>', $roled)->count(); 
                if($total_pd == '1'){ echo '<span style="color:#FFBF00;"> Pending Approval </span>'; }		
              ?>
            </td>

            <td>
               <?php 
                 $WO_NO = $order_mail->WorkOrderNumber;                
                 $orderitem = DB::table('workorderitem')->where('WorkOrderNumber', '=', $WO_NO)->first(); 
                 echo $orderitem->TotalCost;	
              ?>
            </td>
          
             <td class="actions"> 


            <!-- if approved display a different button -->
            <?php
            //FOR PENDING FLEET MANAGER REVIEW
            if($total_pd == '1')  //&& $role_name == 'Fleet Manager'
            {  ?>
              <a href="{{route('workorder.approve_decline', $order_mail->WOId)}}" class="btn btn-warning pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:2px; width:25px;height:25px;border-radius:16px; font-size:10px; background-color:#396" title="Approve Or Decline Order With Number {{$order_mail->WorkOrderNumber}}"> <i class="fa fa-pencil"></i></a>
            <?php 
            }            
            ?>
            
            </td>
        </tr>
        @endforeach

        <?php } ?>	

        


          <!-- FOR VENDORS -->
          <?php
            $roled = $auth_user->RoleId;    $RM = DB::table('role')->where('RoleId', '=', $roled)->first();
            if($RM->RoleName == "Vendor/Mechanic")
            {
          ?>
                
          <?php  
            $order_mail = DB::table('workorder')
            ->leftJoin('workshopemail', 'workorder.WorkOrderNumber', '=', 'workshopemail.WorkOrderNumber')
            ->where('workshopemail.Status', '=', 'Vendor Review')
            ->orWhere('workshopemail.Status', '=', 'Approved')
            ->orWhere('workshopemail.Status', '=', 'Declined')
            ->where('workshopemail.State', '=', '1')
            ->orWhere('workshopemail.State', '=', '3')      
            ->take(5)->get();
          ?>

            @foreach ($order_mail as $order_mail)

              <tr>
              <td>{{$order_mail->WorkOrderNumber}}</td>
              <td>    <?php $as_id = $order_mail->AssetId; ?>
                <?php 
                  $asset = DB::table('asset')->where('AssetId', '=', $as_id)->first(); 	echo $asset->LicensePlate;
                ?>
              </td>
              <td>{{$order_mail->ServiceCompletionDate}}</td>
              <td>
                <?php 						
                  $stid = $order_mail->WorkOrderStatusId;
                  if($stid == 1){					
                ?>
                <img src="{{URL::asset('assets/img/green.png')}}" class="img-responsive" height="10px" width="10px">
                          
                    <?php  }elseif($stid==2){ ?>
                          
                <img src="{{URL::asset('assets/img/red.png')}}" class="img-responsive" height="10px" width="10px">
                          
                    <?php  }elseif($stid==3){ ?>
                      
                        <img src="{{URL::asset('assets/img/yellow.png')}}" class="img-responsive" height="10px" width="10px">
                      
                    <?php } ?>
              </td>
              
              <td>
                <?php 
                  $wrk_no = $order_mail->WorkOrderNumber;
                  $total_vr = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '1')->where('Status', '=', 'Vendor Review')->where('RoleId', '<>', $roled)->count(); 
                  if($total_vr == '1'){ echo '<span style="color:#007FFF"> Vendor Review  </span>'; }
                  
                  $total_ap = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Approved')->where('RoleId', '<>', $roled)->count(); 
                  if($total_ap == '1'){ echo '<span style="color:#339966;"> Approved </span>'; }
                  
                  $total_dc = DB::table('workshopemail')->where('WorkOrderNumber', '=', $wrk_no)->where('State', '=', '3')->where('Status', '=', 'Declined')->where('RoleId', '<>', $roled)->count();
                  if($total_dc == '1'){ echo '<span style="color:red"> Declined </span>'; }			
                ?>
              </td>

              <td>
              <?php  $wo_noo = $order_mail->WorkOrderNumber;
                  $workitem = DB::table('workorderitem')->where('WorkOrderNumber', '=', $wo_noo)->first(); 
                ?>
                @if($workitem) {{$workitem->TotalCost}} @else {{'0000.00'}} @endif
              </td>
            
              <td class="actions"> 
              
              
              <!-- if approved display a different button -->
              <?php
              if($total_ap == '1')
              { ?>
                <a href="{{route('workorder.edit', $order_mail->WOId)}}" class="btn btn-success pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:2px; width:25px;height:25px;border-radius:16px; font-size:10px" title="View Or Edit This Order With Number {{$order_mail->WorkOrderNumber}}"> <i class="fa fa-pencil"></i></a>
              <?php  
              }
              else if($total_dc == '1')
              { ?>
                <a href="{{route('workorder.edit', $order_mail->WOId)}}" class="btn btn-danger pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:2px; width:25px;height:25px;border-radius:16px; font-size:10px" title="View Or Edit This Order With Number {{$order_mail->WorkOrderNumber}}"> <i class="fa fa-pencil"></i></a>
              <?php  
              }
            
              //FOR VENDOR REVIEW
              else if($total_vr == '1')  //&& $role_name == 'Vendor/Mechanic'
              {  ?>
                <a href="{{route('workorder.edit', $order_mail->WOId)}}" class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:2px; width:25px;height:25px;border-radius:16px; font-size:10px" title="View Or Edit This Order With Number {{$order_mail->WorkOrderNumber}}"> <i class="fa fa-pencil"></i></a>
              <?php 
              }
              ?>
              
              </td>
          </tr>

            @endforeach

        <?php } ?>
                    
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

              <a href="{{route('invoice.index')}}" title = 'View All Invoices' class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
        <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
            <tr>                    
                <th scope="col" style="font-weight:normal"> &nbsp;&nbsp;&nbsp;INV NO</th>
                <th scope="col" style="font-weight:normal">Client</th>
                <th scope="col" style="font-weight:normal">Date</th>
                <th scope="col" style="font-weight:normal">Status</th>
                <th scope="col" style="font-weight:normal">State</th>
                <th scope="col" style="font-weight:normal">Total Amt</th>
                <th scope="col" style="font-weight:normal"></th>
            </tr>
        <tbody>
        <!-- POPULATE TABLE WITH INVOICE DATA -->
        <?php $invoices = DB::table('invoice')->orderBy('InvoiceNumber', 'desc')->take(3)->get();  ?>
         @foreach ($invoices as $invoices)
          <tr>
            <td>{{$invoices->InvoiceNumber}}</td>
            <td>
              <?php 
                $ctid = $invoices->ClientId;
                $client = DB::table('client')->where('ClientId', '=', $ctid)->first();	
                echo $client->FirstName.' '.$client->LastName;
              ?>
            </td>
            <td>{{$invoices->DueDate}}</td>
            <td>{{$invoices->Status}}</td>
            <td>{{ 'In Progress' }}</td>
            <td>
              <?php 
                $invno = $invoices->InvoiceNumber;	
                $invoiceitem = DB::table('invoiceitem')->where('InvoiceNumber', '=', $invno)->first();	
              ?>
              @if($invoiceitem) $invoiceitem->Amount; @endif
            </td>
            <td> {{$invoices->TotalCost}} </td>				
           
            <td style="overflow:visible">
            <div class="dropdown" style="">
              <a href="{{route('invoice.edit', $invoices->InvoiceId)}}" class="btn btn-info pull-right"     style="margin:-5px 0px 0px 0px; color:white;padding:2px; width:25px;height:25px;border-radius:16px; font-size:10px" title="View This Invoice With Number {{$invoices->InvoiceNumber}}"> <i class="fa fa-pencil"></i> </a> 
            </div> 
            </td>
                    
        </tr>
        @endforeach
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
                    <th scope="col" style="font-weight:normal"> &nbsp;&nbsp;&nbsp;License Plate</th>
                    <th scope="col" style="font-weight:normal">Mile Int</th>
                    <th scope="col" style="font-weight:normal">Date Int</th>
                    <th scope="col" style="font-weight:normal">Late Mile</th>
                    <th scope="col" style="font-weight:normal">Last Date</th>
                    <th scope="col" style="font-weight:normal">Curr Mile</th>
                </tr>
            <tbody>
                <!-- POPULATE TABLE WITH Schedule Maintenance DATA -->
                <?php $sch_maint = DB::table('schedulemaintenance')->orderBy('SchMaintId', 'desc')->take(3)->get();  ?>
                @foreach ($sch_maint as $sch_maint)
                  <tr>
                  <td>
                      <?php 
                        $as_id = $sch_maint->AssetId;
                        $asset = DB::table('asset')->where('AssetId', '=', $as_id)->first();	
                        echo $asset->LicensePlate;
                      ?>
                    </td>
                    <td>{{$sch_maint->MileInterval}}</td>
                    <td>{{$sch_maint->DateInterval}}  Months</td>
                    <td>{{$sch_maint->LastMaintMile}}</td>
                    <td>{{$sch_maint->LastMaintDate}}</td>
                    <td>{{$sch_maint->CurrentMile}}</td>
               </tr>
                @endforeach
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
                <a href="{{route('job.index')}}" title = 'View All Jobs' class="btn btn-info pull-right"     style="margin:-15px 0px 0px 0px; color:white;padding:0px; width:25px;height:25px;border-radius:16px"><i class="fa fa-list" style="font-size:9px"> </i> </a>
            </div>
            <div class="list-group">
              
              <table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
                    <tr>
                        <th scope="col" style="font-weight:normal"> &nbsp;&nbsp;&nbsp;Type</th>                 <th scope="col" style="font-weight:normal">Status</th>
                        <th scope="col" style="font-weight:normal">Start Date</th>
                        <th scope="col" style="font-weight:normal">End Date</th>
                        <th scope="col" style="font-weight:normal">Address</th>
                        <th scope="col" style="font-weight:normal">Client</th>
                    </tr>
            <tbody>
                  <!-- POPULATE TABLE WITH JOBS DATA -->
                  <?php $Job = DB::table('job')->orderBy('JobId', 'desc')->take(3)->get();  ?>
                    @foreach ($Job as $Job)
                      <tr>
                          <td>{{$Job->Type}} </td>
                          <td>{{$Job->Status}}</td>
                          <td>{{$Job->ScheduleStartDate}}</td>
                          <td>{{$Job->ScheduleEndDate}}</td>
                          <td>{{$Job->Street}}</td>
                          <td>{{$Job->Street}}</td>
                          <td>
                            <?php 
                              $ctid = $Job->ClientId;
                              $client = DB::table('client')->where('ClientId', '=', $ctid)->first();	
                              echo $client->FirstName.' '.$client->LastName;
                            ?>
                          </td>
                     </tr>
                    @endforeach
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
          <li role="presentation" class="active"><a aria-controls="home" role="tab" data-toggle="tab" href="#tab-notif">Messages</a></li>
          <li role="presentation"><a aria-controls="home" role="tab" data-toggle="tab" href="#tab-reminder">Reminder</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content m-t-10">
          
          <!-- EMAIL NOTIFICATION  --><!-- loggedin emails for the user -->
      <?php
        $yourmail = DB::table('workshopemail')->where('Email', '=', $auth_user->email)
        ->orWhere('FleetManagerEmail', '=', $auth_user->email)->take('5')->get();
      ?>
          <div role="tabpanel" class="tab-pane active" id="tab-notif">
            <ul class="timeline">
      @if($yourmail)
      @foreach($yourmail as $yourmail)
      <li>      
          <div class="timeline-badge"><i class="fa fa-envelope"></i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">{{ 'Email'}}</h4> </div>
            <div class="timeline-body"> <span spanlaceholder-p=""></span> <small class=""><i class="fa fa-timer"></i>{{ $yourmail->Message }}</small> <small class="text-muted"><i class="md md-timer"></i> {{ $yourmail->created }}</small></div>
          </div>
      </li>
      @endforeach
      @endif
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