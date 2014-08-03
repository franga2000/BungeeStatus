<?php
//error_reporting(E_ALL);
include $back . 'config.php';
?>
<head>
<title>BungeeCord Network Status</title>
<link rel="icon" type="image/x-icon" href="<?php echo $back; ?>favicon.ico" />
<meta charset="utf-8">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<style>
body:not(.nope) {
    font-family:Verdana, Geneva, sans-serif;
}

table:not(.nope) {
    margin:10px;
    table-layout:fixed;
}

th:not(.nope), td:not(.nope) {
    text-align:center;
    vertical-align:top;
    text-align:center;
    padding:15px;
    border: 1px solid #DD;
	border-radius: 10px;
	box-shadow: 0 0 5px #DDD inset;
}

select:not(.nope) {
	border-radius:4px;
	border:1px solid #dcdcdc;
	font-size:15px;
	font-weight:bold;
	padding:7px 7px;
}

a:link:not(.nope) {
    text-decoration:none;
    color:blue;
}

a:visited:not(.nope) {
    text-decoration:none;
    color:blue;
}

a:hover:not(.nope) {
    text-decoration:none;
    color:black;
}

a:active:not(.nope) {
    text-decoration:none;
    color:blue;
}
</style>