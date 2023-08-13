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
<button class="btn btn-default btn-sm" style="background:#37BEA7;color:white;font-weight:bold;border:none;" @click="show=true">
<em class="icon ni ni-edit"></em> Make Appointment</button>
<button class="btn btn-default btn-sm"><em class="icon ni ni-mail-fill"></em></button>

</div>
</div>

</div>
<div class="col-12 col-md-4"></div>
</div>





</div>
<div class="card-body" style="margin-top:-20px;">
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
<div class="text-muted-dark">{{ user.recommendations }}
    {{ user.recommendations>1?' People':' Person'  }}  </div>
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
            <td class="width45"><span class="avatar" style="background:#37BEA7">
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




<div class="row text-center mt-5">
    <div class="col-lg-6 border-right">
    <label class="mb-0">Rating</label>
    <h4 class="font-18">
    <rating-service :rating="user.rating" />
    </h4>
    </div>
    <div class="col-lg-6">
    <label class="mb-0">Tasks Completed</label>
    <h4 class="font-18 mt-2">{{ user.tasks_complete }} </h4>
    </div>
    </div>







</div>
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























<!------Dialog---->


<form @submit.prevent="submit"    class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="show==true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background: #37BEA7;border:none;">
    <h5 class="modal-title" style="color:white;">Make Appointment</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

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
    <option  v-for="i in user.services" :key="i.id" :value="i.id">
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
    <!-- {{ dialog.change_label }} -->
    <input-error :error="errors.date"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.date">
    </div>
    </div>


    </div>
    <div class="col-12 col-md-6">



    <div class="form-group" v-if="change_field==true">
    <label class="form-label" for="default-01">
    <input-error></input-error>
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
    <!-- <a href="#" class="text-warning pl-3" @click="end_date(true)">Select end date</a> -->
    </label>
    <div class="form-control-wrap">
    <!-- <input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" disabled> -->


<button  @click="end_date(true)" class="form-control" id="default-01">
 Select end date
</button>

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
import AppLayout from '@/Layouts/AppLayout.vue';
import RatingService from '../Components/RatingService.vue';
import CalendarComponent from '../Components/CalendarComponent.vue';
import InputError from '@/Alerts/InputError';
export default {
components:{
AppLayout,
RatingService,
CalendarComponent,
InputError

},

props:{
title:{},
response:{},
flash:{},
errors:{}
},


data(){return{
//
show:false,
change_field:false,


//
form:this.$inertia.form({
date:null,
end_date:null,
start:null,
end:null,
services:null,
psspID:this.response.profile.id,
comment:null,
location:null,
}),






}},




computed:{
user(){
return this.response.profile;
}
},






methods:{
//
select_service(event){
this.form.services=event.target.value;
},

//
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

//
end_date(status){
if(status==true){
this.change_field=true;
}else{
this.change_field=false;
}
}









},








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
