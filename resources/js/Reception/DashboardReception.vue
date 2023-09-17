<template>
    <div class="nk-content p-4">
    <div class="row g-gs">





    <div class="col-md-3" v-for="t in tabs" :key="t.id">
    <div class="card  card-full h-100">
    <div class="card-inner">
    <div class="card-title-group align-start mb-0">
    <div class="card-title">
    <h6 class="subtitle">
    <em :class="t.icon" style="font-size:50px;color:#07372F;"></em>
    </h6>
    </div>
    </div>

    <div class="card-amount mb-2 mt-3">
    <span class="amount"><span class="currency currency-usd" style="color:#07372F;">{{ t.count }} </span>
    </span>
    </div>

    <div class="invest-data mt-3">
    <div class="invest-data-amount g-2">
    <div class="invest-data-history">

    <div class="amount"> <span class="currency currency-usd" style="font-size:15px;color:#07372F;">
    <Inertia-link :href="route(t.url)" style="color:#07372F;"><strong>{{ t.title }} </strong></Inertia-link>
    </span></div>
    </div>

    </div>

    </div>
    </div>
    </div><!-- .card -->
    </div>

    </div>

    <div class="row g-gs mt-2">
    <div class="col-12 col-md-8 p-0">




    <div class="card h-100" style="min-height:500px;">
    <div class="card-header">
    <h3 class="card-title bold" style="text-transform:capitalize;">Applicants</h3>
    <div class="card-options">
    <!-- <a href="#" class="btn btn-primary btn-sm">Action 1</a>
    <a href="#" class="btn btn-secondary btn-sm ml-2">Action 2</a> -->
    </div>
    </div>
    <div class="card-body">
    <table class="table card-table">
    <thead>
    <tr>
    <th>Names</th>
    <th>Service No.</th>
    <th>Dates</th>
    <th>status</th>
    </tr>
    </thead>
    <tbody v-if="appointments.length>0">
    <tr v-for="(a,key) in appointments" :key="key">
    <td class="text-muted text-transform">
        <em class="icon ni ni-user-alt-fill"></em>
    <Inertia-link :href="route('service_provider.pending',{id:a.id})" class="text-black">{{ a.firstname }} {{ a.lastname }}</Inertia-link>
    </td>
    <td class="text-muted">
    {{ a.number }}
    </td>
    <td class="text-muted">
{{ a.created_at.substring(0,10).split('-').reverse().join('/') }}
    </td>
    <td class="text-muted text-transform">
    {{ a.status }}
    </td>
    </tr>

    </tbody>
    <tbody v-else>
    <tr>
    <td colspan="4">No content</td>
    </tr>
    </tbody>
    </table>









    </div>
    </div>
    </div>


    <div class="col-12 col-md-4">
    <div class="card h-100">
    <div class="card-header">
    <h3 class="card-title text-transform">Interviews</h3>

    </div>
    <div class="card-body">

        <div class="row text-center">
            <div class="col-sm-4 border-right pb-4 pt-4">
                <label class="mb-0">Scheduled</label>
                <h4 class="font-30 font-weight-bold text-col-blue counter">
                    {{ interview.all }}
                </h4>
            </div>
            <div class="col-sm-4 border-right pb-4 pt-4">
                <label class="mb-0">Accepted</label>
                <h4 class="font-30 font-weight-bold text-col-blue counter">
                    {{ interview.success }}
                </h4>
            </div>
            <div class="col-sm-4 pb-4 pt-4">
                <label class="mb-0">Failed</label>
                <h4 class="font-30 font-weight-bold text-col-blue counter">
                    {{ interview.fail }}
                </h4>
            </div>
        </div>





    <table class="table card-table">
    <thead>
    <th>Service No.</th>
    <th>Date</th>
    <th>Status</th>
    </thead>

    <tbody v-if="interview.latest.length>0">
    <tr v-for="(i,key) in interview.latest" :key="key">
    <td>
    <inertia-link class="text-muted" :href="route('interview',{id:i.id})">
    {{ i.number }}
    </inertia-link>
    </td>
    <td>
    {{ i.date.split('-').reverse().join('/') }}
    </td>
    <td class="text-right">
    <span class="tag tag-default text-transform">
    {{ i.status }}
    </span>
    </td>
    </tr>

    </tbody>
    <tbody v-else>
    <tr>
    <td>
    No content
    </td>
    </tr>
    </tbody>
    </table>














    </div>
    </div>

    </div>
    </div>





    <div class="row g-gs mt-2">
    <div class="col-12 col-md-4">



    <div class="card h-100">
    <div class="card-header">
    <h3 class="card-title text-transform">Wallet</h3>
    </div>
    <div class="card-body">
    <span>Balance</span>
    <h4>Shs.<span class="counter ml-3">{{ wallet }} </span></h4>

    <div class="form-group">
    <label class="d-block">Service Providers<span class="float-right">Shs.<span class="counter">{{ counts.pssp }} </span></span></label>
    <div class="progress progress-xs">

    </div>
    </div>
    <div class="form-group">
    <label class="d-block">Service Users <span class="float-right">Shs. <span class="counter">{{ counts.pssu }}</span></span></label>
    <div class="progress progress-xs">
    </div>
    </div>
    <div class="form-group">
    <label class="d-block">Others <span class="float-right">Shs.<span class="counter">
    {{ counts.other }}</span></span></label>
    <div class="progress progress-xs">

    </div>
    </div>
    </div>
    <div class="card-footer">
    <Inertia-link :href="route('wallet.admin')" class="btn btn-block btn-info btn-sm">Transaction History </Inertia-link>
    </div>
    </div>

    </div>















    <div class="col-12 col-md-4">
    <div class="card h-100">
    <div class="card-header">
    <h3 class="card-title text-transform">Transactions</h3>
    </div>
    <div class="card-body p-0">
    <div v-if="transactions.length>0">

    <table class="table table-hover mb-0">
    <thead>
    <tr>
    <th>Date</th>
    <th>Amount</th>
    <th>Transaction</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(t,key) in transactions" :key="key">
    <td><em class="icon ni ni-wallet-fill mr-2"></em>{{t.created_at.substring(0,10).split('-').reverse().join('/')}} </td>
    <td>{{t.amount}} </td>
    <td class="text-transform">{{t.transaction}} </td>
    </tr>
    </tbody>
    </table>

    </div>
    <div v-else class="p-3">No Content</div>
    </div>
    </div>
    </div>








    <div class="col-12 col-md-4">
    <div class="card h-100">
    <div class="card-header">
    <h3 class="card-title text-transform">Support Services</h3>
    </div>
    <div class="card-body p-0">
    <div v-if="services.length>0">
    <table class="table card-table">
    <tbody>
    <tr v-for="(s,key) in services" :key="key">
    <td><em class="icon ni ni-grid-fill mr-2"></em> {{ s.name }} </td>
    <td class="text-right">
    <span class="tag tag-default">30</span>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div v-else class="p-3">No Content</div>



    </div>
    </div>





    </div>



    </div>






    </div>
    </template>
    <script>
    export default {
    props:{
    response:{},
    },
    data(){return{
    tabs:[
    {icon:'icon ni ni-users-fill',title:'TOTAL ACTIVE USERS',count:this.response.user_data.statistics.count_user,id:1,url:'users.active'},
    {icon:'icon ni ni-user-list-fill',title:'SERVICE PROVIDERS',count:this.response.user_data.statistics.count_PSSP,id:2,url:'service.providers'},
    {icon:'icon ni ni-shield-check-fill',title:'ADMIN ACCOUNTS',count:this.response.user_data.statistics.count_admin,id:3,url:'admin.accounts'},
    {icon:'icon ni ni-user-check-fill',title:'SERVICE USERS',count:this.response.user_data.statistics.count_service_users,id:4,url:'service.users'},
    ],

    positions:this.response.user_data.get_pssp_services,



    }},






    computed:{
    appointments(){
    return this.response.user_data.appointments;
    },

    wallet(){
    return this.response.user_data.wallet;
    },

    counts(){
    return this.response.user_data.counts;
    },


    interview(){
    return this.response.user_data.interview;
    },

    services(){
    return this.response.user_data.services;
    },

    transactions(){
    return this.response.user_data.transactions;
    }


    }


    }
    </script>
    <style scoped>
    table tr td{
    padding:10px;
    }

    table tr td ul li{
    padding:0;
    margin:0;
    }
    table tr td ul{
        padding:0;
        margin:0;
        }


    </style>
