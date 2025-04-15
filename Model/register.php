<?php

include("connection.php");
include("userManagement.php");

function registerUser($tableData, $tablename)
{
    $registered = false;

    if (connection::getConnection() == null)
    { connection::connect(); }
    $pdo = connection::getConnection();

    $sql =  "INSERT INTO ". $tablename ." (cedula, name, lastName, mail, password, birthDate, gender) "
    ."VALUES (:ci, :name, :lastname, :mail, :password, :birthdate, :gender)";

    $encryptedPass = password_hash($tableData["password"], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':ci', $tableData["ci"]);
    $stmt->bindParam(':name', $tableData["name"]);
    $stmt->bindParam(':lastname', $tableData["lastname"]);
    $stmt->bindParam(':mail', $tableData["mail"]);
    $stmt->bindParam(':password', $encryptedPass);
    $stmt->bindParam(':birthdate', $tableData["birthdate"]);
    $stmt->bindParam(':gender', $tableData["gender"]);

    //verify if user already exists
    $verify_sql = "SELECT cedula FROM ". $tablename ." WHERE cedula = :ci";
    $verify_stmt = $pdo->prepare($verify_sql);
    $verify_stmt->bindParam(':ci', $tableData["ci"]);
    $verify_stmt->execute();

    if (!$verify_stmt->fetch(PDO::FETCH_ASSOC))
    {
        $stmt->execute();
        $registered = true;
    }

    return $registered;
}

?>