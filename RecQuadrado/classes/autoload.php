<?php  
    include_once 'Database.class.php';
    spl_autoload_register(function($class){
        include '../classes/' . $class . '.class.php';
    });

?>