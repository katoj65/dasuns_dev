<template>
<app-layout>
<pssu-institution-profile v-if="role=='pssu' && account_type=='institutional'" :response="response" :errors="errors"/>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import PssuInstitutionProfile from '@/Profiles/PssuInstitutionProfile';

export default {
components:{
AppLayout,
PssuInstitutionProfile

},

props:{
response:{},
title:{},
errors:{},

},

data(){
return{


}
},

//

computed:{
account_type(){
return this.response.type;
},

role(){
return this.response.role;
}




}









}
</script>

<style scoped>
table thead tr td{
border-bottom:solid thin #F2F3F4;
}

table thead tr th{
border-bottom:solid thin #F2F3F4;
}

table tbody tr td{
padding:10px;
border:none;
}
.word-transform{
text-transform: capitalize;
}

table tbody tr th{
border:none;
text-transform: capitalize;
}

table tbody tr td{
border:none;
text-transform: capitalize;
}

.ul ul li{
list-style-type: circle;

}

.bold{
font-weight: bold
;
}

ul li{
border:none;
}


</style>
