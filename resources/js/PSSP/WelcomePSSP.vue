<template>
<div>

<vetting-status-pending v-if="user.vet_status=='pending' || user.vet_status=='interview'" :response="response"></vetting-status-pending>
<vetting-status-fail v-else-if="user.vet_status=='failed'" :response="response"></vetting-status-fail>
<application-decline v-else-if="user.vet_status=='declined'" :response="response"></application-decline>




<div class="nk-content p-0" v-else-if="user.vet_status=='active'">
<div class="container-fluid pt-0">
<div class="nk-content-inner pt-0">
<div class="nk-content-body pt-0">
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
<h6 class="title">Appointment Requests</h6>
<p>{{ row.requests.length>1?row.requests.length+' Requests available':'Request available' }}
<a href="#" class="text-success"> View all</a></p>
</div>
</div>



<table class="table">
<thead>
<tr>
<th scope="col" colspan="2" class="border-0">Appointment</th>
<th scope="col" colspan="2" class="border-0">Appointment Dates</th>
<th scope="col" class="border-0">Time</th>
<th scope="col" class="border-0"></th>
</tr>
</thead>
<tbody>
<tr>
<td class="p-2 border-0" ></td>
</tr>
<tr v-for="r in row.requests" :key="r.id">
<th scope="row" class="border-0">
<div class="nk-tnx-type-icon bg-success-dim text-success">
<em class="icon ni ni-label-fill"></em>
</div>
</th>
<td class="border-0">Mark</td>
<td class="border-0">
{{ r.date }}
</td>
<td class="border-0">
{{ r.end_date }}
</td>
<td class="border-0">
{{ r.from }} - {{ r.to }}
</td>
<td class="border-0" style="width:50px;">
<a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon pl-2 pr-2" data-toggle="dropdown">
View
</a>
</td>
</tr>
</tbody>
</table>



<!-- {{ row.requests }} -->


</div>
</div>
</div><!-- .col -->
























<div class="col-md-4 col-xxl-4">
<div class="card card-full">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h6 class="title">Services I provide</h6>
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
</div>
</div><!-- .col -->





























<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
</div><!-- .col -->

<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
</div><!-- .col -->



<div class="col-md-4 col-xxl-4">
<div class="card card-full">
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
</div>
</div><!-- .col -->







</div>
</div>
</div>
</div>
</div>
</div>















<!--------------------->
<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(192, 25%, 99%, 0.6);" v-if="dialog.show==true">



  <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #37BEA7;border:none;">
                    <h5 class="modal-title" style="color:white;">Appointment Request</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" style="height:500px;overflow:auto">















                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">


<input type="submit" class="button" value="Save" style="border-radius:10px"/>



                    </span>
                </div>
            </div>
        </div>


</form>








</div>
</template>
<script>
import VettingStatusPending from '@/PSSP/VettingStatusPending';
import VettingStatusFail from '@/PSSP/VettingStatusFail';
import ApplicationDecline from '@/PSSP/ApplicationDecline';

export default {
components:{
VettingStatusPending,
VettingStatusFail,
ApplicationDecline,

},

props:{
response:{},


},
data(){return{
dialog:{
show:false,


},


//
user:{
profile:this.$page.props.auth.user_profile,
vet_status:this.$page.props.auth.user.status,
},


//
tabs:[
{icon:'icon ni ni-grid-plus-fill',title:'REQUESTS',count:this.response.user_data.pssp_attributes.requests.length,id:2},
{icon:'icon ni ni-calender-date-fill',title:'APPOINTMENTS',count:50,id:1},
{icon:'icon ni ni-bar-chart-fill',title:'TASKS COMPLETED',count:40,id:3},
{icon:'icon ni ni-wallet-fill',title:'PAYMENTS',count:20,id:4},

],




}},

methods:{
show_dialog(item){
}





},

//
computed:{
row(){
return{
requests:this.response.user_data.pssp_attributes.requests,

}
}
}



}
</script>
