<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\System\SystemController;
use App\Http\Controllers\Partner\PartnerController;
use App\Models\UserProfileModel;
use App\Models\OrganisationProfileModel;
use App\Http\Controllers\Profile\ProfileController;
use App\Models\MenuModel;
use App\Http\Controllers\Menu\MenuController;
use App\Models\EmployeeModel;
use App\Models\DasunsUserNumberModel;


class HandleInertiaRequests extends Middleware
{
/**
 * The root template that's loaded on the first page visit.
 *
 * @see https://inertiajs.com/server-side-setup#root-template
 * @var string
 */
protected $rootView = 'app';

/**
 * Determines the current asset version.
 *
 * @see https://inertiajs.com/asset-versioning
 * @param  \Illuminate\Http\Request  $request
 * @return string|null
 */
public function version(Request $request)
{
return parent::version($request);
}



//get user profile
function get_user_profile(){
    if(Auth::user()!=''){
    $account=Auth::user()->account_type;
    if($account=='personal'){
    return UserProfileModel::where('userID',Auth::user()->id)->get();
    }else{
    return OrganisationProfileModel::where('userID',Auth::user()->id)->get();
    }
    }else{
    return null;
    }
    }

//switch profiles


function admin_profile_switch(){
if(Auth::user()!=''){
$role=Auth::user()->role;
if($role=='admin' or $role=='reception' or $role=='finance'){
$get=EmployeeModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}else{
    return null;
}
}else{
return null;
}
}


//get number

function show_user_number(){
if(Auth::user()!=''){
$role=Auth::user()->role;
if($role=='pssp' or $role=='pssu'){
$get=DasunsUserNumberModel::where('userID',Auth::user()->id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}else{
return [];
}
}else{
return null;
}
}





/**
 * Defines the props that are shared by default.
 *
 * @see https://inertiajs.com/shared-data
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function share(Request $request)
{
return array_merge(parent::share($request), [
//authenticated user information.

'auth'=> function() use($request){
$profile=new ProfileController;

return [
'user'=>$request->user() ? $request->user() : null,
'user_profile'=>Auth::user()!=''?
Auth::user()->role=='pssu'?
Auth::user()->account_type=='personal'?
$profile->get_personal_account_profile()
:$profile->user_profile()
:$profile->profile_PSSP()
:null,
'admin_profile'=>$this->admin_profile_switch(),
'user_number'=>$this->show_user_number(),


];
},

'system'=>function() use($request){
$menu=new MenuController;
$system=new SystemController;
$partner=new PartnerController;
return[
'name'=>'Dasuns',
'logo'=>'http://localhost/dasuns_dev/resources/images/logo/white-logo.png',
'logo2'=>'http://localhost/dasuns_dev/resources/images/logo/color-logo.png',
'slogan'=>'',
'details'=>$system->get_system_information(),
'partners'=>$partner->get_partners(),
'menu'=>Auth::user()!=''?$menu->menu_list():null,

];
},

'flash'=>[
'success'=>fn()=>$request->session()->get('success'),
'warning'=>fn()=>$request->session()->get('warning'),
'error'=>fn()=>$request->session()->get('error'),
'notice'=>fn()=>$request->session()->get('notice'),

]








]);
}
}
