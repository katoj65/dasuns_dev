<template>
<div class="card mb-0">
<div class="card-body">
<div class="row">
<div class="col-lg-4 col-md-3 col-sm-6">
<div class="input-group">
<h6>{{ title }} </h6>
</div>
</div>
<div class="col-lg-5 col-md-9 col-sm-6">
<slot></slot>
</div>
</div>
</div>
</div>
</template>
<script>
export default {
props:{
title:{}
}
}
</script>
