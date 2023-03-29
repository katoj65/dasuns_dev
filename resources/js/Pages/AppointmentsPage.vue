<template>
<app-layout>
<el-card shadow="never" style="min-height:800px;">
<div slot="header" class="clearfix">
<h4>Appointments</h4>
</div>
<div class="row">
<div class="col-12 col-md-9 mb-2">
<!-- <el-card shadow="never" class="h-100"> -->
<!-- <table class="table table-hover border-0 p-0 m-0">
<thead class="border-none">
<tr style="border:none;">
<th scope="col" class="border-0">Date</th>
<th scope="col" class="border-0">End Date</th>
<th scope="col" class="border-0">Time</th>
<th scope="col" class="border-0">Services</th>
</tr>
</thead>
<tbody v-if="appointments.length>0">
<tr v-for="a in appointments" :key="a.id">
<td>{{ a.date }} </td>
<td>{{ a.end_date }} </td>
<td>{{ a.from }} {{ a.to }} </td>
<td>{{ a.name }} </td>
</tr>
<tr>
<td colspan="4">

</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="3">
No appointments
</td>
</tr>
</tbody>
</table> -->



<el-descriptions :column="3" border v-for="a in appointments" :key="a.id">
<el-descriptions-item label-class-name="my-label" content-class-name="my-content">
<template slot="label">
<i class="el-icon-date"></i>
Start Date
</template>
{{ a.date.split('-').reverse().join('/') }}
</el-descriptions-item>
<el-descriptions-item>
<template slot="label">
<i class="el-icon-date"></i>
End Date
</template>
{{ a.end_date.split('-').reverse().join('/') }}
</el-descriptions-item>
<el-descriptions-item>
<template slot="label">
<i class="el-icon-time"></i>
Time
</template>
{{ a.from }} - {{ a.to }}
</el-descriptions-item>

<!-- <el-descriptions-item label="Remarks">
<el-tag size="small">School</el-tag>
</el-descriptions-item> -->
<el-descriptions-item>
<template slot="label">
<i class="el-icon-caret-right"></i>
Service Requested
</template>
{{ a.name }}
<span style="float:right">
<a href="#" class="mr-2 text-primary" @click="show_appointment(a)">View</a>
</span>
</el-descriptions-item>
</el-descriptions>

<!-- </el-card> -->
</div>
<div class="col-12 col-md-3">
<v-calendar is-expanded title-position="left"></v-calendar>
</div>
</div>
</el-card>













<!---------------Modal------------>



<div class=""  v-if="dialog.modal==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Appointment Details</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.modal=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">
<table style="width:100%;">
<tbody>
<tr>
<th>
Date
</th>
<td>
{{ details.date.split('-').reverse().join('/') }}
</td>
<th>End Date</th>
<td>
{{ details.end_date.split('-').reverse().join('/') }}
</td>
</tr>
<tr>
<th>
Time
</th>
<td>
{{ details.from.substring(0,5) }} - {{ details.to.substring(0,5) }}
</td>
<th>
Service
</th>
<td>
{{ details.name }}
</td>
</tr>

<tr>
<th style="padding-bottom:20px;padding-top:20px;">Comment</th>
<td colspan="3" style="padding-bottom:20px;padding-top:20px;bg-success-dim">
{{ details.comment }}
</td>
</tr>


<tr>
<td colspan="4" class="border-2 p-0 mt-2">
<div class="text-white p-2" style="background:#0B5345;">
<h3>Service Provider Details</h3>
</div>



    <ul class="data-list is-compact" style="margin-top:-5px;">
    <li class="data-item border-0">
    <div class="data-col">
    <div class="data-label bold">Names</div>
    <div class="data-value text-transform">{{ details.firstname +' '+details.lastname }} </div>
    </div>
    </li>
    <li class="data-item border-0">
    <div class="data-col">
    <div class="data-label bold">Gender</div>
    <div class="data-value text-transform">{{ details.gender }} </div>
    </div>
    </li>
    <li class="data-item border-0">
    <div class="data-col">
    <div class="data-label bold">Date of Birth</div>
    <div class="data-value">{{ details.dob.split('-').reverse().join('/') }} </div>
    </div>
    </li>
    <!-- <li class="data-item">
    <div class="data-col">
    <div class="data-label">Telephone Number </div>
    <div class="data-value">{{ details.tel }} </div>
    </div>
    </li> -->
    <li class="data-item border-0">
    <div class="data-col">
    <div class="data-label bold">Email Address </div>
    <div class="data-value">{{ details.email }} </div>
    </div>
    </li>
    </ul>



</td>
</tr>

</tbody>
</table>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">


<input type="button" class="button" value="Re-Schedule Appointment" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</div>














</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
components: { AppLayout,

},
props:{
title:{},
response:{}
},

data(){return{
dialog:{
modal:false,
content:null,
},


}},

methods:{
show_appointment(item){
this.dialog.content=item;
this.dialog.modal=true;

},


},

computed:{
appointments(){
return this.response.appointment;
},

details(){
return this.dialog.content;
}



}






}
</script>
<style>
table tbody tr td, table tbody tr th{
padding:10px;
}

</style>
