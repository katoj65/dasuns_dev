<template>
<app-layout>
<div class="row pt-2 mb-2">
<div class="col-12 col-md-4">

<el-card class="card h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="team-options">
</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="user-info">
<h3 style="font-size:18px;" class="text-transform mb-2">{{ applicant.info.firstname }} {{ applicant.info.lastname }} </h3>
<span class="sub-text badge badge-pill badge-success" style="color:white;">Service Provider  </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ applicant.info.gender }} </span></li>
<li><span>Date of Birth</span><span>{{ applicant.info.dob.split('-').reverse().join('/') }} </span></li>
<li><span>Contact</span><span>{{ applicant.info.tel }} </span></li>
<li><span>Email</span><span>{{ applicant.info.email }} </span></li>
<li><span>Dasuns Number</span><span>{{ applicant.info.number }} </span></li>
</ul>
<div class="team-view">

<!--Schedule Appointment--->

<div v-if="response.services.length>0 && response.document.length>0 && response.experience.length>0">
<div class="pt-5" v-if="status=='pending'">
<span  class="btn btn-success" style="padding:0;">
<span>
<a href="#" style="padding:10px;" @click="schedule_appointment(true)">
<em class="icon ni ni-calender-date"></em> Schedule Interview</a>
</span>
<span class="border-left" style="padding:10px;">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" @click="decline_appointment(true)" style="padding:15px;width:100%;">
<span style="padding:0;margin:0;">Decline Application</span>
</a> </el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</span>
</span>
</div>
<div class="pt-5" v-else-if="status=='declined'">
<a href="#" class="btn btn-success" style="padding:10px;font-size:15px;" @click="reschedule_appointment(true)">
<em class="icon ni ni-calender-date" style="margin-right:10px;"></em> Re-schedule Interview
</a>
</div>
</div>
<div v-else>
<button class="btn btn-dim btn-outline-danger btn-lg mt-3 btn-round btn-block" disabled>
<em class="icon ni ni-shield-alert text-danger pr-2"></em> Missing Information
</button>
</div>


<!--Schedule-Appointment--->
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>


</div>
<div class="col-12 col-md-8">
<el-card class="card h-100 p-0" shadow="never">
 <div slot="header" class="clearfix">
    <strong>Application Preview</strong>
    <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
  </div>







<div class="card-body p-0 m-0">


<div class="pt-5 pb-0" v-if="status=='declined'">
<div class="alert alert-danger alert-icon border-0" v-for="decline in response.decline_status" :key="decline.id">
<em class="icon ni ni-shield-alert text-danger"></em> <strong>Application Declined</strong>!
<div class="mt-2"> {{ decline.message }}</div>
 </div>
</div>





<ul class="data-list is-compact p-0 m-0">
<li class="data-item border-0">
<div class="data-col">
<div class="data-label"><strong><em class="icon ni ni-caret-right-fill"></em> Professional Support Services</strong> </div>
<div class="data-value"></div>
</div>
</li>



<li class="data-item" v-for="s in response.services" :key="s.id" style="border-bottom:none;" >
<div class="data-col">
<div class="data-label">
<em class="icon ni ni-dot"></em>
{{ s.name }} </div>
</div>
</li>

<li class="data-item" style="height:0;padding:0;">
</li>

<li class="data-item" style="border-bottom:none;">
<div class="data-col border-0">
<div class="data-label"><strong><em class="icon ni ni-caret-right-fill"></em> Identification Documents </strong></div>
</div>
</li>




<li class="data-item"  v-for="i in response.document" :key="i.id">
<div class="data-col">
<div class="data-label">{{ i.document }}</div>
<div class="data-value text-soft">
<span class="badge badge-dim badge-success p-1" style="font-size:16px;">
{{ i.document_number }}
</span>
</div>
</div>
</li>



<li v-if="response.document==0" class="data-item border-0">
<div class="data-col">
<div class="data-label">
<p class="p2 text-warning">Missing</p>
</div>
</div>
</li>


<li class="data-item" style="border-bottom:none;">
<div class="data-col border-0">
<div class="data-label">
<strong>
<em class="icon ni ni-caret-right-fill"></em> Professional Experience
</strong>
</div>
</div>
</li>






<li class="data-item ">
<div class="data-col">
<div class="data-label" style="width:100%;">
<table class="table preview-reference" v-if="response.experience.length>0">
<tbody style="border:none;">
<tr style="border:none;">
<th style="border:none;">Organisation</th>
<th style="border:none;">Position</th>
<th style="border:none;">Experience Dates</th>
</tr>

<tr style="border:none;" v-for="p in response.experience" :key="p.id">
<td style="border:none;" class="text-transform">
{{ p.organisation_name }}
</td>
<td style="border:none;text-transform:capitalize;">
{{ p.position }}
</td>
<td style="border:none;">
<span>{{ p.from_date.split('-').reverse().join('/') }}</span>
<span class="pl-3">{{ p.to_date.split('-').reverse().join('/') }}</span>
</td>
</tr>
</tbody>
</table>
<div v-else class="text-warning">
Missing
</div>

</div>
</div>
</li>



<li class="data-item" style="border-bottom:none;">
<div class="data-col">
<div class="data-label"><strong><em class="icon ni ni-caret-right-fill"></em> Professional Referees</strong> </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label" style="width:100%;">

<table class="table preview-reference" v-if="response.reference.length>0">
<tbody style="border:none;">
<tr style="border:none;">
<th style="border:none;">Names</th>
<th style="border:none;">Telephone</th>
<th style="border:none;">Email Address</th>
<th style="border:none;">Address</th>
<th style="border:none;">Position</th>
</tr>
<tr style="border:none;" v-for="r in response.reference" :key="r.id">
<td style="border:none;text-transform:capitalize;">
{{ r.names }}
</td>
<td style="border:none;">
{{ r.tel }}
</td>
<td style="border:none;">
{{ r.email }}
</td>
<td style="border:none;">
{{ r.address}}
</td>
<td style="border:none;text-transform:capitalize;">
{{ r.position }}
</td>
</tr>
</tbody>
</table>
<div v-else class="text-warning">
Missing
</div>

</div>
</div>
</li>


















</ul>
</div>



</el-card>
</div>
</div>
































<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="interview_dialog==true" @submit.prevent="submit_interview">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Schedule Interview </h5>
<a href="#" @click="schedule_appointment(false)" style="font-size:20px;">
<em class="icon ni ni-cross"></em>
</a>
</div>



<div class="modal-body" style="height:500px;overflow:auto;" v-show="show_panelists==false">


<div class="form-group">
<label class="form-label" for="full-name">Select Date
<input-error :error="errors.date" style="font-size:14px;"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="full-name" required="required" v-model="form.date">
</div>
</div>
<div class="form-group">
<label class="form-label" for="email-address">Select Time
<input-error :error="errors.time" style="font-size:14px;"></input-error>
</label>
<div class="form-control-wrap">
<input type="time" class="form-control" id="email-address" required="required" v-model="form.time">
</div>
</div>



<div class="form-group">
<label class="form-label" for="phone-no">Select type of Interview</label>
<div style="margin-top: 20px">
<el-radio v-model="form.type" label="physical" border size="medium" style="width:45%;">Physical Interview</el-radio>
<el-radio v-model="form.type" label="online" border size="medium" style="width:45%;">Online Interview</el-radio>
</div>
</div>


<div class="form-group">
<div class="form-control-wrap">
<input type="text" class="form-control" id="phone-no" placeholder="Enter comment" v-model="form.comment"/>
</div>
</div>






<div>
<button class="btn btn-block btn-light" style="width:100%;text-align:center;font-size:18px;padding:10px;" type="button" @click="show_panelists=true">
{{ form.selected.length>0?form.selected.length.length>1?form.selected.length+'Panelists selected':form.selected.length+' Panelist selected':'Select Panelist' }}
</button>

</div>
</div>





<!----------------->
<div class="modal-body" style="min-height:500px;overflow:auto;" v-show="show_panelists==true">
<div class="form-group" v-show="show_panelists==true">
<label class="form-label" for="default-07">Select Interview Panelist</label>
<div class="form-control-wrap">
<div class="form-control p-0" style="min-height:200px;overflow:auto">
<div>
<div class="pt-1 pb-1">
<input-error style="font-size:14px;" :error="errors.selected"></input-error>
</div>
<table class="table table-sm">
<thead>
<tr>
<th scope="col" class="border-0">Names</th>
<th scope="col" class="border-0">Profession</th>
</tr>
</thead>
<tbody>
<tr v-for="a in panelist" :key="a.id" class="hightlight">
<td  scope="row" class="border-0">
<b-form-group  v-slot="{ ariaDescribedby }">
<b-form-checkbox-group id="checkbox-group-2" v-model="form.selected"
:aria-describedby="ariaDescribedby" name="flavour-2">
<b-form-checkbox :value="a.user.id">
{{ a.user.firstname.toUpperCase()+' '+a.user.lastname.toUpperCase()}}
</b-form-checkbox>
</b-form-checkbox-group>
</b-form-group>
</td>
<td class="border-0">
<ul>
<li v-for="x in a.profession" :key="x.id" class="text-muted" style="font-size:13px;"><em class="icon ni ni-forward-alt-fill"></em> {{ x.name }}</li>
</ul>
</td>
</tr>

</tbody>
</table>
</div>
</div>

<div style="margin-top:20px;">
<button class="btn btn-block btn-light" style="width:100%;text-align:center;font-size:18px;padding:10px;" type="button" @click="show_panelists=false">
OK
</button>
</div>
</div>
</div>




</div>










<div class="modal-footer bg-light">
<span class="sub-text">
<button class="btn btn-lg button" v-if="form.selected.length==0" disabled>Schedule</button>
<button type="submit" class="btn btn-lg button" v-else>Schedule</button>



</span>
</div>
</div>
</div>
</form>











<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="interview_decline==true" @submit.prevent="submit2">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Decline Application </h5>
<a href="#" @click="decline_appointment(false)">
<em class="icon ni ni-cross size18"></em>
</a>
</div>
<div class="modal-body">

<div class="form-group">
<label class="form-label" for="phone-no">
<input-error style="font-size:14px;" :error="errors.message"></input-error>
</label>
<div class="form-control-wrap">
<textarea class="form-control" id="phone-no" placeholder="Reason for declining the application" style="height:50px;" v-model="form2.message"></textarea>
</div>
</div>


</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button type="submit" class="btn btn-lg button">OK</button>
</span>
</div>
</div>
</div>
</form>
</app-layout>
</template>
<script>

import InputError from '@/Alerts/InputError';
import AppLayout from '@/Layouts/AppLayout';

export default {
components:{
AppLayout,
InputError


},
props:{
title:{},
response:{},
flash:{},
errors:{}
},

data(){return{

show_panelists:false,

applicant:{
info:this.response.application,
services:this.response.services,

},
interview_dialog:false,
interview_decline:false,
panelist_dialog:false,
panelist:this.response.panelist,
decline_status:this.response.decline_status,
status:this.response.application.status,


//form schedule
form:this.$inertia.form({
date:null,
time:null,
comment:null,
type:'physical',
id:this.response.application.id,
selected:[],
}),


//

form2:this.$inertia.form({
message:null,
id:this.response.application.id,

}),










}},

methods:{

//
submit2(){
this.form2.post(this.route('store.interview_message'),{
onSuccess:()=>{
this.$notify(
{
title:'Successful',
message:this.$page.props.flash.success,
type:'success'

}
);
}
});
},





//
select_panelist(event){
this.form.panelist.push(event.target.id);
},
//

schedule_appointment(item){
if(item==true){
this.interview_dialog=true;
}else if(item==false){
this.interview_dialog=false;
}
},

//
reschedule_appointment(item){
this.form.status='reschedule';
if(item==true){
this.interview_dialog=true;
}else if(item==false){
this.interview_dialog=false;
}
},




//
decline_appointment(item){
if(item==true){
this.interview_decline=true;
}else if(item==false){
this.interview_decline=false;
}
},
//
interview_pabelists(item){
if(item==true){
this.panelist_dialog=true;
}else if(item==false){
this.panelist_dialog=false;
}
},

//
submit_interview(){
this.form.post(this.route('store-interview'),{
onSuccess:()=>{
this.$notify({
position: 'bottom-right',
title: 'Successful',
message:this.$page.props.flash.success,
type:'success'
});
}




});
},

back(){
this.$inertia.get(this.route('dashboard'));
},





}
}
</script>

<style scoped>
table th{
padding-bottom:10px;
}
.hightlight:hover{
background:#F8F9F9;
}

.hightlight{
border-top:solid thin #E5E8E8;
}

table tr td{
padding:15px;
}

table tr{
border-bottom:solid thin #E5E8E8;
}


</style>
