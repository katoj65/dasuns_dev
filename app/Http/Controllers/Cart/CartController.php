<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DasunsCartModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceProviderServicesModel;
use App\Http\Controllers\Wallet\WalletController;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request){
        //

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show(Request $request)
{
//
$get=DasunsCartModel::select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'dasuns_cart.id',
'dasuns_cart.amount',
'dasuns_cart.currency',
'users.firstname',
'users.lastname',
'users.tel',
'users.email',
'dasuns_cart.days',
'appointment.id as appointmentID',
'dasuns_user_number.number',
'users.id as userID',
'appointment.status')

->join('appointment','dasuns_cart.itemID','=','appointment.id')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('dasuns_cart.id',$request->segment(2))
->where('dasuns_cart.userID',Auth::user()->id)
->get();
if(count($get)==1){
foreach($get as $row);

//get services
$services=ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('userID',$row->userID)->get();



//other
$other=DasunsCartModel::select('dasuns_cart.id','appointment.date','dasuns_user_number.number','dasuns_cart.status')
->join('appointment','dasuns_cart.itemID','=','appointment.id')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('dasuns_cart.userID',Auth::user()->id)
->orderby('dasuns_cart.created_at','DESC')
->limit(8)->get();

//



$item=[
'id'=>$row->id,
'amount'=>number_format($row->amount),
'currency'=>$row->currency,
'appointmentID'=>$row->appointmentID,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'date'=>$row->date,
'end_date'=>$row->end_date,
'from'=>$row->from,
'to'=>$row->to,
'days'=>$row->days,
'tel'=>$row->tel,
'email'=>$row->email,
'number'=>$row->number,
'services'=>$services,
'status'=>$row->status,
'payment'=>[
'balance'=>WalletController::get_wallet_balance()->amount,
'balance_amount'=>number_format(WalletController::get_wallet_balance()->amount),
'deadline'=>$this->payment_deadline($row->date),
'status'=>$this->transactable($row),
]


];

//get


$data['title']='Cart details';
$data['response']=[
'appointment'=>$item,
'other'=>$other,



];
return Inertia::render('ShowCartPage',$data);
}else{
    return redirect('/')->with('warning','Could not find item.');
}
}





//transactable balance
private function transactable($row){
$bal=WalletController::get_wallet_balance()->amount;
$pay_amount=$row->amount;
if($bal>=$pay_amount){
$status=true;
}else{
$status=false;
}
return $status;
}







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



//payment deadline
private function payment_deadline($start_date){
$deadline=null;
$day=date('d');
$month=date('m');
$year=date('Y');
$dates=explode('-',$start_date);
$dates=array_reverse($dates);
$ad=$dates[0];
$am=$dates[1];
$ay=$dates[2];
// month formation
$last_month_prev_day=cal_days_in_month(CAL_GREGORIAN,$am-1,$ay);
//date difference between the appoointment date and the current date.
$appoint_date=date_create($start_date);
$current_date=date_create(date('Y-m-d'));
$diff=date_diff($appoint_date,$current_date)->days;
return $diff;
}




// make payment
public function make_payment(Request $request){
$get=DasunsCartModel::select('dasuns_cart.id',
'dasuns_cart.amount',
'appointment.providerID',
'dasuns_cart.currency',
'appointment.id as appointmentID')
->join('appointment','dasuns_cart.itemID','=','appointment.id')
->where('dasuns_cart.id',$request->id)
->get();

//

if(count($get)==1){
foreach($get as $row);




}else{


}

return $get;

}
















}
