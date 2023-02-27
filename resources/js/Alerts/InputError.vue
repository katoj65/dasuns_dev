<template>
<span v-if="error!=null" style="color:red;">
{{ error }}
</span>
</template>
<script>
export default {
    props:{
        error:{}

        },
}
</script>
