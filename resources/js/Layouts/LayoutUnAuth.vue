<template>
<div class="nk-app-root">
<div class="nk-wrap" style="background:white;">

<div class="nk-header nk-header-fluid is-theme is-fixed" style="border:none;background:#37BEA7;z-index:100000">
<div class="container-xl wide-lg" style="border:none;">
<div class="nk-header-wrap" style="border:none;">
<div class="nk-menu-trigger mr-sm-2 d-lg-none">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav">
<em class="icon ni ni-menu"></em></a>
</div>
<div class="nk-header-brand" style="padding:20px;">
<Inertia-link :href="route('home')" class="logo-link">

<img class="logo-light logo-img" :src="$page.props.system.logo " alt="logo">
<img class="logo-dark logo-img" :src="$page.props.system.logo " alt="logo-dark">

</Inertia-link>
</div><!-- .nk-header-brand -->
<div class="nk-header-menu" data-content="headerNav">
<div class="nk-header-mobile">
<div class="nk-header-brand">
<Inertia-link :href="route('home')" class="logo-link">
<img class="logo-light logo-img" :src="$page.props.system.logo " alt="logo">
<img class="logo-dark logo-img" :src="$page.props.system.logo " alt="logo-dark">

</Inertia-link>
</div>
<div class="nk-menu-trigger mr-n2">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon"><em class="icon ni ni-arrow-left"></em></a>
</div>
</div>
<!-- Menu -->
<ul class="nk-menu nk-menu-main">

<li class="nk-menu-item" >
<Inertia-link :href="route('home')" class="main-menu-item" >
<span class="nk-'menu-text">Home</span>
</Inertia-link>
</li>




<li class="nk-menu-item" >
<Inertia-link :href="route('about')" class="main-menu-item">
<span class="nk-'menu-text">About</span>
</Inertia-link>
</li>


<li class="nk-menu-item" >
    <Inertia-link :href="route('instructions')" class="main-menu-item" >
    <span class="nk-'menu-text">What We Do</span>
    </Inertia-link>
    </li>

<li class="nk-menu-item" >
    <Inertia-link :href="route('contact')" class="main-menu-item" >
    <span class="nk-menu-text">Get Help</span>
    </Inertia-link>
</li>

<!-- <li class="nk-menu-item">
    <Inertia-link :href="route('support-services-page')" class="main-menu-item" >
    <span class="nk-'menu-text">Support Services</span>
    </Inertia-link>
    </li>

    <li class="nk-menu-item" >
        <Inertia-link :href="route('support-service-provider-page')" class="main-menu-item" >
        <span class="nk-'menu-text">Service Provider</span>
        </Inertia-link>
        </li> -->




<!-- <li class="nk-menu-item" style="border:none;">
<Inertia-link :href="route('serviceprovider.list')" class="main-menu-item" >
<span class="nk-menu-text">Support Providers</span>
</Inertia-link>
</li> -->



</ul>
</div><!-- .nk-header-menu -->
<div class="nk-header-tools">
<ul class="nk-quick-nav">
<li>
<Inertia-link :href="route('login')" style="font-size:20px;border:none;" class="signin">
<div>Sign In</div>
</Inertia-link>

</li><!-- .dropdown -->

</ul><!-- .nk-quick-nav -->
</div><!-- .nk-header-tools -->
</div><!-- .nk-header-wrap -->
</div><!-- .container-fliud -->
</div>


<slot></slot>



<div class="nk-content nk-content-lg nk-content-fluid border-top" style="background:#07372F;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="row">
<div class="col-12 col-md-4" style="padding-right:20px;">
<div>
<div class="nk-header-brand">
<Inertia-link :href="route('home')" class="logo-link">
<img class="logo-light logo-img" :src="$page.props.system.logo " alt="logo">
<img class="logo-dark logo-img" :src="$page.props.system.logo " alt="logo-dark">
</Inertia-link>
<p style="color:white;font-size:15px;">
{{ system.data.description }}
</p>
</div>
</div>


</div>
<div class="col-12 col-md-2" style="padding-right:10px;">
<h1 style="font-weight:bold;font-size:20px;color:white;">Account</h1>
<ul class="menu">
<li>
<Inertia-link :href="route('register')">Create an account </Inertia-link>
</li>
<li>
<Inertia-link :href="route('login')">Sign in to your Account </Inertia-link>
</li>
<li>
<a href="">Forgot Password </a>
</li>

</ul>
</div>
<div class="col-12 col-md-3" style="padding-right:10px;">
<h1 style="font-weight:bold;font-size:20px;color:white;">Services</h1>
<ul class="menu1">
<li>
<a href="">Support Services</a>
</li>
<li>
<a href="">Services Providers</a>
</li>
<li>
<a href="">Request a custom Service</a>
</li>
<li>
<a href="">How Dasun works</a>
</li>
</ul>




</div>
<div class="col-12 col-md-3" style="color:white;">
<h1 style="font-weight:bold;font-size:20px;color:white;">Contact</h1>

<ul class="menu1">
<li>

<em class="icon ni ni-call-fill" style="margin-right:10px;"></em>
{{ system.data.tel1 }}

</li>
<li>

<em class="icon ni ni-call-fill" style="margin-right:10px;"></em>
{{ system.data.tel2 }}

</li>
<li>
<a :href="'mailto:'+system.data.email">
<em class="icon ni ni-mail-fill" style="margin-right:10px;"></em>
{{ system.data.email }}
</a>

</li>
</ul>






</div>
</div>






<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6" style="text-align:center;padding-top:50px;color:white;margin-top:30px;">
<a :href="system.data.facebook" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-facebook-fill" style="font-size:50px;"></em>
</a>

<a :href="system.data.twitter" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-twitter-round" style="font-size:50px;"></em>
</a>


<a href="#" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-whatsapp" style="font-size:50px;"></em>
</a>




<a href="#" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-linkedin" style="font-size:50px;"></em>
</a>


<a href="#" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-instagram" style="font-size:50px;"></em>
</a>


<a href="#" style="margin-left:20px;margin-left:20px;" target="new">
<em class="icon ni ni-youtube-fill" style="font-size:50px;"></em>
</a>



</div>
<div class="col-12 col-md-3"></div>
</div>




</div>
</div>
</div>
</div>






</div>

</div>
</template>
<script>

export default {
components:{



},
props:{


},
data(){return{


}},

computed:{
system(){
return this.$page.props.system;
}
}



}
</script>




<style scoped>
.link{
color:white;
}

.menu li{
margin-top:10px;
margin-bottom:10px;
}

.menu li a{
color:white;
font-size:15px;
}

.menu1 li{
margin-top:10px;
margin-bottom:10px;
}
.menu1 li a{
color:white;
font-size:15px;
}

.menu1 .menu{
padding-top:70px;
}
h1{
padding-bottom:10px;
}

.nk-menu .nk-menu-main .nk-menu-item{
border:none;
}

.main-menu-item{
border:none;


}

.main-menu-item, .signin{
font-size:16px;
font-weight: bold;
color:white;
}

.main-menu-item:hover, .signin:hover{
color:yellow ;


}

</style>

