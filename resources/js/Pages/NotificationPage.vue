<template>
<app-layout>
<div class="row mt-2">
<div class="col-12 col-md-8">
<div class="card card-radius">
<div class="card-header">
<div class="card-title">
<h5 class="title">Notifications</h5>
</div>
</div>

<div class="card-body m-0 p-0 pb-4" style="min-height:600px; ">

<div v-if="notifications.length>0">

    <div class="nk-msg-item current" data-msg-id="1" v-for="n in notifications" :key="n.id">
        <div class="user-avatar user-avatar-sm bg-success-dim">
            <span><em class="icon ni ni-bell"></em></span>
        </div>
        <div class="nk-msg-info">
            <div class="nk-msg-from">
                <div class="nk-msg-sender">
                    <div class="name bold" style="color:black;">{{ n.title }} </div>
                    <!-- <div class="lable-tag dot bg-pink"></div> -->
                </div>
                <div class="nk-msg-meta">
                    <div class="attchment"><em class="icon ni ni-calender-date-fill"></em></div>
                    <div class="date">{{ n.created_at.substring(0,10).split('-').reverse().join('/') }} </div>
                </div>
            </div>
            <div class="nk-msg-context">
                <div class="nk-msg-text">
                    <!-- <h6 class="title">Unable to select currency when order.</h6> -->
                    <p>{{ n.description }} </p>
                </div>
                <div class="nk-msg-lables">
                    <!-- <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div> -->
                </div>
            </div>
        </div>
    </div>


</div>
<div v-else class="text-muted">No notification content</div>



</div>

</div>


</div>
<div class="col-12 col-md-4">

<div class="card card-radius h-100">
<div class="card-header">
<div class="card-title">
<h4 class="title">Calendar</h4>
</div>
</div>
<div class="card-body">
<calendar-component></calendar-component>
</div>



</div>

</div>
</div>
</app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import CalendarComponent from '../Components/CalendarComponent.vue';
export default {
components:{AppLayout,
CalendarComponent
},
props:{
response:{},
},


computed:{
notifications(){
return this.response.notification;
},

},

methods:{




},

mounted(){

}














}
</script>
