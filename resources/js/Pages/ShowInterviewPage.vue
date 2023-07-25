<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">


<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Interview</h3>
</div>


<div class="card-body">
<div class="row">
<div class="col-md-12">
<address>
<strong class="text-transform">
{{ interview.firstname }} {{ interview.lastname  }}
</strong>

<small class="float-right">
{{ interview.date.split('-').reverse().join('/') }} </small>
 <br>
<em class="icon ni ni-user-list-fill mr-2"></em>

<span class="text-transform">{{ interview.gender }}</span>

<br>
<em class="icon ni ni-calender-date-fill mr-2"></em>{{ interview.dob.split('-').reverse().join('/') }} <br>
<em class="icon ni ni-call-fill mr-2"></em>{{ interview.tel }} <br>
<em class="icon ni ni-mail-fill mr-2"></em>{{ interview.email }}<br>
<em class="icon ni ni-hash mr-2"></em>{{ interview.number }}
</address>
</div>
</div>
<div class="table-responsive">
<table class="table border mb-3">
<thead class="border-top">
<tr>
<th>Interview Details</th>
<th></th>
</tr>
</thead>
<tbody class="border-bottom">
<tr>
<th>Date</th>
<td>{{  interview.date.split('-').reverse().join('/') }} </td>
</tr>

<tr>
<th>Time</th>
<td>{{interview.time.substring(0,5)}} </td>
</tr>

<tr>
<th>Comment</th>
<td class="text-transform">{{interview.comment}} </td>
</tr>

<tr>
<th>Status</th>
<td class="text-transform">{{interview.status}} </td>
</tr>





</tbody>

<thead class="mt-2">
<tr>
<th>Services</th>
<th>
</th>
</tr>
</thead>
<tbody class="border-bottom">
<tr v-for="(s,key) in interview.services" :key="key">
<td colspan="2">
<div class="text-transform">
<em class="icon ni ni-forward-alt-fill mr-2"></em>
{{ s.name }}
</div>
</td>
</tr>
</tbody>








<thead>
<tr>
<th>Interviewer Details</th>
<th>
</th>
</tr>
</thead>
<tbody class="border-bottom">
<tr v-for="(p,key) in interview.panelist" :key="key">
<td colspan="2">
<div class="text-transform">
<em class="icon ni ni-user-alt-fill mr-2"></em>
{{ p.firstname }} {{ p.lastname }}
</div>
</td>
</tr>
</tbody>


</table>
</div>
<div class="row">
<div class="col-md-12 align-right">
<el-button-group v-if="role=='admin'">
<el-button type="secondary">Edit</el-button>
<el-button type="danger">Delete
</el-button>
</el-button-group>
</div>
</div>
</div>
</div>



</div>
<div class="col-12 col-md-2"></div>
</div>


</div>
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout,

},
props:{
title:{},
response:{}
},

computed:{
interview(){
return this.response.interview;
},

role(){
return this.$page.props.auth.user.role;
}




}





}
</script>
<style scoped>
table tbody tr td,table tbody tr th, table thead tr th{
border:none;
}
th{
font-weight:bold;
}
</style>
