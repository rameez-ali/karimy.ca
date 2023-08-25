<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name')); ?> ― Canvas</title>

    <?php if($scripts['darkMode']): ?>
        <link rel="stylesheet" id="baseStylesheet" type="text/css" href="<?php echo e(mix('css/app-dark.css', 'vendor/canvas')); ?>">
        <link rel="stylesheet" id="highlightStylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/sunburst.min.css">
    <?php else: ?>
        <link rel="stylesheet" id="baseStylesheet" type="text/css" href="<?php echo e(mix('css/app.css', 'vendor/canvas')); ?>">
        <link rel="stylesheet" id="highlightStylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/github.min.css">
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/highlight.min.js"></script>
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Karla|Merriweather:400,700">

    <link rel="shortcut icon" href="<?php echo e(mix('favicon.ico', 'vendor/canvas')); ?>">
</head>
<body class="mb-5">
<div id="canvas">
    <?php if(!$assetsUpToDate): ?>
       <div class="alert alert-danger border-0 text-center rounded-0 mb-0">
           <?php echo e(__('canvas::app.assets_are_not_up_to_date')); ?>

           <?php echo e(__('canvas::app.to_update_run')); ?><br/><code>php artisan canvas:publish</code>
       </div>
    <?php endif; ?>

    <router-view></router-view>
</div>

<script>
    window.Canvas = <?php echo json_encode($scripts, 15, 512) ?>;
</script>

<script type="text/javascript" src="<?php echo e(mix('js/app.js', 'vendor/canvas')); ?>"></script>
</body>
</html>
<?php /**PATH /home/karimyca/public_html/laravel_project/vendor/cnvs/canvas/src/../resources/views/layout.blade.php ENDPATH**/ ?>