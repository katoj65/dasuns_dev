<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6" v-if="appointment">


<div class="card" v-for="(a,key) in appointment" :key="key">
<div class="card-header">
<h3 class="card-title text-transform bold">Appointment Details</h3>
</div>

<div class="card-body" style="border:none;">

<ul class="data-list is-compact">


    <li class="data-item">
        <div class="data-col">
        <div class="data-label">Service Requested</div>
        <div class="data-value text-transform">
        {{ a.service }}
        </div>
        </div>
        </li>


    <li class="data-item">
        <div class="data-col">
        <div class="data-label">Date</div>
        <div class="data-value text-transform">{{ a.date.split('-').reverse().join('/') }}

    <span class="ml-3">-</span>
            <span class="ml-3">
            {{ a.end_date!=null?a.end_date.split('-').reverse().join('/'):'' }}</span> </div>
        </div>
        </li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Time</div>
<div class="data-value text-transform">{{ a.from.substring(0,5) }}<span class="mr-3"></span> - <span class="ml-3">  {{a.to.substring(0,5)}} </span></div>
</div>
</li>




<li class="data-item">
<div class="data-col">
<div class="data-label">Service Provider</div>
<div class="data-value text-transform">{{ a.firstname +' '+ a.lastname}}</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Service Number</div>
<div class="data-value">{{ a.number }}</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number</div>
<div class="data-value text-soft">{{ a.tel }}</div>
</div>
</li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Email Address</div>
            <div class="data-value">{{ a.email }}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Location</div>
            <div class="data-value text-transform">{{ a.location }} </div>
        </div>
    </li>

    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Payment</div>
            <div class="data-value text-transform">{{ a.payment }} </div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Status</div>
            <div class="data-value text-transform">
                <!-- <button type="button" class="btn btn-primary text-transform" @click="show=true">{{ a.status }} </button> -->
                {{ a.status }}
            </div>
        </div>
    </li>


</ul>







</div>
<div class="card-footer header_bg text-white" v-if="a.success!='completed'">
Service has been provided successfully
</div>

<div class="card-footer" v-else>
<div class="float-right">
    <button class="btn button-danger" style="font-size:16px;" @click="submit()" v-if="a.status=='cancelled'" disabled>Cancel</button>
<button class="btn button-danger" style="font-size:16px;" @click="submit()" v-else>Cancel</button>
</div>
</div>




</div>







</div>
<div class="col-12 col-md-3"></div>
</div>
</div>


















<form @submit.prevent="submit" class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Action</h5>
<a href="#" class="close" data-dismiss="modal" @click="show=false" aria-label="Close">
</a>
</div>
<div class="modal-body" style="padding:30px;">

<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.option"/>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change='select_option($event)'>
<option value="">--Select Action--</option>
<option v-for="(o,key) in option" :key="key" :value="o.name">{{o.name}} </option>
</select>
</div>
</div>


</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button type="submit" class="submit_button">Save</button>
</span>
</div>
</div>
</div>
</form>









</app-layout>
</template>
<script>

import AppLayout from '../Layouts/AppLayout.vue';
import InputError from '../Alerts/InputError.vue';
export default {
components:{
AppLayout,
InputError,


},
//
props:{
title:{},
response:{},
errors:{},
},
//
computed:{
appointment(){
return this.response.appointment;
}
},

//
data(){return{
show:false,
option:[{name:'Accepted'},{name:'Completed'},{name:'Pending'},{name:'Declined'},{name:'Cancelled'}],
//
form:this.$inertia.form({
option:'',
id:'',
}),

}},

methods:{
select_option(event){
this.form.option=event.target.value;
},

submit(){
this.response.appointment.forEach(element=>{
this.form.id=element.id;
this.form.option='cancelled';
});

this.form.post(this.route('appoinment.update_status'),{
onSuccess:()=>{
this.show=false;
this.$notify({
position: 'bottom-right',
title: 'Successful',
message:this.$page.props.flash.success,
type:'success'
});

}
});



}





}




}
</script>
<style scoped>
small {
font-size:15px;
}
p{
font-weight: bold;

}
.data-item{
border:none;
}
</style>
