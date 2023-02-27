<template>
<form>
<div class="card-body" style="padding:30px;">
<div class="form-group">
<span style="float:right;padding:10px;">
<a href="#" style="color:green;font-size:15px;" @click="dialog.change_field=false">Cancel </a>
</span>
<label class="form-label" for="default-07">Add Services
<input-error :error="errors.services"></input-error>
</label>
<div class="form-control-wrap">
<div>



<select class="form-control" id="default-07" @change="select($event)">
<option value="">--Select service--</option>
<option  v-for="i in services" :key="i.id" :value="i.id">
{{ i.name }}
</option>
</select>

</div>
</div>
</div>

</div>


</form>
</template>
<script>
import InputError from '@/Alerts/InputError';
export default {
props:{
services:{}
},
components:{
 InputError
}


}
</script>
