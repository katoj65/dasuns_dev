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

