<template>
<div class="nk-app-root">
<div class="nk-wrap" style="background:white;">

<div class="nk-header nk-header-fluid is-theme is-fixed" style="border:none;background:#37BEA7;">
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
<a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
</div>
</div>
<!-- Menu -->
<ul class="nk-menu nk-menu-main">
<li class="nk-menu-item" style="border:none;">
<Inertia-link :href="route('supportservices.list')" class="nk-menu-link" style="color:white;border:none;">
<span class="nk-'menu-text">Support Services</span>
</Inertia-link>
</li>
<li class="nk-menu-item" style="border:none;">
<Inertia-link :href="route('serviceprovider.list')" class="nk-menu-link" style="color:white;border:none;">
<span class="nk-menu-text">Support Providers</span>
</Inertia-link>
</li>

<li class="nk-menu-item" style="border:none;">
<Inertia-link :href="route('instruction.list')" class="nk-menu-link" style="color:white;border:none;">
<span class="nk-menu-text">How it works</span>
</Inertia-link>
</li>


</ul>
</div><!-- .nk-header-menu -->
<div class="nk-header-tools">
<ul class="nk-quick-nav">
<li>
<Inertia-link :href="route('login')" style="font-size:20px;color:white;border:none;">
<div style="color:white;">Sign In</div>
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
<p style="color:white;font-size:18px;">
{{ system.about }}
</p>
</div>
</div>


</div>
<div class="col-12 col-md-2" style="padding-right:10px;">
<h1 style="font-weight:bold;font-size:20px;color:white;">Account</h1>
<ul class="menu">
<li>
<a href="">Create an account </a>
</li>
<li>
<a href="">Sign in to your Account </a>
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
<div class="col-12 col-md-3">
<h1 style="font-weight:bold;font-size:20px;color:white;">Contact</h1>

<ul class="menu1">
<li>
<a href="">Contact Us</a>
</li>
<li>
<a href="">Get Help</a>
</li>
<li>
<a href="">Report a Problem</a>
</li>
<li>
<a href="">{{ system.email }} </a>
</li>
</ul>






</div>
</div>






<div class="row">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6" style="text-align:center;padding-top:50px;color:white;margin-top:30px;">
<a href="" style="margin-left:20px;margin-left:20px;">
<em class="icon ni ni-facebook-fill" style="font-size:50px;"></em>
</a>

<a href="" style="margin-left:20px;margin-left:20px;">
<em class="icon ni ni-twitter-round" style="font-size:50px;"></em>
</a>


<a href="" style="margin-left:20px;margin-left:20px;">
<em class="icon ni ni-whatsapp" style="font-size:50px;"></em>
</a>




<a href="" style="margin-left:20px;margin-left:20px;">
<em class="icon ni ni-linkedin" style="font-size:50px;"></em>
</a>


<a href="" style="margin-left:20px;margin-left:20px;">
<em class="icon ni ni-instagram" style="font-size:50px;"></em>
</a>


<a href="" style="margin-left:20px;margin-left:20px;">
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
system:this.$page.props.system.details,


    }}
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
</style>

