<?php
    require_once "models/repertoire.php";
?>

<main>
    <div class="container">
        <div class="row">
            <?php
                if($code==200):
                    $getMont = new DateTime();
            ?>
            <div class="col-12 text-center">
                <h1>Repertoire - <?=$getMont->format('F Y.')?></h1>
            </div>
            <?php
                foreach($repertoire as $r):
            ?>
                <div class="col-9 mx-auto repertoire mb-1 py-2">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <?php
                                $date=new DateTime($r['datePerforming']);
                            ?>
                            <p class="fs-3"><?=$date->format('d.m.')?></p>
                            <p class="fs-4"><?=$date->format('l')?>, 20:00</p>
                            <hr class="text-success border-3 opacity-75"/>
                            <h2 class="fs-1"><?=$r['name']?></h2>
                            <a class="fs-5 text-light py-2 px-3 buy text-uppercase" href="seats.php?id=<?=$r['id']?>">Buy ticket</a>
                        </div>
                        <div class="col-3">
                            <img class="img-fluid" src="assets/images/<?=$r['poster']?>" alt="<?=$p['name']?>"/>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
            <?php
                else:
            ?>
                <p><?=$message?></p>
            <?php
                endif;
            ?>
        </div>
    </div>
</main>