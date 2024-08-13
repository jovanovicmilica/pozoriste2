<?php
    require_once "connection.php";

    $query="SELECT * FROM navigations WHERE preview=1";

    ///1 uvek svi

    // $_SESSION['user']['idRole']=1;
    // session_unset();
    if(isset($_SESSION['user'])){
        ///3 ulogovan 
        $query.=" OR preview=3";

        if($_SESSION['user']['idRole']==1){
            //4 admin
        $query.=" OR preview=4";
        }
    }
    else{
        $query.=" OR preview=2";
    }

    $query.=" ORDER BY priority";

    try{
        $nav=$connection->query($query)->fetchAll();
        // $nav=$query;
    }
    catch(PDOException $e){
        $nav=$e->getMessage();
    }
?>