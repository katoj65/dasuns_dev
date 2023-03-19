<template>
<button class="btn btn-dim btn-danger" @click="open">Deactivate Account</button>
</template>

<script>
export default {

methods: {
open() {
this.$confirm('Do you really want to deactivate your account?', 'Confirm Account Deactivation', {
confirmButtonText: 'Deactivate account',
cancelButtonText: 'Cancel',
type: 'warning',
center: true
}).then(() => {
this.delete();
this.$notify({
title:'Successful',
message:'You have successfully deactivated your account.',
type:'success',
position:'bottom-right'
});


}).catch(() => {
// this.$notify({
// title:'Account not Deleted',
// message:'You did not delete the account.',
// type:'warning',
// position:'bottom-right'
// });

});
},


delete(){
const id=this.$page.props.auth.user.id;
this.$inertia.post(this.route('account.destroy'),{
id:id});
}






}
}
</script>
