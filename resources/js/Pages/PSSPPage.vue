<template>
<app-layout>
<div class="nk-content p-4">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">




<div v-if="user.length>0">
<div class="card" v-for="(u,key) in user" :key="key">
<div class="card-body text-center">
<div class="text-center">
<em class="icon ni ni-user-circle-fill" style="font-size:80px;"></em>
</div>
<h5 class="mt-3 text-transform">{{ u.firstname }} {{ u.lastname }} </h5>
<div class="text-center text-muted mb-3 text-transform">Service Provider </div>
<button type="button" class="btn btn-icon btn-outline-primary">
<em class="icon ni ni-mail-fill"></em>
</button>
<button type="button" class="btn btn-icon btn-outline-danger" @click="submit1(u.id)"><em class="icon ni ni-trash-empty-fill"></em></button>
</div>

<div class="card-footer" style="border:none;">

<div class="card">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value">{{ u.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value">{{ u.dob.split('-').reverse().join('/') }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone </div>
<div class="data-value">{{ u.tel }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email </div>
<div class="data-value" style="text-transform:lowercase;">{{ u.email }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Role</div>
<div class="data-value">Service Provider </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Status</div>
<div class="data-value">{{ u.status }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Service Number</div>
<div class="data-value">{{ u.number }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label">Location</div>
<div class="data-value">{{ u.location }} </div>
</div>
</li>



<li class="data-item">
<div class="data-col">
<div class="data-label">Country</div>
<div class="data-value">{{ u.name }} </div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label text-muted" style="font-weight:bold;">SERVICES OFFERED</div>
<div class="data-value"> </div>
</div>
</li>



<li class="data-item" v-for="(s,key) in services" :key="key">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-caret-right-fill"></em>
{{ s.name }}
</div>
<div class="data-value"> </div>
</div>
</li>







</ul>





<ul class="data-list is-compact" style="margin-top:-10px;" v-if="documents.length>0">
<li class="data-item">
<div class="data-col">
<div class="data-label text-muted" style="font-weight:bold;">VERIFICATION DOCUMENTS</div>
<div class="data-value"></div>
</div>
</li>
<li class="data-item" v-for="(d,key) in documents" :key="key">
<div class="data-col">
<div class="data-label"><em class="icon ni ni-caret-right-fill"></em>
{{ d.document }}
</div>
<div class="data-value"> </div>
</div>
</li>
</ul>






<ul class="data-list is-compact" style="margin-top:-10px;">
<li class="data-item">
<div class="data-col">
<div class="data-label" style="font-weight:bold;">
<a href="#" class="text-muted" @click="drawer = true">ACADEMIC QUALIFICATION</a>
</div>
<div class="data-value"></div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label" style="font-weight:bold;">
<a href="#" class="text-muted" @click="drawer1 = true">EMPLOYMENT HISTORY</a>
</div>
<div class="data-value"></div>
</div>
</li>


<li class="data-item">
<div class="data-col">
<div class="data-label" style="font-weight:bold;">
<a href="#" class="text-muted" @click="drawer2 = true">
REFERECES
</a>
</div>
<div class="data-value"></div>
</div>
</li>






</ul>











</div>



















</div>

</div>
</div>
<div v-else>
No content
</div>






</div>
<div class="col-12 col-md-3"></div>
</div>
</div>








<!----Academic Qualification---->
<el-drawer title="ACADEMIC QUALIFICATIONS" :visible.sync="drawer" size="50%">
<div class="p-1">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>
<th>SCHOOL / INSTITUTION</th>
<th>DATES</th>
<th>QUALIFICATION</th>
</tr>
</thead>
<tbody v-if="education.length>0">
<tr v-for="(e,key) in education" :key="key">

<td>{{e.institution}} </td>
<td>{{e.from.split('-').reverse().join('/')}} - {{e.to.split('-').reverse().join('/')}} </td>
<td>
{{ e.qualification }}
</td>
</tr>

</tbody>
<tbody v-else>
<tr><td colspan="5">No content</td> </tr>
</tbody>
</table>
</div>
</div>
</div>



</div>
</el-drawer>





<!----History---->

<el-drawer title="EMPLOYMENT HISTORY" :visible.sync="drawer1" size="50%">
<div class="p-1">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>
<th>JOB</th>
<th>DATES</th>
<th>EMPLOYER</th>
<th>LOCATION</th>
</tr>
</thead>
<tbody v-if="employment.length>0">
<tr v-for="(j,key) in employment" :key="key">

<td>{{j.job}} </td>
<td>{{j.from.split('-').reverse().join('/')}} - {{j.to}} </td>
<td>
{{ j.employer }}
</td>
<td>
{{ j.location }}
</td>
</tr>

</tbody>
<tbody v-else>
<tr><td colspan="5">No content</td> </tr>
</tbody>
</table>
</div>
</div>
</div>


</div>
</el-drawer>



<!----References----->

<el-drawer title="REFERENCES" :visible.sync="drawer2" size="60%">
<div class="p-1">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>
<th>NAMES</th>
<th>TELEPHONE</th>
<th>EMAIL</th>
<th>POSITION</th>
<th>ADDRESS</th>
</tr>
</thead>
<tbody v-if="reference.length>0">
<tr v-for="(r,key) in reference" :key="key">
<td>{{r.names}} </td>
<td>{{ r.tel }}  </td>
<td>
{{ r.email}}
</td>
<td>
{{ r.position}}
</td>
<td>
{{ r.address}}
</td>
</tr>

</tbody>
<tbody v-else>
<tr><td colspan="5">No content</td> </tr>
</tbody>
</table>
</div>
</div>
</div>



</div>
</el-drawer>





</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout,
},
props:{
title:{},
response:{},
},

data(){return{
drawer:false,
drawer1:false,
drawer2:false,
}},





computed:{
user(){
return this.response.user;
},

services(){
return this.response.services;
},

documents(){
return this.response.documents;
},

employment(){
return this.response.employment;
},

education(){
return this.response.education;
},

reference(){
return this.response.reference;
}


},


methods:{
submit1(id){
this.$inertia.post(this.route('service_provider.destroy',{id:id}),{
onSuccess:()=>{


this.$notify({
title:'Successful',
message:this.$page.props.flash.success,
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
button{
padding:10px;
width:50px;
}
.data-value{
text-transform: capitalize;
}
.data-item{
border:none;
}
ul{
margin:0;
}
</style>
