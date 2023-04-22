<?php
use App\Session;
$grades = $data['grades'];
// var_dump($data['messages'] );
// var_dump($data['messages'] );
$user = $data['user'];
$datenaissance1 = new DateTime($user->getDatenaissance());
$datenaissance=$datenaissance1->format("d/m/Y");
$dateadhesion1 = new DateTime($user->getDateadhesion());
$dateadhesion=$dateadhesion1->format("d/m/Y H:i");
?>
</div>
    <div class="headforum">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>User:</li>
                <div class="list-group">
                    <li>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                <th>NOM</th>
                                <th>DATE naissance</th>
                                <th>ROLE</th>
                                <th>SUJETS</th>
                                <th>PAYS</th>
                                <th>DATE ADHESION</th>
                                <th>AVATAR</th>
                                <th>ACTION</th>
                                </tr>
                            </thead><a style="font-size:x-large" href="?ctrl=utilisateur&method=userDetail&id=<?=  $user->getId() ?>" class="list-group-item list-group-item-action active">
                                    <?= $user->getPsuedo() ?></a>
                            <tbody>
                                <tr>
                                    <td><?= $user->getNom() ?></td>
                                    <td><?= $datenaissance ?></td>
                                    <td><?php
                                    foreach($grades as $role=>$grade)
                                    {
                                        if($role == $user->getRole())
                                        {
                                            echo $grade;
                                        }
                                    }
                                    ?></td>
                                    <td><?php foreach ($data['sujets'] as $sujet) {
                                        // var_dump($sujet);
                                        $id=$sujet->getId();
                                        $titre=$sujet->getTitresujet();?>
                                        <ul><li><a href="?ctrl=forum&method=showAllPostsByTopic&id=<?=$id?>"><?=$titre?></li></ul></a><?php }?></td>
                                    <td><?= strtoupper($user->getAdresse()." <br>".$user->getPays())?></td>
                                    <td><?= $dateadhesion?></td>
                                <td><img style=" width: 50px; height: 50px;" src="<?= AVATAR_PATH .$user->getAvatar() ?>" alt="avatar"></td>
                                <?php 
                                if(!empty(Session::getUtilisateur())){

                                    if((Session::getUtilisateur()->getRole() < 3) or (Session::getUtilisateur()->getId()==$user->getId()) ){
                                ?>
                                <td style="width: 10%; margin: auto" class='boutonsuser'><button class='buttons'><a href='?ctrl=utilisateur&method=supuser&id=<?= $user->getId() ?>'>Supprimer</a></button>
                        <button class='buttons'><a href='?ctrl=utilisateur&method=modUserForm&id=<?= $user->getId() ?>'>Modifier</a></button></td>
                                <?php
                                            }
                                        }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </div>
            </ul>
        </nav>
    </div>
    <button id="editPass">Vous Voulez Changer le Password?</button><br>
        <?php
            if(!empty(Session::getUtilisateur()))
            {
              if(Session::getUtilisateur()->getId()==$user->getId())
            {?>
        <form class="inscription" action="?ctrl=security&method=modPass&id=<?= $user->getId()?>" method="POST">
          <div  id="pass"> 
              <div class="form-group">
                <input type="password" class="form-control" name="passActuel" placeholder="Actuel Password" required> 
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Nouveau Password" required> 
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password1" placeholder="Confirmez Password" required>
              </div>
              <div>
                <button type="submit" id="changer" class="btn btn-primary">Changer le Password</button><br>
                <input id="token" name="token" type="hidden" value=<?=$token?>><br>
          </div>
              </div>
          </div>
        </form>
        
        <?php
            }
            else echo "<p>Sauf erreur, Ce n'est pas votre compte..!! </p>";
          }
          else echo "<p>Veuillez vous connecter pour modifier votre mot de passe!</p>"
          ?>
</div>


<?php
$titre = "user: "  . $user->getPsuedo();