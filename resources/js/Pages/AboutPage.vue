<template>
<LayoutUnAuth>

<div class="row m-0"  id="banner">
<div class="col-12 col-md-12 p-0 m-0" :style="'margin-top:0px;z-index:0;background-image:url('+route+'images/pages/about.jpg'+');height:250px;background-size:cover;background-position:100% 50%;border-radius:0 0 20px 20px;'">
</div>
</div>










<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="row mt-5">
<div class="col-md-2 col-12"></div>
<div class="col-md-8 col-12">
<div>
<h3 class="text-center mb-3" style="font-size:30px;">
<span>About</span>
<span style="color:#1ee0ac;">Dasuns</span>
</h3>


<div v-if="about.length>0">
<ul>
<li v-for="(a,key) in about" :key="key" class="mb-5">
<h4>{{ a.title }} </h4>
<p>
{{ a.description }}
</p>
</li>
</ul>
</div>
<div v-else>
No content
</div>



</div>
<div class="col-md-2 col-12"></div>
</div>
</div>

</div>
</div>
</div>









<div class="nk-content nk-content-lg nk-content-fluid" style="background:#07372F;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body">
<div>
<h4 class="text-center" style="color:#1ee0ac;font-size:30px;padding-bottom:30px;">
Our Team
</h4>
</div>




<div class="row mt-5" v-if="team.length>0">

<div class="col-12 col-md-3 mb-5" v-for="t in team" :key="t.id">
<div>
<img :src="route+t.image" style="height:200px;width:200px;border-radius:100%;text-align:center;" v-if="t.image!=''" />
<div v-else style="height:200px;width:200px;border-radius:100%;text-align:center;background:white;padding:40px;">
    <em class="icon ni ni-user-alt-fill" style="font-size:100px;"></em>
</div>
<div  class="mt-3 pl-3">
<h4 style="color:white;">{{ t.firstname }} {{ t.lastname }} </h4>
<p style="color:white;font-size:14px;">{{ t.position }} </p>
<small class="small" style="color:#1ee0ac;">{{ t.profile_link }} </small>
</div>
</div>


</div>


</div>






</div>
</div>
</div>
</div>







</LayoutUnAuth>
</template>
<script>
import LayoutUnAuth from '@/Layouts/LayoutUnAuth'
export default {
components:{
LayoutUnAuth


},
props:{
title:{},
response:{}
},
data(){return {
route:this.$page.props.system.route,








}},



computed:{
team(){
return this.response.team;
},

images(){
return this.response.images;
},

about(){
return this.response.about;
}






}






}
</script>


<style scoped>
h4{font-size:20px;
line-height: 30px;}
p{font-size:15px; font-family: Arial, sans-serif;
line-height: 25px;

}

@media screen and (max-width: 600px) {
    #banner{
      width:100%;
      padding-left:0;padding-right:0;
      border-radius:0 0 20px 20px;
    }
  }

  @media screen and (min-width: 600px) {
    #banner{
      width:100%;
      padding-left:15%;padding-right:15%;
      border-radius:0 0 20px 20px;
    }
  }

</style>
