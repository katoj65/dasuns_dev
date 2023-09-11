<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\ServiceProviderEducationModel;
use App\Models\ServiceProviderExperienceModel;
use App\Models\ServiceProviderReferenceModel;


class ApprovalController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index(User $user)
{
//
$get=$user->select('users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.status',
'users.email',
'users.id',
'dasuns_user_number.number',
'users.status')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('users.status','pending')
->get();

$query=[];
if(count($get)>0){
$documents_model=new ServiceProviderSecurityDetailsModel;
$service_model=new ServiceProviderServicesModel;
$education_model=new ServiceProviderEducationModel;
$experience_model=new ServiceProviderExperienceModel;
$reference_model=new ServiceProviderReferenceModel;

foreach($get as $row){
$docs=$documents_model->where('userID',$row->id)->count();
$services=$service_model->where('userID',$row->id)->count();
$education=$education_model->where('userID',$row->id)->count();
$experience=$experience_model->where('userID',$row->id)->count();
$reference=$reference_model->where('userID',$row->id)->count();

$query[]=[
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'tel'=>$row->tel,
'email'=>$row->email,
'gender'=>$row->gender,
'number'=>$row->number,
'documents'=>$docs>0?'yes':'no',
'services'=>$services,
'education'=>$education>0?'yes':'no',
'experience'=>$experience>0?'yes':'no',
'recommendation'=>$reference>0?'yes':'no',
'status'=>$row->status,
'id'=>$row->id,

];
}
}





$data['title']='Approval';
$data['response']=[
'user'=>$query



];
return Inertia::render('ApprovalPage',$data);
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
public function update(Request $request,User $user)
{
//
$request->validate(['status'=>'required'],['required'=>'Field is required.']);
$collection=$user->find($request->id);
$collection->status=$request->status;
$collection->save();
$status=$collection->wasChanged();
if($status==true){
return redirect('/approvals')->with('success','Status was changed.');
}else{
return redirect('/approvals')->with('warning','Status was not changed.');
}



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
}
