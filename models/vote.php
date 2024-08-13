<?php
session_start();
require_once "connection.php";
    $code = 200;

    $id = $_POST['id'];
    $user = $_SESSION['user'];
    $idUser = $user['id'];

    $upit = "INSERT INTO useranswers VALUES (null,:id,:idUser)";

    
    $priprema = $connection->prepare($upit);
    $priprema->bindParam(":id", $id);
    $priprema->bindParam(":idUser", $idUser);
    try
    {
        $priprema->execute();
        $code = 201;
        $data = "Successfully voted!";
    }
    catch(PDOException $e)
    {
        $code = 500;
        $data = $e->getMessage();
    }
http_response_code($code);
echo json_encode($data);
?>
