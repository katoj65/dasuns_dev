<template>
<app-layout>
<div>
<div v-if="user.role=='admin' || user.role=='reception' || user.role=='finance'">
<profile-reception :errors="errors" :response="response" v-if="user.role=='reception'"></profile-reception>
</div>
<div v-else>
<div class="nk-block">
<div class="card" style="overflow:auto;">


<div class="card-header" style="background:#FEF9E7;border-bottom:solid thin #FCF3CF;" v-if="user.role=='pssp' && vet_status=='pending' && uploads.identification.length!=0 && uploads.reference.length!=0 && experience.length!=0">
<span class="ul">
<ul>
<!-- <li v-if="experience.length==0">
Add your professional experience.
</li>
<li v-if="uploads.identification.length==0">
Upload in your identification documents.
</li>
<li v-if="uploads.reference.length==0">
Add your professional references.
</li> -->

<li v-if="uploads.identification.length!=0 && uploads.reference.length!=0 && experience.length!=0">
Your submissions are under review by Dasuns team. you will be contacted shortly.
</li>
</ul>
</span>
</div>







<div class="card-aside-wrap">
<div class="card-inner card-inner-lg">
<div class="nk-block-head nk-block-head-lg">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h4 class="nk-block-title">
<span v-if="user.account_type=='personal' && user.role!='admin'" style="font-weight:bold;font-size:20px;">
{{ user.role=='pssu'?'Service User Account':'Service Provider Account' }}
</span>
<span v-else-if="user.account_type=='institutional' && user.role!='admin'" style="font-weight:bold;font-size:20px;">
Institution Account
</span>
<span v-else style="font-weight:bold;font-size:20px;">
Admin Account
</span>
</h4>
<div class="nk-block-des">
<!-- <p class="pt-2">
<em class="icon ni ni-tag-fill"></em>
{{ user.role=='pssu'?user.account_type=='personal'?'Services I Need':'Services I Need':'Services I Provide' }}

</p> -->


</div>
</div>
<div class="nk-block-head-content align-self-start d-lg-none">
<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
</div>
</div>
</div>
<!-- .nk-block-head -->

<div class="nk-block" style="margin-top:-25px;">
<div class="nk-data data-list" v-if="services.length>0">

<div class="data-head mb-4 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;word-spacing:4px;">
<em class="icon ni ni-grid-box-alt-fill"></em>
<span>
{{ user.role=='pssu'?user.account_type=='personal'?'Services I Need':'Services I Need':'Services I Provide' }}
</span>

<span class="float-right">
<!-- <em class="icon ni ni-pen2"></em> -->
</span>
</h6>
</div>


<div class="data-item" data-toggle="modal" data-target="#profile-edit" v-for="s in services" :key="s.id" style="padding:0px;margin:0;border:none;cursor: text;">
<div class="data-col" style="padding:0px;margin:0;">
<span class="data-label text-transform">
<em class="icon ni ni-stop-fill"></em> {{ s.name }}
</span>
<!-- <span class="data-value">Abu Bin Ishtiyak</span> -->
</div>

<div class="data-col data-col-end" style="padding-right:20px;" v-if="services.length>1">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_services(s.id)"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>


</div>
</div>



<div class="nk-data data-list" v-if="disabilities.length>0">
<div class="data-head mb-3 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;word-spacing:4px;">
<em class="icon ni ni-tag-fill"></em>
Nature of disability

<span class="float-right">

</span>
</h6>
</div>





<div class="data-item" data-toggle="modal" data-target="#profile-edit" v-for="d in disabilities" :key="d.id" style="padding:0px;margin:0;border:none;cursor: text;">
<div class="data-col" style="padding:0px;margin:0;">
<span class="data-label text-transform">
<em class="icon ni ni-stop-fill"></em> {{ d.name }}
</span>
</div>
<div class="data-col data-col-end" style="padding-right:20px;">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_disabilities(d.id)"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
</div>






<div v-if="user.role=='pssp'" class="pt-3">
<div class="nk-data data-list">
<div class="data-head mb-3 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;word-spacing:4px;">
<em class="icon ni ni-shield-fill"></em>
Identification documents
<span class="float-right">
<add-identification-documents :response="response" :errors="errors" :flash="flash"></add-identification-documents>
</span>
</h6>
</div>


<div class="data-item" data-toggle="modal" data-target="#profile-edit" style="padding:0px;margin:0;border:none;cursor: text;">
<table style="width:100%;">
<tbody class="text-muted" v-if="response.user_data.identification.length>0">
<tr v-for="i in response.user_data.identification" :key="i.id">
<td  style="border:none;width:50%;">
<em class="icon ni ni-file"></em>
<span style="margin-left:10px;">{{ i.document }}</span>
</td>
<td  style="border:none;">
{{ i.document_number }}
</td>
<td style="border:none;">
<a href="">View document</a>
</td>
<td style="width:50px;border:none;color:#D7DBDD;">
<div>
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_identification_document(i.id)"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>

</td>
</tr>
</tbody>
<tbody v-else>
<tr style="border:none;">
<td style="border:none;" class="text-warning">
Missing
</td>
</tr>
</tbody>

</table>
</div>
</div>







<div class="nk-data data-list pt-0">
<div class="data-head mb-3 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;word-spacing:4px;">
<em class="icon ni ni-folder-fill"></em>
Work Experience
<span class="float-right">
<add-work-experience :response="response" :errors="errors" :flash="flash"></add-work-experience>
</span>
</h6>
</div>
<div>

<table class="table">
<thead style="border:none;">
<tr style="border:none;">
<th scope="col" style="border-bottom:none;">Organisation Name</th>
<th scope="col" style="border-bottom:none;">Position Held</th>
<th scope="col" style="border-bottom:none;">From Date</th>
<th scope="col" style="border-bottom:none;">To Date</th>
<th scope="col" style="border-bottom:none;"></th>
</tr>
</thead >
<tbody v-if="experience.length>0" style="border:none;">
<tr v-for="e in experience" :key="e.id">
<td class="text-muted">
{{ e.organisation_name }}
</td>
<td class="text-muted">
{{ e.position }}
</td>
<td class="text-muted">
{{ e.from_date }}
</td>
<td class="text-muted">
{{ e.to_date }}
</td>
<td class="text-muted">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" @click="delete_pssp_experience(e.id)" style="border:none;"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="5" class="text-warning">
Missing
</td>
</tr>
</tbody>
</table>










</div>
</div>









<div class="nk-data data-list pt-3">
<div class="data-head mb-3 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;">
<em class="icon ni ni-users-fill"></em>
Reference
<span class="float-right">
<add-reference style="text-transform:capitalize;font-weight:normal;font-family:font-family: 'Roboto', sans-serif;letter-spacing:1px;font-size:13px;" :errors="errors" :flash="flash" :response="response"></add-reference>
</span>
</h6>
</div>




<!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit" v-for="r in reference" :key="r.id" style="padding:0px;margin:0;border:none;cursor: text;">
<div class="data-col" style="padding:0px;margin:0;">
<span class="data-label text-transform">
{{ r.names }}
</span>
<span class="data-value">Abu Bin Ishtiyak</span>
</div>
<div class="data-col data-col-end"> -->
<!-- <span class="data-more"><em class="icon ni ni-forward-ios"></em>
</span> -->
<!-- </div>
</div> -->

<div class="data-item" data-toggle="modal" data-target="#profile-edit" style="padding:0px;margin:0;border:none;cursor: text;">

<table class="table table-sm">
<thead>
<tr>
<th scope="col" style="border-bottom:none;">Names</th>
<th scope="col" style="border-bottom:none;">Telephone</th>
<th scope="col" style="border-bottom:none;">Email</th>
<th scope="col" style="border-bottom:none;">Address</th>
<th scope="col" style="border-bottom:none;">Position</th>
<th scope="col" style="border-bottom:none;"></th>

</tr>
</thead>
<tbody class="text-muted" v-if="reference.length>0">
<tr v-for="r in reference" :key="r.id">
<td class="word-transform">{{ r.names }} </td>
<td>{{ r.tel }} </td>
<td>{{ r.email }} </td>
<td class="word-transform">{{ r.address}}</td>
<td class="word-transform">{{ r.position }} </td>
<td>
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" @click="delete_reference(r.id)" style="border:none;"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="6" class="text-warning">
Missing
</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>

<div v-if="user.role=='pssu' && user.account_type=='institutional'">
<div class="nk-data data-list pt-3">
<div class="data-head mb-3 bg-success-dim">
<h6 class="overline-title" style="letter-spacing:1px;">
<em class="icon ni ni-users-fill"></em>
Contact Person
<span class="float-right">
<!-- <add-reference style="text-transform:capitalize;font-weight:normal;font-family:font-family: 'Roboto', sans-serif;letter-spacing:1px;font-size:13px;" :errors="errors" :flash="flash" :response="response"></add-reference> -->
</span>
</h6>
</div>












<div class="nk-tb-list nk-tb-ulist" style="border:none;" v-if="organisation_contact.length>0">
<div class="nk-tb-item nk-tb-head" style="border:none;">
<div class="nk-tb-col bold" style="border:none;"><span>Names</span></div>
<div class="nk-tb-col tb-col-mb bold" style="border:none;"><span>Gender</span></div>
<div class="nk-tb-col tb-col-md bold" style="border:none;"><span>Role</span></div>
<div class="nk-tb-col tb-col-lg bold" style="border:none;"><span>Telephone</span></div>
<div class="nk-tb-col tb-col-md bold" style="border:none;"><span>Email Address</span></div>
<div class="nk-tb-col nk-tb-col-tools" style="border:none;">&nbsp;</div>
</div><!-- .nk-tb-item -->

<div class="nk-tb-item" v-for="o in organisation_contact" :key="o.id">
<div class="nk-tb-col" style="border:none;">
<div class="user-card">
<div class="user-info">
<span class="tb-lead word-transform">
<em class="icon ni ni-user-circle-fill"></em>
{{ o.firstname+' '+o.lastname }} <span class="dot dot-success d-md-none ml-1"></span></span>
<!-- <span>UD01544</span> -->
</div>
</div>
</div>
<div class="nk-tb-col tb-col-mb" style="border:none;">
<span class="tb-lead-sub word-transform">{{ o.gender }} </span>
</div>
<div class="nk-tb-col tb-col-md word-transform" style="border:none;">
{{ o.role }}
</div>
<div class="nk-tb-col tb-col-lg" style="border:none;">
<span class="tb-date word-transform">
{{ o.tel }}
</span>
</div>
<div class="nk-tb-col tb-col-md word-transform" style="text-transform:lowercase;border:none;">
{{ o.email }}
</div>
<div class="nk-tb-col nk-tb-col-tools" style="border:none;">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-button type="clear" icon="el-icon-delete" style="border:none;padding-left:30px;padding-right:30px;" @click="delete_institution_contact_person(o.id)"></el-button>
</el-dropdown-menu>
</el-dropdown>
</div>
</div><!-- .nk-tb-item -->
</div>
<div v-else class="text-warning"> Missing </div>














<!-------end-------->









</div>
</div>




<div class="pt-5">
<div style="padding-bottom:20px;" v-if="user.role==='pssp'">
<Inertia-link :href="route('home')" class="btn  button bg-success-dim" style="padding:10px;border-radius:5px;color:black;" v-if="vet_status!='pending'"><span>DASHBOARD</span></Inertia-link>
</div>
<div  style="padding-bottom:20px;" v-else-if="user.role=='pssu'">
<Inertia-link :href="route('home')" class="btn btn-block button bg-success-dim" style="padding:10px;border-radius:5px;color:black;"><span>DASHBOARD</span></Inertia-link>
</div>
</div>


<!-- data-list -->
</div><!-- .nk-block -->
</div>











<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true" style="border:none;">
<div class="card-inner-group" data-simplebar="init">
<div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
<div class="simplebar-mask" style="border:none;">
<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
<div class="simplebar-content-wrapper" style="height: auto; overflow: hidden">
<div class="simplebar-content" style="padding:10px;">


<div class="card">
<div class="card-inner">
<div class="team">
<div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">

<li><a href="#" @click="edit_user_information()"><span>Edit User Information</span></a></li>

<li v-if="user.role!='admin'"><a href="#" @click="add_services()"><span>Add Services</span></a></li>


<li v-if="user.role=='pssu' && user.account_type=='personal'">
<a href="#" @click="dialog_box.add_pssu_disability=true"><span>Add Disabilities</span></a></li>


<li v-if="user.role=='pssu' && user.account_type=='institutional'">
<a href="#" @click="dialog_box.add_organisation_contact=true"><span>Add Contact Person</span></a></li>






<li><a href="#" @click="dialog_box.delete_account=true"><span>Delete Account</span></a></li>

</ul>
</div>
</div>
</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg" style="background:#37BEA7;">
<span>
<em class="icon ni ni-user-alt-fill" v-if="user.account_type=='personal'"></em>
<em class="icon ni ni-building" v-else></em>
</span>
</div>
<div class="user-info">
<h6 class="text-transform" style="font-size:20px;">{{ user.usernames }} </h6>
<span class="sub-text text-transform pt-1 pb-1">
{{ user.account_type }} Account
</span>
<div class="sub-text text-transform pt-0 pb-1" v-if="user.dasuns_number!=null">
<strong style="margin-right:10px;">Dasuns No:</strong>
{{ user.dasuns_number.number }}
</div>
</div>
</div>


<ul class="team-info">
<li><span><em class="icon ni ni-user-alt"></em> Gender</span><span style="text-transform:capitalize;">{{ user.gender }}</span></li>
<li><span><em class="icon ni ni-call"></em> Telephone</span><span>{{ user.tel }} </span></li>
<li><span><em class="icon ni ni-mail"></em> Email</span>
<span>{{ user.email }} </span></li>


<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-map-pin"></em> Location</span><span style="text-transform:capitalize;">{{ profile.location }} </span></li>


<li v-else-if="user.account_type=='institutional'"><span><em class="icon ni ni-map-pin"></em> Location</span><span style="text-transform:capitalize;">{{ organisation_profile.location }} </span></li>




<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-globe"></em> Country</span><span style="text-transform:capitalize;">{{ profile.country }}</span></li>
<li v-if="user.account_type=='institutional'"><span><em class="icon ni ni-globe"></em> Country</span><span style="text-transform:capitalize;">{{ organisation_profile.country }}</span></li>





<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-calender-date"></em> DOB</span><span style="text-transform:capitalize;">{{ user.dob }} </span></li>


<li v-if="user.account_type=='institutional'"><span>
<em class="icon ni ni-building"></em> Type
</span><span style="text-transform:capitalize;">
{{ organisation_profile.name }}
</span></li>



</ul>





<!--
<div class="team-view" style="padding-bottom:20px;" v-if="user.role==='pssp'">
<Inertia-link :href="route('home')" class="btn btn-block button" style="padding:10px;border-radius:5px;" v-if="vet_status!='pending'"><span><em class="icon ni ni-dashboard"></em> Dashboard</span></Inertia-link>

</div>

<div class="team-view" style="padding-bottom:20px;" v-else-if="user.role=='pssu'">
<Inertia-link :href="route('home')" class="btn btn-block button" style="padding:10px;border-radius:5px;"><span><em class="icon ni ni-dashboard"></em> Dashboard</span></Inertia-link>

</div> -->




</div><!-- .team -->
</div><!-- .card-inner -->
</div>















</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 492px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div><!-- .card-inner-group -->
</div>










<!-- card-aside -->
</div><!-- .card-aside-wrap -->
</div>
</div>




<!-----Dialog boxes-->
<update-user-information :reesponse="response" :errors="errors" :flash="flash" v-if="dialog_box.edit_user==true">
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.edit_user=false">
<em class="icon ni ni-cross"></em>
</a>
</update-user-information>
<AddPSSPService :response="response" :errors="errors" :flash="flash" v-if="dialog_box.add_service==true">
<a href="#" class="close" @click="dialog_box.add_service=false">
<em class="icon ni ni-cross"></em>
</a>
</AddPSSPService>
<add-organisation-contact-person :response="response" :errors="errors" v-if="dialog_box.add_organisation_contact==true">
<a href="#" class="close" @click="dialog_box.add_organisation_contact=false">
<em class="icon ni ni-cross"></em>
</a>
</add-organisation-contact-person>
<!-----Dialog 2---->

<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.add_pssu_disability==true" @submit.prevent="submit_pssu_disability">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Disabilities</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.add_pssu_disability=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.disabilityID"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_pssu_disability($event)">
<option value="">-- Select Disability --</option>
<option v-for="ds in response.user_data.list_disabilities" :key="ds.id" :value="ds.id">
{{ ds.name }}
</option>

</select>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button class="button" type="submit" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;">Save</button>
</span>
</div>
</div>
</div>
</form>
<!-----Dialog2-->

<!------Delete account------->
<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.delete_account==true" @submit.prevent="submit_pssu_disability">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">
<em class="icon ni ni-shield-alert-fill"></em>
Delete Your Account</h5>
</div>
<div class="modal-body">
<p class="pt-3 pb-3" style="text-align:center;">
Do you want to delete your account?
</p>

</div>
<div class="bg-light p-3" style="text-align:center;border-radius:0px 0 5px 5px;">
<button class="button btn-danger" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;margin-right:20px;background:orange;" @click="dialog_box.delete_account=false">Cancel</button>
<button class="button" type="submit" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;">Yes</button>

</div>
</div>
</div>
</form>















</div>
</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import AddReference from '@/PSSP/AddReference';
import AddIdentificationDocuments from '@/PSSP/AddIdentificationDocuments';
import DeleteComponent from '@/Components/DeleteComponent';
import AddServices from '@/PSSP/AddServices';
import UpdateUserInformation from '@/PSSP/UpdateUserInformation';
import AddPSSPService from '@/PSSP/AddPSSPService';
import InputError from '@/Alerts/InputError.vue';
import AddWorkExperience from '@/PSSP/AddWorkExperience';
import AddOrganisationContactPerson from '@/PSSU/AddOrganisationContactPerson';
import ProfileReception from '@/Reception/ProfileReception';



export default {
components:{
AppLayout,
AddReference,
AddIdentificationDocuments,
DeleteComponent,
AddServices,
UpdateUserInformation,
AddPSSPService,
InputError,
AddWorkExperience,
AddOrganisationContactPerson,
ProfileReception,


},


props:{
title:{},
response:{},
errors:{},
flash:{},
},

data(){return{
//experience
experience:this.response.user_data.experience,
//user
user:{
usernames:this.response.user.account_type=='institutional'?this.response.user.firstname:this.response.user.firstname+' '+this.response.user.lastname,
tel:this.response.user.tel,
email:this.response.user.email,
role:this.response.user.role,
account_type:this.response.user.account_type,
gender:this.response.user.gender,
dob:this.response.user.dob,
dasuns_number:null,
},


//profile
profile:this.$page.props.auth.user_profile,
services:this.response.services,
disabilities:this.response.disabilities,
reference:this.$page.props.auth.user.role=='pssp'?this.response.user_data.reference:[],
vet_status:this.$page.props.user.role=='pssp'?this.$page.props.auth.user_profile.vet_status:null,



//start dialog box
dialog_box:{
edit_user:false,
add_disability:false,
delete_account:false,
add_service:false,
add_pssu_disability:false,
delete_account:false,
add_organisation_contact:false,
},

//uploads
uploads:this.$page.props.auth.user.role=='pssp'?{
identification:this.response.user_data.identification,
reference:this.response.user_data.reference,
}:null,

//
disability_form:null,
organisation_contact:this.$page.props.auth.user.account_type=='institutional'?this.response.user_data.institutional_contact_person:null,
organisation_profile:this.$page.props.auth.user.account_type=='institutional'?this.response.user_data.organisation_profile:null,








}},



methods:{

//delete references
delete_reference(id){
this.$inertia.post(this.route('delete_ppsp_reference'),{
id:id
},{
onSuccess:()=>{
this.$inertia.get(route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: 'Reference has been deleted.',
type: 'success'
});
}
});
},



//delete identification document
delete_identification_document(id){
this.$inertia.post(this.route('delete_pssp_identification_document'),{
id:id,
},{
onSuccess:()=>{
this.$inertia.get(route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: 'Document has been deleted.',
type: 'success'
});
}
});
},


//delete PSSP services
delete_services(id){
this.$inertia.post(this.route('delete-services'),{
id:id,
},{
onSuccess:()=>{
this.$inertia.get(route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: 'Profession service has been deleted.',
type: 'success'
});
}
});


},


//dialog box
edit_user_information(){
this.dialog_box.edit_user=true;
},


//delete service
delete_user_services(id){
this.$inertia.post(this.route(''),{
id:id
});
},






//delete disability
delete_disabilities(id){
this.$inertia.post(this.route('delete_disabilities'),{
id:id},
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: 'Disability has been deleted.',
type: 'success'
}));
this.$inertia.get(this.route('profile'));
},

//
select_pssu_disability(event){
this.disability_form=event.target.value;
},

//
add_services(){
this.dialog_box.add_service=true;
},

//submit PSSU disability
submit_pssu_disability(){
this.$inertia.post(this.route('store.pssu_disabilities'),{
disabilityID:this.disability_form
},{

onSuccess:()=>{
var flash=this.$page.props.flash;
  this.$notify({
    position: 'bottom-right',
          title: 'Success',
          message:flash.success!=null?flash.success:flash.warning,
          type:flash.success!=null?'success':'warning'
        });
        this.$inertia.get(this.route('profile'));
}


});
},

//delete account
account_delete(){
    this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning'
        }).then(() => {
          this.$message({
            type: 'success',
            message: 'Delete completed'
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: 'Delete canceled'
          });
        });
},



//delete experience
delete_pssp_experience(id){
this.$inertia.post(this.route('delete.pssp_experience'),{
id:id
},{

onSuccess:()=>{
var flash=this.$page.props.flash;
this.$inertia.get(this.route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message:flash.success,
type: 'success'
});


}

});
},

get_dasuns_number(){
var num=this.$page.props.auth.user_number;
if(num!=null){
this.user.dasuns_number=num
}else{
this.user.dasuns_number=null;
}
},

//delete institutional contact person information
delete_institution_contact_person(item){
this.$inertia.post(this.route('delete.organisation_contact_person'),{
id:item
},
{

onSuccess:()=>{
var flash=this.$page.props.flash;
this.$inertia.get(this.route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message:flash.success,
type: 'success'
});


}



}



);

}



},
mounted(){
this.get_dasuns_number();
}





}
</script>

<style scoped>
table thead tr td{
border-bottom:solid thin #F2F3F4;
}

table thead tr th{
border-bottom:solid thin #F2F3F4;
}

table tbody tr td{
padding:10px;
border:none;
}
.word-transform{
text-transform: capitalize;
}

table tbody tr th{
border:none;
text-transform: capitalize;
}

table tbody tr td{
border:none;
text-transform: capitalize;
}

.ul ul li{
list-style-type: circle;
}

.bold{
    font-weight: bold
    ;
}
</style>
