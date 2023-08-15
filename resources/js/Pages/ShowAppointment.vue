<template>
<app-layout>

<div class="row mt-4">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">

<div class="card">
<div class="card-header bold" v-if="appointment.status=='pending'" style="background:#D5F5E3;">
<div style="color:green;">
You can now make payment for the service requested.
</div>
</div>

<div class="card-header bg-danger-dim bold text-danger" v-if="appointment.status=='cancelled'">
<div style="color:red;">
Appointment was cancelled.
</div>
</div>




<div class="card-header">
<div class="card-title bold">
Appointment
</div>


<div class="card-options">


<el-button-group class="ml-3" v-if="appointment.status=='pending'">
<el-button type="success" @click="show=true">Edit</el-button>
<el-button type="danger" @click="delete_appoointment(appointment.id)">Delete</el-button>
</el-button-group>
<el-button-group class="ml-3" v-else-if="appointment.status!='cancelled'">
<el-button type="danger" @click="cancel_appointment(appointment.id)">Cancel</el-button>
</el-button-group>

</div>



</div>

<div class="card-body">





<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Appointment Start Date</div>
<div class="data-value">{{ appointment.date.split('-').reverse().join('/') }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">End Date</div>
<div class="data-value">{{ appointment.end_date!=null?appointment.end_date.split('-').reverse().join('/'):'-' }}</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Service Requested</div>
<div class="data-value">{{ appointment.service }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Time </div>
<div class="data-value"><span class="mr-3">{{ appointment.from.substring(0,5) }}</span> - <span class="ml-3">{{ appointment.to.substring(0,5) }}</span> </div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Number of Days </div>
<div class="data-value text-transform">{{ response.count_days>1?response.count_days+' Days':response.count_days+' Day' }} </div>
</div>
</li>



<li class="data-item">
    <div class="data-col">
    <div class="data-label">Amount to be paid </div>
    <div class="data-value text-transform">Sh. {{ response.service_amount }} </div>
    </div>
    </li>





<li class="data-item">
<div class="data-col">
<div class="data-label">Location</div>
<div class="data-value text-transform">{{ appointment.location }} </div>
</div>
</li>







<li class="data-item">
<div class="data-col">
<div class="data-label">Comment </div>
<div class="data-value text-transform">{{ appointment.comment }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Service Provider Names </div>
<div class="data-value text-transform">{{ appointment.firstname }} {{ appointment.lastname }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Service Number </div>
<div class="data-value text-transform">{{ appointment.number}}  </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number</div>
<div class="data-value">{{ appointment.tel }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address </div>
<div class="data-value">{{ appointment.email }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">{{ appointment.gender }} </div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth </div>
<div class="data-value">{{ appointment.dob.split('-').reverse().join('/') }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Request Created On </div>
<div class="data-value">{{ appointment.created_at.substring(0,7).split('-').reverse().join('/')  }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Status</div>
<div class="data-value text-transform">
<button type="button" class="btn button bold " style="font-size:16px;" v-if="appointment.status=='pending'" @click="show2=true">
Make Payment
</button>
<span v-else> {{ appointment.status=='payment'?'Make payment':appointment.status }}</span>
</div>
</div>
</li>


</ul>








</div>

</div>

</div>
<div class="col-12 col-md-2"></div>
</div>

























<!--------Edit----------->
<form @submit.prevent="submit"    class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="show==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Make Appointment</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">


<div class="mb-2" style="font-size:16px;font-weight:bold;">

<el-alert :title="flash.warning" type="error" v-if="flash.warning!=null">
</el-alert>





</div>

<div class="form-group">
<label class="form-label" for="default-07">Select Services
<input-error :error="errors.services"></input-error>
</label>
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<select class="custom-select form-control" id="default-07" @change=" select_service($event)">
<!-- <option value="">--Select--</option> -->
<option  v-for="i in old_service" :key="i.id" :value="i.id">
{{ i.name }}
</option>
<option  v-for="n in new_service" :key="n.id" :value="n.id">
{{ n.name }}
</option>
</select>
</div>
</div>
</div>





<div class="row mb-3">
<div class="col-12 col-md-6">

<div class="form-group">
<label class="form-label" for="default-01">
<!-- {{ dialog.change_label }} -->
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.date">
</div>
</div>


</div>
<div class="col-12 col-md-6">



    <div class="form-group" v-if="change_field==true">
        <label class="form-label" for="default-01">
        <input-error></input-error>
        </label>

        <div class="form-control-wrap">
        <div class="form-icon form-icon-right">
        <a href="#" class="text-warning pl-3 pr-3 text-danger" @click="end_date(false)">
        <em class="icon ni ni-cross" style="font-weight:bold;color:red;"></em>
        </a>
        </div>
        <input type="date" class="form-control" id="default-04" placeholder="End date" v-model="form.end_date">
        </div>
        </div>




        <div class="form-group" v-else>
        <label class="form-label text-center" for="default-01">
        <!-- <a href="#" class="text-warning pl-3" @click="end_date(true)">Select end date</a> -->
        </label>
        <div class="form-control-wrap">
        <!-- <input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" disabled> -->


    <button  @click="end_date(true)" class="form-control" id="default-01">
     Select end date
    </button>

        </div>
        </div>









</div>
</div>

<div class="row mb-3">
<div class="col-md-6 col-12">

<div class="form-group">
<label class="form-label" for="default-01">From Time
<input-error :error="errors.start"></input-error>
</label>
<div class="form-control-wrap">
<input type="time" class="form-control" id="default-01" placeholder="Enter start time" v-model="form.start">
</div>
</div>

</div>
<div class="col-12 col-md-6">
<div class="form-group">
<label class="form-label" for="default-01"> To Time
<input-error :error="errors.end"></input-error>
</label>
<div class="form-control-wrap">
<input type="time" class="form-control" id="default-01" placeholder="Enter end time" v-model="form.end">
</div>
</div>

</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">Location
<input-error :error="errors.location"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter appointment location" v-model="form.location">
</div>
</div>

<div class="form-group mt-2">
<label class="form-label" for="default-01">Message</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter message" v-model="form.comment">
</div>
</div>
</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<span class="text-danger text-center" v-if="flash.warning!=null" style="padding-right:70px;">
{{ flash.warning }}
</span>
<input type="submit" class="button" value="Make appointment" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>
















<!--------Make Paymennt Here-->
<form class=""  v-if="show2==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit2">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Make Payment</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show2=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">


<div class="row">
<div class="col-5 py-1"><strong>Appointment date:</strong></div>
<div class="col-7 py-1">{{ appointment.date.split('-').reverse().join('/') }} -  {{ appointment.end_date!=null?appointment.end_date.split('-').reverse().join('/'):'-' }}</div>


<div class="col-5 py-1"><strong>Service provder names:</strong></div>
<div class="col-7 py-1 text-transform">{{ appointment.firstname }} {{ appointment.lastname }}  </div>

<div class="col-5 py-1"><strong>Service Number:</strong></div>
<div class="col-7 py-1">{{ appointment.number }} </div>


<div class="col-5 py-1"><strong>Number of days booked:</strong></div>
<div class="col-7 py-1">{{response.count_days>1?response.count_days+'':response.count_days+''}} </div>


<div class="col-5 py-1"><strong>Amount to be paid:</strong></div>
<div class="col-7 py-1">Shs. {{ response.service_amount}} </div>


<div class="col-5 py-1"><strong>Service cost per day:</strong></div>
<div class="col-7 py-1">Shs. {{response.dasuns_fees }} </div>

<div class="col-5 py-1"><strong>Account balance:</strong></div>
<div class="col-7 py-1">Shs. {{response.balance }} </div>

</div>







<div class="form-group mt-3">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="number" class="form-control" id="default-01" placeholder="Enter amount to be paid" v-model="form2.amount" disabled>
</div>
</div>




</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<input type="submit" class="button" value="Pay Now" style="border-radius:10px"/>

</span>
</div>
</div>
</div>
</form>



</app-layout>
</template>
<script>
import InputError from '@/Alerts/InputError';
import AppLayout from '@/Layouts/AppLayout';
import SelectableCalendar from '@/Components/SelectableCalendar';
import CalendarMarked from '@/Components/CalendarMarked';
export default {
components:{
AppLayout,
InputError,
SelectableCalendar,
CalendarMarked
},
props:{
title:{},
response:{},
flash:{},
errors:{},
},

data(){return{
//
show:false,
show2:false,
change_field:false,
//
old_service:[],
new_service:[],

form:this.$inertia.form({
date:null,
end_date:null,
start:null,
end:null,
services:null,
psspID:this.response.appointment.providerID,
comment:null,
location:null,
id:this.response.appointment.id
}),
form2:this.$inertia.form({
amount:this.response.amount_int,
psspID:this.response.appointment.providerID,
id:this.response.appointment.id,
}),

//
end_date(status){
if(status==true){
this.change_field=true;

}else{
this.change_field=false;
this.form.end_date=null;
}
}











}},


//
methods:{
submit2(){
this.form2.post(this.route('appointment.pay'),{
onSuccess:()=>{
this.show2=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Low Balance',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});
},


select_service(event){
this.form.services=event.target.value;
},

//
submit(){
this.form.post(this.route('update.appointment'),{
onSuccess:()=>{
this.show=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});
},






//
delete_service(id){
this.$inertia.post(this.route('appointment.delete_services'),{
id:id,
appointmentID:this.response.appointment.appointmentID,
},
{
onSuccess:()=>{
this.$notify({
title:'Deleted',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}

}

);
},




//
cancel_appointment(id){
this.$inertia.post(this.route('appointment.cancel'),{
id:id,
appointmentID:this.response.appointment.appointmentID,
},
{
onSuccess:()=>{
this.$notify({
title:'Deleted',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}

}

);
},







//
select_service(event){
this.form.services=event.target.value;
},

//format service
format_appointment(){
this.form.date=this.response.appointment.date;
this.form.location=this.response.appointment.location;
this.form.comment=this.response.appointment.comment;
this.form.end=this.response.appointment.to;
this.form.start=this.response.appointment.from;
this.form.end_date=this.response.appointment.end_date==null?this.response.appointment.end_date:this.response.appointment.date;
this.form.services=this.response.appointment.serviceID;
//format
const services=this.response.services;
const id=this.response.appointment.serviceID;


services.forEach(element=>{
if(element.id==id){
this.old_service.push(element);
}else{
this.new_service.push(element);
}


if(this.form.end_date!=null){
this.change_field=true;
}


});

}







},


//

mounted(){
this.format_appointment();
},


//
computed:{
appointment(){
return this.response.appointment;
},
//
services(){
return this.response.services;
}



}



}
</script>
