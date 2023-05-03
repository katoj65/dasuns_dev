<template>
<AppLayout>
<div class="row mt-2 mb-2">
<div class="col-12 col-md-8">
<div class="card mb-3" style="min-height:700px;">
<div class="card-header">
<h4 class="title" style="font-size:18px;">
{{ pending.length>0?pending.length:''  }}

Requests

</h4>
</div>
<div class="card-body">
<table class="table">
<thead class="border-0">
<tr>
<th scope="col" class="border-0">Date</th>
<th scope="col" class="border-0">Names</th>
<th scope="col" class="border-0">Service Requested</th>
<th scope="col" class="border-0">Location</th>
<th scope="col" class="border-0"></th>

</tr>
</thead>
<tbody v-if="pending.length>0">
<tr v-for="p in pending" :key="p.id">
<td scope="row" :class="p.status=='pending'?'text-warning':'text-success'" style="cursor:pointer;">
{{ p.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td class="text-transform">{{ p.firstname }} {{ p.lastname }} </td>
<td>
{{ p.service.name }}
<!-- <span v-if="p.count_services>0">+ {{ p.count_services }}  </span> -->
</td>
<td class="text-transform">{{ p.location }} </td>
<td style="width:20px;">
<em class="icon ni ni-check-circle-fill text-success" v-if="p.status=='accepted'" style="font-size:20px;"></em>
<em class="icon ni ni-alert-circle-fill text-warning" v-else-if="p.status=='pending'"  style="font-size:20px;"></em>
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="4">No Requests</td>
</tr>
</tbody>
</table>


</div>

</div>
</div>
<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-body">
<CalendarComponent/>
</div>
</div>
</div>
</div>
</AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import CalendarComponent from '@/Components/CalendarComponent';

export default {
components:{
AppLayout,
CalendarComponent
},

props:{
title:{},
response:{},
},




computed:{
//pending
pending(){
return this.response.pending;
},
//accepted
accepted(){
return this.response.accepted;
},

//

},








methods:{
//
items(){
return 111;
}



}






}
</script>

<style scoped>
table {
border-left:none;
}

table tbody tr td, table thead tr{
border-bottom:solid thin #E5E7E9 ;
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
