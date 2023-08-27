<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointmentModel;
use App\Models\User;

class DasunsWalletModel extends Model
{
use HasFactory;
protected $table='dasuns_wallet';

//my balance
public function scopeMy_balance($query){
$get=$query->where('userID',Auth::user()->id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return $row->amount;
}else{
return 0;
}
}






//amount to be paid
public function scopeService_payment($query,$id,$amount){
$balance=$this->my_balance();
$new_balance=$balance-$amount;
$app=AppointmentModel::find($id);
if($app->status=='pending'){
AppointmentModel::where('id',$id)
->where('userID',Auth::user()->id)
->update(['status'=>'paid']);
$query->where('userID',Auth::user()->id)
->update(['amount'=>$new_balance]);
return $app->status;
}return $app->status;
}



















}
