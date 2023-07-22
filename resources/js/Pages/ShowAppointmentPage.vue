<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8" v-if="appointment">


<div class="card" v-for="(a,key) in appointment" :key="key">
<div class="card-header">
<h3 class="card-title text-transform">Appointment Details</h3>
</div>

<div class="card-body" style="border:none;">

<ul class="list-group" style="border:none;">
<li class="list-group-item">
<small class="text-muted">Appointment Date: </small>
<p class="mb-0 pt-2">{{ a.date.split('-').reverse().join('/') }} <span>{{ a.end_date!=null?a.end_date:'' }} </span> </p>
</li>
<li class="list-group-item">
<small class="text-muted">Service Requested: </small>
<div class="mb-0 pt-2" v-if="a.service.length==1">
<p v-for="(s,key) in a.service" :key="key">
{{ s.name }}
</p>
</div>
</li>
<li class="list-group-item">
<small class="text-muted">Service Provider: </small>
<p class="mb-0 pt-2">
{{ a.firstname +' '+ a.lastname}}
</p>
</li>
<li class="list-group-item">
<small class="text-muted">Service Number: </small>
<p class="mb-0 pt-2">{{ a.number }} </p>
</li>

<li class="list-group-item">
<small class="text-muted">Telephone Number: </small>
<p class="mb-0 pt-2">{{ a.tel }} </p>
</li>

<li class="list-group-item">
<small class="text-muted">Email Address: </small>
<p class="mb-0 pt-2">{{ a.email }} </p>
</li>


</ul>

</div>


<div class="card-footer border-0">
<div class="text-right">
<button type="button" class="btn btn-primary text-transform" @click="show=true">{{ a.status }} </button>
</div>
</div>
</div>







</div>
<div class="col-12 col-md-2"></div>
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
</style>
