<template>
<layout-un-auth>

<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">

<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">
    <h3 class="text-center mb-3" style="font-size:30px;">
        <span>Contact</span>
        <span style="color:#1ee0ac;">Dasuns</span>
        </h3>

<div>




<form @submit.prevent="submit">
<div class="card border-4 mt-5" style="border-radius:10px;">
<div class="card-header" style="background:#0B5345;color:white;">
<div class="card-head">
<h3 class="card-title" style="color:white;font-size:19px;text-align:center;width:100%;"> Contact Form</h3>
</div>
</div>
<div class="card-inner">
<div class="row g-4">


<div class="col-12 col-md-12">
    <div class="alert alert-warning alert-icon border-0" v-if="flash.success!=null" style="color:black;">
        <em class="icon ni ni-check-circle"></em> <strong style="color:black;">Thank you for contacting Dasuns</strong>.  <span style="color:black;">{{ flash.success }}</span> </div>
</div>


<div class="col-lg-12">
<div class="form-group">
<label class="form-label" for="full-name-1">Full Name

<input-error :error="errors.names"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="full-name-1" placeholder="Enter fullnames" v-model="form.names">
</div>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-label" for="email-address-1">Email
    <input-error :error="errors.email"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="email-address-1" placeholder="Enter email address" v-model="form.email">
</div>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-label" for="phone-no-1">Phone No
    <input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="phone-no-1" placeholder="Enter telephone number" v-model="form.tel">
</div>
</div>
</div>



<div class="col-lg-12">
    <div class="form-group">
    <label class="form-label" for="pay-amount-1">Message
        <input-error :error="errors.message"></input-error>
    </label>
    <div class="form-control-wrap">
    <textarea class="form-control" id="pay-amount-1" placeholder="Enter message" v-model="form.message">
    </textarea>
    </div>
    </div>
    </div>





<div class="col-12">
<div class="form-group">
<button type="submit" class="btn button" style="border-radius:10px;font-size:18px;">Send</button>
</div>
</div>
</div>

</div>
</div>

</form>





</div>

</div>
<div class="col-12 col-md-3"></div>
</div>
</div>
</div>
</div>
</div>
</layout-un-auth>
</template>
<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth.vue';
import InputError from '@/Alerts/InputError.vue';
export default {
components:{
LayoutUnAuth,
InputError,
},
props:{
title:{},
response:{},
errors:{},
flash:{}
},
data(){return{
form:this.$inertia.form({
email:'',
tel:'',
message:'',
names:'',
})




}},


methods:{
submit(){
this.form.post(this.route('store-contact'),{
onSuccess:()=>{
this.form.reset();
}
});
}




}





}
</script>
