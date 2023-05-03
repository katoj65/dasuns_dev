<template>
<app-layout>
<div class="row pt-2 pb-2">
<div class="col-12 col-md-8 mb-2">
<div class="card" style="min-height:600px;">
<div class="card-header">
<div class="card-title">
<h4 class="title">
Dasus Wallet
</h4>
</div>
</div>

<div class="card-body">
<div class="card card-full">
    <div class="card-inner">
        <div class="card-title-group align-start mb-0">
            <div class="card-title">
                <h6 class="subtitle" style="font-size:18px;">Service Number: {{ response.service_number }} </h6>
            </div>
            <div class="card-tools">
                <em class="icon ni ni-wallet-fill" style="font-size:65px;"></em>
            </div>
        </div>
        <div class="card-amount">
            <span class="amount"> {{ response.balance }} <span class="currency currency-usd">USD</span>
            </span>
            <span class="change up text-danger bold">
            {{ response.currence }} </span>
        </div>
        <div class="invest-data pt-5">
            <div class="invest-data-amount g-2">
                <deposit-withdraw-component></deposit-withdraw-component>
            </div>
            <div class="invest-data-ck">
                <canvas class="iv-data-chart" id="totalDeposit"></canvas>
            </div>
        </div>
    </div>
</div>
</div>


</div>





</div>
<div class="col-12 col-md-4">
<div class="card mb-2">
<div class="card-body">
<calendar-component></calendar-component>
</div>
</div>



<div class="card">
<div>
<ul class="data-list is-compact">
<li class="data-item border-0">
<a href="">
<div class="data-col">
<div class=""><em class="icon ni ni-wallet-saving mr-1" style="font-size:21px;"></em> Transaction Information</div>
</div>
</a>
</li>
<li class="data-item border-0">
<a href="">
<div class="data-col" style="width:100%;">
<div class="" style="width:100%;">
<em class="icon ni ni-shield-alert mr-1" style="font-size:21px;"></em> Report</div>
</div>
</a>
</li>
<li class="data-item border-0">
<a href="">
<div class="data-col" style="width:100%;">
<div class="" style="width:100%;"><em class="icon ni ni-call mr-1" style="font-size:21px;"></em> Contact Us</div>
</div>
</a>
</li>
</ul>
</div>
</div>




</div>
</div>
</app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout';
import CalendarComponent from '../Components/CalendarComponent.vue';
import DepositWithdrawComponent from '../Components/DepositWithdrawComponent.vue';

export default {
components:{
AppLayout,
CalendarComponent,
DepositWithdrawComponent,


},
props:{
title:{},
response:{},
},
data(){return{


}},

}
</script>
