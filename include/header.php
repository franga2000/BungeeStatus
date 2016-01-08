<?php
include $back . "config.php";
$version = "1.8";

if ($config["session_fix"]) session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- BUNGEESTATUS VERSION <?php echo $version ?> -->
    <title><?php echo $config["title"] ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $back ?>favicon.ico" />
    <meta charset="utf-8">
	<meta name="author" content="franga2000">
	<meta name="application-name" content="BungeeStatus">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css">
    
    <link rel="stylesheet" href="<?php echo $back ?>include/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/modal.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
    <?php if (isset($admin)) { ?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/tab.min.js"></script>
    <?php } ?>
    
    <script>
		var VERSION = "<?php echo $version ?>";
	</script>
</head>