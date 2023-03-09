<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeModel;
use App\Models\EmployeeRolesModel;
use Inertia\Inertia;
use App\Models\User;
use App\Models\UserRoleModel;
use App\Models\EmployeeProfileModel;

class EmployeeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
$data['title']='Employees';
$data['response']=[
'employee'=>User::where('role','dmin')->orwhere('role','panelist')->orwhere('role','finance')->orwhere('role','reception')->get(),


];

return Inertia::render('EmployeesPage',$data);


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
    public function show(Request $request)
    {
        //
$get=User::find($request->segment(2));
if($get!=null){
$profile=EmployeeProfileModel::select('*')
->join('country','employee_profile.countryID','=','country.id')
->where('employee_profile.userID',$request->segment(2))->get();
if(count($profile)==1){
foreach($profile as $row);
$prof=$row;
}else{
$prof=[];
}



$data['title']='Employee Information';
$data['response']=[
'employee'=>$get,
'roles'=>UserRoleModel::get(),
'profile'=>$prof,


];

return Inertia::render('ShowEmployeeDetailsPage',$data);

}else{
return redirect('/employees');
}


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
$request->validate(['role'=>['required']]);
$check=User::where('id',$request->id)->where('role',$request->role)->get();
if(count($check)!=1){



User::where('id',$request->id)->update(['role'=>$request->role]);
return redirect('/employee/'.$request->id)->with('success','Employee role has been updated.');
}else{
    return redirect('/employee/'.$request->id)->with('warning','Employee role was not changed.');
}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy(Request $request){
User::where('id',$request->id)->delete();
return redirect('/employees')->with('success','Employee has been deleted.');

}




//user employee status
function employee_status($id){
$get=EmployeeModel::where('userID',$id)->limit(1)->get();
if(count($get)==1){
$status=true;
}else{
$status=false;
}
return $status;
}




//employee profile
function get_employee_profile($id){
$get=EmployeeModel::where('userID',$id)->get();
if(count($get)==1){
foreach($get as $row);
    return $row;
}else{
    return null;
}
}





//employee description
function get_employee_role(){
$get=EmployeeRolesModel::where('name',Auth::user()->role)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return null;
}
}















}
