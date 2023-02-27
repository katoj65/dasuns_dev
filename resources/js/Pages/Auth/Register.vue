<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">



<div class="row g-gs" style="margin:300px;padding-top:10px;padding-bottom:30px;">
<div class="col-md-3 col-12"></div>
<div class="col-md-6 col-12">



<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;">
Create New Account
</h1>
<p style="padding:10px;font-size:16px;text-align:center;color:#AAB7B8;">
Dasuns helps you find Professional support service <br/>providers around you.
</p>









<el-tabs v-model="activeName"  @tab-click="handleClick">
<el-tab-pane name="first">
<span slot="label" style="font-size:20px;color:#07372F;"><i class="el-icon-user-solid"></i> Personal Account</span>

<reg-form-1 :errors="errors" :flash="flash"></reg-form-1>


</el-tab-pane>
<el-tab-pane name="second">
  <span slot="label" style="font-size:20px;color:#07372F;">
  <i class="el-icon-school"></i>
Organisation Account
  </span>


<reg-form-2 :flash="flash" :errors="errors"></reg-form-2>




    </el-tab-pane>
  </el-tabs>














</div>
<div class="col-md-3 col-12"></div>
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
import RegForm2 from './RegForm2';
import RegForm1 from './RegForm1';


export default {
components: {
LayoutUnAuth,
InputError,
FormErrors,
FieldRequiredMessage,
RegForm2,
RegForm1,


},
props:{
errors:[],
flash:{},

},

data() {
return {
activeName: 'first',
//register organisation
org_form:this.$inertia.form({
firstname: null,
lastname:'null',
gender:'other',
dob:'null',
email:null,
tel:null,
role:'pssu',
password:null,
password_confirmation:null,
terms: false,
account_type:'institutional'

}),

org_form_errors:{
firstname:null,
tel:null,
email:null,
password:null,
password_confirmation:null,
terms:null,
},






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








form_errors:{
firstname:null,
lastname:null,
gender:null,
dob:null,
email:null,
tel:null,
email:null,
role:null,
check_dob:null,
password:null,
password_confirmation:null,
terms:null,
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
this.form_errors={};
var age=this.dob_check();
if(age>=16){
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


}else{
this.age_error='You must be atleast 16 years to request or provide any service using Dasuns platform.';
this.form_errors.dob='* Check.';
}
},




//submit organisation form
submit_org(){
this.terms2_message=null;
if(this.org_form.terms==true){
this.terms_color2='black';
this.form.post(this.route('register'),{});
}else{
this.terms_color2='red';
this.terms2_message="You are required to agree to Dasun's terms in order to proceed.";
}
},

//validate organisation form
form2_auto_fields(){
this.terms_color='black';
if(this.activeName=='second'){
this.form.lastname='none';
this.form.gender='other';
this.form.account_type='institutional';
this.form.dob='2000-01-01';
this.form.role='pssu';
this.form.terms=false;
}else{
this.form={
lastname:null,
gender:null,
account_type:null,
role:null,
dob:null,
terms:false,


};
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
<style scoped>
</style>
