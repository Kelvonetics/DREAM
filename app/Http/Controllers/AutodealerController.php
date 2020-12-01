<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Autodealer;
use Auth;

class AutodealerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Auto dealer AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $autodealers = Autodealer::all();
            
            return view('autodealer.index')
            ->with('autodealers', $autodealers);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    { 
        //Auto dealer AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get();             
            return view('autodealer.add')
            ->with('country', $country);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'CountryId' => 'required',
        'DealerName => 'required',
        'PhoneNo' => 'required',
        'DealerEmail' => 'required',
        'DealerAddress' => 'required',
        'DealerState => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $CountryId = $request->input('CountryId');
          $DealerName = $request->input('DealerName');
          $PhoneNo = $request->input('PhoneNo');
          $DealerEmail = $request->input('DealerEmail');
          $DealerAddress = $request->input('DealerAddress');
          $DealerState = $request->input('DealerState');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('CountryId' =>$CountryId, 'DealerName' =>$DealerName, 'PhoneNo' =>$PhoneNo, 'DealerEmail' =>$DealerEmail, 'DealerAddress' =>$DealerAddress, 'DealerState' =>$DealerState, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Autodealer::insert($data);
   
         return redirect()->route('autodealer.index')->with('info', 'New Auto Dealer Created Successfully');
      
    }


    public function edit($DealerId)
    {
        //Auto dealer AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $autodealer = Autodealer::find($DealerId);
            $country = DB::table('country')->orderBy('CountryName', 'asc')->get();  
            return view('autodealer.edit')
            ->with('country', $country)
            ->with('autodealer', $autodealer);
        }
        else {  return redirect()->back(); }
        $autodealer = Autodealer::find($DealerId);
        $country = DB::table('country')->orderBy('CountryName', 'asc')->get();  
        return view('autodealer.edit')
        ->with('country', $country)
        ->with('autodealer', $autodealer);
    }

    public function update(Request $request, $DealerId)
    {      
       /*$this->validate($request, 
       [
            'CountryId' => 'required',
            'DealerName => 'required',
            'PhoneNo' => 'required',
            'DealerEmail' => 'required',
            'DealerAddress' => 'required',
            'DealerState => 'required',
            'Active' => 'required',
            'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'CountryId' => $request->input('CountryId'),
            'DealerName' => $request->input('DealerName'),
            'PhoneNo' => $request->input('PhoneNo'),
            'DealerEmail' => $request->input('DealerEmail'),
            'DealerAddress' => $request->input('DealerAddress'),
            'DealerState' => $request->input('DealerState'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Autodealer::where('DealerId', $DealerId)->update($data);
        return redirect()->route('autodealer.edit', ['DealerId' => $DealerId])->with('info', 'Auto Dealer Updated Successfully');

    }
}
