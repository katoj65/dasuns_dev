<template>
<div>
<a href="#" class="dropdown-item" @click="set_location">Edit location</a>
<form class="" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="show==true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit location</h5>
<a href="#" class="close">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto;">
<div class="form-group">
<label class="form-label" for="default-01">
Location
<input-error></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name">
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01">
Country
<input-error></input-error>
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter first name">
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
</template>
<script>
import InputError from '../Alerts/InputError.vue';
export default {
components:{
InputError
},
props:{
list:{},
flash:{},
errors:{}
},

data(){return{
show:false,




}},

methods:{
set_location(){
this.show=true;
}
}



}
</script>
