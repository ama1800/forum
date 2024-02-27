<?php
use App\Session;
?>
<div id="page">
<a href="?ctrl=sujet&method=addTopicForm"><button type="button" class="btn btn-secondary">Creer Un Sujet</button></a>
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>Liste Du Sujets:</li>
                    <div class="list-group">
                        <?php foreach ($data['sujets'] as $sujet) {
                            $sujetStatu = $sujet->getVerrouillage() == 0 ? '<img width="30" height="30" src="https://i.ibb.co/V3gstS3/ouvert.png" alt="ouvert" border="0" >'  : '<img width="30" height="30" src="https://i.ibb.co/gmmhQd6/fermer.png" alt="fermer" border="0" >';
                            $sujetNom = $sujet->getTitreSujet();
                            $datecreation = $sujet->getDatecreation() ? new DateTime($sujet->getDatecreation()) : "__";
                            if($datecreation !== "__") $datecreation = $datecreation->format("d/m/Y H:i");
                            $sujetId = $sujet->getId();
                            $sujetContenu = $sujet->getContenu();
                            $sujetNbMessage = $sujet->getNb();
                            $auteur = $sujet->getUtilisateur()->getPsuedo();
                            $auteurId = $sujet->getUtilisateur()->getId(); ?>

                            
                    </div>
                    <table class="table table-dark">
                        <a style="color: ivory; font-size: larger" href="?ctrl=forum&method=showAllPostsByTopic&id=<?= $sujetId ?>" class="list-group-item list-group-item-action active"><?= $sujetNom ?></a>
                        <thead>
                            <tr>
                                <th>STATUTS</th>
                                <th>DATE CREATION</th>
                                <th>NB Messages</th>
                                <th>AUTEUR</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td style="width: 10%; " ><?= $sujetStatu ?></td>
                            <td style="width: 20%;" ><?= $datecreation ?></td>
                            <td style="width: 30%;"><?= empty($sujetNbMessage)? 0 : $sujetNbMessage ?></td>
                            <td style="width: 20%;"><a href="?ctrl=utilisateur&method=userDetail&id=<?= $auteurId?>"><?= $auteur ?></a></td>
                            <?php 
                                if(!empty(Session::getUtilisateur())){

                                    if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$auteurId) ){
                            ?>
                                    <td style="width: 60%; margin: auto; display:grid" class='boutonssujet'>
                                        <button class='buttons'><a href='?ctrl=sujet&method=supsujet&id=<?= $sujetId ?>'>Supprimer</a></button>
                                        <button class='buttons'><a href='?ctrl=sujet&method=modTopicForm&id=<?= $sujetId ?>'>Modifier</a></button>
                                    </td>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                         <?php } ?>
                    </table>
                    
                </li>
            </ul>
        </nav>
    </div>
    <?php
        $nbSujets=$data['nbSujets'];
        $parPage=5; 
        $nbPages= ceil(intval($nbSujets['nb'])/$parPage);?>
        <span id="pages">PAGES:  <nav style="display: flex;">
            <?php
                for($i=1; $i<=$nbPages; $i++)
                {
            ?>
        <a href="?ctrl=forum&method=listSujets&p=<?=$i?>"><h5><?=$i?></h5></a>/
            <?php
                }
            ?>
        </nav></span>

</div>
<?php
$titre = "Listes Du Sujets"; ?>


<!-- <a style="  -->