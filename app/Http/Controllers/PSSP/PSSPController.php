<?php

namespace App\Http\Controllers\PSSP;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\ServiceProviderExperienceModel;
use App\Models\ServiceProviderReferenceModel;
use App\Http\Controllers\Interview\InterviewController;
use App\Models\ServiceProviderProfileModel;
use App\Models\DasunsUserNumberModel;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Models\User;
use App\Models\AppointmentModel;




class PSSPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//get security documents
static function get_security_documents($id){
return ServiceProviderSecurityDetailsModel::where('userID',$id)->get();
}


//get service provider services
static function get_pssp_services($id){
return ServiceProviderServicesModel::select('support_service.name','support_service.id')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$id)
->get();
}


//get pssp experience
static function get_pssp_experiences($id){
return ServiceProviderExperienceModel::where('userID',$id)->get();
}

//get pssp referees
static function get_pssp_references($id){
return ServiceProviderReferenceModel::where('userID',$id)->get();
}






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
    public function show(Request $request)
    {

// $get=User::where('id',$request->segment(2))->get();
$get=User::select('users.firstname',
'users.lastname',
'users.id',
'users.gender',
'users.email',
'users.tel',
'users.dob',
'service_provider_profile.location',
'service_provider_profile.profile_picture',
'country.name as country',
'service_provider_profile.about',
'users.created_at')
->join('service_provider_profile','users.id','=','service_provider_profile.userID')
->join('country','service_provider_profile.countryID','=','country.id')
->where('users.id',$request->segment(2))
->where('users.role','pssp')
->where('users.status','active')
->get();

//get services
$svs=ServiceProviderServicesModel::select('support_service.name','support_service.id')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$request->segment(2))
->get();



if(count($get)==1){
foreach($get as $row);



$data['title']='Service Provider';
$data['response']=[
'pssp'=>$row,
'dasuns_number'=>DasunsNumberController::get_dasuns_number_byUserID($row->id)->number,
'services'=>$svs




];
return Inertia::render('ServiceProviderPage',$data);
}else{
    return redirect('/')->width('warning','Could not find user information');
}
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





//get pssp attributes
function get_pssp_attributes($id){
$account_status=PSSPController::pssp_dasuns_number();
$get_services=ServiceProviderServicesModel::select('support_service.name','support_service.id')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$id)
->get();


// $dasuns=DasunsUserNumberModel::select('pssp_interview_rejection.title','pssp_interview_rejection.comment','pssp_interview_rejection.created_at','pssp_interview_rejection.id')
// ->join('pssp_interview_schedule','dasuns_user_number.id','=','pssp_interview_schedule.applicationID')
// ->join('pssp_interview_rejection','pssp_interview_schedule.id','=','pssp_interview_rejection.interviewID')
// ->where('dasuns_user_number.userID',Auth::user()->id)
// ->get();



//request
$requests=AppointmentModel::select('appointment.date',
'appointment.from',
'appointment.to',
'appointment.created_at',
'appointment.end_date')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.status','pending')
->orderby('appointment.created_at','ASC')
->get();

return[
'identification_documents'=>ServiceProviderSecurityDetailsModel::where('userID',$id)->get(),
'services'=>$get_services,
'experience'=>ServiceProviderExperienceModel::where('userID',$id)->get(),
'references'=>ServiceProviderReferenceModel::where('userID',$id)->get(),
'status'=>$account_status,
'interview'=>InterviewController::get_interview_by_userID(Auth::user()->id),
'interview_decline'=>InterviewController::get_declined_interview_by_userID(Auth::user()->id),
'interview_failure'=>Auth::user()->status=='failed'?[]:[],
'requests'=>$requests,
'profile'=>$this->get_pssp_profile(),
'dasuns_number'=>DasunsNumberController::get_dasuns_user_number()

];
}









//dashboard
static function dashboard(){

//generate content by status
$status=Auth::user()->status;
if($status=='pending' or $status=='declined' or $status=='interview'){
$get_services=ServiceProviderServicesModel::select('support_service.name','support_service.id')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',Auth::user()->id)
->get();



//
return [
'dasuns_number'=>DasunsNumberController::get_dasuns_user_number()->number,
'identification_documents'=>ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->get(),
'services'=>$get_services,
'experience'=>ServiceProviderExperienceModel::where('userID',Auth::user()->id)->get(),
'references'=>ServiceProviderReferenceModel::where('userID',Auth::user()->id)->get(),
'interview'=>InterviewController::get_user_interview(),
'interview_decline'=>InterviewController::get_declined_interview_by_userID(Auth::user()->id),
'interview_failure'=>Auth::user()->status=='failed'?[]:[],
'statement'=>PSSPController::get_pssp_profile(),


];


}else{

return [




];


}





}











//get profile
static function  get_pssp_profile(){
$get=ServiceProviderProfileModel::select('about')->where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
$payload=$row;
}else{
$payload=[];
}
return $payload;
}










//get pssp dasuns user number
static function pssp_dasuns_number(){
$userID=Auth::user()->id;
$get=DasunsUserNumberModel::where('userID',$userID)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}


// pssp status
static function get_pssp_by_status($status){
return User::where('role','pssp')->where('status',$status)->get();
}

//get pssp by ID

static function get_pssp_byID($id){
return User::where('role','pssp')->where('id',$id)->get();
}


//service subscription
static function pssp_service_subscription($serviceID,$userID){
return ServiceProviderServicesModel::where('userID',$userID)->where('serviceID',$serviceID)->count()>0?true:false;
}







//create profile

public function store_profile(Request $request){
$request->validate([
'serviceID'=>['required'],
'location'=>['required'],
'countryID'=>['required']
],['required'=>'* Field is required.']);

ServiceProviderProfileModel::insert(['userID'=>Auth::user()->id,
'location'=>$request->location,
'countryID'=>$request->countryID]);

foreach($request->serviceID as $s){
ServiceProviderServicesModel::insert(['userID'=>Auth::user()->id,'serviceID'=>$s]);
}

//generate dasuns number
$dn=DasunsNumberController::create_dasuns_user_number();

//add dasuns user number
DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>$dn,
'role'=>Auth::user()->role,
'account_status'=>'pending'
]);
return redirect('/profile')->with('success','Profile has been created successfully.');
}



//
public function update_about(Request $request){
$request->validate(['about'=>['required']],['required'=>'* Field is required.']);
ServiceProviderProfileModel::where('userID',$request->id)->update(['about'=>$request->about]);
return redirect('/profile')->with('success','About has been updated.');
}














}
