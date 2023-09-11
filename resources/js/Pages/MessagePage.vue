<template>
<app-layout style="overflow:hidden;">

<div class="card p-0" style="overflow:hidden;">
<div class="card-body p-0">
<div class="nk-ibx  border-0">

<div class="nk-ibx-aside toggle-screen-lg hide-aside" data-content="inbox-aside" data-toggle-overlay="true" data-toggle-screen="lg" style="margin-top:3px;padding-top:0;z-index:-0;">
<div class="nk-ibx-head">
<h5 class="mb-0">Message</h5>

</div>
<div class="nk-ibx-nav" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
<div class="simplebar-content" style="padding: 0px;">



<div class="card">
<div class="card-body text-center">
<em class="icon ni ni-user-circle-fill" style="font-size:50px;"></em>
<h5 class="mt-3 mb-0 text-transform mb-2">{{ user.firstname }} {{ user.lastname }} </h5>
<strong>Service Number:</strong> <span>{{ response.number.number }} </span>
<!-- <Inertia-link :href="route('profile.pssp',{id:user.id})" class="btn btn-default btn-sm mt-2">View Profile</Inertia-link> -->

</div>
</div>








</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 907px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 186px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
</div>
<div class="nk-ibx-body bg-white">
<div class="nk-ibx-head">
<div class="nk-ibx-head-actions">
<div class="nk-ibx-head-check">
<div class="custom-control custom-control-sm custom-checkbox">
<input type="checkbox" class="custom-control-input nk-dt-item-check" id="conversionAll">
<label class="custom-control-label" for="conversionAll"></label>
</div>
</div>
<ul class="nk-ibx-head-tools g-1">
<li><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-undo"></em></a></li>
<li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-archived"></em></a></li>
<li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-trash"></em></a></li>
<li>
<div class="dropdown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
<div class="dropdown-menu">
<ul class="link-list-opt no-bdr">
<li><a class="dropdown-item" href="#"><em class="icon ni ni-eye"></em><span>Move to</span></a></li>
<li><a class="dropdown-item" href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
<li><a class="dropdown-item" href="#"><em class="icon ni ni-archived"></em><span>Archive</span></a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>










<div>
<ul class="nk-ibx-head-tools g-1">
<li><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="" data-original-title="Prev Page"><em class="icon ni ni-arrow-left"></em></a></li>
<li><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="" data-original-title="Next Page"><em class="icon ni ni-arrow-right"></em></a></li>
<li><a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a></li>
<li class="mr-n1 d-lg-none"><a href="#" class="btn btn-trigger btn-icon toggle" data-target="inbox-aside"><em class="icon ni ni-menu-alt-r"></em></a></li>
</ul>
</div>
<div class="search-wrap" data-search="search">
<div class="search-content">
<a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
<input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
<button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
</div>
</div>
</div>
<div class="nk-ibx-list" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;background:#F4F6F6;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
<div class="simplebar-content" style="padding: 0px;background:#F4F6F6;min-height:500px;">











<div class="nk-ibx-item">
<a href="#" class="nk-ibx-link"></a>







<div class="nk-ibx-item-elem nk-ibx-item-user">
<div class="user-card">
<div class="user-avatar">

</div>
<div class="user-name">
<div class="lead-text">Abu Bin Ishtiyak </div>
</div>
</div>
</div>
<div class="nk-ibx-item-elem nk-ibx-item-fluid">
<div class="nk-ibx-context-group">
<div class="nk-ibx-context">
<span class="nk-ibx-context-text">
<span class="heading">Can we help you set up email forwording?</span> We’ve noticed you haven’t set up email forward </span>
</div>
</div>
</div>



<div class="nk-ibx-item-elem nk-ibx-item-attach">
</div>
<div class="nk-ibx-item-elem nk-ibx-item-time">
<div class="sub-text">10:00 AM</div>
</div>
<div class="nk-ibx-item-elem nk-ibx-item-tools">
<div class="ibx-actions">
<ul class="ibx-actions-hidden gx-1">
<li>
<a href="#" class="btn btn-sm btn-icon btn-trigger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Archive"><em class="icon ni ni-archived"></em></a>
</li>
<li>
<a href="#" class="btn btn-sm btn-icon btn-trigger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><em class="icon ni ni-trash"></em></a>
</li>
</ul>
<ul class="ibx-actions-visible gx-2">
<li>
<div class="dropdown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a class="dropdown-item" href="#"><em class="icon ni ni-eye"></em><span>View</span></a></li>
<li><a class="dropdown-item" href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
<li><a class="dropdown-item" href="#"><em class="icon ni ni-archived"></em><span>Archive</span></a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>












</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1810px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 93px; transform: translate3d(0px, 132px, 0px); display: block;"></div></div></div>
<div class="nk-ibx-view show-ibx">
<div class="nk-ibx-head">
<div class="nk-ibx-head-actions">
<ul class="nk-ibx-head-tools g-1">
<li class="ml-n2"><a href="#" class="btn btn-icon btn-trigger nk-ibx-hide"><em class="icon ni ni-arrow-left"></em></a></li>
<li><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Archive"><em class="icon ni ni-archived"></em></a></li>
<li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Mark as Spam"><em class="icon ni ni-report"></em></a></li>
<li><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Delete"><em class="icon ni ni-trash"></em></a></li>
<li><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Label"><em class="icon ni ni-label"></em></a></li>
<li>
<div class="dropdown">
<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
<div class="dropdown-menu">
<ul class="link-list-opt no-bdr">
<li><a class="dropdown-item" href="#"><span>Mark as unread</span></a></li>
<li><a class="dropdown-item" href="#"><span>Mark as not important</span></a></li>
<li><a class="dropdown-item" href="#"><span>Archive this message</span></a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>
<div class="nk-ibx-head-actions">
<ul class="nk-ibx-head-tools g-1">
<li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Prev"><em class="icon ni ni-chevron-left"></em></a></li>
<li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="" data-original-title="Next"><em class="icon ni ni-chevron-right"></em></a></li>
<li class="mr-n1 mr-lg-0"><a href="#" class="btn btn-icon btn-trigger search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a></li>
</ul>
</div>
<div class="search-wrap" data-search="search">
<div class="search-content">
<a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
<input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
<button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
</div>
</div>
</div>
<div class="nk-ibx-reply nk-reply" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;background:#F4F6F6;height:700px;">









<div class="nk-ibx-reply-group border-0" v-if="messages.length>0" style="width:90%;padding-left:20px;margin-top:20px;">










<div class="chat is-you"  v-for="(m,key) in messages" :key="key"
:style="m.myID==m.senderID?'float:left;margin-bottom:10px;margin-right:100px;':'float:right;margin-top:10px;margin-left:100px;'">

<div class="chat-content">
<div class="chat-bubbles">



<div class="chat-bubble">
<div class="chat-msg">
{{m.message}}
</div>

<ul class="chat-msg-more">
<li class="d-none d-sm-block">
</li>
<li>

</li>
</ul>
</div>
</div>
<ul class="chat-meta">
<li class="text-transform">{{ m.sender_details.firstname }}  <span v-if="m.sender_details.account_type!='institutional'">{{ m.sender_details.lastname }}</span></li>
<li>{{ m.created_at.substring(0,10).split('-').reverse().join('/') }}</li>
</ul>
</div>
</div>





















</div>



<div v-else>
No Content
</div>










</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1062px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 159px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
</div>
</div>
</div>




</div>

<div class="card-footer">

<div class="nk-reply-form-field">
<textarea class="form-control form-control-simple no-resize" placeholder="Write message "></textarea>
</div>


</div>
</div>





</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout

},

props:{
title:{},
response:{}
},


computed:{
user(){
return this.response.user;
},
messages(){
return this.response.message;
},

}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;





}
</style>
