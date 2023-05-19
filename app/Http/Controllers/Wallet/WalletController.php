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


class WalletController extends Controller
{
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

// if(count($get)==1){
// foreach($get as $row);
// $amount=$row->amount;
// $total=$request->amount+$amount;
// DasunsWalletModel::where('userID',$id)->update(['amount'=>$total]);
// return redirect('/wallet')->with('success','Deposited has been created');
// }else{
// return redirect('/');
// }


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








}
