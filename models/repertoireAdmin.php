<?php
    require_once "connection.php";   

    if(isset($_GET['btn'])){
        $query="SELECT *,r.id FROM repertoire r INNER JOIN prices p
        ON r.idPrice=p.id INNER JOIN performances pe
        ON p.idPerformance=pe.id
        WHERE datePerforming>=CURRENT_DATE
        ORDER BY datePerforming";
    
        
        $code=200;
        try{
            $data=$connection->query($query)->fetchAll();
        }
        catch(Exception $e){
            $code=500;
            $data="Server error";
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