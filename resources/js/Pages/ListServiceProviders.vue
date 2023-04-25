<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
    <div class="container-xl wide-lg">
    <div class="nk-content-inner">
    <div class="nk-content-body">

        <h3 class="text-center mb-3" style="font-size:30px;">
            <span>Service</span>
            <span style="color:#1ee0ac;">Providers</span>
            </h3>





    <div class="row mt-5">


<div class="col-12 col-md-3" v-for="p in pssp" :key="p.id">





<el-card :body-style="{ padding: '0px' }" style="border-radius:10px;">
<div class="card-inner">
<div class="team">

    <div class="user-card user-card-s2">
        <div class="user-avatar md bg-success">
            <em class="icon ni ni-user-alt-fill" style="font-size:30px;"></em>

        </div>
        <div class="user-info">
            <h6>{{ p.firstname }} {{ p.lastname }} </h6>
            <span class="sub-text">{{ p.email }} </span>
        </div>
    </div>
    <div class="team-details">
        <p>I am an UI/UX Designer and Love to be creative.</p>
    </div>

    <div class="team-view mt-2">
        <a href="html/user-details-regular.html" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
    </div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>










</div>





</div>
</div>
</div>
</div>
</div>
</layout-un-auth>
</template>
<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth.vue';
export default {
components:{
LayoutUnAuth
},
props:{
title:{},
response:{}
},




computed:{
pssp(){
return this.response.pssp;
}




}





}
</script>
