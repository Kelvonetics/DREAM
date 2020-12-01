<?php

namespace App\Http\Controllers;  

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Operator;
use App\Users;
use App\Asset;
use App\Category;
use App\Driverincident;
use App\Drivercertification;
use App\Driverleave;
use Auth;

class OperatorController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }


       
    public function index()
    {
        //Operator AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $UserAd = $perm->UserAd;
        if($UserAd)
        {
          $operators = Operator::all();        
          $users = Operator::all();
  
          $assets = Asset::all();
          $category = Category::all();
          $leavetype = DB::table('leavetype')->orderBy('LeaveType', 'asc')->get();
  
          return view('operator.index')
          ->with('users', $users)
          ->with('operators', $operators)
          ->with('asset', $assets)
          ->with('category', $category)
          ->with('leavetype', $leavetype);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {        
       //Operator AUTHORIZATION 
       $auth = Auth::user();  
       $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
       $UserAd = $perm->UserAd;
       if($UserAd)
       {
          $users = Users::all();
        
          return view('operator.add')
          ->with('users', $users);
       }
       else {  return redirect()->back(); }
       
    }

    public function insert(Request $request)
    {
        $this->validate($request, 
        [
          'UserId' => 'required',
          'DeptId' => 'required',
          'Status' => 'required',
          'CreatedBy' => 'required',
        ]);

            $UserId = $request->input('UserId');
            $DeptId = $request->input('DeptId');
            $Status = $request->input('Status');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');
            

            $data = array('UserId' =>$UserId, 'DeptId' =>$DeptId, 'Status' =>$Status, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
    
            Operator::insert($data);
    
          return redirect()->route('operator.index')->with('info', 'New Driver Save Successfully');
    }

   

    public function addOperator(Request $request, $UserId)
    {        
      //Operator AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $UserAd = $perm->UserAd;
      if($UserAd)
      {
        $users = Users::all();
        $user = Users::find($UserId);
 
        return view('operator.addOperator')
        ->with('use', $users)
        ->with('user', $user);
      }
      else {  return redirect()->back(); }
       
    }

    //adding operators notes
    public function addNote(Request $request)
    {
       $this->validate($request, 
        [
            'Notes' => 'required',
            'OperatorId' => 'required',
            'UserId' => 'required',
            'Hide' => 'required',
            'CreatedBy' => 'required'
        ]);

       $Notes = $request->input('Notes');
       $OperatorId = $request->input('OperatorId');
       $UserId = $request->input('UserId');
       $Hide = $request->input('Hide');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('Notes' =>$Notes, 'OperatorId' =>$OperatorId, 'UserId' =>$UserId, 'Hide' =>$Hide, 
       'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('drivernotes')->insert($data);

      return redirect()->route('operator.view', ['UserId' => $UserId])->with('info', 'Drivers Notes Save Successfully');

    }


    public function view(Request $request, $id)
    {
        //Operator AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $UserAd = $perm->UserAd;
        if($UserAd)
        {
          $operator = Operator::where('UserId', '=', $id)->first();
          $opUser = Users::where('UserId', '=', $id)->first();
          $operators = Operator::all();
          $assets = Asset::all();
          $category = Category::all();
          $leavetype = DB::table('leavetype')->orderBy('LeaveType', 'asc')->get();
  
  
          //$retirereason = DB::table('driverincident')->distinct('IncidentId', 'IncidentVehicle', 'IncidentDate', 'IncidentType', 'OperatorId', 'Notes')->where('OperatorId', '=', '')->orderBy('IncidentId', 'desc')->get();
          //$sql = "SELECT DISTINCT IncidentId, IncidentVehicle, IncidentDate, IncidentType, OperatorId, Notes FROM driverincident
          //WHERE OperatorId = '{$op_id}' ORDER BY IncidentId DESC";
          
          $user = Operator::all();
  
          return view('operator.view')
          ->with('user', $user)
          ->with('operator', $operator)
          ->with('opUser', $opUser)
          ->with('assets', $assets)
          ->with('category', $category)
          ->with('leavetype', $leavetype)
          ->with('operators', $operators)          
          ->with('id', $id);
        }
        else {  return redirect()->back(); }
        
    }

    public function edit($UserId)
    {

    }

    //OPERATOR INCIDENCE
    public function addIncident(Request $request)
    {
      $this->validate($request, 
      [
        'OperatorId' => 'required',
        'IncidentDate' => 'required',
        'IncidentType' => 'required',
        'IncidentVehicle' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'Notes' => 'required',
        'CreatedBy' => 'required'
      ]);

          $OperatorId = $request->input('OperatorId');
          $IncidentDate = $request->input('IncidentDate');
          $IncidentType = $request->input('IncidentType');
          $IncidentVehicle = $request->input('IncidentVehicle');
          $name = $request->file('name');
          $Notes = $request->input('Notes');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/incidents');
      
          $name->move($destinationPath, $input['name']);

          $data = array('OperatorId' =>$OperatorId, 'IncidentDate' =>$IncidentDate,'IncidentType' =>$IncidentType, 'IncidentVehicle' =>$IncidentVehicle, 'name' =>$file, 'Notes' =>$Notes, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Driverincident::insert($data);
          $UserId = $request->input('UserId');
          return redirect()->route('operator.view', ['UserId' => $UserId])->with('info', 'Drivers Incident Reported Successfully');
      
    }
   
    //OPERATOR CERTIFICATE
    public function addCertificate(Request $request)
    {
      $this->validate($request, 
      [
        'OperatorId' => 'required',
        'Category' => 'required',
        'Description' => 'required',
        'CertificateExpiryDate' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'CreatedBy' => 'required'
      ]);

          $OperatorId = $request->input('OperatorId');
          $Category = $request->input('Category');
          $Description = $request->input('Description');
          $CertificateExpiryDate = $request->input('CertificateExpiryDate');
          $name = $request->file('name');
          $Notes = $request->input('Notes');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/certificates');
      
          $name->move($destinationPath, $input['name']);

          $data = array('OperatorId' =>$OperatorId, 'Category' =>$Category,'Description' =>$Description, 'CertificateExpiryDate' =>$CertificateExpiryDate, 'name' =>$file, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Drivercertification::insert($data);
          $UserId = $request->input('UserId');
          return redirect()->route('operator.view', ['UserId' => $UserId])->with('info', 'Drivers Certificate Saved Successfully');
      
    }

     //OPERATOR LEAVE
     public function addLeave(Request $request)
     {
       $this->validate($request, 
       [
         'OperatorId' => 'required',
         'LeaveStartDate' => 'required',
         'LeaveEndDate' => 'required',
         'LeaveReason' => 'required', 
         'LeaveType' => 'required',       
         'CreatedBy' => 'required'
       ]);
 
           $OperatorId = $request->input('OperatorId');
           $LeaveStartDate = $request->input('LeaveStartDate');
           $LeaveEndDate = $request->input('LeaveEndDate');
           $LeaveReason = $request->input('LeaveReason');
           $LeaveType = $request->input('LeaveType');
           $CreatedBy = $request->input('CreatedBy');
           $created = date('Y-M-j');
           $updated_at = date('Y-m-j');
 
           $data = array('OperatorId' =>$OperatorId, 'LeaveStartDate' =>$LeaveStartDate,'LeaveEndDate' =>$LeaveEndDate, 'LeaveReason' =>$LeaveReason, 'LeaveType' =>$LeaveType, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
           
    
           Driverleave::insert($data);
           $UserId = $request->input('UserId');
           return redirect()->route('operator.view', ['UserId' => $UserId])->with('info', 'Drivers Leave Saved Successfully');
       
     }

     //OPERATOR INCIDENCE INDEX
    public function addIncidentFromIndex(Request $request)
    {
      $this->validate($request, 
      [
        'OperatorId' => 'required',
        'IncidentDate' => 'required',
        'IncidentType' => 'required',
        'IncidentVehicle' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'Notes' => 'required',
        'CreatedBy' => 'required'
      ]);

          $OperatorId = $request->input('OperatorId');
          $IncidentDate = $request->input('IncidentDate');
          $IncidentType = $request->input('IncidentType');
          $IncidentVehicle = $request->input('IncidentVehicle');
          $name = $request->file('name');
          $Notes = $request->input('Notes');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/incidents');
      
          $name->move($destinationPath, $input['name']);

          $data = array('OperatorId' =>$OperatorId, 'IncidentDate' =>$IncidentDate,'IncidentType' =>$IncidentType, 'IncidentVehicle' =>$IncidentVehicle, 'name' =>$file, 'Notes' =>$Notes, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Driverincident::insert($data);
          return redirect()->route('operator.index')->with('info', 'Drivers Incident Reported Successfully');
      
    }
   
    //OPERATOR CERTIFICATE INDEX
    public function addCertificateFromIndex(Request $request)
    {
      $this->validate($request, 
      [
        'OperatorId' => 'required',
        'Category' => 'required',
        'Description' => 'required',
        'CertificateExpiryDate' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'CreatedBy' => 'required'
      ]);

          $OperatorId = $request->input('OperatorId');
          $Category = $request->input('Category');
          $Description = $request->input('Description');
          $CertificateExpiryDate = $request->input('CertificateExpiryDate');
          $name = $request->file('name');
          $Notes = $request->input('Notes');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/certificates');
      
          $name->move($destinationPath, $input['name']);

          $data = array('OperatorId' =>$OperatorId, 'Category' =>$Category,'Description' =>$Description, 'CertificateExpiryDate' =>$CertificateExpiryDate, 'name' =>$file, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Drivercertification::insert($data);
          return redirect()->route('operator.index')->with('info', 'Drivers Certificate Saved Successfully');
      
    }

     //OPERATOR LEAVE INDEX
     public function addLeaveFromIndex(Request $request)
     {
       $this->validate($request, 
       [
         'OperatorId' => 'required',
         'LeaveStartDate' => 'required',
         'LeaveEndDate' => 'required',
         'LeaveReason' => 'required', 
         'LeaveType' => 'required',       
         'CreatedBy' => 'required'
       ]);
 
           $OperatorId = $request->input('OperatorId');
           $LeaveStartDate = $request->input('LeaveStartDate');
           $LeaveEndDate = $request->input('LeaveEndDate');
           $LeaveReason = $request->input('LeaveReason');
           $LeaveType = $request->input('LeaveType');
           $CreatedBy = $request->input('CreatedBy');
           $created = date('Y-M-j');
           $updated_at = date('Y-m-j');
 
           $data = array('OperatorId' =>$OperatorId, 'LeaveStartDate' =>$LeaveStartDate,'LeaveEndDate' =>$LeaveEndDate, 'LeaveReason' =>$LeaveReason, 'LeaveType' =>$LeaveType, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
           
    
           Driverleave::insert($data);
           return redirect()->route('operator.index')->with('info', 'Drivers Leave Saved Successfully');
       
     }

     //UPLOAD USER PROFILE PHOTO
      public function uploadProfilePhoto(Request $request)
      { 
          $UserId = $request->input('UserId');
          $name = $request->file('name');          
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $FileType = $name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/users');
      
          $name->move($destinationPath, $input['name']);

          $data = array(
              'UserPicture' => $file,
              'updated_at' => date('Y-m-j')
          );
          

          Users::where('UserId', $UserId)->update($data);
          return redirect()->route('operator.index')->with('info', 'User Profile Photo Saved Successfully');
      
      }

      public function absent_jobs_and_vehicles($id)
      {
          //Operator AUTHORIZATION 
          $auth = Auth::user();  
          $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
          $UserAd = $perm->UserAd;
          if($UserAd)
          {
            $operators = Operator::all();        
            $users = Operator::all();    
            $assets = Asset::all();
    
            return view('operator.absent-jobs-and-vehicles')
            ->with('users', $users)
            ->with('operators', $operators)
            ->with('asset', $assets)
            ->with('id', $id);
          }
          else {  return redirect()->back(); }
          
      }


}
