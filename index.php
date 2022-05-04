<?php
    error_reporting(E_ALL ^ E_NOTICE);
    $controller = "paginas";
    $action = "inicio";

    if(isset($_GET['controller']) && isset($_GET['action'])){
        if($_GET['controller'] != ""){
            $controller = $_GET['controller'];
        
        }
        if($_GET['action'] != ""){
            $action = $_GET['action'];
        }
        

    }
    include_once('./views/menus/menu.php');
    require_once('views/template.php');