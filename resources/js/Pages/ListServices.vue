<template>
<layout-un-auth>

<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">

<div class="row">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">
<h3 class="text-center mb-3" style="font-size:30px;">
<span>Support </span>
<span style="color:#1ee0ac;">Services</span>
</h3>
<div class="row mt-5">
<div class="col-12 col-md-4" v-for="s in services" :key="s.id" style="margin-bottom:10px;">

<el-card :body-style="{ padding: '0px',margin:'10px' }">
<img src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png" class="image">
<div style="padding: 14px;">
<span class="text-transform" style="font-size:16px;">{{ s.name }} </span>
</div>
</el-card>


</div>
</div>
</div>
<div class="col-12 col-md-2"></div>
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
services(){
return this.response.services;
}




}





}
</script>
