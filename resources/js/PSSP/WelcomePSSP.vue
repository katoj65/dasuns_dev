<template>
<div>
<vetting-status-pending v-if="status=='pending'" :response="response"></vetting-status-pending>
</div>
</template>
<script>
import VettingStatusPending from '@/PSSP/VettingStatusPending';
import VettingStatusFail from '@/PSSP/VettingStatusFail';
import ApplicationDecline from '@/PSSP/ApplicationDecline';
export default {
components:{
VettingStatusPending,
VettingStatusFail,
ApplicationDecline,

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
