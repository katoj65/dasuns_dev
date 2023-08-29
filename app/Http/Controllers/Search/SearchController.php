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
