<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SupportServiceModel;
use App\Models\User;
use App\Models\ServiceProviderServicesModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSupportServiceModel;
use App\Http\Requests\SearchRequest;
use App\Models\DasunsUserNumberModel;
use App\Models\ServiceProviderProfileModel;




class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index(Request $request, SearchRequest $search_request){
$user=new User;
$number=new DasunsUserNumberModel;
$service=new SupportServiceModel;
$location=new ServiceProviderProfileModel;
$search=$request->segment(2);
$data['title']='search';
$data['response']=[
'search'=>$search,
'pssp'=>$search_request->search_by_names($user, $search),
'number'=>$search_request->search_by_dasuns_number($number,$search),
];

return Inertia::render('SearchPage',$data);

}








/**
 * Service favorites
 */








/**
 *Search for services
 */

static function find_services($search){
$role=Auth::user()->role;
$favorites=false;
$get=SupportServiceModel::where('name','LIKE','%'.$search.'%')->orderby('name','ASC')->get();

if(count($get)>0){

foreach($get as $row){
//
if($role=='pssu'){
$favorites=UserSupportServiceModel::where('serviceID',$row->id)
->where('userID',Auth::user()->id)->count()>0?true:false;
}


//

$data[]=[
'name'=>$row->name,
'icon'=>$row->icon,
'id'=>$row->id,
'count_pssp'=>ServiceProviderServicesModel::join('support_service','service_provider_services.serviceID','=','support_service.id')->join('users','service_provider_services.userID','=','users.id')
->where('users.role','pssp')->where('users.status','active')->where('service_provider_services.serviceID',$row->id)->count(),
'favorites'=>$favorites,




];








}

}else{
$data=[];
}
return $data;
}

/**
 * user searvice provisers
 */

static function find_pssp($search){
$get=User::select('users.firstname',
'users.lastname',
'dasuns_user_number.number',
'users.gender',
'users.tel',
'users.email',
'users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('users.role','pssp')
->where('users.status','active')
->where('users.firstname','LIKE','%'.$search.'%')
->get();

if(count($get)>0){
foreach($get as $row){
$data[]=[

'id'=>$row->id,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'gender'=>$row->gender,
'number'=>$row->number,
'services'=>ServiceProviderServicesModel::where('userID',$row->id)->count(),
'email'=>$row->email,
'tel'=>$row->tel,

];

}
return $data;
}else{

$get=User::select('users.firstname',
'users.lastname',
'dasuns_user_number.number',
'users.gender',
'users.tel',
'users.email',
'users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('users.role','pssp')
->where('users.status','active')
->where('dasuns_user_number.number',$search)
->get();
if(count($get)==1){
return $get;
}else{
return [];
}
// if(count($get)==1){
// foreach($get as $row){
// $data[]=[
// 'id'=>$row->id,
// 'firstname'=>$row->firstname,
// 'lastname'=>$row->lastname,
// 'gender'=>$row->gender,
// 'number'=>$row->number,
// 'services'=>ServiceProviderServicesModel::where('userID',$row->id)->count(),
// 'email'=>$row->email,
// 'tel'=>$row->tel,
// ];

// }

// }else{
//     return [];
// }




}






}



















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request){
$request->validate(['search'=>'required']);
$search=$request->search;
return redirect('/search/'.$search);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    //

$get=SupportServiceModel::where('id',$request->segment(3))->get();
if(count($get)==1){
foreach($get as $row);

$data['title']='Show';
$data['response']=[
'service'=>$row,
'count_results'=>1,
'search'=>$row->name,
'providers'=>ServiceProviderServicesModel::select('users.firstname','users.lastname','users.gender')
->join('users','service_provider_services.userID','=','users.id')
->where('service_provider_services.serviceID',$row->id)
->get(),




];

return Inertia::render('SearchResults',$data);

}else{
    return redirect('/search/'.$request->segment(2));
}
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




//advanced filter
public function advanced_search(Request $request,ServiceProviderProfileModel $search){
$results=[];
$services=new ServiceProviderServicesModel;
$service=$request->segment(2);
$location=$request->segment(3);
$get=$search->select('users.firstname',
'users.lastname',
'dasuns_user_number.number',
'users.id','users.gender',
'service_provider_profile.location')
->join('users','service_provider_profile.userID','=','users.id')
->join('service_provider_services','users.id','=','service_provider_services.userID')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('service_provider_services.serviceID',$service)
->where('service_provider_profile.location','LIKE','%'.$location.'%')
->limit(20)
->get();
//search formation
if(count($get)>0){
foreach($get as $row){
$results[]=[
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'number'=>$row->number,
'id'=>$row->id,
'gender'=>$row->gender,
'location'=>$row->location,
'services'=>$services->count_pssp_services($row->id)
];

}
}

$data['title']='advanced search';
$data['response']=[
'pssp'=>$results,

];

return Inertia::render('SearchAdvancedPage',$data);
}














}
