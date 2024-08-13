<?php
    require_once "connection.php";   


    if(isset($_GET['btn'])){
        $code=200;

     

        
        $query="SELECT *,pr.id FROM performances p INNER JOIN prices pr
                ON p.id=pr.idPerformance";
    
    
        try{
            $performances=$connection->query($query);
            $data=$connection->query($query)->fetchAll();

        }
        catch(Exception $e){
            $code=500;
            $data="Server error";
        }
    }
    else{
        $code=404;
        $data="Not found";
    }

    
echo json_encode($data);
http_response_code($code);
?>