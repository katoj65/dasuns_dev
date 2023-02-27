<template>
<div class="alert alert-danger alert-icon alert-dismissible">
<div style="text-align:left;font-size:16px;">
<em class="icon ni ni-cross-circle"></em> <strong>Form Error</strong>! There is a problem with your information. <button class="close" data-dismiss="alert"></button>
</div>
<ul>
<li v-for="e in error" :key="e" style="text-align:left;">
{{ e }}
</li>
</ul>


</div>
</template>
<script>
export default {
    props:{
        error:{},
    }
}
</script>

