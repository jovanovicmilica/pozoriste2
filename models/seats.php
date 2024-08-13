<?php
    require_once "connection.php";   

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT * FROM tickets WHERE idRepertoire=:id";
        $query2="SELECT * FROM performances p INNER JOIN prices pr
                ON p.id=pr.idPerformance INNER JOIN repertoire re
                ON re.idPrice=pr.id WHERE re.id=:id
                AND datePerforming>=CURRENT_DATE";

        $prepare=$connection->prepare($query);
        $prepare2=$connection->prepare($query2);

        $prepare->bindParam(":id",$id);
        $prepare2->bindParam(":id",$id);


        $code=200;

        try{
            // $performances=$connection->query($query)->fetchAll();
            $prepare->execute();
            $prepare2->execute();
            if($prepare2->rowCount()==0){
                $data="No access";
                $code=404;
            }
            else{
                $code=200;
    
                $data=$prepare->fetchAll();
                $performance=$prepare2->fetch();
            }

            
        }
        catch(Exception $e){
            $code=500;
            $message="Server error";
        }
    }
    else{
        $code=404;
        $message="Page not found";
    }
?>
