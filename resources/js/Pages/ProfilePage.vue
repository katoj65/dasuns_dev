<template>
<app-layout>

<div>
<div v-if="user.role=='admin' || user.role=='reception' || user.role=='finance'">
<employee-profile-component :response="response" :flash="flash" :errors="errors"></employee-profile-component>
</div>
<div v-else>



<!-----PSSP PROFILE-->
<div v-if="user.role=='pssp'">

<div class="row mt-2">
<div class="col-12 col-md-4">


<el-card class="box-card h-100 shadow-none card p-0">
<div class="card-inner p-0">
<div class="team">
<div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">

<li><a href="#" @click="edit_user_information()"><span>Edit User Information</span></a></li>

<li>
<a href="#" v-if="user.role=='pssp'" @click="dialog_box.about=true">Write your Statement</a>
</li>

<li v-if="user.role!='admin'"><a href="#" @click="add_services()"><span>Add Services</span></a></li>


<li v-if="user.role=='pssu' && user.account_type=='personal'">
<a href="#" @click="dialog_box.add_pssu_disability=true"><span>Add Disabilities</span></a></li>


<li v-if="user.role=='pssu' && user.account_type=='institutional'">
<a href="#" @click="dialog_box.add_organisation_contact=true"><span>Add Contact Person</span></a></li>

<li><a href="#" @click="dialog_box.delete_account=true"><span>Delete Account</span></a>
</li>


</ul>
</div>
</div>
</div>

<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info text-transform">
<h3 class="pb-2 pt-2">{{ user.usernames }}</h3>
<span class="sub-text text-transform pt-1 pb-1">
{{ user.account_type }} Account
</span>
<div class="sub-text text-transform pt-0 pb-1" v-if="user.dasuns_number!=null">
<strong style="margin-right:10px;">Service No:</strong>
{{ user.dasuns_number.number }}
</div>
</div>
</div>
<ul class="team-info">
<li><span><em class="icon ni ni-user-alt"></em> Gender</span><span style="text-transform:capitalize;">{{ user.gender }}</span></li>


<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-calender-date"></em> DOB</span><span style="text-transform:capitalize;">{{ user.dob.split('-').reverse().join('/') }} </span></li>


<li><span><em class="icon ni ni-call"></em> Telephone</span><span>{{ user.tel }} </span></li>
<li><span><em class="icon ni ni-mail"></em> Email</span>
<span>{{ user.email }} </span></li>


<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-map-pin"></em> Location</span><span style="text-transform:capitalize;">{{ profile.location }} </span></li>


<li v-else-if="user.account_type=='institutional'"><span><em class="icon ni ni-map-pin"></em> Location</span><span style="text-transform:capitalize;">{{ organisation_profile.location }} </span></li>




<li v-if="user.account_type!='institutional'"><span><em class="icon ni ni-globe"></em> Country</span><span style="text-transform:capitalize;">{{ profile.country }}</span></li>
<li v-if="user.account_type=='institutional'"><span><em class="icon ni ni-globe"></em> Country</span><span style="text-transform:capitalize;">{{ organisation_profile.country }}</span></li>








<li v-if="user.account_type=='institutional'"><span>
<em class="icon ni ni-building"></em> Type
</span><span style="text-transform:capitalize;">
{{ organisation_profile.name }}
</span></li>



</ul>



<!-- <div class="team-view">
<a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary"><span>View Profile</span></a>
</div> -->



</div><!-- .team -->
</div><!-- .card-inner -->






</el-card>





</div>
<div class="col-md-8">
<el-card class="card box-card shadow-none h-100">
<div slot="header" class="clearfix">
<span style="font-weight:bold;">Service Provider Profile Details</span>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>

<div class="card-body">


<div slot="header" class="clearfix bg-warning-dim p-2 mb-4"  v-if="$page.props.auth.user.status=='pending'" style="margin:-20px;">
<span><em class="icon ni ni-shield-alert text-warning"></em> Your account has not yet been approved by Dasuns Management Team</span>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>



<div>
<h4>Personal Statement</h4>
<p class="pt-2 text-muted" style="font-size:14px;">
{{ $page.props.auth.user_profile.about!=null?$page.props.auth.user_profile.about:'Missing' }}
</p>
</div>
<!-- <el-divider></el-divider> -->
<div class="mt-3">
<table style="width:100%;">
<thead class="border-none">
<tr style="border:none">
<th style="border:none" colspan="3">
<h4>Identification Documents</h4>
</th>
<th  style="width:50px;border:none;">
<add-identification-documents :response="response" :errors="errors" :flash="flash"></add-identification-documents>
</th>
</tr>
</thead>
<tbody v-if="response.user_data.identification.length>0">
<tr v-for="i in response.user_data.identification" :key="i.id">
<td style="width:50px;">
<div class="user-avatar sq bg-warning-dim"><em class="icon ni ni-file"></em></div>
</td>
<th>{{ i.document }}</th>
<td><strong>Document Number </strong> <span class="badge badge-outline-primary" style="font-size:14px;padding:10px;">{{ i.document_number }}</span></td>
<td>
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
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-danger">
Missing
</td>
</tr>
</tbody>
</table>

</div>
<el-divider></el-divider>
<div>
<table style="width:100%;">
<thead>
<tr>
<th style="border:none;padding-bottom:20px;">
<h4>Support Services I Provide</h4>
</th>
<th style="border:none;">
</th>
</tr>
</thead>
<tbody v-if="services.length>0" style="padding-top:30px;">
<tr v-for="s in services" :key="s.id">
<td><em class="icon ni ni-chevron-right"></em> {{ s.name }}</td>
<td style="width:50px;">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red">
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_services(s.id)"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-danger">Missing</td>
</tr>
</tbody>
</table>
</div>
<el-divider></el-divider>

<div>
<table style="width:100%;">
<thead>
<tr>
<th style="border:none;">
<h4>
Work Experience
</h4>
</th>
<th style="border:none;width:50px;">
<add-work-experience :response="response" :errors="errors" :flash="flash"></add-work-experience>
</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2" style="padding:0;">

<table class="table">
<thead >
<tr style="border:none;">
<th scope="col" style="border-bottom:none;" class="text-muted" colspan="2">Organisation Name</th>
<th scope="col" style="border-bottom:none;" class="text-muted">Position</th>
<th scope="col" style="border-bottom:none;" class="text-muted">From Date</th>
<th scope="col" style="border-bottom:none;" class="text-muted">To Date</th>
<th scope="col" style="border-bottom:none;"></th>
</tr>
</thead>
<tbody v-if="experience.length>0" style="border:none;">
<tr v-for="e in experience" :key="e.id">
<td aria-sort="width:30px;">
<div class="user-avatar sq bg-success-dim"><em class="icon ni ni-building"></em></div>
</td>
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
<td colspan="5" class="text-danger">
Missing
</td>
</tr>
</tbody>
</table>

</td>
</tr>
</tbody>
</table>

</div>
<el-divider></el-divider>

<div>
<table style="width:100%;">
<thead>
<th>
<h4>
Profession Reference
</h4>
</th>
<th style="width:50px;">
<add-reference style="text-transform:capitalize;font-weight:normal;font-family:font-family: 'Roboto', sans-serif;letter-spacing:1px;font-size:13px;" :errors="errors" :flash="flash" :response="response"></add-reference>
</th>
</thead>
<tbody>
<tr>
<td style="padding:0;padding-top:30px;" colspan="2">
<table class="table table-sm" style="width:100%;">
<thead>
<tr>
<th scope="col" style="border-bottom:none;" colspan="2">Employer Names</th>
<th scope="col" style="border-bottom:none;">Contacts</th>
<th scope="col" style="border-bottom:none;">Address</th>
<th scope="col" style="border-bottom:none;">Position</th>
<th scope="col" style="border-bottom:none;"></th>

</tr>
</thead>
<tbody class="text-muted" v-if="reference.length>0">
<tr v-for="r in reference" :key="r.id">
<td style="width:50px;">
<div class="nk-activity-media user-avatar bg-pink-dim"><em class="icon ni ni-user-alt-fill"></em></div>
</td>
<td class="word-transform">{{ r.names }} </td>
<td>
<div><em class="icon ni ni-call-fill"></em> {{ r.tel }}</div>
<div style="text-transform:lowercase;">
<em class="icon ni ni-mail-fill"></em> {{ r.email }}
</div>
</td>
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
<td colspan="6" class="text-danger">
Missing
</td>
</tr>
</tbody>
</table>

</td>
</tr>
</tbody>
</table>




</div>




</div>
</el-card>
</div>







</div>
</div>
</div>

































<!--Panalist profile---->
<profile-panelist :response="response" :errors="errors" :flash="flash" v-if="user.role=='panelist'"></profile-panelist>



<!---PSSU----->
<ProfilePSSU v-if="user.role=='pssu'" :response="response" :flash="flash" :errors="errors" ></ProfilePSSU>






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












<form @submit.prevent="submit_about"  v-if="dialog_box.about==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Write your statement</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.about=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">

<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.about"></input-error>
</label>
<div class="form-control-wrap">
<textarea type="text" class="form-control" id="default-01" placeholder="Write brief statement" v-model="form_about.about" style="min-height:300px;">
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
import ProfilePanelist from '@/Panelist/ProfilePanelist';
import ProfilePSSU from '@/PSSU/ProfilePSSU';
import PageTitle from '@/Shared/PageTitle';
import EmployeeProfileComponent from '@/Components/EmployeeProfileComponent';



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
ProfilePanelist,
ProfilePSSU,
PageTitle,
EmployeeProfileComponent



},


props:{
title:{},
response:{},
errors:{},
flash:{},
},

data(){return{
page_title:{
heading:'Service Provider Profile',
url:'dashboard'
},


//
form_about:this.$inertia.form({
about:this.$page.props.auth.user_profile.about,
id:this.$page.props.auth.user.id,
}
),


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
status:this.$page.props.auth.user.status,
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
about:false,
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

//
submit_about(){
this.form_about.post(this.route('update.profile_about'),{
onSuccess:()=>{
this.dialog_box.about=false;
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}

});
},






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
