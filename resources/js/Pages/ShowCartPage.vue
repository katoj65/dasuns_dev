<template>
<app-layout>
<div class="row">

<div class="col-12 col-md-8">



<div class="card border-0">
<div class="card-header">
<div class="card-title">
<h1>Cart Item</h1>
</div>
</div>
<div class="card-body">


<div class="card-inner">
<div class="timeline">
<h1 class="timeline-head" style="font-size:18px;padding-bottom:20px;">Appointment Details</h1>
<ul class="timeline-list mt-3">
<li class="timeline-item">
<div class="timeline-status bg-success"></div>
<div class="timeline-date" style="width:200px;">{{ appointment.date.split('-').reverse().join('/') }} <em class="icon ni ni-alarm-alt"></em></div>
<div class="timeline-data">
<h6 class="timeline-title">Appointment Start Date</h6>
<div class="timeline-des">
<p>{{ appointment.days>1?appointment.days+' Days booked':appointment.days+' Day booked' }} </p>
<span class="time mt-2"> {{ appointment.from.substring(0,5) }} </span><span class="time mt-2">{{ appointment.to.substring(0,5) }} </span>
</div>
</div>
</li>
<li class="timeline-item">
<div class="timeline-status bg-warning"></div>
<div class="timeline-date" style="width:200px;">{{ appointment.end_date.split('-').reverse().join('/') }} <em class="icon ni ni-alarm-alt"></em></div>
<div class="timeline-data">
<h6 class="timeline-title">Appointment End Date</h6>
<div class="timeline-des">


<p class="text-transform pb-2"><strong>Amount:</strong> {{ appointment.amount }}  {{ appointment.currency }}</p>
<p class="text-transform pb-2"><h1>Service Provider Details</h1> </p>
<p class="text-transform pb-2 mt-3"><strong>Names:</strong> {{ appointment.firstname }}  {{ appointment.lastname }}</p>
<p class="text-transform pb-2"><strong>Service Number:</strong> {{ appointment.number }}</p>
<p class="text-transform pb-2"><strong>Telephone Number:</strong> {{ appointment.tel }}</p>
<p class="pb-2"><strong>Email Address:</strong> {{ appointment.email }}</p>

<p class="text-transform pb-2"><h1>Services Requested</h1> </p>


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



<!-- <h1>Payment Instructions</h1>
<p class="pt-2">
Some information goes here
</p> -->





</div>
</div>


<div class="card-footer">
<form @submit.prevent="submit">
<span>
<button class="btn btn-success" v-if="appointment.payment.status==false" disabled>Make Payment</button>
<button class="btn btn-success" v-else type="submit">Make Payment</button>
</span>
<span style="float:right;color:black;" v-if="appointment.payment.status==false">
<strong>Your account balance is low</strong>
 <!-- <span style="margin-left:10px;padding-right:20px;">
 {{ appointment.status }} transaction</span> -->
</span>
</form>
</div>
</div>






<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-header">
<div class="card-title"><h1>More Cart Items</h1></div>
</div>
<div class="card-body">

<ul>
<li v-for="other in response.other" :key="other.id">
<div class="border p-2 mb-2" style="border-radius:10px;">
<div class="row" style="font-size:14px;">
<div class="col-7">
<div>
<em class="icon ni ni-calender-date"></em>
{{ other.date.split('-').reverse().join('/') }}
</div>
<p class="text-muted">
{{ other.number }}
</p>
 </div>
<div class="col-5">
<div class="p-1">
<a href="#" class="btn btn-dim btn-light text-transform">{{ other.status }} </a>
</div>
</div>
</div>
</div>
</li>
</ul>



</div>
