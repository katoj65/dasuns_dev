<template>
<div class="nk-block">
<div class="row g-gs">






<div class="col-12 col-md-8">
<div class="card  card-full" style="overflow:auto;height:700px;">
<div class="card-inner bg-warning-dim">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">
<div class="row p-0" style="overflow:auto;">
<div class="col-12 col-md-12 p-0 text-center">
<span class="d-sm-inline  p-1" style="font-weight:normal;text-align:center;">
<em class="icon ni ni-alert-circle"></em> Your submissions are under review by Dasuns team. you will be contacted shortly.
</span>
</div>
</div>
</h6>
</div>
<!-- <div class="card-tools">
<ul class="card-tools-nav">
<li><a href="#"><span>Buy</span></a></li>
<li><a href="#"><span>Sell</span></a></li>
<li class="active"><a href="#"><span>All</span></a></li>
</ul>
</div> -->
</div>
</div><!-- .card-inner -->
<div class="card-inner p-0">
<table class="table">
<thead style="border:none;" class="bg-success-dim">
<tr style="border:none;">
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<em class="icon ni ni-view-list-wd"></em>
Professional Services I Provide
</th>
</tr>
</thead>
<tbody v-if="attributes.services.length>0" style="border:none;">
<tr v-for="s in attributes.services" :key="s.id" style="border:none;">
<td colspan="8" style="border:none;">
{{ s.name }}
</td>


</tr>
</tbody>
<tbody v-else>
<tr>
<td colspan="8">Missing</td>
</tr>
</tbody>

<thead style="border:none;" class="bg-success-dim">
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<em class="icon ni ni-shield-fill"></em>
Identification Documents
</th>
</tr>
</thead>
<tbody v-if="attributes.document.length>0" style="border:none;">
<tr v-for="d in attributes.document" :key="d.id" style="border:none;">
<td colspan="3" style="border:none;">
{{ d.document }}
</td>
<th class="width-100" style="border:none;">
Number
</th>
<td colspan="2" style="border:none;">
{{ d.document_number }}
</td>
<td style="border:none;">
<a href="#" class="hover">Download</a>
</td>
</tr>
</tbody>
<tbody v-else><tr><td>Missing</td></tr></tbody>
<thead class="bg-success-dim">
<th colspan="8" style="border:none;color:#07372F;">
<em class="icon ni ni-folder-fill"></em> Work Experience
</th>
</thead>
<tbody v-if="attributes.experience.length>0">
<tr v-for="a in attributes.experience" :key="a.id" style="border:none;">
<td colspan="3" style="border:none;">
{{ a.organisation_name }}
</td>
<th class="width-100" style="border:none;">Position</th>
<td>
{{ a.position }}
</td>
<th>Dates</th>
<td colspan="2" style="font-size:13px;">
{{ a.from_date }} - {{ a.to_date }}
</td>
</tr>
</tbody>
<tbody v-else><tr><td>Missing</td></tr></tbody>
<thead class="bg-success-dim">
<tr>
<th scope="col" colspan="8" style="border:none;color:#07372F;">
<em class="icon ni ni-users-fill"></em> Professional References
</th>
</tr>
</thead>
<tbody v-if="attributes.reference.length>0">
<tr v-for=" r in attributes.reference" :key="r.id">
<td colspan="2">
{{ r.names }}
</td>
<th style="width:30px;">Tel</th>
<td>{{ r.tel }} </td>
<th class="width-100">Email</th>
<td style="text-transform:lowercase;">{{ r.email }} </td>
<th class="width-100">Position</th>
<td>
{{ r.position }}
</td>
</tr>
</tbody>
<tbody v-else><tr><td>Missing</td></tr></tbody>
</table>





<div style="text-align:center;font-size:18px;color:#07372F;" class="pt-5">
<Inertia-link class="hover">For more information contact Dasuns</Inertia-link>
</div>










</div><!-- .card-inner -->
</div><!-- .card -->
</div><!-- .col -->


















<div class="col-12 col-md-4">
<div class="row g-gs">
<div class="col-md-6 col-lg-12">
<div class="card card-full h-100">
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
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ user.gender }} </span></li>
<li><span>DOB</span><span>{{ user.dob }} </span></li>
<li><span>Email</span><span>{{ user.email }} </span></li>
<li><span>Telephone</span><span>{{ user.tel }} </span></li>
</ul>
<div class="team-view">
<Inertia-link :href="route('profile')" class="btn btn-block btn-dim btn-success"><span>View Profile</span></Inertia-link>
</div>
</div><!-- .team -->
</div>






</div><!-- .card -->
</div><!-- .col -->
</div><!-- .row -->
</div><!-- .col -->
</div><!-- .row -->
</div>
</template>
<script>
export default {
props:{
response:{},
},

data(){return{
attributes:{
document:this.response.user_data.pssp_attributes.identification_documents,
services:this.response.user_data.pssp_attributes.services,
experience:this.response.user_data.pssp_attributes.experience,
reference:this.response.user_data.pssp_attributes.references,
},
//user information
user:this.$page.props.auth.user,


}}



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

</style>
