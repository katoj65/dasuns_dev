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
$account_model=new EscrowAccountModel;
$account=$account_model->find(1);
$dasuns_bal=$account->amount;
if($dasuns_bal>$percentage_amount){
//deduct funds from dasuns escrow account
$new_dasuns_bal=$dasuns_bal-$percentage_amount;
$account->amount=$new_dasuns_bal;
$account->save();
//provider wallet
$wallet_model=new DasunsWalletModel;
$wallet=$wallet_model->where('userID',$providerID)
->first();
$wallet_balance=$wallet->amount+$percentage_amount;
$wallet->amount=$wallet_balance;
$wallet->save();
//update payment table
$payment_model=new PaymentModel;
$payment_model->amount=$percentage_amount;
$payment_model->userID=$providerID;
$payment_model->appointmentID=$id;
$payment_model->paid_to='pssp';
$payment_model->status='success';
$payment_model->service_status='completed';
$payment_model->save();
//update appointment
$appointment_model=new AppointmentModel;
$appointment=$appointment_model->find($id);
$appointment->status='completed';
$appointment->save();

}else{
return null;
}
}














}
