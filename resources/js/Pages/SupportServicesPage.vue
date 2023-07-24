<template>
<app-layout>
<div class="nk-content p-3">


<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Support Services </h3>
<div class="card-options" v-if="role=='admin'">
<div class="input-group">
<button class="btn btn-sm btn-default" type="submit" @click="show=true">Add</button>
</div>
</div>
</div>





<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>

<th colspan="2">PROFESSION SERVICE</th>
<!-- <th>LAST NAME</th>
<th>USERNAME</th> -->
</tr>
</thead>
<tbody v-if="service.length>0">
<tr v-for="(s,key) in service" :key="key">

<td>
<em class="icon ni ni-caret-right-fill"></em> {{ s.name }}
</td>
<td style="width:50px;" v-if="role=='admin'">
<a href="#"  style="padding:0;margin:0;" class="text-muted" @click="submit2(s.id)">
<em class="icon ni ni-trash-empty-fill" style="font-size:16px;"></em>
</a>
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="5">No content</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>













<!-----Dialog-------->
<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Add Support Service</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false"></a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.name"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Service Name" v-model="form.name">
</div>
</div>






<div class="form-group">
<label class="form-label" for="default-textarea">
<input-error :error="errors.description"></input-error>
</label>
<div class="form-control-wrap">
<textarea class="form-control no-resize" id="default-textarea" v-model="form.description" placeholder="Enter service description">
</textarea>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="file" class="form-control" id="default-01">
</div>
</div>



</div>
<div class="modal-footer bg-light">
<span class="sub-text">


<input type="submit" class="button" value="Save" style="border-radius:10px;padding:10px;height:50px;"/>

</span>
</div>
</div>
</div>
</form>






</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError.vue';

export default {
components:{
AppLayout,
InputError


},
props:{
title:{},
response:{},
errors:{}
},
data(){return{
show:false,
form:this.$inertia.form({
name:'',
description:'',
file:'images/icons/international-sign.png',

}),

form1:this.$inertia.form({
id:null,
}),



}},


//computed method
computed:{
service(){
return this.response.service;
},
url(){
return this.$page.props.system.route ;
},

role(){
return this.$page.props.auth.user.role;
}



},

methods:{
submit2(id){
this.form1.id=id;
this.form1.post(this.route('services.destroy'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
position:'bottom-right',
type:'success'
});
}
});


},

submit(){
this.form.post(this.route('services.store'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
position:'bottom-right',
type:'success'
});
this.show=false;
this.form.reset();
}

});
}




}







}
</script>


<style scoped>
input{
padding:10px;
height:35px;
border-radius:30px;
}
button{
height:35px;
padding:10px;
}

.form-control{
height:50px;
border-radius: 5px;
}
</style>
