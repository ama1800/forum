<?php
use App\Session;
$grades = $data['grades'];
$users = $data['users'];
// $colors = $data['colors'];
?>
<div id="page">
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>Forum</li>
                <li>
                    <div class="list-group">
                        <?php 
                        foreach ($users as $user) {
                            $userNom = $user->getNom() ? $user->getNom()." ".$user->getPrenom() : "__";
                            $dateadhesion = $user->getDateadhesion() ? new DateTime($user->getDateadhesion()) : "__";
                            if($dateadhesion !== "__") $dateadhesion = $dateadhesion->format("d/m/Y H:i");
                            $userId = $user->getId();
                            $userpsuedo = $user->getPsuedo();
                            $userRole = $user->getRole();
                            $avatar = $user->getAvatar();
                            $pays = strtoupper($user->getAdresse()."<br>".$user->getPays());
                            $datenaissance = $user->getDatenaissance() ? new DateTime($user->getDatenaissance()) : "__";
                            if($datenaissance !== "__") $datenaissance = $datenaissance->format("d/m/Y");
                             ?>

                            <span><img style=" width: 50px; height: 50px;" src="<?= $avatar ?>" alt="avatar"></span>
                            <a style="color: ivory; font-size: larger" href="?ctrl=utilisateur&method=userDetail&id=<?= $userId ?>" class="list-group-item list-group-item-action active"><?= $userpsuedo ?></a>
                    
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>NOM</th>
                                    <th>DATE naissance</th>
                                    <th>ROLE</th>
                                    <th>CORDONNEES</th>
                                    <th>DATE ADHESION</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                    </div>
                            <tbody>
                                <tr>
                                    <td style="width: 20%; " ><?= $userNom ?></td>
                                    <td style="width: 20%;" ><?= $datenaissance ?></td>
                                    <td style="width: 10%; color :gold; height:60px; overflow: hidden; " ><?php 
                                                                    foreach($grades as $role=>$grade)
                                                                    {
                                                                        if($role == $userRole)
                                                                        {
                                                                            echo $grade;
                                                                        }
                                                                    }?></td>
                                    <td style="width: 20%;"><?= $pays ?></td>
                                    <td style="width: 20%;"><?= $dateadhesion ?></td>
                                    <?php 
                                        if(!empty(Session::getUtilisateur())){

                                        if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$userId) ){
                                    ?> 
                                    <td style="width: 10%; margin: auto" class='boutonsuser'>
                                        <button class='buttons'><a href='?ctrl=utilisateur&method=supUser&id=<?= $userId ?>'>Supprimer</a></button>
                                        <button class='buttons'><a href='?ctrl=utilisateur&method=modUserForm&id=<?= $userId ?>'>Modifier</a></button>
                                    </td>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                        <?php } ?>
                </li>
           </ul>
        </nav>
    </div>
        <?php
            $nbUsers=$data['nbUsers'];
            $parPage=5; 
            $nbPages= ceil(intval($nbUsers['nb'])/$parPage);?>
                <span id="pages">PAGES:  <nav style="display: flex; margin:auto;">
            <?php
                for($i=1; $i<=$nbPages; $i++)
                { 
            ?>
                <a href="?ctrl=forum&method=latestUsers&p=<?=$i?>"><h5><?=$i?></h5></a>/
            <?php
            }
         ?></nav></span>
</div>

<?php
$titre = "Listes Du users"; ?>