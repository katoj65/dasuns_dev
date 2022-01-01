<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsPaymentFeeModel;
use App\Models\User;

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
if(Auth::user()->role=='pssu'){
$condition="appointment.userID";
}elseif(Auth::user()->role=='pssp'){
$condition="appointment.providerID";
}

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
'dasuns_user_number.number',
'appointment.status')
->join('users','appointment.providerID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.ID')
->join('payment','appointment.id','=','payment.appointmentID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('appointment.id',$request->segment(2))
->where($condition,Auth::user()->id)
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
->join('support_service','appointment.serviceID','=','support_service.ID')
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
'dasuns_user_number.number',
'users.id as userID',
'appointment.providerID as providerID')
->join('users','appointment.providerID','=','users.id')
->join('support_service','appointment.serviceID','=','support_service.ID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('appointment.userID',Auth::user()->id)
->orwhere('appointment.providerID',Auth::user()->id)
->orderby('appointment.created_at','DESC')
->get();

}






//all appointments
public function scopeAll_pssp_appointments($query){
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
    'dasuns_user_number.number',
    'users.id as userID',
    'appointment.providerID as providerID')
    ->join('users','appointment.providerID','=','users.id')
    ->join('support_service','appointment.serviceID','=','support_service.ID')
    ->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
    ->where('appointment.providerID',Auth::user()->id)
    ->where('appointment.status','=','paid')
    ->orwhere('appointment.status','=','cancelled')
    ->orwhere('appointment.status','=','completed')
    ->orderby('appointment.created_at','DESC')
    ->get();

    }



//accepted appointments only
public function scopeAccepted_appointments($query){
return $query->select(
'users.firstname',
'users.lastname',
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
->where('appointment.status','accepted')
->where('appointment.providerID',Auth::user()->id)
->orwhere('appointment.userID',Auth::user()->id)
->orderby('appointment.status','DESC')
->orderby('appointment.date','DESC')
->get();



}




//todays appointments
public function scopePssp_schedule_count($query,$id){
$data=[];
$date=date('Ymd');
$time=date('Hi');
$get=$query->select('date','to','from','end_date')
->where('providerID',$id)
->where('status','accepted')
->get();

if(count($get)>0){
//
foreach($get as $row){
$dd=date_create($row->date);
$dd=date_format($dd,'Ymd');
$from=date_create($row->from);
$from=date_format($from,'Hi');
$to=date_create($row->to);
$to=date_format($to,'Hi');
$cur_time=date('Hi');



if($row->end_date==null){
if($dd==$date){

//curtime formation
if($cur_time>=$from and $cur_time<$to){
$status='ongoing';
}else{
$status='ended';
}



//responnse
$data[]=['date'=>$row->date,
'end_date'=>$row->end_date,
'to'=>$row->to,
'from'=>$from,
'status'=>$status];
}


}else{

$de=date_create($row->end_date);
$de=date_format($de,'Ymd');
if($de>=$date and $dd<=$date){


//curtime formation
if($cur_time>=$from and $cur_time<$to){
$status='ongoing';
}else{
$status='ended';
}


//response
$data[]=['date'=>$row->date,
'end_date'=>$row->end_date,
'to'=>$row->to,
'from'=>$from,
'status'=>$status];
}


}
}
}
$data;
}

















//User has an appointment
public function scopeUser_has_appoitment($query){
$data='';
$date=date('Ymd');
$time=date('Hi');
$user=new User;

//user is ordinary user
if(Auth::user()->role=='pssu'){
$where='userID';
//user is service provider
}elseif(Auth::user()->role=='pssp'){
$where='providerID';
}else{
$where='userID';
}



//
$get=$query->select('id','date','to','from','end_date','user_confirm','provider_confirm','userID','providerID')
->where($where,Auth::user()->id)
->where('status','accepted')
->orderby('date','ASC')
->get();


if(count($get)>0){
foreach($get as $row){
//dates
$dd=date_create($row->date);
$dd=date_format($dd,'Ymd');
$ed=date_create($row->end_date);
$ed=date_format($ed,'Ymd');

//from time to tome.
$from=date_create($row->from);
$to=date_create($row->to);
//
$from=date_format($from,'Hi');
$to=date_format($to,'Hi');
//provider and user details
$user_names=$user->find($row->userID);
$provider_names=$user->find($row->providerID);
//
$user_names=$user_names->firstname;
$provider_names=$provider_names->firstname;



if($row->end_date==null){
if($dd==$date){
//check if end date is today and time

$data=[
'start_date'=>$row->date,
'end_date'=>null,
'start_time'=>$row->from,
'end_time'=>$row->to,
'title'=>'You have an appointment',
'role'=>Auth::user()->role,
'time'=>date('Hi'),
'date'=>date('Ymi'),
'id'=>$row->id,
'user_confirm'=>$row->user_confirm,
'provider_confirm'=>$row->provider_confirm,
'status'=>date('Hi')>$to?'past':'ongoing',
'role'=>Auth::user()->role,
'role_onfirmation'=>Auth::user()->role=='pssu'?$row->user_confirm:$row->provider_confirm,
'provider_names'=>$provider_names,
'user_names'=>$user_names,
'other_party_status'=>null,
'button'=>true,


];
}

}else{

$de=date_create($row->end_date);
$de=date_format($de,'Ymd');
if($de>=$date and $dd<=$date){



$data=[
'start_date'=>$row->date,
'end_date'=>$row->end_date,
'start_time'=>$row->from,
'end_time'=>$row->to,
'title'=>'You have an appointment',
'role'=>Auth::user()->role,
'time'=>date('Hi'),
'date'=>date('Ymd'),
'id'=>$row->id,
'user_confirm'=>$row->user_confirm,
'provider_confirm'=>$row->provider_confirm,
'status'=>date('Hi')>$to?'past':'ongoing',
'role'=>Auth::user()->role,
'role_confirm'=>Auth::user()->role=='pssu'?$row->user_confirm:$row->provider_confirm,
'provider_names'=>$provider_names,
'user_names'=>$user_names,
'other_party_confirmation'=>Auth::user()->role=='pssu'?$row->provider_confirm:$row->user_confirm,

'other_party_names'=>Auth::user()->role=='pssu'?$provider_names:$user_names,
'button'=>date('Ymd')==$ed?true:false



];

}


}



}
}
return $data;
}














}





