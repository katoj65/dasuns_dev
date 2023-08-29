<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderServicesModel extends Model
{
    use HasFactory;
    protected $table='service_provider_services';



//count pssp services.
public function scopeCount_pssp_services($query,$id){
return $query->where('userID',$id)->count();
}


//list pssp services.
public function scopeList_pssp_services($query,$id){
return $query->select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$id)
->get();
}



}
