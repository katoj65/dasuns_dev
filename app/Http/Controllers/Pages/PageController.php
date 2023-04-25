<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TeamModel;
use App\Models\ImagesModel;
use App\Models\ContactModel;
use App\Models\SupportServiceModel;

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
$data['title']='Support Service Providers';
$data['response']=[];
return Inertia::render('ListServiceProviders',$data);

}




function how_it_works(){
$data['title']='How it works';
$data['response']=[
'images'=>ImagesModel::where('caption','training')->get(),

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
