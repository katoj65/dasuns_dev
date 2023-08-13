<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PSSPRatingModel extends Model
{
    use HasFactory;
    protected $table='pssp_rating';





public function scopeSum_rating($query,$id){
return $query->where('userID',$id)->sum('rating');
}




}
