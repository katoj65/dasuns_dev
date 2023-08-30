<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsPaymentFeeModel;

class AppointmentModel extends Model
{
use HasFactory;
protected $table='appointment';



//get user appointments
public function scopeMy_appointments($query){
return $query->where('userID',Auth::user()->id)
->where('status','accepted')
->orwhere('status','pending')
->get();
}


//pssp appointments completed
public function scopeCount_pssp_tasks_completed($query,$id){
return $query->where('providerID',$id)->where('status','completed')->count();
}





//get created user
public function scopeGet_created_appointment($query,$request){
return $query->select('appointment.date','appointment.id','appointment.end_date','appointment.from','appointment.to','appointment.location','appointment.comment','users.firstname','users.lastname','users.tel','users.email','users.gender','users.dob')
->join('users','appointment.providerID','=','users.id')
->where('appointment.userID',Auth::user()->id)
->where('appointment.from',$request->start)
->where('appointment.location',$request->location)
->where('appointment.serviceID',$request->services)
->where('appointment.providerID',$request->psspID)
->limit(1)
->get();
}




//show my appointment
public function scopeShow($query,$id){

if(Auth::user()->role=='pssp'){
//
$get=$query->select('appointment.date','appointment.id','appointment.end_date','appointment.from','appointment.to','appointment.location','appointment.comment','users.firstname','users.lastname','users.tel','users.email','users.gender','users.dob','appointment.status','dasuns_user_number.number','support_service.name as service',
'appointment.created_at',
'users.id as providerID',
'support_service.id as serviceID')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userId')
->join('support_service','appointment.serviceID','=','support_service.id')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.id',$id)
->get();

}elseif(Auth::user()->role=='pssu'){
//
$get=$query->select('appointment.date','appointment.id','appointment.end_date','appointment.from','appointment.to','appointment.location','appointment.comment','users.firstname','users.lastname','users.tel','users.email','users.gender','users.dob','appointment.status','dasuns_user_number.number','support_service.name as service',
'appointment.created_at',
'users.id as providerID',
'support_service.id as serviceID')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userId')
->join('support_service','appointment.serviceID','=','support_service.id')
->where('appointment.userID',Auth::user()->id)
->where('appointment.id',$id)
->get();

}else if(Auth::user()->role=='admin' or Auth::user()->role=='reception'){
//
$get=$query->select('appointment.date','appointment.id','appointment.end_date','appointment.from','appointment.to','appointment.location','appointment.comment','users.firstname','users.lastname','users.tel','users.email','users.gender','users.dob','appointment.status','dasuns_user_number.number','support_service.name as service',
'appointment.created_at',
'users.id as providerID',
'support_service.id as serviceID')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userId')
->join('support_service','appointment.serviceID','=','support_service.id')
->where('appointment.id',$id)
->get();


}

return $get;
}




//count appointments
public function scopeCount_my_appointments($query){
return $query->where('userID',Auth::user()->id)
->where('status','accepted')
->count();
}


//number of days
public function scopeNumber_of_days($query,$id){
$get=$query->find($id);
$start=$get->date;
$end=$get->end_date;
if($end!=null){
$c=date_create($start);
$e=date_create($end);
$days=date_diff($c,$e);
$days=$days->days+1;
}else{
$days=1;
}
return $days;
}


//amount to be paid
public function scopeService_amount($query,$id){
$days=$this->number_of_days($id);
$fees=new DasunsPaymentFeesModel;
$fee=$fees->service_fee();
$amount=$days*$fee;
return $amount;
}


//get pssu accepted appointment
public function scopeMy_accepted_appointments($query){
return $query->select('*')
->select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'support_service.name',
'appointment.status',
'appointment.location',
'users.email',
'users.tel',
'appointment.id',
'payment.amount',
'users.firstname',
'users.lastname',
'dasuns_user_number.number')
->join('users','appointment.providerID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.ID')
->join('payment','appointment.id','=','payment.appointmentID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('appointment.userID',Auth::user()->id)
->where('appointment.status','accepted')
->get();
}





//get my appointment details
public function scopeMy_appointment_details($query,$request){
    return $query->select('appointment.date',
    'appointment.end_date',
    'appointment.from',
    'appointment.to',
    'support_service.name',
    'appointment.status',
    'appointment.location',
    'users.email',
    'users.tel',
    'appointment.id',
    'payment.amount',
    'users.firstname',
    'users.lastname',
    'dasuns_user_number.number')
    ->join('users','appointment.providerID','=','users.id')
    ->join('support_service','appointment.serviceID','=','support_service.ID')
    ->join('payment','appointment.id','=','payment.appointmentID')
    ->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
    ->where('appointment.userID',Auth::user()->id)
    ->where('appointment.id',$request->segment(2))
    ->get();
}



//my 5 appointments
public function scopeUpcoming_appointments($query){
return $query->where('userID',Auth::user()->id)
->orwhere('providerID',Auth::user()->id)
->where('status','accepted')
->where('date','>=',date('Y-m-d'))
->get();
}



//pssp appointment
public function scopePssp_appointment($query){
return $query->select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'support_service.name',
'appointment.status',
'appointment.location',
'users.email',
'users.tel',
'appointment.id',
'appointment.status',
'dasuns_user_number.number',
'payment.amount')
->join('appointment_service','appointment.id','=','appointment_service.appointmentID')
->join('support_service','appointment_service.serviceID','=','support_service.ID')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->join('payment','appointment.id','=','payment.appointmentID')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.status','accepted')
->orderby('appointment.date','DESC')
->get();
}


//pssp appointment requests count
public function scopePssp_requests_count($query){
return $query->where('providerID',Auth::user()->id)->where('status','paid')->count();
}

//pssp appointments count
public function scopePssp_appointments_count($query){
return $query->where('providerID',Auth::user()->id)->where('status','accepted')->count();
}


//get pssp requests
public function scopePssp_requests($query){
return $query->select('users.firstname','users.lastname',
'appointment.end_date',
'appointment.date',
'appointment.from',
'appointment.to',
'appointment.location',
'appointment.comment',
'appointment.status',
'appointment.id',
'support_service.name',
'users.role',
'dasuns_user_number.number',
'payment.amount',
'users.tel')
->join('users','appointment.userID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->join('payment','appointment.id','=','payment.appointmentID')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.status','paid')
->orderby('appointment.status','DESC')
->orderby('appointment.date','DESC')
->get();

}




//show pssp request
public function scopeShow_pssp_request($query,$id){
$data=[];
$get=$query->select('users.firstname','users.lastname',
'appointment.end_date',
'appointment.date',
'appointment.from',
'appointment.to',
'appointment.location',
'appointment.comment',
'appointment.status',
'appointment.id',
'support_service.name',
'users.role',
'dasuns_user_number.number',
'payment.amount',
'users.tel',
'users.email',
'users.dob',
'appointment.created_at',
'users.account_type')
->join('users','appointment.userID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->join('payment','appointment.id','=','payment.appointmentID')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.id',$id)
->orderby('appointment.status','DESC')
->orderby('appointment.date','DESC')
->get();
if(count($get)==1){
foreach($get as $row);
$data=$row;
}
return $data;
}




//all appointments
public function scopeAll_appointments($query){
return $query->select('*')
->select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'support_service.name',
'appointment.status',
'appointment.location',
'users.email',
'users.tel',
'appointment.id',
'users.firstname',
'users.lastname',
'dasuns_user_number.number')
->join('users','appointment.providerID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.ID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('appointment.userID',Auth::user()->id)
->orderby('appointment.created_at','DESC')
->get();

}







}





