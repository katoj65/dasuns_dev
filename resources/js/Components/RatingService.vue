<template>
<div class="block text-center mb-4">
<span class="demonstration">Service Delivery Rating</span>
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
