<?php

require_once "connection.php";

    $code=200;
    $data="";

    $upit="UPDATE poll set active=0";
        
    try{
        $connection->query($upit);
        $code=204;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    
echo json_encode($data);
http_response_code($code);
?>