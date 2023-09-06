<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'dob',
        'tel',
        'role',
        'email',
        'password',
        'account_type',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */



//get active service providers
public function scopeActive_pssp($query){
return $query->where('role','pssp')->where('status','active')->get();
}

//get users
public function scopePssu($query){
return $query->where('role','pssu')->get();
}
//admins
public function scopeAdmin($query){
return $query->where('role','admin')->get();
}

//interviewer
public function scopeInterviewr($query){
return $query->where('role','interviewer')->get();
}


//active pssu
public function scopeActive_pssu($query){
return $query->where('role','pssu')->where('status','active')->get();
}


//get user
public function scopeShow($query,$id){
return $query->find($id);
}


//security documents
public function scopeSecurity_documents($query,$id){
return $query->select('service_provider_security_details.document','service_provider_security_details.document_number')->join('service_provider_security_details','users.id','=','service_provider_security_details.userID')->where('users.id',$id)->get();
}



//education history
public function scopeEducation_history($query,$id){
return $query->select('service_provider_education.institution','service_provider_education.from','service_provider_education.to','service_provider_education.qualification','service_provider_education.document')->join('service_provider_education','users.id','=','service_provider_education.userID')->where('users.id',$id)->get();
}

//profession experience
public function scopeProfessionExperience($query,$id){
return $query->select('service_provider_experience.organisation_name',
'service_provider_experience.position',
'service_provider_experience.from_date',
'service_provider_experience.to_date')
->join('users','service_provider_experience.userID','=','users.id')
->get();
}



//get pssp services
public function scopePssp_services($query,$id){
return $query->select('service_provider_services.userID','support_service.name','support_service.id')
->join('service_provider_services','users.id','=','service_provider_services.userID')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$id)
->get();
}



//dasuns number
public function scopeShow_dasuns_number($query,$id){
$row=null;
$get=$query->select('dasuns_user_number.number')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('userID',$id)
->limit(1)
->get();
if(count($get)==1){
foreach($get as $row);
}
return $row;
}













}
