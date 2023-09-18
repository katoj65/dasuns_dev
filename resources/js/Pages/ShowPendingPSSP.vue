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
<button class="btn btn-default btn-sm" v-if="response.status=='interview'" @click="show=true">
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








<!-------dialog----------->
<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Schedule interview</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false" style="color:black;">
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">





<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="text" class="form-control text-transform" id="default-01" placeholder="Enter names" :value="response.user.firstname+' '+response.user.lastname" disabled>
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter date" v-model="form.date">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.time"></input-error>
</label>
<div class="form-control-wrap">
<input type="time" class="form-control" id="default-01" placeholder="Enter time" v-model="form.time">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.type"></input-error>
</label>
<div class="form-control-wrap">
<select type="text" class="form-control" id="default-01" @change="set_type($event)">
<option>--Select--</option>
<option value="physical">Physical </option>
<option value="online">Online </option>
</select>
</div>
</div>

<div class="form-group">
<label class="form-label" for="default-01">
    <input-error :error="errors.comment"></input-error>
</label>
<div class="form-control-wrap">
<textarea type="text" class="form-control" id="default-01" placeholder="Enter comment" v-model="form.comment">
</textarea>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>










</div>
<div v-else class="text-center p-5">No results found</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';
export default {
components:{
AppLayout,
InputError

},

props:{
title:{},
response:{},
errors:{},
flash:{},

},

data(){return{
drawer: false,
drawer2:false,
drawer3:false,
drawer4:false,
drawer5:false,
show:false,
//interview form
form:this.$inertia.form({
id:null,
date:'',
time:'',
comment:'',
type:'',
}),


}},
computed:{

},

methods:{
submit(){
this.form.post(this.route('interview.post'),{
onSuccess:()=>{
const flash=this.$page.props.flash;
this.show=false;
this.$notify({
title:flash.success!=null?'Successful':'Warning',
message:flash.success!=null?flash.success:flash.warning,
type:flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});


},

set_type(event){
this.form.type=event.target.value;
},


set_id(){
const id=this.response.user.id;
this.form.id=id;
}


},
mounted(){
this.set_id();
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
