<?php
    namespace Libs;

    use PDO;

    class db{
        private static $instance =NULL;
        
        public static function crearInstance(){
            if(!isset(self::$instance)){
                $opcionesPDO[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

                self::$instance = new PDO('mysql:host=mysql;dbname=menu', 'root','menu', $opcionesPDO);
            
            }

            return self::$instance;
        }
    }