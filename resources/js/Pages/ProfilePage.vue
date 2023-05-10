<template>
<app-layout>
<div>
<div v-if="user.role=='admin' || user.role=='reception' || user.role=='finance' || user.role=='admin'">
<employee-profile-component :response="response" :flash="flash" :errors="errors"></employee-profile-component>
</div>
<div v-else>
<!-----PSSP PROFILE-->
<div v-if="user.role=='pssp'" class="mb-1 mt-1">

<div class="card">
<div class="card-aside-wrap">

<div class="card-body">
<div class="nk-block-head-content align-self-start d-lg-none">
<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
<em class="icon ni ni-menu-alt-r"></em></a>
</div>


<div class="card-header p-0">
<div class="card-title p-0">
<h2 class="title p-0" style="font-size:20px;">
Service Provider Profile
</h2>
</div>
</div>


<div v-if="account_status!=null" class="mb-3">
<div class="alert alert-danger alert-icon" v-if="account_status.status=='pending'">
<em class="icon ni ni-alert-circle"></em> {{ account_status.message }} </div>
<div class="alert alert-warning alert-icon" v-if="account_status.status=='profile'">
<em class="icon ni ni-alert-circle"></em> {{ account_status.message }} </div>
<div class="alert alert-success alert-icon" v-if="account_status.status=='success'">
<em class="icon ni ni-alert-circle"></em> {{ account_status.message }} </div>
<div class="alert alert-danger alert-icon" v-if="account_status.status=='failed'">
<em class="icon ni ni-alert-circle"></em> {{ account_status.message }} </div>
<div class="alert alert-primary alert-icon" v-if="account_status.status=='interview'">
<em class="icon ni ni-alert-circle"></em> {{ account_status.message }} </div>
</div>

<div>
<h4 style="font-size:20px;">Personal Statement</h4>
<p class="pt-2 text-muted" style="font-size:14px;width:auto;overflow:hidden;">
{{ $page.props.auth.user_profile.about!=null?$page.props.auth.user_profile.about:'Missing' }}
</p>
</div>

<div class="mt-5 border-top pt-4">
<div class="card-inner p-0">
    <div class="card-title-group">
        <div class="card-title">
            <h6 class="title" style="font-size:20px;">Identification Documents</h6>
        </div>
        <div class="card-tools">
            <add-identification-documents :response="response" :errors="errors" :flash="flash"/>
        </div>
    </div>
</div>



<div>
<div v-if="response.user_data.identification.length>0">
<div class="row mt-3" v-for="i in response.user_data.identification" :key="i.id">
<div class="col-3">{{ i.document }}</div>
<div class="col-8">
<strong>Document Number </strong>
<span class="badge badge-outline-primary" style="font-size:14px;padding:10px;">
{{ i.document_number }}</span>
</div>
<div class="col-1">
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
</div>
<div v-else class="text-danger">No content</div>
</div>










<div class="mt-5 border-top pt-4">
    <div class="card-inner p-0">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title" style="font-size:20px;">Support Services I Provide</h6>
            </div>
            <div class="card-tools">

            </div>
        </div>
    </div>


<div v-if="services.length>0">
<div class="row pt-3" v-for="s in services" :key="s.id">
<div class="col-11">{{ s.name }}</div>
<div class="col-1">  <el-dropdown trigger="click">
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
<div v-else class="text-danger">
No content
</div>

</div>










<div class="mt-5 border-top pt-4">
<div class="card-inner p-0">
<div class="card-title-group">
<div class="card-title">
<h6 class="title" style="font-size:20px;">Work Experience</h6>
</div>
<div class="card-tools">
<add-work-experience :response="response" :errors="errors" :flash="flash"/>
</div>
</div>
</div>




<div>
<div v-if="experience.length>0">
<div class="row mt-3">
<div class="col-3 bold">
Organisation Name
</div>
<div class="col-4 bold">Position</div>
<div class="col-4 bold">Dates</div>
<div class="col-1 bold"></div>
</div>


<div class="row" v-for="e in experience" :key="e.id">
<div class="col-3">
   {{ e.organisation_name }}
</div>
<div class="col-4">  {{ e.position }}</div>
<div class="col-4">  {{ e.from_date }} -     {{ e.to_date }}</div>
<div class="col-1">
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
</div>
</div>




</div>
<div class="text-danger" v-else>No expereince added</div>
</div>



<div>

</div>
</div>








<div class="mt-5 border-top pt-4">
    <div class="card-inner p-0">
        <div class="card-title-group">
            <div class="card-title">
                <h3 class="title" style="font-size:20px;">Profession Reference</h3>
            </div>
            <div class="card-tools">
                <add-reference style="text-transform:capitalize;font-weight:normal;font-family:font-family: 'Roboto', sans-serif;letter-spacing:1px;font-size:13px;" :errors="errors" :flash="flash" :response="response"/>
            </div>
        </div>
    </div>


<div v-if="reference.length>0">
<div class="row mb-1 mt-3">
<div class="col-3 bold">
Organisation
</div>
<div class="col-3 bold">
Contacts
</div>
<div class="col-3 bold">
Address
</div>
<div class="col-3 bold">
Position
</div>
</div>
<div class="row" v-for="r in reference" :key="r.id">
<div class="col-3 text-transform">
{{ r.names }}
</div>
<div class="col-3">
    {{ r.tel }}
    </div>
    <div class="col-3">
        {{ r.email }}
        </div>
        <div class="col-3 text-transform">
            {{ r.position }}
            </div>
</div>

</div>
<div class="text-danger" v-else>No experience added</div>



</div>




















</div>












</div>













<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true" style="width:400px">
<div class="card-inner-group" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height:600px; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
<div class="card-inner">
    <div class="card-inner">
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


        <div class="team-view">
        <Inertia-link :href="route('dashboard')" class="btn btn-block btn-success"><span>Dashboard</span></Inertia-link>

        </div>



        </div><!-- .team -->
        </div><!-- .card-inner -->
</div><!-- .card-inner -->






</div></div></div></div>
<div class="simplebar-placeholder" style="width: auto; height: 500px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div><!-- .card-inner-group -->
</div><!-- card-aside -->
</div><!-- .card-aside-wrap -->
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
},

computed:{
status(){
return this.response.user_data.interview_status;
},

account_status(){
return this.response.user_data.account_status_message;
}




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
