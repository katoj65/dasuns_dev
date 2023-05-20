<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UsersModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\SupportServiceModel;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
$get=UsersModel::select('users.firstname','users.lastname','users.gender','users.email',
'dasuns_user_number.number','users.id')
->where('users.role','pssp')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('users.status','active')
->get();
$pssp=[];
if(count($get)>0){
foreach($get as $row){
$pssp[]=[
'id'=>$row->id,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'email'=>$row->email,
'gender'=>$row->gender,
'number'=>$row->number,
'service'=>ServiceProviderController::provider_service($row->id),



];

}
}








$data['title']='Service Providers';
$data['response']=[
'pssp'=>$pssp,
'services'=>SupportServiceModel::get(),


];
return Inertia::render('ServiceProvidersPage',$data);






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

//service provider list
public function service_provider_list(Request $request){
$data['title']='Service Providers';
$data['response']=[];
return Inertia::render('ServiceProviderListPage',$data);
}




//get service
static function provider_service($uid){
$get=ServiceProviderServicesModel::select('support_service.name')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$uid)
->limit(1)
->get();
$row=[];
if(count($get)>0){
foreach($get as $row);
$row=$row;
}
return $row;
}

















}
