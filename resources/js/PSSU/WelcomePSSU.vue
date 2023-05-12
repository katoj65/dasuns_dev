<template>
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
</div>






<div class="col-md-8 col-xxl-4">
<div class="card card-full">
<div class="card-inner">
<div class="card-title-group mb-1">
<div class="card-title">
<h3 class="title" style="font-size:18px;">Appointments</h3>
</div>
</div>



<div class="card-inner p-0 mt-3">
<table class="table table-tranx">


<thead>

<tr>
<!-- <th class="tb-tnx-id"><span class="">#</span></th> -->
<th class="tb-tnx-info">
<span class="tb-tnx-desc d-none d-sm-inline-block">
<span>Service requested</span>
</span>
<span class="tb-tnx-date d-md-inline-block d-none">
<span class="d-md-none">Date</span>
<span class="d-none d-md-block">
<span>Date</span>
<span>Time</span>
</span>
</span>
</th>
<th class="tb-tnx-amount is-alt">
<span class="tb-tnx-total">Amount</span>
<span class="tb-tnx-status d-none d-md-inline-block">Status</span>
</th>
<th class="tb-tnx-action">
<span>&nbsp;</span>
</th>
</tr><!-- tb-tnx-item -->

</thead>



<tbody>
<tr class="tb-tnx-item" v-for="n in 20" :key="n">
<!-- <td class="tb-tnx-id">
<a href="#"><span>4947</span></a>
</td> -->
<td class="tb-tnx-info">
<div class="tb-tnx-desc">
<span class="title">Enterprize Year Subscrition</span>
</div>
<div class="tb-tnx-date">
<span class="date">10-05-2019</span>
<span class="date">10-13-2019</span>
</div>
</td>
<td class="tb-tnx-amount is-alt">
<div class="tb-tnx-total">
<span class="amount">$599.00</span>
</div>
<div class="tb-tnx-status">
<span class="badge badge-dot badge-warning">Due</span>
</div>
</td>
<td class="tb-tnx-action">
<div class="dropdown">
<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
<ul class="link-list-plain">
<li><a href="#">View</a></li>
<li><a href="#">Edit</a></li>
<li><a href="#">Remove</a></li>
</ul>
</div>
</div>
</td>
</tr><!-- tb-tnx-item -->

</tbody>
</table>
</div>




</div>
</div>
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
<h6 class="title">
<div class="row">
<div class="col-lg-3">
<span class="user-avatar sq bg-warning-dim"><span><em class="icon ni ni-wallet-fill"></em></span></span>
</div>
<div class="col-lg-9 pt-2 size12"> Wallet</div>
</div>
</h6>



<p>In last 30 days top invested schemes.</p>
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












</div>
</div>
</template>
<script>
export default {
props:{
response:{},
title:{},
},
data(){return{
content:this.response.user_data.dashboard,




}},


computed:{
tabs(){
return [
{icon:'icon ni ni-calender-date-fill',title:'APPOINTMENTS',count:this.response.user_data.dashboard.count_appointments,id:2},
{icon:'icon ni ni-grid-fill',title:'SERVICE PROVIDERS',count:this.response.user_data.dashboard.service_provider_count,id:1},
{icon:'icon ni ni-bar-chart-fill',title:'RECOMMENDATIONS',count:40,id:3},
{icon:'icon ni ni-wallet-fill',title:'WALLET',count:this.response.user_data.dashboard.account_balance,id:4},

];

},


appointments(){
return this.response.user_data.dashboard.appointments;
}






}








}
</script>

