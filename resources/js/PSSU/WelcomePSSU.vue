<template>
<div class="nk-block pt-0">

<div class="row g-gs">

<div class="col-md-3" v-for="t in tabs" :key="t.id">
<div class="card  card-full card-radius">
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
<div class="card card-full card-radius">
<div class="card-inner">
<div class="card-title-group mb-1">
<div class="card-title">
<h3 class="title" style="font-size:18px;">Appointments</h3>
</div>
</div>



<div class="card-inner p-0 mt-0">
<table class="table table-tranx">


<!-- <thead>

<tr>

<th class="tb-tnx-info">
<span class="tb-tnx-desc d-none d-sm-inline-block">
<span>Service requested</span>
</span>
<span class="tb-tnx-date d-md-inline-block d-none">
<span class="d-md-none">Date</span>
<span class="d-none d-md-block">
<span>Date</span>
<span>Time</span>
</span>
</span>
</th>
<th class="tb-tnx-amount is-alt">
<span class="tb-tnx-total">Amount</span>
<span class="tb-tnx-status d-none d-md-inline-block">Status</span>
</th>
<th class="tb-tnx-action">
<span>&nbsp;</span>
</th>
</tr>

</thead> -->



<tbody>
<tr class="tb-tnx-item" v-for="a in appointments" :key="a">
<!-- <td class="tb-tnx-id">
<a href="#"><span>4947</span></a>
</td> -->
<td class="tb-tnx-info">
<div class="tb-tnx-desc">
<span class="title text-transform">
<!-- <em class="icon ni ni-forward-alt-fill"></em> -->
{{ a.name }} </span>
</div>
<div class="tb-tnx-desc text-muted">
<span class="date">{{ a.date.split('-').reverse().join('/') }} </span>
<span class="date ml-2">
<em class="icon ni ni-clock text-muted"></em>
{{ a.from.substring(0,5) }}</span>
<span class="date ml-2">{{ a.to.substring(0,5) }} </span>
</div>
</td>


<td class="tb-tnx-amount is-alt" style="width:100px;">
<div class="tb-tnx-status">
<span class="badge badge-dot badge-warning text-transform" v-if="a.status=='pending'">{{ a.status }} </span>
<span class="badge badge-dot badge-success text-transform" v-else-if="a.status=='accepted'">{{ a.status }} </span>
</div>
</td>


<td class="tb-tnx-action">
<div class="dropdown">
<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
<ul class="link-list-plain">
<li><a href="#" @click="show_appointment(a)">View</a></li>
<li><a href="#">Remove</a></li>
</ul>
</div>
</div>
</td>



</tr><!-- tb-tnx-item -->

</tbody>
</table>
</div>




</div>
</div>
</div><!-- .col -->









<div class="col-md-4 col-xxl-4">
<div class="card card-full card-radius">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
    <h6 class="title"  style="font-size:18px;">Activities</h6>
    <!-- <p>Activities performed in the last 30 days.</p> -->
</div>
<!-- <div class="card-tools mt-n4 mr-n1">
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
</div> -->
</div>






<div class="card-body p-0 m-0">

    <div class="simplebar-content m-0 " style="padding: 0px;" v-if="activity.length>0">
        <div class="nk-msg-item current p-0 border-0 mb-1" data-msg-id="1" v-for="a in activity" :key="a.id">
            <div class="user-avatar user-avatar-sm bg-success">
                <span><em class="icon ni ni-bell" style="font-size:20px;"></em></span>
            </div>
            <div class="nk-msg-info">
                <div class="nk-msg-from">
                    <div class="nk-msg-sender">
                        <div class="name bold" style="color:black;">{{ a.title}}</div>
                        <div class="nk-msg-meta">
                            <div class="attchment"><em class="icon ni ni-clock"></em></div>
                            <div class="date text-primary" style="font-size:13px;">{{ a.created_at.substring(0,10).split('-').reverse().join('/') }} </div>
                        </div>
                    </div>
                </div>
                <div class="nk-msg-context pb-3">
                    <div class="text-muted">
                        <p style="font-size:13px;">{{ a.description}}</p>
                    </div>
                    <!-- <div class="nk-msg-lables">
                        <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>
                    </div> -->
                </div>
            </div>
        </div>

    </div>

<div class="text-muted" v-else>No content</div>










</div>








</div>
</div>
</div><!-- .col -->







<div class="col-md-4 col-xxl-4">
<div class="card card-full card-radius">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
<h2 class="title" style="font-size:18px;">My Wallet </h2>
<p>View transaction details</p>
</div>

</div>



<div class="card-body">




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
<div class="card-footer bg-white">
<deposit-withdraw-component/>
</div>
</div>
</div><!-- .col -->


















<div class="col-md-4 col-xxl-4">
<div class="card card-full card-radius">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
    <div class="card-title">
        <h2 class="title" style="font-size:18px;">My Wallet </h2>
        <p>View transaction details</p>
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
<div class="card card-full card-radius">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
    <div class="card-title">
        <h2 class="title" style="font-size:18px;">My Service Providers </h2>
        <!-- <p>View transaction details</p> -->
        </div>
<!-- <div class="card-tools mt-n4 mr-n1">
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
</div> -->
</div>
<div class="card-inner-group p-0">
<div v-if="providers.length>0">

<Inertia-link :href="route('show.pssp',[p.id])" v-for="p in providers" :key="p.id">
<div class="card-inner card-inner-md p-0 pb-2 mb-2 border-0" >
    <div class="user-card">
        <div class="user-avatar sq bg-warning-dim"><span><em class="icon ni ni-user-alt-fill"></em></span></div>
        <div class="user-info">
            <span class="lead-text">{{ p.firstname }} {{ p.lastname }} </span>
            <span class="sub-text">{{ p.email }} </span>
        </div>
        <!-- <div class="user-action">
            <div class="drodown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                        <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </div>
</div>
</Inertia-link>


</div>

<div class="text-center tex-muted" v-else>No service provider services requested</div>


</div>

</div>
</div>
</div><!-- .col -->

</div>












<!-------Dialog-------->
<div class=""  v-if="dialog.state==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);z-index:1000000;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Appointment Details </h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.state=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="overflow:auto;max-height:500px;">



<ul class="data-list is-compact">
<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Appointment Date</div>
            <div class="data-value">
                <a href="#" class="text-primary" @click="show_calendar()">
                <em class="icon ni ni-calender-date m-0 p-0"></em>
                {{  dialog.appointment.date.split('-').reverse().join('/') }}
                <span>{{ dialog.appointment.end_date }} </span>
                <span><br/>

                </span>
            </a>
            </div>
        </div>
</li>

<li class="data-item" v-if="calendar.state==true">
<calendar-component />
</li>



<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Time</div>
            <div class="data-value">
                <em class="icon ni ni-clock"></em>
               <span class="text-success mr-2"> {{ dialog.appointment.from }}</span> -  <span class="text-danger ml-2"> {{ dialog.appointment.to }}</span> </div>
        </div>
 </li>
<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Service Requested</div>
        <div class="data-value text-transform"><em class="icon ni ni-tag-fill"></em> {{ dialog.appointment.name }} </div>
    </div>
</li>

<li class="data-item">
        <div class="data-col">
            <div class="data-label bold">Location </div>
            <div class="data-value">
                <em class="icon ni ni-map-pin-fill"></em>
                {{ dialog.appointment.location }}
        </div>
    </div>
</li>



<li class="data-item">
    <div class="data-col">
        <div class="data-label bold">Service Provider  </div>
        <div class="data-value">
            <em class="icon ni ni-user-alt-fill"></em>
            {{ dialog.appointment.firstname }}  {{ dialog.appointment.lastname }}
    </div>
</div>
</li>

<li class="data-item">
    <div class="data-col">
        <div class="data-label bold">Telephone Number </div>
        <div class="data-value">
            <em class="icon ni ni-call-fill"></em>
            {{ dialog.appointment.tel }}
    </div>
</div>
</li>


<li class="data-item">
    <div class="data-col">
        <div class="data-label bold">Email Address </div>
        <div class="data-value">
            <em class="icon ni ni-mail-fill"></em>
            {{ dialog.appointment.email }}
    </div>
</div>
</li>



</ul>










</div>
<div class="modal-footer bg-light text-left">
<span class="mr-3">You have made a payment of Shs: 100000</span>
<span class="sub-text">
    <a href="#" class="btn btn-dim btn-outline-light">Options available </a>
</span>
</div>
</div>
</div>
</div>

<!------------>


<create-appointment/>
</div>
</template>
<script>
import CreateAppointment from '../Components/CreateAppointment.vue';
import DepositWithdrawComponent from '@/Components/DepositWithdrawComponent';
import CalendarComponent from '@/Components/CalendarComponent';
export default {
components:{
DepositWithdrawComponent,
CalendarComponent,
CreateAppointment
},


props:{
response:{},
title:{},
},




data(){
return{

dialog:{
state:false,
appointment:null,
},

content:this.response.user_data.dashboard,
calendar:{
state:false,
},



}},


computed:{
tabs(){
const numbers = new Intl.NumberFormat('en-US');
return [
{icon:'icon ni ni-calender-date-fill',title:'APPOINTMENTS',count:this.response.user_data.dashboard.count_appointments,id:2},
{icon:'icon ni ni-grid-fill',title:'SERVICE PROVIDERS',count:this.response.user_data.dashboard.service_provider_count,id:1},
{icon:'icon ni ni-bar-chart-fill',title:'RECOMMENDATIONS',count:40,id:3},
{icon:'icon ni ni-wallet-fill',title:'WALLET',
count:numbers.format(this.response.user_data.dashboard.account_balance),id:4},

];

},


appointments(){
return this.response.user_data.dashboard.appointments;
},

wallet_balance(){
const sum=new Intl.NumberFormat('en-US');
return sum.format(this.response.user_data.dashboard.account_balance);
},

//activity list
activity(){
return this.response.user_data.dashboard.activity;
},

providers(){
return this.response.user_data.dashboard.pssp;
}






},


methods:{
show_appointment(a){
this.dialog.appointment=a;
this.dialog.state=true;
},

show_calendar(){
if(this.calendar.state==false){
this.calendar.state=true;
}else{
this.calendar.state=false;
}
}





}








}
</script>

<style scoped>
table tr td{
padding:10px;
}

.data-list li{
border:none;
}




</style>
