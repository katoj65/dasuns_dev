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
$user_data['get_pssp_services']=$this->get_registered_positions()];

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



//
$data['title']='Welcome';
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







    
$data['response']=['services'=>SupportServiceModel::get(),
'recommendation'=>DasunsRecommendationsModel::get()];
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





























}
