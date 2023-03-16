<template>
<app-layout>
<el-card style="min-height:600px;" shadow="never" class="mt-1">
<div class="row p-4">
<div class="col-12 col-md-3"></div>

<div class="col-12 col-md-6">
<el-card shadow="never" class="mt-2">
<div slot="header" class="clearfix text-center">
<h3>User Settings </h3>
</div>
<div class="card-body pt-0">

<ul class="data-list is-compact">
<li class="data-item" v-for="m in menu" :key="m.item">
<div class="data-col">
<div class="data-label text-transform">{{ m.item }} </div>
<div class="data-value">
<span v-if="m.item=='email'">{{ m.value }}</span>
<span v-else class="text-transform">

<span v-if="m.value=='change'">
<button class="btn btn-dim btn-primary">Change Password</button>
</span>
<span v-else-if="m.value=='deactivate'">
<button class="btn btn-dim btn-danger">Deactivate Account</button>
</span>
<span v-else>
{{ m.value }}
</span>

</span>
</div>
</div>
</li>

</ul>






</div>
</el-card>
</div>
<div class="col-12 col-md-3"></div>
</div>
</el-card>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
components:{
AppLayout,
},

computed:{
menu(){
const user=this.$page.props.auth.user;
let role=user.role;
if(role=='pssp'){
role='Service Provider';
}else if(role=='pssu'){
role='Service User';
}else if(role=='reception'){
role='Receptionist';
}else{
role=user.role;
}

const item=[
{id:1,item:'User names',value:user.firstname+' '+user.lastname},
{id:2,item:'email',value:user.email},
{id:3,item:'Telephone Number',value:user.tel},
{id:4,item:'Designation',value:role},
{id:5,item:'Date of Birth',value:user.dob.split('-').reverse().join('/')},
{id:6,item:'Gender',value:user.gender},
{id:7,item:'Account Type',value:user.account_type},
{id:8,item:'Account Status',value:user.status},
{id:9,item:'Password',value:'change'},
{id:10,item:'Deactivate Account',value:'deactivate'}

];




return item;

}






}





}
</script>
