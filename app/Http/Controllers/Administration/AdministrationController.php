<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeProfileModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\ServiceProviderEmploymentHistoryModel;
use App\Models\ServiceProviderReferenceModel;
use App\Models\ServiceProviderEducationModel;

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
public function destroy(Request $request){
//
User::where('id',$request->segment(2))->delete();
return redirect('/admin/accounts')->with('success','Account has been deleted');

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





//profile

static function profile(){
return [
'about'=>'No content',

];
}





//change employee status
function change_employee_status(Request $request){
$request->validate(['status'=>['required']]);
EmployeeProfileModel::where('userID',12)->update(['tag'=>$request->status]);
return redirect('/employee/'.$request->id)->with('success','Status was changed.');
}






//admin accounts
public function accounts(Request $request){
if(Auth::user()->role=='admin'){
//formation
$row=[];
$get=User::select('users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.status',
'users.role',
'users.id')
->where('users.role','!=','pssp')->where('users.role','!=','pssu')->get();
if(count($get)>0){
foreach($get as $l){
$row[]=$l;
}
}

$data['title']='Admin accounts';
$data['response']=[
'users'=>$row
];
return Inertia::render('AdminAccountsPage',$data);
}else{
return redirect('/');
}
}









//show admins
public function show_admins(Request $request){
if(Auth::user()->role=='admin'){
$data['title']='Administrator';
$data['response']=[
'user'=>User::where('id',$request->segment(2))->get(),

];

return Inertia::render('AdminShowPage',$data);
}else{
return redirect('/');
}
}





//admin service providers
public function service_providers(Request $request){
if(Auth::user()->role=='admin'){
$data['title']='';
$data['response']=[
'users'=>User::select('users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.role',
'users.id',
'dasuns_user_number.number',
'users.status')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('users.role','pssp')
->orderby('users.status','DESC')
->get()
];

return Inertia::render('AdminServiceProvidersPage',$data);

}else{
return redirect('/');
}
}



//service providers
public function show_service_providers(Request $request){
if(Auth::user()->role=='admin'){
$data['title']='Administrator';
$data['response']=[
'user'=>User::select('users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.role',
'users.id',
'dasuns_user_number.number',
'users.status',
'users.dob',
'country.name',
'service_provider_profile.location',
'service_provider_profile.about')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->join('service_provider_profile','users.id','=','service_provider_profile.userID')
->join('country','service_provider_profile.countryID','=','country.id')
->where('users.id',$request->segment(2))
->get(),

//
'services'=>ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$request->segment(2))
->get(),

//
'documents'=>ServiceProviderSecurityDetailsModel::select('*')
->where('userID',$request->segment(2))
->get(),

//
'employment'=>ServiceProviderEmploymentHistoryModel::
where('userID',$request->segment(2))
->get(),

//
'reference'=>ServiceProviderReferenceModel::
where('userID',$request->segment(2))
->get(),

'education'=>ServiceProviderEducationModel::where('userID',$request->segment(2))->get(),



];

return Inertia::render('PSSPPage',$data);
}else{
return redirect('/');
}
}







public function destroy_pssp(Request $request){
User::where('id',$request->segment(2))->delete();
return redirect('/service/providers')->with('success','Account has been deleted');
}








}
