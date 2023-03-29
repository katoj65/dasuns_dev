<template>
<app-layout>
<el-card shadow="never" style="min-height:800px;">
<div slot="header">
<h4>
Wallet
</h4>
</div>
<div class="row">
<div class="col-12 col-md-8">


<el-card class="card" shadow="never">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label"><h4>Transaction Details</h4></div>
<div class="data-value"></div>
</div>
</li>
<li class="data-item" v-for="n in 15" :key="n">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-calender-date-fill"></em> 10/20/20000</div>
<div class="data-value">
Paid for service
</div>
</div>
</li>


</ul>
</el-card>











</div>
<div class="col-12 col-md-4">


<el-card shadow="never">

<div class="nk-order-ovwg-data sell" style="border:none;">
<div class="amount">12,954.63 <small class="currenct currency-usd">USD</small></div>
<div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div>
<div class="title"><em class="icon ni ni-arrow-up-left"></em> Sell Orders</div>
</div>



</el-card>



</div>
</div>
</el-card>
</app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout,



},
props:{
title:{},
response:{},
},
data(){return{






}},

}
</script>
