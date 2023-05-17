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



<div class="card-inner p-0 mt-0">
<table class="table table-tranx">


<!-- <thead>

<tr>

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
</tr>

</thead> -->



<tbody>
<tr class="tb-tnx-item" v-for="a in appointments" :key="a">
<!-- <td class="tb-tnx-id">
<a href="#"><span>4947</span></a>
</td> -->
<td class="tb-tnx-info">
<div class="tb-tnx-desc">
<span class="title text-transform">
<!-- <em class="icon ni ni-forward-alt-fill"></em> -->
{{ a.name }} </span>
</div>
<div class="tb-tnx-desc text-muted">
<span class="date">{{ a.date.split('-').reverse().join('/') }} </span>
<span class="date ml-2">
<em class="icon ni ni-clock text-muted"></em>
{{ a.from.substring(0,5) }}</span>
<span class="date ml-2">{{ a.to.substring(0,5) }} </span>
</div>
</td>


<td class="tb-tnx-amount is-alt" style="width:100px;">
<div class="tb-tnx-status">
<span class="badge badge-dot badge-warning text-transform" v-if="a.status=='pending'">{{ a.status }} </span>
<span class="badge badge-dot badge-success text-transform" v-else-if="a.status=='accepted'">{{ a.status }} </span>
</div>
</td>


<td class="tb-tnx-action">
<div class="dropdown">
<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
<ul class="link-list-plain">
<li><a href="#" @click="show_appointment(a)">View</a></li>
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
<div class="card card-full">
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
</div>
</div>



<div class="card-body">




<div class="card-amount">
<span class="amount"> 2000000 <span class="currency currency-usd">UGX</span>
</span>
<!-- <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span> -->
</div>


<div class="invest-data">
<div class="invest-data-amount g-2">
<div class="invest-data-history mt-4">
<div class="title"> Withdraw and Deposit Funds</div>
<div class="mt-2">
</div>
</div>
</div>

</div>



</div>

</div>
<div class="card-footer bg-white">
<deposit-withdraw-component/>
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












<!-------Dialog-------->
<div class=""  v-if="dialog.state==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);z-index:1000000;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Details </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.state=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">



<ul class="data-list is-compact">
<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Appointment Date</div>
            <div class="data-value">
                <em class="icon ni ni-calender-date m-0 p-0"></em>
                {{  dialog.appointment.date.split('-').reverse().join('/') }}
                <span>{{ dialog.appointment.end_date }} </span>
            </div>
        </div>
</li>
<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Time</div>
            <div class="data-value">
                <em class="icon ni ni-clock"></em>
               <span class="text-success mr-2"> {{ dialog.appointment.from }}</span> -  <span class="text-danger ml-2"> {{ dialog.appointment.to }}</span> </div>
        </div>
 </li>
<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Service Requested</div>
        <div class="data-value text-transform"><em class="icon ni ni-tag-fill"></em> {{ dialog.appointment.name }} </div>
    </div>
</li>

<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Location </div>
            <div class="data-value">
                <em class="icon ni ni-map-pin-fill"></em>
                {{ dialog.appointment.location }}
        </div>
    </div>
</li>



</ul>










</div>
<div class="modal-footer bg-light">
<span class="sub-text">Modal Footer Text</span>
</div>
</div>
</div>
</div>

<!------------>



</div>
</template>
<script>
import DepositWithdrawComponent from '@/Components/DepositWithdrawComponent';
export default {
components:{
DepositWithdrawComponent
},


props:{
response:{},
title:{},
},
data(){return{
dialog:{
state:false,
appointment:null,
},
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
},







},


methods:{
show_appointment(a){
this.dialog.appointment=a;
this.dialog.state=true;
}





}








}
</script>

<style scoped>
table tr td{
padding:10px;
}

.data-list li{
border:none;
}




</style>
