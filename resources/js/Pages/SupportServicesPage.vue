<template>
<app-layout>
<div class="mt-2">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><em class="icon ni ni-view-x6"></em> Support Services</h3>
                <div class="nk-block-des text-soft">

                </div>
            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->
    </div>





<div class="row">
<div class="col-md-3 mb-4" v-for="s in service" :key="s.id">

    <div class="card card-radius">
        <div class="card-inner">
            <div class="team">

                <div class="user-card user-card-s2">
                    <div class="user-avatar lg bg-success">
                        <span style="padding:20px;"><img :src="url+s.icon"/> </span>

                    </div>
                    <div class="user-info">
                        <h6 class="text-transform">{{ s.name }} </h6>
                        <span class="sub-text mt-2">UI/UX Designer</span>
                    </div>
                </div>
                <!-- <ul class="team-info">
                    <li><span>Join Date</span><span>24 Jun 2015</span></li>

                </ul> -->

            </div><!-- .team -->
        </div><!-- .card-inner -->
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
    response:{},
    },
    data(){return{


    }},


    //computed method
computed:{
service(){
return this.response.service;
},
url(){
return this.$page.props.system.route ;
}



    }







    }
    </script>
