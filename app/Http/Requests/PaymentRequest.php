<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PaymentModel;
use App\Models\DasunsWalletModel;
use App\Models\DasunsPaymentFeesModel;
use Illuminate\Support\Facades\Auth;
use App\Models\EscrowAccountModel;


class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }



//make payments

public function pssu_pay_for_service($request,$appointment){
$wallet=new DasunsWalletModel;
$balance=$wallet->my_balance();
$fees=new DasunsPaymentFeesModel;
$fee=$fees->service_fee();
$amount=$appointment->service_amount($request->id);
$days=$appointment->number_of_days($request->id);
if($amount<$balance){
$payment_status=$wallet->service_payment($request->id,$amount);

//create payment
PaymentModel::insert(['appointmentID'=>$request->id,
'amount'=>$amount,
'paid_to'=>'dasuns',
'status'=>'pending',
'userID'=>Auth::user()->id]);

//get the dasuns escrow account amount
$dasuns_account=EscrowAccountModel::find(1);
if($dasuns_account==null){
EscrowAccountModel::insert(['amount'=>$amount]);
}else{
$dasuns_amount=$dasuns_account->amount;
$debit_dasuns=$dasuns_amount+$amount;

//debit Dasuns escrow account
EscrowAccountModel::where('id',1)
->update(['amount'=>$debit_dasuns]);
}


return true;
}else{
return false;
}

}















}
