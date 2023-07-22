<template>
<div class="nk-content p-4">
<div class="row g-gs">
<div class="col-md-3" v-for="t in tabs" :key="t.id">
<div class="card  card-full h-100">
<div class="card-inner">
<div class="card-title-group align-start mb-0">
<div class="card-title">
<h6 class="subtitle">
<em :class="t.icon" style="font-size:50px;color:#07372F;"></em>
</h6>
</div>
</div>

<div class="card-amount mb-2 mt-3">
<span class="amount"><span class="currency currency-usd" style="color:#07372F;">{{ t.count }} </span>
</span>
</div>

<div class="invest-data mt-3">
<div class="invest-data-amount g-2">
<div class="invest-data-history">

<div class="amount"> <span class="currency currency-usd" style="font-size:15px;color:#07372F;">
<Inertia-link :href="route(t.url)" style="color:#07372F;"><strong>{{ t.title }} </strong></Inertia-link>
</span></div>
</div>

</div>

</div>
</div>
</div><!-- .card -->
</div>

</div>

<div class="row g-gs mt-2">
<div class="col-12 col-md-8 p-0">


<div class="card h-100" style="min-height:500px;">
<div class="card-header">
<h3 class="card-title" style="text-transform:capitalize;">Appointment Requests</h3>
<div class="card-options">
<!-- <a href="#" class="btn btn-primary btn-sm">Action 1</a>
<a href="#" class="btn btn-secondary btn-sm ml-2">Action 2</a> -->
</div>
</div>
<div class="card-body">
<table class="table card-table">
<thead>
<tr>
<th>Service Provider</th>
<th>Service Requested</th>
<th>Dates</th>
<th>status</th>
</tr>
</thead>
<tbody>
<tr v-for="(a,key) in appointments" :key="key">
<td class="text-muted text-transform">
    <em class="icon ni ni-label-fill mr-2"></em>
{{ a.firstname }} {{ a.lastname }}
</td>
<td class="text-muted">
<ul v-if="a.service.length>0">
<li v-for="(l,key) in a.service" :key="key">
<Inertia-link class="text-muted" :href="route('appoitment.show',{id:a.id})">{{ l.name }}</Inertia-link>
</li>
</ul>
<div v-else>
No service
</div>
</td>
<td class="text-muted">
{{ a.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td class="text-muted text-transform">
{{ a.status }}
</td>
</tr>

</tbody>
</table>









</div>
</div>






</div>
<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title">Panel with custom buttons</h3>

</div>
<div class="card-body">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
</div>
</div>




</div>
</div>








</div>
</template>
<script>
export default {
props:{
response:{},
},
data(){return{
tabs:[
{icon:'icon ni ni-users-fill',title:'TOTAL ACTIVE USERS',count:this.response.user_data.statistics.count_user,id:1,url:'admin.accounts'},
{icon:'icon ni ni-user-list-fill',title:'SERVICE PROVIDERS',count:this.response.user_data.statistics.count_PSSP,id:2,url:'service.providers'},
{icon:'icon ni ni-shield-check-fill',title:'ADMIN ACCOUNTS',count:this.response.user_data.statistics.count_admin,id:3,url:'admin.accounts'},
{icon:'icon ni ni-swap-alt-fill',title:'REGISTERED SERVICES',count:this.response.user_data.statistics.count_services,id:4,url:'admin.accounts'},
],

positions:this.response.user_data.get_pssp_services,



}},


computed:{
appointments(){
return this.response.user_data.appointments;
}




}


}
</script>
<style scoped>
table tr td{
padding:10px;
}

table tr td ul li{
padding:0;
margin:0;
}
table tr td ul{
    padding:0;
    margin:0;
    }


</style>
