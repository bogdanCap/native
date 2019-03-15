<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function __autoload($class)
{
    
    $path = str_replace('\\', '/', $class);

    require "$path.php";
}

