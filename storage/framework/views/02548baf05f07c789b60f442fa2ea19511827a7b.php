<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<title><?php echo e(config('app.name', 'Laravel')); ?></title>

<!-- Fonts -->

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

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
</head>
<body class="font-sans antialiased">
<div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/project3/resources/views/app.blade.php ENDPATH**/ ?>