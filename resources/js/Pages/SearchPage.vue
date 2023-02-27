<template>
<app-layout>


<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">

<div class="card-title-group">
<div class="card-title">
<h1 class="title">{{ response.count_results>1?response.count_results+' Search Results':response.count_results+' Search Result' }}</h1>
</div>
<div class="card-tools mt-n1 mr-n1">
<div class="drodown">
<a href="#" class="dropdown-toggle btn-icon" data-toggle="dropdown" aria-expanded="false" style="padding:5px;">
<em class="icon ni ni-opt-dot-alt" style="font-size:20px;"></em>
 Advanced Filter
</a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="margin-top:-8px;">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>Services</span></a></li>
<li><a href="#"><span>Service Provider</span></a></li>

<!-- <li><a href="#"><span>3 Months</span></a></li> -->

</ul>
</div>
</div>
</div>
</div>

</div>
<div class="card-body" style="min-height:700px;">
<div  v-if="response.count_results>0">

<div class="row">
<div class="col-12 col-md-4" v-for="s in response.services" :key="s.id">
<Inertia-link :href="route('search.service',[s.id])" class="project-title">
<div class="nk-order-ovwg-data mb-1 ">
<div class="title" style="font-weight:bolder"><em class="icon ni ni-grid-fill bg-success-dim"></em> {{ s.name }} </div>
<div class="info" style="padding-left:40px;">{{ s.count_pssp>1?s.count_pssp+' Service providers':s.count_pssp+' Service provider' }}</div>
</div>
</Inertia-link>
</div>
</div>






<div class="row mt-5">
<div class="col-12 col-md-4" v-for="p in response.providers" :key="p.id">
<div class="card shadow" style="border-radius:30px;">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>

</div>
<div class="user-info">
    <h6 class="text-transform">{{ p.firstname+' '+p.lastname  }}</h6>
    <span class="sub-text">
    {{ p.services>1?p.services+' Professional Services':p.services+' Professional Service' }}

    </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ p.gender }}</span></li>
<li><span>Contact</span><span>{{ p.tel }}</span></li>
<li><span>Email</span><span>{{ p.email }}</span></li>
<li><span>Servive Number</span><span>{{ p.number }}</span></li>
<li class="pt-2">
<el-rate v-model="value" disabled show-score text-color="#ff9900" score-template="{value} points"></el-rate>
</li>
</ul>
<div class="team-view">
<Inertia-link :href="route('show.pssp',[p.id])" class="btn btn-block btn-dim btn-success"><span>View Profile</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>
</div>
</div>












</div>
</div>
</div>
</div>
</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout,
},
props:{
title:{},
response:{}
},
data(){return{
value: 3.7,



}},
methods:{




}




}
</script>
