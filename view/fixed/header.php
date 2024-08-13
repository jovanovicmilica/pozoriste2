<?php
    require_once "models/getNav.php";
?>
<div class="container-fluid bg-light fixed-top">
    <div class="row py-2 px-3 justify-content-between align-items-center">
        <div class="col-5" id="logo">
            <a href="index.php" class="text-decoration-none text-dark">
                <img class="img-fluid" src="assets/images/logo.png" alt="Logo image"/>
            </a>
        </div>
        <div class="col-6">
            <ul class="d-flex justify-content-between align-items-center m-0 nav">
                <?php
                    foreach($nav as $n):
                ?>
                    <li class="nav-item">
                        <a href="<?=$n['path']?>" class="text-decoration-none"><?=$n['name']?></a>
                    </li>
                <?php
                    endforeach;
                ?>
            </ul>
        </div>
    </div>
</div>