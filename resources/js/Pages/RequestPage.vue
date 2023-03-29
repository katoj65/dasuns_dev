<template>
<AppLayout>
<div>

<el-card shadow="never" style="min-height:800px;">
<div slot="header">
<h4>Requests</h4>
</div>
<div class="row">
<div class="col-md-9 col-12">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner p-0">
<table class="table table-tranx is-compact">
<thead>
<tr class="tb-tnx-head">
<th class="tb-tnx-info">
Appointment Details
</th>

<th class="tb-tnx-info">
Start Date
</th>

<th class="tb-tnx-info">
End Date
</th>

<th class="tb-tnx-info">
Time
</th>

<th>
</th>

</tr>




</thead>
<tbody>



<tr class="tb-tnx-item" v-for="p in pending" :key="p.id">
<td class="tb-tnx-id">
<span class="text-transform">
<em class="icon ni ni-label"></em>
{{ p.firstname }} {{ p.lastname }}
</span>
</td>
<td class="tb-tnx-id">
<span>
{{ p.date }}
</span>
</td>
<td class="tb-tnx-id">
<span>
{{ p.end_date!=null?p.end_date:'-----' }}
</span>
</td>
<td class="tb-tnx-id">
<span>
{{ p.from}} - {{ p.to }}
</span>
</td>
<td>
<a href="" class="text-success">View Details</a>
</td>

</tr>
</tbody>
</table>
</div><!-- .card-inner -->
<div class="card-inner">
<!-- <ul class="pagination justify-content-center justify-content-md-start">
<li class="page-item"><a class="page-link" href="#">Prev</a></li>
<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
<li class="page-item"><a class="page-link" href="#">6</a></li>
<li class="page-item"><a class="page-link" href="#">7</a></li>
<li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul> -->

<!-- .pagination -->
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div>
</div>
<div class="col-md-3 col-12">
<CalendarComponent/>
</div>
</div>
</el-card>
</div>
</AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import CalendarComponent from '@/Components/CalendarComponent';

export default {
components:{
AppLayout,
CalendarComponent
},

props:{
title:{},
response:{},
},




computed:{
pending(){
return this.response.pending_appointments;
},
accepted(){
return this.response.accepted_appointments;
}



}


}
</script>
