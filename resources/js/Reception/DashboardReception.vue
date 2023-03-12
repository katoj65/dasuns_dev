<template>
<div>
<account-approval v-if="status==='pending'" :response="response"></account-approval>
<div class="nk-content p-0" v-else-if="status==='active'">
<div class="container-fluid pt-0">
<div class="nk-content-inner pt-0">
<div class="nk-content-body pt-0">
<div class="nk-block pt-0">
<div class="row g-gs">
<div class="col-md-3" v-for="t in tabs" :key="t.id">



<el-card class="card  card-full" shadow="never">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">
<em :class="t.icon" style="font-size:50px;color:#07372F;"></em>
</h6>
</div>
</div>

<div class="card-amount mb-2 mt-3">
<span class="amount"><span class="currency currency-usd" style="color:#07372F;">{{ t.count }} </span>
</span>
</div>

<div class="invest-data mt-3">
<div class="invest-data-amount g-2">
<div class="invest-data-history">
<!-- <div class="title">This Month</div> -->
<div class="amount"> <span class="currency currency-usd" style="font-size:15px;color:#07372F;">
<strong>{{ t.title }} </strong>
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


<!-- {{ response.user_data.count_interviews }} -->


<el-card class="card card-full" shadow="never">
<div class="card-inner border-0">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">
Service Provider Applications

</h6>
</div>
<div class="card-tools">
<span class="badge badge-outline-success">
{{ response.user_data.count_pending_applications }}
</span>
</div>
</div>
</div>




<div v-if="dashboard.applicant.length>0">
<div class="nk-tb-list">
<div class="nk-tb-item nk-tb-head">
<div class="nk-tb-col" style="border:none;"><span style="font-weight:bold;">Dasuns Number</span></div>
<div class="nk-tb-col tb-col-sm" style="border:none;"><span style="font-weight:bold;">Number of Services</span></div>
<div class="nk-tb-col tb-col-lg" style="border:none;"><span style="font-weight:bold;">Application Date</span></div>
<div class="nk-tb-col" style="border:none;"><span>&nbsp;</span></div>
</div>


<div class="nk-tb-item" v-for="show_applicant in dashboard.applicant" :key="show_applicant.id">
<div class="nk-tb-col" style="border:none;">
<div class="align-center">
<div class="user-avatar user-avatar-sm bg-success-dim">
<span>
<em class="icon ni ni-user-list-fill"></em>
</span>
</div>
<span class="tb-sub ml-2" style="border:none;">
{{ show_applicant.number }}
</span>
</div>
</div>
<div class="nk-tb-col tb-col-sm" style="border:none;">
I apply to provide {{ show_applicant.services }} {{ show_applicant.services>1?' services':' service' }}
</div>
<div class="nk-tb-col tb-col-lg" style="border:none;">
<span class="tb-sub">
{{ show_applicant.date }}
</span>
</div>
<div class="nk-tb-col nk-tb-col-action" style="border:none;">
<Inertia-link :href="route('application_preview',[show_applicant.id])" class="btn btn-outline-success"> Review </Inertia-link>
</div>
</div>



</div>
</div>
<div v-else>
<p class="p-5 text-muted">No application has been received</p>
</div>

<div style="text-align:center;" v-if="dashboard.applicant.length<response.user_data.count_pending_applications" class="p-2">

<Inertia-link class="text-success">
View all applications
</Inertia-link>

</div>



</el-card>











</div><!-- .col -->
























<div class="col-md-4 col-xxl-4">
<el-card class="card card-full" shadow="never">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-4">
<div class="card-title">
<h6 class="title">Interviews </h6>
<!-- <p>In last 30 days top invested schemes.</p> -->
</div>
<div class="card-tools">
<span class="badge badge-outline-success">
{{ response.user_data.count_interviews }}
</span>
</div>
</div>





<table v-if="interviews.length>0" style="padding:0;margin:0;">
<thead>
<tr>
<th class="text-muted" colspan="2">Date</th>
<th class="text-muted"></th>
<th class="text-muted">Applicant</th>
</tr>
<tr>
<th colspan="3" class="p-1"></th>
</tr>
</thead>
<tbody style="padding:0;margin:0;">
<tr v-for="i in interviews" :key="i.id" style="cursor:pointer;" @click="navigate(i.id)">
<td style="border:none;padding-bottom:10px;">
<div class="user-avatar user-avatar-sm bg-warning-dim sq">
<em class="icon ni ni-calender-date text-warning"></em>
</div>
</td>
<td>
{{ reverse_word(i.date.substring(0,10))}} </td>
<td style="border:none;padding-bottom:10px;">{{ i.time.substring(0,5) }} </td>
<td style="border:none;padding-bottom:10px;">{{ i.number }} </td>
</tr>

</tbody>
</table>
<div v-else>
No content
</div>








</div>
</el-card>
</div><!-- .col -->





























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
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h6 class="title">Declined Applications</h6>
<p>{{ declined.length>1?declined.length+' Applications have been declined.':declined.length+' Application has been declined.' }} </p>
</div>
</div>
<div>
<table class="table table-sm" style="width:100%;">
<tbody style="padding:0;">
<tr v-for="d in declined" :key="d.id">
<td style="width:20px;padding:0;padding-bottom:10px;" class="border-0">
<Inertia-link :href="route('application_preview',[d.id])">
<div class="user-avatar user-avatar-sm bg-danger-dim sq">
<em class="icon ni ni-user-alt-fill text-danger"></em>
</div>
</Inertia-link>
</td>
<td scope="row" style="padding:5px;" class="border-0">
<Inertia-link :href="route('application_preview',[d.id])">
{{ d.number }}
</Inertia-link>
</td>
<td style="padding:5px;width:100px;" class="border-0">
{{reverse_word(d.created_at.substring(0,10)) }}
</td>
</tr>
</tbody>
</table>

</div>
<div class="invest-top-ck mt-auto">

</div>
</div>
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
import date_format from '@/Methods/date_format';
export default {
components:{
AccountApproval,

},
props:{
response:{},
},


data(){return{
// dt: new date_format(100),

//

tabs:[

{icon:'icon ni ni-user-list-fill',title:'APPLICANTIONS',count:this.response.user_data.count_pending_applications,id:2},
{icon:'icon ni ni-users-fill',title:'ACTIVE SERVICE PROVIDERS',count:this.response.user_data.count_active_pssp,id:1},
{icon:'icon ni ni-shield-check-fill',title:'ACTIVE USERS',count:this.response.user_data.count_active_users,id:3},
{icon:'icon ni ni-swap-alt-fill',title:'REGISTERED SERVICES',count:this.response.user_data.count_services,id:4},

],

//

admin_profile:this.$page.props.auth.admin_profile,

//dashboard

dashboard:{
applicant:this.response.user_data.applicants,
},

//

interviews:this.response.user_data.interviews,
declined:this.response.user_data.declined_application,


}},



methods:{
//
navigate(id){
this.$inertia.get(this.route('interview',[id]));
},

return_date(item){
var d=new date_format(item)
return d.d+' - '+d.m+' - '+d.y+' - '+d.h+':'+d.mi;
},

reverse_word(item){
var s=item.split('-').reverse().join('/');
return s;
}



//
},

//computed
computed:{
status(){
return this.$page.props.auth.user.status;
}






}
















}
</script>
