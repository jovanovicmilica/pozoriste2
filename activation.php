<?php


    require_once "view/fixed/head.php";

    require_once "view/fixed/header.php";

    if(!isset($_SESSION['user'])){
        require_once "view/pages/activation.php";
    }
    else{
        echo "<main><h1 class='text-center my-5'>No Access</h1></main>";
    }


    require_once "view/fixed/footer.php";

?>