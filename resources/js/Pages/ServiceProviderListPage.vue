<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;font-family: Arial, Helvetica, sans-serif;">
{{ title }}
</h1>

<div>
<div class="row">

<div class="col-md-2 col-12"></div>
<div class="col-md-8 col-12">





<div class="row p-0" v-for="n in 50" style="box-shadow: 0px 0px 10px #D7DBDD;margin:20px;border-radius:10px;border-bottom:solid 3px #0B5345;">
<div class="col-3 p-3">
<img :src="'../public/images/avatar/a-sm.jpg'" style="border-radius:100%;width:100px;"/>
</div>
<div class="col-5 p-3">
<h2 style="font-size:20px;font-weight:bold;">
Micheal Kintu
</h2>
<p style="margin-top:10px;">
<em class="icon ni ni-folder-fill"></em>
Sign Language Interpreter
</p>

<p style="margin-top:10px;">
<em class="icon ni ni-map-pin-fill"></em>
Kampala - Ntinda
</p>


</div>
<div class="col-4 p-10" style="text-align:right;">
<a href="#" class="btn" style="background:background:#45B39D;font-size:14px;"><em class="icon ni ni-reports"></em><span>View </span></a>
</div>
</div>





















</div>
<div class="col-md-2 col-12"></div>



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

