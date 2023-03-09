<template>
<div>
<button type="button" @click="show()" style="padding:0;margin:0;font-size:14px;padding-left:15px;padding-right:15px;" class="btn btn-outline-primary border-radius">Add</button>

<form class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">


<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;word-spacing:0px;text-transform:none;">Upload your Identification Document</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">
<p style="font-weight:normal;font-size:14px;letter-spacing:0px;color:black;line-height:25px;word-spacing:0px;text-transform:none;" class="pm-3">
Upload a scanned copy of your National Identification Card/Passport/ Driving Permit.</p>
<div class="form-group mt-3">
<label class="form-label" for="default-01">
<input-error :error="errors.document"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_document($event)">
<option value="">Select document</option>
<option :value="d.name" v-for="d in documents" :key="d.id">{{ d.name }} </option>
</select>
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.number"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter document number" v-model="form.number">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<!-- <input-error :error="errors.address"></input-error> -->
</label>
<div class="form-control-wrap">



<div class="custom-file">
<input type="file" multiple="" class="custom-file-input form-control" id="customFile" style="padding:20px;">
<label class="custom-file-label " for="customFile">Choose file</label>
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
</form>

</div>
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
flash:{},
},
data(){return{
open:false,
form:this.$inertia.form({
document:null,
number:null,
file:null,
}),

//
documents:this.response.user_data.security_documents,



}},
methods:{
show(){
if(this.open==false){
this.open=true;
}else{
this.open=false;
}
},

select_document(event){
this.form.document=event.target.value;
},



submit(){
this.form.post(route('create-PSSP-security-documents'),{
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
this.form.reset();
}
});
}






}





}
</script>
<style scoped>
label{
font-size:13px;
letter-spacing: 0;
text-transform:none;
word-spacing: 0px;
}
</style>
