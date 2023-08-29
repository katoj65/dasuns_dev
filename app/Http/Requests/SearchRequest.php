<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ServiceProviderServicesModel;
class SearchRequest extends FormRequest

{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
       //
        ];
    }



//search by names, dasuns number or support service name.

public function search_by_names($user, $search){
$data=[];
$services=new ServiceProviderServicesModel;
$get=$user->select('users.firstname',
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
    'number'=>$row->number,
    'services'=>$services->count_pssp_services($row->id)
    ];
    }

    }







return $data;
}




//
public function search_by_dasuns_number($number,$search){
$services=new ServiceProviderServicesModel;
$data=[];
$number=$number->select(
'users.id',
'users.firstname',
'users.lastname',
'users.gender',
'users.tel',
'users.email',
'dasuns_user_number.number')
->join('users','dasuns_user_number.userID','=','users.id')
->where('users.role','pssp')
->where('users.status','active')
->where('dasuns_user_number.number','LIKE','%'.$search.'%')
->get();
if(count($number)>0){
foreach($number as $row){
$data[]=[
'id'=>$row->id,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'number'=>$row->number,
'services'=>$services->count_pssp_services($row->id)
];
}

}

return $data;
}





//
public function search_by_support_service($service,$search){
$service=$service->select('*')
->where('support_service.name','LIKE','%'.$search.'%')
->get();
return $service;
}




//
public function search_by_location($location,$search){
$services=new ServiceProviderServicesModel;
$data=[];
$get=$location->select('users.id',
'users.firstname',
'users.lastname',
'dasuns_user_number.number',
'country.name as country',
'service_provider_profile.location')
->join('users','service_provider_profile.userID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->join('country','service_provider_profile.countryID','=','country.id')
->where('users.role','pssp')
->where('users.status','active')
->where('service_provider_profile.location','LIKE','%'.$search.'%')
->get();

if(count($get)>0){
foreach($get as $row){
$data[]=[
'id'=>$row->id,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'number'=>$row->number,
'services'=>$services->count_pssp_services($row->id)
];
}
}



return $data;
}














}
