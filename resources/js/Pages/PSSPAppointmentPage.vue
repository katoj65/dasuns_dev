<template>
<app-layout>
<div class="nk-block pt-2">
<div class="card" style="min-height:600px;">
<div class="card-header">
<h1 class="card-title">
Appointments
</h1>
</div>
<div class="row">
<div class="col-12 col-md-9">
<div class="card">
<div class="card-body">

<table class="table border">
<thead>
<tr>
<th scope="col">Date</th>
<th scope="col">End date</th>
<th scope="col">Names</th>
<th scope="col">Status</th>
<th scope="col" style="width:30px;"></th>

</tr>
</thead>
<tbody v-if="appointments.length>0">
<tr v-for="a in appointments" :key="a.id">
<td scope="row">
{{ a.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td>{{ a.end_date!=null?a.end_date:'---' }} </td>
<td class="text-transform">{{ a.firstname }} {{ a.lastname }} </td>
<td class="text-transform">{{ a.status }}</td>
<td>
<em class="icon ni ni-check-circle-fill text-success" v-if="a.status=='accepted'" style="font-size:20px;"></em>
<em class="icon ni ni-alert-circle-fill text-warning" v-else-if="a.status=='pending'"  style="font-size:20px;"></em>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="4">No appointments</td>
</tr>
</tbody>
</table>

</div>
</div>

</div>
<div class="col-12 col-md-3">

<div class="card">
<div class="card-header">
<div class="title bold">Calendar</div>
</div>

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
