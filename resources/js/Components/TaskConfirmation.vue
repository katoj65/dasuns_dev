<template>
<div v-if="ongoing!=''" style="margin-top:5px;width:100%;position:fixed;z-index:10000;left:0;bottom:0;border-radius:10px 10px 10px 10px">
<div class="alert alert-success alert-icon" style="border-radius:0;padding-top:10px;padding-bottom:10px:">
<div class="row">
<div class="col-md-2 col-12">

</div>
<div class="col-md-8 col-12">
<em class="icon ni ni-check-circle"></em>
<strong class="mr-3">{{ ongoing.title }}</strong>
<span class="mr-2"><em class="icon ni ni-calendar-booking" style="font-size:20px;"></em>
{{ ongoing.start_date.split('-').reverse().join('/') }}
</span>
<span class="mr-2">-</span>
<span>
{{ ongoing.end_date!=null?ongoing.end_date.split('-').reverse().join('/'):null }}
</span>

<span class="ml-2 mr-2">
<em class="icon ni ni-clock"></em>
</span>
<span>
{{ ongoing.start_time }}
</span>
<span>-</span>
<span>
{{ ongoing.end_time }}
</span>


<span v-if="ongoing.button==true">
<span class="ml-5" v-if="ongoing.status=='past' && ongoing.role_confirm=='pending'">
<button class="button" style="padding:7px;margin:0;font-size:13px;font-weight:bold;padding-left:15px;padding-right:15px;"> Confirm Task Completion</button>
</span>
</span>



</div>
<div class="col-md-2 col-12 text-transform">

<div v-if="ongoing.button==true && ongoing.status=='past'">
<b> <span v-if="ongoing.other_party_confirmation=='done'">
<em class="icon ni ni-user-check-fill"  style="font-size:20px;margin-top:15px;"></em> {{ ongoing.other_party_names }}
</span>
<span v-else class="text-transform">
<em class="icon ni ni-alert-circle mr-2" style="font-size:20px;margin-top:15px;"></em>{{ ongoing.other_party_names }}
</span>
</b>

</div>


</div>
</div>
</div>
</div>

</template>
<script>
export default {
date(){return{

}},
computed:{
ongoing(){
return this.$page.props.data.ongoing_appointment;
}
}
}
</script>
