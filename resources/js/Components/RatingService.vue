<template>
<div class="block text-center mb-4">
<el-rate class="mt-2"   v-model="rating"></el-rate>
</div>
</template>
<script>
export default {
    props:{
    rating:{}
    }
}
</script>
