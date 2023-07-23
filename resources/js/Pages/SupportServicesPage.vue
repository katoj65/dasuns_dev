<template>
<app-layout>
<div class="nk-content p-3">


<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Support Services </h3>
<div class="card-options" v-if="role=='admin'">
<div class="input-group">
<button class="btn btn-sm btn-default" type="submit">Add</button>
</div>
</div>
</div>








<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>

<th colspan="2">PROFESSION SERVICE</th>
<!-- <th>LAST NAME</th>
<th>USERNAME</th> -->
</tr>
</thead>
<tbody v-if="service.length>0">
<tr v-for="(s,key) in service" :key="key">

<td>
<Inertia-link class="text-muted">
<em class="icon ni ni-caret-right-fill"></em> {{ s.name }}
</Inertia-link>
</td>
<td style="width:50px;" v-if="role=='admin'">
<a href="#"  style="padding:0;margin:0;" class="text-muted">
<em class="icon ni ni-trash-empty-fill" style="font-size:16px;"></em>
</a>
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="5">No content</td>
</tr>
</tbody>
</table>
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
},

role(){
return this.$page.props.auth.user.role;
}



}







}
</script>


<style scoped>
input{
padding:5px;
height:35px;
border-radius:30px;
}
button{
height:35px;
padding:10px;
}
</style>
