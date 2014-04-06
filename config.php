<?php
//DON NOT EDIT ANYTHING ABOVE THIS LINE!
if (!isset($back)) {
    $back = './';
}

$password = 'CHANGE-THIS' ; //Not implemented yet
$columns = 2 ; //The number of columns on the page

//DO NOT EDIT ANYTHING BELOW THIS LINE!
$config = array_merge(json_decode(file_get_contents($back . 'servers.json'), true), Array("columns" => $columns) , Array("password" => $password));
?>