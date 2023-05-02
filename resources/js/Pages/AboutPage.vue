<template>
<LayoutUnAuth>
<div class="row m-0"  id="banner">
<div class="col-12 col-md-12 p-0 m-0" :style="'margin-top:0px;z-index:0;background-image:url('+route+'images/pages/wheelchair1.jpg'+');height:250px;background-size:cover;background-position:100% 50%;     border-radius:0 0 20px 20px;'">
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


<h4 class="mb-2">Who we are</h4>

<p>We are Diversity Ability Support Network System (Dasuns), a Social Enterprise
Company registered in Uganda, with a mission of to promoteing inclusive socio-
economic development through facilitating access to professional support services
and assistive technologies to advance rights, choices and opportunities for persons
with disabilities.

</p>


<p class="mt-3">
We believe in the revolutionary power of Assistive
Technologies (AT) in enabling Persons with Disabilities
to live healthy, productive, independent, and dignified
lives, and to effectively participate in education, the
labour market and civic life. We acknowledge the role
of AT products and services in helping to reducing the
need for formal health and support services, long-term
care and the work of caregivers for Persons with
Disabilities.
</p>


<h4 class="mt-5 border-top pt-3 mb-3">
Overview
</h4>

<p class="mt-3">
    The Uganda Demographic and Health Survey (2016)
    indicates that the total population of Persons with
    Disabilities add up to about seven (7) million total
    population of Persons with Disabilities. Few of them
    can obtain a tertiary level degree, 75 percent are not
    employed, and 80 percent are walloping in poverty.
    The main challenges include the inadequate access to
    assistive products and services, such as an accessible
    Professional Support Service System to facilitate the
    effective participation of Persons with Disabilities in

    education, employment and community life.
</p>



<div>






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
}





}






}
</script>


<style scoped>
h4{font-size:20px;
line-height: 30px;}
p{font-size:17px; font-family: Arial, sans-serif;
line-height: 30px;

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
