<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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




//show appointment
public function scopeShow($query,$id){
return $query->select('appointment.date','appointment.id','appointment.end_date','appointment.from','appointment.to','appointment.location','appointment.comment','users.firstname','users.lastname','users.tel','users.email','users.gender','users.dob','appointment.status','dasuns_user_number.number','support_service.name as service',
'appointment.created_at',
'users.id as providerID',
'support_service.id as serviceID')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userId')
->join('support_service','appointment.serviceID','=','support_service.id')
->where('appointment.userID',Auth::user()->id)
->where('appointment.id',$id)
->get();
}



//count appointments
public function scopeCount_my_appointments($query){
return $query->where('userID',Auth::user()->id)
->where('status','accepted')
->count();
}





}





