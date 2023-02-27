<?php

namespace App\Http\Controllers\PSSU;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DasunsNumber\DasunsNumberController;
use App\Models\User;
use App\Models\UserSupportServiceModel;
use App\Models\UserDisabilityModel;
use App\Models\DasunsUserNumberModel;
use App\Models\OrganisationContactPersonModel;



class PSSUController extends Controller
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












//dashboard
static function dashboard(){
$id=Auth::user()->id;
return[
'dasuns_number'=>DasunsNumberController::get_dasuns_number_byUserID($id),
'service_provider_count'=>User::where('status','active')->where('role','pssp')->count(),
'recommendations'=>[],
'count_appointments'=>[],
'account_balance'=>null,
'appointments'=>[]

];


}


//service subscription
static function pssu_service_subscription($serviceID,$userID){
return UserSuppoortServiceModel::where('userID',$userID)->where('serviceID',$serviceID)->count()>0?true:false;
}






//profile
static function profile(){
$id=Auth::user()->id;

//
$user_service=UserSupportServiceModel::select('support_service.name','user_support_service.id')
->join('support_service','user_support_service.serviceID','=','support_service.id')
->where('user_support_service.userID',$id)
->get();

//
$disabilities=UserDisabilityModel::select('user_disability.id','disability.name')
->join('disability','user_disability.disabilityID','=','disability.id')
->where('user_disability.userID',$id)
->get();


return[
'services'=>$user_service,
'dasuns_number'=>PSSUController::get_dasuns_number(),
'disabilities'=>$disabilities,
'contact_person'=>PSSUController::get_contact_person(),




];
}






//delete disaility

public function delete_disability(Request $request){
UserDisabilityModel::where('id',$request->id)->delete();
return redirect('/profile')->with('success','Disabily has been deleted.');

}







//get passu dasuns number
static function get_dasuns_number(){
$get=DasunsUserNumberModel::select('number')->where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row->number;
}else{
    return null;
}

}



//add service
public function store_services(Request $request){
$request->validate(['service'=>'required'],['required'=>'* Field is required']);
$get=UserSupportServiceModel::where('serviceID',$request->service)->where('userID',Auth::user()->id)->limit(1)->get();
if(count($get)==0){
UserSupportServiceModel::insert(['serviceID'=>$request->service,'userID'=>Auth::user()->id]);
return redirect('/profile')->with('success','Service has been added.');

}else{
return redirect('/profile')->with('warning','Service already added.');
}

}



//add disability
public function store_disability(Request $request){
$request->validate(['disability'=>'required'],['required'=>'* Field is required.']);
$count=UserDisabilityModel::where('userID',Auth::user()->id)->where('disabilityID',$request->disability)->count();
if($count==0){
    UserDisabilityModel::insert(['userID'=>Auth::user()->id,'disabilityID'=>$request->disability]);
return redirect('/profile')->with('success','Disability has been added.');
}else{
return redirect('/profile')->with('warning','Disability already added.');
}

}





//get organisation contect person information
static function get_contact_person(){
$get=OrganisationContactPersonModel::where('organisationID',Auth::user()->id)->get();
if(count($get)>0){
foreach($get as $row);
    return $row;
}else{
    return [];
}
}




























}

