<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //
$data['title']='Administrators';
$data['response']=[];

return Inertia::render('AdminsPage',$data);



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

$request->validate([
'firstname'=>['required'],
'lastname'=>['required'],
'gender'=>['required'],
'dob'=>['required'],
'email'=>['required'],
'tel'=>['required'],
'role'=>['required'],
'password'=>['required']
//encrypted password.
//Hash::make($request->password)
],['required'=>'* Field is required.']);

UserModel::inser([
'firstname'=>$request->firstname,
'lastname'=>$request->lastname,
'gender'=>$request->gender,
'dob'=>$request->dob,
'email'=>$request->email,
'tel'=>$request->tel,
'role'=>$request->role,
'password'=>Hash::make($request->password)]);

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


//get user
function get_user_by_id($id){
$email=Auth::user()->email;
$get=User::where('id',$id)->where('email',$email)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return null;
}
}







//create admin
public function create_admins(Request $request){
$data['title']='Add new administrator';
// $data['response']=[
// 'admin'=>$request->segment(2)!=''?$this->get_admin($request->segment(2)):null,
// 'profile'=>$request->segment(2)!=''?'':null,
// ];

$data['response']=[

];
return Inertia::render('CreateAdmins',$data);

}






//search admin
public function search_email(Request $request){
$request->validate(['email'=>['required','email']],['required'=>'* Admin email address is required']);
$get=User::where('email',$request->email)->where('id','!=',Auth::user()->id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return redirect('/admin-create/'.$row->id);
}else{
return redirect('/admin-create');
}
}



//get admin information
function get_admin($id){
$get=User::where('id',$id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return null;
}
}






















}
