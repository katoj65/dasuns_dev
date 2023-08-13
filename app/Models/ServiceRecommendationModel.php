<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRecommendationModel extends Model
{
    use HasFactory;
    protected $table='service_recommendation';



public function scopeCount_recommendations($query,$id){
return $query->where('userID',$id)->count();
}


}
