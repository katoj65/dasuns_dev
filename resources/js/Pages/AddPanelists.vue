<template>
<app-layout>
<div class="nk-block">
<div class="row p-3" v-if="response!=null">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">


<div class="card">
<div class="card-status bg-green"></div>
<div class="card-header">
<h3 class="card-title bold">Interview</h3>
<div class="card-options">
<!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
</div>
</div>
<div class="card-body">

<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Interview Date</div>
<div class="data-value">{{ response.interview.date.split('-').reverse().join('/') }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Time</div>
<div class="data-value">
{{ response.interview.time.substring(0,5) }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Type</div>
<div class="data-value text-transform">
{{ response.interview.type }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Comment</div>
<div class="data-value text-soft text-transform">
{{ response.interview.comment }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Service Provider</div>
<div class="data-value">
{{ response.interview.firstname }} {{ response.interview.lastname }}
</div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Service No.</div>
<div class="data-value">{{ response.interview.number }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Created on</div>
<div class="data-value">
{{ response.interview.created_at.substring(0,10).split('-').reverse().join('/') }}
</div>
</div>
</li>
</ul>


</div>


<div class="card-body border-0">
<h5 class="mb-2">Panelists</h5>
<ul class="right_chat list-unstyled" v-if="response.panelists.length>0">
<li class="online" v-for="(p,key) in response.panelists" :key="key">
<a href="javascript:void(0);">
<div class="media">
<em class="icon ni ni-user-circle-fill mr-2" style="font-size:30px;"></em>
<div class="media-body">
<span class="name bold text-transform">
{{ p.firstname }} {{ p.lastname }}
</span>
<span class="message">Panelist</span>
<!-- <span class="badge badge-outline status"></span> -->
</div>
</div>
</a>
</li>
</ul>
<div v-else>
No panelist added
</div>
</div>








<div class="card-body border-0">
<div>
<h5>Add Panelist</h5>
</div>
<div>

<form class="mt-4" @submit.prevent="submit">

<div class="form-group">
<label class="form-label" for="default-01">
    <input-error :error="errors.pid"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" placeholder="Enter names" @change="set_provider($event)">
<option value="">--Select---</option>
<option v-for="(p,key) in response.panelist_list" :key="key" :value="p.id" class="text-transform">
{{ p.firstname }} {{ p.lastname }}
</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
</label>
<div class="form-control-wrap">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</div>
</div>



</form>

</div>
</div>


</div>















</div>
<div class="col-12 col-md-3"></div>

</div>
<div v-else class="row p-3 ">
<div class="col-12 text-center">
<h4>
No results
</h4>
</div>
</div>
</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Alerts/InputError';
export default {
components:{
AppLayout,
InputError,

},

props:{
title:{},
response:{},
errors:{}
},


data(){return{
form:this.$inertia.form({
pid:null,
id:null,

}),

}},

methods:{
set_provider(event){
this.form.pid=event.target.value;
this.form.id=this.response.interview.id;
},

submit(){
this.form.post(this.route('interview.add_panelists'),{
onSuccess:()=>{
const flash=this.$page.props.flash;
this.show=false;
this.$notify({
title:flash.success!=null?'Successful':'Warning',
message:flash.success!=null?flash.success:flash.warning,
type:flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});


},
},











}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}
.data-item{
border:none;
}


</style>
