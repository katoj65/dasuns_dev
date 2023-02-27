<template>
<app-layout>

<DashboardPSSU v-if="user.role=='pssu'" :response="response" :errors="errors"></DashboardPSSU>
<DashboardPSSP v-if="user.role=='pssp'" :response="response" :errors="errors"></DashboardPSSP>
<DashboardAdmin v-if="user.role=='admin'" :response="response"></DashboardAdmin>
<dashboard-reception v-if="user.role=='reception'" :response="response" :errors="errors"></dashboard-reception>
<dashboard-finance v-if="user.role=='finance'" :response="response" :errors="errors"></dashboard-finance>
<dashboard-panelist v-if="user.role=='panelist'" :response="response.user_data" :errors="errors" :flash="flash"></dashboard-panelist>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import DashboardPSSU from '@/PSSU/DashboardPSSU';
import DashboardPSSP from '@/PSSP/DashboardPSSP';
import DashboardAdmin from '@/Admin/DashboardAdmin';
import DashboardReception from '@/Reception/DashboardReception.vue';
import DashboardFinance from '@/Finance/DashboardFinance';
import DashboardPanelist from '@/Panelist/DashboardPanelist';



export default {
components: {
AppLayout,
DashboardPSSU,
DashboardPSSP,
DashboardAdmin,
DashboardReception,
DashboardFinance,
DashboardPanelist


},

props:{
response:{},
title:{},
errors:{},
flash:{}
},

data(){return{
user:this.$page.props.auth.user,




}}











}
</script>
