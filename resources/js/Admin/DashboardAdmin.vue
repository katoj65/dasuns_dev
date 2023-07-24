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
<h3 class="card-title" style="text-transform:capitalize;">Appointment Requests</h3>
<div class="card-options">
<!-- <a href="#" class="btn btn-primary btn-sm">Action 1</a>
<a href="#" class="btn btn-secondary btn-sm ml-2">Action 2</a> -->
</div>
</div>
<div class="card-body">
<table class="table card-table">
<thead>
<tr>
<th>Service Provider</th>
<th>Service Requested</th>
<th>Dates</th>
<th>status</th>
</tr>
</thead>
<tbody>
<tr v-for="(a,key) in appointments" :key="key">
<td class="text-muted text-transform">
    <em class="icon ni ni-label-fill mr-2"></em>
{{ a.firstname }} {{ a.lastname }}
</td>
<td class="text-muted">
<ul v-if="a.service.length>0">
<li v-for="(l,key) in a.service" :key="key">
<Inertia-link class="text-muted" :href="route('appoitment.show',{id:a.id})">{{ l.name }}</Inertia-link>
</li>
</ul>
<div v-else>
No service
</div>
</td>
<td class="text-muted">
{{ a.date.substring(0,10).split('-').reverse().join('/') }}
</td>
<td class="text-muted text-transform">
{{ a.status }}
</td>
</tr>

</tbody>
</table>









</div>
</div>






</div>
<div class="col-12 col-md-4">
<div class="card h-100">
<div class="card-header">
<h3 class="card-title text-transform">Transactions</h3>

</div>
<div class="card-body">



    {{ wallet }}




</div>
</div>

</div>
</div>





<div class="row g-gs mt-2">
<div class="col-12 col-md-4">



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Wallet</h3>
        </div>
        <div class="card-body">
            <span>Balance</span>
            <h4>Shs.<span class="counter ml-3">{{ wallet }} </span></h4>

            <div class="form-group">
                <label class="d-block">Service Providers<span class="float-right">$<span class="counter">15,025</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-azure" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Service Users <span class="float-right">$<span class="counter">1,843</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Others <span class="float-right">$<span class="counter">3,640</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                </div>
            </div>
       </div>
        <div class="card-footer">
            <a href="javascript:void(0)" class="btn btn-block btn-info btn-sm">View More</a>
        </div>
    </div>







</div>
<div class="col-12 col-md-4">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Wallet</h3>
        </div>
        <div class="card-body">
            <span>Balance</span>
            <h4>Shs.<span class="counter">{{ wallet }} </span></h4>

            <div class="form-group">
                <label class="d-block">Bank of America <span class="float-right">$<span class="counter">15,025</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-azure" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">RBC Bank <span class="float-right">$<span class="counter">1,843</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Frost Bank <span class="float-right">$<span class="counter">3,640</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                </div>
            </div>
       </div>
        <div class="card-footer">
            <a href="javascript:void(0)" class="btn btn-block btn-info btn-sm">View More</a>
        </div>
    </div>




</div>
<div class="col-12 col-md-4">



    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Wallet</h3>
        </div>
        <div class="card-body">
            <span>Balance</span>
            <h4>Shs.<span class="counter">{{ wallet }} </span></h4>

            <div class="form-group">
                <label class="d-block">Bank of America <span class="float-right">$<span class="counter">15,025</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-azure" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">RBC Bank <span class="float-right">$<span class="counter">1,843</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Frost Bank <span class="float-right">$<span class="counter">3,640</span></span></label>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                </div>
            </div>
       </div>
        <div class="card-footer">
            <a href="javascript:void(0)" class="btn btn-block btn-info btn-sm">View More</a>
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
{icon:'icon ni ni-swap-alt-fill',title:'REGISTERED SERVICES',count:this.response.user_data.statistics.count_services,id:4,url:'services'},
],

positions:this.response.user_data.get_pssp_services,



}},






computed:{
appointments(){
return this.response.user_data.appointments;
},

wallet(){
return this.response.user_data.wallet;
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
