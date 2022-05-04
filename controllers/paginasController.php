<?php

    require_once('autoload.php');

    include_once('./models/menu.php');
    include_once('./controllers/menusController.php');

    use models\menu;

    class paginasController{

        function inicio(){

            $menu = menu::consultar();
            Views::redirect('inicio', $menu);
        }

        function general($menu){
            $menu = $menu;
            Views::redirect('general', $menu);
        }

        

        function crear(){
            $menu = menu::menusExistentes();
            Views::redirect('crear', $menu);
        }
        
    }