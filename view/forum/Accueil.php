<?php
use App\Session;
// $nbm = $data['totalMessages'];
// var_dump($nbm); die;
// $nb=$nbm->getNbm();
// die;
?>
<div id="page">
    <div class="headforum">
        <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li>Forum</li>
            <div class="list-group"><?php
            foreach($data['categories'] as $categorie ){
                $catStatu=$categorie->getVerouillage()==0 ? '<img width="30" height="30" src="https://i.ibb.co/V3gstS3/ouvert.png" alt="ouvert" border="0" >'  : '<img width="30" height="30" src="https://i.ibb.co/gmmhQd6/fermer.png" alt="fermer" border="0" >';
                $catNom=$categorie->getNomcategorie();
                $catId=$categorie->getId();
                $catNbSujet=$categorie->getNb();?>
                <a style="color: ivory; font-size: larger" href="?ctrl=forum&method=showAllTopicsByCategorie&id=<?= $catId ?>" class="list-group-item list-group-item-action active">
                <?= $catNom ?></a></div><table class="table table-dark">
                                                            <thead>
                                                            <tr>
                                                                <th>STATUTS</th>
                                                                <th>NB SUJETS<br></th>
                                                                <th>NB MESSAGES</th>
                                                                <th>DERNIERS MESSAGES</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <td><?= $catStatu ?></td>
                                                                <td><?= $catNbSujet ?></td>
                                                                <td><?php //$nbm->getNb()?></td>
                                                                <td> 
                                                                    <ul>
                                                                            <?php 
                                                                            foreach ($data['messages'] as $k=>$mess) {
                                                                                $id=$mess->getId();
                                                                                $titremessage=$mess->getTitremessage();
                                                                            ?>
                                                                    
                                                                        <li>
                                                                            <a  href="?ctrl=message&method=showAllPostsByTopic&id=<?= $id ?>"><?= $titremessage ?></a>
                                                                        </li>
                                                                            <?php }?>
                                                                    </ul>
                                                                    
                                                                </td>
                                                                    <?php 
                                                                        if(!empty(Session::getUtilisateur())){

                                                                            if((Session::getUtilisateur()->getRole() < 2)){
                                                                    ?>
                                                                <td style="width: 12%; margin: auto" class='boutonsCategorie'>
                                                                    <button class='buttons'><a href='?ctrl=categorie&method=supcategorie&id=<?= $catId ?>'>Supprimer</a></button>
                                                                    <button class='buttons'><a href='?ctrl=categorie&method=modcategorie&id=<?= $catId ?>'>Modifier</a></button>
                                                                </td>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
            <?php } ?>
            </li>
        </nav>
    </div>
           
    

<?php
$titre = "Forum Accueil";
$totalMessages= $data['totalMessages'];