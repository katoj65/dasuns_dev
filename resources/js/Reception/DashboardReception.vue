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
</div>





<div class="row g-gs">

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
<th scope="col" colspan="2" class="border-0">Names of Service Provider</th>
<th scope="col" class="border-0">Service Number</th>
<th scope="col" colspan="2" class="border-0">Application Date</th>
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
<div>{{ item.firstname }} {{ item.lastname }}</div>
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


<el-card class="card card-full" shadow="never" style="padding:0;">
<div slot="header" class="clearfix">
<strong>Interviews </strong>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div style="margin:-20px">
<table class="table table-borderless m-0 p-0">
<thead>
<tr>
<th scope="col" class="border-0" colspan="3">Interview Date and Time</th>
</tr>
</thead>
<tbody v-if="interview.length>0">
<tr v-for="i in interview" :key="i.id">
<td style="width:50px;">
<div class="user-avatar  bg-light user-avatar xs">
<em class="icon ni ni-calender-date"></em>
</div>
</td>
<td>
<div>
{{ i.date.split('-').reverse().join('/') }} - {{ i.time.substring(0,5) }}</div>
<div class="text-success">
Service Number: <strong>{{ i.number }}</strong>
</div>
</td>

</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="2" class="text-muted">No interview</td>
</tr>
</tbody>
</table>













</div>
</el-card>
</div>
</div>



<div class="row g-gs">




<div class="col-md-4 col-xxl-4">
<el-card class="card card-full" shadow="never">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h6 class="title">
<em class="icon ni ni-wallet-fill" style="font-size:30px;"></em>
Payments</h6>
<p>In last 30 days top invested schemes.</p>
</div>
<div class="card-tools mt-n4 mr-n1">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>15 Days</span></a></li>
<li><a href="#" class="active"><span>30 Days</span></a></li>
<li><a href="#"><span>3 Months</span></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="progress-list gy-3">
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Strater Plan</div>
<div class="progress-amount">58%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar" data-progress="58" style="width: 58%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Silver Plan</div>
<div class="progress-amount">18.49%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-orange" data-progress="18.49" style="width: 18.49%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Dimond Plan</div>
<div class="progress-amount">16%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-teal" data-progress="16" style="width: 16%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Platinam Plan</div>
<div class="progress-amount">29%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-pink" data-progress="29" style="width: 29%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Vibranium Plan</div>
<div class="progress-amount">33%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-azure" data-progress="33" style="width: 33%;"></div>
</div>
</div>
</div>
<div class="invest-top-ck mt-auto">
<canvas class="iv-plan-purchase" id="planPurchase"></canvas>
</div>
</div>
</el-card>
</div><!-- .col -->
















<div class="col-md-4 col-xxl-4">
<el-card class="card card-full" shadow="never">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h6 class="title">Top Invested Plan</h6>
<p>In last 30 days top invested schemes.</p>
</div>
<div class="card-tools mt-n4 mr-n1">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>15 Days</span></a></li>
<li><a href="#" class="active"><span>30 Days</span></a></li>
<li><a href="#"><span>3 Months</span></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="progress-list gy-3">
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Strater Plan</div>
<div class="progress-amount">58%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar" data-progress="58" style="width: 58%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Silver Plan</div>
<div class="progress-amount">18.49%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-orange" data-progress="18.49" style="width: 18.49%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Dimond Plan</div>
<div class="progress-amount">16%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-teal" data-progress="16" style="width: 16%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Platinam Plan</div>
<div class="progress-amount">29%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-pink" data-progress="29" style="width: 29%;"></div>
</div>
</div>
<div class="progress-wrap">
<div class="progress-text">
<div class="progress-label">Vibranium Plan</div>
<div class="progress-amount">33%</div>
</div>
<div class="progress progress-md">
<div class="progress-bar bg-azure" data-progress="33" style="width: 33%;"></div>
</div>
</div>
</div>
<div class="invest-top-ck mt-auto">
<canvas class="iv-plan-purchase" id="planPurchase"></canvas>
</div>
</div>
</el-card>
</div><!-- .col -->



















<div class="col-md-4 col-xxl-4">
<el-card class="card card-full" shadow="never">

</el-card>
</div><!-- .col -->














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
<style scoped>
table thead th{
border:none;
}
</style>
