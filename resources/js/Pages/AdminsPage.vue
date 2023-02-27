<template>
<app-layout>
<div class="card card-full h-100">
<div class="card-inner">
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









<!-- <a href="#"  @click="open=true" class="btn button" style="border-radius:5px;color:white;padding-left:20px;padding-right:20px;"><span>
<em class="icon ni ni-user-add-fill"></em>
New Employee</span></a> -->







<el-dropdown trigger="click">
<span class="el-dropdown-link btn-success btn">
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









<div class="card card-bordered card-preview">
<table class="table table-tranx is-compact" v-if="employee.length>0">
<thead>
<tr class="tb-tnx-head">
<th class="tb-tnx-id"><span class="">#</span></th>
<th class="tb-tnx-info">
<span class="tb-tnx-desc d-none d-sm-inline-block">
<span>Bill For</span>
</span>
<span class="tb-tnx-date d-md-inline-block d-none">
<span class="d-md-none">Date</span>
<span class="d-none d-md-block">
<span>Issue Date</span>
<span>Due Date</span>
</span>
</span>
</th>
<th class="tb-tnx-amount">
<span class="tb-tnx-total">Total</span>
<span class="tb-tnx-status d-none d-md-inline-block">Status</span>
</th>
</tr></thead>
<tbody>
<tr class="tb-tnx-item"  v-for="e in employee" :key="e.id">
<td class="tb-tnx-id">
<a href="#"><span>4947</span></a>
</td>
<td class="tb-tnx-info">
<div class="tb-tnx-desc">
<span class="title">Enterprize Year Subscrition</span>
</div>
<div class="tb-tnx-date">
<span class="date">10-05-2019</span>
<span class="date">10-13-2019</span>
</div>
</td>
<td class="tb-tnx-amount">
<div class="tb-tnx-total">
<span class="amount">$599.00</span>
</div>
<div class="tb-tnx-status">
<span class="badge badge-dot badge-warning">Due</span>
</div>
</td>
</tr>
</tbody>
</table>
<div v-else>No content</div>
</div>









<div class="card-inner p-0 " v-if="employee.length>0" style="min-height:600px;">
<div class="nk-tb-list nk-tb-orders">
<div class="nk-tb-item nk-tb-head">
<div class="nk-tb-col nk-tb-orders-type"><span></span></div>
<div class="nk-tb-col"><span>Names</span></div>
<div class="nk-tb-col tb-col-sm"><span>Gender</span></div>
<div class="nk-tb-col tb-col-xl"><span>Telephone</span></div>
<div class="nk-tb-col tb-col-xxl"><span>Email Address</span></div>
<div class="nk-tb-col tb-col-sm text-right"><span>Address</span></div>
<div class="nk-tb-col text-right"><span>Business Role</span></div>
</div><!-- .nk-tb-item -->


<div class="nk-tb-item" v-for="e in employee" :key="e.id">
<div class="nk-tb-col nk-tb-orders-type">
<ul class="icon-overlap">
<li>
<em class="icon ni ni-user-alt-fill bg-btc-dim icon-circle"></em>
</li>
<!-- <li><em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em></li> -->
</ul>
</div>
<div class="nk-tb-col">
<span class="tb-lead">
<Inertia-link :href="route('employee.get',[e.userID])">
{{ e.firstname+' '+e.lastname }}
</Inertia-link> </span>
</div>
<div class="nk-tb-col tb-col-sm">
<span class="tb-sub">{{ e.gender }} </span>
</div>
<div class="nk-tb-col tb-col-xl">
<span class="tb-sub">
{{ e.tel }}
</span>
</div>
<div class="nk-tb-col tb-col-xxl">
<span class="tb-sub text-primary">
{{ e.address }}
</span>
</div>
<div class="nk-tb-col tb-col-sm text-right">
<span class="tb-sub ">{{ e.address }}<span></span></span>
</div>
<div class="nk-tb-col text-right">
<span class="tb-sub">
{{ e.role }}
 <span>






<!---Delete edit item-->


<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<!-- <el-dropdown-item>
<el-button type="clear" icon="el-icon-edit" style="border:none;"></el-button>
</el-dropdown-item> -->

<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_article(e.id)"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>







<!----Delete edit item------->


 </span></span>
</div>
</div><!-- .nk-tb-item -->


</div>
</div>
















<!-- .card-inner -->
<div class="card-inner border-top" v-else style="text-align:center;min-height:600px;">No content</div>




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
