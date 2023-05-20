<template>
<app-layout>






<div class="nk-content-body mt-2">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title" style="font-size:20px;"><em class="icon ni ni-user-list-fill"></em> Service Providers</h3>
<div class="nk-block-des text-soft">
<!-- <p>Welcome to Crypto Invest Dashboard</p> -->
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
    <em class="icon ni ni-more-v"></em></a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">

<li class="nk-block-tools-opt">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-primary pl-1 pr-1" data-toggle="dropdown">
    <em class="icon ni ni-opt-dot-alt mr-2"></em> Sort
</a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li v-for="l in services" :key="l.id"><a href="#"><span>{{ l.name }} </span></a></li>
</ul>
</div>
</div>
</li>
</ul>
</div><!-- .toggle-expand-content -->
</div><!-- .toggle-wrap -->
</div><!-- .nk-block-head-content -->
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
        <div class="nk-block mt-2">
            <div class="row">


    <div class="col-12 col-md-3 mb-4"  v-for="p in pssp" :key="p.id">
    <div class="card card-radius" style="min-height:200px;">

    <div class="card-inner">
    <div class="team">
    <div class="user-card user-card-s2">
    <div class="user-avatar lg bg-success-dim">
        <span><em class="icon ni ni-user-alt-fill"></em></span>
        <div class="status dot dot-lg dot-success"></div>
    </div>
    <div class="user-info">
        <h6 class="text-transform">{{ p.firstname }} {{ p.lastname }} </h6>
        <span class="sub-text"><b class="mr-1">Service No:</b>  {{ p.number}}</span>
    </div>
    </div>
    <ul class="team-info">
    <li><span>Gender</span><span class="text-transform">{{ p.gender }} </span></li>
    <li><span>Email</span><span class="text-transform">{{ p.email }} </span></li>
    <li><span>Service</span><span class="text-transform">{{ p.service.name }} </span></li>
    </ul>
    <div class="team-view">
    <Inertia-link :href="route('show.pssp',[p.id])" class="btn btn-block btn-dim btn-success"><span>View Profile</span></Inertia-link>
    </div>
    </div><!-- .team -->
    </div>

    </div>
    </div>
























            </div>
        </div>
    </div>




















</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout

},

props:{
response:{}
},


computed:{
pssp(){
return this.response.pssp;
},

services(){
return this.response.services;
}




}






}
</script>

<style scoped>
.page-title{
    font-family: 'Roboto', sans-serif;





}
</style>
