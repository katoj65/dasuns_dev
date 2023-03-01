<template>
<div>

<!-----------Personal-->
<div v-if="user_details.account_type=='personal'">
<WelcomePSSU :response="response" v-if="$page.props.auth.user.status=='active'"></WelcomePSSU>
<div class="col-12 col-md-12" v-else-if="$page.props.auth.user.status=='pending'">
<div class="card mt-2 mb-2" v-if="account_type=='personal'">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2 pt-5">
<div class="user-avatar md" style="background:#0B5345;width:100px;height:100px;">
<img src="" alt="">
<!-- <div class="status dot dot-lg dot-success"></div> -->
<em class="icon ni ni-user-alt-fill" style="font-size:50px;"></em>
</div>
<div class="user-info">
<h1 style="font-size:30px;font-weight:bold;">
{{ user.firstname }} {{ user.lastname }}


</h1>
<span class="sub-text" style="font-size:16px;">
{{ user.email }}
</span>
</div>
</div>


<form v-if="user_info===null" @submit.prevent="submit">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">
<div class="card mt-3 mb-5 thick-border" style="border-radius:30px;">
<div class="card-header thick_bg border-bottom" style="border-radius:25px 25px 0 0">
<h1 style="text-align:center;font-size:18px;color:white;" class="p-1">Create Your Profile</h1>
</div>

<div class="card-body pl-5 pr-5 pt-0">

<div class="form-group pt-10">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>Select Professional Services
<input-error :error="$page.props.errors.serviceID"></input-error>
 </label>
 <b-form-select v-model="form.serviceID" :options="options" multiple :select-size="4" class="custom-select form-control form-control-lg"></b-form-select>
</div>
</div>
</div>






<div class="form-group pt-4">
<div class="form-control-wrap">
<input-error :error="$page.props.errors.location"></input-error>
<input type="text" class="form-control form-control-lg" placeholder="Enter your address / location" v-model="form.location">
</div>
</div>



<div class="form-group pt-4">
<div class="form-control-wrap">
<input-error :error="$page.props.errors.countryID"></input-error>
<select class="form-control form-control-lg" @change="select_country($event)">
<option>-- Select your country of residance --</option>
<option :value="c.id" v-for="c in response.country" :key="c.id">{{ c.name }} </option>
</select>
</div>
</div>





<div class="form-group pt-2">
<label class="form-label">Do you have a disability?
<input-error :error="$page.props.errors.disability_status"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control form-control-lg" @change="select_disability($event)">
<option>-- Select Answer --</option>
<option value="false">No</option>
<option value="true">Yes</option>
</select>
</div>
</div>





<div class="form-group pt-2" v-if="form.disability_status=='yes'">
<label class="form-label" for="default-07">Select your disability / disabilities </label>
<div class="form-control-wrap">
<div class="form-control-select-multiple">

 <b-form-select v-model="form.disabilityID" :options="response.disability" multiple :select-size="4" class="custom-select form-control form-control-lg"></b-form-select>


</div>
</div>
</div>




<div class="form-group pt-10 pb-10" style="text-align:center;">
<button type="submit" class="btn btn-success button-green border-radius border-radius" style="padding-left:50px;padding-right:50px;font-size:17px;">Save</button>
</div>



</div>


</div>
</div>
</div>
<div class="col-12 col-md-3"></div>
</form>



</div><!-- .team -->
</div><!-- .card-inner -->
</div>
<!-- .card -->
<create-institution-profile v-else-if="account_type=='institutional'" :response="response" :errors="errors"></create-institution-profile>
</div>
</div>


<!----Institutional------->
<div v-else>
<create-institution-profile :response="response" :errors="errors" v-if="$page.props.auth.user.status=='pending'"></create-institution-profile>
<dashboard-institution v-else-if="$page.props.auth.user.status=='active'"></dashboard-institution>
</div>
</div>
</template>
<script>
import WelcomePSSU from '@/PSSU/WelcomePSSU';
import InputError from '@/Alerts/InputError';
import CreateInstitutionProfile from '@/PSSU/CreateInstitutionProfile';
import DashboardInstitution from '@/PSSU/DashboardInstitution';
export default{
components: {
WelcomePSSU,
InputError,
CreateInstitutionProfile,
DashboardInstitution


},
props:{
response:{},
errors:{},
},
data(){return{

//user details
user_details:{
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
status:this.$page.props.auth.user.status,

},





 // Array reference
options:this.response.services,
option1:this.response.disability,
user:this.$page.props.auth.user,
user_profile:this.$page.props.auth.user_profile,
user_info:null,
account_type:this.$page.props.auth.user.account_type,

//form
form:this.$inertia.form({
serviceID:[],
location:null,
disability_status:null,
countryID:null,
disabilityID:[],
upload:null,
}
),
//













}},
methods:{
select_service:function(event){
this.form.serviceID=event.target.value;
},

select_country:function(event){
this.form.countryID=event.target.value;
},

select_disability:function(event){
this.form.disabilityID=null;
this.form.disability_status=event.target.value;
if(event.target.value==true){
alert('some information');
}
},

//submit
submit:function(){
this.$inertia.post(route('create_profile.pssu'),this.form);
}












}


}
</script>
<style scoped>
el-select{
border:none;
}
</style>
