<template>
<app-layout>
<div class="nk-content p-3">
<div class="row">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">




<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Payments</h3>
</div>
<div class="card-body">
<span>Balance</span>
<h4>Shs.<span class="counter ml-3">{{ balance }} </span></h4>

<div class="form-group">
<label class="d-block">Service Providers<span class="float-right">Shs.<span class="counter"> {{ pssp }} </span></span></label>
<div class="progress progress-xs">

</div>
</div>
<div class="form-group">
<label class="d-block">Service Users <span class="float-right">Shs. <span class="counter">{{ pssu }} </span></span></label>
<div class="progress progress-xs">
</div>
</div>
<div class="form-group">
<label class="d-block">Others <span class="float-right">Shs.<span class="counter">
{{other}} </span></span></label>
<div class="progress progress-xs">

</div>
</div>
</div>
<div class="card-footer">

<h6>
Transaction Details
</h6>

<table class="table mb-0">
<thead>

<tr>

<th>Date</th>
<th>Transaction</th>
<th>Amount</th>

</tr>
</thead>
<tbody v-if="log.length>0">
<tr v-for="(l,key) in log" :key="key">
<td><em class="icon ni ni-calender-date-fill mr-2"></em> {{ l.created_at.substring(0,10).split('-').reverse().join('/') }} </td>
<td class="text-transform">
{{ l.transaction }}
</td>
<td>
{{ l.amount }}
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td>No results</td>
</tr>
</tbody>
</table>





</div>
</div>

</div>
<div class="col-12 col-md-2"></div>
</div>
</div>
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout,
},

props:{
title:{},
response:{},
},

computed:{
balance(){
return this.response.balance;
},
//
payments(){
return this.response.payments;
},

//
pssp(){
return this.response.pssp;
},

pssu(){
return this.response.pssu;
},

other(){
return this.response.other;
},

log(){
return this.response.log;
}




},

methods:{
payload(){
console.log(this.response);
}
},


mounted(){
this.payload();
}






}
</script>
