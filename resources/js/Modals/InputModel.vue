<template>
<div>
<button type="button" @click="show()" style="padding:0;margin:0;font-size:14px;padding-left:15px;padding-right:15px;">Add</button>


<form class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #37BEA7;border:none;">
                    <h5 class="modal-title" style="color:white;">Reference</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show()">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" style="max-height:500px;overflow:auto">





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



<div class="form-group">
    <label class="form-label" for="default-01"></label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter email address">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01"></label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" id="default-01" placeholder="Enter position">
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
export default {
props:{
errors:{},
response:{}
},
data(){return{
open:false,



}},
methods:{
show(){
if(this.open==false){
this.open=true;
}else{
this.open=false;
}



}


}





}
</script>

