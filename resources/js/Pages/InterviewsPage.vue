<template>
<app-layout>
<div class="nk-content p-3">



<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Interviews </h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>

<th>Names</th>
<th>Service Number</th>
<th>Date</th>
<th>time</th>
<th>Comment</th>

</tr>
</thead>
<tbody v-if="interviews.length>0">
<tr v-for="(i,key) in interviews" :key="key">
<td class="text-transform">
<Inertia-link class="text-black" :href="route('interview',{id:i.interviewID})">

{{ i.firstname }} {{ i.lastname }}

</Inertia-link>
</td>
<td>{{ i.number }} </td>
<td>
{{ i.date }}
</td>
<td>
{{ i.time }}
</td>
<td>
{{ i.comment }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="4">No content</td>
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
import AppLayout from '../Layouts/AppLayout.vue';

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


computed:{
interviews(){
return this.response.interviews;
}



}



}
</script>
