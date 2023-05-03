<template>
<app-layout>
<div style="min-height:600px;" class="mt-1 card">
<div class="row p-4">
<div class="col-12 col-md-3"></div>

<div class="col-12 col-md-6">
<el-card shadow="never" class="mt-2">
<div slot="header" class="clearfix text-center">
<h3>User Settings </h3>
</div>
<div class="card-body pt-0">

<ul class="data-list is-compact">
<li class="data-item" v-for="m in menu" :key="m.item">
<div class="data-col">
<div class="data-label text-transform">{{ m.item }} </div>
<div class="data-value">
<span v-if="m.item=='email'">{{ m.value }}</span>
<span v-else class="text-transform">

<span v-if="m.value=='change'">
<button class="btn btn-dim btn-primary" @click="dialog.change=true">Change Password</button>
</span>
<span v-else-if="m.value=='deactivate'">
<delete-account></delete-account>
</span>
<span v-else>
{{ m.value }}
</span>

</span>
</div>
</div>
</li>

</ul>






</div>
</el-card>
</div>
<div class="col-12 col-md-3"></div>
</div>
</div>




<!---------Dialog Box-------->
<form class=""  v-if="dialog.change==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
    <h5 class="modal-title" style="color:white;">Change Password</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.change=false">
        <em class="icon ni ni-cross"></em>
    </a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">


<div class="form-group">
<label class="form-label" for="default-01">
Email Address
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Email address" disabled v-model="form.email">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.password"></input-error>
</label>
<div class="form-control-wrap">
<input type="password" class="form-control" id="default-01" placeholder="Enter old password" v-model="form.password">
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.new_password"></input-error>
</label>
<div class="form-control-wrap">
<input type="password" class="form-control" id="default-01" placeholder="Enter new password" v-model="form.new_password">
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












<!----End Dialog Box---->

</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import DeleteAccount from '@/Components/DeleteAccount';
import InputError from '@/Alerts/InputError';

export default {
components:{
AppLayout,
DeleteAccount,
InputError,
},

props:{
errors:{}
},


computed:{
menu(){
const user=this.$page.props.auth.user;
let role=user.role;
if(role=='pssp'){
role='Service Provider';
}else if(role=='pssu'){
role='Service User';
}else if(role=='reception'){
role='Receptionist';
}else{
role=user.role;
}

const item=[
{id:1,item:'User names',value:user.firstname+' '+user.lastname},
{id:2,item:'email',value:user.email},
{id:3,item:'Telephone Number',value:user.tel},
{id:4,item:'Designation',value:role},
{id:5,item:'Date of Birth',value:user.dob.split('-').reverse().join('/')},
{id:6,item:'Gender',value:user.gender},
{id:7,item:'Account Type',value:user.account_type},
{id:8,item:'Account Status',value:user.status},
{id:9,item:'Password',value:'change'},
{id:10,item:'Deactivate Account',value:'deactivate'}

];

return item;

}
},




data(){return{
dialog:{
change:false,
deactivate:false,
},

form:this.$inertia.form({
email:null,
password:null,
new_password:null,
}),





}},

methods:{
payload(){
const user=this.$page.props.auth.user;
this.form.email=user.email;
},




//update password form
submit(){
this.form.post(this.route('account.update_password'),{
onSuccess:()=>{
this.dialog.change=false;
const flash=this.$page.props.flash;
this.$notify({
title:flash.success!=null?'Successful':'Error',
message:flash.success!=null?flash.success:flash.warning,
type:flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});
}


},
mounted(){
this.payload();
}





}
</script>
