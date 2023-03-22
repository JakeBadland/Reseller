<!DOCTYPE html>
<html dir="ltr" lang="">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reseller v2.2.3</title>

    <script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/js/custom.js"></script>
    <link rel="stylesheet" href="/Public/css/main.css">
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css">

</head>
<body>
<div class="header">
    <img class="menu-icon" src="/Public/img/menu.png">
    <div class="menu panel">
        <?php foreach ($shops as $shop) : ?>
            <div><a href="/index/index/<?=$shop['id']?>"><?=$shop['name']?></a></div>
        <?php endforeach ?>
    </div>
</div>
<div class="body">
    <?=$content?>
</div>
<div class="footer"></div>

</body>
</html>