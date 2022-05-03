<?php
    

        function autoload($class){
            $class = strtolower($class);
            include_once ($class."Controller.php");
        }
        spl_autoload_register('autoload');
    