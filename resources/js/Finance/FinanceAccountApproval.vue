<template>
<div class="nk-content-body">
<div class="nk-block">
<div class="card mt-2 mb-2">
<div class="card-aside-wrap">
<div class="card-inner card-inner-lg">
<div class="nk-block-head nk-block-head-lg">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h4 class="nk-block-title" style="font-size:20px;">Welcome to Finance Controller Account</h4>
<div class="nk-block-des">
<p class="text-warning mt-2">

Your account has not been validated by Dasuns Administration yet.

{{ profile }}
</p>
</div>
</div>
<div class="nk-block-head-content align-self-start d-lg-none">
<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
</div>
</div>
</div><!-- .nk-block-head -->
<div class="nk-block">


<div class="nk-data data-list">
<div class="data-head">
<h6 class="overline-title">Your Basic Information</h6>
</div>



<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Full Name</span>
<span class="data-value">Abu Bin Ishtiyak</span>
</div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div><!-- data-item -->




<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Display Name</span>
<span class="data-value">Ishtiyak</span>
</div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>





<!-- data-item -->
<div class="data-item">
<div class="data-col">
<span class="data-label">Email</span>
<span class="data-value">info@softnio.com</span>
</div>
<div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
</div>



<!-- data-item -->
<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Phone Number</span>
<span class="data-value text-soft">Not add yet</span>
</div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>


<!-- data-item -->
<div class="data-item" data-toggle="modal" data-target="#profile-edit">
<div class="data-col">
<span class="data-label">Date of Birth</span>
<span class="data-value">29 Feb, 1986</span>
</div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>


<!-- data-item -->
<div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
<div class="data-col">
<span class="data-label">Address</span>
<span class="data-value">2337 Kildeer Drive,<br>Kentucky, Canada</span>
</div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>

<!-- data-item -->
</div><!-- data-list -->


</div><!-- .nk-block -->
</div>




















<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true" style="border:none;">


<div class="card-inner-group" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;">

<div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">















<div class="card ">
<div class="card-inner">
<div class="team">
<!-- <div class="team-options">
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
<li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
<li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
<li class="divider"></li>
<li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
<li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
<li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
</ul>
</div>
</div>
</div> -->
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success-dim">
<span><em class="icon ni ni-user-alt-fill"></em></span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h6 class="text-transform">{{ user.firstname+' '+user.lastname }} </h6>
<span class="sub-text text-transform">{{ user.role }} </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ user.gender }} </span></li>
<li><span>Contact</span><span>{{ user.tel }} </span></li>
<li><span>Email</span><span>{{ user.email }} </span></li>
</ul>
<div class="team-view">
<Inertia-link :href="route('profile')" class="btn btn-block btn-dim btn-success"><span>View Profile</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</div>

















</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 492px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div><!-- .card-inner-group -->
</div><!-- card-aside -->
</div><!-- .card-aside-wrap -->
</div><!-- .card -->
</div><!-- .nk-block -->
</div>
</template>
<script>
export default {
props:{
response:{},
},
data(){return{
user:this.$page.props.auth.user,
profile:this.$page.props.auth.admin_profile





}}



}
</script>
