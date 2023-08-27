<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
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
return $get;
}

//
public function search_by_dasuns_number($number,$search){
$number=$number->select('users.firstname','users.lastname','users.gender','users.tel','users.email','dasuns_user_number.number')
->join('users','dasuns_user_number.userID','=','users.id')
->where('users.role','pssp')
->where('dasuns_user_number.number','LIKE','%'.$search.'%')
->get();
return $number;
}

//
public function search_by_support_service($service,$search){
$service=$service->select('*')
->where('support_service.name','LIKE','%'.$search.'%')
->get();
return $service;
}




}
