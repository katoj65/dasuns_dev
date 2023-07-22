<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">




<div v-if="user.length>0">
<div class="card" v-for="(u,key) in user" :key="key">
<div class="card-body text-center">
<div class="text-center">
<em class="icon ni ni-user-circle-fill" style="font-size:80px;"></em>
</div>
<h5 class="mt-3 text-transform">{{ u.firstname }} {{ u.lastname }} </h5>
<div class="text-center text-muted mb-3 text-transform">{{u.role}} </div>
<button type="button" class="btn btn-icon btn-outline-primary"><em class="icon ni ni-edit-fill"></em></button>
<button type="button" class="btn btn-icon btn-outline-danger" @click="submit1(u.id)"><em class="icon ni ni-trash-empty-fill"></em></button>
</div>

<div class="card-footer" style="border:none;">




<div class="card">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
    <div class="data-label">Gender</div>
    <div class="data-value">{{ u.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
    <div class="data-label">Date of Birth</div>
    <div class="data-value">{{ u.dob.split('-').reverse().join('/') }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
    <div class="data-label">Telephone </div>
    <div class="data-value">{{ u.tel }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
    <div class="data-label">Email </div>
    <div class="data-value" style="text-transform:lowercase;">{{ u.email }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
    <div class="data-label">Role</div>
    <div class="data-value">{{ u.role }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
    <div class="data-label">Status</div>
    <div class="data-value">{{ u.status }} </div>
</div>
</li>

</ul>
</div>










</div>

</div>
</div>
<div v-else>
No content
</div>






</div>
<div class="col-12 col-md-3"></div>
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

computed:{
user(){
return this.response.user;
}
},


methods:{
submit1(id){
this.$inertia.post(this.route('admin.destroy',{id:id}));
}




}



}
</script>
<style scoped>
button{
padding:10px;
width:50px;
}
.data-value{
text-transform: capitalize;
}
.data-item{
border:none;
}
</style>
