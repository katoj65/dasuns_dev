<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsUserNumberModel;
use App\Models\User;
use App\Models\SupportServiceModel;
use App\Models\ServiceProviderServicesModel;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\ServiceProviderReferenceModel;
use App\Models\SecurityDocumentsModel;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\ServiceProviderExperienceModel;
use Inertia\Inertia;
use App\Models\PSSPInterviewScheduleModel;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Panelist\PanelistController;
use App\Http\Controllers\PSSP\PSSPController;
use App\Http\Controllers\Interview\InterviewController;
use App\Models\PSSPInterviewRecommendationModel;
use App\Models\InterviewPanelistModel;
use App\Models\EmployeeProfileModel;
use App\Models\CountryModel;



class ReceptionController extends Controller
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
'tel'=>['required']],['required'=>'* Field is required']);
$user=Auth::user();
if($user->firstname!=$request->firstname or $user->lastname!=$request->lastname or $user->gender!=$request->gender or $user->tel!=$request->tel){

User::where('id',Auth::user()->id)->update([
'firstname'=>$request->firstname,
'lastname'=>$request->lastname,
'gender'=>$request->gender,
'tel'=>$request->tel]);

return redirect('/')->with('success','User information has been updated.');
}else{
return redirect('/')->with('warning','User information was not updated.');
}



}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy(Request $request)
{
//
return $request;
User::where('id',Auth::user()->id)->delete();
return redirect('/');
}






//get applicant attributes
function applicant_attributes($applicant){
$reference=count(ServiceProviderReferenceModel::where('userID',$applicant)->get());
$documents=count(ServiceProviderSecurityDetailsModel::where('userID',$applicant)->get());
$experience=count(ServiceProviderExperienceModel::where('userID',$applicant)->get());
return [
'ref'=>$reference,
'doc'=>$documents,
'exp'=>$experience
];
}









//get applicants
function get_applicants(){
// $get=DasunsUserNumberModel::select('dasuns_user_number.number','dasuns_user_number.id','dasuns_user_number.created_at','users.id as userID','users.firstname','users.lastname')
// ->join('users','dasuns_user_number.userID','=','users.id')
// ->where('users.role','pssp')
// ->where('users.status','pending')
// ->orderby('dasuns_user_number.created_at','DESC')
// ->get();
// if(count($get)>0){
// foreach($get as $row){
// $data[]=[
// 'number'=>$row->number,
// 'date'=>$row->created_at,
// 'services'=>count(ServiceProviderServicesModel::where('userID',$row->userID)->get()),
// 'id'=>$row->id
// ];
// }
// return $data;
// }else{
// return [];
// }

$get=User::select('users.firstname','users.lastname','dasuns_user_number.number','users.id as userID','dasuns_user_number.id as id','dasuns_user_number.created_at as date')
->join('dasuns_user_number','users.ID','=','dasuns_user_number.userID')
->where('users.role','pssp')
->where('users.status','pending')
->get();

$response=[];
if(count($get)>0){

foreach($get as $row){
$response[]=[
'id'=>$row->id,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'number'=>$row->number,
'count_services'=>ServiceProviderServicesModel::where('userID',$row->userID)->count(),
'date'=>$row->date
];

}

}

return $response;
}











//reception dashboard content
function dashboard(){


// $applicant=DasunsUserNumberModel::select('*')
// ->join('users','dasuns_user_number.userID','=','users.id')
// ->limit(7)
// ->get();

// $pssp=DasunsUserNumberModel::where('account_status','pending')
// ->where('role','pssp')->get();

// // get user information
// $get_pssp=User::select('*')
// ->join('service_provider_profile','users.id','=','service_provider_profile.userID')
// ->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
// ->where('users.role','pssp')
// ->get();


// $get_active_pssp=DasunsUserNumberModel::where('account_status','verified')->where('role','pssp')->get();

//response

// return [
// 'count_pending_applications'=>count($pssp),
// 'applicants'=>$this->get_applicants(),
// 'pssp'=>$get_pssp,
// 'count_pssu'=>User::where('role','pssp')->count(),
// 'count_services'=>count(SupportServiceModel::get()),
// 'count_active_pssp'=>count($get_active_pssp),
// 'count_active_users'=>User::where('role','pssu')->count(),
// 'interviews'=>$this->get_interviews(),
// 'declined_application'=>InterviewController::get_all_declined_interview(),
// 'count_interviews'=>User::where('status','interview')->count(),
// 'profile'=>$this->get_profile(),
// 'country'=>CountryModel::get(),

// ];



return[
'application_pending'=>User::join('dasuns_user_number','users.id','=','dasuns_user_number.userID')->where('users.role','pssp')->where('users.status','pending')->count(),

'active_service_providers'=>User::join('dasuns_user_number','users.id','=','dasuns_user_number.userID')->where('users.role','pssp')->where('users.status','active')->count(),

'active_users'=>User::join('dasuns_user_number','users.id','=','dasuns_user_number.userID')->where('users.role','pssu')->where('users.status','active')->count(),

'services'=>SupportServiceModel::count(),
'interviews'=>$this->get_interviews(),
'declined_applications'=>[],
'country'=>CountryModel::get(),
'applicants'=>$this->get_applicants(),





];









}








//profile information
function get_profile(){
$get=EmployeeProfileModel::select('employee_profile.countryID','employee_profile.location','employee_profile.designation','country.name as country','employee_profile.about','employee_profile.countryID')
->join('country','employee_profile.countryID','=','country.id')
->where('employee_profile.userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
$playload=$row;
}else{
$playload=[];
}
return $playload;
}














//get interviews
function get_interviews(){
$get=DasunsUserNumberModel::select('pssp_interview_schedule.date',
'pssp_interview_schedule.time','dasuns_user_number.number','pssp_interview_schedule.comment',
'pssp_interview_schedule.id')
->join('pssp_interview_schedule','dasuns_user_number.id','=','pssp_interview_schedule.applicationID')
->join('users','dasuns_user_number.userID','=','users.id')
->where('pssp_interview_schedule.status','scheduled')
->where('users.status','interview')
->orderby('pssp_interview_schedule.date','DESC')
->orderby('pssp_interview_schedule.time','DESC')
->limit(6)
->get();
return $get;
}











//get interview panelists
static function get_interview_panelists($id){
$get=InterviewPanelistModel::select('users.firstname',
'users.lastname',
'users.id as userID',
'interview_panelist.interviewID')
->join('users','interview_panelist.userID','=','users.id')
->where('interview_panelist.interviewID',$id)
->get();
if(count($get)>0){
foreach($get as $row){

$data[]=[
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'recommendation'=>PSSPInterviewRecommendationModel::select('service_recommendation.name','pssp_interview_recommendation.comment','pssp_interview_recommendation.id')
->join('service_recommendation','pssp_interview_recommendation.recommendationID','=','service_recommendation.id')
->where('pssp_interview_recommendation.interviewID',$row->interviewID)->where('pssp_interview_recommendation.panelistID',$row->userID)->get(),


];

}

}else{
$data=[];
}

return $data;

}










//show interview
public function show_interview(Request $request){
$state=RolesController::roles(['reception','panelist']);
if($state==true){
$has_recommendations=count(PSSPInterviewRecommendationModel::where('interviewID',$request->segment(2))->get());

$get=PSSPInterviewScheduleModel::select('users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.dob',
'users.status',
'service_provider_profile.location',
'country.name as country',
'dasuns_user_number.number',
'dasuns_user_number.account_status',
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'pssp_interview_schedule.type',
'pssp_interview_schedule.comment',
'users.id as id',
'pssp_interview_schedule.id as interviewID')
->join('dasuns_user_number','pssp_interview_schedule.applicationID','=','dasuns_user_number.id')
->join('users','dasuns_user_number.userID','=','users.id')
->join('service_provider_profile','users.id','=','service_provider_profile.userID')
->join('country','service_provider_profile.countryID','=','country.id')
->where('pssp_interview_schedule.id',$request->segment(2))
->get();

if(count($get)==1){
foreach($get as $row);


//services
$services=ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$row->id)
->get();


$data['title']='Interview';
$data['response']=[
'interview'=>$row,
'services'=>$services,
'panelists'=>ReceptionController::get_interview_panelists($request->segment(2)),
'recommenation_options'=>Auth::user()->role=='panelist'?PanelistController::get_recommendation_options():[],
'expereinces'=>PSSPController::get_pssp_experiences($row->id),
'documents'=>PSSPController::get_security_documents($row->id),
'references'=>PSSPController::get_pssp_references($row->id),
'panelist_status'=>Auth::user()->role=='panelist'?PanelistController::interview_panelist_status($request->segment(2)):[],
'has_recommendations'=>Auth::user()->role=='reception'?$has_recommendations>0?true:false:null,

];

return Inertia::render('ShowInterviewPage',$data);

}else{
    return redirect('/')->with('error','Could not find interview information.');
}
}else{
    return redirect('/');
}

}




//add about the reception
public function add_reception_about(Request $request){

$request->validate([
'country'=>['required'],
'location'=>['required'],
'designation'=>['required']],['required'=>'* Field is required.']);
EmployeeProfileModel::insert([
'userID'=>Auth::user()->id,
'countryID'=>$request->country,
'about'=>$request->about,
'location'=>$request->location,
'designation'=>$request->designation
]);

return redirect('/')->with('success','Your profile information has been added.');

}



//edit reception profile.
public function edit_reception_profile(Request $request){
$request->validate([
'designation'=>['required'],
'country'=>['required'],
'location'=>['required']],['required'=>'* Field is required']);
$get=EmployeeProfileModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);

if($row->designation!=$request->designation or $row->countryID!=$request->country or $row->location!=$request->location or $row->about!=$request->about){
EmployeeProfileModel::where('userID',Auth::user()->id)->update([
'designation'=>$request->designation,
'about'=>$request->about,
'countryID'=>$request->country,
'location'=>$request->location
]);

return redirect('/profile')->with('success','Profile has been updated.');
}else{
return redirect('/profile')->with('warning','Prifile was not edited.');
}
}else{
    return redirect('/')->with('warning','Could not find profile');
}
}






//reception profile
static function reception_profile(){
$get=EmployeeProfileModel::select('country.name as country','employee_profile.about','employee_profile.location','employee_profile.designation','users.status')
->join('country','employee_profile.countryID','=','country.id')
->join('users','employee_profile.userID','=','users.id')
->where('employee_profile.userID',Auth::user()->id)
->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return[];
}
}




//approve employee account
public function approve_employ_account(Request $request){
User::where('id',$request->id)->update(['status'=>'active']);
return redirect('/employee/'.$request->id)->with('success','Accout has been aprroved.');

}






















}
