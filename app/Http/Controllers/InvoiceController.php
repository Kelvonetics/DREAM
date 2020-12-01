<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Invoice;
use Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Invoice AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $invoices = Invoice::all();
            
            return view('invoice.index')
            ->with('invoices', $invoices);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    { 
        //Invoice AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $inv_count = Invoice::count();        ++$inv_count;
            
            return view('invoice.add')
            ->with('inv_count', $inv_count);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      $this->validate($request, 
      [
        'InvoiceNumber' => 'required',
        'ClientId' => 'required',
        'CreatedDate' => 'required',
        'DueDate' => 'required',
        'Status' => 'required',
        'SubTotal' => 'required',
        'DatePaid' => 'required',
        'TotalDue' => 'required',
        'PaymentMethod' => 'required',
        'TotalCost' => 'required',
        'Notes' => 'required',
        'Tax' => 'required',
        'WorkOrderId' => 'required',
        'CreatedBy' => 'required'
      ]);
        
          //INSERT FOR INVOICE TABLE
          $InvoiceNumber = $request->input('InvoiceNumber');
          $ClientId = $request->input('ClientId');
          $CreatedDate = $request->input('CreatedDate');
          $DueDate = $request->input('DueDate');
          $Status = $request->input('Status');
          $SubTotal = $request->input('SubTotal');
          $DatePaid = $request->input('DatePaid');
          $TotalDue = $request->input('TotalDue');
          $PaymentMethod = $request->input('PaymentMethod');
          $TotalCost= $request->input('TotalCost');
          $Notes = $request->input('Notes');
          $Tax = $request->input('Tax');
          $WorkOrderId = $request->input('WorkOrderId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'CreatedDate' =>$CreatedDate, 'DueDate' =>$DueDate, 'Status' =>$Status, 'SubTotal' =>$SubTotal, 'DatePaid' =>$DatePaid, 'TotalDue' =>$TotalDue, 'PaymentMethod' =>$PaymentMethod, 'TotalCost' =>$TotalCost, 'Notes' =>$Notes, 'Tax' =>$Tax, 'WorkOrderId' =>$WorkOrderId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Invoice::insert($data);


          //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP
          $shopemail = $request->input('Email');
          $message = $request->input('Notes').' Invoice Number : '.$request->input('InvoiceNumber');


          //INSERT FOR CLIENT EMAIL TABLE
          $ClientEmail = $shopemail;
          $FromAddress = 'info@dream360.com';
          $Message = $message;
          $Status = 'Unread';
          $State = '1';
          $RoleId = '10';
          $InvoiceNumber = $request->input('InvoiceNumber');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $email_data = array('ClientEmail' =>$ClientEmail, 'FromAddress' =>$FromAddress, 'Message' =>$Message, 'Status' =>$Status, 'State' =>$State, 'RoleId' =>$RoleId,'InvoiceNumber' =>$InvoiceNumber, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          DB::table('invoiceemail')->insert($email_data);



         //inserting for Part Items
        $ct = $this->request->data('ct');
        for($i = 1; $i <= $ct; $i++)
        {
            $InvoiceNumber = $request->input('InvoiceNumber');
            $ClientId = $request->input('ClientId');
            $Quantity = $request->input('Quantity');
            $Description = $request->input('Description');
            $Price = $request->input('Price');
            $Amount = $request->input('Amount');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');

            $item_data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'Quantity' =>$Quantity, 'Description' =>$Description, 'Price' =>$Price, 'Amount' =>$Amount, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);               
            DB::table('invoiceitem')->insert($item_data);
        }	
   
         return redirect()->route('invoice.index')->with('info', 'New Invoice Created Successfully');
      
    }


    public function edit($InvoiceId)
    {
        //Invoice AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $invoice = Invoice::find($InvoiceId);
            
            return view('invoice.edit')
            ->with('invoice', $invoice);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $InvoiceId)
    {      
        $this->validate($request, 
        [
            'InvoiceNumber' => 'required',
            'ClientId' => 'required',
            'CreatedDate' => 'required',
            'DueDate' => 'required',
            'Status' => 'required',
            'PaymentMethod' => 'required',
            'Notes' => 'required',
            'Tax' => 'required',
            'WorkOrderId' => 'required',
            'CreatedBy' => 'required'
        ]);

       $data = array(
            'InvoiceNumber' => $request->input('InvoiceNumber'),
            'ClientId' => $request->input('ClientId'),
            'CreatedDate' => $request->input('CreatedDate'),
            'DueDate' => $request->input('DueDate'),
            'Status' => $request->input('Status'),
            'SubTotal' => $request->input('SubTotal'),
            'DatePaid' => $request->input('DatePaid'),
            'TotalDue' => $request->input('TotalDue'),
            'PaymentMethod' => $request->input('PaymentMethod'),
            'TotalCost' => $request->input('TotalCost'),
            'Notes' => $request->input('Notes'),
            'Tax' => $request->input('Tax'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );
        Invoice::where('InvoiceId', $InvoiceId)->update($data);

            //updating for invoice Items
            $countinv = $request->input('countinv');
            for($i = 1; $i <= $countinv; $i++)
            {
                //updating Part In Workorderitem Table
                $item_data = array(
                    'Quantity' => $request->input('Quantity'.$i.''),
                    'Description' => $request->input('Description'.$i.''),
                    'Price' => $request->input('Price'.$i.''),
                    'Amount' => $request->input('Amount'.$i.''),
                    'updated_at' => date('Y-m-j')
                );
                $ItemId = $request->input('ItemId'.$i.'');
                DB::table('invoiceitem')->where('ItemId', $ItemId)->update($item_data);             
            }


        $InvoiceNumber = $request->input('InvoiceNumber');
        return redirect()->route('invoice.index')->with('info', ' Invoice Updated With '.$countinv .' Part Item(s) Added For Invoice Number : '.$InvoiceNumber);

    }
}
