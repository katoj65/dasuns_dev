<template>
<app-layout>
<div class="nk-block pt-2 mb-2">
<div class="row">
<div class="col-12 col-md-8">
<div class="card" style="min-height:700px;">
<div class="card-header">
<h1 class="card-title">
{{ appointments.length>0?appointments.length:null }}

Appointments
</h1>
</div>
<div class="card-body">


<table class="table">
<thead class="border-0">
<tr>
<th scope="col" class="border-0">Start Date</th>
<th scope="col" class="border-0">Time</th>
<th scope="col" class="border-0">Service Requested</th>
<th scope="col" class="border-0">Location</th>
<th scope="col" class="border-0">Names</th>
<th scope="col" class="border-0"></th>
</tr>
</thead>






<tbody v-if="appointments.length>0">
<tr v-for="a in appointments" :key="a.id">
<td scope="row" class="text-success">
{{ a.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td> {{ a.from.substring(0,5) }} </td>
<td>
<ul v-if="a.services.length>0">
<li v-for="l in a.services" :key="l.id">
{{ l.name }}
</li>
</ul>
</td>
<td class="text-transform">
{{ a.location }}
</td>
<td class="text-transform">{{ a.firstname }} {{ a.lastname }} </td>
<td style="width:30px;">
<em class="icon ni ni-check-circle-fill text-success" v-if="a.status=='accepted'" style="font-size:20px;"></em>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="3">No Appointment</td>
</tr>
</tbody>
</table>




</div>
</div>
</div>
<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-body">
<calendar-component/>
</div>
</div>
</div>
</div>
</div>
</app-layout>
</template>
<script>
import CalendarComponent from '../Components/CalendarComponent.vue';
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout,
CalendarComponent
},
props:{
title:{},
response:{}
},

computed:{
appointments(){
return this.response.appointments;
}
}

}
</script>



<style scoped>
table {
border-left:none;
}

table tbody tr td, table thead tr{
border-bottom:none ;
border-top:none;
}
table thead, table tbody{
border:none;
}
table td, table th{
padding:10px;
}

table tbody tr:hover{
background:#F8F9F9;
}



</style>
