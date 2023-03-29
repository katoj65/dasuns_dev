
<template>
<v-calendar color="sky-blue" :attributes="attrs" style="border:none;width:100%;" expanded/>
</template>
<script>
export default {
data(){return{

attrs:[{
highlight: true,
dates: new Date(),
}],





}}
}
</script>
