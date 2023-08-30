<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">










    



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
request(){
return this.response.request;
}




}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;





}
</style>
