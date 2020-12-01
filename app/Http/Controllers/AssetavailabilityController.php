<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Assetavailability;

class AssetavailabilityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /*public function index()
    {
        $assetavailabilitys = Assetavailability::all();

        return view('assetavailability.index')
        ->with('assetavailabilitys', $assetavailabilitys);
    }


    public function add()
    {                
        return view('assetmake.add');
    }*/

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'Make' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $AssetId = $request->input('AssetId');
          $StartDate = $request->input('StartDate');
          $EndDate = $request->input('EndDate');
          $VendorId = $request->input('VendorId');
          $WorkOrderId = $request->input('WorkOrderId');
          $Reason = $request->input('Reason');
          $Status = '1';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'StartDate' =>$StartDate, 'EndDate' =>$EndDate, 'VendorId' =>$VendorId, 'WorkOrderId' =>$WorkOrderId, 'Reason' =>$Reason, 'Status' =>$Status,'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assetavailability::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'New Assetavailability Created Successfully');
      
    }


    /*public function edit($MakeId)
    {
        $assetmake = Assetavailability::find($MakeId);
        return view('assetmake.edit')
        ->with('assetmake', $assetmake);
    }*/

    public function update(Request $request, $AssetAvailId)
    {      
       /*$this->validate($request, 
       [
           'Make' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'AssetId' => $request->input('AssetId'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'VendorId' => $request->input('VendorId'),
            'WorkOrderId' => $request->input('WorkOrderId'),
            'Reason' => $request->input('Reason'),
            'Status' => '1',
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );
        $AssetId = $request->input('AssetId');
        Assetavailability::where('AssetAvailId', $AssetAvailId)->update($data);
        return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Assetavailability Updated Successfully');

    }


    public function updateAssetAvail(Request $request, $AssetAvailId)
    {      
       /*$this->validate($request, 
       [
           'Make' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'EndDate' => $request->input('EndDate'),
            'Status' => '0',
            'updated_at' => date('Y-m-j')
        );
        $AssetId = $request->input('AssetId');
        Assetavailability::where('AssetAvailId', $AssetAvailId)->update($data);
        return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Has Been Put Back To Service Today');

    }
}
