<template>
<app-layout>
<div class="nk-content p-3">
<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Administrators</h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-vcenter text-nowrap mb-0">
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Gender</th>
<th>Telephone</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody v-if="users.length>0">
<tr v-for="(u,key) in users" :key="key">
<td>
<Inertia-link class="text-muted" :href="route('admins.show',{id:u.id})"><em class="icon ni ni-user-alt-fill"></em>
 {{ u.firstname }}
</Inertia-link>
</td>
<td>
<Inertia-link class="text-muted" :href="route('admins.show',{id:u.id})">{{ u.lastname }}</Inertia-link>
</td>
<td class="text-muted">
{{ u.gender }}
</td>
<td class="text-muted">{{ u.tel }} </td>
<td style="text-transform:lowercase;" class="text-muted">{{ u.email }} </td>
<td class="text-muted">{{ u.role }}</td>
<td><label class="tag tag-success">{{ u.status }}</label></td>
<td><button class="btn btn-danger btn-sm"><i class="icon-trash"></i></button></td>
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

//computed
computed:{
users(){
return this.response.users;
}



},
//methods



}
</script>
<style scoped>
td{
text-transform: capitalize;
}
</style>
