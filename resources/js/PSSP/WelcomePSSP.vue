<template>
<div>
<vetting-status-pending v-if="status=='pending'" :response="response"></vetting-status-pending>
<InterviewPSSP :response="response" v-else-if="status=='interview'"></InterviewPSSP>
</div>
</template>
<script>
import VettingStatusPending from '@/PSSP/VettingStatusPending';
import VettingStatusFail from '@/PSSP/VettingStatusFail';
import ApplicationDecline from '@/PSSP/ApplicationDecline';
import InterviewPSSP from '@/PSSP/InterviewPSSP';
export default {

components:{
VettingStatusPending,
VettingStatusFail,
ApplicationDecline,
InterviewPSSP,
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
