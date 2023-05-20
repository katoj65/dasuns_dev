<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLogModel;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
ActivityLogModel::where('userID',Auth::user()->id)->where('status','pending')->update(['status'=>'seen']);
$data['title']='Notifications';
$data['response']=[
'notification'=>ActivityLogModel::where('userID',Auth::user()->id)->orderby('created_at','DESC')->get(),


];
return Inertia::render('NotificationPage',$data);


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


//notification indicator

static function notification_indicator(){
return ActivityLogModel::where('userID',Auth::user()->id)->where('status','pending')->count();
}


//update status to seen from pending
public function update_status(){
ActivityLogModel::where('userID',Auth::user()->id)->where('status','pending')->update(['status'=>'seen']);
return null;
}





}
