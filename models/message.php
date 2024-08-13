<?php

    require_once "connection.php";

if(isset($_POST["btnMessage"])){
    $code=200;
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];
    $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
    $regSubject="/^[\w\s]+$/";
    $error=0;
    if(!preg_match($regEmail,$email)){
        $error++;
        $data="E-mail format: pera.peric.55.19@ict.edu.rs or pera@gmail.com";
    }
    if(!preg_match($regSubject,$subject)){
        $error++;
        $data="You have to write title";
    }
    if(count($message)<10){
        $error++;
        $data="Message have 10 words minimum";
    }
    if($error==0){
        $message=implode($message," ");
        $datum=date("Y-m-d H:i:s");
        $insert="INSERT INTO messages VALUES(null,:email,:subject,:message,:datum)";
        $prepare=$connection->prepare($insert);
        $prepare->bindParam(":email",$email);
        $prepare->bindParam(":subject",$subject);
        $prepare->bindParam(":message",$message);
        $prepare->bindParam(":datum",$datum);
        try{
            $prepare->execute();
            $date="Message successfuly sent";
            $code=201;
        }
        catch(PDOException $e){
            $date="Server error";
            $code=500;
        }
    }
    else{
        $code=422;
        $date=$data;
    }
}
else{
    $code=404;
    $date="Error";
}

echo json_encode($date);
http_response_code($code);
?>