<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfileModel;
use App\Models\UserSupportServiceModel;
use App\Models\UserDisabilityModel;
use Inertia\Inertia;
use App\Models\OrganisationProfileModel;
use App\Models\OrganisationContactPersonModel;
use App\Models\ServiceProviderProfileModel;
use App\Models\ServiceProviderServicesModel;
use App\Http\Controllers\Documents\DocumentsController;
use App\Models\ServiceProviderReferenceModel;
use App\Models\ServiceProviderSecurityDetailsModel;
use App\Models\SupportServiceModel;
use App\Models\User;
use App\Models\AdminRolesModel;
use App\Models\EmployeeModel;
use App\Models\DisabilityModel;
use App\Models\ServiceProviderExperienceModel;
use App\Http\Controllers\Employee\EmployeeController;
use App\Models\DasunsNumberModel;
use App\Models\DasunsUserNumberModel;
use App\Http\Controllers\Panelist\PanelistController;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Http\Controllers\PSSU\PSSUController;
use App\Http\Controllers\Reception\ReceptionController;
use App\Models\CountryModel;
use App\Http\Controllers\PSSP\PSSPController;
use App\Http\Controllers\Administration\AdministrationController;
use App\Models\AccountStatusMessageModel;



class ProfileController extends Controller{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */


//check uploaded documents
function get_pssp_additional_requirements(){
$identification=ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->get();
$reference=ServiceProviderReferenceModel::where('userID',Auth::user()->id)->get();
return['identification'=>$identification,'reference'=>$reference];
}


//get institutional profile details
function get_institution_profile(){
$get=OrganisationProfileModel::
select('institution_type.name','organisation_profile.location','country.name as country')
->join('institution_type','organisation_profile.institution_typeID','=','institution_type.id')
->join('country','organisation_profile.countryID','=','country.id')
->where('organisation_profile.userID',Auth::user()
->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}

}







//index method
public function index(){

//create dasuns number

$list=SupportServiceModel::get();
$user=Auth::user();

if($user->role=='pssp'){
//PSSPController::interview_status();
$docs=new DocumentsController;
$user_data=[
'security_documents'=>$docs->get_security_documents(),
'reference'=>ServiceProviderReferenceModel::where('userID',$user->id)->get(),
'identification'=>ServiceProviderSecurityDetailsModel::where('userID',$user->id)->get(),
'requirements'=>$this->get_pssp_additional_requirements(),
'list_services'=>$list,
'experience'=>ServiceProviderExperienceModel::where('userID',$user->id)->get(),
'interview_status'=>PSSPController::get_interview_status(),
'account_status_message'=>PSSPController::account_status_message(),
// 'interview'=>PSSPController::interview_scheduled(),
];

}elseif($user->role=='panelist'){

$user_data=[
'profile'=>PanelistController::profile(),
];

}elseif($user->role=='pssu'){

$user_data=[
'list_services'=>$list,
'list_disabilities'=>DisabilityModel::get(),
'profile'=>PSSUController::profile()
];









}elseif($user->role=='reception'){
$user_data['profile']=ReceptionController::reception_profile();
$user_data['country']=CountryModel::get();





}elseif($user->role=='admin'){

 $user_data['profile']=AdministrationController::profile();

}




else{

$user_data=['list_services'=>$list,
'list_disabilities'=>DisabilityModel::get(),
'institutional_contact_person'=>Auth::user()->account_type?OrganisationContactPersonModel::where('organisationID',Auth::user()->id)->get():null,
'organisation_profile'=>Auth::user()->account_type=='institutional'?$this->get_institution_profile():null,


];


}





//
$data['title']='Profile';
$data['response']=[
'user'=>$user,
'profile'=>$user->role=='pssu'?$this->user_profile():$this->profile_PSSP(),

'services'=>$user->role=='pssu'?UserSupportServiceModel::select('user_support_service.id','support_service.name','support_service.id as sid')
->join('support_service','user_support_service.serviceID','=','support_service.id')
->where('user_support_service.userID',$user->id)
->get():ServiceProviderServicesModel::select('service_provider_services.id','support_service.name','support_service.id as sid')
->join('support_service','service_provider_services.serviceID','=','support_service.id')
->where('service_provider_services.userID',$user->id)
->get(),

'disabilities'=>Auth::user()->account_type=='personal'?UserDisabilityModel::select('*')->where('user_disability.userID',$user->id)->join('disability','user_disability.disabilityID','=','disability.id')
->get():[],
'user_data'=>$user_data,



];

return Inertia::render('ProfilePage',$data);

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


//create user profile
public function create_pssu_profile(Request $request){
$request->validate([
'serviceID'=>['required'],
'location'=>['required'],
'disability_status'=>['required'],
'countryID'=>['required']],['required'=>'* Field is required.']);

//
$id=Auth::user()->id;
UserProfileModel::insert(
['userID'=>$id,
'location'=>$request->location,
'countryID'=>$request->countryID,
'disability'=>$request->disability_status]);

//PSSU array
foreach($request->serviceID as $service){
UserSupportServiceModel::insert(['userID'=>$id,'serviceID'=>$service]);
}

//disability
if($request->disabilityID!=""){
foreach($request->disabilityID as $d){
UserDisabilityModel::insert(['userID'=>$id,'disabilityID'=>$d]);
}
}




//create a dasuns user number
$dn=DasunsNumberController::create_dasuns_user_number();
DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>$dn,
'role'=>Auth::user()->role,
'account_status'=>'verified'
]);

//



User::where('id',Auth::user()->id)->update(['status'=>'active']);


return redirect()->route('profile');
}





//create institution profile
public function create_institution_profile(Request $request){
    $request->validate([
        'serviceID'=>['required'],
        'typeID'=>['required'],
        'location'=>['required'],
        'countryID'=>['required'],
        'firstname'=>['required'],
        'lastname'=>['required'],
        'gender'=>['required'],
        'email'=>['required'],
        'tel'=>['required'],
        'position'=>['required']
        ],['required'=>'* Field is required.']);
        $id=Auth::user()->id;
        OrganisationProfileModel::insert([
        'userID'=>$id,
        'institution_typeID'=>$request->typeID,
        'location'=>$request->location,
        'countryID'=>$request->countryID]);
        foreach($request->serviceID as $sid){
        UserSupportServiceModel::insert(['userID'=>$id,'serviceID'=>$sid]);
        }
        OrganisationContactPersonModel::insert([
        'organisationID'=>$id,
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'gender'=>$request->gender,
        'role'=>$request->position,
        'email'=>$request->email,
        'tel'=>$request->tel,
        ]);



//create a dasuns user number
$dn=DasunsNumberController::create_dasuns_user_number();
DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>$dn,
'role'=>Auth::user()->role,
'account_status'=>'verified'
]);

//
User::where('id',Auth::user()->id)->update(['status'=>'active']);




        return redirect()->route('profile');
        }




//
public function create_institution_profiles(Request $request){
return $request;
}






//user profile
function user_profile(){
$get=OrganisationProfileModel::select(
'country.name as country',
'organisation_profile.location',
'institution_type.name as institution',
'organisation_contact_person.firstname',
'organisation_contact_person.lastname',
'organisation_contact_person.tel',
'organisation_contact_person.email',
'organisation_contact_person.role')
->where('organisation_profile.userID',Auth::user()->id)
->join('organisation_contact_person','organisation_profile.userID','=','organisation_contact_person.organisationID')
->join('institution_type','organisation_profile.institution_typeID','=','institution_type.id')
->join('country','organisation_profile.countryID','=','country.id')
->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return  [];
}

}




//service provider profile
function profile_PSSP(){
$user=Auth::user();
$get=ServiceProviderProfileModel::select('country.name as country',
'service_provider_profile.location',
'service_provider_profile.location',
'service_provider_profile.vet_status',
'service_provider_profile.about')
->where('service_provider_profile.userID',$user->id)
->join('country','service_provider_profile.countryID','=','country.id')
->get();
if(count($get)>0){
foreach($get as $row);
return $row;
}else{
return [];
}
}





//personal user profile
function get_personal_account_profile(){
$user=Auth::user();
$get=UserProfileModel::select('user_profile.location',
'user_profile.disability',
'user_profile.photo',
'country.name as country')
->join('country','user_profile.countryID','=','country.id')
->where('user_profile.userID',$user->id)
->get();
if(count($get)>0){
foreach($get as $row);
return $row;
}else{
return[];
}

}








//create PSSP profile
public function create_profile_pssp(Request $request){
// $application=new ApplicationController;
$request->validate([
'serviceID'=>['required'],
'location'=>['required'],
'countryID'=>['required']
],['required'=>'* Field is required.']);

ServiceProviderProfileModel::insert(['userID'=>Auth::user()->id,
'location'=>$request->location,
'countryID'=>$request->countryID]);

foreach($request->serviceID as $s){
ServiceProviderServicesModel::insert(['userID'=>Auth::user()->id,'serviceID'=>$s]);
}

//generate dasuns number
$dn=DasunsNumberController::create_dasuns_user_number();

//add dasuns user number
DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>$dn,
'role'=>Auth::user()->role,
'account_status'=>'pending'
]);

// User::where('id',Auth::user()->id)->update(['status'=>'active']);

return redirect('/profile')->with('success','Profile has been created successfully.');

}










//create references
public function create_PSSP_reference(Request $request){
$request->validate([
'names'=>['required'],
'position'=>['required'],
'email'=>['required','email'],
'tel'=>['required'],
'address'=>['required']],['required'=>'* Field is required.']);
ServiceProviderReferenceModel::insert([
'userID'=>Auth::user()->id,
'names'=>$request->names,
'position'=>$request->position,
'email'=>$request->email,
'tel'=>$request->tel,
'address'=>$request->address
]);
return redirect('/profile')->with('success','Your profession reference has been added.');
}




//create PSSP Security documents
public function create_PSSP_identification_document(Request $request){
$request->validate([
'document'=>['required'],
'number'=>['required']
],['required'=>'* Field is required.']);
ServiceProviderSecurityDetailsModel::insert([
'userID'=>Auth::user()->id,'document'=>$request->document,
'document_number'=>$request->number,
'file'=>'null']);
return redirect('/profile')->with('success','Your document has been uploaded.');
}


//delete PSSP references.
public function delete_PSSP_reference(Request $request){
ServiceProviderReferenceModel::where('id',$request->id)->where('userID',Auth::user()->id)->delete();
return redirect()->route('profile');
}


//delete PSSP document
public function delete_PSSP_identification_document(Request $request){
ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)
->where('id',$request->id)
->delete();
return redirect()->route('profile');
}




//delete PSSP services
public function delete_PSSP_services(Request $request){
if(Auth::user()->account_type=='pssp'){
ServiceProviderServicesModel::where('userID',Auth::user()->id)
->where('service_provider_services.id',$request->id)
->delete();
return redirect('/profile')->with('success','Service has been deleted.');
}elseif(Auth::user()->account_type=='pssu'){
return('hello');
}
}












//create PSSP service
public function create_PSSP_service(Request $request){
$request->validate([
'service'=>['required']
],['required'=>'* Field is required.']);

$auth=Auth::user();
if($auth->role=='pssp'){
//PSSP
$get=ServiceProviderServicesModel::where('userID',Auth::user()->id)
->where('serviceID',$request->service)->get();
if(count($get)==0){
ServiceProviderServicesModel::insert([
'userID'=>Auth::user()->id,
'serviceID'=>$request->service
]);

return redirect('/profile')->with('success','Profession service has been added.');
}else{
    return redirect('/profile')->with('warning','Profession service is already added.');
}

}elseif($auth->role=='pssu'){
//PSSU
$get1=UserSupportServiceModel::where('userID',$auth->id)
->where('serviceID',$request->service)->limit(1)->get();
if(count($get1)==0){
UserSupportServiceModel::insert(['userID'=>$auth->id,'serviceID'=>$request->service]);
return redirect('/profile')->with('success','Service has been added.');
}else{
return redirect('/profile')->with('warning','Service is already added on your list.');
}
}
}




//admin check
// function admin_status(){
// $get=
// }




//create admins
public function create_admins(Request $request){
$admin=$this->get_admin($request->segment(2));
if($admin!=null){

$employee=new EmployeeController;
$status=$employee->employee_status($request->segment(2));
$data['title']='Add new administrator';
$data['response']=[

'admin'=>$admin,
'roles'=>AdminRolesModel::get(),
'status'=>$status,
'emplyee_profile'=>$status==true?$employee->get_employee_profile($request->segment(2)):null
];

return Inertia::render('CreateAdmins',$data)->with('warning',$status==true?'Employee is an administrator.':null);
}else{
return redirect('/employee')->with('warning','Could not find information.');
}


}




//
public function search_email(Request $request){
$request->validate(['email'=>['required','email']],['required'=>'* Admin email address is required']);
$get=User::where('email',$request->email)->where('id','!=',Auth::user()->id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return redirect('/employee/'.$row->id)->with('warning',count(EmployeeModel::where('userID',$row->id)->get())==1?'User is already an administrator.':null);
}else{
return redirect('/employee')->with('error','Could not find user with  '.$request->email. ' email address.');
}
}







//show admins
public function show_admins(Request $request){
$data['title']='Add new administrator';
$data['response']=[
'employee'=>EmployeeModel::orderby('firstname','ASC')->get(),];
return Inertia::render('AdminsPage',$data);

}




//get admin information
function get_admin($id){
$get=User::where('id',$id)->limit(1)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return null;
}
}





//create role
function store_admin_role(Request $request){
$request->validate([
'tel2'=>['required'],
'role'=>['required'],
'address'=>['required'],
'title'=>['required'],
'email2'=>['required']],['required'=>'* Field is required.']);
$get=EmployeeModel::where('userID',$request->userID)->get();
if(count($get)==0){
EmployeeModel::insert([
'userID'=>$request->userID,
'firstname'=>$request->firstname,
'lastname'=>$request->lastname,
'gender'=>$request->gender,
'dob'=>$request->dob,
'tel'=>$request->tel,
'email'=>$request->email,
'role'=>$request->role,
'business_tel'=>$request->tel2,
'business_email'=>$request->email2,
'address'=>$request->address,
'title'=>$request->title
]);
User::where('id',$request->userID)->update(['role'=>$request->role]);
return redirect('/employee')->with('success','Administrator has been added.');
}else{
 return redirect('/employee')->with('warning',ucfirst($request->firstname).' '.ucfirst($request->lastname).' is already an administrator.');
}
}





//delete admin role
public function delete_admin_role(Request $request){
$request->validate(['id'=>['required']]);
$get=EmployeeModel::where('id',$request->id)->get();
if(count($get)==1){
foreach($get as $row);
EmployeeModel::where('id',$request->id)->delete();
User::where('id',$row->userID)->update(['role'=>'pssu']);
}
return redirect('/employee')->with('success','Administrator has been deleted.');

}



//delete services
public function delete_services(Request $request){
$user=Auth::user();
if($user->role=='pssu'){
UserSupportServiceModel::where('id',$request->id)
->where('userID',$user->id)
->delete();
}elseif($user->role=='pssp'){
ServiceProviderServicesModel::where('id',$request->id)
->where('userID',$user->id)
->delete();
}
return redirect('/profile')->with('success','Service has been deleted.');
}




//delete disability
public function delete_disabilities(Request $request){
$user=Auth::user();
UserDisabilityModel::where('disabilityID',$request->id)
->delete();
return redirect('/profile')->with('success','Disabilty has been deleted.');
}



//select pssu disability
public function submit_pssu_disabilities(Request $request){
$request->validate(['disabilityID'=>['required']],['required'=>'* Field is required.']);
$get=UserDisabilityModel::where('userID',Auth::user()->id)->where('disabilityID',$request->disabilityID)->get();
if(count($get)==0){
UserDisabilityModel::insert(['userID'=>Auth::user()->id,'disabilityID'=>$request->disabilityID]);
return redirect('/profile')->with('success','Disability has been added.');
}else{
return redirect('/profile')->with('warning','Disability is already on your list.');
}


}



//create pssp experience
public function store_pssp_experience(Request $request){
$request->validate([
'organisation'=>['required'],
'position'=>['required'],
'from'=>['required'],
'to'=>['required']],
['required'=>'* Field is required.']);
ServiceProviderExperienceModel::insert([
'userID'=>Auth::user()->id,
'organisation_name'=>$request->organisation,
'position'=>$request->position,
'from_date'=>$request->from,
'to_date'=>$request->to
]);
return redirect('/profile')->with('success','Experince has been added');
}





//delete PSSP Work experience
public function delete_PSSP_work_experience(Request $request){
ServiceProviderExperienceModel::where('userID',Auth::user()->id)->where('id',$request->id)->delete();
return redirect('/profile')->with('success','Experience information has been deleted.');
}







//create application number
function create_application_number(){
if(count(DasunsUserNumberModel::where('userID',Auth::user()->id)->get())==0){

$get=count(User::where('role',Auth::user()->role)->get());
$dasuns=DasunsNumberModel::get();
if(count($dasuns)==1){
foreach($dasuns as $row);
$sum=$get+1;
$num=Auth::user()->role=='pssp'?$row->service_provider_number:$row->service_user_number;
$count_num=strlen($num);
$count_sum=strlen($sum);
$substr=$count_num-$count_sum;
$get_first_number=substr($num,0,$substr);
$actual_num=$get_first_number.strval($sum);

$experience=count(ServiceProviderExperienceModel::where('userID',Auth::user()->id)->get());
$security=count(ServiceProviderSecurityDetailsModel::where('userID',Auth::user()->id)->get());
$references=count(ServiceProviderReferenceModel::where('userID',Auth::user()->id)->get());


if(Auth::user()->role=='pssp' and $experience!=0 and $security!=0 and $references!=0){

DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>Auth::user()->role=='pssp'?$actual_num.'P':$actual_num.'U',
'role'=>Auth::user()->role,
'account_status'=>Auth::user()->role=='pssp'?'pending':'verified'
]);


}elseif(Auth::user()->role=='pssu'){

DasunsUserNumberModel::insert([
'userID'=>Auth::user()->id,
'number'=>Auth::user()->role=='pssp'?$actual_num.'P':$actual_num.'U',
'role'=>Auth::user()->role,
'account_status'=>Auth::user()->role=='pssp'?'pending':'verified'
]);

}

// return Auth::user()->role=='pssp'?$actual_num.'P':$actual_num.'U';

}else{
return null;
}

}
}







//get user dasuns number
function get_user_dasuns_number(){
if(Auth::user()!=''){
$get=DasunsUserNumberModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}
}else{
return null;
}
}






//check if all pssp attributes are filled;
function check_if_pssp_attributes_are_filled(){
$id=Auth::user()->id;
$reference=count(ServiceProviderReferenceModel::where('userID',$id)->get());
$documents=count(ServiceProviderSecurityDetailsModel::where('userID',$id)->get());
$experience=count(ServiceProviderExperienceModel::where('userID',$id)->get());
return [$reference,$documents,$experience];
}





//delete organisation contact person information
public function delete_organisation_contact_person(Request $request){
$request->validate(['id'=>['required']]);
OrganisationContactPersonModel::where('id',$request->id)->delete();
return redirect('/profile')->with('success','Organisation contact person has been deleted.');
}






//add organisation contact person
public function add_organisation_contact_person(Request $request){
$request->validate([
'firstname'=>['required'],
'lastname'=>['required'],
'gender'=>['required'],
'tel'=>['required'],
'email'=>['required'],
'role'=>['required']
],['required'=>'* Field is required.']);

OrganisationContactPersonModel::insert([
    'organisationID'=>Auth::user()->id,
    'firstname'=>$request->firstname,
    'lastname'=>$request->lastname,
    'gender'=>$request->gender,
    'tel'=>$request->tel,
    'email'=>$request->email,
    'role'=>$request->role

    ]);

return redirect('/profile')->with('success','Organisation contact person has been added.');
}











}
