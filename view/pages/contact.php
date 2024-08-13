<?php
    require_once "models/poll.php";
?>
<main>
    <div class="container pt-5">
        <div class="row pt-5 text-center">
            <h1>Contact</h1>
        </div>
        <div class="row justify-content-between">
            <div class="col-5">
                <form action="#" onSubmit="return sendMessage()">
                    <div class="row messageDiv">
                        <div class="col-12 mt-2">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" class="form-control">
                            <p>E-mail formats: petar.petrovic.123.21@ict.edu.rs or petar@gmail.com</p>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="title">Subject</label>
                            <input type="text" id="subject" class="form-control">
                            <p>You have to write subject</p>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="message">Message</label>
                            <textarea class="col-12 form-control" id="message"></textarea>
                            <p>Message has 10 words minimum</p>
                        </div>
                        <div class="col-12 mt-2">
                        </div>
                        <div class="col-12 mt-2">
                            <input type="submit" id="btnMessage" class="btn" value="Send">
                            <div class="my-2">
                                <p id="alertMessage"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-5">
                <h2>Pool</h2>
                <?php
                    if(isset($_SESSION['user'])):
                ?>
                <form action="#">

                    <?php
                        if(isset($message)):
                    ?>
                            <p><?=$message?></p>
                    <?php
                        else:
                    ?>
                    <h4><?=$aktivna['question']?></h4>
                    <?php
                        foreach($odgovori as $o): 
                    ?>
                        <input type="radio" value="<?=$o['id']?>" name="odg" class="odg"/>
                        <span class="mx-2"><?=$o['answer']?></span>
                        <br/>
                    <?php
                        endforeach;
                    ?>
                        <input type="button" value="Vote" id="vote"
                    <?php
                        if(isset($obavestenje)):
                        ?>
                            disabled="disabled"
                        <?php
                        endif;
                        ?>
                            class="btn btn-primary mt-2">
                        <?php
                            if(isset($obavestenje)):
                            ?>
                                <p><?=$obavestenje?></p>
                            <?php
                            endif;
                        ?>
                            <p id="obavestenje"></p>
                    <?php
                        endif;
                    ?>
                </form>
                <?php
                    else:
                ?>
                    <h3>Log in to see our poll!</h3>
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</main>