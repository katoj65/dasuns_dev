<template>
<layout-un-auth>
<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="container">

<div class="row">

<div class="col-12 col-md-12">
<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;">
{{ title }}
</h1>

<div class="h-100" style="min-height:600px;">

<div class="row pt-4">
<div class="col-12 col-md-2"></div>
<div class="col-12 col-md-8">

<el-collapse v-model="activeName" accordion>
  <el-collapse-item :name="n.id" v-for="n in response.terms" :key="n.id" style="font-size:17px;">

<template slot="title">
 <h1 style="font-weight:bold;font-size:18px;">{{ n.title }}</h1>
</template>

    <div>{{ n.description }} </div>

  </el-collapse-item>

</el-collapse>



</div>
<div class="col-12 col-md-2"></div>
</div>











</div>



</div>

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
LayoutUnAuth,

},
    props:{
        response:{},
        title:{},
    },

}
</script>
