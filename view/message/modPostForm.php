<div>
    <form action="?ctrl=message&method=addPost&id=<?= $id ?>" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="titremessage" id="exampleFormControlInput1" placeholder="Titre Du message"><br>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="reponse" id="exampleFormControlTextarea1" rows="5"></textarea><br>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Envoyez</button>
        </div>
        <input id="token" name="token" type="hidden" value=<?=$token?>><br><br>
    </form>

</div>