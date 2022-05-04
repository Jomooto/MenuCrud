<?php

    namespace Models;

  
    require_once('libs/db.php');
    use libs\db;
    use PDOException;

    class menu{

        public $id;
        public $name;
        public $description;
        public $father_id;
        public $name2;

        public function __construct($id = null, $name = null, $description = null, $father_id = null, $name2 = null) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->father_id = $father_id;
            $this->name2 = $name2;
        }


        public static function consultar(){
            $listMenu = [];
            $conexion = db::crearInstance();
            $sql = $conexion->query("SELECT a.id, a.name, a.description, a.father_id, b.name AS name2 FROM menu AS a INNER JOIN menu AS b ON a.father_id = b.id
            UNION 
            SELECT a.id, a.name, a.description, a.father_id, a.father_id FROM menu AS a  WHERE a.father_id IS NULL");
            

            foreach($sql->fetchAll() as $menu){
                $listMenu[] = new menu($menu['id'], $menu['name'], $menu['description'], $menu['father_id'], $menu['name2']);
            }
        
            return $listMenu;
        }

        public static function ifHaveSon($id = 0) {
            $conexion = db::crearInstance();
            $sql = $conexion->prepare("SELECT id FROM menu WHERE father_id = ?");
            $sql->execute(array($id));
            
            $result =  $sql->fetch();
        
            return ((bool)$result['id']);
        }


        public static function menusExistentes($id = 0, $father_id = 0) {
            $listMenu = [];
            $conexion = db::crearInstance();
            if($father_id == NULL){
                $father_id = 0;
            }
            $sql = $conexion->query("SELECT id, name FROM menu WHERE id != $id AND id != $father_id");

            foreach($sql->fetchAll() as $menu){
                $listMenu[] = new menu($menu['id'], $menu['name']);
            }

            return $listMenu;
        }

        public static function nullMenus() {
            $listMenu = [];
            $conexion = db::crearInstance();
            $sql = $conexion->query("SELECT id, name, father_id, description FROM menu WHERE father_id IS NULL");

            foreach($sql->fetchAll() as $menu){
                $listMenu[] = new menu($menu['id'], $menu['name'], $menu['father_id'], $menu['description']);
            }

            return $listMenu;
        }

        public static function subMenus($id) {
            $listMenu = [];
            $conexion = db::crearInstance();
            // var_dump($id);
            $sql = $conexion->query("SELECT id, name, father_id, description FROM menu WHERE father_id = $id");

            
            foreach($sql->fetchAll() as $menu){
                $listMenu[] = new menu($menu['id'], $menu['name'], $menu['father_id'], $menu['description']);
            }
            

            // var_dump($listMenu);
            return $listMenu;
        }

        public static function checkSubMenus($id) {
            $listMenu = [];
            $conexion = db::crearInstance();
            $sql = $conexion->prepare("SELECT id, name FROM menu WHERE father_id = ?");
            // $sql->execute(array($id));
            // $result =  $sql->fetch();
            
            $sql->execute(array($id));
            
            $result =  $sql->fetch();

            return ((bool)$result['id']);

        }

        public static function getChildsMenus() {
            $listMenu = [];
            $conexion = db::crearInstance();
            $sql = $conexion->query("SELECT id, name, father_id, description FROM menu");

            foreach($sql->fetchAll() as $menu){
                $listMenu[] = new menu($menu['id'], $menu['name'], $menu['father_id'], $menu['description']);
            }

            return $listMenu;
        }


        public static function crear($name, $father_id = NULL, $description){
            $conexion = db::crearInstance();
            if(!$father_id){
                $sql = $conexion->prepare("INSERT INTO menu(name, description) VALUES (?, ?)");
                $sql->execute(array($name, $description));
            }else{
                $sql = $conexion->prepare("INSERT INTO menu(name, father_id, description) VALUES (?, ?, ?)");
                $sql->execute(array($name, $father_id, $description));
            }
            
        }

        public static function borrar($id){
            $conexion = db::crearInstance();
            $sql = $conexion->prepare('DELETE FROM menu WHERE id =?');
            $sql->execute(array($id));
        }

        public static function buscarById($id){
            $conexion = db::crearInstance();
            $isNull = self::ifFatherIsNull($id);
            // var_dump($isNull);
            if(!$isNull){
                $sql = $conexion->prepare('SELECT id, name, father_id, description FROM menu where id = ?;');
                $sql->execute(array($id));            
                $menu = $sql->fetch();

                return new menu($menu['id'], $menu['name'], $menu['description'], $menu['father_id'],$menu['name2']);
            }else{
                $sql = $conexion->prepare('SELECT a.id, a.name, a.description, a.father_id, b.name AS name2 FROM menu AS a INNER JOIN menu AS b ON a.father_id = b.id WHERE a.id = ?;');
                $sql->execute(array($id));            
                $menu = $sql->fetch();

                return new menu($menu['id'], $menu['name'], $menu['description'], $menu['father_id'], $menu['name2']);
            }
            
        }

        public function ifFatherIsNull($id){
            $conexion = db::crearInstance();
            $sql = $conexion->prepare("SELECT father_id FROM menu WHERE id = ?");
            $sql->execute(array($id));
            $result =  $sql->fetch();

            return ((bool)$result['father_id']);
        }

        public static function update($id, $name, $father_id, $description){
            try{
                $conexion = db::crearInstance();
                $sql = $conexion->prepare('UPDATE menu SET name = ?, description = ?, father_id = ? WHERE id = ?');                            
                $result = $sql->execute(array($name, $description, $father_id, $id));
            }catch(PDOException $Exception){
                    echo $Exception->getMessage();
            }
            // var_dump($id);
        }
        
    }