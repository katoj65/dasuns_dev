<template>
<app-layout>
<div class="nk-block"  v-if="response!=null">
<div class="row p-3">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">






<div class="card">
<div class="card-body text-center ribbon">
<div class="ribbon-box indigo">PENDING</div>
<em class="icon ni ni-user-circle-fill" style="font-size:100px;"></em>
<h4 class="mt-3 mb-2 text-transform">
{{ response.user.firstname }} {{ response.user.lastname }}
</h4>
<span class="mt-2">
<strong class="mr-1">Service No.</strong>
{{ response.number }}
</span>
<div class="text-center mt-3">
<button class="btn btn-default btn-sm" v-if="response.status=='interview'">
Schedule Interview</button>
<button class="btn btn-default btn-sm">Message</button>
</div>
<div class="row mt-4 text-left">
<div class="col-12">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">{{ response.user.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value"> {{ response.user.dob }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone</div>
<div class="data-value">{{ response.user.tel }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value text-soft">
{{ response.user.email }}
</div>
</div>
</li>




<li class="data-item">
<div class="data-col">
<div class="data-label">Location</div>
<div class="data-value text-transform">
{{ response.profile!=null?response.profile.location:'--------' }}
</div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Country</div>
<div class="data-value text-transform">
{{ response.profile!=null?response.profile.country:'--------' }}
</div>
</div>
</li>




<li class="data-item">
<div class="data-col">
<div class="data-label">Services</div>
<div class="data-value">
    <a href="javascript:void(0)" @click="drawer5 = true" type="primary">
{{ response.services.length>1?response.services.length+' Profession Services':response.services.length+' Profession Service' }}
</a>
</div>
</div>
</li>




<li class="data-item">
<div class="data-col">
<div class="data-label">Identification Documents</div>
<div class="data-value"><a href="javascript:void(0)" @click="drawer4 = true" type="primary"> {{ response.documents.length>0?'Uploaded':'missing' }}</a> </div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Academic Qualification </div>
<div class="data-value">
<a href="javascript:void(0)" @click="drawer3 = true" type="primary">
{{ response.education.length>0?'Available':'Missing' }}
</a>
</div>
</div>
</li>




<li class="data-item">
<div class="data-col">
<div class="data-label">Profession Experience</div>
<div class="data-value text-break">
<a href="javascript:void(0)" @click="drawer2 = true" type="primary"> {{ response.experience.length>0?'Available':'None' }}</a>
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Recommendations</div>
<div class="data-value">
<a href="javascript:void(0)" @click="drawer = true" type="primary"> {{ response.recommendation.length>0?'Available':'None' }} </a>
</div>
</div>
</li>
</ul>

</div>
</div>
</div>
</div>



</div>
<div class="col-12 col-md-3"></div>
</div>
























<el-drawer title=""
:visible.sync="drawer"
:with-header="false">
<div class="card" style="width:400px;">
<div class="card-header">
<h6>
Recommendation
</h6>
</div>
<div class="card-body">

    <table style="width: 100%;">
        <thead>
        <tr>
        <th>Names</th>
        <th>Position</th>
        <th>Contact</th>
        </tr>
        </thead>
        <tbody v-if="response.recommendation.length>0">
        <tr v-for="(r,key) in response.recommendation" :key="key">
        <td>
        {{ r.names }}
        </td>
        <td>
        {{ r.position }}
        </td>
        <td>
        {{ r.tel }}
        <div>
        {{ r.email }}
        </div>
        </td>
        </tr>
        </tbody>
        <tbody v-else>
        <tr>
        <td>No identification documents</td>
        </tr>
        </tbody>
        </table>

</div>
</div>
</el-drawer>










<el-drawer title=""
:visible.sync="drawer2"
:with-header="false">
<div class="card" style="width:400px;">
<div class="card-header">
<h6>
Profession Experience
</h6>
</div>
<div class="card-body">


    <table>
        <thead>
        <tr>
        <th>
        Institution
        </th>
        <th>
        From
        </th>
        <th>
        To
        </th>
        <th>
        Qualification
        </th>
        </tr>
        </thead>
        <tbody v-if="response.profession.length>0">
        <tr v-for="(p,key) in response.profession" :key="key">
        <td>
        {{ p.organisation_name }}
        </td>
        <td>
        {{ p.position }}
        </td>
        <td>
        {{ p.from_date }}
        </td>
        <td>
        {{ p.to_date }}
        </td>
        </tr>
        </tbody>
        <tbody v-else>
        <tr>
        <td colspan="3">No education qualification</td>
        </tr>
        </tbody>
        </table>



</div>
</div>
</el-drawer>











<el-drawer title=""
:visible.sync="drawer3"
:with-header="false">
<div class="card">
<div class="card-header">
<h6>
Academic Qualifications
</h6>
</div>
<div class="card-body">

<table>
<thead>
<tr>
<th>
Institution
</th>
<th>
From
</th>
<th>
To
</th>
<th>
Qualification
</th>
</tr>
</thead>
<tbody v-if="response.education.length>0">
<tr v-for="(e,key) in response.education" :key="key">
<td>
{{ e.institution }}
</td>
<td>
{{ e.from }}
</td>
<td>
{{ e.to }}
</td>
<td>
{{ e.qualification }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="3">No education qualification</td>
</tr>
</tbody>
</table>

</div>
</div>
</el-drawer>









<el-drawer title=""
:visible.sync="drawer4"
:with-header="false">
<div class="card" style="min-width:400px;">
<div class="card-header">
<h6>
Identification Documents
</h6>
</div>
<div class="card-body">

<table style="width: 100%;">
<thead>
<tr>
<th>Document</th>
<th>Number</th>
</tr>
</thead>
<tbody v-if="response.documents.length>0">
<tr v-for="(d,key) in response.documents" :key="key">
<td>
{{ d.document }}
</td>
<td>
{{ d.document_number }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td>No identification documents</td>
</tr>
</tbody>
</table>
</div>
</div>
</el-drawer>











<el-drawer title=""
:visible.sync="drawer5"
:with-header="false">
<div class="card" style="width:400px;">
<div class="card-header">
<h6>
Profession Services
</h6>
</div>
<div class="card-body">
<div v-if="response.services.length>0">
<ul>
<li v-for="(s,key) in response.services" :key="key">
<em class="icon ni ni-caret-right-fill"></em> {{ s.name }}
</li>
</ul>
</div>
<div v-else>No services</div>
</div>
</div>
</el-drawer>









</div>


<div v-else class="text-center p-5">
    No results found
    </div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout

},

props:{
title:{},
response:{},

},

data(){return{
drawer: false,
drawer2:false,
drawer3:false,
drawer4:false,
drawer5:false,


}},
computed:{

},

methods:{






}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}
.data-item{
border:none;
}

a{color:#8094ae;}
table th, table td{
padding:10px;
}
</style>
