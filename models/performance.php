<?php
    require_once "connection.php";   
    

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $query="SELECT * FROM performances WHERE id=:id";

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
            $date="Server error";
            $code=500;
        }




    }
    else{
        $code=404;
        $data="No access";
    }
?>