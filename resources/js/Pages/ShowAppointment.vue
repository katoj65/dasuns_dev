<template>
<app-layout>



<!-------------------->

<div class="row mt-2">
<div class="col-12 col-md-8">
<div class="card card-radius h-100">
<div class="card-header mb-3">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">Appointment Details</h6>
</div>
<div class="card-tools mr-n1">
<el-dropdown trigger="click">
<span class="el-dropdown-link btn">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" @click="change(true)" style="padding:10px;width:100%;">Change</a></el-dropdown-item>
<el-dropdown-item><a href="#" @click="change_edit(true)" style="padding:10px;width:100%">Add Services</a></el-dropdown-item>
<el-dropdown-item><a href="#" @click="delete_appoointment()" style="padding:10px;width:100%">Delete</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>



</div>



<div class="card-header bg-white">
<div class="card-title bg-white">
<h5 class="title">{{ response.appointment.end_date!=null?'Dates':'Date' }}: <span style="font-weight:normal;">{{ response.appointment.date.split('-').reverse().join('/') }}</span>

<span style="padding-left:50px;">
{{ response.appointment.end_date!=null?'End Date:':'' }}
{{ response.appointment.end_date!=null?response.appointment.end_date.split('-').reverse().join('/'):'' }}
</span>
</h5>
</div>
</div>


<div class="card-body">


<ul class="data-list is-compact" style="margin-top:-10px;padding:0;margin:0;">
<li class="data-item border-0">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-clock"></em> Start Time</div>
<div class="data-value">
{{ response.appointment.from.substring(0,5) }}
</div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-clock"></em> End Time</div>
<div class="data-value">
{{ response.appointment.to.substring(0,5) }}
</div>
</div>
</li>
<li class="data-item border-0">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-map-pin"></em> Location</div>
<div class="data-value text-transform">{{ response.appointment.location }}</div>
</div>
</li>
</ul>





<ul class="data-list is-compact" style="margin-top:-10px;padding:0;margin:0;">
<li class="data-item border-0">
<h4>
Service requested
</h4>
</li>

<li class="data-item border-0" v-for="other in response.services" :key="other.id">
<div class="data-col">
<div class="data-label">
<em class="icon ni ni-forward-alt-fill"></em>
{{ other.name }}
</div>
<div class="data-value" style="text-align:right;" v-if="response.services.length>1">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" class="text-danger p-1" @click="delete_service(other.id)">Delete</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
</li>
<li v-if="response.appointment.end_date!=null" class="data-item border mt-2">

<div style="width:100%;">
<div class="card">
<div class="card-title-group align-start mb-1 border-bottom pb-2">
<div class="card-title">
<h6 class="title">
<span v-if="response.clocking.length==0">{{response.number_of_days}}</span> Appointment Days
<!-- {{ response.clocking }} -->
</h6>
</div>
<div class="card-tools mt-n1 mr-n1" v-if="response.cart_status==false">
<a href="#" class=" btn-outline-light p-1" @click="calendar.show=true"><em class="icon ni ni-calender-date mr-2"></em>Select Days</a>
</div>
</div><!-- .card-title-group -->
<div class="nk-coin-ovwg">




<v-calendar is-expanded :min-date="response.appointment.date" :max-date="response.appointment.end_date" title-position="left" style="border:none;" v-if="response.clocking.length==0" />

<v-calendar :attributes="response.clocking_date_format"  is-expanded :min-date="response.appointment.date" :max-date="response.appointment.end_date" title-position="left" style="border:none;" v-else />


</div><!-- .nk-coin-ovwg -->
</div><!-- .card-inner -->
</div>


</li>


</ul>
</div>




<div class="nk-msg-item" data-msg-id="2" style="margin-top:-30px;">
<div class="nk-msg-info">
<div class="nk-msg-context">
<div class="nk-msg-text">
 <h6 class="title"><em class="icon ni ni-mail-fill"></em> Message</h6>
<p>{{ response.appointment.comment }}</p>
</div>
<div class="nk-msg-lables">
<div class="asterisk"><a class="active" href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>
</div>
</div>
</div>
</div>




</div>

</div>








<div class="col-12 col-md-4">
<div class="card h-100 card-radius">
<div class="card-header pt-2 pb-1">
<div class="card-title">
<h4>
Service Provider Details
</h4>
</div>
</div>
<div class="card-inner">
<div class="team">
<div class="team-options">

</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>
<!-- <div class="status dot dot-lg dot-success"></div> -->
</div>
<div class="user-info">
<h6 class="text-transform">{{ response.appointment.firstname +' '+response.appointment.lastname }} </h6>
<span class="sub-text pt-2">
Service No: {{ response.appointment.number }}
</span>
</div>
</div>
<ul class="team-info">
<li><span>Gender </span><span class="text-transform"> {{ ap.gender }} </span></li>
<li><span>Telephone</span><span>{{ ap.tel }} </span></li>
<li><span>Email</span><span>{{ ap.email }} </span></li>
<li><span>Country</span><span>{{ ap.country }} </span></li>
<li><span>Joined</span><span>{{ ap.joined.substring(0,10).split('-').reverse().join('/') }} </span></li>

<li class="mt-2"><span>Rating</span><span>
<el-rate></el-rate>
</span></li>




<!-- <li class="pt-2">
<div class="pt-3 border p-2">
<h4 style="display:block;">Service Provider's Statement</h4>
<p style="font-size:14px;display:block;line-height:18px;" class="text-muted pt-2">
{{ ap.about.length>100? ap.about.substring(0,200)+' ...' : ap.about }}
</p>
</div>
</li> -->





</ul>
<div class="team-view">
<Inertia-link :href="route('show.pssp',[ap.id])" class="btn btn-block btn-success"><span>View Profile</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>







</div>
</div>






















<!----------Dialog Information------->

<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit" v-if="dialog.change==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Make Appointment</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="change(false)">
<em class="icon ni ni-cross"></em>
</a>
</div>

<div class="modal-body" style="max-height:500px;overflow:auto">

<div class="row mb-3" v-if="response.appointment.end_date!=null">
<div class="col-md-6 col-12">
<div class="form-group">
<label class="form-label" for="default-01">
Start Date
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.date">
</div>
</div>
</div>
<div class="col-md-6 col-12">
<div class="form-group">
<label class="form-label" for="default-01">
End Date
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.end_date">
</div>
</div>
</div>
</div>


<!-----Appointment------>

<div class="form-group" v-else>
<label class="form-label" for="default-01">
Appointment Date
<input-error :error="errors.date"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter appointment date" v-model="form.date">
</div>
</div>




<div class="row mb-3">
<div class="col-md-6 col-12">

<div class="form-group">
<label class="form-label" for="default-01"> From Time
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

<input type="submit" class="button" value="Save changes" style="border-radius:10px"/>

</span>
</div>
</div>
</div>
</form>






<!----Add services-------->

<form class=""  v-if="dialog.edit==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit2">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Add Services to Appointment</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="change_edit(false)">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.service"></input-error>
</label>
<div class="form-control-wrap">
<select  class="form-control" id="default-01" @change="select_field($event)">
<option value="">--Select services--</option>
<option v-for="x in response.pssp_services" :key="x.id" :value="x.id">
{{ x.name }}
</option>
</select>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>







<!------Select Calendar----->
<selectable-calendar v-if="calendar.show==true" :response="response">
<template #exit>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="calendar.show=false">
<em class="icon ni ni-cross"></em>
</a>
</template>
<template #done>
<input type="submit" class="button" value="Done" style="border-radius:10px" @click="calendar.show=false;"/>
</template>
</selectable-calendar>



</app-layout>
</template>
<script>
import InputError from '@/Alerts/InputError';
import AppLayout from '@/Layouts/AppLayout';
import SelectableCalendar from '@/Components/SelectableCalendar';
import CalendarMarked from '@/Components/CalendarMarked';
export default {
components:{
AppLayout,
InputError,
SelectableCalendar,
CalendarMarked
},
props:{
title:{},
response:{},
flash:{},
errors:{},
},

data(){return{
formatted_date:[],
calendar:{range: {
start:this.response.appointment.date.split('-').join(','),
end:this.response.appointment.end_date!=null?this.response.appointment.end_date.split('-').join(','):null
},
select:null,
show:false,

},

dialog:{
change:false,
edit:false,
},
//

list:{
services:[],
service_id:[],
},


//
select_service:false,
//
service_options:null,
//
form2:this.$inertia.form(
{
service:null,
id:this.response.appointment.appointmentID,
}
),

//
form:this.$inertia.form({
date:null,
comment:null,
end_date:null,
start:null,
end:null,
location:null,
id:this.response.appointment.appointmentID,
services:[],

}),

//
form2:this.$inertia.form(
{
id:this.response.appointment.appointmentID,
service:null,
}
),


}},


//
methods:{
change(item){
this.dialog.change=item;
},
//

change_edit(state){
this.dialog.edit=state;
},







//
submit(){
this.form.post(this.route('update.appointment'),{
onSuccess:()=>{
this.dialog.change=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Error',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});

},

//

form_formation(){
this.form.date=this.response.appointment.date;
this.form.start=this.response.appointment.from;
this.form.end=this.response.appointment.to;
this.form.comment=this.response.appointment.comment;
this.form.location=this.response.appointment.location;
this.form.end_date=this.response.appointment.end_date;
const ids=[];
this.response.services.forEach(element => {
ids.push(element.id);
});
this.form.services=ids;
},

//
submit2(){
this.form2.post(this.route('appointment.add_services'),{
onSuccess:()=>{
this.dialog.edit=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Error',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottopm-right'

});
}
});
},





//
select_field(event){
this.form2.service=event.target.value;
},


//
delete_service(id){
this.$inertia.post(this.route('appointment.delete_services'),{
id:id,
appointmentID:this.response.appointment.appointmentID,
},
{
onSuccess:()=>{
this.$notify({
title:'Deleted',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}

}

);
},

//

delete_appoointment(){
this.$inertia.post(this.route('appointment.delete'),{id:this.response.appointment.appointmentID},{
onSuccess:()=>{
this.$notify({
title:'Deleted',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
});


},

//

add_cart(){
this.$inertia.post(this.route('cart.add'),{
id:this.response.appointment.appointmentID,
amount:this.response.amount_original,
currency:this.response.currency,
num_days:this.response.number_of_days,
},
{
onSuccess:()=>{
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Error',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'
});
}

});
},

//
calendar_date_formation(){
if(this.response.clocking.length!=0){
const format_array=[];
this.response.clocking.forEach(item=>{
format_array.push({dates:item.date,key: 'today',highlight: true,});
});
this.formatted_date=format_array;
}else{
this.formatted_date=[];
}
},


//
submit_remove_from_cart(){
this.$inertia.post(this.route('cart.remove'),{
id:this.response.appointment.appointmentID,
},{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'

});
}
});
}









},


//

mounted(){
this.form_formation();
this.calendar_date_formation();

},


//
computed:{
ap(){
return this.response.appointment;
},




}



}
</script>
