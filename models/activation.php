<?php

    require_once "connection.php";   

    if(isset($_GET['code'])){
        $code=$_GET['code'];
    
        $query="SELECT * FROM users WHERE activationcode=:code";
    
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":code",$code);
        try{
            $prepare->execute();
            if($prepare->rowCount()==1){
                $korisnik=$prepare->fetch();
                $aktivan=1;
                $query2="UPDATE users SET active=:active WHERE activationcode=:code";
                $prepare2=$connection->prepare($query2);
                $prepare2->bindParam(":active",$aktivan);
                $prepare2->bindParam(":code",$code);
                try{
                    $prepare2->execute();
                    $message="Account activated";
                }
                catch(PDOException $e){
                    $message="Server error";
                }
            }
            else{
                $message="Code Not Found";
            }
        }
        catch(PDOException $e){
            // $message="Server error";
            $message=$e->getMessage();
        }
    }
    else{
        $message="No Access";
    }

?>