<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">

<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">

<div class="card" v-if="response.profile">
        <div class="card-body text-center">
            <div class="circle">
                <em class="icon ni ni-user-circle-fill" style="font-size:100px;"></em>
            </div>
            <h4 class="mt-3 mb-0 text-transform">

                {{ user.firstname }} {{ user.lastname }}

            </h4>
            <span>jason-porter@info.com</span>

            <div class="mt-2">
            <button class="btn btn-default btn-sm">Follow</button>
            <button class="btn btn-default btn-sm">Message</button>
            </div>
        </div>



<div class="card-body">


    <ul class="data-list is-compact">
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Gender</div>
                <div class="data-value">{{ user.gender }} </div>
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
                <div class="data-label">Telephone</div>
                <div class="data-value">{{ user.tel }} </div>
            </div>
        </li>
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Email Address</div>
                <div class="data-value text-soft">
                    {{ user.email }}
                </div>
            </div>
        </li>
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Service Number</div>
                <div class="data-value text-soft">
{{ user.number }}
                </div>
            </div>
        </li>
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Location</div>
                <div class="data-value">{{ user.location }} </div>
            </div>
        </li>
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Country</div>
                <div class="data-value">{{ user.country }} </div>
            </div>
        </li>
        <li class="data-item">
            <div class="data-col">
                <div class="data-label">Account created on</div>
                <div class="data-value">{{ user.created_at }} </div>
            </div>
        </li>

    </ul>



</div>



</div>
<div v-else>No results found</div>






</div>
<div class="col-12 col-md-3"></div>



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
title:{},
response:{}
},


computed:{
user(){
return this.response.profile;
}

}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}

.data-item{
border:none;
}
.card-body{
border:none;
}



</style>
