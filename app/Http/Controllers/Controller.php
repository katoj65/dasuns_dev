<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


//has permission
public function has_permission($array){
$collect=$array;
if(in_array(Auth::user()->role,$collect)){
return true;
}else{
return false;
}
}








}
