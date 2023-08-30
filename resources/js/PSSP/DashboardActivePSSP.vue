<template>
<div class="nk-block pt-0">
<div class="section-body mt-3 mb-3">
<div class="container-fluid">
<div class="tab-content mt-3">
<div class="tab-pane fade show active" id="Payroll-Salary" role="tabpanel">
<div class="row clearfix">
<div class="col-md-3" v-for="t in tab" :key="t.id">
<div class="card  card-full h-100">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">
<em :class="t.icon" style="font-size:50px;color:#07372F;"></em>
</h6>
</div>
</div>

<div class="card-amount mb-2 mt-3">
<span class="amount"><span class="currency currency-usd" style="color:#07372F;">{{ t.count }} </span>
</span>
</div>

<div class="invest-data mt-3">
<div class="invest-data-amount g-2">
<div class="invest-data-history">

<div class="amount"> <span class="currency currency-usd" style="font-size:15px;color:#07372F;">
<Inertia-link :href="route(t.url)" class="text-black"><strong>{{ t.title }} </strong></Inertia-link>
</span></div>
</div>

</div>

</div>
</div>
</div><!-- .card -->
</div>


</div>


<div class="tab-pane fade show active mt-3" id="Payroll-Salary" role="tabpanel">
<div class="row clearfix">


<div class="col-md-8">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title bold">Appointments</h4>
</div>
<div>

<table class="table table-hover table-vcenter mb-0 mt-2">
<thead>
<tr>
<th class="bold text-transform">Appointment Request</th>
<th class="bold text-transform">Date</th>
<th class="bold text-transform">Start</th>
<th class="bold text-transform">End</th>
<th class="bold text-transform">Status</th>
<th class="bold text-transform"></th>
</tr>
</thead>
<tbody v-if="appointments.length>0">
<tr v-for="a in appointments" :key="a">

<td><span> {{ a.name }} </span></td>
<td><span>{{ a.date.split('-').reverse().join('/') }}</span></td>
<td><span>{{ a.from.substring(0,5) }}</span></td>
<td><span>{{ a.to.substring(0,5) }}</span></td>
<td class="text-transform">
{{ a.status }}
</td>
<td style="width:50px;">
<Inertia-link :href="route('appointment.details',{id:a.id})" class="btn btn-default btn-sm text-primary" style="border:none;margin:0;">View</Inertia-link>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td>No content</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>








<div class="col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h1 class="card-title bold">Services I Provide</h1>
</div>
<div class="card-body">
<div v-if="services.length>0">

<div class="user-card mb-2" v-for="s in services" :key="s.id">
<div class="user-avatar user-avatar-xs bg-azure-dim">
<span><em class="icon ni ni-bookmark-fill"></em></span>
</div>
<div class="user-name">
<span class="tb-lead" style="font-size:15px;font-weight:normal">{{ s.name }} </span>
</div>
</div>

</div>
<div v-else> No services</div>
</div>
</div>
</div>






















</div>
</div>



<div class="tab-pane fade show active mt-3" id="Payroll-Salary" role="tabpanel">
<div class="row clearfix">








<div class="col-12 col-md-4 pb-3">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold"><em class="icon ni ni-wallet-fill" style="font-size:30px;"></em> Wallet</h3>

</div>
<div class="card-body">
<h6>Ballance</h6>
<h3 class="pt-3" style="font-weight:normal;"><span class="counter">{{ wallet_balance }}</span></h3>
<span><span class="text-danger mr-2"></span>
</span>
</div>
<div class="card-footer border-0">
<div class="list-group border-0 list-widget" style="border:none;">
<Inertia-link :href="route('wallet.deposit')" class="list-group-item" style="font-size:16px;color:black;"><em class="icon ni ni-wallet-out"></em> Deposit Funds</Inertia-link>
<Inertia-link :href="route('wallet.withdraw')" class="list-group-item" style="font-size:16px;color:black"><em class="icon ni ni-wallet-in"></em> Withdraw Funds</Inertia-link>
</div>
</div>
</div>
</div>







<div class="col-12 col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title bold">Recommendations</h4>
</div>
<div style="min-height:200px;" class="card-body p-0">

<ul class="nk-support p-0 m-0">
<li class="nk-support-item border-0" v-for="r in recommendations" :key="r.id">
<div class="user-avatar bg-purple-dim">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="nk-support-content">
<div class="title">
<span>
{{ r.names }}
</span>

</div>
<p class="text-transform" style="font-size:13px;height:40px;overflow:hidden;">{{ r.message }} </p>
<span class="time">{{ r.created_at.substring(0,10).split('-').reverse().join('/') }} </span>
</div>
</li>
</ul>




</div>
</div>
</div>





<div class="col-12 col-md-4">
<div shadow="never" class="h-100 card">
<div class="card-header">
<h4 class="card-title bold">Tasks</h4>
</div>
<div style="min-height:200px;" class="card-body p-0">

<table style="width:100%;" class="table card-table" >
<thead>
<tr>
<th>Date</th>
<!-- <th>Time</th> -->
<th>Appointment</th>
</tr>

</thead>

<tbody v-if="tasks.length>0">
<tr v-for="(t,key) in tasks" :key="key">
<td class="text-muted">{{t.date.split('-').reverse().join('/')}} </td>

<td>{{t.name}} </td>
</tr>

</tbody>

<tbody v-else>
<tr>
<td colspan="3">No tasks</td>
</tr>
</tbody>
</table>







</div>
</div>
</div>



</div>
</div>




</div>


</div>
</div>
</div>
</div>
</template>
<script>
import TableComponent1 from '../Components/TableComponent1.vue';
export default {
components: {
TableComponent1,

},
props:{
title:{},
response:{},
flash:{},
errors:{}
},


data(){
return{

modal:false,
content:null,
modal_wallet:{
deposit:false,
withdraw:false,
},

//payment options
payment_option:{
//mobile payment
mobile:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'MTN'},
{name:'Airtel'},
{name:'Other'}

],



},
//card payment
card:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'Paypal'},
{name:'Master Card'},

]
},

//bank payment
bank:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'Centenary Bank'},
{name:'DFCU Bank'},
{name:'UBA Bank'},
{name:'Bank of Africa'},

]

}






}





}
},



//

computed:{
tab(){
const nf = new Intl.NumberFormat('en-US');
const counts=this.response.user_data.pssp_attributes.counts;
const item=[
{id:1,title:'REQUESTS',count:counts.requests,url:'requests',icon:'icon ni ni-emails-fill'},
{id:2,title:'APPOINTMENTS',count:counts.appointments,url:'list_appointments',icon:'icon ni ni-calender-date-fill'},
{id:3,title:'SERVICES',count:counts.services,url:'pssp-services',icon:'icon ni ni-dashboard-fill'},
{id:4,title:'WALLET',count:nf.format(counts.wallet),url:'wallet',icon:'con ni ni-wallet-fill'},
];
return item;
},

//get services
services(){
return this.response.user_data.pssp_attributes.lists.services;
},

//appointments
appointments(){
return this.response.user_data.pssp_attributes.lists.appointments;
},

//wallet balance
wallet_balance(){
const nf = new Intl.NumberFormat('en-US');
// "1,234,567,890"
return nf.format(this.response.user_data.pssp_attributes.counts.wallet);
},

//recommendations
recommendations(){
return this.response.user_data.pssp_attributes.lists.recommendations;
},


//recommendations
tasks(){
return this.response.user_data.pssp_attributes.lists.activities;
},






},

methods:{
open(a){
this.content=a;
this.modal=true;
},


close(){
this.content=null;
this.modal=false;
},

//submit status
submit(status){
const flash=this.$page.props.flash;
this.$inertia.post(this.route('appointment-update-state'),{
'status':status,
'id':this.content.id
},{
onSuccess:()=>{
this.content=null;
this.$notify({
position:'bottom-right',
title:'Successful',
message:'Appointment '+status+'.',
type: 'success'
});
this.modal=false;
}
});

}




}






}
</script>

<style scoped>
table tr th, table tr td{
border-bottom:solid 1px #F4F6F6;
padding:15px;
}

table thead table tbody tr{
border:none;
}
table tbody tr:hover{
background: #F8F9F9;
}

form table tr td{
border-bottom:none;
}
form table tr:hover{
background:none;
}
.data-list li{
border:none;
}
.card{
margin:0;
}

</style>
