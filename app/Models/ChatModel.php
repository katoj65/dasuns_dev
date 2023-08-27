<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChatModel extends Model
{
use HasFactory;
protected $table='chat';


//get user chat
public function scopeUser_messages($query,$id){
return $query->where('senderID',$id)
->orwhere('receiverID',$id)
->orwhere('senderID',Auth::user()->id)
->orwhere('receiverID',Auth::user()->id)
->get();
}


//message sender
public function scopeSender($query,$id){
    $user=new User;
    return $user->find($id);
    }






}
