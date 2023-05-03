<template>
<div>
<table class="table">
<thead class="border-0">
<tr>
<th scope="col" class="border-0" v-for="t in head" :key="t">{{ t }} </th>
</tr>
</thead>
<tbody v-if="body.length>0">
<tr v-for="p in body" :key="p.id">
<td scope="row" :class="p.status=='pending'?'text-warning':'text-success'">
{{ p.date.substring(0,10).split('-').reverse().join('/') }}

<!-- <span v-if="p."> - </span> -->

</td>
<td class="text-transform">{{ p.firstname }} {{ p.lastname }} </td>
<td>
{{ p.service.name }}
<!-- <span v-if="p.count_services>0">+ {{ p.count_services }}  </span> -->
</td>
<td class="text-transform">{{ p.location }} </td>
<td style="width:20px;">
<em class="icon ni ni-check-circle-fill text-success" v-if="p.status=='accepted'" style="font-size:20px;"></em>
<em class="icon ni ni-alert-circle-fill text-warning" v-else-if="p.status=='pending'"  style="font-size:20px;"></em>
</td>
</tr>

</tbody>
</table>
</div>
</template>
<script>
export default {
    props:{
    body:[],
    head:[],
    }
}
</script>
