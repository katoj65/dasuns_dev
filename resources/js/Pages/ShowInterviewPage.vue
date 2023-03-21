<template>
<app-layout>
<div class="row pt-2 pb-3">
<div class="col-12 col-md-4">
<el-card class="card  h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2 ">
<!-- <div class="mb-3">
<span>

<em class="icon ni ni-calender-date-fill text-success" style="font-size:50px;"></em>

</span>
</div> -->

<div class="user-avatar sq bg-warning-dim" style="width:70px;height:60px;">
<span><em class="icon ni ni-calender-date-fill text-warning" style="font-size:50px;margin:10px;"></em></span>

</div>

<div class="user-info">
<h1 style="font-size:20px;" class="mb-2 mt-3">{{ i.date }} </h1>
<span class="sub-text pt-4" style="font-size:20px;"><em class="icon ni ni-clock mr-3 text-success"></em> {{ i.time }}</span>
</div>
</div>






<div v-if="i.status=='pending' || i.status=='interview'">

<div class="team-view mt-5" v-if="$page.props.auth.user.role=='panelist'">
<div v-if="panelist_status==false">
<a href="#" class="btn btn-block btn-success" @click="recommendation_dialog(true)"><span>Recommend Applicant</span></a>
</div>
<!-- <div class="text-muted">
<em class="icon ni ni-check-circle-fill text-success" style="font-size:50px;"></em>
</div> -->
</div>

<div class="team-view mt-5" v-else>
<span v-if="response.panelists.length>0">
<button disabled class="btn btn-block btn-dim  btn-outline-success btn-round">{{ response.panelists.length>1?response.panelists.length+' Panelists':response.panelists.length+' Panelist'}} </button>
</span>
<span v-else>
<a href="#" class="btn btn-block btn-dim btn-success" @click="change_dialog(true)"><span>Change</span></a>
</span>
</div>

</div>

<div v-else-if="i.status=='active'">
<div class="team-view mt-5">
<button class="btn btn-block btn-dim btn-success " disabled><span><em class="icon ni ni-check-circle mr-3"></em> Recommended</span></button>
</div>
</div>



</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>
</div>
















<div class="col-12 col-md-8">
<el-card class="card h-100" shadow="true">
<div slot="header" class="clearfix">
<span><strong style="font-size:18px;">Interview Appointment</strong></span>
<el-dropdown trigger="click" style="float:right;" v-if="role=='reception'">
<span class="el-dropdown-link">
<buttopn class="btn bg-success" ><em class="icon ni ni-more-h text-white"></em></buttopn>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" style="padding:5px;" @click="delete_item(response.interview.interviewID)">Delete</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
  </div>


<div class="card-body p-0" style="min-height:700px;">
<div class="mt-0">
<ul class="data-list is-compact">

<li class="data-item">
<div class="data-col">
<div class="data-label">Names</div>
<div class="data-value text-transform" style="font-weight:bold;">{{ i.firstname }} {{ i.lastname }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform"> {{ i.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value">
{{ i.dob }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number</div>
<div class="data-value">
{{ i.tel }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ i.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Physical Address</div>
<div class="data-value text-transform">
{{ i.location }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Country of Residence</div>
<div class="data-value">{{ i.country }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Dasuns Number </div>
<div class="data-value">{{ i.number }} </div>
</div>
</li>







<li class="data-item mt-3">
<div class="data-col">
<div class="data-label">
<div>
<h1 class="mb-1 size15">
<em class="icon ni ni-list-thumb-alt-fill"></em>
Services
</h1>
<div>
<ul>
<li v-for="x in s" :key="x.id">
<span>
<em class="icon ni ni-dot"></em>
</span>
<span>{{ x.name }}</span>
</li>
</ul>
</div>
</div>
</div>
<!-- <div class="data-value text-break">1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</div> -->
</div>
</li>







<li class="data-item pt-4">
<div class="data-col">
<!-- <div class="data-label">Comment</div> -->
<div class="data-value">
<div>
<h1 class="pb-2 size15">
<em class="icon ni ni-alert-fill"></em>
Comment
</h1>
<div>
{{ i.comment }}
</div>
</div>
</div>
</div>
</li>




<li class="pt-4">
<div>


<el-collapse accordion >
<el-collapse-item name="1">
<template slot="title">
<h3 class="size15" style="padding-left:20px;padding-right:20px;">
<em class="icon ni ni-shield-fill text-muted"></em>
Identification Documents
</h3>
</template>
<div style="padding-left:20px;padding-right:20px;">

<table style="width:100%;" class="text-muted">
<tbody v-if="documents.length>0">
<tr v-for="d in documents" :key="d.id">
<td>
{{ d.document }}
</td>
<td>
{{ d.document_number }}
</td>
<td>
<a href="#">File</a>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">
Missing
</td>
</tr>
</tbody>
</table>




</div>
</el-collapse-item>
<el-collapse-item  name="2">
<template slot="title">
<h3 class="size15 bold" style="padding-left:20px;padding-right:20px;"><em class="icon ni ni-folder-fill text-muted"></em> Profession Experience</h3>
</template>
<div class="pl-2 pr-2">
<table class="table">
<thead>
<tr class="border-0">
<th scope="col" class="border-0">Organisation</th>
<th scope="col" class="border-0">Position</th>
<th scope="col" class="border-0">From date</th>
<th scope="col" class="border-0">To date</th>
</tr>
</thead>
<tbody class="border-0" v-if="response.expereinces.length>0">
<tr v-for="e in response.expereinces" :key="e.id" class="border-0">
<td scope="row" class="border-0 text-transform">
{{ e.organisation_name }}
</td>
<td class="border-0 text-transform">
{{ e.position }}
</td>
<td class="border-0">
{{ e.from_date }}
</td>
<td class="border-0">
{{ e.to_date }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">Missing</td>
</tr>
</tbody>
</table>
</div>
</el-collapse-item>


<el-collapse-item name="3">
<template slot="title">
<h3 class="bold size15" style="padding-left:20px;padding-right:20px;">
<em class="icon ni ni-tag-fill text-muted"></em> Profession References</h3>
</template>
<div class="pl-2 pr-2" style="padding-left:20px;padding-right:20px;">
<table class="table">
<thead>
<tr class="border-0">
<th scope="col" class="border-0">Names</th>
<th scope="col" class="border-0">Telephone</th>
<th scope="col" class="border-0">Email</th>
<th scope="col" class="border-0">Address</th>
<th scope="col" class="border-0">Position</th>

</tr>
</thead>
<tbody class="border-0" v-if="response.references.length>0">
<tr v-for="r in response.references" :key="r.id" class="border-0">
<td scope="row" class="border-0 text-transform">
{{ r.names}}
</td>
<td class="border-0 text-transform">
{{ r.tel }}
</td>
<td class="border-0">
{{ r.email }}
</td>
<td class="border-0">
{{ r.address }}
</td>
<td class="border-0 text-transform">
{{ r.position }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">Missing</td>
</tr>
</tbody>
</table>
</div>
</el-collapse-item>
</el-collapse>


</div>
</li>







<li class="data-item">
<div class="card thick-border card-preview mt-2" style="width:100%;">
<table class="table table-ulogs"  style="margin-top:-3px;">
<thead class="thick-bg">
<tr>
<th>
Panelist Names
</th>
<th colspan="1">
Recommendations
</th>
</tr>
</thead>
<tbody v-if="response.panelists.length>0">

<tr v-for="r in response.panelists">
<td class="text-transform p-2">
<em class="icon ni ni-user-alt-fill text-warning mr-2"></em>
{{ r.firstname }} {{ r.lastname }}
</td>
<td class="p-2">
<div v-if="r.recommendation.length>0">
<div v-for="rc in r.recommendation">
<span class="mr-2 text-success">
{{ rc.name }} :
</span>
<span>
{{ rc.comment }}
</span>
</div>
</div>
<div v-else class="text-warning">
No recommendation yet.
</div>
</td>
</tr>

</tbody>

<body v-else>
<tr><td colspan="2">No recommendations so far.</td></tr>
</body>
</table>
</div>









</li>
</ul>
</div>
</div>



<div class="card-footer bg-light" v-if="response.has_recommendations==true && i.status=='interview'">
<div class="row">
<div class="col-12 col-md-6">
</div>
<div class="col-12 col-md-6" style="text-align:right;">
<el-dropdown trigger="click">
<span class="el-dropdown-link btn btn-success" style="font-size:15px;">
Account Approval<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" @click="dialog_confirmation()" style="padding:10px;">Approve</a></el-dropdown-item>
<el-dropdown-item><a href="#" style="padding:10px;" @click="dialog_rejection()">Reject</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
</div>
</el-card>



<!--------->











</div>
</div>













<!---------Recommendation-->
<form class=""  v-if="dialog.recommentation==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit2">
<div class="modal-dialog" role="document">



<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Interview Panelist Recommendation</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="recommendation_dialog(false)">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.option"></input-error>
</label>
<div class="form-control-wrap">
<select type="text" class="form-control" @change="select_option($event)">
<option>-- Select Recommendation --</option>
<option v-for="r in recommend" :key="r.id" :value="r.id">
{{ r.name }}
</option>
</select>
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<textarea type="text" class="form-control" id="default-01" placeholder="Enter  your comment" v-model="form2.comment"></textarea>
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




<!-------Change----->

<form class=""  v-if="dialog.change==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Change Interview Details</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="change_dialog(false)">
<em class="icon ni ni-cross size18"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">

<div class="form-group">
<label class="form-label" for="default-01">
Date
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter date" v-model="form.date">
</div>
</div>

<div class="form-group">
<label class="form-label" for="default-01">
Time
 <input-error :error="errors.time"></input-error>
</label>
<div class="form-control-wrap">
<input type="time" class="form-control" id="default-01" placeholder="Enter time" v-model="form.time">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
Comment
 <input-error :error="errors.comment"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter comment" v-model="form.comment">
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











<!---------Confrimation dialog------>
<div class=""  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog.confirmation==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Account Approval Confirmation</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_confirmation()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">
<p>Do you really want to approved this account?</p>
</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button class="btn mr-3 button-bg" @click="submit_account_approval()">Yes</button>
<button class="btn btn-danger" @click="dialog_confirmation()">No</button>
</span>
</div>
</div>
</div>
</div>












<!---------reject application-------->
<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog.rejection==true" @submit.prevent="submit_rejection">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Rejected Interview Comment</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_rejection()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">

<div class="form-group">
<label class="form-label" for="default-01">
 <input-error :error="errors.comment_field"></input-error>
</label>
<div class="form-control-wrap">
<textarea  class="form-control" id="default-01" placeholder="Enter comment" v-model="form_rejection.comment_field">
</textarea>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<input type="submit" class="button" value="Submit" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>








</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';
import PageTitle from '@/Shared/PageTitle';
export default {
components:{
AppLayout,
InputError,
PageTitle

},


props:{
title:{},
response:{},
flash:{},
errors:{},
},

data(){return{
page_title:{
url:'dashboard',
heading:'Interview Appointment',
},


i:this.$page.props.response.interview,
s:this.$page.props.response.services,
p:this.$page.props.response.panelists,
recommend:this.response.recommenation_options,

documents:this.response.documents,
references:this.response.references,
experiences:this.response.experiences,
pssp_recommendation:this.response.recommentation,

//
dialog:{
change:false,
recommentation:false,
confirmation:false,
rejection:false,
},
//
form:this.$inertia.form({
date:this.response.interview.date,
time:this.response.interview.time,
id:this.response.interview.interviewID,
comment:this.$page.props.response.interview.comment,
}),

//
form2:this.$inertia.form({
option:null,
comment:null,
id:this.response.interview.interviewID
}),
form2_errors:{
option:null,
},

panelist_status:this.response.panelist_status,

//delete
delete_form:this.$inertia.form({
id:this.response.interview.interviewID,
}),

//interview approval form
form_approval:this.$inertia.form({
id:this.response.interview.interviewID,
}),


//rejection form
form_rejection:this.$inertia.form({
id:this.response.interview.interviewID,
comment_field:null,
}),



}},

methods:{
//
submit_rejection(){
this.form_rejection.post(this.route('store.interview_rejection'),{
onSuccess:()=>{
this.$notify({
position: 'bottom-right',
title:'Successful',
message:this.$page.props.flash.success,
type:'success'
});

}
});
},





//
submit_account_approval(){
this.form_approval.post(this.route('store.pssp_account_approval'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title:'Successful',
message:this.$page.props.flash.success,
type:'success'
});
}
});
},



//
recommendation_dialog(state){
this.errors={};
this.dialog.recommentation=state;
},

//
change_dialog(state){
this.dialog.change=state;
},


//
submit(){
if(this.form.time!=this.i.time || this.form.date!=this.i.date || this.form.comment!=this.$page.props.response.interview.comment){
this.form.post(this.route('update.interview'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title:'Successful',
message:this.$page.props.flash.success,
type:'success'
});

}
});

}else{
this.$notify({
    position: 'bottom-right',
 title:'Warning',
 message:'Interview information was not edited.',
 type:'warning'
});
}
this.dialog.change=false;

},

//
submit2(){
this.form2.post(this.route('store.interview_recommendation'),{
onSuccess:()=>{
this.errors=null;
this.$notify({
    position: 'bottom-right',
title:'Successful',
message:this.$page.props.flash.success,
type:'success'
});
}
});
},


//
select_option(event){
this.form2.option=event.target.value;
},


//
delete_item(){
this.delete_form.post(this.route('delete.interview'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title:'Success',
message:this.flash.success,
type:success
});
}
});
},




//

dialog_confirmation(){
    if(this.dialog.confirmation==false){
this.dialog.confirmation=true;
    }else{
this.dialog.confirmation=false;
    }

},

//

dialog_rejection(){
this.errors={};
if(this.dialog.rejection==false){
this.dialog.rejection=true;
}else{
this.dialog.rejection=false;
}
}


},

computed:{
role(){
return this.$page.props.auth.user.role;
}


}





}
</script>

<style scoped>

.data-item{
border:none;
}



</style>
