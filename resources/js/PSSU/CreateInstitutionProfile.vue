<template>

<el-card class="card pt-3" style="min-height:700px;" shadow="never">
<div class="card-inner">
<div class="team">



<div class="user-card user-card-s2">
<div class="user-avatar md" style="background:#0B5345;width:100px;height:100px;">
<img src="" alt="">
<!-- <div class="status dot dot-lg dot-success"></div> -->
<em class="icon ni ni-user-alt-fill" style="font-size:50px;"></em>
</div>
<div class="user-info">
<h1 style="font-weight:bold;text-transform:capitalize;" class="size:2">
{{ user.usernames }}
</h1>
<span class="sub-text" style="font-size:16px;">
{{ user.email }}
</span>
</div>
</div>
</div>



<div class="row pt-0 mt-2">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">



<div class="card thick-border" style="border-radius:30px;">
<div class="card-header thick-bg" style="text-align:center;border-radius: 25px 25px 0 0;">
<h1 class="size20" style="color:white;">Create Profile</h1>
</div>
<div class="card-body pl-5 pr-5">
<form class="row" @submit.prevent="submit">
<div class="col-12 col-md-12">
<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.typeID"></input-error>
 </label>
<select class="form-control form-control-lg" style="text-transform:capitalize;" @change="select_type($event)">
<option value="">Select Institution Type</option>
<option v-for="i in response.institution_type" :key="i.id" :value="i.id">
{{ i.name }}
</option>
</select>
<!-- <input type="text" class="form-control form-control-lg" placeholder="Enter your address / location"> -->
</div>
</div>
</div>


<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.location"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter institution address / location" v-model="form.location">
</div>
</div>
</div>





<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.countryID"></input-error>
 </label>
<select class="form-control form-control-lg" style="text-transform:capitalize;" @change="select_country($event)">
<option value="">Select Country</option>
<option v-for="c in response.country" :key="c.id" :value="c.id">
{{ c.name }}
</option>
</select>
</div>
</div>
</div>





<div class="form-group pt-2">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>Select Professional Services
<input-error :error="$page.props.errors.serviceID"></input-error>
 </label>
 <b-form-select v-model="form.serviceID" :options="options" multiple :select-size="4" class="custom-select form-control form-control-lg"></b-form-select>
</div>
</div>
</div>




<div class="border-top pt-4 mt-4">
<h1 style="font-weight:bold;font-size:20px;"><em class="icon ni ni-building"></em>  Institution Contact Person</h1>
</div>



<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.firstname"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter first name" v-model="form.firstname">
</div>
</div>
</div>



<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.lastname"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter last name" v-model="form.lastname">
</div>
</div>
</div>





<div class="col-12 col-md-12 p-0">
<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.gender"></input-error>
 </label>
<select class="form-control form-control-lg" @change="select_gender($event)">
<option>Select gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
</div>
</div>
</div>
</div>



<div class="col-12 col-md-12 p-0">
<div class="form-group pt-1">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.position"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter position" v-model="form.position">
</div>
</div>
</div>
</div>



<div class="col-12 col-md-12 p-0">
<div class="form-group pt-3">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.tel"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter telephone number" v-model="form.tel">
</div>
</div>
</div>
</div>

<div class="form-group pt-2">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="$page.props.errors.email"></input-error>
 </label>
<input type="email" class="form-control form-control-lg" placeholder="Enter email address" v-model="form.email">
</div>
</div>
</div>


<div class="col-lg-12 pt-10 pb-10" style="text-align:center;">
<div class="form-group">
<button type="submit" class="btn btn-success button" style="padding-left:50px;padding-right:50px;font-size:17px;">Finish</button>
</div>
</div>




</div>

</form>

</div>
</div>


</div>
<div class="col-12 col-md-3"></div>



</div>












</div><!-- .team -->
</el-card><!-- .card-inner -->
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError,
},
props:{
response:{},
title:{},
errors:{},

},

data(){return{


form: this.$inertia.form(
{
serviceID:[],
typeID:null,
location:null,
countryID:null,
firstname:null,
lastname:null,
gender:null,
email:null,
tel:null,
position:null,


}
),





options:this.response.services,
user:{
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
email:this.$page.props.auth.user.email,
tel:this.$page.props.auth.user.tel,
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
usernames:this.$page.props.auth.user.account_type=='personal'?this.$page.props.auth.user.firstname+' '+this.$page.props.auth.user.lastname:this.$page.props.auth.user.firstname,
}


}},

methods:{
select_gender(event){
this.form.gender=event.target.value;
},
select_country(event){
this.form.countryID=event.target.value;
},
select_type(event){
this.form.typeID=event.target.value;
},

submit(){
this.form.post(this.route('profile.create_institution'),{

});
}






}




}
</script>
