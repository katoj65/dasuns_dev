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
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body" style="margin:-20px;">
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
import Sidebar from '@/Shared/Sidebar';
import Header from '@/Shared/Header';
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






}
</script>

<style>
a { text-decoration: none; }




</style>
