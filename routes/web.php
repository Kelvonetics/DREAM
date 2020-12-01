<?php
use Illuminate\Support\Facades\Input;
use App\Assetmodel;
use App\Assetnote;
use App\Vendor;
use App\invcategory;
use App\Inventoryitem;
use App\Workorderlabour;
use App\Schedulemaintenance;
use App\Workshop;
use App\Assetavailability;
use App\Client;
use App\Clientasset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/', function (){ return view('welcome'); });
});


/*Route::get('/home', function () 
{
    dd('Home');    //return view('index');
}); */

Route::get('/register', function () 
{
    return view('auth.register');    //return view('index');
});
Auth::routes();

Route::get('/home', 'HomeController@welcome')->name('home');

Route::post('/login/custom', 
	[
		'uses' => 'loginController@login',  'as' => 'login.custom'
	]);


Route::group(['middleware' => 'auth'], function()
{
	Route::get('/home', function()
	{
		return view('home');
	})->name('home');

	Route::get('/dashboard', function()
	{
		return view('dashboard');
	})->name('dashboard');
});





Route::group(['middleware' => 'auth'], function()
{
Route::get('/best/index', 'BestController@index')->name('best.index');
});












/// asset routes 

Route::get('/asset', 'AssetController@index')->name('asset.index');

Route::get('/asset/index', 'AssetController@index')->name('asset.index');


Route::get('/asset/assignvehicle', 'AssetController@assignvehicle')->name('asset.assignvehicle');

Route::get('/asset/availvehicles', 'AssetController@availvehicles')->name('asset.availvehicles');

Route::post('/asset/addAssignVehicle', 'AssetController@addAssignVehicle')->name('asset.addAssignVehicle');


//route to get Driver Name
Route::get('/getdrivername', function () 
{
	$UserId = Input::get('UserId');
	$driverNames = Users::where('UserId', '=', '$UserId')->get();

    return Response::json($driverNames);
});

Route::post('/asset/insertasset', 'AssetController@insertasset')->name('asset.insertasset');

Route::post('/asset/addAssetExpenseFromIndex', 'AssetController@addAssetExpenseFromIndex')->name('asset.addAssetExpenseFromIndex');

Route::get('/asset/logFuel', 'AssetController@logFuel')->name('asset.logFuel');

Route::post('/asset/addFuel', 'AssetController@addFuel')->name('asset.addFuel');


//route to get asset models based on make selected when adding new asset
Route::get('/make-models', function () 
{
	$MakeId = Input::get('MakeId');
	$assetmodel = Assetmodel::where('MakeId', '=', $MakeId)->get();

    return Response::json($assetmodel);
});

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/asset/add', 'AssetController@add')->name('asset.add');
});

Route::post('/asset/insert', 'AssetController@insert')->name('asset.insert');

Route::get('/asset/view/{id}', 'AssetController@view')->name('asset.view');


Route::post('/asset/update/{id}', 'AssetController@update');



// PURCHASE SUMMARY
Route::post('/asset/updateSummary/{id}', 'AssetController@updateSummary');
Route::post('/asset/addSummary/{id}', 'AssetController@addSummary');


//ASSET EXPENSE
Route::post('/asset/addAssetExpense', 'AssetController@addAssetExpense');

//ASSET FILE UPLOAD
Route::post('/asset/uploadAssetFile', 'AssetController@uploadAssetFile');

Route::post('/asset/uploadAssetFileFromIndex', 'AssetController@uploadAssetFileFromIndex');


//route to get asset models based on make selected when adding new asset
Route::get('/asset-notes', function () 
{
	//$AssetId = Input::get('MakeId');
	$assetnote = Assetnote::where('AssetId', '=', 1)->get();

    return Response::json($assetnote);
});


//ASSET NOTES
Route::post('/asset/addNote', 'AssetController@addNote');

//route to get asset notes
Route::get('/fetch-assetnotes', function () 
{
	$assetnotes = DB::table('assetnotes')->orderBy('EqpNotesId', 'desc')->take(10)->get();

    return Response::json($assetnotes);
});

//PUTTING VEHICLE BACK IN SERVICE
Route::post('/assetavailability/updateAssetAvail/{AssetAvailId}', 'AssetavailabilityController@updateAssetAvail');


//UPLOAD ASSET PROFILE PHOTO
Route::post('/asset/uploadProfilePhoto', 'AssetController@uploadProfilePhoto');

Route::get('/asset/driver-resent-assets/{Id}', 'AssetController@driver_resent_assets')->name('asset.driver-resent-assets');




// USERS ROUTE
Route::group(['middleware' => 'auth'], function()
{
Route::get('/user/', 'UserController@index')->name('user.index');
});

Route::group(['middleware' => 'auth'], function()
{
Route::get('/user/index', 'UserController@index')->name('user.index');
});

Route::get('/user/add', 'UserController@add')->name('user.add');

Route::post('/user/insert', 'UserController@insert')->name('user.insert');

Route::get('/user/edit/{UserId}', 'UserController@edit')->name('user.edit');

Route::post('/user/update/{UserId}', 'UserController@update')->name('user.update');

//UPLOAD USER PROFILE PHOTO
Route::post('/user/uploadProfilePhoto', 'UserController@uploadProfilePhoto');





// OPERATOR ROUTE
Route::get('/operator/', 'OperatorController@index')->name('operator.index');

Route::get('/operator/index', 'OperatorController@index')->name('operator.index');

Route::get('/operator/add', 'OperatorController@add')->name('operator.add');

Route::post('/operator/insert', 'OperatorController@insert')->name('operator.insert');

Route::get('/operator/addOperator/{id}', 'OperatorController@addOperator')->name('operator.addOperator');


//route to get user department
Route::get('/user-department', function () 
{
	$userDept = DB::table('department')->orderBy('DeptName', 'asc')->get();

    return Response::json($userDept);
});


Route::get('/operator/view/{id}', 'OperatorController@view')->name('operator.view');

Route::post('/operator/update/{OperatorId}', 'OperatorController@update')->name('operator.update');


//OPERATOR INCIDENT
Route::post('/operator/addIncident', 'OperatorController@addIncident');

//OPERATOR CERTIFICATION
Route::post('/operator/addCertificate', 'OperatorController@addCertificate');

//OPERATOR LEAVE
Route::post('/operator/addLeave', 'OperatorController@addLeave');

//OPERATOR INCIDENT FROM INDEX
Route::post('/operator/addIncidentFromIndex', 'OperatorController@addIncidentFromIndex');

//OPERATOR CERTIFICATION FROM INDEX
Route::post('/operator/addCertificateFromIndex', 'OperatorController@addCertificateFromIndex');

//OPERATOR LEAVE FROM INDEX
Route::post('/operator/addLeaveFromIndex', 'OperatorController@addLeaveFromIndex');

//OPERATOR NOTES
Route::post('/operator/addNote', 'OperatorController@addNote');

//route to get operator notes
Route::get('/fetch-operatornotes', function () 
{
	$Id = Input::get('UserId');
	$drivernotes = DB::table('drivernotes')->take(10)->orderBy('EqpNotesId', 'desc')->take(10)->get();

    return Response::json($drivernotes);
});

Route::get('/operator/absent-jobs-and-vehicles/{id}', 'OperatorController@absent_jobs_and_vehicles')->name('operator.absent-jobs-and-vehicles');

//UPLOAD USER PROFILE PHOTO
Route::post('/operator/uploadProfilePhoto', 'OperatorController@uploadProfilePhoto');





// INVENTORY ITEM ROUTE
Route::get('/inventoryItem/', 'InventoryitemController@index')->name('inventoryItem.index');

Route::get('/inventoryItem/index', 'InventoryitemController@index')->name('inventoryItem.index');

Route::get('/inventoryItem/add', 'InventoryitemController@add')->name('inventoryItem.add');

Route::post('/inventoryItem/insert', 'InventoryitemController@insert')->name('inventoryItem.insert');

//route to get inventory item vendors based on category selected when adding new inventory item
Route::get('/invcat-vendors', function () 
{
	$InvCatId = Input::get('InvCatId');
	$vendors = Vendor::where('InvCatId', '=', $InvCatId)->get();

    return Response::json($vendors);
});

Route::get('/inventoryItem/edit/{InvId}', 'InventoryitemController@edit')->name('inventoryItem.edit'); 

Route::post('/inventoryItem/update/{InvId}', 'InventoryitemController@update')->name('inventoryItem.update'); 





// ROLE ROUTE
Route::get('/role/', 'RoleController@index')->name('role.index');

Route::get('/role/index', 'RoleController@index')->name('role.index');

Route::get('/role/add', 'RoleController@add')->name('role.add');

Route::post('/role/insert', 'RoleController@insert')->name('role.insert');
 
Route::get('/role/edit/{RoleId}', 'RoleController@edit')->name('role.edit');

Route::post('/role/update/{RoleId}', 'RoleController@update');

Route::get('/role/permission/{RoleId}', 'RoleController@permission')->name('role.permission');

Route::post('/role/permission_update/{RoleId}', 'RoleController@permission_update');





// USER POSITION ROUTE
Route::get('/userposition/', 'UserpositionController@index')->name('userposition.index');

Route::get('/userposition/index', 'UserpositionController@index')->name('userposition.index');

Route::get('/userposition/add', 'UserpositionController@add')->name('userposition.add');

Route::post('/userposition/insert', 'UserpositionController@insert')->name('userposition.insert');

Route::get('/userposition/edit/{PositionId}', 'UserpositionController@edit')->name('userposition.edit');

Route::post('/userposition/update/{PositionId}', 'UserpositionController@update');





// USER DEPARTMENT ROUTE
Route::get('/department/', 'DepartmentController@index')->name('department.index');

Route::get('/department/index', 'DepartmentController@index')->name('department.index');

Route::get('/department/add', 'DepartmentController@add')->name('department.add');

Route::post('/department/insert', 'DepartmentController@insert')->name('department.insert');

Route::get('/department/edit/{PositionId}', 'DepartmentController@edit')->name('department.edit');

Route::post('/department/update/{PositionId}', 'DepartmentController@update');





// COMPANY LOCATION ROUTE
Route::get('/companylocation/', 'CompanylocationController@index')->name('companylocation.index');

Route::get('/companylocation/index', 'CompanylocationController@index')->name('companylocation.index');

Route::get('/companylocation/add', 'CompanylocationController@add')->name('companylocation.add');

Route::post('/companylocation/insert', 'CompanylocationController@insert')->name('companylocation.insert');

Route::get('/companylocation/edit/{PositionId}', 'CompanylocationController@edit')->name('companylocation.edit');

Route::post('/companylocation/update/{PositionId}', 'CompanylocationController@update');





// ASSET MAKE ROUTE
Route::get('/assetmake/', 'AssetmakeController@index')->name('assetmake.index');

Route::get('/assetmake/index', 'AssetmakeController@index')->name('assetmake.index');

Route::get('/assetmake/add', 'AssetmakeController@add')->name('assetmake.add');

Route::post('/assetmake/insert', 'AssetmakeController@insert')->name('assetmake.insert');

Route::get('/assetmake/edit/{PositionId}', 'AssetmakeController@edit')->name('assetmake.edit');

Route::post('/assetmake/update/{PositionId}', 'AssetmakeController@update');



// ASSET MODEL ROUTE
Route::get('/assetmodel/', 'AssetmodelController@index')->name('assetmodel.index');

Route::get('/assetmodel/index', 'AssetmodelController@index')->name('assetmodel.index');

Route::get('/assetmodel/add', 'AssetmodelController@add')->name('assetmodel.add');

Route::post('/assetmodel/insert', 'AssetmodelController@insert')->name('assetmodel.insert');

Route::get('/assetmodel/edit/{PositionId}', 'AssetmodelController@edit')->name('assetmodel.edit');

Route::post('/assetmodel/update/{PositionId}', 'AssetmodelController@update');



// ASSET TYPE ROUTE
Route::get('/assettype/', 'AssettypeController@index')->name('assettype.index');

Route::get('/assettype/index', 'AssettypeController@index')->name('assettype.index');

Route::get('/assettype/add', 'AssettypeController@add')->name('assettype.add');

Route::post('/assettype/insert', 'AssettypeController@insert')->name('assettype.insert');

Route::get('/assettype/edit/{PositionId}', 'AssettypeController@edit')->name('assettype.edit');

Route::post('/assettype/update/{PositionId}', 'AssettypeController@update');



// VENDOR ROUTE
Route::get('/vendor/', 'VendorController@index')->name('vendor.index');

Route::get('/vendor/index', 'VendorController@index')->name('vendor.index');

Route::get('/vendor/add', 'VendorController@add')->name('vendor.add');

Route::post('/vendor/insert', 'VendorController@insert')->name('vendor.insert');

Route::get('/vendor/edit/{PositionId}', 'VendorController@edit')->name('vendor.edit');

Route::post('/vendor/update/{PositionId}', 'VendorController@update');




// INVENTORY CATEGORY ROUTE
Route::get('/invcategory/', 'InvcategoryController@index')->name('invcategory.index');

Route::get('/invcategory/index', 'InvcategoryController@index')->name('invcategory.index');

Route::get('/invcategory/add', 'InvcategoryController@add')->name('invcategory.add');

Route::post('/invcategory/insert', 'InvcategoryController@insert')->name('invcategory.insert');

Route::get('/invcategory/edit/{PositionId}', 'InvcategoryController@edit')->name('invcategory.edit');

Route::post('/invcategory/update/{PositionId}', 'InvcategoryController@update');




// WORK ORDER LABOUR ROUTE
Route::get('/workorderlabour/', 'WorkorderlabourController@index')->name('workorderlabour.index');

Route::get('/workorderlabour/index', 'WorkorderlabourController@index')->name('workorderlabour.index');

Route::get('/workorderlabour/add', 'WorkorderlabourController@add')->name('workorderlabour.add');

Route::post('/workorderlabour/insert', 'WorkorderlabourController@insert')->name('workorderlabour.insert');

Route::get('/workorderlabour/edit/{Id}', 'WorkorderlabourController@edit')->name('workorderlabour.edit');

Route::post('/workorderlabour/update/{Id}', 'WorkorderlabourController@update');





// AUTO DEALER ROUTE
Route::get('/autodealer/', 'AutodealerController@index')->name('autodealer.index');

Route::get('/autodealer/index', 'AutodealerController@index')->name('autodealer.index');

Route::get('/autodealer/add', 'AutodealerController@add')->name('autodealer.add');

Route::post('/autodealer/insert', 'AutodealerController@insert')->name('autodealer.insert');

Route::get('/autodealer/edit/{Id}', 'AutodealerController@edit')->name('autodealer.edit');

Route::post('/autodealer/update/{Id}', 'AutodealerController@update');




// AUTO WORKSHOP ROUTE
Route::get('/workshop/', 'WorkshopController@index')->name('workshop.index');

Route::get('/workshop/index', 'WorkshopController@index')->name('workshop.index');

Route::get('/workshop/add', 'WorkshopController@add')->name('workshop.add');

Route::post('/workshop/insert', 'WorkshopController@insert')->name('workshop.insert');

Route::get('/workshop/edit/{Id}', 'WorkshopController@edit')->name('workshop.edit');

Route::post('/workshop/update/{Id}', 'WorkshopController@update');





// ASSET AVAILABILITY ROUTE
Route::post('/assetavailability/insert/{AssetId}', 'AssetavailabilityController@insert')->name('assetavailability.insert'); 

Route::post('/assetavailability/update/{AssetAvailId}', 'AssetavailabilityController@update');



// ASSET SCHEDULE MAINTENANCE ROUTE
Route::post('/schedulemaintenance/insert/{AssetId}', 'SchedulemaintenanceController@insert')->name('schedulemaintenance.insert'); 

Route::post('/schedulemaintenance/update/{SchMaintId}', 'SchedulemaintenanceController@update');





// WORKORDER ROUTE
Route::get('/workorder/', 'WorkorderController@index')->name('workorder.index');

Route::get('/workorder/index', 'WorkorderController@index')->name('workorder.index');

Route::get('/workorder/add', 'WorkorderController@add')->name('workorder.add');

Route::post('/workorder/insert', 'WorkorderController@insert')->name('workorder.insert');

Route::get('/workorder/edit/{Id}', 'WorkorderController@edit')->name('workorder.edit');

Route::get('/workorder/approve_decline/{Id}', 'WorkorderController@approve_decline')->name('workorder.approve_decline');

Route::post('/workorder/approve/{Id}', 'WorkorderController@approve');

Route::post('/workorder/decline/{Id}', 'WorkorderController@decline');

Route::get('/workorder/approved/{Id}', 'WorkorderController@approved')->name('workorder.approved');

Route::post('/workorder/update/{Id}', 'WorkorderController@update');





//route to get all inventory category
Route::get('/loadcategory', function () 
{
	$cates = Invcategory::all();

    return Response::json($cates);
});

//route to get inventory category with the same invitem id
Route::get('/loadpart', function () 
{
	$InvCatId = Input::get('InvCatId');
	$cate = Inventoryitem::where('InvCatId', '=', $InvCatId)->get();

    return Response::json($cate);
});

//route to get Part Cost
Route::get('/loadcost', function () 
{
	$InvId = Input::get('InvId');
	$part_cost = Inventoryitem::where('InvId', '=', $InvId)->get();

    return Response::json($part_cost);
});

//route to get all Labour Description
Route::get('/loadlabour', function () 
{
	$labours = Workorderlabour::all();
	
		return Response::json($labours);
});


//route to get Labour Cost
Route::get('/loadlabourcost', function () 
{
	$LabourId = Input::get('LabourId');
	$labour_cost = Workorderlabour::where('LabourId', '=', $LabourId)->get();

    return Response::json($labour_cost);
});



//route to get Scheduled Maintenance Id
Route::get('/fetchschmaintid', function () 
{
	$AssetId = Input::get('AssetId');
	$SchMaintId = Schedulemaintenance::where('AssetId', '=', $AssetId)->get();

    return Response::json($SchMaintId);
});


//route to get Workshop Email
Route::get('/fetchshopemail', function () 
{
	$WorkShopId = Input::get('WorkShopId');
	$shop_email = Workshop::where('WorkShopId', '=', $WorkShopId)->get();

    return Response::json($shop_email);
});




// CLIENT ROUTE
Route::get('/client/', 'ClientController@index')->name('client.index');

Route::get('/client/index', 'ClientController@index')->name('client.index');

Route::get('/client/add', 'ClientController@add')->name('client.add');

Route::post('/client/insert', 'ClientController@insert')->name('client.insert');

Route::get('/client/edit/{Id}', 'ClientController@edit')->name('client.edit');

Route::post('/client/update/{Id}', 'ClientController@update');

Route::get('/client/view/{Id}', 'ClientController@view')->name('client.view');

Route::post('/client/editactive/', 'ClientController@editactive');

Route::post('/client/editinactive/', 'ClientController@editinactive');

Route::post('/client/retireclientasset/', 'ClientController@retireclientasset')->name('client.retireclientasset');

Route::get('/client/clientprofile/{Id}', 'ClientController@clientprofile')->name('client.clientprofile');

Route::post('/client/updateClientProfile/{Id}', 'ClientController@updateClientProfile');




//CLIENT NOTES  
Route::post('/client/addNote', 'ClientController@addNote');

//route to get client notes
Route::get('/fetch-clientnotes', function () 
{
	$clientnotes = DB::table('clientnotes')->orderBy('ClientNotesId', 'desc')->take(10)->get();

    return Response::json($clientnotes);
});

//CLIENT ASSET
Route::post('/client/insertClientAssetFromIndex', 'ClientController@insertClientAssetFromIndex')->name('client.insertClientAssetFromIndex');
Route::post('/client/insertClientAssetFromView', 'ClientController@insertClientAssetFromView')->name('client.insertClientAssetFromView');

//CLIENT QUOTE
Route::post('/client/insertClientQuoteFromView', 'ClientController@insertClientQuoteFromView')->name('client.insertClientQuoteFromView');

//CLIENT INVOICE
Route::post('/client/insertInvoiceFromIndex', 'ClientController@insertInvoiceFromIndex')->name('client.insertInvoiceFromIndex');

Route::post('/client/insertInvoiceFromView', 'ClientController@insertInvoiceFromView')->name('client.insertInvoiceFromView');




Route::get('/clientasset', 'ClientassetController@index')->name('clientasset.index');

Route::get('/clientasset/index', 'ClientassetController@index')->name('clientasset.index');

Route::get('/clientasset/add', 'ClientassetController@add')->name('clientasset.add');

Route::post('/clientasset/insert', 'ClientassetController@insert')->name('clientasset.insert');

Route::get('/clientasset/edit/{Id}', 'ClientassetController@edit')->name('clientasset.edit');

Route::post('/clientasset/update/{Id}', 'ClientassetController@update')->name('clientasset.update');

Route::get('/clientasset/view/{Id}', 'ClientassetController@view')->name('clientasset.view');


Route::post('/clientasset/insertPurchaseSummary', 'ClientassetController@insertPurchaseSummary')->name('clientasset.insertPurchaseSummary');

Route::post('/clientasset/updatePurchaseSummary/{Id}', 'ClientassetController@updatePurchaseSummary')->name('clientasset.updatePurchaseSummary');



Route::post('/clientasset/insertClientAssetExpense', 'ClientassetController@insertClientAssetExpense')->name('clientasset.insertClientAssetExpense');


Route::post('/clientasset/insertClientAssetFuel', 'ClientassetController@insertClientAssetFuel')->name('clientasset.insertClientAssetFuel');


Route::post('/clientasset/uploadClientAssetFile', 'ClientassetController@uploadClientAssetFile')->name('clientasset.uploadClientAssetFile');

Route::post('/clientasset/insertAvailability', 'ClientassetController@insertAvailability')->name('clientasset.insertAvailability');


Route::post('/clientasset/updateAvailability/{Id}', 'ClientassetController@updateAvailability')->name('clientasset.updateAvailability');

Route::post('/clientasset/putBackInService/{Id}', 'ClientassetController@putBackInService')->name('clientasset.putBackInService');

Route::post('/clientasset/retireClientAsset/{Id}', 'ClientassetController@retireClientAsset')->name('clientasset.retireClientAsset');

Route::post('/clientasset/updateClientMaintnance/{Id}', 'ClientassetController@updateClientMaintnance')->name('clientasset.updateClientMaintnance');


Route::post('/clientasset/insertClientMaintnance', 'ClientassetController@insertClientMaintnance')->name('clientasset.insertClientMaintnance');


//CLIENT ASSET PROFILE PHOTO
Route::get('/clientasset/clientAssetProfile/{Id}', 'ClientassetController@clientAssetProfile')->name('clientasset.clientAssetProfile');

Route::post('/clientasset/updateClientAssetProfile/{Id}', 'ClientassetController@updateClientAssetProfile');


//route to get clientasset models based on make selected when adding new asset
Route::get('/make-models', function() 
{
	$MakeId = Input::get('MakeId');
	$assetmodel = Assetmodel::where('MakeId', '=', $MakeId)->get();

    return Response::json($assetmodel);
});






// CLIENT WORKORDER ROUTE
Route::get('/clientworkorder', 'ClientworkorderController@index')->name('clientworkorder.index');

Route::get('/clientworkorder/index', 'ClientworkorderController@index')->name('clientworkorder.index');

Route::get('/clientworkorder/add', 'ClientworkorderController@add')->name('clientworkorder.add');

Route::post('/clientworkorder/insert', 'ClientworkorderController@insert')->name('clientworkorder.insert');

Route::get('/clientworkorder/edit/{Id}', 'ClientworkorderController@edit')->name('clientworkorder.edit');

Route::post('/clientworkorder/update/{Id}', 'ClientworkorderController@update');






//route to get all inventory category

Route::get('/loadcategory', function () 
{
	$cates = Invcategory::all();

    return Response::json($cates);
});

//route to get inventory category with the same invitem id
Route::get('/loadpart', function () 
{
	$InvCatId = Input::get('InvCatId');
	$cate = Inventoryitem::where('InvCatId', '=', $InvCatId)->get();

    return Response::json($cate);
});

//route to get Part Cost
Route::get('/loadcost', function () 
{
	$InvId = Input::get('InvId');
	$part_cost = Inventoryitem::where('InvId', '=', $InvId)->get();

    return Response::json($part_cost);
});

//route to get all Labour Description
Route::get('/loadlabour', function () 
{
	$labours = Workorderlabour::all();
	
		return Response::json($labours);
});


//route to get Labour Cost
Route::get('/loadlabourcost', function () 
{
	$LabourId = Input::get('LabourId');
	$labour_cost = Workorderlabour::where('LabourId', '=', $LabourId)->get();

    return Response::json($labour_cost);
});

//route to get Client Asset
Route::get('/fetchasset', function () 
{
	$ClientId = Input::get('ClientId');
	$clientasset = Clientasset::where('ClientId', '=', $ClientId)->get();

    return Response::json($clientasset);
});


//route to get Client Email
Route::get('/fetchclientemail', function () 
{
	$ClientId = Input::get('ClientId');
	$shop_email = Client::where('ClientId', '=', $ClientId)->get();

    return Response::json($shop_email);
});




// INVOICE ROUTE
Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');

Route::get('/invoice/index', 'InvoiceController@index')->name('invoice.index');

Route::get('/invoice/add', 'InvoiceController@add')->name('invoice.add');

Route::post('/invoice/insert', 'InvoiceController@insert')->name('invoice.insert');

Route::get('/invoice/edit/{Id}', 'InvoiceController@edit')->name('invoice.edit');

Route::post('/invoice/update/{Id}', 'InvoiceController@update');





// JOB ROUTE
Route::get('/job', 'JobController@index')->name('job.index');

Route::get('/job/index', 'JobController@index')->name('job.index');

Route::get('/job/add', 'JobController@add')->name('job.add');

Route::post('/job/insert', 'JobController@insert')->name('job.insert');

Route::get('/job/edit/{Id}', 'JobController@edit')->name('job.edit');

Route::post('/job/update/{Id}', 'JobController@update');

Route::get('/job/view/{Id}', 'JobController@view')->name('job.view');

Route::get('/job/driver-resent-jobs/{Id}', 'JobController@driver_resent_jobs')->name('job.driver-resent-jobs');







//route to get Client Address
Route::get('/loadClientDetails', function () 
{
	$ClientId = Input::get('ClientId');
	$clientAddr = Client::where('ClientId', '=', $ClientId)->get();

    return Response::json($clientAddr);
});

Route::get('/job/assignjob', 'JobController@assignjob')->name('job.assignjob');

Route::get('/job/availjobs', 'JobController@availjobs')->name('job.availjobs');

Route::post('/job/insertjob', 'JobController@insertjob')->name('job.insertjob');


/// Report routes 

Route::get('/report/vehicle', 'ReportController@vehicle')->name('report.vehicle');

Route::get('/report/vehicle-report/{id}', 'ReportController@vehicle_report')->name('report.vehicle-report');




Route::get('/report/job-report', 'ReportController@job_report')->name('report.job-report');

Route::get('/report/code', 'ReportController@code')->name('report.code');

//route to get report json for vehicle
Route::get('/fetchvehicleservice', function () 
{
	$AssetId = 1;
	$asset_service = DB::table('schedulemaintenance')->pluck('AssetId', 'CurrentMile')
	->where('AssetId', '=', $AssetId)->get();

    return Response::json($asset_service);
});


Route::get('/report/code', 'ReportController@code')->name('report.code');

Route::get('/report/data', 'ReportController@data')->name('report.data');


Route::get('/report/report', 'ReportController@report')->name('report.report');






//RIDE SHARE ROUTE
Route::get('/community/ride-share-index', 'CommunityController@ride_share_index')->name('community.ride-share-index');

Route::get('/community/add-rideshare', 'CommunityController@add_rideshare')->name('community.add-rideshare');

Route::post('/community/insert-rideshare', 'CommunityController@insert_rideshare')->name('community.insert-rideshare');

Route::get('/community/rideshare-edit/{Id}', 'CommunityController@rideshare_edit')->name('community.rideshare-edit');

Route::post('/community/rideshare-update/{Id}', 'CommunityController@rideshare_update');

Route::get('/community/view/{Id}', 'CommunityController@view')->name('community.view');


Route::post('/community/joinride', 'CommunityController@joinride')->name('community.joinride');

Route::post('/community/insert-joinride', 'CommunityController@insert_joinride')->name('community.insert-joinride');

Route::get('/community/joinride-index', 'CommunityController@joinride_index')->name('community.joinride-index');


//route to get report json for ride share user details
Route::get('/fetchjoinrideuser', function () 
{
	$id = Input::get('RideShareId');
	$joinride_details = DB::table('joinride')->where('RideShareId', '=', $id)->get();

    return Response::json($joinride_details);
});






//ROUTE FOR SENDING EMAILS
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


Route::get('sendMail','MailController@send');

Route::get('hope','WorkorderController@hope');

Route::get('kelvin','WorkorderController@b_email');




// SETTINGS ROUTE
Route::get('/settings', 'SettingController@index')->name('settings');

Route::get('/settings/index', 'SettingController@index')->name('settings.index');

Route::post('/settings/insert_mailConfig', 'SettingController@insert_mailConfig')->name('settings.insert_mailConfig');

Route::post('/settings/insert_sendmail', 'SettingController@insert_sendmail')->name('settings.insert_sendmail');

Route::post('/settings/update_stock/{Id}', 'SettingController@update_stock');


Route::post('/settings/update_flow_WorkOrder/{Id}', 'SettingController@update_flow_WorkOrder');

Route::post('/settings/update_flow_PendingApproval/{Id}', 'SettingController@update_flow_PendingApproval');

Route::post('/settings/update_flow_Declined/{Id}', 'SettingController@update_flow_Declined');

Route::post('/settings/upload_totaldistance', 'SettingController@upload_totaldistance')->name('settings.upload_totaldistance');




// FOR CSV UPLOADED

Route::resource('notebooks', 'NotebooksController');
Route::resource('notes', 'NotesController');

Route::get('notes/{notebookId}/createNote', 'NotesController@createNote')->name('notes.createNote');

Route::get('upload', 'BudgetController@showForm');
//Route::post('upload', 'BudgetController@store');

Route::post('upload', 'BudgetController@store_tot_dist');



