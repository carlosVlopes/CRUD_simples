<?php

// conexao com o banco de dados SQL

    // Configurações do site
    define('HOST','localhost'); // IP
    define('USER','root'); //usuario
    define('PASS', null); //senha
    define('DB', 'db_crud'); //banco

    class Conexao{
        /** @var PDO */
        private static $Connect;

        private static function Conectar(){
            try{

                //verefica se a conexão não existe
                if (self::$Connect == null):

                    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                    self::$Connect = new PDO($dsn, USER, PASS, null);
                endif;
            } catch (PDOException $e){
                echo $e->getMessage();
            }

            //Seta os atributos para que seja retornado as excessões do banco
            self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return self::$Connect;
        }

        public static function retornarConexao(){
            return self::Conectar();
        }
    }


?>