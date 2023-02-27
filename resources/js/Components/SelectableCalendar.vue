<template>
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Select Preffered Days</h5>
<div class="dropdown ml-4" style="float:right;">
<a href="#" class="btn btn-round btn-success" data-toggle="dropdown" aria-expanded="false"><span>
{{ dialog.change_title }}
</span><em class="icon ni ni-chevron-down"></em></a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-sm mt-1" style="">
<ul class="link-list-plain">
<li><a href="#" @click="change(false)">Calendar</a></li>
<li><a href="#" @click="change(true)">List Days</a></li>
</ul>
</div>
</div>
<slot name="exit"></slot>
</div>


<div class="modal-body" style="max-height:500px;overflow:auto" v-if="dialog.change==false">
<v-calendar :attributes="attributes" @dayclick="onDayClick" style="border:none;" is-expanded title-position="left"   :min-date="response.appointment.date" :max-date="response.appointment.end_date"/>
</div>


<div class="modal-body" style="max-height:500px;overflow:auto" v-else>
<div class="card card-bordered">
<ul class="data-list is-compact">

<li class="data-item">
<div class="data-col"><div class="data-label">Date</div></div>
<div class="data-col"><div class="data-label">Time</div></div>
</li>


<li class="data-item" v-for="l in response.clocking" :key="l.date">
<div class="data-col">
<div class="data-label">{{ l.date.split('-').reverse().join('/') }} </div>
<div class="data-value">
{{ response.appointment.from.substring(0,5) }} - {{ response.appointment.to.substring(0,5)  }}
</div>
</div>
</li>


<li v-if="response.clocking.length==0">
<p class="p-2">No days selected</p>
</li>


</ul>
</div>
</div>







<div v-if="$page.props.flash.notice!=null" class="text-success text-center p-2">{{ $page.props.flash.notice }} </div>
<div v-else-if="$page.props.flash.error" class="text-danger text-center p-2">
{{ $page.props.flash.error }}

</div>
<div class="modal-footer bg-light">
<span>
<slot name="done"></slot>
</span>
</div>
</div>
</div>
</div>

</template>
<script>
export default {
props:{
response:{}
},

data() {
return {
days:[],
//
dialog:{
change:false,
change_title:'Calendar',
},

};
},
computed: {
dates() {
return this.days.map(day => day.date);
},
attributes() {
return this.dates.map(date => ({
highlight: true,
dates: date,
}));
},



},
methods: {
onDayClick(day) {
const idx = this.days.findIndex(d => d.id === day.id);
if (idx >= 0) {
this.days.splice(idx, 1);
} else {


this.days.push({
id: day.id,
date: day.date,
});

const d=day.id;
this.submit(d);

}
},
//

submit(d){

this.$inertia.post(this.route('appointment.work_days'),
{date:d,
id:this.response.appointment.appointmentID},
{
onSuccess:()=>{
this.days=this.$page.props.response.clocking;
}
}
);
},

change(state){
if(state==true){
this.dialog.change_title='Number of Days';
this.dialog.change=true;
}else{
this.dialog.change_title='Calaneder';
this.dialog.change=false;
t
}
}




},





mounted(){
this.days=this.$page.props.response.clocking
}




}
</script>
