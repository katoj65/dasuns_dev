<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationProfileModel extends Model
{
    use HasFactory;
    protected $table='organisation_profile';
    protected $fillable=['userID','institution_typeID','location','countryID','logo'];
}
