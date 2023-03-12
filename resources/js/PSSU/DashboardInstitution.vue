<template>
<div class="nk-block pt-0">

<!-- {{ response.user_data.dashboard }} -->


<div class="row g-gs">
<div class="col-md-3" v-for="t in tabs" :key="t.id" shadow="never">
<el-card class="card  card-full" shadow="never">
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
</el-card><!-- .card -->
</div>






<div class="col-md-8 col-xxl-4">
<el-card class="card card-full" shadow="never">
<div class="card-inner">
<div class="card-title-group mb-1">
<div class="card-title">
    <h6 class="title">Appointments</h6>
    <p>The investment overview of your platform. <a href="#">All Investment</a></p>
</div>
</div>
<ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
<li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#overview">Overview</a>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#thisyear">This Year</a>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#alltime">All Time</a>
</li>
</ul>
<div class="tab-content mt-0">
<div class="tab-pane active" id="overview">
    <div class="invest-ov gy-2">
        <div class="subtitle">Currently Actived Investment</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Paid Profit</div>
            </div>
        </div>
    </div>
    <div class="invest-ov gy-2">
        <div class="subtitle">Investment in this Month</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane" id="thisyear">
    <div class="invest-ov gy-2">
        <div class="subtitle">Currently Actived Investment</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">89,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">96</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">99,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Paid Profit</div>
            </div>
        </div>
    </div>
    <div class="invest-ov gy-2">
        <div class="subtitle">Investment in this Month</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">83</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane" id="alltime">
    <div class="invest-ov gy-2">
        <div class="subtitle">Currently Actived Investment</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">556</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Paid Profit</div>
            </div>
        </div>
    </div>
    <div class="invest-ov gy-2">
        <div class="subtitle">Investment in this Month</div>
        <div class="invest-ov-details">
            <div class="invest-ov-info">
                <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                <div class="title">Amount</div>
            </div>
            <div class="invest-ov-stats">
                <div><span class="amount">223</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                <div class="title">Plans</div>
            </div>
        </div>
    </div>
</div>
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
},

//
data(){
return{


}},


//computed
computed:{
tabs(){
const items=[
{icon:'icon ni ni-calender-date-fill',title:'APPOINTMENTS',count:100,id:2},
{icon:'icon ni ni-grid-fill',title:'SERVICE PROVIDERS',count:1,id:1},
{icon:'icon ni ni-bar-chart-fill',title:'RECOMMENDATIONS',count:40,id:3},
{icon:'icon ni ni-wallet-fill',title:'WALLET',count:20,id:4},
];
return items;
},





}






}
</script>

