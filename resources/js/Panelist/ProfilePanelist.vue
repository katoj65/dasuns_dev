<template>
<div class="pt-1">
<div class="row">
<div class="col-12 col-md-4">
<el-card shadow="never" class="h-100">

<div class="card-inner">
<div class="team">
<div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-dim btn-success btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>Change Profile Picture</span></a></li>
<li><a href="#" @click="edit_profile()"><span>Edit Profile</span></a></li>
<!-- <li class="divider"></li>
<li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li> -->
</ul>
</div>
</div>
</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span>AB</span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h6 class="text-transform">
{{ response.user.firstname }} {{ response.user.lastname }}
</h6>
<span class="sub-text text-transform">
{{ response.user.role }}
</span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform"> {{ response.user.gender }} </span></li>
<li><span>Date of Birth</span><span> {{ response.user.dob.split('-').reverse().join('-') }} </span></li>
<li><span>Contact</span><span>{{ response.user.tel }} </span></li>
<li><span>Email</span><span>{{ response.user.email }} </span></li>
</ul>
<!-- <div class="team-view">
<a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary"><span>View Profile</span></a>
</div> -->
</div><!-- .team -->
</div><!-- .card-inner -->








</el-card>

</div>
<div class="col-12 col-md-8">
<el-card shadow="never" class="h-100">
<div slot="header" class="clearfix">
<h4>Panelist Profile</h4>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div class="card-body p-0">
<el-card shadow="never">
<span  slot="header" style="font-weight:bold;">
Professional Experience
</span>

<div class="p-0" v-if="profession.length>0">
<ul class="data-list is-compact m-0 p-0" >
<li class="data-item p-0 mb-1" style="border:none;" v-for="p in profession" :key="p.id">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-chevron-right"></em> {{ p.name }} </div>
<div class="data-value" style="width:100%;">
{{ p.number_years>1?p.number_years+' Years':p.number_years+' Year' }}

<span style="float:right;">
<el-dropdown trigger="click">
<span class="el-dropdown-link btn btn-dim btn-success" style="padding:5px;">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" @click="delete_expertise(p.id)">
Delete
</a>

</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</span>

</div>
</div>
</li>
</ul>
</div>
<div v-else>
No content
</div>
</el-card>




<el-card shadow="never" class="mt-3">
<span  slot="header" style="font-weight:bold;">
User Details
</span>

<div class="p-0">
<ul class="data-list is-compact m-0 p-0" >



<li class="data-item p-0 mb-1" style="border:none;" v-for="i in activity" :key="i">
<div class="data-col">
<div class="data-label">
{{ i.title }}
</div>
<div class="data-value text-transform">
{{ i.description }}
</div>
</div>
</li>




</ul>
</div>
</el-card>










</div>
</el-card>
</div>
</div>























<!----------Dialog--->
<!----Add expertise--->
<form  v-if="dialog.expertise==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Add Profession Experience</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close"  @click="show_expertise()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.professionID"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01"  @change="select_profession($event)">
<option value="">-- Select profession--</option>
<option :value="e.id" v-for="e in employee_professions" :key="e.id">{{ e.name }} </option>
</select>
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<textarea class="form-control" id="default-01" placeholder="Enter profession description" v-model="form.description"></textarea>
</div>
</div>


<div class="row">
<div class="col-12 col-md-12">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.years"></input-error>
</label>
<div class="form-control-wrap">
<input type="number" class="form-control" id="default-01" placeholder="Enter  years of experience" v-model="form.years">
</div>
</div>


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

<!---Edit profile----->

<form  v-if="dialog.edit_profile==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit_edit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Edit Profile</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="edit_profile()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter firstname" v-model="form_edit.firstname">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter lastname" v-model="form_edit.lastname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_gender($event)">
<option :value="form_edit.gender">{{ form_edit.gender }} </option>
<option v-for="g in gender" :key="g.name" v-if="form_edit.gender!=g.name">{{ g.name }} </option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form_edit.tel">
</div>
</div>


<!-- <div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.email"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter email address" v-model="form_edit.email">
</div>
</div> -->








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
errors:{}
},

data(){return{
dialog:{
expertise:false,
edit_profile:false,
},

user:this.response.user,
profile:this.response.user_data.profile,

//

form:this.$inertia.form({
professionID:null,
description:null,
years:null,
id:this.$page.props.auth.user.id,
}
),



//
form_edit:this.$inertia.form({
firstname:this.response.user.firstname,
lastname:this.response.user.lastname,
gender:this.response.user.gender,
tel:this.response.user.tel,
// email:this.response.user.email,
id:this.$page.props.auth.user.id,
}),

gender:[
{name:'male'},
{name:'female'},
{name:'other'}
]







}},
methods:{

show_expertise(){
if(this.dialog.expertise==false){
this.dialog.expertise=true;
}else{
this.dialog.expertise=false;
}
},

//
select_profession(event){
this.form.professionID=event.target.value;
},

//
submit(){
this.form.post(this.route('store.panelist_profession_profile'),{
onSuccess:()=>{
this.dialog.expertise=false;
this.form.reset();
this.$notify({
position: 'bottom-right',
title:this.flash.success=='success'?'Successful':'Warning',
message:this.flash.success=='success'?this.flash.success:this.flash.warning,
type:this.flash.success=='success'?'success':'warning'
});
}
});
},

//
select_gender(event){
this.form_edit.gender=event.target.value;
},


//
delete_expertise(id){
this.$inertia.post(this.route('destroy.panelist_expertise'),{
id:id},{
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
edit_profile(){
if(this.dialog.edit_profile==false){
this.dialog.edit_profile=true;
}else{
this.dialog.edit_profile=false;
}

},

//
submit_edit(){
this.form_edit.post(this.route('update_panelist_profile'),{
onSuccess:()=>{
this.dialog.edit_profile=false;
this.$notify({
position: 'bottom-right',
title:this.flash.success!=null?'Successful':'Warning',
message:this.flash.success!=null?this.flash.success:this.flash.warning,
type:this.flash.success!=null?'success':'warning'
})
}
});
}








},

computed:{
profession(){
return this.response.user_data.profile.profession;
},

activity(){
const item=[
{id:1,title:'Account Type',description:this.response.user.account_type},
{id:2,title:'Account Status',description:this.response.user.status},
{id:3,title:'Registered at',description:this.response.user.created_at.substring(0,10).split('-').reverse().join('/')},
// {id:4,title:'Location',description:''},
// {id:5,title:'Country',description:''},
{id:6,title:'User Designation',description:this.response.user.role},
// {id:7,title:'Wallet',description:this.response.user.role}

];

return item;
}





}


}
</script>
<style scoped>
</style>
