<template>
    <div class="nk-header nk-header-fixed is-light" style="border:none; box-shadow: 1px 1px 1px #EAEDED;z-index:100000000000">
        <div class="container-fluid" style="z-index:1000000000000;">
        <div class="nk-header-wrap">
        <div class="nk-menu-trigger d-xl-none ml-n1">
        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-header-brand d-xl-none">
        <Inertia-link :href="route('home')" class="logo-link">
        <img class="logo-light logo-img" :src="$page.props.system.logo2" alt="logo">
        <img class="logo-dark logo-img" :src="$page.props.system.logo2" alt="logo-dark">
        </Inertia-link>
        </div><!-- .nk-header-brand -->

        <div class="nk-header-news d-none d-xl-block" style="width:70%;">
        <div class="nk-news-list">
        <!-- <a class="nk-news-item" href="#" @click="search_bar()">
        <div class="nk-news-icon">
        <em class="icon ni ni-search" style="color:#0B5345;"></em>
        </div>
        <div>
        <p style="font-weight:bold;font-size:17px;color:#0B5345;">Search...</p>

        </div>
        </a> -->




        <div class="left">
            <div class="input-group xs-hide" style="margin-left:-25px;;">
            <form style="width:400px;">
            <input type="text" class="form-control" placeholder="Search..." style="border:none;border-radius:10px;background:#f8f9fa;"></form>
            </div>
            </div>


        </div>

        </div><!-- .nk-header-news -->












        <div class="nk-header-tools">
        <ul class="nk-quick-nav">
        <li class="dropdown notification-dropdown mr-n1">
        <Inertia-link :href="route('home')" class="dropdown-toggle nk-quick-nav-icon">
        <div class=""><em class="icon ni ni-home-fill" style="font-size:25px;color:#07372F;"></em></div>
        </Inertia-link>

        </li>
        <li class="dropdown notification-dropdown mr-n1">
        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
        <div><em class="icon ni ni-bell-fill" style="font-size:25px;color:#07372F;"></em>
        <span class="badge badge-danger" style="position:absolute;margin-top:-10px;margin-left:-10px;" v-if="count_notification>0">
            {{ count_notification }}</span>


        </div>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1 border-none">
        <div class="dropdown-head">
        <span class="sub-title nk-dropdown-title bold">Notifications</span>
        <!-- <a href="#">Mark All as Read</a> -->
        </div>
        <div class="dropdown-body">
        <div class="nk-notification">



        <div v-if="pending_notification.length>0">

        <div class="nk-notification-item dropdown-inner" v-for="p in pending_notification" :key="p.id">
        <div class="nk-notification-icon">
        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
        </div>
        <div class="nk-notification-content">
        <div class="nk-notification-text"> <span v-if="p.status=='pending'" class="bold">{{ p.title }}</span>
        <span v-else>{{ p.title }} </span>
        </div>
        <div class="nk-notification-time">{{ p.created_at.substring(0,10).split('-').reverse().join('/') }} </div>
        </div>
        </div>

        </div>

        <div class="text-center text-muted" v-else>
        0 Notification
        </div>




        </div><!-- .nk-notification -->
        </div><!-- .nk-dropdown-body -->
        <div class="dropdown-foot center">
        <Inertia-link :href="route('notifications')">View All</Inertia-link>
        </div>
        </div>
        </li><!-- .dropdown -->
        <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <div class="user-toggle">
        <div class="user-avatar sm" style="background:#07372F;">
        <em class="icon ni ni-user-alt-fill" style="font-size:20px;"></em>
        </div>
        <div class="user-info d-none d-md-block">
        <div class="user-status" style="color:#0B5345;">
        {{ user.email }}
        </div>
        <div class="user-name dropdown-indicator" style=" text-transform: capitalize;font-size:18px;color:#0B5345;">

        {{ user.usernames }}
        </div>
        </div>
        </div>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1" style="border-top:none;">

        <div class="dropdown-inner">
        <ul class="link-list">
        <li><Inertia-link :href="route('profile')"><em class="icon ni ni-user-alt"></em><span>View Profile</span></Inertia-link></li>
        <li><Inertia-link :href="route('settings')"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></Inertia-link></li>
        <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
        <li><Inertia-link :href="route('employee')" v-if="user.role=='admin' || user.role=='reception'"><em class="icon ni ni-activity-alt"></em><span>Employees</span></Inertia-link></li>
        <!-- <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> -->
        </ul>
        </div>
        <div class="dropdown-inner">
        <ul class="link-list">
        <li><Inertia-link :href="route('logout')" method="post" as="button" type="button"><em class="icon ni ni-signout"></em><span>Sign out</span></Inertia-link></li>
        </ul>
        </div>
        </div>
        </li><!-- .dropdown -->
        </ul><!-- .nk-quick-nav -->
        </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->









        <!------filter dialog------->

        <form class=""  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="filter==true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header thick-bg" style="border:none;">
        <h5 class="modal-title" style="color:white;">Advanced Filter</h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="filter_dialog()">
        <em class="icon ni ni-cross"></em>
        </a>
        </div>
        <div class="modal-body" style="max-height:500px;overflow:auto">





        <div class="form-group">
        <label class="form-label" for="default-01"></label>
        <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter names">
        </div>
        </div>




        <div class="form-group">
        <label class="form-label" for="default-01"></label>
        <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter address">
        </div>
        </div>



        <div class="form-group">
        <label class="form-label" for="default-01"></label>
        <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter telephone contact">
        </div>
        </div>




        </div>
        <div class="modal-footer bg-light">
        <span class="sub-text">


        <input type="submit" class="button" value="Filter" style="border-radius:10px"/>



        </span>
        </div>
        </div>
        </div>
        </form>










        <!-----------Search functionality goes here-->




        <form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(192, 25%, 99%, 0.6);" @submit.prevent="submit" v-if="dialog.search==true">

        <div style="width:100%;height:100%; margin-top:-200px;border-radius:10px;" class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius:100px;">
        <div class="modal-header" style="border:none;border-radius:10px;background:#0B5345;">
        <div style="width:100%;">

        <div class="form-control-wrap" style="width:100%; border-radius:100px;">
        <div class="form-icon form-icon-left">
        <em class="icon ni ni-search"></em>
        </div>
        <input type="text" class="form-control" id="default-03" placeholder="Search for services, service providers ..." style="border-radius:50px;padding-right:50px;border:none;" v-model="form.search">
        </div>

        </div>
        </div>

        <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog.search=false" style="position:absolute;margin-right:20px;margin-top:10px;">
        <em class="icon ni ni-cross"></em>
        </a>
        </div>
        </div>
        </form>








        </div>
</template>
<script>
import SearchPanel from '@/Components/SearchPanel';

export default {
components:{
SearchPanel,
},


data(){return{
dialog:{
search:false,

},


form:this.$inertia.form({
search:null,
}),


user:{
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
email:this.$page.props.auth.user.email,
tel:this.$page.props.auth.user.tel,
role:this.$page.props.auth.user.role,
account_type:this.$page.props.auth.user.account_type,
usernames:this.$page.props.auth.user.account_type=='personal'?this.$page.props.auth.user.firstname:this.$page.props.auth.user.firstname,
},

search_option:false,
filter:false,


}},

//search option
methods:{

submit(){
this.form.post(this.route('store.search'),{
onSuccess:()=>{
this.dialog.search=false;
}
});
},





search_bar(){
this.dialog.search=true;
if(this.search_option==false){
this.search_option=true;
}else{
this.search_option=false;
}
$('#focusID').focus();
},
//




//check result
check_result(){
if(this.$page.props.response.count_results!=null){
this.search_option=true;
this.dialog.search=false;
this.form.search=this.$page.props.response.search;
}

},

//
filter_dialog(){
if(this.filter==false){
this.filter=true;
}else{
this.filter=false;
}
},

focus_input(event){
$('#focusID').focus();
}






},

//
mounted(){
this.check_result();
if(this.$page.props.response.search!=null){
this.dialog.search=false;
}
},

computed:{
test(){
if(route().current()=='search.results'){
this.dialog.search=false;
}
},


count_notification(){
return this.$page.props.notification.count;
},

pending_notification(){
return this.$page.props.notification.pending;
},










}







}
</script>
