<template>
<app-layout>
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6 mt-4">














    <div class="card" style="min-height:600px;">
        <div class="card-header">
            <h3 class="card-title bold"><em class="icon ni ni-wallet-fill mr-2" style="font-size:20px;"></em>Wallet</h3>
            <div class="card-options">
<Inertia-link :href="route('wallet.history')" style="font-size:13px;">
History
</Inertia-link>
            </div>
        </div>
        <div class="card-body">
            <div class="row">


<div class="col-lg-4 col-md-4">
<div class="card">
<div class="card-body currency_state">
    <div class="content">
        <div class="text">Service No.</div>
        <h5 class="number">{{ response.service_number }}  </h5>
    </div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-4">
<div class="card">
<div class="card-body currency_state">
    <div class="content">
        <div class="text">Balance</div>
        <h5 class="number"> {{ balance }}</h5>
    </div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-4">
<div class="card">
<div class="card-body currency_state">
    <div class="content">
        <div class="text" style="color:white;">Currency</div>
        <h5 class="number">Shillings{{ response.currence }}</h5>
    </div>
</div>
</div>
</div>




            </div>



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
