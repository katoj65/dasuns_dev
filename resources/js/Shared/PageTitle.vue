<template>
<el-page-header @back="back()" content="slot" style="font-weight:bold;">
<template slot="content">
<span style="text-transform">
{{ title.heading }}
</span>
</template>
</el-page-header>
</template>

<script>
export default {
props:{
title:{}
},
methods:{
back(){
this.$inertia.get(this.route(this.title.url));
},
}
}
</script>
