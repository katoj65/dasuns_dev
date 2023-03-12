<template>
<div class="nk-block">
<active-panelist-dashboard :response="response" :flash="flash" errors="errors" v-if="status=='active'"></active-panelist-dashboard>






<div class="row g-gs" v-else>
<div class="col-12 col-md-12">
<el-card class="card p-4" shadow="never">
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6">
<div class="card card-full" style="min-height:600px;">
<div class="card-inner">
<div class="card-title-group">
<div class="card-title" style="width:100%;">
<h6  style="text-align:center;width:100%;"></h6>
</div>

</div>
</div>
<div>


<div class="card mb-10 mt-3 border" style="border-radius:5px;">
<div class="card-inner">
<div class="team">

<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span><em class="icon ni ni-user-alt-fill"></em></span>

</div>
<div class="user-info">
<h6 class="text-transform">{{ user.firstname }} {{ user.lastname }} </h6>
<span class="sub-text">Panelist</span>
</div>
</div>

<div class="team-view">
<button class="btn btn-block btn-dim btn-success" @click="close_dialog1()"><span>Add Profession Experience </span></button>
</div>

<div>

<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform">{{ user.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value">{{ user.dob }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ user.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number </div>
<div class="data-value">{{ user.tel }} </div>
</div>
</li>
<li class="data-item border-0 mt-2">
<div class="data-col">
<div class="data-label"><strong>PROFESSION EXPERIENCE </strong></div>
<!-- <div class="data-value">info@softnio.com</div> -->
</div>
</li>
<li class="data-item border-0 p-0" style="width:100%;">

<div class="card  card-full" style="width:100%;">
<div class="card-inner-group" v-if="$page.props.response.user_data.dashboard.panelist_professions.length>0">
<div class="data-item" v-for="x in  $page.props.response.user_data.dashboard.panelist_professions" :key="x.id">
<div class="data-col">
<span class="data-label text-transform" style="width:250px;">{{ x.name }} </span>
<span class="data-value" style="width:100px;">{{ x.years>1?x.years+' Years':x.years+' Year' }} </span>
</div>
<div class="data-col data-col-end">
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" style="padding:5px;" @click="submit2(x.id)">Delete</a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>

</div>
<div v-else>
No content
</div>
</div>

</li>
</ul>



<div class="border-top" style="width:100%;" v-if="$page.props.response.user_data.dashboard.panelist_professions.length>0">
<button  class="btn btn-block btn-dim btn-success mt-2" @click="submit3()">
FINISH
</button>
</div>


</div>

</div><!-- .team -->
</div><!-- .card-inner -->
</div>


























</div>
</div>






</div>


<div class="col-12 col-md-3"></div>

</div>
</el-card>
</div>
</div>




<!------Dialog Panels-->


<form class="" v-if="dialog.experience==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">

<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Panelist Profession Experience</h5>
<a href="#" class="close"  aria-label="Close" @click="close_dialog1()">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">

<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.experience"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_exp($event)">
<option>-- Select Profession--</option>
<option v-for="p in profession" :key="p.id" :value="p.id">{{ p.name }}</option>
</select>
</div>
</div>






<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<textarea class="form-control" id="default-01" placeholder="Enter profession description" v-model="form.description"></textarea>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.years"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" placeholder="Enter telephone contact" @change="select_years($event)">
<option>-- Select Number of Years --</option>
<option :value="x" v-for="x in 30" :key="x">
{{ x }} {{ x==1?'Year':'Years' }}
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




</div>
</template>
<script>
import ActivePanelistDashboard from '@/Panelist/ActivePanelistDashboard';
import InputError from '@/Alerts/InputError';
export default {

components:{
InputError,
ActivePanelistDashboard,
},

props:{
response:{},
title:{},
errors:{},
flash:{}
},


data(){
return{
interviews:this.response.dashboard.interviews,
profile:this.response.dashboard.profile,
profession:this.response.dashboard.profession,
panelist_professions:this.$page.props.response.user_data.dashboard.panelist_professions,
recommend:this.response.dashboard.recommended,


dialog:{
experience:false,
},

form:this.$inertia.form({
experience:null,
description:null,
years:null,
}
),



//
form2:this.$inertia.form({
id:null,
}),






}},







methods:{

close_dialog1(){
if(this.dialog.experience==false){
this.dialog.experience=true;
}else if(this.dialog.experience==true){
this.dialog.experience=false;
}
},


//select
select_exp(event){
this.form.experience=event.target.value;
},

//select
select_years(event){
this.form.years=event.target.value;
},



submit(){
this.form.post(this.route('store.profession_profile'),{
onSuccess:()=>{
this.dialog.experience=false;
this.$notify({
    position: 'bottom-right',
title: 'Success',
message:this.flash.success!=null?this.flash.success:this.flash.warning,
type: this.flash.success!=null?'success':'warning'
});
}
});
},



//
submit2(id){
this.form2.id=id;
this.form2.post(route('delete.profession_attributes'),{
onSuccess:()=>{
this.$notify({
    position: 'bottom-right',
title: 'Success',
message:this.flash.success,
type:'success'
});
}
});

},

//
submit3(){
this.$inertia.post(this.route('panelist.finish'));
}







},


computed:{
user(){
return this.$page.props.auth.user;
},
status(){
return this.$page.props.auth.user.status;
}




}



}
</script>
<style scoped>
table tr th, table tr td{
padding:10px;
}
</style>
