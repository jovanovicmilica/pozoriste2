<?php
    require_once "connection.php";

    $upit="SELECT * FROM poll";


    $upit2="SELECT a.answer,COUNT(ua.idAnswer) AS answers FROM answers a LEFT JOIN  useranswers ua ON a.id=ua.idAnswer GROUP BY a.id";
    $code=200;

    try{
        $question=$connection->query($upit)->fetch();
        $data['question']=$question['question'];
        $data['active']=$question['active'];

        $data['voting']=$connection->query($upit2)->fetchAll();
    }
    catch(PDOException $e){
        $code=500;
        $data=$e->getMessage();
    }




echo json_encode($data);
http_response_code($code);
?>