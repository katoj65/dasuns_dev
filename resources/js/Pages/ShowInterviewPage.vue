<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">


<div class="card">
<div class="card-header">
<h3 class="card-title text-transform">Interview</h3>
</div>


<div class="card-body">
<div class="row">
<div class="col-md-12">
<address>
<strong class="text-transform">
{{ interview.firstname }} {{ interview.lastname  }}
</strong>

<small class="float-right">
{{ interview.date.split('-').reverse().join('/') }} </small>
 <br>
<em class="icon ni ni-user-list-fill mr-2"></em>

<span class="text-transform">{{ interview.gender }}</span>

<br>
<em class="icon ni ni-calender-date-fill mr-2"></em>{{ interview.dob.split('-').reverse().join('/') }} <br>
<em class="icon ni ni-call-fill mr-2"></em>{{ interview.tel }} <br>
<em class="icon ni ni-mail-fill mr-2"></em>{{ interview.email }}<br>
<em class="icon ni ni-hash mr-2"></em>{{ interview.number }}
</address>
</div>
</div>
<div class="table-responsive">
<table class="table border mb-3">
<thead class="border-top">
<tr>
<th>Interview Details</th>
<th></th>
</tr>
</thead>
<tbody class="border-bottom">
<tr>
<th>Date</th>
<td>{{  interview.date.split('-').reverse().join('/') }} </td>
</tr>

<tr>
<th>Time</th>
<td>{{interview.time.substring(0,5)}} </td>
</tr>

<tr>
<th>Comment</th>
<td class="text-transform">{{interview.comment}} </td>
</tr>

<tr>
<th>Status</th>
<td class="text-transform">{{interview.status}} </td>
</tr>





</tbody>

<thead class="mt-2">
<tr>
<th>Services</th>
<th>
</th>
</tr>
</thead>
<tbody class="border-bottom">
<tr v-for="(s,key) in interview.services" :key="key">
<td colspan="2">
<div class="text-transform">
<em class="icon ni ni-forward-alt-fill mr-2"></em>
{{ s.name }}
</div>
</td>
</tr>
</tbody>



<thead>
<tr>
<th>Interviewer Details</th>
<th>
</th>
</tr>
</thead>
<tbody class="border-bottom">
<tr v-for="(p,key) in interview.panelist" :key="key">
<td colspan="2">
<div class="text-transform">
<em class="icon ni ni-user-alt-fill mr-2"></em>
{{ p.firstname }} {{ p.lastname }}
</div>
</td>
</tr>
</tbody>


</table>
</div>
<div class="row">
<div class="col-md-12 align-right">
<el-button-group v-if="role=='admin'">
<el-button type="secondary" @click="show=true">Edit</el-button>
<el-button type="danger" @click="submit1(interview.interviewID)">Delete
</el-button>
</el-button-group>
</div>
</div>
</div>
</div>



</div>
<div class="col-12 col-md-2"></div>
</div>
</div>












<!-------------->
<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background: #37BEA7;border:none;">
    <h5 class="modal-title" style="color:white;">Change Interview Details</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

    </a>
    </div>
    <div class="modal-body" style="max-height:500px;overflow:auto">




    <div class="form-group">
    <label class="form-label" for="default-01">
    Date
    <input-error :error="errors.date"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="date" class="form-control" id="default-01" placeholder="Enter date" v-model="form.date">
    </div>
    </div>

    <div class="form-group">
    <label class="form-label" for="default-01">
    Time
     <input-error :error="errors.time"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="time" class="form-control" id="default-01" placeholder="Enter time" v-model="form.time">
    </div>
    </div>



    <div class="form-group">
    <label class="form-label" for="default-01">
    Comment
     <input-error :error="errors.comment"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter comment" v-model="form.comment">
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











</app-layout>
</template>
<script>
import InputError from '../Alerts/InputError.vue';
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout,
InputError

},
props:{
title:{},
response:{},
flash:{},
errors:{}
},

data(){return{
form1:this.$inertia.form({
id:null,
}),

//
show:false,
//

form:this.$inertia.form({
date:'',
time:'',
comment:'',
id:null
}),





}},

computed:{
interview(){
return this.response.interview;
},

role(){
return this.$page.props.auth.user.role;
}




},



methods:{



//
submit1(id){
this.form1.id=id;
this.form1.post(this.route('delete.interview'),{
onSuccess:()=>{
this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
position:'bottom-right',
type:'success'
});
}
});
},





//
submit(){
this.form.post(this.route('update.interview'),{
onSuccess:()=>{
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
position:'bottom-right',
type:this.$page.props.flash.success!=null?'success':'warning'
});
this.show=false;
}
});
},




payload(){
const id=this.response.interview.interviewID;
this.form.id=id;
this.form.date=this.response.interview.date;
this.form.time=this.response.interview.time;
this.form.comment=this.response.interview.comment;
}






},
mounted(){
this.payload();
}





}
</script>
<style scoped>
table tbody tr td,table tbody tr th, table thead tr th{
border:none;
}
th{
font-weight:bold;
}
</style>
