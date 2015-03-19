<?php
include $back . "config.php";
$version = "1.8";

if ($config["session_fix"]) session_start();
?>
<head>
    <!-- BUNGEESTATUS VERSION <?php echo $version ?> -->
    <title><?php echo $config["title"] ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $back ?>include/favicon.ico" />
    <meta charset="UTF-8">
	<meta name="author" content="franga2000">
	<meta name="application-name" content="BungeeStatus">
    
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.2/css/bootstrap3/bootstrap-switch.min.css">
    
    <link rel="stylesheet" href="<?php echo $back ?>include/style.css">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <?php if (isset($admin)): ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/tab.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/modal.min.js"></script>
    <?php endif ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
</head>
<script>
var VERSION = <?php echo $version ?>;
</script>