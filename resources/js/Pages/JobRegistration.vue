<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;font-family: Arial, Helvetica, sans-serif;">
{{ title }}
</h1>

<div>
<div class="row">

<div class="col-md-3 col-12"></div>
<div class="col-md-6 col-12">



<div>
<!---Age check--->


<div class="col-12 col-md-12" v-if="terms_color=='red'" style="color:red;">
* You have to agree to Dasuns' terms to proceed.
</div>



<div class="alert alert-danger alert-icon" v-if="age_error!=null">
<em class="icon ni ni-cross-circle"></em>
<strong>Check your date of birth</strong>! {{ age_error }} </div>
<form @submit.prevent="submit">
<div class="row">
<div class="col-lg-12 pt-2">
<div class="form-group">
<div class="form-control-wrap">
<!-- <input-error :error="errors.firstname"></input-error> -->
<field-required-message :error="errors.firstname"></field-required-message>
<input type="text" class="form-control form-control-lg" placeholder="Enter first name" v-model="form.firstname">
</div>
</div>
</div>

<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<field-required-message :error="errors.lastname"></field-required-message>
<input type="text" class="form-control form-control-lg" placeholder="Enter last name" v-model="form.lastname">
</div>
</div>
</div>





<div class="col-md-6 pt-10">
<div class="form-group">
<div class="form-control-wrap" style="text-align:left;">
<span style="padding-left:15px;">Gender
<field-required-message :error="errors.gender"></field-required-message>
</span>
<select class="form-control form-control-lg" @change="select_gender($event)">
<option value="">--Select--</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select>
</div>
</div>
</div>



<div class="col-md-6 pt-10">
<div class="form-group">
<div class="form-control-wrap" style="text-align:left;padding-left:10px;">
<span style="padding-left:15px;">
Date of birth
<field-required-message :error="errors.dob"></field-required-message>
</span>
<input class="form-control form-control-lg" type="date" placeholder="Enter date of birth" v-model="form.dob">
</div>
</div>
</div>




<div class="col-md-12 pt-10">
<div class="form-group">
<div class="form-control-wrap" style="text-align:left;">
<span style="padding-left:15px;">
<span style="padding-right:10px;">Tell us what you are looking for at Dasuns platform.</span>
<field-required-message :error="errors.role"></field-required-message>
</span>
<select class="form-control form-control-lg" @change="select_role($event)" style="text-transform:capitalize;">
<option value="">--Select--</option>
<option :value="r.name" v-for="r in response.role" :key="r.id">{{ r.name }} </option>

<!-- <option value="other">Other</option> -->
</select>
</div>
</div>
</div>







<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">

<field-required-message :error="errors.tel"></field-required-message>
<input type="number" class="form-control form-control-lg" placeholder="Enter your telephone number" v-model="form.tel">
</div>
</div>
</div>


<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<input-error :error="errors.email"></input-error>
<input type="email" class="form-control form-control-lg" placeholder="Enter your email address" v-model="form.email">
</div>
</div>
</div>


<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<input-error :error="errors.password"></input-error>
<input type="password" class="form-control form-control-lg" placeholder="Enter your password" v-model="form.password">
</div>
</div>
</div>




<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<input-error :error="errors.password_confirmation"></input-error>
<input type="password" class="form-control form-control-lg" placeholder="Confirm password" v-model="form.password_confirmation">
</div>
</div>
</div>






<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap" style="text-align:left;">


<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input form-control" checked="" id="customCheck2" v-model="form.terms">
<label class="custom-control-label" for="customCheck2">
<span :style="'font-size:20px;color:'+terms_color"> I agree to Dasun's terms. </span>
</label>
<Inertia-link style="margin-left:20px;" :href="route('terms')">Read terms</Inertia-link>
</div>
</div>
</div>
</div>






<div class="col-lg-12 pt-10 pb-20">
<div class="form-group">
<button type="submit" class="btn btn-success button" style="padding-left:50px;padding-right:50px;font-size:17px;">Continue</button>
</div>


<div class="form-group pt-10">
<Inertia-link :href="route('login')" style="font-size:20px;" class="inertia-link">
Already have an account?
<strong style="margin-left:30px;">
Login
</strong>
</Inertia-link>
</div>



</div>




</div>

</form>
</div>













</div>
<div class="col-md-3 col-12"></div>



</div>


</div>

</div>
</div>
</div>
</div>
</layout-un-auth>
</template>

<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth';
import InputError from '@/Alerts/InputError';
import FormErrors from '@/Alerts/FormErrors';
import FieldRequiredMessage from '@/Alerts/FieldRequiredMessage';


export default {
components: {
LayoutUnAuth,
InputError,
FormErrors,
FieldRequiredMessage,



},
props:{
response:{},
title:{},
errors:[],
flash:{},


},

data() {
return {
activeName: 'first',

//
form_type:{
individual:{
form:1,

},

business:{
form1:true,
form2:false,
}

},



age_error:null,
terms_color:'black',


form:this.$inertia.form({
firstname: null,
lastname:null,
gender:null,
dob:null,
email:null,
tel:null,
role:null,
password:null,
password_confirmation:null,
terms: false,
age:null,
account_type:'personal',
}),



}
},

methods: {
submit() {
this.terms_color='black';
if(this.form.terms==false){
this.terms_color='red';
}else{
this.terms_color='black';
this.form.post(this.route('register'));
}

},









//select gender
select_gender(event){
this.form.gender=event.target.value;
},

select_role(event){
this.form.role=event.target.value;
},

//dob check
dob_check(){
this.form.age=null;
this.age_error=null;
if(this.form.dob!=null){
var y=new Date();
var year=y.getFullYear();
//sub string
var form_dob=this.form.dob;
var dob=form_dob.substring(0,4);
var age=year-dob;
this.form.age=age;
return age;
}
},



//items
handleClick(tab, event) {
// this.form2_auto_fields();
},

submit2(){
this.form.post(this.route('register'));
}







},


mounted(){

}




}
</script>
