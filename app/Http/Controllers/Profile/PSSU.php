<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Wallet\WalletController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Models\CountryModel;
use App\Models\InstitutionTypeModel;


class PSSU extends Controller
{

//
public function profile(){
$user=new User;
return[
'user'=>$user->user_details(),
'dasuns_number'=>$user->show_dasuns_number(Auth::user()->id)->number,
'type'=>Auth::user()->account_type,
'role'=>Auth::user()->role,
'country'=>CountryModel::all(),
'institution'=>InstitutionTypeModel::all(),

];

}








}
