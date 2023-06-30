<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
    public function update(Request $request)
    {
        //
$request->validate([
'firstname'=>['required'],
'lastname'=>['required'],
'gender'=>['required'],
'dob'=>['required'],
'tel'=>['required']],
['required'=>'* Field is required']);

User::where('id',Auth::user()->id)
->update(['firstname'=>$request->firstname,
'lastname'=>$request->lastname,
'gender'=>$request->gender,
'dob'=>$request->dob,
'tel'=>$request->tel]);




return redirect('/profile')->with('success','Some information');



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

//view admins

public function show_admins(){
$data['title']='Admins';
$data['response']=[];
return Inertia::render('AdminsPage',$data);
}



//get users by ID
static function userbyID($id){
$get=User::where('id',$id)->limit(1)->get();
$row=null;
if(count($get)==1){
foreach($get as $row);
}
return $row;
}






//email verification
public function email_verification(){
$email=Auth::user()->email;
$count=User::where('email',$email)->where('email_verified_at','')->count();
if($count==0){
User::where('email',$email)->update(['email_verified_at',date('Y-m-d H:i:s')]);
return true;
}else{
return null;
}
}



//send email
//$options=['sender'=>'',receiver=>'',title=>'',message=>'];
static function send_email($to,$subject,$txt,$headers){
if(mail($to,$subject,$txt,$headers)){
$status=true;
}else{
$status=false;
}
return $status;
}







//forgot password
public function forgot_password(Request $request){
$request->validate(['email'=>'required']);
//send code
$code=Date('is');
$send=UserController::send_email(
$request->email,
'Dasuns Password Reset Code',
'You password reset code is '.$code,
['From'=>'dasuns-no-reply@dasuns.org']);
if($send==true){

return redirect('/email/verification')->with('success','Password reset code has been sent to your email');

}else{
return redirect('/forgot-password')->with('error','Invalid email address');
}

}

//password reset account

public function password_reset(Request $request){
$data['title']='Password reset';
$data['response']=[];
return Inertia::render('ResetPasswordPage',$data);
}


//create new password
public function create_new_password(Request $request){
$request->validate(['code'=>'request','password'=>'request','retype_password'=>'required']);
return $request;
}





}
