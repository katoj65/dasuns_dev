<template>
<form @submit.prevent="submit">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Profession Support Services</h5>
<slot></slot>
</div>

<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.service"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_service($event)">
<option value="">Select</option>
<option :value="r.id" v-for="r in response.user_data.list_services" :key="r.id">
{{ r.name }}
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
flash:{}
},
data(){return{
    
form:this.$inertia.form({
service:null
}),

user:this.$page.props.auth.user,
error:this.errors.servive,
form_error:null,




}},

methods:{
hide(){
if(this.state1!=false){
this.show='hide';
}

},


//auto fill

submit(){

this.form.post(this.route('profile.add_ssp_service'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:'Profession service is already added.',
type:this.$page.props.flash.success!=null?'success':'warning'
});
this.$inertia.get(this.route('profile'));
}
});





},

//
select_service(event){
this.form.service=event.target.value;
},


//service validation
service_validation(){
var message=null;
this.response.services.forEach(item=> {
if(this.form.service==item.sid){
message=true;
}else{
message=false;
}
});
return message;
}







},



}
</script>

