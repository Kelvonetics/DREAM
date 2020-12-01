<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Assetretiredetail;

class AssetretiredetailController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'Make' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $AssetId = $request->input('AsId');
          $RetireDate = $request->input('RetireDate');
          $RetireMileage = $request->input('RetireMileage');
          $DisposalMethod = $request->input('DisposalMethod');
          $RetireSalePrice = $request->input('RetireSalePrice');
          $RetireReason = $request->input('RetireReason');
          $RetireComment = $request->input('RetireComment');
          $Status = $request->input('Status');
          $DomainId = '5';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'RetireDate' =>$RetireDate, 'RetireMileage' =>$RetireMileage, 'DisposalMethod' =>$DisposalMethod, 'RetireSalePrice' =>$RetireSalePrice, 'RetireReason' =>$RetireReason, 'RetireComment' =>$RetireComment, 'Status' =>$Status, 'DomainId' =>$DomainId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assetretiredetail::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Vehicle Retirement Was Successfully');
      
    }

    public function update(Request $request, $RetireId)
    {      
       
    }
}
