<template>
<app-layout>

<div class="row mt-4">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">

<div class="card">
<div class="card-header">
<div class="card-title bold">
Appointment
</div>


<div class="card-options">
Created on <span class="ml-3">{{ appointment.created_at.substring(0,7).split('-').reverse().join('/') }}</span>
</div>



</div>

<div class="card-body">













<ul class="data-list is-compact">
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Appointment Start Date</div>
            <div class="data-value">{{ appointment.date.split('-').reverse().join('/') }} </div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">End Date</div>
            <div class="data-value">{{ appointment.end_date.split('-').reverse().join('/') }}</div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Service Requested</div>
            <div class="data-value">{{ appointment.service }} </div>
        </div>
    </li>
    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Time </div>
            <div class="data-value"><span class="mr-3">{{ appointment.from.substring(0,5) }}</span> - <span class="ml-3">{{ appointment.to.substring(0,5) }}</span> </div>
        </div>
    </li>

  <li class="data-item">
        <div class="data-col">
            <div class="data-label">Location</div>
            <div class="data-value text-transform">{{ appointment.location }} </div>
        </div>
    </li>



    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Comment </div>
            <div class="data-value text-transform">{{ appointment.comment }} </div>
        </div>
    </li>
      <li class="data-item">
        <div class="data-col">
            <div class="data-label">Service Provder Name </div>
            <div class="data-value text-transform">{{ appointment.firstname }} {{ appointment.lastname }} </div>
        </div>
    </li>


    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Telephone Number</div>
            <div class="data-value">{{ appointment.tel }} </div>
        </div>
    </li>


    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Email Eddress </div>
            <div class="data-value">{{ appointment.email }} </div>
        </div>
    </li>


    <li class="data-item">
        <div class="data-col">
            <div class="data-label">Gender</div>
            <div class="data-value text-transform">{{ appointment.gender }} </div>
        </div>
    </li>



        <li class="data-item">
        <div class="data-col">
            <div class="data-label">Date of Birth </div>
            <div class="data-value">{{ appointment.dob.split('-').reverse().join('/') }} </div>
        </div>
    </li>

        <li class="data-item">
        <div class="data-col">
            <div class="data-label">Status</div>
            <div class="data-value text-transform">
                <button type="button" class="btn btn-primary bold" style="font-size:18px;">
                {{ appointment.status=='payment'?'Make payment':appointment.status }}
                </button>

            </div>
        </div>
    </li>




</ul>








</div>

</div>

</div>
<div class="col-12 col-md-2"></div>
</div>
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
appointment(){
return this.response.appointment;
},




}



}
</script>
