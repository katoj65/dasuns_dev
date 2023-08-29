<template>
<app-layout>
<div class="row m-2 pt-2">
<div class="card" style="min-height:800px;">
<div class="card-header" v-if="pssp.length>0">
<div class="card-title">
<h6 class="bold">Search results</h6>
</div>
</div>


<div class="card-body" v-if="pssp.length>0">
    <div class="row">
    <div class="col-12 col-md-3" v-for="(l,key) in pssp" :key="key">
    <div class="card border">
    <div class="card-body text-center">

    <div class="text-center">
    <em class="icon ni ni-user-circle-fill" style="font-size:50px;">
    </em>
    </div>

    <h6 class="mt-3 mb-0 text-transform mb-2">{{ l.firstname }} {{ l.lastname }}</h6>
    <span style="font-size:13px;"><strong>Service No:</strong> {{ l.number }} </span>
    <div class="mt-3">
    <Inertia-link class="btn btn-default btn-sm" :href="route('profile.pssp',{id:l.id})">View Profile</Inertia-link>
    <Inertia-link class="btn btn-default btn-sm" :href="route('messages',{id:l.id})">Message</Inertia-link>
    </div>
    <div class="row text-center mt-4">
    <div class="col-lg-12">
    <label class="mb-0 text-muted" style="font-size:13px;">
    {{ l.services>1?l.services+' Professional Services':l.services+' Professional Service' }}
    </label>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>

<div class="card-body text-center p-5" v-else>
<h4>No search results found</h4>
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




}},
computed:{
pssp(){
return this.response.pssp;
},






}




}
</script>
