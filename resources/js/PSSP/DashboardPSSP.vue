<template>
<div>

<CreateProfilePSSP v-if="user.profile.length==0" :response="response" :errors="errors" :flash="flash"></CreateProfilePSSP>
<WelcomePSSP v-else :response="response" :errors="errors" :flash="flash"></WelcomePSSP>

</div>
</template>
<script>
import CreateProfilePSSP from '@/PSSP/CreateProfilePSSP';
import WelcomePSSP from '@/PSSP/WelcomePSSP';
export default {
components:{
CreateProfilePSSP,
WelcomePSSP,

},
props:{
response:{},
errors:{},
flash:{}
},
data(){return{
user:{
role:this.$page.props.auth.user.role,
profile:this.$page.props.auth.user_profile,
}




}},






}
</script>
