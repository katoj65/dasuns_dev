<template>
<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6 mt-4">


<div class="card" style="min-height:700px;">
<div class="card-inner">
<div class="team">

<div class="user-card user-card-s2 pt-3">
<div class="user-avatar md" style="background:#0B5345;width:100px;height:100px;">
<img src="" alt="">
<!-- <div class="status dot dot-lg dot-success"></div> -->
<em class="icon ni ni-user-alt-fill" style="font-size:50px;"></em>
</div>
<div class="user-info">
<h1 style="font-size:20px;font-weight:bold;text-transform:capitalize;">
{{ user.usernames }}
</h1>
<span class="sub-text pt-2" style="font-size:16px;">
{{ user.email }}
</span>
</div>



</div>
</div>

<div class="card  mb-5 thick-border" style="border-radius:30px;">
    <div class="card-header thick_bg" style="border-radius: 26px 26px 0 0;">
    <h1 style="font-size:18px;text-align:center;letter-spacing:0.3px;word-spacing:1px;"> Create professional support service provider profile</h1>
    </div>
    <div class="card-body">
    <form class="row" @submit.prevent="submit">
    <div class="col-12 col-md-12">



    <div class="form-group pt-2">
    <div class="form-control-wrap">
    <div class="form-control-select-multiple">
    <label>Services you would like to offer
    <p><input-error :error="$page.props.errors.serviceID"></input-error></p>
     </label>
     <b-form-select v-model="form.serviceID" :options="options" multiple :select-size="4" class="custom-select form-control form-control-lg"></b-form-select>
    </div>
    </div>
    </div>



    <div class="form-group pt-4">
    <div class="form-control-wrap">
    <input-error :error="$page.props.errors.location"></input-error>
    <input type="text" class="form-control form-control-lg" placeholder="Enter your address / location" v-model="form.location">
    </div>
    </div>




    <div class="form-group pt-0">
    <div class="form-control-wrap">
    <div class="form-control-select-multiple">
    <label>
    <input-error :error="$page.props.errors.countryID"></input-error>
     </label>
    <select class="form-control form-control-lg" style="text-transform:capitalize;" @change="select_country($event)">
    <option value="">Select Country</option>
    <option v-for="c in response.country" :key="c.id" :value="c.id">
    {{ c.name }}
    </option>
    </select>
    </div>
    </div>
    </div>









    <div class="col-lg-12 pt-10 pb-3" style="text-align:center;">
    <div class="form-group">
    <button type="submit" class="btn button" style="padding-left:50px;padding-right:50px;font-size:17px;">Finish</button>
    </div>
    </div>




    </div>

    </form>

    </div>
    </div>












</div><!-- .team -->
</div>






</div>
<div class="col-12 col-md-3"></div>
</div>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError,
},
props:{
response:{},
title:{},
errors:{},

},

data(){return{
form: this.$inertia.form({
serviceID:[],
location:null,
countryID:null,
}
),





options:this.response.services,
user:{
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
email:this.$page.props.auth.user.email,
tel:this.$page.props.auth.user.tel,
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
usernames:this.$page.props.auth.user.account_type=='personal'?this.$page.props.auth.user.firstname+' '+this.$page.props.auth.user.lastname:this.$page.props.auth.user.firstname,
}


}},

methods:{
select_country(event){
this.form.countryID=event.target.value;
},

submit(){
this.form.post(this.route('profile.create-pssp'),{

});
}






}




}
</script>
