<template>
<div class="nk-block pt-0">
<div class="row g-gs">
<div class="col-md-3" v-for="t in tab" :key="t.id" shadow="never">
<el-card class="card  card-full h-100" shadow="never">
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
<Inertia-link :href="route(t.url)"><strong>{{ t.title }} </strong></Inertia-link>
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
</div>



<div class="row mt-2">
<div class="col-md-8">
<el-card shadow="never" class="h-100">
<div slot="header">
<h4>Appointments</h4>
</div>
<div>





</div>
</el-card>
</div>
<div class="col-md-4">
<el-card shadow="never" class="h-100">
<div slot="header">
<h4>Services</h4>
</div>
<div>


</div>
</el-card>
</div>
</div>









<div class="row mt-2">
<div class="col-12 col-md-4">
<el-card shadow="never" class="h-100">
<div slot="header">
<h4>Wallet</h4>
</div>
<div>





</div>
</el-card>
</div>

<div class="col-12 col-md-4">
<el-card shadow="never" class="h-100">
<div slot="header">
<h4>Recommendations</h4>
</div>
<div>


</div>
</el-card>
</div>

<div class="col-12 col-md-4">
<el-card shadow="never" class="h-100" >
<div slot="header">
<h4>Activities</h4>
</div>
<div>





</div>
</el-card>
</div>
</div>











</div>
</template>
<script>
export default {
props:{
response:{}
},

//

computed:{
tab(){
const item=[
{id:1,title:'REQUESTS',count:10,url:'dashboard',icon:'icon ni ni-emails'},
{id:2,title:'APPOINTMENTS',count:3,url:'dashboard',icon:'icon ni ni-calender-date-fill'},
{id:3,title:'SERVICES',count:4,url:'dashboard',icon:'icon ni ni-dashboard-fill'},
{id:4,title:'WALLET',count:4,url:'wallet',icon:'con ni ni-wallet-fill'},
];

return item;

}




}









}
</script>
