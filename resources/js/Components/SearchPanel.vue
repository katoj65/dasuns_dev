<template>
<form style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(192, 15%, 99%, 0.6);" @submit.prevent="submit">



<div style="width:100%;height:100%; margin-top:-200px;border-radius:100px;" class="modal-dialog" role="document">
<div class="modal-content" style="border-radius:100px;">
<div class="modal-header" style="background: #37BEA7;border:none;border-radius:100px;">
<div style="width:100%;">

<div class="form-control-wrap" style="width:100%; border-radius:100px;">
<div class="form-icon form-icon-left">
<em class="icon ni ni-search"></em>
</div>
<input type="text" class="form-control" id="default-03" placeholder="Search for services, service providers ..." style="border-radius:50px;padding-right:50px;" v-model="form.search">
</div>

</div>
</div>

<slot></slot>
<!-- <div class="modal-body" style="max-height:500px;overflow:auto">





<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter names">
</div>
</div>




<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter address">
</div>
</div>



<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="text" class="form-control" id="default-01" placeholder="Enter telephone contact">
</div>
</div>




</div>
<div class="modal-footer bg-light">
<span class="sub-text">


<input type="submit" class="button" value="Filter" style="border-radius:10px"/>



</span>
</div> -->
</div>
</div>
</form>

</template>



<script>
export default {
props:{},
data(){return{

form:this.$inertia.form({
search:null,
}),

}},
methods:{
submit(){
this.form.post(this.route('store.search'),{
});
},



}
}
</script>
