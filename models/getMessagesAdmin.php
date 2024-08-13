<?php
    require_once "connection.php";

    $code=200;

    $query="select * from messages";

    try{
        $data=$connection->query($query)->fetchAll();

        
    }
    catch(PDOException $e){
        $data="Server error";
        $code=500;
        // $data=$e->getMessage();
    }
    
echo json_encode($data);
http_response_code($code);
    
?>