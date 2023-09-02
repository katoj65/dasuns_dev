<template>
<div class="nk-app-root">
<!-- main @s -->
<div class="nk-main ">
<!-- sidebar @s -->
<sidebar></sidebar>
<!-- sidebar @e -->
<!-- wrap @s -->
<div class="nk-wrap ">
<!-- main header @s -->
<Header style="z-index:10;"></Header>
<!-- main header @e -->



<!-- content @s -->
<div class="nk-content p-0">
<div class="container-fluid p-0">
<div class="nk-content-inner p-0">
<div class="nk-content-body p-0">











<!----------Ongoing-------->
<div v-if="ongoing!=''" style="margin-top:5px;">
<div class="alert alert-success alert-icon" style="border-radius:0;">
<em class="icon ni ni-check-circle"></em>
<strong class="mr-3">{{ ongoing.title }}</strong>
<span class="mr-3"><em class="icon ni ni-calendar-booking" style="font-size:20px;"></em>
{{ ongoing.start_date }}
</span>
<span>
{{ ongoing.end_date }}
</span>
<span class="float-right mr-3">
<a href="">Click</a>
</span>
</div>
</div>








<slot></slot>



















</div>
</div>
</div>
</div>
<!-- content @e -->
<!-- footer @s -->
<div class="nk-footer" style="border-top:none;">
<div class="container-fluid">
<div class="nk-footer-wrap">
<div class="nk-footer-copyright"> &copy; {{ year }} Dasuns </div>
<div class="nk-footer-links">
<ul class="nav nav-sm">
<li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
<li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
</ul>
</div>
</div>
</div>
</div>
<!-- footer @e -->
</div>
</div>
</div>
</template>
<script>

import Header from '@/Shared/Header';
import Sidebar from '@/Shared/Sidebar';
let d=new Date();
let year=d.getFullYear();

export default {
components:{
Sidebar,
Header,


},



data(){
return{
user:this.$page.props.auth.user,
year:year,
account_type:this.$page.props.auth.user.account_type,
role:this.$page.props.auth.user.role,
//user details

user_details:{
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
email:this.$page.props.auth.user.email,
tel:this.$page.props.auth.user.tel,
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
userames:this.$page.props.auth.user.account_type=='personal'?this.$page.props.auth.user.firstname+' '+this.$page.props.auth.user.lastname:this.$page.props.auth.user.firstname,
}




}
},
props: {

},

methods:{



},

mounted(){

},

computed:{
ongoing(){
return this.$page.props.data.ongoing_appointment;
}

}



}
</script>

<style>
a{ text-decoration: none; }




</style>
