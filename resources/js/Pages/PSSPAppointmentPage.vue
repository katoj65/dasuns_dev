<template>
    <AppLayout>
    <div class="nk-block pt-0">
    <div class="section-body mt-3 mb-3">
    <div class="container-fluid">









    <div class="card">
    <div class="card-header">
    <h3 class="card-title bold">Appointments</h3>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover table-striped text-nowrap table-vcenter mb-0">
    <thead>
    <tr>
    <th>Service Requested</th>
    <th>Date</th>
    <th>Time</th>
    <th>Location</th>
    <th>Telephone</th>
    <th>Service Number</th>
    <th>Amount</th>
    </tr>
    </thead>


    <tbody v-if="appointments.length>0">
    <tr v-for="(r,key) in appointments" :key="key">
    <td><Inertia-link :href="route('request.show',{id:r.id})" class="text-black">
        {{ r.name }}
    </Inertia-link></td>
    <td>
    {{ r.date.split('-').reverse().join('/') }} - {{ r.end_date!=null?r.end_date.split('-').reverse().join('/'):null }}
    </td>
    <td>{{ r.from.substring(0,5)}} - {{r.to.substring(0,5)}}</td>
    <td>{{ r.location }} </td>
    <td>{{ r.tel }}</td>
    <td>{{ r.number }} </td>
    <td>
    {{ r.amount }}
    </td>
    </tr>
    </tbody>
    <tbody v-else>
    <tr>
    <td colspan="4">No requests</td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>















    </div>
    </div>
    </div>
    </AppLayout>
    </template>
    <script>
    import AppLayout from '@/Layouts/AppLayout';
    import CalendarComponent from '@/Components/CalendarComponent';

    export default {
    components:{
    AppLayout,
    CalendarComponent
    },

    props:{
    title:{},
    response:{},
    },




    computed:{
    //pending

    appointments(){
    return this.response.appointments;
    },




    },








    methods:{
    //
    items(){
    return 111;
    }



    }






    }
    </script>

    <style scoped>
    table {
    border-left:none;
    }

    table tbody tr td, table thead tr{
    border-bottom:none ;
    border-top:none;
    }
    table thead, table tbody{
    border:none;
    }
    table td, table th{
    padding:10px;
    }

    table tbody tr:hover{
    background:#F8F9F9;
    }
    table td{
    text-transform: capitalize;
    }


    </style>
