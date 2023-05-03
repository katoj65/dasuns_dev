<template>
<app-layout>
<div class="card mt-2 mb-2" style="min-height:700px;">
<div class="card-header">

<div class="card-title-group">
<div class="card-title">
<h6 class="title">Services I provider to Dasuns</h6>
</div>
<div class="card-tools pt-1">
<a href="#" class="btn btn-success d-none d-sm-inline-flex" ><em class="icon ni ni-download-cloud"></em><span>
<span class="d-none d-md-inline">Add new service</span></span></a>
</div>
</div>


</div>









<div class="card-body">
<div class="mt-0 mb-2 row" v-if="services.length>0">
<div class="col-12 col-md-3 mb-2" v-for="s in services" :key="s.id">

<div class="card bg1" style="border-radius:10px;">
<div class="card-inner" style="min-height:270px;">
<div class="team">
<div class="user-card user-card-s2">
    <div class="user-avatar md bg-success">
        <span>
<img :src="image_route+s.icon"/>
        </span>
    </div>
    <div class="user-info">
        <h6 class="text-transform" style="font-size:18px;">{{ s.name }} </h6>
    </div>
</div>

<ul class="team-statistics">
    <li><span>213</span><span>Rating</span></li>
    <li><span>87.5%</span><span>Tasks Completed</span></li>

</ul>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>


</div>

</div>
<div v-else>
No services
</div>




</div>



</div>
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue'

export default {
components:{
AppLayout,
},

props:{
title:{},
response:{}
},


computed:{
services(){
return this.response.services;
},

image_route(){
return this.$page.props.system.route;
}



}







}
</script>

AppLayout
