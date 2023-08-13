<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DasunsWalletModel extends Model
{
    use HasFactory;
    protected $table='dasuns_wallet';


public function scopeMy_balance($query){
return $query->find(Auth::user()->id)->amount;
}











}
