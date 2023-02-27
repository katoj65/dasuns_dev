<template>
<div>
<finance-account-approval v-if="admin_profile.length==0" :response="response"></finance-account-approval>
<div class="nk-content p-0" v-else>
<div class="container-fluid pt-0">
<div class="nk-content-inner pt-0">
<div class="nk-content-body pt-0">
<div class="nk-block pt-0">
<div class="row g-gs">
<div class="col-md-3" v-for="t in tabs" :key="t.id">
<div class="card  card-full">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">
<em :class="t.icon" style="font-size:50px;color:#07372F;"></em>
</h6>
</div>
<!-- <div class="card-tools">
<em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="" data-original-title="Total Deposited" aria-describedby="tooltip481665"></em>
</div> -->
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
</div><!-- .card -->
</div><!-- .col -->


















<div class="col-md-8 col-xxl-4">
<div class="card card-full">
<div class="card-inner">
<div class="card-title-group mb-1">
<div class="card-title">
<h6 class="title">Investment Overview</h6>
<p>The investment overview of your platform. <a href="#">All Investment</a></p>
</div>
</div>
<div style="min-height:400px;">




</div>

</div>
</div>
</div><!-- .col -->
























<div class="col-md-4 col-xxl-4">
<div class="card card-full">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-4">
<div class="card-title">
<h6 class="title">Registered Positions </h6>
<!-- <p>In last 30 days top invested schemes.</p> -->
</div>
</div>










</div>
</div>
</div><!-- .col -->





























<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
</div><!-- .col -->
















<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
</div><!-- .col -->



















<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
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
import FinanceAccountApproval from '@/Finance/FinanceAccountApproval';
export default {
components:{
FinanceAccountApproval,
},
props:{
response:{},
},
data(){return{
tabs:[
{icon:'icon ni ni-user-list-fill',title:'APPLICANTIONS',count:1,id:2},
{icon:'icon ni ni-users-fill',title:'ACTIVE SERVICE PROVIDERS',count:0,id:1},
{icon:'icon ni ni-shield-check-fill',title:'ACTIVE USERS',count:0,id:3},
{icon:'icon ni ni-swap-alt-fill',title:'REGISTERED SERVICES',count:0,id:4},
],
admin_profile:this.$page.props.auth.admin_profile



}},


}
</script>
