<?php
    require_once "models/performance.php";
?>

<main>
    <div class="container">
        <div class="row justify-content-between">
                <?php
                    if($code!=200):
                ?>
                    <div class="col-12 text-center">
                        <h1><?=$data?></h1>
                    </div>
                <?php
                    else:
                ?>
                    <div class="col-12 text-center">
                        <h1>
                            <?=$data['name']?>
                        </h1>
                    </div>

                    <div class="col-4 my-4">
                        <img class="img-fluid" src="assets/images/<?=$data['poster']?>" alt="<?=$data['name']?>"/>
                    </div>

                    <div class="col-6 my-4">
                        <p><?=$data['description']?></p>
                        <p>Duration: <?=$data['duration']?></p>
                            <?php
                                $date=new DateTime($data['premier']);
                            ?>
                        <p>Premier: <?=$date->format('d.m.Y.')?></p>
                    </div>

                <?php
                    endif;
                ?>
        </div>
    </div>
</main>