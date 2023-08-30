<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\AppointmentModel;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointmentServiceModel;
use App\Models\ServiceProviderProfileModel;
use App\Http\Controllers\Profile\ProfileController;
use App\Models\SupportServiceModel;

class RequestController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index(AppointmentModel $appointment){
$data['title']='Requests';
$data['response']=[
'requests'=>$appointment->pssp_requests(),

];
return Inertia::render('RequestPage',$data);

}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
//
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show(Request $request,AppointmentModel $appointment)
{
//

$data['title']='Request';
$data['response']=[
'request'=>$appointment->show_pssp_request($request->segment(2)),


];



return Inertia::render('RequestShowPage',$data);

}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
//
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
//
}




//request services
public function request_service(Request $request){
$request->validate(['service'=>['required'],'location'=>['required']],
['required'=>'* Field is required.']);
// $location=ProfileController::get_user_profile_information();
// $get=ServiceProviderProfileModel::select('*')
// ->join('users','service_provider_profile.userID','=','users.id')
// ->join('service_provider_services','users.id','=','service_provider_services.userID')
// ->where('service_provider_services.serviceID',$request->service)
// ->where('service_provider_profile.location','LIKE','%'.$request->location.'%')
// ->limit(20)
// ->get();
$format_url='request/service/'.$request->service.'/location/'.$request->location;
//format Url
return redirect('/search/'.$request->service.'/'.$request->location);


}







//return searched information
public function request_service_provider(Request $request){
$service=$request->segment(3);
$location=$request->segment(5);
//get information
$get=ServiceProviderProfileModel::select('users.firstname','users.lastname','dasuns_user_number.number','users.id','users.gender')
->join('users','service_provider_profile.userID','=','users.id')
->join('service_provider_services','users.id','=','service_provider_services.userID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('service_provider_services.serviceID',$service)
->where('service_provider_profile.location','LIKE','%'.$location.'%')
->limit(20)
->get();

//service requested
$svs=SupportServiceModel::where('id',$service)->get();
$item=null;
if(count($svs)==1){
foreach($svs as $r);
$item=$r->name;
}


$data['title']='service provider requests';
$data['response']=[
'pssp'=>$get,
'service_requested'=>$item,
'location'=>$location,

];
return Inertia::render('RequestServicePage',$data);

}
















}
