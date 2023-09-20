<template>
<div class="nk-block">
<active-panelist-dashboard :response="response" :flash="flash" errors="errors" v-if="response.user.status=='active'"/>
<div class="nk-content" v-else>
<div class="row g-gs">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">
<div class="card">
<div class="card-header">
<div class="card-title">
<h6>
Complete your profile
</h6>
</div>
</div>
<div class="card-body text-center">
<em class="icon ni ni-user-circle-fill" style="font-size:100px;"></em>
<h4 class="mt-3 mb-0 text-transform">{{ response.user.firstname }} {{ response.user.lastname }} </h4>
<span>{{ response.user.email }} </span>
<div class="mt-3">
<button class="btn btn-default btn-sm">View Profile</button>
<button class="btn btn-default btn-sm">Message</button>
</div>


<div class="text-left mt-4">


<ul class="data-list is-compact">


<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">{{ response.user.gender }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value text-transform">{{ response.user.dob.split('-').reverse().join('/') }}</div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone</div>
<div class="data-value">{{ response.user.tel }}</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ response.user.email }}</div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Designation</div>
<div class="data-value text-transform">{{ response.user.role }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Joined at </div>
<div class="data-value">
{{ response.user.created_at.substring(0,10).split('-').reverse().join('/') }}
</div>
</div>
</li>

</ul>




</div>

</div>




<div class="card-body">

<table style="width:100%;">
<thead>
<tr>
<th colspan="3">
<h5>
Profession Experience
</h5>
</th>
</tr>
<tr>
<th>
Profession
</th>
<th>
Description
</th>
<th>
No. Years
</th>
</tr>
</thead>
<tbody v-if="response.profile.length>0">
<tr v-for="(t,key) in response.profile" :key="key">
<td>
{{ t.name }}
</td>
<td>
{{ t.description }}
</td>
<td>
{{ t.number_years }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="2">
No content
</td>
</tr>
</tbody>
</table>




</div>



<div class="card-body">

<h6 class="mb-3">Fill in profile information</h6>

<form @submit.prevent="submit">


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.pid"></input-error>
</label>
<div class="form-control-wrap">
<select type="text" class="form-control" id="default-01" @change="set_profession($event)">
<option value="">--Select profession--</option>
<option v-for="(p,key) in response.professions" :key="key" :value="p.id">
{{ p.name }}
</option>

</select>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.description"></input-error>
</label>
<div class="form-control-wrap">
<textarea class="form-control" id="default-01" placeholder="Enter profession description" v-model="form.description">
</textarealass>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.years"></input-error>
</label>
<div class="form-control-wrap">
<input type="number" class="form-control" id="default-01" placeholder="Enter of years of experience" v-model="form.years">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
<a href="javascript:void(0)" class="buttom btn-default btn-sm text-black" style="border-radius:10px;float:right;padding:15px;font-size:17px;" v-if="response.profile.length>0" @click="submit2('active')">Continue <em class="icon ni ni-arrow-long-right"></em></a>

</div>
</div>

</form>

</div>
</div>










</div>
<div class="col-12 col-md-3"></div>
</div>
</div>
</div>
</template>
<script>
import ActivePanelistDashboard from '@/Panelist/ActivePanelistDashboard';
import InputError from '@/Alerts/InputError';
export default {

components:{
InputError,
ActivePanelistDashboard,
},

props:{
response:{},
title:{},
errors:{},
flash:{}
},


data(){
return{
form:this.$inertia.form({
pid:null,
description:'',
years:''

}),

form2:this.$inertia.form({
status:null,
}),








}},







methods:{
set_profession(event){
this.form.pid=event.target.value;
},

submit(){
this.form.post(this.route('profile.post_panelist'),{
onSuccess:()=>{
const flash=this.$page.props.flash;
this.form.reset();
this.$notify({
title:flash.success!=null?'Successful':'Warning',
message:flash.success!=null?flash.success:flash.warning,
position:'bottom-right',
type:flash.success!=null?'success':'warning'});

}

});
},

submit2(status){
this.form2.status=status;
this.form2.put(this.route('user.update_status'),{

onSuccess:()=>{
const flash=this.$page.props.flash;
this.form.reset();
this.$notify({
title:flash.success!=null?'Successful':'Warning',
message:flash.success!=null?flash.success:flash.warning,
position:'bottom-right',
type:flash.success!=null?'success':'warning'});

}


});
}





},





computed:{
user(){
return this.response.user_data.user;
},

profile(){
return this.response.user_data.profile;
}



}



}
</script>
<style scoped>
table tr th, table tr td{
padding:10px;
}
.data-item{
border:none;
}
</style>
