<?php
//DON NOT EDIT ANYTHING ABOVE THIS LINE!
if (!isset($back)) {
    $back = './';
}

//DO NOT EDIT ANYTHING BELOW THIS LINE!
$config = array_merge(json_decode(file_get_contents($back . 'servers.json'), true), Array(
    'password' =>       'CHANGE-THIS',
    'columns' =>        2,  //The number of columns of serverson the main page
    'player_columns'=>  2,  //The number of columns of playerson the server page
    'nojava' =>         false,  //The number of columns of playerson the server page
    'toolbar' =>        "top" //Location of the toolbar
    )
);
?>