<?php
    require_once "connection.php";
    $next=null;

    $query="SELECT *,re.id FROM performances p INNER JOIN prices pr
            ON p.id=pr.idPerformance INNER JOIN repertoire re
            ON re.idPrice=pr.id 
            WHERE datePerforming>=CURRENT_DATE ORDER BY datePerforming LIMIT 1";


    try{
        $data=$connection->query($query);
        if($data->rowCount()==0){
            $data="There is nothing in the repertoire";
        }
        else{
            $next=$data->fetch();
        }
        $code=200;
    }
    catch(PDOException $e){
        $data="Server error";
        $code=500;
    }
?>