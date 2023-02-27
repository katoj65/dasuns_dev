<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;font-family: Arial, Helvetica, sans-serif;">
{{ title }}
</h1>




<div class="row g-gs" style="padding-bottom:10px;">
<div class="col-md-4" v-for="n in 12">
<div class="card card-full" style="text-align:center;border-radius:12px;box-shadow: 0px 0px 10px #D7DBDD;">
<div class="card-inner">
<div class="card-title-group align-start mb-0">

<div style="text-align:center;width:100%;">
<em class="icon ni ni-puzzle-fill" style="color:#0B5345;font-size:50px;"></em>
</div>
</div>


<div style="text-align:center;width:100%;margin-top:30px;">
<h3 style="font-size:20px;font-weight:bold;">
Service information
</h3>
<div style="padding:10px;font-size:16px;">
20 Services
</div>
</div>





</div>
</div><!-- .card -->
</div><!-- .col -->






</div>









</div>

</div>
</div>
</div>
</div>
</layout-un-auth>
</template>
<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth';
export default {
components:{
LayoutUnAuth
},

props:{
title:{},
response:{}


    },

data(){return{




    }},
methods:{


}



}
</script>

