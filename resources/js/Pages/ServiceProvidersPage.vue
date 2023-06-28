<template>
<app-layout>
<div class="nk-content-body mt-2">
<div class="row">
<div class="col-12">
    <div class="card m-2">
        <div class="card-body">
            <div class="row">


<div class="col-lg-4 col-md-4 col-sm-6">
<div class="input-group">
<h6>Service Providers</h6>
</div>
</div>
<div class="col-lg-5 col-md-4 col-sm-6">
<div class="input-group">

</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-12">
</div>
</div>
</div>
</div>
</div>









<div class="col-12 col-md-3" v-for="p in pssp" :key="p.id">

<Inertia-link :href="route('show.pssp',[p.id])">
    <div class="card" style="margin:10px;margin-top:5px;">
        <div class="card-body text-center">
            <div class="user-card user-card-s2">
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
<small class="float-right text-muted text-transform">
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
            <div class="row text-center mt-2">
                <div class="col-lg-6 border-right">
                    <label class="mb-0">Rating</label>
                    <h4 class="font-18">31</h4>
                </div>
                <div class="col-lg-6">
                    <label class="mb-0">Tasks done</label>
                    <h4 class="font-18">39</h4>
                </div>
            </div>
        </div>
    </div>
</Inertia-link>
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
