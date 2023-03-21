<template>
<app-layout>
<el-card class="card card-full h-100 mt-1" shadow="never">
<form slot="header" class="clearfix" @submit.prevent="submit_approve">
<span class="bold">
Approve Employee Account
</span>
<span style="float: right; padding: 0px 0">
<button class="btn btn-success" style="margin:0;" v-if="profile.designation!=null && profile.location!=null && profile.name!=null">
Approve account
</button>
<button class="btn btn-success" type="submit" style="margin:0;" v-else disabled>
Approve account
</button>
</span>
</form>




<div class="card-body pb-5">
<div class="row">
<div class="col-12 col-md-4">

<div class="card">
<div class="card-inner p-0">
<div class="team">
<div class="team-options">
<div class="drodown">


<el-dropdown trigger="click">
<a href="#" class="btn btn-dim btn-success el-dropdown-link">
<em class="icon ni ni-more-h"></em>
</a>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a @click="dialog.change=true" style="padding:10px;">Change</a> </el-dropdown-item>
<el-dropdown-item><a @click="dialog.edit_status=true" style="padding:10px;">Edit Status</a> </el-dropdown-item>
<el-dropdown-item><a style="padding:10px;" @click="submit_delete(e.id)">Delete</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
<div class="user-card user-card-s2 ">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="user-info">
<h6 class="text-transform">{{ response.employee.firstname }} {{ response.employee.lastname }} </h6>
<span class="sub-text text-transform">{{ response.employee.role }} </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ response.employee.gender}} </span></li>
<li><span>Date of Birth</span><span>{{ response.employee.dob.split('-').reverse().join('/') }} </span></li>
<li><span>Telephone</span><span>{{ response.employee.tel }} </span></li>
<li><span>Email</span><span>{{ response.employee.email }} </span></li>
</ul>

</div><!-- .team -->
</div><!-- .card-inner -->
</div>






</div>
<div class="col-12 col-md-8 pt-3">




<el-card class="box-card" shadow="never">
<div slot="header" class="clearfix">
<span><h4>Employee Profile Information</h4></span>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div>









<div class="card-inner card-inner-lg p-0">
<div class="nk-block">
<div class="nk-data data-list">
<!-- <div class="data-head">
<h6 class="overline-title">Basics</h6>
</div> -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Joined </span>
<span class="data-value">{{ e.created_at.substring(0,10).split('-').reverse().join('/') }}</span>
</div>
</div><!-- data-item -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Employee Position </span>
<span class="data-value text-transform">{{ response.employee.role }} </span>
</div>
</div><!-- data-item -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Account Type </span>
<span class="data-value text-transform"> {{ e.account_type }}  </span>
</div>
</div><!-- data-item -->




<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Personal Statement </span>
<span class="data-value text-transform text-muted" style="font-size:14px;"> {{ profile.about!=null?profile.about:'missing' }}  </span>
</div>
</div><!-- data-item -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Counntry </span>
<span class="data-value text-transform"> {{ profile.name!=null?profile.name:'missing' }}  </span>
</div>
</div><!-- data-item -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Location </span>
<span class="data-value text-transform"> {{ profile.location!=null?profile.location:'missing' }}  </span>
</div>
</div><!-- data-item -->


<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Employee Role Status </span>
<span class="data-value text-transform"> {{ profile.tag!=null?profile.tag:'missing' }}  </span>
</div>
</div><!-- data-item -->



</div><!-- data-list -->
</div><!-- .nk-block -->
</div>




</div>
</el-card>





</div>

</div>

</div>
</el-card>












<!----------DIALOG-->

<form @submit.prevent="submit_change"  v-if="dialog.change==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Change User Role</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.change=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">





<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<select type="text" class="form-control text-transform" id="default-01" @change="select_role($event)">
<option :value="response.employee.role">{{ response.employee.role }} </option>
<option v-for="r in roles" :key="r.id" v-if="response.employee.role!=r.name" :value="r.name">{{ r.name }}</option>
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
</form>





<!---------Change status------->
<form  v-if="dialog.edit_status==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit_status">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Change Employee Status</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.edit_status=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">

<div class="form-group">
<label class="form-label" for="default-01">
Change Status:
<span>
<input-error :error="errors.status"></input-error>
</span>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="change_status($event)" >
<option value="">--Select Status--</option>
<option v-for="s in status_list" :key="s.id" :value="s.name">
{{ s.name }}
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
</form>








</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import InputError from '../Alerts/InputError';
export default {
components:{
AppLayout,
InputError,


},
props:{
response:{},
title:{},
errors:{}
},
data(){return{
roles:this.response.roles,
//dialog box
dialog:{
change:false,
edit_status:false
},

//delete employee
form_delete:this.$inertia.form({
id:null,
}),
//change role
form_change:this.$inertia.form({
role:null,
id:this.response.employee.id
}),

form_approve:this.$inertia.form({
id:null,
}),

//employee status form
form_employee_status:this.$inertia.form({
id:this.response.employee.id,
status:null,
}),






}},

methods:{
//change status details
change_status(event){
this.form_employee_status.status=event.target.value;
},




//
submit_delete(id){
this.form_delete.id=id;
this.form_delete.post(this.route('destroy.employee'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
});
},





//
back(){
this.$inertia.get(this.route('employee'));
},

//



submit_change(){
this.form_change.post(this.route('update.employee_role'),{
onSuccess:()=>{
this.dialog.change=false;
this.form_employee_status.reset();
this.$notify({
title:this.$page.props.flash.success?'Successful':'Warning',
message:this.$page.props.flash.success?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success?'success':'warning',
position:'bottom-right'

});

}
});
},

//
select_role(event){
this.form_change.role=event.target.value;
},



//approve account
submit_approve(){
this.form_approve.id=this.response.employee.id;
this.form_approve.post(this.route('employee.approve'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
});
},


//chnage emplotyee status
submit_status(){
this.form_employee_status.post(this.route('admin.change_employee_status'),
{
onSuccess:()=>{
const m=this.$page.props.flash;
this.dialog.edit_status=false;
this.$notify({
title:m.success!=null?'Successful':'Error',
message:m.success!=null?m.success:m.warning,
type:m.success!=null?'success':'warning',
position:'bottom-right'

});

}

});
},

set_status(){
this.form_employee_status.status=this.response.profile.tag;
}








},


computed:{
profile(){
return this.response.profile;
},
e(){
return this.response.employee;
},


status_list(){
const tag=this.response.profile.tag;
const item=[{id:1,name:'other'},
{id:2,name:'official'}];
const new_item=[];
item.forEach(element=>{
if(tag!=element.name){
new_item.push(element);
}
});
return item;

}




},

mounted(){
// this.set_status();
}





}
</script>
