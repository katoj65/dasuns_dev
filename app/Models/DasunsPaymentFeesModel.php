<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DasunsPaymentFeesModel extends Model
{
    use HasFactory;
    protected $table='dasuns_payment_fees';





public function scopeService_fee($query){
return $query->find(1)->amount;
}





}
