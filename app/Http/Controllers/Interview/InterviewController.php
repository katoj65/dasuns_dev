<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PSSPInterviewScheduleModel;
use App\Models\PSSPInterviewRecommendationModel;
use Illuminate\Support\Facades\Auth;
use App\Models\PSSPDeclinedInterviewModel;
use App\Models\DasunsUserNumberModel;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Panelist\PanelistController;
use App\Models\User;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Models\PSSPInterviewRejectionModel;
use App\Models\AccountStatusMessageModel;
use Inertia\Inertia;
use App\Models\ServiceProviderServicesModel;
use App\Models\InterviewPanelistModel;




class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
















public function index(Request $request){
$data['title']='Interviews';
$data['response']=[
'interviews'=>PSSPInterviewScheduleModel::select('pssp_interview_schedule.created_at',
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'pssp_interview_schedule.comment',
'pssp_interview_schedule.status',
'pssp_interview_schedule.type',
'users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.dob',
'dasuns_user_number.number',
'users.id',
'pssp_interview_schedule.id as interviewID')
->join('users','pssp_interview_schedule.service_providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->get(),







];

return Inertia::render('InterviewsPage',$data);

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
public function show(Request $request){
        //

$row=[];
$get=PSSPInterviewScheduleModel::select('pssp_interview_schedule.created_at',
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'pssp_interview_schedule.comment',
'pssp_interview_schedule.status',
'pssp_interview_schedule.type',
'users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'users.dob',
'dasuns_user_number.number',
'users.id',
'pssp_interview_schedule.id as interviewID')
->join('users','pssp_interview_schedule.service_providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('pssp_interview_schedule.id',$request->segment(2))
->limit(1)
->get();
if(count($get)==1){
foreach($get as $row);
$item=[
'date'=>$row->date,
'time'=>$row->time,
'comment'=>$row->comment,
'status'=>$row->status,
'type'=>$row->type,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'gender'=>$row->gender,
'tel'=>$row->tel,
'email'=>$row->email,
'dob'=>$row->dob,
'number'=>$row->number,
'created_at'=>$row->created_at,
'id'=>$row->id,
'interviewID'=>$row->interviewID,

//services
'services'=>ServiceProviderServicesModel::
join('support_service','service_provider_services.serviceID','=','support_service.id')->where('service_provider_services.userID',$row->id)->get(),

//panelists
'panelist'=>InterviewPanelistModel::select('users.firstname','users.lastname')
->join('users','interview_panelist.userID','=','users.id')
->where('interviewID',$row->interviewID)
->get()

];


$data['title']='Interview';
$data['response']=['interview'=>$item];

return Inertia::render('ShowInterviewPage',$data);



}else{
return redirect('/');
}










}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



public function update(Request $request){
$request->validate(['date'=>['required'],
'time'=>['required'],
'comment'=>['required']],
['required'=>'* Field is required.']);

//
$get=PSSPInterviewScheduleModel::where('id',$request->id)
->limit(1)
->get();
if(count($get)==1){
foreach($get as $row);
if($request->date!=$row->date || $request->time!=$row->time || $request->comment!=$row->comment){

//
PSSPInterviewScheduleModel::where('id',$request->id)
->update(['time'=>$request->time,'date'=>$request->date,'comment'=>$request->comment]);
return redirect('/interview/'.$request->id)->with('success','Interview information hase been updated.');

}else{
return redirect('/interview/'.$request->id)->with('warning','Interview details not changed.');
}






}else{
return redirect('/');
}


return $request;

}




/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */




public function destroy(Request $request){
PSSPInterviewScheduleModel::where('id',$request->id)->delete();
return redirect('/')->with('success','Interview has been deleted.');
}








//interview recommendation
public function store_interview_recommendation(Request $request){

$request->validate(['option'=>['required'],['required'=>'* Field is required.']]);
$id=Auth::user()->id;
PSSPInterviewRecommendationModel::insert([
'panelistID'=>$id,
'interviewID'=>$request->id,
'recommendationID'=>$request->option,
'comment'=>$request->comment
]);

return redirect('/')->with('success','You have successfully submited your recommendation');
}








//get interview recommendations
static function get_interview_recommendations($id){
$get=PSSPInterviewRecommendationModel::select('*')
->join('service_recommendation','pssp _interview_recommendation.recommendationID','=','service_recommendation.id')
->where('pssp_interview_recommendation.interviewID',$id)->get();
return $get;
}





//interview store decline message
public function store_interview_decline_message(Request $request){
$request->validate(['message'=>['required']],['required'=>'* Field is required.']);
$dasuns=DasunsNumberController::get_dasuns_number_byID($request->id);

PSSPDeclinedInterviewModel::insert(['interviewID'=>$request->id,'message'=>$request->message]);
DasunsUserNumberModel::where('id',$request->id)->update(['account_status'=>'declined']);
User::where('id',$dasuns->userID)->update(['status'=>'declined']);

return redirect('/')->with('success','Interview has been declined.');
}






//set decline interview status
static function set_declined_interview_status($dasunsID){
$dasuns=DasunsNumberController::get_dasuns_number_byID($dasunsID);
DasunsUserNumberModel::where('id',$dasunsID)->update(['account_status'=>'declined']);
User::where('id',$dasuns->userID)->update(['status'=>'declined']);
return true;
}



//set interview status
static function set_interview_status($dasunsID){
$dasuns=DasunsNumberController::get_dasuns_number_byID($dasunsID);
DasunsUserNumberModel::where('id',$dasunsID)->update(['account_status'=>'interview']);
User::where('id',$dasuns->userID)->update(['status'=>'interview']);
return true;
}











//get interview decline
static function get_interview_decline($id){
$get=PSSPDeclinedInterviewModel::where('interviewID',$id)->get();
return $get;
}





//get all declined interviews
static function get_all_declined_interview(){
$get=PSSPDeclinedInterviewModel::select(
'dasuns_user_number.number','dasuns_user_number.id',
'pssp_declined_interview.created_at',
'pssp_declined_interview.message')
->join('dasuns_user_number','pssp_declined_interview.interviewID','=','dasuns_user_number.id')
->where('dasuns_user_number.account_status','declined')
->get();
return $get;
}





//get pssp interview details
static function get_pssp_interview_details($id){
$get=PSSPInterviewScheduleModel::select(
'pssp_interview_schedule.id',
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'pssp_interview_schedule.comment'
)
// ->join('dasuns_user_number','pssp_interview_schedule.applicationID','=','dasuns_user_number.id')
->where('id',$id)
->get();
if(count($get)>0){
foreach($get as $row){
$data=[
'InterviewID'=>$row->id,
// 'number'=>$row->number,
'date'=>$row->date,
'time'=>$row->time,
'comment'=>$row->comment,
'status'=>$row->status,
'panelists'=>PanelistController::get_interview_panelist($row->id),
];
}
return $data;
}else{
    return [];
}

}








//get interview and dasuns number
static function get_interview_and_dasuns_number($interviewID){
$get=PSSPInterviewScheduleModel::select('*')
// ->join('dasuns_user_number','pssp_interview_schedule.applicationID','=','dasuns_user_number.id')
->where('pssp_interview_schedule.id',$interviewID)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}
}




//decline interview by interview ID
static function get_interview_declined($interviewID){
$get=PSSPDeclinedInterviewModel::where('interviewID',$interviewID)->orderby('created_at','DESC')->get();
if(count($get)>0){
foreach($get as $row);
return $row;
}else{
return[];
}
}





//approve interview
public function store_approve_interview(Request $request){
$get=PSSPInterviewScheduleModel::select('id','service_providerID as userID')
->where('id',$request->id)->get();
if(count($get)==1){
foreach($get as $row);
User::where('id',$row->userID)->update(['status'=>'active']);
DasunsUserNumberModel::where('userID',$row->userID)->update(['account_status'=>'verified']);
AccountStatusMessageModel::where('userID',$row->userID)
->update(['message'=>'Your account is approved.','status'=>'success']);

return redirect('/')->with('success','Service provider account has been verified.');

}else{
return redirect('/')->with('error','No content found.');
}
}





//get interview by user ID
static function get_interview_by_userID($id){
$get=PSSPInterviewScheduleModel::select(
'pssp_interview_schedule.id',
'pssp_interview_schedule.date',
'pssp_interview_schedule.time',
'pssp_interview_schedule.comment')

->join('dasuns_user_number','pssp_interview_schedule.applicationID','=','dasuns_user_number.id')
->where('dasuns_user_number.userID',$id)
->get();

if(count($get)>0){
foreach($get as $row){

return [

    'InterviewID'=>$row->id,
    'number'=>$row->number,
    'date'=>$row->date,
    'time'=>$row->time,
    'comment'=>$row->comment,
    'status'=>$row->status,
    'panelists'=>PanelistController::get_interview_panelist($row->id),

];

}

}else{

    return [];
}


}





//get declined interview by userID
static function get_declined_interview_by_userID($id){
$get=PSSPDeclinedInterviewModel::select('*')
->join('dasuns_user_number','pssp_declined_interview.interviewID','=','dasuns_user_number.id')
->where('dasuns_user_number.userID',$id)
->get();

return $get;

}






//interview rejection psot
public function store_interview_rejection(Request $request){
$request->validate(['comment_field'=>['required']],['required'=>'* Field is required.']);
PSSPInterviewRejectionModel::insert(['interviewID'=>$request->id,
'comment'=>$request->comment_field]);

$interview=InterviewController::get_interview_byID($request->id);
$dasuns=DasunsNumberController::get_dasuns_number_byID($interview->applicationID);
DasunsUserNumberModel::where('id',$dasuns->id)->update(['account_status'=>'failed']);
User::where('id',$dasuns->userID)->update(['status'=>'failed']);
PSSPInterviewScheduleModel::where('id',$request->id)->update(['status'=>'failed']);

return redirect('/')->with('success','Interview has been rejected.');

}




//get interview by id
static function get_interview_byID($id){
$get=PSSPInterviewScheduleModel::where('id',$id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return[];
}
}





//get interview by applicant ID
static function get_interview_by_applicantID($id){
$get=PSSPInterviewScheduleModel::where('applicationID',$id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
    return[];
}
}



//get user interview;
static function get_user_interview(){
$get=PSSPInterviewScheduleModel::where('service_providerID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}













}
