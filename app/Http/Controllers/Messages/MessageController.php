<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\ChatModel;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
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
public function show(Request $request, User $user)
{
//
$user_details=$user->show($request->segment(2));
if($user!=null){
$messages=[];
$chat=new ChatModel;
$message=$chat->user_messages($user_details->id);
if(count($message)>0){
foreach($message as $row){
$messages[]=[
'id'=>$row->id,
'message'=>$row->message,
'senderID'=>$row->senderID,
'receiverID'=>$row->receiverID,
'created_at'=>$row->created_at,
'sender_details'=>$chat->sender($row->senderID),
'myID'=>Auth::user()->id,

];
}
}





$data['title']='Messages';
$data['response']=[
'message'=>$messages,
'user'=>$user_details,
'number'=>$user->show_dasuns_number($user_details->id),
'current_user'=>Auth::user()->id

];

return Inertia::render('MessagePage',$data);
}else{
return redirect('/')->with('error','Could not find user messages.');
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
