<template>

<div class="row pt-2 pb-3">
<div class="col-12 col-md-4">
<el-card class="card  h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="user-card user-card-s2 ">
<!-- <div class="mb-3">
<span>

<em class="icon ni ni-calender-date-fill text-success" style="font-size:50px;"></em>

</span>
</div> -->

<div class="user-avatar sq bg-warning-dim" style="width:70px;height:60px;">
<span><em class="icon ni ni-calender-date-fill text-warning" style="font-size:50px;margin:10px;"></em></span>

</div>

<div class="user-info">
<h1 style="font-size:20px;" class="mb-2 mt-3">{{ i.date }} </h1>
<span class="sub-text pt-4" style="font-size:20px;"><em class="icon ni ni-clock mr-3 text-success"></em> {{ i.time }}</span>
</div>
</div>






<div v-if="i.status=='pending' || i.status=='interview'">

<div class="team-view mt-5" v-if="$page.props.auth.user.role=='panelist'">
<div v-if="panelist_status==false">
<a href="#" class="btn btn-block btn-success" @click="recommendation_dialog(true)"><span>Recommend Applicant</span></a>
</div>
<!-- <div class="text-muted">
<em class="icon ni ni-check-circle-fill text-success" style="font-size:50px;"></em>
</div> -->
</div>

<div class="team-view mt-5" v-else>
<span v-if="response.panelists.length>0">
<button disabled class="btn btn-block btn-dim  btn-outline-success btn-round">{{ response.panelists.length>1?response.panelists.length+' Panelists':response.panelists.length+' Panelist'}} </button>
</span>
<span v-else>
<a href="#" class="btn btn-block btn-dim btn-success" @click="change_dialog(true)"><span>Change</span></a>
</span>
</div>

</div>

<div v-else-if="i.status=='active'">
<div class="team-view mt-5">
<button class="btn btn-block btn-dim btn-success " disabled><span><em class="icon ni ni-check-circle mr-3"></em> Recommended</span></button>
</div>
</div>



</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>
</div>

<div class="col-12 col-md-8">
<el-card class="card h-100" shadow="true">
<div slot="header" class="clearfix">
<span><strong style="font-size:18px;">Interview Appointment</strong></span>
<el-dropdown trigger="click" style="float:right;" v-if="role=='reception'">
<span class="el-dropdown-link">
<buttopn class="btn bg-success" ><em class="icon ni ni-more-h text-white"></em></buttopn>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" style="padding:5px;" @click="delete_item(response.interview.interviewID)">Delete</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
  </div>


<div class="card-body p-0" style="min-height:700px;">
<div class="mt-0">
<ul class="data-list is-compact">

<li class="data-item">
<div class="data-col">
<div class="data-label">Names</div>
<div class="data-value text-transform" style="font-weight:bold;">{{ i.firstname }} {{ i.lastname }} </div>
</div>
</li>

<li class="data-item">
<div class="data-col">
<div class="data-label">Gender</div>
<div class="data-value text-transform"> {{ i.gender }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value">
{{ i.dob }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Telephone Number</div>
<div class="data-value">
{{ i.tel }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value">{{ i.email }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Physical Address</div>
<div class="data-value text-transform">
{{ i.location }}
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Country of Residence</div>
<div class="data-value">{{ i.country }} </div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Dasuns Number </div>
<div class="data-value">{{ i.number }} </div>
</div>
</li>







<li class="data-item mt-3">
<div class="data-col">
<div class="data-label">
<div>
<h1 class="mb-1 size15">
<em class="icon ni ni-list-thumb-alt-fill"></em>
Services
</h1>
<div>
<ul>
<li v-for="x in s" :key="x.id">
<span>
<em class="icon ni ni-dot"></em>
</span>
<span>{{ x.name }}</span>
</li>
</ul>
</div>
</div>
</div>
<!-- <div class="data-value text-break">1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</div> -->
</div>
</li>







<li class="data-item pt-4">
<div class="data-col">
<!-- <div class="data-label">Comment</div> -->
<div class="data-value">
<div>
<h1 class="pb-2 size15">
<em class="icon ni ni-alert-fill"></em>
Comment
</h1>
<div>
{{ i.comment }}
</div>
</div>
</div>
</div>
</li>




<li class="pt-4">
<div>


<el-collapse accordion >
<el-collapse-item name="1">
<template slot="title">
<h3 class="size15" style="padding-left:20px;padding-right:20px;">
<em class="icon ni ni-shield-fill text-muted"></em>
Identification Documents
</h3>
</template>
<div style="padding-left:20px;padding-right:20px;">

<table style="width:100%;" class="text-muted">
<tbody v-if="documents.length>0">
<tr v-for="d in documents" :key="d.id">
<td>
{{ d.document }}
</td>
<td>
{{ d.document_number }}
</td>
<td>
<a href="#">File</a>
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">
Missing
</td>
</tr>
</tbody>
</table>




</div>
</el-collapse-item>
<el-collapse-item  name="2">
<template slot="title">
<h3 class="size15 bold" style="padding-left:20px;padding-right:20px;"><em class="icon ni ni-folder-fill text-muted"></em> Profession Experience</h3>
</template>
<div class="pl-2 pr-2">
<table class="table">
<thead>
<tr class="border-0">
<th scope="col" class="border-0">Organisation</th>
<th scope="col" class="border-0">Position</th>
<th scope="col" class="border-0">From date</th>
<th scope="col" class="border-0">To date</th>
</tr>
</thead>
<tbody class="border-0" v-if="response.expereinces.length>0">
<tr v-for="e in response.expereinces" :key="e.id" class="border-0">
<td scope="row" class="border-0 text-transform">
{{ e.organisation_name }}
</td>
<td class="border-0 text-transform">
{{ e.position }}
</td>
<td class="border-0">
{{ e.from_date }}
</td>
<td class="border-0">
{{ e.to_date }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">Missing</td>
</tr>
</tbody>
</table>
</div>
</el-collapse-item>


<el-collapse-item name="3">
<template slot="title">
<h3 class="bold size15" style="padding-left:20px;padding-right:20px;">
<em class="icon ni ni-tag-fill text-muted"></em> Profession References</h3>
</template>
<div class="pl-2 pr-2" style="padding-left:20px;padding-right:20px;">
<table class="table">
<thead>
<tr class="border-0">
<th scope="col" class="border-0">Names</th>
<th scope="col" class="border-0">Telephone</th>
<th scope="col" class="border-0">Email</th>
<th scope="col" class="border-0">Address</th>
<th scope="col" class="border-0">Position</th>

</tr>
</thead>
<tbody class="border-0" v-if="response.references.length>0">
<tr v-for="r in response.references" :key="r.id" class="border-0">
<td scope="row" class="border-0 text-transform">
{{ r.names}}
</td>
<td class="border-0 text-transform">
{{ r.tel }}
</td>
<td class="border-0">
{{ r.email }}
</td>
<td class="border-0">
{{ r.address }}
</td>
<td class="border-0 text-transform">
{{ r.position }}
</td>
</tr>
</tbody>
<tbody v-else>
<tr>
<td class="text-warning">Missing</td>
</tr>
</tbody>
</table>
</div>
</el-collapse-item>
</el-collapse>


</div>
</li>







<li class="data-item">
<div class="card thick-border card-preview mt-2" style="width:100%;">
<table class="table table-ulogs"  style="margin-top:-3px;">
<thead class="thick-bg">
<tr>
<th>
Panelist Names
</th>
<th colspan="1">
Recommendations
</th>
</tr>
</thead>
<tbody v-if="response.panelists.length>0">

<tr v-for="r in response.panelists">
<td class="text-transform p-2">
<em class="icon ni ni-user-alt-fill text-warning mr-2"></em>
{{ r.firstname }} {{ r.lastname }}
</td>
<td class="p-2">
<div v-if="r.recommendation.length>0">
<div v-for="rc in r.recommendation">
<span class="mr-2 text-success">
{{ rc.name }} :
</span>
<span>
{{ rc.comment }}
</span>
</div>
</div>
<div v-else class="text-warning">
No recommendation yet.
</div>
</td>
</tr>

</tbody>

<body v-else>
<tr><td colspan="2">No recommendations so far.</td></tr>
</body>
</table>
</div>









</li>
</ul>
</div>
</div>



<div class="card-footer bg-light" v-if="response.has_recommendations==true && i.status=='interview'">
<div class="row">
<div class="col-12 col-md-6">
</div>
<div class="col-12 col-md-6" style="text-align:right;">
<el-dropdown trigger="click">
<span class="el-dropdown-link btn btn-success" style="font-size:15px;">
Account Approval<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item><a href="#" @click="dialog_confirmation()" style="padding:10px;">Approve</a></el-dropdown-item>
<el-dropdown-item><a href="#" style="padding:10px;" @click="dialog_rejection()">Reject</a></el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</div>
</div>
</div>
</el-card>



<!--------->











</div>
</div>
</template>
