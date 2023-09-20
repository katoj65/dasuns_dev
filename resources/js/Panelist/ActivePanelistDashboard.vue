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
</div>
</div>
</div>

<div class="row g-gs">
<div class="col-12 col-md-8">

<!-- {{ response.interviews }} -->


<div class="card">
<div class="card-header">
<div class="card-title">
<h6>Interviews</h6>
</div>
</div>
<div class="card-body">




<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>

    <th>Date</th>
    <th>Time</th>
    <th>Names</th>
    <th>Created at</th>
</tr>
</thead>
<tbody v-if="response.interviews.length>0">
<tr v-for="(i,key) in response.interviews" :key="key">
<td><Inertia-link :href="route('interview',{id:i.id})" class="text-black"> {{ i.date.split('-').reverse().join('/') }}</Inertia-link> </td>
<td><Inertia-link :href="route('interview',{id:i.id})" class="text-black">{{ i.time.substring(0,5) }}</Inertia-link> </td>
<td> <Inertia-link :href="route('interview',{id:i.id})" class="text-black">
    {{ i.firstname }} {{ i.lastname }}
</Inertia-link> </td>
<td>
{{ i.created_at.substring(0,10).split('-').reverse().join('/') }}
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="3">
No interviews
</td>
</tr>
</tbody>
</table>
</div>










</div>
</div>








</div>
<div class="col-12 col-md-4">

    <div class="card">
        <div class="card-header">
        <div class="card-title">
        <h6>Approved Interviews</h6>
        </div>
        </div>
        <div class="card-body"></div>
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



}},






computed:{
tabs(){
return [
{icon:'icon ni ni-users-fill',title:'TOTAL ACTIVE USERS',count:this.response.statistics.count_user,id:1,url:'users.active'},
{icon:'icon ni ni-user-list-fill',title:'SERVICE PROVIDERS',count:this.response.statistics.count_PSSP,id:2,url:'service.providers'},
{icon:'icon ni ni-shield-check-fill',title:'ADMIN ACCOUNTS',count:this.response.statistics.count_admin,id:3,url:'admin.accounts'},
{icon:'icon ni ni-user-check-fill',title:'SERVICE USERS',count:this.response.statistics.count_service_users,id:4,url:'service.users'}];
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
