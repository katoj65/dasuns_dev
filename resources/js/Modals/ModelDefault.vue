<template>
<div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault" @click="show()">Modal Default</button>


<div class=""  v-if="open==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show()">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem similique earum necessitatibus nesciunt! Quia id expedita asperiores voluptatem odit quis fugit sapiente assumenda sunt voluptatibus atque facere autem, omnis explicabo.</p>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modal Footer Text</span>
                </div>
            </div>
        </div>
</div>

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

