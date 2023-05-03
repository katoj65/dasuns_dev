<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\AppointmentModel;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointmentServiceModel;

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
}
