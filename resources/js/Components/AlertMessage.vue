<template>
<div>
<div class="alert alert-success alert-icon" v-if="type=='success'">
<em class="icon ni ni-check-circle"></em>
<strong>Thanks for your deposit</strong>.
 Your account balance has been updated accordingly. </div>
</div>
</template>
<script>
export default {
props:{
message:{},
title:{},
type:{}
}



}
</script>
