<?php
    require_once "models/next.php";
?>

<main>
    <div class="container">
        <div class="row justify-content-center p-2">
            <?php
                if($next):
            ?>
                <div class="col-3">
                    <img src="assets/images/<?=$next['poster']?>" class="img-fluid" alt="<?=$next['name']?>"/>
                </div>
                <div class="col-3 next">
                    <div>
                        <p class="text-secondary fs-4">Next in the repertoire</p>
                        <h1 class="mt-2 mb-4"><?=$next['name']?></h1>
                        <?php
                            $date=new DateTime($next['datePerforming']);
                        ?>
                        <p class="m-0 fs-3"><?=$date->format('l')?></p>
                        <p class="fs-3"><?=$date->format('d.m.')?></p>
                    </div>
                    <div class="my-1">
                    <a class="fs-5 text-light py-2 px-3 buy text-uppercase" href="seats.php?id=<?=$next['id']?>">Buy ticket</a>
                    </div>
                </div>
            <?php
                else:
            ?>
                <p><?=$data?></p>
            <?php
                endif;
            ?>
        </div>
    </div>

    <div class="container-fluid bg-light py-4 my-5">
        <div class="row justify-content-between">
            <div class="col-12 text-center mb-3">
                <h2>About</h2>
            </div>
            <div class="col-6">
                <img src="assets/images/teatar.jpg" alt="Theatre"/>
            </div>
            <div class="col-6">
                <p class="fs-5">'Theater' is the youngest theater in Serbia, with its headquarters in Belgrade, Banovo Brdo. It is located between the wooded Kosutnjak and Ada Ciganlija, two favorite resorts of Belgraders.</p>
                <p class="fs-5">'Theater' was a dream, realized with the help of people who had a vision and enthusiasm, and most of all love for the theater, culture and the community in which they live.</p>
                <p class="fs-5">Today, we are one of the most visited stages in Belgrade, and our performances are at the top of viewership and popularity in the entire region.</p>
                <p class="fs-5">Tens of thousands of people follow our guest appearances and look forward to our performances.</p>
            </div>
        </div>
    </div>
</main>