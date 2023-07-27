<template>
<layout-un-auth-vue>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">

<h4 style="font-size:25px;" class="text-center">
{{ service.name }}
</h4>







<div class="row mt-5" v-if="response.providers.length>0">
</div>
<div class="center" v-else></div>
</div>






</div>
</div>
</div>
</layout-un-auth-vue>
</template>
<script>
import LayoutUnAuthVue from '../Layouts/LayoutUnAuth.vue'
export default {
    components:{
LayoutUnAuthVue,
    },
props:{
response:{},
title:{},
},

data(){return{

}},

computed:{
service(){
return this.response.service;
}


}







}
</script>
<style scoped>
.btn-dim:hover{
color:white;
}
.btn-dim{
color:#07372F
}
</style>
