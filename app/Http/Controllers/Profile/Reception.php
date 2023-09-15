<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Reception extends Controller
{
    //
    public function profile(User $user){
        return [
        'user'=>$user->where('id',Auth::user()->id)->get(),
        'role'=>Auth::user()->role,
        ];
        }
}
