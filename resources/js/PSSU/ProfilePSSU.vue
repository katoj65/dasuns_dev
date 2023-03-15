<template>
<page-wrapper>
<page-wrapper v-if="account_type==='personal'">
<div>
<div class="row mt-2 mb-2">
<div class="col-12 col-md-4">






<el-card class="card h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="team-options">



<el-dropdown trigger="click" style="z-index:0;">
<span class="el-dropdown-link btn btn-dim btn-success">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>Upload porfile picture</el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.edit_user=true" class="p-1">Edit user information</a></el-dropdown-item>

<el-dropdown-item><a href="#" @click="dialog_box.edit_profile=true" class="p-1">Edit Profile</a></el-dropdown-item>

<el-dropdown-item><a href="#" @click="dialog_box.add_service=true" class="p-1">Add services</a></el-dropdown-item>

<el-dropdown-item v-if="disability_status=='true'"><a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1">Add disabilities</a></el-dropdown-item>

<el-dropdown-item v-if="user.account_type=='institutional'"><a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1">New Contact Person</a></el-dropdown-item>

<el-dropdown-item>Settings</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>



</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span>
<em class="icon ni ni-user-alt-fill"></em>
</span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h2 class="text-transform mb-2">{{ $page.props.auth.user.firstname+' '+$page.props.auth.user.lastname }} </h2>
<span class="sub-text"><strong style="font-weight:bold;color:black;" class="mr-1">Dasuns No:</strong> {{ response.user_data.profile.dasuns_number }} </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ $page.props.auth.user.gender }} </span></li>
<li><span>Date of Birth</span><span>
{{ $page.props.auth.user.dob.split('-').reverse().join('/') }}
</span></li>
<li><span>Telephone</span><span>
{{ $page.props.auth.user.tel }}
</span></li>
<li><span>Email</span><span>
{{ $page.props.auth.user.email }}
</span></li>

<li v-if="user_profile.location!=null"><span>Location</span><span class="text-transform">
{{ user_profile.location }}
</span></li>
<li v-if="user_profile.name!=null"><span>Country</span><span class="text-transform">
{{ user_profile.name }}
</span></li>
</ul>





<div class="team-view pt-2">
<Inertia-link :href="route('dashboard')" class="btn btn-block btn-dim btn-success"><span>
Dashboard</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>



</div>
<div class="col-12 col-md-8">

<el-card class="card h-100 pt-2" style="min-height:700px;" shadow="never">

<div slot="header" class="clearfix">
<h3>Service User Profile</h3>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div class="card-inner p-0">
<table style="width:100%;">
<thead>
<tr>
<th>
<h1><em class="icon ni ni-caret-right-fill"></em> Services I Need from Dasuns Platform</h1>
</th>
</tr>
</thead>
<tbody v-if="response.user_data.profile.services.length>0">
<tr v-for="n in response.user_data.profile.services" :key="n.id">
<td class="pt-2 pl-2">
<em class="icon ni ni-dot"></em> {{ n.name }}
</td>
<td style="width:20px;">
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_services(n.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
<tr>
<td class="p-2"></td>
</tr>
</tbody>
<thead class="border-top">
<tr>
<th colspan="2" class="p-4"></th>
</tr>
<tr>
<th colspan="1">
<h1>
<em class="icon ni ni-caret-right-fill"></em> My Disabilities
<span class="text-transform text-muted">
({{ disability_status=='true'?'Yes':'No' }})
</span>
</h1>
</th>
<td>
</td>
</tr>
<tr v-if="response.user_data.profile.disabilities.length==0">
<td colspan="2" class="p-4">
<div>

<a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1 btn btn-light"><em class="icon ni ni-property-add"></em> Add disabilities</a>

</div>
</td>
</tr>
</thead>
<tbody>
<tr v-for="d in response.user_data.profile.disabilities" :key="d.id">
<td class="pt-2 pl-2">
<em class="icon ni ni-dot"></em> {{ d.name }}
</td>
<td>
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_disabilities(d.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
<tr>
<td colspan="2" class="p-3"></td>
</tr>
</tbody>






<tbody v-if="$page.props.auth.user.account_type=='institutional'"  class="border-top">
<tr>
<td colspan="2" class="pt-3">

<div class="card thick-border h-100 mt-3">
<div class="card-header thick-bg" style="border-radius: 0px 0px 0 0;">
<h1 style="color:white;">
<em class="icon ni ni-shield-check"></em>
Organisation Contact Person Information
</h1>
</div>

<div class="card-inner p-0">
<div class="project">
<div class="project-head pl-4 pr-4 pt-2 pb-0">
<span class="project-title">
<div class="user-avatar sq bg-success"><span><em class="icon ni ni-user-alt-fill"></em></span></div>
<div class="project-info">
<h6 class="title text-transform">
{{ contact_person.firstname +' '+contact_person.lastname}}
</h6>
<span class="sub-text text-transform">{{ contact_person.gender }} </span>
</div>
</span>
</div>




    <div class="card m-0">
    <ul class="data-list is-compact m-0 p-0 border-0">
     <li class="data-item p-0 border-0"></li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Telephone</div>
    <div class="data-value">
{{ contact_person.tel }}
    </div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Email</div>
    <div class="data-value">{{ contact_person.email }}</div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4 pb-4">
    <div class="data-col">
    <div class="data-label">Designation</div>
    <div class="data-value text-transform">{{ contact_person.role }}</div>
    </div>
    </li>
    </ul>
    </div>


</div>
</div>
</div>
</td>
</tr>
</tbody>

<tbody class="border-top">
<tr>
<tr>
<th colspan="2" class="p-2"></th>
</tr>
<tr>
<td colspan="2">
<div class="row">
<div class="col-12 col-md-4">
<strong>
<em class="icon ni ni-caret-right-fill"></em>
Joined Dasuns Platform
</strong>
</div>
<div class="col-12 col-md-4">
<span class="badge badge-success p-1" style="font-size:16px;">
{{ user.created_at.substring(0,10).split('-').reverse().join('/') }}
</span>
</div>
</div>
</td>
</tr>
</tbody>





</table>








</div>
</el-card>
</div>

<!---------Dialog information-->

<form @submit.prevent="submit" class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.edit_user==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit User Information</h5>
<a href="#" class="close" @click="dialog_box.edit_user=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">






<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form_user.firstname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.lastname">
</div>
</div>






<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" @change="select_gender($event)">
<option :value="user.gender">{{ user.gender }} </option>
<option value="male" v-if="user.gender!='male'">Male</option>
<option value="female" v-if="user.gender!='female'">Female</option>
<option value="other" v-if="user.gender!='other'">Other</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.dob"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.dob">
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form_user.tel">
</div>
</div>





</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>

<!------------services--->


<form @submit.prevent="submit_services" v-if="dialog_box.add_service==true">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Profession Support Services</h5>
<a href="#" class="close" @click="dialog_box.add_service=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<!-- {{ response.user_data.list_services }} -->

<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.service"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_service($event)">
<option value="">Select</option>
<option :value="r.id" v-for="r in response.user_data.list_services" :key="r.id">
{{ r.name }}
</option>
</select>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</div>

</form>

<!------Disabilities------->

<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.add_pssu_disability==true" @submit.prevent="submit_disability">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Disabilities</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.add_pssu_disability=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body">


<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.disability"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_disability($event)">
<option value="">-- Select Disability --</option>
<option v-for="ds in response.user_data.list_disabilities" :key="ds.id" :value="ds.id">
{{ ds.name }}
</option>

</select>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button class="button" type="submit" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;">Save</button>
</span>
</div>
</div>
</div>
</form>








<!-------Update profile------>
<form class=""  v-if="dialog_box.edit_profile==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit4">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Edit Profile</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.edit_profile=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">






<div class="form-group">
<label class="form-label" for="default-01">Select Disability:</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" placeholder="Enter names" @change="change_disability($event)">
<option :value="selected_disability">{{ selected_disability }} </option>
<option v-for="d in disability_status_loop" :key="d.id">
{{ d.name }}
</option>
</select>
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">Location:</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter location" v-model="form_update_profile.location">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
Select Country:
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="change_country($event)">
<option :value="c.id" v-for="c in country" :key="c.id">{{ c.name }} </option>
</select>
</div>
</div>



</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<input type="submit" class="button" value="Save" style="border-radius:10px"/>

</span>
</div>
</div>
</div>
</form>












</div>
</div>
</page-wrapper>













<page-wrapper v-else>
<div class="row mt-2 mb-2">
<div class="col-12 col-md-4">
<el-card class="card h-100" shadow="never">
<div class="card-inner">
<div class="team">
<div class="team-options">

<el-dropdown trigger="click" style="z-index:0;">
<span class="el-dropdown-link btn btn-dim btn-success">
<em class="icon ni ni-more-h"></em>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>Upload porfile picture</el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.edit_user=true" class="p-1">Edit user information</a></el-dropdown-item>
<el-dropdown-item><a href="#" @click="dialog_box.add_service=true" class="p-1">Add services</a></el-dropdown-item>
<el-dropdown-item v-if="user.account_type=='institutional'"><a href="#" @click="dialog_box.add_pssu_disability=true" class="p-1">Edit Contact Person</a></el-dropdown-item>

<el-dropdown-item>Settings</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>


</div>
<div class="user-card user-card-s2">
<div class="user-avatar lg bg-success">
<span>
<em class="icon ni ni-user-alt-fill"></em>
</span>
<div class="status dot dot-lg dot-success"></div>
</div>
<div class="user-info">
<h2 class="text-transform mb-2">{{ $page.props.auth.user.firstname }} </h2>
<span class="sub-text"><strong style="font-weight:bold;color:black;" class="mr-1">Service No:</strong> {{ response.user_data.profile.dasuns_number }} </span>
</div>
</div>
<ul class="team-info">
<li><span>Gender</span><span class="text-transform">{{ $page.props.auth.user.gender }} </span></li>
<li><span>Date of Birth</span><span>
{{ $page.props.auth.user.dob.split('-').reverse().join('/') }}
</span></li>
<li><span>Telephone</span><span>
{{ $page.props.auth.user.tel }}
</span></li>
<li><span>Email</span><span>
{{ $page.props.auth.user.email }}
</span></li>
</ul>
<div class="team-view pt-2">
<Inertia-link :href="route('dashboard')" class="btn btn-block btn-dim btn-success"><span>
<em class="icon ni ni-wallet-fill mr-1"></em>
Dashboard</span></Inertia-link>
</div>
</div><!-- .team -->
</div><!-- .card-inner -->
</el-card>



</div>
<div class="col-12 col-md-8">










<el-card class="card h-100 pt-2" style="min-height:700px;" shadow="never">
<div slot="header" class="clearfix">
<h3>Organisation  Profile Information</h3>
<!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
</div>
<div class="card-inner">
<table style="width:100%;">
<thead>
<tr>
<th>
<h1><em class="icon ni ni-caret-right-fill"></em> Services I Need from Dasuns Platform</h1>
</th>
</tr>
</thead>


<tbody v-if="response.user_data.profile.services.length>0">
<tr v-for="n in response.user_data.profile.services" :key="n.id">
<td class="pt-2 pl-2">
<em class="icon ni ni-dot"></em>
{{ n.name }}
</td>
<td style="width:20px;">
<el-dropdown>
<span class="el-dropdown-link">
<i class="el-icon-arrow-down el-icon--right"></i>
</span>
<el-dropdown-menu slot="dropdown">
<el-dropdown-item>
<a href="#" class="p-1" @click="delete_services(n.id)"><em class="icon ni ni-trash" style="font-size:20px;"></em></a>
</el-dropdown-item>
</el-dropdown-menu>
</el-dropdown>
</td>
</tr>
</tbody>
<tbody v-if="$page.props.auth.user.account_type=='institutional'">
<tr>
<td colspan="2" class="pt-3">

<div class="card thick-border h-100 mt-3">
<div class="card-header thick-bg" style="border-radius: 0px 0px 0 0;">
<h1 style="color:white;">
<em class="icon ni ni-shield-check"></em>
Organisation Contact Person Information
</h1>
</div>

<div class="card-inner p-0">
<div class="project">
<div class="project-head pl-4 pr-4 pt-2 pb-0">
<span class="project-title">
<div class="user-avatar sq bg-success"><span><em class="icon ni ni-user-alt-fill"></em></span></div>
<div class="project-info">
<h6 class="title text-transform">
{{ contact_person.firstname +' '+contact_person.lastname}}
</h6>
<span class="sub-text text-transform">{{ contact_person.gender }} </span>
</div>
</span>
</div>




    <div class="card m-0">
    <ul class="data-list is-compact m-0 p-0 border-0">
     <li class="data-item p-0 border-0"></li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Telephone</div>
    <div class="data-value">
{{ contact_person.tel }}
    </div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4">
    <div class="data-col">
    <div class="data-label">Email</div>
    <div class="data-value">{{ contact_person.email }}</div>
    </div>
    </li>
    <li class="data-item border-0 p-1 pl-4 pb-4">
    <div class="data-col">
    <div class="data-label">Designation</div>
    <div class="data-value text-transform">{{ contact_person.role }}</div>
    </div>
    </li>
    </ul>
    </div>


</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>









<div class="bottom clearfix border-top p-2 mt-5">
<time class="time">Joined Dasuns Platform:</time>
<span class="text-success bold ml-3">{{ user.created_at.substring(0,10).split('-').reverse().join('/') }}</span>
</div>
</el-card>
</div>




















<!---------Dialog information-->

<form @submit.prevent="submit" class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.edit_user==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit User Information</h5>
<a href="#" class="close" @click="dialog_box.edit_user=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form_user.firstname">
</div>
</div>



<!-- <div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.lastname">
</div>
</div> -->






<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.gender"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" @change="select_gender($event)">
<option :value="user.gender">{{ user.gender }} </option>
<option value="male" v-if="user.gender!='male'">Male</option>
<option value="female" v-if="user.gender!='female'">Female</option>
<option value="other" v-if="user.gender!='other'">Other</option>
</select>
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.dob"></input-error>
</label>
<div class="form-control-wrap">
<input type="date" class="form-control" id="default-01" placeholder="Enter last name" v-model="form_user.dob">
</div>
</div>





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form_user.tel">
</div>
</div>





</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</form>











<!------------services--->
<form @submit.prevent="submit_services" v-if="dialog_box.add_service==true">
<div class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Profession Support Services</h5>
<a href="#" class="close" @click="dialog_box.add_service=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<!-- {{ response.user_data.list_services }} -->

<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.service"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_service($event)">
<option value="">Select</option>
<option :value="r.id" v-for="r in response.user_data.list_services" :key="r.id">
{{ r.name }}
</option>
</select>
</div>
</div>

</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<input type="submit" class="button" value="Save" style="border-radius:10px"/>
</span>
</div>
</div>
</div>
</div>

</form>















<!------Contact Person Form------->
<form  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="dialog_box.add_pssu_disability==true" @submit.prevent="submit3">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Contact Person</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="dialog_box.add_pssu_disability=false">
<em class="icon ni ni-cross"></em>
</a>
</div>
<div class="modal-body" style="max-height:450px;overflow:auto;">





<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.firstname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.firstname">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.lastname"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter last name" v-model="form3.lastname">
</div>
</div>









<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.disability"></input-error>
</label>
<div class="form-control-wrap">
<select class="form-control text-transform" id="default-01" @change="select_edit_gender($event)">
<option :value="form3.gender">{{form3.gender}}</option>
<option v-for="g in gender_format" :key="g.id" :value="g.name">
{{ g.name }}
</option>
</select>
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.designation"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.designation">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.tel"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.tel">
</div>
</div>

<div class="form-group">
<label class="form-label" for="default-01">
<input-error :error="errors.email"></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name" v-model="form3.email">
</div>
</div>






</div>
<div class="modal-footer bg-light">
<span class="sub-text">
<button class="button" type="submit" style="padding-left:20px;padding-right:20px;font-size:17px;border-radius:10px;">Save</button>
</span>
</div>
</div>
</div>
</form>


























</div>
</page-wrapper>
</page-wrapper>


</template>
<script>
import PageWrapper from '@/Shared/PageWrapper';
import InputError from '@/Alerts/InputError';
export default {
components:{
InputError,
PageWrapper,
},
props:{
response:{},
flash:{},
errors:{},

},



data(){return{
//selected country name
selected_country:null,
selected_countryID:null,
//
selected_disability_item:null,
//disability status
disabilities:[
{id:1,name:'true'},
{id:2,name:'false'}
],

//
form_update_profile:this.$inertia.form({
location:null,
country:null,
disability:null
}),


//genders
gender:[
{id:1,name:'male'},
{id:2,name:'female'},
{id:3,name:'other'}
],

//form for editing service provider
form3:this.$inertia.form({
firstname:null,
gender:null,
tel:null,
email:null,
designation:null,
}),

//start dialog box

dialog_box:{
edit_user:false,
add_disability:false,
delete_account:false,
add_service:false,
add_pssu_disability:false,
delete_account:false,
edit_profile:false,

},
//

form_user:this.$inertia.form({
firstname:this.$page.props.auth.user.firstname,
lastname:this.$page.props.auth.user.lastname,
gender:this.$page.props.auth.user.gender,
dob:this.$page.props.auth.user.dob,
tel:this.$page.props.auth.user.tel,

}),

//
form_service:this.$inertia.form({
service:null
}),

//
form_disability:this.$inertia.form({
disability:null,
}),





}},




methods:{
change_country(event){
this.form_update_profile.country=event.target.value;
},
change_disability(event){
this.form_update_profile.disability=event.target.value;
},


submit4(){
this.form_update_profile.post(this.route('pssu.update_profile'),{
onSuccess:()=>{
const flash=this.$page.props.flash;
this.dialog_box.edit_profile=false;
this.$notify({
title:flash.success!=null?'Successful':'Error',
message:flash.success!=null?flash.success:flash.warning,
type:flash.success!=null?'success':'warning',
position:'bottom-right'

});
}
});
},


disability_load(){
this.selected_disability_item =this.response.user_data.profile.user_profile.disability;
},





delete_services(id){
this.$inertia.post(this.route('delete-services'),{
id:id,
},{
onSuccess:()=>{
this.$inertia.get(route('profile'));
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'Profession service has been deleted.',
type: 'success'
});
}
});

},




//
delete_disabilities(id){
this.$inertia.post(this.route('pssu.delete-disability'),{
id:id},{
onSuccess:()=>{
this.$notify({
title:'Succesfull',
message:this.$page.props.flash.success,
type:'success',
position:'bottom-right'
});
}
}
);
},


//dialog box
edit_user_information(){
this.dialog_box.edit_user=true;
},


//
submit(){
this.form_user.post(this.route('user_update_account'),{
onSuccess:()=>{
this.dialog_box.edit_user=false;
this.$notify({
position: 'bottom-right',
title: 'Successful',
message: 'User information has been updated.',
type: 'success'
});

}
});

},

//
select_gender(event){
this.form_user.gender=event.target.value;
},


//
submit_services(){
this.form_service.post(this.route('pssu.store-services'),{
onSuccess:()=>{
this.$notify({
position: 'bottom-right',
title: this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning'
});
this.dialog_box.add_service=false;
}
});

},

//
select_service(event){
this.form_service.service=event.target.value;
},

//
select_disability(event){
this.form_disability.disability=event.target.value;
},

//
submit_disability(){
this.form_disability.post(this.route('pssu.store_disability'),{
onSuccess:()=>{
this.dialog_box.add_pssu_disability=false;
this.$notify({
position:'bottom-right',
title:this.$page.props.flash.success?'Successful':'Warning',
message:this.$page.props.flash.success?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success?'success':'warning',
});



}
});


},


data_load(){
this.contact_person=this.response.user_data.profile.contact_person;
const admin=this.response.user_data.profile.contact_person
this.form3.firstname=admin.firstname;
this.form3.lastname=admin.lastname;
this.form3.gender=admin.gender;
this.form3.email=admin.email;
this.form3.tel=admin.tel;
this.form3.designation=admin.role;
},

//select edit gender
select_edit_gender(event){
this.form3.gender=event.target.value;
},







//submit 3
submit3(){
this.form3.post(this.route('pssu.update_contact_person'),{
onSuccess:()=>{
this.dialog_box.add_pssu_disability=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
type:this.$page.props.flash.success!=null?'success':'warning',
position:'bottom-right'
});
}
});
},



//
selected_profile(){
this.form_update_profile.location=this.response.user_data.profile.user_profile.location;
this.form_update_profile.country=this.response.user_data.profile.user_profile.countryID;
this.form_update_profile.disability=this.response.user_data.profile.user_profile.disability;

},






},




//
mounted(){
this.disability_load();
this.data_load();
this.selected_profile();
},


//
computed:{
format_countries(){
const countries=this.response.user_data.country;
const country=[];
// countries.forEach(element=>{

// });
return countries;
},



//
disability_status_loop(){
const payload=[];
const item=this.response.user_data.profile.user_profile.disability;
this.disabilities.forEach(element=>{
if(item!=element.name){
payload.push({id:element.id,name:element.name});
}
});
return payload;
},




//
selected_disability(){
return this.response.user_data.profile.user_profile.disability;
},


//
country(){
this.selected_country=this.response.user_data.profile.user_profile.name;
this.selected_countryID=this.response.user_data.profile.user_profile.countryID;
return this.response.user_data.profile.country;
},


disability_status(){
return this.response.user_data.profile.user_profile.disability;
},



//
user_profile(){
return this.response.user_data.profile.user_profile;
},

//contact person
contact_person(){
return this.response.user_data.profile.contact_person;
},
//account type
account_type(){
return this.$page.props.auth.user.account_type;
},

//contact person
admin(){
const user=this.$page.props.auth.account_type;

return user=='personal'?null:this.response.user_data.profile.contact_person;
},
// user information
user(){
return this.$page.props.auth.user;
},

//format gender
gender_format(){
const item=[];
this.gender.forEach(element=>{
if(this.form3.gender!=element.name){
item.push({
id:element.id,name:element.name
});
}
});
return item;
}






}

}
</script>
<style scoped>
.dropdown-toggle:hover, .btn-sm:hover, .btn-icon:hover, .btn-trigger:hover{
background: none;
}




</style>
