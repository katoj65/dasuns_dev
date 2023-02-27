<?php

namespace App\Http\Controllers\Vetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DasunsUserNumberModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\ServiceProviderExperienceModel;
use App\Models\ServiceProviderReferenceModel;
use App\Models\PSSPInterviewScheduleModel;
use App\Models\User;
use App\Models\PanelistProfessionProfileModel;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Models\InterviewPanelistModel;
use App\Http\Controllers\Interview\InterviewController;
use App\Http\Controllers\Authorisation\AuthorisationController;
use App\Models\PSSPDeclinedInterviewModel;

class VettingController extends Controller
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

//get panelist information

function panelist_information(){
$get=User::select('users.firstname','users.lastname','id')
->where('users.role','panelist')
->where('users.status','active')
->get();
if(count($get)>0){
foreach($get as $row){
$data[]=[
'user'=>$row,
'profession'=>PanelistProfessionProfileModel::select('employee_profession.name','panelist_profession_profile.id')
->join('employee_profession','panelist_profession_profile.professionID','=','employee_profession.id')
->where('panelist_profession_profile.userID',$row->id)
->get(),

];
}
}else{
$data=[];
}

return $data;

}






//previe application
public function preview_application(Request $request){
$access=AuthorisationController::authorise_access(['reception']);
if($access==true){
$application=DasunsUserNumberModel::select('users.firstname',
'users.lastname',
'users.id',
'users.gender',
'users.email',
'users.tel',
'dasuns_user_number.number',
'users.dob',
'service_provider_profile.location',
'service_provider_profile.profile_picture',
'country.name as country',
'dasuns_user_number.created_at as application_date',
'dasuns_user_number.id as did',
'dasuns_user_number.account_status as status',
'users.status as user_status'
)
->join('users','dasuns_user_number.userID','=','users.id')
->join('service_provider_profile','users.id','=','service_provider_profile.userID')
->join('country','service_provider_profile.countryID','=','country.id')
->where('dasuns_user_number.id',$request->segment(2))
->where('users.role','pssp')
->get();

if(count($application)>0){
foreach($application as $row);

//services applied for.
$get_services=ServiceProviderServicesModel::select('*')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('userID',$row->id)
->get();


//panelists


$data['title']='preview';
$data['response']=[
'application'=>$row,
'services'=>$get_services,
'document'=>ServiceProviderSecurityDetailsModel::where('userID',$row->id)->get(),
'experience'=>ServiceProviderExperienceModel::where('userID',$row->id)->get(),
'reference'=>ServiceProviderReferenceModel::where('userID',$row->id)->get(),
'panelist'=>$this->panelist_information(),
'decline_status'=>InterviewController::get_interview_decline($request->segment(2)),
'pssp_rejection'=>[],



];

return Inertia::render('ApplicationPreview',$data);
}else{
return redirect('/dashboard');
}
}else{
    return redirect('/');
}
}







//schedule interview
public function create_interview_schedule(Request $request){
$request->validate([
'date'=>['required','date'],
'time'=>['required','time'],
'type'=>['required'],
'selected'=>['required']],
['required'=>' *Field is required.']);

PSSPInterviewScheduleModel::insert([
'date'=>$request->date,
'time'=>$request->time,
'type'=>$request->type,
'comment'=>$request->comment,
'applicationID'=>$request->id
]);

//
DasunsUserNumberModel::where('id',$request->id)
->update(['account_status'=>'interview']);

//user status at interview
$userID=DasunsNumberController::get_dasuns_number_byID($request->id)->userID;
User::where('id',$userID)->update(['status'=>'interview']);
PSSPDeclinedInterviewModel::where('interviewID',$request->id)->delete();
//get interview details
$get=PSSPInterviewScheduleModel::where('applicationID',$request->id)->where('date',$request->date)->where('time',$request->time)->get();

//

if(count($get)==1){
foreach($get as $item);
foreach($request->selected as $s){
InterviewPanelistModel::insert(['userID'=>$s,'interviewID'=>$item->id]);
}
}

return redirect('/')->with('success','Interview has been scheduled.');

}

























}
