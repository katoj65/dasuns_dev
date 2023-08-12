<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">

<!-- {{ response }} -->
<div class="col-12 col-md-12"></div>
<div class="col-12 col-md-12">
<div class="card">
<div class="card-body">


<div class="row">
<div class="col-12 col-md-4"></div>
<div class="col-12 col-md-4">
    <div class="card">
        <div class="card-body text-center">
        <div>
        <em class="icon ni ni-user-circle-fill" style="font-size:100px;padding:10px;"></em>
        </div>
        <h3 class="mt-3 mb-0 text-transform">{{ user.firstname }} {{ user.lastname }} </h3>
        <span><strong class="mr-2">Service Number: </strong>{{ user.service_number.number }} </span>
        <ul class="mt-3 list-unstyled d-flex justify-content-center">
        <li><a class="p-3" target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="p-3" target="_blank" href="#"><i class="fa fa-slack"></i></a></li>
        <li><a class="p-3" target="_blank" href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
        <button class="btn btn-default btn-sm"><em class="icon ni ni-edit"></em> Make Appointment</button>
        <button class="btn btn-default btn-sm"><em class="icon ni ni-mail-fill"></em> Message</button>
        <div class="row text-center mt-4">
        <div class="col-lg-6 border-right">
        <label class="mb-0">Rating</label>
        <h4 class="font-18">
        <rating-service :rating="3" />
        </h4>
        </div>
        <div class="col-lg-6">
        <label class="mb-0">Tasks Completed</label>
        <h4 class="font-18">20</h4>
        </div>
        </div>
        </div>
        </div>

</div>
<div class="col-12 col-md-4"></div>
</div>





</div>
<div class="card-body">
<div class="row" style="padding:50px;padding-top:0;">
<div class="col-12 col-md-8">
<div class="card">
<div class="card-body">
<div class="row text-center">
<div class="col-lg-4 text-left p-0">
<h6 class="mb-1"><em class="icon ni ni-call"></em> Telephone</h6>
<div class="text-muted-dark">{{ user.tel }}</div>
</div>
<div class="col-lg-4 text-left p-0">
<h6 class="mb-1"><em class="icon ni ni-mail"></em> Email Address</h6>
<div class="text-muted-dark">{{ user.email }}</div>
</div>
<div class="col-lg-4 text-left p-0">
<h6 class="mb-1"><em class="icon ni ni-users"></em>Recommendations</h6>
<div class="text-muted-dark">3000 People</div>
</div>
</div>
</div>
</div>
<div>
</div>
<div class="border card">
<div class="card-header"><h6>About</h6></div>
<p class="p-3">{{ user.profile.about }}</p>


<div class="p-3">
<h6>Services</h6>
<ul>
<li v-for="(s,key) in user.services" :key="key">
<em class="icon ni ni-check-round-fill"></em> {{ s.name }}
</li>
</ul>
</div>



<table class="table card-table mt-2">
    <tbody>
        <tr>
            <td class="width45"><span class="avatar bg-success">
                <em class="icon ni ni-map-pin-fill"></em>
            </span></td>
            <td>
                <p class="mb-0 text-transform">{{user.profile.location}} </p>
                <span class="text-muted font-13 text-transform">{{user.profile.country }} </span>
            </td>

        </tr>




    </tbody>
</table>





</div>


</div>
<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title bold">Pictures</h3>
</div>
<div class="card-body">
<div>
<div class="row img-gallery">
<div class="col-6" v-for="n in 4" :key="n">
<div style="height:100px;background:silver;border-radius:5px;"></div>
</div>

</div>
</div>
</div>


<!-- <div class="card-body border card">
<calendar-component/>
</div> -->



<div class="card" style="padding:30px;padding-top:0;">
    <div class="card-header">
        <h2 class="card-title bold">Availability</h2>
    </div>
    <table class="table card-table">
        <tbody>
            <tr v-for="(n,key) in 3" :key="key">
                <td style="border:none;">Date time</td>
                <td class="text-right" style="border:none;">
                <span class="tag tag-default">65%</span>
                </td>
            </tr>


        </tbody>
    </table>
</div>






</div>

</div>

</div>
</div>
</div>
<div class="col-12 col-md-12"></div>
</div>

</div>
</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import RatingService from '../Components/RatingService.vue';
import CalendarComponent from '../Components/CalendarComponent.vue';
export default {
components:{
AppLayout,
RatingService,
CalendarComponent

},

props:{
title:{},
response:{}
},


computed:{
user(){
return this.response.profile;
}


}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}
.contact-menu ul li{
float:left;

}
</style>
