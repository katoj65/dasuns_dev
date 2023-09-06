<template>
<div v-if="ongoing!=''" style="margin-top:5px;width:100%;position:fixed;z-index:10000;left:0;bottom:0;border-radius:10px 10px 10px 10px">
<div class="alert alert-success alert-icon" style="border-radius:0;padding-top:10px;padding-bottom:10px:">
<div class="row">
<div class="col-md-2 col-12">


</div>
<div class="col-md-8 col-12">
<em class="icon ni ni-check-circle"></em>
<strong class="mr-3">{{ ongoing.title }}</strong>
<span class="mr-3"><em class="icon ni ni-calendar-booking" style="font-size:20px;"></em>
{{ ongoing.start_date }}
</span>
<span>
{{ ongoing.end_date }}
</span>
<span class="ml-5">
<button class="button" style="padding:7px;margin:0;font-size:13px;font-weight:bold;padding-left:15px;padding-right:15px;"> Confirm Task Completion</button>
</span>
</div>
<div class="col-md-2 col-12">

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
