<template>
<app-layout>
<div class="row m-2 pt-2">
<div class="col-12 col-md-12">


<div class="card">
<div class="card-header">
<h3 class="card-title bold">Appointments </h3>
</div>
<div class="card-body">
<div>






<table class="table mb-0">
<thead>
<tr>
<th>Support Service</th>
<th>Date</th>
<th>Time</th>
<th>Location</th>
<th>Telephone</th>
<th>Status</th>
</tr>
</thead>
<tbody v-if="appointments.length>0">
<tr  v-for="a in appointments" :key="a">
<th scope="row">

    <em class="icon ni ni-check-circle-fill text-success mr-2" v-if="a.status=='accepted'"></em>
    <em class="icon ni ni-alert-circle-fill  text-warning mr-2" v-else></em>
    {{ a.name }}


</th>
<td>
    {{ a.date.split('-').reverse().join('/') }}
</td>
<td><em class="icon ni ni-clock text-muted"></em>
    {{ a.from.substring(0,5) }}
    <span class="date ml-2">{{ a.to.substring(0,5) }}</span> </td>
<td>
{{ a.location }}
</td>
<td>
    {{ a.tel }}
</td>
<td>
    {{ a.status }}
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="6">No content</td>
</tr>
</tbody>
</table>














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
text-transform: capitalize;
}

.data-list li{
border:none;
}






</style>
