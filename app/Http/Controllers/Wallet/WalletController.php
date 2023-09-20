<?php

namespace App\Http\Controllers\Wallet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsWalletModel;
use Illuminate\Support\Facades\Hash;
use App\Models\DasunsUserNumberModel;
use App\Http\Controllers\Activity\ActivityController;
use App\Models\LogWalletModel;
use App\Models\DasunsPaymentFeesModel;
use App\Models\PaymentModel;
use App\Models\EscrowAccountModel;
use App\Http\Controllers\Role\RoleController;



class WalletController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(){
        //
$get=DasunsWalletModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
//get dasuns number
$dasuns=DasunsUserNumberModel::where('userID',Auth::user()->id)->get();
if(count($dasuns)==1){
foreach($dasuns as $row1);
}else{
return redirect('/');
}


$data['title']='Wallet';
$data['response']=[
'balance'=>$row->amount,
'currence'=>$row->currency,
'service_number'=>$row1->number,


];
return Inertia::render('WalletPage',$data);
}else{
return redirect('/');
}
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


/*****
 * New user wallet
 *
 */

static function new_user_wallet(){
if(Auth::user()!=null){
$get=DasunsWalletModel::where('userID',Auth::user()->id)->get();
if(count($get)==0){
DasunsWalletModel::insert(['userID'=>Auth::user()->id]);
}
}
}



// get user wallet
static function get_wallet_balance(){
$get=DasunsWalletModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}



//deposit funds to wallet
public function deposit_funds(Request $request){
$request->validate([
'type'=>['required'],
'tel'=>['required'],
'amount'=>['required']],['required'=>'* Field is required.']);

$id=Auth::user()->id;
$password=Hash::make($request->password);
$user_password=Auth::user()->password;
$get=DasunsWalletModel::where('userID',$id)->limit(1)->get();



if(count($get)==1){
foreach($get as $row);
$amount=$row->amount;
$total=$request->amount+$amount;
DasunsWalletModel::where('userID',$id)->update(['amount'=>$total]);
ActivityController::store_activity(['userID'=>Auth::user()->id,
'title'=>'Wallet Deposit','description'=>'Amount '.$request->amount.' has been deposited to your wallet']);
return redirect('/wallet')->with('success','Deposited has been created.');

}else{
    return redirect('/');
}

}








//transaction log
static function store_wallet_log($insert){
$get=DasunsWalletModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
$insert[]=['walletID'=>$row->id];
if(LogWalletModel::insert($insert)){
return true;
}else{
return false;
}
}else{
return null;
}
}





//dasuns service costs
static function dasuns_service_cost(){
$get=DasunsPaymentFeesModel::get();
$amount=0;
if(count($get)==1){
foreach($get as $row);
$amount=$row->amount;
}
return $amount;
}





//make payment for the service
static function make_service_payment($sid){
$balance=WalletController::get_wallet_balance()->amount;
$cost=WalletController:: dasuns_service_cost();
$mesage=true;
if($balance<=$cost){
$mesage=false;
}else{
//payment.
PaymentModel::insert(['userID'=>Auth::user()->id,
'appointmentID'=>$sid,
'amount'=>$cost,
'paid_to'=>'dasuns'
]);
//send to dusuns account.
WalletController::deposit_escrow_account($cost);
//update wallet balance.
$update=$balance-$cost;
DasunsWalletModel::where('userID',Auth::user()->id)->update(['amount'=>$update]);
}
return $mesage;
}




//transfer funds to dasuns account
static function deposit_escrow_account($amount){
$get=EscrowAccountModel::get();
if(count($get)==0){
EscrowAccountModel::insert(['amount'=>$amount]);
}else{
foreach($get as $row);
$update=$row->amount+$amount;
EscrowAccountModel::where('id','!=','')->update(['amount'=>$update]);
}
}




//depisit funs view

public function deposit_funds_view(Request $request){
$data['title']='Deposit funcds';
$data['response']=[];
return Inertia::render('WalletDepositPage',$data);
}


//withdraw funds view
public function withdraw_funds_view(Request $request){
$data['title']='Deposit funcds';
$data['response']=[];
return Inertia::render('WalletWithdrawPage',$data);
}





//wallet histroy
public function wallet_history(PaymentModel $payment){
if(Auth::user()->role=='pssp'){

$model=$payment->select('payment.amount',
'support_service.name',
'payment.created_at')
->where('payment.userID',Auth::user()->id)
->join('appointment','payment.userID','=','appointment.userID')
->join('support_service','appointment.serviceID','=','support_service.id')
->orderby('payment.created_at','DESC')
->get();

}else{

$model=$payment->select('payment.amount',
'support_service.name',
'payment.created_at')
->where('payment.userID',Auth::user()->id)
->join('appointment','payment.userID','=','appointment.userID')
->join('support_service','appointment.serviceID','=','support_service.id')
->orderby('payment.created_at','DESC')
->get();

}

$data['title']='Payment history';
$data['response']=['payments'=>$model];
return Inertia::render('WalletHistoryPage',$data);
}







//admin wallet method
public function admin_wallet(Request $request, PaymentModel $payment){
$permission=RoleController::permission(['admin','reception']);
if($permission!=null){

$data['title']='Admin Wallet';
$data['response']=[
'balance'=>number_format(DasunsWalletModel::select('amount')->sum('amount')),
'pssp'=>number_format(DasunsWalletModel::select('dasuns_wallet.amount')
->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','pssp')

->sum('dasuns_wallet.amount')),
'pssu'=>number_format(DasunsWalletModel::select('dasuns_wallet.amount')
->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','pssu')
->sum('dasuns_wallet.amount')),

'other'=>number_format(DasunsWalletModel::select('dasuns_wallet.amount')
->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','admin')
->orwhere('users.role','reception')
->orwhere('users.role','panelist')
->orwhere('users.role','secretary')
->sum('dasuns_wallet.amount')),

'payments'=>$payment->select('users.firstname',
'users.lastname',
'payment.amount',
'payment.paid_to',
'payment.created_at')
->join('users','payment.userID','=','users.id')
// ->join('appointment','payment.appointmentID','=','appointment.id')
->orderby('payment.created_at','DESC')
->get(),

];

return Inertia::render('AdminWallet',$data);

}else{

return redirect('/');

}
}























}
