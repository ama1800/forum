<?php
use App\Session;
$th = $data['sujet'];
$nb = $data['nb'];
$id=$th->getId();
$datecreation1 = new DateTime($th->getDatecreation());
$datecreation=$datecreation1->format("d/m/Y H:i");
$auteur= $th->getUtilisateur()->getPsuedo();
$auteurId= $th->getUtilisateur()->getId();
?>
<div id="page">
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <?php if($th->getVerrouillage() == 0){ ?>
    <a href="?ctrl=message&method=addPostForm"><button type="button" class="btn btn-secondary">Répondre</button></a> <?php }else {?>
    <a><button type="button" class="btn btn-secondary btn-lg" disabled>Sujet Fermé</button></a> <?php } ?>
</div>
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>SUJET PAR:</li>
                <div class="list-group">
                    <li>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>STATUTS</th>
                                    <th>TITRE SUJET</th>
                                    <th>DATE CREATION</th>
                                    <th>SUJET</th>
                                    <th>NB Messages</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <a style="font-size: x-large;" href="?ctrl=utilisateur&method=userDetail&id=<?= $auteurId?>"><?= $auteur ?></a>
                            <tbody>
                                <tr>
                                    <td><?= $sujetStatu = $th->getVerrouillage() == 0 ? '<img width="30" height="30" src="https://i.ibb.co/V3gstS3/ouvert.png" alt="ouvert" border="0" >'  : '<img width="30" height="30" src="https://i.ibb.co/gmmhQd6/fermer.png" alt="fermer" border="0" >' ?></td>
                                    <td><?= $th->getTitresujet() ?></td>
                                    <td><?= $datecreation ?></td>
                                    <td><?= $th->getContenu() ?></td>
                                    <td><?= $nb->getNbm()?></td>
                                    <?php 
                                    if(!empty(Session::getUtilisateur())){

                                        if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$auteurId) ){
                                    ?>
                                    <td style="width: 10%; margin: auto" class='boutonssujet'><button class='buttons'><a href='?ctrl=sujet&method=supsujet&id=<?= $id ?>'>Supprimer</a></button>
                            <button class='buttons'><a href='?ctrl=sujet&method=modTopicForm&id=<?= $id ?>'>Modifier</a></button></td>
                                    <?php
                                                }
                                            }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </div>
                <div class="list-group">
                    <li>
                        <?php
                                    foreach ($data['messages'] as $message):
                                        $titreMessage = $message->getTitreMessage();
                                        $datecreation = $message->getDatecreation();
                                        $reponse = $message->getReponse();
                                        $messageId = $message->getId();
                                        $auteur = $message->getUtilisateur()->getPsuedo(); 
                                        $auteurId = $message->getUtilisateur()->getId();?>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">TITRE Message</th>
                                    <th style="width: 20%;">DATE CREATION</th>
                                    <th style="width: 40%;">Message</th>
                                    <th style="width: 20%; margin: auto">ACTION</th>
                                </tr>
                            </thead>
                                    <a style="font-size:x-large" href="?ctrl=utilisateur&method=userDetail&id=<?=  $auteurId ?>" class="list-group-item list-group-item-action active">
                                    <?=  $auteur ?></a>
                            <tbody>
                                <td><?= $titreMessage ?></td>
                                <td><?= $datecreation ?></td>
                                <td><?= $reponse ?></td>
                                <?php 
                                if(!empty(Session::getUtilisateur())){

                                    if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$auteurId) ){
                                ?>
                                <td  class='boutonsmessage'><button class='buttons'><a href='?ctrl=message&method=supmessage&id=<?= $messageId?>'>Supprimer</a></button>
                        <button class='buttons'><a href='?ctrl=message&method=modPostForm&id=<?=$messageId?>'>Modifier</a></button></td>
                                <?php
                                            }
                                        }
                                ?>
                            </tbody>
                        </table>
                        <?php endforeach; ?>
                    </li>
                </div>
            </ul>
        </nav>
    </div>
    <form action="?ctrl=message&method=addPost&id=<?= $id ?>" method="POST">
        <div class="form-group">
            <label for="ajoutMessge"><h4>Ajouter Un Message:</h4> </label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="titremessage" id="exampleFormControlInput1" placeholder="Titre Du message"><br>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="reponse" id="exampleFormControlTextarea1" placeholder="Votre Message" rows="5"></textarea><br>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Envoyez</button>
        </div>
        <input id="token" name="token" type="hidden" value=<?=$token?>><br><br>
    </form>
</div>


<?php
$titre = "Sujet: "  . $th->getTitresujet();
