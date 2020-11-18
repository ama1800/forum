<?php
use App\Session;


?>
<div id="page">
    <div class="headforum">
        <h3>Resultats de la Recherche : <?= sizeof($data['resultsS'])+ sizeof($data['resultsM'])?> Résultat(s) trouvé</h3>
        <h4>Les Sujets : <?= sizeof($data['resultsS'])==0? "Aucun résultat trouvé":sizeof($data['resultsS'])?></h4>
        <div class="list-group">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>TITRE SUJET</th>
                            <th>DATE CREATION</th>
                            <th>SUJET</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
            <?php
            foreach ($data['resultsS'] as $k=>$sujetResults) 
            {
                $datecreation1 = new DateTime($sujetResults->getDatecreation());
                $datecreation=$datecreation1->format("d/m/Y H:i");
                $idS=$sujetResults->getId();
                $titreSujet=$sujetResults->getTitresujet();
                $contenu=$sujetResults->getContenu();
                $idS=$sujetResults->getId();

                $q=$_POST['q'];
                $mots=explode(" ", $q);
                $i=0;
                foreach($mots as $mot)
                {
                    if(strlen($mot)>2)
                    {
                        $i++;
                        if($i>4){$i=1;} 
                        $titreSujet= str_ireplace($mot, '<span class="colorer'.$i.'">'.$mot.'</span>',$titreSujet);
                        $contenu= str_ireplace($mot, '<span class="colorer'.$i.'">'.$mot.'</span>',$contenu);
                    }
                }?> 
                    <tbody>
                        <tr>
                            <td><a style="color: #d300ff; font-size: larger" href="?ctrl=forum&method=showAllPostsByTopic&id=<?= $idS ?>"><?= $titreSujet ?></a></td>
                            <td><?= $datecreation ?></td>
                            <td><?= $contenu ?></td>
                            <?php 
                            if(!empty(Session::getUtilisateur())){

                                if(Session::getUtilisateur()->getRole() < 3){
                            ?>
                            <td style="width: 10%; margin: auto" class='boutonssujet'><button class='buttons'><a href='?ctrl=sujet&method=supsujet&id=<?= $idS ?>'>Supprimer</a></button>
                    <button class='buttons'><a href='?ctrl=sujet&method=modTopicForm&id=<?= $idS ?>'>Modifier</a></button></td>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <?php
            // $nbSujet=sizeof($data['resultsS']);
            // $parPage=4; 
            // $nbPages= ceil(intval($nbSujet)/$parPage);?>
            <!-- <span id="pages">PAGES:  <nav style="display: flex;"> -->
                <?php
                    // for($i=1; $i<=$nbPages; $i++)
                    // {
                ?>
            <!-- <a href="?ctrl=forum&method=search&p=<?//$i?>"><h5><?//$i?></h5></a>/ -->
                <?php
                    // }
                ?>
            </nav>
            </span>
        </div>
        
        <h4>Les Messages: <?= sizeof($data['resultsM'])==0? "Aucun résultat trouvé":sizeof($data['resultsM'])?></h4>
                <div class="list-group">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>TITRE MESSAGE</th>
                                        <th>DATE CREATION</th>
                                        <th>MESSAGE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <?php
        foreach ($data['resultsM'] as $k=>$messageResults) 
        {
            
            $datecreation1 = new DateTime($messageResults->getDatecreation());
            $datecreation=$datecreation1->format("d/m/Y H:i");
            $id=$messageResults->getId();
            $titreMessage=$messageResults->getTitremessage();
            $reponse=$messageResults->getReponse();
            $sujetId=$messageResults->getSujet()->getId();
            //  requperer le mot out la phrase a chercher
            $q=$_POST['q'];
            // exploser la chaine de caracteres et stocker les mots dans un tableau
                $mots=explode(" ", $q);
                // initialisation d'un conteur
                $i=0;
                // parcourir le tableau
                foreach($mots as $mot)
                {
                    
                    // seulement mot a plus de 2 caracteres
                    if(strlen($mot)>2)
                    {
                        // incrementer le compteur =1
                        $i++;
                        // si compteur arrive à 4 recommence de 1
                        if($i>4){$i=1;} 
                        // remplacer les mots rechercher par un span class= colorerX X=$i qui s'incremente.
                        // str_ireplace() ne prend pas compte des majuscules ou miniscules. 
                        $titreMessage= str_ireplace($mot, '<span class="colorer'.$i.'">'.$mot.'</span>',$titreMessage);
                        $reponse= str_ireplace($mot, '<span class="colorer'.$i.'">'.$mot.'</span>',$reponse);
                    }
                }?>
                    <tbody>
                        <tr>
                            <td style="width: 25%;"><a style="color: #d300ff; font-size: larger" href="?ctrl=forum&method=showAllPostsByTopic&id=<?= $sujetId?>"><?='<span>'. $titreMessage .'</span>'?></a></td>
                            <td><?= $datecreation ?></td>
                            <td><?= $reponse ?></td>
                            <?php 
                            if(!empty(Session::getUtilisateur())){

                                if(Session::getUtilisateur()->getRole() < 3){
                            ?>
                            <td style="width: 10%; margin: auto" class='boutonssujet'><button class='buttons'><a href='?ctrl=sujet&method=supsujet&id=<?= $id ?>'>Supprimer</a></button>
                            <button class='buttons'><a href='?ctrl=sujet&method=modTopicForm&id=<?= $id ?>'>Modifier</a></button></td>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <?php
            // $nbMessages=sizeof($data['resultsM']);
            // $parPage=4; 
            // $nbPages= ceil(intval($nbMessages)/$parPage);?>
            <!-- <span id="pages">PAGES:  <nav style="display: flex;"> -->
                <?php
                    // for($i=1; $i<=$nbPages; $i++)
                    // {
                ?>
            <!-- <a href="?ctrl=forum&method=search&p=<?//$i?>"><h5><?//$i?></h5></a>/ -->
                <?php
                    // }
                ?>
            <!-- </nav>
            </span> -->
        </div>
    </div>
</div>

<?php
$titre = "Listes Des resultats"; 