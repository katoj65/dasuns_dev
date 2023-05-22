<template>
<app-layout>
    <div class="mt-2 mb-2">
        <div class="nk-block-head nk-block-head-sm mb-2">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title"><em class="icon ni ni-view-x6"></em>
                    <span class="text-transform">{{ response.service_requested }}</span>  in <span class="text-transform">{{ response.location }}</span></h3>
                    <div class="nk-block-des text-soft">

                    </div>
                </div><!-- .nk-block-head-content -->

            </div><!-- .nk-block-between -->
        </div>





    <div class="row">
    <div class="col-md-3 mb-4" v-for="p in providers" :key="p.id">

        <div class="card  border-radius mb-4">
            <div class="card-inner">
            <div class="team">

            <div class="user-card user-card-s2">
            <div class="user-avatar lg bg-success-dim">
            <span><em class="icon ni ni-user-alt-fill"></em></span>
            <!-- <div class="status dot dot-lg dot-success"></div> -->
            </div>
            <div class="user-info">
            <h6 class="mb-2 text-transform">
            {{ p.firstname }} {{ p.lastname }}

            </h6>
            <span class="sub-text">Service No: {{ p.number }} </span>
            </div>
            </div>
            <ul class="team-info mt-0">
            <li><span>Gender</span><span class="text-transform">{{ p.gender }} </span></li>
            <!-- <li><span>Contact</span><span>+88 01713-123656</span></li>
            <li><span>Email</span><span>info@softnio.com</span></li> -->
            </ul>
            <div class="team-view">
            <Inertia-link :href="route('show.pssp',[p.id])" class="btn btn-block btn-dim btn-success">
            <span>View Profile</span></Inertia-link>
            </div>
            </div><!-- .team -->
            </div><!-- .card-inner -->
            </div>


            </div>
            </div>
    </div>

















    </div>







    </div>
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue'
export default {
components: { AppLayout },
props:{
title:{},
response:{}
},
data(){
return{


}
},


computed:{
providers(){
return this.response.pssp;
}




}

}
</script>
