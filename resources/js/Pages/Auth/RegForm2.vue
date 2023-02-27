<template>
    <div>
    <form @submit.prevent="submit">
<div class="row">
<div class="col-12 col-md-12" v-if="terms_color=='red'" style="color:red;">
* You have to agree to Dasuns' terms to proceed.
</div>

<div class="col-lg-12 pt-2">
<div class="form-group">
<div class="form-control-wrap">
<field-required-message :error="errors.firstname"></field-required-message>
<!-- <input-error :error="errors.firstname"></input-error> -->
<input type="text" class="form-control form-control-lg" placeholder="Enter institution name" v-model="form.firstname">
</div>
</div>
</div>

<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<field-required-message :error="errors.tel"></field-required-message>
<input type="number" class="form-control form-control-lg" placeholder="Enter institution telephone number" v-model="form.tel">
</div>
</div>
</div>


<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<input-error :error="errors.email"></input-error>
<input type="email" class="form-control form-control-lg" placeholder="Enter institution email address" v-model="form.email">
</div>
</div>
</div>


<div class="col-lg-12 pt-10">
<div class="form-group">
<div class="form-control-wrap">
<input-error :error="errors.password"></input-error>
<input type="password" class="form-control form-control-lg" placeholder="Enter password" v-model="form.password">
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
<input type="checkbox" class="custom-control-input form-control" checked="" id="customCheck11" v-model="form.terms">
<label class="custom-control-label" for="customCheck11">
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
</template>
<script>
import InputError from '@/Alerts/InputError';
import FormErrors from '@/Alerts/FormErrors';
import FieldRequiredMessage from '@/Alerts/FieldRequiredMessage';

export default {
components: {
InputError,
FormErrors,
FieldRequiredMessage
},

props:{
errors:{},
flash:{},
},

data(){return{

age_error:null,
terms_color:'black',
form:this.$inertia.form({
firstname: null,
lastname:'none',
gender:'other',
dob:'2000-01-01',
email:null,
tel:null,
role:'pssu',
password:null,
password_confirmation:null,
terms: false,
age:null,
account_type:'institutional',
}),
}},



methods: {
submit() {
this.form_errors={};
if(this.form.terms==true){
this.terms_color='black';
this.form.post(this.route('register'), {
onFinish: () => {
this.form.reset('password', 'password_confirmation');
this.form_validation();
},
})
}else{
this.terms_color='red';
}
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


//form validation
form_validation(){
this.form_errors={};
if(this.errors.firstname!=null){
this.form_errors.firstname='* Required.';
}
if(this.errors.lastname!=null){
this.form_errors.lastname='* Required.';
}
if(this.errors.gender!=null){
this.form_errors.gender='* Required.';
}
if(this.errors.dob!=null){
this.form_errors.dob='* Required.';
}
if(this.errors.email!=null){
this.form_errors.email=this.errors.email;
}
if(this.errors.tel!=null){
this.form_errors.tel='* Required.';
}
if(this.errors.password!=null){
this.form_errors.password=this.errors.password;
}
if(this.errors.role!=null){
this.form_errors.role='* Required';
}
if(this.errors.password_confirmation!=null){
this.form_errors.password_confirmation='* Required';
}
},

//items
handleClick(tab, event) {

},

submit2(){
this.form.post(this.route('register'));
}







},






}
</script>
