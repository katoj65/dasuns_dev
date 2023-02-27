<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //

function time_format($time){
return date_format($time,'H:I');
}


function date_format($date){
return date_format($date,'d-M-Y');
}


function date_time_format($date){
return date_format($date,'d-M-Y H:I');
}













}
