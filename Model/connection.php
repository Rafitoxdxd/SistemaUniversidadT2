<?php

//clase para manejar la conexion con la base de datos
class Conexion
{
    //maneja la conexion con la base de datos
    private static $pdo;

    //Conecta con la base de datos
    static function conectar()
    {
        try
        {
            //crea una nueva instancia PDO en localhost con la BDD asignada
            Conexion::$pdo = new PDO("mysql:host=localhost; dbname=sistema_psicologia", "root", "");
            //asigna el mensaje de error a mostrar en caso de problemas al conectar
            Conexion::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //establece la codificación de caracteres a UTF-8, para aceptar caracteres especiales
            Conexion::$pdo->exec("SET CHARACTER SET UTF8");
        }
        catch (PDOException $e)
        {
            //creates a new database if the DB doesn't exists (TO DELETE WHEN TESTS ARE DONE)
            //ELIMINAR ESTO DESDE AQUI--------------------------------------------------------------------
            try
            {
                Conexion::$pdo = new PDO("mysql:host=localhost", "root", "");
                Conexion::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                Conexion::$pdo->exec("SET CHARACTER SET UTF8");

                $sql  = "CREATE DATABASE IF NOT EXISTS sistema_psicologia";
                $stmt = Conexion::$pdo->prepare($sql);
                $stmt->execute();

                //set the database to $pdo
                Conexion::$pdo = new PDO("mysql:host=localhost; dbname=sistema_psicologia", "root", "");
                Conexion::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                Conexion::$pdo->exec("SET CHARACTER SET UTF8");

                //create tables
                //user table
                $sql = "CREATE TABLE IF NOT EXISTS users (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."cedula INT(9) NOT NULL, "
                ."name VARCHAR(32) NOT NULL, "
                ."lastName VARCHAR(32) NOT NULL, "
                ."mail VARCHAR(80) NOT NULL, "
                ."password VARCHAR(80) NOT NULL, "
                ."birthDate DATE, "
                ."gender CHAR(1))";
                $stmt = Conexion::$pdo->prepare($sql);
                $stmt->execute();

                //psychologists table
                $sql = "CREATE TABLE IF NOT EXISTS psychologists (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."cedula INT(9) NOT NULL, "
                ."name VARCHAR(32) NOT NULL, "
                ."lastName VARCHAR(32) NOT NULL, "
                ."mail VARCHAR(80) NOT NULL, "
                ."password VARCHAR(80) NOT NULL, "
                ."birthDate DATE, "
                ."gender CHAR(1))";
                $stmt = Conexion::$pdo->prepare($sql);
                $stmt->execute();

                //consultations table
                $sql = "CREATE TABLE IF NOT EXISTS consultations (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."idUser INT NOT NULL, "
                ."idPsychologist INT NOT NULL, "
                ."consulDate DATE)";
                $stmt = Conexion::$pdo->prepare($sql);
                $stmt->execute();

                //history date
                $sql = "CREATE TABLE IF NOT EXISTS history (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."idUser INT NOT NULL, "
                ."idPsychologist INT NOT NULL, "
                ."documentPath VARCHAR(100) NOT NULL, "
                ."documentTitle VARCHAR(64) NOT NULL, "
                ."documentPa VARCHAR(128), "
                ."uploadDate DATE NOT NULL)";
                $stmt = Conexion::$pdo->prepare($sql);
                $stmt->execute();

            }
            catch (PDOException $e)
            { echo $e->getMessage(); }
            //HASTA AQUI------------------------------------------------------------------------------------------------
        }
    }

    static function getConexion()
    { return Conexion::$pdo; }
}

?>