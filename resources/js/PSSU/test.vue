<template>
<div>






<div class="row" v-if="user_profile.length==0">
<div class="col-12 col-md-12">
<div class="card" style="min-height:700px;" v-if="account_type=='personal'">
<div class="card-inner">
<div class="team">





<div class="user-card user-card-s2">
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
<div class="team-details">
<p style="font-size:20px;font-weight:bold;">Create your Profile</p>
</div>
<!-- <ul class="team-statistics">
<li><span>213</span><span>Projects</span></li>
<li><span>87.5%</span><span>Performed</span></li>
<li><span>587</span><span>Tasks</span></li>
</ul> -->
<!-- <div class="team-view">
<a href="html/user-details-regular.html" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
</div> -->
<form v-if="user_info===null" @submit.prevent="submit">
<div class="row">
<div class="col-12 col-md-4"></div>
<div class="col-12 col-md-4">

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


<!--
  <el-select v-model="form.serviceID" multiple placeholder="-- Select --"   size="large"  class="custom-select form-control form-control-lg">
    <el-option
      v-for="s in response.services"
      :key="s.id"
      :label="s.name"
      :value="s.id" >
    </el-option>
  </el-select> -->





<!-- <div class="form-group pt-10">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>Professional Services </label>
<select class="custom-select form-control form-control-lg" id="default-07" @change="select_service($event)">
<option value="option_select0">-- Select --</option>
<option :value="s.id" v-for="s in response.services" :key="s.id">
{{ s.name }}
</option>

</select>
</div>
</div>
</div> -->






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
<option value="no">No</option>
<option value="yes">Yes</option>
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




<div class="form-group pt-3">
<label class="form-label" for="default-06">Upload your picture</label>
<div class="form-control-wrap">
<div class="custom-file">
<input type="file" multiple="" class="custom-file-input form-control form-control-lg" id="customFile" style="padding:30px;">
<label class="custom-file-label" for="customFile">Choose file</label>
</div>
</div>
</div>



<div class="form-group pt-3" style="text-align:center;color:#45B39D;">
<div class="form-control-wrap">
<a href="#" style="font-size:17px;font-weight:bold;">View User Information </a>
</div>
</div>





<div class="form-group pt-10 pb-10" style="text-align:center;">
<button type="submit" class="btn btn-success button-green border-radius border-radius" style="padding-left:50px;padding-right:50px;font-size:17px;">Save</button>
</div>






</div>
<div class="col-12 col-md-12"></div>
</div>
</form>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>
<!-- .card -->
<create-institution-profile v-else-if="account_type=='institutional'" :response="response" :errors="errors"></create-institution-profile>
</div>
</div>
<div class="row" v-else>
<WelcomePSSU :response="response" v-if="user_details.account_type=='personal'"></WelcomePSSU>
<dashboard-institution></dashboard-institution>
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
