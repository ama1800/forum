<?php
use App\Session;
?>

<div id="page">
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>Forum</li>
                <div class="list-group">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>TITRE MESSAGE</th>
                            <th>DATE CREATION</th>
                            <th>LE MESSAGE</th>
                            <th>L'AUTEUR</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <?php foreach ($data['messages'] as $message) {
                        $messageNom = $message->getTitremessage();
                        $messageId = $message->getId();
                        $datecreation1 = new DateTime($message->getDatecreation());
                        $datecreation=$datecreation1->format("d/m/Y H:i");
                        $reponse= $message->getReponse();
                        $auteur = $message->getUtilisateur()->getPsuedo();
                        $auteurId = $message->getUtilisateur()->getId();
                        $sujetId= $message->getSujet()->getId();
                         ?>
                    <tbody>
                        <td style="width: 12%;"><a href="?ctrl=forum&method=showAllPostsByTopic&id=<?= $sujetId?>"><?='<span>'. $messageNom .'</span>'?></a></td>
                        <td style="width: 12%"><?= $datecreation ?></td>
                        <td style="width: 52%; color :goldenrod "><?= '<p >'.$reponse.'</p>' ?></td>
                        <td style="width: 12%"><a href="?ctrl=utilisateur&method=userDetail&id=<?= $auteurId?>"><?= $auteur ?></a></td>
                        <?php 
                                if(!empty(Session::getUtilisateur())){

                                    if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$auteurId) ){
                            ?>
                        <td style="display:grid " class='boutonsMessage'><button class='buttons'><a href='?ctrl=message&method=supMessage&id=<?= $messageId?>'>Supprimer</a>
                            </button>
                            <button class='buttons'><a href='?ctrl=message&method=modPostForm&id=<?= $messageId?>'>Modifier</a></button>
                        </td>
                        <?php
                                    }
                                }
                        ?>
                    </tbody>
            <?php } ?>
                </table>
                </div>
            </li>
            </ul>
        </nav>
    </div>
    <?php
    // pagination
        $nbMessages=$data['nbMessages'];
        // nombre de messages par page
        $parPage=5; 
        //  arrondir vers un entier le nombre totale de messages diviser par nombre de messages par page
        $nbPages= ceil(intval($nbMessages['nbm'])/$parPage);
    ?>
    <span id="pages">PAGES:  
        <nav style="display: flex;">
        <?php
        // boucler pour definir le nombre de pages a afficher
            for($i=1; $i<=$nbPages; $i++)
            { 
        ?>
        <!-- Générer les liens d'acces aux page -->
        <a href="?ctrl=message&method=DerniersMessages&p=<?=$i?>"><h5><?=$i?></h5></a>/
        <?php
            }
        ?>
            </nav>
        </span>
</div>

<?php
$titre = "Listes Du messages"; ?>