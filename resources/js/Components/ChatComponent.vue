<template>
<div id="chat">


<div class="card shadow" style="border:none;" v-if="isOpen==true">
<div class="card-header">
<div class="card-title-group">
<h4 class="title">Chat</h4>
<div class="card-tools">
 <a href="#" @click="chat()">Close</a>
    </div>
</div>

</div>

<div class="card-body">


<div v-for="n in 20" :key="n">
    <div class="chat is-me" >
        <div class="chat-content">
            <div class="chat-bubbles">
                <div class="chat-bubble">
                    <div class="chat-msg bg-primary-dim text-muted"> Thanks for inform. We just solved  </div>
                    <ul class="chat-msg-more">
                        <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a></li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-sm">
                                    <ul class="link-list-opt no-bdr">
                                        <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li>
                                        <li><a href="#"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                        <li><a href="#"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="chat-meta">
                <li>Abu Bin Ishtiyak</li>
                <li>29 Apr, 2020 4:12 PM</li>
            </ul>
        </div>
    </div>


    <div class="chat-content">
        <div class="chat-bubbles">
            <div class="chat-bubble">
                <div class="chat-msg bg-success-dim"> Hey, I am facing problem as i can not login into? </div>
                <ul class="chat-msg-more">
                    <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a></li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li>
                                    <li><a href="#"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                    <li><a href="#"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="chat-meta">
            <li>3:49 PM</li>
        </ul>
    </div>

    </div>



</div>
</div>

<a href="#" v-if="isOpen==false" @click="chat()">
<div class="nk-activity-media user-avatar bg-success shadow" style="padding:30px;">
<em class="icon ni ni-chat-circle-fill text-white" style="font-size:30px;"></em></div>

</a>


</div>
</template>
<script>
export default {
    props:{

    },

data(){
return{
isOpen:false,

}
},



methods:{
chat(){
if(this.isOpen==false){
this.isOpen=true;
}else{
this.isOpen=false;
}
}






}





}
</script>


<style scoped>
#chat{
position:fixed;
bottom:0;
right:0;
margin:30px;
z-index: 1000;
}


.card{
width:300px;
height:400px;
position: inherit;
bottom:0;
right:30px;

}

.card-header{
background:#37BEA7;
color:white;
padding:5px;
padding-left:15px;
padding-right:15px;
}

.title{
color:white;
padding:0;
}

.card-title-group{
padding:10px;
}

.card-body{
height:300px;
overflow:auto;
}


</style>
