<?php
    require_once "connection.php";   

    $query="SELECT *,r.id FROM repertoire r INNER JOIN prices p
    ON r.idPrice=p.id INNER JOIN performances pe
    ON p.idPerformance=pe.id
    WHERE MONTH(datePerforming)=MONTH(CURRENT_DATE) AND datePerforming>=CURRENT_DATE
    ORDER BY datePerforming";

    
    $code=200;
    try{
        $repertoire=$connection->query($query)->fetchAll();
    }
    catch(Exception $e){
        $code=500;
        // $message="Server error";
        $message=$e->getMessage();
    }
?>