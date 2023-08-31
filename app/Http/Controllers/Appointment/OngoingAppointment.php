<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use Illuminate\Support\Facades\Auth;

class OngoingAppointment extends Controller
{

public function appointment_clock($appointment){
$date=date('Ymd');
$time=date('Hi');
//apppointment formation
$adate=date_create($appointment->date);
$afrom=date_create($appointment->from);
$ato=date_create($appointment->to);
//
$ad=date_format($adate,'Ymd');
$af=date_format($afrom,'Hi');
$at=date_format($ato,'Hi');
//
$details=[];
//if
if($appointment->end_date==null){
if($date==$ad){
$details=['message'=>'You have an appointment',
'start_time'=>substr($appointment->from,0,5),
'end_time'=>substr($appointment->to,0,5),
'start_date'=>$appointment->date,
'end_date'=>null];
}
}else{

//
$edate=date_create($appointment->end_date);
$ed=date_format($edate,'Ymd');
//
$details=[
'message'=>'You have an appointment',
'start_time'=>substr($appointment->from,0,5),
'end_time'=>substr($appointment->to,0,5),
'start_date'=>$appointment->date,
'end_date'=>$appointment->end_date
];
}

return $details;

}



//appointment pssp
public function pssp_has_ongoing_appointment($id){
$date=date('Ymd');
$time=date('Hi');




}
















}
