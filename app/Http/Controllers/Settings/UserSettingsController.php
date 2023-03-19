<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserPasswordUpdateModel;

class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

$data['title']='User Settings';
$data['response']=[





];

return Inertia::render('SettingsPage',$data);

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


//change password
public function change_password(Request $request){
$request->validate(['password'=>['required'],'new_password'=>['required']],['required'=>'* Field is required.']);
$old_password= Hash::make($request->password);
$new_password=Hash::make($request->new_password);
$get=User::where('id',Auth::user()->id)->where('email',$request->email)->get();
if(count($get)==1){
foreach($get as $row);
if($old_password!=$row->password){
UserPasswordUpdateModel::where('email',$request->email)->update(['password',$new_password]);
return redirect('/settings')->with('success','Your password has been changed.');
}else{
return redirect('/settings')->with('warning','You cannot use the same password.');
}
}else{
return redirect('/settings')->with('warning','Your password input does not match the old password.');
}
}















}
