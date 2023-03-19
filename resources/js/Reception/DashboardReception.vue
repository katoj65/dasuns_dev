<template>
<div>
<account-approval v-if="status==='pending'" :response="response"></account-approval>
<div class="nk-content p-0" v-else-if="status==='active'">
<div class="container-fluid pt-0">
<div class="nk-content-inner pt-0">
<div class="nk-content-body pt-0">
<div class="nk-block pt-0">
<div class="row g-gs">






<div class="col-md-3" v-for="m in menu" :key="m.id">
<el-card class="card  card-full" shadow="never">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">
<em :class="m.icon" style="font-size:50px;color:#07372F;"></em>
</h6>
</div>
</div>

<div class="card-amount mb-2 mt-3">
<span class="amount">
<span class="currency currency-usd" style="color:#07372F;">{{ m.count }} </span>
</span>
</div>

<div class="invest-data mt-3">
<div class="invest-data-amount g-2">
<div class="invest-data-history">
<!-- <div class="title">This Month</div> -->
<div class="amount"> <span class="currency currency-usd" style="font-size:15px;color:#07372F;">
<strong>{{ m.title }} </strong>
</span></div>
</div>
<!-- <div class="invest-data-history">
<div class="title">This Week</div>
<div class="amount">1,259.28 <span class="currency currency-usd">USD</span></div>
</div> -->
</div>

</div>
</div>
</el-card><!-- .card -->
</div><!-- .col -->









<div class="col-md-8 col-xxl-4">
<el-card class="card card-full p-0" shadow="never">
<div class="card-inner border-0 p-0">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">
Service Provider Applications

</h6>
</div>
<div class="card-tools">
<span class="badge badge-outline-success">
</span>
</div>
</div>
</div>

<div class="pt-2">
{{ applicant }}
<table class="table table-borderless">
<thead>
<tr>
<th scope="col" colspan="2">Name</th>
<th scope="col">Service Number</th>
<th scope="col" colspan="2">Application Date</th>
</tr>
</thead>
<tbody v-if="applicants.length>0">
<tr  v-for="item in applicants" :key="item.id">
<td><div class="user-avatar user-avatar-sm bg-success-dim">
<span>
<em class="icon ni ni-user-list-fill"></em>
</span>
</div></td>
<td class="text-transform">
<div class="bold">{{ item.firstname }} {{ item.lastname }}</div>
<div class="text-success" style="font-size:14px;">
{{ item.count_services>1?item.count_services+' Profession Services':item.count_services+' Profession Service' }}
</div>
</td>
<td>
{{ item.number }}
</td>
<td>
{{ item.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td>
<Inertia-link :href="route('application_preview',[item.id])" class="btn btn-outline-success"> Review </Inertia-link>
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="3" class="text-muted">
No applications
</td>
</tr>
</tbody>
</table>
</div>
</el-card>
</div>










<div class="col-md-4 col-xxl-4">
<el-card class="card card-full" shadow="never">
<div slot="header" class="clearfix">
<strong>Interview </strong>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div class="card-body">


















</div>
</el-card>
</div>
























</div>
</div>
</div>
</div>
</div>
</div>
</div>
</template>
<script>

import AccountApproval from '@/Reception/AccountApproval';
export default {
components:{
AccountApproval,

},
props:{
response:{},
},

computed:{


//menu
menu(){
const menu = [
{icon:'icon ni ni-user-list-fill',title:'APPLICANTIONS',count:this.response.user_data.application_pending,id:2},
{icon:'icon ni ni-users-fill',title:'ACTIVE SERVICE PROVIDERS',count:this.response.user_data.active_service_providers,id:1},
{icon:'icon ni ni-shield-check-fill',title:'ACTIVE USERS',count:this.response.user_data.active_users,id:3},
{icon:'icon ni ni-swap-alt-fill',title:'REGISTERED SERVICES',count:this.response.user_data.services,id:4},
];
return menu;
},


status(){
return this.$page.props.auth.user.status;
},

interview(){
return this.response.user_data.interviews;
},

applicants(){
return this.response.user_data.applicants;
}





}















}
</script>
