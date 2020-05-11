<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
        <meta name="description" content="BRMTOOLで作成したブルベデータを編集します">
        <title><?php echo $title; ?><?php isset( $subtitle ) and print( ' - '.$subtitle) ;?></title>
        <link rel="shortcut icon" href="<?php echo Uri::base(false);?>favicon.ico" type="image/vnd.microsoft.icon">
        <link rel="icon" href="<?php echo Uri::base(false);?>favicon.ico" type="image/vnd.microsoft.icon">
        <?php echo Asset::css('revbrm.css'); ?>
        <?php echo Asset::js('jquery-3.2.1.min.js'); ?>
        <?php echo Asset::js('jquery-ui.min.js'); ?>
        <?php echo Asset::css('jquery-ui.min.css'); ?>
</head>
<body>
    <div id="header">
        <?php echo $header; ?>
    </div>
    <div id="wrapper" class="clearfix">
        <div id="left">
            <?php echo $left; ?>
        </div>
        <div id="main">
            <?php echo $main; ?>
        </div>
        <div id="right">
            <?php echo $right; ?>
        </div>
        <div id="sep_vertical"></div>
    </div>
    <div id="footer">
        <?php echo $footer; ?>
    </div>
</body>
</html>
