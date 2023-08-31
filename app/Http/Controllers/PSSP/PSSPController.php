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
use App\Models\InterviewStatusModel;
use App\Models\AccountStatusMessageModel;
use App\Models\PSSPInterviewScheduleModel;
use App\Models\InterviewPanelistModel;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\AppointmentServiceModel;
use App\Models\DasunsRecommendationsModel;
use App\Http\Controllers\User\UserController;
use App\Models\PSSPRatingModel;
use App\Models\DasunsWalletModel;





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






public function index(User $user)
{
        //
$data['title']='Service providers';
$data['response']=[
'service_providers'=>$user->active_pssp(),
];

return Inertia::render('ServiceProviderList',$data);

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
public function show(User $user, Request $request){
$get=$user->show($request->segment(2));

//pssp profile
if($get!=null){
$profile_data=new ServiceProviderProfileModel;
$profiles=$profile_data->show($get->id);
if(count($profiles)==1){
foreach($profiles as $p);
}
//rating
$rate=new PSSPRatingModel;
$appointment=new AppointmentModel;
$recommend=new DasunsRecommendationsModel;

//pssp details

$profile=[
'id'=>$get->id,
'firstname'=>$get->firstname,
'lastname'=>$get->lastname,
'gender'=>$get->gender,
'tel'=>$get->tel,
'email'=>$get->email,
'status'=>$get->status,
'profile'=>$p,
'services'=>$user->pssp_services($get->id),
'service_number'=>$user->show_dasuns_number($get->id),
'rating'=>$rate->sum_rating($get->id),
'recommendations'=>$recommend->count_recommendations($get->id),
'tasks_complete'=>$appointment->count_pssp_tasks_completed($get->id),
'schedule_count'=>$appointment->pssp_schedule_count($get->id),

];






$data['title']='Profile';
$data['response']=['profile'=>$profile];
return Inertia::render('ProfilePSSP',$data);
}else{
return redirect('/')->with('warning','Could not find user');
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
'dasuns_number'=>DasunsNumberController::get_dasuns_user_number(),
'interview_status'=>PSSPController::get_interview_status(),

];
}









//dashboard
static function dashboard(){
//generate content by status
$status=Auth::user()->status;
if($status=='pending' or $status=='declined' or $status=='interview' or $status=='banned'){
$get_services=ServiceProviderServicesModel::select('support_service.name','support_service.id')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',Auth::user()->id)
->get();

//




return [
'dasuns_number'=>PSSPController::return_dasuns_number(),
'identification_documents'=>ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->get(),
'services'=>$get_services,
'experience'=>ServiceProviderExperienceModel::where('userID',Auth::user()->id)->get(),
'references'=>ServiceProviderReferenceModel::where('userID',Auth::user()->id)->get(),
'interview'=>PSSPController::interview_scheduled(),
'interview_decline'=>InterviewController::get_declined_interview_by_userID(Auth::user()->id),
'interview_failure'=>Auth::user()->status=='failed'?[]:[],
'statement'=>PSSPController::get_pssp_profile(),
'interview_status'=>PSSPController::get_interview_status(),
'account_status_message'=>PSSPController::account_status_message(),

];

}else{

//appointments
$appointment=new AppointmentModel;
$wallet=new DasunsWalletModel;



//
return [
'providerID'=>Auth::user()->id,
//
'counts'=>[
'requests'=>$appointment->pssp_requests_count(),
'appointments'=>$appointment->pssp_appointments_count(),
'services'=>ServiceProviderServicesModel::where('userID',Auth::user()->id)->count(),
'wallet'=>$wallet->my_balance(),
],

//lists
'lists'=>[
'services'=>ServiceProviderServicesModel::select('support_service.name','support_service.id','support_service.icon')
->where('service_provider_services.userID',Auth::user()->id)
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->get(),
'appointments'=>$appointment->all_pssp_appointments(),
'recommendations'=>DasunsRecommendationsModel::where('userID',Auth::user()->id)->limit(2)->get(),
'activities'=>$appointment->pssp_appointment(),


],

'section3'=>[
'wallet_details'=>WalletController::get_wallet_balance(),


]



];


}
}


// get dasuns number
static function return_dasuns_number(){
$get=DasunsUserNumberModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row->number;
}else{
return null;
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


UserController::send_email(
Auth::user()->email,
'Dasuns account has been created',
'You have successfully created an account with Dasuns.',
['From'=>'dasuns-no-reply@dasuns.org']);





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






//interview status
static function interview_status(){


$documents=ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->count();
$experience=ServiceProviderExperienceModel::where('userID',Auth::user()->id)->count();
$references=ServiceProviderReferenceModel::where('userID',Auth::user()->id)->count();
if($documents!=0 and $experience!=0 and $references!=0){
$user_status=Auth::user()->status;
$message=null;
$state=null;
if($user_status=='interview'){
$message='Interview has been scheduled';
$state='interview';
}elseif($user_status=='declined'){
$message='Your application has been declined';
$state='declined';
}elseif($user_status=='active'){
$message='Your application has been approved.';
$state='approved';
}else{
$message='Your application is under review, Dasuns will contact you soon.';
$state='pending';
}



if($user_status!=='active'){
InterviewStatusModel::where('userID',Auth::user()->id)->update(['userID'=>Auth::user()->id,'status'=>$state,'message'=>$message]);
}



}else{
$status=InterviewStatusModel::where('userID',Auth::user()->id)->count();
if($status==0){
InterviewStatusModel::insert(['userID'=>Auth::user()->id,
'status'=>'incomplete',
'message'=>'You are required to fill in all documents.']);
}else{

InterviewStatusModel::where('userID',Auth::user()->id)->update(['userID'=>Auth::user()->id,
'status'=>'incomplete',
'message'=>'Fill in the missing information to allow Dasuns review your application on time.']);
}

}
}








//get interview status
static function get_interview_status(){
$get=InterviewStatusModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}





//account status message
static function account_status_message(){
$get=AccountStatusMessageModel::where('userID',Auth::user()->id)->get();
$response=[];
if(count($get)==1){
foreach($get as $row);
$response=$row;
}
return $response;
}







//store reference
public function store_reference(Request $request){
$request->validate([
'names'=>['required'],
'position'=>['required'],
'email'=>['required','email'],
'tel'=>['required'],
'address'=>['required']],['required'=>'* Field is required.']);

ServiceProviderReferenceModel::insert([
'userID'=>Auth::user()->id,
'names'=>$request->names,
'position'=>$request->position,
'email'=>$request->email,
'tel'=>$request->tel,
'address'=>$request->address
]);
PSSPController::profile_fillout_check();
return redirect('/profile')->with('success','Your profession reference has been added.');
}







//store Security documents
public function store_identification_document(Request $request){
$request->validate([
'document'=>['required'],
'number'=>['required']
],['required'=>'* Field is required.']);

ServiceProviderSecurityDetailsModel::insert([
'userID'=>Auth::user()->id,'document'=>$request->document,
'document_number'=>$request->number,
'file'=>'null']);
PSSPController::profile_fillout_check();
return redirect('/profile')->with('success','Your document has been uploaded.');
}






//store pssp experience
public function store_experience(Request $request){
$request->validate([
'organisation'=>['required'],
'position'=>['required'],
'from'=>['required'],
'to'=>['required']],
['required'=>'* Field is required.']);

ServiceProviderExperienceModel::insert([
'userID'=>Auth::user()->id,
'organisation_name'=>$request->organisation,
'position'=>$request->position,
'from_date'=>$request->from,
'to_date'=>$request->to
]);

PSSPController::profile_fillout_check();
return redirect('/profile')->with('success','Experince has been added');
}






//static profile filled check
static function profile_fillout_check(){
$doc=ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->count();
$ref=ServiceProviderReferenceModel::where('userID',Auth::user()->id)->count();
$exp=ServiceProviderExperienceModel::where('userID',Auth::user()->id)->count();
if($doc==0 or $ref==0 or $exp==0){
//
$check=AccountStatusMessageModel::where('userID',Auth::user()->id)->count();
if($check==0){
AccountStatusMessageModel::insert(['userID'=>Auth::user()->id,'message'=>'Fill in the missing details of your profile.']);
}else{
AccountStatusMessageModel::where('userID',Auth::user()->id)->update(['message'=>'Dasuns team will contact you for further proceedings.']);
}
}else{
AccountStatusMessageModel::where('userID',Auth::user()->id)->update(['message'=>'Dasuns team will contact you for further proceedings.','status'=>'profile']);
}
}







//get scheduled interview
static function interview_scheduled(){
$get=PSSPInterviewScheduleModel::where('service_providerID',Auth::user()->id)->get();
$response=[];
if(count($get)==1){
foreach($get as $row);
$response=[
'id'=>$row->id,
'userID'=>$row->service_providerID,
'date'=>$row->date,
'time'=>$row->time,
'comment'=>$row->comment,
'created_at'=>$row->created_at,
'panelists'=>InterviewPanelistModel::where('interviewID',$row->id)->count()

];
}
return $response;
}








//show appointments
public function list_appointments(AppointmentModel $appointments){
//
$data['title']='Appointments';
$data['response']=[
'appointments'=>$appointments->pssp_appointment(),

];
return Inertia::render('PSSPAppointmentPage',$data);
}







//update status of the appointment
public function update_appointment_status(Request $request){
$id=Auth::user()->id;
AppointmentModel::where('id',$request->id)->update(['status'=>$request->status]);
return redirect('/dashboard')->with('success','Appointment '.$request->status);
}






//services information
public function pssp_services_list(Request $request){
$data['title']='Services';
$data['response']=[
'services'=>ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',Auth::user()->id)
->get(),

];
return Inertia::render('PSSPServices',$data);
}

















}
