<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<title>Dasuns</title>

<!-- Fonts -->



<!-- Styles -->
<link rel="stylesheet" href="<?php echo e(asset('/public/css/app.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('/public/css/dashlite.css?ver=2.2.0')); ?>">
<link id="skin-default" rel="stylesheet" href="<?php echo e(asset('/public/css/theme.css?ver=2.2.0')); ?>">

<!-- Styles -->
<link rel="stylesheet" href="<?php echo e(asset('/public/css/app.css')); ?>">

<!-- Scripts -->

<?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
<script src="<?php echo e(asset('/public/js/app.js')); ?>" defer></script>
<script src="<?php echo e(asset('/public/js/bundle.js?ver=2.2.0')); ?>"></script>
<script src="<?php echo e(asset('/public/js/scripts.js?ver=2.2.0')); ?>"></script>
<!-- import CSS -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- import JavaScript -->


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

<style type="text/css">
.form-control,input, select{
border:solid thin #E5E8E8;
border-radius:10px;
padding:15px;
padding-left:20px;
padding-right:20px;
height:55px;
font-size:16px;
}

.button-green{
background: #45B39D;
border:solid thin #45B39D;
padding:10px;
}

.border-radius{
border-radius: 20px;
}

.inertia-link:hover{
color:#0B5345;
}

label, .form-label{
font-size:16px;
}

.header_bg{
background:#37BEA7;
}

.thick_bg{
background:#07372F;
}

.thinker_bg{
background:#001713;
}

.clear_bg{
background:#D4;
}

.font-color:{
color:#001713;
}

.button{
 background:#37BEA7;
 border:none;
 padding:15px;
 border-radius: 30px;
 color:white;
}

.light-text{
 color:#37BEA7;
}


body {
    font-family: 'Roboto', sans-serif;
}

p{
font-size:15px;
font-family: 'Roboto', sans-serif;
}
div{
font-size:15px;
font-family: 'Roboto', sans-serif;
}

span, div, p, label{
    font-family: 'Roboto', sans-serif;
}

h1,h2,h3,h4,h5,h6{
font-weight: bolder;
font-family: 'Roboto', sans-serif;
}

.button:hover{
background: #07372F;
color:white;
}

.bg-white{
background:white;
}
.text-transform{
text-transform: capitalize;
}

.float-right:{
text-align: right;
}
.float-left:{
text-align: left;
}

.float-center:{
text-align: center;
}
.modal-dialog .modal-header{
    background: #37BEA7;border:none;
    color:white;
}

.modal-dialog .modal-header .modal-title{
color:white;
}
.lighter-bg{
    background: #37BEA7;
    color:white;
}

.border1:{
  border:  solid thin #F2F3F4;
}

.hover:hover{
color:#37BEA7;
}

</style>


</head>
<body class="font-sans antialiased">
<div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dasuns_dev/resources/views/app.blade.php ENDPATH**/ ?>