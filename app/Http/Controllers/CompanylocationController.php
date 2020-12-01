<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Companylocation;
use Auth;

class CompanylocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Company location  AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $companylocations = Companylocation::all();
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get();
    
            return view('companylocation.index')
            ->with('country', $country)
            ->with('companylocations', $companylocations);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {
        //Company location  AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get();                
            return view('companylocation.add')
            ->with('country', $country);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'LocationName' => 'required',
        'Address' => 'required',
        'State' => 'required',
        'CountryId' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $LocationName = $request->input('LocationName');
          $Address = $request->input('Address');
          $State = $request->input('State');
          $CountryId = $request->input('CountryId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('LocationName' =>$LocationName, 'Address' =>$Address, 'State' =>$State, 'CountryId' =>$CountryId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Companylocation::insert($data);
   
         return redirect()->route('companylocation.index')->with('info', 'New Company Location Created Successfully');
      
    }

    
    public function edit($LocationId)
    {
        //Company location AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $companylocation = Companylocation::find($LocationId);
            
            $countrys = DB::table('country')->orderBy('CountryName', 'asc')->get(); 
            return view('companylocation.edit')
            ->with('countrys', $countrys)
            ->with('companylocation', $companylocation);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $LocationId)
    {      
       /*$this->validate($request, 
       [
           'DeptName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'LocationName' => $request->input('LocationName'),
            'Address' => $request->input('Address'),
            'State' => $request->input('State'),
            'CountryId' => $request->input('CountryId'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Companylocation::where('LocationId', $LocationId)->update($data);
        return redirect()->route('companylocation.edit', ['LocationId' => $LocationId])->with('info', 'Company Location Updated Successfully');

    }
}
