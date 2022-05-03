<?php 

    require_once('autoload.php');
    include_once('./libs/db.php');
    include_once('./models/menu.php');

    use libs\db;
    use models\menu;
    
    db::crearInstance();

    class menusController{
        
        public function inicio(){
            $menus = menu::consultar();
            // $haveSon = menu::ifHaveSon();
            Views::redirect('inicio', $menus);
        }
        public function crear(){
            if($_POST){
                $name = $_POST['name'];
                $father_id = $_POST['father_id'];
                $description = $_POST['description'];
                menu::crear($name, $father_id, $description);
                $menu = menu::consultar();
                Views::redirect('inicio', $menu);
                exit();
            }
            $menus = menu::menusExistentes();
            Views::redirect('crear', $menus);
        }



        public function editar(){

            if($_POST){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $father_id = $_POST['father_id'];
                // $name2 = $_POST['name2'];
                $description = $_POST['description'];
                menu::update($id, $name, $father_id, $description);
                $menu = menu::consultar();
                Views::redirect('inicio', $menu);

                exit();
            }

            $id = $_GET['id'];
            $menu = (menu::buscarById($id));
            $existentes = (menu::menusExistentes($id, $menu->father_id));
            // var_dump($existentes);
            Views::redirect('editar' , $menu, $existentes);
        }

        public function borrar(){
            $id = $_GET['id'];
            menu::borrar($id);
            $menu = menu::consultar();
            Views::redirect('inicio', $menu);
        }

    }