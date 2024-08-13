<?php
session_start();
    require_once "connection.php";

    if(isset($_POST['ticketsBtn'])){

        $query="SELECT *,t.id FROM tickets t INNER JOIN repertoire r 
                ON r.id=t.idRepertoire INNER JOIN prices p 
                ON r.idPrice=p.id INNER JOIN performances pe
                ON pe.id=p.idPerformance
                WHERE t.idUser=:idUser
                AND r.datePerforming>=CURRENT_DATE
                ORDER BY datePerforming";
    
        $idUser=$_SESSION['user']['id'];
    
        
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":idUser",$idUser);

        
        try{
            $prepare->execute();

            $data=$prepare->fetchAll();
            $code=200;

            
        }
        catch(Exception $e){
            $code=500;
            // $data="Server error";
            $data=$e->getMessage();
        }
    }
    else{
        $data="No access";
        $code=404;
    }

    

echo json_encode($data);
http_response_code($code);
?>