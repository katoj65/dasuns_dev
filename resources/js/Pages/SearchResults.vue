<template>
<app-layout>

<div class="card">
<div class="card-header">
<h3> {{ response.search }} </h3>
</div>



<div class="card-body">


Some information



</div>



</div>

</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components:{
AppLayout
},

props:{
response:{},

},


data(){return{






}}




}
</script>
