<template>
<layout-un-auth-vue>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">

<h4 style="font-size:25px;" class="text-center">
{{ service.name }}
</h4>

<p class="text-center pt-3" style="font-size:17px;">Here are the professional {{ service.name }} near you.</p>






<div class="row mt-5" v-if="response.providers.length>0">
<div class="col-md-3 col-12 mb-5" v-for="p in response.providers" :key="p.id">
<el-card class="card p-0" style="border-radius:10px;">
<div class="card-inner p-0">
<div class="team">
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="user-info">
<h6 class="text-transform">{{ p.firstname }}  {{ p.lastname }} </h6>
<span class="sub-text pt-2 pb-2"> <em class="icon ni ni-star-fill mr-1"></em> {{ service.name }} </span>
</div>
</div>

<div class="team-view">
<Inertia-link :href="route('login')" class="btn btn-block text-success" style="font-size:15px;"><span>
Login to make appointment
</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card><!-- .card -->
</div>
</div>
<div class="center" v-else>No service provider for this service</div>
</div>
</div>
</div>
</div>
</layout-un-auth-vue>
</template>
<script>
import LayoutUnAuthVue from '../Layouts/LayoutUnAuth.vue'
export default {
    components:{
LayoutUnAuthVue,
    },
props:{
response:{},
title:{},
},

data(){return{

}},

computed:{
service(){
return this.response.service;
}


}







}
</script>
