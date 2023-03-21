<?php

namespace App\Http\Controllers\Panelist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DasunsUserNumberModel;
use App\Models\PanelistProfessionProfileModel;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeProfessionModel;
use App\Models\User;
use App\Models\InterviewPanelistModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\ServiceRecommendationModel;
use App\Models\PSSPInterviewRecommendationModel;
use App\Http\Controllers\Interview\InterviewController;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;




class PanelistController extends Controller
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


static function get_recommendation_options(){
return ServiceRecommendationModel::orderby('name','ASC')->get();
}


//ssp services

static function get_pssp_services($userID){
$get=ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$userID)
->get();
return $get;
}






//get recommended interviews
static function get_recommened_interviews(){
$id=Auth::user()->id;
$get=PSSPInterviewRecommendationModel::select('dasuns_user_number.number',
'pssp_interview_schedule.date','pssp_interview_schedule.id')
->join('pssp_interview_schedule','pssp_interview_recommendation.interviewID','=','pssp_interview_schedule.id')
->join('dasuns_user_number','pssp_interview_schedule.service_providerID','=','dasuns_user_number.userID')
->join('interview_panelist','pssp_interview_schedule.id','interview_panelist.interviewID')
->where('interview_panelist.userID',$id)

->get();
return $get;
}



//check if panalist has recommended the service

static function get_panelist_recommendation($id){
return PSSPInterviewRecommendationModel::where('interviewID',$id)->where('panelistID',Auth::user()->id)->get();
}










//get interviews
static function get_panelist_interviews(){
$data=[];
$id=Auth::user()->id;
$get=DasunsUserNumberModel::select(
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'dasuns_user_number.number',
'pssp_interview_schedule.comment',
'pssp_interview_schedule.id',
'dasuns_user_number.userID')
->join('pssp_interview_schedule','dasuns_user_number.userID','=','pssp_interview_schedule.service_providerID')
->join('interview_panelist','pssp_interview_schedule.id','=','interview_panelist.interviewID')
->where('pssp_interview_schedule.status','scheduled')
->where('interview_panelist.userID',$id)
->get();

if(count($get)>0){
    foreach($get as $row){
        $count=count(PanelistController::get_panelist_recommendation($row->id))==0?false:true;
        if($count==false){
            $data[]=['pssp'=>$row,
            'services'=>count(PanelistController::get_pssp_services($row->userID)),
            'count'=>$count
            ];

        }

    }

}




return $data;

}








//dashboard
static function dashboard(){
return[
'interviews'=>PanelistController::get_panelist_interviews(),
'profile'=>PanelistProfessionProfileModel::get(),
'user'=>Auth::user(),
'dasuns_number'=>DasunsNumberController::get_dasuns_number_byUserID(Auth::user()->id),
'recommended'=>PanelistController::get_recommened_interviews(),
'profession'=>EmployeeProfessionModel::get(),

'panelist_professions'=>PanelistProfessionProfileModel::select('panelist_profession_profile.id','panelist_profession_profile.description','panelist_profession_profile.number_years','employee_profession.name')

->join('employee_profession','panelist_profession_profile.professionID','=','employee_profession.id')
->where('panelist_profession_profile.userID',Auth::user()->id)
->get(),



];



}




//create panelist profile
public function store_profession_profile(Request $request){
$request->validate([
'experience'=>['required'],
'years'=>['required']
],['required'=>'* Field is required.']);

$get=PanelistProfessionProfileModel::where('userID',Auth::user()->id)
->where('professionID',$request->experience)->get();
if(count($get)==0){

PanelistProfessionProfileModel::insert([
'userID'=>Auth::user()->id,
'professionID'=>$request->experience,
'number_years'=>$request->years,
'description'=>$request->description,
]);

return redirect('/')->with('success','Experience has been added.');
}else{
return redirect('/')->with('warning','Profession was already added.');
}

}





//delete profile attribute
public function delete_profession_attribute(Request $request){
PanelistProfessionProfileModel::where('id',$request->id)->delete();
return redirect('/dashboard')->with('success','Item has been deleted.');
}










//Finish
public function finish(Request $request){
$id=Auth::user()->id;
// User::where('id',$id)->update(['status'=>'active']);
return redirect('/');
}







//get panelist by interview ID
static function get_panelist_by_interviewID($id){
$get=InterviewPanelistModel::select('users.firstname','users.lastname','users.id')
->join('users','interview_panelist.userID','=','users.id')
->where('interview_panelist.interviewID',$id)
->where('users.role','panelist')
->get();
if(count($get)>0){
foreach($get as $row){
$data[]=['panelist'=>$row,
//
'profession'=>PanelistProfessionProfileModel::select('*')
->join('employee_profession','panelist_profession_profile.professionID','=','employee_profession.id')
->where('panelist_profession_profile.userID',$row->id)
->get(),
'recommendation'=>InterviewController::get_interview_recommendations($id),

];
}
return $data;
}else{
return[];
}
}





//check panelist status on interview
static function interview_panelist_status($id){
$get=PSSPInterviewRecommendationModel::where('panelistID',Auth::user()->id)
->where('interviewID',$id)
->get();
if(count($get)==0){
return false;
}else{
return true;
}
}







//get panelist interview recommendation
static function get_panelist_interview_recommendation($interviewID){
$get=PSSPInterviewRecommendationModel::where('interviewID',$interviewID)->get();
if(count($get)>0){
foreach($get as $row){
$data[]=[
'time'

];
}
return $data;
}else{
return [];
}
}





//get receoomedation by panelist and interviewID
static function get_interview_recommendation_by_panelist_interviewID($panelistID,$interviewID){
$get_recommendation=PSSPInterviewRecommendationModel::select('*')
->join('service_recommendation','pssp_interview_recommendation.recommendationID','=','service_recommendation.id')
->where('pssp_interview_recommendation.panelistID',$panelistID)
->where('pssp_interview_recommendation.interviewID',$interviewID)
->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
    return [];
}

}








//get interview panelist by interview ID
static function get_interview_panelist($id){
$get=InterviewPanelistModel::select(
'users.id as userID',
'users.firstname',
'users.lastname')
->join('users','interview_panelist.userID','=','users.id')
->where('interview_panelist.interviewID',$id)
->get();

if(count($get)>0){

foreach($get as $row){

$data[]=[

'userID'=>$row->userID,
'names'=>$row->firstname.' '.$row->lastname,
'profile'=>PanelistController::get_panelist_profile($row->userID),
'recommendation'=>PSSPInterviewRecommendationModel::select('*')
->join('service_recommendation','pssp_interview_recommendation.recommendationID','=','service_recommendation.id')
->where('pssp_interview_recommendation.panelistID',$row->userID)
->where('pssp_interview_recommendation.interviewID',$id)
->get(),


];


}
return $data;
}else{
return [];
}

}

//get panelist profile list
static function get_panelist_profile($id){
return PanelistProfessionProfileModel::where('userID',$id)->get();
}



//panelist profile
static function profile(){
$id=Auth::user()->id;
return [
'employee_professions'=>EmployeeProfessionModel::get(),
'profession'=>PanelistProfessionProfileModel::select('panelist_profession_profile.id','panelist_profession_profile.description','panelist_profession_profile.years','employee_profession.name')->join('employee_profession','panelist_profession_profile.professionID','=','employee_profession.id')->where('panelist_profession_profile.userID',$id)->get(),
'dasuns_number'=>DasunsNumberController::get_dasuns_number_byUserID(Auth::user()->id),

];
}



//add new profession to panelist profile
public function store_add_professions(Request $request){
$request->validate([
'professionID'=>['required'],
'years'=>['required']
],['required'=>'* Field is required']);

$get=PanelistProfessionProfileModel::where('userID',$request->id)->where('professionID',$request->professionID)->get();
if(count($get)==0){

PanelistProfessionProfileModel::insert(['userID'=>$request->id,'professionID'=>$request->professionID,'years'=>$request->years,'description'=>$request->description]);
return redirect('/profile')->with('success','Profession has been added.');

}else{
    return redirect('/profile')->with('warning','Profession was already added.');
}

}


//delete profile expertise item
public function destroy_expertise(Request $request){
PanelistProfessionProfileModel::where('id',$request->id)->delete();
return redirect('/profile')->with('success','Item has been deleted.');
}




//edit profile
public function update_profile(Request $request){
$user=Auth::user();
$request->validate([
'firstname'=>['required'],
'lastname'=>['required'],
'gender'=>['required'],
'tel'=>['required'],
// 'email'=>['required']
],['required'=>'* Field is required.']);

if($user->firstname!=$request->firstname or $user->lastname!=$request->lastname or $user->gender!=$request->gender or $user->tel!=$request->tel or $user->email!=$request->email){

User::where('id',$request->id)->update(['firstname'=>$request->firstname,'lastname'=>$request->lastname,'gender'=>$request->gender,'tel'=>$request->tel]);
return redirect('/profile')->with('success','Your profile information has been updated.');
}else{
return redirect('/profile')->with('warning','Your profile information was not changed.');
}


}













}




