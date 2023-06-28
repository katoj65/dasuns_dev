<template>
<app-layout>
<div class="row m-2 pt-2">
<div class="col-12 col-md-8">


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Appointments </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-tranx">


                    <!-- <thead>

                    <tr>

                    <th class="tb-tnx-info">
                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                    <span>Service requested</span>
                    </span>
                    <span class="tb-tnx-date d-md-inline-block d-none">
                    <span class="d-md-none">Date</span>
                    <span class="d-none d-md-block">
                    <span>Date</span>
                    <span>Time</span>
                    </span>
                    </span>
                    </th>
                    <th class="tb-tnx-amount is-alt">
                    <span class="tb-tnx-total">Amount</span>
                    <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                    </th>
                    <th class="tb-tnx-action">
                    <span>&nbsp;</span>
                    </th>
                    </tr>

                    </thead> -->



                    <tbody v-if="appointments.length>0">
                    <tr class="tb-tnx-item" v-for="a in appointments" :key="a">
                    <td class="tb-tnx-info">
                    <div class="tb-tnx-desc">
                    <span class="title text-transform">
                    <em class="icon ni ni-check-circle-fill text-success mr-2" v-if="a.status=='accepted'"></em>
                    <em class="icon ni ni-alert-circle-fill  text-warning mr-2" v-else></em>

                    {{ a.name }} </span>
                    </div>
                    <div class="tb-tnx-desc text-muted">
                    <span class="date">{{ a.date.split('-').reverse().join('/') }} </span>
                    <span class="date ml-2">
                    <em class="icon ni ni-clock text-muted"></em>
                    {{ a.from.substring(0,5) }}</span>
                    <span class="date ml-2">{{ a.to.substring(0,5) }} </span>
                    </div>
                    </td>


                    <td class="tb-tnx-amount is-alt" style="width:100px;">
                    <div class="tb-tnx-status">
                    <span class="badge text-transform" v-if="a.status=='pending'" style="color:black;">{{ a.status }} </span>
                    <span class="badge text-transform" v-else-if="a.status=='accepted'" style="color:black;">{{ a.status }} </span>
                    </div>
                    </td>

                    <td class="tb-tnx-action">
                    <div class="dropdown">
                    <a class="text-soft dropdown-toggle btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                    <ul class="link-list-plain">
                    <li><a href="#" @click="show_appointment(a)">View</a></li>
                    <li><a href="#">Remove</a></li>
                    </ul>
                    </div>
                    </div>
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
<div class="col-12 col-md-4">

    <div class="card">
        <div class="card-inner d-flex flex-column">
        <div class="card-title-group mb-3">
        <div class="card-title">
        <h2 class="title" style="font-size:18px;">Calendar </h2>
        <!-- <p>View transaction details</p> -->
        </div>
        </div>

        <calendar-component/>
        </div>
        </div>
</div>








</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CalendarComponent from '@/Components/CalendarComponent.vue';
export default {
components:{
AppLayout,
CalendarComponent
},


props:{
response:{},
title:{},
},




data(){
return{
dialog:{
state:false,
appointment:null,
},

calendar:{
state:false,
},



}},


computed:{
appointments(){
return this.response.appointments;
},




},


methods:{
show_appointment(a){
this.dialog.appointment=a;
this.dialog.state=true;
},

show_calendar(){
if(this.calendar.state==false){
this.calendar.state=true;
}else{
this.calendar.state=false;
}
},







}








}
</script>

<style scoped>
table tr td{
padding:10px;
}

.data-list li{
border:none;
}






</style>
