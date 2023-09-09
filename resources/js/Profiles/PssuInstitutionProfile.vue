<template>
<div class="section-body mt-3 mb-3" v-if="user!=null">
<div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-4 col-md-12 mb-3">
<div class="card h-100">
<div class="card-body text-center">
<em class="icon ni ni-user-circle-fill" style="font-size:100px;"></em>

<h6 class="mt-3 mb-0 text-transform">{{ user.firstname }} {{ account_type=='institutional'?null:user.lastname }} </h6>
<span><strong>Service No: </strong>{{ response.dasuns_number }} </span>
<ul class="mt-3 list-unstyled d-flex justify-content-center">

</ul>
<Inertia-link class="btn btn-default btn-sm" :href="route('dashboard')">Dashboard</Inertia-link>
<Inertia-link class="btn btn-default btn-sm" :href="route('messages')">Message</Inertia-link>


</div>

<div class="card-body border-0 p-0">
<ul class="list-group mb-3 pb-3" style="border:none">
<li class="list-group-item" style="border:none">
</li>
<li class="list-group-item">
<small class="text-muted">Institution: </small>
<p class="mb-0">{{ user.institution }} </p>
</li>
<li class="list-group-item">
<small class="text-muted">Date of Birth: </small>
<p class="mb-0">{{ user.dob.split('-').reverse().join('/') }} </p>
</li>
<li class="list-group-item">
<small class="text-muted">Account Type: </small>
<p class="mb-0 text-transform">{{ user.type}} </p>
</li>




<li class="list-group-item">
Wallet
<div class="float-right">
</div>
</li>




</ul>












</div>





</div>

</div>




<div class="col-lg-8 col-md-12 mb-3">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold">PROFILE</h3>
<div class="card-options">

<div class="item-action dropdown ml-2">
<a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
<div class="dropdown-menu dropdown-menu-right">
<a href="javascript:void(0)" class="dropdown-item" @click="show=true">Edit institution information</a>
<a href="javascript:void(0)" class="dropdown-item" @click="show2=true">Edit contact person information</a>
</div>
</div>
</div>
</div>
<div class="card-body">

<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Account Type</div>
<div class="data-value text-transform">{{ user.type }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone </div>
<div class="data-value">{{ user.tel }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ user.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Location</div>
<div class="data-value text-transform">{{ user.location }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Country</div>
<div class="data-value text-transform">{{ user.country }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Status</div>
<div class="data-value text-transform">
{{ user.status }}
</div>
</div>
</li>





<li class="data-item">
<div class="data-col">
<div class="data-label" style="font-weight:bold;">
ORGANISATION'S CONTACT PERSON
</div>
<div class="data-value text-transform">

</div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Conact Names</div>
<div class="data-value text-transform">
{{ user.contact_firstname }} {{ user.contact_lastname }}
</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">
{{ user.contact_gender }}
</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Designation</div>
<div class="data-value text-transform">
{{ user.contact_role }}
</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone</div>
<div class="data-value text-transform">
{{ user.contact_tel }}
</div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">
{{ user.contact_email }}
</div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Registered at</div>
<div class="data-value">
{{ user.created_at.substring(0,10).split('-').reverse().join('/') }}
</div>
</div>
</li>


</ul>

</div>
</div>

</div>
</div>
</div>

















<!---------->
<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="show==true" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">
Edit institution details
</h5>
<a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.name"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter name" v-model="form.name">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.dob"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter date of birth" v-model="form.dob">
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.type"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_institute($event)">
<option :value="user.institutionID">
{{ user.institution }}
</option>
<option v-for="i in institutions" :key="i.id" class="text-transform" :value="i.id">
{{ i.name }}
</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone contact" v-model="form.tel">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.location"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter location" v-model="form.location">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.country"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_country($event)">
<option :value="user.countryID">
{{ user.country }}
</option>
<option v-for="c in country" :key="c.id" class="text-transform" :value="c.id">
{{ c.name }}
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












<!---------->
<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="show2==true" @submit.prevent="submit2">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">
Edit institution contact person details
</h5>
<a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close" @click="show2=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">

{{ form2 }}

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
<select class="form-control" id="default-01" @change="set_gender($event)">
<option :value="form2.gender">{{ form2.gender }} </option>
<option value="male" v-if="form2.gender=='female'">
Male
</option>
<option value="female" v-else-if="form2.gender=='male'">
Female
</option>
</select>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="number" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form2.tel">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.email"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter email address" v-model="form2.email">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.role"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter designation" v-model="form2.role">
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
</template>
<script>

import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';
export default {
components:{
AppLayout,
InputError,
},

props:{
response:{},
title:{},
errors:{},

},

data(){
return{

gender:[{name:'male'},{name:'female'}],
//flash
flash:this.$page.props.flash,
//
form:this.$inertia.form({
id:null,
name:'',
tel:'',
location:'',
country:'',
dob:'',
type:'',

}),

//
form2:this.$inertia.form({
id:null,
firstname:'',
lastname:'',
gender:'',
tel:'',
role:'',
email:''

}),

show:false,
show2:false,
}
},

//

computed:{
user(){
return this.response.user;
},
//
account_type(){
return this.response.type;
},
//
country(){
const country=this.response.country;
const data=[];
country.forEach(element=>{
if(element.name!=this.response.user.country){
data.push(element);
}

});
return data;
},

//
institutions(){
const inst=this.response.institution;
const data=[];
inst.forEach(el=>{
if(el.name!=this.response.user.institution_type){
data.push(el);
}
});
return data;
},

//selected gender
select_contact_gender(){
const data=[];
this.gender.forEach(el=>{
if(this.response.user.contact_gender!=el.name){
data.push(el);
}
});
return data;
}




},

methods:{
set_gender(event){
this.form2.gender=event.target.value;
},

//
submit(){
this.form.put(this.route('profile.edit_institution'),{
onSuccess:()=>{
this.show=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
position:'bottom-right',
type:this.$page.props.flash.success!=null?'success':'warning'
});
}
});
},

//
submit2(){
this.form2.put(this.route('profile.update_contact_person'),{
onSuccess:()=>{
this.show2=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
position:'bottom-right',
type:this.$page.props.flash.success!=null?'success':'warning'
});
}
});
},

//
select_country(event){
this.form.country=event.target.value;
},
//
select_institute(event){
this.form.type=event.target.value;
},

//
set_fields(){
const user=this.response.user;
this.form.name=user.firstname;
this.form.dob=user.dob;
this.form.type=user.institutionID;
this.form.location=user.location;
this.form.tel=user.tel;
this.form.country=user.countryID;
this.form.id=user.id;
this.form2.id=user.id;
this.form2.firstname=user.contact_firstname;
this.form2.lastname=user.contact_lastname;
this.form2.gender=user.contact_gender;
this.form2.email=user.contact_email;
this.form2.role=user.contact_role;
this.form2.tel=user.contact_tel;
},
//format gender







},
mounted(){
this.set_fields();
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

ul li{
border:none;
}
.data-item{
border:none;
}


</style>
