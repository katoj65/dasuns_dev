<template>
<LayoutUnAuth>

<div class="row  m-0"  id="banner">
<div class="col-12 col-md-12 " :style="'margin-top:0;z-index:0;background-image:url('+route+'images/pages/wheelchair1.jpg'+');border-radius:0 0 20px 20px;height:250px;background-size:cover;background-position:100% 40%;'">

</div>

</div>




<div class="nk-content nk-content-lg nk-content-fluid" style="min-height:600px;">
<div class="container-xl wide-lg">
<div class="nk-content-inner">

<div class="row mt-5">
<div class="col-md-2 col-12"></div>
<div class="col-md-8 col-12" >
<div>
<h3 class="text-center mb-1" style="font-size:30px;">
<span>What</span>
<span style="color:#1ee0ac;">we do</span>
</h3>


<h4 class="mb-2 pb-2 mt-4"><em class="icon ni ni-headphone" style="background:#1ee0ac;color:white;padding:5px;border-radius:5px;"></em><br/><br/> We Provide Suppoert Services</h4>

<p>
We facilitate access to professional support service through a digital
platform (Dasuns) that connects providers with users. Users could choose the type of
service by interacting through a digital system.
</p>


<p>
Service providers and users only need to sign up for an account once. Users can
then log on to the system and request for their preferred support service from
available service providers within reach.
</p>


<h4 class="mt-4 pt-4">
<em class="icon ni ni-headphone" style="background:#1ee0ac;color:white;padding:5px;border-radius:5px;"></em><br/><br/>
Service Providers
</h4>

<p class="mt-3">
While we acknowledge that most support service providers have their training
backgrounds from Universities and other tertiary institutions, we work with
Organisations of Persons with Disabilities to enhance their professional skills and
further have them go through a vetting process before we could onboard them on
Dasuns Digital Platform as support service providers.
</p>


<div class="row mt-4 mb-2">
<div class="col-12 col-md-6 mb-3" v-for="i in images" :key="i.id">
<img :src="route+i.image" style="height:200px;border-radius:10px;"/>
</div>
</div>


<div style="height:50px;"></div>
<h4 class="mt-2">
<em class="icon ni ni-headphone" style="background:#1ee0ac;color:white;padding:5px;border-radius:5px;"></em><br/><br/>
Capacity Strengthening on Inclusive Programming
</h4>

<p class="pt-3">
Awareness of disability-inclusive development is
increasing globally. However, we believe that unless
deliberate measures are considered, Persons with
Disabilities are more likely to experience adverse
socio-economic outcomes such as less education,
poorer health outcomes, lower levels of employment,
and higher poverty rates.
</p>


<div class="row">
<div class="col-12 col-md-6">
<p class="mt-2">
The United Nations Convention on the Rights of Persons with Disabilities (CRPD)
promotes the full integration of persons with disabilities in societies on an equal basis
with others; and the 2030 Agenda for Sustainable Development clearly states that
disability cannot be a reason or criteria for lack of access to development
programming and the realization of human rights.
</p>

<p class="pt-2">
We support development planning teams to identify, analyse, include, monitor, and
evaluate disability issues as an integral part of their plansning and budgeting
processess.
</p>
</div>
<div class="col-12 col-md-6 pt-5" v-if="image5.length>0">
    <div v-for="i5 in image5" :key="i5.id">
    <img :src="route+i5.image" style="border-radius:10px;"/>
    </div>
    </div>
</div>







<h4 class="mt-4 pt-4">
<em class="icon ni ni-headphone" style="background:#1ee0ac;color:white;padding:5px;border-radius:5px;"></em><br/><br/>
Mentorship for Youth with Disabilities in ICTs
</h4>


<p class="pt-2">
Information and Communication Technology skill development is an important
strategy for the social inclusion of persons with disabilities in the mainstream of
community life. Effective participation in educational, employment and social
opportunities may be dependent upon being able to make use of computers and the
internet.
</p>





<div class="row mb-5 pb-5">
<div class="col-12 col-md-6">
<p>
For many young men and women with disabilities, these opportunities can
be particularly important. Many of them could exploit learning opportunities on-line,
work from home, and make contact with services, friends, family and support
networks.
</p>
<p>
However, many of these young men and women with
disabilities have not had the opportunity to acquire
such relevant skills to compete favourably in the
evolving digital world. We work to empower young men
and women with disabilities with the ICT skills and
knowledge they need to succeed.
</p>
</div>
<div class="col-12 col-md-6 pt-5" v-if="image5.length>0">
<div v-for="i5 in image6" :key="i5.id">
<img :src="route+i5.image" style="border-radius:10px;"/>
</div>
</div>



</div>


<div>






</div>


</div>
<div class="col-md-2 col-12"></div>
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
images(){
return this.response.images;
},
image6(){
return this.response.pic6;
},
image5(){
return this.response.pic5;
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
      padding-left:15%;
      padding-right:15%;
      border-radius:0 0 20px 20px;
    }
  }



</style>
