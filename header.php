<?php
//error_reporting(E_ALL);
include $back . 'config.php';
?>
<head>
<title>BungeeCord Network Status</title>
<link rel="icon" type="image/x-icon" href="<?php echo $back; ?>favicon.ico" />
<meta charset="utf-8">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<style>
body {
    font-family:Verdana, Geneva, sans-serif;
}

table {
    margin:10px;
    table-layout:fixed;
    overflow-x:auto;
}

table, th, td {
    //border: 1px solid black;
}

th, td {
    text-align:center;
    vertical-align:top;
    text-align:center;
    padding:15px;
    border: 1px solid #DD;
	border-radius: 10px;
	box-shadow: 0 0 5px #DDD inset;
}

a:link {
    text-decoration:none;
    color:blue;
}

a:visited {
    text-decoration:none;
    color:blue;
}

a:hover {
    text-decoration:none;
    color:black;
}

a:active {
    text-decoration:none;
    color:blue;
}

</style>