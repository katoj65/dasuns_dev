<template>
<app-layout>
<div class="card">
<div class="card-header bg-warning-dim text-center" v-if="$page.props.auth.user.status=='pending'" style="font-size:15px;">
<em class="icon ni ni-shield-alert text-warning"></em>
Your account has not yet been approved by Dasuns Management Team
</div>


<div class="card-header bg-warning-dim text-center" v-else-if="$page.props.auth.user.status=='interview'" style="font-size:15px;">
<em class="icon ni ni-calendar-booking text-warning"></em>
Interview has been schedules
</div>




<div class="card-body">
<div class="row">
<div class="col-12 col-md-4">

<div class="card border-0">
<div class="card-inner">
<div class="team">
<div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">

<li><a href="#" @click="edit_user_information()"><span>Edit User Information</span></a></li>

<li>
<a href="#" v-if="user.role=='pssp'" @click="dialog_box.about=true">Add About Information</a>
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
<strong style="margin-right:10px;">Dasuns No:</strong>
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
</div>
</div>


















<div class="col-12 col-md-8 pt-3">

<div class="card border">
<div class="card-header border-bottom pb-0 bg-white" >
<div class="card-title pb-0">
<h4>
<page-title :title="page_title"></page-title>
</h4>
</div>
</div>
<div class="card-body" style="min-height:500px;padding:0;">
<table style="width:100%;">
<thead class="">
<th class="p-1"> <em class="icon ni ni-caret-right-fill text-success"></em>
Personal Statement
</th>
</thead>

<tbody class="border-bottom">
<tr>
<td class="pl-4 pb-4 -pr-4">

{{ $page.props.auth.user_profile.about }}

</td>


</tr>

</tbody>


<thead>
<th class="p-1"> <em class="icon ni ni-caret-right-fill text-success"></em>
Support Services
</th>
</thead>
<tbody>
<tr>
<th class="p-2"></th>
</tr>
<tr>
<td>
<div v-if="services.length>0" class="pb-3">
<ul>
<li  v-for="s in services" :key="s.id" class="p-1">
<div class="row">
<div class="col-10">
<em class="icon ni ni-dot"></em>
{{ s.name }}
</div>
<div class="col-2">
<div>
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
</div>
</div>
</div>
</li>
</ul>
</div>
<div v-else class="text-warning">Missing</div>
</td>
</tr>
</tbody>
<thead  v-if="user.role=='pssp'"  class="border-top">
<tr >
<th class="border-0 p-1">
<div class="row">
<div class="col-10 ">
<em class="icon ni ni-caret-right-fill text-success"></em>
Identification Documents
</div>
<div class="col-2">
<add-identification-documents :response="response" :errors="errors" :flash="flash"></add-identification-documents>
</div>
</div>
</th>
</tr>
</thead>
<tbody v-if="user.role=='pssp'">
<tr>
<td class="border-0">
<div v-if="response.user_data.identification.length>0" class="pt-3 pb-3">
<ul>
<li v-for="i in response.user_data.identification" :key="i.id">
<div class="row">
<div class="col-6">
<em class="icon ni ni-file"></em>
<span style="margin-left:10px;">{{ i.document }}</span>
</div>
<div class="col-4">
{{ i.document_number }}
</div>
<div class="col-2">
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
</div>
</li>
</ul>
</div>
<div v-else class="text-warning" style="padding-left:20px;">Missing</div>
</td>
</tr>
<tr>
<td class="p-2 border-0"></td>
</tr>
</tbody>
<thead v-if="user.role=='pssu'"  class="border-top">
<tr>
<th class="border-0 p-1"><em class="icon ni ni-caret-right-fill text-success"></em> Nature of Disability </th>
</tr>
</thead>
<tbody v-if="user.account_type=='pssu'">
<tr>
<td class="border-0">
<div v-if="disabilities.length>0" class="pt-3 pb-3">
<div data-target="#profile-edit" v-for="d in disabilities" :key="d.id" style="padding:0px;margin:0;border:none;cursor: text;">
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
<div v-else>No disability</div>
</td>
</tr>
<tr>
<td class="p-2 border-0"></td>
</tr>
</tbody>

<thead  class="border-top">

<tr>
<th class="border-0 p-1">
<div class="row">
<div class="col-10 ">
<em class="icon ni ni-caret-right-fill text-success"></em>
Work Experience
</div>
<div class="col-2">
<add-work-experience :response="response" :errors="errors" :flash="flash"></add-work-experience>
</div>
</div>
</th>
</tr>
</thead>
<tbody>
<tr>
<td class="border-0">
<div class="pt-3 pb-3">
<table class="table">
<thead >
<tr style="border:none;">
<th scope="col" style="border-bottom:none;">Organisation Name</th>
<th scope="col" style="border-bottom:none;">Position</th>
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
</td>
</tr>
</tbody>
<thead>
<tr>
<th class="p-1 border-top">
<div class="row">
<div class="col-10">
<em class="icon ni ni-caret-right-fill text-success"></em>
Profession Reference
</div>
<div class="col-2">
<add-reference style="text-transform:capitalize;font-weight:normal;font-family:font-family: 'Roboto', sans-serif;letter-spacing:1px;font-size:13px;" :errors="errors" :flash="flash" :response="response"></add-reference>
</div>
</div>

</th>
</tr>
</thead>
<tbody>
<tr>
<td class="border-0">
<div class="pt-3 pb-3">
<table class="table table-sm">
<thead>
<tr>
<th scope="col" style="border-bottom:none;">Names</th>
<th scope="col" style="border-bottom:none;">Contacts</th>
<th scope="col" style="border-bottom:none;">Address</th>
<th scope="col" style="border-bottom:none;">Position</th>
<th scope="col" style="border-bottom:none;"></th>

</tr>
</thead>
<tbody class="text-muted" v-if="reference.length>0">
<tr v-for="r in reference" :key="r.id">
<td class="word-transform">{{ r.names }} </td>
<td>
<div>{{ r.tel }}</div>
<div style="text-transform:lowercase;">
{{ r.email }}
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
<td colspan="6" class="text-warning">
Missing
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>




<!-- <div class="card-footer bg-warning-dim text-center" v-if="$page.props.auth.user.status=='pending'" style="font-size:13px;">
<em class="icon ni ni-shield-alert text-warning"></em>
Your account has not yet been approved by Dasuns Management Team
</div>

<div class="card-footer bg-warning-dim text-center" v-if="$page.props.auth.user.status=='interview'" style="font-size:13px;">
<em class="icon ni ni-calendar-booking text-warning"></em>
Interview has been schedules
</div> -->




</div>
</div>
</div>
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
