<template>
<div>
<VettingStatusPending v-if="status=='pending'" :response="response"/>
<InterviewPSSP :response="response" v-else-if="status=='interview'"/>
<DashboardActivePSSP v-else-if="status=='active'"/>
</div>
</template>
<script>
import VettingStatusPending from '@/PSSP/VettingStatusPending';
import VettingStatusFail from '@/PSSP/VettingStatusFail';
import ApplicationDecline from '@/PSSP/ApplicationDecline';
import InterviewPSSP from '@/PSSP/InterviewPSSP';
import DashboardActivePSSP from '@/PSSP/DashboardActivePSSP';
export default {

components:{
VettingStatusPending,
VettingStatusFail,
ApplicationDecline,
InterviewPSSP,
DashboardActivePSSP
},

props:{
title:{},
response:{},
},






computed:{
status(){
return this.$page.props.auth.user.status;
}



}














}
</script>
