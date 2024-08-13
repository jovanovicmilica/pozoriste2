<?php
    require_once "connection.php";   


    if(isset($_POST['btn'])){
        $code=200;

     

        $idPerformance=$_POST['idPerformance'];

        $err=0;
        if($idPerformance==0){
            $data="You have to choose performance";
            $err++;
        }
        if(!isset($_POST['date']) || strtotime($_POST['date'])<time()){
            $data="You have to choose date in future";
            $err++;
        }

        if($err==0){
            $date=$_POST['date'];

            $query="SELECT * FROM repertoire WHERE datePerforming=:datePerforming";
    
            $prepare=$connection->prepare($query);

            $prepare->bindParam(":datePerforming",$date);
    
            try{
                $prepare->execute();
                if($prepare->rowCount()==1){
                    $data="Date already reserved!";
                }
                else{
                    $query2="INSERT INTO repertoire  VALUES (NULL, :id, :datePerforming)";

                    $prepare2=$connection->prepare($query2);

                    $prepare2->bindParam(":id",$idPerformance);
                    $prepare2->bindParam(":datePerforming",$date);

                    $prepare2->execute();
                    $code=201;
                    $data="Added to repertoire";
                }
    
            }
            catch(Exception $e){
                $code=500;
                $data="Server error";
            }
        }
        
    }
    else{
        $code=404;
        $data="Not found";
    }

    
echo json_encode($data);
http_response_code($code);
?>