<template>
<div class="nk-block">



<div class="row g-gs">
<div class="col-md-3" v-for="t in tab" :key="t.id" shadow="never">
<el-card class="card  card-full" shadow="never">
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
<div class="amount">
<Inertia-link :href="route(t.url)"><span class="currency currency-usd" style="font-size:15px;color:#07372F;">
<strong>{{ t.title }} </strong>
</span>
</Inertia-link>
</div>
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






<div class="row g-gs">
<div class="col-lg-8">

<el-card class="card card-full" style="min-height:700px;" shadow="never">
<div class="card-inner">
<div class="card-title-group">
<div class="card-title">
<h6 class="title"><span class="mr-2" style="font-size:20px;">Interviews</span>


<!-- <a href="#" class="link d-none d-sm-inline">See History</a> -->

</h6>
</div>
<!-- <div class="card-tools">
<ul class="card-tools-nav">
<li><a href="#"><span>Buy</span></a></li>
<li><a href="#"><span>Sell</span></a></li>
<li class="active"><a href="#"><span>All</span></a></li>
</ul>
</div> -->
</div>
</div><!-- .card-inner -->


<table class="table table-sm" v-if="interviews.length>0">
<thead>
<tr>

<th scope="col" class="border-0">Interview Date</th>
<th scope="col" class="border-0">Dasuns Number</th>
<th scope="col" colspan="2" class="border-0">Number of Services</th>
</tr>
<tr>
<th colspan="4" class="border-0 p-2"></th>
</tr>
</thead>
<tbody>
<tr v-for="i in interviews" :key="i.id">
<td class="border-0">{{ i.pssp.date }} </td>
<td class="border-0">{{ i.pssp.number }} </td>
<td class="border-0">{{ i.services>0?i.services+' Services':i.services+'Service' }} </td>
<td style="width:70px;" class="border-0">
<Inertia-link :href="route('interview',[i.pssp.id])" class="btn btn-dim btn-success">Preview</Inertia-link>
</td>
</tr>
</tbody>
</table>
<div v-else class="p-4 text-center text-muted">No New Interview</div>








</el-card><!-- .card -->
</div><!-- .col -->




<div class="col-lg-4">
<div class="row g-gs">
<div class="col-md-6 col-lg-12">
<el-card class="card  card-full" shadow="never">
<div class="card-inner">
<div class="card-title-group align-start mb-2">
<div class="card-title">
<h6 class="title">Recommendations</h6>
<p>{{ recommend.length>1?recommend.length+' Recommended interviews':recommend.length+' Recommended interview' }} </p>
</div>
<div class="card-tools mt-n1 mr-n1">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#" class="active"><span>15 Days</span></a></li>
<li><a href="#"><span>30 Days</span></a></li>
<li><a href="#"><span>3 Months</span></a></li>
</ul>
</div>
</div>
</div>
</div><!-- .card-title-group -->
<div class="nk-coin-ovwg">
<table style="width:100%;">
<tr v-for="r in recommend" :key="r.id">
<td>
<Inertia-link :href="route('interview',[r.id])"><div> {{ r.number }}</div></Inertia-link>
</td>
<td  style="width:100px;">
{{ r.date }}
</td>
</tr>
</table>



</div><!-- .nk-coin-ovwg -->
</div><!-- .card-inner -->
</el-card><!-- .card -->
</div><!-- .col -->






<div class="col-md-6 col-lg-12">
<el-card class="card card-full h-100" shadow="never">
<div class="card-inner">
<div class="card-title-group align-start mb-3">
<div class="card-title">
<h6 class="title">User Activities</h6>
<p>In last 30 days <em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Referral Informations"></em></p>
</div>
<div class="card-tools mt-n1 mr-n1">
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
<div class="user-activity-group g-4">
<div class="user-activity">
<em class="icon ni ni-users"></em>
<div class="info">
<span class="amount">345</span>
<span class="title">Direct Join</span>
</div>
<div class="gfx" data-color="#9cabff" style="color: rgb(156, 171, 255);">
<svg enable-background="new 0 0 48 17.5" version="1.1" viewBox="0 0 48 17.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
<path fill="currentColor" d="m1.2 17.4h-0.3c-0.5-0.1-0.8-0.7-0.7-1.2 2-7.2 5-12.2 8.8-14.7 1.5-1 3-1.5 4.5-1.4 4.9 0.3 7.2 4.9 9 8.5 0.3 0.4 0.5 0.8 0.7 1.2 1 1.8 2.7 3.9 4.5 4.3 0.9 0.2 1.7-0.1 2.6-0.8 1.8-1.4 3-3.7 4.1-5.9 0.5-1 1-1.9 1.5-2.9 1-1.5 2.8-3.5 4.9-3.8 1.1-0.1 2.2 0.3 3.1 1 1.3 1.1 1.9 2.6 2.4 4.1 0.4 1 0.7 1.9 1.2 2.6 0.3 0.4 0.2 1.1-0.2 1.4s-1.1 0.2-1.4-0.2c-0.7-0.9-1.1-2-1.5-3-0.5-1.3-1-2.5-1.9-3.3-0.5-0.4-1-0.6-1.5-0.5-1.3 0.2-2.7 1.6-3.5 2.8-0.5 0.8-1 1.8-1.4 2.7-1.2 2.4-2.4 4.9-4.6 6.5-1.3 1.1-2.8 1.5-4.2 1.2-3.1-0.6-5.1-3.9-5.9-5.3-0.2-0.4-0.4-0.8-0.6-1.3-1.7-3.4-3.5-7.2-7.3-7.4-1.1-0.1-2.1 0.3-3.3 1-3.5 2.4-6.2 7-8 13.7-0.2 0.4-0.6 0.7-1 0.7z"></path>
</svg>
</div>
</div>
<div class="user-activity">
<em class="icon ni ni-users"></em>
<div class="info">
<span class="amount">49</span>
<span class="title">Referral Join</span>
</div>
<div class="gfx" data-color="#ccd4ff" style="color: rgb(204, 212, 255);">
<svg enable-background="new 0 0 48 17.5" version="1.1" viewBox="0 0 48 17.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
<path fill="currentColor" d="m1.2 17.4h-0.3c-0.5-0.1-0.8-0.7-0.7-1.2 2-7.2 5-12.2 8.8-14.7 1.5-1 3-1.5 4.5-1.4 4.9 0.3 7.2 4.9 9 8.5 0.3 0.4 0.5 0.8 0.7 1.2 1 1.8 2.7 3.9 4.5 4.3 0.9 0.2 1.7-0.1 2.6-0.8 1.8-1.4 3-3.7 4.1-5.9 0.5-1 1-1.9 1.5-2.9 1-1.5 2.8-3.5 4.9-3.8 1.1-0.1 2.2 0.3 3.1 1 1.3 1.1 1.9 2.6 2.4 4.1 0.4 1 0.7 1.9 1.2 2.6 0.3 0.4 0.2 1.1-0.2 1.4s-1.1 0.2-1.4-0.2c-0.7-0.9-1.1-2-1.5-3-0.5-1.3-1-2.5-1.9-3.3-0.5-0.4-1-0.6-1.5-0.5-1.3 0.2-2.7 1.6-3.5 2.8-0.5 0.8-1 1.8-1.4 2.7-1.2 2.4-2.4 4.9-4.6 6.5-1.3 1.1-2.8 1.5-4.2 1.2-3.1-0.6-5.1-3.9-5.9-5.3-0.2-0.4-0.4-0.8-0.6-1.3-1.7-3.4-3.5-7.2-7.3-7.4-1.1-0.1-2.1 0.3-3.3 1-3.5 2.4-6.2 7-8 13.7-0.2 0.4-0.6 0.7-1 0.7z"></path>
</svg>
</div>
</div>
</div>
</div>
<div class="user-activity-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<canvas class="usera-activity-chart chartjs-render-monitor" id="userActivity" width="943" height="280" style="display: block; height: 102px; width: 343px;"></canvas>
</div>
</el-card><!-- .card -->
</div><!-- .col -->
</div><!-- .row -->
</div><!-- .col -->
</div><!-- .row -->

<!------Dialog Panels-->
</div>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {

components:{
InputError,
},

props:{
response:{},
errors:{},
flash:{}
},


data(){
return{
profile:this.response.dashboard.profile,
profession:this.response.dashboard.profession,
panelist_professions:this.$page.props.response.user_data.dashboard.panelist_professions,
recommend:this.response.dashboard.recommended,


dialog:{
experience:false,
},

form:this.$inertia.form({
experience:null,
description:null,
years:null,
}
),



//
form2:this.$inertia.form({
id:null,
}),






}},

methods:{

close_dialog1(){
if(this.dialog.experience==false){
this.dialog.experience=true;
}else if(this.dialog.experience==true){
this.dialog.experience=false;
}
},


//select
select_exp(event){
this.form.experience=event.target.value;
},

//select
select_years(event){
this.form.years=event.target.value;
},



submit(){
this.form.post(this.route('store.profession_profile'),{
onSuccess:()=>{
this.dialog.experience=false;
this.$notify({
    position: 'bottom-right',
title: 'Success',
message:this.flash.success!=null?this.flash.success:this.flash.warning,
type: this.flash.success!=null?'success':'warning'
});
}
});
},



//
submit2(id){
this.form2.id=id;
this.form2.post(route('delete.profession_attributes'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title: 'Success',
message:this.flash.success,
type:'success'
});
}
});

},

//
submit3(){
this.$inertia.post(this.route('panelist.finish'));
}







},


computed:{
//
user(){
return this.$page.props.auth.user;
},
//


tab(){
const count=this.response.dashboard.count_items;
const items=[
{icon:'icon ni ni-calender-date-fill',title:'APPOINTMENTS',count:count.appointments,id:2,url:'appointments'},
{icon:'icon ni ni-grid-fill',title:'SERVICE PROVIDERS',count:count.providers,id:1,url:'dashboard'},
{icon:'icon ni ni-bar-chart-fill',title:'RECOMMENDATIONS',count:count.recommendations,id:3,url:'dashboard'},
{icon:'icon ni ni-wallet-fill',title:'WALLET',count:count.wallet,id:4,url:'wallet'},
];
return items;
},
//
interviews(){
return this.response.dashboard.interviews;
},

//







}



}
</script>
<style scoped>
table tr th, table tr td{
padding:10px;
}
</style>
