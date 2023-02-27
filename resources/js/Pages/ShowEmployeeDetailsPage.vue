<template>
<app-layout>
<div class="card card-full h-100">

<div class="card-body pb-5">


<div class="row">
<div class="col-12 col-md-4">

<div class="card">
<div class="card-inner">
<div class="team">
<div class="team-options">
<div class="drodown">


<el-dropdown trigger="click">
<a href="#" class="btn btn-dim btn-success el-dropdown-link">
<em class="icon ni ni-more-h"></em>
</a>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a @click="dialog.change=true" style="padding:10px;">Change</a> </el-dropdown-item>
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



<div class="card border" style="min-height:600px;">
<div class="card-header mb-0 border-bottom pb-0 card-header-bg">
<div class="card-title p-0">
<h2>
<el-page-header @back="back()" content="Employee Profile Information">
</el-page-header>
</h2>
</div>
</div>




<ul class="data-list is-compact ">
<li class="data-item border-0">
<div class="data-col">
<div class="data-label">Joined Dasuns </div>
<div class="data-value">
{{ e.created_at.substring(0,10).split('-').reverse().join('/') }}

</div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label">Employee Position</div>
<div class="data-value text-transform">{{ response.employee.role }} </div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label">Account Type</div>
<div class="data-value text-transform">{{ e.account_type }} </div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label">Account Status</div>
<div class="data-value text-soft text-transform"><em>
{{ e.status }}
</em></div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label"></div>
<div class="data-value"></div>
</div>
</li>
<!-- <li class="data-item">
<div class="data-col">
<div class="data-label">Full Address</div>
<div class="data-value">6516, Eldoret, Uasin Gishu, 30100</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Country of Residence</div>
<div class="data-value">Kenya</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Full Address</div>
<div class="data-value">6516, Eldoret, Uasin Gishu, 30100</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Wallet Type</div>
<div class="data-value">Bitcoin</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Wallet Address</div>
<div class="data-value text-break">1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telegram</div>
<div class="data-value">
<span>@tokenlite</span> <a href="https://t.me/tokenlite" target="_blank"><em class="icon ni ni-telegram"></em></a>
</div>
</div>
</li> -->
</ul>















</div>




</div>

</div>

</div>
</div>












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












</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout

},
props:{
response:{},
title:{},
},
data(){return{
e:this.response.employee,
roles:this.response.roles,
//dialog box
dialog:{
change:false,
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








}},

methods:{
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
this.$notify({
title:this.$page.props.flash.success?'Successful':'Warning',
message:this.$page.props.flash.success?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success?'success':'warning',
position:'bottom-right'

});

}
});
},

select_role(event){
this.form_change.role=event.target.value;
}













}
}
</script>
