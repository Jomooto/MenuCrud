<?php
    

    $controller = strtolower($controller);
    $action = strtolower($action);
    
    if(file_exists("controllers/{$controller}Controller.php")){
        include_once("controllers/{$controller}Controller.php");
        $objController = "{$controller}Controller";
    }else{
        include_once("controllers/paginasController.php");
        $objController = "paginasController";
    }
    if(!method_exists($objController,$action)){
        $action = "inicio";
    }
    

    $controllers = new $objController();
    $controllers->$action();