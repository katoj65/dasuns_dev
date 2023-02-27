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


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index(Request $request){
$search=$request->segment(2);
$data['title']='Search';

$services=SearchController::find_services($search);
$providers=SearchController::find_pssp($search);
$count=count($services)+count($providers);

$data['response']=[

'services'=>$services,
'providers'=>$providers,
'count_results'=>$count,
'search'=>$request->segment(2)

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
->where('users.id','!=',Auth::user()->id)

// ->orwhere('lastname','LIKE','%'.$search.'%')
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
    //
$request->validate(['search'=>['required','string']]);
if($request->search!=null){
return redirect('/search/'.$request->search);
}
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
}
