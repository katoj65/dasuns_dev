<template>
<div class="row pt-2">
<div class="col-12 col-md-4">
<el-card shadow="never" class="card h-100">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2">
<div class="user-avatar lg" style="background:#37BEA7;">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="user-info text-transform">
<h2 style="font-size:20px;">{{ user.firstname }} {{ user.lastname }} </h2>
<span class="sub-text text-transform mt-2">
{{ user.account_type }} Account
</span>
<div class="sub-text text-transform mt-2">
<strong style="margin-right:10px;">Dasuns No:</strong>  {{ user_number.number }}
</div>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ user.gender }} </span></li>
<li><span>DOB</span><span>{{ user.dob }} </span></li>
<li><span>Telephone</span><span>{{ user.tel }} </span></li>
<li><span>Email</span><span>{{ user.email }} </span></li>
</ul>
<div class="team-view">
<Inertia-link :href="route('profile')" class="btn btn-block btn-success" v-if="user.status=='pending'"><span>Edit Profile</span></Inertia-link>
<button class="btn btn-block btn-success" disabled v-else-if="user.status=='interview'">Edit Profile</button>


</div>
</div>
</div>
</el-card>
</div>
<div class="col-12 col-md-8">
<el-card shadow="never" class="card h-100">
<div slot="header" class="clearfix">
<h4>Professional Service Provider Account</h4>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>


<div class="p-3 bg-warning-dim" style="margin:-20px;"  v-if="response.user_data.pssp_attributes.identification_documents.length==0 || response.user_data.pssp_attributes.experience.length==0 || response.user_data.pssp_attributes.references.length==0 || response.user_data.pssp_attributes.services.length==0">
<em class="icon ni ni-alert-circle text-warning" style="margin-right:10px;"></em>
Fill in all missing information
</div>

<div class="p-3 bg-warning-dim" style="margin:-20px;" v-else>

<div v-if="$page.props.auth.user.status=='pending'">
<em class="icon ni ni-alert-circle text-warning" style="margin-right:10px;"></em>
Dasuns team is reviewing your application, you will be contacted shortly.
</div>

<div v-else-if="$page.props.auth.user.status=='interview'">
<strong>
Interview has been scheduled
</strong>
<p class="pt-2 pb-2">
<span class="mr-3">
<em class="icon ni ni-calender-date text-warning"></em>
{{ date_format(interview.date) }}
</span>
<span>
<em class="icon ni ni-clock text-warning"></em>
{{ interview.time.substring(0,5) }}
</span>
</p>
<p class="pt-1 pb-2">
{{ interview.comment }}
</p>
<div>
<div>
<a href="#" @click="show_panelist()"><strong><em class="icon ni ni-users-fill text-warning"></em>
{{ interview.panelists.length>1?interview.panelists.length+' Panelists':interview.panelists.length+' Panelist' }}

</strong></a>
</div>
</div>
</div>

<div v-else-if="$page.props.auth.user.status=='declined'">
Your application was declined

</div>
</div>

<div class="p-3 bg-warning-dim" v-if="message!=null && decline==null && interview==null">
<em class="icon ni ni-alert-circle"></em>
{{ message }}
</div>

<div class="p-3 bg-warning-dim" v-else-if="decline!=null && interview==null">
<div><strong>
Your application was declined
</strong></div>
<div class="pt-2">
{{ decline.message }}
</div>
</div>



<div>
<table class="table mt-5">
<thead style="border:none;">
<tr style="border:none;">
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
<em class="icon ni ni-caret-right-fill"></em>
Personal Statement
</div>
</th>
</tr>
</thead>
<tbody>
<tr>
<td style="font-size:13px;" class="text-muted">
{{ response.user_data.pssp_attributes.profile.about!=null?response.user_data.pssp_attributes.profile.about:'Missing' }}
</td>
</tr>
</tbody>
</table>

<el-divider></el-divider>
<table class="table mt-2">
<thead style="border:none;">
<tr style="border:none;">
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
<em class="icon ni ni-caret-right-fill"></em>
Professional Services I Provide
</div>
</th>
</tr>
</thead>

<tbody v-if="attributes.services.length>0" style="border:none;">
<tr v-for="s in attributes.services" :key="s.id" style="border:none;">
<td colspan="8" style="border:none;" class="pl-5">
<em class="icon ni ni-bullet-fill"></em> {{ s.name }}
</td>
</tr>
<tr>
<td colspan="8" style="padding:10px;"></td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="8" class="text-warning">Missing</td>
</tr>
</tbody>
<thead>
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;" class="pt-2">
<div>
<em class="icon ni ni-caret-right-fill"></em>
Identification Documents
</div>
</th>
</tr>
</thead>
<tbody v-if="attributes.document.length>0" style="border:none;">
<tr v-for="d in attributes.document" :key="d.id" style="border:none;">
<td colspan="3" style="border:none;">
<div class="pl-4">
{{ d.document }}
</div>
</td>
<th class="width-100" style="border:none;">

</th>
<td colspan="2" style="border:none;">
{{ d.document_number }}
</td>
<td style="border:none;">
<a href="#" class="hover">Download</a>
</td>
</tr>
</tbody>
<tbody v-else><tr><td class="text-warning">
<div class="p-2">Missing</div>
</td></tr></tbody>
</table>


<el-divider></el-divider>


<table class="table mt-3">
<thead>
<th colspan="8" style="border:none;color:#07372F;">
<div>
<em class="icon ni ni-caret-right-fill"></em> Work Experience
</div>
</th>
</thead>
<tbody v-if="attributes.experience.length>0">
<tr v-for="a in attributes.experience" :key="a.id" style="border:none;">
<td colspan="3" style="border:none;">
<div class="pl-4">
{{ a.organisation_name }}
</div>
</td>
<th class="width-100" style="border:none;">Position</th>
<td>
{{ a.position }}
</td>
<th style="border:none;">Dates</th>
<td colspan="2" style="font-size:13px;">
{{ a.from_date }} - {{ a.to_date }}
</td>
</tr>
</tbody>
<tbody v-else><tr><td class="text-warning">

<div class="p-2">Missing</div>
</td></tr></tbody>
</table>




<el-divider></el-divider>
<table class="table mt-2">
<thead>
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
<em class="icon ni ni-caret-right-fill"></em> Profession References
</div>
</th>
</tr>
</thead>
<tbody v-if="attributes.reference.length>0">
<tr>
<th>
<div class="pl-4">
Names
</div>
</th>
<th>Contacts</th>
<th>Position</th>
</tr>
<tr v-for=" r in attributes.reference" :key="r.id">
<td>
<div class="pl-4">{{ r.names }}</div>
</td>
<td style="text-transform:lowercase">
<div class="pb-4">
<div><em class="icon ni ni-call"></em> {{ r.tel }}</div>
<div><em class="icon ni ni-mail"></em>
{{ r.email }}
</div>
</div>

</td>
<td class="text-transform">{{ r.position }}</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">
<div class="p-2 pb-5">Missing</div>
</td></tr>
</tbody>
</table>





</div>










</el-card>
</div>
</div>
</template>
<script>
export default {
props:{
response:{},
},

data(){return{
panelist_menu:false,

attributes:{
document:this.response.user_data.pssp_attributes.identification_documents,
services:this.response.user_data.pssp_attributes.services,
experience:this.response.user_data.pssp_attributes.experience,
reference:this.response.user_data.pssp_attributes.references,
},
//user information
user:this.$page.props.auth.user,
message:null,
user_number:this.$page.props.auth.user_number,
decline:this.response.user_data.pssp_attributes.interview_decline,
account_status:this.response.user_data.pssp_attributes.status.account_status,
interview:this.response.user_data.pssp_attributes.interview,

}},

methods:{
missing_items(){
if(this.attributes.document.length==0 || this.attributes.experience.length==0 || this.attributes.reference.length==0){
this.message='Submit all missing information to from your profile page.';
}else{
this.message='Your submissions are under review by Dasuns team, you will be contacted shortly.';
}
},

date_format(item){
var s=item.split('-');
var r=s.reverse();
return r.join('/ ');
},

show_panelist(){
if(this.panelist_menu==false){
this.panelist_menu=true;
}else{
this.panelist_menu=false;
}
}






},
mounted(){
this.missing_items();

}



}
</script>
<style scoped>
.width-100{
width:100px;
}

table thead tr th{
padding:10px;
}

table tbody tr th, table tbody tr td{
padding:10px;
text-transform: capitalize;

}

table thead tr, table tbody tr{border:none;}

table thead tr th, table tbody tr td{border:none;}

.ac{
--color:red;
--background:red;
--border:none;

}
.ac{
background-color: aqua;
background:red;
}

</style>
