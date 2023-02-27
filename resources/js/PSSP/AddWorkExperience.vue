<template>
<div>
<button type="button" @click="show()" style="padding:0;margin:0;font-size:14px;padding-left:15px;padding-right:15px;">Add</button>

<form class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">


<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;word-spacing:0px;text-transform:none;">Add Work Experience</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">
<p style="font-weight:normal;font-size:14px;letter-spacing:0px;color:black;line-height:25px;word-spacing:0px;text-transform:none;" class="pm-3">
Tell us your work experince.</p>


<div class="row pt-2">
<div class="col-12 col-md-12">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.organisation"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter organisation name" v-model="form.organisation">
</div>
</div>
</div>



<div class="col-12 col-md-12 mt-3">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.position"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter position held" v-model="form.position">
</div>
</div>
</div>






<div class="col-12 col-md-12 mt-2">
<div class="row pt-3">
<div class="col-12 col-md-6">

<div class="form-group">
<label class="form-label" for="default-01">
From date
<input-error :error="errors.from"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter date" v-model="form.from">
</div>
</div>
</div>
<div class="col-12 col-md-6">
<div class="form-group">
<label class="form-label" for="default-01">
To date
<input-error :error="errors.to"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter date" v-model="form.to">
</div>
</div>
</div>
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
organisation:null,
position:null,
from:null,
to:null,

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

this.form.post(route('store.pssp_experience'),{
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
