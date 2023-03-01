<template>
<app-layout>
<div class="row">

<div class="col-12 col-md-8">

{{ appointment.payment }}

<form @submit.prevent="submit">
<md-card style="box-shadow:none;">
<md-card-header>
<div class="md-title" style="font-weight:bold;">Cart Details</div>
</md-card-header>

<md-card-content style="min-height:700px;">
<div class="card-inner">
<div class="timeline">
<h6 class="timeline-head">Appointment Information</h6>
<ul class="timeline-list">
<li class="timeline-item">
<div class="timeline-status bg-success"></div>
<div class="timeline-date">{{ appointment.date.split('-').reverse().join('/') }}</div>
<div class="timeline-data">
<h6 class="timeline-title">Appointment Begins</h6>
<div class="timeline-des">
<p class="text-success">{{ appointment.days>1?appointment.days+' Days booked':appointment.days+' Day booked' }} </p>
<span class="time mt-2"> {{ appointment.from.substring(0,5) }} </span><span class="time mt-2">{{ appointment.to.substring(0,5) }} </span>
</div>
</div>
</li>
<li class="timeline-item">
<div class="timeline-status bg-warning"></div>
<div class="timeline-date">{{ appointment.end_date.split('-').reverse().join('/') }}</div>
<div class="timeline-data">
<h6 class="timeline-title">Appointment Ends</h6>
<div class="timeline-des">




<p class="text-transform pb-2 mt-4"><strong>Amount:</strong><span class="text-success" style="font-weight:bold;"> {{ appointment.amount }}  {{ appointment.currency }}</span> </p>
<p class="text-transform pb-2"><h1>Service Provider Details</h1> </p>
<p class="text-transform pb-2 mt-3"><strong>Names:</strong> {{ appointment.firstname }}  {{ appointment.lastname }}</p>
<p class="text-transform pb-2"><strong>Service Number:</strong> {{ appointment.number }}</p>
<p class="text-transform pb-2"><strong>Telephone Number:</strong> {{ appointment.tel }}</p>
<p class="pb-2"><strong>Email Address:</strong> {{ appointment.email }}</p>

<p class="text-transform pb-2"><h1>Services Requested</h1></p>



<div class="mt-2">
<ul v-if="appointment.services.length>0">
<li v-for="s in appointment.services" :key="s.id" style="margin-bottom:10px;">
<em class="icon ni ni-forward-alt-fill"></em> {{ s.name }}
</li>
</ul>

</div>





</div>
</div>
</li>

</ul>
</div>
</div>

</md-card-content>
<md-card-actions>
<md-button class="bg-success" style="color:white;margin-right:20px;"  v-if="appointment.payment.status==false" disabled>Make Payment</md-button>
<md-button class="bg-success" style="color:white;margin-right:20px;" v-else>Make Payment</md-button>
<md-button class="bg-danger" style="color:white;">Cancel</md-button>
</md-card-actions>
</md-card>

</form>



</div>
<div class="col-12 col-md-4">



<div class="viewport" style="background:white;padding:10px;">
<md-toolbar :md-elevation="0">
<span style="font-weight:bold;">Cart Items Available</span>
</md-toolbar>
<div>
<md-list class="md-triple-line">
<md-list-item v-for="o in  response.other" :key="o.id">
<md-avatar>
<em class="icon ni ni-calender-date"></em>
</md-avatar>
<div class="md-list-item-text">
<span>{{ o.date.split('-').reverse().join('/') }}</span>
<span style="font-weight:bold;color:siver;">
{{ o.number }}
</span>
</div>

<md-button class="md-list-action bg-warning-dim" style="font-size:13px;font-weight:normal;">
{{ o.status }}
</md-button>
</md-list-item>
</md-list>

<div style="background:white;padding:10px;" class="border-top">
<div class="nk-order-ovwg-data border">
<div class="amount mb-2">Wallet</div>
<!-- <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div> -->
<div class="title"><em class="icon ni ni-arrow-up-left"></em>
{{ appointment.payment.balance_amount }}
</div>
</div>
</div>


</div>
</div>


</div>
</div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout

},
props:{
title:{},
response:{},
},

data(){return{







}},

methods:{
submit(){

}

},

computed:{
appointment(){
return this.response.appointment;
}
}



}
</script>
