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

<el-card style="text-align:center;padding:0px;border-radius:10px;">
<!-- <div style="text-align:center;margin-right:25%;margin-left:25%;">
<div class="nk-activity-media user-avatar" style="background:#0B5345;">
<img :src="route+s.icon" alt="" style="padding:0px;border-radius:0;margin:40px;"></div>
</div>
<div style="padding: 5px;" class="text-center">
<span class="text-transform" style="font-size:16px;font-weight:bold;">{{ s.name }} </span>
</div> -->


<div class="user-card user-card-s2">
<div class="user-avatar md"  style="background:#0B5345;padding:10px;">
<img :src="route+s.icon" alt="" style="border-radius:0;padding:0px;">

</div>
<div class="user-info">
<h6>{{ s.name }}</h6>
<!-- <span class="sub-text">@ashley</span> -->
</div>
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

data(){return{
route:this.$page.props.system.route,


}},

computed:{
services(){
return this.response.services;
}




}





}
</script>
