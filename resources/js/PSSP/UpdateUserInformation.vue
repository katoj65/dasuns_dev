<template>
<form @submit.prevent="submit">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit User Information</h5>
<slot></slot>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">

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
<select class="form-control text-transform" id="default-01" @change="select_gender($event)">
<option :value="user.gender">{{ user.gender }} </option>
<option value="male" v-if="user.gender!='male'">Male</option>
<option value="female" v-if="user.gender!='female'">Female</option>
<option value="other" v-if="user.gender!='other'">Other</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.dob"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter last name" v-model="form.dob">
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form.tel">
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
</div>

</form>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
components:{
   InputError,
},
props:{
errors:{},
response:{},
state:{},
flash:{}
},
data(){return{
open:false,
form:this.$inertia.form({
firstname:null,
lastname:null,
gender:null,
email:null,
role:null,
tel:null,
dob:null,
}),

user:this.$page.props.auth.user,


}},
methods:{
show(){
if(this.state==false){
this.state='update_user';
}else{
this.state=false;
}
},
//auto fill
user_fill(){
this.form.firstname=this.user.firstname;
this.form.lastname=this.user.lastname;
this.form.dob=this.user.dob;
this.form.tel=this.user.tel,
this.form.gender=this.user.gender
},

submit(){
if(this.update_validation()==true){

this.form.post(this.route('user_update_account'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: 'User information has been updated.',
type: 'success'
});
this.$inertia.get(this.route('profile'));
}
});


}else{

this.$inertia.get(this.route('profile'));
this.$notify({
    position: 'bottom-right',
title: 'Warning',
message: 'User information was not changed.',
type: 'warning'
});

}


},

select_gender(event){
this.form.gender=event.target.value;
},

update_validation(){
if(this.form.firstname!=this.user.firstname || this.form.lastname!=this.user.lastname || this.form.gender!=this.user.gender || this.form.dob!=this.user.dob || this.form.tel!=this.user.tel){
return true;
}else{
return false}
},








},

mounted(){
this.user_fill();



}




}
</script>

