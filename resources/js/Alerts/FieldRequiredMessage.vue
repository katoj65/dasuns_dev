<template>
    <div v-if="error!=null" style="color:red">
   <span style="padding-right:10px;">* Field is required.</span>
    </div>
</template>
<script>
export default{
props:{
error:{}
}


}
</script>
