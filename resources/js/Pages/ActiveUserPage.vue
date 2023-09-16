<template>
<app-layout>


<div class="nk-content p-3">
<div class="card">
<div class="card-header">
<h3 class="card-title text-transform bold">Active Users</h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-vcenter text-nowrap mb-0">
<thead>
<tr>
<th>Names</th>
<th>Gender</th>
<th>Service Number</th>
<th>Telephone</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th></th>

</tr>
</thead>
<tbody v-if="active.length>0">
<tr v-for="(a,key) in active" :key="key">
<td class="text-transform">
<em class="icon ni ni-user-circle-fill mr-2"></em> {{ a.firstname }} {{ a.lastname }}
</td>
<td class="text-transform">
{{ a.gender }}
</td>
<td class="text-transform">
{{ a.number }}
</td>
<td class="text-transform">
 {{ a.tel }}
</td>
<td>
{{ a.email }}
</td>
<td class="text-transform">
<span v-if="a.role=='pssp'">Service Provider </span>
<span v-if="a.role=='pssu'">Service User</span>
<span v-if="a.role=='admin'">Administrator </span>
<span v-if="a.role=='panelist'"> Panelist</span>
</td>
<td class="text-transform">
{{ a.status }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td>
No content
</td>
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
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout

},

props:{
title:{},
response:{}
},


data(){return{

}},


computed:{
active(){
return this.response.active;
}




}





}
</script>
