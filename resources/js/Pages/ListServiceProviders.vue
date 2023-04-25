<template>
<layout-un-auth>

Some information


</layout-un-auth>
</template>
<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth.vue';
export default {
components:{
LayoutUnAuth
},
    props:{
    title:{},
    response:{}
    }
}
</script>
