<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DasunsRecommendationsModel extends Model
{
    use HasFactory;
    protected $table='dasuns_recommendation';


public function scopeCount_recommendations($query,$id){
return $query->where('recommendID',$id)->count();
}


}
