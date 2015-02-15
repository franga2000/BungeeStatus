<?php
if (!isset($back))  $back = './';
$config = array_merge(json_decode(file_get_contents($back . 'config.json'), true), Array(
    'servers' => json_decode(file_get_contents($back . 'servers.json'), true), 
//DO NOT EDIT ANYTHING ABOVE THIS LINE!

    'password' => 'CHANGE-THIS', //The password used to access the admin page

//DO NOT EDIT ANYTHING BELOW THIS LINE!
));
?>