<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Schedulemaintenance;

class SchedulemaintenanceController extends Controller
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

        //CALCULATING DUE DATE
        $rem_ldate = $request->input('LastMaintDate');     
        $rem_dintvals = $request->input('DateInterval');  $rem_dintval = $rem_dintvals * 30;
        $rem_drem = $request->input('DateReminder'); 
        $duedate = date('m/d/Y', strtotime($rem_ldate. ' + '.$rem_dintval.' days'));
        $startremdate = date('m/d/Y', strtotime($duedate. ' - '.$rem_drem.' days'));

          $AssetId = $request->input('AsId');
          $MileInterval = $request->input('MileInterval');
          $DateInterval = $request->input('DateInterval');
          $LastMaintMile = $request->input('LastMaintMile');
          $LastMaintDate = $request->input('LastMaintDate');
          $DateReminder = $request->input('DateReminder');
          $MileReminder = $request->input('MileReminder');
          $CurrentMile = $request->input('CurrentMile');
          $DueReminderDate = $startremdate;
          $DueDate = $duedate;
          $WorkshopId = $request->input('WorkshopId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'MileInterval' =>$MileInterval, 'DateInterval' =>$DateInterval, 'LastMaintMile' =>$LastMaintMile, 'LastMaintDate' =>$LastMaintDate, 'DateReminder' =>$DateReminder, 'MileReminder' =>$MileReminder, 'CurrentMile' =>$CurrentMile, 'DueReminderDate' =>$DueReminderDate, 'DueDate' =>$DueDate, 'WorkshopId' =>$WorkshopId,'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Schedulemaintenance::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Vehicle Schedulemaintenance Was Created Successfully');
      
    }

    public function update(Request $request, $SchMaintId)
    {      
       /*$this->validate($request, 
       [
           'Make' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/
            //CALCULATING DUE DATE
			$rem_ldate = $request->input('LastMaintDate');     
			$rem_dintvals = $request->input('DateInterval');  $rem_dintval = $rem_dintvals * 30;
			$rem_drem = $request->input('DateReminder'); 
			$duedate = date('m/d/Y', strtotime($rem_ldate. ' + '.$rem_dintval.' days'));
			$startremdate = date('m/d/Y', strtotime($duedate. ' - '.$rem_drem.' days'));

       $data = array(
            'AssetId' => $request->input('AsId'),
            'MileInterval' => $request->input('MileInterval'),
            'DateInterval' => $request->input('DateInterval'),
            'LastMaintMile' => $request->input('LastMaintMile'),
            'LastMaintDate' => $request->input('LastMaintDate'),
            'DateReminder' => $request->input('DateReminder'),
            'MileReminder' => $request->input('MileReminder'),
            'CurrentMile' => $request->input('CurrentMile'),
            'DueReminderDate' => $startremdate,
            'DueDate' => $duedate,
            'WorkshopId' => $request->input('WorkshopId'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );
        $AssetId = $request->input('AsId');
        Schedulemaintenance::where('SchMaintId', $SchMaintId)->update($data);
        return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Vehicle Schedulemaintenance Updated Successfully');

    }
}
