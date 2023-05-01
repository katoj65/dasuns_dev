<template>
<el-dropdown trigger="click">
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right text-muted"></i>
</span>
<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_items()"></el-button>
</el-dropdown-item>

<el-dropdown-menu slot="dropdown" style="color:red;margin-top:-3px;" color="red" >
<el-dropdown-item>
<el-button type="clear" icon="el-icon-delete" style="border:none;" @click="delete_items()"></el-button>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</template>
<script>
export default {
    props:{
options:{}
    },

methods:{
delete_items(){
this.$inertia.post(this.route(this.options[1]),
{id:this.options[0]},{
onSuccess:()=>{
this.$inertia.get(this.route().current());
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'Item has been deleted.',
type: 'success'
});
}
});
}




}




}
</script>
