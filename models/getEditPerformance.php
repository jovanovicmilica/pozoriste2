<?php
    require_once "connection.php";   
    

    if(isset($_POST['id'])){
        $id=$_POST['id'];

        $query="SELECT *,p.id FROM performances p INNER JOIN prices pr
                ON p.id=pr.idPerformance
               WHERE p.id=:id";

        $prepare=$connection->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            if($prepare->rowCount()==1){
                $data=$prepare->fetch();
                $code=200;
            }
            else{
                $data="No access";
                $code=404;
            }
        }
        catch(PDOException $e){
            $data="Server error";
            // $data=$e->getMessage();
            $code=500;
        }




    }
    else{
        $code=404;
        $data="No access";
    }
    echo json_encode($data);
    http_response_code($code);
?>