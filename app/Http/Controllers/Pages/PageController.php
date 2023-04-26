<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TeamModel;
use App\Models\ImagesModel;
use App\Models\ContactModel;
use App\Models\SupportServiceModel;
use App\Models\User;
use App\Models\ServiceProviderServicesModel;

class PageController extends Controller
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

//


function support_services(){
$data['title']='Support Service';
$data['response']=[
'services'=>SupportServiceModel::get(),
];
return Inertia::render('ListServices',$data);

}




function support_services_providers(){
$pssp=[];
$service=[];
$get_pssp=User::where('users.role','pssp')->where('users.status','active')->get();
if(count($get_pssp)>0){
foreach($get_pssp as $row){

//services
$get_service=ServiceProviderServicesModel::select('support_service.name','support_service.icon')->where('userID',$row->id)
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->limit(1)
->get();
if(count($get_service)==1){
foreach($get_service as $row1){
$service=$row1;
}
}



//main content
$pssp[]=[
'names'=>$row->firstname.' '.$row->lastname,
'email'=>$row->email,
'service'=>$service,

];







}
}





$data['title']='Support Service Providers';
$data['response']=[
'pssp'=>$pssp,
];
return Inertia::render('ListServiceProviders',$data);

}




function how_it_works(){
$data['title']='How it works';
$data['response']=[
'images'=>ImagesModel::where('caption','training')->get(),
'pic5'=>ImagesModel::where('caption','pic5')->get(),
'pic6'=>ImagesModel::where('caption','pic6')->get(),


];
return Inertia::render('InstructionsPage',$data);
}




function contact(){
$data['title']='Contact Us';
$data['response']=[];
return Inertia::render('ContactPage',$data);
}



function about(){

    $data['title']='About Us';
    $data['response']=[
        'team'=>TeamModel::get(),



    ];
    return Inertia::render('AboutPage',$data);
    }



//send contact message
public function store_contact(Request $request){
$request->validate([
'names'=>['required'],
'email'=>['required','email'],
'tel'=>['required'],
'message'=>['required']],['required'=>'* Field is required.']);
ContactModel::insert(['names'=>$request->names,'email'=>$request->email,'tel'=>$request->tel,'message'=>$request->message]);
return redirect('/contact')->with('success','Our team will get back to you shortly. ');

}












}
