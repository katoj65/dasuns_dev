<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">
<div class="col-md-3 col-12"></div>
<div class="col-md-6 col-12">



<div class="card" v-if="request!=null">
<div class="card-header">
<div class="card-title">
<h6 class="bold">Appointment Request</h6>
</div>
<div class="card-options">
    <em class="icon ni ni-check-circle-fill" style="color:#45B39D;font-size:30px;" v-if="request.status=='accepted'"></em>
    <em class="icon ni ni-alert-circle-fill"  style="font-size:30px;" v-else-if="request.status=='paid'"></em>
    <em class="icon ni ni-alert-circle-fill"  style="color:red;font-size:30px;" v-else></em>
</div>
</div>


<div class="card-body">



<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Request</div>
<div class="data-value text-transform">{{ request.name }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date</div>
<div class="data-value">{{ request.date.split('-').reverse().join('/') }} <span class="ml-2 mr-2"> - </span> {{ request.end_date!=null?request.end_date.split('-').reverse().join('/'):null }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Time</div>
<div class="data-value">{{ request.from.substring(0,5) }} - {{ request.to.substring(0,5) }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Service Number</div>
<div class="data-value text-soft">
{{ request.number }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone </div>
<div class="data-value">{{ request.tel }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">E-mail Address</div>
<div class="data-value">{{ request.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Client Name</div>
<div class="data-value text-transform">{{ request.firstname }} {{ request.account_type=='personal'?request.lastname:null }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Client Date of Birth</div>
<div class="data-value text-transform">{{ request.dob.split('-').reverse().join('/') }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Location of Appointment </div>
<div class="data-value text-transform">
{{ request.location }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Comment</div>
<div class="data-value text-transform"><i>{{ request.comment }}</i> </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Amount Paid</div>
<div class="data-value text-break">
{{ request.amount }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Requested On</div>
<div class="data-value">
{{ request.created_at.substring(0,10).split('-').reverse().join('/') }}
</div>
</div>
</li>
<li class="data-item" v-if="request.status!='paid'">
<div class="data-col">
<div class="data-label">Status</div>
<div class="data-value text-transform">{{ request.status }} </div>
</div>
</li>
</ul>

</div>

<div class="card-footer">
<div>
<div v-if="request.status=='paid'" class="float-right">
<button class="btn button-success" style="font-size:16px;" @click="submit(request.id,'accepted')">Accept</button>
<button class="btn button-danger"  style="font-size:16px;" @click="submit(request.id,'declined')">Decline</button>
</div>
<div v-else-if="request.status=='accepted'" class="float-right">
<button class="btn button-danger" style="font-size:16px;" @click="submit(request.id,'cancelled')">Cancel</button>
</div>
<div v-else-if="request.status=='cancelled'" class="text-red">
Appointment Cancelled
</div>



</div>
</div>
</div>







</div>
<div class="col-md-3 col-12"></div>
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
response:{},
flash:{},
errors:{}
},

data(){
return{
form:this.$inertia.form({
id:null,
status:null,
}),
}
},


computed:{
request(){
return this.response.request;
}




},

methods:{
submit(id,status){
this.form.id=id;
this.form.status=status;
this.form.put(this.route('appointment.update'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.flash.success,
position:'bottom-right',
type:'success'
});
}
});

}





}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}

.data-item{
border:none;
}


</style>
