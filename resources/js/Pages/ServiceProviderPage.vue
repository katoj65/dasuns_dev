<template>
<app-layout>
<div class="row mt-2">
<div class="col-12 col-md-8">


<div class="card card-radius h-100" style="min-height:600px;">
    <div class="card-header" :style="'height:150px;background-image:url('+url+'images/avatar/image.jpeg);background-size:cover;background-repeat:no-repeat;border-radius:19px 20px 0 0;background-position: 0 0px;'">

    </div>

    <div class="card-inner" style="margin-top:-60px;">
        <div class="team">

        <div class="user-card user-card-s2">
        <div class="user-avatar lg bg-success" style="border:solid 3px white;width:100px;height:100px;">
        <span><em class="icon ni ni-user-alt-fill"></em></span>
        <div class="status dot dot-lg dot-success"></div>
        </div>
        <div class="user-info">
        <h2 class="text-transform mb-4 size20">{{ response.pssp.firstname +' '+ response.pssp.lastname }} </h2>






<rating-service :rating="3"></rating-service>






<div class="btn-group btn-group-lg" style="border-radius:100px;">
<button type="button" class="btn btn-success" style="border-radius:20px 0 0  20px;"><strong class="mr-1" style="color:white;">Service No:</strong> {{ response.dasuns_number }}</button>
<!-- <button type="button" class="btn btn-primary"></button> -->
<button type="button" class="btn btn-success" style="border-radius:0 20px 20px 0;border-left:solid thin white;" @click="dialog.appointment=true"><em class="icon ni ni-external-alt mr-1"></em> Request</button>
</div>



</div>
</div>









<div class="card-body p-0 m-0">
<div class="mt-4">



<div class=" pb-4">

<div class="invest-data">
<div class="invest-data-amount g-2">
<div class="invest-data-history">
<div class="title text-success bold"><em class="icon ni ni-user-check-fill"></em> Gender</div>
<div class="amount bold  text-transform">{{  response.pssp.gender }} </div>
</div>
<div class="invest-data-history">
<div class="title text-success bold"><em class="icon ni ni-calendar-booking-fill"></em> Date of Birth</div>
<div class="amount bold  text-transform"> {{ response.pssp.dob.split('-').reverse('-').join('/') }}</div>
</div>

<div class="invest-data-history">
<div class="title text-success bold"><em class="icon ni ni-mail-fill"></em> Email</div>
<div class="amount bold">{{  response.pssp.email }} </div>
</div>


<div class="invest-data-history">
<div class="title text-success bold"><em class="icon ni ni-map-pin-fill"></em> Location</div>
<div class="amount bold text-transform">{{  response.pssp.location }}, {{  response.pssp.country }} </div>
</div>
</div>

</div>


</div>







                <div class="card-inner mt-0 border-radius shadow">
                <div class="card-title-group">
                <div class="card-title">
                <h6 class="title">
                <span class="mr-5"><em class="icon ni ni-eye-fill"></em> Views</span>
                <span class="mr-5"><em class="icon ni ni-thumbs-up"></em> Recommendations</span>


                </h6>
                </div>
                <div class="card-tools">
                <a href="#"><strong class="mr-3"><em class="icon ni ni-share-fill"></em> Share</strong></a>

                <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                <em class="icon ni ni-more-h"></em>
                </span>
                <el-dropdown-menu slot="dropdown">
                <el-dropdown-item icon="el-icon-plus">Action 1</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-plus">Action 2</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-plus-outline">Action 3</el-dropdown-item>
                <el-dropdown-item icon="el-icon-check">Action 4</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-check">Action 5</el-dropdown-item>
                </el-dropdown-menu>
                </el-dropdown>

                </div>
                </div>
                </div>
                <ul class="nk-support">
                <li class="nk-support-item">
                <div class="nk-support-content">
                <div class="title">
                <span style="font-size:18px;">About</span>
                </div>
                <p v-if="response.pssp.about!=null">
                {{ response.pssp.about }}
                </p>
                <p v-else class="text-muted">
                No content
                </p>
                </div>
                </li>



                <li class="nk-support-item border-0">
                <div class="nk-support-content">
                <div class="title mb-2">
                <span style="font-size:18px;">Professional Services I provide</span>
                </div>

                <ul>
                <li  v-for="s in response.services" :key="s.id" class="mb-2 text-transform">
                    <em class="icon ni ni-check-circle-fill text-success"></em>
                {{ s.name }}

                </li>
                </ul>

                </div>
                </li>








<!-- <li class="nk-support-item border-0">
<div class="nk-support-content">
<div class="title mb-3">
<span style="font-size:18px;">Recommendations</span>
</div>
<div class="nk-msg-item current  border-radius mb-2 " data-msg-id="1" v-for="n in 4" :key="n" style="background:#F8F9F9;border:none;">
<div class="nk-msg-media user-avatar">
    <span>AB</span>
</div>
<div class="nk-msg-info">
    <div class="nk-msg-from">
        <div class="nk-msg-sender">
            <div class="name" style="font-weight:bolder;color:black;">Abu Bin Ishtiyak</div>

        </div>
        <div class="nk-msg-meta">
            <div class="attchment"><em class="icon ni ni-clip-h"></em></div>
            <div class="date">12 Jan</div>
        </div>
    </div>
    <div class="nk-msg-context">
        <div class="nk-msg-text">

            <p>Hello team, I am facing problem as i can not select currency on buy order page.</p>
        </div>

    </div>
</div>
</div>
</div>
</li> -->




                </ul>
                </div>


        </div>



        </div><!-- .team -->
        </div><!-- .card-inner -->
















</div>
</div>
<div class="col-12 col-md-4">
<div class="card card-radius">
<div class="card-header mb-0">
<div class="card-title">
<h4 class="title">Service Provider Details</h4>
</div>
</div>


<div class="block p-1 text-center">
    <div><span class="text-muted">Photos of Service Provider</span></div>
    <div class="mt-2">
        <a href="#" class="btn btn-dim btn-success"><em class="icon ni ni-folder-fill mr-2"></em> View all</a>
    </div>
  </div>




<div class="row pl-3 pr-3 mt-3">
<div class="col-md-6 mb-2" v-for="n in 4" :key="n">
<img :src="url+'images/avatar/image.jpeg'" class="border-radius"/>
</div>
</div>

</div>


<div class="card card-radius">
<div class="card-header">
<div class="card-title">
<h3>Calendar</h3>
</div>
</div>

<div class="card-body">
<chat-component></chat-component>
<calendar-component/>
</div>

</div>






</div>



</div>
















<!------Dialog---->


<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit" v-if="dialog.appointment==true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background: #37BEA7;border:none;">
    <h5 class="modal-title" style="color:white;">Make Appointment</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.appointment=false">
    <em class="icon ni ni-cross"></em>
    </a>
    </div>
    <div class="modal-body" style="max-height:500px;overflow:auto">


    <div class="mb-2" style="font-size:16px;font-weight:bold;">

    <el-alert :title="flash.warning" type="error" v-if="flash.warning!=null">
    </el-alert>


    </div>




    <div class="form-group">
    <label class="form-label" for="default-07">Select Services
    <input-error :error="errors.services"></input-error>
    </label>
    <div class="form-control-wrap">
    <div class="form-control-select-multiple">
    <select class="custom-select form-control" id="default-07"  @change="select_service($event)">
    <option value="">--Select--</option>
    <option  v-for="i in response.services" :key="i.id" :value="i.id">
    {{ i.name }}
    </option>
    </select>
    </div>
    </div>
    </div>





    <div class="row mb-3">
    <div class="col-12 col-md-6">

    <div class="form-group">
    <label class="form-label" for="default-01">
    {{ dialog.change_label }}
    <input-error :error="errors.date"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.date">
    </div>
    </div>


    </div>
    <div class="col-12 col-md-6">



    <div class="form-group" v-if="dialog.change_field==true">
    <label class="form-label" for="default-01">
    End date
    <!-- <input-error :error="errors.date"></input-error> -->
    </label>




    <div class="form-control-wrap">
    <div class="form-icon form-icon-right">
    <a href="#" class="text-warning pl-3 pr-3 text-danger" @click="end_date(false)">
    <em class="icon ni ni-cross" style="font-weight:bold;color:red;"></em>
    </a>
    </div>
    <input type="date" class="form-control" id="default-04" placeholder="End date" v-model="form.end_date">
    </div>






    </div>




    <div class="form-group" v-else>
    <label class="form-label text-center" for="default-01">
    <a href="#" class="text-warning pl-3" @click="end_date(true)">Select end date</a>
    <!-- End date -->
    <!-- <input-error :error="errors.date"></input-error> -->
    </label>
    <div class="form-control-wrap">
    <input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" disabled>
    </div>


    </div>












    </div>
    </div>








    <div class="row mb-3">
    <div class="col-md-6 col-12">

    <div class="form-group">
    <label class="form-label" for="default-01">From Time
    <input-error :error="errors.start"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="time" class="form-control" id="default-01" placeholder="Enter start time" v-model="form.start">
    </div>
    </div>

    </div>
    <div class="col-12 col-md-6">
    <div class="form-group">
    <label class="form-label" for="default-01"> To Time
    <input-error :error="errors.end"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="time" class="form-control" id="default-01" placeholder="Enter end time" v-model="form.end">
    </div>
    </div>

    </div>
    </div>




    <div class="form-group">
    <label class="form-label" for="default-01">Location
    <input-error :error="errors.location"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter appointment location" v-model="form.location">
    </div>
    </div>

    <div class="form-group mt-2">
    <label class="form-label" for="default-01">Message</label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter message" v-model="form.comment">
    </div>
    </div>







    </div>
    <div class="modal-footer bg-light">
    <span class="sub-text">
    <span class="text-danger text-center" v-if="flash.warning!=null" style="padding-right:70px;">
    {{ flash.warning }}
    </span>


    <input type="submit" class="button" value="Make appointment" style="border-radius:10px"/>



    </span>
    </div>
    </div>
    </div>
    </form>





</app-layout>
</template>

<script>
import ChatComponent from '@/Components/ChatComponent';
import RatingService from '@/Components/RatingService';
import CalendarComponent from '@/Components/CalendarComponent';
import AppLayout from '@/Layouts/AppLayout';
import InputError from '@/Alerts/InputError';
export default {
components:{
AppLayout,
InputError,
CalendarComponent,
RatingService,
ChatComponent,
},

props:{
title:{},
response:{},
flash:{},
errors:{}
},




data(){return{
//

//
dialog:{
appointment:false,
change_label:'Appointment date',
change_field:false,
},



//
form:this.$inertia.form({
date:null,
end_date:null,
start:null,
end:null,
services:null,
psspID:this.response.pssp.id,
comment:null,
location:null,
}),


}},









methods:{
submit(){
this.form.post(this.route('store.appointment'),{
onSuccess:()=>{
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'

});
}
});



},



//select service
select_service(event){
this.form.services=event.target.value;
},



//end date
end_date(status){
if(status==true){
this.dialog.change_field=true;
this.dialog.change_label="Start date";

}else{
this.dialog.change_field=false;
this.dialog.change_label="Appointment date";
}
}







},


computed:{
url(){
return this.$page.props.system.route;
}






}










}
</script>
