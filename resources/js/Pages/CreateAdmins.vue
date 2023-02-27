<template>
<admin-layout>





<div class="card  card-full" style="min-height:600px;">
<div class="card-inner">
<!-- <div class="card-title-group align-start mb-3 pb-1">
<div class="card-title">
<h6 class="title">Create Admin Account</h6>
<p style="font-size:14px;">You are required to set roles for the admin.</p>
</div>
<div class="card-tools mt-n1 mr-n1">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#" class="active"><span>15 Days</span></a></li>
<li><a href="#"><span>30 Days</span></a></li>
<li><a href="#"><span>3 Months</span></a></li>
</ul>
</div>
</div>
</div>
</div> -->

<!-- .card-title-group -->

<div class="card-title-group align-start  bg-warning-dim mb-3" v-if="$page.props.flash.warning!=null" style="margin:-25px; border-radius: 8px 8px 0 0;">
<div class="card-title p-1 w-100" style="text-align:center;color:#07372F;">
This user is an administrator.
</div>
</div>



<div>
<div class="row" v-if="admin!=null">
<div class="col-12 col-md-3">
<div class="user-avatar bg-success-dim" style="padding:50px;">
<span>
<em class="icon ni ni-user-alt-fill" style="font-size:50px;"></em>
</span>
</div>
</div>
<div class="col-12 col-md-9 pt-3">
<h1 style="font-size:20px;word-spacing:15px;margin-bottom:5px;" class="text-transform">
{{ admin.firstname }} {{ admin.lastname }}
</h1>


<table class="table table-hover mt-2">
<tbody>
<tr>
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-mail"></em> Email</th>
<td style="text-transform:lowercase;" class="border-no">{{ admin.email }}</td>
<td class="border-no"></td>
<td class="border-no"></td>
</tr>
<tr>
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-call"></em> Telephone</th>
<td class="border-no">{{ admin.tel}}</td>
<td class="border-no"></td>
<td class="border-no"></td>
</tr>

<tr v-if="status==true">
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-shield"></em> Role</th>
<td class="border-no">{{ employee_profile.role }}</td>
<td class="border-no">
</td>
<td class="border-no">
</td>
</tr>

<tr v-if="status==true">
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-tag"></em> Title</th>
<td class="border-no">{{ employee_profile.title }}</td>
<td class="border-no">
</td>
<td class="border-no">
</td>
</tr>

<tr v-if="status==true">
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-map-pin"></em> Address</th>
<td class="border-no">{{ employee_profile.address }}</td>
<td class="border-no">
</td>
<td class="border-no">
</td>
</tr>


<tr v-if="status==true">
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-call"></em> Business Contact</th>
<td class="border-no">{{ employee_profile.business_tel }}</td>
<td class="border-no">
</td>
<td class="border-no">
</td>
</tr>


<tr v-if="status==true">
<th scope="row" style="text-align:left;padding-left:0;" class="border-no"><em class="icon ni ni-mail"></em> Business Email</th>
<td class="border-no">{{ employee_profile.email }}</td>
<td class="border-no">
</td>
<td class="border-no">
</td>
</tr>




</tbody>
</table>





</div>
<div class="col-12 col-md-12">








<form  @submit.prevent="submit" style="padding:50px;padding-top:0;" v-if="status==false">
<div class="card " style="margin:0;">
<!-- <div class="card-header" style="background:white;font-weight:bold;"></div> -->
<div class="card-body">
  <el-divider content-position="left" style="font-size:17px;" class="text-muted">Fill in Administrator Information</el-divider>
<div class="row">
<div class="col-12 col-md-12 pb-3">
<div class="form-control-wrap">
<label>
<input-error :error="errors.tel2"></input-error>
</label>

    <input type="number" class="form-control" id="default-01" placeholder="Enter business telephone number" v-model="form.tel2">
    </div>
</div>


<div class="col-12 col-md-12 pb-3">
<div class="form-control-wrap">
<label>
<input-error :error="errors.email2"></input-error>
</label>

    <input type="email" class="form-control" id="default-01" placeholder="Enter business email address" v-model="form.email2">
    </div>
</div>


<div class="col-12 col-md-12 pt-3 pb-3">
<div class="form-control-wrap">
<label>
<input-error :error="errors.address"></input-error>
</label>
    <input type="text" class="form-control" id="default-01" placeholder="Enter employee residance" v-model="form.address" >
    </div>
</div>



<div class="col-12 col-md-6 pt-3">
<div class="form-control-wrap">
<label>
Admin Role
<input-error :error="errors.role"></input-error>
</label>
    <select class="form-control" id="default-01" style="text-transform:capitalize;" @change="select_role($event)">
<option value="">-- Select --</option>
<option v-for="n in response.roles" :key="n.id" :value="n.name">
{{ n.name }}
</option>
    </select>
    </div>
</div>


<div class="col-12 col-md-6 pt-3">
<div class="form-control-wrap">
<label>
Admin Title
<input-error :error="errors.title"></input-error>
</label>
    <input type="text" class="form-control" id="default-01" placeholder="Enter employee title" v-model="form.title" >
    </div>
</div>




</div>
</div>
<div class="card-footer pt-5 mt-3" style="background:white;border-top:solid thin #F2F3F4;">

<input type="submit" class="button" value="Save" style="padding-right:40px;padding-left:40px;border-radius:4px;"/>

<Inertia-link :href="route('employee')" class="button bg-danger"  style="padding:19px;padding-right:40px;padding-left:40px;border-radius:4px;margin-left:30px;">
Cancel
</Inertia-link>

</div>
</div>

</form>










</div>
</div>








</div><!-- .nk-coin-ovwg -->
</div><!-- .card-inner -->
</div>































</admin-layout>
</template>
<script>
import AdminLayout from '@/Admin/AdminLayout';
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';

export default {
components: {
AppLayout,
AdminLayout,
InputError


},

props:{
response:{},
title:{},
errors:{},
flash:{}
},

data(){return{
user:this.$page.props.auth.user,
status:this.response.status,
employee_profile:this.response.emplyee_profile,


form:this.$inertia.form({
firstname:this.response.admin.firstname,
lastname:this.response.admin.lastname,
gender:this.response.admin.gender,
dob:this.response.admin.dob,
email:this.response.admin.email,
tel:this.response.admin.tel,
role:null,

//
tel2:null,
email2:null,
address:null,
title:null,
userID:this.response.admin.id,

}),

search:{
email:null,
response:this.response.admin,
message:null,



},

admin:this.response.admin



}},

methods:{
//gender
select_gender(event){
this.form.gender=event.target.value;
},
//role
select_role(event){
this.form.role=event.target.value;
},

//submit
submit(){
this.form.post(this.route('store.new_admin'),{
    onSuccess:()=>{
    this.$notify({
    position: 'bottom-right',
    title: 'Successful',
    message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
    type:this.$page.props.flash.success!=null?'success':'warning'
    });
}
});

},

//email
search_email(){
this.$inertia.post(this.route('search.admin-email'),{email:this.search.email},{
onSuccess:()=>{
// this.$inertia.get(this.route('search.email-results'));


}


});



},

select_role(event){
this.form.role=event.target.value;
}






}














}
</script>
<style scoped>
el-date-picker{
border: 1px solid transparent;
}
label{
font-size:14px;
}
p{
padding:6px;
margin-bottom:5px;
padding-left:0;
}
.left{
padding-left:0;
}

td{
text-transform: capitalize;

}
.border-no{
border:none;
}
</style>
