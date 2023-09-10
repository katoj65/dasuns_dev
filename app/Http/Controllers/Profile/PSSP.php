<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CountryModel;

class PSSP extends Controller
{
    //

public function profile(){
$user=new User;
return[
'user'=>$user->profile_pssp(),
'dasuns_number'=>$user->show_dasuns_number(Auth::user()->id)->number,
'type'=>Auth::user()->account_type,
'role'=>Auth::user()->role,
'country'=>CountryModel::all(),
'services'=>$user->pssp_services(Auth::user()->id),
'documents'=>$user->security_documents(auth::user()->id),
'education'=>$user->education_history(Auth::user()->id),
'experience'=>$user->professionExperience(Auth::user()->id),
'is_active'=>Auth::user()->status=='active'?true:false,






];

}






}
