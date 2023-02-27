<template>
<div>
<button type="button" @click="show()" style="padding:0;margin:0;font-size:14px;padding-left:15px;padding-right:15px;">Add</button>


<form class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #37BEA7;border:none;">
                    <h5 class="modal-title" style="color:white;text-transform:none;">Add References</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show()">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" style="max-height:500px;overflow:auto">






<div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.names"></input-error>
    </label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter names" v-model="form.names">
    </div>
</div>




<div class="form-group">
    <label class="form-label" for="default-01">
      <input-error :error="errors.address"></input-error>
    </label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter physical address" v-model="form.address">
    </div>
</div>



<div class="form-group">
    <label class="form-label" for="default-01">
      <input-error :error="errors.tel"></input-error>
    </label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter telephone contact" v-model="form.tel">
    </div>
</div>



<div class="form-group">
    <label class="form-label" for="default-01">
      <input-error :error="errors.email"></input-error>
    </label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter email address" v-model="form.email">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">
      <input-error :error="errors.position"></input-error>
    </label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter position" v-model="form.position">
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
names:null,
email:null,
tel:null,
address:null,
position:null,
}),





}},
methods:{
show(){
if(this.open==false){
this.open=true;
}else{
this.open=false;
}
},

submit(){
this.form.post(this.route('profile.create_pssp_reference'),{
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
text-transform: none;
word-spacing: 0;

}
</style>
