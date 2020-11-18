
   <h2>Nouveau Sujet</h2>
<form action="?ctrl=sujet&method=addTopic" method="POST">
<div class="form-group">
    <label for="exampleFormControlInput1">Titre Du Sujet</label><br>
    <input type="text" class="form-control" name="titresujet" id="exampleFormControlInput1"><br><br>
            <label for="exampleFormControlTextarea1">Saisir Le Contenu</label><br>
            <textarea class="form-control" name="contenu" id="exampleFormControlTextarea1" rows="10"></textarea><br><br>
            <label for="exampleFormControlTextarea1">Choisir La Categorie</label><br>
    <select name="categorie_id" multiple class="form-control" id="categorie"><br>
              <?php
              foreach($data['cat'] as $categorie){
                  echo '<option value ='.$categorie->getId().'>'.$categorie->getId()."-".$categorie->getNomcategorie().'</option>';
              }
              ?>
          </select><br>
    <button type="submit" class="btn btn-primary">Envoyez</button><br><br>
    </div>
    <input id="token" name="token" type="hidden" value=<?=$token?>>
</form>



<?php

$titre = "Nouveau Sujet";