<template>
<div class="row mt-2 mb-2">
<div class="col-12 col-md-4">



<el-card class="card h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="team-options">



<el-dropdown trigger="click" style="z-index:0;">
<span class="el-dropdown-link btn btn-dim btn-success">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>Upload porfile picture</el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.edit_user=true" class="p-1">Edit user information</a></el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.add_service=true" class="p-1">Add services</a></el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1">Add disabilities</a></el-dropdown-item>

<el-dropdown-item v-if="user.account_type=='institutional'"><a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1">New Contact Person</a></el-dropdown-item>

<el-dropdown-item>Settings</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>



</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span>
<em class="icon ni ni-user-alt-fill"></em>
</span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h2 class="text-transform mb-2">{{ $page.props.auth.user.firstname+' '+$page.props.auth.user.lastname }} </h2>
<span class="sub-text"><strong style="font-weight:bold;color:black;" class="mr-1">Dasuns No:</strong> {{ response.user_data.profile.dasuns_number }} </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ $page.props.auth.user.gender }} </span></li>
<li><span>Date of Birth</span><span>
{{ $page.props.auth.user.dob.split('-').reverse().join('/') }}
</span></li>
<li><span>Telephone</span><span>
{{ $page.props.auth.user.tel }}
</span></li>
<li><span>Email</span><span>
{{ $page.props.auth.user.email }}
</span></li>
</ul>
<div class="team-view pt-2">
<Inertia-link :href="route('wallet')" class="btn btn-block btn-dim btn-success"><span>
<em class="icon ni ni-wallet-fill mr-1"></em>
Wallet</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>



</div>
<div class="col-12 col-md-8">


<el-card class="card h-100 pt-2" style="min-height:700px;" shadow="never">

<div slot="header" class="clearfix">
<h3>Service User Profile</h3>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div class="card-inner p-0">
<table style="width:100%;">
<thead>
<tr>
<th>
<h1><em class="icon ni ni-caret-right-fill text-success"></em> Services I Need from Dasuns Platform</h1>
</th>
</tr>
</thead>
<tbody v-if="response.user_data.profile.services.length>0">
<tr v-for="n in response.user_data.profile.services" :key="n.id">
<td class="pt-2 pl-2">
{{ n.name }}
</td>
<td style="width:20px;">
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_services(n.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
</tbody>
<thead>
<tr>
<th colspan="2" class="p-4"></th>
</tr>
<tr>
<th colspan="2">
<h1>
<em class="icon ni ni-caret-right-fill text-success"></em> My Disabilities
</h1>
</th>
</tr>
</thead>
<tbody>
<tr v-for="d in response.user_data.profile.disabilities" :key="d.id">
<td class="pt-2 pl-2">
{{ d.name }}
</td>
<td>
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_disabilities(d.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>

</tbody>













<tbody v-if="$page.props.auth.user.account_type=='institutional'">
<tr>
<td colspan="2" class="pt-3">

<div class="card thick-border h-100 mt-3">
<div class="card-header thick-bg" style="border-radius: 0px 0px 0 0;">
<h1 style="color:white;">
<em class="icon ni ni-shield-check"></em>
Organisation Contact Person Information
</h1>
</div>

<div class="card-inner p-0">
<div class="project">
<div class="project-head pl-4 pr-4 pt-2 pb-0">
<span class="project-title">
<div class="user-avatar sq bg-success"><span><em class="icon ni ni-user-alt-fill"></em></span></div>
<div class="project-info">
<h6 class="title text-transform">
{{ contact_person.firstname +' '+contact_person.lastname}}
</h6>
<span class="sub-text text-transform">{{ contact_person.gender }} </span>
</div>
</span>
</div>




    <div class="card m-0">
    <ul class="data-list is-compact m-0 p-0 border-0">
     <li class="data-item p-0 border-0"></li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Telephone</div>
    <div class="data-value">
{{ contact_person.tel }}
    </div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Email</div>
    <div class="data-value">{{ contact_person.email }}</div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4 pb-4">
    <div class="data-col">
    <div class="data-label">Designation</div>
    <div class="data-value text-transform">{{ contact_person.role }}</div>
    </div>
    </li>
    </ul>
    </div>


</div>
</div>
</div>
</td>
</tr>
</tbody>

<tbody>
<tr>
<tr>
<th colspan="2" class="p-2"></th>
</tr>
<tr>
<td colspan="2">
<div class="row">
<div class="col-12 col-md-4">
<strong>
<em class="icon ni ni-caret-right-fill text-success"></em>
Joined Dasuns Platform
</strong>
</div>
<div class="col-12 col-md-4">
<span class="badge badge-success p-1" style="font-size:16px;">
{{ user.created_at.substring(0,10).split('-').reverse().join('/') }}
</span>
</div>
</div>
</td>
</tr>
</tbody>





</table>








</div>
</el-card>
</div>




















<!---------Dialog information-->

<form @submit.prevent="submit" class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.edit_user==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit User Information</h5>
<a href="#" class="close" @click="dialog_box.edit_user=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">






<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form_user.firstname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.lastname">
</div>
</div>






<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" @change="select_gender($event)">
<option :value="user.gender">{{ user.gender }} </option>
<option value="male" v-if="user.gender!='male'">Male</option>
<option value="female" v-if="user.gender!='female'">Female</option>
<option value="other" v-if="user.gender!='other'">Other</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.dob"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.dob">
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form_user.tel">
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











<!------------services--->


<form @submit.prevent="submit_services" v-if="dialog_box.add_service==true">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Profession Support Services</h5>
<a href="#" class="close" @click="dialog_box.add_service=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<!-- {{ response.user_data.list_services }} -->

<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.service"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_service($event)">
<option value="">Select</option>
<option :value="r.id" v-for="r in response.user_data.list_services" :key="r.id">
{{ r.name }}
</option>
</select>
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
</div>

</form>




<!------Disabilities------->

<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.add_pssu_disability==true" @submit.prevent="submit_disability">
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
<input-error :error="errors.disability"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_disability($event)">
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










</div>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError,
},
props:{
response:{},
flash:{},
errors:{},

},
data(){return{
user:this.$page.props.auth.user,
contact_person:[],
//start dialog box

dialog_box:{

edit_user:false,
add_disability:false,
delete_account:false,
add_service:false,
add_pssu_disability:false,
delete_account:false,

},
//

form_user:this.$inertia.form({

firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
gender:this.$page.props.auth.user.gender,
dob:this.$page.props.auth.user.dob,
tel:this.$page.props.auth.user.tel,

}),

//
form_service:this.$inertia.form({
service:null
}),

//
form_disability:this.$inertia.form({
disability:null,
}),





}},




methods:{

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




//
delete_disabilities(id){
this.$inertia.post(this.route('pssu.delete-disability'),{
id:id},{
onSuccess:()=>{
this.$notify({
title:'Succesfull',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
}
);
},


//dialog box
edit_user_information(){
this.dialog_box.edit_user=true;
},


//
submit(){
this.form_user.post(this.route('user_update_account'),{
onSuccess:()=>{
this.dialog_box.edit_user=false;
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'User information has been updated.',
type: 'success'
});

}
});

},

//
select_gender(event){
this.form_user.gender=event.target.value;
},


//
submit_services(){
this.form_service.post(this.route('pssu.store-services'),{
onSuccess:()=>{
this.$notify({
position: 'bottom-right',
title: this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning'
});
this.dialog_box.add_service=false;
}
});

},

//
select_service(event){
this.form_service.service=event.target.value;
},

//
select_disability(event){
this.form_disability.disability=event.target.value;
},

//
submit_disability(){
this.form_disability.post(this.route('pssu.store_disability'),{
onSuccess:()=>{
this.dialog_box.add_pssu_disability=false;
this.$notify({
position:'bottom-right',
title:this.$page.props.flash.success?'Successful':'Warning',
message:this.$page.props.flash.success?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success?'success':'warning',
});



}
});


},


data_load(){
this.contact_person=this.response.user_data.profile.contact_person;
}





},
mounted(){
this.data_load();



},


//
computed:{

}

}
</script>
<style scoped>
.dropdown-toggle:hover, .btn-sm:hover, .btn-icon:hover, .btn-trigger:hover{
background: none;
}




</style>
