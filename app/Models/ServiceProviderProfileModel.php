<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderProfileModel extends Model
{
use HasFactory;
protected $table='service_provider_profile';

//get profile
public function scopeShow($query,$id){
return $query->select('country.name as country',
'service_provider_profile.location',
'service_provider_profile.about')
->join('country','service_provider_profile.countryID','=','country.id')
->where('service_provider_profile.userID',$id)
->get();
}







}
