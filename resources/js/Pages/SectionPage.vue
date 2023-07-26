<template>
<app-layout>
<div class="nk-content p-3">




<div class="row">

<div class="col-12 col-md-12">


    <div class="card">
        <div class="card-header">
        <h3 class="card-title text-transform">Sections</h3>
        <div class="card-options">
        <a href="#" class="btn btn-primary">Add Content</a>
        </div>
        </div>


        <div class="card-body" v-if="section.length>0">



            <ul class="recent_comments list-unstyled">
                <li v-for="(s,key) in section" :key="key">

                    <div class="comment_body">
                        <h6>{{s.title}}  <small class="float-right">{{s.created_at.substring(0,10)}} </small></h6>
                        <p>{{s.description}} </p>
                        <div>
                            <span class="tag tag-success text-transform">{{s.tag }} </span>
                            <a href="javascript:void(0);"><i class="icon-bubbles"></i></a>
                            <a href="javascript:void(0);"><i class="icon-trash"></i></a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <div v-else class="p-5">No content</div>
        </div>





</div>
</div>












</div>
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout
},

props:{
title:{},
response:{}
},

computed:{
section(){
return this.response.section;
}



}




}
</script>
