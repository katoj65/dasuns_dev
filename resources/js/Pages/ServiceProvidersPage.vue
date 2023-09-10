<template>
<app-layout>
<div class="nk-block">
<page-header :title="title"></page-header>

<div class="row p-3">
<div class="col-12 col-md-3" v-for="p in pssp" :key="p.id">

<Inertia-link>
    <div class="card p-0">
        <div class="card-body text-center p-0 mt-5">
            <div class="user-card user-card-s2 mt-3">
                <div class="user-avatar lg bg-info">
                    <span><em class="icon ni ni-user-alt-fill"></em></span>

                </div>
                <div class="user-info">
                    <h6 class="text-transform">{{ p.firstname }} {{ p.lastname }}</h6>
                    <span class="sub-text"><span class="sub-text"><b class="mr-1">Service No:</b>  {{ p.number}}</span></span>
                </div>
            </div>





<div class="card-body text-left">
<div class="card-text">
<div class="mt-0">
<small class="float-right text-muted text-transform">{{ p.gender }} </small>
<h6>Gender </h6>
</div>

<div class="mt-2">
<small class="float-right">
{{ p.email }}
</small>
<h6>Email </h6>
</div>


<div class="mt-2">
<small class="float-right text-muted text-transform">
{{ p.service.name }}
</small>
<h6>Service </h6>
</div>




</div>
</div>





            <!-- <button class="btn btn-default btn-sm">View Profile</button>
            <button class="btn btn-default btn-sm">Message</button> -->

        </div>
    </div>
</Inertia-link>
</div>











</div>
</div>
</app-layout>
</template>
<script>
import PageHeader from '../Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout,
PageHeader

},

props:{
response:{}
},

data(){return{
title:'Service providers',


}},





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
