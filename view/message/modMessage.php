<?php
    $message=$data['message'];
?>
   <h2>Modifier message</h2>
    <form action="?ctrl=message&method=modPost&id=<?=$message->getId()?>" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Titre Du message</label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="titremessage" id="exampleFormControlInput1" value="<?= $message->getTitremessage()?>">
        </div>
        <div class="form-group">
                    <label for="exampleFormControlTextarea1">Modifier votre Message</label>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="reponse" id="exampleFormControlTextarea1" rows="6">
            <?= $message->getReponse()?>
            </textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Envoyez</button>
        </div>
            <input id="token" name="token" type="hidden" value=<?=$token?>>
    </form>



<?php

$titre = "Modifier Message";