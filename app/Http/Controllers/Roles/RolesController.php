<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRoleModel;

class RolesController extends Controller
{
    //

static function roles($array){
$role=Auth::user()->role;
foreach($array as $x){
if($x==$role){
$status[]=true;
}else{
$status[]=[];
}
return count($status)==1?true:false;
}
}




















}
