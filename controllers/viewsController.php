<?php 
    // namespace Controller;

    // include_once('./conexion.php');
    include_once('./models/menu.php');
    include_once('./libs/db.php');
    

    use models\menu;

    class Views{

        static function redirect($page, $menu=null, $existentes = null) {
            $menus = $menu;
            $existentes = $existentes;
            include_once("./views/menus/$page.php");
        }
    }