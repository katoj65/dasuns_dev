<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsWalletModel;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
$data['title']='Wallet';
$data['response']=[];
return Inertia::render('WalletPage',$data);

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












}
