<?php
include $back . 'config.php';
?>
<head>
<title>BungeeCord Network Status</title>
<link rel="icon" type="image/x-icon" href="<?php echo $back; ?>favicon.ico" />
<meta charset="utf-8">
</head>

<style>
body {
    font-family:Verdana, Geneva, sans-serif;
}

table {
    width:100%;
    height:50%;
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
}

a:visited {
    text-decoration:none;}
a:hover {text-decoration:none;
}

a:active {
    text-decoration:none;
}

</style>