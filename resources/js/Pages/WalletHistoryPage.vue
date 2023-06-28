<template>
<app-layout>
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6 mt-4">














    <div class="card" style="min-height:600px;">
        <div class="card-header">
            <h3 class="card-title bold">Wallet History</h3>
            <div class="card-options">
                <Inertia-link :href="route('wallet')" style="font-size:13px;">
Wallet
                </Inertia-link>
            </div>
        </div>
        <div class="card-body">





<table class="table mb-0">
<thead>
<tr>
<th>Date</th>
<th>Item</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<tr v-for="n in 40" :key="n">
<td>Mark</td>
<td>Otto</td>
<td>@mdo</td>
</tr>

</tbody>
</table>


















</div>





<div class="card-footer">
    <div>

        <Inertia-link :href="route('wallet.deposit')" class="btn btn-default btn-sm">Deposit Funds</Inertia-link>

        <Inertia-link :href="route('wallet.withdraw')" class="btn btn-default btn-sm">Withdraw Funds

        </Inertia-link>
    </div>

</div>


</div>










</div>
<div class="col-12 col-md-3"></div>
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


//computed method
computed:{
balance(){
const nf = new Intl.NumberFormat('en-US');
return nf.format(this.response.balance);
},









}







}
</script>
