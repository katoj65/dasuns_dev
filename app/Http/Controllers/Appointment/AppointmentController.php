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




class AppointmentController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
$data['title']='Appointment';
$data['response']=[
'appointments'=>AppointmentModel::select('appointment.date',
'appointment.end_date',
'appointment.from',
'appointment.to',
'support_service.name',
'appointment.status',
'appointment.location',
'appointment.comment',
'users.firstname',
'users.lastname',
'users.email',
'users.tel')
->join('appointment_service','appointment.id','=','appointment_service.appointmentID')
->join('support_service','appointment_service.serviceID','=','support_service.ID')
->join('users','appointment.providerID','=','users.id')
->where('appointment.userID',Auth::user()->id)
->where('appointment.status','accepted')
->orwhere('appointment.status','pending')
->orderby('appointment.status','ASC')
->orderby('appointment.date','DESC')
->get()




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
$balance=$wallet->my_balance();
$fees=new DasunsPaymentFeesModel;
$fee=$fees->service_fee();
$appointment=new AppointmentModel;

//
AppointmentModel::insert([
'serviceID'=>$request->services,
'providerID'=>$request->psspID,
'userID'=>Auth::user()->id,
'date'=>$request->date,
'end_date'=>$request->end_date,
'from'=>$request->start,
'to'=>$request->end,
'location'=>$request->location,
'comment'=>$request->comment
]);

//
$get=$appointment->get_created_appointment($request);
if(count($get)==1){
foreach($get as $row);
return redirect('/appointment-details/'.$row->id)->with('success','Appointment request sent.');
}else{
return redirect('/profile/'.$row->id.'/service-provider')->with('warning','Could not find appointment details.');
}








// //dates
// $x=explode("-",$request->date);
// $dt=$x[0].$x[1].$x[2];
// if($dt>date('Ymd')){

// //payment details.
// $service_payments=AppointmentController::get_payment_fees();
// $amount=$service_payments->amount;
// $charges=$service_payments->charges;
// //Wallet balance
// $wallet_balance=AppointmentController::wallet_balance();
// //changes plus wallet
// $actual_charge=$amount+$charges;

// if($wallet_balance>=$actual_charge){

// //
// AppointmentModel::insert([
// 'providerID'=>$request->psspID,
// 'userID'=>Auth::user()->id,
// 'date'=>$request->date,
// 'end_date'=>$request->end_date,
// 'from'=>$request->start,
// 'to'=>$request->end,
// 'location'=>$request->location,
// 'comment'=>$request->comment
// ]);




// //

// $get=AppointmentModel::where('providerID',$request->psspID)
// ->where('userID',Auth::user()->id)
// ->where('date',$request->date)
// ->where('from',$request->start)
// ->where('to',$request->end)
// ->orderby('created_at','DESC')
// ->limit(1)
// ->get();



// //
// if(count($get)==1){
// foreach($get as $row);

// AppointmentServiceModel::insert([
// 'serviceID'=>$request->services,
// 'appointmentID'=>$row->id]);



// //create activity content
// $names=UserController::userbyID($request->psspID);
// $service=SupportServiceController::support_servicebyID($request->services);
// ActivityController::store_activity(['userID'=>Auth::user()->id,
// 'title'=>'Service Request',
// 'description'=>$service->name.' service
// from
// '.$names->firstname.'
// '.$names->lastname.'
// , Tel: '.$names->tel.'.']);


// //transfer funds to dasuns account
// WalletController::make_service_payment($row->id);

// return redirect('/appointment-details/'.$row->id)->with('success','Appointment request sent.');
// }else{
// return redirect('/service-provider/'.$request->psspID)->with('warning','Could not.');
// }


// }else{
// return redirect('/service-provider/'.$request->psspID)->with('warning','You do not have enough money in your wallet to make an appointment. Please recharge your wallet.');
// }

// }else{
// return redirect('/service-provider/'.$request->psspID)->with('warning','You seleted a date that has passed.');
// }

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
public function show(Request $request, AppointmentModel $appointment)
{
$get=$appointment->show($request->segment(2));
if(count($get)==1){
$user = new User;
foreach($get as $row);
$data['title']='Appointment';
$data['response']=[
'appointment'=>$row,
'services'=>$user->pssp_services($row->providerID),


];





return Inertia::render('ShowAppointment',$data);

}else{
    return redirect('/')->with('error','No appointment details.');
}






//
// $get=AppointmentModel::select('users.firstname',
// 'users.lastname',
// 'users.gender',
// 'users.tel',
// 'users.email',
// 'users.created_at as joined',
// 'appointment.id',
// 'appointment.date',
// 'appointment.from',
// 'appointment.to',
// 'appointment.location',
// 'appointment.comment',
// 'dasuns_user_number.number',
// 'users.id',
// 'appointment.id as appointmentID',
// 'country.name as country',
// 'service_provider_profile.about',
// 'country.id as countryID',
// 'appointment.end_date')
// //
// ->join('users','appointment.providerID','=','users.id')
// ->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
// ->join('service_provider_profile','appointment.providerID','=','service_provider_profile.userID')
// ->join('country','service_provider_profile.countryID','=','country.id')
// ->where('appointment.id',$request->segment(2))->get();

// //

// if(count($get)==1){
// foreach($get as $row);

// //

// $services=AppointmentServiceModel::select('support_service.name','appointment_service.id')
// ->join('support_service','appointment_service.serviceID','=','support_service.id')
// ->where('appointment_service.appointmentID',$request->segment(2))
// ->get();


// //
// $pssp_services=ServiceProviderServicesModel::select('*')
// ->join('support_service','service_provider_services.serviceID','=','support_service.id')
// ->where('service_provider_services.userID',$row->id)
// ->get();

// //
// $amount=$this->countryPaymentAmount($row->countryID);
// //

// $clocking=AppointmentClockingModel::where('appointmentID',$request->segment(2))->orderby('date','ASC')->get();
// if(count($clocking)>0){
// foreach($clocking as $c){
// $clock[]=[
// 'date'=>$c->date
// ];
// }
// }else{
// $clock=[];
// }



// //get number of days for the appointment
// if(count($clocking)==0){
// $num_days=$this->number_of_appointment_days($row);
// }else{
// $num_days=count($clocking);
// }


// //calculate the amount to be paid.
// $amount_paid=$num_days*$amount->amount;

// //

// $data['title']='Appointment';
// $data['response']=[
// 'appointment'=>$row,
// 'services'=>$services,
// 'pssp_services'=>$pssp_services,
// 'amount'=>number_format($amount->amount),
// 'currency'=>$amount->name,
// 'amount_original'=>$amount_paid,
// 'clocking'=>$clocking,
// 'number_of_days'=>$num_days,
// 'total_amount'=>number_format($amount_paid),
// 'clocking_date_format'=>$this->format_clocking_dates($clocking),
// 'cart_status'=>$this->check_cart_item($row->appointmentID),


// ];

// return Inertia::render('ShowAppointment',$data);

// }else{
//     return redirect('/');
// }

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










// //dates
// $x=explode("-",$request->date);
// $dt=$x[0].$x[1].$x[2];
// $ed=explode("-",$request->end_date);
// $end_date_format=$ed[0].$ed[1].$ed[2];

// //
// if($dt<$end_date_format){

// $get=AppointmentModel::where('id',$request->id)->get();
// if(count($get)==1){
// foreach($get as $row);

// //

// if($request->date!=$row->date or $request->start!=$row->from or $request->end!=$row->to or $request->location!=$row->location or $request->comment!=$row->comment or $request->end_date!=$row->end_date){

// //
// AppointmentModel::where('id',$request->id)
// ->update(['date'=>$request->date,
// 'end_date'=>$request->end_date,
// 'from'=>$request->start,
// 'to'=>$request->end,
// 'comment'=>$request->comment,
// 'location'=>$request->location]);



// return redirect('/appointment-details/'.$request->id)->with('success','Appointment has been updated.');


// }else{
// return redirect('/appointment-details/'.$request->id)->with('warning','Appointment was not updated.');
// }


// }else{
// return redirect('/appointment-details/'.$request->id);
// }
// }else{
// return redirect('/appointment-details/'.$request->id)->with('warning','You seleted a date that has passed.');
// }








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
public function showAppointment(Request $request){

$data=[];
$get=AppointmentModel::
select('users.firstname',
'users.lastname',
'appointment.status',
'appointment.id',
'appointment.date',
'appointment.end_date',
'dasuns_user_number.number',
'users.tel',
'users.email')
->join('users','appointment.providerID','=','users.id')
->join('dasuns_user_number','users.id','=','dasuns_user_number.userID')
->where('appointment.id',$request->segment(2))
->get();
if(count($get)>0){
foreach($get as $row){
$content[]=[
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
