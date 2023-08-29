<template>
<div class="nk-block pt-0">
<div>
<div class="section-body mt-3">
<div class="container-fluid">
<div class="tab-content mt-3">

<div class="tab-pane fade show active" id="Payroll-Salary" role="tabpanel">
<div class="row clearfix">

<div class="col-lg-3 col-md-6" v-for="t in tabs" :key="t.id">
<div class="card">
<div class="card-body">
<h6> <em :class="t.icon" style="font-size:30px;color:#07372F;"></em></h6>
<h3 class="pt-3" style="font-weight:normal;"><span class="counter">{{ t.count }}</span></h3>
<span>
<Inertia-link :href="route(t.url)">
<strong style="color:black;">{{ t.title }} </strong>
</Inertia-link>
</span>
</div>
</div>
</div>

</div>



<div class="tab-pane fade show active" id="Payroll-Salary" role="tabpanel">
<div class="row clearfix">




<div class="col-12 col-md-8 h-100">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold">Appointments</h3>
</div>
<div class="table-responsive">
<table class="table table-hover table-vcenter mb-0 mt-2">
<thead>
<tr>
<th class="bold text-transform">Appointment Request</th>
<th class="bold text-transform">Date</th>
<th class="bold text-transform">Start</th>
<th class="bold text-transform">End</th>
<th class="bold text-transform">Status</th>
<th class="bold text-transform"></th>
</tr>
</thead>
<tbody v-if="appointments.length>0">
<tr v-for="a in appointments" :key="a">

<td><span> {{ a.name }} </span></td>
<td><span>{{ a.date.split('-').reverse().join('/') }}</span></td>
<td><span>{{ a.from.substring(0,5) }}</span></td>
<td><span>{{ a.to.substring(0,5) }}</span></td>
<td class="text-transform">
{{ a.status }}
</td>
<td style="width:50px;">
<!-- <span class="badge badge-dot badge-warning text-transform" v-if="a.status=='pending'">{{ a.status }} </span>
<span class="badge badge-dot badge-success text-transform" v-else-if="a.status=='accepted'">{{ a.status }} </span> -->

<Inertia-link :href="route('appointment.details',{id:a.id})" class="btn btn-default btn-sm text-primary" style="border:none;margin:0;">View</Inertia-link>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td>No content</td>
</tr>
</tbody>
</table>
</div>
</div>








</div>








<div class="col-12 col-md-4 pb-3">

<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold">Activities</h3>
<div class="card-options">

<div class="item-action dropdown ml-2">
<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-174px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
<a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View All </a>

</div>
</div>
</div>
</div>
<table class="table card-table mt-2">
<tbody  v-if="activity.length>0">
<tr v-for="a in activity" :key="a.id">
<td class="width45"><span class="avatar avatar-green">
<em class="icon ni ni-bell" style="font-size:20px;"></em>
</span></td>
<td>
<p class="mb-0">{{ a.title}}</p>
<!-- <span class="text-muted font-13">{{ a.description}}</span> -->
</td>
<td class="text-right">
<p class="mb-0">{{ a.created_at.substring(0,10).split('-').reverse().join('/') }}</p>
<!-- <span class="text-success font-13">Done</span> -->
</td>
</tr>

</tbody>
<tbody v-else><tr>
<td colspan="3">No content</td>
</tr></tbody>
</table>
</div>





</div>


</div>









<div class="row clear-fix">

<div class="col-12 col-md-4 pb-3">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold"><em class="icon ni ni-wallet-fill" style="font-size:30px;"></em> Wallet</h3>

</div>
<div class="card-body">
<h6>Ballance</h6>
<h3 class="pt-3" style="font-weight:normal;"><span class="counter">{{ wallet_balance }}</span></h3>
<span><span class="text-danger mr-2"></span>

</span>
</div>
<div class="card-footer border-0">
<!-- <deposit-withdraw-component :errors="errors"/> -->
<div class="list-group border-0 list-widget" style="border:none;">
<Inertia-link :href="route('wallet.deposit')" class="list-group-item" style="font-size:16px;color:black;"><em class="icon ni ni-wallet-out"></em> Deposit Funds</Inertia-link>
<Inertia-link :href="route('wallet.withdraw')" class="list-group-item" style="font-size:16px;color:black"><em class="icon ni ni-wallet-in"></em> Withdraw Funds</Inertia-link>

</div>
</div>
</div>

</div>

















<div class="col-12 col-md-4 pb-3">
<div class="card  h-100">
<div class="card-header">
<h3 class="card-title bold">Recommendations</h3>
</div>
<div class="card-body">

<ul class="right_chat list-unstyled" v-if="recommendations.length>0">
<li class="offline" v-for="r in recommendations" :key="r.id">
<a href="javascript:void(0);">
<div class="media">
<span class="avatar avatar-green" style="margin:10px;margin-top:-2px;">
<em class="icon ni ni-user-fill" style="font-size:20px;"></em>
</span>
<div class="media-body">
<span class="name">{{ r.names }} <small class="float-right">
{{ r.created_at.substring(0,10).split('-').reverse().join('/')}}
</small></span>
<span class="message">{{ r.message }}</span>
<span class="badge badge-outline status"></span>
</div>
</div>
</a>
</li>

</ul>








<div v-else>No content</div>
</div>
</div>

</div>








<div class="col-12 col-md-4 pb-3">

<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold">Tasks</h3>
</div>
<div class="card-body p-0">
<table style="width:100%;" class="table card-table">
<thead>
<tr>
<th>Date</th>
<!-- <th>Time</th> -->
<th>Appointment</th>
</tr>

</thead>

<tbody v-if="tasks.length>0">
<tr v-for="(t,key) in tasks" :key="key">
<td class="text-muted">{{t.date.split('-').reverse().join('/')}} </td>
<!-- <td>{{t.from}} <span>{{t.to  }} </span> </td> -->
<td>{{t.name}} </td>
</tr>

</tbody>

<tbody v-else>
<tr>
<td colspan="3">No content</td>
</tr>
</tbody>
</table>





</div>
</div>

</div>



</div>
</div>




















</div>

</div>
</div>
</div>

</div>
































<!-------Dialog-------->
<div class=""  v-if="dialog.state==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);z-index:1000000;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Details </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.state=false">

</a>
</div>
<div class="modal-body" style="overflow:auto;max-height:500px;">



<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label bold">Appointment Date</div>
<div class="data-value">
<a href="#" class="text-primary" @click="show_calendar()">
<em class="icon ni ni-calender-date m-0 p-0"></em>
{{  dialog.appointment.date.split('-').reverse().join('/') }}
<span>{{ dialog.appointment.end_date }} </span>
<span><br/>

</span>
</a>
</div>
</div>
</li>

<li class="data-item" v-if="calendar.state==true">
<calendar-component />
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label bold">Time</div>
<div class="data-value">
<em class="icon ni ni-clock"></em>
<span class="text-success mr-2"> {{ dialog.appointment.from }}</span> -  <span class="text-danger ml-2"> {{ dialog.appointment.to }}</span> </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label bold">Service Requested</div>
<div class="data-value text-transform"><em class="icon ni ni-tag-fill"></em> {{ dialog.appointment.name }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label bold">Location </div>
<div class="data-value">
<em class="icon ni ni-map-pin-fill"></em>
{{ dialog.appointment.location }}
</div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label bold">Service Provider  </div>
<div class="data-value">
<em class="icon ni ni-user-alt-fill"></em>
{{ dialog.appointment.firstname }}  {{ dialog.appointment.lastname }}
</div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label bold">Telephone Number </div>
<div class="data-value">
<em class="icon ni ni-call-fill"></em>
{{ dialog.appointment.tel }}
</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label bold">Email Address </div>
<div class="data-value">
<em class="icon ni ni-mail-fill"></em>
{{ dialog.appointment.email }}
</div>
</div>
</li>



</ul>










</div>
<div class="modal-footer bg-light text-left">
<span class="mr-3">You have made a payment of Shs: 100000</span>
<span class="sub-text">
<a href="#" class="btn btn-dim btn-outline-light">Options available </a>
</span>
</div>
</div>
</div>
</div>


</div>
</template>
<script>

import DepositWithdrawComponent from '@/Components/DepositWithdrawComponent';
import CalendarComponent from '@/Components/CalendarComponent';
export default {
components:{
DepositWithdrawComponent,
CalendarComponent,

},


props:{
response:{},
title:{},
errors:{}

},




data(){
return{

dialog:{
state:false,
appointment:null,
},

content:this.response.user_data.dashboard,
calendar:{
state:false,
},



}},


computed:{
//
tabs(){
const numbers = new Intl.NumberFormat('en-US');
return [
{icon:'icon ni ni-calender-date-fill',
title:'APPOINTMENTS',
count:this.response.user_data.dashboard.count_appointments,
id:2,
url:'appointments'},

{icon:'icon ni ni-grid-fill',
title:'SERVICE PROVIDERS',
count:this.response.user_data.dashboard.service_provider_count,
id:1,
url:'user.service-providers'},

{icon:'icon ni ni-bar-chart-fill',
title:'RECOMMENDATIONS',
count:this.response.user_data.dashboard.count_recommendations,
id:3,
url:'appointments'},

{icon:'icon ni ni-wallet-fill',
title:'WALLET',
count:numbers.format(this.response.user_data.dashboard.account_balance),
id:4,
url:'wallet'},

];

},

//
appointments(){
return this.response.user_data.dashboard.appointments;
},
//
wallet_balance(){
const sum=new Intl.NumberFormat('en-US');
return sum.format(this.response.user_data.dashboard.account_balance);
},

//activity list
activity(){
return this.response.user_data.dashboard.activity;
},
//
providers(){
return this.response.user_data.dashboard.pssp;
},

//
recommendations(){
return this.response.user_data.dashboard.recommendations;
},

//tasks
tasks(){
return this.response.user_data.dashboard.tasks;
}






},


methods:{
show_appointment(a){
this.dialog.appointment=a;
this.dialog.state=true;
},

show_calendar(){
if(this.calendar.state==false){
this.calendar.state=true;
}else{
this.calendar.state=false;
}
},







}








}
</script>

<style scoped>
table tr td{
padding:5px;
}

.data-list li{
border:none;
}

table tr th{
border:none;
text-align:left;
padding:0;
padding-bottom:10px;
}

table thead tr th{
text-transform: capitalize;
}


</style>
