<?php

    require_once "view/fixed/head.php";

    require_once "view/fixed/header.php";

    if(isset($_SESSION['user'])){
        require_once "view/pages/tickets.php";
    }
    else{
        echo "<main><div class='text-center'><h1>No access</h1></div></main>";
    }

    require_once "view/fixed/footer.php";

?>