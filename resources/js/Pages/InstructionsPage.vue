<template>
    <LayoutUnAuth>

    <div class="row  m-0"  id="banner">
    <div class="col-12 col-md-12 " :style="'margin-top:0;z-index:0;background-image:url('+route+'images/pages/wheelchair2.jpg'+');border-radius:0 0 20px 20px;height:250px;background-size:cover;background-position:100% 65%;border:none;'">

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




<div v-if="article.length>0" class="mt-4">

<ul>
<li v-for="(a,key) in article" :key="key" class="mb-4">
<h4>
{{ a.title }}
</h4>
<p>

{{ a.description }}
</p>
</li>
</ul>

</div>
<div v-else>
No content
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
    },


//instructions
article(){
return this.response.article;
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
          padding-left:15%;
          padding-right:15%;
          border-radius:0 0 20px 20px;
        }
      }



    </style>
