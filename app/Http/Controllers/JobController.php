<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Job;
use App\Client;
use App\Assignjob;
use Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $JobMa = $perm->JobMa;
        if($JobMa)
        {
            $jobs = Job::all();
            
            return view('job.index')
            ->with('jobs', $jobs);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {        
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $JobMa = $perm->JobMa;
        if($JobMa)
        {
            $clients = Client::all();
            $total_jobs = Job::count();  ++$total_jobs;
            $jobtypes = DB::table('jobtype')->orderBy('JobType', 'asc')->get();
            $jobstatus = DB::table('jobstatus')->orderBy('JobStatus', 'asc')->get();
            
            return view('job.add')
            ->with('clients', $clients)
            ->with('jobtypes', $jobtypes)
            ->with('total_jobs', $total_jobs)
            ->with('jobstatus', $jobstatus);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      $this->validate($request, 
      [
        'Type' => 'required',
        'Status' => 'required',
        'Description' => 'required',
        'ScheduleStartDate' => 'required',
        'ScheduleEndDate' => 'required',
        //'ActualStartDate' => 'required',        
        //'ActualEndDate' => 'required',
        'ClientId' => 'required',
        'CountryId' => 'required',
        'State' => 'required',        
        'City' => 'required', 
        'Street' => 'required',
        'Phone' => 'required',
        //'ContactPerson' => 'required',        
        'Active' => 'required', 
        'CreatedBy' => 'required'
      ]);

          $Type = $request->input('Type');
          $Status = $request->input('Status');
          $Description = $request->input('Description');
          $ScheduleStartDate = $request->input('ScheduleStartDate');
          $ScheduleEndDate = $request->input('ScheduleEndDate');
          //$ActualStartDate = $request->input('ActualStartDate');
          //$ActualEndDate = $request->input('ActualEndDate');
          $ClientId = $request->input('ClientId');
          $CountryId = $request->input('CountryId');
          $State = $request->input('State');
          $City = $request->input('City');
          $Street = $request->input('Street');
          $Phone = $request->input('Phone');
          $ContactPerson = $request->input('ContactPerson');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('Type' =>$Type, 'Status' =>$Status, 'Description' =>$Description, 'ScheduleStartDate' =>$ScheduleStartDate, 'ScheduleEndDate' =>$ScheduleEndDate, 'ClientId' =>$ClientId, 'CountryId' =>$CountryId, 'State' =>$State, 'City' =>$City, 'Street' =>$Street, 'Phone' =>$Phone, 'ContactPerson' =>$ContactPerson, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Job::insert($data);
   
         return redirect()->route('job.index')->with('info', 'New Job Save Successfully');
      
    }

    public function view(Request $request, $JobId)
    {
      
    }

    public function edit($JobId)
    {
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $JobMa = $perm->JobMa;
        if($JobMa)
        {
            $job = Job::find($JobId);
            $client = Client::all();
            $jobtypes = DB::table('jobtype')->get();
            $jobstatus = DB::table('jobstatus')->get();
            $countrys = DB::table('country')->get();
    
            return view('job.edit')
            ->with('job', $job)
            ->with('client', $client)
            ->with('jobtypes', $jobtypes)
            ->with('countrys', $countrys)
            ->with('jobstatus', $jobstatus);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $JobId)
    {
       $job = Job::find($JobId);       
       $this->validate($request, 
       [
         'Type' => 'required',
         'Status' => 'required',
         'Description' => 'required',
         'ScheduleStartDate' => 'required',
         'ScheduleEndDate' => 'required',
         //'ActualStartDate' => 'required',        
         //'ActualEndDate' => 'required',
         'ClientId' => 'required',
         'CountryId' => 'required',
         'State' => 'required',        
         'City' => 'required', 
         'Street' => 'required',
         'Phone' => 'required',
         'ContactPerson' => 'required',        
         'Active' => 'required', 
         'CreatedBy' => 'required'
       ]);

       $data = array(
            'Type' => $request->input('Type'),
            'Status' => $request->input('Status'),
            'Description' => $request->input('Description'),
            'ScheduleStartDate' => $request->input('ScheduleStartDate'),
            'ScheduleEndDate' => $request->input('ScheduleEndDate'),
            'ActualStartDate' => $request->input('ActualStartDate'),
            'ActualEndDate' => $request->input('ActualEndDate'),
            'ClientId' => $request->input('ClientId'),
            'CountryId' => $request->input('CountryId'),
            'State' => $request->input('State'),
            'City' => $request->input('City'),
            'Street' => $request->input('Street'),
            'Phone' => $request->input('Phone'),
            'ContactPerson' => $request->input('ContactPerson'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy')
        );

        Job::where('JobId', $JobId)->update($data);
        return redirect()->route('job.edit', ['JobId' => $JobId])->with('info', 'Job  Updated Successfully');

    }



    public function assignjob()
    {        
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssignJo = $perm->AssignJo;
        if($AssignJo)
        {
            return view('job.assign-job');
        }
        else {  return redirect()->back(); }
        
    }

    public function availjobs()
    {        
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssignJo = $perm->AssignJo;
        if($AssignJo)
        {
            return view('job.avail-jobs');
        }
        else {  return redirect()->back(); }
        
    }

    public function insertjob(Request $request)
    {
      $this->validate($request, 
      [
        'JobId' => 'required',
        'AssetId' => 'required',
        'UserId' => 'required',
        'DeptId' => 'required',
        'JobStartDateTime' => 'required',
        'JobEndDateTime' => 'required',
        'CreatedBy' => 'required'
      ]);
        
          //INSERT FOR ASSIGN JOB TABLE
          $JobId = $request->input('JobId');
          $AssetId = $request->input('AssetId');
          $UserId = $request->input('UserId');
          $DeptId = $request->input('DeptId');
          $JobStartDateTime = $request->input('JobStartDateTime');
          $JobEndDateTime = $request->input('JobEndDateTime');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('JobId' =>$JobId, 'AssetId' =>$AssetId, 'UserId' =>$UserId, 'DeptId' =>$DeptId, 'JobStartDateTime' =>$JobStartDateTime, 'JobEndDateTime' =>$JobEndDateTime, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assignjob::insert($data);
   
         return redirect()->route('job.assignjob')->with('info', 'Job Was Assigned Successfully');
      
    }

    public function driver_resent_jobs($u_id)
    {
        //Job AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $JobMa = $perm->JobMa;
        if($JobMa)
        {
            $jobs = Job::all();
            $resent_jobs = DB::table('assignjob')->where('UserId', '=', $u_id)->get();
            
            return view('job.driver-resent-jobs')
            ->with('jobs', $jobs)
            ->with('resent_jobs', $resent_jobs);
        }
        else {  return redirect()->back(); }        
    }


}
