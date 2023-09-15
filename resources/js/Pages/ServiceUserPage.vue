<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">





<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h6 class="card-title bold">Service User </h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>

<th>FIRST NAME</th>
<th>LAST NAME</th>
<th>GENDER</th>
<th>SERVICE NUMBER</th>
<th>TELEPHONE</th>
<th>EMAIL ADDRESS</th>

</tr>
</thead>
<tbody v-if="response.users.length>0">
<tr v-for="(u,key) in response.users" :key="key">

<td class="text-transform">
<Inertia-link :href="route('user.profile',{id:u.id})" class="text-black">{{ u.firstname }}</Inertia-link>
</td>
<td class="text-transform">
<div v-if="u.lastname=='none'">
</div>
<div v-else>
<Inertia-link :href="route('user.profile',{id:u.id})" class="text-black">{{ u.lastname }}</Inertia-link>
</div>
</td>
<td class="text-transform">{{ u.gender }} </td>
<td>{{ u.number}} </td>
<td>{{ u.tel }} </td>
<td>{{ u.email }} </td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="5">No results</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>














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

}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;





}
</style>
