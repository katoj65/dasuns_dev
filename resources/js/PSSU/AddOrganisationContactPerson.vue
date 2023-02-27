<template>
<form @submit.prevent="submit">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Organisation Contact Person</h5>
<slot></slot>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">



<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="errors.firstname"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter first name" v-model="form.firstname">
</div>
</div>
</div>



<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="errors.lastname"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter last name" v-model="form.lastname">
</div>
</div>
</div>














<div class="row">
<div class="col-12 col-md-6">
<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="errors.gender"></input-error>
 </label>
<select class="form-control form-control-lg" @change="select_gender($event)">
<option value="">Select gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select>
</div>
</div>
</div>
</div>


<div class="col-12 col-md-6">
<div class="form-group pt-0">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="errors.role"></input-error>
 </label>
<input type="text" class="form-control form-control-lg" placeholder="Enter position" v-model="form.role">
</div>
</div>
</div>
</div>
</div>


<div class="col-12 col-md-12 p-0">
<div class="form-group pt-3">
<div class="form-control-wrap">
<div class="form-control-select-multiple">
<label>
<input-error :error="errors.tel"></input-error>
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
<input-error :error="errors.email"></input-error>
 </label>
<input type="email" class="form-control form-control-lg" placeholder="Enter email address" v-model="form.email">
</div>
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
errors:{}
},
data(){return{
form:this.$inertia.form({
firstname:null,
lastname:null,
gender:null,
role:null,
tel:null,
email:null,
}),


}},
methods:{
submit(){
this.form.post(this.route('add.organisation_contact_person'),{
onSuccess:()=>{
var flash=this.$page.props.flash;
this.open=false;
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message: flash.success,
type: 'success'
});
this.$inertia.get(this.route('profile'));
}
});

},
select_gender(event){
this.form.gender=event.target.value;
}






}







}
</script>
