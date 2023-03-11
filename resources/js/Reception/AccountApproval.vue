<template>
<div class="nk-content-body">
<div class="nk-block pt-2">
<el-card class="card" shadow="never">

<div slot="header" class="clearfix">
<h4 class="nk-block-title">Welcome to Reception Account</h4>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>

<div class="row">
<div class="col-12 col-md-4">
<div class="card">
<div class="card-inner">
<div class="team">
<!-- <div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#" @click="dialog.edit_info=true"><span>Edit User Information</span></a></li>
<li><a href="#"><span>Upload Picture</span></a></li>
<li v-if="profile==null"><a href="#" @click="dialog.create_profile=true"><span>Add Profile</span></a></li>
<li v-else><a href="#" @click="dialog.edit_profile=true"><span>Edit Profile</span></a></li>
<li><a href="#" @click="dialog.delete_account=true"><span>Delete Account</span></a></li>
</ul>
</div>
</div>
</div> -->
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h6 class="text-transform">{{ user.firstname+' '+user.lastname }} </h6>
<span class="sub-text text-transform">{{ user.role }} </span>
</div>




</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ user.gender }} </span></li>
<li><span>Contact</span><span>{{ user.tel }} </span></li>
<li><span>Email</span><span>{{ user.email }} </span></li>
</ul>
<div class="team-view">
<Inertia-link :href="route('profile')" class="btn btn-block btn-dim btn-success"><span>Edit Profile</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>



</div>
<div class="col-12 col-md-8">



<el-card shadow="never">
<div slot="header" class="clearfix">
<h6 class="nk-block-title text-danger" style="font-weight:normal;">Your account has not yet been approved by Dasuns Administration.</h6>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>

<div>




<div class="nk-block">
<div class="nk-data data-list">
<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label bold">Personal Statement</span>
<span class="data-value text-muted" style="font-size:13px;">
{{ profile.about }}
</span>
</div>
</div><!-- data-item -->

<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label bold">Location</span>
<span class="data-value text-transform">
{{ profile.location }}
</span>
</div>
</div><!-- data-item -->


<div class="data-item">
<div class="data-col">
<span class="data-label bold">Country</span>
<span class="data-value text-transform">
{{ profile.country }}
</span>
</div>

</div><!-- data-item -->



<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label bold">Designation</span>
<span class="data-value text-soft text-transform">
{{ profile.designation }}
</span>
</div>
</div><!-- data-item -->



<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label bold">Status</span>
<span class="data-value text-soft text-transform">
Not Approved
</span>
</div>
</div><!-- data-item -->



<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label bold">Settings</span>
<span class="data-value text-soft text-transform">
<a href="#">Change User Settings</a>
</span>
</div>
</div><!-- data-item -->



<!-- data-item -->
</div><!-- data-list -->

</div>
</div>
</el-card>
</div>
</div>














<!-------Dialog boxes------>
<!-- <form  v-if="dialog.create_profile==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Create Profile </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.create_profile=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.designation"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter designation" v-model="form.designation">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.country"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select($event)">
<option value="">--Select Country--</option>
<option v-for="c in country" :value="c.id" :key="c.id">{{ c.name }} </option>
</select>
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.location"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter your physical adderess" v-model="form.location">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
</label>
<div class="form-control-wrap">
<textarea type="text" class="form-control" id="default-01" placeholder="Write your personal statement" v-model="form.about"></textarea>
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
</form> -->




<!----------------->
<!-- <form  v-if="dialog.edit_info==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit2">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Edit User Information </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.edit_info=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form2.firstname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form2.lastname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" @change="select_gender($event)">
<option :value="$page.props.auth.user.gender">{{ $page.props.auth.user.gender }} </option>
<option v-for="g in new_gender" :key="g.id" :value="g.name">{{ g.name }}</option>
</select>
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="number" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form2.tel">
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
</form> -->





<!-------------->

<!-- <form v-if="dialog.delete_account==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit3">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Delete Account</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.delete_account=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">
<p>Do you want to delete this account?</p>
</div>
<div class="modal-footer bg-light">
<button class="btn btn-danger" style="font-size:14px;">Confirm</button>
</div>
</div>
</div>
</form> -->




<!------------->
<!-- <form  v-if="dialog.edit_profile==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit3">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Edit Profile</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.edit_profile=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.designation"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter designation" v-model="form3.designation">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.country"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select($event)">
<option value="">--Select Country--</option>
<option v-for="c in country" :value="c.id" :key="c.id">{{ c.name }} </option>
</select>
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.location"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter your physical adderess" v-model="form3.location">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
</label>
<div class="form-control-wrap">
<textarea type="text" class="form-control" id="default-01" placeholder="Write your personal statement" v-model="form3.about"></textarea>
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

 -->














</el-card>
<!-- .card -->
</div><!-- .nk-block -->
</div>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError
},
props:{
response:{},


},


data(){return{

dialog:{
create_profile:false,
edit_info:false,
delete_account:null,
edit_profile:false,
},
gender:[
{id:1,name:'male'},
{id:2,name:'female'},
{id:3,name:'other'}
],


//form
form:this.$inertia.form({
designation:null,
country:null,
location:null,
about:null,
}),


//form2
form2:this.$inertia.form({
firstname:null,
lastname:null,
gender:null,
tel:null,
}),


//form3
form3:this.$inertia.form({
designation:null,
country:null,
location:null,
about:null,
}),



//formatted gender
formatted_gender:[],
formatted_country:[],

//delete form
delete_form:this.$inertia.form({
id:this.$page.props.auth.user.id,
}),

}},

computed:{

profile(){
return this.response.user_data.profile;
},

country(){
return this.response.user_data.country;
},

errors(){
return this.$page.props.errors;
},

flash(){
return this.$page.props.flash;
},

user(){
return this.$page.props.auth.user;
},

new_gender(){
const gender=[];
this.gender.forEach(element=>{
if(element.name!=this.$page.props.auth.user.gender){
gender.push({id:element.id,name:element.name});
}
});
return gender;
}






},



methods:{
//
select(event){
this.form.country=event.target.value;
},

//
submit(){
this.form.post(this.route('reception.create_about'),{
onSuccess:()=>{
this.dialog.create_profile=false;
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type: 'success',
position:'bottom-right'

});


}

})
},




//select gender
select_gender(event){
this.form2.gender=event.target.value;
},


submit2(){
this.form2.post(this.route('reception.edit_user'),{
onSuccess:()=>{
this.dialog.edit_info=false;
this.$notify({
title:this.$page.props.flash.success==null?'Error':'Successful',
message:this.$page.props.flash.success==null?this.$page.props.flash.warning:this.$page.props.flash.success,
type:this.$page.props.flash.success==null?'warning':'success',
position:'bottom-right'
});
}
});
},



//user payload
user_payload(){
this.form2.firstname=this.$page.props.auth.user.firstname;
this.form2.lastname=this.$page.props.auth.user.lastname;
this.form2.gender=this.$page.props.auth.user.gender;
this.form2.tel=this.$page.props.auth.user.tel;
},


//delete
submit3(){
this.delete_form.post(this.route('reception.delete'),{
onSuccess:()=>{
this.dialog.delete_account=false;
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type:'success',
position:'bottoom-right'
});
}
});
},


//format
format_edit_user(){
this.form3.about=this.response.user_data.profile.about;
this.form3.designation=this.response.user_data.profile.designation;
this.form3.country=this.response.user_data.profile.countryID;
this.form3.location=this.response.user_data.profile.location;
},

//edit reception
submit3(){
this.form3.post(this.route('reception.edit_profile'),{
onSuccess:()=>{
this.dialog.edit_profile=false;
this.$notify({
title:this.$page.props.flash.success==null?'Warning':'Successful',
message:this.$page.props.flash.success==null?this.$page.props.flash.warning:this.$page.props.flash.success,
type:this.$page.props.flash.success==null?'warning':'success',
position:'bottom-right'
});
}
});
}





},

mounted(){
this.user_payload();
this.format_edit_user();
}





}
</script>
