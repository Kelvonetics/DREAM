<?php

namespace App\Http\Controllers;

use App\Budget;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tot_dist;

class BudgetController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    /*public function store(Request $request)
    {   
        //get file
        $upload=$request->file('upload_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');

        $header=fgetcsv($file);

        //dd($header);
       $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) 
        {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        //dd($escapedHeader);

        //looping through other columns
        while($columns = fgetcsv($file))
        {
            if($columns[0] == "")
            {
                continue;
            }
            //trim data
            foreach ($columns as $key => &$value) 
            {
                $value = preg_replace('/\D/','',$value);
            }

           $data = array_combine($header, $columns);

           // setting type
           foreach ($data as $key => &$value) 
           {
                $value = ($key == "zip" || $key == "month")?(integer)$value: (float)$value;
           }

           // Table update
           $zip = $data['zip'];
           $month = $data['month'];
           $lodging = $data['lodging'];
           $meal = $data['meal'];
           $housing = $data['housing'];
           $plate = $data['plate'];

           $budget = Budget::firstOrNew(['zip' => $zip,'month' => $month]);
           $budget->lodging = $lodging;
           $budget->meal = $meal;
           $budget->housing = $housing;
           $budget->plate = $plate;
           $budget->save();
        }
        
        
    }*/


    public function store_tot_dist(Request $request)
    {   
        //get file
        $upload=$request->file('upload_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');

        $header=fgetcsv($file);

        //dd($header);
       $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) 
        {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        //dd($escapedHeader);

        //looping through other columns
        while($columns = fgetcsv($file))
        {
            if($columns[0] == "")
            {
                continue;
            }
            //trim data
            foreach ($columns as $key => &$value) 
            {
               $value = preg_replace('/\D/','',$value);
            }

           $data = array_combine($header, $columns);

           // setting type
           foreach ($data as $key => &$value) 
           {
                $value = ($key == "assetid" || $key == "typeid")?(integer)$value: (float)$value;
           }

           // Table update
           $assetid = $data['assetid'];
           $typeid = $data['typeid'];
           $vehicle = $data['vehicle'];
           $starttime = $data['starttime'];
           $stoptime = $data['stoptime'];
           $beginingmileage = $data['beginingmileage'];
           $endmileage = $data['endmileage'];
           $totaldistance = $data['totaldistance'];

           $tot_dist = Tot_dist::firstOrNew(['assetid' => $assetid,'typeid' => $typeid]);
           $tot_dist->vehicle = $vehicle;
           $tot_dist->starttime = $starttime;
           $tot_dist->stoptime = $stoptime;
           $tot_dist->beginingmileage = $beginingmileage;
           $tot_dist->endmileage = $endmileage;
           $tot_dist->totaldistance = $totaldistance;
           $tot_dist->save();
        }
        
        
    }
}