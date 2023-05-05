<template>
<div>




<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="current_route=='dashboard/create-appointment'" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">
Request for professional support services
</h5>
<Inertia-link :href="route('dashboard')" class="close">
<em class="icon ni ni-cross"></em>
</Inertia-link>
</div>
<div class="modal-body">





<div class="row gy-4">
<div class="col-sm-12">
<div class="form-group">
<label class="form-label" for="default-01">Select service

<input-error :error="errors.service" class="ml-1"/>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" placeholder="Input placeholder" @change="select_service($event)">
<option value="">Select</option>
<option v-for="s in services" :key="s.id" :value="s.value">
{{ s.text }}
</option>
</select>
</div>
</div>
</div>


<div class="col-sm-12">
<div class="form-group">
<label class="form-label" for="default-01">Location
<input-error :error="errors.location" class="ml-1"/>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter service provision location" v-model="form.location"/>
</div>
</div>
</div>





<div class="col-sm-12">
<div class="form-group">
<label class="form-label" for="default-01">Country

<input-error :error="errors.country" class="ml-1"/>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter service provision location" v-model="form.country"/>
</div>
</div>
</div>




















    </div>
















</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button type="submit" class="btn btn-success button" style="font-size:17px;">Request</button>
</span>
</div>
</div>
</div>
</form>







<div style="position:fixed;bottom:0;right:0;padding:20px;margin-bottom:50px;">
    <a href="#" class="btn btn-round btn-xl btn-success shadow" @click="navigate()">
        <em class="icon ni ni-edit mr-1" style="font-size:25px;color:white;"></em> Request</a>
<!-- <el-button circle style="width:70px;height:70px;background:#0B5345;" class="shadow" @click="navigate()">

</el-button> -->
</div>
</div>
</template>


<script>
import InputError from '../Alerts/InputError.vue';
export default {
components: {
InputError,
},
data(){return{
props:{
response:{},
},


form:this.$inertia.form({
service:'',
location:'',
country:'',

}),







}},





methods:{
//
navigate(){
this.$inertia.get(this.route('dashboard-create-appointment'));
},

//submit
submit(){
this.form.post(this.route('request-service'),{

});
},

//select
select_service(event){
this.form.service=event.target.value;
},

payload(){
const item=this.$page.props;
this.form.location=item.profile.location;
this.form.country=item.profile.country;
}





},

//computed
computed:{

//current route
current_route(){
return this.$page.props.system.current_route.uri;
},

//services
services(){
return this.$page.props.response.services;
},

//error
errors(){
return this.$page.props.errors;
},



//location
location(){
const item=this.$page.props;
return item.profile;
},






},
//mounted
mounted(){
this.payload();
}








}
</script>
