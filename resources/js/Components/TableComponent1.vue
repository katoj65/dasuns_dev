<template>
<div>

<table class="nk-tb-list nk-tb-ulist">
<thead>
<tr class="nk-tb-item nk-tb-head">
<th class="nk-tb-col"><span class="sub-text">Appointment Dates</span></th>
<th class="nk-tb-col tb-col-lg"><span class="sub-text">Location</span></th>
<th class="nk-tb-col tb-col-lg"><span class="sub-text">Names</span></th>
<th class="nk-tb-col tb-col-lg"><span class="sub-text">Requested at</span></th>
<th class="nk-tb-col tb-col-xxl"><span class="sub-text">Status</span></th>
<th class="nk-tb-col nk-tb-col-tools text-right">
<div class="dropdown">
<a href="#" class="btn btn-xs btn-trigger btn-icon dropdown-toggle mr-n1" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-right">
<ul class="link-list-opt no-bdr">
<li><a href="#"><span>Accepted</span></a></li>
<li><a href="#"><span>Pending</span></a></li>
</ul>
</div>
</div>
</th>
</tr><!-- .nk-tb-item -->
</thead>
<tbody v-if="appointments.length>0">
<tr class="nk-tb-item" v-for="a in appointments" :key="a.id" @click="open(a)" style="cursor:pointer;">
<td class="nk-tb-col">
<a href="" class="project-title">
<div class="user-avatar sq bg-purple-dim">
<em class="icon ni ni-calender-date-fill"></em>
<span>
</span></div>
<div class="project-info">
<h6 class="title">
<span>{{ a.date.substring(0,10).split('-').reverse().join('/') }}</span>
<span v-if="a.end_date!=null">  -  {{ a.end_date!=null?a.end_date.substring(0,10).split('-').reverse().join('/'):'---' }}</span>


</h6>
</div>
</a>
</td>
<td class="nk-tb-col tb-col-lg text-transform">
<span>
{{ a.location }}
</span>
</td>
<td class="nk-tb-col tb-col-lg text-transform">
{{ a.firstname }} {{ a.lastname }}
</td>
<td class="nk-tb-col tb-col-mb">
<span class="badge badge-dim badge-success" v-if="a.status=='accepted'" style="font-size:14px;">
<em class="icon ni ni-clock"></em><span>
{{ a.created_at.substring(0,10).split('-').reverse().join('/') }}
</span>
</span>

<span class="badge badge-dim badge-warning" v-else style="font-size:14px;">
    <em class="icon ni ni-clock"></em><span>
        {{ a.created_at.substring(0,10).split('-').reverse().join('/') }}
    </span>
    </span>

</td>
<td class="nk-tb-col nk-tb-col-tools">
<em class="icon ni ni-check-circle-fill text-success" v-if="a.status=='accepted'" style="font-size:20px;"></em>
<em class="icon ni ni-alert-circle-fill text-warning" v-else-if="a.status=='pending'"  style="font-size:20px;"></em>
</td>
</tr><!-- .nk-tb-item -->

</tbody>
</table>



</div>
</template>
<script>
export default {
props:{
appointments:[]
}
}
</script>
