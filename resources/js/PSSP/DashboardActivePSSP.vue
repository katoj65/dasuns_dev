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
    <div style="min-height:400px;">

<table class="table">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">End date</th>
        <th scope="col">Names</th>
        <th scope="col">Status</th>
        <th scope="col" style="width:30px;"></th>

      </tr>
    </thead>
    <tbody v-if="appointments.length>0">
      <tr v-for="a in appointments" :key="a.id" @click="open(a)" style="cursor:pointer;">
        <td scope="row">
        {{ a.date.substring(0,10).split('-').reverse().join('/') }}
        </td>
        <td>{{ a.end_date!=null?a.end_date:'---' }} </td>
        <td class="text-transform">{{ a.firstname }} {{ a.lastname }} </td>
        <td class="text-transform">{{ a.status }}</td>
        <td>
        <em class="icon ni ni-check-circle-fill text-success" v-if="a.status=='accepted'" style="font-size:20px;"></em>
        <em class="icon ni ni-alert-circle-fill text-warning" v-else-if="a.status=='pending'"  style="font-size:20px;"></em>
        </td>
      </tr>
    </tbody>
    <tbody v-else>
    <tr>
    <td colspan="4">No appointments</td>
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
<div style="min-height:400px;" class="card-body">
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
<div shadow="never" class="h-100 card">
<div class="card-header">
<h4>Wallet</h4>
</div>
<div style="min-height:400px;">





</div>
</div>
</div>












<div class="col-12 col-md-4">
<div  class="h-100 card">
<div class="card-header">
<h4 class="card-title">Recommendations</h4>
</div>
<div style="min-height:400px;">


</div>
</div>
</div>





<div class="col-12 col-md-4">
    <div shadow="never" class="h-100 card">
    <div class="card-header">
    <h4 class="card-title">Activities</h4>
    </div>
    <div style="min-height:400px;">





    </div>
    </div>
    </div>





</div>














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
<table style="width:100%;">
<tbody>
<tr>
<td>
{{ content.date.substring(0,10) }}
</td>
<td>
{{ content.end_date!=null?content.end_date.substring(0,10):null }}
</td>
</tr>

<tr>
<td>
{{ content.from.substring(0,10) }}
</td>
<td>
{{ content.to!=null?content.to.substring(0,10):null }}
</td>
</tr>


<tr>
<td colspan="2">
{{ content.comment }}
</td>
</tr>


<tr>
<td colspan="2">
{{ content.firstname }} {{ content.lastname }}
</td>
</tr>
<tr style="border:none;">
<td colspan="2" style="border:none;">
<div v-if="content.services.length>0">
<ul>
<li v-for="s in content.services" :key="s.id" class="text-transform">
    <div class="user-card mb-2">
        <div class="user-avatar user-avatar-xs bg-azure-dim">
            <span><em class="icon ni ni-bookmark-fill"></em></span>
        </div>
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
</td>
</tr>
</tbody>
</table>


</div>
<div class="modal-footer bg-light">
<span class="sub-text">Modal Footer Text</span>
</div>
</div>
</div>
</form>





</div>
</template>
<script>
export default {
props:{
title:{},
response:{}
},


data(){
return{
modal:false,
content:null,

}
},



//

computed:{
tab(){
const counts=this.response.user_data.pssp_attributes.counts;
const item=[
{id:1,title:'REQUESTS',count:counts.requests,url:'requests',icon:'icon ni ni-emails'},
{id:2,title:'APPOINTMENTS',count:counts.appointments,url:'list_appointments',icon:'icon ni ni-calender-date-fill'},
{id:3,title:'SERVICES',count:counts.services,url:'dashboard',icon:'icon ni ni-dashboard-fill'},
{id:4,title:'WALLET',count:counts.wallet,url:'wallet',icon:'con ni ni-wallet-fill'},
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

//




},

methods:{
open(a){
this.content=a;
this.modal=true;
},


close(){
this.content=null;
this.modal=false;
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
</style>
