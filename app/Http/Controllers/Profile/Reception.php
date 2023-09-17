<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CountryModel;


class Reception extends Controller
{
    //
    public function profile(){
        $user=new User;
        $show=[];
        $get=$user->select(
        'users.id',
        'users.firstname',
        'users.lastname',
        'users.gender',
        'users.dob',
        'users.tel',
        'users.email',
        'users.created_at',
        'users.status',
        'users.role',
        'employee_profile.location',
        'country.name as country',
        'country.id as countryID')

        ->where('users.id',Auth::user()->id)
        ->join('employee_profile','users.id','=','employee_profile.userID')
        ->join('country','employee_profile.countryID','=','country.id')
        ->get();
        if(count($get)==1){
        foreach($get as $row);
        $show=$row;
        }


        return [
        'user'=>$show,
        'role'=>Auth::user()->role,
        'auth'=>Auth::user(),
        'country'=>CountryModel::all(),
        ];
        }
}
