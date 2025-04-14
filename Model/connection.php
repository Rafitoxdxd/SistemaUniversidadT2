<?php

class connection
{
    private static $pdo;

    static function connect()
    {
        try
        {
            connection::$pdo = new PDO("mysql:host=localhost; dbname=sistema_psicologia", "root", "");
            connection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            connection::$pdo->exec("SET CHARACTER SET UTF8");
        }
        catch (PDOException $e)
        {
            //creates a new database if the DB doesn't exists (TO DELETE WHEN TESTS ARE DONE)
            try
            {
                connection::$pdo = new PDO("mysql:host=localhost", "root", "");
                connection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                connection::$pdo->exec("SET CHARACTER SET UTF8");

                $sql = "CREATE DATABASE IF NOT EXISTS sistema_psicologia";
                $stmt = connection::$pdo->prepare($sql);
                $stmt->execute();

                //set the database to $pdo
                connection::$pdo = new PDO("mysql:host=localhost; dbname=sistema_psicologia", "root", "");
                connection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                connection::$pdo->exec("SET CHARACTER SET UTF8");

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
                $stmt = connection::$pdo->prepare($sql);
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
                $stmt = connection::$pdo->prepare($sql);
                $stmt->execute();

                //consultations table
                $sql = "CREATE TABLE IF NOT EXISTS consultations (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."idUser INT NOT NULL, "
                ."idPsychologist INT NOT NULL, "
                ."consulDate DATE)";
                $stmt = connection::$pdo->prepare($sql);
                $stmt->execute();

                //history date
                $sql = "CREATE TABLE IF NOT EXISTS history (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                ."idUser INT NOT NULL, "
                ."idPsychologist INT NOT NULL, "
                ."documentPath VARCHAR(100) NOT NULL, "
                ."documentTitle VARCHAR(64) NOT NULL, "
                ."documentPa VARCHAR(128), "
                ."uploadDate DATE NOT NULL)";
                $stmt = connection::$pdo->prepare($sql);
                $stmt->execute();

            }
            catch (PDOException $e)
            { echo $e->getMessage(); }
        }
    }

    static function getConnection()
    { return connection::$pdo; }
}

?>