<template>
    <div class="nk-header nk-header-fluid is-theme" style="background:#45B39D;border:none;">
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
<span class="nk-menu-text">How it works11</span>
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

</template>
<script>
export default{
props:{

},
components:{



}




}


</script>

<style  scoped>
.active .nk-menu-item{




}
</style>
