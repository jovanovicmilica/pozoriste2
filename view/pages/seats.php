<?php
    require_once "models/seats.php";

?>
<main>
    <div class="container">
        <div class="row">
            <?php
                if($code!=200):
            ?>
                <h1 class="text-center"><?=$data?></h1>
            <?php
                else:
            ?>
            <div class="col-12">
                <div class="row justify-content-between align-items-end">
                    <div class="col-6">
                        <h1 class="m-0"><?=$performance['name']?></h1>
                    </div>
                    <div class="col-6 text-end">
                        <?php
                            $date=new DateTime($performance['datePerforming']);
                        ?>
                        <p class="m-0 fs-4"><?=$date->format('d.m.Y.')?> 20:00h</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="scena">
                    <p class="text-light fs-1 m-0">Scena</p>
                </div>
            </div>
            <div class="col-12 parter mx-auto my-3">
                <div>
                    <p class="fs-4">Parterre left</p>
                </div>
                <div>
                    <p class="fs-4">Parterre right</p>
                </div>
            </div>
            <div class="col-12 mx-auto text-end">
                    <form action="#">
                        <div class="px-3 py-1">
                            <input type="button" id="checkSeats" class="fs-4 text-bold px-3 py-1 kupi text-light border-0" value="Buy" data-bs-toggle="modal" data-bs-target="#modalTickets">
                            <input type="hidden" id="repertoire" value="<?=$_GET['id']?>"/>
                        </div>
                    </form>
            </div>
            <div class="col-12 mx-auto">
                <?php
                    for($i=1;$i<=10;$i++):
                        $jMax=10;
                    ?>

                    <div class="redDrzac">
                        <div class="red">
                            <span><?=$i?></span>
                        </div>

                        <div id="places">
                    <?php
                        for($j=1;$j<=$jMax;$j++):
                            
                ?>
                <!-- POSITION!!!!! -->
                <!-- 1 levo -->
                <!-- 2 desno -->
                <!-- 3 sredina -->

                        
                            <a href="#" class="places 
                                <?php
                                foreach($data as $d):
                                    if($d['position']==1 && $d['row']==$i && $d['place']==$j):
                                ?>
                                    purchased
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            " data-position="1" data-row="<?=$i?>" data-place="<?=$j?>"><?=$j?><span class="popup">
                                Row: <span class="font-weight-bold"><?=$i?></span><br>
                                Seat: <span class="font-weight-bold"><?=$j?></span><br>
                                Parterre left <br>
                                Price : <?=$performance['price']?>
                            </span></a>
                    

                <?php
                        endfor;
                ?>
                <?php
                        if($i%2==0):
                ?>
                        <a href="#" class="places 
                                <?php
                                foreach($data as $d):
                                    if($d['position']==3 && $d['row']==$i && $d['place']==$j):
                                ?>
                                    purchased
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            " data-position="3" data-row="<?=$i?>" data-place="11">11<span class="popup">
                                Row: <span class="font-weight-bold"><?=$i?></span><br>
                                Seat: <span class="font-weight-bold">11</span><br>
                                Middle <br>
                                Price : <?=$performance['price']?>
                            </span></a>
                <?php
                        endif;
                ?>
                <?php
                        for($j=$jMax;$j>=1;$j--):
                ?>
        
                            <a href="#" class="places
                                <?php
                                foreach($data as $d):
                                    if($d['position']==2 && $d['row']==$i && $d['place']==$j):
                                ?>
                                    purchased
                                <?php
                                    endif;
                                endforeach;
                                ?>" data-position="2" data-row="<?=$i?>" data-place="<?=$j?>"><?=$j?><span class="popup">
                                Row: <span class="font-weight-bold"><?=$i?></span><br>
                                Seat: <span class="font-weight-bold"><?=$j?></span><br>
                                Parterre right <br>
                                Price : <?=$performance['price']?>
                            </span></a>
                                
                                
                        
        
                <?php
                            
                        endfor;

                ?>
                        </div>
                        
                        <div class="red desno">
                            <span><?=$i?></span>
                        </div>
                    </div>
                <?php
                    endfor;
                ?>
            </div>
            

            <!-- Modal -->
            <div class="modal fade" id="modalTickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tickets</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="seatsMessage">

                    </div>
                    <div id="buyMessage"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="buy" class="btn btnBuy">Buy</button>
                </div>
                </div>
            </div>
            </div>
            
            <?php
                endif;
            ?>
        </div>
        <?php
            if($code==200):
        ?>
        <div class="col-12">
            <p><span class="boja nedostupna"></span> Seats are not available</p>
            <p><span class="boja dostupna"></span> Available seats</p>
            <p><span class="boja izabrana"></span> Selected seats</p>
        </div>

        <?php
            endif;
        ?>
    </div>
</main>