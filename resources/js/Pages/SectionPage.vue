<template>
<app-layout>
<div class="nk-content p-3">




<div class="row">

<div class="col-12 col-md-12">


    <div class="card">
        <div class="card-header">
        <h3 class="card-title text-transform">Sections</h3>
        <div class="card-options">
        <a href="#" class="btn btn-primary">Add Content</a>
        </div>
        </div>


        <div class="card-body" v-if="section.length>0">



            <ul class="recent_comments list-unstyled">
                <li v-for="(s,key) in section" :key="key">

                    <div class="comment_body">
                        <h6>{{s.title}}  <small class="float-right">{{s.created_at.substring(0,10)}} </small></h6>
                        <p>{{s.description}} </p>
                        <div>
                            <span class="tag tag-success text-transform">{{s.tag }} </span>
                            <a href="javascript:void(0);"><i class="icon-bubbles"></i></a>
                            <a href="javascript:void(0);"><i class="icon-trash"></i></a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <div v-else class="p-5">No content</div>
        </div>





</div>
</div>


</div>



















<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #37BEA7;border:none;">
                    <h5 class="modal-title" style="color:white;">Reference</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

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
</app-layout>
</template>
<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
components:{
AppLayout
},

props:{
title:{},
response:{},
errors:{},
flash:{}
},

computed:{
section(){
return this.response.section;
}



},

data(){return{
show:false,
show2:false,


}
},

methods:{




}




}
</script>
