<?php

namespace App\Http\Controllers\PSSU;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Models\User;
use App\Models\UserSupportServiceModel;
use App\Models\UserDisabilityModel;
use App\Models\DasunsUserNumberModel;
use App\Models\OrganisationContactPersonModel;
use App\Models\UserProfileModel;
use App\Models\CountryModel;
use App\Models\AppointmentModel;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\ActivityLogModel;
use App\Models\DasunsRecommendationsModel;
use App\Models\DisabilityModel;





class PSSUController extends Controller
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
$data['title']='profile';
$data['response']=[
'profile'=>null

];


return Inertia::render('ProfilePSSP',$data);

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












//dashboard
static function dashboard(){
$id=Auth::user()->id;
$appointment=AppointmentModel::select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'support_service.name',
'appointment.status',
'appointment.location',
'appointment.comment',
'users.firstname',
'users.lastname',
'users.email',
'users.tel',
'appointment.id')
->join('appointment_service','appointment.id','=','appointment_service.appointmentID')
->join('support_service','appointment_service.serviceID','=','support_service.ID')
->join('users','appointment.providerID','=','users.id')
->where('appointment.userID',Auth::user()->id)
->orderby('appointment.status','ASC')
->orderby('appointment.date','DESC')
->orderby('appointment.from','ASC')
->get();

//models
$appoint=new AppointmentModel;

return[
'role'=>Auth::user()->role,
'dasuns_number'=>DasunsNumberController::get_dasuns_number_byUserID($id),
'service_provider_count'=>User::where('status','active')->where('role','pssp')->count(),
'count_recommendations'=>DasunsRecommendationsModel::count(),
'count_appointments'=>$appoint->count_my_appointments(),
'account_balance'=>WalletController::get_wallet_balance()->amount,
'appointments'=>$appoint->all_appointments(),
'activity'=>ActivityLogModel::where('userID',Auth::user()->id)->orderby('created_at','DESC')->limit(5)->get(),
'pssp'=>AppointmentModel::select('users.firstname','users.lastname','users.id','users.email')
->join('users','appointment.providerID','=','users.id')
->where('appointment.userID',Auth::user()->id)
->distinct()
->limit(4)
->get(),
'recommendations'=>DasunsRecommendationsModel::get(),
'tasks'=>$appoint->my_accepted_appointments(),


];


}


//service subscription
static function pssu_service_subscription($serviceID,$userID){
return UserSuppoortServiceModel::where('userID',$userID)->where('serviceID',$serviceID)->count()>0?true:false;
}






//profile
static function profile(){
$id=Auth::user()->id;
//account details
$user_profile=UserProfileModel::select('country.name','user_profile.location','user_profile.disability','country.id as countryID')
->join('country','user_profile.countryID','=','country.id')
->where('user_profile.userID',$id)
->get();
if(count($user_profile)==1){
foreach($user_profile as $up)
$user_profile=$up;
}else{
$user_profile=[];
}


//
$user_service=UserSupportServiceModel::select('support_service.name','user_support_service.id')
->join('support_service','user_support_service.serviceID','=','support_service.id')
->where('user_support_service.userID',$id)
->get();

//
$disabilities=UserDisabilityModel::select('user_disability.id','disability.name')
->join('disability','user_disability.disabilityID','=','disability.id')
->where('user_disability.userID',$id)
->get();


return[

'services'=>$user_service,
'dasuns_number'=>PSSUController::get_dasuns_number(),
'disabilities'=>$disabilities,
'select_disability'=>DisabilityModel::get(),
'contact_person'=>Auth::user()->account_type=='institutional'?PSSUController::get_contact_person():[],
'user_profile'=>Auth::user()->account_type=='personal'?$user_profile:[],
'country'=>CountryModel::get(),
'service_number'=>DasunsNumberController::show_dasuns_user_number(),


];
}






//delete disaility

public function delete_disability(Request $request){
UserDisabilityModel::where('id',$request->id)->delete();
return redirect('/profile')->with('success','Disabily has been deleted.');

}







//get passu dasuns number
static function get_dasuns_number(){
$get=DasunsUserNumberModel::select('number')->where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row->number;
}else{
    return null;
}

}



//add service
public function store_services(Request $request){
$request->validate(['service'=>'required'],['required'=>'* Field is required']);
$get=UserSupportServiceModel::where('serviceID',$request->service)->where('userID',Auth::user()->id)->limit(1)->get();
if(count($get)==0){
UserSupportServiceModel::insert(['serviceID'=>$request->service,'userID'=>Auth::user()->id]);
return redirect('/profile')->with('success','Service has been added.');

}else{
return redirect('/profile')->with('warning','Service already added.');
}

}



//add disability
public function store_disability(Request $request){
$request->validate(['disability'=>'required'],['required'=>'* Field is required.']);
$count=UserDisabilityModel::where('userID',Auth::user()->id)->where('disabilityID',$request->disability)->count();
if($count==0){
UserDisabilityModel::insert(['userID'=>Auth::user()->id,'disabilityID'=>$request->disability]);
return redirect('/profile')->with('success','Disability has been added.');
}else{
return redirect('/profile')->with('warning','Disability already added.');
}

}





//get organisation contect person information
static function get_contact_person(){
$get=OrganisationContactPersonModel::where('organisationID',Auth::user()->id)->get();
if(count($get)>0){
foreach($get as $row);
    return $row;
}else{
    return [];
}
}






//edit pssu institution contact person
public function update_innstitution_contact_person(Request $request){
$get=OrganisationContactPersonModel::where('organisationID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
if($row->firstname!=$request->firstname or $row->lastname!=$request->lastname or $row->gender!=$request->gender or $row->tel!=$request->tel or $row->email!=$request->email or $row->role!=$request->designation){
    OrganisationContactPersonModel::where('organisationID',Auth::user()->id)->update([
    'firstname'=>$request->firstname,
    'lastname'=>$request->lastname,
    'gender'=>$request->gender,
    'tel'=>$request->tel,
    'email'=>$request->email,
    'role'=>$request->designation
    ]);
return redirect('/profile')->with('success','Contact person has been updated.');

}else{
return redirect('/profile')->with('warning','Contact person information was not edited.');
}

}else{
return redirect('/profile')->with('warning','Could not find contact person for the organisation.');
}
}






//personal profile update
function update_personal_profile(Request $request){
$request->validate(['location'=>['required'],
'country'=>['required']],
['required'=>'* Field is required']);
//
$get=UserProfileModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);

if($request->location!=$row->location or $request->country!=$row->countryID){

UserProfileModel::where('userID',Auth::user()->id)->update([
'location'=>$request->location,
'countryID'=>$request->country]);

return redirect('/profile')->with('success','Location information has been updated.');

}else{
return redirect('/profile')->with('warning','Location information was not updated.');
}

}else{
return redirect('/profile')->with('warning','Could not find user profile information.');
}

}




























}

