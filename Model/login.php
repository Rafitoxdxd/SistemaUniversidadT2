<?php

//importa el archivo de conexion
include("connection.php");

//conecta con la base de datos
if (Conexion::getConexion() == null)
{ Conexion::conectar(); }


if (isset($_POST["login"]))
{
    $u_ci = $_POST["ci"];
    $u_password = $_POST["pass"];
    
    $sql = "SELECT * FROM users WHERE cedula = :ci";

    $stmt = Conexion::getConexion()->prepare($sql);
    $stmt->bindParam(':ci', $u_ci);
    $stmt->execute();

    $userdata = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$userdata)
    { echo "user not found"; }
    else if (password_verify($u_password, $userdata["password"]))
    {
        if (session_status() == PHP_SESSION_NONE)
        { session_start(); }
        $_SESSION["ci"] = $userdata["cedula"];
        $_SESSION["name"] = $userdata["name"];
        $_SESSION["lastname"] = $userdata["lastName"];
        $_SESSION["mail"] = $userdata["mail"];
        $_SESSION["birthdate"] = $userdata["birthDate"];
        $_SESSION["gender"] = $userdata["gender"];

        //return to main page
        header("Location: ?pagina=main");
        exit;
    }
    else
    { echo "wrong password"; }

    $_POST["login"] = null;
}

?>