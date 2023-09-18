<template>
<app-layout>
<div style="min-height:600px;">
<div class="row p-4">
<div class="col-12 col-md-3"></div>

<div class="col-12 col-md-6">
<div class="mt-2 card">
<div  class="clearfix text-center card-header">
<h5>Settings </h5>
</div>
<div class="card-body pt-0">




<ul class="data-list is-compact" v-if="response.user!=null">
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">First Name</div>
            <div class="data-value text-transform">{{response.user.firstname}} </div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Last Name</div>
            <div class="data-value text-transform">{{response.user.lastname}}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Gender</div>
            <div class="data-value text-transform">{{response.user.gender}}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Date of Birth</div>
            <div class="data-value text-soft">{{response.user.dob.split('-').reverse().join('/')}}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Telephone</div>
            <div class="data-value">{{response.user.tel}}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Email Address</div>
            <div class="data-value">{{response.user.email}}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Registered on </div>
            <div class="data-value">
                {{response.user.created_at.substring(0,10).split('-').reverse().join('/')}}
            </div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Password</div>
            <div class="data-value">******** <a href="javascript:void(0)" class="ml-3" @click="show=true">Change</a></div>
        </div>
    </li>


</ul>




</div>
</div>
</div>
<div class="col-12 col-md-3"></div>
</div>
</div>




<!---------Dialog Box-------->
<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
    <h5 class="modal-title" style="color:white;">Change Password</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

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
response:{},
errors:{}
},


computed:{
menu(){

const item=[
{id:1,item:'User names',value:this.response.user.firstname},
{id:2,item:'email',value:''},
{id:3,item:'Telephone Number',value:''},
{id:4,item:'Designation',value:''},
{id:5,item:'Date of Birth',value:''},
{id:6,item:'Gender',value:''},
{id:7,item:'Account Type',value:''},
{id:8,item:'Account Status',value:''},
{id:9,item:'Password',value:'change'},
{id:10,item:'Deactivate Account',value:'.......'}

];

return item;

}
},




data(){return{
show:false,
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
<style scoped>
.data-item{
border: none;
}
</style>
