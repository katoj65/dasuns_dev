<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentModel;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\AppointmentServiceModel;
use App\Models\ServiceProviderServicesModel;
use App\Models\DasunsPaymentFeesModel;
use App\Models\DasunsCartModel;
use App\Models\AppointmentClockingModel;
use App\Http\Controllers\Wallet\DasunsWalletController;
use App\Models\DasunsWalletModel;
use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SupportServices\SupportServiceController;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\User;
use App\Models\PaymentModel;
use App\Http\Requests\PaymentRequest;




class AppointmentController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index(AppointmentModel $appointments)
{
$data['title']='Appointment';
$data['response']=[
'appointments'=>$appointments->my_accepted_appointments(),




];
return Inertia::render('AppointmentsPage',$data);
//
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

public function store(Request $request,DasunsWalletModel $wallet){

$request->validate([
'services'=>['required'],
'date'=>['required'],
'start'=>['required'],
'end'=>['required'],
'location'=>['required']],
['required'=>'* Required.']);
//
$date=explode('-',$request->date);
$date=join($date);
$end_date=explode('-',$request->end_date);
$end_date=join($end_date);
$curdate=date('Ymd');
//
if($date>=$curdate){
if($date<=$end_date or $end_date==null){

$appointment=new AppointmentModel;
AppointmentModel::insert([
'serviceID'=>$request->services,
'providerID'=>$request->psspID,
'userID'=>Auth::user()->id,
'date'=>$request->date,
'end_date'=>$request->end_date,
'from'=>$request->start,
'to'=>$request->end,
'location'=>$request->location,
'comment'=>$request->comment]);
$get=$appointment->get_created_appointment($request);

if(count($get)==1){
foreach($get as $row);
return redirect('/appointment-details/'.$row->id)->with('success','Appointment request sent.');
}else{
return redirect('/profile/'.$row->id.'/service-provider')->with('warning','Could not find appointment details.');
}


}else{
return redirect('/profile/'.$request->psspID.'/service-provider')->with('warning','Invalid dates');
}
}else{
return redirect('/profile/'.$request->psspID.'/service-provider')->with('warning','Invalid dates.');
}


}






//get payment fees based on ones country
static function get_payment_fees(){
$get=DasunsPaymentFeesModel::get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return null;
}
}

//wallet balance
static function wallet_balance(){
$get=DasunsWalletModel::where('userID',Auth::user()->id)->get();
if(count($get)==1){
foreach($get as $row);
return $row->amount;
}else{
return 0;
}
}







/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show(Request $request, AppointmentModel $appointment){
$get=$appointment->show($request->segment(2));
if(count($get)==1){
$user = new User;
$wallet=new DasunsWalletModel;
$balance=$wallet->my_balance();
$fees=new DasunsPaymentFeesModel;
$fee=$fees->service_fee();
$appointment=new AppointmentModel;
foreach($get as $row);
$days=$appointment->number_of_days($row->id);
$data['title']='Appointment';
$data['response']=[
'appointment'=>$row,
'services'=>$user->pssp_services($row->providerID),
'count_days'=>$days,
'dasuns_fees'=>number_format($fee),
'balance'=>number_format($balance),
'service_amount'=>number_format($appointment->service_amount($row->id)),
'amount_int'=>$appointment->service_amount($row->id)
];


return Inertia::render('ShowAppointment',$data);
}else{
return redirect('/')->with('error','No appointment details.');
}

}





//make payment
public function make_payment(Request $request,AppointmentModel $appointment){
$payment_request=new PaymentRequest;
$pay=$payment_request->pssu_pay_for_service($request,$appointment);
if($pay==true){
return redirect('/appointment-details/'.$request->id)->with('success','You have successfully paid.');
}else{
return  redirect('/appointment-details/'.$request->id)->with('warning','Your account balance is low.');
}
}




//cancelled appointment
public function cancel_appointment(Request $request, AppointmentModel $appointment){
$appointment->where('id',$request->id)->where('userID',Auth::user()->id)->update(['status'=>'cancelled']);
return redirect('/appointment-details/'.$request->id)->with('success','Appointment has been cancelled.');
}
















/*number of days in a month */
private function number_of_appointment_days($row){
$start_date=$row->date;
$end_date=$row->end_date!=null?$row->end_date:null;
//
$ed=explode('-',$end_date);
$sd=explode('-',$start_date);

if($end_date!=null){
//
$syy=$sd[0];
$smm=$sd[1];
$sdd=$sd[2];
//
$eyy=$ed[0];
$emm=$ed[1];
$edd=$ed[2];
//number of months
$months=$emm-$smm;
//number of days in first and last months.
$first_month=cal_days_in_month(CAL_GREGORIAN,$smm,$syy);
$last_month=cal_days_in_month(CAL_GREGORIAN,$emm,$eyy);
$s=date_create($start_date);
$e=date_create($end_date);
$date_diff=date_diff($s,$e);
$number_of_days=$date_diff->days+1;
}else{
$number_of_days=1;
}
return $number_of_days;
}




//format the clocking date for UI consumption.
private function format_clocking_dates($clocking){
if(count($clocking)>0){
foreach($clocking as $r){
$data[]=[
'dates'=>$r->date,
'key'=>'today',
'highlight'=>true
];
}
}else{
$data=[];
}
return $data;
}










/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, AppointmentModel $appointment)
{
//

$request->validate([
'services'=>['required'],
'date'=>['required'],
'start'=>['required'],
'end'=>['required'],
'location'=>['required']],
['required'=>'* Required.']);

$date=explode('-',$request->date);
$date=join($date);
$end_date=explode('-',$request->end_date);
$end_date=join($end_date);
$cdate=date('Y').'-'.date('m').'-'.date('d');
$curdate=explode('-',$cdate);
$curdate=join($curdate);
//
if($date>=$curdate){
if($date<=$end_date or ($date!=null and $end_date==null) ){
$get=$appointment->show($request->id);
foreach($get as $row);
//
if($row->date!=$request->date or
$row->end_date!=$request->end_date or
$row->location!=$request->location or
$row->comment!=$request->comment or
$row->from!=$request->start or
$row->to!=$request->end or
$row->serviceID!=$request->services
){

AppointmentModel::where('id',$request->id)->where('userID',Auth::user()->id)
->update([
'serviceID'=>$request->services,
'providerID'=>$request->psspID,
'date'=>$request->date,
'end_date'=>$request->end_date,
'from'=>$request->start,
'to'=>$request->end,
'location'=>$request->location,
'comment'=>$request->comment
]);

return redirect('/appointment-details/'.$request->id)->with('success','Appointment update.');
}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Appointment was not updated.');
}

}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Invalid dates');
}
}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Invalid dates');
}












}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy(Request $request)
{
//
AppointmentModel::where('id',$request->id)->delete();
return redirect('/')->with('success','Appointent has been deleted.');

}









//
public function add_services(Request $request){
$request->validate(['service'=>['required']],['required'=>'* Field is required.']);
$get=AppointmentServiceModel::where('appointmentID',$request->id)->where('serviceID',$request->service)->get();

if(count($get)==0){
AppointmentServiceModel::insert(['appointmentID'=>$request->id,'serviceID'=>$request->service]);
return redirect('/appointment-details/'.$request->id)->with('success','Service has been added to the appointment.');

}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Service is already added to your list.');
}
}




//
public function delete_service(Request $request){
AppointmentServiceModel::where('id',$request->id)->delete();
return redirect('/appointment-details/'.$request->appointmentID)->with('success','Service has been deleted.');
return $request;
}

//

function countryPaymentAmount($countryID){
$get=DasunsPaymentFeesModel::where('countryID',$countryID)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return [];
}
}




//dasuns cart
public function add_cart(Request $request){
$id=Auth::user()->id;
$get=DasunsCartModel::where('itemID',$request->id)
->where('amount',$request->amount)
->where('userID',$id)
->where('currency',$request->currency)
->where('days',$request->num_days)
 ->orderby('created_at','DESC')
->limit(1)
->get();
if(count($get)==0){

    //

DasunsCartModel::insert([
'itemID'=>$request->id,
'amount'=>$request->amount,
'userID'=>$id,
'currency'=>$request->currency,
'days'=>$request->num_days
]);


//

$get=DasunsCartModel::where('itemID',$request->id)
->where('amount',$request->amount)
->where('userID',$id)
->where('currency',$request->currency)
->where('days',$request->num_days)
 ->orderby('created_at','DESC')
->limit(1)
->get();
if(count($get)==1){
foreach($get as $row);
return redirect('/cart/'.$row->id)->with('success','Item has been added to cart.');
}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Item is already added to cart.');
}


}else{
return redirect('/appointment-details/'.$request->id)->with('warning','Item is already added to cart.');
}

}









//add work days
public function add_appointment_work_days(Request $request){
//Appointment information
$dates=$this->get_appointment_dates($request->id);
$sd=date_create($dates->date);
$start=date_format($sd,'Ymd');
$ed=date_create($dates->end_date);
$end=date_format($ed,'Ymd');
$r_date=date_create($request->date);
$request_date=date_format($r_date,'Ymd');

if($request_date>=$start and $request_date<=$end){

//Clocking information
$get=AppointmentClockingModel::where('appointmentID',$request->id)
->where('date',$request->date)->limit(1)->get();
$date=date_create($request->date);
if(count($get)==1){
AppointmentClockingModel::where('appointmentID',$request->id)->where('date',$request->date)->delete();
return redirect('/appointment-details/'.$request->id)->with('error',date_format($date,'d/m/Y').' has been removed from list.');
}else{
AppointmentClockingModel::insert(['appointmentID'=>$request->id,'date'=>$request->date]);
return redirect('/appointment-details/'.$request->id)->with('notice',date_format($date,'d/m/Y').' has been added to the list.');
}


}else{
    return redirect('/appointment-details/'.$request->id)->with('error','Selected date is not within your range.');
}


}









//
private function check_cart_item($id){
$count=count(DasunsCartModel::where('itemID',$id)->where('userID',Auth::user()->id)->get());;
return $count==1?true:false;
}


//remove item from cart
public function remove_from_cart(Request $request){
DasunsCartModel::where('itemID',$request->id)->delete();
return redirect('/appointment-details/'.$request->id)->with('success','Item has been deleted from cart.');
}




//get appointment date
private function get_appointment_dates($id){
$get=AppointmentModel::select('date','end_date')->where('id',$id)->get();
if(count($get)==1){
foreach($get as $row);
return $row;
}else{
return[];
}
}





//expired appointments
static function appointment_expired(){
$current_date=date('y-m-d');
$get=AppointmentModel::where('date','>=',$current_date)->where('status')->get();
}



//get all appointments
static function get_appointement($id=null){
if($id!=''){
$get=AppointmentModel::where('id',$id)->get();
}else{
$get=AppointmentModel::get();
}
return $get;
}






//show appointment
public function showAppointment(Request $request, AppointmentModel $appointment){
$payment=new PaymentModel;
$data=[];
$get=$appointment->my_appointment_details($request);
if(count($get)>0){
foreach($get as $row){
$content[]=[

'payment'=>number_format($payment->cost_of_service($row->id)),
'location'=>$row->location,
'from'=>$row->from,
'to'=>$row->to,
'firstname'=>$row->firstname,
'lastname'=>$row->lastname,
'status'=>$row->status,
'id'=>$row->id,
'date'=>$row->date,
'end_date'=>$row->end_date,
'number'=>$row->number,
'tel'=>$row->tel,
'email'=>$row->email,
'service'=>AppointmentServiceModel::select('support_service.name')
->join('support_service','appointment_service.serviceID','=','support_service.id')
->where('appointmentID',$row->id)
->limit(1)
->get(),

];

}
}


if(count($get)==0){
return redirect('/')->with('warning','could not find content');
}

$data['title']='Appointment';
$data['response']=[
'appointment'=>$content];
return Inertia::render('ShowAppointmentPage',$data);
}





//update appointment option
public function update_appointment_status(Request $request){
$request->validate(['option'=>['required']]);
AppointmentModel::where('id',$request->id)->update(['status'=>$request->option]);
return redirect('/appointment/'.$request->id)->with('success','Appointment is '.$request->option);


}




















}
