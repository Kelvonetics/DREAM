<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Rideshare;
use App\Asset;
use App\Users;
use App\Operator;
use Auth;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function ride_share_index()
    {
      //RIDE SHARE INDEX AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $Community = $perm->Community;
      if($Community)
      {
        $rideshare = Rideshare::all();
        $assets = Asset::all();
        $operators = Operator::all();  
        $Users = Users::all();   
        $joinride = DB::table('joinride')->get();     
        
        return view('community.ride-share-index')
        ->with('rideshare', $rideshare)
        ->with('assets', $assets)
        ->with('operators', $operators)
        ->with('Users', $Users)
        ->with('joinride', $joinride);
      }
      else {  return redirect()->back(); } 
     
    }


    public function insert_rideshare(Request $request)
    {
       $this->validate($request, 
        [
            'AssetId' => 'required',
            'UserId' => 'required',
            'DepartureDate' => 'required',
            'DepartureTime' => 'required',
            'DepartureCity' => 'required',
            'DestinationCity' => 'required',
            'Duration' => 'required',
            'Stoppages' => 'required',
            'NoOfPassengers' => 'required',
            'Cost' => 'required'
        ]);

       $AssetId = $request->input('AssetId');
       $UserId = $request->input('UserId');
       $DepartureDate = $request->input('DepartureDate');
       $DepartureTime = $request->input('DepartureTime');
       $DepartureCity = $request->input('DepartureCity');
       $DestinationCity = $request->input('DestinationCity');
       $Duration = $request->input('Duration');
       $Stoppages = $request->input('Stoppages');
       $NoOfPassengers = $request->input('NoOfPassengers');
       $Cost = $request->input('Cost');
       $Status = '1';
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('AssetId' =>$AssetId, 'UserId' =>$UserId, 'DepartureDate' =>$DepartureDate, 
       'DepartureTime' =>$DepartureTime, 'DepartureCity' =>$DepartureCity, 'DestinationCity' =>$DestinationCity, 'Duration' =>$Duration, 
       'Stoppages' =>$Stoppages, 'NoOfPassengers' =>$NoOfPassengers, 'Cost' =>$Cost, 'Status' =>$Status,
       'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('rideshare')->insert($data);

      return redirect()->route('community.ride-share-index')->with('info', 'Ride Share Save Successfully');

    }

    public function joinride(Request $request)
    {
       $this->validate($request, 
        [
            'AssetId' => 'required',
            'UserId' => 'required',
            'DepartureDate' => 'required',
            'DepartureTime' => 'required',
            'DepartureCity' => 'required',
            'DestinationCity' => 'required',
            'Duration' => 'required',
            'Stoppages' => 'required',
            'NoOfPassengers' => 'required',
            'Cost' => 'required'
        ]);

       $AssetId = $request->input('AssetId');
       $UserId = $request->input('UserId');
       $DepartureDate = $request->input('DepartureDate');
       $DepartureTime = $request->input('DepartureTime');
       $DepartureCity = $request->input('DepartureCity');
       $DestinationCity = $request->input('DestinationCity');
       $Duration = $request->input('Duration');
       $Stoppages = $request->input('Stoppages');
       $NoOfPassengers = $request->input('NoOfPassengers');
       $Cost = $request->input('Cost');
       $Status = '1';
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('AssetId' =>$AssetId, 'UserId' =>$UserId, 'DepartureDate' =>$DepartureDate, 
       'DepartureTime' =>$DepartureTime, 'DepartureCity' =>$DepartureCity, 'DestinationCity' =>$DestinationCity, 'Duration' =>$Duration, 
       'Stoppages' =>$Stoppages, 'NoOfPassengers' =>$NoOfPassengers, 'Cost' =>$Cost, 'Status' =>$Status,
       'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('rideshare')->insert($data);

      return redirect()->route('community.ride-share-index')->with('info', 'Ride Share Save Successfully');

    }

    public function rideshare_edit($RideShareId)
    {
        //ASSET EDIT AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
          $rideshares = Rideshare::find($RideShareId);
          $assets = Asset::all();
          $operators = Operator::all(); 
          return view('community.rideshare-edit')
          ->with('rideshares', $rideshares)
          ->with('assets', $assets)
          ->with('operators', $operators);
        }
        else {  return redirect()->back(); } 

    }


    public function rideshare_update(Request $request, $RideShareId)
    {
        $rideshare = Rideshare::find($RideShareId);       
       /*$this->validate($request, 
       [
           'MakeId' => 'required',
           'ModelId' => 'required',
           'LicensePlate' => 'required',
           'VIN' => 'required',
           'DeptId' => 'required',
           'LocationId' => 'required',
           'EqpYear' => 'required',
           'FuelTypeId' => 'required',
           'AssetTypeId' => 'required',
           'Color' => 'required',
           'CreatedBy' => 'required',
           'Active' => 'required'
       ]);*/

       $data = array(
            'AssetId' => $request->input('AssetId'),
            'UserId' => $request->input('UserId'),
            'DepartureDate' => $request->input('DepartureDate'),
            'DepartureTime' => $request->input('DepartureTime'),
            'DepartureCity' => $request->input('DepartureCity'),
            'DestinationCity' => $request->input('DestinationCity'),
            'Stoppages' => $request->input('Stoppages'),
            'NoOfPassengers' => $request->input('NoOfPassengers'),
            'Cost' => $request->input('Cost'),
            'Status' => $request->input('Status'),
            'CreatedBy' => $request->input('CreatedBy'),
            'created' => date('Y-M-j'),
            'updated_at' => date('Y-m-j')
        );

        Rideshare::where('RideShareId', $RideShareId)->update($data);
        return redirect()->route('community.ride-share-index')->with('info', 'Ride Share Details Updated Successfully');

    }
    



    public function joinride_index()
    {
      //RIDE SHARE INDEX AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $Community = $perm->Community;
      if($Community)
      {
        $joinride = DB::table('joinride')->get();       
        
        return view('community.joinride-index')
        ->with('joinride', $joinride);
      }
      else {  return redirect()->back(); } 
     
    }

    public function insert_joinride(Request $request)
    {
       $this->validate($request, 
        [
            'RideShareId' => 'required',
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required',
            'Phone' => 'required',
            'Street' => 'required',
            'City' => 'required',
            'State' => 'required',
            'NoOfSeats' => 'required'
        ]);

       $RideShareId = $request->input('RideShareId');
       $FirstName = $request->input('FirstName');
       $LastName = $request->input('LastName');
       $Email = $request->input('Email');
       $Phone = $request->input('Phone');
       $Street = $request->input('Street');
       $City = $request->input('City');
       $State = $request->input('State');
       $NoOfSeats = $request->input('NoOfSeats');
       $Note = $request->input('Note');
       $Status = '0';
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('RideShareId' =>$RideShareId, 'FirstName' =>$FirstName, 'LastName' =>$LastName, 
       'Email' =>$Email, 'Phone' =>$Phone, 'Street' =>$Street, 'City' =>$City, 
       'State' =>$State, 'NoOfSeats' =>$NoOfSeats, 'Note' =>$Note, 'Status' =>$Status, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('joinride')->insert($data);

      return redirect()->route('community.joinride-index')->with('info', 'Joining Ride Was Saved Successfully');

    }
}
