<?php
use App\Session;
$th = $data['categorie'];
$nb = $data['nb'];
$nbm = $data['nbm'];
//  var_dump($th);
//  var_dump($nb);
//  var_dump($nbm);
//  die;
?>

<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <?=$th->getVerouillage() == 0 ?'
  <a href="?ctrl=sujet&method=addTopicForm"><button type="button" class="btn btn-secondary">Creer Un Sujet</button></a>' :
  '<a><button type="button" class="btn btn-secondary btn-lg" disabled>Categorie Fermé</button></a>' ?>
</div>
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>categorie:</li>
                <div class="list-group">
                    <li>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>STATUTS</th>
                                    <th>Nom categorie</th>
                                    <th>Nombre Sujets</th>
                                    <th>Nombre Messages</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $categorieStatu = $th->getVerouillage() == 0 ? '<img width="30" height="30" src="https://i.ibb.co/V3gstS3/ouvert.png" alt="ouvert" border="0" >'  : '<img width="30" height="30" src="https://i.ibb.co/gmmhQd6/fermer.png" alt="fermer" border="0" >' ?></td>
                                    <td><?= $th->getNomcategorie() ?></td>
                                    <td><?= empty($nb[0]->getNb())? 0 : $nb[0]->getNb() ?></td>
                                    <td><?= empty($nbm->getNb())? 0 : $nbm->getNb() ?></td>
                                    <?php 
                                            if(!empty(Session::getUtilisateur())){

                                                if(Session::getUtilisateur()->getRole() < 2){
                                    ?>
                                    <td style="width: 20%;" class='boutonsmessage'><button class='buttons'><a href='?ctrl=categorie& method=supcategorie&id=<?= $th->getId()?>'>Supprimer</a></button>
                                    <button class='buttons'><a href='?ctrl=message&method=modcategorie&id=<?= $th->getId() ?>'>Modifier</a></button></td>
                                    <?php
                                                }
                                            }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </div>
                <div>
                    <li>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">TITRE Sujet</th>
                                    <th style="width: 20%;">DATE CREATION</th>
                                    <th style="width: 20%;">AUTEUR</th>
                                    <th style="width: 20%;">ACTION</th>
                                </tr>
                            </thead>
                            <?php
                                    if(isset($data['sujets']))
                                    {
                                        foreach ($data['sujets'] as $sujet) {
                                        $titreSujet = $sujet->getTitresujet();
                                        $datecreation1 = new DateTime($sujet->getDatecreation());
                                        $datecreation=$datecreation1->format("d/m/Y H:i");
                                        $sujetId = $sujet->getId();
                                        $auteur=$sujet->getUtilisateur()->getPsuedo();
                                        $auteurId=$sujet->getUtilisateur()->getId(); ?>
                                <tbody>
                                    <td><a href="?ctrl=forum&method=showAllPostsByTopic&id=<?= $sujetId ?>"><?= $titreSujet ?></a></td>
                                    <td><?= $datecreation ?></td>
                                    <td style="width: 10%;"><a href="?ctrl=utilisateur&method=userDetail&id=<?= $auteurId?>"><?= $auteur ?></a></td>
                                    <?php 
                                            if(!empty(Session::getUtilisateur())){

                                                if(Session::getUtilisateur()->getRole() < 2){
                                    ?>
                                    <td  class='boutonsmessage'>
                                        <button class='buttons'><a href='?ctrl=message& method=supsujet&id=<?= $sujetId?>'>Supprimer</a></button>
                                        <button class='buttons'><a href='?ctrl=message&method=modsujet&id=<?= $sujetId ?>'>Modifier</a></button>
                                    </td>
                                    <?php
                                                }
                                            }
                                    ?>
                                </tbody>
                            <?php } } ?>
                        </table>
                    </li>
                </div>
            </ul>
        </nav>
    </div>
</div>


<?php
$titre = "Categorie: "  . $th->getNomcategorie();