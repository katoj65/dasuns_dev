<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\SupportServiceModel;
use App\Models\DasunsRecommendationsModel;
use App\Models\CountryModel;
use App\Models\DisabilityModel;
use App\Models\InstitutionTypeModel;
use App\Models\User;
use App\Models\ServiceProviderServicesModel;
use App\Http\Controllers\PSSP\PSSPController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Reception\ReceptionController;
use App\Http\Controllers\Panelist\PanelistController;
use App\Http\Controllers\PSSU\PSSUController;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\TestimonialModel;
use App\Models\PartnerModel;
use App\Models\AppointmentModel;
use App\Models\AppointmentServiceModel;
use App\Models\LogWalletModel;
use App\Models\DasunsWalletModel;
use App\Models\PSSPInterviewScheduleModel;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request){
//
if(Auth::user()!=null){
WalletController::new_user_wallet();

//role
$role=Auth::user()->role;
$user_data=[];

//pssu account
if($role=='pssu'){
$user_data=['dashboard'=>PSSUController::dashboard()];
}

//pssp account
elseif($role=='pssp'){
$pssp=new PSSPController;
$user_data['pssp_attributes']=PSSPController::dashboard();
$user_data['number']=null;
}

//admin account

elseif($role=='admin'){
$user_data['statistics']=[
'count_user'=>count(User::get()),
'count_PSSP'=>count(User::where('role','pssp')->get()),
'count_admin'=>count(User::where('role','!=','pssu')->where('role','!=','pssp')->get()),
'count_services'=>count(SupportServiceModel::get()),
$user_data['get_pssp_services']=$this->get_registered_positions(),
];

$user_data['appointments']=HomeController::admin_appointment_formation();
$user_data['transactions']=LogWalletModel::select('*')->get();
$user_data['wallet']=number_format(DasunsWalletModel::select('amount')->sum('amount'));

$user_data['counts']=[
'pssp'=>number_format(DasunsWalletModel::select('amount')->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','pssp')->sum('amount')),
'pssu'=>number_format(DasunsWalletModel::select('amount')->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','pssu')->sum('amount')),
'other'=>number_format(DasunsWalletModel::select('amount')->join('users','dasuns_wallet.userID','=','users.id')
->where('users.role','!=','pssu')
->where('users.role','!=','pssp')
->sum('amount'))];


$user_data['interview']=[
'all'=>PSSPInterviewScheduleModel::count(),
'success'=>PSSPInterviewScheduleModel::where('status','accepted')->count(),
'fail'=>PSSPInterviewScheduleModel::where('status','failed')->count(),
'latest'=>PSSPInterviewScheduleModel::select('dasuns_user_number.number','pssp_interview_schedule.date',
'pssp_interview_schedule.id',
'pssp_interview_schedule.status')
->join('dasuns_user_number','pssp_interview_schedule.service_providerID','=','dasuns_user_number.userID')
->orderby('pssp_interview_schedule.date','DESC')
->limit(10)
->get()];
$user_data['services']=SupportServiceModel::get();
$user_data['transactions']=LogWalletModel::orderby('created_at','DESC')->limit(5)->get();





}

//reception account
elseif($role=='reception'){
$reception_controller=new ReceptionController;
$user_data=$reception_controller->dashboard();
}

//finance
elseif($role=='finance'){
$user_data=[];
}

//panelist
elseif($role=='panelist'){
$user_data=['dashboard'=>PanelistController::dashboard()];
}

//else side
else{
$user_data=[];
}



//service formation
$service=SupportServiceModel::get();
if(count($service)>0){
foreach($service as $s){
$sv[]=['value'=>$s->id,'text'=>$s->name];
}
}
else{
$sv=[];
}



//disability information
$disabilities=DisabilityModel::get();
if(count($disabilities)>0){
foreach($disabilities as $d){
$ds[]=['value'=>$d->id,'text'=>$d->name];
}
}else{
$ds=[];
}



//welcome page details.

$data['title']='Welcome';
$data['profile']=ProfileController::get_user_profile_information();
$data['response']=[
'services'=>$sv,
'country'=>CountryModel::get(),
'disability'=>$ds,
'institution_type'=>InstitutionTypeModel::get(),
'user_data'=>$user_data,
];

//
return Inertia::render('Dashboard',$data);

}else{




//user not logged in
$services=[];
$get=SupportServiceModel::get();
if(count($get)>0){
foreach($get as $row){
$service[]=[
'id'=>$row->id,
'name'=>$row->name,
'icon'=>$row->icon,
'providers'=>ServiceProviderServicesModel::where('serviceID',$row->id)->count(),

];
}
}





//welcome page
$data['response']=['services'=>$service,

'recommendation'=>TestimonialModel::get(),
'partner'=>PartnerModel::get()



];
return Inertia::render('Welcome',$data);

}
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

//how it works
public function how_it_works(Request $request){
$data['title']='How it works';
$data['response']=[];
return Inertia::render('HowItWorksPage',$data);

}





//registerd positions
function get_registered_positions(){
$get=SupportServiceModel::get();
if(count($get)>0){
foreach($get as $row){
$count=count(ServiceProviderServicesModel::where('serviceID',$row->id)->get());
$data[]=[
'id'=>$row->id,
'service'=>ucwords($row->name),
'providers'=>$count>1?$count.' Service Providers':$count.' Service Provider'
];
}
return $data;
}else{
return [];
}


}





//admin appointment request formation
static function admin_appointment_formation(){
$data=[];
$get=AppointmentModel::
select('users.firstname',
'users.lastname',
'appointment.status',
'appointment.id',
'appointment.date',
'appointment.end_date')
->join('users','appointment.providerID','=','users.id')
// ->orderby('appointment.status','DESC')
->orderby('appointment.date','DESC')
->get();
if(count($get)>0){
foreach($get as $row){
$data[]=[
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'status'=>$row->status,
'id'=>$row->id,
'date'=>$row->date,
'end_date'=>$row->end_date,
'service'=>AppointmentServiceModel::select('support_service.name')
->join('support_service','appointment_service.serviceID','=','support_service.id')
->where('appointmentID',$row->id)
->limit(1)
->get(),
];

}
}

return $data;

}






























}
