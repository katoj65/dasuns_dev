<template>
<div class="row mt-2">
<div class="col-12 col-md-4">
<el-card shadow="never" class="card h-100">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2">
<div class="user-avatar lg" style="background:#37BEA7;">
<span><em class="icon ni ni-user-alt-fill"></em></span>
</div>
<div class="user-info text-transform">
<h2 style="font-size:20px;">{{ user.firstname }} {{ user.lastname }} </h2>
<span class="sub-text text-transform mt-2">
{{ user.account_type }} Account
</span>
<div class="sub-text text-transform mt-2">
<strong style="margin-right:10px;">Service No:</strong>  {{ dasuns_number }}
</div>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ user.gender }} </span></li>
<li><span>DOB</span><span>{{ user.dob }} </span></li>
<li><span>Telephone</span><span>{{ user.tel }} </span></li>
<li><span>Email</span><span>{{ user.email }} </span></li>
</ul>
<div class="team-view">
<Inertia-link :href="route('profile')" class="btn btn-block btn-success" v-if="user.status=='pending'"><span>Edit Profile</span></Inertia-link>
<button class="btn btn-block btn-success" disabled v-else-if="user.status=='interview'">Edit Profile</button>


</div>
</div>
</div>
</el-card>
</div>



<div class="col-12 col-md-8">
<el-card shadow="never" class="card h-100">
<div slot="header" class="clearfix">
<h4>Professional Service Provider Account</h4>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>



<div class="card-body p-0 m-0">
<table class="table">
<thead style="border:none;">
<tr style="border:none;">
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
Personal Statement
</div>
</th>
</tr>
</thead>
<tbody>
<tr>
<td class="text-muted">
{{ results.statement.about!=null?results.statement.about:'Missing' }}
</td>
</tr>
</tbody>
</table>


<table class="table mt-3" style="border:none;">
<thead style="border:none;">
<tr style="border:none;">
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
Professional Services I Provide
</div>
</th>
</tr>
</thead>
<tbody v-if="results.services.length>0" style="border:none;">
<tr v-for="s in results.services" :key="s.id" style="border:none;">
<td colspan="8" style="border:none;" class="pl-5">
<em class="icon ni ni-bullet-fill"></em> {{ s.name }}
</td>
</tr>
<tr>
<td colspan="8" style="padding:10px;"></td>
</tr>
</tbody>
<tbody v-else style="border:none;">
<tr>
<td colspan="8" class="text-warning">Missing</td>
</tr>
</tbody>
</table>
<el-divider></el-divider>




<table class="table">
<thead>
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;" class="pt-2">
<div>
Identification Documents
</div>
</th>
</tr>
</thead>
<tbody v-if="results.identification.length>0" style="border:none;">
<tr v-for="d in attributes.identification" :key="d.id" style="border:none;">
<td colspan="3" style="border:none;">
<div class="pl-4">
{{ d.document }}
</div>
</td>
<th class="width-100" style="border:none;">

</th>
<td colspan="2" style="border:none;">
{{ d.document_number }}
</td>
<td style="border:none;">
<a href="#" class="hover">Download</a>
</td>
</tr>
</tbody>
<tbody v-else><tr><td class="text-warning">
<div class="p-2">Missing</div>
</td></tr></tbody>
</table>

<el-divider></el-divider>




<table class="table mt-3">
<thead>
<th colspan="8" style="border:none;color:#07372F;">
<div>
Work Experience
</div>
</th>
</thead>
<tbody v-if="results.experience.length>0">
<tr v-for="a in results.experience" :key="a.id" style="border:none;">
<td colspan="3" style="border:none;">
<div class="pl-4">
{{ a.organisation_name }}
</div>
</td>
<th class="width-100" style="border:none;">Position</th>
<td>
{{ a.position }}
</td>
<th style="border:none;">Dates</th>
<td colspan="2" style="font-size:13px;">
{{ a.from_date }} - {{ a.to_date }}
</td>
</tr>
</tbody>
<tbody v-else><tr><td class="text-warning">

<div class="p-2">Missing</div>
</td></tr></tbody>
</table>








<el-divider></el-divider>
<table class="table mt-2">
<thead>
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<div>
Profession References
</div>
</th>
</tr>
</thead>
<tbody v-if="results.references.length>0">
<tr>
<th>
<div class="pl-4">
Names
</div>
</th>
<th>Contacts</th>
<th>Position</th>
</tr>
<tr v-for=" r in results.references" :key="r.id">
<td>
<div class="pl-4">{{ r.names }}</div>
</td>
<td style="text-transform:lowercase">
<div class="pb-4">
<div><em class="icon ni ni-call"></em> {{ r.tel }}</div>
<div><em class="icon ni ni-mail"></em>
{{ r.email }}
</div>
</div>

</td>
<td class="text-transform">{{ r.position }}</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">
<div class="p-2 pb-5">Missing</div>
</td></tr>
</tbody>
</table>







</div>

















</el-card>
</div>
</div>
</template>
<script>
export default {
props:{
response:{},
},



computed:{
//
user(){
return this.$page.props.auth.user;
},

//
dasuns_number(){
return this.response.user_data.pssp_attributes.dasuns_number;
},

results(){
const item=this.response.user_data.pssp_attributes;
const response={

'identification':item.identification_documents,
'services':item.services,
'experience':item.experience,
'references':item.references,
'interview':item.interview,
'decline':item.interview_decline,
'statement':item.statement

};
return response;
}




}







}
</script>

<style scoped>
.width-100{
width:100px;
}

table thead tr th{
padding:10px;
}

table tbody tr th, table tbody tr td{
padding:10px;
text-transform: capitalize;

}

table thead tr, table tbody tr{border:none;}

table thead tr th, table tbody tr td{border:none;}

.ac{
--color:red;
--background:red;
--border:none;

}
.ac{
background-color: aqua;
background:red;
}

</style>


