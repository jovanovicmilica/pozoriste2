<?php


    require_once "view/fixed/head.php";

    require_once "view/fixed/header.php";

    if(isset($_SESSION['user'])){
        echo "<h1 class='text-center my-3'>No access</h1>";
    }
    else{
        require_once "view/pages/login.php";
    }

    require_once "view/fixed/footer.php";

?>