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
<small class="text-muted">Gender: </small>
<p class="mb-0 text-transform">{{ user.gender }} </p>
</li>
<li class="list-group-item">
<small class="text-muted">Date of Birth: </small>
<p class="mb-0">{{ user.dob.split('-').reverse().join('/') }} </p>
</li>
<li class="list-group-item">
<small class="text-muted">Account Type: </small>
<p class="mb-0 text-transform">{{ user.account_type}} </p>
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
<a href="javascript:void(0)" class="dropdown-item" @click="show=true">Edit profile</a>

</div>
</div>
</div>
</div>
<div class="card-body">

<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Account Type</div>
<div class="data-value text-transform">{{ user.account_type }} </div>
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
Edit user details
</h5>
<a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form.firstname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form.lastname">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01">
<option :value="user.gender">
{{ user.gender }}
</option>
<option class="text-transform" v-if="user.gender=='male'">
Female
</option>
<option class="text-transform" v-else-if="user.gender=='female'">
Male
</option>
</select>
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
firstname:'',
lastname:'',
gender:'',
tel:'',
location:'',
country:'',
dob:'',
}),
//
show:false,
}
},

//

computed:{
user(){
return this.response.user;
},
//
account_type(){
return this.response.user.account_type;
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

//
submit(){
this.form.put(this.route('profile.update-pssu-personal'),{
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
select_country(event){
this.form.country=event.target.value;
},

//
set_fields(){
const user=this.response.user;
this.form.firstname=user.firstname;
this.form.lastname=user.lastname;
this.form.dob=user.dob;
this.form.gender=user.gender;
this.form.location=user.location;
this.form.tel=user.tel;
this.form.country=user.countryID;
this.form.id=user.id;
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
