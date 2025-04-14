<?php

include("connection.php");

if (connection::getConnection() == null)
{ connection::connect(); }

if (isset($_POST["login"]))
{
    $u_ci = $_POST["ci"];
    $u_password = $_POST["pass"];
    
    $sql = "SELECT * FROM users WHERE cedula = :ci";

    $stmt = connection::getConnection()->prepare($sql);
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
        header("Location: ?page=main");
        exit;
    }
    else
    { echo "wrong password"; }

    $_POST["login"] = null;
}

?>