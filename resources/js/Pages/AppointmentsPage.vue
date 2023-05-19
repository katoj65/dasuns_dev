<template>
<app-layout>
<div class="nk-block pt-0">



<div class="row g-gs">

<div class="col-md-8 col-xxl-4">
<div class="card card-full card-radius">
<div class="card-inner">
<div class="card-title-group mb-1">
<div class="card-title">
<h3 class="title" style="font-size:18px;">Appointments</h3>
</div>
</div>



<div class="card-inner p-0 mt-0">
<table class="table table-tranx">


<!-- <thead>

<tr>

<th class="tb-tnx-info">
<span class="tb-tnx-desc d-none d-sm-inline-block">
<span>Service requested</span>
</span>
<span class="tb-tnx-date d-md-inline-block d-none">
<span class="d-md-none">Date</span>
<span class="d-none d-md-block">
<span>Date</span>
<span>Time</span>
</span>
</span>
</th>
<th class="tb-tnx-amount is-alt">
<span class="tb-tnx-total">Amount</span>
<span class="tb-tnx-status d-none d-md-inline-block">Status</span>
</th>
<th class="tb-tnx-action">
<span>&nbsp;</span>
</th>
</tr>

</thead> -->



<tbody>
<tr class="tb-tnx-item" v-for="a in appointments" :key="a">
<td class="tb-tnx-info">
<div class="tb-tnx-desc">
<span class="title text-transform">
<em class="icon ni ni-check-circle-fill text-success mr-2" v-if="a.status=='accepted'"></em>
<em class="icon ni ni-alert-circle-fill  text-warning mr-2" v-else></em>

{{ a.name }} </span>
</div>
<div class="tb-tnx-desc text-muted">
<span class="date">{{ a.date.split('-').reverse().join('/') }} </span>
<span class="date ml-2">
<em class="icon ni ni-clock text-muted"></em>
{{ a.from.substring(0,5) }}</span>
<span class="date ml-2">{{ a.to.substring(0,5) }} </span>
</div>
</td>


<td class="tb-tnx-amount is-alt" style="width:100px;">
<div class="tb-tnx-status">
<span class="badge badge-dot badge-warning text-transform" v-if="a.status=='pending'">{{ a.status }} </span>
<span class="badge badge-dot badge-success text-transform" v-else-if="a.status=='accepted'">{{ a.status }} </span>
</div>
</td>

<td class="tb-tnx-action">
<div class="dropdown">
<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
<ul class="link-list-plain">
<li><a href="#" @click="show_appointment(a)">View</a></li>
<li><a href="#">Remove</a></li>
</ul>
</div>
</div>
</td>
</tr>

</tbody>
</table>
</div>


</div>
</div>
</div>










<div class="col-md-4 col-xxl-4">
<div class="card card-full card-radius">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h2 class="title" style="font-size:18px;">Calendar </h2>
<!-- <p>View transaction details</p> -->
</div>
</div>

<calendar-component/>
</div>
</div>
</div><!-- .col -->

</div>












<!-------Dialog-------->
<div class=""  v-if="dialog.state==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);z-index:1000000;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Details </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.state=false">
<em class="icon ni ni-cross"></em>
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
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CalendarComponent from '@/Components/CalendarComponent.vue';
export default {
components:{
AppLayout,
CalendarComponent
},


props:{
response:{},
title:{},
},




data(){
return{
dialog:{
state:false,
appointment:null,
},

calendar:{
state:false,
},



}},


computed:{
appointments(){
return this.response.appointments;
},




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
padding:10px;
}

.data-list li{
border:none;
}






</style>
