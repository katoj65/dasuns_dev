<template>
<div>

<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit" v-if="show==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title">
Request for professional support services
</h6>
<a href="#" class="close" @click="show=false">
</a>
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
<option v-for="s in services" :key="s.id" :value="s.id">
{{ s.name }}
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

<!-- <div class="col-sm-12">
<div class="form-group">
<label class="form-label" for="default-01">Country

<input-error :error="errors.country" class="ml-1"/>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter service provision location" v-model="form.country"/>
</div>
</div>
</div> -->
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button type="submit" class="btn btn-success button" style="font-size:15px;">Submit</button>
</span>
</div>
</div>
</div>
</form>



<button style="border-radius:0 10px 10px 0;background:#f8f9fa;padding:16px;outline:none;" @click="show=true" type="button">
<em class="icon ni ni-opt-dot-alt  mr-1" style="font-size:20px;"></em>
</button>


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

show:false,






}},





methods:{

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
return this.$page.props.data.services;
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
