<template>
<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu" style="background:#07372F;border:solid thin #07372F;">
<div class="nk-sidebar-element nk-sidebar-head" style="border:none;">
<div class="nk-sidebar-brand" style="border:none;">
<Inertia-link :href="route('home')" class="logo-link nk-sidebar-logo">
<img class="logo-light logo-img" :src="$page.props.system.logo"  alt="logo">
<img class="logo-dark logo-img" :src="$page.props.system.logo">
</Inertia-link>
</div>
<div class="nk-menu-trigger mr-n2">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
</div>
</div><!-- .nk-sidebar-element -->
<div class="nk-sidebar-element">
<div class="nk-sidebar-content">
<div class="nk-sidebar-menu" data-simplebar>
<ul class="nk-menu" v-if="$page.props.auth.user.status=='active'">
<li class="nk-menu-item" v-for="m in menu" :key="m.id">
<Inertia-link :href="route(m.url)" class="nk-menu-link" style="color:white;">
<span class="nk-menu-icon" style="color:white;">
<em :class="m.icon"></em></span>
<span class="nk-menu-text" style="color:white;">
{{ m.name }}
</span>
</Inertia-link>
</li><!-- .nk-menu-item -->




</ul><!-- .nk-menu -->
<ul class="nk-menu" v-else>
<Inertia-link :href="route('dashboard')" class="nk-menu-link" style="color:white;">
<span class="nk-menu-icon" style="color:white;">
<em class="icon ni ni-layout"></em>
</span>
<span class="nk-menu-text" style="color:white;">
Dashboard
</span>
</Inertia-link>
</ul>



</div><!-- .nk-sidebar-menu -->
</div><!-- .nk-sidebar-content -->
</div><!-- .nk-sidebar-element -->
</div>
</template>

<script>
export default {

data(){return{
user:{
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
},
menu:null,
role:this.$page.props.auth.user.role,

//menus
reception_menu:[
{name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{name:'User Accounts',url:'dashboard',icon:'icon ni ni-users-fill'},
{name:'Admin Accounts',url:'dashboard',icon:'icon ni ni-shield-check'},
{name:'Service Providers',url:'dashboard',icon:'icon ni ni-user-list-fill'},
{name:'Applicants',url:'dashboard',icon:'icon ni ni-notes-alt'},
{name:'Interviews',url:'dashboard',icon:'icon ni ni-list-thumb-alt'},
{name:'Dasuns Services',url:'dashboard',icon:'icon ni ni-brick'},
{name:'Employees',url:'employees',icon:'icon ni ni-brick'},
{name:'Payments',url:'dashboard',icon:'icon ni ni-wallet-alt'},
],
//


pssp_menu:[
{name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{name:'Appointments',url:'dashboard',icon:'icon ni ni-calender-date-fill'},
{name:'Requests',url:'dashboard',icon:'icon ni ni-layout'},
{name:'Tasks',url:'dashboard',icon:'icon ni ni-layout'},
{name:'Recommendations',url:'dashboard',icon:'icon ni ni-layout'},
{name:'Wallet',url:'dashboard',icon:'icon ni ni-wallet-alt'},



],
//
admin_menu:[
{name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{name:'User Accounts',url:'users.active',icon:'icon ni ni-users-fill'},
{name:'Admin Accounts',url:'admin.accounts',icon:'icon ni ni-shield-check'},
{name:'Service Providers',url:'service.providers',icon:'icon ni ni-user-list-fill'},
{name:'Appointments',url:'appointments',icon:'icon ni ni-notes-alt'},
{name:'Interviews',url:'interviews',icon:'icon ni ni-list-thumb-alt'},
{name:'Dasuns Services',url:'services',icon:'icon ni ni-brick'},
{name:'Payments',url:'wallet.admin',icon:'icon ni ni-wallet-alt'},
{name:'Pages',url:'sections',icon:'icon ni ni-article'},
],


//
panelist_menu:[
{name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{name:'Interviews Approved',url:'dashboard',icon:'icon ni ni-thumbs-up'},
{name:'Interviews Declined',url:'dashboard',icon:'icon ni ni-thumbs-down'},
{name:'Wallet',url:'dashboard',icon:'icon ni ni-wallet-alt'},
],


//

pssu_menu:[
{id:1, name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{id:2, name:'Appointments',url:'appointments',icon:'icon ni ni-calender-date-fill'},
{id:3, name:'Service Providers',url:'service-providers',icon:'icon ni ni-user-list-fill'},
{id:4, name:'Support Services',url:'support-services',icon:'icon ni ni-view-grid-fill'},
{id:6, name:'Recommendations',url:'dashboard',icon:'icon ni ni-bar-chart-fill'},
{id:7, name:'Wallet',url:'wallet',icon:'icon ni ni-wallet-alt'},
// {id:5, name:'Chat',url:'dashboard',icon:'icon ni ni-chat-circle-fill'},

],


//reception
reception_menu:[
{name:'Dashboard',url:'dashboard',icon:'icon ni ni-layout'},
{name:'User Accounts',url:'dashboard',icon:'icon ni ni-users-fill'},
{name:'Admin Accounts',url:'dashboard',icon:'icon ni ni-shield-check'},
{name:'Service Providers',url:'dashboard',icon:'icon ni ni-user-list-fill'},
{name:'Applicants',url:'dashboard',icon:'icon ni ni-notes-alt'},
{name:'Interviews',url:'dashboard',icon:'icon ni ni-list-thumb-alt'},
{name:'Dasuns Services',url:'dashboard',icon:'icon ni ni-brick'},
{name:'Employees',url:'employee',icon:'icon ni ni-wallet-alt'},

],






}},
methods:{

user_menu(){

if(this.role=='reception'){
this.menu=this.reception_menu;
}else if(this.role=='pssp'){
this.menu=this.pssp_menu;
}else if(this.role=='admin'){
this.menu=this.admin_menu;
}else if(this.role=='panelist'){
this.menu=this.panelist_menu;
}else if(this.role=='pssu'){
this.menu=this.pssu_menu;
}else if(this.role=='reception'){
this.menu=this.reception_menu;
}






},


},
mounted(){
this.user_menu();
}



}
</script>
