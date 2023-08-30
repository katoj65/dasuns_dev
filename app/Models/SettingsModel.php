<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    use HasFactory;
    protected $table='settings';


//get service_amount
public function scopeGet_service_amount($query){
return $query->find(1)->service_amount;
}

//get percentage_charge
public function scopeGet_charged_percentage($query){
return $query->find(1)->charge_percentage;
}

}
