
<template>

<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid"  style="background:#07372F;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="row g-gs" style="margin:300px;padding-top:30px;padding-bottom:30px;">
<div class="col-md-3 col-12"></div>
<div class="col-md-6 col-12">
<h1 style="text-align:center;color:white;text-shadow: 0px 0px 1px black;font-weight:bolder;font-size:30px;word-spacing:5px;line-height:50px;font-family: Arial, Helvetica, sans-serif;">
Professional Care Support Services for Persons with <span style="color:yellow;">Disabilities</span>
</h1>
</div>
<div class="col-md-3 col-12"></div>
</div>


<div class="row g-gs" style="padding-bottom:30px;">
<div class="col-md-4" v-for="s in response.services" :key="s.name">



<div class="card border-none shadow-none" style="text-align:center;border-radius:12px;" id="item">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div style="text-align:center;width:100%;padding-left:33%;">
<!-- <em class="icon ni ni-puzzle-fill" style="color:yellow;font-size:50px;"></em> -->
<img :src="$page.props.system.route+s.icon" style="width:70px;"/>
</div>
</div>
<div style="text-align:center;width:100%;margin-top:30px;">
<h3 style="color:white;font-size:20px;font-weight:bold;" class="text-transform">
{{ s.name }}
</h3>
<!-- <div style="color:#48C9B0;padding:10px;font-size:16px;">
{{ s.providers<2?s.providers+' Service Provider':s.providers+' Service Providers' }}
</div> -->
</div>

</div>
</div>





<!-- .card -->
</div><!-- .col -->





</div>

</div>
</div>
</div>
</div>








<div class="nk-content nk-content-lg nk-content-fluid border-top" style="background:white;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">


<div class="row">
<div class="col-12 col-md-12">
<h1 style="text-align:center;font-size:30px;font-weight:bolder;font-family: Arial, Helvetica, sans-serif;line-height:50px;color:black;">
How to find a Support Service Provider in <br/>
3 Easy Steps
</h1>
</div>
</div>




<div class="nk-block" style="margin-top:70px;">
<div class="row g-gs">

<div class="col-md-4" v-for="i in instruct" :key="i.id">
<div class="card card-full" style="box-shadow: 0px 0px 20px #E5E7E9;border-radius:15px;">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div style="text-align:center;width:100%;">
<em :class="i.icon" style="color:#0B5345;font-size:50px;"></em>
</div>
</div>

<div style="text-align:center;margin-top:20px;padding-top:20px;">
<h3 class="amount" style="font-weight:bolder;font-size:24px;color:#0B5345;">
{{ i.id }} .
{{ i.title }}
</h3>
<p style="margin-top:15px;  font-family: Sans-serif;font-size:16px;">
{{ i.description }}
</p>
</div>




</div>
</div><!-- .card -->
</div><!-- .col -->

</div>


<div class="row g-gs">
<div class="col-12 col-md-12" style="text-align:center;">
<div style="padding:20px;">
<Inertia-link :href="route('login')" class="btn btn-lg btn-primary text-center" style="border-radius:50px;padding:15px;text-align:center;padding-left:100px;padding-right:100px;background:#45B39D;border:none;"><div style="text-align:center;font-size:20px;">Get Started</div></Inertia-link>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>








<div class="nk-content nk-content-lg nk-content-fluid" style="background:white;margin-top:-20px;">
<div class="container-xl wide-lg" style="border-top:solid 1px #F2F3F4;padding-top:30px;">
<div class="nk-content-inner">
<div class="nk-content-body">


<div class="row">
<div class="col-12 col-md-12">
<h1 style="text-align:center;font-size:30px;font-weight:bolder;font-family: Arial, Helvetica, sans-serif;line-height:50px;color:black;">
Testimonials, from people who are <br/>already using Dasuns
</h1>
</div>
</div>




<div class="row" style="margin-top:50px;">
<div class="col-lg-6" v-for="r in response.recommendation" :key="r.id">
<div class="card " style="box-shadow: 0px 0px 20px #E5E7E9;border-radius:15px;margin-bottom:30px;">
<img :src="image_route+r.image" style="border-radius: 5px 5px 0 0"/>
<div class="card-inner">
<p class="card-text" style="padding:5px;font-size:18px;">
<i>" {{ r.message }}  ".</i>
</p>
<h1 class="card-title" style="font-weight:bolder;font-size:25px;padding:5px;">
{{ r.names }}
</h1>
<h5 class="card-title" style="padding:5px;font-size:16px;color:#A6ACAF;font-weight:bold;">
{{ r.position }}
</h5>
</div>
</div>
</div>
</div>




</div>
</div>
</div>
</div>












<div class="nk-content nk-content-lg nk-content-fluid" style="background:white;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body" style="padding-top:30px;padding-bottom:30px; border-top:solid 1px #F2F3F4;">
    <h1 style="text-align:center;font-size:30px;font-weight:bolder;font-family: Arial, Helvetica, sans-serif;line-height:50px;color:black;">
     Our Supporters
        </h1>
<div class="row mt-5 pt-3">
<div class="col-2" v-for="p in response.partner " :key="p.id" style="text-alin:center;">
<a :href="p.url" :title="p.name">
<img :src="image_route+p.logo" style="width:150px;"/>
</a>
</div>
</div>

</div>
</div>
</div>
</div>






</layout-un-auth>
</template>
<script>

import LayoutUnAuth from '@/Layouts/LayoutUnAuth';

export default{
components:{
LayoutUnAuth

},

props:{
response:{},
title:{},

},




data(){
return{

url:this.$page.props.system.details.website,
partners:this.$page.props.system.partners,
image_route:this.$page.props.system.route,

instruct:[
{id:1, title:'Create an Account',
description:'Take a few minutes to create an account on Dasuns platform that you will use to contact your service provider.',
icon:'icon ni ni-user-circle'},

{id:2, title:'Create an Account',
description:'Select the type of support you need from our listed categories. If you need something unique, contact us',
icon:'icon ni ni-shield-check'},

{id:3, title:'Create an Account',
description:'Choose a service provider from the selected service category and place your booking through Dasuns Platform.',
icon:'icon ni ni-chat'}
],



}
},



computed:{
partner(){
return this.response.partner;
}




}











}

</script>
<style scoped>
#item {
    background:#148F77;
    height: 230px;
  }


  #item:hover {

    background:#45B39D  ;
      }



</style>
