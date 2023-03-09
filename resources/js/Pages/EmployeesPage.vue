<template>
<app-layout>
<el-card class="card card-full h-100 mt-2" shadow="never">
<div slot="header" class="clearfix">
<span style="font-weight:bold;">Employees</span>

<el-dropdown trigger="click" style="float: right; padding: 3px 0;margin-top:-20px;">
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
</div>

<div class="card-body p-0" style="min-height:700px;">
<table class="table table-borderless">
<thead>
<tr>
<th scope="col">First name</th>
<th scope="col">Last name</th>
<th scope="col">Gender</th>
<th scope="col">Email</th>
<th scope="col">Role</th>
<th></th>

</tr>
</thead>
<tbody>
<tr  v-for="e in employee" :key="e.id">
<td><Inertia-link :href="route('employee.show',[e.id])">{{ e.firstname }}</Inertia-link> </td>
<td><Inertia-link :href="route('employee.show',[e.id])">{{ e.lastname }}</Inertia-link> </td>
<td>{{ e.gender }} </td>
<td class="text">{{ e.email }} </td>
<td>{{ e.role }} </td>
<td>
<Inertia-link :href="route('employee.show',[e.id])" class="btn btn-dim btn-success">View Profile</Inertia-link>
</td>
</tr>

</tbody>
</table>

</div>



</el-card>














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

table tbody td{
text-transform: capitalize;
}
.text{
   text-transform:lowercase;
}
</style>
