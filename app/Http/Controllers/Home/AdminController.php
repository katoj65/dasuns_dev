<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(){
//
$data['title']='Admin';
$data['response']=[


];
return Inertia::render('AdminsPage',$data);
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



//create admin
public function create_admins(Request $request){
$data['title']='Add new administrator';
$data['response']=[

];
return Inertia::render('CreateAdmins',$data);

}



//search admin
public function search_email(Request $request){
    $request->validate(['email'=>['required','email']],['required'=>'* Admin email address is required']);
    $get=User::where('email',$request->email)->where('id','!=',Auth::user()->id)->limit(1)->get();
    if(count($get)==1){
    foreach($get as $row);
    return redirect('/employee123');
    }else{
    return redirect('/admin-create');
    }
    }



//get employee for admin role
public function create_employee_role(Request $request){
$data['title']='Employee role';
$data['response']=[];

return Inertia::render('CreateAdmins',$data);

}












}
