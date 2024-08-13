<?php
    require_once "connection.php";

    $code=200;

    if(isset($_POST['id'])){
        $query="DELETE FROM performances WHERE id=:id";
        
        $priprema=$connection->prepare($query);

        $priprema->bindParam(":id",$_POST['id']);

        try{
            $priprema->execute();
            $data="Deleted";
        }
        catch(PDOException $e){
            $data="Server error";
            $code=500;
            // $data=$e->getMessage();
        }
    }
    else{
        $code=404;
        $data="Not found";
    }

    
echo json_encode($data);
http_response_code($code);
?>