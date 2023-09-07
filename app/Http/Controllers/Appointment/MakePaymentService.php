<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EscrowAccountModel;
use App\Models\PaymentModel;
use App\Models\AppointmentModel;
use App\Models\DasunsWalletModel;

class MakePaymentService extends Controller
{
    //
public function pay_service_provider($id,$providerID,$percentage_amount){
$account=new EscrowAccountModel;
$funds=$account->find(1)->amount;
if($funds>$percentage_amount){
//deduct funds from dasuns escrow account

$new_funds=$funds-$percentage_amount;
$account->where('id',1)->update(['amount'=>$new_funds]);

//credit provider account
$wallet=new DasunsWalletModel;
$get_wallet=$wallet->where('userID',$providerID)->limit(1)->get();
foreach($get_wallet as $w);
$wallet_balance=$w->amount;

//new balance
$new_bal=$wallet_balance+$percentage_amount;
$wallet->where('id',$w->id)->where('userID',$providerID)
->update(['amount'=>$new_bal]);

//recording payment to payment table
$payment=new PaymentModel;
$payment->insert(['userID'=>$providerID,
'amount'=>$new_bal,
'paid_to'=>'pssp',
'service_status'=>'completed']);

//


}else{
return null;
}
}














}
