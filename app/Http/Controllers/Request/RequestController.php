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
public function index(){
        //
$data['title']='Requests';
if(Auth::user()->role=='pssp'){
//
$pending=[];
$get=AppointmentModel::select('users.firstname','users.lastname',
'appointment.end_date',
'appointment.date',
'appointment.from',
'appointment.to',
'appointment.location',
'appointment.comment',
'appointment.status',
'appointment.id')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.status','pending')
->join('users','appointment.userID','=','users.id')
->orderby('appointment.status','DESC')
->orderby('appointment.date','DESC')
->get();

if(count($get)>0){
foreach($get as $r){
$sv=[];
$services=AppointmentServiceModel::where('appointment_service.appointmentID',$r->id)
->join('support_service','appointment_service.serviceID','=','support_service.id')
->limit(1)
->get();

//get services.
if(count($services)==1){
foreach($services as $i);
$sv=$i;
}

$pending[]=[
'firstname'=>$r->firstname,
'lastname'=>$r->lastname,
'date'=>$r->date,
'end_date'=>$r->end_date,
'location'=>$r->location,
'comment'=>$r->comment,
'status'=>$r->status,
'from'=>$r->from,
'to'=>$r->to,
'service'=>$sv,
'count_services'=>AppointmentServiceModel::where('appointmentID',$r->id)->count()
];

}
}



$data['response']=[
//pening appointments.
'pending'=>$pending,
//accepted appointments.
'accepted'=>AppointmentModel::where('providerID',Auth::user()->id)->where('status','accepted')->orderby('date','DESC')->limit(1)->get(),


];


}else{
$data['response']=[];
}

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
    public function show($id)
    {
        //
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
$request->validate(['service'=>['required'],'location'=>['required']],['required'=>'* Field is required.']);
// $location=ProfileController::get_user_profile_information();
$get=ServiceProviderProfileModel::select('*')
->join('users','service_provider_profile.userID','=','users.id')
->join('service_provider_services','users.id','=','service_provider_services.userID')
->where('service_provider_services.serviceID',$request->service)
->where('service_provider_profile.location','LIKE','%'.$request->location.'%')
->limit(20)
->get();
$format_url='request/service/'.$request->service.'/location/'.$request->location;
//format Url
return redirect($format_url);


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
