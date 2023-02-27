<template>
<app-layout>
<div class="card card-full h-100">
<div class="card-header" style="background:white;">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">
<span class="mr-1">
Employees
</span>
</h6>
</div>
<div class="card-tools">
<ul class="card-tools-nav">
<li>

<el-dropdown trigger="click">
<span class="el-dropdown-link btn-success btn mt-2">
<span style="font-weight:bold;"> New</span>
<em class="icon ni ni-user-add-fill" style="font-size:20px;"></em>
</span>
<el-dropdown-menu slot="dropdown" style="margin-top:-1px;">
<el-dropdown-item>
<a href="#" @click="open=true" style="padding:10px;width:100%;"> Add system Administrator</a>
</el-dropdown-item>

</el-dropdown-menu>
</el-dropdown>








</li>
</ul>
</div>
</div>
</div><!-- .card-inner -->







<div class="card-body" style="min-height:700px;">

<div class="card card-bordered card-preview">
<table class="table table-tranx is-compact" v-if="employee.length>0">
<thead>
<tr class="tb-tnx-head">
<th class="tb-tnx-info">
Names
</th>
<th class="tb-tnx-info">
Gender
</th>
<th class="tb-tnx-info">
Date of Birth
</th>
<th class="tb-tnx-info">
Contact Information
</th>
<th class="tb-tnx-info">
Role
</th>
</tr>
</thead>



<tbody>
<tr class="tb-tnx-item"  v-for="e in employee" :key="e.id">
<td class="tb-tnx-info text-transform">
<Inertia-link :href="route('employee.show',[e.id])">
 {{ e.firstname }}  {{ e.lastname }}
</Inertia-link>
</td>
<td class="tb-tnx-info text-transform">
{{ e.gender }}
</td>
<td class="tb-tnx-info text-transform">
{{ e.dob.split('-').reverse().join('/')}}
</td>
<td class="tb-tnx-info">
<em class="icon ni ni-call-fill"></em> {{ e.tel }} <span class="pl-2"> <em class="icon ni ni-mail-fill"></em> {{ e.email }}</span>
</td>
<td class="tb-tnx-info text-transform">
{{ e.role }}
</td>
</tr>
</tbody>
</table>
<div v-else>No content</div>
</div>

</div>







<div class="card-inner-sm border-top text-center d-sm-none">
<a href="#" class="btn btn-link btn-block">See History</a>
</div><!-- .card-inner -->
</div>














<!---Model--->

<form class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="search_email">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Search for email address</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="open=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">
<div class="col-12 col-md-12">
<p class="p-2">
<input-error :error="errors.email"></input-error>
</p>
<div class="col-md-12 col-12">
<div class="form-group">
<div class="form-control-wrap">
<div class="form-icon form-icon-left">
<em class="icon ni ni-mail"></em>
</div>
<input type="text" class="form-control" id="default-03" placeholder="Enter email address.." v-model="search.email">
</div>
</div>
</div>
<p class="p-2 text-danger" v-if="flash.error!=null">
{{ flash.error }}
</p>
</div>
</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<button type="submit" class="button" style="border-radius:10px">
<em class="icon ni ni-search"></em>
</button>


</span>
</div>
</div>
</div>
</form>





































</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';
export default {
components: {
InputError,
AppLayout,
},

props:{
response:{},
title:{},
errors:{},
flash:{}
},

data(){return{
user:this.$page.props.auth.user,
open:false,
search:{
email:null,
},

employee:this.response.employee




}},

methods:{
search_email(){
this.$inertia.post(this.route('employee.create'),{email:this.search.email},{
onSuccess:()=>{
// this.$inertia.get(this.route('search.email-results'));
}
});
},





//delete article
delete_article(id){
this.$inertia.post(this.route('delete.admin'),{id:id},{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title: 'Successful',
message:this.$page.props.flash.success,
type: 'success'
});
this.$inertia.get(this.route('employee'));
console.log(this.$page.props);
}
});







}





},

//mouted
// mounted(){
// console.log(this.$page.props);
// }











}
</script>
<style scoped>
.nk-tb-col{
text-transform: capitalize;
}
</style>
