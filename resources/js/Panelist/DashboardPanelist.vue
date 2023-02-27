<template>

<div class="nk-block">

<div class="row g-gs" v-if="$page.props.auth.user.status =='active'">
<div class="col-lg-8">



<div class="card card-full" style="min-height:700px;">
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








</div><!-- .card -->
</div><!-- .col -->




<div class="col-lg-4">
<div class="row g-gs">
<div class="col-md-6 col-lg-12">
<div class="card  card-full">
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
</div><!-- .card -->
</div><!-- .col -->






<div class="col-md-6 col-lg-12">
<div class="card card-full h-100">
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
</div><!-- .card -->
</div><!-- .col -->
</div><!-- .row -->
</div><!-- .col -->
</div><!-- .row -->
<div class="row g-gs" v-else>
<div class="col-12 col-md-12">
<div class="card p-4">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">
<div class="card card-full" style="min-height:600px;">
<div class="card-inner">
<div class="card-title-group">
<div class="card-title" style="width:100%;">
<h6  style="text-align:center;width:100%;"></h6>
</div>

</div>
</div>
<div>


<div class="card mb-10 mt-3 border" style="border-radius:5px;">
<div class="card-inner">
<div class="team">

<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>

</div>
<div class="user-info">
<h6 class="text-transform">{{ user.firstname }} {{ user.lastname }} </h6>
<span class="sub-text">Panelist</span>
</div>
</div>

<div class="team-view">
<button class="btn btn-block btn-dim btn-success" @click="close_dialog1()"><span>Add Profession Experience </span></button>
</div>

<div>

<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">{{ user.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value">{{ user.dob }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ user.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number </div>
<div class="data-value">{{ user.tel }} </div>
</div>
</li>
<li class="data-item border-0 mt-2">
<div class="data-col">
<div class="data-label"><strong>PROFESSION EXPERIENCE </strong></div>
<!-- <div class="data-value">info@softnio.com</div> -->
</div>
</li>
<li class="data-item border-0 p-0" style="width:100%;">

<div class="card  card-full" style="width:100%;">
<div class="card-inner-group" v-if="$page.props.response.user_data.dashboard.panelist_professions.length>0">
<div class="data-item" v-for="x in  $page.props.response.user_data.dashboard.panelist_professions" :key="x.id">
<div class="data-col">
<span class="data-label text-transform" style="width:250px;">{{ x.name }} </span>
<span class="data-value" style="width:100px;">{{ x.years>1?x.years+' Years':x.years+' Year' }} </span>
</div>
<div class="data-col data-col-end">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" style="padding:5px;" @click="submit2(x.id)">Delete</a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>

</div>
<div v-else>
No content
</div>
</div>

</li>
</ul>



<div class="border-top" style="width:100%;" v-if="$page.props.response.user_data.dashboard.panelist_professions.length>0">
<button  class="btn btn-block btn-dim btn-success mt-2" @click="submit3()">
FINISH
</button>
</div>


</div>

</div><!-- .team -->
</div><!-- .card-inner -->
</div>


























</div>
</div>






</div>


<div class="col-12 col-md-3"></div>

</div>
</div>
</div>
</div>




<!------Dialog Panels-->


<form class="" v-if="dialog.experience==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">

<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Panelist Profession Experience</h5>
<a href="#" class="close"  aria-label="Close" @click="close_dialog1()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">

<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.experience"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_exp($event)">
<option>-- Select Profession--</option>
<option v-for="p in profession" :key="p.id" :value="p.id">{{ p.name }}</option>
</select>
</div>
</div>






<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<textarea class="form-control" id="default-01" placeholder="Enter profession description" v-model="form.description"></textarea>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.years"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" placeholder="Enter telephone contact" @change="select_years($event)">
<option>-- Select Number of Years --</option>
<option :value="x" v-for="x in 30" :key="x">
{{ x }} {{ x==1?'Year':'Years' }}
</option>
</select>
</div>
</div>

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
import InputError from '@/Alerts/InputError';
export default {

components:{
InputError,
},

props:{
response:{},
title:{},
errors:{},
flash:{}
},


data(){
return{
interviews:this.response.dashboard.interviews,
profile:this.response.dashboard.profile,
user:this.response.dashboard.user,
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







}



}
</script>
<style scoped>
table tr th, table tr td{
padding:10px;
}
</style>
