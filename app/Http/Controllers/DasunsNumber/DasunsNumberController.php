<?php

namespace App\Http\Controllers\DasunsNumber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DasunsUserNumberModel;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsNumberModel;
use App\Models\User;

class DasunsNumberController extends Controller
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








//get dasuns user number
static function get_dasuns_number_byID($id){
$get=DasunsUserNumberModel::where('id',$id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}


//get dasuns number by user ID
static function get_dasuns_number_byUserID($id){
$get=DasunsUserNumberModel::where('userID',$id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
    return[];
}
}



//create dasuns number
static function create_dasuns_user_number(){

if(Auth::user()!=null){

$id=Auth::user()->id;
$role=Auth::user()->role;
$get=count(User::where('role',Auth::user()->role)->get());
$dasuns=DasunsNumberModel::get();
if(count($dasuns)==1){
foreach($dasuns as $row);
$sum=$get+1;
$num=Auth::user()->role=='pssp'?$row->service_provider_number:$row->service_user_number;
$count_num=strlen($num);
$count_sum=strlen($sum);
$substr=$count_num-$count_sum;
$get_first_number=substr($num,0,$substr);
$actual_num=$get_first_number.strval($sum);
//add role code
$initial=$role=='pssp'?$actual_num.'P':$actual_num.'U';

return $initial;

}else{
return null;
}
}else{
    return null;
}
}


























}
