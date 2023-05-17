<template>
<div>
<div class=""  v-if="dialog.state==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);z-index:1000000;">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Appointment Details </h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
    <em class="icon ni ni-cross"></em>
    </a>
    </div>
    <div class="modal-body">



    <ul class="data-list is-compact">
    <li class="data-item">
            <div class="data-col">
                <div class="data-label bold">Appointment Date</div>
                <div class="data-value">
                    <em class="icon ni ni-calender-date m-0 p-0"></em>
                 start date
                    <span>end date </span>
                </div>
            </div>
    </li>
    <li class="data-item">
            <div class="data-col">
                <div class="data-label bold">Time</div>
                <div class="data-value">
                    <em class="icon ni ni-clock"></em>
                   <span class="text-success mr-2">from time</span> -  <span class="text-danger ml-2"> to time</span> </div>
            </div>
     </li>
    <li class="data-item">
            <div class="data-col">
                <div class="data-label bold">Service Requested</div>
            <div class="data-value text-transform"><em class="icon ni ni-tag-fill"></em> service name  </div>
        </div>
    </li>

    <li class="data-item">
            <div class="data-col">
                <div class="data-label bold">Location </div>
                <div class="data-value">
                    <em class="icon ni ni-map-pin-fill"></em>
                   location
            </div>
        </div>
    </li>



    </ul>










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
title:{},
button:{},
content:{}
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

