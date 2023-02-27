<?php

namespace App\Http\Controllers\PSSP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PSSPApplicationModel;
use Illuminate\Support\Facades\Auth;
use App\Models\DasunsNumberModel;
use App\Http\Controllers\Profile\ProfileController;

class ApplicationController extends Controller
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


//get PSSP application.
function get_applications(){
return PSSPApplicationModel::get();
}

//get PSSP pending application
function get_pending_applications(){
return PSSPApplicationModel::where('status','pending')->get();
}

//get PSSP pending application
function get_approved_applications(){
return PSSPApplicationModel::where('status','approved')->get();
}


//create pssp application
function store_application(){
$profile=new ProfileController;
if(PSSPApplicationModel::insert(['userID'=>Auth::user()->id,'applicationID'=>$profile->create_application_number()])){
return true;
}else{
return false;
}
}


//generate application number
function get_application_number(){
$get=DasunsNumberModel::get();
if(count($get)>0){
foreach($get as $row);
return $row;
}else{
return [];
}
}








}
