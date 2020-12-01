<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Workshop;
use App\Users;
use Auth;


class WorkshopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Order Labour AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $Community = $perm->Community;
        if($Community)
        {
            $workshops = Workshop::all();
            
            return view('workshop.index')
            ->with('workshops', $workshops);
        }
        else {  return redirect()->back(); } 
        
    }


    public function add()
    { 
        //Order Labour AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $Community = $perm->Community;
        if($Community)
        {
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get(); 
            $users = Users::all();            
            return view('workshop.add')
            ->with('country', $country)
            ->with('users', $users);
        }
        else {  return redirect()->back(); } 
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'WorkShopName => 'required',
        'Phone' => 'required',
        'Email' => 'required',
        'Address' => 'required',
        'City' => 'required',
        'State => 'required',
        'Country' => 'required',
        'ContactName' => 'required',
        'UserId' => 'required',
        'OperationHoursFrom' => 'required',
        'OperationHoursTo' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $WorkShopName = $request->input('WorkShopName');
          $Phone = $request->input('Phone');
          $Email = $request->input('Email');
          $Address = $request->input('Address');
          $City = $request->input('City');
          $State = $request->input('State');
          $Country = $request->input('Country');
          $ContactName = $request->input('ContactName');
          $UserId = $request->input('UserId');
          $OperationHoursFrom = $request->input('OperationHoursFrom');
          $OperationHoursTo = $request->input('OperationHoursTo');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('WorkShopName' =>$WorkShopName, 'Phone' =>$Phone, 'Email' =>$Email, 'Address' =>$Address, 'City' =>$City, 'State' =>$State, 'Country' =>$Country, 'ContactName' =>$ContactName, 'UserId' =>$UserId, 'OperationHoursFrom' =>$OperationHoursFrom, 'OperationHoursTo' =>$OperationHoursTo, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Workshop::insert($data);
   
         return redirect()->route('workshop.index')->with('info', 'New Auto Workshop Created Successfully');
      
    }


    public function edit($WorkShopId)
    {
        //Order Labour AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $Community = $perm->Community;
        if($Community)
        {
            $workshop = Workshop::find($WorkShopId);
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get(); 
            $users = Users::all();  
            return view('workshop.edit')
            ->with('country', $country)
            ->with('workshop', $workshop)
            ->with('users', $users);
        }
        else {  return redirect()->back(); } 
        
    }

    public function update(Request $request, $WorkShopId)
    {      
       /*$this->validate($request, 
       [
            'WorkShopName => 'required',
            'Phone' => 'required',
            'Email' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'State => 'required',
            'Country' => 'required',
            'ContactName' => 'required',
            'UserId' => 'required',
            'OperationHoursFrom' => 'required',
            'OperationHoursTo' => 'required',
            'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'WorkShopName' => $request->input('WorkShopName'),
            'Phone' => $request->input('Phone'),
            'Email' => $request->input('Email'),
            'Address' => $request->input('Address'),
            'State' => $request->input('State'),
            'Country' => $request->input('Country'),
            'ContactName' => $request->input('ContactName'),
            'UserId' => $request->input('UserId'),
            'OperationHoursFrom' => $request->input('OperationHoursFrom'),
            'OperationHoursTo' => $request->input('OperationHoursTo'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Workshop::where('WorkShopId', $WorkShopId)->update($data);
        return redirect()->route('workshop.edit', ['WorkShopId' => $WorkShopId])->with('info', 'Auto Workshop Updated Successfully');

    }
}
