<?php
session_start();
    require_once "connection.php";

    $data="";
    $code=200;

    if(isset($_POST['btnBuy'])){

        $tickets=$_POST['tickets'];
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']['id'];
            $query="INSERT INTO tickets VALUES (NULL, :idRepertoire, :idUser, :placeRow, :place, :position, :purchaseDate)";
    
            foreach($tickets as $t){
    
                try{
                    $prepare=$connection->prepare($query);
                    $date=date("Y-m-d H:i:s");
        
                    $prepare->bindParam(":idRepertoire",$t['idRepertoire']);
                    $prepare->bindParam(":idUser",$idUser);
                    $prepare->bindParam(":placeRow",$t['row']);
                    $prepare->bindParam(":place",$t['place']);
                    $prepare->bindParam(":position",$t['position']);
                    $prepare->bindParam(":purchaseDate",$date);
        
                    $prepare->execute();
                    $code=201;
                    $data="Tickets were successfully purchased";
                }
                catch(PDOException $e){
                    $data="Server error";
                    $code=500;
                }
            }
        }
        else{
           $data="Login to buy";
           $code=401;
        }

        
    }
    else{
        $data= "NOT FOUND";
        $code=404;
    }

    
echo json_encode($data);
http_response_code($code);

?>