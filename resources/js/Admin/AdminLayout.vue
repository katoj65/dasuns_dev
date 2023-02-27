<template>
<app-layout>

<div class="nk-content p-0">
<div class="container-fluid pt-0">
<div class="nk-content-inner pt-0">
<div class="nk-content-body pt-0">
<div class="nk-block pt-0">
<div class="row g-gs">
<div class="col-md-8 col-xxl-4">
<slot></slot>
</div><!-- .col -->

<div class="col-md-4 col-xxl-4">
<div class="card card-full">
<div class="card-inner d-flex flex-column h-100">
<div class="card-title-group mb-3">
<div class="card-title">
    <h6 class="title">Services I provide</h6>
    <p>In last 30 days top invested schemes.</p>
</div>
<div class="card-tools mt-n4 mr-n1">
    <div class="drodown">
        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <ul class="link-list-opt no-bdr">
                <li><a href="#"><span>15 Days</span></a></li>
                <li><a href="#" class="active"><span>30 Days</span></a></li>
                <li><a href="#"><span>3 Months</span></a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="progress-list gy-3">
<div class="progress-wrap">
    <div class="progress-text">
        <div class="progress-label">Strater Plan</div>
        <div class="progress-amount">58%</div>
    </div>
    <div class="progress progress-md">
        <div class="progress-bar" data-progress="58" style="width: 58%;"></div>
    </div>
</div>
<div class="progress-wrap">
    <div class="progress-text">
        <div class="progress-label">Silver Plan</div>
        <div class="progress-amount">18.49%</div>
    </div>
    <div class="progress progress-md">
        <div class="progress-bar bg-orange" data-progress="18.49" style="width: 18.49%;"></div>
    </div>
</div>
<div class="progress-wrap">
    <div class="progress-text">
        <div class="progress-label">Dimond Plan</div>
        <div class="progress-amount">16%</div>
    </div>
    <div class="progress progress-md">
        <div class="progress-bar bg-teal" data-progress="16" style="width: 16%;"></div>
    </div>
</div>
<div class="progress-wrap">
    <div class="progress-text">
        <div class="progress-label">Platinam Plan</div>
        <div class="progress-amount">29%</div>
    </div>
    <div class="progress progress-md">
        <div class="progress-bar bg-pink" data-progress="29" style="width: 29%;"></div>
    </div>
</div>
<div class="progress-wrap">
    <div class="progress-text">
        <div class="progress-label">Vibranium Plan</div>
        <div class="progress-amount">33%</div>
    </div>
    <div class="progress progress-md">
        <div class="progress-bar bg-azure" data-progress="33" style="width: 33%;"></div>
    </div>
</div>
</div>
<div class="invest-top-ck mt-auto">
<canvas class="iv-plan-purchase" id="planPurchase"></canvas>
</div>
</div>
</div>

</div><!-- .col -->




































</div>
</div>
</div>
</div>
</div>
</div>




</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
export default {
components: {
AppLayout,



},

props:{
response:{},
title:{},
errors:{},
},

data(){return{
user:this.$page.props.auth.user,




}}











}
</script>
