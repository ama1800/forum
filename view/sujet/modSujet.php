<?php
    $sujet=$data['sujet'];
?>
   <h2>Modifier Sujet</h2>
<form action="?ctrl=sujet&method=modTopic&id=<?=$sujet->getId()?>" method="POST">
<div class="form-group">
    <label for="exampleFormControlInput1">Titre Du Sujet</label><br>
    <input type="text" class="form-control" name="titresujet" id="exampleFormControlInput1" value="<?= $sujet->getTitresujet()?>"><br>
            <label for="exampleFormControlTextarea1">Contenu</label><br>
            <textarea class="form-control" name="contenu" id="exampleFormControlTextarea1" rows="10">
            <?= $sujet->getContenu()?>
            </textarea><br>
    
    <select name="categorie_id" multiple class="form-control" id="categorie">
              <?php
              foreach($data['cat'] as $categorie){
                  echo '<option value ='.$categorie->getId().'>'.$categorie->getId()."-".$categorie->getNomcategorie().'</option>';
              }
              ?>
          </select><br>
    <button type="submit" class="btn btn-primary">Envoyez</button>
    </div>
    <input id="token" name="token" type="hidden" value=<?=$token?>><br>
</form>



<?php

$titre = "Modifier Sujet";