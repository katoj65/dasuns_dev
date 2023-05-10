<template>
<div class="nk-block pt-0">

<div class="row g-gs">
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
<Inertia-link :href="route(t.url)"><strong>{{ t.title }} </strong></Inertia-link>
</span></div>
</div>

</div>

</div>
</div>
</div><!-- .card -->
</div>




<div class="col-md-8">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title">Appointments</h4>
</div>
<div>

<table class="nk-tb-list nk-tb-ulist">
<thead class="border-0">
<tr class="nk-tb-item nk-tb-head border-0">
<th class="nk-tb-col border-0"><span class="sub-text">Appointment Dates</span></th>
<th class="nk-tb-col tb-col-lg border-0"><span class="sub-text">Location</span></th>
<th class="nk-tb-col tb-col-lg border-0"><span class="sub-text">Names</span></th>
<th class="nk-tb-col tb-col-lg border-0"><span class="sub-text">Requested at</span></th>
<th class="nk-tb-col tb-col-xxl border-0"><span class="sub-text">Status</span></th>
<th class="nk-tb-col nk-tb-col-tools text-right border-0">
<div class="dropdown">
<a href="#" class="btn btn-xs btn-trigger btn-icon dropdown-toggle mr-n1" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>Accepted</span></a></li>
<li><a href="#"><span>Pending</span></a></li>
</ul>
</div>
</div>
</th>
</tr><!-- .nk-tb-item -->
</thead>
<tbody v-if="appointments.length>0">
<tr class="nk-tb-item" v-for="a in appointments" :key="a.id" @click="open(a)" style="cursor:pointer;">
<td class="nk-tb-col border-0">
<a href="" class="project-title">
<div class="user-avatar sq bg-purple-dim">
<em class="icon ni ni-calender-date-fill"></em>
<span>
</span></div>
<div class="project-info">
<h6 style="font-size:15px;font-weight:normal;line-height:25px;">
<span class="text-success">
{{ a.date.substring(0,10).split('-').reverse().join('/') }}</span><br/>

<span v-if="a.end_date!=null" class="text-warning"> {{ a.end_date!=null?a.end_date.substring(0,10).split('-').reverse().join('/'):'---' }}</span>


</h6>
</div>
</a>
</td>
<td class="nk-tb-col tb-col-lg text-transform border-0">
<span>
{{ a.location }}
</span>
</td>
<td class="nk-tb-col tb-col-lg text-transform border-0">
{{ a.firstname }} {{ a.lastname }}
</td>
<td class="nk-tb-col tb-col-mb border-0">
<span class="badge badge-dim badge-success" v-if="a.status=='accepted'" style="font-size:14px;">
<em class="icon ni ni-clock"></em><span>
{{ a.created_at.substring(0,10).split('-').reverse().join('/') }}
</span>
</span>

<span class="badge badge-dim badge-warning" v-else style="font-size:14px;">
<em class="icon ni ni-clock"></em><span>
{{ a.created_at.substring(0,10).split('-').reverse().join('/') }}
</span>
</span>

</td>
<td class="nk-tb-col nk-tb-col-tools border-0">
<em class="icon ni ni-check-circle-fill text-success" v-if="a.status=='accepted'" style="font-size:20px;"></em>
<em class="icon ni ni-alert-circle-fill text-warning" v-else-if="a.status=='pending'"  style="font-size:20px;"></em>
</td>
</tr><!-- .nk-tb-item -->

</tbody>
<tbody v-else>
<tr>
<td>No appointment available</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>











<div class="col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h1 class="card-title">Services I Provide</h1>
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












<div class="col-12 col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title">Wallet</h4>
</div>
<div style="min-height:200px;" class="card-body p-0">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">Your account balance</h6>
</div>
<div class="card-tools">
<em class="icon ni ni-wallet-fill" style="font-size:30px;"></em>
</div>
</div>
<div class="card-amount">
<span class="amount"> {{ wallet_balance }} <span class="currency currency-usd">UGX</span>
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
<div class="card-footer bg-white"><deposit-withdraw-component/></div>
</div>
</div>












<div class="col-12 col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title">Recommendations</h4>
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
<!-- <span class="badge badge-dot badge-dot-xs badge-info ml-1">Open</span> -->
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
<h4 class="card-title">Activities</h4>
</div>
<div style="min-height:200px;" class="card-body">

<div class="timeline">
<h6 class="timeline-head">November, 2019</h6>
<ul class="timeline-list">
<li class="timeline-item" v-for="n in 3" :key="n">
<div class="timeline-status bg-primary is-outline"></div>
<div class="timeline-date">13 Nov <em class="icon ni ni-alarm-alt"></em></div>
<div class="timeline-data">
<h6 class="timeline-title">Submited KYC Application</h6>
<div class="timeline-des">

<span class="time">09:30am</span>
</div>
</div>
</li>


</ul>
</div>






</div>
</div>
</div>





</div>
















<!-----Booking--->

<create-appointment></create-appointment>

<!-----------FORM MODAL-->

<form class=""  v-if="modal==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Details</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="close()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">


<div class="card border border-radius">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label bold"> <em class="icon ni ni-calender-date-fill mr-2" style="font-size:20px;"></em> Dates</div>
<div class="data-value">{{ content.date.substring(0,10).split('-').reverse().join('/') }} -  {{ content.end_date!=null?content.end_date.substring(0,10).split('-').reverse().join('/'):null }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label bold"> <em class="icon ni ni-clock mr-2" style="font-size:20px;"></em> Time</div>
<div class="data-value">{{ content.from.substring(0,10) }} -  {{ content.to.substring(0,10) }}</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label bold"><em class="icon ni ni-chat-circle mr-2" style="font-size:20px;"></em> Comment</div>
<div class="data-value text-transform">{{ content.comment }}</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label bold">   <em class="icon ni ni-user-alt-fill mr-2" style="font-size:20px;"></em> Names</div>
<div class="data-value">
<div class="user-card">
<div class="user-name">
<span class="tb-lead text-transform" style="font-size:16px;">
{{ content.firstname }} {{ content.lastname }}
</span>
</div>
</div>
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label bold"> <em class="icon ni ni-bookmark-fill mr-2" style="font-size:20px;"></em> Services</div>
<div v-if="content.services.length>0">
<ul>
<li v-for="s in content.services" :key="s.id" class="text-transform">
<div class="user-card mb-2">

<div class="user-name">
<span class="tb-lead" style="font-size:15px;font-weight:normal">{{ s.name }} </span>
</div>
</div>
</li>
</ul>
</div>
<div v-else class="text-muted">
No service requested
</div>
</div>
</li>
</ul>
</div>
</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<el-button-group v-if="content.status=='pending'">
<el-button type="success"  class="btn btn-success" @click="submit('accepted')">Accept</el-button>
<el-button type="warning" @click="submit('declined')">Decline</el-button>
</el-button-group>

<el-button type="warning" class="btn btn-success" v-if="content.status=='accepted'" @click="submit('cancelled')">Cancel</el-button>



<!-- <div class="dropdown">
<a href="#" class="btn btn-success" data-toggle="dropdown" aria-expanded="false"><span>Appointment Confirmation</span><em class="icon ni ni-chevron-down"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-auto mt-1" style="">
<ul class="link-list-plain">
<li v-if="content.status=='pending'"><a href="#" @click="submit('accepted')">Accept</a></li>
<li><a href="#" v-if="content.status=='pending'" @click="submit('declined')">Decline</a></li>
<li><a href="#" v-if="content.status=='accepted'" @click="submit('cancelled')">Cancel</a></li>
</ul>
</div>
</div> -->


</span>
</div>
</div>
</div>
</form>




<!-------Modal deposit------>






</div>
</template>
<script>
import TableComponent1 from '../Components/TableComponent1.vue';
import DepositWithdrawComponent from '../Components/DepositWithdrawComponent.vue';
import CreateAppointment from '../Components/CreateAppointment.vue';
export default {
components: {
TableComponent1,
DepositWithdrawComponent,
CreateAppointment
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
activities(){
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

</style>
