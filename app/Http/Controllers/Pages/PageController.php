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
use App\Http\Controllers\Role\RoleController;
use App\Models\SectionModel;


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
$get_service=ServiceProviderServicesModel::select('support_service.id','support_service.name','support_service.icon')->where('userID',$row->id)
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
'article'=>SectionModel::where('tag','what we do')->orderby('created_at','ASC')->get(),


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
    'about'=>SectionModel::where('tag','about')->orderby('created_at','ASC')->get(),



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



//service provider list
public function show_all_services(Request $request){
$get=SupportServiceModel::where('support_service.id',$request->segment(2))
->get();
$service=[];
//get all services

if(count($get)>0){
foreach($get as $row);
$service=[
'id'=>$row->id,
'name'=>$row->name,
'icon'=>$row->icon
];

}


$data['title']='profession services';
$data['response']=[
'service'=>$service,
'providers'=>ServiceProviderServicesModel::join('users','service_provider_services.userID','=','users.id')
->where('service_provider_services.serviceID',$request->segment(2))
->get(),

];
return Inertia::render('ListServicesPage',$data);

}



//section
public function sections(Request $request){
$permission=RoleController::permission(['admin']);
if($permission!=null){
$data['title']='Sections';
$data['response']=[
'section'=>SectionModel::orderby('tag','ASC')->get(),
'pages'=>SectionModel::select('tag')->distinct()->get(),



];


return Inertia::render('SectionPage',$data);

}else{
return redirect('/');
}

}


//add section
public function store_section(Request $request){
$request->validate(['description'=>['required'],'page'=>['required']]);
SectionModel::insert(['title'=>$request->title,
'description'=>$request->description,
'tag'=>$request->page]);
return redirect('/sections')->with('success','Section has been added.');
}








//uodate section
public function update_section(Request $request){
$request->validate(['description'=>['required'],'page'=>['required']]);
$section=SectionModel::where('id',$request->id)->limit(1)->get();
if(count($section)==1){
foreach($section as $row);
//
if($row->title==$request->title and $row->description==$request->description and $row->tag==$request->page){
return redirect('/sections')->with('warning','Content was not changed.');
}else{
SectionModel::where('id',$request->id)->update([
'title'=>$request->title,
'description'=>$request->description,
'tag'=>$request->page
]);
return redirect('/sections')->with('success','Section has been updated.');
}


}else{
return redirect('/');
}
}







//destroy section
public function destroy_section(Request $request){
SectionModel::where('id',$request->id)->delete();
return redirect('/sections')->with('success','Content has been deleted.');
}









}
