<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">



<div class="col-12 col-md-12">




    <div class="card">
        <div class="card-header">
            <h6 class="card-title bold">Tasks</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                    <th>Support Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Telephone</th>
                    <th>Service Provider</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody v-if="tasks.length>0">
                    <tr  v-for="a in tasks" :key="a">
                    <th scope="row">
                    <Inertia-link :href="route('appoitment.show',{id:a.id})" class="text-black">
                        <em class="icon ni ni-check-circle-fill text-success mr-2" v-if="a.status=='accepted'"></em>
                        <em class="icon ni ni-alert-circle-fill  text-warning mr-2" v-else></em>
                        {{ a.name }}


                    </Inertia-link>
                    </th>
                    <td>
                        {{ a.date.split('-').reverse().join('/') }}
                    </td>
                    <td><em class="icon ni ni-clock text-muted"></em>
                        {{ a.from.substring(0,5) }}
                        <span class="date ml-2">{{ a.to.substring(0,5) }}</span> </td>
                    <td>
                    {{ a.location }}
                    </td>
                    <td>
                        {{ a.tel }}
                    </td>
                    <td class="text-transform">
                    {{ a.firstname  }} {{ a.lastname }}
                    </td>
                    <td>
                        {{ a.status }}
                    </td>
                    </tr>

                    </tbody>
                    <tbody v-else>
                    <tr>
                    <td colspan="6">No content</td>
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
tasks(){
return this.response.task;
}

}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;





}
</style>
