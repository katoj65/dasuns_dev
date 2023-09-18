<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PSSPInterviewScheduleModel extends Model
{
    use HasFactory;
    protected $table='pssp_interview_schedule';
    protected $fillable=['date','time','service_providerID','type','comment'];
}
