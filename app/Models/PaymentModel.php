<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table='payment';


//show amount paid for the service
public function scopeCost_of_service($query,$id){
$amount=0;
$get=$query->select('amount')->where('appointmentID',$id)->get();
if(count($get)==1){
foreach($get as $row);
$amount=$row->amount;
}
return $amount;
}


}
