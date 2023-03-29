<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\AppointmentModel;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(){
        //

$data['title']='Requests';
if(Auth::user()->role=='pssp'){
$data['response']=[
'pending_appointments'=>AppointmentModel::select('users.firstname','users.lastname','users.tel','appointment.date','appointment.end_date','appointment.from','appointment.to','appointment.id')
->join('users','appointment.userID','=','users.id')
->where('appointment.providerID',Auth::user()->id)
->where('appointment.status','pending')
->orderby('date','DESC')->get(),

'accepted_appointments'=>AppointmentModel::where('providerID',Auth::user()->id)->where('status','accepted')->orderby('date','DESC')->get(),


];


}else{
$data['response']=[];
}

return Inertia::render('RequestPage',$data);


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
}
