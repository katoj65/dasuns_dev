<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentModel;
use App\Models\SettingsModel;


class PercentageService extends Controller
{
    //

public function calculate_dasuns_percentage($id){
$payment=new PaymentModel;
$get=$payment->where('appointmentID',$id)->limit(1)->get();
$amount=0;
if(count($get)==1){
foreach($get as $row);
//amount
$amount=$row->amount;
}
//settings percentage
$settings=new SettingsModel;
$percentage=$settings->find(1)->charge_percentage;
//
$x=$percentage*$amount;
$total=$x/100;
$actual_amount=$row->amount-$total;
return $actual_amount;
}
















}
