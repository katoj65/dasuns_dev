<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelistProfessionProfileModel extends Model
{
    use HasFactory;
    protected $table='panelist_profession_profile';
    protected $fillable=['userID','professionID','description','number_years'];
}
