<template>
<app-layout>
<div class="row m-2 pt-2">
<div class="card">
<class="card-header">
<divclass="card-title">
<h4></h4>
</div>
</div>


</div>


</div>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout,
},
props:{
title:{},
response:{}
},
data(){return{




}},
computed:{
pssp(){
return this.response.pssp;
},

number(){
return this.response.number;
},

service(){
return this.response.service;
}



}




}
</script>
