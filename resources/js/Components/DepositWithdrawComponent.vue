<template>
<div>
<el-button-group class="mt-2">
<el-button type="success" @click="modal=true"><em class="icon ni ni-wallet-in"></em> Deposit Funds</el-button>
<el-button type="warning">Withdraw Funds <em class="icon ni ni-wallet-out"></em></el-button>
</el-button-group>







<div class=""  style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" v-if="modal==true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Deposit Funds to your Wallet</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="modal=false">
    <em class="icon ni ni-cross"></em>
    </a>
    </div>
    <div class="modal-body">


    <div class="card-inner border border-radius">
    <ul class="nav nav-tabs mt-n3">
    <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#tabItem5">
        <em class="icon ni ni-mobile"></em>
        <span>Mobile Money</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#tabItem6">
        <em class="icon ni ni-cc-alt"></em>
        <span>Credit Card</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tabItem7">
            <em class="icon ni ni-coins"></em>

    <span>Bank Transfer</span></a>
        </li>
    </ul>
    <div class="tab-content" style="max-height:450px;overflow-y:auto;">
    <div class="tab-pane active" id="tabItem5">
    <form @submit.prevent="submit1">
    <div class="row gy-4">
    <div>



    <!-- <p class="p-3">
    {{payment_option.mobile.instructions}}
    </p> -->
    </div>
    <div class="col-sm-12">
    <div class="form-group">
    <label class="form-label" for="default-01">Mobile service Provider
<span class="text-danger ml-2" v-if="errors.type!=null">{{ errors.type }} </span>

    </label>
    <div class="form-control-wrap">
    <select class="form-control" id="default-01" v-model="form1.type">
    <option value="">Select</option>
    <option v-for="m in payment_option.mobile.services" :key="m.name">
    {{ m.name }}
    </option>
    </select>
    </div>
    </div>
    </div>

    <div class="col-sm-12">
    <div class="form-group">
    <label class="form-label" for="default-01">Telephone Number

        <span class="text-danger ml-2" v-if="errors.tel!=null">{{ errors.tel }} </span>
    </label>
    <div class="form-control-wrap">
    <input type="number" class="form-control" id="default-01" placeholder="Enter telephone number" v-model="form1.tel">
    </div>
    </div>
    </div>


    <div class="col-sm-12">
    <div class="form-group">
    <label class="form-label" for="default-01">Amount <span class="text-danger ml-2" v-if="errors.amount!=null">{{ errors.amount }} </span></label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" id="default-01" placeholder="Enter amount" v-model="form1.amount">
    </div>
    </div>
    </div>





    <div class="col-sm-12">
    <div class="form-group">
    <button class="btn button" style="font-size:18px;">
    Deposit to Wallet
    </button>
    </div>
    </div>



    </div>
    </form>
    </div>
    <div class="tab-pane" id="tabItem6">
    <p>
        {{payment_option.card.instructions}}
    </p>
    </div>
    <div class="tab-pane" id="tabItem7">
    <p>
        {{payment_option.bank.instructions}}
    </p>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>







</div>
</template>
<script>
import InputError from '../Alerts/InputError.vue';
export default {
components:{
InputError,
},

data(){return{
modal:false,
flash:null,
// errors:null,


//
payment_option:{
//mobile payment
mobile:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'MTN'},
{name:'Airtel'},
{name:'Other'}

],



},
//card payment
card:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'Paypal'},
{name:'Master Card'},

]
},

//bank payment
bank:{

instructions:'Credit card Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis',
//services list

services:[

{name:'Centenary Bank'},
{name:'DFCU Bank'},
{name:'UBA Bank'},
{name:'Bank of Africa'},

]

}






},

form1:this.$inertia.form({
type:'',
tel:'',
amount:'',
password:''
}),






}},


methods:{
submit1(){
this.flash=this.$page.props.flash;
this.errors=this.$page.props.errors;
this.form1.post(this.route('wallet-deposit'),{
onSuccess:()=>{
this.modal=false;
this.form1.reset();
this.$notify({
title:'Successful',
message:flash.success,
type:'success',
position:'bottom-right'

});

}
});
},








},


computed:{
errors(){
return this.$page.props.errors;
}
}



}
</script>
