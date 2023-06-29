<template>
<page-wrapper>
<page-wrapper v-if="account_type==='personal'">
<div class="row p-3">
<div class="col-12 col-md-4">
    <div class="card pt-3 h-100">
        <div class="user-card user-card-s2">
            <div class="user-avatar lg bg-info">
                <span><em class="icon ni ni-user-alt-fill"></em></span>
                <div class="status dot dot-lg dot-success"></div>
            </div>
            <div class="user-info">
                <h5>{{ $page.props.auth.user.firstname+' '+$page.props.auth.user.lastname }}</h5>
                <p class="muted"><strong>Service No.</strong> <span class="ml-1">{{ service_number }}</span> </p>

            </div>
        </div>





        <div class="card-body">
            <div class="row">
                <div class="col-5 py-1"><strong>Gender:</strong></div>
                <div class="col-7 py-1 text-transform">{{ $page.props.auth.user.gender }}</div>
                <div class="col-5 py-1"><strong>DOB:</strong></div>
                <div class="col-7 py-1">{{ $page.props.auth.user.dob.split('-').reverse().join('/') }}</div>
                <div class="col-5 py-1"><strong>Telephone:</strong></div>
                <div class="col-7 py-1">{{ $page.props.auth.user.tel }}</div>
                <div class="col-5 py-1"><strong>Email:</strong></div>
                <div class="col-7 py-1">{{ $page.props.auth.user.email }}</div>
                <div class="col-5 py-1"><strong>Location:</strong></div>
                <div class="col-7 py-1 text-transform">{{ user_profile.location }}</div>
                <div class="col-5 py-1"><strong>Country:</strong></div>
                <div class="col-7 py-1 text-transform">{{ user_profile.name }}</div>


            </div>
        </div>




<div class="card-footer">
<Inertia-link :href="route('dashboard')" class="btn btn-block border" style="color:black;"><span>
View Dashboard</span></Inertia-link>
</div>
</div>
</div>








<div class="col-12 col-md-8">



    <div class="card h-100" style="min-height:600px;">
        <div class="card-header">
            <h3 class="card-title">User Profile</h3>
            <div class="card-options">
                <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                <div class="item-action dropdown ml-2">
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" @click="set_user(true)">Edit user information </a>
                        <!-- <a href="#" class="dropdown-item"  @click="set_profile(true)"> Edit profile </a> -->
                        <a href="#" class="dropdown-item" @click="set_location(true)">Add location</a>

                        <a href="#" class="dropdown-item" @click="set_service(true)">Add services</a>

                <a href="#" class="dropdown-item" @click="set_disability(true)" v-if="disability_status=='true'">Add disabilities</a>

                <a href="#" class="dropdown-item"  v-if="user.account_type=='institutional'">Move to</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-unstyled feeds_widget">
                <li>
                    <div class="feeds-left"><em class="icon ni ni-caret-right-fill"></em></div>
                    <div class="feeds-body">
                        <h4 class="title">Services I Need from Dasuns Platform</h4>

<div v-if="response.user_data.profile.services.length>0" class="mt-3">
<div class="row" v-for="n in response.user_data.profile.services" :key="n.id">
<div class="col-11"> {{ n.name }}</div>
<div class="col-1">
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_services(n.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
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





<li>
<div class="feeds-left"><em class="icon ni ni-caret-right-fill"></em>  </div>
<div class="feeds-body">
<h4 class="title">My Disabilities
<small class="float-right text-muted">
{{ disability_status=='true'?'Yes':'No' }}
</small></h4>


<div v-if="response.user_data.profile.disabilities.length>0" class="mt-3">
<div class="row" v-for="d in response.user_data.profile.disabilities" :key="d.id">
<div class="col-11">
{{ d.name }}
</div>
<div class="col-1">
    <el-dropdown>
        <span class="el-dropdown-link">
        <i class="el-icon-arrow-down el-icon--right"></i>
        </span>
        <el-dropdown-menu slot="dropdown">
        <el-dropdown-item>
        <a href="#" class="p-1" @click="delete_disabilities(d.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
        </el-dropdown-item>
        </el-dropdown-menu>
        </el-dropdown>
</div>

    </div>
    </div>



</div>





<!-- <div v-if="response.user_data.profile.disabilities.length>0">
<div v-for="d in response.user_data.profile.disabilities" :key="d.id" class="row">
<div class="col-12">
{{ d.name }}
</div>
<div class="col-1">
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_disabilities(d.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
</div> -->



</li>



<li>
<div class="feeds-left"><em class="icon ni ni-caret-right-fill"></em> </div>
<div class="feeds-body" v-if="$page.props.auth.user.account_type=='institutional'">
<h4 class="title">Organisation Contact Person Information
<small class="float-right text-muted">10:50</small>
</h4>

<div class="row">
<div class="col-6">
<strong>
Names
</strong>
<p>
</p>
</div>





</div>
</div>
<div class="feeds-body" v-else>
<h4 class="title">Joined Dasuns Platform
<small class="float-right text-muted">{{ user.created_at.substring(0,10).split('-').reverse().join('/') }}</small>
</h4>

</div>





</li>





<!--
                <li>
                    <div class="feeds-left"><i class="fa fa-check"></i></div>
                    <div class="feeds-body">
                        <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">11:05</small></h4>
                        <small>WE have fix all Design bug with Responsive</small>
                    </div>
                </li> -->
                <!-- <li>
                    <div class="feeds-left"><i class="fa fa-shopping-cart"></i></div>
                    <div class="feeds-body">
                        <h4 class="title">7 New Orders <small class="float-right text-muted">11:35</small></h4>
                        <small>You received a new oder from Tina.</small>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>













</div>
</div>

</page-wrapper>






<page-wrapper v-else>
</page-wrapper>




































<!---------Dialog information-->

<form @submit.prevent="submit" class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.edit_user==true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h6 class="modal-title">Edit User Information</h6>
    <a href="#" class="close" @click="dialog_box.edit_user=false">

    </a>
    </div>
    <div class="modal-body" style="max-height:500px;overflow:auto;">
    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.firstname"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form_user.firstname">
    </div>
    </div>



    <!-- <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.lastname"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.lastname">
    </div>
    </div> -->






    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.gender"></input-error>
    </label>
    <div class="form-control-wrap">
    <select class="form-control text-transform" id="default-01" @change="select_gender($event)">
    <option :value="user.gender">{{ user.gender }} </option>
    <option value="male" v-if="user.gender!='male'">Male</option>
    <option value="female" v-if="user.gender!='female'">Female</option>
    <option value="other" v-if="user.gender!='other'">Other</option>
    </select>
    </div>
    </div>



    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.dob"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="date" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.dob">
    </div>
    </div>





    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.tel"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form_user.tel">
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











    <!------------services--->
    <form @submit.prevent="submit_services" v-if="dialog_box.add_service==true">
    <div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h6 class="modal-title">Add Profession Support Services</h6>
    <a href="#" class="close" @click="dialog_box.add_service=false">
    </a>
    </div>
    <!-- {{ response.user_data.list_services }} -->

    <div class="modal-body" style="max-height:500px;overflow:auto;">
    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.service"></input-error>
    </label>
    <div class="form-control-wrap">
    <select class="form-control" id="default-01" @change="select_service($event)">
    <option value="">Select</option>
    <option :value="r.id" v-for="r in response.user_data.list_services" :key="r.id">
    {{ r.name }}
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
    </div>

    </form>















    <!------Contact Person Form------->
    <!-- <form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit3">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Edit Contact Person</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.add_pssu_disability=false">

    </a>
    </div>
    <div class="modal-body" style="max-height:450px;overflow:auto;">





    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.firstname"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.firstname">
    </div>
    </div>



    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.lastname"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form3.lastname">
    </div>
    </div>









    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.disability"></input-error>
    </label>
    <div class="form-control-wrap">
    <select class="form-control text-transform" id="default-01" @change="select_edit_gender($event)">
    <option :value="form3.gender">{{form3.gender}}</option>
    <option v-for="g in gender_format" :key="g.id" :value="g.name">
    {{ g.name }}
    </option>
    </select>
    </div>
    </div>




    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.designation"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.designation">
    </div>
    </div>



    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.tel"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.tel">
    </div>
    </div>

    <div class="form-group">
    <label class="form-label" for="default-01">
    <input-error :error="errors.email"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.email">
    </div>
    </div>






    </div>
    <div class="modal-footer bg-light">
    <span class="sub-text">
    <button class="button" type="submit" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;">Save</button>
    </span>
    </div>
    </div>
    </div>
    </form> -->









<!----------Location information------------>
<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.edit_location==true" @submit.prevent="submit4">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h6 class="modal-title">Edit location</h6>
    <a href="#" class="close" @click="set_location(false)">

    </a>
    </div>
    <div class="modal-body" style="max-height:500px;overflow:auto;">




    <div class="form-group">
    <label class="form-label" for="default-01">
    Location
    <input-error :error="errors.location"></input-error>
    </label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter location" v-model="form_update_location.location">
    </div>
    </div>


    <div class="form-group">
    <label class="form-label" for="default-01">
    Country
    <input-error :error="errors.country"></input-error>
    </label>
    <div class="form-control-wrap">
    <select class="form-control" id="default-01" placeholder="Enter country" @change="change_country($event)">
<option value="">{{ user_profile.name }} </option>


<option v-for="co in location_data.new.countries" :key="co.id" :value="co.id">{{ co.name }} </option>
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








<!----------Add disabilities------------>
<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.add_pssu_disability==true" @submit.prevent="submit_disability">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title">Add disability</h6>
<a href="#" class="close" @click="set_disability(false)">

</a>
</div>
<div class="modal-body p-3" style="max-height:500px;overflow:auto;">



<div class="form-group">
<label class="form-label" for="default-01">
Disabilities
<input-error :error="errors.country"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" placeholder="Enter country" @change="select_disability($event)">
<option value="">--Select disabilites-- </option>


<option v-for="d in response.user_data.profile.select_disability " :key="d.id" :value="d.id">{{ d.name }} </option>
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






</page-wrapper>
</template>
<script>
import PageWrapper from '@/Shared/PageWrapper';
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError,
PageWrapper,

},
props:{
response:{},
flash:{},
errors:{},

},



data(){return{

//update location information
form_update_location:this.$inertia.form({
location:null,
country:null,
}),

location_data:null,



//selected country name
selected_country:null,
selected_countryID:null,
//
selected_disability_item:null,
//disability status
disabilities:[
{id:1,name:'true'},
{id:2,name:'false'}
],

//
form_update_profile:this.$inertia.form({
location:null,
country:null,
disability:null
}),


//genders
gender:[
{id:1,name:'male'},
{id:2,name:'female'},
{id:3,name:'other'}
],

//form for editing service provider
form3:this.$inertia.form({
firstname:null,
gender:null,
tel:null,
email:null,
designation:null,
}),

//start dialog box

dialog_box:{
edit_user:false,
add_disability:false,
delete_account:false,
add_service:false,
add_pssu_disability:false,
delete_account:false,
edit_profile:false,
edit_location:false,

},
//

form_user:this.$inertia.form({
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
gender:this.$page.props.auth.user.gender,
dob:this.$page.props.auth.user.dob,
tel:this.$page.props.auth.user.tel,

}),

//
form_service:this.$inertia.form({
service:null
}),

//
form_disability:this.$inertia.form({
disability:null,
}),

}},




methods:{

location_field_data(){
const all=this.response.user_data.profile.country;
const old_country=this.response.user_data.profile.user_profile.name;
let items=[];
all.forEach(element=>{
if(element.name!=old_country){
items.push({id:element.id,name:element.name});
}
});
this.location_data={
defaults:{
country:{name:old_country},
locaction:{name:this.response.user_data.profile.user_profile.location}
},
new:{
countries:items,
}
}
//
this.form_update_location.location=this.location_data.defaults.locaction.name;



}
,


//
set_user(state){
this.dialog_box.edit_user=true;
},
set_profile(state){
this.dialog_box.edit_profile=true;
},
set_service(state){
this.dialog_box.add_service=state;
},
set_disability(state){
this.dialog_box.add_pssu_disability=state;
},
set_contact_person(state){

},
set_location(state){
this.dialog_box.edit_location=state;
},










change_country(event){
this.form_update_location.country=event.target.value;
},

change_disability(event){
this.form_update_profile.disability=event.target.value;
},


submit4(){
this.form_update_location.post(this.route('pssu.update_profile'),{
onSuccess:()=>{
const flash=this.$page.props.flash;
this.set_location(false);
this.$notify({
title:flash.success!=null?'Successful':'Error',
message:flash.success!=null?flash.success:flash.warning,
type:flash.success!=null?'success':'warning',
position:'bottom-right'

});
}
});
},


disability_load(){
this.selected_disability_item =this.response.user_data.profile.user_profile.disability;
},





delete_services(id){
this.$inertia.post(this.route('delete-services'),{
id:id,
},{
onSuccess:()=>{
this.$inertia.get(route('profile'));
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'Profession service has been deleted.',
type: 'success'
});
}
});

},




//
delete_disabilities(id){
this.$inertia.post(this.route('pssu.delete-disability'),{
id:id},{
onSuccess:()=>{
this.$notify({
title:'Succesfull',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
}
);
},


//dialog box
edit_user_information(){
this.dialog_box.edit_user=true;
},


//
submit(){
this.form_user.post(this.route('user_update_account'),{
onSuccess:()=>{
this.dialog_box.edit_user=false;
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'User information has been updated.',
type: 'success'
});

}
});

},

//
select_gender(event){
this.form_user.gender=event.target.value;
},


//
submit_services(){
this.form_service.post(this.route('pssu.store-services'),{
onSuccess:()=>{
this.$notify({
position: 'bottom-right',
title: this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning'
});
this.dialog_box.add_service=false;
}
});

},

//
select_service(event){
this.form_service.service=event.target.value;
},

//
select_disability(event){
this.form_disability.disability=event.target.value;
},

//
submit_disability(){
this.form_disability.post(this.route('pssu.store_disability'),{
onSuccess:()=>{
this.dialog_box.add_pssu_disability=false;
this.$notify({
position:'bottom-right',
title:this.$page.props.flash.success?'Successful':'Warning',
message:this.$page.props.flash.success?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success?'success':'warning',
});



}
});


},


data_load(){
// this.contact_person=this.response.user_data.profile.contact_person;
// const admin=this.response.user_data.profile.contact_person
// this.form3.firstname=admin.firstname;
// this.form3.lastname=admin.lastname;
// this.form3.gender=admin.gender;
// this.form3.email=admin.email;
// this.form3.tel=admin.tel;
// this.form3.designation=admin.role;
},

//select edit gender
select_edit_gender(event){
this.form3.gender=event.target.value;
},







//submit 3
submit3(){
this.form3.post(this.route('pssu.update_contact_person'),{
onSuccess:()=>{
this.dialog_box.add_pssu_disability=false;
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
selected_profile(){
this.form_update_profile.location=this.response.user_data.profile.user_profile.location;
this.form_update_profile.country=this.response.user_data.profile.user_profile.countryID;
this.form_update_profile.disability=this.response.user_data.profile.user_profile.disability;

},






},




//
mounted(){
this.disability_load();
this.data_load();
this.selected_profile();
this.location_field_data();
},


//
computed:{
format_countries(){
const countries=this.response.user_data.country;
const country=[];
// countries.forEach(element=>{

// });
return countries;
},



//
disability_status_loop(){
const payload=[];
const item=this.response.user_data.profile.user_profile.disability;
this.disabilities.forEach(element=>{
if(item!=element.name){
payload.push({id:element.id,name:element.name});
}
});
return payload;
},




//
selected_disability(){
return this.response.user_data.profile.user_profile.disability;
},


//
country(){
this.selected_country=this.response.user_data.profile.user_profile.name;
this.selected_countryID=this.response.user_data.profile.user_profile.countryID;
return this.response.user_data.profile.country;
},


disability_status(){
return this.response.user_data.profile.user_profile.disability;
},



//
user_profile(){
return this.response.user_data.profile.user_profile;
},

//contact person
// contact_person(){
// return this.response.user_data.profile.contact_person;
// },
//account type
account_type(){
return this.$page.props.auth.user.account_type;
},

//contact person
admin(){
const user=this.$page.props.auth.account_type;

return user=='personal'?null:null;
},
// user information
user(){
return this.$page.props.auth.user;
},

//format gender
gender_format(){
const item=[];
this.gender.forEach(element=>{
if(this.form3.gender!=element.name){
item.push({
id:element.id,name:element.name
});
}
});
return item;
},

//service number
service_number(){
return this.response.user_data.profile.service_number;
},



// selected countries
// location_field_data(){
// const all=this.response.user_data.profile.country;
// const old_country=this.response.user_data.profile.user_profile.name;
// let items=[];
// all.forEach(element=>{
// if(element.name!=old_country){
// items.push({id:element.id,name:element.name});
// }
// });
// return {
// defaults:{
// country:{name:old_country},
// locaction:{name:this.response.user_data.profile.user_profile.location}
// },
// new:{
// countries:items,

// }



// }
// }




}

}
</script>
<style scoped>
.dropdown-toggle:hover, .btn-sm:hover, .btn-icon:hover, .btn-trigger:hover{
background: none;
}




</style>
